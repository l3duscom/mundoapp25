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
                        <p class="text-muted mb-0" style="font-size: 12px; font-weight: 600">Ano vigente</p>
                        <strong class="text-xl fw-normal mb-0" style="margin-top: -3px;"><?php echo esc($declaration->year); ?></strong>
                        <p class="text-muted mb-0" style="font-size: 12px; font-weight: 600">Status da declaração</p>
                        <strong class="text-xl fw-normal mb-0" style="margin-top: -3px;"><?php echo esc($declaration->status); ?></strong>

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
                                <a class="dropdown-item" href="<?php echo site_url("declarations/editar_dici_scm_anual/$declaration->id"); ?>">Editar declaração</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo site_url("declarations/duplicar_dici_scm_anual/$declaration->id"); ?>">Duplicar declaração</a>

                            <?php if (!empty($estacoes)) : ?>
                                <?php if (!usuario_logado()->is_cliente) : ?>
                                    <a class="dropdown-item" href="<?php echo site_url("declarations/gerarelatoriodiciscmanualestacoes/$declaration->id"); ?>">Gerar CSV Estações</a>
                                    <a class="dropdown-item" href="<?php echo site_url("declarations/gerarelatoriodiciscmanualenlacesproprios/$declaration->id"); ?>">Gerar CSV Enlaces Próprios</a>
                                    <a class="dropdown-item" href="<?php echo site_url("declarations/gerarelatoriodiciscmanualenlacescontratados/$declaration->id"); ?>">Gerar CSV Enlaces Contratados</a>

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

                    <a href="<?php echo site_url("console/dashboard") ?>" class="btn btn-secondary btn-sm ml-2 ">Voltar</a>
                    <hr>
                    <?php if (!usuario_logado()->is_cliente & $declaration->status == 'ENVIADA') : ?>
                        <a href="<?php echo site_url("declarations/enviarrecibo/$declaration->id"); ?>" class="btn btn-sm btn-success btn-block"><i class="fas fa-check-circle" style="padding-right: 10px;"></i> Finalizar declaração</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>

    <div class=" col-lg-9">
        <div class="block">

            <div class="row">
                <div class="col-lg-8">
                    <strong>Estações</strong>
                </div>
                <div class="col-lg-4">
                    <?php if ($declaration->status == 'ABERTA') : ?>
                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#estacoesModal"><i class="fas fa-plus" style="padding-right: 10px;"></i> Adicionar informações</button>
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
                            <th>ID</th>
                            <th>Estação</th>
                            <th>Cidade</th>
                            <th>Abertura</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($estacoes as $estacao) : ?>
                            <tr>
                                <td><?php echo esc($estacao->id_estacao); ?></td>
                                <td><?php echo esc($estacao->numestacao); ?></td>
                                <td><?php echo esc($estacao->Nome); ?></td>
                                <td><?php echo esc($estacao->abertura); ?></td>
                                <td>

                                    <div class="btn-group">
                                        <?php if ($declaration->status == 'ABERTA') : ?>
                                            <a class="btn btn-sm btn-secondary" href="<?php echo site_url("declarations/editar_dici_scm_anual_estacoes/$estacao->id"); ?>"><i class="fas fa-edit"></i></a>
                                        <?php endif; ?>

                                        <?php
                                        $atributos = [
                                            'onSubmit' => "return confirm('Tem certeza da exclusão do plano?');",
                                        ];
                                        ?>
                                        <?php if ($declaration->status == 'ABERTA') : ?>
                                            <?php echo form_open("/declarations/excluirPlanoScmAnualEstacao/$estacao->id", $atributos) ?>

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
        </div>

        <?php if (!empty($estacoes)) : ?>
            <div class="block">

                <div class="row">
                    <div class="col-lg-8">
                        <strong>Enlaces Próprios</strong>
                    </div>
                    <div class="col-lg-4">
                        <?php if ($declaration->status == 'ABERTA') : ?>
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#enlacesPropriosModal"><i class="fas fa-plus" style="padding-right: 10px;"></i> Adicionar informações</button>
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
                                <th>Estação de Origem</th>
                                <th>Estação de Destino</th>
                                <th>Meio</th>
                                <th>Capacidade</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($proprios as $proprio) : ?>
                                <tr>
                                    <td><?php echo esc($proprio->estacao_a_id); ?></td>
                                    <td><?php echo esc($proprio->estacao_b_id); ?></td>
                                    <td><?php echo esc($proprio->enlaces_proprios_terrestres_meio); ?></td>
                                    <td><?php echo esc($proprio->enlaces_proprios_terrestres_c_nominal); ?></td>
                                    <td>

                                        <div class="btn-group">
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <a class="btn btn-sm btn-secondary" href="<?php echo site_url("declarations/editar_dici_scm_anual_enlace_proprio/$proprio->id"); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>

                                            <?php
                                            $atributos = [
                                                'onSubmit' => "return confirm('Tem certeza da exclusão do plano?');",
                                            ];
                                            ?>
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <?php echo form_open("/declarations/excluirPlanoScmAnualProprio/$proprio->id", $atributos) ?>

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
            </div>

            <div class="block">

                <div class="row">
                    <div class="col-lg-8">
                        <strong>Enlaces Contratados</strong>
                    </div>
                    <div class="col-lg-4">
                        <?php if ($declaration->status == 'ABERTA') : ?>
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#enlacesContratadosModal"><i class="fas fa-plus" style="padding-right: 10px;"></i> Adicionar informações</button>
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
                                <th>Estação de Origem</th>
                                <th>Estação de Destino</th>
                                <th>Meio</th>
                                <th>Prestadora</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($contratados as $contratado) : ?>
                                <tr>
                                    <td><?php echo esc($contratado->estacao_a_id); ?></td>
                                    <td><?php echo esc($contratado->estacao_b_id); ?></td>
                                    <td><?php echo esc($contratado->enlaces_contratados_meio); ?></td>
                                    <td><?php echo esc($contratado->enlaces_contratados_prestadora); ?></td>
                                    <td>

                                        <div class="btn-group">
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <a class="btn btn-sm btn-secondary" href="<?php echo site_url("declarations/editar_dici_scm_anual_enlace_contratado/$contratado->id"); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>

                                            <?php
                                            $atributos = [
                                                'onSubmit' => "return confirm('Tem certeza da exclusão do plano?');",
                                            ];
                                            ?>
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <?php echo form_open("/declarations/excluirPlanoScmAnualEnlaceContratado/$contratado->id", $atributos) ?>

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
            </div>

            <!--
            <div class="block">

                <div class="row">
                    <div class="col-lg-8">
                        <strong>Enlaces via Satélite</strong>
                    </div>
                    <div class="col-lg-4">
                        <?php if ($declaration->status == 'ABERTA') : ?>
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#enlacesViaSateliteModal"><i class="fas fa-plus" style="padding-right: 10px;"></i> Adicionar informações</button>
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
                                <th>Estação de Origem</th>
                                <th>ID Satélite</th>
                                <th>Código Satélite</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($satelites as $satelite) : ?>
                                <tr>
                                    <td><?php echo esc($satelite->estacao_a_id); ?></td>
                                    <td><?php echo esc($satelite->enlaces_satelites_id); ?></td>
                                    <td><?php echo esc($satelite->enlaces_satelites_cod_satelite); ?></td>
                                    <td>

                                        <div class="btn-group">
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <a class="btn btn-sm btn-secondary" href="<?php echo site_url("declarations/editar_dici_scm_anual_via_satelite/$satelite->id"); ?>"><i class="fas fa-edit"></i></a>
                                            <?php endif; ?>

                                            <?php
                                            $atributos = [
                                                'onSubmit' => "return confirm('Tem certeza da exclusão do plano?');",
                                            ];
                                            ?>
                                            <?php if ($declaration->status == 'ABERTA') : ?>
                                                <?php echo form_open("/declarations/excluirPlanoScmAnualViaSatelite/$satelite->id", $atributos) ?>

                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>

                                                <?php echo form_close(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div> 
            </div>
            -->
            <div class="col-lg-12">
                <?php if (usuario_logado()->is_cliente &  $declaration->status == 'ABERTA') : ?>
                    <a href="<?php echo site_url("declarations/gravarenviar/$declaration->id"); ?>" class="btn btn-sm btn-secondary btn-block"><i class="fas fa-check-circle" style="padding-right: 10px;"></i> <strong>Gravar e enviar</strong></a>
                <?php endif; ?>
            </div><br><br>
        <?php endif; ?>


    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="estacoesModal" tabindex="-1" role="dialog" aria-labelledby="estacoesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estacoesModal">Adição de informações DICI-SCM Anual - Estações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?php echo form_open('/', ['id' => 'form_estacoes'], ['id' => "$declaration->id"]) ?>


                <?php echo $this->include('Declarations/_form_dici_scm_anual_estacoes'); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-primary btn-sm">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="enlacesPropriosModal" tabindex="-1" role="dialog" aria-labelledby="enlacesPropriosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enlacesPropriosModalLabel">Adição de informações DICI-SCM Anual - Enlaces Próprios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?php echo form_open('/', ['id' => 'form_enlaces_p'], ['id' => "$declaration->id"]) ?>


                <?php echo $this->include('Declarations/_form_dici_scm_anual_enlaces_proprios'); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-primary btn-sm">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="enlacesContratadosModal" tabindex="-1" role="dialog" aria-labelledby="enlacesContratadosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enlacesContratadosModal">Adição de informações DICI-SCM Anual - Enlaces Contratados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?php echo form_open('/', ['id' => 'form_enlaces_c'], ['id' => "$declaration->id"]) ?>


                <?php echo $this->include('Declarations/_form_dici_scm_anual_enlaces_contratados'); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-primary btn-sm">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="enlacesViaSateliteModal" tabindex="-1" role="dialog" aria-labelledby="enlacesViaSateliteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enlacesViaSateliteModal">Adição de informações DICI-SCM Anual - Enlaces Via Satélite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?php echo form_open('/', ['id' => 'form_enlaces_v'], ['id' => "$declaration->id"]) ?>


                <?php echo $this->include('Declarations/_form_dici_scm_anual_enlaces_via_satelite'); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-primary btn-sm">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<!-- $('#myModal').on('shown.bs.modal', function () {
$('#myInput').trigger('focus')
}) -->

<script src="<?php echo site_url('recursos/vendor/mask/jquery.mask.min.js') ?>"></script>
<script src="<?php echo site_url('recursos/vendor/mask/app.js') ?>"></script>

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


        $("#form_estacoes").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('declarations/register_dici_scm_anual_estacoes'); ?>',
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
                                "<?php echo site_url("declarations/criar_dici_scm_anual_step_2/"); ?>" + <?php echo $declaration->id; ?>;

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

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>


        $("#form_enlaces_p").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('declarations/register_dici_scm_anual_enlaces_proprios'); ?>',
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
                                "<?php echo site_url("declarations/criar_dici_scm_anual_step_2/"); ?>" + <?php echo $declaration->id; ?>;

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

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>


        $("#form_enlaces_c").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('declarations/register_dici_scm_anual_enlaces_contratados'); ?>',
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
                                "<?php echo site_url("declarations/criar_dici_scm_anual_step_2/"); ?>" + <?php echo $declaration->id; ?>;

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

<script>
    $(document).ready(function() {

        //$("#form").LoadingOverlay("show");

        <?php echo $this->include('Clientes/_checkmail'); ?>

        <?php echo $this->include('Clientes/_viacep'); ?>


        $("#form_enlaces_v").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('declarations/register_dici_scm_anual_enlaces_via_satelite'); ?>',
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
                                "<?php echo site_url("declarations/criar_dici_scm_anual_step_2/"); ?>" + <?php echo $declaration->id; ?>;

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