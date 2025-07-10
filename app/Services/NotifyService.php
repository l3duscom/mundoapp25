<?php

namespace App\Services;

use Exception;


class NotifyService
{


    private $access_token;
    private $device_token;
    private $url;
    private $ativos = true;



    public function __construct()
    {
        if (env('CI_ENVIRONMENT') == 'development') {
            $this->access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwcC5hcGlicmFzaWwuaW8vYXV0aC9yZWdpc3RlciIsImlhdCI6MTcwODY5NTk3OCwiZXhwIjoxNzQwMjMxOTc4LCJuYmYiOjE3MDg2OTU5NzgsImp0aSI6InBUR1FDRG5CeDdIS2ZWNk4iLCJzdWIiOiI3NTA3IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.RsmXkLI0gI_h6K-x-3rei8Gi088RE6d1VSJ2LXvGhZE';
            $this->device_token = '18c4cfd2-4e88-4d5b-9fed-fc2ef413ef30';
            $this->url = 'https://cluster.apigratis.com/api/v2/whatsapp/sendText';
        } else {
            $this->access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwcC5hcGlicmFzaWwuaW8vYXV0aC9yZWdpc3RlciIsImlhdCI6MTcwODY5NTk3OCwiZXhwIjoxNzQwMjMxOTc4LCJuYmYiOjE3MDg2OTU5NzgsImp0aSI6InBUR1FDRG5CeDdIS2ZWNk4iLCJzdWIiOiI3NTA3IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.RsmXkLI0gI_h6K-x-3rei8Gi088RE6d1VSJ2LXvGhZE';
            $this->device_token = '18c4cfd2-4e88-4d5b-9fed-fc2ef413ef30';
            $this->url = 'https://cluster.apigratis.com/api/v2/whatsapp/sendText';
        }
    }

    public function notificawpp($cliente, $mensagem)
    {
        // Valide $cliente e $mensagem adequadamente antes de usá-los

        $vars = array(
            'number' => '55' . preg_replace('/\D/', '', $cliente->telefone),
            'text' => $mensagem,
        );

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->access_token,
            'DeviceToken: ' . $this->device_token,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vars));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $apiResponse = curl_exec($ch);

        $data = json_decode($apiResponse, true);

        curl_close($ch);

        return $data;
    }

    public function notificawpppwd($cliente, $mensagem)
    {
        // Valide $post adequadamente antes de usá-lo

        $vars = array(
            //'number' => $cliente->number,
            'number' => '55' . str_replace([' ', '-', '(', ')'], '', $cliente->telefone),
            'text' => $mensagem,
        );

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->access_token,
            'DeviceToken: ' . $this->device_token,
        ];

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vars));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);

            // Verifique se a solicitação foi bem-sucedida (código de status HTTP 2xx) antes de continuar

            if (curl_getinfo($ch, CURLINFO_HTTP_CODE) >= 200 && curl_getinfo($ch, CURLINFO_HTTP_CODE) < 300) {
                $data = json_decode($apiResponse, true);
            } else {
                // Trata os erros 
                throw new Exception("Erro na API do Whatsapp: " . $apiResponse);
            }

            curl_close($ch);

            return $data;
        } catch (Exception $e) {
            throw new Exception("Erro na solicitação à API do whatsapp: " . $e->getMessage());
        }
    }


    public function whatsapp($cliente, $mensagem)
    {
        // Valide $post adequadamente antes de usá-lo
        $number = '5522222222222';
        $msg = "🔥Mensagem automatica enviada pelo sistema \n*Fechou!* \nhttps://dreamfest.com.br";
        $vars = array(
            //'number' => $cliente->number,
            'number' => $number,
            'text' => $msg,
        );

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->access_token,
            'DeviceToken: ' . $this->device_token,
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vars));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $apiResponse = curl_exec($ch);

        $data = json_decode($apiResponse, true);

        curl_close($ch);

        return $data;
    }
}
