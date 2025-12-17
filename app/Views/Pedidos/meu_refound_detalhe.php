<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    /* Timeline Premium */
    .timeline-container {
        position: relative;
        padding: 30px 20px;
        border-radius: 16px;
        overflow: hidden;
    }
    .timeline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }
    .timeline::before {
        content: '';
        position: absolute;
        top: 24px;
        left: 60px;
        right: 60px;
        height: 4px;
        background: rgba(255,255,255,0.2);
        border-radius: 2px;
        z-index: 1;
    }
    .timeline-progress {
        position: absolute;
        top: 24px;
        left: 60px;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #20c997);
        border-radius: 2px;
        z-index: 2;
        transition: width 0.5s ease;
    }
    .timeline-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 3;
        flex: 1;
    }
    .timeline-step .circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        border: 3px solid rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: rgba(255,255,255,0.5);
        margin-bottom: 12px;
        transition: all 0.3s;
    }
    .timeline-step.completed .circle {
        background: linear-gradient(135deg, #28a745, #20c997);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }
    .timeline-step.active .circle {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        animation: pulse-ring 1.5s infinite;
    }
    .timeline-step.error .circle {
        background: linear-gradient(135deg, #dc3545, #fd7e14);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
    }
    @keyframes pulse-ring {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.5); }
        70% { box-shadow: 0 0 0 15px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }
    .timeline-step .label {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.5);
        text-align: center;
        font-weight: 500;
    }
    .timeline-step.completed .label,
    .timeline-step.active .label {
        color: white;
        font-weight: 600;
    }

    /* Cards Premium */
    .detail-card {
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .detail-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    .detail-card .card-header {
        background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%);
        border-bottom: 1px solid rgba(255,255,255,0.1);
        font-weight: 600;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .detail-card .card-header i {
        font-size: 1.2rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .detail-card .card-body {
        padding: 20px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        color: rgba(255,255,255,0.6);
        font-size: 0.875rem;
    }
    .info-value {
        font-weight: 600;
        text-align: right;
    }

    /* Upgrade Section Premium */
    .upgrade-section {
        background: linear-gradient(135deg, rgba(16,185,129,0.15) 0%, rgba(5,150,105,0.1) 100%);
        border: 2px solid #10b981;
        border-radius: 16px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }
    .upgrade-section::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(16,185,129,0.1);
        border-radius: 50%;
    }
    .upgrade-section .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #10b981;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .upgrade-section .section-title i {
        font-size: 1.5rem;
    }
    .upgrade-inner-card {
        background: rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .upgrade-inner-card h6 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 16px;
        color: rgba(255,255,255,0.8);
    }

    /* Ingressos Cards */
    .ingresso-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s;
    }
    .ingresso-card:hover {
        background: rgba(255,255,255,0.08);
    }
    .ingresso-card.upgrade {
        background: linear-gradient(135deg, rgba(16,185,129,0.1) 0%, rgba(5,150,105,0.05) 100%);
        border-color: rgba(16,185,129,0.3);
    }
    .ingresso-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .ingresso-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .ingresso-icon.original {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    .ingresso-icon.upgrade {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    /* Benefícios Grid */
    .beneficio-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: rgba(16,185,129,0.1);
        border-radius: 8px;
        margin-bottom: 8px;
    }
    .beneficio-item i {
        color: #10b981;
        font-size: 1.1rem;
    }

    /* Breadcrumb Custom */
    .breadcrumb-custom {
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
        padding: 12px 20px;
    }
    .breadcrumb-custom .breadcrumb {
        margin: 0;
    }

    /* Header Section */
    .page-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }
    .page-header-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
    }
    .page-header-content h2 {
        font-weight: 700;
        margin-bottom: 4px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .timeline::before {
            left: 30px;
            right: 30px;
        }
        .timeline-step .circle {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        .timeline-step .label {
            font-size: 0.7rem;
        }
        .page-header-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }
    }
</style>
<?php echo $this->endSection() ?>


<?php echo $this->section('conteudo') ?>

<?php helper('refound'); ?>

<?php
// Determinar etapas da timeline
$etapas = [
    'enviada' => ['label' => 'Enviada', 'icon' => 'bi-send-fill'],
    'analise' => ['label' => 'Em Análise', 'icon' => 'bi-search'],
    'final' => ['label' => $refound->status === 'concluido' ? 'Concluída' : ($refound->status === 'cancelado' ? 'Cancelada' : 'Pendente'), 'icon' => $refound->status === 'concluido' ? 'bi-check-lg' : ($refound->status === 'cancelado' ? 'bi-x-lg' : 'bi-hourglass-split')],
];

$statusAtual = $refound->status;
$etapaAtual = 'enviada';
if (in_array($statusAtual, ['processando'])) {
    $etapaAtual = 'analise';
} elseif (in_array($statusAtual, ['concluido', 'cancelado', 'erro'])) {
    $etapaAtual = 'final';
}

// Calcular progresso da timeline
$etapasKeys = array_keys($etapas);
$etapaAtualIndex = array_search($etapaAtual, $etapasKeys);
$progressWidth = ($etapaAtualIndex / (count($etapas) - 1)) * 100;
?>

<div class="row justify-content-center">
    <div class="col-lg-12 col-xl-10">
        
        <!-- Breadcrumb -->
        <div class="breadcrumb-custom mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('pedidos') ?>"><i class="bi bi-house me-1"></i>Meus Pedidos</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('pedidos/meus-refounds') ?>">Minhas Solicitações</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Solicitação #<?= $refound->id ?></li>
                </ol>
            </nav>
        </div>

        <!-- Cabeçalho -->
        <div class="page-header">
            <div class="page-header-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="page-header-content">
                <h2>Solicitação #<?= $refound->id ?></h2>
                <div class="d-flex align-items-center gap-2">
                    <?= getTipoSolicitacaoBadge($refound->tipo_solicitacao) ?>
                    <?= getStatusRefoundBadge($refound->status) ?>
                </div>
            </div>
        </div>

        <!-- Timeline de Progresso -->
        <div class="card detail-card mb-4">
            <div class="card-header">
                <i class="bi bi-diagram-3"></i>
                <span>Progresso da Solicitação</span>
            </div>
            <div class="card-body timeline-container">
                <div class="timeline">
                    <div class="timeline-progress" style="width: <?= $progressWidth ?>%;"></div>
                    <?php 
                    foreach ($etapas as $key => $etapa): 
                        $index = array_search($key, $etapasKeys);
                        $isCompleted = $index < $etapaAtualIndex;
                        $isActive = $key === $etapaAtual;
                        $isError = $isActive && in_array($statusAtual, ['cancelado', 'erro']);
                        
                        $class = '';
                        if ($isCompleted) $class = 'completed';
                        elseif ($isActive && $isError) $class = 'error';
                        elseif ($isActive) $class = 'active';
                    ?>
                        <div class="timeline-step <?= $class ?>">
                            <div class="circle">
                                <i class="bi <?= $etapa['icon'] ?>"></i>
                            </div>
                            <span class="label"><?= $etapa['label'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Cards Evento e Pedido -->
        <div class="row g-4">
            <!-- Card do Evento -->
            <div class="col-md-6">
                <div class="card detail-card h-100">
                    <div class="card-header">
                        <i class="bi bi-calendar-event"></i>
                        <span>Evento</span>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><?= esc($refound->evento_nome) ?></h5>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-calendar3 me-2"></i>Data do Evento</span>
                            <span class="info-value">
                                <?= $refound->evento_data_inicio ? date('d/m/Y', strtotime($refound->evento_data_inicio)) : '-' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card do Pedido -->
            <div class="col-md-6">
                <div class="card detail-card h-100">
                    <div class="card-header">
                        <i class="bi bi-bag"></i>
                        <span>Pedido Original</span>
                    </div>
                    <div class="card-body">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-receipt me-2"></i>Código</span>
                            <span class="info-value">#<?= esc($refound->pedido_codigo) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-cash me-2"></i>Valor Total</span>
                            <span class="info-value">R$ <?= number_format($refound->pedido_valor_total ?? 0, 2, ',', '.') ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-calendar-check me-2"></i>Data da Compra</span>
                            <span class="info-value">
                                <?= $refound->pedido_data_compra ? date('d/m/Y H:i', strtotime($refound->pedido_data_compra)) : '-' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ingressos Originais -->
        <?php if (!empty($refound->ingressos_originais)): ?>
        <?php 
        $ingressosOriginais = json_decode($refound->ingressos_originais, true);
        if (is_array($ingressosOriginais) && !empty($ingressosOriginais)):
        ?>
        <div class="card detail-card mt-4">
            <div class="card-header">
                <i class="bi bi-ticket-perforated"></i>
                <span>Ingressos Originais</span>
            </div>
            <div class="card-body">
                <?php foreach ($ingressosOriginais as $ingresso): ?>
                <?php 
                $nome = $ingresso['nome'] ?? $ingresso['ingresso_nome'] ?? 'Ingresso';
                $codigo = $ingresso['codigo'] ?? $ingresso['ingresso_codigo'] ?? '';
                $valor = $ingresso['valor'] ?? $ingresso['valor_original'] ?? null;
                ?>
                <div class="ingresso-card">
                    <div class="ingresso-info">
                        <div class="ingresso-icon original">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                        <div>
                            <div class="fw-semibold"><?= esc($nome) ?></div>
                            <?php if (!empty($codigo)): ?>
                            <small class="text-muted">Código: <?= esc($codigo) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($valor !== null): ?>
                    <span class="badge bg-secondary">R$ <?= number_format(floatval($valor), 2, ',', '.') ?></span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Seção de Upgrade -->
        <?php if ($refound->tipo_solicitacao === 'upgrade'): ?>
        <div class="upgrade-section mt-4">
            <div class="section-title">
                <i class="bi bi-arrow-up-circle-fill"></i>
                Upgrade Solicitado
            </div>
            
            <div class="row g-4">
                <!-- Detalhes do Upgrade -->
                <div class="col-md-6">
                    <div class="upgrade-inner-card">
                        <h6><i class="bi bi-info-circle me-2"></i>Detalhes da Oferta</h6>
                        <?php if (!empty($refound->oferta_titulo)): ?>
                        <div class="info-row">
                            <span class="info-label">Oferta</span>
                            <span class="info-value"><?= esc($refound->oferta_titulo) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($refound->tipo_upgrade)): ?>
                        <div class="info-row">
                            <span class="info-label">Tipo</span>
                            <span class="info-value"><?= esc($refound->tipo_upgrade) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($refound->oferta_vantagem_valor)): ?>
                        <div class="info-row">
                            <span class="info-label">Vantagem</span>
                            <span class="info-value text-success fw-bold" style="font-size: 1.1rem;">
                                + R$ <?= number_format($refound->oferta_vantagem_valor, 2, ',', '.') ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Novos Ingressos -->
                <div class="col-md-6">
                    <?php if (!empty($refound->ingressos_para_upgrade)): ?>
                    <?php 
                    $ingressosUpgrade = json_decode($refound->ingressos_para_upgrade, true);
                    if (is_array($ingressosUpgrade) && !empty($ingressosUpgrade)):
                    ?>
                    <div class="upgrade-inner-card">
                        <h6><i class="bi bi-stars me-2"></i>Novos Ingressos</h6>
                        <?php foreach ($ingressosUpgrade as $ingresso): ?>
                        <?php 
                        $oferta = $ingresso['oferta'] ?? [];
                        $nome = $oferta['tipo'] ?? $oferta['titulo'] ?? $ingresso['nome'] ?? 'Ingresso';
                        $codigo = $ingresso['ingresso_codigo'] ?? $ingresso['codigo'] ?? '';
                        $valor = $oferta['ganho'] ?? null;
                        ?>
                        <div class="ingresso-card upgrade">
                            <div class="ingresso-info">
                                <div class="ingresso-icon upgrade">
                                    <i class="bi bi-arrow-up"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-success"><?= esc($nome) ?></div>
                                    <?php if (!empty($codigo)): ?>
                                    <small class="text-muted">Código: <?= esc($codigo) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ($valor !== null): ?>
                            <span class="badge bg-success">Ganho de R$ <?= number_format(floatval($valor), 2, ',', '.') ?></span>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Benefícios -->
            <?php if (!empty($refound->beneficios_apresentados)): ?>
            <?php 
            $beneficios = json_decode($refound->beneficios_apresentados, true);
            if (is_array($beneficios) && !empty($beneficios)):
            ?>
            <div class="upgrade-inner-card mt-4">
                <h6><i class="bi bi-gift me-2"></i>Benefícios Incluídos</h6>
                <div class="row g-2">
                    <?php foreach ($beneficios as $beneficio): ?>
                    <div class="col-md-6">
                        <div class="beneficio-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span><?= esc($beneficio) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Informações da Solicitação -->
        <div class="card detail-card mt-4">
            <div class="card-header">
                <i class="bi bi-info-circle"></i>
                <span>Informações da Solicitação</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-calendar-plus me-2"></i>Data da Solicitação</span>
                            <span class="info-value"><?= date('d/m/Y H:i', strtotime($refound->created_at)) ?></span>
                        </div>
                        <?php if (!empty($refound->processado_em)): ?>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-calendar-check me-2"></i>Data de Processamento</span>
                            <span class="info-value"><?= date('d/m/Y H:i', strtotime($refound->processado_em)) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-flag me-2"></i>Status Atual</span>
                            <span class="info-value"><?= getStatusRefoundBadge($refound->status) ?></span>
                        </div>
                    </div>
                </div>
                <?php if (!empty($refound->observacoes)): ?>
                <div class="mt-3 p-3 rounded" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <strong class="d-block mb-2"><i class="bi bi-chat-left-text me-2"></i>Observações:</strong>
                    <p class="mb-0 text-muted"><?= nl2br(esc($refound->observacoes)) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Botão Voltar -->
        <div class="mt-4">
            <a href="<?= site_url('pedidos/meus-refounds') ?>" class="btn btn-outline-secondary rounded-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar para Minhas Solicitações
            </a>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>
