<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Ingresso;
use App\Traits\ValidacoesTrait;
use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class Console extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $ingressoModel;
	private $pedidoModel;


	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->ingressoModel = new \App\Models\IngressoModel();
		$this->pedidoModel = new \App\Models\PedidoModel();
	}

	public function dashboard()
	{

		unset($_SESSION['carrinho']);

		$id = $this->usuarioLogado()->id;

		$convite = $this->usuarioLogado()->codigo;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		$indicacoes = $this->pedidoModel->where('convite', $convite)->whereIn('status', ['CONFIRMED', 'RECEIVED', 'paid'])->countAllResults();

		$card = $this->cartaoModel->where('user_id', $id)->where('expiration >= NOW()')->first();

		$ingressos = $this->ingressoModel->recuperaIngressosPorUsuario($id);



		foreach ($ingressos as $key => $value) {
			$ingressos[$key]->qr = (new QRCode)->render($ingressos[$key]->codigo);
		}


		$ingresso = $this->ingressoModel->select('id')
			->where('user_id', $id)
			->first();
		if (isset($ingresso)) {
			$temingresso = true;
		} else {
			$temingresso = false;
		}





		$data = [
			'titulo' => 'Dashboard de ' . esc($cliente->nome),
			'cliente' => $cliente,
			'card' => $card,
			'temingresso' => $temingresso,
			'convite' => $convite,
			'indicacoes' => $indicacoes,
			'ingressos' => $ingressos,

		];




		return view('Console/dashboard', $data);
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
