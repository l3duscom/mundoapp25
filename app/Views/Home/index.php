<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>
<style>
    .evento-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
    }
    
    .evento-card:hover {
        transform: translateY(-2px);
        border-color: #007bff;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }
    
    .evento-card .card-body {
        padding: 1.5rem;
    }
    
    .evento-card .evento-nome {
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.5rem;
    }
    
    .evento-card .evento-status {
        font-size: 0.9rem;
        color: #28a745;
        font-weight: 500;
    }
    
    .evento-card .evento-status.inativo {
        color: #dc3545;
    }
    
    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .selection-guide {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-radius: 0.5rem;
    }
    
    .no-events {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }
    
    .no-events i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #dee2e6;
    }
</style>
<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<!-- Seção de Boas-vindas -->
<div class="welcome-section">
    <div class="d-flex align-items-center">
        <div class="me-3">
            <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
        </div>
        <div>
            <h3 class="mb-1">Olá, <strong><?php echo esc(usuario_logado()->nome); ?>!</strong></h3>
            <p class="mb-0 opacity-75">Bem-vindo ao painel administrativo</p>
        </div>
    </div>
</div>

<!-- Guia de Seleção -->
<div class="selection-guide">
    <div class="d-flex align-items-center">
        <div class="me-3">
            <i class="bi bi-info-circle-fill text-primary" style="font-size: 1.5rem;"></i>
        </div>
        <div>
            <h5 class="mb-1">Selecione um Evento</h5>
            <p class="mb-0 text-muted">Escolha um evento abaixo para acessar suas funcionalidades administrativas. Após a seleção, você poderá gerenciar ingressos, pedidos e concursos.</p>
        </div>
    </div>
</div>

<!-- Lista de Eventos -->
<?php if (!empty($eventos)) : ?>
    <div class="row">
        <?php foreach ($eventos as $evento) : ?>
            <?php if ($evento->ativo == 1) : ?>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card evento-card h-100" onclick="window.location.href='<?= site_url('home/evento/' . $evento->id) ?>'">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <i class="bi bi-calendar-event text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="evento-nome"><?= esc($evento->nome) ?></div>
                                    <div class="evento-status">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Evento Ativo
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?= $evento->local ?></small>
                                    <i class="bi bi-arrow-right text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="no-events">
        <i class="bi bi-calendar-x"></i>
        <h4>Nenhum evento disponível</h4>
        <p class="text-muted">Não há eventos ativos no momento.</p>
    </div>
<?php endif; ?>

<!-- Dica adicional -->
<?php if (!empty($eventos)) : ?>
    <div class="mt-4">
        <div class="alert alert-info" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-lightbulb me-2"></i>
                <div>
                    <strong>Dica:</strong> Após selecionar um evento, você verá apenas os menus relevantes para aquele evento específico.
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php echo $this->endSection() ?>




<?php echo $this->section('scripts') ?>
<script>
    // Adicionar efeito de hover mais suave
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.evento-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
<?php echo $this->endSection() ?>