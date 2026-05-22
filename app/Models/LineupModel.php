<?php

namespace App\Models;

use CodeIgniter\Model;

class LineupModel extends Model
{
    protected $table          = 'lineup';
    protected $returnType     = 'App\Entities\LineupEntity';
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'event_id',
        'nome',
        'dia',
        'tipo',
        'descricao',
        'imagem',
        'ordem',
        'ativo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Recupera todo o lineup de um evento, ordenado por dia e ordem
     *
     * @param integer $event_id
     * @param boolean $apenasAtivos
     * @return array
     */
    public function getLineupByEvento(int $event_id, bool $apenasAtivos = false): array
    {
        $builder = $this->where('event_id', $event_id);

        if ($apenasAtivos) {
            $builder->where('ativo', 1);
        }

        return $builder
            ->orderBy('dia', 'ASC')
            ->orderBy('ordem', 'ASC')
            ->orderBy('nome', 'ASC')
            ->findAll();
    }
}
