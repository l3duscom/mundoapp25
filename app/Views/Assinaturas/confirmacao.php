<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('conteudo') ?>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-success">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="bx bx-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h2 class="text-success mb-3">Assinatura Confirmada!</h2>
                    <p class="lead text-muted mb-4">
                        Parabéns! Você agora é um membro <strong>Premium</strong> e tem acesso a todos os benefícios exclusivos.
                    </p>

                    <div class="bg-light rounded p-4 mb-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <small class="text-muted">Plano</small>
                                <h5 class="mb-0"><?= esc($plano->nome) ?></h5>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Valor</small>
                                <h5 class="mb-0 text-primary"><?= $plano->getPrecoFormatado() ?></h5>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Início</small>
                                <h6 class="mb-0"><?= $assinatura->getDataInicioFormatada() ?></h6>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Próxima Cobrança</small>
                                <h6 class="mb-0"><?= $assinatura->getProximoVencimentoFormatado() ?></h6>
                            </div>
                        </div>
                    </div>

                    <h6 class="mb-3">Seus benefícios:</h6>
                    <ul class="list-unstyled text-start mx-auto" style="max-width: 300px;">
                        <?php foreach($plano->getBeneficios() as $beneficio): ?>
                        <li class="py-1">
                            <i class="bx bx-check-circle text-success me-2"></i><?= esc($beneficio) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= site_url('home') ?>" class="btn btn-primary btn-lg">
                            <i class="bx bx-home me-2"></i>Ir para Home
                        </a>
                        <a href="<?= site_url('assinaturas/minhas') ?>" class="btn btn-outline-primary">
                            Gerenciar Assinatura
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
