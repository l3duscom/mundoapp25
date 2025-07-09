<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciScmModel extends Model
{
    protected $table = 'dici_scm';
    protected $returnType = 'App\Entities\DiciScm';
    protected $allowedFields = [
        'declaration_id',
        'city_code',
        'tipo_cliente',
        'tipo_atendimento',
        'tipo_meio',
        'tipo_produto',
        'tipo_tecnologia',
        'velocidade',
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
            'dici_scm.id',
            'dici_scm.created_at',
            'dici_scm.declaration_id',
            'dici_scm.tipo_cliente',
            'dici_scm.tipo_atendimento',
            'dici_scm.tipo_meio',
            'dici_scm.tipo_produto',
            'dici_scm.tipo_tecnologia',
            'dici_scm.velocidade',
            'dici_scm.qtd_acessos',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_scm.city_code',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_scm.city_code')
            ->where('dici_scm.id', $id)
            ->first();
    }

    public function recuperaPlanosDeclaracoes($id)
    {

        $atributos = [
            'dici_scm.id',
            'dici_scm.created_at',
            'dici_scm.declaration_id',
            'dici_scm.tipo_cliente',
            'dici_scm.tipo_atendimento',
            'dici_scm.tipo_meio',
            'dici_scm.tipo_produto',
            'dici_scm.tipo_tecnologia',
            'dici_scm.velocidade',
            'dici_scm.qtd_acessos',
            'cidade.Nome',
            'cidade.Uf',
            'cidade.Codigo',
            'dici_scm.city_code',

        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm.declaration_id')
            ->join('cidade', 'cidade.Codigo = dici_scm.city_code')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
