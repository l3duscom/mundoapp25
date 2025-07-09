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
<div class="alert border-0 bg-success alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="fs-3 text-white"><i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="ms-3">
            <div class="text-white">Pagamento confirmado</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

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
                                <i class="bx bx-check-circle" style="font-size: 80px; color:green"></i>
                                <h3>Parabéns! Seu pedido foi realizado com sucesso!</h3>
                                <p style="font-size: 16px;" class="mb-2">Para acessar os seus ingressos acesse:<br> <a href="<?= site_url('/console/dashboard') ?>" class="btn btn-lg btn-primary btn-block shadow"><strong>Acessar meus ingressos</strong></a></p>
                                <p class="text-muted" style="font-size: 12px;"> Você também receberá um e-mail com a confirmação da sua compra! Verifique na caixa de entrada e/ou spam.</p>






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