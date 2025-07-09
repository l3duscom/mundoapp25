<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Cliente;
use App\Entities\DiciScm;
use App\Entities\Fust;
use App\Entities\DiciTvpa;
use App\Entities\DiciStfc;
use App\Entities\DiciScmTrimestral;
use App\Entities\DiciScmAnualEstacoes;
use App\Entities\DiciScmAnualEnlacesViaSatelite;
use App\Entities\DiciScmAnualEnlacesProprios;
use App\Entities\DiciScmAnualEnlacesContratados;
use App\Entities\Declaration;
use App\Traits\ValidacoesTrait;

class Declarations extends BaseController
{
    use ValidacoesTrait;

    private $clienteModel;
    private $usuarioModel;
    private $grupoUsuarioModel;
    private $declarationModel;
    private $estadoModel;
    private $diciScmModel;
    private $diciTvpaModel;
    private $diciStfcModel;
    private $diciScmTrimestralModel;
    private $DiciScmAnualEstacoesModel;
    private $DiciScmAnualEnlacesViaSateliteModel;
    private $DiciScmAnualEnlacesPropriosModel;
    private $DiciScmAnualEnlacesContratadosModel;
    private $notificationsModel;
    private $fustModel;

    public function __construct()
    {
        $this->clienteModel = new \App\Models\ClienteModel();
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->grupoUsuarioModel = new \App\Models\GrupoUsuarioModel();
        $this->declarationModel = new \App\Models\DeclarationModel();
        $this->estadoModel = new \App\Models\EstadoModel();
        $this->diciScmModel = new \App\Models\DiciScmModel();
        $this->diciTvpaModel = new \App\Models\DiciTvpaModel();
        $this->diciStfcModel = new \App\Models\DiciStfcModel();
        $this->diciScmTrimestralModel = new \App\Models\DiciScmTrimestralModel();
        $this->DiciScmAnualEstacoesModel = new \App\Models\DiciScmAnualEstacoesModel();
        $this->DiciScmAnualEnlacesViaSateliteModel = new \App\Models\DiciScmAnualEnlacesViaSateliteModel();
        $this->DiciScmAnualEnlacesPropriosModel = new \App\Models\DiciScmAnualEnlacesPropriosModel();
        $this->DiciScmAnualEnlacesContratadosModel = new \App\Models\DiciScmAnualEnlacesContratadosModel();
        $this->notificationsModel = new \App\Models\NotificationsModel();
        $this->fustModel = new \App\Models\FustModel();
    }

    public function index()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-declaracoes')) {

            $this->registraAcaoDoUsuario('tentou listar as suas declarações');

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $data = [
            'titulo' => 'Declarações',
        ];

        return view('Declarations/index', $data);
    }

    public function minhas()
    {

        $data = [
            'titulo' => 'Minhas declarações',
        ];

        return view('console/dashboard', $data);
    }

    public function recuperaDeclaracoes()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        $declarations = $this->declarationModel->recuperaDeclaracoes();

        // Receberá o array de objetos de ordems
        $data = [];
        $link_type = "";

        foreach ($declarations as $declaration) {
            if (esc($declaration->type) == "dici-scm") {
                $link_type = "criar_dici_scm_step_2";
            } else if (esc($declaration->type) == "dici-tvpa") {
                $link_type = "criar_dici_tvpa_step_2";
            } else if (esc($declaration->type) == "dici-stfc") {
                $link_type = "criar_dici_stfc_step_2";
            } else if (esc($declaration->type) == "dici-scm-trimestral") {
                $link_type = "criar_dici_scm_trimestral_step_2";
            } else if (esc($declaration->type) == "fust") {
                $link_type = "criar_fust_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual") {
                $link_type = "criar_dici_scm_anual_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-estacoes") {
                $link_type = "criar_dici_scm_anual_estacoes_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-via-satelite") {
                $link_type = "criar_dici_scm_anual_via_satelite_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-enlaces-proprios") {
                $link_type = "criar_dici_scm_anual_enlaces_proprios_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-enlaces-contratados") {
                $link_type = "criar_dici_scm_anual_enlaces_contratados_step_2";
            }
            $dataformatada = date("d.m.Y", strtotime($declaration->created_at));
            $data[] = [
                'nome' => $declaration->deleted_at === null ? anchor("declarations/$link_type/$declaration->id", esc($declaration->nome), 'title="Exibir Declaração ' . esc($declaration->id) . ' "') : $declaration->nome,
                'cnpj' => esc($declaration->cnpj),
                'type' => esc($declaration->type),
                'month' => esc($declaration->month),
                'status' => $declaration->exibeSituacao(),
                'created_at' => $dataformatada,

            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function recuperaDeclaracoesPorUsuario()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        $declarations = $this->declarationModel->recuperaDeclaracoesPorUsuario(usuario_logado()->id);

        // Receberá o array de objetos de ordems
        $data = [];
        $link_type = "";

        foreach ($declarations as $declaration) {
            if (esc($declaration->type) == "dici-scm") {
                $link_type = "criar_dici_scm_step_2";
            } else if (esc($declaration->type) == "dici-tvpa") {
                $link_type = "criar_dici_tvpa_step_2";
            } else if (esc($declaration->type) == "dici-stfc") {
                $link_type = "criar_dici_stfc_step_2";
            } else if (esc($declaration->type) == "dici-scm-trimestral") {
                $link_type = "criar_dici_scm_trimestral_step_2";
            } else if (esc($declaration->type) == "fust") {
                $link_type = "criar_fust_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual") {
                $link_type = "criar_dici_scm_anual_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-estacoes") {
                $link_type = "criar_dici_scm_anual_estacoes_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-via-satelite") {
                $link_type = "criar_dici_scm_anual_via_satelite_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-enlaces-proprios") {
                $link_type = "criar_dici_scm_anual_enlaces_proprios_step_2";
            } else if (esc($declaration->type) == "dici-scm-anual-enlaces-contratados") {
                $link_type = "criar_dici_scm_anual_enlaces_contratados_step_2";
            }
            $data[] = [
                'nome' => $declaration->deleted_at === null ? anchor("declarations/$link_type/$declaration->id", esc($declaration->nome), 'title="Exibir Declaração ' . esc($declaration->id) . ' "') : $declaration->nome,
                'cnpj' => esc($declaration->cnpj),
                'type' => esc($declaration->type),
                'month' => esc($declaration->month),
                'status' => $declaration->exibeSituacao(),
                'created_at' => esc($declaration->created_at->humanize()),

            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }

    public function criar_fust()
    {

        $declaration = new Declaration();

        $type = "fust";

        $declaration->code = $this->declarationModel->geraCodigoDeclaracao();

        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));



        $data = [
            'titulo' => 'Nova declaração',
            'declaration' => $declaration,
            'type' => $type,
            'client_id' => $cliente->id,
            'code' => $declaration->code
        ];

        return view('Declarations/criar_fust', $data);
    }

    public function criar_dici_scm()
    {

        $declaration = new Declaration();

        $estados = $this->estadoModel->selectEstados();

        $type = "dici-scm";

        $declaration->code = $this->declarationModel->geraCodigoDeclaracao();

        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));



        $data = [
            'titulo' => 'Nova declaração',
            'declaration' => $declaration,
            'options_estados' => $estados,
            'type' => $type,
            'client_id' => $cliente->id,
            'code' => $declaration->code
        ];

        return view('Declarations/criar_dici_scm', $data);
    }

    public function criar_dici_scm_trimestral()
    {

        $declaration = new Declaration();

        $estados = $this->estadoModel->selectEstados();

        $type = "dici-scm-trimestral";

        $declaration->code = $this->declarationModel->geraCodigoDeclaracao();

        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));



        $data = [
            'titulo' => 'Nova declaração',
            'declaration' => $declaration,
            'options_estados' => $estados,
            'type' => $type,
            'client_id' => $cliente->id,
            'code' => $declaration->code
        ];

        return view('Declarations/criar_dici_scm_trimestral', $data);
    }

    public function criar_dici_scm_anual()
    {

        $declaration = new Declaration();

        $estados = $this->estadoModel->selectEstados();

        $type = "dici-scm-anual";

        $declaration->code = $this->declarationModel->geraCodigoDeclaracao();

        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));



        $data = [
            'titulo' => 'Nova declaração',
            'declaration' => $declaration,
            'options_estados' => $estados,
            'type' => $type,
            'client_id' => $cliente->id,
            'code' => $declaration->code
        ];

        return view('Declarations/criar_dici_scm_anual', $data);
    }

    public function criar_dici_tvpa()
    {

        $declaration = new Declaration();

        $estados = $this->estadoModel->selectEstados();

        $type = "dici-tvpa";

        $declaration->code = $this->declarationModel->geraCodigoDeclaracao();

        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));



        $data = [
            'titulo' => 'Nova declaração',
            'declaration' => $declaration,
            'options_estados' => $estados,
            'type' => $type,
            'client_id' => $cliente->id,
            'code' => $declaration->code
        ];

        return view('Declarations/criar_dici_tvpa', $data);
    }

    public function criar_dici_stfc()
    {

        $declaration = new Declaration();

        $estados = $this->estadoModel->selectEstados();

        $type = "dici-stfc";

        $declaration->code = $this->declarationModel->geraCodigoDeclaracao();

        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));



        $data = [
            'titulo' => 'Nova declaração',
            'declaration' => $declaration,
            'options_estados' => $estados,
            'type' => $type,
            'client_id' => $cliente->id,
            'code' => $declaration->code
        ];

        return view('Declarations/criar_dici_stfc', $data);
    }

    public function register_fust_step_1(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Declaration($post);

        if ($this->declarationModel->save($declaration)) {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_step_1(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Declaration($post);

        if ($this->declarationModel->save($declaration)) {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_trimestral_step_1(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Declaration($post);


        if ($this->declarationModel->save($declaration)) {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();


            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_anual_step_1(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Declaration($post);


        if ($this->declarationModel->save($declaration)) {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();


            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_tvpa_step_1(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Declaration($post);

        if ($this->declarationModel->save($declaration)) {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_stfc_step_1(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Declaration($post);

        if ($this->declarationModel->save($declaration)) {
            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_fust_step_2(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new Fust($post);

        if ($this->fustModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->fustModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_step_2(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciScm($post);

        if ($this->diciScmModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->diciScmModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_trimestral_step_2(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciScmTrimestral($post);
        if ($declaration->DADO_INFORMADO == 'Receita_Operacional_Líquida_ROL') {
            $codigo = 1;
        } else if ($declaration->DADO_INFORMADO == 'Capital_Expenditure_CAPEX') {
            $codigo = 2;
        } else if ($declaration->DADO_INFORMADO == 'Tráfego_SCM_Total_MB') {
            $codigo = 3;
        }

        if ($this->diciScmTrimestralModel
            ->insert($declaration)
        ) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();
            $this->diciScmTrimestralModel
                ->protect(false)
                ->where('id', $this->diciScmTrimestralModel->getInsertID())
                ->set('CODIGO', $codigo)
                ->update();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->diciScmTrimestralModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_anual_estacoes(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciScmAnualEstacoes($post);

        if ($this->DiciScmAnualEstacoesModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->DiciScmAnualEstacoesModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_anual_enlaces_proprios(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciScmAnualEnlacesProprios($post);

        if ($this->DiciScmAnualEnlacesPropriosModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->DiciScmAnualEnlacesPropriosModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_anual_enlaces_contratados(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciScmAnualEnlacesContratados($post);

        if ($this->DiciScmAnualEnlacesContratadosModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->DiciScmAnualEnlacesContratadosModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_scm_anual_enlaces_via_satelite(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciScmAnualEnlacesViaSatelite($post);

        if ($this->DiciScmAnualEnlacesViaSateliteModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->DiciScmAnualEnlacesViaSateliteModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_tvpa_step_2(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciTvpa($post);

        if ($this->diciTvpaModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->diciTvpaModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function register_dici_stfc_step_2(int $id = null)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = new DiciStfc($post);

        if ($this->diciStfcModel->insert($declaration)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            $retorno['id'] = $this->declarationModel->getInsertID();

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->diciStfcModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function criar_fust_step_2(int $id = null)
    {
        $declaration = $this->buscaDeclaracaoOu404($id);

        $declarations = $this->fustModel->recuperaPlanosDeclaracoes($id);


        $data = [
            'titulo' => "Declaração {$declaration->Code}",
            'declaration' => $declaration,
            'declarations' => $declarations
        ];

        return view('Declarations/criar_fust_step_2', $data);
    }


    public function criar_dici_scm_step_2(int $id = null)
    {
        $declaration = $this->buscaDeclaracaoOu404($id);

        $estados = $this->estadoModel->selectEstados();

        $declarations = $this->diciScmModel->recuperaPlanosDeclaracoes($id);

        $data = [
            'titulo' => "Declaração {$declaration->Code}",
            'options_estados' => $estados,
            'declaration' => $declaration,
            'declarations' => $declarations
        ];

        return view('Declarations/criar_dici_scm_step_2', $data);
    }

    public function criar_dici_scm_trimestral_step_2(int $id = null)
    {
        $declaration = $this->buscaDeclaracaoOu404($id);

        $estados = $this->estadoModel->selectEstados();

        $declarations = $this->diciScmTrimestralModel->recuperaPlanosDeclaracoes($id);

        $data = [
            'titulo' => "Declaração {$declaration->Code}",
            'options_estados' => $estados,
            'declaration' => $declaration,
            'declarations' => $declarations
        ];

        return view('Declarations/criar_dici_scm_trimestral_step_2', $data);
    }

    public function criar_dici_scm_anual_step_2(int $id = null)
    {
        $declaration = $this->buscaDeclaracaoOu404($id);

        $estados = $this->estadoModel->selectEstados();

        $estacoes = $this->DiciScmAnualEstacoesModel->recuperaDeclaracoes($id);
        $proprios = $this->DiciScmAnualEnlacesPropriosModel->recuperaDeclaracoes($id);
        $contratados = $this->DiciScmAnualEnlacesContratadosModel->recuperaDeclaracoes($id);
        $satelites = $this->DiciScmAnualEnlacesViaSateliteModel->recuperaDeclaracoes($id);
        $declarations = $this->diciScmTrimestralModel->recuperaPlanosDeclaracoes($id);

        $data = [
            'titulo' => "Declaração {$declaration->Code}",
            'options_estados' => $estados,
            'declaration' => $declaration,
            'proprios' => $proprios,
            'contratados' => $contratados,
            'satelites' => $satelites,
            'declarations' => $declarations,
            'estacoes' => $estacoes
        ];

        return view('Declarations/criar_dici_scm_anual_step_2', $data);
    }

    public function criar_dici_tvpa_step_2(int $id = null)
    {
        $declaration = $this->buscaDeclaracaoOu404($id);


        $estados = $this->estadoModel->selectEstados();

        $declarations = $this->diciTvpaModel->recuperaPlanosDeclaracoes($id);

        $data = [
            'titulo' => "Declaração {$declaration->Code}",
            'options_estados' => $estados,
            'declaration' => $declaration,
            'declarations' => $declarations
        ];

        return view('Declarations/criar_dici_tvpa_step_2', $data);
    }

    public function criar_dici_stfc_step_2(int $id = null)
    {
        $declaration = $this->buscaDeclaracaoOu404($id);

        $estados = $this->estadoModel->selectEstados();

        $declarations = $this->diciStfcModel->recuperaPlanosDeclaracoes($id);

        $data = [
            'titulo' => "Declaração {$declaration->Code}",
            'options_estados' => $estados,
            'declaration' => $declaration,
            'declarations' => $declarations
        ];

        return view('Declarations/criar_dici_stfc_step_2', $data);
    }



    public function exibir(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaDeclaracaoOu404($id);

        $data = [
            'titulo' => 'Exibindo o cliente ' . esc($cliente->nome),
            'cliente' => $cliente,
        ];

        return view('Clientes/exibir', $data);
    }

    public function editar_fust(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);

        $data = [
            'titulo' => 'Editando declaração ' . esc($declaracao->code),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/editar_fust', $data);
    }

    public function editar_dici_scm(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando declaração ' . esc($declaracao->code),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/editar_dici_scm', $data);
    }

    public function editar_dici_scm_anual(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando declaração ' . esc($declaracao->code),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/editar_dici_scm_anual', $data);
    }

    public function editar_dici_stfc(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando declaração ' . esc($declaracao->code),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/editar_dici_stfc', $data);
    }

    public function editar_dici_tvpa(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando declaração ' . esc($declaracao->code),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/editar_dici_tvpa', $data);
    }

    public function editar_fust_plano(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $plano = $this->buscaPlanoFustOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'plano' => $plano,
        ];

        return view('Declarations/editar_fust_plano', $data);
    }

    public function editar_dici_scm_plano(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $plano = $this->buscaPlanoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_scm_plano', $data);
    }

    public function editar_dici_tvpa_plano(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $plano = $this->buscaPlanoTvpaOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_tvpa_plano', $data);
    }

    public function editar_dici_scm_trimestral_plano(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $estados = $this->estadoModel->selectEstados();


        $plano = $this->buscaPlanoScmTrimestralOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'options_estados' => $estados,
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_scm_trimestral_plano', $data);
    }

    public function editar_dici_scm_anual_estacoes(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $estados = $this->estadoModel->selectEstados();


        $plano = $this->buscaPlanoAnualEstacaoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'options_estados' => $estados,
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_scm_anual_estacoes', $data);
    }

    public function editar_dici_scm_anual_enlace_proprio(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $estados = $this->estadoModel->selectEstados();


        $plano = $this->buscaPlanoAnualProprioOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'options_estados' => $estados,
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_scm_anual_enlace_proprio', $data);
    }

    public function editar_dici_scm_anual_enlace_contratado(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $estados = $this->estadoModel->selectEstados();


        $plano = $this->buscaPlanoAnualContratadoOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'options_estados' => $estados,
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_scm_anual_enlace_contratado', $data);
    }

    public function editar_dici_stfc_plano(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $plano = $this->buscaPlanoStfcOu404($id);


        //$this->removeBlockCepEmailSessao();

        $data = [
            'titulo' => 'Editando Plano de declaração ',
            'plano' => $plano,
        ];

        return view('Declarations/editar_dici_stfc_plano', $data);
    }

    public function duplicar_fust($id)
    {

        $declarationBase = $this->buscaDeclaracaoOu404($id);
        $planosBase = $this->fustModel->recuperaPlanosDeclaracoes($id);



        $novaDeclaracao = [
            'year' => $declarationBase->year,
            'month' => $declarationBase->month,
            'status' => 'ABERTA',
            'client_id' => $declarationBase->client_id,
            'code' => $this->declarationModel->geraCodigoDeclaracao(),
            'type' => $declarationBase->type,

        ];

        // cria declaração
        $this->declarationModel->skipValidation(true)->protect(false)->insert($novaDeclaracao);
        $novoId = $this->declarationModel->getInsertID();
        foreach ($planosBase as $p) {
            $novoPlano = [
                'declaration_id' => $novoId,
                'referencia' => $p->referencia,
                'pis' => $p->pis,
                'icms' => $p->icms,
                'cofins' => $p->cofins,
                'processo' => $p->processo,
                'faturamento' => $p->faturamento,
                'qtd_nfe' => $p->qtd_nfe
            ];
            $this->fustModel->skipValidation(true)->protect(false)->insert($novoPlano);
        }



        return redirect()->to(site_url("declarations/criar_fust_step_2/$novoId"))->with('sucesso', "Declaração duplicada com sucesso!");
    }

    public function duplicar_dici_scm($id)
    {

        $declarationBase = $this->buscaDeclaracaoOu404($id);
        $planosBase = $this->diciScmModel->recuperaPlanosDeclaracoes($id);



        $novaDeclaracao = [
            'year' => $declarationBase->year,
            'month' => $declarationBase->month,
            'status' => 'ABERTA',
            'client_id' => $declarationBase->client_id,
            'code' => $this->declarationModel->geraCodigoDeclaracao(),
            'type' => $declarationBase->type,

        ];

        // cria declaração
        $this->declarationModel->skipValidation(true)->protect(false)->insert($novaDeclaracao);
        $novoId = $this->declarationModel->getInsertID();
        foreach ($planosBase as $p) {
            $novoPlano = [
                'declaration_id' => $novoId,
                'tipo_cliente' => $p->tipo_cliente,
                'tipo_atendimento' => $p->tipo_atendimento,
                'tipo_meio' => $p->tipo_meio,
                'tipo_produto' => $p->tipo_produto,
                'tipo_tecnologia' => $p->tipo_tecnologia,
                'velocidade' => $p->velocidade,
                'qtd_acessos' => $p->qtd_acessos,
                'city_code' => $p->city_code
            ];
            $this->diciScmModel->skipValidation(true)->protect(false)->insert($novoPlano);
        }



        return redirect()->to(site_url("declarations/criar_dici_scm_step_2/$novoId"))->with('sucesso', "Declaração duplicada com sucesso!");
    }

    public function duplicar_dici_scm_anual($id)
    {

        $declarationBase = $this->buscaDeclaracaoOu404($id);
        $estacoes = $this->DiciScmAnualEstacoesModel->recuperaPlanos($id);
        $enlacesProprios = $this->DiciScmAnualEnlacesPropriosModel->recuperaPlanos($id);
        $enlacesContratados = $this->DiciScmAnualEnlacesContratadosModel->recuperaPlanos($id);


        $novaDeclaracao = [
            'year' => $declarationBase->year,
            'status' => 'ABERTA',
            'client_id' => $declarationBase->client_id,
            'code' => $this->declarationModel->geraCodigoDeclaracao(),
            'type' => $declarationBase->type,

        ];

        // cria declaração
        $this->declarationModel->skipValidation(true)->protect(false)->insert($novaDeclaracao);
        $novoId = $this->declarationModel->getInsertID();

        foreach ($estacoes as $estacao) {
            $novaEstacao = [
                'declaration_id' => $novoId,
                'id_estacao' => $estacao->id_estacao,
                'numestacao' => $estacao->numestacao,
                'lat' => $estacao->lat,
                'long' => $estacao->long,
                'city_code' => $estacao->city_code,
                'endereco' => $estacao->endereco,
                'abertura' => $estacao->abertura
            ];

            $this->DiciScmAnualEstacoesModel->skipValidation(true)->protect(false)->insert($novaEstacao);
        }

        $i = 1;
        while (
            $i <= 400
        ) {
            $i++;  /* the printed value would be
                   $i before the increment
                   (post-increment) */
        }

        foreach ($enlacesProprios as $enlaceProprio) {
            $novoEnlaceProprio = [
                'declaration_id' => $novoId,
                'estacao_a_id' => $enlaceProprio->estacao_a_id,
                'estacao_b_id' => $enlaceProprio->estacao_b_id,
                'enlaces_proprios_terrestres_id' => $enlaceProprio->enlaces_proprios_terrestres_id,
                'enlaces_proprios_terrestres_meio' => $enlaceProprio->enlaces_proprios_terrestres_meio,
                'enlaces_proprios_terrestres_c_nominal' => $enlaceProprio->enlaces_proprios_terrestres_c_nominal,
                'enlaces_proprios_terrestres_swap' => $enlaceProprio->enlaces_proprios_terrestres_swap,
                'geometria_wkt' => $enlaceProprio->geometria_wkt,
                'srid' => $enlaceProprio->srid
            ];
            $this->DiciScmAnualEnlacesPropriosModel->skipValidation(true)->protect(false)->insert($novoEnlaceProprio);
        }

        $i = 1;
        while (
            $i <= 400
        ) {
            $i++;  /* the printed value would be
                   $i before the increment
                   (post-increment) */
        }

        foreach ($enlacesContratados as $enlaceContratado) {
            $novoEnlaceContratado = [
                'declaration_id' => $novoId,
                'estacao_a_id' => $enlaceContratado->estacao_a_id,
                'estacao_b_id' => $enlaceContratado->estacao_b_id,
                'enlaces_contratados_id' => $enlaceContratado->enlaces_contratados_id,
                'enlaces_contratados_meio' => $enlaceContratado->enlaces_contratados_meio,
                'enlaces_contratados_prestadora' => $enlaceContratado->enlaces_contratados_prestadora
            ];
            $this->DiciScmAnualEnlacesContratadosModel->skipValidation(true)->protect(false)->insert($novoEnlaceContratado);
        }



        return redirect()->to(site_url("declarations/criar_dici_scm_anual_step_2/$novoId"))->with('sucesso', "Declaração duplicada com sucesso!");
    }

    public function duplicar_dici_scm_trimestral($id)
    {

        $declarationBase = $this->buscaDeclaracaoOu404($id);
        $planosBase = $this->diciScmTrimestralModel->recuperaPlanosDeclaracoes($id);



        $novaDeclaracao = [
            'year' => $declarationBase->year,
            'month' => $declarationBase->month,
            'status' => 'ABERTA',
            'client_id' => $declarationBase->client_id,
            'code' => $this->declarationModel->geraCodigoDeclaracao(),
            'type' => $declarationBase->type,
            'trimestre' => $declarationBase->trimestre,

        ];

        // cria declaração
        $this->declarationModel->skipValidation(true)->protect(false)->insert($novaDeclaracao);
        $novoId = $this->declarationModel->getInsertID();
        foreach ($planosBase as $p) {
            $novoPlano = [
                'declaration_id' => $novoId,
                'CODIGO' => $p->CODIGO,
                'DADO_INFORMADO' => $p->DADO_INFORMADO,
                'SERVICO' => $p->SERVICO,
                'UNIDADE_DA_FEDERACAO_UF' => $p->UNIDADE_DA_FEDERACAO_UF,
                'VALORES' => $p->VALORES,
            ];
            $this->diciScmTrimestralModel->skipValidation(true)->protect(false)->insert($novoPlano);
        }



        return redirect()->to(site_url("declarations/criar_dici_scm_trimestral_step_2/$novoId"))->with('sucesso', "Declaração duplicada com sucesso!");
    }

    public function duplicar_dici_stfc($id)
    {

        $declarationBase = $this->buscaDeclaracaoOu404($id);
        $planosBase = $this->diciStfcModel->recuperaPlanosDeclaracoes($id);



        $novaDeclaracao = [
            'year' => $declarationBase->year,
            'month' => $declarationBase->month,
            'status' => 'ABERTA',
            'client_id' => $declarationBase->client_id,
            'code' => $this->declarationModel->geraCodigoDeclaracao(),
            'type' => $declarationBase->type,

        ];

        // cria declaração
        $this->declarationModel->skipValidation(true)->protect(false)->insert($novaDeclaracao);
        $novoId = $this->declarationModel->getInsertID();
        foreach ($planosBase as $p) {
            $novoPlano = [
                'declaration_id' => $novoId,
                'tipo_cliente' => $p->tipo_cliente,
                'tipo_atendimento' => $p->tipo_atendimento,
                'tipo_meio' => $p->tipo_meio,
                'city_code' => $p->city_code
            ];
            $this->diciStfcModel->skipValidation(true)->protect(false)->insert($novoPlano);
        }



        return redirect()->to(site_url("declarations/criar_dici_stfc_step_2/$novoId"))->with('sucesso', "Declaração duplicada com sucesso!");
    }

    public function duplicar_dici_tvpa($id)
    {

        $declarationBase = $this->buscaDeclaracaoOu404($id);
        $planosBase = $this->diciTvpaModel->recuperaPlanosDeclaracoes($id);



        $novaDeclaracao = [
            'year' => $declarationBase->year,
            'month' => $declarationBase->month,
            'status' => 'ABERTA',
            'client_id' => $declarationBase->client_id,
            'code' => $this->declarationModel->geraCodigoDeclaracao(),
            'type' => $declarationBase->type,

        ];

        // cria declaração
        $this->declarationModel->skipValidation(true)->protect(false)->insert($novaDeclaracao);
        $novoId = $this->declarationModel->getInsertID();
        foreach ($planosBase as $p) {
            $novoPlano = [
                'declaration_id' => $novoId,
                'tipo_cliente' => $p->tipo_cliente,
                'tipo_meio' => $p->tipo_meio,
                'tipo_tecnologia' => $p->tipo_tecnologia,
                'qtd_acessos' => $p->qtd_acessos,
                'city_code' => $p->city_code
            ];
            $this->diciTvpaModel->skipValidation(true)->protect(false)->insert($novoPlano);
        }



        return redirect()->to(site_url("declarations/criar_dici_tvpa_step_2/$novoId"))->with('sucesso', "Declaração duplicada com sucesso!");
    }

    public function atualizar_fust()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $declaracao = $this->buscaDeclaracaoOu404($post['id']);

        $declaracao->fill($post);

        if ($declaracao->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->declarationModel->protect(false)->save($declaracao)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }


    public function atualizar_dici_scm()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $declaracao = $this->buscaDeclaracaoOu404($post['id']);

        $declaracao->fill($post);

        if ($declaracao->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->declarationModel->protect(false)->save($declaracao)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_scm_anual()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $declaracao = $this->buscaDeclaracaoOu404($post['id']);

        $declaracao->fill($post);

        if ($declaracao->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->declarationModel->protect(false)->save($declaracao)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_fust_plano()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoFustOu404($post['id']);

        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->fustModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_scm_plano()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoOu404($post['id']);

        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->diciScmModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_tvpa_plano()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoTvpaOu404($post['id']);

        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->diciTvpaModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_scm_trimestral_plano()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoScmTrimestralOu404($post['id']);



        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->diciScmTrimestralModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_scm_anual_estacoes()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoAnualEstacaoOu404($post['id']);



        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->DiciScmAnualEstacoesModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_scm_anual_enlaces_proprios()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoAnualProprioOu404($post['id']);



        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->DiciScmAnualEnlacesPropriosModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_scm_anual_enlaces_contratados()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoAnualContratadoOu404($post['id']);



        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->DiciScmAnualEnlacesContratadosModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_stfc_plano()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $plano = $this->buscaPlanoStfcOu404($post['id']);

        $plano->fill($post);

        if ($plano->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->diciStfcModel->protect(false)->save($plano)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_stfc()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $declaracao = $this->buscaDeclaracaoOu404($post['id']);

        $declaracao->fill($post);

        if ($declaracao->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->declarationModel->protect(false)->save($declaracao)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function atualizar_dici_tvpa()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();

        // Recupero o post da requisição
        $post = $this->request->getPost();
        $declaracao = $this->buscaDeclaracaoOu404($post['id']);

        $declaracao->fill($post);

        if ($declaracao->hasChanged() === false) {
            $retorno['info'] = 'Não há dados para atualizar';
            return $this->response->setJSON($retorno);
        }

        if ($this->declarationModel->protect(false)->save($declaracao)) {

            session()->setFlashdata('sucesso', 'Dados salvos com sucesso!');

            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Por favor verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->declarationModel->errors();

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

        $cliente = $this->buscaDeclaracaoOu404($id);

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

    public function excluirPlanoFust(int $id = null)
    {



        $plano = $this->buscaPlanoFustOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "Cliente $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->fustModel->delete($id);

            return redirect()->to(site_url("declarations/criar_fust_step_2/$plano->declaration_id"))->with('sucesso', "Plano da cidade $plano->Nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o plano da cidade de " . esc($plano->Nome) . ' - ' . esc($plano->Uf),
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlano(int $id = null)
    {



        $plano = $this->buscaPlanoOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "Cliente $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->diciScmModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_scm_step_2/$plano->declaration_id"))->with('sucesso', "Plano da cidade $plano->Nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o plano da cidade de " . esc($plano->Nome) . ' - ' . esc($plano->Uf),
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoScmTrimestral(int $id = null)
    {



        $plano = $this->buscaPlanoScmTrimestralOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "Cliente $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->diciScmTrimestralModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_scm_trimestral_step_2/$plano->declaration_id"))->with('sucesso', "Plano da cidade $plano->Nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o plano da cidade de " . esc($plano->Nome) . ' - ' . esc($plano->Uf),
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoTvpa(int $id = null)
    {



        $plano = $this->buscaPlanoTvpaOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "Cliente $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->diciTvpaModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_tvpa_step_2/$plano->declaration_id"))->with('sucesso', "Plano da cidade $plano->Nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o plano da cidade de " . esc($plano->Nome) . ' - ' . esc($plano->Uf),
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoStfc(int $id = null)
    {



        $plano = $this->buscaPlanoStfcOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "Cliente $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->diciStfcModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_stfc_step_2/$plano->declaration_id"))->with('sucesso', "Plano da cidade $plano->Nome excluído com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o plano da cidade de " . esc($plano->Nome) . ' - ' . esc($plano->Uf),
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoScmAnualEstacao(int $id = null)
    {



        $plano = $this->buscaPlanoAnualEstacaoOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "O $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->DiciScmAnualEstacoesModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_scm_anual_step_2/$plano->declaration_id"))->with('sucesso', "Plano excluído com sucesso!");
        }

        $data = [
            'titulo' => "Plano Excluído com sucesso!",
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoScmAnualProprio(int $id = null)
    {

        $plano = $this->buscaPlanoAnualProprioOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "O $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->DiciScmAnualEnlacesPropriosModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_scm_anual_step_2/$plano->declaration_id"))->with('sucesso', "Plano excluído com sucesso!");
        }

        $data = [
            'titulo' => "Plano Excluído com sucesso!",
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoScmAnualEnlaceContratado(int $id = null)
    {

        $plano = $this->buscaPlanoAnualContratadoOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "O $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->DiciScmAnualEnlacesContratadosModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_scm_anual_step_2/$plano->declaration_id"))->with('sucesso', "Plano excluído com sucesso!");
        }

        $data = [
            'titulo' => "Plano Excluído com sucesso!",
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluirPlanoScmAnualViaSatelite(int $id = null)
    {

        $plano = $this->buscaPlanoAnualViaSateliteOu404($id);

        if ($plano->deleted_at != null) {
            return redirect()->back()->with('info', "O $plano->nome já encontra-se excluído");
        }

        if ($this->request->getMethod() === 'post') {
            $this->DiciScmAnualEnlacesViaSateliteModel->delete($id);

            return redirect()->to(site_url("declarations/criar_dici_scm_anual_step_2/$plano->declaration_id"))->with('sucesso', "Plano excluído com sucesso!");
        }

        $data = [
            'titulo' => "Plano Excluído com sucesso!",
            'plano' => $plano,
        ];

        return view('Declarations/excluirPlano', $data);
    }

    public function excluir(int $id = null)
    {

        $declaracao = $this->buscaDeclaracaoOu404($id);

        if ($declaracao->deleted_at != null) {
            return redirect()->back()->with('info', "Declaração $declaracao->nome já encontra-se excluída");
        }

        if ($this->request->getMethod() === 'post') {
            $this->declarationModel->delete($id);

            return redirect()->to(site_url("console/dashboard"))->with('sucesso', "Declaração $declaracao->nome excluída com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o declaração " . esc($declaracao->nome),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/excluir', $data);
    }

    public function excluirAdm(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('excluir-declaracoes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);

        if ($declaracao->deleted_at != null) {
            return redirect()->back()->with('info', "Declaração $declaracao->nome já encontra-se excluída");
        }

        if ($this->request->getMethod() === 'post') {
            $this->declarationModel->delete($id);

            return redirect()->to(site_url("console/dashboard"))->with('sucesso', "Declaração $declaracao->nome excluída com sucesso!");
        }

        $data = [
            'titulo' => "Excluindo o declaração " . esc($declaracao->nome),
            'declaracao' => $declaracao,
        ];

        return view('Declarations/excluir', $data);
    }

    public function desfazerExclusao(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $cliente = $this->buscaDeclaracaoOu404($id);

        if ($cliente->deleted_at === null) {
            return redirect()->back()->with('info', "Apenas declarações excluídas podem ser recuperadas");
        }

        $cliente->deleted_at = null;
        $this->declarationModel->protect(false)->save($cliente);

        return redirect()->back()->with('sucesso', "Cliente $cliente->nome recuperado com sucesso!");
    }

    public function desfazerExclusaoCliente(int $id = null)
    {

        $declaration = $this->buscaDeclaracaoOu404($id);

        if ($declaration->deleted_at === null) {
            return redirect()->back()->with('info', "Apenas declarações excluídas podem ser recuperadas");
        }

        $declaration->deleted_at = null;

        $this->declarationModel->protect(false)->save($declaration);

        return redirect()->back()->with('sucesso', "Cliente $declaration->nome recuperado com sucesso!");
    }
    /*--------------------------------Método privados-------------------------*/

    /**
     * Método que recupera o cliente
     *
     * @param integer $id
     * @return Exceptions|object
     */
    private function buscaDeclaracaoOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->declarationModel->recuperaDeclaracao($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->diciScmModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoFustOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->fustModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoScmTrimestralOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->diciScmTrimestralModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoTvpaOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->diciTvpaModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoStfcOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->diciStfcModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoAnualEstacaoOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->DiciScmAnualEstacoesModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoAnualProprioOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->DiciScmAnualEnlacesPropriosModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoAnualContratadoOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->DiciScmAnualEnlacesContratadosModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    private function buscaPlanoAnualViaSateliteOu404(int $id = null)
    {
        if (!$id || !$declaration = $this->DiciScmAnualEnlacesViaSateliteModel->recuperaPlano($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a declaração $id");
        }

        return $declaration;
    }

    /**
     * Método que envia o e-mail para o cliente informando a alteração no e-mail de acesso.
     *
     * @param object $usuario
     * @return void
     */
    private function enviaEmailCriacaoEmailAcesso(object $cliente): void
    {
        $email = service('email');

        $email->setFrom(env('email.SMTPUser'), env('LICENCED'));

        $email->setTo($cliente->email);

        $email->setSubject('Dados de acesso ao sistema');

        $data = [
            'cliente' => $cliente,
        ];

        $mensagem = view('Clientes/email_dados_acesso', $data);

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

        $email->setFrom(env('email.SMTPUser'), env('LICENCED'));

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


    public function gerarelatoriodiciscm($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciScm($id);

        $filename = 'DICI_MENSAL_SCM_' . date('Ymd') . '_' . $declaracao->nome . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        $file = fopen('php://output', 'wt');


        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        $header = array("CNPJ", "ANO", "MES", "COD_IBGE", "TIPO_CLIENTE", "TIPO_ATENDIMENTO", "TIPO_MEIO", "TIPO_PRODUTO", "TIPO_TECNOLOGIA", "VELOCIDADE", "ACESSOS");

        //$csv = fputcsv($file, $header, ";");
        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        foreach ($declarations as $key => $line) {
            $csv = fputcsv($file, $line, ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        }

        fclose($file);

        exit;
    }

    public function gerarelatoriodiciscmanualestacoes($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciScmAnualEstacoes($id);

        $filename = 'DICI_ANUAL_SCM_ESTACOES' . date('Ymd') . '_' . $declaracao->nome . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        $file = fopen('php://output', 'wt');



        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        $header = array("CNPJ", "ANO", "ID", "NUMESTACAO", "LAT", "LONG", "COD_IBGE", "ENDERECO", "ABERTURA");

        //$csv = fputcsv($file, $header, ";");
        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");

        foreach ($declarations as $key => $line) {
            $csv = fputcsv($file, $line, ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        }

        fclose($file);

        exit;
    }

    public function gerarelatoriodiciscmanualenlacesproprios($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciScmAnualEnlacesProprios($id);

        $filename = 'DICI_ANUAL_SCM_ESTACOES' . date('Ymd') . '_' . $declaracao->nome . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        $file = fopen('php://output', 'wt');



        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        $header = array("CNPJ", "ANO", "ESTACAO_A_ID", "ESTACAO_B_ID", "ENLACES_PROPRIOS_TERRESTRES_ID", "ENLACES_PROPRIOS_TERRESTRES_MEIO", "ENLACES_PROPRIOS_TERRESTRES_C_NOMINAL", "ENLACES_PROPRIOS_TERRESTRES_SWAP", "GEOMETRIA_WKT", "SRID");

        //$csv = fputcsv($file, $header, ";");
        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");

        foreach ($declarations as $key => $line) {
            $csv = fputcsv($file, $line, ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        }

        fclose($file);

        exit;
    }

    public function gerarelatoriodiciscmanualenlacescontratados($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciScmAnualEnlacesContratados($id);

        $filename = 'DICI_ANUAL_SCM_ESTACOES' . date('Ymd') . '_' . $declaracao->nome . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        $file = fopen('php://output', 'wt');



        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        $header = array("CNPJ", "ANO", "ESTACAO_A_ID", "ESTACAO_B_ID", "ENLACES_CONTRATADOS_ID", "ENLACES_CONTRATADOS_MEIO", "ENLACES_CONTRATADOS_PRESTADORA");

        //$csv = fputcsv($file, $header, ";");
        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");

        foreach ($declarations as $key => $line) {
            $csv = fputcsv($file, $line, ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        }

        fclose($file);

        exit;
    }

    public function gerarelatoriodiciscmtrimestral($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciScmTrimestral($id);

        // file name
        //$filename = 'dici_scm_' . date('Ymd') . '.csv';
        $filename = 'DICI_TRIMESTRAL_SCM_' . date('Ymd') . '_' . $declaracao->nome . '.csv';

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=utf-8");

        // get data


        //$usersData = $users->select('*')->findAll();

        // file creation
        $file = fopen('php://output', 'w');

        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));


        $header = array("DADO_INFORMADO", "SERVICO", "UNIDADE_DA_FEDERACAO_UF", "VALORES", "CNPJ");

        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        foreach ($declarations as $key => $line) {
            fputcsv(
                $file,
                $line,
                ";",
                $enclosure = "\"",
                $escape = "\\",
                $eol = "\r\n"
            );
        }
        fclose($file);
        exit;
    }

    public function gerarelatoriodicitvpa($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciTvpa($id);

        // file name
        //$filename = 'dici_scm_' . date('Ymd') . '.csv';
        $filename = 'DICI_TVPA_' . date('Ymd') . '_' . $declaracao->nome . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        //header("Content-Type: application/csv; ");
        header("Content-Type: text/csv; charset=utf-8");

        // get data


        //$usersData = $users->select('*')->findAll();

        // file creation
        $file = fopen('php://output', 'w');
        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $header = array("CNPJ", "ANO", "MES", "COD_IBGE", "TIPO_CLIENTE", "TIPO_MEIO", "TIPO_TECNOLOGIA", "QT_ACESSOS");

        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        foreach ($declarations as $key => $line) {
            fputcsv(
                $file,
                $line,
                ";",
                $enclosure = "\"",
                $escape = "\\",
                $eol = "\r\n"
            );
        }
        fclose($file);
        exit;
    }

    public function gerarelatoriodicistfc($id = null)
    {


        $declaracao = $this->buscaDeclaracaoOu404($id);
        $declarations = $this->declarationModel->geraCsvDiciStfc($id);

        // file name
        //$filename = 'dici_scm_' . date('Ymd') . '.csv';
        $filename = 'DICI_STFC_' . date('Ymd') . '_' . $declaracao->nome . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        //header("Content-Type: application/csv; ");
        header("Content-Type: text/csv; charset=utf-8");

        // get data


        //$usersData = $users->select('*')->findAll();

        // file creation
        $file = fopen('php://output', 'w');
        fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $header = array("CNPJ", "ANO", "MES", "COD_IBGE", "TIPO_CLIENTE", "TIPO_ATENDIMENTO", "TIPO_MEIO");

        fputcsv($file, $header, $separator = ";", $enclosure = "\"", $escape = "\\", $eol = "\r\n");
        foreach ($declarations as $key => $line) {
            fputcsv(
                $file,
                $line,
                ";",
                $enclosure = "\"",
                $escape = "\\",
                $eol = "\r\n"
            );
        }
        fclose($file);
        exit;
    }

    public function checkin(int $id = null)
    {

        if (!$this->usuarioLogado()->temPermissaoPara('editar-clientes')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaracao = $this->buscaDeclaracaoOu404($id);

        if ($declaracao->status === 'FINALIZADA') {
            return redirect()->back()->with('info', "Esta declaração já foi finalizada");
        }

        $declaracao->status = "FINALIZADA";
        $this->declarationModel->protect(false)->save($declaracao);

        $email = $this->declarationModel->select('clientes.email')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $declaracao->id)
            ->first();

        //$this->enviaEmailNotificacao($email->email, $declaracao->code, $declaracao->month);



        return redirect()->to(site_url("declarations"))->with('sucesso', "Declaração $declaracao->code finalizada com sucesso!");
    }

    public function gravarenviar(int $id = null)
    {



        $declaracao = $this->buscaDeclaracaoOu404($id);

        if ($declaracao->status === 'ENVIADA') {
            return redirect()->back()->with('info', "Esta declaração já foi finalizada");
        }

        $declaracao->status = "ENVIADA";
        $this->declarationModel->protect(false)->save($declaracao);

        //$email = $this->declarationModel->select('clientes.email')
        //->join('clientes', 'clientes.id = declarations.client_id')
        //->where('declarations.id', $declaracao->id)
        //->first();

        //$this->enviaEmailNotificacao($email->email, $declaracao->code, $declaracao->month);



        return redirect()->to(site_url("console/dashboard"))->with('sucesso', "Declaração $declaracao->code enviada com sucesso!");
    }

    /**
     * Método que envia o e-mail para o usuário.
     *
     * @param object $usuario
     * @return void
     */
    private function enviaEmailNotificacao(string $emailCliente, string $code, string $month): void
    {

        $email = service('email');

        $email->setFrom(env('email.SMTPUser'), env('LICENCED'));

        $email->setTo($emailCliente);

        $email->setSubject('Declaração Finalizada!');

        $data = [
            'codigo' => $code,
            'month' => $month
        ];

        $mensagem = view('Declarations/recibo', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    private function enviaEmailLembrete(string $emailCliente,  string $month, string $nome, string $year): void
    {

        $email = service('email');

        $email->setFrom(env('email.SMTPUser'), env('LICENCED'));

        $email->setTo($emailCliente);

        $email->setSubject('Lembrete de envio de declaração mensal');

        $data = [
            'month' => $month,
            'year' => $year,
            'nome' => $nome
        ];

        $mensagem = view('Declarations/lembrete', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    private function enviaEmailLembreteTrimestral(string $emailCliente,  string $month, string $nome, string $year): void
    {

        $email = service('email');

        $email->setFrom(env('email.SMTPUser'), env('LICENCED'));

        $email->setTo($emailCliente);

        $email->setSubject('Lembrete de envio de declaração trimestral');

        $data = [
            'month' => $month,
            'year' => $year,
            'nome' => $nome
        ];

        $mensagem = view('Declarations/lembretet', $data);

        $email->setMessage($mensagem);

        $email->send();
    }

    public function EnviarRecibo(int $id = null)
    {
        if (!$this->usuarioLogado()->temPermissaoPara('editar-usuarios')) {
            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $declaration = $this->buscaDeclaracaoOu404($id);

        $data = [
            'titulo' => "Enviar recibo de declaração " . esc($declaration->code),
            'declaration' => $declaration,
        ];


        return view('Declarations/upload_recibo', $data);
    }

    public function importar(int $id = null)
    {
        if ($id == 1) {
            $declaration = 'SCM-MENSAL';
        } else if ($id == 2) {
            $declaration = 'SCM-TRIMESTRAL';
        } else if ($id == 3) {
            $declaration = 'STFC';
        } else if ($id == 4) {
            $declaration = 'TVPA';
        } else if ($id == 5) {
            $declaration = 'FUST';
        }
        $cliente = $this->clienteModel->select('id')
            ->where('usuario_id', usuario_logado()->id)
            ->first();
        //$cliente = intval(is_array($cliente));

        $code = $this->declarationModel->geraCodigoDeclaracao();

        $data = [
            'titulo' => "importar declaração " . esc($declaration),
            'declaration' => $declaration,
            'id' => $id,
            'client_id' => $cliente->id,
            'code' => $code
        ];


        return view('Declarations/importar_csv', $data);
    }

    public function importCsvDiciScm()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
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


                    while (($mesano = fgetcsv($file, 1000, ";")) !== FALSE) {
                        if ($mesano[2] == 1) {
                            $mes = "Janeiro";
                        } else if ($mesano[2] == 2) {
                            $mes = "Fevereiro";
                        } else if ($mesano[2] == 3) {
                            $mes = "Março";
                        } else if ($mesano[2] == 4) {
                            $mes = 'Abril';
                        } else if ($mesano[2] == 5) {
                            $mes = "Maio";
                        } else if ($mesano[2] == 6) {
                            $mes = "Junho";
                        } else if ($mesano[2] == 7) {
                            $mes = "Julho";
                        } else if ($mesano[2] == 8) {
                            $mes = "Agosto";
                        } else if ($mesano[2] == 9) {
                            $mes = "Setembro";
                        } else if ($mesano[2] == 10) {
                            $mes = "Outubro";
                        } else if ($mesano[2] == 11) {
                            $mes = "Novembro";
                        } else if ($mesano[2] == 12) {
                            $mes = "Dezembro";
                        }
                        $ano = $mesano[1];
                    }

                    $post = $this->request->getPost();
                    $declaration = [
                        'year' => $ano,
                        'month' => $mes,
                        'type' => 'dici-scm',
                        'client_id' => $post['client_id'],
                        'code' => $post['code'],
                        'status' => $post['status'],
                    ];
                    $this->declarationModel->skipValidation(true)->protect(false)->insert($declaration);
                    $declaration_id = $this->declarationModel->getInsertID();




                    while (($filedata = fgetcsv($csv, 1000, ";")) !== FALSE) {
                        //$num = count($filedata);
                        if ($i >= 0) {
                            $csvArr[$i]['declaration_id'] = $declaration_id;
                            $csvArr[$i]['city_code'] = $filedata[3];
                            $csvArr[$i]['tipo_cliente'] = $filedata[4];
                            $csvArr[$i]['tipo_atendimento'] = $filedata[5];
                            $csvArr[$i]['tipo_meio'] = $filedata[6];
                            $csvArr[$i]['tipo_produto'] = $filedata[7];
                            $csvArr[$i]['tipo_tecnologia'] = $filedata[8];
                            $csvArr[$i]['velocidade'] = $filedata[9];
                            $csvArr[$i]['qtd_acessos'] = $filedata[10];
                        }

                        $i++;
                    }

                    fclose($file);
                    $count = 0;

                    foreach ($csvArr as $data) {
                        $this->diciScmModel->skipValidation(true)->protect(false)->insert($data);
                        //$this->diciScmModel->insert($data);
                        $count++;
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
        return redirect()->to(site_url("declarations/criar_dici_scm_step_2/$declaration_id"))->with('sucesso', "Declaração importada com sucesso!");
    }

    public function importCsvDiciStfc()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
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


                    while (($mesano = fgetcsv($file, 1000, ";")) !== FALSE) {
                        if ($mesano[2] == 1) {
                            $mes = "Janeiro";
                        } else if ($mesano[2] == 2) {
                            $mes = "Fevereiro";
                        } else if ($mesano[2] == 3) {
                            $mes = "Março";
                        } else if ($mesano[2] == 4) {
                            $mes = 'Abril';
                        } else if ($mesano[2] == 5) {
                            $mes = "Maio";
                        } else if ($mesano[2] == 6) {
                            $mes = "Junho";
                        } else if ($mesano[2] == 7) {
                            $mes = "Julho";
                        } else if ($mesano[2] == 8) {
                            $mes = "Agosto";
                        } else if ($mesano[2] == 9) {
                            $mes = "Setembro";
                        } else if ($mesano[2] == 10) {
                            $mes = "Outubro";
                        } else if ($mesano[2] == 11) {
                            $mes = "Novembro";
                        } else if ($mesano[2] == 12) {
                            $mes = "Dezembro";
                        }
                        $ano = $mesano[1];
                    }

                    $post = $this->request->getPost();
                    $declaration = [
                        'year' => $ano,
                        'month' => $mes,
                        'type' => 'dici-stfc',
                        'client_id' => $post['client_id'],
                        'code' => $post['code'],
                        'status' => $post['status'],
                    ];
                    $this->declarationModel->skipValidation(true)->protect(false)->insert($declaration);
                    $declaration_id = $this->declarationModel->getInsertID();




                    while (($filedata = fgetcsv($csv, 1000, ";")) !== FALSE) {
                        //$num = count($filedata);
                        if ($i >= 0) {
                            $csvArr[$i]['declaration_id'] = $declaration_id;
                            $csvArr[$i]['city_code'] = $filedata[3];
                            $csvArr[$i]['tipo_cliente'] = $filedata[4];
                            $csvArr[$i]['tipo_atendimento'] = $filedata[5];
                            $csvArr[$i]['tipo_meio'] = $filedata[6];
                        }

                        $i++;
                    }

                    fclose($file);
                    $count = 0;

                    foreach ($csvArr as $data) {
                        $this->diciStfcModel->skipValidation(true)->protect(false)->insert($data);
                        //$this->diciScmModel->insert($data);
                        $count++;
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
        return redirect()->to(site_url("declarations/criar_dici_stfc_step_2/$declaration_id"))->with('sucesso', "Declaração importada com sucesso!");
    }

    public function importCsvDiciTvpa()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
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


                    while (($mesano = fgetcsv($file, 1000, ";")) !== FALSE) {
                        if ($mesano[2] == 1) {
                            $mes = "Janeiro";
                        } else if ($mesano[2] == 2) {
                            $mes = "Fevereiro";
                        } else if ($mesano[2] == 3) {
                            $mes = "Março";
                        } else if ($mesano[2] == 4) {
                            $mes = 'Abril';
                        } else if ($mesano[2] == 5) {
                            $mes = "Maio";
                        } else if ($mesano[2] == 6) {
                            $mes = "Junho";
                        } else if ($mesano[2] == 7) {
                            $mes = "Julho";
                        } else if ($mesano[2] == 8) {
                            $mes = "Agosto";
                        } else if ($mesano[2] == 9) {
                            $mes = "Setembro";
                        } else if ($mesano[2] == 10) {
                            $mes = "Outubro";
                        } else if ($mesano[2] == 11) {
                            $mes = "Novembro";
                        } else if ($mesano[2] == 12) {
                            $mes = "Dezembro";
                        }
                        $ano = $mesano[1];
                    }

                    $post = $this->request->getPost();
                    $declaration = [
                        'year' => $ano,
                        'month' => $mes,
                        'type' => 'dici-tvpa',
                        'client_id' => $post['client_id'],
                        'code' => $post['code'],
                        'status' => $post['status'],
                    ];
                    $this->declarationModel->skipValidation(true)->protect(false)->insert($declaration);
                    $declaration_id = $this->declarationModel->getInsertID();




                    while (($filedata = fgetcsv($csv, 1000, ";")) !== FALSE) {
                        //$num = count($filedata);
                        if ($i >= 0) {
                            $csvArr[$i]['declaration_id'] = $declaration_id;
                            $csvArr[$i]['city_code'] = $filedata[3];
                            $csvArr[$i]['tipo_cliente'] = $filedata[4];
                            $csvArr[$i]['tipo_meio'] = $filedata[5];
                            $csvArr[$i]['tipo_tecnologia'] = $filedata[6];
                            $csvArr[$i]['qtd_acessos'] = $filedata[7];
                        }

                        $i++;
                    }

                    fclose($file);
                    $count = 0;

                    foreach ($csvArr as $data) {
                        $this->diciTvpaModel->skipValidation(true)->protect(false)->insert($data);
                        //$this->diciScmModel->insert($data);
                        $count++;
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
        return redirect()->to(site_url("declarations/criar_dici_tvpa_step_2/$declaration_id"))->with('sucesso', "Declaração importada com sucesso!");
    }

    public function importCsvFust()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
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


                    while (($mesano = fgetcsv($file, 1000, ";")) !== FALSE) {
                        if ($mesano[2] == 1) {
                            $mes = "Janeiro";
                        } else if ($mesano[2] == 2) {
                            $mes = "Fevereiro";
                        } else if ($mesano[2] == 3) {
                            $mes = "Março";
                        } else if ($mesano[2] == 4) {
                            $mes = 'Abril';
                        } else if ($mesano[2] == 5) {
                            $mes = "Maio";
                        } else if ($mesano[2] == 6) {
                            $mes = "Junho";
                        } else if ($mesano[2] == 7) {
                            $mes = "Julho";
                        } else if ($mesano[2] == 8) {
                            $mes = "Agosto";
                        } else if ($mesano[2] == 9) {
                            $mes = "Setembro";
                        } else if ($mesano[2] == 10) {
                            $mes = "Outubro";
                        } else if ($mesano[2] == 11) {
                            $mes = "Novembro";
                        } else if ($mesano[2] == 12) {
                            $mes = "Dezembro";
                        }
                        $ano = $mesano[1];
                    }

                    $post = $this->request->getPost();
                    $declaration = [
                        'year' => $ano,
                        'month' => $mes,
                        'type' => 'dici-tvpa',
                        'client_id' => $post['client_id'],
                        'code' => $post['code'],
                        'status' => $post['status'],
                    ];
                    $this->declarationModel->skipValidation(true)->protect(false)->insert($declaration);
                    $declaration_id = $this->declarationModel->getInsertID();




                    while (($filedata = fgetcsv($csv, 1000, ";")) !== FALSE) {
                        //$num = count($filedata);
                        if ($i >= 0) {
                            $csvArr[$i]['declaration_id'] = $declaration_id;
                            $csvArr[$i]['referencia'] = $filedata[3];
                            $csvArr[$i]['pis'] = $filedata[4];
                            $csvArr[$i]['icms'] = $filedata[5];
                            $csvArr[$i]['cofins'] = $filedata[6];
                            $csvArr[$i]['processo'] = $filedata[7];
                            $csvArr[$i]['faturamento'] = $filedata[8];
                            $csvArr[$i]['qtd_nfe'] = $filedata[9];
                        }

                        $i++;
                    }

                    fclose($file);
                    $count = 0;

                    foreach ($csvArr as $data) {
                        $this->fustModel->skipValidation(true)->protect(false)->insert($data);
                        //$this->diciScmModel->insert($data);
                        $count++;
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
        return redirect()->to(site_url("declarations/criar_fust_step_2/$declaration_id"))->with('sucesso', "Declaração importada com sucesso!");
    }

    public function importCsvDiciScmTrim()
    {
        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
        } else {
            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/" . $newName, "r");
                    $csv = fopen("../public/csvfile/" . $newName, "r");
                    $i = 0;

                    $csvArr = array();
                    $trimestre = null;
                    $ano = null;


                    while (($mesano = fgetcsv($file, 1000, ";")) !== FALSE) {
                        $ano = $mesano[0];
                        $trimestre = $mesano[2];
                    }

                    $post = $this->request->getPost();
                    $declaration = [
                        'year' => $ano,
                        'trimestre' => $trimestre,
                        'type' => 'dici_scm',
                        'client_id' => $post['client_id'],
                        'code' => $post['code'],
                        'status' => $post['status'],
                    ];
                    $this->declarationModel->skipValidation(true)->protect(false)->insert($declaration);
                    $declaration_id = $this->declarationModel->getInsertID();




                    while (($filedata = fgetcsv($csv, 1000, ";")) !== FALSE) {
                        //$num = count($filedata);
                        if ($i > 0) {
                            $csvArr[$i]['declaration_id'] = $declaration_id;
                            $csvArr[$i]['DADO_INFORMADO'] = $filedata[0];
                            $csvArr[$i]['SERVICO'] = $filedata[1];
                            $csvArr[$i]['UNIDADE_DA_FEDERACAO_UF'] = $filedata[2];
                            $csvArr[$i]['VALORES'] = $filedata[3];
                        }

                        $i++;
                    }

                    fclose($file);
                    $count = 0;

                    foreach ($csvArr as $data) {
                        $this->diciScmTrimestralModel->skipValidation(true)->protect(false)->insert($data);
                        //$this->diciScmModel->insert($data);
                        $count++;
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
        //return $this->response->setJSON($csvArr);
        return redirect()->to(site_url("declarations/criar_dici_scm_trimestral_step_2/$declaration_id"))->with('sucesso', "Declaração importada com sucesso!");
    }



    public function upload()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }


        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();


        $validacao = service('validation');


        $regras = [
            'pdf' => 'uploaded[pdf]|max_size[pdf,1024]',
        ];

        $mensagens = [   // Errors
            'pdf' => [
                'uploaded' => 'Por favor escolha um arquivo',
                'max_size' => 'Por favor escolha uma pdf de no máximo 1024'

            ],
        ];

        $validacao->setRules($regras, $mensagens);


        if ($validacao->withRequest($this->request)->run() === false) {
            $retorno['erro'] = 'Por favor verifique os abaixo e tente novamente';
            $retorno['erros_model'] = $validacao->getErrors();


            // Retorno para o ajax request
            return $this->response->setJSON($retorno);
        }

        // Recupero o post da requisição
        $post = $this->request->getPost();

        $declaration = $this->buscaDeclaracaoOu404($post['id']);



        // Recuperamos a imagem que veio no post
        $pdf = $this->request->getFile('pdf');


        $caminhoPdf = $pdf->store('recibos');


        // C:\xampp\htdocs\ordem\writable\uploads/usuarios/1625800273_8dc568f411ea409f3e16.jpg
        $caminhoPdf = WRITEPATH . "uploads/$caminhoPdf";


        // Podemos manipular a imagem que está salva no diretório

        if ($declaration->status === 'FINALIZADA') {
            session()->setFlashdata('erro', 'Essa declaração já foi finalziada!');


            // Retorno para o ajax request
            return $this->response->setJSON($retorno);
        }

        $declaration->recibo = $pdf->getName();
        $declaration->status = "FINALIZADA";


        $this->declarationModel->protect(false)->save($declaration);


        $email = $this->declarationModel->select('clientes.email')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $declaration->id)
            ->first();

        $this->enviaEmailNotificacao($email->email, $declaration->code, $declaration->month);



        //return redirect()->to(site_url("declarations"))->with('sucesso', "Declaração $declaracao->code enviada com sucesso!");



        session()->setFlashdata('sucesso', 'Recibo enviado com sucesso!');


        // Retorno para o ajax request
        return $this->response->setJSON($retorno);
    }

    public function pdf(string $pdf = null)
    {
        if ($pdf != null) {
            $this->exibeArquivo('recibos', $pdf);
        }
    }

    public function notifica()
    {
        $month = date('m');
        $year = date('y');
        $declarations = $this->declarationModel->paraNotificar($month);
        foreach ($declarations as $declaration) {

            $log = [
                'usuario_id' => $declaration->id,
                'nome' => $declaration->nome,
                'email' => $declaration->email,
                'type' => $declaration->type
            ];
            $this->notificationsModel->insert($log);
            $this->enviaEmailLembrete($declaration->email, $month, $declaration->nome, $year);
        }




        echo "<pre>";
        print_r($declarations);
        echo "</pre>";
    }

    public function notificaT()
    {
        $month = date('m');
        $year = date('y');
        $declarations = $this->declarationModel->paraNotificarTrimestral($month);
        foreach ($declarations as $declaration) {

            $log = [
                'usuario_id' => $declaration->id,
                'nome' => $declaration->nome,
                'email' => $declaration->email,
                'type' => $declaration->type
            ];
            $this->notificationsModel->insert($log);
            $this->enviaEmailLembreteTrimestral($declaration->email, $month, $declaration->nome, $year);
        }




        echo "<pre>";
        print_r($declarations);
        echo "</pre>";
    }
}
