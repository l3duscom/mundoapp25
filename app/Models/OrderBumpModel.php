<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderBumpModel extends Model
{
    protected $table = 'order_bumps';
    protected $returnType = 'App\Entities\OrderBump';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'event_id',
        'ticket_id',
        'nome',
        'descricao',
        'preco',
        'imagem',
        'tipo',
        'estoque',
        'max_por_pedido',
        'ordem',
        'ativo'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /**
     * Busca order_bumps ativos para um evento específico
     * 
     * @param int $eventId
     * @return array
     */
    public function getOrderBumpsAtivos(int $eventId): array
    {
        return $this->where('event_id', $eventId)
                    ->where('ativo', 1)
                    ->where('estoque >', 0)
                    ->orderBy('ordem', 'ASC')
                    ->findAll();
    }

    /**
     * Busca order_bumps ativos para um ticket específico
     * 
     * @param int $ticketId
     * @return array
     */
    public function getOrderBumpsPorTicket(int $ticketId): array
    {
        return $this->where('ticket_id', $ticketId)
                    ->where('ativo', 1)
                    ->where('estoque >', 0)
                    ->orderBy('ordem', 'ASC')
                    ->findAll();
    }

    /**
     * Decrementa o estoque de um order_bump
     * 
     * @param int $id
     * @param int $quantidade
     * @return bool
     */
    public function decrementaEstoque(int $id, int $quantidade = 1): bool
    {
        $orderBump = $this->find($id);
        if ($orderBump && $orderBump->estoque >= $quantidade) {
            return $this->update($id, [
                'estoque' => $orderBump->estoque - $quantidade
            ]);
        }
        return false;
    }
}
