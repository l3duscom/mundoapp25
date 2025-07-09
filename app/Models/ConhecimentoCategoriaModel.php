<?php

namespace App\Models;

use CodeIgniter\Model;

class ConhecimentoCategoriaModel extends Model
{
    protected $table = 'conhecimento_categoria';
    protected $returnType = 'App\Entities\ConhecimentoCategoria';
    protected $allowedFields = [
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

    public function recuperaDeclaracoes($id)
    {

        $atributos = [
            'dici_scm_anual_enlaces_contratados.id',
            'dici_scm_anual_enlaces_contratados.created_at',
            'dici_scm_anual_enlaces_contratados.declaration_id',
            'dici_scm_anual_enlaces_contratados.estacao_a_id',
            'dici_scm_anual_enlaces_contratados.estacao_b_id',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_prestadora',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_meio',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_enlaces_contratados.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_enlaces_contratados.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }

    public function selectCategorias()
    {
        $options = "<option value=''>Selecione a Categoria</option>";
        $categorias = $this->findAll();

        foreach ($categorias as $categoria) {
            $options .= "<option value='{$categoria->id}'>{$categoria->titulo}</option>" . PHP_EOL;
        }
        //26:55
        return $options;
    }
}
