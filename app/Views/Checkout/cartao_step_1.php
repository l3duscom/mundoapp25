<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<style>
    .checkout-container {
        max-width: 540px;
        margin: 0 auto;
    }

    .checkout-section {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
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
        padding: 14px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.2s;
        outline: none;
        background: #fff;
    }

    .checkout-input:focus {
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

    .total-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        background: #f9fafb;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .total-bar-label {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
    }

    .total-bar-value {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
    }

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

    .checkout-footer-text {
        max-width: 540px;
        margin: 0 auto;
        font-size: 11px;
        color: #9ca3af;
        line-height: 1.6;
    }

    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 12px;
        color: #059669;
        margin-top: 16px;
    }

    .secure-badge i {
        font-size: 16px;
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<div class="checkout-container mt-3">

    <div class="checkout-section">
        <div class="checkout-section-title"><i class="bx bx-credit-card"></i> Pagamento com cartao</div>

        <div class="total-bar">
            <span class="total-bar-label">Total a pagar</span>
            <span class="total-bar-value">R$ <?= number_format($_SESSION['total'] + $_SESSION['valor_frete'], 2, ',', '.') ?></span>
        </div>

        <form method="POST" action="<?= site_url('checkout/cartao_step_2/' . $event_id) ?>">
            <?= csrf_field() ?>

            <input type="hidden" name="valor_total" id="valor_total" value="<?= $_SESSION['total'] * 100 ?>" required>
            <input type="hidden" name="convite" value="<?= $_SESSION['convite'] ?>">
            <input type="hidden" name="forma_pagamento" value="cartao">

            <div class="mb-3">
                <label class="checkout-label">Informe seu e-mail para continuar</label>
                <input type="email" name="email" placeholder="seu@email.com" class="checkout-input" required>
            </div>

            <button id="btn-salvar" type="submit" class="btn-checkout">
                <i class="bx bx-right-arrow-alt"></i> Continuar
            </button>
        </form>

        <div class="secure-badge">
            <i class="bx bx-lock-alt"></i> Ambiente seguro e criptografado
        </div>
    </div>

    <div class="text-center mt-3 mb-2">
        <span style="font-size: 11px; color: #9ca3af;">Pagamento processado com seguranca por</span><br>
        <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="80" height="auto" style="opacity: 0.6;">
    </div>

    <div class="checkout-footer-text mt-3 mb-4">
        <p class="mb-1"><strong>Precisa de ajuda?</strong> <a href="#" target="_blank">Entre em contato</a></p>
        <p class="mb-1">* O valor parcelado possui acrescimo.</p>
        <p class="mb-1"><strong>Meia entrada solidaria</strong> (40% de desconto) disponivel para qualquer pessoa que levar 1kg de alimento no dia do evento.</p>
        <p class="mb-1">Ao clicar em "Continuar", eu concordo com os termos de uso e regras do evento e estou ciente da Politica de Privacidade.</p>
    </div>

</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<?php echo $this->endSection() ?>