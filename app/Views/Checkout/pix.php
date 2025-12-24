<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<h5 class="mb-0 mt-3">Quase lá! Agora é só efetuar o pagamento e garantir seus ingressos! </h5>


<div class="row mt-4">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">







                        <!-- Exibirá os retornos do backend -->
                        <div id="response">
                            <?php if (session()->getFlashdata('erro')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('erro') ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (session()->getFlashdata('sucesso')): ?>
                                <div class="alert alert-success">
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


                        <div class="d-flex align-items-center mt-0">
                            <div class="card border shadow-none w-100">

                                <div class="card-header py-3">
                                    <h6 class="mb-0">Seus dados </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 ">
                                            <label class="form-control-label">Nome completo</label>
                                            <input type="text" name="nome" placeholder="Digite seu nome completo" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-control-label">Seu email</label>
                                            <input type="email" name="email" placeholder="Digite seu email para receber seu ingresso" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" required>
                                            <div id="email"></div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-control-label">Celular</label>
                                            <input type="text" name="telefone" placeholder="Insira o telefone" class="form-control sp_celphones mb-2 shadow" style="font-size:medium; padding:13px">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-0">
                            <div class="card border shadow-none w-100">

                                <div class="card-header py-3">
                                    <h6 class="mb-0">Pagamento</h6>
                                </div>
                                <div class="card-body">

                                    <div class="form-group col-md-12">
                                        <label class="form-control-label">CPF</label>
                                        <input type="text" name="cpf" placeholder="Digite o número do  seu CPF" class="form-control form-control-lg mb-2 shadow cpf" style="font-size:medium; padding:13px" required>
                                        <span class="text-muted" style="font-size: 11px; padding-left: 5px">Por exigência do Banco Central, o boleto precisa ter seu CPF.</span>
                                    </div>
                                    <hr>



                                    <div class="card-header py-3">
                                        <h6 class="mb-0">Detalhes da compra</h6>
                                    </div>
                                    <div class="" style="padding: 5px;">
                                        <?php if (isset($_SESSION['carrinho'])) : ?>
                                            <table class="table mb-0 table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" width="40%">Ingresso</th>
                                                        <th scope="col" width="20%" style="align-items:center">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;Quantidade
                                                        </th>
                                                        <th scope="col" width="20%">Valor</th>
                                                        <th scope="col" width="20%">Taxa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                                        <?php if ($value['quantidade'] != 0) : ?>
                                                            <tr>
                                                                <td><u><?= $value['nome']; ?></u></td>
                                                                <td><?= $value['quantidade']; ?> </a></td>
                                                                <td>R$ <?= number_format($value['quantidade'] * $value['unitario'], 2, ',', ''); ?></td>
                                                                <td>R$ <?= number_format($value['quantidade'] * $value['taxa'], 2, ',', ''); ?></td>
                                                            </tr>
                                                        <?php endif; ?>


                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <center>
                                                        <i class="fadeIn animated bx bx-error-circle"></i><br>Oooops, seu carrinho está vazio, escolha um ingresso e venha viver a magia no Dreamfest!
                                                    </center>
                                                    </hr>
                                                <?php endif; ?>


                                                </tbody>
                                            </table>
                                    </div>


                                </div>

                            </div>


                        </div>

                        <!-- Seção de Cupom de Desconto -->
                        <div class="card border shadow-none w-100 mt-3">
                            <div class="card-header py-3">
                                <h6 class="mb-0"><i class="bx bx-purchase-tag-alt me-2"></i>Cupom de desconto</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 align-items-end">
                                    <div class="col-8 col-md-9">
                                        <input type="text" 
                                               id="codigo-cupom" 
                                               name="codigo_cupom"
                                               class="form-control" 
                                               placeholder="Digite seu cupom"
                                               style="text-transform: uppercase;">
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <button type="button" 
                                                id="btn-validar-cupom" 
                                                class="btn w-100"
                                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; font-weight: 600;">
                                            Aplicar
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Área de resultado do cupom -->
                                <div id="cupom-resultado" class="mt-3"></div>
                                
                                <!-- Campos hidden para armazenar o cupom validado -->
                                <input type="hidden" name="cupom_id" id="cupom_id" value="">
                                <input type="hidden" name="cupom_desconto" id="cupom_desconto" value="0">
                            </div>
                        </div>

                        <!-- Resumo do Pedido -->
                        <div class="card border shadow-none w-100 mt-3">
                            <div class="card-header py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <h6 class="mb-0 text-white"><i class="bx bx-receipt me-2"></i>Resumo do Pedido</h6>
                            </div>
                            <div class="card-body py-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal (ingressos)</span>
                                    <strong class="resumo-subtotal">R$ <?= number_format($subtotalIngressos, 2, ',', '.') ?></strong>
                                </div>
                                
                                <?php if ($valorFrete > 0): ?>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted"><i class="bx bx-package me-1"></i>Entrega</span>
                                    <strong class="resumo-frete">R$ <?= number_format($valorFrete, 2, ',', '.') ?></strong>
                                </div>
                                <?php endif; ?>
                                
                                <div id="linha-desconto-cupom" class="d-flex justify-content-between mb-2" style="display: none !important;">
                                    <span class="text-success"><i class="bx bx-purchase-tag me-1"></i>Desconto Cupom</span>
                                    <strong class="text-success resumo-desconto-cupom">- R$ 0,00</strong>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-success"><i class="bx bx-check-circle me-1"></i>Desconto PIX (10%)</span>
                                    <strong class="text-success resumo-desconto-pix">- R$ <?= number_format($descontoPix, 2, ',', '.') ?></strong>
                                </div>
                                
                                <hr class="my-2">
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="font-size: 1.1rem;">Total a pagar</span>
                                    <span class="fw-bold resumo-total-final" style="font-size: 1.3rem; color: #6C038F;">R$ <?= number_format($totalComDesconto, 2, ',', '.') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button id="btn-salvar" type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; padding: 15px; font-size: 1.1rem; font-weight: 600; border-radius: 10px;">
                                <i class="bx bx-lock-alt me-2"></i>Finalizar Compra
                            </button>
                        </div>
                        
                        <?php echo form_close(); ?>

                        <div class="text-center mt-3">
                            <span class="text-muted" style="font-size: 10px;">Pagamento processado com segurança por</span><br>
                            <img class="mt-1" src="<?php echo site_url('recursos/front/images/asaas.png'); ?>" width="80px" height="auto" style="opacity: 0.7;">
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">


                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <h5 class="mb-0">Compra segura</h4>
                                    <p class="mb-0">Ambiente seguro e autenticado</p>
                                    <span class="text-muted" style="font-size: 10px;">Este site utiliza certificado SSL</span>
                            </div>
                            <div class="ms-auto fs-3 ">
                                <i class="fadeIn animated bx bx-check-shield" style="font-size: 45px;"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 42%"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<div class="row" style="padding-left: 20px; padding-right: 20px">
    <div class="col-8">
        <div class="text-muted" style="font-size: 11px; ">
            <p class="mb-0"><strong>Precisa de ajuda? </strong><a href="#" target="_blank">Entre em contato</a></p>
            <p class="mt-0 mb-0">* O valor parcelado possui acréscimo.</p>
            <p class="mt-0 mb-0"><strong>Meia entrada solidária </strong> (40% de desconto) disponível para qualquer pessoa que levar 1kg de alimento não perecível no dia do evento.</p>
            <p class="mt-0 mb-0">Ao clicar em 'Comprar agora', eu concordo (i) com os termos de uso e regras do evento denominado Dreamfest 25 - Mega Festivalk Geek e estou ciente da Política de Privacidade e que sou maior de idade ou autorizado e acompanhado por um tutor legal.</p>

            <hr>
            <p class="mt-0 mb-0">MUNDO DREAM EVENTOS E PRODUCOES LTDA © 2024 - Todos os direitos reservados</p>
            <p class="mt-0 mb-0">21.812.142/0001-23</p>
        </div>
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

        // Função para atualizar valores na tela
        function atualizarValores() {
            // Desconto cupom sobre ingressos
            var ingressosComDesconto = subtotalIngressos - valorDescontoCupom;
            
            // Desconto PIX (10%) sobre ingressos já com desconto do cupom
            var novoDescontoPix = ingressosComDesconto * 0.10;
            var ingressosFinal = ingressosComDesconto - novoDescontoPix;
            
            // Total final = ingressos com descontos + frete (frete não tem desconto)
            var novoTotalFinal = ingressosFinal + valorFrete;
            
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
            
            // Atualiza os spans de resumo
            $('.resumo-subtotal').text('R$ ' + formatarReal(subtotalIngressos));
            $('.resumo-desconto-pix').text('- R$ ' + formatarReal(novoDescontoPix));
            $('.resumo-total-final').text('R$ ' + formatarReal(novoTotalFinal));
            
            // Atualiza o hidden do valor total (em centavos)
            $('#valor_total').val(Math.round(novoTotalFinal * 100));
        }

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