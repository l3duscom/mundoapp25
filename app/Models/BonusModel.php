<?php

namespace App\Models;

use CodeIgniter\Model;

class BonusModel extends Model
{
    protected $table = 'bonus';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'ingresso_id',
        'user_id',
        'tipo_bonus',
        'instrucoes',
        'codigo',
    ];

    protected $validationRules = [
        'ingresso_id' => 'required|integer',
        'user_id' => 'required|integer',
        'tipo_bonus' => 'required|max_length[100]',
        'codigo' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'ingresso_id' => [
            'required' => 'O ID do ingresso é obrigatório.',
        ],
        'user_id' => [
            'required' => 'O ID do usuário é obrigatório.',
        ],
        'tipo_bonus' => [
            'required' => 'O tipo do bônus é obrigatório.',
        ],
    ];

    /**
     * Recupera bônus por ingresso
     */
    public function getBonusPorIngresso(int $ingressoId)
    {
        return $this->where('ingresso_id', $ingressoId)->findAll();
    }

    /**
     * Recupera bônus por usuário
     */
    public function getBonusPorUsuario(int $userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    /**
     * Recupera bônus específico por tipo e ingresso
     */
    public function getBonusPorTipo(int $ingressoId, string $tipoBonus)
    {
        return $this->where('ingresso_id', $ingressoId)
                    ->where('tipo_bonus', $tipoBonus)
                    ->first();
    }

    /**
     * Verifica se já existe um bônus do tipo para o ingresso
     */
    public function bonusExiste(int $ingressoId, string $tipoBonus): bool
    {
        return $this->where('ingresso_id', $ingressoId)
                    ->where('tipo_bonus', $tipoBonus)
                    ->countAllResults() > 0;
    }
}
