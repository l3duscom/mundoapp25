<?php

namespace App\Models;

use CodeIgniter\Model;

class CupomModel extends Model
{
    protected $table = 'cupons';
    protected $returnType = 'App\Entities\Cupom';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'evento_id',
        'nome',
        'desconto',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nome' => 'required',

    ];

    protected $validationMessages = [];
}
