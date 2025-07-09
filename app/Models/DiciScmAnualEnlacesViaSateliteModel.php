<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciScmAnualEnlacesViaSateliteModel extends Model
{
    protected $table = 'dici_scm_anual_enlaces_via_satelite';
    protected $returnType = 'App\Entities\DiciScmAnualEnlacesViaSatelite';
    protected $allowedFields = [
        'declaration_id',
        'ano',
        'estacao_a_id',
        'enlaces_satelites_id',
        'enlaces_satelites_cod_satelite',
        'enlaces_satelites_freq_central_canal_uplink_mhz',
        'enlaces_satelites_freq_central_canal_downlink_mhz',
        'enlaces_satelites_cap_uso_canal_uplink_mhz',
        'enlaces_satelites_cap_uso_canal_uplink_mbps',
        'enlaces_satelites_cap_uso_canal_downlink_mhz',
        'enlaces_satelites_cap_uso_canal_downlink_mbps',
        'created_at'


    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';


    public function recuperaPlano(int $id)
    {

        $atributos = [
            'dici_scm_anual_enlaces_via_satelite.id',
            'dici_scm_anual_enlaces_via_satelite.created_at',
            'dici_scm_anual_enlaces_via_satelite.declaration_id',
            'dici_scm_anual_enlaces_via_satelite.estacao_a_id',
            'dici_scm_anual_enlaces_via_satelite.enlaces_satelites_id',
            'dici_scm_anual_enlaces_via_satelite.enlaces_satelites_cod_satelite',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_via_satelite.declaration_id')
            ->where('dici_scm_anual_enlaces_via_satelite.id', $id)
            ->first();
    }

    public function recuperaDeclaracoes($id)
    {

        $atributos = [
            'dici_scm_anual_enlaces_via_satelite.id',
            'dici_scm_anual_enlaces_via_satelite.created_at',
            'dici_scm_anual_enlaces_via_satelite.declaration_id',
            'dici_scm_anual_enlaces_via_satelite.estacao_a_id',
            'dici_scm_anual_enlaces_via_satelite.enlaces_satelites_id',
            'dici_scm_anual_enlaces_via_satelite.enlaces_satelites_cod_satelite',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_via_satelite.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_enlaces_via_satelite.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
