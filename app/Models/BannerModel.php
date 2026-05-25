<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table          = 'banners';
    protected $returnType     = 'App\Entities\BannerEntity';
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'event_id',
        'imagem',
        'link',
        'ordem',
        'ativo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * Recupera todos os banners de um evento, ordenado por ordem
     *
     * @param integer $event_id
     * @param boolean $apenasAtivos
     * @return array
     */
    public function getBannersByEvento(int $event_id, bool $apenasAtivos = false): array
    {
        $builder = $this->where('event_id', $event_id);

        if ($apenasAtivos) {
            $builder->where('ativo', 1);
        }

        return $builder
            ->orderBy('ordem', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
