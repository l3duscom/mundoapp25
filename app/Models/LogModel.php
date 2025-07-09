<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'logs';
    protected $returnType = 'App\Entities\Log';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'matricula',
        'bloqueado',
        'status',
        'via',
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
