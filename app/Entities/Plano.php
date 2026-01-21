<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Plano extends Entity
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'preco' => 'float',
        'ativo' => 'boolean',
    ];

    /**
     * Retorna os benefícios como array
     *
     * @return array
     */
    public function getBeneficios(): array
    {
        if (empty($this->attributes['beneficios'])) {
            return [];
        }

        $beneficios = json_decode($this->attributes['beneficios'], true);
        return is_array($beneficios) ? $beneficios : [];
    }

    /**
     * Define os benefícios a partir de um array
     *
     * @param array $beneficios
     * @return $this
     */
    public function setBeneficios(array $beneficios)
    {
        $this->attributes['beneficios'] = json_encode($beneficios);
        return $this;
    }

    /**
     * Retorna o preço formatado em Real
     *
     * @return string
     */
    public function getPrecoFormatado(): string
    {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }

    /**
     * Retorna o ciclo formatado
     *
     * @return string
     */
    public function getCicloFormatado(): string
    {
        return $this->ciclo === 'MONTHLY' ? 'Mensal' : 'Anual';
    }

    /**
     * Retorna o preço por mês (útil para comparação de planos anuais)
     *
     * @return float
     */
    public function getPrecoPorMes(): float
    {
        if ($this->ciclo === 'YEARLY') {
            return $this->preco / 12;
        }
        return $this->preco;
    }

    /**
     * Retorna o preço por mês formatado
     *
     * @return string
     */
    public function getPrecoPorMesFormatado(): string
    {
        return 'R$ ' . number_format($this->getPrecoPorMes(), 2, ',', '.');
    }

    /**
     * Verifica se o plano está ativo
     *
     * @return bool
     */
    public function isAtivo(): bool
    {
        return $this->ativo == true;
    }
}
