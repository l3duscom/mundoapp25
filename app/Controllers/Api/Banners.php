<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

/**
 * Controller API de Banners
 * Lista os banners de um evento
 */
class Banners extends BaseController
{
    private $bannerModel;
    private $eventoModel;

    public function __construct()
    {
        $this->bannerModel = new \App\Models\BannerModel();
        $this->eventoModel = new \App\Models\EventoModel();
    }

    /**
     * Lista todos os banners
     * GET /api/banners
     * GET /api/banners?ativo=1
     * GET /api/banners?event_id=1
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function index()
    {
        try {
            $event_id = $this->request->getGet('event_id');
            $ativo    = $this->request->getGet('ativo');

            $builder = $this->bannerModel
                ->orderBy('event_id', 'ASC')
                ->orderBy('ordem', 'ASC')
                ->orderBy('id', 'ASC');

            if ($event_id) {
                $builder->where('event_id', $event_id);
            }

            if ($ativo !== null) {
                $builder->where('ativo', $ativo);
            }

            $banners = $builder->findAll();

            $data = [];
            foreach ($banners as $item) {
                $data[] = [
                    'id'         => (int)$item->id,
                    'event_id'   => (int)$item->event_id,
                    'imagem'     => !empty($item->imagem) ? 'https://backoffice.mundodream.com.br/banners/imagem/' . $item->imagem : null,
                    'link'       => $item->link,
                    'ordem'      => (int)$item->ordem,
                    'ativo'      => (int)$item->ativo,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }

            return $this->response
                ->setJSON([
                    'success' => true,
                    'data'    => $data,
                    'total'   => count($data),
                ])
                ->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Erro ao listar banners API: ' . $e->getMessage());

            return $this->response
                ->setJSON([
                    'success' => false,
                    'message' => 'Erro ao listar banners',
                    'error' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Erro interno'
                ])
                ->setStatusCode(500);
        }
    }

    /**
     * Lista os banners de um evento específico
     * GET /api/banners/evento/{event_id}
     * GET /api/banners/evento/{event_id}?ativo=1
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

            $banners = $this->bannerModel->getBannersByEvento((int)$event_id, $apenasAtivos);

            // Formata resposta
            $data = [];
            foreach ($banners as $item) {
                $data[] = [
                    'id'         => (int)$item->id,
                    'imagem'     => !empty($item->imagem) ? 'https://backoffice.mundodream.com.br/banners/imagem/' . $item->imagem : null,
                    'link'       => $item->link,
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
                        'banners' => $data,
                        'total'   => count($data),
                    ]
                ])
                ->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Erro ao listar banners por evento API: ' . $e->getMessage());

            return $this->response
                ->setJSON([
                    'success' => false,
                    'message' => 'Erro ao listar banners',
                    'error' => ENVIRONMENT === 'development' ? $e->getMessage() : 'Erro interno'
                ])
                ->setStatusCode(500);
        }
    }

    /**
     * Serve uma imagem de banner
     * GET /banners/imagem/{arquivo}
     *
     * @param string|null $arquivo Nome do arquivo de imagem
     * @return void
     */
    public function imagem(string $arquivo = null)
    {
        if ($arquivo !== null) {
            $this->exibeArquivo('banners', $arquivo);
        }
    }
}
