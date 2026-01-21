<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('conteudo') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Minhas Assinaturas</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="bx bx-crown text-primary me-2"></i>Minhas Assinaturas</h2>
                <a href="<?= site_url('assinaturas') ?>" class="btn btn-outline-primary">
                    <i class="bx bx-plus me-2"></i>Ver Planos
                </a>
            </div>
        </div>
    </div>

    <?php if(session()->getFlashdata('erro')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('erro') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('sucesso')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('sucesso') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if(empty($assinaturas)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bx bx-package display-1 text-muted mb-3"></i>
                    <h4 class="text-muted">Você ainda não possui assinaturas</h4>
                    <p class="text-muted mb-4">Assine um plano premium e aproveite benefícios exclusivos!</p>
                    <a href="<?= site_url('assinaturas') ?>" class="btn btn-primary btn-lg">
                        <i class="bx bx-crown me-2"></i>Ver Planos Disponíveis
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>

    <div class="row">
        <?php foreach($assinaturas as $assinatura): ?>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100 <?= $assinatura->status === 'ACTIVE' ? 'border-success' : '' ?>">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bx bx-crown text-primary me-2"></i>
                        <?= esc($assinatura->plano_nome ?? 'Plano Premium') ?>
                    </h5>
                    <span class="badge bg-<?= $assinatura->getStatusBadgeClass() ?>">
                        <?= $assinatura->getStatusLabel() ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Início</small>
                            <strong><?= $assinatura->getDataInicioFormatada() ?></strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Próximo Vencimento</small>
                            <strong><?= $assinatura->getProximoVencimentoFormatado() ?></strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Valor</small>
                            <strong class="text-primary"><?= $assinatura->getValorPagoFormatado() ?></strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Ciclo</small>
                            <strong><?= $assinatura->plano_ciclo === 'MONTHLY' ? 'Mensal' : 'Anual' ?></strong>
                        </div>
                        <?php if($assinatura->status === 'ACTIVE'): ?>
                        <div class="col-12">
                            <div class="alert alert-success mb-0 py-2">
                                <i class="bx bx-check-circle me-2"></i>
                                Restam <strong><?= $assinatura->getDiasRestantes() ?></strong> dias de acesso premium
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex gap-2">
                        <a href="<?= site_url('assinaturas/detalhes/' . $assinatura->id) ?>" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="bx bx-show me-1"></i>Detalhes
                        </a>
                        <?php if($assinatura->podeCancelar()): ?>
                        <button type="button" class="btn btn-outline-danger btn-sm flex-fill btn-cancelar" 
                                data-assinatura-id="<?= $assinatura->id ?>">
                            <i class="bx bx-x me-1"></i>Cancelar
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<!-- Modal de Cancelamento -->
<div class="modal fade" id="modalCancelar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger">
                    <i class="bx bx-error-circle me-2"></i>Cancelar Assinatura
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja cancelar sua assinatura?</p>
                <p class="text-muted small">
                    Você perderá acesso aos benefícios premium imediatamente após o cancelamento.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                <button type="button" class="btn btn-danger" id="btn-confirmar-cancelar">
                    <i class="bx bx-x me-2"></i>Confirmar Cancelamento
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    var assinaturaIdParaCancelar = null;
    var modal = new bootstrap.Modal(document.getElementById('modalCancelar'));

    // Abre modal de cancelamento
    $('.btn-cancelar').on('click', function() {
        assinaturaIdParaCancelar = $(this).data('assinatura-id');
        modal.show();
    });

    // Confirma cancelamento
    $('#btn-confirmar-cancelar').on('click', function() {
        if (!assinaturaIdParaCancelar) return;

        var btn = $(this);
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

        $.ajax({
            url: '<?= site_url('assinaturas/cancelar') ?>',
            type: 'POST',
            data: {
                assinatura_id: assinaturaIdParaCancelar,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function(response) {
                modal.hide();
                if (response.sucesso) {
                    location.reload();
                } else if (response.erro) {
                    alert(response.erro);
                    btn.prop('disabled', false).html('<i class="bx bx-x me-2"></i>Confirmar Cancelamento');
                }
            },
            error: function() {
                alert('Erro ao cancelar assinatura.');
                btn.prop('disabled', false).html('<i class="bx bx-x me-2"></i>Confirmar Cancelamento');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
