<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    .upgrade-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 20px;
    }
    
    /* Header com destaque */
    .upgrade-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .upgrade-header .badge-special {
        display: inline-block;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }
    
    .upgrade-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
        line-height: 1.2;
    }
    
    .upgrade-header h1 span {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .upgrade-header p {
        font-size: 16px;
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Card da oferta */
    .upgrade-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
        border: 2px solid #6366f1;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .upgrade-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .upgrade-card .ribbon {
        position: absolute;
        top: 20px;
        right: -35px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        padding: 8px 40px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        transform: rotate(45deg);
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
    }
    
    .offer-content {
        position: relative;
        z-index: 1;
    }
    
    .offer-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .offer-title .icon {
        font-size: 32px;
    }
    
    /* Comparação */
    .comparison {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        margin: 30px 0;
        flex-wrap: wrap;
    }
    
    .comparison-item {
        text-align: center;
        padding: 20px;
        border-radius: 12px;
        min-width: 180px;
    }
    
    .comparison-item.old {
        background: #f3f4f6;
        opacity: 0.7;
    }
    
    .comparison-item.new {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
    }
    
    .comparison-item .label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
        margin-bottom: 8px;
    }
    
    .comparison-item .value {
        font-size: 18px;
        font-weight: 700;
    }
    
    .comparison-arrow {
        font-size: 28px;
        color: #6366f1;
    }
    
    /* Ganho destacado */
    .gain-highlight {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        padding: 20px 30px;
        border-radius: 12px;
        text-align: center;
        margin: 25px 0;
    }
    
    .gain-highlight .gain-label {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 5px;
    }
    
    .gain-highlight .gain-sublabel {
        font-size: 12px;
        opacity: 0.8;
        margin-top: 5px;
    }
    
    .gain-highlight .gain-value {
        font-size: 36px;
        font-weight: 800;
    }
    
    /* Lista de benefícios */
    .benefits-section {
        margin: 30px 0;
    }
    
    .benefits-section h3 {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 15px;
    }
    
    .benefits-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .benefit-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 15px;
        background: #fff;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
    }
    
    .benefit-item .check {
        color: #10b981;
        font-size: 18px;
        flex-shrink: 0;
    }
    
    /* Opções de upgrade (quando há mais de uma) */
    .upgrade-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin: 20px 0;
    }
    
    .upgrade-option {
        background: #fff;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .upgrade-option:hover,
    .upgrade-option.selected {
        border-color: #6366f1;
        box-shadow: 0 5px 20px rgba(99, 102, 241, 0.2);
    }
    
    .upgrade-option.selected {
        background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
    }
    
    .upgrade-option h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 10px;
    }
    
    .upgrade-option .option-gain {
        display: inline-block;
        background: #10b981;
        color: #fff;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Botões */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn-upgrade {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 18px 30px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .btn-upgrade:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
    }
    
    .btn-refuse {
        display: block;
        text-align: center;
        padding: 12px;
        color: #9ca3af;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .btn-refuse:hover {
        color: #6b7280;
    }
    
    /* Modal de confirmação */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .modal-overlay.active {
        display: flex;
    }
    
    .modal-content {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        max-width: 500px;
        width: 100%;
        text-align: center;
    }
    
    .modal-icon {
        font-size: 48px;
        margin-bottom: 20px;
    }
    
    .modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }
    
    .modal-text {
        font-size: 15px;
        color: #6b7280;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    .modal-benefits {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        text-align: left;
    }
    
    .modal-benefits h4 {
        font-size: 14px;
        font-weight: 600;
        color: #92400e;
        margin-bottom: 10px;
    }
    
    .modal-benefits ul {
        margin: 0;
        padding-left: 20px;
        font-size: 13px;
        color: #92400e;
    }
    
    .modal-buttons {
        display: flex;
        gap: 15px;
    }
    
    .modal-btn {
        flex: 1;
        padding: 14px 20px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }
    
    .modal-btn.primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
    }
    
    .modal-btn.primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
    }
    
    .modal-btn.secondary {
        background: transparent;
        color: #9ca3af;
        font-size: 12px;
        font-weight: 400;
        text-decoration: underline;
        padding: 8px 10px;
    }
    
    .modal-btn.secondary:hover {
        background: transparent;
        color: #6b7280;
    }
    
    /* Responsivo */
    @media (max-width: 768px) {
        .upgrade-header h1 {
            font-size: 24px;
        }
        
        .comparison {
            flex-direction: column;
            gap: 15px;
        }
        
        .comparison-arrow {
            transform: rotate(90deg);
        }
        
        .comparison-item.new {
            transform: scale(1);
        }
        
        .modal-buttons {
            flex-direction: column;
        }
    }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<?php
// Definir ofertas baseadas no ticket_id
$ticketIdsExcecao = [608, 1113, 1114, 1115, 1116, 1117, 1118, 1119, 1123, 1124];

// Função para obter oferta baseada no ticket_id
function getOfertaParaTicket($ticketId) {
    switch ($ticketId) {
        case 1114:
        case 1124:
            return [
                'titulo' => '2x Ingressos VIP FULL',
                'subtitulo' => 'Experiência máxima no Dreamfest ou Anime Expo',
                'ganho' => 296,
                'quantidade' => 2,
                'tipo' => 'VIP FULL',
            ];
            
        case 1113:
            return [
                'titulo' => '1x Ingresso VIP FULL',
                'subtitulo' => 'Experiência máxima no Dreamfest ou Anime Expo',
                'ganho' => 199,
                'quantidade' => 1,
                'tipo' => 'VIP FULL',
            ];
            
        case 1115:
            return [
                'titulo' => '1x Ingresso VIP FULL',
                'subtitulo' => 'Experiência máxima no Dreamfest ou Anime Expo',
                'ganho' => 244,
                'quantidade' => 1,
                'tipo' => 'VIP FULL',
            ];
            
        case 1116:
            // Para este ticket, usamos a primeira opção como padrão
            return [
                'titulo' => '2x Ingressos VIP FULL',
                'subtitulo' => 'Experiência máxima para você e um acompanhante',
                'ganho' => 398,
                'quantidade' => 2,
                'tipo' => 'VIP FULL',
                'opcao_alternativa' => [
                    'titulo' => '1x Combo 2 Dias VIP FULL',
                    'subtitulo' => 'Experiência completa nos dois dias de evento',
                    'ganho' => 258,
                ],
            ];
            
        default:
            // Demais tickets (1117, 1118, 1119, 1123, 608)
            return [
                'titulo' => '1x EPIC PASS',
                'subtitulo' => 'Acesso especial ao próximo evento',
                'ganho' => 99,
                'quantidade' => 1,
                'tipo' => 'EPIC PASS',
            ];
    }
}

// Processar TODOS os ingressos do pedido
$ingressosParaUpgrade = [];
$ganhoTotal = 0;
$totalIngressosNovos = 0;

if (!empty($ingressos)) {
    foreach ($ingressos as $ingresso) {
        if (isset($ingresso->ticket_id) && in_array((int)$ingresso->ticket_id, $ticketIdsExcecao)) {
            $oferta = getOfertaParaTicket((int)$ingresso->ticket_id);
            $ingressosParaUpgrade[] = [
                'ingresso_atual' => $ingresso->nome,
                'ingresso_id' => $ingresso->id,
                'ticket_id' => $ingresso->ticket_id,
                'oferta' => $oferta,
            ];
            $ganhoTotal += $oferta['ganho'];
            $totalIngressosNovos += $oferta['quantidade'];
        }
    }
}

// Resumo das ofertas para exibição
$totalIngressosAtuais = count($ingressosParaUpgrade);
$ingressoAtual = $totalIngressosAtuais > 1 
    ? $totalIngressosAtuais . ' ingressos atuais' 
    : ($ingressosParaUpgrade[0]['ingresso_atual'] ?? 'Ingresso anterior');

// Agrupar ofertas por tipo para exibição
$resumoOfertas = [];
foreach ($ingressosParaUpgrade as $item) {
    $tipo = $item['oferta']['tipo'];
    if (!isset($resumoOfertas[$tipo])) {
        $resumoOfertas[$tipo] = ['quantidade' => 0, 'titulo' => $item['oferta']['titulo']];
    }
    $resumoOfertas[$tipo]['quantidade'] += $item['oferta']['quantidade'];
}

// Montar título resumido
$tituloOfertaResumo = [];
foreach ($resumoOfertas as $tipo => $dados) {
    $tituloOfertaResumo[] = $dados['quantidade'] . 'x ' . $tipo;
}
$tituloOfertaFinal = implode(' + ', $tituloOfertaResumo);

// Identificar tipo principal de upgrade para exibir benefícios corretos
$tipoUpgradePrincipal = 'EPIC PASS'; // Padrão
if (isset($resumoOfertas['VIP FULL'])) {
    $tipoUpgradePrincipal = 'VIP FULL';
}

// Para compatibilidade com o restante do código
$ofertas = [];
if (!empty($ingressosParaUpgrade)) {
    $ofertas[] = [
        'titulo' => $tituloOfertaFinal ?: '1x EPIC PASS',
        'subtitulo' => 'Upgrade automático para todos os ingressos do pedido',
        'ganho' => $ganhoTotal,
    ];
    
    // Verificar se tem ticket 1116 para oferecer opção alternativa
    $temTicket1116 = false;
    foreach ($ingressosParaUpgrade as $item) {
        if ($item['ticket_id'] == 1116) {
            $temTicket1116 = true;
            break;
        }
    }
    
    if ($temTicket1116) {
        // Calcular ganho alternativo
        $ganhoAlternativo = 0;
        foreach ($ingressosParaUpgrade as $item) {
            if ($item['ticket_id'] == 1116 && isset($item['oferta']['opcao_alternativa'])) {
                $ganhoAlternativo += $item['oferta']['opcao_alternativa']['ganho'];
            } else {
                $ganhoAlternativo += $item['oferta']['ganho'];
            }
        }
        $ofertas[] = [
            'titulo' => 'Opção Combo 2 Dias',
            'subtitulo' => 'Inclui Combo 2 Dias VIP FULL para tickets elegíveis',
            'ganho' => $ganhoAlternativo,
        ];
    }
}
?>

<div class="upgrade-container">
    <!-- Header especial -->
    <div class="upgrade-header">
        <span class="badge-special">🎁 Oferta Exclusiva</span>
        <h1>Espera! Temos uma <span>proposta incrível</span> para você!</h1>
        <p>Antes de solicitar o reembolso, que tal trocar seu ingresso por uma experiência ainda melhor? Sem custo adicional!</p>
    </div>
    
    <!-- Card da oferta principal -->
    <div class="upgrade-card">
        <div class="ribbon">GRÁTIS</div>
        
        <div class="offer-content">
            <div class="offer-title">
                <span class="icon">🚀</span>
                Upgrade Garantido
            </div>
            
            <!-- Comparação visual -->
            <div class="comparison">
                <div class="comparison-item old">
                    <div class="label">Seu ingresso atual</div>
                    <div class="value"><?= esc($ingressoAtual) ?></div>
                </div>
                
                <div class="comparison-arrow">→</div>
                
                <div class="comparison-item new">
                    <div class="label">Seu novo ingresso</div>
                    <div class="value"><?= esc($ofertas[0]['titulo']) ?></div>
                </div>
            </div>
            
            <!-- Vantagem destacada -->
            <div class="gain-highlight">
                <div class="gain-label">Vantagem no upgrade</div>
                <div class="gain-value">+ R$ <?= number_format($ganhoTotal, 0, ',', '.') ?></div>
                <div class="gain-sublabel">em valor de ingresso</div>
            </div>
            
            <?php if (count($ofertas) > 1): ?>
            <!-- Múltiplas opções de upgrade -->
            <div class="upgrade-options">
                <?php foreach ($ofertas as $index => $oferta): ?>
                <div class="upgrade-option <?= $index === 0 ? 'selected' : '' ?>" onclick="selecionarOpcao(this, <?= $index ?>)">
                    <h4><?= esc($oferta['titulo']) ?></h4>
                    <p style="font-size: 13px; color: #6b7280; margin-bottom: 10px;"><?= esc($oferta['subtitulo']) ?></p>
                    <span class="option-gain">Ganho: R$ <?= number_format($oferta['ganho'], 0, ',', '.') ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Benefícios do upgrade -->
            <div class="benefits-section">
                <h3>✨ O que você ganha com o <?= $tipoUpgradePrincipal ?>:</h3>
                <div class="benefits-list">
                    
                    <?php if ($tipoUpgradePrincipal === 'EPIC PASS'): ?>
                    <!-- Benefícios do EPIC PASS -->
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Fila preferencial</strong> (Entrada e Food Park)
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Acesso ao evento com <strong>1 hora de antecedência</strong>
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Pulseira Colecionável
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Credencial + Cordão Colecionável
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Pôster Oficial
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Até 30% de desconto</strong> em lojinhas durante o evento
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Frontstage</strong> - Acesso às primeiras fileiras do palco principal
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Meet & Greet</strong> com convidados especiais (Fila virtual com check-in antecipado)
                    </div>
                    
                    <?php else: ?>
                    <!-- Benefícios do VIP FULL -->
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Fila preferencial</strong> (Entrada e Food Park)
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Acesso ao evento com <strong>1 hora de antecedência</strong>
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        1 Ingresso Cinemark Cortesia
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Pulseira Colecionável
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Credencial + Cordão Colecionável
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Copo EXCLUSIVO Colecionável
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Ingresso Holográfico EXCLUSIVO colecionável
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        Pôster Oficial
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Meet & Greet</strong> com todos os convidados
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Até 30% de desconto</strong> em lojinhas durante o evento
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Sala VIP</strong> - Acesso à sala climatizada, reservada e com presença de convidados
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Espaço Diversão</strong> - Fliperamas e animes/séries liberados na sala VIP
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Frontstage</strong> - Espaço nas primeiras fileiras do palco principal
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Alimentação inclusa</strong> - Snacks, salgados, bebidas quentes e geladas e guloseimas na sala VIP
                    </div>
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Rodízio de Pizza</strong> servido exclusivamente na sala VIP das 13h às 16h
                    </div>
                    <?php endif; ?>
                    
                    <div class="benefit-item">
                        <span class="check">✓</span>
                        <strong>Validade de 2 anos</strong> para usar em qualquer edição
                    </div>
                </div>
            </div>
            
            <!-- Onde usar o upgrade -->
            <div class="validity-section" style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 12px; padding: 20px; margin-top: 20px;">
                <h4 style="font-size: 16px; font-weight: 600; color: #92400e; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                    📅 Validade do seu upgrade
                </h4>
                <p style="font-size: 14px; color: #78350f; margin-bottom: 15px; line-height: 1.6;">
                    Seu novo ingresso é válido por <strong>2 anos</strong> e pode ser utilizado em <strong>qualquer edição</strong> dos eventos:
                </p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="https://instagram.com/dreamfestoficial" target="_blank" style="display: flex; align-items: center; gap: 8px; background: #fff; padding: 10px 16px; border-radius: 8px; text-decoration: none; color: #1f2937; font-weight: 500; font-size: 14px; border: 1px solid #e5e7eb; transition: all 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #E4405F;"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        @dreamfestoficial
                    </a>
                    <a href="https://instagram.com/animexpoficial" target="_blank" style="display: flex; align-items: center; gap: 8px; background: #fff; padding: 10px 16px; border-radius: 8px; text-decoration: none; color: #1f2937; font-weight: 500; font-size: 14px; border: 1px solid #e5e7eb; transition: all 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #E4405F;"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        @animexpoficial
                    </a>
                </div>
                <p style="font-size: 12px; color: #a16207; margin-top: 12px;">
                    Acompanhe as redes sociais para ficar por dentro das próximas edições!
                </p>
            </div>
        </div>
    </div>
    
    <!-- Botões de ação -->
    <div class="action-buttons">
        <button type="button" class="btn-upgrade" onclick="aceitarUpgrade()">
            <span>🎉</span>
            Quero fazer o upgrade GRÁTIS!
        </button>
        
        <a href="javascript:void(0)" class="btn-refuse" onclick="abrirModalRecusa()">
            Não, prefiro receber o reembolso em dinheiro
        </a>
    </div>
</div>

<!-- Modal de confirmação de recusa -->
<div class="modal-overlay" id="modalRecusa">
    <div class="modal-content">
        <div class="modal-icon">🤔</div>
        <div class="modal-title">Tem certeza que quer recusar?</div>
        <div class="modal-text">
            Você está abrindo mão de um upgrade gratuito para um ingresso que vale <strong>R$ <?= number_format($ganhoTotal, 0, ',', '.') ?> a mais</strong> que o seu ingresso atual!
        </div>
        
        <div class="modal-benefits">
            <h4>⚠️ Você vai perder:</h4>
            <ul>
                <li>Upgrade gratuito para <?= esc($ofertas[0]['titulo']) ?></li>
                <li>Ingresso R$ <?= number_format($ofertas[0]['ganho'], 0, ',', '.') ?> mais valioso que o atual</li>
                <?php if ($tipoUpgradePrincipal === 'EPIC PASS'): ?>
                <!-- Benefícios EPIC PASS -->
                <li>Fila preferencial (Entrada e Food Park)</li>
                <li>Acesso 1 hora antes do evento</li>
                <li>Frontstage nas primeiras fileiras</li>
                <li>Meet & Greet com convidados especiais</li>
                <li>Brindes colecionáveis</li>
                <li>Até 30% de desconto em lojinhas</li>
                <?php else: ?>
                <!-- Benefícios VIP FULL -->
                <li>Sala VIP com alimentação inclusa</li>
                <li>Rodízio de Pizza das 13h às 16h</li>
                <li>Meet & Greet com todos os convidados</li>
                <li>Frontstage nas primeiras fileiras</li>
                <li>Ingresso Cinemark Cortesia</li>
                <li>Brindes colecionáveis exclusivos</li>
                <?php endif; ?>
                <li>Acesso garantido por 2 anos</li>
            </ul>
        </div>
        
        <!-- Aviso sobre demora do reembolso -->
        <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 15px; margin-bottom: 20px; text-align: left;">
            <h4 style="font-size: 13px; font-weight: 600; color: #b91c1c; margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                ⏳ Aviso sobre reembolso em dinheiro
            </h4>
            <p style="font-size: 12px; color: #991b1b; line-height: 1.5; margin: 0;">
                O reembolso em dinheiro está <strong>demorando mais que o esperado</strong>, pois os valores investidos para trazer os artistas, assim como toda a logística do evento, já foram utilizados e não puderam ser recuperados.
            </p>
        </div>
        
        <div class="modal-buttons">
            <button type="button" class="modal-btn primary" onclick="fecharModalRecusa()">
                Voltar e aceitar o upgrade
            </button>
            <button type="button" class="modal-btn secondary" onclick="confirmarRecusa()">
                Continuar com reembolso
            </button>
        </div>
    </div>
</div>

<!-- Formulário oculto para envio -->
<form id="formUpgrade" method="POST" action="<?= site_url('cancelamento/processar-upgrade') ?>" style="display: none;">
    <?= csrf_field() ?>
    <input type="hidden" name="pedido_id" value="<?= esc($pedido->id) ?>">
    <input type="hidden" name="opcao_selecionada" id="opcaoSelecionada" value="0">
    <input type="hidden" name="aceita_upgrade" id="aceitaUpgrade" value="">
</form>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>
<script>
    let opcaoSelecionada = 0;
    
    function selecionarOpcao(elemento, index) {
        // Remove seleção anterior
        document.querySelectorAll('.upgrade-option').forEach(el => el.classList.remove('selected'));
        // Adiciona seleção nova
        elemento.classList.add('selected');
        opcaoSelecionada = index;
        document.getElementById('opcaoSelecionada').value = index;
    }
    
    function aceitarUpgrade() {
        document.getElementById('aceitaUpgrade').value = '1';
        document.getElementById('formUpgrade').submit();
    }
    
    function abrirModalRecusa() {
        document.getElementById('modalRecusa').classList.add('active');
    }
    
    function fecharModalRecusa() {
        document.getElementById('modalRecusa').classList.remove('active');
    }
    
    function confirmarRecusa() {
        document.getElementById('aceitaUpgrade').value = '0';
        document.getElementById('formUpgrade').submit();
    }
    
    // Fechar modal ao clicar fora
    document.getElementById('modalRecusa').addEventListener('click', function(e) {
        if (e.target === this) {
            fecharModalRecusa();
        }
    });
</script>
<?php echo $this->endSection() ?>
