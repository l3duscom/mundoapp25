<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoOrderBumpModel extends Model
{
    protected $table = 'pedido_order_bumps';
    protected $returnType = 'App\Entities\PedidoOrderBump';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'pedido_id',
        'order_bump_id',
        'quantidade',
        'preco_unitario',
        'usado',
        'usado_em',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /**
     * Salva os orderbumps de um pedido
     * 
     * @param int $pedidoId
     * @param array $orderBumps Array de IDs dos orderbumps selecionados
     * @param OrderBumpModel $orderBumpModel Model para buscar dados do orderbump
     * @return bool
     */
    public function salvaOrderBumpsDoPedido(int $pedidoId, array $orderBumps, $orderBumpModel): bool
    {
        if (empty($orderBumps)) {
            return true;
        }

        foreach ($orderBumps as $orderBumpId) {
            $orderBump = $orderBumpModel->find($orderBumpId);
            
            if ($orderBump) {
                $this->insert([
                    'pedido_id' => $pedidoId,
                    'order_bump_id' => $orderBumpId,
                    'quantidade' => 1,
                    'preco_unitario' => $orderBump->preco,
                ]);

                // Decrementa o estoque
                $orderBumpModel->decrementaEstoque($orderBumpId, 1);
            }
        }

        return true;
    }

    /**
     * Recupera os orderbumps de um pedido
     * 
     * @param int $pedidoId
     * @return array
     */
    public function getOrderBumpsDoPedido(int $pedidoId): array
    {
        return $this->select('pedido_order_bumps.*, order_bumps.nome, order_bumps.descricao, order_bumps.imagem')
                    ->join('order_bumps', 'order_bumps.id = pedido_order_bumps.order_bump_id')
                    ->where('pedido_id', $pedidoId)
                    ->findAll();
    }

    /**
     * Calcula o total dos orderbumps de um pedido
     * 
     * @param int $pedidoId
     * @return float
     */
    public function getTotalOrderBumpsDoPedido(int $pedidoId): float
    {
        $result = $this->selectSum('preco_unitario * quantidade', 'total')
                       ->where('pedido_id', $pedidoId)
                       ->first();
        
        return $result->total ?? 0;
    }

    /**
     * Recupera os orderbumps de pedidos confirmados de um usuário
     * 
     * @param int $userId
     * @return array
     */
    public function getOrderBumpsPorUsuario(int $userId): array
    {
        return $this->select('pedido_order_bumps.*, order_bumps.nome, order_bumps.descricao, order_bumps.imagem, pedidos.id as pedido_id, pedidos.codigo as pedido_codigo')
                    ->join('order_bumps', 'order_bumps.id = pedido_order_bumps.order_bump_id')
                    ->join('pedidos', 'pedidos.id = pedido_order_bumps.pedido_id')
                    ->where('pedidos.user_id', $userId)
                    ->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid'])
                    ->orderBy('pedido_order_bumps.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Marca um orderbump como usado
     * 
     * @param int $id ID do pedido_order_bump
     * @param int $userId ID do usuário (para validação de segurança)
     * @return bool
     */
    public function marcarComoUsado(int $id, int $userId): bool
    {
        // Verificar se o orderbump pertence ao usuário
        $item = $this->select('pedido_order_bumps.*')
                     ->join('pedidos', 'pedidos.id = pedido_order_bumps.pedido_id')
                     ->where('pedido_order_bumps.id', $id)
                     ->where('pedidos.user_id', $userId)
                     ->first();

        if (!$item) {
            return false;
        }

        // Verificar se já foi usado
        if ($item->usado) {
            return false;
        }

        return $this->update($id, [
            'usado' => 1,
            'usado_em' => date('Y-m-d H:i:s'),
        ]);
    }
}
