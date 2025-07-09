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
	private $meetModel;
	private $queueModel;



	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->ingressoModel = new \App\Models\IngressoModel();
		$this->pedidoModel = new \App\Models\PedidoModel();
		$this->meetModel = new \App\Models\MeetModel();
		$this->queueModel = new \App\Models\QueueModel();
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

	public function meets()
	{


		$id = $this->usuarioLogado()->id;

		$convite = $this->usuarioLogado()->codigo;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		$meets = $this->queueModel->recuperaQueuePorUsuario($id);





		foreach ($meets as $key => $value) {
			$meets[$key]->qr = (new QRCode)->render($meets[$key]->code);
		}








		$data = [
			'titulo' => 'Dashboard de ' . esc($cliente->nome),
			'cliente' => $cliente,
			'convite' => $convite,
			'meets' => $meets,

		];




		return view('Console/meets', $data);
	}

	public function meet(int $ingresso_id, int $event_id)
	{


		$id = $this->usuarioLogado()->id;

		$convite = $this->usuarioLogado()->codigo;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		$ingresso = $this->ingressoModel->find($ingresso_id);



		if (stripos($ingresso->nome, 'sábado') !== false) {
			$day = 'sab';
		} elseif (stripos($ingresso->nome, 'domingo') !== false) {
			$day = 'dom';
		} else {
			$day = 'duo';
		}


		if (stripos($ingresso->nome, 'vip') !== false) {
			$tipo = 'vip';
		} elseif (stripos($ingresso->nome, 'epic') !== false) {
			$tipo = 'epic';
		} else {
			$tipo = 'comum';
		}


		$meets_vip = $this->meetModel->recuperaMeetVipForDay($event_id, 'vip');
		$meets_epic = $this->meetModel->recuperaMeetEpicForDay($event_id, 'epic');
		$meets = $this->meetModel->recuperaMeetForDay($event_id);

		$count_queue = $this->queueModel->CountQueueForDayEpic($event_id, $day, $id);

		$queue = $this->queueModel->recuperaQueueAllByUser($ingresso_id);




		// Primeiro, vamos montar uma lista só dos meet_id que o usuário já reservou:
		$meetReservadosIds = array_map(function ($item) {
			return $item->meet_id;
		}, $queue);

		// Agora, filtramos os meets:
		$meetsDisponiveis = array_filter($meets, function ($meet) use ($meetReservadosIds) {
			return !in_array($meet->id, $meetReservadosIds);
		});
		$meetsDisponiveisVip = array_filter($meets_vip, function ($meet_vip) use ($meetReservadosIds) {
			return !in_array($meet_vip->id, $meetReservadosIds);
		});
		$meetsDisponiveisEpic = array_filter($meets_epic, function ($meet_epic) use ($meetReservadosIds) {
			return !in_array($meet_epic->id, $meetReservadosIds);
		});
		//1836




		if ($tipo == 'vip') {
			$data = [
				'titulo' => 'Dashboard de ' . esc($cliente->nome),
				'cliente' => $cliente,
				'meets' => $meetsDisponiveisVip,
				'day' => $day,
				'tipo' => $tipo,
				'count_queue' => $count_queue,
				'queue' => $queue
			];
			return view('Console/meet_vip', $data);
		} else if ($tipo == 'epic') {
			$data = [
				'titulo' => 'Dashboard de ' . esc($cliente->nome),
				'cliente' => $cliente,
				'meets' => $meetsDisponiveisEpic,
				'day' => $day,
				'tipo' => $tipo,
				'count_queue' => $count_queue,
				'queue' => $queue
			];
			return view('Console/meet_epic', $data);
		} else {
			$data = [
				'titulo' => 'Dashboard de ' . esc($cliente->nome),
				'cliente' => $cliente,
				'meets' => $meetsDisponiveis,
				'day' => $day,
				'tipo' => $tipo,
				'count_queue' => $count_queue,
				'queue' => $queue
			];
			return view('Console/meet', $data);
		}
	}

	public function queuecheck($meet_id, $ingresso_id)
	{
		$id = $this->usuarioLogado()->id;

		$queues = $this->queueModel->recuperaOrdem($meet_id);

		$meet = $this->meetModel->find($meet_id);

		$ordem = $queues->ordem;

		$this->queueModel
			->protect(false)
			->insert([
				'user_id' => $id,
				'meet_id' => $meet_id,
				'ingresso_id' => $ingresso_id,
				'code' => $this->queueModel->geraCodigo(),
				'status' => 'CHECKIN',
				'ordem'  => $ordem + 1,
			]);

		$this->meetModel
			->protect(false)
			->where('id', $meet_id)
			->set('quantidade', $meet->quantidade - 1)
			->update();

		return redirect()->to(site_url("console/dashboard"))->with('sucesso', "Meet & Greet reservado com sucesso!");
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
