<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />


<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>



<?php
if (!isset($_SESSION['frete'])) {
    $_SESSION['frete'] = 1;
    $_SESSION['valor_frete'] = 0;
};
if (!isset($_SESSION['casa'])) {
    $_SESSION['casa'] = '';
    $_SESSION['btn_texto_casa'] = 'Selecionar';
    $_SESSION['btn_color_casa'] = 'muted';
};
if (!isset($_SESSION['impressao'])) {
    $_SESSION['impressao'] = '';
    $_SESSION['btn_texto_impressao'] = 'Selecionar';
    $_SESSION['btn_color_impressao'] = 'muted';
};

?>


<h5 class="mb-0 mt-3">DREAMFEST 23 - MEGA FESTIVAL GEEK</h5>
<strong style="color: #A7A7A7"> 10/06/2023 - 11/06/2023 // PORTO ALEGRE</strong>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">



                        <!-- Exibirá os retornos do backend -->
                        <div id="response">


                        </div>



                        <?php
                        $entregas = array(

                            // ['tipo' => 'casa', 'valor' => 20, 'descricao' => 'Receba seu kit com ingresso, pulseiras e guia no conforto da sua casa (máximo de 4 ingressos por pacote)', 'titulo' => 'Disponível para entrega', 'badge' => '+ R$ 20,00', 'icone' => '<i class="fa-solid fa-truck-fast"></i>', 'classe' => 'badge bg-warning text-dark font-13'],
                            ['tipo' => 'impressao', 'valor' => 0, 'descricao' => 'Seu ingresso vai estar disponível na seção ingressos do aplicativo Mundo Dream.', 'titulo' => 'Disponível para impressão', 'badge' => 'GRÁTIS', 'icone' => '<i class="fa-solid fa-print "></i>', 'classe' => 'badge bg-success  font-13']

                        );


                        ?>


                        <?php
                        if (isset($_GET['escolher'])) {
                            $entrega = (int) $_GET['escolher'];

                            $_SESSION['frete'] =  $entregas[$entrega]['tipo'];
                            if ($_SESSION['valor_frete'] == 0) {
                                $_SESSION['valor_frete'] =  $entregas[$entrega]['valor'];
                            } else {
                                $_SESSION['valor_frete'] =  0;
                            }

                            if ($entregas[$entrega]['tipo'] == 'casa') {
                                $_SESSION['casa'] = 'disabled';
                                $_SESSION['impressao'] = '';
                                $_SESSION['btn_texto_casa'] = 'selecionado';
                                $_SESSION['btn_color_casa'] = 'success';
                                $_SESSION['btn_texto_impressao'] = 'selecionar';
                                $_SESSION['btn_color_impressao'] = 'muted';
                            } else {
                                $_SESSION['casa'] = '';
                                $_SESSION['impressao'] = 'disabled';
                                $_SESSION['btn_texto_casa'] = 'Selecionar';
                                $_SESSION['btn_color_casa'] = 'muted';
                                $_SESSION['btn_texto_impressao'] = 'Selecionado';
                                $_SESSION['btn_color_impressao'] = 'success';
                            }
                        }




                        ?>



                        <div class=" mt-1"></div>
                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body shadow">
                                    <div class="d-flex align-items-center ">
                                        <div class="">
                                            <h4 class="mb-0"><i class="fa-solid fa-truck-fast"></i>Selecione uma forma de entrega </h4>
                                        </div>


                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-12">
                                            <div class="card-body shadow">

                                                <?php foreach ($entregas as $key => $value) : ?>


                                                    <div class="card border border-<?= $_SESSION['btn_color_' . $value['tipo']] ?>">
                                                        <div class="form-check mt-3 mb-3">

                                                            <a href="?escolher=<?= $key ?>" id="<?= $value['tipo'] ?>" class=" btn btn-sm btn-primary mb-3 <?= $_SESSION[$value['tipo']] ?>"><?= $_SESSION['btn_texto_' . $value['tipo']] ?></a>
                                                            <label class="form-check-label ml-5 font-20" for="flexRadioDefault1" style="padding-left: 10px;"><?= $value['icone'] ?> <?= $value['titulo'] ?> <span class="<?= $value['classe'] ?>" style="margin-left: 7px;"> <?= $value['badge'] ?></span>
                                                                <br>
                                                                <span class="font-14 mt-0"> <?= $value['descricao'] ?></span>
                                                            </label>

                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>



                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>











                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body  shadow">
                                    <div class="d-flex align-items-center ">
                                        <div class="">
                                            <h4 class="mb-0">Ingressos <?= $_SESSION['frete'] ?></h4>
                                            <p class="mb-0 text-muted" style="font-size: 11px">Dreamfest 23 - Mega Festival Geek</p>
                                            <p class="mb-0 text-muted" style="font-size: 11px">10 e 11 de Junho de 2023 - <strong>Lote 1</strong></p>
                                        </div>
                                        <div class="ms-auto fs-3 mb-0 text-muted">

                                        </div>

                                        <div class="ms-auto fs-3 mb-0">
                                            <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                            <strong>R$ <?= number_format($_SESSION['total'] + $_SESSION['valor_frete'], 2, ',', '') ?></strong>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($_SESSION['total'] != 0) : ?>
                            <div id="areaBotoes" class="row g-3">
                                <div class="col-lg-6">
                                    <a href="<?= site_url('/checkout/cartao') ?>" class="w-100 btn btn-primary btn-lg "><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="bi bi-credit-card-fill me-2 font-16"></i>Cartão</a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="<?= site_url('/checkout/pix') ?>" class="w-100 btn btn-primary btn-lg "><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="fa-brands fa-pix"></i> PIX <span class="badge bg-warning text-dark font-13" style="margin-left: 7px;">10% OFF</span></a>
                                </div>
                                <!--
                                <div class="col-lg-4">
                                    <a href="<?= site_url('/checkout/boleto') ?>" class="w-100 btn btn-primary btn-lg disabled"><span class="text-white" style="font-size: 12px;">Pagar com:</span><i class="bx bx-barcode-reader me-2 font-24"></i>Boleto</a>
                                </div>
                            -->

                            </div>
                            <hr>
                            <center>
                                <span class="text-muted mb-5" style="font-size: 12px;">Processado por:</span><br>
                                <img class="mt-1" src="https://asaas.com/assets/home3/header-logo-blue.svg">
                            </center>
                        <?php endif ?>
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























<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>


        $("#form").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('carrinho/cupom'); ?>',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {

                    $("#response").html('');
                    $("#btn-salvar").val('Por favor aguarde...');

                },
                success: function(response) {

                    $("#btn-salvar").val('Salvar');
                    $("#btn-salvar").removeAttr("disabled");

                    $('[name=csrf_ordem]').val(response.token);


                    if (!response.erro) {


                        if (response.info) {

                            $("#response").html('<div class="alert alert-info">' + response
                                .info + '</div>');

                        } else {

                            // Tudo certo com a atualização do usuário
                            // Podemos agora redirecioná-lo tranquilamente

                            window.location.href =
                                "<?php echo site_url("carrinho"); ?>";

                        }

                    }

                    if (response.erro) {

                        // Exitem erros de validação


                        $("#response").html('<div class="alert alert-danger">' + response.erro +
                            '</div>');


                        if (response.erros_model) {


                            $.each(response.erros_model, function(key, value) {

                                $("#response").append(
                                    '<ul class="list-unstyled"><li class="text-danger">' +
                                    value + '</li></ul>');

                            });

                        }

                    }

                },
                error: function() {

                    alert(
                        'Não foi possível procesar a solicitação. Por favor entre em contato com o suporte técnico.'
                    );
                    $("#btn-salvar").val('Salvar');
                    $("#btn-salvar").removeAttr("disabled");

                }



            });


        });


        $("#form").submit(function() {

            $(this).find(":submit").attr('disabled', 'disabled');

        });


    });
</script>




<?php echo $this->endSection() ?>