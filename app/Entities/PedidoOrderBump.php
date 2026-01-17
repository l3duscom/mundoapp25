<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PedidoOrderBump extends Entity
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'usado_em',
    ];

    protected $casts = [
        'pedido_id' => 'integer',
        'order_bump_id' => 'integer',
        'quantidade' => 'integer',
        'preco_unitario' => 'float',
        'usado' => 'boolean',
    ];
}
