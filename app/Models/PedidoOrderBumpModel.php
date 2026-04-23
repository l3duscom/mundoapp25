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
     * Aceita dois formatos:
     *  - Associativo: [order_bump_id => quantidade]
     *  - Lista (compat): [order_bump_id, order_bump_id, ...] — qtd = 1
     *
     * Respeita limites de `max_por_pedido` e `estoque` do order bump.
     *
     * @param int $pedidoId
     * @param array $orderBumps
     * @param OrderBumpModel $orderBumpModel
     * @return bool
     */
    public function salvaOrderBumpsDoPedido(int $pedidoId, array $orderBumps, $orderBumpModel): bool
    {
        if (empty($orderBumps)) {
            return true;
        }

        // Normaliza para [id => qtd]
        $mapa = [];
        $ehLista = array_keys($orderBumps) === range(0, count($orderBumps) - 1);

        foreach ($orderBumps as $chave => $valor) {
            if ($ehLista) {
                $id = (int) $valor;
                $qtd = 1;
            } else {
                $id = (int) $chave;
                $qtd = (int) $valor;
            }

            if ($id <= 0 || $qtd <= 0) {
                continue;
            }

            $mapa[$id] = ($mapa[$id] ?? 0) + $qtd;
        }

        foreach ($mapa as $orderBumpId => $quantidade) {
            $orderBump = $orderBumpModel->find($orderBumpId);
            if (!$orderBump) {
                continue;
            }

            // Limita pela máximo permitido por pedido (se configurado > 0)
            $max = (int) ($orderBump->max_por_pedido ?? 0);
            if ($max > 0) {
                $quantidade = min($quantidade, $max);
            }

            // Limita pelo estoque disponível
            $estoque = (int) ($orderBump->estoque ?? 0);
            $quantidade = min($quantidade, $estoque);

            if ($quantidade <= 0) {
                continue;
            }

            $this->insert([
                'pedido_id' => $pedidoId,
                'order_bump_id' => $orderBumpId,
                'quantidade' => $quantidade,
                'preco_unitario' => $orderBump->preco,
            ]);

            $orderBumpModel->decrementaEstoque($orderBumpId, $quantidade);
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
