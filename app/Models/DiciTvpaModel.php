<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciTvpaModel extends Model
{
    protected $table = 'dici_tvpa';
    protected $returnType = 'App\Entities\DiciTvpa';
    protected $allowedFields = [
        'declaration_id',
        'city_code',
        'tipo_cliente',
        'tipo_meio',
        'tipo_tecnologia',
        'qtd_acessos',
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
            'dici_tvpa.id',
            'dici_tvpa.created_at',
            'dici_tvpa.declaration_id',
            'dici_tvpa.tipo_cliente',
            'dici_tvpa.tipo_meio',
            'dici_tvpa.tipo_tecnologia',
            'dici_tvpa.qtd_acessos',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_tvpa.city_code',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_tvpa.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_tvpa.city_code')
            ->where('dici_tvpa.id', $id)
            ->first();
    }

    public function recuperaPlanosDeclaracoes($id)
    {

        $atributos = [
            'dici_tvpa.id',
            'dici_tvpa.created_at',
            'dici_tvpa.declaration_id',
            'dici_tvpa.tipo_cliente',
            'dici_tvpa.tipo_meio',
            'dici_tvpa.tipo_tecnologia',
            'dici_tvpa.qtd_acessos',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_tvpa.city_code',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_tvpa.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_tvpa.city_code')
            ->where('declarations.id', $id)
            ->orderBy('dici_tvpa.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
