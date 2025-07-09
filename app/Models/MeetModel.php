<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetModel extends Model
{
    protected $table = 'meet';
    protected $returnType = 'App\Entities\Meet';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'event_id',
        'artista',
        'dia',
        'data_meet',
        'hora_inicial',
        'hora_final',
        'quantidade',
        'tipo',
        'cretade_at',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';




    // Validation
    protected $validationRules = [
        'artista' => 'required',

    ];


    protected $validationMessages = [];

    public function recuperaMeetForDay(int $event_id)
    {

        $atributos = [
            'meet.id',
            'meet.event_id',
            'artista',
            'meet.dia',
            'meet.data_meet',
            'meet.hora_inicial',
            'meet.hora_final',
            'meet.quantidade',
            'meet.tipo',
            'meet.created_at',

        ];

        $retorno = $this->select($atributos)
            ->join('eventos', 'eventos.id = meet.event_id')
            ->where('meet.event_id', $event_id)
            ->where('meet.quantidade >', 0)
            ->orderBy('meet.hora_inicial', 'ASC')
            ->findAll();

        return $retorno;
    }

    public function recuperaMeetVipForDay(int $event_id, string $tipo)
    {

        $atributos = [
            'meet.id',
            'meet.event_id',
            'artista',
            'meet.dia',
            'meet.data_meet',
            'meet.hora_inicial',
            'meet.hora_final',
            'meet.quantidade',
            'meet.tipo',
            'meet.created_at',

        ];

        $retorno = $this->select($atributos)
            ->join('eventos', 'eventos.id = meet.event_id')
            ->where('meet.event_id', $event_id)
            ->where('meet.tipo', $tipo)
            ->where('meet.quantidade >', 0)
            ->orderBy('meet.hora_inicial', 'ASC')
            ->findAll();

        return $retorno;
    }

    public function recuperaMeetEpicForDay(int $event_id, string $tipo)
    {

        $atributos = [
            'meet.id',
            'meet.event_id',
            'artista',
            'meet.dia',
            'meet.data_meet',
            'meet.hora_inicial',
            'meet.hora_final',
            'meet.quantidade',
            'meet.tipo',
            'meet.created_at',

        ];

        $retorno = $this->select($atributos)
            ->join('eventos', 'eventos.id = meet.event_id')
            ->where('meet.event_id', $event_id)
            ->where('meet.tipo', $tipo)
            ->where('meet.quantidade >', 0)
            ->orderBy('meet.hora_inicial', 'ASC')
            ->findAll();

        return $retorno;
    }

    public function checkMeetAvailable(int $meet_id)
    {

        $atributos = [
            'meet.id',
            'meet.event_id',
            'meet.dia',
            'meet.data_meet',
            'meet.hora_inicial',
            'meet.hora_final',
            'meet.quantidade',
            'meet.tipo',
            'meet.created_at',
            'eventos.name'
        ];

        $retorno = $this->select($atributos)
            ->where('meet.quantidade >= 0')
            ->where('meet.event_id', $meet_id)
            ->find();

        return $retorno;
    }
}
