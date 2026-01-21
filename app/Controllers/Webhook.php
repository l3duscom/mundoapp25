<?php

namespace App\Controllers;

use App\Models\AuditoriaModel;
use App\Models\PedidoModel;
use App\Models\CupomModel;
use App\Models\AssinaturaModel;
use App\Models\UsuarioModel;
use App\Services\PontosCompraService;

class Webhook extends BaseController
{
    public function asaas()
    {
        // Log do início da notificação
        log_message('info', 'Webhook ASAAS recebido: ' . $this->request->getBody());
        
        // Verifica se é uma requisição POST
        if ($this->request->getMethod() !== 'post') {
            log_message('error', 'Método não permitido: ' . $this->request->getMethod());
            return $this->response->setJSON(['error' => 'Método não permitido'])->setStatusCode(405);
        }
        
        $json = $this->request->getBody();
        $data = json_decode($json, true);

        // Log dos dados recebidos
        log_message('info', 'Dados decodificados: ' . json_encode($data));

        if (!$data || !isset($data['payment'])) {
            log_message('error', 'Dados de pagamento ausentes ou inválidos: ' . $json);
            return $this->response->setJSON(['error' => 'Dados de pagamento ausentes ou inválidos'])->setStatusCode(400);
        }

        $payment_id = $data['payment']['id'] ?? null;
        $payment_status = $data['payment']['status'] ?? null;
        $payment_transactionReceiptUrl = $data['payment']['transactionReceiptUrl'] ?? null;
        $subscription_id = $data['payment']['subscription'] ?? null;

        // Log dos valores extraídos
        log_message('info', 'Payment ID: ' . $payment_id);
        log_message('info', 'Payment Status: ' . $payment_status);
        log_message('info', 'Subscription ID: ' . ($subscription_id ?? 'N/A'));

        // Validações básicas
        if (!$payment_id || !$payment_status) {
            log_message('error', 'Dados obrigatórios não encontrados');
            return $this->response->setJSON(['error' => 'Dados obrigatórios não encontrados'])->setStatusCode(400);
        }

        try {
            // Auditoria simples
            $auditoriaModel = new AuditoriaModel();
            $auditoriaModel->insert([
                'acao' => 'Webhook ASAAS',
                'descricao' => 'Notificação Asaas pay - ID: ' . $payment_id . ' - Status: ' . $payment_status . ($subscription_id ? ' - Subscription: ' . $subscription_id : ''),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // ========================================
            // TRATAMENTO DE ASSINATURAS RECORRENTES
            // ========================================
            if ($subscription_id) {
                $this->processarWebhookAssinatura($subscription_id, $payment_status, $data);
            }

            // ========================================
            // TRATAMENTO DE PAGAMENTOS AVULSOS (PEDIDOS)
            // ========================================
            // Atualiza pedido diretamente
            $pedidosModel = new PedidoModel();
            
            // Busca o pedido antes de atualizar para verificar se tem cupom
            $pedido = $pedidosModel->where('charge_id', $payment_id)->first();
            $statusAnterior = $pedido ? $pedido->status : null;
            
            $result = $pedidosModel
                ->where('charge_id', $payment_id)
                ->set([
                    'status' => $payment_status,
                    'comprovante' => $payment_transactionReceiptUrl,
                    'updated_at' => date('Y-m-d H:i:s')
                ])
                ->update();

            // Se o pedido tem cupom, verifica se precisa decrementar (expirado/cancelado/reembolsado)
            if ($result && $pedido && $pedido->cupom_id) {
                $cupomModel = new CupomModel();
                
                // Status que indicam que o pagamento não foi efetivado ou foi cancelado/reembolsado
                $statusQueDevemDecrementar = [
                    'REFUNDED', 'CHARGEBACK', 'REFUND_REQUESTED', 'REFUND_IN_PROGRESS',
                    'OVERDUE', 'EXPIRED', 'PENDING', 'CANCELED', 'overdue', 'expired', 'canceled'
                ];
                
                // Decrementa se o status indica que o pagamento foi cancelado/expirado/reembolsado
                // Isso libera o cupom para ser usado novamente
                if (in_array($payment_status, $statusQueDevemDecrementar)) {
                    $cupomModel->decrementarUso($pedido->cupom_id);
                    log_message('info', 'Uso do cupom #' . $pedido->cupom_id . ' decrementado (status: ' . $payment_status . ') para pedido charge_id: ' . $payment_id);
                }
            }

            // Atribui pontos se o pagamento foi confirmado
            // Só atribui se o status anterior não era confirmado (evita duplicatas em múltiplos webhooks)
            if ($result && $pedido) {
                $statusConfirmados = ['RECEIVED', 'CONFIRMED', 'paid', 'RECEIVED_IN_CASH'];
                $statusAnteriorConfirmado = in_array($statusAnterior, $statusConfirmados);
                $statusAtualConfirmado = in_array($payment_status, $statusConfirmados);
                
                // Só atribui se mudou de não-confirmado para confirmado
                if (!$statusAnteriorConfirmado && $statusAtualConfirmado) {
                    $pontosService = new PontosCompraService();
                    $pontosResult = $pontosService->atribuirPontosDoPedido($pedido->id);
                    
                    if ($pontosResult['success']) {
                        log_message('info', 'Pontos atribuídos para pedido #' . $pedido->id . ': ' . ($pontosResult['data']['pontos'] ?? 0) . ' pontos');
                    } else {
                        log_message('warning', 'Falha ao atribuir pontos para pedido #' . $pedido->id . ': ' . ($pontosResult['message'] ?? 'Erro desconhecido'));
                    }
                }
            }

            if ($result) {
                log_message('info', 'Pedido atualizado com sucesso: ' . $payment_id);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Pedido atualizado com sucesso']);
            } else {
                log_message('error', 'Erro ao atualizar pedido: ' . $payment_id);
                return $this->response->setJSON(['error' => 'Erro ao atualizar pedido'])->setStatusCode(500);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exceção no webhook: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Erro interno: ' . $e->getMessage()])->setStatusCode(500);
        }
    }

    /**
     * Processa webhooks relacionados a assinaturas recorrentes
     *
     * @param string $subscriptionId ID da assinatura no Asaas
     * @param string $paymentStatus Status do pagamento
     * @param array $data Dados completos do webhook
     * @return void
     */
    private function processarWebhookAssinatura(string $subscriptionId, string $paymentStatus, array $data): void
    {
        $assinaturaModel = new AssinaturaModel();
        $usuarioModel = new UsuarioModel();

        $assinatura = $assinaturaModel->getByAsaasId($subscriptionId);

        if (!$assinatura) {
            log_message('warning', 'Assinatura não encontrada para subscription_id: ' . $subscriptionId);
            return;
        }

        log_message('info', 'Processando webhook de assinatura #' . $assinatura->id . ' - Status: ' . $paymentStatus);

        $statusConfirmados = ['RECEIVED', 'CONFIRMED', 'RECEIVED_IN_CASH'];
        $statusCancelados = ['REFUNDED', 'CHARGEBACK', 'REFUND_REQUESTED'];
        $statusAtrasados = ['OVERDUE'];

        if (in_array($paymentStatus, $statusConfirmados)) {
            // Pagamento confirmado - ativa/renova a assinatura
            $planoModel = new \App\Models\PlanoModel();
            $plano = $planoModel->find($assinatura->plano_id);
            
            $meses = ($plano && $plano->ciclo === 'YEARLY') ? 12 : 1;
            $novaDataFim = date('Y-m-d H:i:s', strtotime("+{$meses} months"));
            $proximoVencimento = date('Y-m-d', strtotime("+{$meses} months"));

            $assinaturaModel->update($assinatura->id, [
                'status' => 'ACTIVE',
                'data_fim' => $novaDataFim,
                'proximo_vencimento' => $proximoVencimento,
                'valor_pago' => $data['payment']['value'] ?? $assinatura->valor_pago,
            ]);

            $usuarioModel->protect(false)->update($assinatura->usuario_id, [
                'is_premium' => 1,
                'premium_ate' => $novaDataFim,
            ]);

            log_message('info', 'Assinatura #' . $assinatura->id . ' ativada/renovada até ' . $novaDataFim);

        } elseif (in_array($paymentStatus, $statusAtrasados)) {
            // Pagamento atrasado
            $assinaturaModel->update($assinatura->id, ['status' => 'OVERDUE']);
            log_message('info', 'Assinatura #' . $assinatura->id . ' marcada como OVERDUE');

        } elseif (in_array($paymentStatus, $statusCancelados)) {
            // Pagamento cancelado/reembolsado
            $assinaturaModel->update($assinatura->id, [
                'status' => 'CANCELLED',
                'data_fim' => date('Y-m-d H:i:s'),
            ]);

            $usuarioModel->protect(false)->update($assinatura->usuario_id, [
                'is_premium' => 0,
                'premium_ate' => null,
                'asaas_subscription_id' => null,
            ]);

            log_message('info', 'Assinatura #' . $assinatura->id . ' cancelada');
        }
    }
} 

