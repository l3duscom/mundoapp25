<?php

namespace App\Models;

use CodeIgniter\Model;

class ResgatePremiumModel extends Model
{
    protected $table = 'resgates_premium';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'usuario_id',
        'evento_id',
        'ticket_id',
        'ingresso_id',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Verifica se o usuário já resgatou ingresso gratuito para o evento
     */
    public function jaResgatouParaEvento(int $usuarioId, int $eventoId): bool
    {
        return $this->where('usuario_id', $usuarioId)
            ->where('evento_id', $eventoId)
            ->countAllResults() > 0;
    }

    /**
     * Registra um novo resgate de ingresso gratuito
     */
    public function registrarResgate(int $usuarioId, int $eventoId, int $ticketId, int $ingressoId): int
    {
        $this->insert([
            'usuario_id' => $usuarioId,
            'evento_id' => $eventoId,
            'ticket_id' => $ticketId,
            'ingresso_id' => $ingressoId,
        ]);

        return $this->getInsertID();
    }

    /**
     * Retorna todos os resgates de um usuário
     */
    public function getResgatesPorUsuario(int $usuarioId): array
    {
        return $this->select('resgates_premium.*, eventos.nome as evento_nome, tickets.nome as ticket_nome')
            ->join('eventos', 'eventos.id = resgates_premium.evento_id', 'left')
            ->join('tickets', 'tickets.id = resgates_premium.ticket_id', 'left')
            ->where('resgates_premium.usuario_id', $usuarioId)
            ->orderBy('resgates_premium.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Retorna os IDs de eventos que o usuário já resgatou
     */
    public function getEventosResgatados(int $usuarioId): array
    {
        $resgates = $this->select('evento_id')
            ->where('usuario_id', $usuarioId)
            ->findAll();

        return array_column($resgates, 'evento_id');
    }
}
