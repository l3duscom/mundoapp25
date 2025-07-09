<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Credencial;
use App\Entities\Ingresso;
use App\Traits\ValidacoesTrait;

use Dompdf\Dompdf;
use Picqer\Barcode\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorHTML;

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

class Ingressos extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $ingressoModel;
	private $pedidosModel;
	private $enderecoModel;
	private $credencialModel;


	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->ingressoModel = new \App\Models\IngressoModel();
		$this->pedidosModel = new \App\Models\PedidoModel();
		$this->enderecoModel = new \App\Models\EnderecoModel();
		$this->credencialModel = new \App\Models\CredencialModel();
	}

	public function index()
	{

		$id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);

		$ingressos = $this->ingressoModel->recuperaIngressosPorUsuario($id);

		$ingressos_encerrados = $this->ingressoModel->recuperaIngressosPorUsuarioEncerrados($id);
		$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		foreach ($ingressos as $key => $value) {
			$ingressos[$key]->qr = (new QRCode)->render($ingressos[$key]->codigo);
		}
		//dd($ingressos);
		$data = [
			'titulo' => 'Dashboard de ' . esc($cliente->nome),
			'cliente' => $cliente,
			'card' => $card,
			'ingressos' => $ingressos,
			'ingressos_encerrados' => $ingressos_encerrados
		];


		return view('Ingressos/index', $data);
	}

	public function encerrados()
	{

		$id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);


		$ingressos = $this->ingressoModel->recuperaIngressosPorUsuarioEncerrados($id);
		$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		//dd($ingressos);
		$data = [
			'titulo' => 'Dashboard de ' . esc($cliente->nome),
			'cliente' => $cliente,
			'card' => $card,
			'ingressos' => $ingressos
		];


		return view('Ingressos/encerrados', $data);
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

	public function vincular_cinemark()
	{

		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();




		// Recupero o post da requisição
		$post = $this->request->getPost();

		$credencial = $this->ingressoModel->find($post['ingresso_id']);

		$credencial->fill($post);



		if ($this->ingressoModel->save($credencial)) {
			session()->setFlashdata('sucesso', 'Credencial vinculada com sucesso!');

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
				->where('usuario_id', $credencial->user_id)
				->first();





			$this->enviaEmailCinemark($cliente);

			$retorno['id'] = $post['pedido_id'];



			return $this->response->setJSON($retorno);
		}
	}

	public function gerarIngressoPdf($id)
	{

		$user_id = $this->usuarioLogado()->id;

		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $user_id)->first();

		$cliente = $this->buscaclienteOu404($cli->id);


		$ingresso = $this->ingressoModel->recuperaIngresso($id);
		//$participante = '';

		if ($ingresso->participante != null) {
			$participante = $ingresso->participante;
		} else {
			$participante = $cliente->nome;
		}

		$generator = new BarcodeGeneratorHTML();
		$barcode = $generator->getBarcode($ingresso->codigo, $generator::TYPE_CODE_39);

		$qrcode = (new QRCode)->render($ingresso->codigo);




		$data = [
			'titulo' => 'Meu ingresso: ' . $ingresso->codigo . ' - ' . date('d/m/Y H:i'),
			'ingresso' => $ingresso,
			'participante' => $participante,
			'barcode' => $barcode,
			'qrcode' => $qrcode
		];

		$nomeArquivo = 'Ingresso-' . $ingresso->slug . '-' . $ingresso->codigo . '.pdf';

		$dompdf = new Dompdf();

		$dompdf->loadHtml(view('Ingressos/pdf', $data));
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream($nomeArquivo, ['Attachment' => false]);

		unset($dompdf);
		unset($dompdf);

		exit();
	}

	public function gerarEticket($id)
	{


		$pedido_id = $id;

		$pedido = $this->pedidosModel->recuperaPedido($pedido_id);




		$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $pedido->user_id)->first();


		$cliente = $this->buscaclienteOu404($cli->id);

		$endereco = $this->enderecoModel->where('pedido_id', $pedido_id)->first();



		$todos = $this->ingressoModel->recuperaIngressosPorUsuario($pedido->user_id);

		$ingressos = $this->ingressoModel->recuperaIngressosPorPedido($pedido_id);


		//$ingresso = $this->ingressoModel->recuperaIngresso($id);
		//$participante = '';

		//if ($ingresso->participante != null) {
		//$participante = $ingresso->participante;
		//} else {
		//$participante = $cliente->nome;
		//}

		//$generator = new BarcodeGeneratorHTML();
		//$barcode = $generator->getBarcode($ingresso->codigo, $generator::TYPE_CODE_39);

		$data = [
			'titulo' => 'E-ticket: ' . $pedido->cod_pedido . ' - ' . date('d/m/Y H:i'),
			'ingressos' => $ingressos,
			'cliente' => $cliente,
			'endereco' => $endereco
			//'participante' => $participante,
			//'barcode' => $barcode
		];

		$nomeArquivo = 'E-ticket do pedido -' . $pedido->cod_pedido . '.pdf';

		$dompdf = new Dompdf();

		$dompdf->loadHtml(view('Ingressos/eticket', $data));
		$dompdf->setPaper('A4');
		$dompdf->render();
		$dompdf->stream($nomeArquivo, ['Attachment' => false]);

		unset($dompdf);
		unset($dompdf);

		exit();
	}

	public function vincular($id)
	{




		//$pedidos = $this->pedidosModel->recuperaPedidosPorPedido($pedido_id);
		$ingresso = $this->ingressoModel->recuperaIngresso($id);


		$credencial = $this->credencialModel->where('ingresso_id', $id)->first();

		//dd($endereco);
		$data = [
			'titulo' => 'Vincular credencial',
			'credencial' => $credencial,
			'id' => $id,
			'pedido' => $ingresso->pedido_id


		];




		return view('Ingressos/vincular', $data);
	}

	public function cinemark($id)
	{




		//$pedidos = $this->pedidosModel->recuperaPedidosPorPedido($pedido_id);
		$ingresso = $this->ingressoModel->recuperaIngresso($id);


		$credencial = $this->ingressoModel->where('id', $id)->first();

		//dd($endereco);
		$data = [
			'titulo' => 'Vincular credencial',
			'credencial' => $credencial,
			'id' => $id,
			'pedido' => $ingresso->pedido_id


		];




		return view('Ingressos/cinemark', $data);
	}

	private function enviaEmailCinemark(object $cliente): void
	{
		$email = service('email');

		$email->setFrom(env('email.SMTPUser'), env('LICENCED'));

		$email->setTo($cliente->email);

		$email->setCC('relacionamento@mundodream.com.br');

		$email->setSubject('Olá, seu ingresso Cinemark foi enviado com sucesso!!!');

		$data = [
			'cliente' => $cliente,
		];

		$mensagem = view('Pedidos/email_cortesia', $data);

		$email->setMessage($mensagem);

		$email->send();
	}

	public function vincular_credencial()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();




		// Recupero o post da requisição
		$post = $this->request->getPost();

		$credencial = new Credencial($post);

		if ($this->credencialModel->save($credencial)) {
			session()->setFlashdata('sucesso', 'Credencial vinculada com sucesso!');

			$retorno['id'] = $post['pedido_id'];


			return $this->response->setJSON($retorno);
		}

		// Retornamos os erros de validação
		$retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
		$retorno['erros_model'] = $this->enderecoModel->errors();

		// Retorno para o ajax request
		return $this->response->setJSON($retorno);
	}

	public function atualizar($id)
	{

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		// Recupero o post da requisição
		$post = $this->request->getPost();


		$ingresso = $this->ingressoModel->recuperaIngresso($id);

		$ingresso->fill($post);


		if ($this->ingressoModel->save($ingresso)) {

			return redirect()->to(site_url("ingressos"))->with('sucesso', "Participante alterado com sucesso");
		}

		return redirect()->to(site_url("ingressos"))->with('atencao', "Erro ao alterar o participante, contate o suporte!");
	}

	public function add()
	{


		if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

			return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
		}




		$data = [
			'titulo' => 'Add Ingressos ADMIN',


		];


		return view('Carrinho/admin', $data);
	}
}
