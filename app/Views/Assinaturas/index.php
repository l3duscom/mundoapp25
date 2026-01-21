<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('conteudo') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Planos e Assinaturas</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">
                <i class="bx bx-crown me-2"></i>Planos e Assinaturas
            </h1>
            <p class="lead text-muted">Escolha o plano ideal para você e aproveite benefícios exclusivos</p>
        </div>
    </div>

    <?php if(session()->getFlashdata('erro')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('erro') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('info')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('info') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Planos -->
    <div class="row justify-content-center">
        <!-- Plano Free -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border h-100 shadow-sm">
                <div class="card-header bg-light text-center py-4">
                    <h4 class="mb-0 text-muted">Free</h4>
                    <div class="display-4 fw-bold text-muted my-3">R$ 0</div>
                    <span class="text-muted">Para sempre</span>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="py-2 border-bottom">
                            <i class="bx bx-check text-success me-2"></i>
                            Acesso aos eventos
                        </li>
                        <li class="py-2 border-bottom">
                            <i class="bx bx-check text-success me-2"></i>
                            Compra de ingressos
                        </li>
                        <li class="py-2 border-bottom">
                            <i class="bx bx-x text-danger me-2"></i>
                            <span class="text-muted">Acesso antecipado</span>
                        </li>
                        <li class="py-2 border-bottom">
                            <i class="bx bx-x text-danger me-2"></i>
                            <span class="text-muted">Descontos exclusivos</span>
                        </li>
                        <li class="py-2">
                            <i class="bx bx-x text-danger me-2"></i>
                            <span class="text-muted">Sem taxa de conveniência</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent border-top-0 text-center py-4">
                    <button class="btn btn-outline-secondary btn-lg w-100" disabled>
                        Plano Atual
                    </button>
                </div>
            </div>
        </div>

        <!-- Planos Premium -->
        <?php foreach($planos as $plano): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-primary h-100 shadow position-relative">
                <?php if($plano->ciclo === 'MONTHLY'): ?>
                <div class="position-absolute top-0 start-50 translate-middle">
                    <span class="badge bg-primary px-3 py-2">
                        <i class="bx bx-star me-1"></i>Mais Popular
                    </span>
                </div>
                <?php endif; ?>
                
                <div class="card-header text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h4 class="mb-0 text-white"><?= esc($plano->nome) ?></h4>
                    <div class="display-4 fw-bold text-white my-3"><?= $plano->getPrecoFormatado() ?></div>
                    <span class="text-white-50">
                        <?= $plano->ciclo === 'MONTHLY' ? '/mês' : '/ano' ?>
                        <?php if($plano->ciclo === 'YEARLY'): ?>
                        <br><small>(<?= $plano->getPrecoPorMesFormatado() ?>/mês)</small>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <?php foreach($plano->getBeneficios() as $beneficio): ?>
                        <li class="py-2 border-bottom">
                            <i class="bx bx-check-circle text-success me-2"></i>
                            <?= esc($beneficio) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="card-footer bg-transparent border-top-0 text-center py-4">
                    <?php if(isset($assinaturaAtiva) && $assinaturaAtiva && $assinaturaAtiva->plano_id == $plano->id): ?>
                        <button class="btn btn-success btn-lg w-100" disabled>
                            <i class="bx bx-check me-2"></i>Assinatura Ativa
                        </button>
                    <?php else: ?>
                        <a href="<?= site_url('assinaturas/contratar/' . $plano->id) ?>" 
                           class="btn btn-primary btn-lg w-100"
                           style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="bx bx-crown me-2"></i>Assinar Agora
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- FAQ -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="text-center mb-4">Perguntas Frequentes</h3>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Como funciona a assinatura?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            A assinatura é cobrada automaticamente no cartão de crédito cadastrado. Você pode cancelar a qualquer momento.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Posso cancelar a qualquer momento?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Sim! Você pode cancelar sua assinatura a qualquer momento. O acesso premium continua até o fim do período pago.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Quais formas de pagamento são aceitas?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Aceitamos cartão de crédito das principais bandeiras: Visa, Mastercard, Elo e Hipercard.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
