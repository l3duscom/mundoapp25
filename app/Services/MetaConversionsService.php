<?php

namespace App\Services;

use App\Models\PedidoModel;
use App\Models\UsuarioModel;
use App\Models\EventoModel;
use App\Models\ClienteModel;
use App\Models\EnderecoModel;

class MetaConversionsService
{
    const API_BASE = 'https://graph.facebook.com/v20.0';

    protected $pedidoModel;
    protected $usuarioModel;
    protected $eventoModel;
    protected $clienteModel;
    protected $enderecoModel;

    private string $accessToken;
    private string $defaultPixelId;
    private string $testEventCode;

    public function __construct()
    {
        $this->pedidoModel   = new PedidoModel();
        $this->usuarioModel  = new UsuarioModel();
        $this->eventoModel   = new EventoModel();
        $this->clienteModel  = new ClienteModel();
        $this->enderecoModel = new EnderecoModel();

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

        $usuario  = $this->usuarioModel->find($pedido->user_id);
        $cliente  = $this->clienteModel->where('usuario_id', $pedido->user_id)->first();
        $endereco = null;
        if (!empty($pedido->endereco_id)) {
            $endereco = $this->enderecoModel->find($pedido->endereco_id);
        }
        if (!$endereco) {
            $endereco = $this->enderecoModel->where('user_id', $pedido->user_id)->orderBy('id', 'DESC')->first();
        }

        $evento  = $this->eventoModel->find($pedido->evento_id ?? $this->defaultPixelId);

        $pixelId = (!empty($evento->meta_pixel_id)) ? $evento->meta_pixel_id : $this->defaultPixelId;
        if (empty($pixelId)) {
            log_message('warning', 'Meta CAPI: Nenhum meta_pixel_id configurado para pedido #' . $pedidoId);
            return false;
        }

        $eventId = $this->generateEventId($pedidoId);

        $userData = $this->buildUserData($usuario, $cliente, $endereco, $context);

        log_message('info', 'Meta CAPI: pedido #' . $pedidoId
            . ' user_data keys=' . implode(',', array_keys($userData))
            . ' cliente=' . ($cliente ? 'sim' : 'nao')
            . ' endereco=' . ($endereco ? 'sim' : 'nao'));

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

    private function buildUserData(?object $usuario, ?object $cliente, ?object $endereco, array $context): array
    {
        $data = [];

        $email    = $cliente->email    ?? $usuario->email    ?? null;
        $telefone = $cliente->telefone ?? null;
        $nome     = $cliente->nome     ?? $usuario->nome     ?? null;
        $cpf      = $cliente->cpf      ?? null;
        $cep      = $endereco->cep     ?? $cliente->cep      ?? null;
        $cidade   = $endereco->cidade  ?? $cliente->cidade   ?? null;
        $estado   = $endereco->estado  ?? $cliente->estado   ?? null;

        if (!empty($email)) {
            $data['em'] = [hash('sha256', strtolower(trim($email)))];
        }

        if (!empty($telefone)) {
            $tel = preg_replace('/\D/', '', $telefone);
            // Normaliza para E.164 sem sinal (Brasil = 55)
            if (strlen($tel) === 11 || strlen($tel) === 10) {
                $tel = '55' . $tel;
            }
            $data['ph'] = [hash('sha256', $tel)];
        }

        if (!empty($nome)) {
            $partes = explode(' ', trim($nome), 2);
            $data['fn'] = [hash('sha256', strtolower($partes[0]))];
            if (!empty($partes[1])) {
                $data['ln'] = [hash('sha256', strtolower($partes[1]))];
            }
        }

        if (!empty($cpf)) {
            $cpfNorm = preg_replace('/\D/', '', $cpf);
            $data['external_id'] = [hash('sha256', $cpfNorm)];
        } elseif (!empty($usuario->id)) {
            $data['external_id'] = [hash('sha256', (string)$usuario->id)];
        }

        if (!empty($cep)) {
            $zp = preg_replace('/\D/', '', $cep);
            $data['zp'] = [hash('sha256', $zp)];
        }

        if (!empty($cidade)) {
            $ct = preg_replace('/[^a-z0-9]/', '', strtolower($this->removerAcentos($cidade)));
            if ($ct !== '') {
                $data['ct'] = [hash('sha256', $ct)];
            }
        }

        if (!empty($estado)) {
            $st = strtolower(preg_replace('/[^a-zA-Z]/', '', $estado));
            if ($st !== '') {
                $data['st'] = [hash('sha256', $st)];
            }
        }

        $data['country'] = [hash('sha256', 'br')];

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

    private function removerAcentos(string $str): string
    {
        $de = ['á','à','â','ã','ä','é','è','ê','ë','í','ì','î','ï','ó','ò','ô','õ','ö','ú','ù','û','ü','ç','Á','À','Â','Ã','Ä','É','È','Ê','Ë','Í','Ì','Î','Ï','Ó','Ò','Ô','Õ','Ö','Ú','Ù','Û','Ü','Ç'];
        $para = ['a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c','A','A','A','A','A','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','C'];
        return str_replace($de, $para, $str);
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
