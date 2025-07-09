<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Credencial;
use App\Entities\Check;
use App\Traits\ValidacoesTrait;

class Acessos extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $ingressoModel;
	private $pedidosModel;
	private $eventoModel;
	private $enderecoModel;
	private $credencialModel;
	private $checkModel;


	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->ingressoModel = new \App\Models\IngressoModel();
		$this->pedidosModel = new \App\Models\PedidoModel();
		$this->enderecoModel = new \App\Models\EnderecoModel();
		$this->eventoModel = new \App\Models\EventoModel();
		$this->credencialModel = new \App\Models\CredencialModel();
		$this->checkModel = new \App\Models\CheckModel();
	}

	public function index()
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
			'titulo' => 'Comprar ingressos',
			'id' => $id,

		];


		return view('Carrinho/index', $data);
	}


	public function salavip()
	{

		$event_id = 11;
		$evento = $this->eventoModel->find($event_id);

		$data = [
			'titulo' => 'Acesso sala vip',

		];


		return view('Acessos/vip', $data);
	}

	public function check()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();




		// Recupero o post da requisição
		$post = $this->request->getPost();


		$atributos = [
			'ingressos.id',
			'ingressos.codigo',
			'ingressos.nome',
			'pedidos.evento_id',
			'pedidos.status',
			'pedidos.user_id'
		];

		$ingresso = $this->ingressoModel->select($atributos)
			->withDeleted(true)
			->join('pedidos', 'pedidos.id = ingressos.pedido_id')
			->join('credenciais', 'credenciais.ingresso_id = ingressos.id')
			->where('pedidos.evento_id', $post['evento_id'])
			->where('credenciais.codigo', $post['codigo'])
			->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
			->orderBy('id', 'DESC')
			->first();



		if ($ingresso) {

			if (stripos($ingresso->nome, 'VIP') !== false) {
				$acesso = new Check($post);
				$acesso->usuario_id = $ingresso->user_id;
				$acesso->ingresso_id = $ingresso->id;
				$acesso->operador_id = $post['operador'];
				$acesso->tipo_acesso = $post['tipo'];

				if ($this->checkModel->save($acesso)) {
					session()->setFlashdata('sucesso', '<span style="font-size: 36px; padding:20px">Acesso Liberado!</span>');
					return $this->response->setJSON($retorno);
				}
			} else {
				// Se a palavra "vip" não estiver presente no campo 'nome'
				//$retorno['erro'] = '<span style="font-size: 36px; padding:20px">Acesso negado! </span><br><span style="padding:20px">O ingresso não possui privilégios VIP</span>';
				session()->setFlashdata('erro', '<span style="font-size: 36px; padding:20px">Acesso negado! </span><br><span style="padding:20px">O ingresso não possui privilégios VIP</span>');

				return $this->response->setJSON($retorno);
			}
		} else {
			session()->setFlashdata('erro', '<span style="font-size: 36px; padding:20px">Acesso negado! </span><br><span style="padding:20px">O ingresso não foi localizado</span>');
			//$retorno['erro'] = '<span style="font-size: 36px; padding:20px">Acesso negado! </span><br><span style="padding:20px">O ingresso não foi localizado</span>';

			// Retorno para o ajax request
			return $this->response->setJSON($retorno);
		}



		// Retornamos os erros de validação
		$retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
		$retorno['erros_model'] = $this->enderecoModel->errors();

		// Retorno para o ajax request
		return $this->response->setJSON($retorno);
	}

	public function girafinhas()
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
			'titulo' => 'Comprar ingressos',
			'id' => $id,

		];


		return view('Carrinho/girafinhas', $data);
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
