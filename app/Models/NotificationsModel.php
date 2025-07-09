<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationsModel extends Model
{
    protected $table = 'notifications';
    protected $returnType = 'App\Entities\Notifications';
    protected $allowedFields = [
        'usuario_id',
        'nome',
        'email',
        'created_at'


    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
