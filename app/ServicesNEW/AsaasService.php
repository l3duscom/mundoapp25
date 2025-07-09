<?php

namespace App\Services;

use Exception;


class AsaasService
{


    private $access_token;
    private $customers;
    private $payments;



    public function __construct()
    {
        if (env('CI_ENVIRONMENT') == 'development') {
            $this->access_token = env('ASAAS_ACCESS_TOKEN_SANDBOX');
            $this->customers = 'https://sandbox.asaas.com/api/v3/customers';
            $this->payments = 'https://sandbox.asaas.com/api/v3/payments/';
        } else {
            $this->access_token = env('ASAAS_ACCESS_TOKEN');
            $this->customers = 'https://www.asaas.com/api/v3/customers';
            $this->payments = 'https://www.asaas.com/api/v3/payments/';
        }
    }

    public function customers($post)
    {

        $vars = array(
            'name' => $post['nome'],
            'email' => $post['email'],
            'phone' =>  $post['telefone'],
            'mobilePhone' =>  $post['telefone'],
            'cpfCnpj' => $post['cpf'],
            'postalCode' => $post['cep'],
            'addressNumber' => $post['numero'],
            "observations" => "Nome do evento",
            "notificationDisabled" => true,
        );

        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];



        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->customers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vars));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $dadosCustomer = json_decode($apiResponse, true);

            curl_close($ch);

            return $dadosCustomer;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function payments($post)
    {


        $dadosCustomer = $post['customer_id'];


        $credit_card = array(
            'customer' => $dadosCustomer,
            'billingType' => 'CREDIT_CARD',
            'dueDate' =>  date('Y-m-d', strtotime('+1 days')),
            'installmentCount' => $post['installmentCount'],
            'installmentValue' => number_format($post['installmentValue'], 2, '.', ''),
            'description' => $post['description'],
            'postalCode' => $post['postalCode'],
            'observations' => $post['observations'],
            'creditCard' => [
                'holderName' => $post['holderName'],
                'number' => $post['number'],
                'expiryMonth' => $post['expiryMonth'],
                'expiryYear' => $post['expiryYear'],
                'ccv' => $post['ccv']
            ],
            'creditCardHolderInfo' => [
                'name' => $post['nome'],
                'email' => $post['email'],
                'cpfCnpj' => $post['cpf'],
                'postalCode' => $post['cep'],
                'addressNumber' => $post['numero'],
                'mobilePhone' => $post['telefone']
            ],

            'remoteIp' => $_SERVER['REMOTE_ADDR']
        );




        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];



        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->payments);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credit_card));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $dadosCreditCard = json_decode($apiResponse, true);


            curl_close($ch);

            return $dadosCreditCard;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function paymentPix($post)
    {


        $dadosCustomer = $post['customer_id'];


        $pay = array(
            'customer' => $dadosCustomer,
            'billingType' => 'PIX',
            'dueDate' =>  date('Y-m-d', strtotime('+1 days')),
            'value' => $post['value'] / 100,
            'description' => $post['description'],
            'externalReference' => $post['externalReference'],
        );




        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];



        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->payments);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pay));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $retorno = json_decode($apiResponse, true);


            curl_close($ch);

            return $retorno;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function listaCobranca($payment_id)
    {
        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];



        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->payments . $payment_id);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $retorno = json_decode($apiResponse, true);


            curl_close($ch);


            return $retorno;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function obtemQrCode(string $payment_id)
    {
        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];



        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->payments . $payment_id . '/pixQrCode');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);

            $retorno = json_decode($apiResponse, true);

            curl_close($ch);


            return $retorno;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
