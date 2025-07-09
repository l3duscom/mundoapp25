<?php

namespace App\Controllers;

use App\Services\GerencianetService;
use CodeIgniter\Config\Factories;


class Home extends BaseController
{

    private $ordemModel;
    private $usuarioModel;
    private $ordemItemModel;
    private $clienteModel;
    private $fornecedorModel;
    private $itemModel;
    private $gerencianetService;
    private $ingressoModel;
    private $pedidoModel;
    private $eventoModel;

    public function __construct()
    {
        $this->ordemModel = new \App\Models\OrdemModel();
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->ordemItemModel = new \App\Models\OrdemItemModel();
        $this->clienteModel = new \App\Models\ClienteModel();
        $this->fornecedorModel = new \App\Models\FornecedorModel();
        $this->itemModel = new \App\Models\ItemModel();
        $this->ingressoModel = new \App\Models\IngressoModel();
        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->eventoModel = new \App\Models\EventoModel();
    }

    public function index()
    {

        $eventos = $this->eventoModel->findAll();



        $data = [
            'titulo' => 'Home',
            'eventos' => $eventos,
        ];

        if (!$this->usuarioLogado()->temPermissaoPara('visualizar-home')) {

            return redirect()->to(site_url("Console/dashboard"));
        }




        return view('Home/index', $data);
    }

    public function evento(int $event_id)
    {
        $total_ingressos_individual = $this->ingressoModel->recuperaTotalIngressos($event_id);
        $total_ingressos_sabado = $this->ingressoModel->recuperaTotalIngressosSabado($event_id);
        $total_ingressos_domingo = $this->ingressoModel->recuperaTotalIngressosDomingo($event_id);

        $total_ingressos_combo = $this->ingressoModel->recuperaTotalIngressosCombo($event_id);
        $total_ingressos_hoje = $this->ingressoModel->recuperaTotalIngressosHoje($event_id);
        $total_ingressos_pendentes = $this->ingressoModel->recuperaTotalIngressosPendentes($event_id);
        $total_ingressos_cortesias = $this->ingressoModel->recuperaTotalIngressosCortesias($event_id);

        $total_ingressos = $total_ingressos_individual + $total_ingressos_combo;
        $valor_hoje = $this->pedidoModel->recuperaTotalIngressosHojeValor($event_id);
        $valor_total = $this->pedidoModel->recuperaTotalIngressosValor($event_id);
        $total_sabado = $total_ingressos_sabado + $total_ingressos_combo;
        $total_domingo = $total_ingressos_domingo + $total_ingressos_combo;
        $total_epic = $this->ingressoModel->recuperaTotalIngressosEpic($event_id);
        $total_vip = $this->ingressoModel->recuperaTotalIngressosVip($event_id);




        $data = [
            'titulo' => 'Home',
            'total_ingressos' => $total_ingressos,
            'total_ingressos_hoje' => $total_ingressos_hoje,
            'total_ingressos_pendentes' => $total_ingressos_pendentes,
            'total_ingressos_cortesias' => $total_ingressos_cortesias,
            'total_sabado' => $total_sabado,
            'total_domingo' => $total_domingo,
            'total_epic' => $total_epic,
            'total_vip' => $total_vip,
            'valor_hoje' => $valor_hoje,
            'valor_total' => $valor_total,
        ];

        if (!$this->usuarioLogado()->temPermissaoPara('visualizar-home')) {

            return redirect()->to(site_url("Console/dashboard"));
        }




        return view('Home/evento', $data);
    }

    public function boletoteste()
    {

        //$boleto = $this->gerencianetService->criaBoleto($a);
        //echo $boleto['data']['barcode'];
    }
}
