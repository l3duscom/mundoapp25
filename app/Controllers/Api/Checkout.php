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
        $json = $this->request->getBody();
        $data = json_decode($json, true);

        if (!$data || !isset($data['payment'])) {
            return $this->fail('Dados de pagamento ausentes ou inválidos.');
        }

        $payment_id = $data['payment']['id'] ?? null;
        $payment_status = $data['payment']['status'] ?? null;
        $payment_transactionReceiptUrl = $data['payment']['transactionReceiptUrl'] ?? null;

        // Auditoria
        $auditoriaModel = new AuditoriaModel();
        $auditoriaModel->insert([
            'acao' => 'Notify',
            'descricao' => 'Notificação Asaas pay'
        ]);

        // Atualiza pedido
        $pedidosModel = new PedidoModel();
        $updated = $pedidosModel
            ->where('charge_id', $payment_id)
            ->set([
                'status' => $payment_status,
                'comprovante' => $payment_transactionReceiptUrl
            ])
            ->update();

        if ($updated) {
            return $this->respond(['status' => 'success', 'message' => 'Pedido atualizado com sucesso.']);
        } else {
            return $this->fail('Erro ao atualizar pedido.');
        }
    }
} 