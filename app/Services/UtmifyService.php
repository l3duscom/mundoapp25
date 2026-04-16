<?php

namespace App\Services;

use App\Models\PedidoModel;
use App\Models\PedidoUtmModel;
use App\Models\UsuarioModel;

/**
 * Serviço de integração com UTMify
 * Envia postback de venda confirmada via API
 */
class UtmifyService
{
    const API_URL = 'https://api.utmify.com.br/api-credentials/orders';
    const API_TOKEN = 'rTHVfZ0W4FaTkSz4cgcMw0eGXst1kq7NJCfT';

    protected $pedidoModel;
    protected $pedidoUtmModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
        $this->pedidoUtmModel = new PedidoUtmModel();
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Notifica o UTMify sobre uma venda confirmada
     */
    public function notifyPurchase(int $pedidoId): bool
    {
        $pedido = $this->pedidoModel->find($pedidoId);
        if (!$pedido) {
            log_message('error', 'UTMify: Pedido não encontrado: ' . $pedidoId);
            return false;
        }

        $usuario = $this->usuarioModel->find($pedido->user_id);
        if (!$usuario) {
            log_message('error', 'UTMify: Usuário não encontrado para pedido: ' . $pedidoId);
            return false;
        }

        $utms = $this->pedidoUtmModel->getByPedidoId($pedidoId);

        $payload = [
            'orderId'    => $pedido->codigo,
            'platform'   => 'MundoApp',
            'paymentMethod' => $pedido->forma_pagamento === 'CREDIT_CARD' ? 'credit_card' : 'pix',
            'status'     => 'paid',
            'currency'   => 'BRL',
            'grossValue' => (float) $pedido->total,
            'customer'   => [
                'name'  => $usuario->nome ?? '',
                'email' => $usuario->email ?? '',
                'phone' => $usuario->telefone ?? '',
            ],
            'trackingParameters' => [
                'src'           => $utms->utm_source ?? '',
                'sck'           => $utms->utm_campaign ?? '',
                'utm_source'    => $utms->utm_source ?? '',
                'utm_medium'    => $utms->utm_medium ?? '',
                'utm_campaign'  => $utms->utm_campaign ?? '',
                'utm_content'   => $utms->utm_content ?? '',
                'utm_term'      => $utms->utm_term ?? '',
            ],
            'createdAt' => $pedido->created_at ?? date('Y-m-d\TH:i:s'),
        ];

        return $this->sendToUtmify($payload);
    }

    /**
     * Envia dados para a API do UTMify
     */
    private function sendToUtmify(array $payload): bool
    {
        $ch = curl_init(self::API_URL);

        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'x-api-token: ' . self::API_TOKEN,
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_TIMEOUT        => 10,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            log_message('error', 'UTMify cURL error: ' . $error);
            return false;
        }

        if ($httpCode >= 200 && $httpCode < 300) {
            log_message('info', 'UTMify: Venda enviada com sucesso. Response: ' . $response);
            return true;
        }

        log_message('error', 'UTMify: Erro HTTP ' . $httpCode . '. Response: ' . $response);
        return false;
    }
}
