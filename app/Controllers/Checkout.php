<?php

namespace App\Controllers;

use Exception;

use App\Services\GerencianetService;
use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\CartaoCredito;
use App\Entities\Pedido;
use App\Entities\Transaction;
use App\Entities\Endereco;
use App\Entities\Evento;
use App\Traits\ValidacoesTrait;
use App\Services\PagarMeService;


$session = session();

class Checkout extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $cartaoCreditoModel;
	private $pedidoModel;
	private $ingressoModel;
	private $grupoUsuarioModel;
	private $transactionModel;
	private $enderecoModel;
	private $gerencianetService;
	private $asaasService;
	private $notifyService;
	private $pagarmeService;
	private $eventoModel;
	private $ticketModel;



	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->cartaoCreditoModel = new \App\Models\CartaoCreditoModel();
		$this->pedidoModel = new \App\Models\PedidoModel();
		$this->ingressoModel = new \App\Models\IngressoModel();
		$this->grupoUsuarioModel = new \App\Models\GrupoUsuarioModel();
		$this->transactionModel = new \App\Models\TransactionModel();
		$this->enderecoModel = new \App\Models\EnderecoModel();
		//$this->gerencianetService = new \App\Services\GerencianetService();
		$this->asaasService = new \App\Services\AsaasService();
		$this->notifyService = new \App\Services\NotifyService();
		$this->pagarmeService = new \App\Services\PagarmeService();
		$this->eventoModel = new \App\Models\EventoModel();
		$this->ticketModel = new \App\Models\TicketModel();

	}

	public function whatsapp()
	{
		$number = '5551982495665';
		$mensagem = "🔥Mensagem automatica enviada pelo sistema \n*Fechou!* \nhttps://dreamfest.com.br";
		$wpp = $this->notifyService->whatsapp($number, $mensagem);
		dd($wpp);
	}


	public function pagarme()
	{

		$orderData = [
			'items' => [
				[
					'amount' => 1000, // valor em centavos
					'description' => 'Produto Exemplo',
					'quantity' => 1,
					'code' => 'product_code',
				]
			],
			'customer' => [
				'name' => 'Nome do Cliente',
				'email' => 'email@cliente.com',
				'document' => '12345678909',
				'type' => 'individual',
				'phones' => [
					'mobile_phone' => [
						'country_code' => '55',
						'area_code' => '11',
						'number' => '999999999'
					]
				],
				'birthday' => '1985-01-01'
			],

			'shipping' => [
				'address' => [
					'country' => 'BR',
					'state' => 'SP',
					'city' => 'São Paulo',
					'line_1' => 'Rua Exemplo, 123, Bairro Exemplo',
					'zip_code' => '01001000'
				],
				'amount' => 1000,
				'description' => 'Nome de Entrega'
			],
			'payments' => [
				[
					'payment_method' => 'credit_card',
					'credit_card' => [
						'installments' => 1,
						'card' => [
							'number' => '4111111111111111',
							'holder_name' => 'Nome do Portador',
							'exp_month' => '12',
							'exp_year' => '25',
							'cvv' => '123',
							'billing_address' => [
								'country' => 'BR',
								'state' => 'SP',
								'city' => 'São Paulo',
								'line_1' => 'Rua Exemplo, 123, Bairro Exemplo',
								'zip_code' => '01001000'
							],
						]
					]
				]
			],
			'initiator_transaction_key' => uniqid() // Adicionando um iniciador de transação único
		];

		$response = $this->pagarmeService->createTransaction($orderData);

		return $this->response->setJSON($response);
	}

	//novo processador de pagamentos usando pagar.me
	public function finalizarcartaoOLD2()
	{

		$retorno['token'] = csrf_hash();

		$post = $this->request->getPost();

		$email = $post['email'];

		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id',
			'clientes.customer_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {
			$user_id = $cliente->usuario_id;
		} else {

			$cliente = new Cliente($post);

			if ($this->clienteModel->save($cliente)) {
				$newuser = $this->criaUsuarioParaCliente($cliente);
				$this->enviaEmailCriacaoEmailAcesso($cliente, $newuser);

				$cliente_id = $this->clienteModel->getInsertID();

				$atributos = [
					'clientes.id',
					'clientes.nome',
					'clientes.cpf',
					'clientes.email',
					'clientes.telefone',
					'clientes.deleted_at',
					'clientes.usuario_id',
					'clientes.customer_id'
				];

				$cliente = $this->clienteModel->select($atributos)
					->withDeleted(true)
					->where('clientes.id', $cliente_id)
					->orderBy('id', 'DESC')
					->first();

				$user_id = $cliente->usuario_id;
			}
		}

		if ($post['frete'] == 'casa') {
			$frete = 1;
		} else {
			$frete = 0;
		}

		$data = [
			'evento_id' => 17,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' => $post['valor_total'],
			'convite' => $post['convite'],
			'frete' => $frete,
			'forma_pagamento' => 'CREDIT_CARD',

		];

		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();

		foreach ($_SESSION['carrinho'] as $key => $value) {

			for ($i = 0; $i < $value['quantidade']; $i++) {
				$nome = $value['nome'];
				$quantidade = 1;
				$valorUnitario = $value['preco'];
				$valor = $value['preco'];
				$tipo = $value['tipo'];
				$ticket_id = $value['ticket_id'];
				$ingressos = [
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor_unitario' => $valorUnitario,
					'valor' => $valor,
					'tipo' => $tipo,
					'ticket_id' => $ticket_id,
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				];

				$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);
				$ingresso_id = $this->ingressoModel->getInsertID();
			}
		}

		$customer_id = '';
		$customer = [];
		$credit_card_token = '';

		if (empty($cliente->customer_id)) {
			$cobrar = [
				'nome' => $post['nome'],
				'cpf' => $post['cpf'],
				'email' => $post['email'],
				'telefone' => preg_replace('/[^0-9]/', '', $_POST['telefone']),
				'cep' => preg_replace('/[^0-9]/', '', $_POST['cep']),
				'numero' => $_POST['numero'],
			];

			$customer = $this->asaasService->customers($cobrar);

			$customer_id = $customer['id'];
		} else {
			$customer_id = $cliente->customer_id;
		}

		$this->clienteModel
			->protect(false)
			->where(
				'id',
				$cliente->id
			)
			->set('customer_id', $customer_id)
			->update();

		$juros = 0.034;
		$installmentCount = $post['installmentCount'];
		$valorFormatado = number_format((float)$post['valor_total'], 2, '.', '');

		if ($installmentCount <= 1) {
			$installmentValue = $valorFormatado * 100;
		} else {
			//$installmentValue = ($post['valor_total'] + ($post['valor_total'] * $juros * $installmentCount)) / $installmentCount;
			$partial = ($valorFormatado + ($valorFormatado * $juros * $installmentCount));
			$installmentValue = number_format((float)$partial, 2, '.', '');
		}
		$telefone = preg_replace('/[^0-9]/', '', $_POST['telefone']);
		preg_match('/^(\d{2})(\d{8,9})$/', $telefone, $matches);

		$evento = $this->eventoModel->select()->where('id', 17)->first();
		$integerValuePartial = preg_replace('/\D/', '', $installmentValue);
		$integerValue = (int)$integerValuePartial;
		$pay = [
			'items' => [
				[
					'amount' => $integerValue,
					'description' => 'Ingresso(s) ' . $evento->nome,
					'quantity' => 1,
					'code' => 'product_code',
				]
			],
			'customer' => [
				'name' => $post['nome'],
				'email' => $post['email'],
				'document' => preg_replace('/\D/', '', $post['cpf']),
				'type' => 'individual',
				'phones' => [
					'mobile_phone' => [
						'country_code' => '55',
						'area_code' => $matches[1],
						'number' => $matches[2]
					]
				],
			],


			'payments' => [
				[
					'payment_method' => 'credit_card',
					'credit_card' => [
						'installments' => $post['installmentCount'],
						'card' => [
							'number' => $post['numero_cartao'],
							'holder_name' => $post['holderName'],
							'exp_month' => $post['mes_vencimento'],
							'exp_year' => $post['ano_vencimento'],
							'cvv' => $post['codigo_seguranca'],
							'billing_address' => [
								'country' => 'BR',
								'state' => $_POST['estado'],
								'city' => $_POST['cidade'],
								'line_1' => $_POST['endereco'],
								'zip_code' => preg_replace('/[^0-9]/', '', $_POST['cep'])
							],
						]
					]
				]
			],
			'options' => [
				'antifraud_enabled' => false
			],
			'initiator_transaction_key' => uniqid() // Adicionando um iniciador de transação único
		];

		$payment = $this->pagarmeService->createTransaction($pay);

		if (!isset($payment['errors'][0])) {
			if ($payment['status'] == 'paid') {
				$payment['status'] = 'CONFIRMED';
			}
			$this->pedidoModel
				->skipValidation(true)
				->protect(false)
				->where(
					'id',
					$pedido_id
				)
				->set('charge_id', $payment['id'])
				->set('status', $payment['status'])
				->update();


			$tranaction = [
				'pedido_id' => $pedido_id,
				'charge_id' => $payment['id'],
				'installment_value' => $post['valor_total'],
				'installments' => $post['installmentCount'],
				'payment' => 'CREDIT_CARD',
			];

			$this->transactionModel->skipValidation(true)->protect(false)->insert($tranaction);
			$endereco = [
				'pedido_id' => $pedido_id,
				'endereco' => $_POST['endereco'],
				'numero' => $_POST['numero'],
				'bairro' => $_POST['bairro'],
				'cep' => preg_replace('/[^0-9]/', '', $_POST['cep']),
				'cidade' => $_POST['cidade'],
				'estado' => $_POST['estado'],
			];

			$this->enderecoModel->skipValidation(true)->protect(false)->insert($endereco);
			$this->enviaEmailPedidoCartao($cliente);

			//$retorno['id'] = $pedido_id;


			if ($payment['status'] == 'paid' || $payment['status'] == 'CONFIRMED' || $payment['status'] == 'RECEIVED') {
				unset($_SESSION['carrinho']);
				return redirect()->to(site_url("checkout/obrigado/"));
			} else {
				return redirect()->to(site_url("checkout/cartao/"))->with('erro', "Erro ao processar pagamento!");
			}
		} else {
			return redirect()->to(site_url("checkout/cartao/"))->with('erro', "Erro ao processar pagamento!");
		}
	}

	public function pix()
	{



		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}

		// Calculate total and discount from cart
		$total = 0;
		$valor_desconto = 0;
		
		if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
			foreach ($_SESSION['carrinho'] as $item) {
				if ($item['quantidade'] > 0) {
					$total += ($item['quantidade'] * $item['unitario']) + ($item['quantidade'] * $item['taxa']);
				}
			}
		}

		$data = [
			'titulo' => 'Comprar ingressos',
			'id' => $id,
			'total' => $total,
			'valor_desconto' => $valor_desconto,
		];


		return view('Checkout/pix', $data);
	}

	public function confirmadm()
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


		return view('Checkout/confirmadm', $data);
	}

	public function cartao()
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


		return view('Checkout/cartao_step_1', $data);
	}

	public function cartao_step_2()
	{




		// Recupero o post da requisição
		$post = $this->request->getPost();

		$email = $post['email'];
		$data_cli = [];


		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id',
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {
			$data_cli = [
				'user_id' => $cliente->usuario_id,
				'credit_card_token' => $cliente->credit_card_token,
				'nome' => $cliente->nome,
				'email' => $cliente->email,
				'cpf' => $cliente->cpf,
				'telefone' => $cliente->telefone
			];
		} else {
			$data_cli = [
				'nome' => null,
				'email' => $email,
				'cpf' => null,
				'telefone' => null
			];
		}




		$data = [
			'titulo' => 'Comprar ingressos',
			'data_cli' => $data_cli
		];


		return view('Checkout/cartao', $data);
	}


	public function obrigado()
	{
		$event_id = 17;

		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}
		$items = $this->ticketModel->recuperaAdicionaisPorEvento($event_id);

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
				'dia' => $item->dia,
				'lote' => $item->lote,
				'categoria' => $item->categoria,
				'data_lote' => $item->data_lote,
				'estoque' => $item->estoque
			);
		}


		$data = [
			'titulo' => 'Comprar ingressos',
			'id' => $id,
			'items' => $ingressos
		];


		return view('Checkout/obrigado', $data);
	}

	public function orderbump($id)
	{


		$data = [
			'titulo' => 'Parabéns',
			'pedido_id' => $id

		];


		return view('Checkout/obrigado', $data);
	}

	public function loja()
	{


		$data = [
			'titulo' => 'Loja Oficial',

		];


		return view('Checkout/loja', $data);
	}

	public function finalizarm()
	{

		$post = $this->request->getPost();

		var_dump($post);
	}

	public function finalizarc()
	{

		// Recupero o post da requisição
		$post = $this->request->getPost();


		$email = $post['email'];

		$total = trim($post['valor_total']);
		$total = str_replace(".", "", $total);


		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {
			$user_id = $cliente->usuario_id;
		} else {
			//criqar usuario e pegar o ID
			//$user_id = $this->usuarioModel->getInsertID();
			$cliente = new Cliente($post);

			if ($this->clienteModel->save($cliente)) {
				// Cria usuario do cliente
				$this->criaUsuarioParaCliente($cliente);

				// Envia dados de acesso ao clente
				$this->enviaEmailCriacaoEmailAcesso($cliente);

				$cliente_id = $this->clienteModel->getInsertID();

				$atributos = [
					'clientes.id',
					'clientes.nome',
					'clientes.cpf',
					'clientes.email',
					'clientes.telefone',
					'clientes.deleted_at',
					'clientes.usuario_id'
				];

				$cliente = $this->clienteModel->select($atributos)
					->withDeleted(true)
					->where('clientes.id', $cliente_id)
					->orderBy('id', 'DESC')
					->first();

				$user_id = $cliente->usuario_id;
			}
		}
		//dd($user_id);

		$data = [
			'evento_id' => 17,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' => $total / 100,
			'convite' => $post['convite'],
			'forma_pagamento' => 'cartão',

		];
		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();

		foreach ($_SESSION['carrinho'] as $key => $value) {

			for ($i = 0; $i < $value['quantidade']; $i++) {

				$nome = $value['nome'];
				$quantidade = 1;
				$valorUnitario = $value['preco'];
				$valor = $value['preco'];
				$tipo = $value['tipo'];

				$ingressos = [
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor_unitario' => $valorUnitario,
					'valor' => $valor,
					'tipo' => $tipo,
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				];

				$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);
				$ingresso_id = $this->ingressoModel->getInsertID();
			}
		}




		//dd($post);
		$paymentToken = $_POST['payment_token'];

		$cobrar = [
			'nome' => $post['nome'],
			'cpf' => $post['cpf'],
			'email' => $post['email'],
			'telefone' => preg_replace('/[^0-9]/', '', $_POST['telefone']),
			'nascimento' => date('Y-m-d', strtotime($_POST['nascimento'])),
			'item' => [
				'name' => 'Ingresso Dreamfest',
				'amount' => 1,
				'value' => (int)$total
			],
			'rua' => $_POST['endereco'],
			'numero' => $_POST['numero'],
			'bairro' => $_POST['bairro'],
			'cep' => preg_replace('/[^0-9]/', '', $_POST['cep']),
			'cidade' => $_POST['cidade'],
			'estado' => $_POST['estado'],
			'parcelas' => (int) $_POST['parcelas'],
			'payment_token' => $paymentToken


		];
		$cartao = $this->gerencianetService->criaCartao($cobrar);

		$installment_value = $cartao['data']['installment_value'];
		$installments = $cartao['data']['installments'];
		$charge_id = $cartao['data']['charge_id'];
		$status = $cartao['data']['status'];
		$payment = $cartao['data']['payment'];


		if (isset($charge_id)) {
			$this->pedidoModel
				->protect(false)
				->where(
					'id',
					$pedido_id
				)
				->set('charge_id', $charge_id)
				->set('status', $status)
				->update();
		}

		if (isset($charge_id)) {
			$tranaction = [
				'pedido_id' => $pedido_id,
				'charge_id' => $charge_id,
				'installment_value' => $installment_value,
				'installments' => $installments,
				'payment' => $payment,
			];

			$this->transactionModel->skipValidation(true)->protect(false)->insert($tranaction);
		}


		if (isset($charge_id)) {
			$endereco = [
				'pedido_id' => $pedido_id,
				'endereco' => $_POST['endereco'],
				'numero' => $_POST['numero'],
				'bairro' => $_POST['bairro'],
				'cep' => preg_replace('/[^0-9]/', '', $_POST['cep']),
				'cidade' => $_POST['cidade'],
				'estado' => $_POST['estado'],
			];

			$this->enderecoModel->skipValidation(true)->protect(false)->insert($endereco);
		}

		$this->enviaEmailPedidoCartao($cliente);


		return redirect()->to('checkout/obrigado');
	}

	public function finalizar(int $id = null)
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();


		// Recupero o post da requisição
		$post = $this->request->getPost();

		$email = $post['email'];



		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {
			$user_id = $cliente->usuario_id;
		} else {
			//criqar usuario e pegar o ID
			//$user_id = $this->usuarioModel->getInsertID();
			$cliente = new Cliente($post);
			if ($this->clienteModel->save($cliente)) {
				// Cria usuario do cliente
				$this->criaUsuarioParaCliente($cliente);

				// Envia dados de acesso ao clente
				$this->enviaEmailCriacaoEmailAcesso($cliente);

				$cliente_id = $this->clienteModel->getInsertID();

				$atributos = [
					'clientes.id',
					'clientes.nome',
					'clientes.cpf',
					'clientes.email',
					'clientes.telefone',
					'clientes.deleted_at',
					'clientes.usuario_id'
				];

				$cliente = $this->clienteModel->select($atributos)
					->withDeleted(true)
					->where('clientes.id', $cliente_id)
					->orderBy('id', 'DESC')
					->first();

				$user_id = $cliente->usuario_id;
			}
		}


		$data = [
			'evento_id' => 17,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' => $post['total'],
			'convite' => $post['convite'],
			'forma_pagamento' => 'boleto',

		];
		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();

		foreach ($_SESSION['carrinho'] as $key => $value) {

			for ($i = 0; $i < $value['quantidade']; $i++) {

				$nome = $value['nome'];
				$quantidade = 1;
				$valorUnitario = $value['preco'];
				$valor = $value['preco'];
				$tipo = $value['tipo'];

				$ingressos = [
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor_unitario' => $valorUnitario,
					'valor' => $valor,
					'tipo' => $tipo,
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				];

				$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);
				$ingresso_id = $this->ingressoModel->getInsertID();
			}
		}
		$total = trim($post['total']);
		$total = str_replace(".", "", $total);

		$cobrar = [
			'nome' => $post['nome'],
			'cpf' => $post['cpf'],
			'email' => $post['email'],
			'expiration' => date('Y-m-d', strtotime('+5 days')),
			'item' => [
				'name' => 'Ingresso Dreamfest',
				'amount' => 1,
				'value' => (int)$total
			],

		];

		$boleto = $this->gerencianetService->criaBoleto($cobrar);
		$charge_id = $boleto['data']['charge_id'];
		$status = $boleto['data']['status'];
		$barcode = $boleto['data']['barcode'];
		$link_boleto = $boleto['data']['link'];
		$billet_link = $boleto['data']['billet_link'];
		$pdf = $boleto['data']['pdf']['charge'];
		$qrcode = $boleto['data']['pix']['qrcode'];
		$qrcode_image = $boleto['data']['pix']['qrcode_image'];
		$expire_at = $boleto['data']['expire_at'];
		$payment = $boleto['data']['payment'];




		if (isset($charge_id)) {
			$this->pedidoModel
				->protect(false)
				->where('id', $pedido_id)
				->set('charge_id', $charge_id)
				->set('status', $status)
				->update();
		}

		if (isset($charge_id)) {
			$tranaction = [
				'pedido_id' => $pedido_id,
				'charge_id' => $charge_id,
				'expire_at' => $expire_at,
				'barcode' => $barcode,
				'pdf' => $pdf,
				'qrcode' => $qrcode,
				'qrcode_image' => $qrcode_image,
				'link' => $link_boleto,
				'billet_link' => $billet_link,
				'payment' => $payment,
			];

			$this->transactionModel->skipValidation(true)->protect(false)->insert($tranaction);
		}

		$cliente->link = $link_boleto;

		$this->enviaEmailPedido($cliente);

		$retorno['id'] = (int)$charge_id;

		// Retorno para o ajax request
		return $this->response->setJSON($retorno);
	}

	public function finalizarcartaoOLD()
	{

		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		$post = $this->request->getPost();

		$email = $post['email'];


		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id',
			'clientes.customer_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {
			$user_id = $cliente->usuario_id;
			/*
			if ($cliente->telefone == null || $cliente->telefone == '') {
				$this->clienteModel
					->protect(false)
					->where(
						'usuario_id',
						$user_id
					)
					->set('telefone', $post['telefone'])
					->update();
			}

			if ($cliente->nome == null || $cliente->nome == '') {
				$this->clienteModel
					->protect(false)
					->where(
						'usuario_id',
						$user_id
					)
					->set('nome', $post['nome'])
					->update();
			} */
		} else {
			//criqar usuario e pegar o ID
			//$user_id = $this->usuarioModel->getInsertID();
			$cliente = new Cliente($post);

			if ($this->clienteModel->save($cliente)) {
				// Cria usuario do cliente
				$newuser = $this->criaUsuarioParaCliente($cliente);

				// Envia dados de acesso ao clente
				$this->enviaEmailCriacaoEmailAcesso($cliente, $newuser);
				/*
				if ($cliente->telefone) {
					$mensagem = "Saudações " . $cliente->nome . "\n\nSua conta no Mundo Dream foi criada com sucesso e você já pode adquirir seus ingressos para o Dreamfest e desfrutar de tudo o que temos a te oferecer! \n\nSeja muito bem vindo(a), seus dados de acesso são: \n*link:* " . esc(site_url("/")) . "\n*E-mail de acesso:* " . $cliente->email . "\n*Senha:*  " . $newuser . "\n\nAtenciosamente, \nDepartamento de Relacionamento";

					$telefone = str_replace([' ', '-', '(', ')'], '', $cliente->telefone);
					if (strlen($telefone) == 10 || strlen($telefone) == 11) {
						// Verificar se o número começa com 9 (para números de celular no Brasil)
						if (
							strlen($telefone) == 11 && substr($telefone, 2, 1) != '9'
						) {
							return false;
						}
						$api = $this->notifyService->notificawpp($cliente, $mensagem);
					}
				} */

				$cliente_id = $this->clienteModel->getInsertID();

				$atributos = [
					'clientes.id',
					'clientes.nome',
					'clientes.cpf',
					'clientes.email',
					'clientes.telefone',
					'clientes.deleted_at',
					'clientes.usuario_id',
					'clientes.customer_id'
				];

				$cliente = $this->clienteModel->select($atributos)
					->withDeleted(true)
					->where('clientes.id', $cliente_id)
					->orderBy('id', 'DESC')
					->first();

				$user_id = $cliente->usuario_id;
			}
		}
		//dd($user_id);

		if ($post['frete'] == 'casa') {
			$frete = 1;
		} else {
			$frete = 0;
		}

		$data = [
			'evento_id' => 17,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' =>  $post['valor_total'],
			'convite' => $post['convite'],
			'frete' => $frete,
			'forma_pagamento' => 'CREDIT_CARD',

		];
		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();

		foreach ($_SESSION['carrinho'] as $key => $value) {

			for ($i = 0; $i < $value['quantidade']; $i++) {

				$nome = $value['nome'];
				$quantidade = 1;
				$valorUnitario = $value['preco'];
				$valor = $value['preco'];
				$tipo = $value['tipo'];
				$ticket_id = $value['ticket_id'];

				$ingressos = [
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor_unitario' => $valorUnitario,
					'valor' => $valor,
					'tipo' => $tipo,
					'ticket_id' => $ticket_id,
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				];

				$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);
				$ingresso_id = $this->ingressoModel->getInsertID();
			}
		}



		$customer_id = '';
		$customer = [];
		$credit_card_token = '';
		//dd($post);
		//$paymentToken = $_POST['payment_token'];
		if (empty($cliente->customer_id)) {
			$cobrar = [
				'nome' => $post['nome'],
				'cpf' => $post['cpf'],
				'email' => $post['email'],
				'telefone' => preg_replace('/[^0-9]/', '', $_POST['telefone']),
				'cep' => preg_replace('/[^0-9]/', '', $_POST['cep']),
				'numero' => $_POST['numero'],


			];

			$customer = $this->asaasService->customers($cobrar);

			$customer_id = $customer['id'];
		} else {
			$customer_id = $cliente->customer_id;
		}

		$this->clienteModel
			->protect(false)
			->where(
				'id',
				$cliente->id
			)
			->set('customer_id', $customer_id)
			->update();



		$juros = 0.034;
		$installmentCount = $post['installmentCount'];
		if ($installmentCount <= 1) {
			$installmentValue = $post['valor_total'];
		} else {
			$installmentValue = ($post['valor_total'] + ($post['valor_total'] * $juros * $installmentCount)) / $installmentCount;
		}

		//dd($post['valor_total']);
		//$cartao = $this->gerencianetService->criaCartao($cobrar);
		$pay = [
			'customer_id' => $customer_id,
			'installmentCount' => $post['installmentCount'],
			'installmentValue' => (float)$installmentValue,
			'description' => 'Ingressos Dreamfest 23',
			'postalCode' => preg_replace('/[^0-9]/', '', $_POST['cep']),
			'observations' => 'Api ASAAS',
			'holderName' => $post['holderName'],
			'number' => $post['numero_cartao'],
			'expiryMonth' => $post['mes_vencimento'],
			'expiryYear' => $post['ano_vencimento'],
			'ccv' => $post['codigo_seguranca'],
			'nome' => $post['nome'],
			'email' => $post['email'],
			'cpf' => $post['cpf'],
			'cep' => $post['cep'],
			'numero' => $post['numero'],
			'telefone' => preg_replace('/[^0-9]/', '', $_POST['telefone']),
			//'creditCardToken' => $credit_card_token

		];

		$payment = $this->asaasService->payments($pay);


		if (!isset($payment['errors'][0])) {

			$this->pedidoModel
				->skipValidation(true)
				->protect(false)
				->where(
					'id',
					$pedido_id
				)
				->set('charge_id', $payment['id'])
				->set('status', $payment['status'])
				->update();


			$tranaction = [
				'pedido_id' => $pedido_id,
				'charge_id' => $payment['id'],
				'installment_value' => $post['valor_total'],
				'installments' => $post['installmentCount'],
				'payment' => $payment['billingType'],
			];

			$this->transactionModel->skipValidation(true)->protect(false)->insert($tranaction);

			$endereco = [
				'pedido_id' => $pedido_id,
				'endereco' => $_POST['endereco'],
				'numero' => $_POST['numero'],
				'bairro' => $_POST['bairro'],
				'cep' => preg_replace('/[^0-9]/', '', $_POST['cep']),
				'cidade' => $_POST['cidade'],
				'estado' => $_POST['estado'],
			];

			$this->enderecoModel->skipValidation(true)->protect(false)->insert($endereco);

			$this->enviaEmailPedidoCartao($cliente);
			/*
			$atributos = [
				'clientes.id',
				'clientes.nome',
				'clientes.cpf',
				'clientes.email',
				'clientes.telefone',
				'clientes.deleted_at',
				'clientes.usuario_id',
				'clientes.customer_id'
			];

			$cliente = $this->clienteModel->select($atributos)
				->withDeleted(true)
				->where('clientes.email', $email)
				->orderBy('id', 'DESC')
				->first();

			if ($cliente->telefone) {
				$mensagem = "Saudações " . $cliente->nome . "\n\nSeu pedido foi realizado com sucesso! \nEstamos muito felizes em contar com você no evento geek mais mágico do sul do Brasil! \n\n*Para acessar seus ingressos, acesse o link abaixo usando seu email " . $cliente->email . " e senha!* \n" . esc(site_url("/")) . "\n\nDetalhes do evento: \n*Dreamfest 24 - Mega Festival Geek* \n8 e 9 de junho das 10h às 19h \nCentro de eventos da PUCRS - Porto Alegre RS \n\nGeek que é geek não 😴 no ponto!";

				$telefone = str_replace([' ', '-', '(', ')'], '', $cliente->telefone);
				if (strlen($telefone) == 10 || strlen($telefone) == 11) {
					// Verificar se o número começa com 9 (para números de celular no Brasil)
					if (strlen($telefone) == 11 && substr($telefone, 2, 1) != '9') {
						return false;
					}
					$api = $this->notifyService->notificawpp($cliente, $mensagem);
				}
			} */

			$retorno['id'] = $payment['id'];


			if ($payment['status'] == 'CONFIRMED' || $payment['status'] == 'RECEIVED') {
				unset($_SESSION['carrinho']);
				return $this->response->setJSON($retorno);
			} else {
				unset($_SESSION['carrinho']);
				return redirect()->to('checkout/obrigado');
			}
		} else {
			$retorno['erro'] = 'Falha ao processar compra';
			return $this->response->setJSON($retorno);
		}
	}


	public function finalizarpixOLD()
	{

		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		$post = $this->request->getPost();

		$email = $post['email'];

		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id',
			'clientes.customer_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {

			$user_id = $cliente->usuario_id;
			/*
			if ($cliente->telefone == null || $cliente->telefone == '') {
				$this->clienteModel
					->protect(false)
					->where(
						'usuario_id',
						$user_id
					)
					->set('telefone', $post['telefone'])
					->update();
			}

			if ($cliente->nome == null || $cliente->nome == '') {
				$this->clienteModel
					->protect(false)
					->where(
						'usuario_id',
						$user_id
					)
					->set('nome', $post['nome'])
					->update();
			} */
		} else {
			//criqar usuario e pegar o ID
			//$user_id = $this->usuarioModel->getInsertID();
			$cliente = new Cliente($post);

			if ($this->clienteModel->save($cliente)) {
				// Cria usuario do cliente
				$newuser = $this->criaUsuarioParaCliente($cliente);



				// Envia dados de acesso ao clente
				$this->enviaEmailCriacaoEmailAcesso($cliente, $newuser);
				/*

				if ($cliente->telefone) {
					$mensagem = "Saudações " . $cliente->nome . "\n\nSua conta no Mundo Dream foi criada com sucesso e você já pode adquirir seus ingressos para o Dreamfest e desfrutar de tudo o que temos a te oferecer! \n\nSeja muito bem vindo(a), seus dados de acesso são: \n*link:* " . esc(site_url("/")) . "\n*E-mail de acesso:* " . $cliente->email . "\n*Senha:*  " . $newuser . "\n\nAtenciosamente, \nDepartamento de Relacionamento";

					$telefone = str_replace([' ', '-', '(', ')'], '', $cliente->telefone);
					if (strlen($telefone) == 10 || strlen($telefone) == 11) {
						// Verificar se o número começa com 9 (para números de celular no Brasil)
						if (
							strlen($telefone) == 11 && substr($telefone, 2, 1) != '9'
						) {
							return false;
						}
						$api = $this->notifyService->notificawpp($cliente, $mensagem);
					}
				}
				*/

				$cliente_id = $this->clienteModel->getInsertID();

				$atributos = [
					'clientes.id',
					'clientes.nome',
					'clientes.cpf',
					'clientes.email',
					'clientes.telefone',
					'clientes.deleted_at',
					'clientes.usuario_id',
					'clientes.customer_id'
				];

				$cliente = $this->clienteModel->select($atributos)
					->withDeleted(true)
					->where('clientes.id', $cliente_id)
					->orderBy('id', 'DESC')
					->first();



				$user_id = $cliente->usuario_id;
			}
		}
		if ($post['frete'] == 'casa') {
			$frete = 1;
		} else {
			$frete = 0;
		}



		$data = [
			'evento_id' => 17,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' =>  $post['valor_total'] / 100,
			'frete' => $frete,
			'convite' => $post['convite'],
			'forma_pagamento' => 'PIX',

		];
		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();

		foreach ($_SESSION['carrinho'] as $key => $value) {

			for ($i = 0; $i < $value['quantidade']; $i++) {

				$nome = $value['nome'];
				$quantidade = 1;
				$valorUnitario = $value['preco'];
				$valor = $value['preco'];
				$tipo = $value['tipo'];
				$ticket_id = $value['ticket_id'];

				$ingressos = [
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor_unitario' => $valorUnitario,
					'valor' => $valor,
					'tipo' => $tipo,
					'ticket_id' => $ticket_id,
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				];

				$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);
				$ingresso_id = $this->ingressoModel->getInsertID();
			}
		}



		$customer_id = '';
		$customer = [];
		$credit_card_token = '';
		//dd($post);
		//$paymentToken = $_POST['payment_token'];
		if (empty($cliente->customer_id)) {
			$cobrar = [
				'nome' => $post['nome'],
				'cpf' => $post['cpf'],
				'email' => $post['email'],
				'telefone' => preg_replace('/[^0-9]/', '', $_POST['telefone']),
				'cep' => '',
				'numero' => '',


			];

			$customer = $this->asaasService->customers($cobrar);


			$customer_id = $customer['id'];
		} else {
			$customer_id = $cliente->customer_id;
		}

		$this->clienteModel
			->protect(false)
			->where(
				'id',
				$cliente->id
			)
			->set('customer_id', $customer_id)
			->update();


		//$cartao = $this->gerencianetService->criaCartao($cobrar);
		$pay = [
			'customer_id' => $customer_id,
			'value' => (float)$post['valor_total'],
			'description' => 'Ingressos Dreamfest 25',
			'externalReference' => 'Api ASAAS',

		];

		$payment = $this->asaasService->paymentPix($pay);


		if (!isset($payment['errors'][0])) {

			$this->pedidoModel
				->skipValidation(true)
				->protect(false)
				->where(
					'id',
					$pedido_id
				)
				->set('charge_id', $payment['id'])
				->set('status', $payment['status'])
				->update();

			$payment_id = $payment['id'];

			$transaction = $this->asaasService->obtemQrCode($payment_id);



			$montatranaction = [
				'pedido_id' => $pedido_id,
				'charge_id' => $payment['id'],
				'installment_value' => $payment['value'],
				'expire_at' => date('Y-m-d', strtotime('+1 days')),
				'payment' => $payment['billingType'],
				'qrcode' => $transaction['payload'],
				'qrcode_image' => $transaction['encodedImage'],
				'link' => $payment['invoiceUrl'],
			];




			$this->transactionModel->skipValidation(true)->protect(false)->insert($montatranaction);

			$montaemail = [
				'nome' => $cliente->nome,
				'email' => $cliente->email,
				'url' => site_url("checkout/qrcode/" . $payment['id']),
				'qrcode_image' => $transaction['encodedImage'],
				'copiaecola' => $transaction['payload'],
				'expire_at' => strtotime($transaction['expirationDate']),
				'valor' => $payment['value']
			];



			$this->enviaEmailPedido((object)$montaemail);

			/*
			$atributos = [
				'clientes.id',
				'clientes.nome',
				'clientes.cpf',
				'clientes.email',
				'clientes.telefone',
				'clientes.deleted_at',
				'clientes.usuario_id',
				'clientes.customer_id'
			];

			$cliente = $this->clienteModel->select($atributos)
				->withDeleted(true)
				->where('clientes.email', $email)
				->orderBy('id', 'DESC')
				->first();


			if ($cliente->telefone) {
				$mensagem = "Saudações " . $cliente->nome . "\n\nSeu pedido foi realizado com sucesso! \nEstamos muito felizes em contar com você no evento geek mais mágico do sul do Brasil! \n\nAbaixo, segue link para pagamento: \n" . esc(site_url("checkout/qrcode/" . $payment['id'])) . "\n*Resumo do seu pedido:* \nTotal a pagar: R$ " . $payment['value'] . "\nVencimento: " . date('d/m/Y', strtotime($transaction['expirationDate'])) . "\nPix copia e cola: " . $transaction['payload'] . "\n\n*Para acessar seus ingressos, acesse o link abaixo usando seu email " . $cliente->email . " e senha!* \n" . esc(site_url("/")) . "\n\nDetalhes do evento: \n*Dreamfest 24 - Mega Festival Geek* \n8 e 9 de junho das 10h às 19h \nCentro de eventos da PUCRS - Porto Alegre RS \n\nGeek que é geek não 😴 no ponto!";

				$telefone = str_replace([' ', '-', '(', ')'], '', $cliente->telefone);
				if (strlen($telefone) == 10 || strlen($telefone) == 11) {
					// Verificar se o número começa com 9 (para números de celular no Brasil)
					if (strlen($telefone) == 11 && substr($telefone, 2, 1) != '9') {
						return false;
					}
					$api = $this->notifyService->notificawpp($cliente, $mensagem);
				}
			}

			*/

			$retorno['id'] = $payment['id'];

			unset($_SESSION['carrinho']);

			return $this->response->setJSON($retorno);
		} else {
			$retorno['erro'] = 'Falha ao processar compra';
			return $this->response->setJSON($retorno);
		}
	}

	public function finalizarcartao()
	{
		helper('text');
		$retorno['token'] = csrf_hash();

		try {
			$post = $this->request->getPost();

			if (!isset($post['email'], $post['valor_total'], $_SESSION['carrinho'])) {
				return redirect()->to(site_url("checkout/cartao/"))->with('erro', "Dados incompletos");
			}

			$cliente = $this->buscaOuCriaCliente($post);
			$user_id = $cliente->usuario_id;

			$event_id = $this->request->getPost('event_id');
			$pedido_id = $this->criaPedidoCartao($post, $user_id, $event_id);
			$this->registraIngressos($pedido_id, $user_id);

			$customer_id = $this->obtemOuCriaCustomerIdAsaas($cliente, $post);
			$this->clienteModel->protect(false)->update($cliente->id, ['customer_id' => $customer_id]);

			$juros = 0.034;
			$installmentCount = $post['installmentCount'];
			$valorFormatado = number_format((float) $post['valor_total'], 2, '.', '');

			if ($installmentCount <= 1) {
				$installmentValue = $valorFormatado * 100;
			} else {
				$partial = ($valorFormatado + ($valorFormatado * $juros * $installmentCount));
				$installmentValue = number_format((float) $partial, 2, '.', '');
			}

			$telefone = preg_replace('/[^0-9]/', '', $post['telefone']);
			preg_match('/^(\d{2})(\d{8,9})$/', $telefone, $matches);

			$evento = $this->eventoModel->find(17);
			$integerValue = (int) preg_replace('/\D/', '', $installmentValue);

			$pay = [
				'items' => [[
					'amount' => $integerValue,
					'description' => 'Ingresso(s) ' . $evento->nome,
					'quantity' => 1,
					'code' => 'product_code',
				]],
				'customer' => [
					'name' => $post['nome'],
					'email' => $post['email'],
					'document' => preg_replace('/\D/', '', $post['cpf']),
					'type' => 'individual',
					'phones' => [
						'mobile_phone' => [
							'country_code' => '55',
							'area_code' => $matches[1],
							'number' => $matches[2]
						]
					],
				],
				'payments' => [[
					'payment_method' => 'credit_card',
					'credit_card' => [
						'installments' => $post['installmentCount'],
						'card' => [
							'number' => $post['numero_cartao'],
							'holder_name' => $post['holderName'],
							'exp_month' => $post['mes_vencimento'],
							'exp_year' => $post['ano_vencimento'],
							'cvv' => $post['codigo_seguranca'],
							'billing_address' => [
								'country' => 'BR',
								'state' => $post['estado'],
								'city' => $post['cidade'],
								'line_1' => $post['endereco'],
								'zip_code' => preg_replace('/[^0-9]/', '', $post['cep'])
							],
						]
					]
				]],
				'options' => [
					'antifraud_enabled' => false
				],
				'initiator_transaction_key' => uniqid()
			];

			$payment = $this->pagarmeService->createTransaction($pay);

			if (!isset($payment['errors'][0])) {
				$status = $payment['status'] == 'paid' ? 'CONFIRMED' : $payment['status'];

				$this->pedidoModel->protect(false)->update($pedido_id, [
					'charge_id' => $payment['id'],
					'status' => $status
				]);

				$this->transactionModel->protect(false)->insert([
					'pedido_id' => $pedido_id,
					'charge_id' => $payment['id'],
					'installment_value' => $post['valor_total'],
					'installments' => $post['installmentCount'],
					'payment' => 'CREDIT_CARD',
				]);

				$this->enderecoModel->protect(false)->insert([
					'pedido_id' => $pedido_id,
					'endereco' => $post['endereco'],
					'numero' => $post['numero'],
					'bairro' => $post['bairro'],
					'cep' => preg_replace('/[^0-9]/', '', $post['cep']),
					'cidade' => $post['cidade'],
					'estado' => $post['estado'],
				]);

				$this->enviaEmailPedidoCartao($cliente);

				if (in_array($status, ['paid', 'CONFIRMED', 'RECEIVED'])) {
					unset($_SESSION['carrinho']);
					return redirect()->to(site_url("checkout/obrigado/"));
				}
			}

			return redirect()->to(site_url("checkout/cartao/"))->with('erro', "Erro ao processar pagamento!");
		} catch (\Throwable $e) {
			log_message('error', 'Erro em finalizarcartao: ' . $e->getMessage());
			return redirect()->to(site_url("checkout/cartao/"))->with('erro', "Erro inesperado");
		}
	}

	private function criaPedidoCartao(array $post, int $user_id, int $event_id): int
	{
		$frete = ($post['frete'] ?? '') === 'casa' ? 1 : 0;

		$data = [
			'evento_id' => $event_id,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' => $post['valor_total'],
			'convite' => $post['convite'] ?? '',
			'frete' => $frete,
			'forma_pagamento' => 'CREDIT_CARD',
		];

		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		return $this->pedidoModel->getInsertID();
	}

	
	public function finalizarpix($event_id)
	{
		if (! $this->request->isAJAX()) {
			return redirect()->back();
		}

		helper('text');
		$retorno['token'] = csrf_hash();

		try {
			$post = $this->request->getPost();

			// Validar dados obrigatórios
			if (!isset($post['email'], $post['valor_total'], $_SESSION['carrinho'])) {
				return $this->response->setJSON(['erro' => 'Dados incompletos']);
			}

			$cliente = $this->buscaOuCriaCliente($post);
			$user_id = $cliente->usuario_id;

			$pedido_id = $this->criaPedido($post, $user_id, $event_id);
			$this->registraIngressos($pedido_id, $user_id);

			$customer_id = $this->obtemOuCriaCustomerIdAsaas($cliente, $post);
			$this->clienteModel->protect(false)->update($cliente->id, ['customer_id' => $customer_id]);

			$payment = $this->asaasService->paymentPix([
				'customer_id' => $customer_id,
				'value' => (float) $post['valor_total'],
				'description' => 'Ingressos Dreamfest 25',
				'externalReference' => 'Api ASAAS'
			]);

			if (isset($payment['errors'][0])) {
				return $this->response->setJSON(['erro' => 'Falha ao processar compra']);
			}

			$transaction = $this->asaasService->obtemQrCode($payment['id']);

			$this->pedidoModel->protect(false)->update($pedido_id, [
				'charge_id' => $payment['id'],
				'status' => $payment['status']
			]);

			$this->transactionModel->protect(false)->insert([
				'pedido_id' => $pedido_id,
				'charge_id' => $payment['id'],
				'installment_value' => $payment['value'],
				'expire_at' => date('Y-m-d', strtotime('+1 days')),
				'payment' => $payment['billingType'],
				'qrcode' => $transaction['payload'],
				'qrcode_image' => $transaction['encodedImage'],
				'link' => $payment['invoiceUrl']
			]);

			$this->enviaEmailPedido((object) [
				'nome' => $cliente->nome,
				'email' => $cliente->email,
				'url' => site_url("checkout/qrcode/{$payment['id']}"),
				'qrcode_image' => $transaction['encodedImage'],
				'copiaecola' => $transaction['payload'],
				'expire_at' => strtotime($transaction['expirationDate']),
				'valor' => $payment['value']
			]);

			unset($_SESSION['carrinho']);

			$retorno['id'] = $payment['id'];
			return $this->response->setJSON($retorno);
		} catch (\Throwable $e) {
			log_message('error', 'Erro em finalizarpix: ' . $e->getMessage());
			return $this->response->setJSON(['erro' => 'Erro interno. Tente novamente.']);
		}
	}

	private function buscaOuCriaCliente(array $post)
	{
		$cliente = $this->clienteModel
			->withDeleted(true)
			->where('email', $post['email'])
			->orderBy('id', 'DESC')
			->first();

		if ($cliente) {
			return $cliente;
		}

		$cliente = new Cliente($post);
		if ($this->clienteModel->save($cliente)) {
			$cliente->id = $this->clienteModel->getInsertID();
			$newuser = $this->criaUsuarioParaCliente($cliente);
			$this->enviaEmailCriacaoEmailAcesso($cliente, $newuser);
			return $this->clienteModel->find($cliente->id);
		}

		throw new \Exception('Erro ao salvar cliente');
	}

	private function criaPedido(array $post, int $user_id, int $event_id): int
	{
		$frete = ($post['frete'] ?? '') === 'casa' ? 1 : 0;

		$data = [
			'evento_id' => $event_id,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' => $post['valor_total'] / 100,
			'frete' => $frete,
			'convite' => $post['convite'] ?? '',
			'forma_pagamento' => 'PIX',
		];

		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		return $this->pedidoModel->getInsertID();
	}

	private function registraIngressos(int $pedido_id, int $user_id): void
	{
		foreach ($_SESSION['carrinho'] as $item) {
			for ($i = 0; $i < $item['quantidade']; $i++) {
				$this->ingressoModel->skipValidation(true)->protect(false)->insert([
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $item['nome'],
					'quantidade' => 1,
					'valor_unitario' => $item['preco'],
					'valor' => $item['preco'],
					'tipo' => $item['tipo'],
					'ticket_id' => $item['ticket_id'],
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				]);
			}
		}
	}

	private function obtemOuCriaCustomerIdAsaas($cliente, array $post): string
	{
		if (!empty($cliente->customer_id)) {
			return $cliente->customer_id;
		}

		$cobrar = [
			'nome' => $post['nome'],
			'cpf' => $post['cpf'],
			'email' => $post['email'],
			'telefone' => preg_replace('/[^0-9]/', '', $post['telefone']),
			'cep' => '',
			'numero' => '',
		];

		$customer = $this->asaasService->customers($cobrar);

		if (!isset($customer['id'])) {
			throw new \Exception('Erro ao criar cliente na API ASAAS');
		}

		return $customer['id'];
	}


	public function finalizaradm()
	{

		$post = $this->request->getPost();

		$email = $post['email'];

		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id',
			'clientes.customer_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.email', $email)
			->orderBy('id', 'DESC')
			->first();

		if ($cliente != null) {
			$user_id = $cliente->usuario_id;
		} else {
			//criqar usuario e pegar o ID
			//$user_id = $this->usuarioModel->getInsertID();
			$cliente = new Cliente($post);

			if ($this->clienteModel->save($cliente)) {
				// Cria usuario do cliente
				$newuser = $this->criaUsuarioParaCliente($cliente);

				// Envia dados de acesso ao clente
				$this->enviaEmailCriacaoEmailAcesso($cliente, $newuser);



				$cliente_id = $this->clienteModel->getInsertID();

				$atributos = [
					'clientes.id',
					'clientes.nome',
					'clientes.cpf',
					'clientes.email',
					'clientes.telefone',
					'clientes.deleted_at',
					'clientes.usuario_id',
					'clientes.customer_id'
				];

				$cliente = $this->clienteModel->select($atributos)
					->withDeleted(true)
					->where('clientes.id', $cliente_id)
					->orderBy('id', 'DESC')
					->first();

				$user_id = $cliente->usuario_id;
			}
		}

		$atributos = [
			'usuarios.id',
			'usuarios.nome',

		];

		$id_admin = $this->usuarioLogado()->id;
		$admin = $this->usuarioModel->select($atributos)
			->withDeleted(true)
			->where('usuarios.id', $id_admin)
			->first();

		$data = [
			'evento_id' => 17,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' =>  $post['valor_total'] / 100,
			'convite' => $admin->nome,
			'forma_pagamento' => 'Manual',
			'status' => 'CONFIRMED',

		];
		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();

		foreach ($_SESSION['carrinho'] as $key => $value) {

			for ($i = 0; $i < $value['quantidade']; $i++) {

				$nome = $value['nome'];
				$quantidade = 1;
				$valorUnitario = $value['preco'];
				$valor = $value['preco'];
				$tipo = $value['tipo'];
				//$ticket_id = $value['ticket_id'];

				$ingressos = [
					'pedido_id' => $pedido_id,
					'user_id' => $user_id,
					'nome' => $nome,
					'quantidade' => $quantidade,
					'valor_unitario' => $valorUnitario,
					'valor' => $valor,
					'tipo' => $tipo,
					//'ticket_id' => $ticket_id,
					'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
				];

				$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);
				$ingresso_id = $this->ingressoModel->getInsertID();
			}
		}





		$montaemail = [
			'nome' => $cliente->nome,
			'email' => $cliente->email,

		];


		$this->enviaEmailCortesia((object)$montaemail);




		unset($_SESSION['carrinho']);

		return redirect()->to(site_url("/"))->with('atencao', "Cortesias adicionadas!");
	}

	public function geraIngressoMembro(int $event_id)
	{


		if (!$this->usuarioLogado()->is_membro) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}

		$user_id = $this->usuarioLogado()->id;

		$ingresso = $this->ingressoModel->select('ingressos.id')
			->join('pedidos', 'pedidos.id = ingressos.pedido_id')
			->where('ingressos.user_id', $user_id)
			->where('pedidos.evento_id', $event_id)
			->first();



		if (isset($ingresso)) {
			return redirect()->to(site_url("ingressos"))->with('atencao', "Você já garantiu o seu acesso ao evento!");
		}




		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->withDeleted(true)
			->where('clientes.usuario_id', $user_id)
			->first();


		$cliente_id = $cliente->id;


		$data = [
			'evento_id' => $event_id,
			'user_id' => $user_id,
			'codigo' => $this->pedidoModel->geraCodigoPedido(),
			'total' => '0',
			'forma_pagamento' => 'autoatendimento',
			'status' => 'paid'

		];
		//dd('aqui');
		$this->pedidoModel->skipValidation(true)->protect(false)->insert($data);
		$pedido_id = $this->pedidoModel->getInsertID();


		if ($event_id == 17) {
			$nome_evento = 'Checkin - Acesso via Dreamclub';
		} else if ($event_id == 10) {
			$nome_evento = 'Sensei Party de Carnaval - Acesso via Dreamclub';
		}

		$ingressos = [
			'pedido_id' => $pedido_id,
			'user_id' => $user_id,
			'nome' => $nome_evento,
			'quantidade' => 1,
			'valor_unitario' => 0,
			'valor' => 0,
			'codigo' => $user_id . $this->ingressoModel->geraCodigoIngresso(),
		];

		$this->ingressoModel->skipValidation(true)->protect(false)->insert($ingressos);


		$this->enviaEmailPedido($cliente);

		return redirect()->to(site_url("ingressos"))->with('sucesso', "Seu ingresso foi gerado com sucesso! Apresente seu cartão na bilheteria do evento para garantir seu acesso.");
	}

	public function qrcode(string $id)
	{


		$transaction = $this->buscatransactionOu404($id);


		$convite = $this->usuarioModel->select('usuarios.codigo')
			->join('pedidos', 'pedidos.user_id = usuarios.id')
			->where('pedidos.charge_id', $id)
			->first();
		//dd($convite->id);

		$payment = $this->asaasService->listaCobranca($id);
		$status = $payment['status'];

		$indicacoes = $this->pedidoModel->where('convite', $convite->codigo)->where('status', 'paid')->countAllResults();

		$data = [
			'titulo' => 'Pagamento via PIX ',
			'charge_id' => $id,
			'transaction' => $transaction,
			'convite' => $convite->codigo,
			'indicacoes' => $indicacoes,
			'status' => $status
		];



		return view('Checkout/qrcode', $data);
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
	private function buscaclienteByEmailOu404($email = null)
	{
		if (!$email || !$cliente = $this->clienteModel->recuperaClienteByEmail($email)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o cliente $email");
		}

		return $cliente;
	}

	private function criaUsuarioParaCliente(object $cliente)
	{

		$pass = $this->usuarioModel->geraCodigoUsuario();
		// Montamos os dados do usuário do cliente
		$usuario = [
			'nome' => $cliente->nome,
			'email' => $cliente->email,
			'password' => $pass,
			'ativo' => true,
		];

		// Criamos o usuário do cliente
		$this->usuarioModel->skipValidation(true)->protect(false)->insert($usuario);

		// Montamos os dados do grupo que o usuário fará parte
		$grupoUsuario = [
			'grupo_id' => 2, // Grupo de clientes.... lembrem que esse ID jamais deverá ser alterado ou removido.
			'usuario_id' => $this->usuarioModel->getInsertID(),
		];

		// Inserimos o usuário no grupo de clientes
		$this->grupoUsuarioModel->protect(false)->insert($grupoUsuario);

		// Atualizamos a tabela de clientes com o ID do usuário criado
		$this->clienteModel
			->protect(false)
			->where('id', $this->clienteModel->getInsertID())
			->set('usuario_id', $this->usuarioModel->getInsertID())
			->update();

		return $pass;
	}

	/**
	 * Método que envia o e-mail para o cliente informando a alteração no e-mail de acesso.
	 *
	 * @param object $usuario
	 * @return void
	 */
	private function enviaEmailCriacaoEmailAcesso(object $cliente, string $newuser): void
	{
		$email = service('email');

		$email->setFrom(env('email.fromEmail'), env('email.fromName'));

		$email->setTo($cliente->email);

		$email->setSubject('Dados de acesso ao sistema');

		$data = [
			'cliente' => $cliente,
			'newuser' => $newuser
		];

		$mensagem = view('Clientes/email_dados_acesso', $data);

		$email->setMessage($mensagem);

		$email->send();
	}

	/**
	 * Método que recupera o cliente
	 *
	 * @param integer $id
	 * @return Exceptions|object
	 */
	private function buscatransactionOu404(string $id = null)
	{
		if (!$id || !$transaction = $this->transactionModel->recuperaTransaction($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a transação $id");
		}

		return $transaction;
	}

	private function enviaEmailPedido(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.fromEmail'), env('email.fromName'));

		$email->setTo($cliente->email);

		$email->setSubject('Pedido realizado com sucesso!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_pedido', $data);

		$email->setMessage($mensagem);

		$email->send();
	}

	private function enviaEmailCortesia(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.fromEmail'), env('email.fromName'));

		$email->setTo($cliente->email);

		$email->setSubject('Seus ingressos CORTESIA estão disponíveis!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_cortesia', $data);

		$email->setMessage($mensagem);

		$email->send();
	}


	private function enviaEmailPedidoCartao(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.fromEmail'), env('email.fromName'));

		$email->setTo($cliente->email);

		$email->setSubject('Pedido realizado com sucesso!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_pedido_cartao', $data);

		$email->setMessage($mensagem);

		$email->send();
	}

	public function consultaCep()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		$cep = $this->request->getGet('cep');

		return $this->response->setJSON($this->consultaViaCep($cep));
	}

	public function checkPaid(int $pedido_id)
	{


		$user = $this->usuarioModel->select('usuarios.id')
			->join('pedidos', 'pedidos.user_id = usuarios.id')
			->where('pedidos.id', $pedido_id)
			->first();



		$atributos = [
			'clientes.id',
			'clientes.nome',
			'clientes.cpf',
			'clientes.email',
			'clientes.telefone',
			'clientes.deleted_at',
			'clientes.usuario_id'
		];

		$cliente = $this->clienteModel->select($atributos)
			->where('usuario_id', $user->id)
			->first();



		$this->pedidoModel
			->protect(false)
			->where('id', $pedido_id)
			->set('status', 'paid')
			->update();

		$this->enviaEmailPaid($cliente);

		return redirect()->back()->with('info', "Alterado com sucesso!");
	}

	private function enviaEmailPaid(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.fromEmail'), env('email.fromName'));

		$email->setTo($cliente->email);

		$email->setSubject('Olá, seus ingressos já estão disponíveis!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_paid', $data);

		$email->setMessage($mensagem);

		$email->send();
	}
}
