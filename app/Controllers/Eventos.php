<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\EventoEntity;
use App\Traits\ValidacoesTrait;

class Eventos extends BaseController
{
    use ValidacoesTrait;

    private $eventoModel;

    public function __construct()
    {
        $this->eventoModel = new \App\Models\EventoModel();
    }

    public function index()
    {
        if (!$this->usuarioLogado()->temPermissaoPara('listar-eventos')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $data = [
            'titulo' => 'Listando eventos',
        ];

        return view('Eventos/index', $data);
    }

    public function recuperaEventos()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = [
            'eventos.id',
            'eventos.nome',
            'eventos.data_inicio',
            'eventos.data_fim',
            'eventos.categoria',
            'eventos.ativo',
            'eventos.deleted_at',
            'usuarios.nome as responsavel'
        ];

            $eventos = $this->eventoModel
            ->select($atributos)
            ->join('usuarios', 'usuarios.id = eventos.user_id')
            ->withDeleted(true)
            ->orderBy('ISNULL(eventos.deleted_at)', 'ASC') // Eventos não excluídos primeiro
            ->orderBy('eventos.ativo', 'DESC')             // Ativos primeiro
            ->orderBy('eventos.id', 'DESC')                // Mais recentes primeiro
            ->find();


        // Receberá o array de objetos de eventos
        $data = [];

        foreach ($eventos as $evento) {
            $data[] = [
                'nome' => anchor("eventos/exibir/$evento->id", esc($evento->nome), 'title="Exibir evento ' . esc($evento->nome) . ' "'),
                'data_inicio' => $evento->data_inicio ? date('d/m/Y', strtotime($evento->data_inicio)) : '-',
                'data_fim' => $evento->data_fim ? date('d/m/Y', strtotime($evento->data_fim)) : '-',
                'categoria' => esc($evento->categoria ?? '-'),
                'responsavel' => esc($evento->responsavel),
                'situacao' => $evento->exibeSituacao(),
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar()
    {
        if (!$this->usuarioLogado()->temPermissaoPara('criar-eventos')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $evento = new EventoEntity();

        $data = [
            'titulo' => 'Criar novo evento',
            'evento' => $evento,
        ];

        return view('Eventos/criar', $data);
    }

    public function cadastrar()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        if (!empty($post['data_inicio'])) {
            $post['data_inicio'] = date('Y-m-d', strtotime(str_replace('/', '-', $post['data_inicio'])));
        }
        if (!empty($post['data_fim'])) {
            $post['data_fim'] = date('Y-m-d', strtotime(str_replace('/', '-', $post['data_fim'])));
        }

        $evento = new EventoEntity($post);

        if ($this->eventoModel->save($evento)) {
            $id = $this->eventoModel->getInsertID();
            session()->setFlashdata('sucesso', 'Evento salvo com sucesso!');
            return redirect()->to(site_url('eventos/exibir/' . $id));
        }

        // Retornamos os erros de validação
        return redirect()->back()->withInput()->with('erros_model', $this->eventoModel->errors());
    }

    public function exibir(int $id = null)
    {
        if (!$this->usuarioLogado()->temPermissaoPara('listar-eventos')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $evento = $this->buscaEventoOu404($id);

        $data = [
            'titulo' => 'Exibindo o evento ' . esc($evento->nome),
            'evento' => $evento,
        ];

        return view('Eventos/exibir', $data);
    }

    public function editar(int $id = null)
    {
        if (!$this->usuarioLogado()->temPermissaoPara('editar-eventos')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $evento = $this->buscaEventoOu404($id);

        $data = [
            'titulo' => 'Editando o evento ' . esc($evento->nome),
            'evento' => $evento,
        ];

        return view('Eventos/editar', $data);
    }

    public function atualizar()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $post = $this->request->getPost();

        if (!empty($post['data_inicio'])) {
            $post['data_inicio'] = date('Y-m-d', strtotime(str_replace('/', '-', $post['data_inicio'])));
        }
        if (!empty($post['data_fim'])) {
            $post['data_fim'] = date('Y-m-d', strtotime(str_replace('/', '-', $post['data_fim'])));
        }

        $evento = $this->buscaEventoOu404($post['id']);
        $evento->fill($post);

        if ($evento->hasChanged() === false) {
            session()->setFlashdata('info', 'Não há dados para atualizar');
            return redirect()->to(site_url('eventos/exibir/' . $evento->id));
        }

        if ($this->eventoModel->save($evento)) {
            session()->setFlashdata('sucesso', 'Evento atualizado com sucesso!');
            return redirect()->to(site_url('eventos/exibir/' . $evento->id));
        }

        // Retornamos os erros de validação
        return redirect()->back()->withInput()->with('erros_model', $this->eventoModel->errors());
    }


    public function excluir(int $id = null)
    {
        if (!$this->usuarioLogado()->temPermissaoPara('excluir-eventos')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $evento = $this->buscaEventoOu404($id);

        if ($evento->deleted_at != null) {
            return redirect()->back()->with('info', "Evento $evento->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->eventoModel->delete($id);

            return redirect()->to(site_url("eventos"))->with('sucesso', "Evento $evento->nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o evento " . esc($evento->nome),
            'evento' => $evento,
        ];

        return view('Eventos/excluir', $data);
    }

    public function desfazerExclusao(int $id = null)
    {
        if (!$this->usuarioLogado()->temPermissaoPara('editar-eventos')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $evento = $this->buscaEventoOu404($id);

        if ($evento->deleted_at === null) {
            return redirect()->back()->with('info', "Apenas eventos excluídos podem ser recuperados");
        }

        $evento->deleted_at = null;
        $this->eventoModel->protect(false)->save($evento);

        return redirect()->back()->with('sucesso', "Evento $evento->nome recuperado com sucesso!");
    }

   

    public function consultaCep()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $cep = $this->request->getGet('cep');

        return $this->response->setJSON($this->consultaViaCep($cep));
    }

    /*--------------------------------Método privados-------------------------*/

    /**
     * Método que recupera o evento
     *
     * @param integer $id
     * @return Exceptions|object
     */
    private function buscaEventoOu404(int $id)
    {
        if (!$id || !$evento = $this->eventoModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o evento $id");
        }

        return $evento;
    }
}
