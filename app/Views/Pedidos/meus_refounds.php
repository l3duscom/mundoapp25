<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    /* Cards de Resumo Premium */
    .stats-card {
        position: relative;
        border-radius: 16px;
        padding: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
    }
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: 0.1;
        transform: translate(30%, -30%);
    }
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }
    .stats-card .stats-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }
    .stats-card .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stats-card .stats-label {
        font-size: 0.875rem;
        opacity: 0.8;
        font-weight: 500;
    }
    
    /* Card Total - Gradiente Azul */
    .stats-card.total {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .stats-card.total::before {
        background: white;
    }
    .stats-card.total .stats-icon {
        background: rgba(255,255,255,0.2);
        color: white;
    }
    
    /* Card Pendentes - Gradiente Amarelo/Laranja */
    .stats-card.pendentes {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        color: #5a3e00;
    }
    .stats-card.pendentes::before {
        background: #5a3e00;
    }
    .stats-card.pendentes .stats-icon {
        background: rgba(90,62,0,0.15);
        color: #5a3e00;
    }
    
    /* Card Concluídos - Gradiente Verde */
    .stats-card.concluidos {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    .stats-card.concluidos::before {
        background: white;
    }
    .stats-card.concluidos .stats-icon {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    /* Cards de Solicitação */
    .refound-card {
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .refound-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .refound-card .status-indicator {
        width: 4px;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
    }
    .refound-card.status-pendente .status-indicator { background: linear-gradient(180deg, #ffc107, #ff9800); }
    .refound-card.status-processando .status-indicator { background: linear-gradient(180deg, #17a2b8, #0dcaf0); }
    .refound-card.status-concluido .status-indicator { background: linear-gradient(180deg, #28a745, #20c997); }
    .refound-card.status-cancelado .status-indicator { background: linear-gradient(180deg, #dc3545, #fd7e14); }
    
    .refound-card .card-body {
        padding: 20px 24px;
        position: relative;
    }
    
    .evento-nome {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 4px;
    }
    
    .pedido-codigo {
        font-size: 0.8rem;
        opacity: 0.7;
    }
    
    .vantagem-valor {
        font-size: 1.25rem;
        font-weight: 700;
    }
    
    .btn-ver-detalhes {
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    .btn-ver-detalhes:hover {
        transform: scale(1.05);
    }
    
    /* Empty State */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }
    .empty-state-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2.5rem;
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .stats-card .stats-number {
            font-size: 2rem;
        }
        .refound-card .card-body {
            padding: 16px;
        }
    }
</style>
<?php echo $this->endSection() ?>


<?php echo $this->section('conteudo') ?>

<?php helper('refound'); ?>

<?php 
$total = count($refounds);
$pendentes = 0;
$concluidos = 0;
foreach ($refounds as $r) {
    if ($r->status === 'pendente') $pendentes++;
    if ($r->status === 'concluido') $concluidos++;
}
?>

<div class="row justify-content-center">
    <div class="col-lg-12 col-xl-10">
        
        <!-- Cabeçalho -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center rounded-circle me-3" 
                     style="width:50px; height:50px; background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="bi bi-arrow-repeat text-white" style="font-size:1.5rem;"></i>
                </div>
                <div>
                    <h2 class="mb-0 fw-bold">Minhas Solicitações</h2>
                    <small class="text-muted">Acompanhe seus reembolsos e upgrades</small>
                </div>
            </div>
        </div>

        <?php if (session()->has('erro')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?= session('erro') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->has('sucesso')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <?= session('sucesso') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Cards de Resumo -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stats-card total shadow">
                    <div class="stats-icon">
                        <i class="bi bi-stack"></i>
                    </div>
                    <div class="stats-number"><?= $total ?></div>
                    <div class="stats-label">Total de Solicitações</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card pendentes shadow">
                    <div class="stats-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stats-number"><?= $pendentes ?></div>
                    <div class="stats-label">Pendentes</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card concluidos shadow">
                    <div class="stats-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stats-number"><?= $concluidos ?></div>
                    <div class="stats-label">Concluídos</div>
                </div>
            </div>
        </div>

        <!-- Lista de Solicitações -->
        <?php if (empty($refounds)): ?>
            <div class="card border-0 shadow-sm rounded-4">
                <div class="empty-state">
                    <div class="empty-state-icon bg-light">
                        <i class="bi bi-inbox text-muted"></i>
                    </div>
                    <h4 class="mb-2">Nenhuma solicitação encontrada</h4>
                    <p class="text-muted mb-0">Você ainda não possui solicitações de reembolso ou upgrade.</p>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($refounds as $refound): ?>
                    <div class="col-12">
                        <div class="card refound-card status-<?= $refound->status ?> shadow-sm position-relative">
                            <div class="status-indicator"></div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- Info Principal -->
                                    <div class="col-lg-5 col-md-6 mb-3 mb-md-0">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <?= getTipoSolicitacaoBadge($refound->tipo_solicitacao) ?>
                                            <?= getStatusRefoundBadge($refound->status) ?>
                                        </div>
                                        <h5 class="evento-nome mb-1"><?= esc($refound->evento_nome) ?></h5>
                                        <span class="pedido-codigo">
                                            <i class="bi bi-receipt me-1"></i>
                                            Pedido #<?= esc($refound->pedido_codigo) ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Data -->
                                    <div class="col-lg-3 col-md-3 mb-3 mb-md-0">
                                        <div class="text-muted small mb-1">
                                            <i class="bi bi-calendar3 me-1"></i>Data da Solicitação
                                        </div>
                                        <div class="fw-semibold">
                                            <?= date('d/m/Y', strtotime($refound->created_at)) ?>
                                            <span class="text-muted small"><?= date('H:i', strtotime($refound->created_at)) ?></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Valor/Vantagem e Botão -->
                                    <div class="col-lg-4 col-md-3 text-md-end">
                                        <?php if (!empty($refound->oferta_vantagem_valor) && $refound->tipo_solicitacao === 'upgrade'): ?>
                                            <div class="text-muted small mb-1">Vantagem</div>
                                            <div class="vantagem-valor text-success mb-2">
                                                + R$ <?= number_format($refound->oferta_vantagem_valor, 2, ',', '.') ?>
                                            </div>
                                        <?php elseif (!empty($refound->pedido_valor_total)): ?>
                                            <div class="text-muted small mb-1">Valor do Pedido</div>
                                            <div class="vantagem-valor mb-2">
                                                R$ <?= number_format($refound->pedido_valor_total, 2, ',', '.') ?>
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?= site_url('pedidos/meus-refounds/' . $refound->id) ?>" 
                                           class="btn btn-outline-primary btn-ver-detalhes">
                                            <i class="bi bi-eye me-1"></i> Ver Detalhes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Botão Voltar -->
        <div class="mt-4">
            <a href="<?= site_url('pedidos') ?>" class="btn btn-outline-secondary rounded-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar para Meus Pedidos
            </a>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>
