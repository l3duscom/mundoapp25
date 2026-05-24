<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Controller API de Lineup
 * Lista o lineup (atrações/artistas) de um evento
 */
class Lineup extends BaseController
{
    private $lineupModel;
    private $eventoModel;

    public function __construct()
    {
        $this->lineupModel = new \App\Models\LineupModel();
        $this->eventoModel = new \App\Models\EventoModel();
    }

    /**
     * Lista o lineup de um evento específico
     * GET /api/lineup/evento/{event_id}
     * GET /api/lineup/evento/{event_id}?ativo=1
     *
     * @param int $event_id ID do evento
     * @return \CodeIgniter\HTTP\Response
     */
    public function byEvento($event_id = null)
    {
        if (!$event_id) {
            return $this->response
                ->setJSON([
                    'success' => false,
                    'message' => 'ID do evento não fornecido'
                ])
                ->setStatusCode(400);
        }

        try {
            // Valida se evento existe
            $evento = $this->eventoModel->find($event_id);
            if (!$evento) {
                return $this->response
                    ->setJSON([
                        'success' => false,
                        'message' => 'Evento não encontrado'
                    ])
                    ->setStatusCode(404);
            }

            // Filtro opcional: apenas ativos
            $apenasAtivos = $this->request->getGet('ativo') == 1;

            $lineup = $this->lineupModel->getLineupByEvento((int)$event_id, $apenasAtivos);

            // Formata resposta
            $data = [];
            foreach ($lineup as $item) {
                $data[] = [
                    'id'         => (int)$item->id,
                    'nome'       => $item->nome,
                    'dia'        => $item->dia ? (is_object($item->dia) ? $item->dia->format('Y-m-d') : $item->dia) : null,
                    'tipo'       => $item->tipo,
                    'descricao'  => $item->descricao,
                    'imagem'     => !empty($item->imagem) ? 'https://backoffice.mundodream.com.br/lineup/imagem/' . $item->imagem : null,
                    'ordem'      => (int)$item->ordem,
                    'ativo'      => (int)$item->ativo,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }

            return $this->response
                ->setJSON([
                    'success' => true,
                    'data' => [
                        'evento' => [
                            'id'   => $evento->id,
                            'nome' => $evento->nome,
                        ],
                        'lineup' => $data,
                        'total'  => count($data),
                    ]
                ])
                ->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Erro ao listar lineup por evento API: ' . $e->getMessage());

            return $this->response
                ->setJSON([
                    'success' => false,
                    'message' => 'Erro ao listar lineup',
                    'error' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Erro interno'
                ])
                ->setStatusCode(500);
        }
    }

    /**
     * Serve uma imagem do lineup
     * GET /api/lineup/imagem/{arquivo}
     *
     * @param string|null $arquivo Nome do arquivo de imagem
     * @return void
     */
    public function imagem(string $arquivo = null)
    {
        if ($arquivo !== null) {
            $this->exibeArquivo('lineup', $arquivo);
        }
    }
}
