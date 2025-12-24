<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Cupom extends Entity
{
    protected $attributes = [
        'id' => null,
        'evento_id' => null,
        'nome' => null,
        'codigo' => null,
        'desconto' => null,
        'tipo' => null,
        'valor_minimo' => null,
        'quantidade_total' => null,
        'quantidade_usada' => null,
        'uso_por_usuario' => null,
        'data_inicio' => null,
        'data_fim' => null,
        'ativo' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'data_inicio',
        'data_fim',
    ];

    protected $casts = [
        'id' => 'integer',
        'evento_id' => '?integer',
        'desconto' => 'float',
        'valor_minimo' => '?float',
        'quantidade_total' => '?integer',
        'quantidade_usada' => 'integer',
        'uso_por_usuario' => '?integer',
        'ativo' => 'boolean',
    ];

    /**
     * Retorna o desconto formatado (ex: "10%" ou "R$ 15,00")
     *
     * @return string
     */
    public function getDescontoFormatado(): string
    {
        if ($this->attributes['tipo'] === 'percentual') {
            return number_format($this->attributes['desconto'], 0) . '%';
        }
        
        return 'R$ ' . number_format($this->attributes['desconto'], 2, ',', '.');
    }

    /**
     * Retorna se o cupom está ativo e dentro do período de validade
     *
     * @return bool
     */
    public function estaValido(): bool
    {
        // Verifica se está ativo
        if (!$this->attributes['ativo']) {
            return false;
        }

        $hoje = date('Y-m-d');

        // Verifica data de início
        if ($this->attributes['data_inicio']) {
            $dataInicio = date('Y-m-d', strtotime($this->attributes['data_inicio']));
            if ($dataInicio > $hoje) {
                return false;
            }
        }

        // Verifica data de fim
        if ($this->attributes['data_fim']) {
            $dataFim = date('Y-m-d', strtotime($this->attributes['data_fim']));
            if ($dataFim < $hoje) {
                return false;
            }
        }

        return true;
    }

    /**
     * Verifica se o cupom atingiu o limite de uso
     *
     * @return bool
     */
    public function atingiuLimite(): bool
    {
        if ($this->attributes['quantidade_total'] === null) {
            return false; // Sem limite
        }

        return $this->attributes['quantidade_usada'] >= $this->attributes['quantidade_total'];
    }

    /**
     * Retorna a situação do cupom para exibição
     *
     * @return string HTML com badge de status
     */
    public function exibeSituacao(): string
    {
        if ($this->attributes['deleted_at'] != null) {
            $icone = '<span class="text-white">Excluído</span>&nbsp;<i class="fa fa-undo"></i>&nbsp;Desfazer';
            $situacao = anchor("cupons/desfazerexclusao/{$this->attributes['id']}", $icone, ['class' => 'btn btn-outline-success btn-sm']);
            return $situacao;
        }

        if (!$this->attributes['ativo']) {
            return '<span class="badge bg-secondary"><i class="fa fa-times"></i>&nbsp;Inativo</span>';
        }

        if ($this->atingiuLimite()) {
            return '<span class="badge bg-danger"><i class="fa fa-ban"></i>&nbsp;Esgotado</span>';
        }

        if (!$this->estaValido()) {
            return '<span class="badge bg-warning text-dark"><i class="fa fa-clock"></i>&nbsp;Expirado</span>';
        }

        return '<span class="badge bg-success"><i class="fa fa-thumbs-up"></i>&nbsp;Disponível</span>';
    }

    /**
     * Retorna informações de uso
     *
     * @return string
     */
    public function getInfoUso(): string
    {
        $usado = $this->attributes['quantidade_usada'] ?? 0;
        $total = $this->attributes['quantidade_total'];

        if ($total === null) {
            return "{$usado} usos (ilimitado)";
        }

        return "{$usado}/{$total} usos";
    }

    /**
     * Retorna período de validade formatado
     *
     * @return string
     */
    public function getPeriodoValidade(): string
    {
        $inicio = $this->attributes['data_inicio'];
        $fim = $this->attributes['data_fim'];

        if (!$inicio && !$fim) {
            return 'Sem restrição de data';
        }

        $inicioFormatado = $inicio ? date('d/m/Y', strtotime($inicio)) : 'Início imediato';
        $fimFormatado = $fim ? date('d/m/Y', strtotime($fim)) : 'Sem data limite';

        return "{$inicioFormatado} até {$fimFormatado}";
    }
}
