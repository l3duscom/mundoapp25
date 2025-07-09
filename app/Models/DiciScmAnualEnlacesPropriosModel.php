<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciScmAnualEnlacesPropriosModel extends Model
{
    protected $table = 'dici_scm_anual_enlaces_proprios';
    protected $returnType = 'App\Entities\DiciScmAnualEnlacesProprios';
    protected $allowedFields = [
        'declaration_id',
        'ano',
        'estacao_a_id',
        'estacao_b_id',
        'enlaces_proprios_terrestres_id',
        'enlaces_proprios_terrestres_meio',
        'enlaces_proprios_terrestres_c_nominal',
        'enlaces_proprios_terrestres_swap',
        'geometria_wkt',
        'srid',
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
            'dici_scm_anual_enlaces_proprios.id',
            'dici_scm_anual_enlaces_proprios.created_at',
            'dici_scm_anual_enlaces_proprios.declaration_id',
            'dici_scm_anual_enlaces_proprios.estacao_a_id',
            'dici_scm_anual_enlaces_proprios.estacao_b_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_meio',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_c_nominal',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_swap',
            'dici_scm_anual_enlaces_proprios.geometria_wkt',
            'dici_scm_anual_enlaces_proprios.srid',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_proprios.declaration_id')
            ->where('dici_scm_anual_enlaces_proprios.id', $id)
            ->first();
    }

    public function recuperaPlanos(int $id)
    {

        $atributos = [
            'dici_scm_anual_enlaces_proprios.id',
            'dici_scm_anual_enlaces_proprios.created_at',
            'dici_scm_anual_enlaces_proprios.declaration_id',
            'dici_scm_anual_enlaces_proprios.estacao_a_id',
            'dici_scm_anual_enlaces_proprios.estacao_b_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_meio',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_c_nominal',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_swap',
            'dici_scm_anual_enlaces_proprios.geometria_wkt',
            'dici_scm_anual_enlaces_proprios.srid',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_proprios.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_enlaces_proprios.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }

    public function recuperaDeclaracoes($id)
    {

        $atributos = [
            'dici_scm_anual_enlaces_proprios.id',
            'dici_scm_anual_enlaces_proprios.created_at',
            'dici_scm_anual_enlaces_proprios.declaration_id',
            'dici_scm_anual_enlaces_proprios.estacao_a_id',
            'dici_scm_anual_enlaces_proprios.estacao_b_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_c_nominal',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_meio',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_proprios.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_enlaces_proprios.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
