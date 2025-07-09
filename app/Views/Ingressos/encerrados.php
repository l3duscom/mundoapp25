<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">

    <?php $id = usuario_logado()->id ?>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Ingressos Encerrados</div>
        <a href="<?= site_url('/ingressos') ?>" style="padding-left: 10px;"><strong>ingressos ativos</strong> </a>

    </div>

    <!--end breadcrumb-->
    <?php $ingresso_id = null ?>

    <div class="row">

        <?php if ($ingressos != null) : ?>
            <?php foreach ($ingressos as $i) : ?>
                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow radius-10">
                                <div class="card-body">

                                    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                                        <div class="breadcrumb-title pe-3"><strong class="font-20"><?= $i->nome_evento ?></strong></div>
                                        <div class="ps-3">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb mb-0 p-0">
                                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-calendar-star"></i></a>
                                                    </li>
                                                    <li class="breadcrumb-item active" aria-current="page">
                                                        <?= date('d/m/Y', strtotime($i->data_inicio)) ?> - <?= date('d/m/Y', strtotime($i->data_fim)) ?>

                                                    </li>
                                                </ol>
                                            </nav>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="btn-group mt-2">
                                                <span class="text-muted"> Nenhuma ação disponível
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <hr class="mt-2">
                                        <div class="col-lg-8">
                                            <p class="mb-0 text-muted" style="font-size: 10px;">Ingresso</p>

                                            <strong><?= $i->nome ?></strong>
                                        </div>
                                        <div class="col-lg-3">
                                            <p class="mb-0 text-muted" style="font-size: 10px;">Código do ingresso</p>
                                            <strong><?= $i->codigo ?></strong>
                                        </div>
                                        <div class="col-lg-12 mt-3"></div>
                                        <div class="col-lg-3">
                                            <p class="mb-0 text-muted" style="font-size: 10px;">Nome</p>
                                            <?php if ($i->participante == null) : ?>
                                                <strong><?= $cliente->nome ?></strong>
                                            <?php else : ?>
                                                <strong><?= $i->participante ?></strong>
                                            <?php endif ?>

                                        </div>

                                        <div class="col-lg-3">
                                            <p class="mb-0 text-muted" style="font-size: 10px;">Acesso</p>
                                            <strong><?= $i->frete == null || $i->frete == 0 ? "Retirar no local" : "Receber em casa" ?></strong>
                                        </div>


                                        <div class="col-lg-3">
                                            <p class="mb-0 text-muted" style="font-size: 10px;">Comprovante</p>
                                            <strong>
                                                <?php if ($i->comprovante != null) : ?>
                                                    <strong><a href="<?= $i->comprovante ?>" target="_blank">Baixar comprovante</a></strong>
                                                <?php else : ?>
                                                    <strong>Indiponível</strong>
                                                <?php endif ?>
                                            </strong>

                                        </div>
                                    </div>
                                    <hr class="mt-2">



                                    <div class="col-lg-12">
                                        <?php if ($i->tipo == 'cinemark') : ?>
                                            <div class="alert border-0 bg-light-warning alert-dismissible fade show py-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-3 text-warning"><i class="bi bi-exclamation-triangle-fill"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <div class="text-warning"><strong>É UM VOUCHER CINEMARK?</strong> Para utilizar seu ingresso cinemark, basta seguir os passoas abaixo:<br>
                                                            1 – Atualize ou baixe o APP da Cinemark.
                                                            <br>
                                                            2 – Selecione o cinema, filme e horário da sua sessão.
                                                            <br>
                                                            3 – Selecione os assentos.
                                                            <br>
                                                            4 – Faça seu login caso não tenha feito, selecione o tipo de ingresso (Ingresso Corporativo) e a quantidade de ingressos. Após isso digite o CÓDIGO DO INGRESSO que irá utilizar.
                                                            <br>
                                                            5 – Aproveite para já comprar seu combo.
                                                            <br>
                                                            6 – Apresente seu ingresso online pelo celular, diretamente na entrada da sala.
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif ?>
                                        <span class="text-muted"> Nenhuma ação disponível
                                        </span>



                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>


                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="participante<?= $i->id; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="participante<?= $i->id; ?>Modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="participante<?= $i->id; ?>Modal">Gerenciamento de ingresso</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">


                                    <?php echo form_open("ingressos/atualizar/$i->id") ?>
                                    <?= csrf_field() ?>

                                    <div class="form-group col-md-12">
                                        <label class="form-control-label">Informe o nome do novo participante</label>
                                        <input type="text" name="participante" class="form-control">
                                    </div>
                                    <p class="text-muted font-13"> Este é o nome que aparecerá no seu ingresso!</p>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                    <input id="btn-salvar" type="submit" value="Alterar" class="btn btn-primary btn-sm">
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>

                <center>
                    <hr>
                    <p>Nenhum ingresso encontrado</p>

                    <a href="<?= site_url('/carrinho') ?>" target="_blank" class="btn btn-primary">Comprar ingresso!</a>
                    <hr>
                </center>

            <?php endif; ?>

                </div>


    </div>
</div>




<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script type="text/javascript" src="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.js') ?>"></script>



<script>
    $(document).ready(function() {


        const DATATABLE_PTBR = {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }


        $(' #ajaxTable').DataTable({
            "oLanguage": DATATABLE_PTBR,
            "ajax": "<?php echo site_url('declarations/recuperaDeclaracoesPorUsuario'); ?>",
            "columns": [{
                "data": "nome"
            }, {
                "data": "month"
            }, {
                "data": "type"
            }, {
                "data": "status"
            }, {
                "data": "created_at"
            }, ],
            "order": [],
            "deferRender": true,
            "processing": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
            },
            "responsive": true,
            "pagingType": $(window).width() < 768 ? "simple" : "simple_numbers",
        });
    });
</script>

<script>
    $(document).ready(function() {




        $("#form_participante").on('submit', function(e) {


            e.preventDefault();


            $.ajax({

                type: 'POST',
                url: '<?php echo site_url('ingressos/atualizar'); ?>',
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