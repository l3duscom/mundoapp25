<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Ticket;
use App\Traits\ValidacoesTrait;

class Carrinho extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $ticketModel;



	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->ticketModel = new \App\Models\TicketModel();
	}

	public function evento($event_id)
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}


		$items = $this->ticketModel->recuperaIngressosPorEvento($event_id);


		$ingressos = array();
		foreach ($items as $item) {
			$ingressos[] = array(
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
			);
		}
		//dd($ingressos);

		$data = [
			'titulo' => 'Comprar ingressos',
			'id' => $id,
			'items' => $ingressos

		];


		return view('Carrinho/index', $data);
	}

	public function girafinhas($event_id)
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}


		$items = $this->ticketModel->recuperaIngressosGirafasPorEvento($event_id);


		$ingressos = array();
		foreach ($items as $item) {
			$ingressos[] = array(
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
			);
		}
		//dd($ingressos);

		$data = [
			'titulo' => 'Comprar ingressos parceiros',
			'id' => $id,
			'items' => $ingressos

		];


		return view('Carrinho/girafa', $data);
	}

	public function loja()
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}





		$data = [
			'titulo' => 'Exclusivos e colecionáveis',
			'id' => $id,

		];


		return view('Carrinho/loja', $data);
	}

	public function clube()
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}





		$data = [
			'titulo' => 'DreamClub - O Clube de Vantagens do Dream!',
			'id' => $id,

		];


		return view('Carrinho/clube', $data);
	}



	public function pucrs()
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}





		$data = [
			'titulo' => 'Comprar ingressos PUCRS',
			'id' => $id,

		];


		return view('Carrinho/pucrs', $data);
	}

	public function marista()
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}





		$data = [
			'titulo' => 'Comprar ingressos Marista',
			'id' => $id,

		];


		return view('Carrinho/pucrs', $data);
	}


	/**
	 * Método que recupera o cliente
	 *
	 * @param integer $id
	 * @return Exceptions|object
	 */
	private function buscaclienteOu404(int $id = null)
	{
		if (!$id || !$cliente = $this->clienteModel->recuperaCliente($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o cliente $id");
		}

		return $cliente;
	}
}
