<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiKeyFilter implements FilterInterface
{
    /**
     * Verifica se a API Key está presente e é válida
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verifica API Key no header Authorization (Bearer)
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');
        $apiKey = null;
        
        if (!empty($authHeader)) {
            if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
                $apiKey = $matches[1];
            }
        }
        
        if (empty($apiKey)) {
            return service('response')
                ->setJSON([
                    'error' => 'API Key é obrigatória',
                    'message' => 'Use Authorization: Bearer YOUR_API_KEY'
                ])
                ->setStatusCode(401);
        }
        
        // Lista de API Keys válidas lidas do .env
        $validApiKeys = [
            env('API_ACCESS_TOKEN'),
            env('API_ACCESS_TOKEN_SANDBOX'),
            env('API_ACCESS_TOKEN_TEST')
        ];
        
        // Remove valores vazios/null
        $validApiKeys = array_filter($validApiKeys);
        
        if (empty($validApiKeys)) {
            log_message('error', 'Nenhuma API Key configurada no .env');
            return service('response')
                ->setJSON(['error' => 'Configuração de API inválida'])
                ->setStatusCode(500);
        }
        
        if (!in_array($apiKey, $validApiKeys)) {
            return service('response')
                ->setJSON(['error' => 'API Key inválida'])
                ->setStatusCode(401);
        }
        
        return $request;
    }

    /**
     * Executado após a requisição
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Método vazio - não necessário para este filtro
    }
} 