<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoUtmModel extends Model
{
    protected $table = 'pedido_utms';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'pedido_id',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    protected $deletedField = '';

    /**
     * Busca UTMs de um pedido
     */
    public function getByPedidoId(int $pedidoId): ?object
    {
        return $this->where('pedido_id', $pedidoId)->first();
    }
}
