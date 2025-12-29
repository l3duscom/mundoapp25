<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class InscricaoHistorico extends Entity
{
    protected $dates = [
        'created_at',
    ];

    protected $casts = [
        'dados_anteriores' => 'json',
        'dados_novos' => 'json',
    ];
}
