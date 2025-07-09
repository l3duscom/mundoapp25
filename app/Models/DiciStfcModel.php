<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciStfcModel extends Model
{
    protected $table = 'dici_stfc';
    protected $returnType = 'App\Entities\DiciStfc';
    protected $allowedFields = [
        'declaration_id',
        'city_code',
        'tipo_cliente',
        'tipo_atendimento',
        'tipo_meio',
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
            'dici_stfc.id',
            'dici_stfc.created_at',
            'dici_stfc.declaration_id',
            'dici_stfc.tipo_cliente',
            'dici_stfc.tipo_atendimento',
            'dici_stfc.tipo_meio',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_stfc.city_code',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_stfc.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_stfc.city_code')
            ->where('dici_stfc.id', $id)
            ->first();
    }

    public function recuperaPlanosDeclaracoes($id)
    {

        $atributos = [
            'dici_stfc.id',
            'dici_stfc.created_at',
            'dici_stfc.declaration_id',
            'dici_stfc.tipo_cliente',
            'dici_stfc.tipo_atendimento',
            'dici_stfc.tipo_meio',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_stfc.city_code',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_stfc.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_stfc.city_code')
            ->where('declarations.id', $id)
            ->orderBy('dici_stfc.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
