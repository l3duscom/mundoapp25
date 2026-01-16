<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class FooterSetting extends Entity
{
    protected $attributes = [
        'id' => null,
        'chave' => null,
        'valor' => null,
        'tipo' => 'text',
        'descricao' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Retorna o valor processado conforme o tipo
     */
    public function getValorProcessado()
    {
        if ($this->attributes['tipo'] === 'json') {
            return json_decode($this->attributes['valor'], true) ?? [];
        }
        
        return $this->attributes['valor'];
    }

    /**
     * Verifica se é uma configuração de imagem
     */
    public function isImagem(): bool
    {
        return $this->attributes['tipo'] === 'image';
    }

    /**
     * Verifica se é uma configuração JSON
     */
    public function isJson(): bool
    {
        return $this->attributes['tipo'] === 'json';
    }
}
