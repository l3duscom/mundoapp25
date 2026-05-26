<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">


    <div class="col-lg-3">

        <div class="block">

            <div class="block-body">

                <!-- Exibirá os retornos do backend -->
                <div id="response">


                </div>
                <h3>Meus Meet & Greet</h3>
                <div class="card shadow radius-10">
                    <div class="card-body">

                        <?php
                        $renderMeet = function ($meet, $exibirQr = true) {
                        ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow radius-10">
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <h2><?= esc($meet->artista) ?></h2>
                                            </div>
                                            <?php if (!empty($meet->evento_nome)) : ?>
                                                <div class="col-lg-12" style="font-size: 12px;">
                                                    <span class="text-muted"><i class="bx bx-calendar-event"></i> <?= esc($meet->evento_nome) ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-lg-12">
                                                <span><?= date('d/m/Y', strtotime($meet->data_meet)) ?>
                                                    | <?= esc($meet->hora_inicial) ?> </span>
                                            </div>
                                            <div class="col-lg-12" style="font-size: 13px;">
                                                <span>Você é o <strong style="color:greenyellow"><?= esc($meet->ordem) ?>º </strong>da fila <?= esc($meet->tipo) ?></span>
                                            </div>
                                            <?php if ($exibirQr) : ?>
                                                <div class="col-lg-12 mt-3">
                                                    <img src="<?= $meet->qr ?>" style="background-color:#fff; padding:0px" width="100%">
                                                    <hr>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        };
                        ?>

                        <?php if (!empty($meetsAtuais)) : ?>
                            <h5 class="mt-2 mb-3"><i class="bx bx-time-five"></i> Evento atual</h5>
                            <?php foreach ($meetsAtuais as $meet) : ?>
                                <?php $renderMeet($meet, true); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($meetsAnteriores)) : ?>
                            <h5 class="mt-4 mb-3 text-muted"><i class="bx bx-archive"></i> Eventos anteriores</h5>
                            <?php foreach ($meetsAnteriores as $meet) : ?>
                                <?php $renderMeet($meet, false); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (empty($meetsAtuais) && empty($meetsAnteriores)) : ?>
                            <p class="text-muted">Você ainda não possui meet & greet.</p>
                        <?php endif; ?>

                        <hr>
                        <p class="text-muted font-13"> Dúvidas sobre o meet & Greet? <a href="https://dreamfest.com.br/central-de-ajuda/como-funciona-o-meet-greet" target="_blank">Clique aqui</a></p>
                    </div>
                </div>

            </div>



        </div> <!-- ./ block -->

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
                url: '<?php echo site_url('pedidos/editar_endereco_pedido'); ?>',
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
                                "<?php echo site_url("ingressos/"); ?>";

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