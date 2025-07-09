<?php

namespace App\Controllers;

use Exception;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
use App\Entities\Pedido;

class Cron extends BaseController
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
    private $pedidoModel;
    private $auditoriaModel;

    public function __construct()
    {
        $this->options = [
            'client_id' => env('GERENCIANET_CLIENT_ID'),
            'client_secret' => env('GERENCIANET_CLIENT_SECRET'),
            'sandbox' => env('GERENCIANET_SANDBOX'), // altere conforme o ambiente (true = homologação e false = producao)
            'time' => env('GERENCIANET_TIMEOUT')
        ];
        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->auditoriaModel = new \App\Models\AuditoriaModel();
    }

    public function index()
    {
        // Envio o hash do token do form
        $tokenNotificacao = trim($this->request->getPost('notification'));

        $log = [
            'acao' => 'notificação - start',
            'descricao' => 'foi chamado'
        ];
        $this->auditoriaModel->skipValidation(true)->protect(false)->insert($log);

        $params = [
            'token' => $tokenNotificacao
        ];
        //$params = ['token' => '8a207235-5feb-40cc-959b-e889d57147ae'];

        $log = [
            'acao' => 'token',
            'descricao' => $tokenNotificacao
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->getNotification($params, []);



            // Conta o tamanho do array data (que armazena o resultado)
            $i = count($response["data"]);
            // Pega o último Object chargeStatus
            $ultimoStatus = $response["data"][$i - 1];
            // Acessando o array Status
            $status = $ultimoStatus["status"];
            // Obtendo o ID da transação        
            $charge_id = $ultimoStatus["identifiers"]["charge_id"];
            // Obtendo a String do status atual
            $statusAtual = $status["current"];


            $log = [
                'acao' => 'notificação ',
                'descricao' => 'Cliente | ' . $charge_id . ' | ' . $statusAtual . ' criado'
            ];
            $this->auditoriaModel->skipValidation(true)->protect(false)->insert($log);

            $this->pedidoModel
                ->protect(false)
                ->where('charge_id', $charge_id)
                ->set('status', $statusAtual)
                ->update();

            // Com estas informações, você poderá consultar sua base de dados e atualizar o status da transação especifica, uma vez que você possui o "charge_id" e a String do STATUS

            echo "O id da transação é: " . $charge_id . " seu novo status é: " . $statusAtual;

            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
