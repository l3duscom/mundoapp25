<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderBump extends Entity
{
    protected $attributes = [
        'id'             => null,
        'event_id'       => null,
        'ticket_id'      => null,
        'nome'           => null,
        'descricao'      => null,
        'preco'          => null,
        'imagem'         => null,
        'tipo'           => null,
        'estoque'        => null,
        'max_por_pedido' => null,
        'ordem'          => null,
        'ativo'          => null,
        'created_at'     => null,
        'updated_at'     => null,
        'deleted_at'     => null,
    ];

    protected $casts = [
        'id'             => 'integer',
        'event_id'       => 'integer',
        'ticket_id'      => '?integer',
        'preco'          => 'float',
        'estoque'        => 'integer',
        'max_por_pedido' => 'integer',
        'ordem'          => 'integer',
        'ativo'          => 'boolean',
    ];

    protected $datamap = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Retorna o preço formatado em Real
     * 
     * @return string
     */
    public function getPrecoFormatado(): string
    {
        return 'R$ ' . number_format($this->attributes['preco'], 2, ',', '.');
    }

    /**
     * Retorna a URL da imagem ou uma imagem padrão
     * 
     * @return string
     */
    public function getImagemUrl(): string
    {
        if (!empty($this->attributes['imagem'])) {
            // Se já for uma URL externa completa
            if (strpos($this->attributes['imagem'], 'http') === 0) {
                return $this->attributes['imagem'];
            }
            // Imagens ficam no backoffice externo
            return 'https://backoffice.mundodream.com.br/uploads/order_bumps/' . $this->attributes['imagem'];
        }
        return site_url('recursos/front/images/placeholder.png');
    }

    /**
     * Verifica se há estoque disponível
     * 
     * @return bool
     */
    public function temEstoque(): bool
    {
        return $this->attributes['estoque'] > 0;
    }
}
