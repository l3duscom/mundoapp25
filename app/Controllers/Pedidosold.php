<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Endereco;
use App\Traits\ValidacoesTrait;

class Pedidos extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $pedidosModel;
	private $enderecoModel;
	private $ingressoModel;
	private $credencialModel;



	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->pedidosModel = new \App\Models\PedidoModel();
		$this->enderecoModel = new \App\Models\EnderecoModel();
		$this->ingressoModel = new \App\Models\IngressoModel();
		$this->credencialModel = new \App\Models\CredencialModel();
	}

	public function index()
	{

		$id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		$pedidos = $this->pedidosModel->recuperaPedidosPorUsuario($id);


		$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		//dd($ingressos);
		$data = [
			'titulo' => 'Dashboard de ' . esc($cliente->nome),
			'cliente' => $cliente,
			'card' => $card,
			'pedidos' => $pedidos
		];


		return view('Pedidos/meus', $data);
	}

	public function gerenciar()
	{

		if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}

		$id = $this->usuarioLogado()->id;








		$data = [
			'titulo' => 'Gerenciamento de pedidos',
		];


		return view('Pedidos/gerenciar', $data);
	}

	public function entrega()
	{

		if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}

		$id = $this->usuarioLogado()->id;



		$data = [
			'titulo' => 'Pedidos aguardando envio',
		];


		return view('Pedidos/entrega', $data);
	}

	public function vip()
	{

		if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}

		$id = $this->usuarioLogado()->id;



		$data = [
			'titulo' => 'Pedidos aguardando envio',
		];


		return view('Pedidos/vip', $data);
	}

	public function vipentregue()
	{

		if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}

		$id = $this->usuarioLogado()->id;



		$data = [
			'titulo' => 'Pedidos aguardando envio',
		];


		return view('Pedidos/vipentregue', $data);
	}

	public function enviados()
	{

		if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}

		$id = $this->usuarioLogado()->id;



		$data = [
			'titulo' => 'Pedidos enviados',
		];


		return view('Pedidos/enviados', $data);
	}

	public function recuperaPedidosAdmin()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		$pedidos = $this->pedidosModel->listaPedidosAdmin();

		// Receberá o array de objetos de clientes
		$data = [];

		foreach ($pedidos as $pedido) {
			$data[] = [

				'cod_pedido' => anchor("pedidos/ingressos/" . $pedido->id, esc($pedido->cod_pedido), 'title="Exibir usuário ' . esc($pedido->cod_pedido) . ' "'),
				'nome' => esc($pedido->nome),
				'email' => esc($pedido->email),
				'telefone' => esc($pedido->telefone),
				'status' => esc($pedido->status),
				'cpf' => esc($pedido->cpf),
				'frete' => $pedido->frete,
				'status_entrega' => esc($pedido->status_entrega),
				'rastreio' => esc($pedido->rastreio),
			];
		}

		$retorno = [
			'data' => $data,
		];

		return $this->response->setJSON($retorno);
	}

	public function recuperaPedidosAdminEntrega()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}
		$event_id = 11;

		$pedidos = $this->pedidosModel->listaPedidosAdminEntrega($event_id);

		// Receberá o array de objetos de clientes
		$data = [];

		foreach ($pedidos as $pedido) {
			$data[] = [

				'cod_pedido' => anchor("pedidos/ingressos/" . $pedido->id, esc($pedido->cod_pedido), 'title="Exibir usuário ' . esc($pedido->cod_pedido) . ' "'),
				'nome' => esc($pedido->nome),
				'email' => esc($pedido->email),
				'telefone' => esc($pedido->telefone),
				'status' => esc($pedido->status),
				'cpf' => esc($pedido->cpf),
				'frete' => $pedido->frete,
				'status_entrega' => esc($pedido->status_entrega),
				'rastreio' => esc($pedido->rastreio),
			];
		}

		$retorno = [
			'data' => $data,
		];

		return $this->response->setJSON($retorno);
	}

	public function recuperaPedidosAdminVip()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}
		$event_id = 11;

		$pedidos = $this->pedidosModel->listaPedidosAdminVip($event_id);

		// Receberá o array de objetos de clientes
		$data = [];

		foreach ($pedidos as $pedido) {
			$data[] = [

				'cod_pedido' => anchor("pedidos/ingressos/" . $pedido->id, esc($pedido->cod_pedido), 'title="Exibir usuário ' . esc($pedido->cod_pedido) . ' "'),
				'nome' => esc($pedido->nome),
				'email' => esc($pedido->email),
				'telefone' => esc($pedido->telefone),
				'status' => esc($pedido->status),
				'cinemark' => esc($pedido->cinemark),
				'frete' => $pedido->frete,
				'status_entrega' => esc($pedido->status_entrega),
				'rastreio' => esc($pedido->rastreio),
			];
		}

		$retorno = [
			'data' => $data,
		];

		return $this->response->setJSON($retorno);
	}

	public function recuperaPedidosAdminVipEntregue()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}
		$event_id = 11;

		$pedidos = $this->pedidosModel->listaPedidosAdminVipEntregue($event_id);

		// Receberá o array de objetos de clientes
		$data = [];

		foreach ($pedidos as $pedido) {
			$data[] = [

				'cod_pedido' => anchor("pedidos/ingressos/" . $pedido->id, esc($pedido->cod_pedido), 'title="Exibir usuário ' . esc($pedido->cod_pedido) . ' "'),
				'nome' => esc($pedido->nome),
				'email' => esc($pedido->email),
				'telefone' => esc($pedido->telefone),
				'status' => esc($pedido->status),
				'cinemark' => esc($pedido->cinemark),
				'frete' => $pedido->frete,
				'status_entrega' => esc($pedido->status_entrega),
				'rastreio' => esc($pedido->rastreio),
			];
		}

		$retorno = [
			'data' => $data,
		];

		return $this->response->setJSON($retorno);
	}
	public function recuperaPedidosAdminEnviados()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}
		$event_id = 11;

		$pedidos = $this->pedidosModel->listaPedidosAdminEnviados($event_id);

		// Receberá o array de objetos de clientes
		$data = [];

		foreach ($pedidos as $pedido) {
			$data[] = [

				'cod_pedido' => anchor("pedidos/ingressos/" . $pedido->id, esc($pedido->cod_pedido), 'title="Exibir usuário ' . esc($pedido->cod_pedido) . ' "'),
				'nome' => esc($pedido->nome),
				'email' => esc($pedido->email),
				'telefone' => esc($pedido->telefone),
				'status' => esc($pedido->status),
				'cpf' => esc($pedido->cpf),
				'frete' => $pedido->frete,
				'status_entrega' => esc($pedido->status_entrega),
				'rastreio' => esc($pedido->rastreio),
			];
		}

		$retorno = [
			'data' => $data,
		];

		return $this->response->setJSON($retorno);
	}

	public function ingressos($id)
	{

		$pedido_id = $id;

		$pedido = $this->pedidosModel->recuperaPedido($pedido_id);




		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $pedido->user_id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);


		$endereco = $this->enderecoModel->where('pedido_id', $pedido_id)->first();


		$todos = $this->ingressoModel->recuperaIngressosPorUsuario($pedido->user_id);


		$ingressos = $this->ingressoModel->recuperaIngressosPorPedido($pedido_id);

		$credenciais = $this->credencialModel->withDeleted(true)->where('pedido_id', $pedido_id)->findAll();
		$data = [
			'titulo' => 'Ingressos do pedido' . esc($pedido->cod_pedido),
			'todos' => $todos,
			'ingressos' => $ingressos,
			'pedido' => $pedido,
			'cliente' => $cliente,
			'endereco' => $endereco,
			'credenciais' => $credenciais
		];


		return view('Pedidos/ingressos', $data);
	}

	public function rastreio($pedido_id)
	{

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		// Recupero o post da requisição
		$post = $this->request->getPost();


		$pedido = $this->pedidosModel->find($pedido_id);

		$pedido->fill($post);


		if ($this->pedidosModel->save($pedido)) {

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
				->where('usuario_id', $pedido->user_id)
				->first();





			$this->enviaEmailRastreio($cliente);

			return redirect()->to(site_url("pedidos/ingressos/" . $pedido_id))->with('sucesso', "Participante alterado com sucesso");
		}

		return redirect()->to(site_url("pedidos/ingressos/" . $pedido_id))->with('atencao', "Erro ao alterar o participante, contate o suporte!");
	}

	private function enviaEmailRastreio(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.SMTPUser'), env('LICENCED'));

		$email->setTo($cliente->email);

		$email->setCC('relacionamento@mundodream.com.br');

		$email->setSubject('Olá, seus ingressos foram enviados!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_rastreio', $data);

		$email->setMessage($mensagem);

		$email->send();
	}



	public function receberCartao()
	{
		$id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		$pedidos = $this->pedidosModel->recuperaPedidosPorUsuario($id);


		$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		//dd($ingressos);
		$data = [
			'titulo' => 'Receber Cartão',
			'cliente' => $cliente,
			'card' => $card,
		];


		return view('Pedidos/receber_cartao', $data);
	}

	public function gerenciarEndereco($pedido_id)
	{

		$id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		//$pedidos = $this->pedidosModel->recuperaPedidosPorPedido($pedido_id);


		$endereco = $this->enderecoModel->where('pedido_id', $pedido_id)->first();

		//dd($endereco);
		$data = [
			'titulo' => 'Gerenciar Endereço',
			'cliente' => $cliente,
			'endereco' => $endereco,
			'pedido_id' => $pedido_id,

		];



		if (isset($endereco)) {
			return view('Pedidos/editar_endereco', $data);
		} else {
			return view('Pedidos/receber_cartao', $data);
		}
	}



	public function registrar_endereco_cartao()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		$user_id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $user_id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		// Recupero o post da requisição
		$post = $this->request->getPost();

		$endereco = new Endereco($post);

		if ($this->enderecoModel->save($endereco)) {
			session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

			$retorno['id'] = $this->enderecoModel->getInsertID();

			$this->cartaoModel
				->protect(false)
				->where('user_id', $user_id)
				->set('endereco_id', $retorno['id'])
				->set('status', 'Preparando')
				->update();

			//$this->enviaEmailEnvioCartao($cliente);

			return $this->response->setJSON($retorno);
		}

		// Retornamos os erros de validação
		$retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
		$retorno['erros_model'] = $this->enderecoModel->errors();

		// Retorno para o ajax request
		return $this->response->setJSON($retorno);
	}

	public function editar_endereco_pedido()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		$user_id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $user_id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		// Recupero o post da requisição
		$post = $this->request->getPost();
		$pedido_id = $post['pedido_id'];
		$endereco = $this->enderecoModel->where('pedido_id', $pedido_id)->first();
		$endereco->fill($post);

		if ($endereco->hasChanged() === false) {
			$retorno['info'] = 'Não há dados para atualizar';
			return $this->response->setJSON($retorno);
		}

		if ($this->enderecoModel->save($endereco)) {
			session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

			$retorno['id'] = $this->enderecoModel->getInsertID();


			//$this->enviaEmailEnvioCartao($cliente);

			return $this->response->setJSON($retorno);
		}

		// Retornamos os erros de validação
		$retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
		$retorno['erros_model'] = $this->enderecoModel->errors();

		// Retorno para o ajax request
		return $this->response->setJSON($retorno);
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

	private function enviaEmailEnvioCartao(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.SMTPUser'), env('LICENCED'));

		$email->setTo($cliente->email);

		$email->setCC('relacionamento@mundodream.com.br');

		$email->setSubject('Endereço atualizado com sucesso!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_envio_cartao', $data);

		$email->setMessage($mensagem);

		$email->send();
	}
}
