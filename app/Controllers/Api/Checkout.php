<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AuditoriaModel;
use App\Models\PedidoModel;

class Checkout extends ResourceController
{
    public function obrigado()
    {
        return $this->respond([
            'status' => 'success',
            'mensagem' => 'Compra realizada com sucesso!'
        ]);
    }

    public function notify()
    {
        // Log do início da notificação
        log_message('info', 'Notify recebido: ' . $this->request->getBody());
        
        $json = $this->request->getBody();
        $data = json_decode($json, true);

        if (!$data || !isset($data['payment'])) {
            log_message('error', 'Dados de pagamento ausentes ou inválidos: ' . $json);
            return $this->fail('Dados de pagamento ausentes ou inválidos.');
        }

        $payment_id = $data['payment']['id'] ?? null;
        $payment_status = $data['payment']['status'] ?? null;
        $payment_transactionReceiptUrl = $data['payment']['transactionReceiptUrl'] ?? null;

        // Validações
        if (!$payment_id) {
            log_message('error', 'Payment ID não encontrado');
            return $this->fail('Payment ID não encontrado.');
        }

        if (!$payment_status) {
            log_message('error', 'Status do pagamento não encontrado');
            return $this->fail('Status do pagamento não encontrado.');
        }

        // Auditoria
        $auditoriaModel = new AuditoriaModel();
        $auditoriaModel->insert([
            'acao' => 'Notify',
            'descricao' => 'Notificação Asaas pay - ID: ' . $payment_id . ' - Status: ' . $payment_status,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Atualiza pedido
        $pedidosModel = new PedidoModel();
        $pedido = $pedidosModel->where('charge_id', $payment_id)->first();
        
        if (!$pedido) {
            log_message('error', 'Pedido não encontrado para charge_id: ' . $payment_id);
            return $this->fail('Pedido não encontrado.');
        }

        $updated = $pedidosModel
            ->where('charge_id', $payment_id)
            ->set([
                'status' => $payment_status,
                'comprovante' => $payment_transactionReceiptUrl,
                'updated_at' => date('Y-m-d H:i:s')
            ])
            ->update();

        if ($updated) {
            log_message('info', 'Pedido atualizado com sucesso: ' . $payment_id);
            return $this->respond(['status' => 'success', 'message' => 'Pedido atualizado com sucesso.']);
        } else {
            log_message('error', 'Erro ao atualizar pedido: ' . $payment_id);
            return $this->fail('Erro ao atualizar pedido.');
        }
    }
} 