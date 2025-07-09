<?php

namespace App\Models;

use CodeIgniter\Model;

class DiciScmTrimestralModel extends Model
{
    protected $table = 'dici_scm_trimestral';
    protected $returnType = 'App\Entities\DiciScmTrimestral';
    protected $allowedFields = [
        'declaration_id',
        'CODIGO',
        'DADO_INFORMADO',
        'SERVICO',
        'UNIDADE_DA_FEDERACAO_UF',
        'VALORES',
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
            'dici_scm_trimestral.id',
            'dici_scm_trimestral.created_at',
            'dici_scm_trimestral.declaration_id',
            'dici_scm_trimestral.DADO_INFORMADO',
            'dici_scm_trimestral.SERVICO',
            'dici_scm_trimestral.VALORES',
            'dici_scm_trimestral.UNIDADE_DA_FEDERACAO_UF',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_trimestral.declaration_id')
            ->where('dici_scm_trimestral.id', $id)
            ->first();
    }

    public function recuperaPlanosDeclaracoes($id)
    {

        $atributos = [
            'dici_scm_trimestral.id',
            'dici_scm_trimestral.created_at',
            'dici_scm_trimestral.declaration_id',
            'dici_scm_trimestral.DADO_INFORMADO',
            'dici_scm_trimestral.SERVICO',
            'dici_scm_trimestral.VALORES',
            'dici_scm_trimestral.UNIDADE_DA_FEDERACAO_UF',
            'dici_scm_trimestral.CODIGO',
        ];

        return $this->select($atributos)
            ->join('declarations', 'declarations.id = dici_scm_trimestral.declaration_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_trimestral.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }
}
