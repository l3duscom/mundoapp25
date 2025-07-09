<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\Auditoria;
use App\Traits\ValidacoesTrait;

class Clientes extends BaseController
{
    use ValidacoesTrait;

    private $clienteModel;
    private $usuarioModel;
    private $grupoUsuarioModel;
    private $auditoriaModel;
    private $cartaoModel;
    private $ingressoModel;
    private $pedidoModel;

    public function __construct()
    {
        $this->clienteModel = new \App\Models\ClienteModel();
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->grupoUsuarioModel = new \App\Models\GrupoUsuarioModel();
        $this->auditoriaModel = new \App\Models\AuditoriaModel();
        $this->cartaoModel = new \App\Models\CartaoModel();
        $this->ingressoModel = new \App\Models\IngressoModel();
        $this->pedidoModel = new \App\Models\PedidoModel();
    }

    public function index()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $data = [
            'titulo' => 'Listando os clientes',
        ];

        return view('Clientes/index', $data);
    }

    public function recuperaClientes()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = [
            'clientes.id',
            'clientes.nome',
            'clientes.cpf',
            'clientes.email',
            'clientes.telefone',
            'clientes.deleted_at',
            'grupos_usuarios.grupo_id'
        ];

        $clientes = $this->clienteModel->select($atributos)
            ->distinct('clientes.id')
            ->withDeleted(true)
            ->join('grupos_usuarios', 'grupos_usuarios.usuario_id = clientes.usuario_id')
            ->orderBy('id', 'DESC')
            ->find();

        // Receberá o array de objetos de clientes
        $data = [];

        foreach ($clientes as $cliente) {
            $data[] = [
                'nome' => anchor("clientes/exibir/$cliente->id", $cliente->grupo_id == 3 ? esc($cliente->nome) . ' ' . '<i class="lni lni-crown" style="color: #ffd700"></i>' : esc($cliente->nome), 'title="Exibir cliente ' . esc($cliente->nome) . ' "'),
                //'nome' => $cliente->grupo_id == 3 ? $cliente->grupo_id : $cliente->grupo_id,
                'cpf' => esc($cliente->cpf),
                'email' => esc($cliente->email),
                'telefone' => esc($cliente->telefone),
                'situacao' => $cliente->exibeSituacao(),
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('criar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = new Cliente();

        $this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Criando novo cliente',
            'cliente' => $cliente,
        ];

        return view('Clientes/criar', $data);
    }

    public function add()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('criar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = new Cliente();

        $this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Criando novo membro',
            'cliente' => $cliente,
        ];

        return view('Clientes/add', $data);
    }

    public function addinfluencer()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('criar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = new Cliente();

        $this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Criando novo membro',
            'cliente' => $cliente,
        ];

        return view('Clientes/addinfluencer', $data);
    }

    public function cadastrar(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        if (session()->get('blockEmail') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um E-mail com domínio válido'];

            return $this->response->setJSON($retorno);
        }

        if (session()->get('blockCep') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um CEP válido'];

            return $this->response->setJSON($retorno);
        }

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $cliente = new Cliente($post);

        if ($this->clienteModel->save($cliente)) {

            // Cria usuario do cliente
            $this->criaUsuarioParaCliente($cliente);

            // Envia dados de acesso ao clente
            $this->enviaEmailCriacaoEmailAcesso($cliente);

            $btnCriar = anchor("clientes/criar", 'Cadastrar novo cliente', ['class' => 'btn btn-danger mt-2']);

            session()->setFlashdata('sucesso', "Dados salvos com sucesso!<br><br>Importante: informe ao cliente os dados de acesso ao sistema: <p>E-mail: $cliente->email <p><p>Senha inicial: 123456</p> Esses mesmos dados foram enviados para o e-mail do cliente.<br> $btnCriar");

            $retorno['id'] = $this->clienteModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->clienteModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function cadastrarMembro(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        if (session()->get('blockEmail') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um E-mail com domínio válido'];

            return $this->response->setJSON($retorno);
        }

        if (session()->get('blockCep') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um CEP válido'];

            return $this->response->setJSON($retorno);
        }

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $cliente = new Cliente($post);

        if ($this->clienteModel->save($cliente)) {

            // Cria usuario do cliente
            $this->criaUsuarioParaMembro($cliente);

            // Envia dados de acesso ao clente
            $this->enviaEmailCriacaoMembroAcesso($cliente);

            $btnCriar = anchor("clientes/add", 'Cadastrar novo membro', ['class' => 'btn btn-danger mt-2']);

            session()->setFlashdata('sucesso', "Dados salvos com sucesso!<br><br>Importante: informe ao cliente os dados de acesso ao sistema: <p>E-mail: $cliente->email <p><p>Senha inicial: 123456</p> Esses mesmos dados foram enviados para o e-mail do cliente.<br> $btnCriar");

            $retorno['id'] = $this->clienteModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->clienteModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function cadastrarInfluencer(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        if (session()->get('blockEmail') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um E-mail com domínio válido'];

            return $this->response->setJSON($retorno);
        }

        if (session()->get('blockCep') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um CEP válido'];

            return $this->response->setJSON($retorno);
        }

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $cliente = new Cliente($post);

        if ($this->clienteModel->save($cliente)) {

            // Cria usuario do cliente
            $this->criaUsuarioParaInfluencer($cliente);

            // Envia dados de acesso ao clente
            $this->enviaEmailCriacaoInfluencerAcesso($cliente);

            $btnCriar = anchor("clientes/addinfluencer", 'Cadastrar novo influencer', ['class' => 'btn btn-danger mt-2']);

            session()->setFlashdata('sucesso', "Dados salvos com sucesso!<br><br>Importante: informe ao cliente os dados de acesso ao sistema: <p>E-mail: $cliente->email <p><p>Senha inicial: 123456</p> Esses mesmos dados foram enviados para o e-mail do cliente.<br> $btnCriar");

            $retorno['id'] = $this->clienteModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->clienteModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function exibir(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaclienteOu404($id);

        $data = [
            'titulo' => 'Exibindo o cliente ' . esc($cliente->nome),
            'cliente' => $cliente,
        ];

        return view('Clientes/exibir', $data);
    }

    public function editar(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaclienteOu404($id);

        $this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando o cliente ' . esc($cliente->nome),
            'cliente' => $cliente,
        ];

        return view('Clientes/editar', $data);
    }

    public function atualizar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $cliente = $this->buscaclienteOu404($post['id']);

        if (session()->get('blockEmail') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um E-mail com domínio válido'];

            return $this->response->setJSON($retorno);
        }

        if (session()->get('blockCep') === true) {
            $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
            $retorno['erros_model'] = ['cep' => 'Informe um CEP válido'];

            return $this->response->setJSON($retorno);
        }

        $cliente->fill($post);

        if ($cliente->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->clienteModel->save($cliente)) {
            if ($cliente->hasChanged('email')) {
                $this->usuarioModel->atualizaEmailDoCliente($cliente->usuario_id, $cliente->email);

                $this->enviaEmailAlteracaoEmailAcesso($cliente);

                session()->setFlashdata('sucesso', 'Dados salvos com sucesso!<br><br>Importante: informe ao cliente o novo e-mail de acesso ao sistema: <p>E-mail: ' . $cliente->email . '<p> Um e-mail de notificação foi enviado para o cliente');

                return $this->response->setJSON($retorno);
            }

            // Não houve alteração no e-mail

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->clienteModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function consultaCep()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $cep = $this->request->getGet('cep');

        return $this->response->setJSON($this->consultaViaCep($cep));
    }

    public function consultaEmail()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $email = $this->request->getGet('email');

        // Cuidado para não deixar o bypass ativado (true)
        return $this->response->setJSON($this->checkEmail($email, true));
    }

    public function historico(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaclienteOu404($id);

        $data = [
            'titulo' => 'Histórico de atendimento do cliente ' . esc($cliente->nome),
            'cliente' => $cliente,
        ];

        $ordemModel = new \App\Models\OrdemModel();

        $ordensCliente = $ordemModel->where('cliente_id', $cliente->id)->orderBy('ordens.id', 'DESC')->paginate(5);

        if ($ordensCliente != null) {

            $data['ordensCliente'] = $ordensCliente;
            $data['pager'] = $ordemModel->pager;
        }

        return view('Clientes/historico', $data);
    }

    public function excluir(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('excluir-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaClienteOu404($id);

        if ($cliente->deleted_at != null) {
            return redirect()->back()->with('info', "Cliente $cliente->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->clienteModel->delete($id);

            return redirect()->to(site_url("clientes"))->with('sucesso', "Cliente $cliente->nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o cliente " . esc($cliente->nome),
            'cliente' => $cliente,
        ];

        return view('Clientes/excluir', $data);
    }

    public function desfazerExclusao(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaClienteOu404($id);

        if ($cliente->deleted_at === null) {
            return redirect()->back()->with('info', "Apenas clientes excluídos podem ser recuperados");
        }

        $cliente->deleted_at = null;
        $this->clienteModel->protect(false)->save($cliente);

        return redirect()->back()->with('sucesso', "Cliente $cliente->nome recuperado com sucesso!");
    }

    /*--------------------------------Método privados-------------------------*/

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

    /**
     * Método que envia o e-mail para o cliente informando a alteração no e-mail de acesso.
     *
     * @param object $usuario
     * @return void
     */
    private function enviaEmailCriacaoEmailAcesso(object $cliente): void
    {
        $log = [
            'acao' => 'Envio de email',
            'descricao' => 'Cliente | ' . $cliente->nome . ' | ' . $cliente->email . ' criado automaticamente via importação CSV'
        ];
        $this->auditoriaModel->skipValidation(true)->protect(false)->insert($log);

        $email = service('email');

        $email->setFrom(env('email.fromEmail'), env('email.fromName'));

        $email->setTo($cliente->email);

        $email->setCC('relacionamento@mundodream.com.br');

        $email->setSubject('Seja bem-vindo(a) ao MundoDream!');

        $data = [
            'cliente' => $cliente,
        ];

        $mensagem = view('Clientes/email_dados_acesso', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    private function enviaEmailMigracao(object $cliente): void
    {
        $log = [
            'acao' => 'Envio de email',
            'descricao' => 'Cliente | ' . $cliente->nome . ' | ' . $cliente->email . ' criado automaticamente via importação CSV'
        ];
        $this->auditoriaModel->skipValidation(true)->protect(false)->insert($log);

        $email = service('email');

        $email->setFrom(env('email.fromEmail'), env('email.fromName'));

        $email->setTo($cliente->email);

        //$email->setCC('relacionamento@mundodream.com.br');

        $email->setSubject('Seja bem-vindo(a) ao MundoDream!');

        $data = [
            'cliente' => $cliente,
        ];

        $mensagem = view('Clientes/email_migracao', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    private function enviaEmailCriacaoMembroAcesso(object $cliente): void
    {
        $email = service('email');

        $email->setFrom(env('email.fromEmail'), env('email.fromName'));

        $email->setTo($cliente->email);

        $email->setCC('relacionamento@mundodream.com.br');

        $email->setSubject('Dreamclub | Dados de acesso ao sistema');

        $data = [
            'cliente' => $cliente,
        ];

        $mensagem = view('Clientes/email_dados_acesso_membro', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    private function enviaEmailCriacaoInfluencerAcesso(object $cliente): void
    {
        $email = service('email');

        $email->setFrom(env('email.fromEmail'), env('email.fromName'));

        $email->setTo($cliente->email);

        $email->setCC('relacionamento@mundodream.com.br');

        $email->setSubject('Dados de acesso ao Mundo Dream para Influencers');

        $data = [
            'cliente' => $cliente,
        ];

        $mensagem = view('Clientes/email_dados_acesso_influencer', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    /**
     * Método que envia o e-mail para o cliente informando a alteração no e-mail de acesso.
     *
     * @param object $usuario
     * @return void
     */
    private function enviaEmailAlteracaoEmailAcesso(object $cliente): void
    {
        $email = service('email');

        $email->setFrom(env('email.fromEmail'), env('email.fromName'));

        $email->setTo($cliente->email);

        $email->setSubject('E-mail de acesso ao sistema foi alterado');

        $data = [
            'cliente' => $cliente,
        ];

        $mensagem = view('Clientes/email_acesso_alterado', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    /**
     * Remove da sessão os dados de bloqueio de CEP e E-mail das requisições anterioes
     *
     * @return void
     */
    private function removeBlockCepEmailSessao(): void
    {
        session()->remove('blockCep');
        session()->remove('blockEmail');
    }

    /**
     * Método que cria o usuário para o cliente recém cadastrado
     *
     * @param object $cliente
     * @return void
     */
    private function criaUsuarioParaCliente(object $cliente): void
    {

        // Montamos os dados do usuário do cliente
        $usuario = [
            'nome' => $cliente->nome,
            'email' => $cliente->email,
            'password' => '123456',
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
    }

    private function criaUsuarioParaMembro(object $cliente): void
    {

        // Montamos os dados do usuário do cliente
        $usuario = [
            'nome' => $cliente->nome,
            'email' => $cliente->email,
            'password' => '123456',
            'ativo' => true,
        ];

        // Criamos o usuário do cliente
        $this->usuarioModel->skipValidation(true)->protect(false)->insert($usuario);

        // Montamos os dados do grupo que o usuário fará parte
        $grupoUsuario = [
            'grupo_id' => 2, // Grupo de clientes.... lembrem que esse ID jamais deverá ser alterado ou removido.
            'usuario_id' => $this->usuarioModel->getInsertID(),
        ];

        $ativaPremium = [
            'grupo_id' => 3, // Grupo de clientes.... lembrem que esse ID jamais deverá ser alterado ou removido.
            'usuario_id' => $this->usuarioModel->getInsertID(),
        ];

        // Inserimos o usuário no grupo de clientes
        $this->grupoUsuarioModel->protect(false)->insert($grupoUsuario);
        $this->grupoUsuarioModel->protect(false)->insert($ativaPremium);

        // Atualizamos a tabela de clientes com o ID do usuário criado
        $this->clienteModel
            ->protect(false)
            ->where('id', $this->clienteModel->getInsertID())
            ->set('usuario_id', $this->usuarioModel->getInsertID())
            ->update();
    }

    private function criaUsuarioParaInfluencer(object $cliente): void
    {

        // Montamos os dados do usuário do cliente
        $usuario = [
            'nome' => $cliente->nome,
            'email' => $cliente->email,
            'password' => '123456',
            'ativo' => true,
        ];

        // Criamos o usuário do cliente
        $this->usuarioModel->skipValidation(true)->protect(false)->insert($usuario);

        // Montamos os dados do grupo que o usuário fará parte
        $grupoUsuario = [
            'grupo_id' => 2, // Grupo de clientes.... lembrem que esse ID jamais deverá ser alterado ou removido.
            'usuario_id' => $this->usuarioModel->getInsertID(),
        ];

        $ativaInfluencer = [
            'grupo_id' => 5, // Grupo de influencer.... lembrem que esse ID jamais deverá ser alterado ou removido.
            'usuario_id' => $this->usuarioModel->getInsertID(),
        ];

        // Inserimos o usuário no grupo de clientes
        $this->grupoUsuarioModel->protect(false)->insert($grupoUsuario);
        $this->grupoUsuarioModel->protect(false)->insert($ativaInfluencer);

        // Atualizamos a tabela de clientes com o ID do usuário criado
        $this->clienteModel
            ->protect(false)
            ->where('id', $this->clienteModel->getInsertID())
            ->set('usuario_id', $this->usuarioModel->getInsertID())
            ->update();
    }

    public function importar()
    {

        $data = [
            'titulo' => "importar CSV ",

        ];


        return view('Clientes/importar_csv', $data);
    }

    public function importCsv()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('Home/index', $data);
        } else {
            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/" . $newName, "r");
                    $csv = fopen("../public/csvfile/" . $newName, "r");
                    $i = 0;
                    $numberOfFields = 11;
                    $csvArr = array();
                    $mes = null;
                    $ano = null;




                    $post = $this->request->getPost();
                    $declaration = [

                        'type' => 'dici-scm',

                        'status' => $post['status'],
                    ];


                    $user_id = usuario_logado()->id;




                    while (($filedata = fgetcsv($csv, 1000, ";")) !== FALSE) {
                        //$num = count($filedata);
                        if ($i >= 1) {
                            $csvArr[$i]['email'] = $filedata[0];
                            $csvArr[$i]['nome'] = $filedata[1];
                        }

                        $i++;
                    }

                    fclose($file);
                    $count = 0;

                    foreach ($csvArr as $data) {
                        $email_cliente = $this->clienteModel->select('email')
                            ->where('email', $data['email'])
                            ->first();


                        if (!$email_cliente) {

                            sleep(3);

                            $cliente = new Cliente($data);

                            $this->clienteModel->skipValidation(true)->protect(false)->insert($cliente);

                            // Cria usuario do cliente
                            $this->criaUsuarioParaCliente($cliente);


                            // Envia dados de acesso ao clente
                            $this->enviaEmailMigracao($cliente);

                            //cria log
                            $cliente_email_importado = $data['email'];
                            $cliente_nome_importado = $data['nome'];
                            $log = [
                                'user_id' => $user_id, // Grupo de clientes.... lembrem que esse ID jamais deverá ser alterado ou removido.
                                'acao' => 'Criação de cliente',
                                'descricao' => 'Cliente | ' . $cliente_nome_importado . ' | ' . $cliente_email_importado . ' criado automaticamente via importação CSV'
                            ];
                            $this->auditoriaModel->skipValidation(true)->protect(false)->insert($log);


                            $count++;
                        }
                    }

                    session()->setFlashdata('message', $count . ' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    session()->setFlashdata('message', 'CSV file coud not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            } else {
                session()->setFlashdata('message', 'CSV file coud not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        //Sreturn $this->response->setJSON($declaration);
        return redirect()->to(site_url("clientes"))->with('sucesso', "clientes importados com sucesso!");
    }

    public function dashboard(int $id = null)
    {

        //$id = $this->usuarioLogado()->id;

        //$convite = $this->usuarioLogado()->codigo;



        $cliente = $this->buscaclienteOu404($id);



        $usuario = $this->usuarioModel->withDeleted(true)->where('id', $cliente->usuario_id)->first();
        $convite = $usuario->codigo;


        $indicacoes = $this->pedidoModel->where('convite', $convite)->whereIn('status', ['CONFIRMED', 'RECEIVED', 'paid'])->countAllResults();

        $card = $this->cartaoModel->withDeleted(true)->where('user_id', $id)->first();

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
            'indicacoes' => $indicacoes
        ];


        return view('Console/dashboard', $data);
    }
}
