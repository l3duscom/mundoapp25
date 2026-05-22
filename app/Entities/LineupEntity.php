<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class LineupEntity extends Entity
{
    protected $dates = [
        'dia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
