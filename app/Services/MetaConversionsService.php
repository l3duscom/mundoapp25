<?php

namespace App\Services;

use App\Models\PedidoModel;
use App\Models\UsuarioModel;
use App\Models\EventoModel;

class MetaConversionsService
{
    const API_BASE = 'https://graph.facebook.com/v20.0';

    protected $pedidoModel;
    protected $usuarioModel;
    protected $eventoModel;

    private string $accessToken;
    private string $defaultPixelId;
    private string $testEventCode;

    public function __construct()
    {
        $this->pedidoModel  = new PedidoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->eventoModel  = new EventoModel();

        $this->accessToken    = env('META_PIXEL_ACCESS_TOKEN', '');
        $this->defaultPixelId = env('META_PIXEL_ID', '');
        $this->testEventCode  = env('META_CAPI_TEST_EVENT_CODE', '');
    }

    /**
     * Dispara evento Purchase para a Meta Conversions API.
     *
     * @param int   $pedidoId ID do pedido confirmado
     * @param array $context  ['ip' => string, 'ua' => string, 'fbc' => string, 'fbp' => string]
     */
    public function sendPurchaseEvent(int $pedidoId, array $context = []): bool
    {
        if (empty($this->accessToken)) {
            log_message('warning', 'Meta CAPI: META_PIXEL_ACCESS_TOKEN não configurado');
            return false;
        }

        $pedido = $this->pedidoModel->find($pedidoId);
        if (!$pedido) {
            log_message('error', 'Meta CAPI: Pedido #' . $pedidoId . ' não encontrado');
            return false;
        }

        $usuario = $this->usuarioModel->find($pedido->user_id);
        $evento  = $this->eventoModel->find($pedido->evento_id ?? $this->defaultPixelId);

        $pixelId = (!empty($evento->meta_pixel_id)) ? $evento->meta_pixel_id : $this->defaultPixelId;
        if (empty($pixelId)) {
            log_message('warning', 'Meta CAPI: Nenhum meta_pixel_id configurado para pedido #' . $pedidoId);
            return false;
        }

        $eventId = $this->generateEventId($pedidoId);

        $userData = $this->buildUserData($usuario, $context);

        $payload = [
            'data' => [[
                'event_name'       => 'Purchase',
                'event_time'       => time(),
                'event_id'         => $eventId,
                'event_source_url' => base_url('checkout/obrigado'),
                'action_source'    => 'website',
                'user_data'        => $userData,
                'custom_data'      => [
                    'value'        => (float)($pedido->total ?? 0),
                    'currency'     => 'BRL',
                    'content_ids'  => [(string)($pedido->evento_id ?? '')],
                    'content_type' => 'product',
                    'order_id'     => (string)$pedidoId,
                    'content_name' => $evento->nome ?? '',
                ],
            ]],
        ];

        if (!empty($this->testEventCode)) {
            $payload['test_event_code'] = $this->testEventCode;
        }

        return $this->send($pixelId, $payload);
    }

    /**
     * Gera event_id estável e compartilhável com o browser (deduplicação).
     * Baseado apenas no pedido_id para ser reproduzível.
     */
    public function generateEventId(int $pedidoId): string
    {
        return 'purchase_' . $pedidoId;
    }

    private function buildUserData(?object $usuario, array $context): array
    {
        $data = [];

        if ($usuario) {
            if (!empty($usuario->email)) {
                $data['em'] = [hash('sha256', strtolower(trim($usuario->email)))];
            }

            if (!empty($usuario->telefone)) {
                $tel = preg_replace('/\D/', '', $usuario->telefone);
                // Normaliza para E.164 sem sinal
                if (strlen($tel) === 11 || strlen($tel) === 10) {
                    $tel = '55' . $tel;
                }
                $data['ph'] = [hash('sha256', $tel)];
            }

            if (!empty($usuario->nome)) {
                $partes = explode(' ', trim($usuario->nome), 2);
                $data['fn'] = [hash('sha256', strtolower($partes[0]))];
                if (!empty($partes[1])) {
                    $data['ln'] = [hash('sha256', strtolower($partes[1]))];
                }
            }

            if (!empty($usuario->cpf)) {
                $cpf = preg_replace('/\D/', '', $usuario->cpf);
                $data['external_id'] = [hash('sha256', $cpf)];
            } else {
                $data['external_id'] = [hash('sha256', (string)$usuario->id)];
            }

            $data['country'] = [hash('sha256', 'br')];
        }

        if (!empty($context['ip'])) {
            $data['client_ip_address'] = $context['ip'];
        }

        if (!empty($context['ua'])) {
            $data['client_user_agent'] = $context['ua'];
        }

        if (!empty($context['fbc'])) {
            $data['fbc'] = $context['fbc'];
        }

        if (!empty($context['fbp'])) {
            $data['fbp'] = $context['fbp'];
        }

        return $data;
    }

    private function send(string $pixelId, array $payload): bool
    {
        $url = self::API_BASE . '/' . $pixelId . '/events?access_token=' . urlencode($this->accessToken);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr  = curl_error($ch);
        curl_close($ch);

        if ($curlErr) {
            log_message('error', 'Meta CAPI: cURL error: ' . $curlErr);
            return false;
        }

        $json = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && !empty($json['events_received'])) {
            log_message('info', 'Meta CAPI: Purchase enviado com sucesso. events_received=' . $json['events_received']);
            return true;
        }

        log_message('error', 'Meta CAPI: Falha HTTP ' . $httpCode . ' — ' . $response);
        return false;
    }
}
