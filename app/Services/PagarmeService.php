<?php

namespace App\Services;

use Exception;


class PagarmeService
{

    private $apiKey;

    public function __construct()
    {
        if (env('CI_ENVIRONMENT') == 'development') {
            $this->apiKey = env('PAGARME_API_KEY_SANDBOX');
        } else {
            $this->apiKey = env('PAGARME_API_KEY');
        }
        //$this->apiKey = 'sk_e2751c76fc6e4b31a1bb8f776bafa661:'; // PRODUÇÃO
        //$this->apiKey = 'sk_test_7ba13a7131054cd4af8e1113b5ca9705:'; // HOMOLOGAÇÃO
    }

    private function sendRequest($endpoint, $data, $method = 'POST')
    {

        $url = "https://api.pagar.me/core/v5/{$endpoint}";
        $base64 = $this->apiKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($base64),
        ]);



        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'GET') {
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function createTransaction($data)
    {
        return $this->sendRequest('orders', $data);
    }
}
