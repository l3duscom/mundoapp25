<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PlanoModel;
use App\Models\AssinaturaModel;
use App\Models\ClienteModel;
use App\Services\AsaasService;

class Assinaturas extends BaseController
{
    protected $planoModel;
    protected $assinaturaModel;
    protected $clienteModel;
    protected $asaasService;
    protected $usuarioModel;

    public function __construct()
    {
        $this->planoModel = new PlanoModel();
        $this->assinaturaModel = new AssinaturaModel();
        $this->clienteModel = new ClienteModel();
        $this->asaasService = new AsaasService();
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }

    /**
     * Lista os planos disponíveis
     */
    public function index()
    {
        $planos = $this->planoModel->getPlanosParaExibicao();
        
        // Verifica se usuário está logado e se já tem assinatura ativa
        $assinaturaAtiva = null;
        if ($this->usuarioLogado()) {
            $assinaturaAtiva = $this->assinaturaModel->getAssinaturaAtiva($this->usuarioLogado()->id);
        }

        $data = [
            'titulo' => 'Planos e Assinaturas',
            'planos' => $planos,
            'assinaturaAtiva' => $assinaturaAtiva,
        ];

        return view('Assinaturas/index', $data);
    }

    /**
     * Página de contratação de um plano
     */
    public function contratar($planoId)
    {
        // Verifica se usuário está logado
        if (!$this->usuarioLogado()) {
            return redirect()->to(site_url('login'))->with('erro', 'Faça login para assinar um plano.');
        }

        $plano = $this->planoModel->find($planoId);

        if (!$plano || !$plano->isAtivo()) {
            return redirect()->to(site_url('assinaturas'))->with('erro', 'Plano não encontrado.');
        }

        // Verifica se já tem assinatura ativa
        $assinaturaAtiva = $this->assinaturaModel->getAssinaturaAtiva($this->usuarioLogado()->id);
        if ($assinaturaAtiva) {
            return redirect()->to(site_url('assinaturas/minhas'))->with('info', 'Você já possui uma assinatura ativa.');
        }

        // Busca dados do cliente
        $cliente = $this->clienteModel->where('usuario_id', $this->usuarioLogado()->id)->first();

        $data = [
            'titulo' => 'Assinar ' . $plano->nome,
            'plano' => $plano,
            'cliente' => $cliente,
        ];

        return view('Assinaturas/contratar', $data);
    }

    /**
     * Processa a contratação de uma assinatura
     */
    public function processar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $retorno['token'] = csrf_hash();

        // Verifica se usuário está logado
        if (!$this->usuarioLogado()) {
            $retorno['erro'] = 'Sessão expirada. Faça login novamente.';
            return $this->response->setJSON($retorno);
        }

        $post = $this->request->getPost();

        // Validação básica
        if (empty($post['plano_id'])) {
            $retorno['erro'] = 'Plano não informado.';
            return $this->response->setJSON($retorno);
        }

        $plano = $this->planoModel->find($post['plano_id']);
        if (!$plano || !$plano->isAtivo()) {
            $retorno['erro'] = 'Plano inválido.';
            return $this->response->setJSON($retorno);
        }

        try {
            // Busca ou cria o cliente
            $cliente = $this->clienteModel->where('usuario_id', $this->usuarioLogado()->id)->first();
            
            if (!$cliente) {
                $retorno['erro'] = 'Cadastro de cliente não encontrado.';
                return $this->response->setJSON($retorno);
            }

            // Verifica se cliente tem customer_id no Asaas
            if (empty($cliente->customer_id)) {
                // Cria customer no Asaas
                $customerData = $this->asaasService->customers([
                    'nome' => $post['nome'] ?? $cliente->nome,
                    'email' => $post['email'] ?? $cliente->email,
                    'telefone' => preg_replace('/[^0-9]/', '', $post['telefone'] ?? $cliente->telefone),
                    'cpf' => preg_replace('/[^0-9]/', '', $post['cpf'] ?? $cliente->cpf),
                    'cep' => preg_replace('/[^0-9]/', '', $post['cep'] ?? ''),
                    'numero' => $post['numero'] ?? '',
                ]);

                if (isset($customerData['id'])) {
                    $cliente->customer_id = $customerData['id'];
                    $this->clienteModel->protect(false)->update($cliente->id, ['customer_id' => $customerData['id']]);
                } else {
                    $retorno['erro'] = 'Erro ao criar cliente no gateway de pagamento.';
                    return $this->response->setJSON($retorno);
                }
            }

            // Monta dados da assinatura
            $subscriptionData = [
                'customer_id' => $cliente->customer_id,
                'billing_type' => 'CREDIT_CARD',
                'value' => $plano->preco,
                'cycle' => $plano->ciclo,
                'description' => 'Assinatura ' . $plano->nome,
                'next_due_date' => date('Y-m-d'),
                'external_reference' => 'user_' . $this->usuarioLogado()->id,
                'credit_card' => [
                    'holder_name' => $post['holder_name'],
                    'number' => preg_replace('/[^0-9]/', '', $post['card_number']),
                    'expiry_month' => $post['expiry_month'],
                    'expiry_year' => $post['expiry_year'],
                    'ccv' => $post['ccv'],
                ],
                'holder_info' => [
                    'name' => $post['nome'] ?? $cliente->nome,
                    'email' => $post['email'] ?? $cliente->email,
                    'cpf_cnpj' => preg_replace('/[^0-9]/', '', $post['cpf'] ?? $cliente->cpf),
                    'postal_code' => preg_replace('/[^0-9]/', '', $post['cep'] ?? ''),
                    'address_number' => $post['numero'] ?? '',
                    'mobile_phone' => preg_replace('/[^0-9]/', '', $post['telefone'] ?? $cliente->telefone),
                ],
            ];

            // Cria assinatura no Asaas
            $asaasSubscription = $this->asaasService->createSubscription($subscriptionData);

            if (!$asaasSubscription || isset($asaasSubscription['errors'])) {
                $errorMsg = isset($asaasSubscription['errors'][0]['description']) 
                    ? $asaasSubscription['errors'][0]['description'] 
                    : 'Erro ao processar pagamento.';
                $retorno['erro'] = $errorMsg;
                log_message('error', 'Erro Asaas: ' . json_encode($asaasSubscription));
                return $this->response->setJSON($retorno);
            }

            // Calcula data de expiração baseada no ciclo
            $meses = $plano->ciclo === 'YEARLY' ? 12 : 1;
            $dataFim = date('Y-m-d H:i:s', strtotime("+{$meses} months"));

            // Cria assinatura no banco local
            $assinaturaId = $this->assinaturaModel->insert([
                'usuario_id' => $this->usuarioLogado()->id,
                'plano_id' => $plano->id,
                'asaas_subscription_id' => $asaasSubscription['id'],
                'asaas_customer_id' => $cliente->customer_id,
                'status' => 'ACTIVE',
                'data_inicio' => date('Y-m-d H:i:s'),
                'data_fim' => $dataFim,
                'proximo_vencimento' => $asaasSubscription['nextDueDate'] ?? date('Y-m-d', strtotime("+{$meses} months")),
                'valor_pago' => $plano->preco,
                'forma_pagamento' => 'CREDIT_CARD',
            ]);

            // Atualiza usuário como premium
            $this->usuarioModel->protect(false)->update($this->usuarioLogado()->id, [
                'is_premium' => 1,
                'premium_ate' => $dataFim,
                'asaas_subscription_id' => $asaasSubscription['id'],
            ]);

            $retorno['sucesso'] = 'Assinatura realizada com sucesso!';
            $retorno['redirect'] = site_url('assinaturas/confirmacao/' . $assinaturaId);

            return $this->response->setJSON($retorno);

        } catch (\Throwable $e) {
            log_message('error', 'Erro ao processar assinatura: ' . $e->getMessage());
            $retorno['erro'] = 'Erro inesperado. Tente novamente.';
            return $this->response->setJSON($retorno);
        }
    }

    /**
     * Página de confirmação da assinatura
     */
    public function confirmacao($assinaturaId)
    {
        if (!$this->usuarioLogado()) {
            return redirect()->to(site_url('login'));
        }

        $assinatura = $this->assinaturaModel->find($assinaturaId);

        if (!$assinatura || $assinatura->usuario_id != $this->usuarioLogado()->id) {
            return redirect()->to(site_url('assinaturas'))->with('erro', 'Assinatura não encontrada.');
        }

        $plano = $this->planoModel->find($assinatura->plano_id);

        $data = [
            'titulo' => 'Assinatura Confirmada',
            'assinatura' => $assinatura,
            'plano' => $plano,
        ];

        return view('Assinaturas/confirmacao', $data);
    }

    /**
     * Lista as assinaturas do usuário logado
     */
    public function minhasAssinaturas()
    {
        if (!$this->usuarioLogado()) {
            return redirect()->to(site_url('login'));
        }

        $assinaturas = $this->assinaturaModel->getAssinaturasComPlano($this->usuarioLogado()->id);

        $data = [
            'titulo' => 'Minhas Assinaturas',
            'assinaturas' => $assinaturas,
        ];

        return view('Assinaturas/minhas', $data);
    }

    /**
     * Cancela uma assinatura
     */
    public function cancelar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $retorno['token'] = csrf_hash();

        if (!$this->usuarioLogado()) {
            $retorno['erro'] = 'Sessão expirada.';
            return $this->response->setJSON($retorno);
        }

        $assinaturaId = $this->request->getPost('assinatura_id');
        $assinatura = $this->assinaturaModel->find($assinaturaId);

        if (!$assinatura || $assinatura->usuario_id != $this->usuarioLogado()->id) {
            $retorno['erro'] = 'Assinatura não encontrada.';
            return $this->response->setJSON($retorno);
        }

        if (!$assinatura->podeCancelar()) {
            $retorno['erro'] = 'Esta assinatura não pode ser cancelada.';
            return $this->response->setJSON($retorno);
        }

        try {
            // Cancela no Asaas
            if (!empty($assinatura->asaas_subscription_id)) {
                $this->asaasService->cancelSubscription($assinatura->asaas_subscription_id);
            }

            // Cancela localmente
            $this->assinaturaModel->cancelar($assinaturaId);

            // Remove premium do usuário
            $this->usuarioModel->protect(false)->update($this->usuarioLogado()->id, [
                'is_premium' => 0,
                'premium_ate' => null,
                'asaas_subscription_id' => null,
            ]);

            $retorno['sucesso'] = 'Assinatura cancelada com sucesso.';

        } catch (\Throwable $e) {
            log_message('error', 'Erro ao cancelar assinatura: ' . $e->getMessage());
            $retorno['erro'] = 'Erro ao cancelar assinatura.';
        }

        return $this->response->setJSON($retorno);
    }

    /**
     * Detalhes de uma assinatura específica
     */
    public function detalhes($assinaturaId)
    {
        if (!$this->usuarioLogado()) {
            return redirect()->to(site_url('login'));
        }

        $assinatura = $this->assinaturaModel->find($assinaturaId);

        if (!$assinatura || $assinatura->usuario_id != $this->usuarioLogado()->id) {
            return redirect()->to(site_url('assinaturas/minhas'))->with('erro', 'Assinatura não encontrada.');
        }

        $plano = $this->planoModel->find($assinatura->plano_id);

        $data = [
            'titulo' => 'Detalhes da Assinatura',
            'assinatura' => $assinatura,
            'plano' => $plano,
        ];

        return view('Assinaturas/detalhes', $data);
    }

    // ========================================
    // ÁREA ADMINISTRATIVA
    // ========================================

    /**
     * Admin - Lista todas as assinaturas
     */
    public function admin()
    {
        if (!$this->usuarioLogado() || !$this->usuarioLogado()->is_admin) {
            return redirect()->to(site_url('home'));
        }

        $assinaturas = $this->assinaturaModel
            ->select('assinaturas.*, usuarios.nome as usuario_nome, usuarios.email as usuario_email, planos.nome as plano_nome')
            ->join('usuarios', 'usuarios.id = assinaturas.usuario_id')
            ->join('planos', 'planos.id = assinaturas.plano_id')
            ->orderBy('assinaturas.created_at', 'DESC')
            ->findAll();

        $data = [
            'titulo' => 'Gerenciar Assinaturas',
            'assinaturas' => $assinaturas,
        ];

        return view('Assinaturas/admin', $data);
    }

    /**
     * Admin - Gerenciar planos
     */
    public function adminPlanos()
    {
        if (!$this->usuarioLogado() || !$this->usuarioLogado()->is_admin) {
            return redirect()->to(site_url('home'));
        }

        $planos = $this->planoModel->findAll();

        $data = [
            'titulo' => 'Gerenciar Planos',
            'planos' => $planos,
        ];

        return view('Assinaturas/admin_planos', $data);
    }
}
