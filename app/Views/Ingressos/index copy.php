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
        <div class="breadcrumb-title pe-3">Meus Ingressos</div>
    </div>
    <!--end breadcrumb-->


    <div class="row">
        <?php if ($ingressos != null) : ?>
            <?php foreach ($ingressos as $e) : ?>
                <div class="col-lg-12">
                    <div class="card shadow radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">

                                    <?= $nome_evento = $e['nome_evento']; ?>
                                    <?= $local_evento = $e['local']; ?>
                                    <?= $data_inicio = $e['data_inicio']; ?>
                                    <?= $data_fim = $e['data_fim']; ?>

                                    <h3 class=" mb-4"><?= $nome_evento ?></h3>
                                    <p class="mb-2" style="font-size:16px"><i class="bi bi-calendar-check-fill" style="padding-right: 10px; "></i> <?= date('d/m/Y', strtotime($data_inicio)) . ' - ' . date('d/m/Y', strtotime($data_fim)) ?></p>
                                    <p class="mb-2" style="font-size:16px"><i class="bx bx-map-pin" style="padding-right: 10px;"></i>
                                        <?= $local_evento ?> - Av. Ipiranga, 6681 - Partenon, Porto Alegre - RS, 90619-900
                                    </p>
                                    <p class="mb-2"> <img src=" <?php echo site_url('recursos/theme/images/classificacao-livre-logo.png'); ?>" style="padding-right: 10px;" alt="" width=" 28px" height="auto">
                                        Classificação Livre</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-13">
                            <div class="card shadow radius-10">
                                <div class="card-body">

                                    <?php foreach ($ingressos as $i) : ?>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Nome</p>
                                                <strong><?= $cliente->nome ?></strong>
                                            </div>
                                            <div class="col-lg-4">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Ingresso</p>
                                                <strong><?= $i['nome'] ?></strong>
                                            </div>
                                            <div class="col-lg-4">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Código do ingresso</p>
                                                <strong><?= $i['codigo'] ?></strong>
                                            </div>

                                            <div class="col-lg-12 mt-3"></div>

                                            <div class="col-lg-3">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Código de acesso</p>
                                                <strong>R$ <?= number_format($i['valor'], 2, ',', '') ?></strong>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Acesso</p>
                                                <strong><?= $i['frete'] == null ? "Retirar no local" : "receber em casa" ?></strong>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Evento</p>
                                                <strong><?= $i['nome_evento'] ?></strong>
                                            </div>

                                            <div class="col-lg-3">
                                                <p class="mb-0 text-muted" style="font-size: 10px;">Comprovante</p>
                                                <strong>
                                                    <?php if ($i['comprovante'] != null) : ?>
                                                        <strong><a href="<?= $i['comprovante'] ?>" target="_blank">Baixar comprovante</a></strong>
                                                    <?php else : ?>
                                                        <strong>Indiponível</strong>
                                                    <?php endif ?>
                                                </strong>

                                            </div>
                                        </div>
                                        <hr class="mt-5">

                                    <?php endforeach; ?>

                                    <div class="col-lg-12" style="padding-left: 30px;">
                                        <p class="mb-1">Atualmente seus ingressos estão marcados para retirada no dia do evento! Quer receber o kit em casa por apenas R$ 20,00? (até 4 ingressos por pacote)</p>
                                        <a href="" class="btn btn-primary btn-block disabled mt-0">Quero receber meu kit completo em casa!</a>

                                    </div>
                                </div>
                            </div>
                        </div>



                    <?php endforeach; ?>
                    </div>
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

<?php echo $this->endSection() ?>