<?php

namespace App\Models;

use CodeIgniter\Model;

class AssinaturaModel extends Model
{
    protected $table = 'assinaturas';
    protected $returnType = 'App\Entities\Assinatura';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'usuario_id',
        'plano_id',
        'asaas_subscription_id',
        'asaas_customer_id',
        'status',
        'data_inicio',
        'data_fim',
        'proximo_vencimento',
        'valor_pago',
        'forma_pagamento',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /**
     * Retorna a assinatura ativa de um usuário
     *
     * @param int $usuarioId
     * @return object|null
     */
    public function getAssinaturaAtiva(int $usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
            ->where('status', 'ACTIVE')
            ->first();
    }

    /**
     * Busca assinatura pelo ID do Asaas
     *
     * @param string $subscriptionId
     * @return object|null
     */
    public function getByAsaasId(string $subscriptionId)
    {
        return $this->where('asaas_subscription_id', $subscriptionId)
            ->first();
    }

    /**
     * Retorna todas as assinaturas de um usuário
     *
     * @param int $usuarioId
     * @return array
     */
    public function getAssinaturasDoUsuario(int $usuarioId): array
    {
        return $this->where('usuario_id', $usuarioId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Retorna assinaturas com plano (join)
     *
     * @param int $usuarioId
     * @return array
     */
    public function getAssinaturasComPlano(int $usuarioId): array
    {
        return $this->select('assinaturas.*, planos.nome as plano_nome, planos.ciclo as plano_ciclo')
            ->join('planos', 'planos.id = assinaturas.plano_id')
            ->where('assinaturas.usuario_id', $usuarioId)
            ->orderBy('assinaturas.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Atualiza o status de uma assinatura
     *
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function atualizarStatus(int $id, string $status): bool
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Cancela uma assinatura
     *
     * @param int $id
     * @return bool
     */
    public function cancelar(int $id): bool
    {
        return $this->update($id, [
            'status' => 'CANCELLED',
            'data_fim' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Ativa uma assinatura
     *
     * @param int $id
     * @param string $ciclo
     * @return bool
     */
    public function ativar(int $id, string $ciclo = 'MONTHLY'): bool
    {
        $meses = $ciclo === 'YEARLY' ? 12 : 1;
        $dataFim = date('Y-m-d H:i:s', strtotime("+{$meses} months"));
        $proximoVencimento = date('Y-m-d', strtotime("+{$meses} months"));

        return $this->update($id, [
            'status' => 'ACTIVE',
            'data_inicio' => date('Y-m-d H:i:s'),
            'data_fim' => $dataFim,
            'proximo_vencimento' => $proximoVencimento,
        ]);
    }

    /**
     * Busca assinaturas que vencem em X dias (para notificações)
     *
     * @param int $dias
     * @return array
     */
    public function getAssinaturasVencendoEm(int $dias): array
    {
        $dataLimite = date('Y-m-d', strtotime("+{$dias} days"));
        
        return $this->where('status', 'ACTIVE')
            ->where('proximo_vencimento', $dataLimite)
            ->findAll();
    }

    /**
     * Busca assinaturas expiradas que precisam ser atualizadas
     *
     * @return array
     */
    public function getAssinaturasExpiradas(): array
    {
        return $this->where('status', 'ACTIVE')
            ->where('data_fim <', date('Y-m-d H:i:s'))
            ->findAll();
    }
}
