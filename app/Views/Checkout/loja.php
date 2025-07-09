<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<?php

$a = 0;
$influencer = '';
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
};
if (isset($_SESSION['cupom'])) {
    $_SESSION['cupom'] = 0;
};
if (isset($_GET['cosplyer'])) {
    $cosplayer = 1;
} else {
    $cosplayer = 0;
}
if (isset($_GET['convite'])) {
    $_SESSION['convite'] = $_GET['convite'];
} else if (!empty($_SESSION['convite'])) {
    $_SESSION['convite'];
} else {
    $_SESSION['convite'] = 0;
};


?>


<div class="row mt-4">
    <div class="col-lg-12">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">




                        <!-- Exibirá os retornos do backend -->
                        <div id="response">


                        </div>

                        <?php
                        $items = array(

                            ['tipo' => 'adicional', 'modal' => '#', 'imagem' => 'recursos/front/images/ingressos/add_pulseira.png', 'nome' => 'Pulseira personalizada RFID colecionável + Entrada e Saída livre no evento', 'preco' => '9.99', 'taxa' => '0,05'],
                            ['tipo' => 'adicional', 'modal' => '#', 'imagem' => 'recursos/front/images/ingressos/add_credencial.png', 'nome' => 'Credencial EXCLUSIVA + Cordão colecionável', 'preco' => '12.49', 'taxa' => '0,05'],
                            ['tipo' => 'adicional', 'modal' => '#', 'imagem' => 'recursos/front/images/ingressos/add_volumes.png', 'nome' => 'Guarda Volumes', 'preco' => '9.99', 'taxa' => '0,05'],
                            //['tipo' => 'adicional', 'modal' => '#', 'imagem' => 'recursos/front/images/ingressos/add_poster.png', 'nome' => 'Pôster Oficial DF23 Colecionável', 'preco' => '29.49', 'taxa' => '0,05'],

                        );


                        ?>



                        <div>

                            <center>


                                <div class=" row" style="padding: 10px;">
                                    <?php foreach ($items as $key => $value) : ?>

                                        <div class="col-lg-4" style="padding: 5px;">
                                            <a href="?adicionar=<?= $key ?>"><img src="<?php echo site_url($value['imagem']); ?>" alt="" width="100%" height="auto"></a>
                                            <hr>
                                        </div>


                                        <!-- Modal -->


                                    <?php endforeach; ?>
                                </div>

                                <?php
                                if (isset($_GET['adicionar'])) {
                                    $idProduto = (int) $_GET['adicionar'];
                                    if (isset($items[$idProduto])) {
                                        if (isset($_SESSION['carrinho'][$idProduto])) {
                                            $_SESSION['carrinho'][$idProduto]['quantidade']++;
                                        } else {
                                            $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'nome' => $items[$idProduto]['nome'], 'preco' => $items[$idProduto]['preco'] + ($items[$idProduto]['preco'] * 0.00), 'tipo' => $items[$idProduto]['tipo'], 'taxa' => $items[$idProduto]['preco'] * 0.00, 'unitario' => $items[$idProduto]['preco']);
                                        }
                                    }
                                }

                                if (isset($_GET['excluir'])) {
                                    $idProduto = (int) $_GET['excluir'];
                                    if (isset($items[$idProduto])) {
                                        if (isset($_SESSION['carrinho'][$idProduto])) {
                                            if ($_SESSION['carrinho'][$idProduto]['quantidade'] > 0) {
                                                $_SESSION['carrinho'][$idProduto]['quantidade']--;
                                            } else {
                                                unset($_SESSION['carrinho'][$idProduto]);
                                            }
                                        }
                                    }
                                }


                                ?>

                                <?php $total_carrinho = 0; ?>
                                <div class="" style="padding: 5px;">
                                    <?php if (isset($_SESSION['carrinho'])) : ?>
                                        <table class="table mb-0 table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="40%">Ingresso</th>
                                                    <th scope="col" width="20%" style="align-items:center">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;Quantidade
                                                    </th>
                                                    <th scope="col" width="25%">Valor</th>
                                                    <th scope="col" width="15%">Taxa</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ($_SESSION['carrinho'] as $key => $value) : ?>
                                                    <?php if ($value['quantidade'] != 0) : ?>
                                                        <tr>
                                                            <td><u><?= $value['nome']; ?></u></td>
                                                            <td> <a class="btn btn-sm" href="?adicionar=<?= $key ?>"><i class="bx bx-plus"></i> </a> <?= $value['quantidade']; ?> <a class="btn btn-sm" href="?excluir=<?= $key ?>"><i class="bx bx-minus"></i> </a></td>
                                                            <td>R$ <?= number_format($value['quantidade'] * $value['unitario'], 2, ',', ''); ?></td>
                                                            <td>R$ <?= number_format($value['quantidade'] * $value['taxa'], 2, ',', ''); ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php

                                                    $total_carrinho += $value['quantidade'] * $value['preco'];

                                                    ?>

                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <center>
                                                    <i class="fadeIn animated bx bx-error-circle font-30" style="color: red"></i><br>Quer <strong>turbinar</strong> a sua experiência no Dreamfest 23? Então clica agora mesmo no botão abaixo e adicione mais experiências incríveis ao seu ingresso!
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
                                                    <p class="mb-0 text-muted" style="font-size: 11px">10 e 11 de Junho de 2023</p>
                                                </div>
                                                <div class="ms-auto fs-3 mb-0 text-muted">

                                                </div>

                                                <div class="ms-auto fs-3 mb-0">
                                                    <p class="mb-0" style="font-size: 10px;">Total a pagar:</p>
                                                    <strong>R$ <?= number_format($_SESSION['total'], 2, ',', '') ?></strong>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($_SESSION['total'] != 0) : ?>
                                    <div id="areaBotoes" class="row g-3">
                                        <div class="col-lg-12">
                                            <a href="<?= site_url('/evento/entrega') ?>" class="w-100 btn btn-primary btn-lg ">Continuar</a>
                                        </div>


                                    </div>

                                <?php endif ?>

                                <p class="mt-5 text-muted"><a href="<?= site_url('/carrinho') ?>" style="color:#999999">Quer comprar mais ingressos? clique aqui!</a></p>
                                <hr>
                                <span class="text-muted mb-5" style="font-size: 12px;">Processado por:</span><br>
                                <img class="mt-1" src="https://asaas.com/assets/home3/header-logo-blue.svg">
                            </center>
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




<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>




<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");




        $("#form").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('checkout/finalizar'); ?>',
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
                                "<?php echo site_url("checkout/qrcode/"); ?>" + response.id;

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