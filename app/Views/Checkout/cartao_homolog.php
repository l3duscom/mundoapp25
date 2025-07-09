<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">




<!-- Cole aqui o script -->
<script type='text/javascript'>
    var s = document.createElement('script');
    s.type = 'text/javascript';
    var v = parseInt(Math.random() * 1000000);
    s.src = 'https://sandbox.gerencianet.com.br/v1/cdn/f4a23657edfeb8bd4d2613b0a9aa759b/' + v;
    s.async = false;
    s.id = 'f4a23657edfeb8bd4d2613b0a9aa759b';
    if (!document.getElementById('f4a23657edfeb8bd4d2613b0a9aa759b')) {
        document.getElementsByTagName('head')[0].appendChild(s);
    };
    $gn = {
        validForm: true,
        processed: false,
        done: {},
        ready: function(fn) {
            $gn.done = fn;
        }
    };
</script>


<script src="<?php echo site_url('recursos'); ?>/js/script-cartao.js"></script>


<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>


<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h4 class="mb-0">Finalizar compra</h4>
                                            <p class="mb-0 text-muted" style="font-size: 11px">Dreamfest 23 - Mega Festival Geek</p>
                                            <p class="mb-0 text-muted" style="font-size: 11px">Ingressos - <strong>Acesso para a magia!</strong></p>
                                        </div>
                                        <div class="ms-auto fs-3 mb-0">
                                            <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                            <strong>R$ <?= $_SESSION['total'] ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Exibirá os retornos do backend -->
                        <div id="response">


                        </div>



                        <form class="needs-validation" id="formulario_pagamento" method="POST" action="<?= site_url('Checkout/finalizarc') ?>" novalidate>
                            <?= csrf_field() ?>

                            <input type="hidden" name="valor_total" id="valor_total" value="<?= $_SESSION['total'] * 100 ?>" required>

                            <div class="d-flex align-items-center mt-0">
                                <div class="card border shadow-none w-100">

                                    <div class="card-header py-3">
                                        <h6 class="mb-0">Seus dados</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label for="nome" class="form-label">Nome completo</label>
                                                <input type="text" name="nome" id="nome" required class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px">
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="cpf" class="form-label">CPF</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="cpf" id="cpf" required>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="email" id="email" required>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="telefone" class="form-label">Telefone</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="telefone" id="telefone" required>

                                            </div>

                                            <div class="col-3">
                                                <label for="nascimento" class="form-label">Data de nascimento</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="nascimento" id="nascimento" required>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex align-items-center mt-0">
                                <div class="card border shadow-none w-100">

                                    <div class="card-header py-3">
                                        <h6 class="mb-0">Dados do cartão</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label for="numero_cartao" class="form-label">Número do cartão</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="numero_cartao" id="numero_cartao" required>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <label for="bandeira" class="form-label">Bandeira</label>
                                                <select class="form-select form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" id="bandeira" required>
                                                    <option value=""></option>
                                                    <option value="visa">Visa</option>
                                                    <option value="mastercard">MasterCard</option>
                                                    <option value="amex">Amex</option>
                                                    <option value="elo">Elo</option>
                                                    <option value="hipercard">Hipercard</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="mes_vencimento" class="form-label">Mês de vencimento</label>
                                                <select class="form-select form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="mes_vencimento" id="mes_vencimento" required>
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
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="ano_vencimento" class="form-label">Ano de vencimento</label>
                                                <select class="form-select form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="ano_vencimento" id="ano_vencimento" required>
                                                    <option></option>
                                                    <option>2020</option>
                                                    <option>2022</option>
                                                    <option>2023</option>
                                                    <option>2024</option>
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
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="codigo_seguranca" class="form-label">Código de segurança (cvv)</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="codigo_seguranca" id="codigo_seguranca" required>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <!-- Input do Payment Token que será gerado a partir dos dados do cartão inseridos -->
                                            <div class="col-12">
                                                <input type="hidden" class="form-control" name="payment_token" id="payment_token" readonly>
                                            </div>

                                            <!-- Input da máscara do cartão de crédito inserido -->
                                            <div class="col-12">
                                                <input type="hidden" class="form-control" name="mascara_cartao" id="mascara_cartao" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="d-flex align-items-center mt-0">
                                <div class="card border shadow-none w-100">

                                    <div class="card-header py-3">
                                        <h6 class="mb-0">Endereço de cobrança</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="cep" class="form-label">CEP</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow cep" style="font-size:medium; padding:13px" name="cep" required>
                                                <div id="cep"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="endereco" class="form-label">endereco</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="endereco" id="endereco" required readonly>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="numero" class="form-label">Número</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="numero" id="numero" required>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="bairro" class="form-label">Bairro</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="bairro" id="bairro" required readonly>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <label for="cidade" class="form-label">Cidade</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="cidade" id="cidade" required readonly>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="estado" class="form-label">Estado</label>
                                                <input type="text" class="form-control form-control-lg mb-2 shadow" style="font-size:medium; padding:13px" name="estado" id="estado" required readonly>
                                                <div class="invalid-feedback">
                                                    Este campo é obrigatório.
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex align-items-center mt-0">
                                <div class="card border shadow-none w-100">

                                    <div class="card-header py-3">
                                        <h6 class="mb-0">Detalhes do pedido</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="" style="padding: 5px;">
                                                <?php if (isset($_SESSION['carrinho'])) : ?>
                                                    <table class="table mb-0 table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" width="70%">Ingresso</th>
                                                                <th scope="col" width="10%" style="align-items:center">
                                                                    Qtd
                                                                </th>
                                                                <th scope="col" width="20%">Valor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                                                <?php if ($value['quantidade'] != 0) : ?>
                                                                    <tr>
                                                                        <td><u><?= $value['nome']; ?></u></td>
                                                                        <td><?= $value['quantidade']; ?> </a></td>
                                                                        <td>R$ <?= $value['quantidade'] * $value['preco']; ?></td>
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
                            </div>



                            <div id="areaBotoes" class="row g-3">
                                <div class="col-6">
                                    <button class="w-100 btn btn-warning btn-lg" id="ver_parcelas" type="button"><i class="bi bi-arrow-right-short"></i> Definir
                                        parcelas</button>

                                    <!-- número de parcelas escolhido -->
                                    <input type="hidden" class="form-control" name="parcelas" id="parcelas">
                                </div>
                                <div class="col-6">
                                    <button class="w-100 btn btn-secondary btn-lg disabled" id="confirmar_pagamento" type="button">Confirmar pagamento</button>
                                </div>
                            </div>

                        </form>




                        <center>
                            <p class="mt-2 text-muted"><a href="<?= site_url('/carrinho') ?>" style="color:#999999">Ou adicione mais ingressos</a></p>
                            <hr>
                            <img src="https://gerencianet-pub-prod-1.s3.amazonaws.com/imagens/efi/logos/efi-logo-gray.svg">
                        </center>
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
            <p class="mt-0 mb-0">* O valor parcelado (acima de 3 parcelas) possui acréscimo.</p>
            <p class="mt-0 mb-0"><strong>Meia entrada solidária </strong> (50% de desconto) disponível para qualquer pessoa que levar 1kg de alimento não perecível no dia do evento.</p>
            <p class="mt-0 mb-0">Ao clicar em 'Comprar agora', eu concordo (i) com os termos de uso e regras do evento denominado Dreamfest 23 - Mega Festivalk Geek e estou ciente da Política de Privacidade e que sou maior de idade ou autorizado e acompanhado por um tutor legal.</p>

            <hr>
            <p class="mt-0 mb-0">L & M SOLUCOES EM EVENTOS E CONVENCOES DE CULTURA POP LTDA © 2023 - Todos os direitos reservados</p>
            <p class="mt-0 mb-0">21.812.142/0001-23</p>
        </div>
    </div>
</div>




<div class="container">



    <main>




    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <a href="https://gerencianet.com.br/" target="_blank">
            <img style="height: 30px;" src="https://login.gerencianet.com.br/img/svg/logo-gerencianet-topo.svg" alt="Gerencianet - Conceito em Pagamentos">
        </a>
    </footer>
</div>


<!-- MODAL PARA DEFINIÇÃO DAS PARCELAS -->
<div class="modal fade" id="modal_parcelas" tabindex="-1" aria-labelledby="modal_parcelas_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_parcelas_Label">Número de parcelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="opcoes_parcelas" class="form-label">Escolha como deseja pagar</label>
                <select class="form-select" id="opcoes_parcelas" required>
                    <option value="1">1 x de R$35,00 sem juros</option>
                </select>
                <div class="invalid-feedback">
                    O número de parcelas é obrigatório
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="definir_parcelas" class="btn btn-primary">Definir parcelas</button>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>


<script>
    $(document).ready(function() {
        $('[name=cep]').on('keyup', function() {


            var cep = $(this).val();

            if (cep.length === 9) {

                $.ajax({

                    type: 'GET',
                    url: '<?php echo site_url('checkout/consultacep'); ?>',
                    data: {
                        cep: cep
                    },
                    dataType: 'json',
                    beforeSend: function() {


                        $("#formulario_pagamento").LoadingOverlay("show");

                        $("#cep").html('');

                    },
                    success: function(response) {

                        $("#formulario_pagamento").LoadingOverlay("hide", true);


                        if (!response.erro) {

                            if (!response.endereco) {

                                $('[name=endereco]').prop('readonly', false);

                                $('[name=endereco]').focus();

                            }


                            if (!response.bairro) {

                                $('[name=bairro]').prop('readonly', false);

                            }


                            // Preenchemos os inputs com os valores do response
                            $('[name=endereco]').val(response.endereco);
                            $('[name=bairro]').val(response.bairro);
                            $('[name=cidade]').val(response.cidade);
                            $('[name=estado]').val(response.estado);

                        }

                        if (response.erro) {

                            // Exitem erros de validação

                            $("#cep").html(response.erro);
                        }

                    },
                    error: function() {

                        $("#formulario_pagamento").LoadingOverlay("hide", true);

                        alert(
                            'Não foi possível procesar a solicitação. Por favor entre em contato com o suporte técnico.'
                        );

                    }



                });



            }

        });
    });
</script>
<script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
<?php echo $this->endSection() ?>