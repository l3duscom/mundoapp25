<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>
<?php
$a = 0;
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
};
if (isset($_SESSION['cupom'])) {
    $_SESSION['cupom'] = 0;
};
?>

<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">




                        <!-- Exibirá os retornos do backend -->
                        <div id="response">


                        </div>


                        <?php
                        $items = array(
                            ['nome' => 'Ingresso Comum DOMINGO - Meia e meia solidária', 'preco' => '35.00'],
                            ['nome' => 'Ingresso Comum DOMINGO - PUCRS', 'preco' => '35.00'],
                            ['nome' => 'Ingresso VIP FAN', 'preco' => '115.00'],
                            ['nome' => 'Ingresso VIP FULL', 'preco' => '195.00'],
                            ['nome' => 'DreamClub', 'preco' => '89.00'],

                        );


                        ?>
                        <h5 class="mt-2">Adicione mais experiências ao seu dia mágico:</h5>
                        <hr>

                        <div class="row">
                            <?php foreach ($items as $key => $value) : ?>

                                <div class="col-6" style="padding: 20px;">
                                    <div class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                                        <div class="font-22"> <a href="?adicionar=<?= $key ?>" class="btn btn-default"> <i class="bx bx-plus"></i></a>
                                        </div>
                                        <div class="ms-2"><?= $value['nome'] ?></div>


                                    </div>

                                </div>


                            <?php endforeach; ?>
                        </div>


                        <?php
                        if (isset($_GET['adicionar'])) {
                            $idProduto = (int) $_GET['adicionar'];
                            if (isset($items[$idProduto])) {
                                if (isset($_SESSION['carrinho'][$idProduto])) {
                                    $_SESSION['carrinho'][$idProduto]['quantidade']++;
                                } else {
                                    $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'nome' => $items[$idProduto]['nome'], 'preco' => $items[$idProduto]['preco']);
                                }
                            }
                            echo '<script>alert("Adicionado");</script>';
                        }

                        if (isset($_GET['excluir'])) {
                            $idProduto = (int) $_GET['excluir'];
                            if (isset($items[$idProduto])) {
                                if (isset($_SESSION['carrinho'][$idProduto])) {
                                    if ($_SESSION['carrinho'][$idProduto]['quantidade'] > 0) {
                                        $_SESSION['carrinho'][$idProduto]['quantidade']--;
                                    } else {
                                        $_SESSION['carrinho'][$idProduto]['quantidade'] = 0;
                                    }
                                }
                            }
                            echo '<script>alert("Excluido");</script>';
                        }


                        ?>


                        <div class=" mt-5"></div>
                        <h4 class="mb-0">Detalhes do pedido </h4>
                        <hr>
                        <?php $total_carrinho = 0; ?>
                        <div class="" style="padding: 5px;">
                            <?php if (isset($_SESSION['carrinho'])) : ?>
                                <table class="table mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="65%">Ingresso</th>
                                            <th scope="col" width="15%" style="align-items:center">
                                                <center>Qtd</center>
                                            </th>
                                            <th scope="col" width="20%">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                            <?php if ($value['quantidade'] != 0) : ?>
                                                <tr>
                                                    <td><u><?= $value['nome']; ?></u></td>
                                                    <td> <a class="btn btn-sm" href="?adicionar=<?= $key ?>"><i class="bx bx-plus"></i> </a> <?= $value['quantidade']; ?> <a class="btn btn-sm" href="?excluir=<?= $key ?>"><i class="bx bx-minus"></i> </a></td>
                                                    <td>R$ <?= $value['quantidade'] * $value['preco']; ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php

                                            $total_carrinho += $value['quantidade'] * $value['preco'];

                                            ?>

                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <center>
                                            <i class="fadeIn animated bx bx-error-circle"></i><br>Oooops, seu carrinho está vazio, escolha um ingresso e venha viver a magia no Dreamfest!
                                        </center>
                                        </hr>
                                    <?php endif; ?>

                                    <?php $_SESSION['total'] = $total_carrinho ?>
                                    </tbody>
                                </table>
                        </div>









                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body  shadow">
                                    <div class="d-flex align-items-center ">
                                        <div class="">
                                            <h4 class="mb-0">Ingressos </h4>
                                            <p class="mb-0 text-muted" style="font-size: 11px">Dreamfest 23 - Mega Festival Geek</p>
                                            <p class="mb-0 text-muted" style="font-size: 11px">Meia entrada solidária - <strong>Lote 1</strong></p>
                                        </div>
                                        <div class="ms-auto fs-3 mb-0 text-muted">

                                        </div>

                                        <div class="ms-auto fs-3 mb-0">
                                            <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                            <strong>R$ <?= $_SESSION['total'] ?></strong>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="areaBotoes" class="row g-3">
                            <div class="col-6">
                                <a href="<?= site_url('/checkout/cartao') ?>" class="w-100 btn btn-primary btn-lg disabled"><i class="bi bi-credit-card-fill me-2 font-16"></i> Pagar com cartão de crédito</a>

                            </div>
                            <div class="col-6">
                                <a href="<?= site_url('/checkout/pix') ?>" class="w-100 btn btn-primary btn-lg"><i class="bx bx-barcode-reader me-2 font-24"></i> Pagar com PIX / Boleto</a>

                            </div>

                        </div>
                        <hr>
                        <center>
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