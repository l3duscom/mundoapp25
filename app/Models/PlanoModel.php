<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanoModel extends Model
{
    protected $table = 'planos';
    protected $returnType = 'App\Entities\Plano';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'nome',
        'slug',
        'descricao',
        'preco',
        'ciclo',
        'beneficios',
        'ativo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nome' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|min_length[3]|max_length[100]|is_unique[planos.slug,id,{id}]',
        'preco' => 'required|decimal',
        'ciclo' => 'required|in_list[MONTHLY,YEARLY]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O nome do plano é obrigatório.',
        ],
        'slug' => [
            'required' => 'O slug é obrigatório.',
            'is_unique' => 'Este slug já existe.',
        ],
        'preco' => [
            'required' => 'O preço é obrigatório.',
            'decimal' => 'O preço deve ser um valor decimal.',
        ],
    ];

    /**
     * Retorna todos os planos ativos
     *
     * @return array
     */
    public function getAtivos(): array
    {
        return $this->where('ativo', 1)
            ->orderBy('preco', 'ASC')
            ->findAll();
    }

    /**
     * Busca um plano pelo slug
     *
     * @param string $slug
     * @return object|null
     */
    public function getPorSlug(string $slug)
    {
        return $this->where('slug', $slug)
            ->where('ativo', 1)
            ->first();
    }

    /**
     * Retorna planos para exibição (ordenados por preço)
     *
     * @return array
     */
    public function getPlanosParaExibicao(): array
    {
        return $this->where('ativo', 1)
            ->orderBy('ciclo', 'ASC')
            ->orderBy('preco', 'ASC')
            ->findAll();
    }
}
