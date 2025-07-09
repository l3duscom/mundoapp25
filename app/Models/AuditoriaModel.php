<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditoriaModel extends Model
{
    protected $table = 'auditoria';
    protected $returnType = 'App\Entities\Auditoria';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'acao',
        'descricao',
        'created_at'

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'action' => 'required|max_length[255]',

    ];

    protected $validationMessages = [];
}
