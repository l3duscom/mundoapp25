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


    public function criar()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('criar-eventos')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $evento = new EventoEntity();

        $data = [
            'titulo' => 'Criar evento presencial',
            'evento' => $evento,
        ];

        return view('Eventos/criar', $data);
    }



    public function cadastrar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();




        // Recupero o post da requisição
        $post = $this->request->getPost();


        $EventoEntity = new EventoEntity($post);






        if ($this->eventoModel->save($EventoEntity)) {
            $btnCriar = anchor("eventos/criar", 'Cadastrar novo evento', ['class' => 'btn btn-danger mt-2']);

            session()->setFlashdata('sucesso', "Dados salvos com sucesso!<br> $btnCriar");

            // Retornamos o último ID inserido na tabela de usuarios
            //Ou seja, o ID do usuário recém criado
            $retorno['id'] = $this->eventoModel->getInsertID();


            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os abaixo e tente novamente';
        $retorno['erros_model'] = $this->eventoModel->errors();


        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }
}
