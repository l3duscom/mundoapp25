<?php

namespace App\Models;

use CodeIgniter\Model;

class ConcursoModel extends Model
{
    protected $table = 'concursos';
    protected $returnType = 'App\Entities\Concurso';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'evento_id',
        'codigo',
        'tipo',
        'nome',
        'slug',
        'ativo',
        'juri',
        'cretade_at',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'codigo' => 'required',

    ];

    protected $validationMessages = [];

    public function geraCodigoPedido(): string
    {
        do {
            $codigo = strtoupper(random_string('alnum', 20));

            $this->select('codigo')->where('codigo', $codigo);
        } while ($this->countAllResults() > 1);

        return $codigo;
    }


    public function recuperaConcursosPorEvento(int $evento_id)
    {
        $atributos = [
            'concursos.id',
            'concursos.created_at',
            'concursos.codigo',
            'concursos.tipo',
            'concursos.nome',
            'concursos.slug',
            'concursos.ativo',
            'concursos.evento_id',
            'concursos.juri',
            'eventos.nome as nome_evento',
            'eventos.slug',
            'eventos.data_inicio',
            'eventos.data_fim',
            'eventos.hora_inicio',
            'eventos.hora_fim',
            'eventos.local'
        ];



        return $this->select($atributos)
            ->join('eventos', 'eventos.id = concursos.evento_id')
            ->where('eventos.id', $evento_id)
            ->orderBy('concursos.created_at', 'DESC')
            ->findAll();
    }
}
