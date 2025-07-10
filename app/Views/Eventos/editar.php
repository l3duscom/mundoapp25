<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />

<link rel="stylesheet" href="<?php echo site_url('recursos/theme/plugins/datetimepicker/css/classic.css') ?>" />
<link rel="stylesheet" href="<?php echo site_url('recursos/theme/plugins/datetimepicker/css/classic.time.css') ?>" />
<link rel="stylesheet" href="<?php echo site_url('recursos/theme/plugins/datetimepicker/css/classic.date.css') ?>" />
<link rel="stylesheet" href="<?php echo site_url('recursos/theme/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') ?>">

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">

    <?php $id = usuario_logado()->id ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 text-muted"><a href="<?php echo site_url('/eventos'); ?>">Eventos</a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <?php if (usuario_logado()->is_membro) : ?>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('/'); ?>"><i class="fadeIn animated bx bx-crown" style="color: #ffd700;" title="Membro Premium"></i> </a></li>
                    <?php else : ?>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('/'); ?>"><i class="bx bx-home-alt"></i></a></li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $titulo; ?></li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="align-items-center">
        <div id="response">

        </div>


        <?php echo form_open('/', ['id' => 'form']) ?>
        <input type="hidden" name="id" value="<?php echo $evento->id; ?>">
        <?php echo $this->include('Eventos/_form'); ?>
        <div class="form-group mb-2">
            <div class="card shadow radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="btn-group">
                            <input id="btn-salvar" type="submit" value="Atualizar evento" class="btn btn-primary ">
                            <a href="<?php echo site_url("eventos") ?>" class="btn btn-dark ">Cancelar</a>
                        </div>
                        <div style="padding-right: 5px;">
                            <a href="<?php echo site_url('eventos'); ?>">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>



<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<script src="<?php echo site_url('recursos/vendor/loadingoverlay/loadingoverlay.min.js') ?>"></script>


<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>



<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Eventos/_viacep'); ?>

        $("#form").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('eventos/atualizar'); ?>',
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

                    $("#btn-salvar").val('Atualizar evento');
                    $("#btn-salvar").removeAttr("disabled");

                    $('[name=csrf_ordem]').val(response.token);


                    if (!response.erro) {


                        if (response.info) {

                            $("#response").html('<div class="alert alert-info">' + response
                                .info + '</div>');

                        } else {

                            // Tudo certo com a atualização do evento
                            // Podemos agora redirecioná-lo tranquilamente

                            window.location.href =
                                "<?php echo site_url("eventos/exibir/"); ?>" + <?php echo $evento->id; ?>;

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
                    $("#btn-salvar").val('Atualizar evento');
                    $("#btn-salvar").removeAttr("disabled");

                }



            });


        });


        $("#form").submit(function() {

            $(this).find(":submit").attr('disabled', 'disabled');

        });


    });
</script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/plugins/datetimepicker/js/legacy.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/plugins/datetimepicker/js/picker.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/plugins/datetimepicker/js/picker.time.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/plugins/datetimepicker/js/picker.date.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/plugins/bootstrap-material-datetimepicker/js/moment.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/theme/js/form-date-time-pickes.js') ?>"></script>



<?php echo $this->endSection() ?> 