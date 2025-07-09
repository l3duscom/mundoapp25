<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">


    <div class="col-lg-8">

        <div class="block">

            <div class="block-body">

                <!-- Exibirá os retornos do backend -->
                <div id="response">


                </div>
                <h3>FILA MEET & GREET EPIC</h3>
                <div class="card shadow radius-10">
                    <div class="card-body">

                        <div class="card-body">
                            <p class="font-15" style="font-weight: 800;"> Selecione o Meet & Greet Desejado:</p>
                            <div class="alert alert-warning" role="alert">
                                As opções listadas abaixo são as disponíveis para seu ingresso/dia de uso e com estoque. Qualquer dúvida entre em contato.
                                <hr>Os horários do Meet & Greet podem sofrer alterações, atente-se sempre ao cronograma oficial divulgado em nosso site.
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col col-lg-6 col-sm-12 mt-2">Convidado</div>
                                <div class="col col-lg-3 col-sm-12 mt-2">Horário previsto</div>
                                <div class="col col-lg-3 col-sm-12">

                                </div>
                            </div>
                        </div>

                        <?php foreach ($meets as $meet) : ?>

                            <?php if ($meet->tipo === $tipo) : ?>
                                <?php if ($day === 'duo' || $meet->dia === $day) : ?>

                                    <div class="card shadow bg-dark radius-10">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col col-lg-6 col-sm-12 mt-2" style="font-size: 16px;font-weight: 800;"><?= $meet->artista ?></div>
                                                <div class="col col-lg-3 col-sm-12 mt-2"><?= $meet->hora_inicial ?></div>
                                                <div class="col col-lg-3 col-sm-12">
                                                    <a href="<?= site_url('/console/queuecheck/' . $meet->id . '/' . service('uri')->getSegment(3)) ?>" class="btn btn-primary shadow w-100"><i class='bx bx-check' style="padding-right: 5px;"></i>Reservar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php endforeach; ?>


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