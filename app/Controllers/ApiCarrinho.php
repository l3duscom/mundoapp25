<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Evento;
use App\Entities\Ticket;
use App\Traits\ValidacoesTrait;

class ApiCarrinho extends BaseController
{
    use ValidacoesTrait;

    private $clienteModel;
    private $usuarioModel;
    private $cartaoModel;
    private $ticketModel;
    private $eventoModel;

    public function __construct()
    {
        $this->clienteModel = new \App\Models\ClienteModel();
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->cartaoModel = new \App\Models\CartaoModel();
        $this->ticketModel = new \App\Models\TicketModel();
        $this->eventoModel = new \App\Models\EventoModel();
    }

    public function evento($event_id)
    {
        $evento = $this->eventoModel->find($event_id);
        $items = $this->ticketModel->recuperaIngressosPorEvento($event_id);
        $ingressos = array();
        foreach ($items as $item) {
            $ingressos[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'preco' => $item->preco,
                'descricao' => $item->descricao,
                'data_inicio' => $item->data_inicio,
                'data_fim' => $item->data_fim,
                'tipo' => $item->tipo,
                'dia' => $item->dia,
                'lote' => $item->lote,
                'categoria' => $item->categoria,
                'data_lote' => $item->data_lote,
                'estoque' => $item->estoque
            ];
        }
        return $this->response->setJSON([
            'evento' => $evento,
            'ingressos' => $ingressos
        ]);
    }

    public function adicional($event_id)
    {
        $items = $this->ticketModel->recuperaAdicionaisPorEvento($event_id);
        $ingressos = array();
        foreach ($items as $item) {
            $ingressos[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'preco' => $item->preco,
                'descricao' => $item->descricao,
                'data_inicio' => $item->data_inicio,
                'data_fim' => $item->data_fim,
                'tipo' => $item->tipo,
                'dia' => $item->dia,
                'lote' => $item->lote,
                'categoria' => $item->categoria,
                'data_lote' => $item->data_lote,
                'estoque' => $item->estoque
            ];
        }
        return $this->response->setJSON([
            'ingressos' => $ingressos
        ]);
    }

    public function girafinhas($event_id)
    {
        $items = $this->ticketModel->recuperaIngressosGirafasPorEvento($event_id);
        $ingressos = array();
        foreach ($items as $item) {
            $ingressos[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'preco' => $item->preco,
                'descricao' => $item->descricao,
                'data_inicio' => $item->data_inicio,
                'data_fim' => $item->data_fim,
                'tipo' => $item->tipo,
                'lote' => $item->lote,
                'categoria' => $item->categoria,
                'data_lote' => $item->data_lote,
                'estoque' => $item->estoque
            ];
        }
        return $this->response->setJSON([
            'ingressos' => $ingressos
        ]);
    }

    public function otakada($event_id)
    {
        $items = $this->ticketModel->recuperaIngressosOtakadaPorEvento($event_id);
        $ingressos = array();
        foreach ($items as $item) {
            $ingressos[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'preco' => $item->preco,
                'descricao' => $item->descricao,
                'data_inicio' => $item->data_inicio,
                'data_fim' => $item->data_fim,
                'tipo' => $item->tipo,
                'lote' => $item->lote,
                'categoria' => $item->categoria,
                'data_lote' => $item->data_lote,
                'estoque' => $item->estoque
            ];
        }
        return $this->response->setJSON([
            'ingressos' => $ingressos
        ]);
    }

    public function loja()
    {
        return $this->response->setJSON([
            'titulo' => 'Exclusivos e colecionáveis'
        ]);
    }

    public function clube()
    {
        return $this->response->setJSON([
            'titulo' => 'DreamClub - O Clube de Vantagens do Dream!'
        ]);
    }

    public function pucrs($event_id)
    {
        $items = $this->ticketModel->recuperaIngressosPucPorEvento($event_id);
        $ingressos = array();
        foreach ($items as $item) {
            $ingressos[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'preco' => $item->preco,
                'descricao' => $item->descricao,
                'data_inicio' => $item->data_inicio,
                'data_fim' => $item->data_fim,
                'tipo' => $item->tipo,
                'lote' => $item->lote,
                'categoria' => $item->categoria,
                'data_lote' => $item->data_lote,
                'estoque' => $item->estoque
            ];
        }
        return $this->response->setJSON([
            'ingressos' => $ingressos
        ]);
    }

    public function marista($event_id)
    {
        $items = $this->ticketModel->recuperaIngressosPucPorEvento($event_id);
        $ingressos = array();
        foreach ($items as $item) {
            $ingressos[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'preco' => $item->preco,
                'descricao' => $item->descricao,
                'data_inicio' => $item->data_inicio,
                'data_fim' => $item->data_fim,
                'tipo' => $item->tipo,
                'lote' => $item->lote,
                'categoria' => $item->categoria,
                'data_lote' => $item->data_lote,
                'estoque' => $item->estoque
            ];
        }
        return $this->response->setJSON([
            'ingressos' => $ingressos
        ]);
    }

    public function adicionar()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();
        if (empty($data['item_id']) || empty($data['quantidade'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'item_id e quantidade são obrigatórios.'
            ])->setStatusCode(400);
        }
        // Simulação de "adicionar ao carrinho" (em produção, salvaria em sessão, banco ou cache)
        $item = $this->ticketModel->find($data['item_id']);
        if (!$item) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item não encontrado.'
            ])->setStatusCode(404);
        }
        $carrinho = [
            'item_id' => $item->id,
            'nome' => $item->nome,
            'preco' => $item->preco,
            'quantidade' => (int)$data['quantidade']
        ];
        // Aqui você pode expandir para múltiplos itens, salvar em sessão, etc.
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Item adicionado ao carrinho.',
            'carrinho' => [$carrinho]
        ]);
    }
} 