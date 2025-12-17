<?php

namespace App\Models;

use CodeIgniter\Model;

class RefoundModel extends Model
{
    protected $table = 'refounds';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = [
        'pedido_id',
        'cliente_id',
        'tipo_solicitacao',
        'aceito',
        'pedido_codigo',
        'pedido_valor_total',
        'pedido_data_compra',
        'pedido_forma_pagamento',
        'pedido_status',
        'cliente_nome',
        'cliente_email',
        'evento_id',
        'evento_nome',
        'evento_data_inicio',
        'ingressos_originais',
        'tipo_upgrade',
        'oferta_titulo',
        'oferta_subtitulo',
        'oferta_vantagem_valor',
        'opcao_selecionada',
        'oferta_detalhes',
        'beneficios_apresentados',
        'ingressos_para_upgrade',
        'ip_solicitacao',
        'user_agent',
        'observacoes',
        'status',
        'processado_em',
        'processado_por',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /**
     * Salva uma solicitação de upgrade aceita
     */
    public function salvarUpgradeAceito($dados)
    {
        $dados['tipo_solicitacao'] = 'upgrade';
        $dados['aceito'] = 1;
        $dados['status'] = 'pendente';
        
        return $this->insert($dados);
    }

    /**
     * Salva uma solicitação de reembolso (upgrade recusado)
     */
    public function salvarReembolso($dados)
    {
        $dados['tipo_solicitacao'] = 'reembolso';
        $dados['aceito'] = 0;
        $dados['status'] = 'pendente';
        
        return $this->insert($dados);
    }

    /**
     * Busca solicitações pendentes
     */
    public function getSolicitacoesPendentes()
    {
        return $this->where('status', 'pendente')
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    /**
     * Busca solicitações por pedido
     */
    public function getPorPedido($pedidoId)
    {
        return $this->where('pedido_id', $pedidoId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Marca como processado
     */
    public function marcarProcessado($id, $adminId = null)
    {
        return $this->update($id, [
            'status' => 'concluido',
            'processado_em' => date('Y-m-d H:i:s'),
            'processado_por' => $adminId,
        ]);
    }

    /**
     * Lista todos os refunds de um cliente
     */
    public function listaRefoundsPorCliente($cliente_id)
    {
        return $this->select(['refounds.*'])
            ->where('cliente_id', $cliente_id)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Conta refunds pendentes de um cliente
     */
    public function contaRefoundsPendentesPorCliente($cliente_id)
    {
        return $this->where('cliente_id', $cliente_id)
                    ->where('status', 'pendente')
                    ->countAllResults();
    }
}
