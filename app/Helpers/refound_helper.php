<?php

/**
 * Helper para formatação de ingressos em views de reembolso
 */

if (!function_exists('formatarIngressosCliente')) {
    /**
     * Formata ingressos originais para exibição ao cliente
     * 
     * @param string $jsonString JSON com dados dos ingressos
     * @return string HTML formatado
     */
    function formatarIngressosCliente($jsonString)
    {
        if (empty($jsonString)) {
            return '<span class="text-muted">Nenhum ingresso encontrado</span>';
        }

        $ingressos = json_decode($jsonString, true);
        
        if (!is_array($ingressos) || empty($ingressos)) {
            return '<span class="text-muted">Nenhum ingresso encontrado</span>';
        }

        $html = '<div class="ingressos-lista">';
        
        foreach ($ingressos as $ingresso) {
            $nome = $ingresso['nome'] ?? $ingresso['ingresso_nome'] ?? 'Ingresso';
            $codigo = $ingresso['codigo'] ?? $ingresso['ingresso_codigo'] ?? '';
            $valor = $ingresso['valor'] ?? $ingresso['valor_original'] ?? null;
            
            $valorFormatado = $valor !== null ? 'R$ ' . number_format(floatval($valor), 2, ',', '.') : '';
            
            $html .= '<div class="ingresso-item d-flex align-items-center mb-2 p-2 bg-light rounded">';
            $html .= '<i class="bi bi-ticket-perforated text-primary me-2"></i>';
            $html .= '<div class="flex-grow-1">';
            $html .= '<span class="ingresso-nome fw-semibold">' . esc($nome) . '</span>';
            if (!empty($codigo)) {
                $html .= '<br><small class="text-muted">Código: ' . esc($codigo) . '</small>';
            }
            $html .= '</div>';
            if (!empty($valorFormatado)) {
                $html .= '<span class="ingresso-valor badge bg-secondary">' . $valorFormatado . '</span>';
            }
            $html .= '</div>';
        }
        
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('formatarIngressosUpgradeCliente')) {
    /**
     * Formata ingressos de upgrade para exibição ao cliente
     * Mostra o tipo da oferta e o ganho
     * 
     * @param string $jsonString JSON com dados dos ingressos de upgrade
     * @return string HTML formatado
     */
    function formatarIngressosUpgradeCliente($jsonString)
    {
        if (empty($jsonString)) {
            return '<span class="text-muted">Nenhum upgrade encontrado</span>';
        }

        $ingressos = json_decode($jsonString, true);
        
        if (!is_array($ingressos) || empty($ingressos)) {
            return '<span class="text-muted">Nenhum upgrade encontrado</span>';
        }

        $html = '<div class="ingressos-upgrade-lista">';
        
        foreach ($ingressos as $ingresso) {
            // Usar o tipo da OFERTA como nome principal
            $oferta = $ingresso['oferta'] ?? [];
            $nome = $oferta['tipo'] ?? $oferta['titulo'] ?? $ingresso['nome'] ?? $ingresso['ingresso_nome'] ?? 'Ingresso';
            $codigo = $ingresso['ingresso_codigo'] ?? $ingresso['codigo'] ?? '';
            $valor = $oferta['ganho'] ?? $ingresso['preco'] ?? null;
            
            // IMPORTANTE: Mostrar "Ganho de R$ xx,xx" para deixar claro que é um benefício
            $valorFormatado = $valor !== null ? 'Ganho de R$ ' . number_format(floatval($valor), 2, ',', '.') : '';
            
            $html .= '<div class="ingresso-item d-flex align-items-center mb-2 p-2 rounded" style="background: linear-gradient(135deg, #e6fffa 0%, #e0f2f1 100%); border: 1px solid #10b981;">';
            $html .= '<i class="bi bi-arrow-up-circle-fill text-success me-2" style="font-size: 1.25rem;"></i>';
            $html .= '<div class="flex-grow-1">';
            $html .= '<span class="ingresso-nome fw-bold text-success">' . esc($nome) . '</span>';
            if (!empty($codigo)) {
                $html .= '<br><small class="text-muted">Código: ' . esc($codigo) . '</small>';
            }
            $html .= '</div>';
            if (!empty($valorFormatado)) {
                $html .= '<span class="ingresso-valor badge bg-success">' . $valorFormatado . '</span>';
            }
            $html .= '</div>';
        }
        
        $html .= '</div>';
        
        return $html;
    }
}

if (!function_exists('getStatusRefoundBadge')) {
    /**
     * Retorna o badge HTML para um status de refound
     * 
     * @param string $status Status do refound
     * @return string HTML do badge
     */
    function getStatusRefoundBadge($status)
    {
        $badges = [
            'pendente' => '<span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i>Pendente</span>',
            'processando' => '<span class="badge bg-info"><i class="bi bi-gear me-1"></i>Em Análise</span>',
            'concluido' => '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Concluído</span>',
            'cancelado' => '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Cancelado</span>',
            'erro' => '<span class="badge bg-dark"><i class="bi bi-exclamation-triangle me-1"></i>Erro</span>',
        ];
        
        return $badges[$status] ?? '<span class="badge bg-secondary">' . esc($status) . '</span>';
    }
}

if (!function_exists('getTipoSolicitacaoBadge')) {
    /**
     * Retorna o badge HTML para um tipo de solicitação
     * 
     * @param string $tipo Tipo da solicitação (upgrade/reembolso)
     * @return string HTML do badge
     */
    function getTipoSolicitacaoBadge($tipo)
    {
        if ($tipo === 'upgrade') {
            return '<span class="badge bg-primary"><i class="bi bi-arrow-up-circle me-1"></i>Upgrade</span>';
        }
        return '<span class="badge bg-purple" style="background-color: #6f42c1;"><i class="bi bi-arrow-return-left me-1"></i>Reembolso</span>';
    }
}
