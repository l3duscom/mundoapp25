<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class EventoContextFilter implements FilterInterface
{
    /**
     * Verifica se há evento selecionado no contexto
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar se o usuário está logado e é admin
        $autenticacao = service('autenticacao');
        $usuario = $autenticacao->pegaUsuarioLogado();
        
        if (!$usuario || !$usuario->is_admin) {
            return;
        }

        // Verificar se há evento selecionado
        $event_id = session()->get('event_id');
        
        if (!$event_id) {
            // Se não há evento selecionado e está tentando acessar uma rota que precisa de contexto
            $path = $request->uri->getPath();
            
            // Rotas que precisam de contexto de evento
            $rotas_com_contexto = [
                'concursos',
                'pedidos/gerenciar_evento',
                'ingressos/add'
            ];
            
            foreach ($rotas_com_contexto as $rota) {
                if (strpos($path, $rota) !== false) {
                    // Redirecionar para home para selecionar evento
                    return redirect()->to(site_url('/'))->with('atencao', 'Selecione um evento primeiro.');
                }
            }
        }
    }

    /**
     * We don't have anything to do here.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
} 