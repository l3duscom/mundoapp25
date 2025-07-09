<?php

namespace App\Models;

use CodeIgniter\Model;

class CartaoCreditoModel extends Model
{
    protected $table = 'cartoes_credito';
    protected $returnType = 'App\Entities\CartaoCredito';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'creditCardNumber',
        'creditCardBrand',
        'creditCardToken',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'creditCardNumber' => 'required',

    ];

    protected $validationMessages = [];
}
