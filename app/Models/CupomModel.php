<?php

namespace App\Models;

use CodeIgniter\Model;

class CupomModel extends Model
{
    protected $table = 'cupons';
    protected $returnType = 'App\Entities\Cupom';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'evento_id',
        'nome',
        'codigo',
        'desconto',
        'tipo',
        'valor_minimo',
        'quantidade_total',
        'quantidade_usada',
        'uso_por_usuario',
        'data_inicio',
        'data_fim',
        'ativo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nome' => 'required',
        'codigo' => 'required',
        'desconto' => 'required|decimal',
        'tipo' => 'required|in_list[percentual,fixo]',
    ];

    protected $validationMessages = [];

    /**
     * Valida um cupom de desconto
     *
     * @param string $codigo Código do cupom
     * @param int|null $eventoId ID do evento (opcional)
     * @param int|null $userId ID do usuário (opcional)
     * @param float|null $valorPedido Valor total do pedido (opcional)
     * @return array ['valido' => bool, 'cupom' => object|null, 'erro' => string|null]
     */
    public function validarCupom(string $codigo, ?int $eventoId = null, ?int $userId = null, ?float $valorPedido = null): array
    {
        // Busca o cupom pelo código (case insensitive)
        $cupom = $this->where('UPPER(codigo)', strtoupper($codigo))->first();

        // Cupom não encontrado
        if (!$cupom) {
            return [
                'valido' => false,
                'cupom' => null,
                'erro' => 'Cupom não encontrado.'
            ];
        }

        // Cupom desativado
        if (!$cupom->ativo) {
            return [
                'valido' => false,
                'cupom' => null,
                'erro' => 'Este cupom está desativado.'
            ];
        }

        // Verifica se o cupom é para um evento específico
        if ($cupom->evento_id && $eventoId && $cupom->evento_id != $eventoId) {
            return [
                'valido' => false,
                'cupom' => null,
                'erro' => 'Este cupom não é válido para este evento.'
            ];
        }

        // Verifica data de início
        if ($cupom->data_inicio) {
            $dataInicio = date('Y-m-d', strtotime($cupom->data_inicio));
            $hoje = date('Y-m-d');
            if ($dataInicio > $hoje) {
                return [
                    'valido' => false,
                    'cupom' => null,
                    'erro' => 'Este cupom ainda não está válido.'
                ];
            }
        }

        // Verifica data de expiração
        if ($cupom->data_fim) {
            $dataFim = date('Y-m-d', strtotime($cupom->data_fim));
            $hoje = date('Y-m-d');
            if ($dataFim < $hoje) {
                return [
                    'valido' => false,
                    'cupom' => null,
                    'erro' => 'Este cupom expirou.'
                ];
            }
        }

        // Verifica limite de uso total
        if ($cupom->quantidade_total !== null && $cupom->quantidade_usada >= $cupom->quantidade_total) {
            return [
                'valido' => false,
                'cupom' => null,
                'erro' => 'Este cupom já atingiu o limite de uso.'
            ];
        }

        // Verifica valor mínimo do pedido
        if ($cupom->valor_minimo && $valorPedido !== null && $valorPedido < $cupom->valor_minimo) {
            return [
                'valido' => false,
                'cupom' => null,
                'erro' => 'Valor mínimo do pedido para usar este cupom: R$ ' . number_format($cupom->valor_minimo, 2, ',', '.')
            ];
        }

        // Verifica uso por usuário
        if ($cupom->uso_por_usuario && $userId) {
            $usoUsuario = $this->verificarUsoUsuario($cupom->id, $userId);
            if ($usoUsuario >= $cupom->uso_por_usuario) {
                return [
                    'valido' => false,
                    'cupom' => null,
                    'erro' => 'Você já utilizou este cupom o número máximo de vezes.'
                ];
            }
        }

        // Cupom válido!
        return [
            'valido' => true,
            'cupom' => $cupom,
            'erro' => null
        ];
    }

    /**
     * Calcula o valor do desconto baseado no tipo do cupom
     *
     * @param object $cupom Objeto do cupom
     * @param float $valorPedido Valor total do pedido
     * @return float Valor do desconto
     */
    public function calcularDesconto(object $cupom, float $valorPedido): float
    {
        if ($cupom->tipo === 'percentual') {
            // Desconto percentual
            $desconto = $valorPedido * ($cupom->desconto / 100);
        } else {
            // Desconto fixo - não pode ser maior que o valor do pedido
            $desconto = min($cupom->desconto, $valorPedido);
        }

        return round($desconto, 2);
    }

    /**
     * Incrementa o contador de uso do cupom
     *
     * @param int $cupomId ID do cupom
     * @return bool
     */
    public function incrementarUso(int $cupomId): bool
    {
        $cupom = $this->find($cupomId);
        if (!$cupom) {
            return false;
        }

        return $this->update($cupomId, [
            'quantidade_usada' => ($cupom->quantidade_usada ?? 0) + 1
        ]);
    }

    /**
     * Decrementa o contador de uso do cupom (para cancelamentos)
     *
     * @param int $cupomId ID do cupom
     * @return bool
     */
    public function decrementarUso(int $cupomId): bool
    {
        $cupom = $this->find($cupomId);
        if (!$cupom || ($cupom->quantidade_usada ?? 0) <= 0) {
            return false;
        }

        return $this->update($cupomId, [
            'quantidade_usada' => $cupom->quantidade_usada - 1
        ]);
    }

    /**
     * Verifica quantas vezes um usuário usou um cupom específico
     *
     * @param int $cupomId ID do cupom
     * @param int $userId ID do usuário
     * @return int Quantidade de usos
     */
    public function verificarUsoUsuario(int $cupomId, int $userId): int
    {
        $pedidoModel = new \App\Models\PedidoModel();
        
        return $pedidoModel
            ->where('cupom_id', $cupomId)
            ->where('user_id', $userId)
            ->where('status !=', 'cancelado')
            ->countAllResults();
    }

    /**
     * Busca cupom por código
     *
     * @param string $codigo
     * @return object|null
     */
    public function buscarPorCodigo(string $codigo)
    {
        return $this->where('UPPER(codigo)', strtoupper($codigo))->first();
    }

    /**
     * Lista cupons ativos
     *
     * @return array
     */
    public function listarAtivos(): array
    {
        return $this->where('ativo', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Lista cupons por evento
     *
     * @param int $eventoId
     * @return array
     */
    public function listarPorEvento(int $eventoId): array
    {
        return $this->groupStart()
            ->where('evento_id', $eventoId)
            ->orWhere('evento_id', null)
            ->groupEnd()
            ->where('ativo', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}
