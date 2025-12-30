<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
	public function novo()
	{
		// Buscar próximos eventos ativos
		$eventoModel = new \App\Models\EventoModel();
		$eventos = $eventoModel
			->where('ativo', 1)
			->where('data_inicio >=', date('Y-m-d'))
			->orderBy('data_inicio', 'ASC')
			->limit(6)
			->findAll();

		// Buscar cupons de desconto ativos
		$cupomModel = new \App\Models\CupomModel();
		$cupons = $cupomModel
			->where('ativo', 1)
			->where('(data_fim IS NULL OR data_fim >= "' . date('Y-m-d') . '")')
			->orderBy('desconto', 'DESC')
			->limit(4)
			->findAll();

		// Backgrounds aleatórios locais
		$backgrounds = [
			site_url('recursos/theme/images/login/1.JPG'),
			site_url('recursos/theme/images/login/2.JPG'),
			site_url('recursos/theme/images/login/3.JPG'),
			site_url('recursos/theme/images/login/4.JPG'),
			site_url('recursos/theme/images/login/5.JPG'),
			site_url('recursos/theme/images/login/6.JPG'),
			site_url('recursos/theme/images/login/7.JPG'),
			site_url('recursos/theme/images/login/8.JPG'),
		];
		$backgroundAleatorio = $backgrounds[array_rand($backgrounds)];

		$data = [
			'titulo' => 'Acesse sua conta',
			'eventos' => $eventos,
			'cupons' => $cupons,
			'background' => $backgroundAleatorio,
		];

		return view('Login/novo', $data);
	}


	public function criar()
	{
		if (!$this->request->isAJAX()) {
			return redirect()->back();
		}

		// Envio o hash do token do form
		$retorno['token'] = csrf_hash();

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		// Recuperando a instância do serviço autenticacao
		$autenticacao = service('autenticacao');


		if ($autenticacao->login($email, $password) === false) {

			// Credenciais inválidas

			$retorno['erro'] = 'Por favor verifique os abaixo e tente novamente';
			$retorno['erros_model'] = ['credenciais' => 'Não encontramos suas credenciais de acesso'];
			return $this->response->setJSON($retorno);
		}


		//$this->registraAcaoDoUsuario('Logou na aplicação');


		// Credenciais validadas

		// Recupero o usuário logado
		$usuarioLogado = $autenticacao->pegaUsuarioLogado();

		//session()->setFlashdata('sucesso', "Olá $usuarioLogado->nome, que bom que está de volta!");


		if ($usuarioLogado->is_cliente) {

			$retorno['redirect'] = 'console/dashboard';
			return $this->response->setJSON($retorno);
		}


		// Aqui é um usuário normal.

		$retorno['redirect'] = 'home';
		return $this->response->setJSON($retorno);
	}


	public function logout()
	{

		// Recuperando a instância do serviço autenticacao
		$autenticacao = service('autenticacao');

		$usuarioLogado = $autenticacao->pegaUsuarioLogado();

		$autenticacao->logout();

		return redirect()->to(site_url("login/mostramensagemlogout/$usuarioLogado->nome"));
	}


	public function mostraMensagemLogout($nome = null)
	{

		return redirect()->to(site_url("login"))->with("sucesso", "$nome, esperamos ver você novamente!");
	}
}
