<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">
    <div class="col-lg-3">
        <div class="block">
            <div class="row ">
                <div class="col-12">
                    <!-- Stat item-->
                    <strong><i class="fas fa-th-list text-secondary" style="padding-right: 10px;"></i><?php echo $titulo; ?><?php echo esc($declaration->code); ?></strong>
                    <hr>
                    <div>
                        <p class="text-muted mb-0" style="font-size: 12px; font-weight: 600">Status da declaração</p>
                        <strong class="text-xl fw-normal mb-0" style="margin-top: -3px;"><?php echo esc($declaration->status); ?></strong>

                        <p class="text-muted mb-0" style="font-size: 12px; font-weight: 600">Data da declaração</p>
                        <p class="text-xl fw-normal mb-0" style="margin-top: -3px;"><?php echo esc($declaration->month); ?> de <?php echo esc($declaration->year); ?></p>
                        <p class="text-muted" style="font-size: 12px; font-weight: 600;">Declaração iniciada a <?php echo $declaration->created_at->humanize(); ?></p>

                        <?php if ($declaration->recibo !== null) : ?>
                            <hr>
                            <p><a href="<?php echo site_url("declarations/pdf/$declaration->recibo"); ?>"> <i class="fas fa-file-pdf"></i> Baixar recibo</a></p>
                        <?php endif; ?>
                        <div class="progress" style="height: 2px">
                            <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p></p>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gerenciar Declaração
                        </button>
                        <div class="dropdown-menu">
                            <?php if ($declaration->status == 'ABERTA') : ?>
                                <a class="dropdown-item" href="<?php echo site_url("declarations/editar_dici_stfc/$declaration->id"); ?>">Editar declaração</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo site_url("declarations/duplicar_dici_stfc/$declaration->id"); ?>">Duplicar declaração</a>

                            <?php if (!empty($declarations)) : ?>
                                <?php if (!usuario_logado()->is_cliente) : ?>
                                    <a class="dropdown-item" href="<?php echo site_url("declarations/gerarelatoriodicistfc/$declaration->id"); ?>">Gerar CSV</a>
                                <?php endif; ?>

                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <?php if ($declaration->status == 'ABERTA') : ?>
                                <?php if ($declaration->deletado_em == null) : ?>

                                    <a class="dropdown-item" href="<?php echo site_url("declarations/excluir/$declaration->id"); ?>">Excluir declaração</a>

                                <?php else : ?>

                                    <a class="dropdown-item" href="<?php echo site_url("declarations/desfazerexclusao/$declaration->id"); ?>">Restaurar declaração</a>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <a href="<?php echo site_url("console/dashboard") ?>" class="btn btn-secondary btn-sm ml-2">Voltar</a>

                </div>

            </div>
        </div>
    </div>
    <div class=" col-lg-9">
        <div class="block text-center">
            <?php if (empty($declarations)) : ?>

                <p class="contributions " style="margin-top: 40px;">Essa declaração ainda não possui planos cadastrados</p>
                <?php if ($declaration->status == 'ABERTA') : ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus" style="padding-right: 10px;"></i> Adicionar plano</button>
                <?php endif; ?>
            <?php else : ?>
                <div class="row">
                    <div class="col-lg-4">
                        <?php if ($declaration->status == 'ABERTA') : ?>
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus" style="padding-right: 10px;"></i> Adicionar plano</button>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-4">

                        <?php if (!usuario_logado()->is_cliente & $declaration->status == 'ENVIADA') : ?>
                            <a href="<?php echo site_url("declarations/enviarrecibo/$declaration->id"); ?>" class="btn btn-sm btn-success btn-block"><i class="fas fa-check-circle" style="padding-right: 10px;"></i> Finalizar declaração</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($declaration->status !== 'FINALIZADA') : ?>
                    <hr>
                <?php endif; ?>
                <div class=" table-responsive">

                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Cidade</th>
                                <th>Cliente</th>
                                <th>Tipo Atend.</th>
                                <th>Meio</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($declarations as $dec) : ?>
                                <tr>
                                    <td><?php echo esc($dec->Nome); ?> - <?php echo esc($dec->Uf); ?></td>
                                    <td><?php echo esc($dec->tipo_cliente); ?></td>
                                    <td><?php echo esc($dec->tipo_atendimento); ?></td>
                                    <td><?php echo esc($dec->tipo_meio); ?></td>
                                    <td>

                                        <div class="btn-group">
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <a class="btn btn-sm btn-secondary" href="<?php echo site_url("declarations/editar_dici_stfc_plano/$dec->id"); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>

                                            <?php
                                            $atributos = [
                                                'onSubmit' => "return confirm('Tem certeza da exclusão do plano?');",
                                            ];
                                            ?>
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <?php echo form_open("/declarations/excluirPlanoStfc/$dec->id", $atributos) ?>

                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>

                                                <?php echo form_close(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>



                </div> <!-- ./ block -->
                <div class="col-lg-12">
                    <hr>
                    <?php if (usuario_logado()->is_cliente & !empty($declarations) & $declaration->status == 'ABERTA') : ?>
                        <a href="<?php echo site_url("declarations/gravarenviar/$declaration->id"); ?>" class="btn btn-sm btn-secondary btn-block"><i class="fas fa-check-circle" style="padding-right: 10px;"></i> <strong>Gravar e enviar</strong></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adição de plano DICI-STFC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?php echo form_open('/', ['id' => 'form'], ['id' => "$declaration->id"]) ?>


                <?php echo $this->include('Declarations/_form_dici_stfc_step_2'); ?>







            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                <input id="btn-salvar" type="submit" value="Salvar plano" class="btn btn-primary btn-sm">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>



<script type="text/javascript">
    var base_url = "<?php echo site_url() ?>";

    $(function() {
        $('#estados').change(function() {
            $('#city_code').html("<option>Carregando...</option>");
            $('#city_code').attr('disabled', 'disabled');
            var uf = $('#estados').val();
            $.post('<?php echo site_url('cidades/getcidades'); ?>', {
                uf: uf
            }, function(data) {
                $('#city_code').html(data);
                $('#city_code').removeAttr('disabled');
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>


        $("#form").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('declarations/register_dici_stfc_step_2'); ?>',
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
                                "<?php echo site_url("declarations/criar_dici_stfc_step_2/"); ?>" + <?php echo $declaration->id; ?>;

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