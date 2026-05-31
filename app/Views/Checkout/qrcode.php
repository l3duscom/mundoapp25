<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />

<style>
    .checkout-container {
        max-width: 540px;
        margin: 0 auto;
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
        color: #059669;
        font-size: 16px;
    }

    /* Status bar */
    .status-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        margin-bottom: 16px;
    }

    .status-bar i {
        font-size: 20px;
        color: #059669;
    }

    .status-bar .status-text {
        flex: 1;
    }

    .status-bar .status-text strong {
        font-size: 14px;
        color: #065f46;
        display: block;
    }

    .status-bar .status-text span {
        font-size: 12px;
        color: #047857;
    }

    .status-bar .status-value {
        font-size: 20px;
        font-weight: 700;
        color: #059669;
    }

    /* QR Code area */
    .qr-wrapper {
        text-align: center;
        padding: 20px 0;
    }

    .qr-wrapper img {
        max-width: 220px;
        width: 100%;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        padding: 8px;
        background: #fff;
    }

    .qr-instructions {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.5;
        margin-top: 16px;
    }

    .qr-instructions ol {
        padding-left: 20px;
        margin: 0;
    }

    .qr-instructions li {
        margin-bottom: 6px;
    }

    /* Copy button */
    .btn-copy {
        width: 100%;
        padding: 14px;
        background: #059669;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-copy:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    .btn-copy.copied {
        background: #065f46;
    }

    .pix-code-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 11px;
        color: #6b7280;
        word-break: break-all;
        max-height: 60px;
        overflow: hidden;
        margin-top: 12px;
    }

    /* Polling bar */
    .polling-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        padding: 12px 16px;
        z-index: 1000;
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
    }

    .polling-bar-inner {
        max-width: 540px;
        margin: 0 auto;
    }

    .polling-info {
        text-align: center;
        margin-bottom: 8px;
    }

    .polling-info span {
        font-size: 13px;
        color: #6b7280;
    }

    .polling-info strong {
        font-size: 16px;
        color: #059669;
    }

    .btn-verify {
        width: 100%;
        padding: 14px;
        background: #059669;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-verify:hover {
        background: #047857;
    }

    .pix-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #ecfdf5;
        color: #059669;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .checkout-footer-text {
        max-width: 540px;
        margin: 0 auto;
        font-size: 11px;
        color: #9ca3af;
        line-height: 1.6;
    }

    /* Espaço para a polling bar fixa */
    .bottom-spacer {
        height: 120px;
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<?php
if ($status == 'RECEIVED') {
    $url = site_url('checkout/obrigado/');
    header('Location: ' . $url);
    exit;
}
?>

<div class="checkout-container mt-3">

    <!-- Retornos do backend -->
    <div id="response"></div>

    <!-- Status do pagamento -->
    <div class="status-bar">
        <i class="fa-brands fa-pix"></i>
        <div class="status-text">
            <strong>Pagamento via PIX</strong>
            <span>Desconto de 10% aplicado</span>
        </div>
        <div class="status-value">R$ <?= number_format($transaction->installment_value / 100, 2, ',', ''); ?></div>
    </div>

    <!-- QR Code -->
    <div class="checkout-section">
        <div class="checkout-section-title"><i class="bx bx-qr-scan"></i> Escaneie o QR Code</div>

        <div class="qr-wrapper">
            <img src="data:image/png+xml;base64,<?= $transaction->qrcode_image; ?>" alt="QR Code PIX">
        </div>

        <button id="execCopy" type="button" class="btn-copy">
            <i class="bx bx-copy"></i> Copiar codigo PIX
        </button>

        <div class="pix-code-box">
            <input id="input" type="text" value="<?= trim($transaction->qrcode); ?>" style="border: none; background: transparent; width: 100%; font-size: 11px; color: #6b7280; outline: none;" readonly>
        </div>
    </div>

    <!-- Instrucoes -->
    <div class="checkout-section">
        <div class="checkout-section-title"><i class="bx bx-info-circle"></i> Como pagar</div>
        <div class="qr-instructions">
            <ol>
                <li>Abra o app do seu banco ou carteira digital</li>
                <li>Escolha pagar via <strong>PIX</strong></li>
                <li>Escaneie o QR Code ou copie e cole o codigo</li>
                <li>Confirme o pagamento</li>
            </ol>
            <p class="mt-2 mb-0" style="font-size: 12px; color: #9ca3af;">O pagamento e confirmado automaticamente em segundos.</p>
        </div>
    </div>

    <div class="text-center mt-3 mb-2">
        <span style="font-size: 11px; color: #9ca3af;">Pagamento processado com seguranca por</span><br>
        <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="80" height="auto" style="opacity: 0.6;">
    </div>

    <div class="checkout-footer-text mt-3 mb-4">
        <p class="mb-1"><strong>Precisa de ajuda?</strong> <a href="#" target="_blank">Entre em contato</a></p>
        <p class="mb-1"><strong>Meia entrada solidaria</strong> (40% de desconto) disponivel para qualquer pessoa que levar 1kg de alimento no dia do evento.</p>
    </div>

    <div class="bottom-spacer"></div>
</div>

<!-- Barra fixa de verificacao -->
<div class="polling-bar">
    <div class="polling-bar-inner">
        <div class="polling-info">
            <span>Verificando pagamento automaticamente...</span><br>
            <span style="font-size: 12px;">Proxima verificacao em: </span>
            <strong id="timer"></strong>
        </div>
        <button id="btn-salvar" type="button" class="btn-verify">Verificar pagamento agora</button>
    </div>
</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<!-- Meta Pixel Purchase Event: disparado no callback do polling quando is_paid=true -->
<?php /* fbq movido para o callback JS abaixo para não disparar múltiplas vezes em reloads */ ?>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<script>
    $(document).ready(function() {
        // Copiar codigo PIX
        document.getElementById('execCopy').addEventListener('click', function() {
            var input = document.getElementById('input');
            input.select();
            document.execCommand('copy');

            var btn = this;
            btn.innerHTML = '<i class="bx bx-check"></i> Codigo copiado!';
            btn.classList.add('copied');

            setTimeout(function() {
                btn.innerHTML = '<i class="bx bx-copy"></i> Copiar codigo PIX';
                btn.classList.remove('copied');
            }, 3000);
        });

        // Variaveis para controle do polling
        let pollingInterval;
        let countdownInterval;
        let nextCheckSeconds = 5;
        let isPaymentReceived = false;
        let totalChecks = 0;
        let maxChecks = 60;

        function updateTimer() {
            $('#timer').text(nextCheckSeconds + 's');
            nextCheckSeconds--;

            if (nextCheckSeconds < 0) {
                nextCheckSeconds = 4;
            }
        }

        function checkTransactionStatus() {
            if (isPaymentReceived) return;

            totalChecks++;

            if (totalChecks > maxChecks) {
                clearInterval(pollingInterval);
                clearInterval(countdownInterval);
                $('#timer').text('--');
                return;
            }

            nextCheckSeconds = 5;

            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('checkout/check-status/' . $charge_id); ?>',
                dataType: 'json',
                success: function(response) {
                    if (response.is_paid) {
                        isPaymentReceived = true;
                        clearInterval(pollingInterval);
                        clearInterval(countdownInterval);

                        // Meta Pixel Purchase — dispara uma única vez quando PIX confirmado
                        <?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
                        if (typeof fbq !== 'undefined') {
                            fbq('track', 'Purchase', {
                                content_name: '<?= esc($evento->nome, 'js') ?> - PIX',
                                content_category: '<?= esc($evento->categoria ?? 'Evento', 'js') ?>',
                                content_type: 'product',
                                value: <?= ($transaction->installment_value ?? 0) / 100 ?>,
                                currency: 'BRL',
                                content_ids: [<?= $evento->id ?>],
                                order_id: '<?= esc($charge_id ?? '', 'js') ?>'
                            }, {eventID: '<?= esc($meta_event_id ?? '', 'js') ?>'});
                        }
                        <?php endif; ?>

                        $("#response").html('<div class="alert alert-success" style="border-radius: 10px;"><i class="bx bx-check-circle me-1"></i> Pagamento confirmado! Redirecionando...</div>');
                        $("#btn-salvar").text('Pagamento Confirmado!').prop('disabled', true).css('background', '#065f46');
                        $('#timer').text('✓').css('color', '#059669');

                        setTimeout(function() {
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                        }, 2000);
                    }
                },
                error: function() {
                    if (totalChecks === 1) {
                        $("#response").html('<div class="alert alert-warning" style="border-radius: 10px;">Verificando conexao... Tentando novamente.</div>');
                    }
                }
            });
        }

        $("#response").html('<div class="alert alert-info" style="border-radius: 10px;"><i class="bx bx-time me-1"></i> Aguardando confirmacao do pagamento PIX...</div>');

        updateTimer();
        countdownInterval = setInterval(updateTimer, 1000);
        pollingInterval = setInterval(checkTransactionStatus, 5000);
        setTimeout(checkTransactionStatus, 2000);

        // Botao de verificar pagamento manual
        $("#btn-salvar").on('click', function() {
            if (!isPaymentReceived) {
                $(this).prop('disabled', true).text('Verificando...');

                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('checkout/check-status/' . $charge_id); ?>',
                    dataType: 'json',
                    success: function(response) {
                        if (response.is_paid) {
                            isPaymentReceived = true;
                            clearInterval(pollingInterval);
                            clearInterval(countdownInterval);

                            $("#response").html('<div class="alert alert-success" style="border-radius: 10px;"><i class="bx bx-check-circle me-1"></i> Pagamento confirmado! Redirecionando...</div>');
                            $("#btn-salvar").text('Pagamento Confirmado!').css('background', '#065f46');
                            $('#timer').text('✓').css('color', '#059669');

                            setTimeout(function() {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                }
                            }, 2000);
                        } else {
                            $("#btn-salvar").prop('disabled', false).text('Verificar pagamento agora');
                            $("#response").html('<div class="alert alert-warning" style="border-radius: 10px;">Pagamento ainda nao detectado. Aguarde ou tente novamente.</div>');
                        }
                    },
                    error: function() {
                        $("#btn-salvar").prop('disabled', false).text('Verificar pagamento agora');
                        $("#response").html('<div class="alert alert-danger" style="border-radius: 10px;">Erro ao verificar pagamento. Tente novamente.</div>');
                    }
                });
            }
        });

        $(window).on('beforeunload', function() {
            clearInterval(pollingInterval);
            clearInterval(countdownInterval);
        });
    });
</script>

<?php echo $this->endSection() ?>