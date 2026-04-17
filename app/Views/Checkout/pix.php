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
        color: #9333ea;
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
        border-color: #9333ea;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
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
        background: #9333ea;
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
        background: #7c3aed;
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

    /* Botão finalizar */
    .btn-checkout {
        width: 100%;
        padding: 16px;
        background: #059669;
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
        background: #047857;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
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
        margin-left: 8px;
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="checkout-container mt-3">




    <!-- Exibirá os retornos do backend -->
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


                        <?php echo form_open('Checkout/finalizarpix/' . $event_id, ['id' => 'form']) ?>

<?php
// Se vier valor_total via GET, usa ele como base do total (corrigindo para float)
if (isset($_GET['valor_total']) && !empty($_GET['valor_total'])) {
    // Limpa o valor e converte para float
    $valorGet = str_replace(',', '.', $_GET['valor_total']);
    $valorGet = preg_replace('/[^0-9.]/', '', $valorGet);
    $total = floatval($valorGet);
}

// Separa o frete do total dos ingressos
$valorFrete = isset($_SESSION['valor_frete']) ? floatval($_SESSION['valor_frete']) : 0;
$subtotalIngressos = $total; // Valor original dos ingressos (sem frete)

// Cálculo do desconto PIX (10% sobre os ingressos, não sobre o frete)
$descontoPix = $subtotalIngressos * 0.10;
$totalIngressosComDesconto = $subtotalIngressos - $descontoPix;

// Total final = ingressos com desconto + frete (frete não tem desconto)
$totalComDesconto = $totalIngressosComDesconto + $valorFrete;
?>
<input type="hidden" name="valor_total" id="valor_total" value="<?= $totalComDesconto * 100 ?>" required>
<input type="hidden" name="frete" id="frete" value="<?= $_SESSION['frete'] ?>" required>
<input type="hidden" name="convite" value="<?= $_SESSION['convite'] ?>"> 


    <div class="checkout-section">
        <div class="checkout-section-title"><i class="bx bx-user"></i> Seus dados</div>
        <div class="checkout-field">
            <label class="checkout-label">Nome completo</label>
            <input type="text" name="nome" placeholder="Digite seu nome completo" class="checkout-input" required>
        </div>
        <div class="checkout-field">
            <label class="checkout-label">Seu email</label>
            <input type="email" name="email" placeholder="Digite seu email para receber seu ingresso" class="checkout-input" required>
            <div id="email"></div>
        </div>
        <div class="checkout-field">
            <label class="checkout-label">Celular</label>
            <input type="text" name="telefone" placeholder="(00) 00000-0000" class="checkout-input sp_celphones">
        </div>
    </div>

    <div class="checkout-section">
        <div class="checkout-section-title"><i class="bx bx-id-card"></i> CPF</div>
        <div class="checkout-field">
            <input type="text" name="cpf" placeholder="000.000.000-00" class="checkout-input cpf" required>
            <span class="checkout-hint">Por exigência do Banco Central, o PIX precisa do seu CPF.</span>
        </div>
    </div>

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

        <div class="summary-row discount">
            <span class="label"><i class="bx bx-check-circle me-1"></i>Desconto PIX (10%)</span>
            <span class="value resumo-desconto-pix">- R$ <?= number_format($descontoPix, 2, ',', '.') ?></span>
        </div>

        <div class="summary-row total">
            <span class="label">Total a pagar</span>
            <span class="value resumo-total-final">R$ <?= number_format($totalComDesconto, 2, ',', '.') ?></span>
        </div>
    </div>

    <button id="btn-salvar" type="submit" class="btn-checkout">
        <i class="fa-brands fa-pix"></i> Pagar com PIX <span class="pix-tag">10% OFF</span>
    </button>

    <?php echo form_close(); ?>

    <div class="text-center mt-3 mb-2">
        <span style="font-size: 11px; color: #9ca3af;">Pagamento processado com segurança por</span><br>
        <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="80" height="auto" style="opacity: 0.6;">
    </div>

    <div class="checkout-footer-text mt-3 mb-4">
        <p class="mb-1"><strong>Precisa de ajuda?</strong> <a href="#" target="_blank">Entre em contato</a></p>
        <p class="mb-1">* O valor parcelado possui acréscimo.</p>
        <p class="mb-1"><strong>Meia entrada solidária</strong> (40% de desconto) disponível para qualquer pessoa que levar 1kg de alimento no dia do evento.</p>
        <p class="mb-1">Ao clicar em "Pagar com PIX", eu concordo com os termos de uso e regras do evento Dreamfest 25 e estou ciente da Política de Privacidade.</p>
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
        <p class="text-muted">Não feche ou atualize esta página.<br>Sua compra está sendo finalizada.</p>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form');
        const btn = document.getElementById('btn-salvar');
        if (form && btn) {
            form.addEventListener('submit', function(e) {
                btn.disabled = true;
                btn.value = "Processando...";
                btn.classList.add('disabled');
                // Mostra o modal
                var modal = new bootstrap.Modal(document.getElementById('modalProcessando'));
                modal.show();
            });
        }
    });
</script>

<!-- Meta Pixel Events -->
<?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
<script>
// ViewContent Event - quando a página PIX é carregada
fbq('track', 'ViewContent', {
    content_name: '<?= $evento->nome ?> - PIX',
    content_category: '<?= $evento->categoria ?? 'Evento' ?>',
    content_type: 'product',
    content_ids: [<?= $evento->id ?>]
});

// InitiateCheckout Event - quando o usuário clica para finalizar o pagamento PIX
function trackInitiateCheckoutPix() {
    let totalValue = <?= $total ?? 0 ?>;
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
        content_name: '<?= $evento->nome ?> - PIX',
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

<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<script>
    $(document).ready(function() {

        // Track InitiateCheckout when user submits PIX payment
        $("#form").on('submit', function(e) {
            <?php if (isset($evento) && !empty($evento->meta_pixel_id)): ?>
            trackInitiateCheckoutPix();
            <?php endif; ?>
        });

        // ========================================
        // VALIDAÇÃO DE CUPOM DE DESCONTO
        // ========================================
        
        // Valor dos ingressos (sem frete)
        var subtotalIngressos = <?= $subtotalIngressos ?? 0 ?>;
        var valorFrete = <?= $valorFrete ?? 0 ?>;
        var cupomAplicado = false;
        var valorDescontoCupom = 0;
        var valorOrderBumps = 0;

        // Função para calcular total dos order bumps selecionados
        function calcularOrderBumps() {
            var total = 0;
            $('.order-bump-checkbox:checked').each(function() {
                total += parseFloat($(this).data('preco')) || 0;
            });
            return total;
        }

        // Função para atualizar valores na tela
        function atualizarValores() {
            // Calcula order bumps selecionados
            valorOrderBumps = calcularOrderBumps();
            
            // Desconto cupom sobre ingressos
            var ingressosComDesconto = subtotalIngressos - valorDescontoCupom;
            
            // Desconto PIX (10%) sobre ingressos já com desconto do cupom (NÃO sobre order bumps)
            var novoDescontoPix = ingressosComDesconto * 0.10;
            var ingressosFinal = ingressosComDesconto - novoDescontoPix;
            
            // Total final = ingressos com descontos + frete + order bumps (frete e order bumps não têm desconto PIX)
            var novoTotalFinal = ingressosFinal + valorFrete + valorOrderBumps;
            
            // Função para formatar valor em Real
            function formatarReal(valor) {
                return valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
            
            // Mostra/esconde linha de desconto do cupom
            if (valorDescontoCupom > 0) {
                $('#linha-desconto-cupom').css('display', 'flex');
                $('.resumo-desconto-cupom').text('- R$ ' + formatarReal(valorDescontoCupom));
            } else {
                $('#linha-desconto-cupom').css('display', 'none');
            }
            
            // Mostra/esconde linha de order bumps
            if (valorOrderBumps > 0) {
                $('#linha-order-bumps').show().css('display', 'flex');
                $('.resumo-order-bumps').text('+ R$ ' + formatarReal(valorOrderBumps));
            } else {
                $('#linha-order-bumps').hide();
                $('.resumo-order-bumps').text('+ R$ 0,00');
            }
            
            // Atualiza os spans de resumo
            $('.resumo-subtotal').text('R$ ' + formatarReal(subtotalIngressos));
            $('.resumo-desconto-pix').text('- R$ ' + formatarReal(novoDescontoPix));
            $('.resumo-total-final').text('R$ ' + formatarReal(novoTotalFinal));
            
            // Atualiza o hidden do valor total (em centavos)
            $('#valor_total').val(Math.round(novoTotalFinal * 100));
        }

        // ========================================
        // ORDER BUMPS - Seleção e cálculo
        // ========================================
        
        // Evento de mudança nos checkboxes dos order bumps
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

        // Permitir clicar no card inteiro para selecionar o order bump
        $('.order-bump-item').on('click', function(e) {
            // Evita trigger duplo quando clica no checkbox
            if ($(e.target).is('input[type="checkbox"]')) return;
            
            var checkbox = $(this).find('.order-bump-checkbox');
            checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
        });

        // Evento de clique no botão Aplicar
        $('#btn-validar-cupom').on('click', function() {
            var codigo = $('#codigo-cupom').val().trim().toUpperCase();
            var btn = $(this);
            
            if (!codigo) {
                $('#cupom-resultado').html(
                    '<div class="alert alert-warning mb-0 py-2"><small><i class="bx bx-error-circle me-1"></i>Digite um código de cupom</small></div>'
                );
                return;
            }

            // Desabilita o botão durante a requisição
            btn.prop('disabled', true).text('...');

            // Pega o token CSRF atualizado do formulário
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
                    // Atualiza token CSRF
                    if (response.token) {
                        $('input[name="<?= csrf_token() ?>"]').val(response.token);
                    }

                    if (response.erro) {
                        // Cupom inválido
                        $('#cupom-resultado').html(
                            '<div class="alert alert-danger mb-0 py-2"><small><i class="bx bx-x-circle me-1"></i>' + response.erro + '</small></div>'
                        );
                        cupomAplicado = false;
                        valorDescontoCupom = 0;
                        $('#cupom_id').val('');
                        $('#cupom_desconto').val('0');
                    } else {
                        // Cupom válido
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

                        // Atualiza campos hidden
                        $('#cupom_id').val(response.cupom.id);
                        $('#cupom_desconto').val(response.cupom.valor_desconto);

                        // Desabilita o campo de cupom
                        $('#codigo-cupom').prop('disabled', true);
                        
                        // Atualiza valores na tela
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

        // Permite aplicar cupom com Enter
        $('#codigo-cupom').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#btn-validar-cupom').click();
            }
        });

    });
</script>





<?php echo $this->endSection() ?>