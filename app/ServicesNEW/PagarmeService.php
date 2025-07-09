<?php

namespace App\Services;

use CodeIgniter\HTTP\CURLRequest;

class PagarmeService
{
    protected $apiKey;
    protected $baseUrl;
    protected $client;

    public function __construct()
    {
        $this->apiKey = getenv('PAGARME_API_KEY');
        $this->baseUrl = getenv('PAGARME_API_URL') ?: 'https://api.pagar.me/core/v5';

        $this->client = service('curlrequest', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->apiKey}"
            ]
        ]);
    }

    public function createTransaction(array $payload): array
    {
        try {
            $response = $this->client->post("{$this->baseUrl}/orders", [
                'json' => $payload
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Throwable $e) {
            log_message('error', 'Erro ao criar transação no Pagar.me: ' . $e->getMessage());
            return ['errors' => [$e->getMessage()]];
        }
    }
}
