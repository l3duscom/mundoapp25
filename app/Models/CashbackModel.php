<?php

namespace App\Models;

use CodeIgniter\Model;

class CashbackModel extends Model
{
    protected $table = 'cashback';
    protected $returnType = 'App\Entities\Cashback';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'imagem',
        'url',
        'titulo',
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
