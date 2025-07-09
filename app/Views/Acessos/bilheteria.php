<?php echo $this->extend('Layout/acessos'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />


<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<div class="row">


    <div class="col-lg-12">

        <div class="block">

            <div class="block-body">

                <!-- Exibirá os retornos do backend -->
                <div id="response">


                </div>

                <div class="card shadow radius-10 " style="background-color: #fff;">
                    <div class="card-body" style="padding:20%">
                        <div class="form-group mb-2">
                            <?php echo form_open('/', ['id' => 'form']) ?>


                            <?php echo $this->include('Acessos/_form_bilheteria'); ?>




                            <input id="btn-salvar" type="submit" value="Validar acesso" class="btn btn-white w-100 text-muted">


                            <?php echo form_close(); ?>

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
                    url: '<?php echo site_url('acessos/checkaccess'); ?>',
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
                                    "<?php echo site_url("acessos/bilheteria/"); ?>";

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