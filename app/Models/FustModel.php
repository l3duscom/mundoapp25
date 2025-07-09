<?php

namespace App\Models;

use CodeIgniter\Model;

class FustModel extends Model
{
    protected $table = 'fust';
    protected $returnType = 'App\Entities\Fust';
    protected $allowedFields = [
        'declaration_id',
        'referencia',
        'pis',
        'icms',
        'cofins',
        'processo',
        'faturamento',
        'qtd_nfe',
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
            'fust.id',
            'fust.created_at',
            'fust.declaration_id',
            'fust.referencia',
            'fust.pis',
            'fust.icms',
            'fust.cofins',
            'fust.processo',
            'fust.faturamento',
            'fust.qtd_nfe'
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = fust.declaration_id')
            ->where('fust.id', $id)
            ->first();
    }

    public function recuperaPlanosDeclaracoes($id)
    {


        $atributos = [
            'fust.id',
            'fust.created_at',
            'fust.declaration_id',
            'fust.referencia',
            'fust.pis',
            'fust.icms',
            'fust.cofins',
            'fust.processo',
            'fust.faturamento',
            'fust.qtd_nfe'

        ];


        return $this->select($atributos)
            ->join('declarations', 'declarations.id = fust.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('fust.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
