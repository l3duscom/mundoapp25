<?php

namespace App\Models;

use CodeIgniter\Model;

class PontoModel extends Model
{
    protected $table = 'pontos';
    protected $returnType = 'App\Entities\Ponto';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'quantidade',
        'descricao',
        'expiration',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'matricula' => 'required|min_length[14]|max_length[125]',

    ];

    protected $validationMessages = [];
}
