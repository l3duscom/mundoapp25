<?php

namespace App\Models;

use CodeIgniter\Model;

class ConhecimentoModel extends Model
{
    protected $table = 'conhecimento';
    protected $returnType = 'App\Entities\Conhecimento';
    protected $allowedFields = [
        'categoria_id',
        'titulo',
        'descricao'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';


    public function recuperaPlano(int $id)
    {

        $atributos = [
            'dici_scm_anual_enlaces_contratados.id',
            'dici_scm_anual_enlaces_contratados.created_at',
            'dici_scm_anual_enlaces_contratados.declaration_id',
            'dici_scm_anual_enlaces_contratados.estacao_a_id',
            'dici_scm_anual_enlaces_contratados.estacao_b_id',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_id',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_meio',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_prestadora',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_contratados.declaration_id')
            ->where('dici_scm_anual_enlaces_contratados.id', $id)
            ->first();
    }

    public function recuperaConhecimentos()
    {

        $atributos = [
            'conhecimento.id',
            'conhecimento.titulo',
            'conhecimento.descricao',
            'conhecimento_categoria.titulo as categoria_titulo'

        ];

        return $this->select($atributos)
            ->join('conhecimento_categoria', 'conhecimento_categoria.id = conhecimento.categoria_id')
            ->orderBy('conhecimento.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
