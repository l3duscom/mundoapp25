<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Cartao;
use App\Entities\Evento;
use App\Entities\Ticket;
use App\Traits\ValidacoesTrait;

class Carrinho extends BaseController
{
	use ValidacoesTrait;

	private $clienteModel;
	private $usuarioModel;
	private $cartaoModel;
	private $ticketModel;
	private $eventoModel;
	private $cupomModel;



	public function __construct()
	{
		$this->clienteModel = new \App\Models\ClienteModel();
		$this->usuarioModel = new \App\Models\UsuarioModel();
		$this->cartaoModel = new \App\Models\CartaoModel();
		$this->ticketModel = new \App\Models\TicketModel();
		$this->eventoModel = new \App\Models\EventoModel();
		$this->cupomModel = new \App\Models\CupomModel();
	}

	public function evento($event_id)
	{
		// Buscar dados do evento para o pixel

		$evento = $this->eventoModel->find($event_id);

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
				'dia' => $item->dia,
				'lote' => $item->lote,
				'categoria' => $item->categoria,
				'data_lote' => $item->data_lote,
				'estoque' => $item->estoque,
				'parent_ticket_id' => $item->parent_ticket_id
			);
		}

		$data = [
			'titulo' => 'Comprar ingressos',
			'id' => $id,
			'items' => $ingressos,
			'event_id' => $event_id,
			'evento' => $evento // Dados do evento para o pixel
		];

		return view('Carrinho/index', $data);
	}

	public function adicional($event_id)
	{


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
		//dd($ingressos);

		$data = [
			'titulo' => 'Comprar ingressos',
			'id' => $id,
			'items' => $ingressos

		];


		return view('Carrinho/adicionais', $data);
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

    public function otakada($event_id)
    {


        if ($this->usuarioLogado()) {
            $id = $this->usuarioLogado()->id;
            $cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
            //$cliente = $this->buscaclienteOu404($cli->id);
            $card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
        } else {
            $id = null;
        }


        $items = $this->ticketModel->recuperaIngressosOtakadaPorEvento($event_id);


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


        return view('Carrinho/otakada', $data);
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





	public function pucrs($event_id)
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}


		$items = $this->ticketModel->recuperaIngressosPucPorEvento($event_id);


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


		return view('Carrinho/puc', $data);
	}

	public function marista($event_id)
	{


		if ($this->usuarioLogado()) {
			$id = $this->usuarioLogado()->id;
			$cli = $this->clienteModel->withDeleted(true)->where('usuario_id', $id)->first();
			//$cliente = $this->buscaclienteOu404($cli->id);
			$card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();
		} else {
			$id = null;
		}


		$items = $this->ticketModel->recuperaIngressosPucPorEvento($event_id);


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


		return view('Carrinho/puc', $data);
	}

	
	/**
	 * Valida um cupom de desconto via AJAX
	 * POST /carrinho/validar
	 *
	 * @return \CodeIgniter\HTTP\Response JSON response
	 */
	public function validar()
	{
		// Verifica se é requisição AJAX
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Prepara resposta com novo token CSRF
		$retorno = ['token' => csrf_hash()];

		// Recupera parâmetros do POST
		$codigo = $this->request->getPost('codigo');
		$eventoId = $this->request->getPost('evento_id') ? (int) $this->request->getPost('evento_id') : null;
		$userId = $this->request->getPost('user_id') ? (int) $this->request->getPost('user_id') : null;
		$valorPedido = $this->request->getPost('valor_pedido') ? (float) $this->request->getPost('valor_pedido') : null;

		// Valida se código foi informado
		if (empty($codigo)) {
			$retorno['erro'] = 'Digite um código de cupom.';
			return $this->response->setJSON($retorno);
		}

		// Converte para maiúsculas e remove espaços
		$codigo = strtoupper(trim($codigo));

		// Valida o cupom
		$resultado = $this->cupomModel->validarCupom($codigo, $eventoId, $userId, $valorPedido);

		if (!$resultado['valido']) {
			$retorno['erro'] = $resultado['erro'];
			return $this->response->setJSON($retorno);
		}

		// Cupom válido - calcula desconto
		$cupom = $resultado['cupom'];
		$valorDesconto = 0;
		$valorFinal = $valorPedido ?? 0;

		if ($valorPedido) {
			$valorDesconto = $this->cupomModel->calcularDesconto($cupom, $valorPedido);
			$valorFinal = $valorPedido - $valorDesconto;
		}

		// Armazena cupom na sessão
		$session = session();
		$session->set('cupom_id', $cupom->id);
		$session->set('cupom_codigo', $cupom->codigo);
		$session->set('cupom_desconto', $valorDesconto);

		// Monta resposta de sucesso
		$retorno['sucesso'] = 'Cupom válido!';
		$retorno['cupom'] = [
			'id' => $cupom->id,
			'codigo' => $cupom->codigo,
			'nome' => $cupom->nome,
			'desconto_formatado' => $cupom->getDescontoFormatado(),
			'valor_desconto' => $valorDesconto,
			'valor_desconto_formatado' => 'R$ ' . number_format($valorDesconto, 2, ',', '.'),
			'valor_final' => $valorFinal,
			'valor_final_formatado' => 'R$ ' . number_format($valorFinal, 2, ',', '.'),
		];

		return $this->response->setJSON($retorno);
	}

	/**
	 * Remove cupom aplicado da sessão
	 * POST /carrinho/removerCupom
	 *
	 * @return \CodeIgniter\HTTP\Response JSON response
	 */
	public function removerCupom()
	{
		// Verifica se é requisição AJAX
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Prepara resposta com novo token CSRF
		$retorno = ['token' => csrf_hash()];

		// Remove cupom da sessão
		$session = session();
		$session->remove('cupom_id');
		$session->remove('cupom_codigo');
		$session->remove('cupom_desconto');

		$retorno['sucesso'] = 'Cupom removido com sucesso.';

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
}
