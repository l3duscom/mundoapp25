<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckModel extends Model
{
    protected $table = 'acessos';
    protected $returnType = 'App\Entities\Check';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'ingresso_id',
        'usuario_id',
        'operador_id',
        'tipo_acesso',
        'created_at',


    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
