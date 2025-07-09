<?php

namespace App\Services;

use Exception;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class GerencianetService
{
    public const PAYMENT_METHOD_BILLET = 'billet';
    public const PAYMENT_METHOD_CREDIT = 'credit';

    private const STATUS_NEW = 'new';
    private const STATUS_WAITING = 'waiting';
    private const STATUS_PAID = 'paid';
    private const STATUS_UNPAID = 'unpaid';
    private const STATUS_REFUNDED = 'refunded';
    private const STATUS_CONTESTED = 'contested';
    private const STATUS_SETTLED = 'settled';
    private const STATUS_CANCELED = 'canceled';

    private $options;
    private $user;
    private $subscriptionService;
    private $userSubscription;

    public function __construct()
    {
        $this->options = [
            'client_id' => env('GERENCIANET_CLIENT_ID'),
            'client_secret' => env('GERENCIANET_CLIENT_SECRET'),
            'sandbox' => env('GERENCIANET_SANDBOX'), // altere conforme o ambiente (true = homologação e false = producao)
            'time' => env('GERENCIANET_TIMEOUT')
        ];
    }

    public function createPlan()
    {


        $body = [
            'name' => 'My plan',
            'interval' => 2,
            'repeats' => null
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->createPlan([], $body);

            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            exit;
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function criaBoleto($post)
    {

        $items = [
            $post['item']
        ];

        $metadata = array('notification_url' => 'https://mundodream.com.br/cron.php');

        $cpf = trim($post['cpf']);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);


        $customer = [
            'name' => $post['nome'],
            'cpf' => $cpf,
            'email' => $post['email']

        ];







        $bankingBillet = [
            'expire_at' => $post['expiration'],
            'customer' => $customer,

        ];

        $payment = [
            'banking_billet' => $bankingBillet
        ];

        $body = [
            'items' => $items,
            'metadata' => $metadata,
            'payment' => $payment
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->oneStep([], $body);

            //$response['data']['variaveldagerencianet'];

            return $response;

            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function criaCartao($post)
    {
        $paymentToken = $post['payment_token'];

        $items = [
            $post['item']
        ];

        $metadata = array('notification_url' => 'https://mundodream.com.br/cron.php');

        $cpf = trim($post['cpf']);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);


        $customer = [
            'name' => $post['nome'],
            'cpf' => $cpf,
            'phone_number' => $post['telefone'],
            'email' => $post['email'],
            'birth' => $post['nascimento']
        ];

        $billingAddress = [
            'street' => $post['rua'],
            'number' => $post['numero'],
            'neighborhood' => $post['bairro'],
            'zipcode' => $post['cep'],
            'city' => $post['cidade'],
            'state' => $post['estado']
        ];

        $credit_card = [
            'customer' => $customer,
            'installments' => (int) $post['parcelas'],
            'billing_address' => $billingAddress,
            'payment_token' => $paymentToken
        ];
        $payment = [
            'credit_card' => $credit_card
        ];

        $body = [
            'items' => $items,
            'metadata' => $metadata,
            'payment' => $payment
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->oneStep([], $body);
            return $response;
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            echo 'Máscara do cartão:' . $post['mascara_cartao'];
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
