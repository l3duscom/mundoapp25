<?php

namespace App\Models;

use CodeIgniter\Model;

class AvaliacaoModel extends Model
{
    protected $table = 'avaliacoes';
    protected $returnType = 'App\Entities\Avaliacao';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'inscricao_id',
        'jurado_id',
        'nota_total',
        'nota_1',
        'nota_2',
        'nota_3',
        'nota_4',
        'nota_5',
        'checkin',
        'aprovado',
        'cretade_at',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';




    // Validation
    protected $validationRules = [
        'nota_1' => 'required',

    ];

    protected $validationMessages = [];




    public function recuperarecuperaInscricoesCosplayPorConcurso(int $concurso_id)
    {
        $atributos = [
            'inscricoes.id',
            'inscricoes.concurso_id',
            'inscricoes.codigo',
            'inscricoes.email',
            'inscricoes.motivacao',
            'inscricoes.tempo',
            'inscricoes.nome',
            'inscricoes.nome_social',
            'inscricoes.personagem',
            'inscricoes.obra',
            'inscricoes.genero',
            'inscricoes.referencia',
            'inscricoes.apoio',
            'inscricoes.video_led',
            'inscricoes.observacoes',
        ];



        return $this->select($atributos)
            ->where('inscricoes.concurso_id', $concurso_id)
            ->orderBy('inscricoes.updated_at', 'ASC')
            ->findAll();
    }

    public function recuperarecuperaInscricoesKpopPorConcurso(int $concurso_id)
    {
        $atributos = [
            'inscricoes.id',
            'inscricoes.concurso_id',
            'inscricoes.codigo',
            'inscricoes.email',
            'inscricoes.motivacao',
            'inscricoes.nome',
            'inscricoes.nome_social',
            'inscricoes.marca',
            'inscricoes.musica',
            'inscricoes.grupo',
            'inscricoes.referencia',
            'inscricoes.video_led',
            'inscricoes.integrantes',
        ];



        return $this->select($atributos)
            ->where('inscricoes.concurso_id', $concurso_id)
            ->orderBy('inscricoes.updated_at', 'ASC')
            ->findAll();
    }

    protected function generateCodigo(array $data): array
    {
        if (isset($data['data']['nome'])) {
            $data['data']['codigo'] = strtoupper(random_string('alnum', 20));
        }
        return $data;
    }
}
