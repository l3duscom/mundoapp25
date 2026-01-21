<?= $this->extend('Layout/principal') ?>

<?= $this->section('titulo') ?><?= $titulo ?><?= $this->endSection() ?>

<?= $this->section('conteudo') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('assinaturas') ?>">Planos</a></li>
                    <li class="breadcrumb-item active">Contratar</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Resumo do Plano -->
            <div class="card border-primary mb-4 shadow">
                <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0"><i class="bx bx-crown me-2"></i><?= esc($plano->nome) ?></h5>
                            <small><?= $plano->getCicloFormatado() ?></small>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-0"><?= $plano->getPrecoFormatado() ?></h3>
                            <small><?= $plano->ciclo === 'MONTHLY' ? '/mês' : '/ano' ?></small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6>Benefícios inclusos:</h6>
                    <ul class="list-unstyled">
                        <?php foreach($plano->getBeneficios() as $beneficio): ?>
                        <li class="py-1">
                            <i class="bx bx-check-circle text-success me-2"></i><?= esc($beneficio) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Formulário de Pagamento -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h5 class="mb-0"><i class="bx bx-credit-card me-2"></i>Dados de Pagamento</h5>
                </div>
                <div class="card-body">
                    <form id="form-assinatura" action="<?= site_url('assinaturas/processar') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="plano_id" value="<?= $plano->id ?>">

                        <!-- Dados Pessoais -->
                        <h6 class="text-muted mb-3">Dados Pessoais</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="nome" 
                                       value="<?= $cliente->nome ?? '' ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" 
                                       value="<?= $cliente->email ?? '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CPF</label>
                                <input type="text" class="form-control cpf-mask" name="cpf" 
                                       value="<?= $cliente->cpf ?? '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control telefone-mask" name="telefone" 
                                       value="<?= $cliente->telefone ?? '' ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CEP</label>
                                <input type="text" class="form-control cep-mask" name="cep" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Número</label>
                                <input type="text" class="form-control" name="numero" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Dados do Cartão -->
                        <h6 class="text-muted mb-3"><i class="bx bx-lock-alt me-1"></i>Dados do Cartão</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nome no Cartão</label>
                                <input type="text" class="form-control" name="holder_name" 
                                       placeholder="Como está impresso no cartão" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Número do Cartão</label>
                                <input type="text" class="form-control card-mask" name="card_number" 
                                       placeholder="0000 0000 0000 0000" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CVV</label>
                                <input type="text" class="form-control" name="ccv" 
                                       placeholder="123" maxlength="4" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mês de Validade</label>
                                <select class="form-select" name="expiry_month" required>
                                    <option value="">Selecione</option>
                                    <?php for($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>">
                                        <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ano de Validade</label>
                                <select class="form-select" name="expiry_year" required>
                                    <option value="">Selecione</option>
                                    <?php for($i = date('Y'); $i <= date('Y') + 15; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="bx bx-info-circle me-2"></i>
                            Sua assinatura será renovada automaticamente. Você pode cancelar a qualquer momento.
                        </div>

                        <div id="resposta-assinatura"></div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" id="btn-assinar" class="btn btn-primary btn-lg"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                <i class="bx bx-lock-alt me-2"></i>Confirmar Assinatura - <?= $plano->getPrecoFormatado() ?>
                            </button>
                        </div>

                        <p class="text-center text-muted mt-3">
                            <i class="bx bx-shield-quarter me-1"></i>
                            Pagamento seguro processado por Asaas
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    // Máscaras
    $('.cpf-mask').mask('000.000.000-00');
    $('.telefone-mask').mask('(00) 00000-0000');
    $('.cep-mask').mask('00000-000');
    $('.card-mask').mask('0000 0000 0000 0000');

    // Submit do formulário
    $('#form-assinatura').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var btn = $('#btn-assinar');
        var resposta = $('#resposta-assinatura');

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Processando...');
        resposta.html('');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                // Atualiza token CSRF
                if (response.token) {
                    $('input[name="<?= csrf_token() ?>"]').val(response.token);
                }

                if (response.erro) {
                    resposta.html('<div class="alert alert-danger">' + response.erro + '</div>');
                    btn.prop('disabled', false).html('<i class="bx bx-lock-alt me-2"></i>Confirmar Assinatura - <?= $plano->getPrecoFormatado() ?>');
                } else if (response.sucesso) {
                    resposta.html('<div class="alert alert-success">' + response.sucesso + '</div>');
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1500);
                    }
                }
            },
            error: function() {
                resposta.html('<div class="alert alert-danger">Erro ao processar. Tente novamente.</div>');
                btn.prop('disabled', false).html('<i class="bx bx-lock-alt me-2"></i>Confirmar Assinatura - <?= $plano->getPrecoFormatado() ?>');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
