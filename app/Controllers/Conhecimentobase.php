<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Conhecimento;
use App\Entities\ConhecimentoCategoria;

class Conhecimentobase extends BaseController
{

    private $conhecimentoModel;
    private $ConhecimentoCategoriaModel;

    public function __construct()
    {
        $this->conhecimentoModel = new \App\Models\ConhecimentoModel();
        $this->ConhecimentoCategoriaModel = new \App\Models\ConhecimentoCategoriaModel();
    }

    public function index()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $data = [
            'titulo' => 'Central de Ajuda',
        ];

        return view('Conhecimento/index', $data);
    }

    public function ajuda()
    {
        $conhecimentos = $this->conhecimentoModel->recuperaConhecimentos();

        $data = [
            'titulo' => 'Central de Ajuda',
            'conhecimentos' => $conhecimentos
        ];

        return view('Conhecimento/ajuda', $data);
    }

    public function recuperaConhecimentos()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = [
            'conhecimento.id',
            'conhecimento.titulo',
            'conhecimento_categoria.titulo as categoria_titulo'
        ];

        //$categorias = $this->ConhecimentoCategoriaModel->selectCategorias();

        $conhecimentos = $this->conhecimentoModel->select($atributos)
            ->join('conhecimento_categoria', 'conhecimento_categoria.id = conhecimento.categoria_id')
            ->orderBy('id', 'DESC')
            ->findAll();

        // Receberá o array de objetos de clientes
        $data = [];

        foreach ($conhecimentos as $conhecimento) {
            $data[] = [
                'titulo' => anchor("conhecimentobase/editar/$conhecimento->id", esc($conhecimento->titulo), 'title="Exibir conhecimento ' . esc($conhecimento->titulo) . ' "'),
                'categoria' => esc($conhecimento->categoria_titulo),

            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('criar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $conhecimento = new Conhecimento();

        //$this->removeBlockCepEmailSessao();
        $categorias = $this->ConhecimentoCategoriaModel->selectCategorias();
        $data = [
            'titulo' => 'Criando novo conhecimento',
            'conhecimento' => $conhecimento,
            'categorias' => $categorias,
        ];

        return view('Conhecimento/criar', $data);
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

        $conhecimento = new Conhecimento($post);

        if ($this->conhecimentoModel->save($conhecimento)) {

            // Não houve alteração no e-mail

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }



        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }



    public function editar(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $conhecimento = $this->buscaconhecimentoOu404($id);
        $categorias = $this->ConhecimentoCategoriaModel->selectCategorias();
        $data = [
            'titulo' => 'Editando o conhecimento ' . esc($conhecimento->titulo),
            'conhecimento' => $conhecimento,
            'categorias' => $categorias,
        ];

        return view('Conhecimento/editar', $data);
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



        $conhecimento = $this->buscaconhecimentoOu404($post['id']);




        if (empty($post['categoria_id'])) {
            unset($post['categoria_id']);
        }

        $conhecimento->fill($post);

        if ($conhecimento->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->conhecimentoModel->save($conhecimento)) {

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





    public function excluir(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('excluir-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $conhecimento = $this->buscaconhecimentoOu404($id);

        if ($conhecimento->deleted_at != null) {
            return redirect()->back()->with('info', "Conhecimento $conhecimento->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->conhecimentoModel->delete($id);

            return redirect()->to(site_url("conhecimentobase"))->with('sucesso', "Conhecimento $conhecimento->titulo excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o conhecimento " . esc($conhecimento->nome),
            'conhecimento' => $conhecimento,
        ];

        return view('Conhecimento/excluir', $data);
    }



    /*--------------------------------Método privados-------------------------*/

    /**
     * Método que recupera o cliente
     *
     * @param integer $id
     * @return Exceptions|object
     */
    private function buscaconhecimentoOu404(int $id = null)
    {
        if (!$id || !$conhecimento = $this->conhecimentoModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o conhecimento $id");
        }

        return $conhecimento;
    }
}
