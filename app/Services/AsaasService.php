<?php

namespace App\Services;

use Exception;


class AsaasService
{


    private $access_token;
    private $customers;
    private $payments;
    private $subscriptions;
    private $baseUrl;



    public function __construct()
    {
        if (env('CI_ENVIRONMENT') == 'development') {
            $this->access_token = env('ASAAS_ACCESS_TOKEN_SANDBOX');
            $this->baseUrl = 'https://sandbox.asaas.com/api/v3/';
            $this->customers = $this->baseUrl . 'customers';
            $this->payments = $this->baseUrl . 'payments/';
            $this->subscriptions = $this->baseUrl . 'subscriptions';
        } else {
            $this->access_token = env('ASAAS_ACCESS_TOKEN');
            $this->baseUrl = 'https://www.asaas.com/api/v3/';
            $this->customers = $this->baseUrl . 'customers';
            $this->payments = $this->baseUrl . 'payments/';
            $this->subscriptions = $this->baseUrl . 'subscriptions';
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
            //'dueDate' =>  date('Y-m-d', strtotime('+1 days')),
            'dueDate' =>  date('Y-m-d'),
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

    // ========================================
    // MÉTODOS DE ASSINATURA RECORRENTE
    // ========================================

    /**
     * Cria uma assinatura recorrente no Asaas
     *
     * @param array $data Dados da assinatura
     * @return array|null
     */
    public function createSubscription(array $data): ?array
    {
        $subscription = [
            'customer' => $data['customer_id'],
            'billingType' => $data['billing_type'] ?? 'CREDIT_CARD',
            'value' => (float) $data['value'],
            'nextDueDate' => $data['next_due_date'] ?? date('Y-m-d'),
            'cycle' => $data['cycle'] ?? 'MONTHLY', // MONTHLY ou YEARLY
            'description' => $data['description'] ?? 'Assinatura Premium',
            'externalReference' => $data['external_reference'] ?? null,
        ];

        // Se for cartão de crédito, adiciona os dados do cartão
        if (($data['billing_type'] ?? 'CREDIT_CARD') === 'CREDIT_CARD' && isset($data['credit_card'])) {
            $subscription['creditCard'] = [
                'holderName' => $data['credit_card']['holder_name'],
                'number' => $data['credit_card']['number'],
                'expiryMonth' => $data['credit_card']['expiry_month'],
                'expiryYear' => $data['credit_card']['expiry_year'],
                'ccv' => $data['credit_card']['ccv'],
            ];
            $subscription['creditCardHolderInfo'] = [
                'name' => $data['holder_info']['name'],
                'email' => $data['holder_info']['email'],
                'cpfCnpj' => $data['holder_info']['cpf_cnpj'],
                'postalCode' => $data['holder_info']['postal_code'],
                'addressNumber' => $data['holder_info']['address_number'],
                'mobilePhone' => $data['holder_info']['mobile_phone'],
            ];
        }

        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->subscriptions);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($subscription));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $retorno = json_decode($apiResponse, true);

            curl_close($ch);

            log_message('info', 'Asaas createSubscription response: ' . json_encode($retorno));

            return $retorno;
        } catch (Exception $e) {
            log_message('error', 'Erro ao criar assinatura Asaas: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Cancela uma assinatura no Asaas
     *
     * @param string $subscriptionId ID da assinatura no Asaas
     * @return array|null
     */
    public function cancelSubscription(string $subscriptionId): ?array
    {
        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->subscriptions . '/' . $subscriptionId);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $retorno = json_decode($apiResponse, true);

            curl_close($ch);

            log_message('info', 'Asaas cancelSubscription response: ' . json_encode($retorno));

            return $retorno;
        } catch (Exception $e) {
            log_message('error', 'Erro ao cancelar assinatura Asaas: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtém detalhes de uma assinatura no Asaas
     *
     * @param string $subscriptionId ID da assinatura no Asaas
     * @return array|null
     */
    public function getSubscription(string $subscriptionId): ?array
    {
        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->subscriptions . '/' . $subscriptionId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $retorno = json_decode($apiResponse, true);

            curl_close($ch);

            return $retorno;
        } catch (Exception $e) {
            log_message('error', 'Erro ao obter assinatura Asaas: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Lista pagamentos de uma assinatura
     *
     * @param string $subscriptionId ID da assinatura no Asaas
     * @return array|null
     */
    public function getSubscriptionPayments(string $subscriptionId): ?array
    {
        $headers = [
            'Content-Type: application/json',
            'access_token: ' . $this->access_token
        ];

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->subscriptions . '/' . $subscriptionId . '/payments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $apiResponse = curl_exec($ch);
            $retorno = json_decode($apiResponse, true);

            curl_close($ch);

            return $retorno;
        } catch (Exception $e) {
            log_message('error', 'Erro ao listar pagamentos da assinatura: ' . $e->getMessage());
            return null;
        }
    }
}
