<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciScmAnualEstacoesModel extends Model
{
    protected $table = 'dici_scm_anual_estacoes';
    protected $returnType = 'App\Entities\DiciScmAnualEstacoes';
    protected $allowedFields = [
        'declaration_id',
        'ano',
        'id_estacao',
        'numestacao',
        'lat',
        'long',
        'city_code',
        'endereco',
        'abertura',
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
            'dici_scm_anual_estacoes.id',
            'dici_scm_anual_estacoes.created_at',
            'dici_scm_anual_estacoes.declaration_id',
            'dici_scm_anual_estacoes.id_estacao',
            'dici_scm_anual_estacoes.numestacao',
            'dici_scm_anual_estacoes.lat',
            'dici_scm_anual_estacoes.long',
            'dici_scm_anual_estacoes.endereco',
            'dici_scm_anual_estacoes.abertura',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_scm_anual_estacoes.city_code',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_estacoes.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_scm_anual_estacoes.city_code')
            ->where('dici_scm_anual_estacoes.id', $id)
            ->first();
    }

    public function recuperaPlanos(int $id)
    {

        $atributos = [
            'dici_scm_anual_estacoes.id',
            'dici_scm_anual_estacoes.created_at',
            'dici_scm_anual_estacoes.declaration_id',
            'dici_scm_anual_estacoes.id_estacao',
            'dici_scm_anual_estacoes.numestacao',
            'dici_scm_anual_estacoes.lat',
            'dici_scm_anual_estacoes.long',
            'dici_scm_anual_estacoes.endereco',
            'dici_scm_anual_estacoes.abertura',
            'dici_scm_anual_estacoes.city_code',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_estacoes.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_estacoes.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }

    public function recuperaDeclaracoes($id)
    {

        $atributos = [
            'dici_scm_anual_estacoes.id',
            'dici_scm_anual_estacoes.created_at',
            'dici_scm_anual_estacoes.declaration_id',
            'dici_scm_anual_estacoes.id_estacao',
            'dici_scm_anual_estacoes.numestacao',
            'dici_scm_anual_estacoes.lat',
            'dici_scm_anual_estacoes.long',
            'dici_scm_anual_estacoes.endereco',
            'dici_scm_anual_estacoes.abertura',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_scm_anual_estacoes.city_code',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_anual_estacoes.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_scm_anual_estacoes.city_code')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_estacoes.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
