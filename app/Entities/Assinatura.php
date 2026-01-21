<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Assinatura extends Entity
{
    protected $dates = [
        'data_inicio',
        'data_fim',
        'proximo_vencimento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'usuario_id' => 'integer',
        'plano_id' => 'integer',
        'valor_pago' => 'float',
    ];

    /**
     * Verifica se a assinatura está ativa
     *
     * @return bool
     */
    public function isAtiva(): bool
    {
        if ($this->status !== 'ACTIVE') {
            return false;
        }

        // Se tem data_fim, verifica se ainda não expirou
        if (!empty($this->data_fim)) {
            return strtotime($this->data_fim) >= time();
        }

        return true;
    }

    /**
     * Retorna os dias restantes da assinatura
     *
     * @return int
     */
    public function getDiasRestantes(): int
    {
        if (empty($this->data_fim)) {
            return 0;
        }

        $dataFim = strtotime($this->data_fim);
        $hoje = time();

        if ($dataFim <= $hoje) {
            return 0;
        }

        return (int) ceil(($dataFim - $hoje) / 86400);
    }

    /**
     * Retorna o label de status formatado
     *
     * @return string
     */
    public function getStatusLabel(): string
    {
        $labels = [
            'PENDING' => 'Pendente',
            'ACTIVE' => 'Ativa',
            'OVERDUE' => 'Atrasada',
            'CANCELLED' => 'Cancelada',
            'EXPIRED' => 'Expirada',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Retorna a classe CSS do badge de status
     *
     * @return string
     */
    public function getStatusBadgeClass(): string
    {
        $classes = [
            'PENDING' => 'warning',
            'ACTIVE' => 'success',
            'OVERDUE' => 'danger',
            'CANCELLED' => 'secondary',
            'EXPIRED' => 'dark',
        ];

        return $classes[$this->status] ?? 'secondary';
    }

    /**
     * Retorna o valor pago formatado
     *
     * @return string
     */
    public function getValorPagoFormatado(): string
    {
        return 'R$ ' . number_format($this->valor_pago, 2, ',', '.');
    }

    /**
     * Retorna a data do próximo vencimento formatada
     *
     * @return string
     */
    public function getProximoVencimentoFormatado(): string
    {
        if (empty($this->proximo_vencimento)) {
            return '-';
        }

        return date('d/m/Y', strtotime($this->proximo_vencimento));
    }

    /**
     * Retorna a data de início formatada
     *
     * @return string
     */
    public function getDataInicioFormatada(): string
    {
        if (empty($this->data_inicio)) {
            return '-';
        }

        return date('d/m/Y', strtotime($this->data_inicio));
    }

    /**
     * Verifica se a assinatura pode ser cancelada
     *
     * @return bool
     */
    public function podeCancelar(): bool
    {
        return in_array($this->status, ['ACTIVE', 'PENDING', 'OVERDUE']);
    }
}
