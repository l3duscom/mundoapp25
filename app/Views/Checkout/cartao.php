<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />

<style>
    .checkout-container {
        max-width: 540px;
        margin: 0 auto;
    }

    .checkout-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 24px;
    }

    .checkout-section {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .checkout-section-title {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .checkout-section-title i {
        color: #7c3aed;
        font-size: 16px;
    }

    .checkout-input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.2s;
        outline: none;
        background: #fff;
    }

    .checkout-input:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .checkout-select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.2s;
        outline: none;
        background: #fff;
        appearance: auto;
    }

    .checkout-select:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .checkout-label {
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }

    .checkout-field {
        margin-bottom: 14px;
    }

    .checkout-field:last-child {
        margin-bottom: 0;
    }

    .checkout-row {
        display: flex;
        gap: 12px;
    }

    .checkout-row .checkout-field {
        flex: 1;
    }

    /* Tabela de itens */
    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-name {
        font-size: 13px;
        color: #374151;
        flex: 1;
    }

    .item-qty {
        font-size: 13px;
        color: #6b7280;
        min-width: 30px;
        text-align: center;
    }

    .item-price {
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        min-width: 80px;
        text-align: right;
    }

    /* Cupom */
    .coupon-row {
        display: flex;
        gap: 8px;
    }

    .coupon-row .checkout-input {
        flex: 1;
        text-transform: uppercase;
    }

    .btn-coupon {
        padding: 12px 20px;
        background: #7c3aed;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-coupon:hover {
        background: #6d28d9;
    }

    /* Order bump */
    .bump-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 8px;
    }

    .bump-item:hover {
        border-color: #a7f3d0;
    }

    .bump-item.checked {
        border-color: #34d399;
        background: #ecfdf5;
    }

    .bump-item .bump-check {
        width: 20px;
        height: 20px;
        accent-color: #059669;
        cursor: pointer;
    }

    .bump-img {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
        background: #f3f4f6;
    }

    .bump-info {
        flex: 1;
    }

    .bump-name {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
    }

    .bump-desc {
        font-size: 12px;
        color: #6b7280;
    }

    .bump-price {
        font-size: 14px;
        font-weight: 700;
        color: #059669;
        white-space: nowrap;
    }

    /* Resumo */
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        font-size: 14px;
    }

    .summary-row .label {
        color: #6b7280;
    }

    .summary-row .value {
        font-weight: 600;
        color: #111827;
    }

    .summary-row.discount .label,
    .summary-row.discount .value {
        color: #059669;
    }

    .summary-row.total {
        padding-top: 12px;
        margin-top: 8px;
        border-top: 1px solid #e5e7eb;
    }

    .summary-row.total .label {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
    }

    .summary-row.total .value {
        font-size: 20px;
        font-weight: 700;
        color: #7c3aed;
    }

    /* Botao finalizar */
    .btn-checkout {
        width: 100%;
        padding: 16px;
        background: #7c3aed;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-checkout:hover {
        background: #6d28d9;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .checkout-hint {
        font-size: 11px;
        color: #9ca3af;
    }

    .checkout-footer-text {
        max-width: 540px;
        margin: 0 auto;
        font-size: 11px;
        color: #9ca3af;
        line-height: 1.6;
    }

    .info-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #eff6ff;
        color: #3b82f6;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 6px;
    }

    @media (max-width: 480px) {
        .checkout-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<?php
$juros = 0.034;

// Usa o total passado pelo controlador (calculado a partir do carrinho)
$subtotalIngressos = $total ?? 0;

// Separa o frete do total dos ingressos
$valorFrete = isset($_SESSION['valor_frete']) ? floatval($_SESSION['valor_frete']) : 0;

// Total = ingressos + frete (frete nao tem desconto do cupom)
$totalFinal = $subtotalIngressos + $valorFrete;

$event_id = session()->get('event_id');
?>

<div class="checkout-container mt-3">

    <!-- Exibira os retornos do backend -->
    <div id="response">
        <?php if (session()->getFlashdata('erro')): ?>
            <div class="alert alert-danger" style="border-radius: 10px;">
                <?= session()->getFlashdata('erro') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-success" style="border-radius: 10px;">
                <?= session()->getFlashdata('sucesso') ?>
            </div>
        <?php endif; ?>
    </div>

    <form method="POST" action="<?= site_url('Checkout/finalizarcartao/' . $event_id) ?>" id="form">
        <?= csrf_field() ?>

        <input type="hidden" name="valor_total" id="valor_total" value="<?= $totalFinal ?>" required>
        <input type="hidden" name="frete" id="frete" value="<?= $_SESSION['frete'] ?>" required>
        <input type="hidden" name="convite" value="<?= $_SESSION['convite'] ?>">
        <input type="hidden" name="event_id" value="<?= $event_id ?>">

        <!-- Dados pessoais -->
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-user"></i> Seus dados</div>
            <div class="checkout-field">
                <label class="checkout-label">Nome completo</label>
                <input type="text" name="nome" placeholder="Digite seu nome completo" class="checkout-input" value="<?php if ($data_cli) echo esc($data_cli['nome']); ?>" required>
            </div>
            <div class="checkout-row">
                <div class="checkout-field">
                    <label class="checkout-label">E-mail</label>
                    <?php if (isset($data_cli['email']) && !empty($data_cli['email'])) : ?>
                        <input type="email" class="checkout-input" value="<?= esc($data_cli['email']) ?>" readonly>
                        <input type="hidden" name="email" value="<?= esc($data_cli['email']) ?>">
                    <?php else : ?>
                        <input type="email" name="email" placeholder="seu@email.com" class="checkout-input" required>
                    <?php endif ?>
                </div>
                <div class="checkout-field">
                    <label class="checkout-label">Celular</label>
                    <?php if (isset($data_cli['telefone']) && !empty($data_cli['telefone'])) : ?>
                        <input type="hidden" name="telefone" value="<?= esc($data_cli['telefone']) ?>">
                        <div class="info-badge mt-1"><i class="bx bx-check-circle"></i> Telefone cadastrado</div>
                    <?php else : ?>
                        <input type="text" name="telefone" placeholder="(00) 00000-0000" class="checkout-input sp_celphones">
                    <?php endif ?>
                </div>
            </div>
            <div class="checkout-field">
                <label class="checkout-label">CPF</label>
                <?php if (isset($data_cli['cpf']) && !empty($data_cli['cpf'])) : ?>
                    <input type="hidden" name="cpf" value="<?= esc($data_cli['cpf']) ?>">
                    <div class="info-badge"><i class="bx bx-check-circle"></i> CPF cadastrado</div>
                <?php else : ?>
                    <input type="text" name="cpf" placeholder="000.000.000-00" class="checkout-input cpf" required>
                <?php endif ?>
            </div>
        </div>

        <!-- Dados do cartao -->
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-credit-card"></i> Dados do cartao</div>
            <?php if (empty($data_cli['credit_card_token'])) : ?>
                <div class="checkout-field">
                    <label class="checkout-label">Numero do cartao</label>
                    <input type="text" name="numero_cartao" id="numero_cartao" placeholder="0000 0000 0000 0000" class="checkout-input" required>
                </div>
                <div class="checkout-field">
                    <label class="checkout-label">Nome impresso no cartao</label>
                    <input type="text" name="holderName" id="holderName" placeholder="Como esta no cartao" class="checkout-input" required>
                </div>
                <div class="checkout-row">
                    <div class="checkout-field">
                        <label class="checkout-label">Parcelas</label>
                        <select name="installmentCount" id="installmentCount" class="checkout-select" required>
                            <option></option>
                            <option value="1">1x de R$ <?= number_format($totalFinal / 1, 2, ',', '.') ?></option>
                            <option value="2">2x de R$ <?= number_format(($totalFinal + ($totalFinal * $juros * 2)) / 2, 2, ',', '.') ?></option>
                            <option value="3">3x de R$ <?= number_format(($totalFinal + ($totalFinal * $juros * 3)) / 3, 2, ',', '.') ?></option>
                            <option value="4">4x de R$ <?= number_format(($totalFinal + ($totalFinal * $juros * 4)) / 4, 2, ',', '.') ?></option>
                            <option value="5">5x de R$ <?= number_format(($totalFinal + ($totalFinal * $juros * 5)) / 5, 2, ',', '.') ?></option>
                        </select>
                    </div>
                    <div class="checkout-field">
                        <label class="checkout-label">CVV</label>
                        <input type="text" name="codigo_seguranca" id="codigo_seguranca" placeholder="000" class="checkout-input" required>
                    </div>
                </div>
                <div class="checkout-row">
                    <div class="checkout-field">
                        <label class="checkout-label">Mes de vencimento</label>
                        <select name="mes_vencimento" id="mes_vencimento" class="checkout-select" required>
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                    <div class="checkout-field">
                        <label class="checkout-label">Ano de vencimento</label>
                        <select name="ano_vencimento" id="ano_vencimento" class="checkout-select" required>
                            <option></option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                            <option>2028</option>
                            <option>2029</option>
                            <option>2030</option>
                            <option>2031</option>
                            <option>2032</option>
                            <option>2033</option>
                            <option>2034</option>
                            <option>2035</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="payment_token" id="payment_token">
                <input type="hidden" name="mascara_cartao" id="mascara_cartao">
            <?php else : ?>
                <div class="info-badge"><i class="bx bx-check-circle"></i> Compra com cartao cadastrado</div>
            <?php endif ?>
        </div>

        <!-- Endereco de cobranca -->
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-map"></i> Endereco de cobranca</div>
            <div class="checkout-row">
                <div class="checkout-field" style="flex: 0 0 140px;">
                    <label class="checkout-label">CEP</label>
                    <input type="text" name="cep" placeholder="00000-000" class="checkout-input cep" required>
                    <div id="cep"></div>
                </div>
                <div class="checkout-field">
                    <label class="checkout-label">Endereco</label>
                    <input type="text" name="endereco" id="endereco" class="checkout-input" required readonly>
                </div>
            </div>
            <div class="checkout-row">
                <div class="checkout-field" style="flex: 0 0 100px;">
                    <label class="checkout-label">Numero</label>
                    <input type="text" name="numero" id="numero" class="checkout-input" required>
                </div>
                <div class="checkout-field">
                    <label class="checkout-label">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="checkout-input" required readonly>
                </div>
            </div>
            <div class="checkout-row">
                <div class="checkout-field">
                    <label class="checkout-label">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="checkout-input" required readonly>
                </div>
                <div class="checkout-field" style="flex: 0 0 80px;">
                    <label class="checkout-label">Estado</label>
                    <input type="text" name="estado" id="estado" class="checkout-input" required readonly>
                </div>
            </div>
        </div>

        <!-- Detalhes da compra -->
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-receipt"></i> Detalhes da compra</div>
            <?php if (isset($_SESSION['carrinho'])) : ?>
                <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                    <?php if ($value['quantidade'] != 0) : ?>
                        <div class="item-row">
                            <span class="item-name"><?= $value['nome']; ?></span>
                            <span class="item-qty"><?= $value['quantidade']; ?>x</span>
                            <span class="item-price">R$ <?= number_format($value['quantidade'] * ($value['unitario'] + $value['taxa']), 2, ',', ''); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center" style="color: #9ca3af;"><i class="bx bx-error-circle"></i> Carrinho vazio</p>
            <?php endif; ?>
        </div>

        <!-- Cupom de desconto -->
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-purchase-tag-alt"></i> Cupom de desconto</div>
            <div class="coupon-row">
                <input type="text" id="codigo-cupom" name="codigo_cupom" class="checkout-input" placeholder="DIGITE SEU CUPOM" style="text-transform: uppercase;">
                <button type="button" id="btn-validar-cupom" class="btn-coupon">Aplicar</button>
            </div>
            <div id="cupom-resultado" class="mt-2"></div>
            <input type="hidden" name="cupom_id" id="cupom_id" value="">
            <input type="hidden" name="cupom_desconto" id="cupom_desconto" value="0">
        </div>

        <!-- Order Bumps -->
        <?php if (isset($orderBumps) && !empty($orderBumps)): ?>
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-gift"></i> Aproveite e compre junto</div>
            <?php foreach ($orderBumps as $bump): ?>
            <div class="order-bump-item bump-item" data-bump-id="<?= $bump->id ?>" data-bump-preco="<?= $bump->preco ?>">
                <input type="checkbox" class="bump-check order-bump-checkbox" name="order_bumps[]" value="<?= $bump->id ?>" id="bump_<?= $bump->id ?>" data-preco="<?= $bump->preco ?>">
                <?php if (!empty($bump->imagem)): ?>
                <img src="<?= $bump->getImagemUrl() ?>" alt="<?= esc($bump->nome) ?>" class="bump-img">
                <?php else: ?>
                <div class="bump-img d-flex align-items-center justify-content-center" style="background: #ecfdf5;">
                    <i class="bx bx-package" style="font-size: 20px; color: #059669;"></i>
                </div>
                <?php endif; ?>
                <div class="bump-info">
                    <div class="bump-name"><?= esc($bump->nome) ?></div>
                    <?php if (!empty($bump->descricao)): ?>
                    <div class="bump-desc"><?= esc($bump->descricao) ?></div>
                    <?php endif; ?>
                </div>
                <div class="bump-price">R$ <?= number_format($bump->preco, 2, ',', '.') ?></div>
                <div class="order-bump-added small" style="display: none; background: #059669; color: #fff; padding: 6px 12px; margin: 10px -12px -12px -12px; border-radius: 0 0 9px 9px; text-align: center; width: calc(100% + 24px);">
                    <i class="bx bx-check-circle me-1"></i>adicionado
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Resumo do pedido -->
        <div class="checkout-section">
            <div class="checkout-section-title"><i class="bx bx-calculator"></i> Resumo do pedido</div>

            <div class="summary-row">
                <span class="label">Subtotal (ingressos)</span>
                <span class="value resumo-subtotal">R$ <?= number_format($subtotalIngressos, 2, ',', '.') ?></span>
            </div>

            <?php if ($valorFrete > 0): ?>
            <div class="summary-row">
                <span class="label">Entrega</span>
                <span class="value resumo-frete">R$ <?= number_format($valorFrete, 2, ',', '.') ?></span>
            </div>
            <?php endif; ?>

            <div id="linha-desconto-cupom" class="summary-row discount" style="display: none;">
                <span class="label"><i class="bx bx-purchase-tag me-1"></i>Desconto Cupom</span>
                <span class="value resumo-desconto-cupom">- R$ 0,00</span>
            </div>

            <div id="linha-order-bumps" class="summary-row" style="display: none;">
                <span class="label" style="color: #7c3aed;"><i class="bx bx-gift me-1"></i>Adicionais</span>
                <span class="value resumo-order-bumps" style="color: #7c3aed;">+ R$ 0,00</span>
            </div>

            <div class="summary-row total">
                <span class="label">Total a pagar</span>
                <span class="value resumo-total-final">R$ <?= number_format($totalFinal, 2, ',', '.') ?></span>
            </div>
        </div>

        <button id="btn-salvar" type="submit" class="btn-checkout">
            <i class="bx bx-lock-alt"></i> Finalizar Compra
        </button>

    </form>

    <div class="text-center mt-3 mb-2">
        <span style="font-size: 11px; color: #9ca3af;">Pagamento processado com seguranca por</span><br>
        <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="80" height="auto" style="opacity: 0.6;">
    </div>

    <div class="checkout-footer-text mt-3 mb-4">
        <p class="mb-1"><strong>Precisa de ajuda?</strong> <a href="#" target="_blank">Entre em contato</a></p>
        <p class="mb-1">* O valor parcelado possui acrescimo.</p>
        <p class="mb-1"><strong>Meia entrada solidaria</strong> (40% de desconto) disponivel para qualquer pessoa que levar 1kg de alimento no dia do evento.</p>
        <p class="mb-1">Ao clicar em "Finalizar Compra", eu concordo com os termos de uso e regras do evento Dreamfest 25 e estou ciente da Politica de Privacidade.</p>
    </div>

</div>




<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<!-- Modal de Processamento -->
<div class="modal fade" id="modalProcessando" tabindex="-1" aria-labelledby="modalProcessandoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="text-align:center;">
      <div class="modal-body py-5">
        <div class="spinner-border text-primary mb-3" style="width: 4rem; height: 4rem;" role="status"></div>
        <h5 class="mb-3 mt-2">Processando pagamento...</h5>
        <p class="text-muted">Nao feche ou atualize esta pagina.<br>Sua compra esta sendo finalizada.</p>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form');
        const btn = document.getElementById('btn-salvar');
        if (form && btn) {
            form.addEventListener('submit', function(e) {
                btn.disabled = true;
                btn.value = "Processando...";
                btn.classList.add('disabled');
                var modal = new bootstrap.Modal(document.getElementById('modalProcessando'));
                modal.show();
            });
        }
    });
</script>

<!-- Meta Pixel Events -->
<?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
<script>
// ViewContent Event
fbq('track', 'ViewContent', {
    content_name: '<?= $evento->nome ?> - Cartao',
    content_category: '<?= $evento->categoria ?? 'Evento' ?>',
    content_type: 'product',
    content_ids: [<?= $evento->id ?>]
});

// InitiateCheckout Event
function trackInitiateCheckoutCartao() {
    let totalValue = <?= $totalFinal ?? 0 ?>;
    let cartItems = [];
    let totalItems = 0;

    <?php if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])): ?>
        <?php foreach ($_SESSION['carrinho'] as $key => $value): ?>
            <?php if ($value['quantidade'] > 0): ?>
                cartItems.push(<?= $key ?>);
                totalItems += <?= $value['quantidade'] ?>;
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    fbq('track', 'InitiateCheckout', {
        content_name: '<?= $evento->nome ?> - Cartao',
        content_category: '<?= $evento->categoria ?? 'Evento' ?>',
        content_type: 'product',
        value: totalValue,
        currency: 'BRL',
        content_ids: cartItems,
        num_items: totalItems
    });
}
</script>
<?php endif; ?>

<script>
    $(document).ready(function() {

        // Track InitiateCheckout when user submits card payment
        $("#form").on('submit', function(e) {
            <?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
            trackInitiateCheckoutCartao();
            <?php endif; ?>
        });

        // ========================================
        // CONSULTA CEP
        // ========================================
        $('[name=cep]').on('keyup', function() {
            var cep = $(this).val();
            if (cep.length === 9) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('checkout/consultacep'); ?>',
                    data: { cep: cep },
                    dataType: 'json',
                    beforeSend: function() {
                        $("#cep").html('');
                    },
                    success: function(response) {
                        if (!response.erro) {
                            if (!response.endereco) {
                                $('[name=endereco]').prop('readonly', false).focus();
                            }
                            if (!response.bairro) {
                                $('[name=bairro]').prop('readonly', false);
                            }
                            $('[name=endereco]').val(response.endereco);
                            $('[name=bairro]').val(response.bairro);
                            $('[name=cidade]').val(response.cidade);
                            $('[name=estado]').val(response.estado);
                        }
                        if (response.erro) {
                            $("#cep").html(response.erro);
                        }
                    },
                    error: function() {
                        alert('Nao foi possivel processar a solicitacao. Por favor entre em contato com o suporte.');
                    }
                });
            }
        });

        // ========================================
        // VALIDACAO DE CUPOM DE DESCONTO
        // ========================================

        var subtotalIngressos = <?= $subtotalIngressos ?? 0 ?>;
        var valorFrete = <?= $valorFrete ?? 0 ?>;
        var juros = <?= $juros ?? 0.034 ?>;
        var cupomAplicado = false;
        var valorDescontoCupom = 0;
        var valorOrderBumps = 0;

        function calcularOrderBumps() {
            var total = 0;
            $('.order-bump-checkbox:checked').each(function() {
                total += parseFloat($(this).data('preco')) || 0;
            });
            return total;
        }

        function atualizarValores() {
            valorOrderBumps = calcularOrderBumps();

            var ingressosComDesconto = subtotalIngressos - valorDescontoCupom;
            var novoTotalFinal = ingressosComDesconto + valorFrete + valorOrderBumps;

            function formatarReal(valor) {
                return valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            if (valorDescontoCupom > 0) {
                $('#linha-desconto-cupom').css('display', 'flex');
                $('.resumo-desconto-cupom').text('- R$ ' + formatarReal(valorDescontoCupom));
            } else {
                $('#linha-desconto-cupom').css('display', 'none');
            }

            if (valorOrderBumps > 0) {
                $('#linha-order-bumps').show().css('display', 'flex');
                $('.resumo-order-bumps').text('+ R$ ' + formatarReal(valorOrderBumps));
            } else {
                $('#linha-order-bumps').hide();
                $('.resumo-order-bumps').text('+ R$ 0,00');
            }

            $('.resumo-subtotal').text('R$ ' + formatarReal(subtotalIngressos));
            $('.resumo-total-final').text('R$ ' + formatarReal(novoTotalFinal));

            $('#valor_total').val(novoTotalFinal);

            // Atualiza as parcelas
            $('#installmentCount').html(
                '<option></option>' +
                '<option value="1">1x de R$ ' + formatarReal(novoTotalFinal) + '</option>' +
                '<option value="2">2x de R$ ' + formatarReal((novoTotalFinal + (novoTotalFinal * juros * 2)) / 2) + '</option>' +
                '<option value="3">3x de R$ ' + formatarReal((novoTotalFinal + (novoTotalFinal * juros * 3)) / 3) + '</option>' +
                '<option value="4">4x de R$ ' + formatarReal((novoTotalFinal + (novoTotalFinal * juros * 4)) / 4) + '</option>' +
                '<option value="5">5x de R$ ' + formatarReal((novoTotalFinal + (novoTotalFinal * juros * 5)) / 5) + '</option>'
            );
        }

        // ========================================
        // ORDER BUMPS
        // ========================================

        $('.order-bump-checkbox').on('change', function() {
            var card = $(this).closest('.order-bump-item');
            var addedMsg = card.find('.order-bump-added');

            if ($(this).is(':checked')) {
                card.addClass('checked');
                addedMsg.show();
            } else {
                card.removeClass('checked');
                addedMsg.hide();
            }
            atualizarValores();
        });

        $('.order-bump-item').on('click', function(e) {
            if ($(e.target).is('input[type="checkbox"]')) return;
            var checkbox = $(this).find('.order-bump-checkbox');
            checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
        });

        // Evento de clique no botao Aplicar
        $('#btn-validar-cupom').on('click', function() {
            var codigo = $('#codigo-cupom').val().trim().toUpperCase();
            var btn = $(this);

            if (!codigo) {
                $('#cupom-resultado').html(
                    '<div class="alert alert-warning mb-0 py-2"><small><i class="bx bx-error-circle me-1"></i>Digite um codigo de cupom</small></div>'
                );
                return;
            }

            btn.prop('disabled', true).text('...');

            var csrfName = '<?= csrf_token() ?>';
            var csrfToken = $('input[name="' + csrfName + '"]').val();

            $.ajax({
                url: '<?php echo site_url('carrinho/validar'); ?>',
                type: 'POST',
                data: {
                    codigo: codigo,
                    evento_id: '<?= $event_id ?? '' ?>',
                    valor_pedido: subtotalIngressos,
                    [csrfName]: csrfToken
                },
                dataType: 'json',
                success: function(response) {
                    if (response.token) {
                        $('input[name="<?= csrf_token() ?>"]').val(response.token);
                    }

                    if (response.erro) {
                        $('#cupom-resultado').html(
                            '<div class="alert alert-danger mb-0 py-2"><small><i class="bx bx-x-circle me-1"></i>' + response.erro + '</small></div>'
                        );
                        cupomAplicado = false;
                        valorDescontoCupom = 0;
                        $('#cupom_id').val('');
                        $('#cupom_desconto').val('0');
                    } else {
                        cupomAplicado = true;
                        valorDescontoCupom = response.cupom.valor_desconto;

                        $('#cupom-resultado').html(
                            '<div class="alert alert-success mb-0 py-2">' +
                                '<small><i class="bx bx-check-circle me-1"></i>' +
                                    'Cupom <strong>' + response.cupom.codigo + '</strong> aplicado! ' +
                                    'Desconto: <strong>' + response.cupom.valor_desconto_formatado + '</strong>' +
                                '</small>' +
                            '</div>'
                        );

                        $('#cupom_id').val(response.cupom.id);
                        $('#cupom_desconto').val(response.cupom.valor_desconto);
                        $('#codigo-cupom').prop('disabled', true);

                        atualizarValores();
                    }
                },
                error: function() {
                    $('#cupom-resultado').html(
                        '<div class="alert alert-danger mb-0 py-2"><small><i class="bx bx-error me-1"></i>Erro ao validar. Tente novamente.</small></div>'
                    );
                },
                complete: function() {
                    btn.prop('disabled', cupomAplicado).text('Aplicar');
                }
            });
        });

        $('#codigo-cupom').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#btn-validar-cupom').click();
            }
        });

    });
</script>

<?php echo $this->endSection() ?>