<?php

namespace App\Models;

use CodeIgniter\Model;

class CartaoModel extends Model
{
    protected $table = 'cartoes';
    protected $returnType = 'App\Entities\Cartao';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'endereco_id',
        'rastreio',
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
