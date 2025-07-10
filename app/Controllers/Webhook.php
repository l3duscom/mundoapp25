<?php

namespace App\Controllers;

use App\Models\AuditoriaModel;
use App\Models\PedidoModel;

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

        // Log dos valores extraídos
        log_message('info', 'Payment ID: ' . $payment_id);
        log_message('info', 'Payment Status: ' . $payment_status);

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
                'descricao' => 'Notificação Asaas pay - ID: ' . $payment_id . ' - Status: ' . $payment_status,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Atualiza pedido diretamente
            $pedidosModel = new PedidoModel();
            
            $result = $pedidosModel
                ->where('charge_id', $payment_id)
                ->set([
                    'status' => $payment_status,
                    'comprovante' => $payment_transactionReceiptUrl,
                    'updated_at' => date('Y-m-d H:i:s')
                ])
                ->update();

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
} 