<?php

namespace App\Controllers;

use App\Controllers\BaseController;

/**
 * Controller para a página pública de cancelamento
 */
class Cancelamento extends BaseController
{
    private $pedidoModel;
    private $clienteModel;
    private $ingressoModel;
    private $eventoModel;
    private $refoundModel;

    public function __construct()
    {
        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->clienteModel = new \App\Models\ClienteModel();
        $this->ingressoModel = new \App\Models\IngressoModel();
        $this->eventoModel = new \App\Models\EventoModel();
        $this->refoundModel = new \App\Models\RefoundModel();
    }

    /**
     * Exibe a página de cancelamento
     *
     * @return string
     */
    public function index()
    {
        $data = [
            'titulo' => 'Cancelamento',
        ];

        return view('Cancelamento/index', $data);
    }

    /**
     * Localiza o pedido pelo email e código
     *
     * @return string
     */
    public function localizar()
    {
        $post = $this->request->getPost();
        
        $email = trim($post['email'] ?? '');
        $codigo_pedido = trim($post['codigo_transacao'] ?? '');
        
        // Validações básicas
        if (empty($email) || empty($codigo_pedido)) {
            return redirect()->back()
                ->with('erro', 'Por favor, preencha todos os campos.')
                ->withInput();
        }
        
        // Buscar cliente pelo email
        $cliente = $this->clienteModel
            ->where('email', $email)
            ->first();
        
        if (!$cliente) {
            return redirect()->back()
                ->with('erro', 'Não encontramos nenhuma compra com este email.')
                ->withInput();
        }
        
        // Buscar pedidos do cliente
        $pedidos = $this->pedidoModel
            ->where('user_id', $cliente->usuario_id)
            ->findAll();
        
        if (empty($pedidos)) {
            return redirect()->back()
                ->with('erro', 'Não encontramos nenhum pedido associado a este email.')
                ->withInput();
        }
        
        // Verificar se algum pedido tem o código informado
        $pedidoEncontrado = null;
        foreach ($pedidos as $pedido) {
            if ($pedido->codigo === $codigo_pedido) {
                $pedidoEncontrado = $pedido;
                break;
            }
        }
        
        if (!$pedidoEncontrado) {
            return redirect()->back()
                ->with('erro', 'O número do pedido informado não corresponde a nenhuma compra deste email.')
                ->withInput();
        }
        
        // VERIFICAR SE JÁ EXISTE SOLICITAÇÃO PARA ESTE PEDIDO
        $solicitacaoExistente = $this->refoundModel
            ->where('pedido_id', $pedidoEncontrado->id)
            ->where('deleted_at IS NULL')
            ->first();
        
        if ($solicitacaoExistente) {
            // Já existe solicitação - mostrar mensagem apropriada
            $tipoSolicitacao = $solicitacaoExistente->tipo_solicitacao === 'upgrade' 
                ? 'upgrade de ingresso' 
                : 'reembolso';
            $dataFormatada = date('d/m/Y \à\s H:i', strtotime($solicitacaoExistente->created_at));
            
            return redirect()->back()
                ->with('erro', "Já existe uma solicitação de {$tipoSolicitacao} registrada para este pedido em {$dataFormatada}. Cada pedido só pode ter uma solicitação. Se precisar de ajuda, entre em contato com nosso suporte.")
                ->withInput();
        }
        
        // Buscar dados do evento
        $evento = $this->eventoModel->find($pedidoEncontrado->evento_id);
        
        // Buscar ingressos do pedido
        $ingressos = $this->ingressoModel
            ->where('pedido_id', $pedidoEncontrado->id)
            ->findAll();
        
        $data = [
            'titulo' => 'Cancelamento',
            'pedido' => $pedidoEncontrado,
            'cliente' => $cliente,
            'evento' => $evento,
            'ingressos' => $ingressos,
            'step' => 2, // Avançar para step 2 (Verificação de segurança)
        ];
        
        return view('Cancelamento/verificacao', $data);
    }

    /**
     * Exibe a tela de upgrade de ingresso (para tickets de exceção)
     *
     * @return string
     */
    public function upgrade()
    {
        $post = $this->request->getPost();
        
        $pedido_id = $post['pedido_id'] ?? null;
        
        if (!$pedido_id) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Pedido não encontrado.');
        }
        
        // Buscar pedido
        $pedido = $this->pedidoModel->find($pedido_id);
        
        if (!$pedido) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Pedido não encontrado.');
        }
        
        // VERIFICAR SE JÁ EXISTE SOLICITAÇÃO PARA ESTE PEDIDO
        $solicitacaoExistente = $this->refoundModel
            ->where('pedido_id', $pedido->id)
            ->where('deleted_at IS NULL')
            ->first();
        
        if ($solicitacaoExistente) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Já existe uma solicitação registrada para este pedido. Cada pedido só pode ter uma solicitação.');
        }
        
        // Buscar cliente
        $cliente = $this->clienteModel
            ->where('usuario_id', $pedido->user_id)
            ->first();
        
        // Buscar evento
        $evento = $this->eventoModel->find($pedido->evento_id);
        
        // Buscar ingressos
        $ingressos = $this->ingressoModel
            ->where('pedido_id', $pedido->id)
            ->findAll();
        
        $data = [
            'titulo' => 'Upgrade de Ingresso',
            'pedido' => $pedido,
            'cliente' => $cliente,
            'evento' => $evento,
            'ingressos' => $ingressos,
        ];
        
        return view('Cancelamento/upgrade', $data);
    }

    /**
     * Processa solicitação de reembolso para tickets normais (sem exceção)
     *
     * @return string
     */
    public function solicitarReembolso()
    {
        $post = $this->request->getPost();
        
        $pedido_id = $post['pedido_id'] ?? null;
        
        if (!$pedido_id) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Pedido não encontrado.');
        }
        
        // Buscar pedido
        $pedido = $this->pedidoModel->find($pedido_id);
        
        if (!$pedido) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Pedido não encontrado.');
        }
        
        // VERIFICAR SE JÁ EXISTE SOLICITAÇÃO PARA ESTE PEDIDO
        $solicitacaoExistente = $this->refoundModel
            ->where('pedido_id', $pedido->id)
            ->where('deleted_at IS NULL')
            ->first();
        
        if ($solicitacaoExistente) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Já existe uma solicitação registrada para este pedido. Cada pedido só pode ter uma solicitação.');
        }
        
        // Buscar cliente
        $cliente = $this->clienteModel
            ->where('usuario_id', $pedido->user_id)
            ->first();
        
        // Buscar evento
        $evento = $this->eventoModel->find($pedido->evento_id);
        
        // Buscar ingressos
        $ingressos = $this->ingressoModel
            ->where('pedido_id', $pedido->id)
            ->findAll();
        
        // Preparar dados para salvar
        $dadosRefound = [
            'pedido_id' => $pedido->id,
            'cliente_id' => $cliente->id ?? null,
            'tipo_solicitacao' => 'reembolso',
            'aceito' => 0,
            'pedido_codigo' => $pedido->codigo,
            'pedido_valor_total' => $pedido->total,
            'pedido_data_compra' => $pedido->created_at,
            'pedido_forma_pagamento' => $pedido->forma_pagamento,
            'pedido_status' => $pedido->status,
            'cliente_nome' => $cliente->nome ?? null,
            'cliente_email' => $cliente->email ?? null,
            'evento_id' => $evento->id ?? null,
            'evento_nome' => $evento->nome ?? null,
            'evento_data_inicio' => $evento->data_inicio ?? null,
            'ingressos_originais' => json_encode(array_map(function($ing) {
                return [
                    'id' => $ing->id,
                    'nome' => $ing->nome,
                    'codigo' => $ing->codigo,
                    'ticket_id' => $ing->ticket_id,
                    'valor' => $ing->valor,
                ];
            }, $ingressos)),
            'tipo_upgrade' => null,
            'oferta_titulo' => null,
            'oferta_subtitulo' => null,
            'oferta_vantagem_valor' => null,
            'opcao_selecionada' => null,
            'oferta_detalhes' => null,
            'beneficios_apresentados' => null,
            'ingressos_para_upgrade' => null,
            'ip_solicitacao' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'observacoes' => 'Solicitação direta de reembolso (ticket normal, sem oferta de upgrade)',
            'status' => 'pendente',
        ];
        
        // Salvar no banco
        $this->refoundModel->insert($dadosRefound);
        
        // Exibir tela de confirmação
        $data = [
            'titulo' => 'Solicitação de Reembolso',
            'pedido' => $pedido,
            'cliente' => $cliente,
            'evento' => $evento,
            'ingressos' => $ingressos,
        ];
        
        return view('Cancelamento/reembolso_confirmado', $data);
    }

    /**
     * Processa a decisão do upgrade
     *
     * @return string
     */
    public function processarUpgrade()
    {
        $post = $this->request->getPost();
        
        $pedido_id = $post['pedido_id'] ?? null;
        $aceita_upgrade = $post['aceita_upgrade'] ?? null;
        $opcao_selecionada = $post['opcao_selecionada'] ?? 0;
        
        if (!$pedido_id) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Pedido não encontrado.');
        }
        
        // Buscar pedido
        $pedido = $this->pedidoModel->find($pedido_id);
        
        if (!$pedido) {
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Pedido não encontrado.');
        }
        
        // VERIFICAR SE JÁ EXISTE SOLICITAÇÃO PARA ESTE PEDIDO (evita duplo submit)
        $solicitacaoExistente = $this->refoundModel
            ->where('pedido_id', $pedido->id)
            ->where('deleted_at IS NULL')
            ->first();
        
        if ($solicitacaoExistente) {
            // Já existe - mostrar tela de sucesso se foi upgrade, ou mensagem de erro
            if ($solicitacaoExistente->tipo_solicitacao === 'upgrade' && $solicitacaoExistente->aceito == 1) {
                return redirect()->to(site_url('cancelamento'))
                    ->with('sucesso', 'Seu upgrade já foi registrado anteriormente com sucesso!');
            }
            return redirect()->to(site_url('cancelamento'))
                ->with('erro', 'Já existe uma solicitação registrada para este pedido. Cada pedido só pode ter uma solicitação.');
        }
        
        // Buscar cliente
        $cliente = $this->clienteModel
            ->where('usuario_id', $pedido->user_id)
            ->first();
        
        // Buscar evento
        $evento = $this->eventoModel->find($pedido->evento_id);
        
        // Buscar ingressos
        $ingressos = $this->ingressoModel
            ->where('pedido_id', $pedido->id)
            ->findAll();
        
        // Calcular as ofertas (mesma lógica da view)
        $ticketIdsExcecao = [608, 1113, 1114, 1115, 1116, 1117, 1118, 1119, 1123, 1124];
        $ingressosParaUpgrade = [];
        $ganhoTotal = 0;
        
        foreach ($ingressos as $ingresso) {
            if (isset($ingresso->ticket_id) && in_array((int)$ingresso->ticket_id, $ticketIdsExcecao)) {
                $oferta = $this->getOfertaParaTicket((int)$ingresso->ticket_id);
                $ingressosParaUpgrade[] = [
                    'ingresso_id' => $ingresso->id,
                    'ingresso_nome' => $ingresso->nome,
                    'ingresso_codigo' => $ingresso->codigo,
                    'ticket_id' => $ingresso->ticket_id,
                    'valor_original' => $ingresso->valor,
                    'oferta' => $oferta,
                ];
                $ganhoTotal += $oferta['ganho'];
            }
        }
        
        // Identificar tipo principal
        $tipoUpgradePrincipal = 'EPIC PASS';
        foreach ($ingressosParaUpgrade as $item) {
            if ($item['oferta']['tipo'] === 'VIP FULL') {
                $tipoUpgradePrincipal = 'VIP FULL';
                break;
            }
        }
        
        // Montar título da oferta
        $resumoOfertas = [];
        foreach ($ingressosParaUpgrade as $item) {
            $tipo = $item['oferta']['tipo'];
            if (!isset($resumoOfertas[$tipo])) {
                $resumoOfertas[$tipo] = 0;
            }
            $resumoOfertas[$tipo] += $item['oferta']['quantidade'];
        }
        $tituloOfertaResumo = [];
        foreach ($resumoOfertas as $tipo => $qtd) {
            $tituloOfertaResumo[] = $qtd . 'x ' . $tipo;
        }
        $tituloOfertaFinal = implode(' + ', $tituloOfertaResumo);
        
        // Benefícios apresentados
        $beneficios = $tipoUpgradePrincipal === 'EPIC PASS' 
            ? [
                'Fila preferencial (Entrada e Food Park)',
                'Acesso 1 hora de antecedência',
                'Pulseira Colecionável',
                'Credencial + Cordão Colecionável',
                'Pôster Oficial',
                'Até 30% de desconto em lojinhas',
                'Frontstage - Acesso às primeiras fileiras',
                'Meet & Greet com convidados especiais',
                'Validade de 2 anos',
            ]
            : [
                'Fila preferencial (Entrada e Food Park)',
                'Acesso 1 hora de antecedência',
                '1 Ingresso Cinemark Cortesia',
                'Pulseira Colecionável',
                'Credencial + Cordão Colecionável',
                'Copo EXCLUSIVO Colecionável',
                'Ingresso Holográfico EXCLUSIVO',
                'Pôster Oficial',
                'Meet & Greet com todos os convidados',
                'Até 30% de desconto em lojinhas',
                'Sala VIP climatizada com convidados',
                'Espaço Diversão na sala VIP',
                'Frontstage nas primeiras fileiras',
                'Alimentação inclusa na sala VIP',
                'Rodízio de Pizza das 13h às 16h',
                'Validade de 2 anos',
            ];
        
        // Preparar dados para salvar
        $refoundModel = new \App\Models\RefoundModel();
        
        $dadosRefound = [
            'pedido_id' => $pedido->id,
            'cliente_id' => $cliente->id ?? null,
            'pedido_codigo' => $pedido->codigo,
            'pedido_valor_total' => $pedido->total,
            'pedido_data_compra' => $pedido->created_at,
            'pedido_forma_pagamento' => $pedido->forma_pagamento,
            'pedido_status' => $pedido->status,
            'cliente_nome' => $cliente->nome ?? null,
            'cliente_email' => $cliente->email ?? null,
            'evento_id' => $evento->id ?? null,
            'evento_nome' => $evento->nome ?? null,
            'evento_data_inicio' => $evento->data_inicio ?? null,
            'ingressos_originais' => json_encode(array_map(function($ing) {
                return [
                    'id' => $ing->id,
                    'nome' => $ing->nome,
                    'codigo' => $ing->codigo,
                    'ticket_id' => $ing->ticket_id,
                    'valor' => $ing->valor,
                ];
            }, $ingressos)),
            'tipo_upgrade' => $tipoUpgradePrincipal,
            'oferta_titulo' => $tituloOfertaFinal,
            'oferta_subtitulo' => 'Upgrade automático para todos os ingressos do pedido',
            'oferta_vantagem_valor' => $ganhoTotal,
            'opcao_selecionada' => $opcao_selecionada,
            'oferta_detalhes' => json_encode([
                'tipo_principal' => $tipoUpgradePrincipal,
                'ganho_total' => $ganhoTotal,
                'resumo_ofertas' => $resumoOfertas,
            ]),
            'beneficios_apresentados' => json_encode($beneficios),
            'ingressos_para_upgrade' => json_encode($ingressosParaUpgrade),
            'ip_solicitacao' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
        ];
        
        if ($aceita_upgrade === '1') {
            // Usuário aceitou o upgrade - salvar como upgrade aceito
            $refoundModel->salvarUpgradeAceito($dadosRefound);
            
            $data = [
                'titulo' => 'Upgrade Confirmado',
                'pedido' => $pedido,
                'cliente' => $cliente,
                'evento' => $evento,
                'ingressos' => $ingressos,
                'opcao_selecionada' => $opcao_selecionada,
                'tipo_upgrade' => $tipoUpgradePrincipal,
                'oferta_titulo' => $tituloOfertaFinal,
                'ganho_total' => $ganhoTotal,
                'sucesso' => true,
            ];
            
            return view('Cancelamento/upgrade_sucesso', $data);
        } else {
            // Usuário recusou o upgrade - salvar como reembolso
            $refoundModel->salvarReembolso($dadosRefound);
            
            $data = [
                'titulo' => 'Solicitação de Reembolso',
                'pedido' => $pedido,
                'cliente' => $cliente,
                'evento' => $evento,
                'ingressos' => $ingressos,
            ];
            
            return view('Cancelamento/reembolso_confirmado', $data);
        }
    }

    /**
     * Retorna a oferta baseada no ticket_id
     */
    private function getOfertaParaTicket($ticketId)
    {
        switch ($ticketId) {
            case 1114:
            case 1124:
                return [
                    'titulo' => '2x Ingressos VIP FULL',
                    'subtitulo' => 'Experiência máxima no Dreamfest ou Anime Expo',
                    'ganho' => 296,
                    'quantidade' => 2,
                    'tipo' => 'VIP FULL',
                ];
                
            case 1113:
                return [
                    'titulo' => '1x Ingresso VIP FULL',
                    'subtitulo' => 'Experiência máxima no Dreamfest ou Anime Expo',
                    'ganho' => 199,
                    'quantidade' => 1,
                    'tipo' => 'VIP FULL',
                ];
                
            case 1115:
                return [
                    'titulo' => '1x Ingresso VIP FULL',
                    'subtitulo' => 'Experiência máxima no Dreamfest ou Anime Expo',
                    'ganho' => 244,
                    'quantidade' => 1,
                    'tipo' => 'VIP FULL',
                ];
                
            case 1116:
                return [
                    'titulo' => '2x Ingressos VIP FULL',
                    'subtitulo' => 'Experiência máxima para você e um acompanhante',
                    'ganho' => 398,
                    'quantidade' => 2,
                    'tipo' => 'VIP FULL',
                ];
                
            default:
                return [
                    'titulo' => '1x EPIC PASS',
                    'subtitulo' => 'Acesso especial ao próximo evento',
                    'ganho' => 99,
                    'quantidade' => 1,
                    'tipo' => 'EPIC PASS',
                ];
        }
    }
}

