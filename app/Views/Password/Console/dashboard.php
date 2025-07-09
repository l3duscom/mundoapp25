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
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">

                    <?php if (usuario_logado()->is_membro) : ?>
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="fadeIn animated bx bx-crown" style="color: #ffd700;" title="Membro Premium"></i> </a></li>
                    <?php else : ?>
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo esc(usuario_logado()->nome); ?></li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div id="response">


    </div>
    <?php echo $this->include('Layout/_mensagens'); ?>



    <div class="row">

        <div class="col-lg-9">
            <div class="card shadow radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ms-3 " style="padding-right: 20px;">
                            <h5 class="mt-0 text-warning">Concorra a prêmios incríveis!</h5>
                            <p class="mb-0">Indique o Dreamfest para seus amigos usando seu link personalizado, e ganhe <strong>Dreamcoins</strong> a cada ingresso comprado pelos seus amigos! Ao alcançar marcos específicos, também serão geradas conquistas exclusivas!
                                <strong>Os 3 Dreamers que tiverem o maior</strong> número de indicações serão <strong class="text-bg-warning">premiados</strong> no palco principal do evento!
                            </p>
                            <hr>
                            <span class="mb-3 mt-2 text-muted font-weight-bold" style="font-size: 12px;">Seu link para convidar seus amigos é:</span><br>
                            <div class="row">
                                <div class="col-lg-9">
                                    <input id="input" type="text" class="form-control form-control-lg mb-3" style="border:none" value="<?= site_url('/evento/dreamfest_23?convite=' . $convite) ?>">

                                </div>
                                <div class="col-lg-3">
                                    <button id="execCopy" class="btn btn-primary btn-lg btn-block"><i class="fadeIn animated bx bx-copy"></i> Copiar link</button>
                                </div>
                                <script>
                                    // Type 1
                                    document.getElementById('execCopy').addEventListener('click', execCopy);

                                    function execCopy() {
                                        document.querySelector("#input").select();
                                        document.execCommand("copy");
                                    }
                                </script>
                            </div>
                            <hr>
                            <center>
                                <p class="font-20">Você acumulou <span class="text-bg-warning rounded-4" style="padding: 4px;"><strong><?= $indicacoes ?></strong></span> indicações válidas!</p>
                            </center>
                        </div>

                        <hr>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-13">
                    <div class="card shadow radius-10">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5> Cashback</h5>

                                </div>
                                <div class="col-lg-2 d-grid">
                                    <a href="javascript:;" class="btn btn-sm btn-outline-dark mb-3 " style="margin-left: -10px">Todos</a>
                                </div>

                            </div>
                            <div class="row" style="padding: 10px;">
                                <div class="col-lg-2 col-sm-6 shadow">
                                    <img src="https://www.starbucksathome.com/br/static/version1672267160/frontend/Webjump/starbucks/pt_BR/images/logo.svg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="https://www.awin1.com/cread.php?awinmid=28175&awinaffid=1212984&clickref=<?= $id ?>&ued=https%3A%2F%2Fwww.starbucksathome.com%2Fbr%2F" target="_blank" class="btn btn-sm btn-dark">Resgatar 2,5% de cashback</a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 shadow">
                                    <img src="https://ui.awin.com/images/upload/merchant/profile/30511.png?1654709988" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="https://www.awin1.com/cread.php?awinmid=28175&awinaffid=1212984&clickref=<?= $id ?>&ued=https%3A%2F%2Fwww.legombrinq.com.br%2F" target="_blank" class="btn btn-sm btn-dark">Resgatar 2,5% de cashback</a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 shadow">
                                    <img src="data:image/png;base64,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" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="https://www.awin1.com/cread.php?awinmid=28175&awinaffid=1212984&clickref=<?= $id ?>&ued=https%3A%2F%2Fwww.kanui.com.br%2F" target="_blank" class="btn btn-sm btn-dark">Resgatar 3,0% de cashback</a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 shadow">
                                    <img src="https://play-lh.googleusercontent.com/oKJmywken2GtkjM8DxpgfbWmdsv83a0FA7whzBBYtwjSmJcfdqozaekOva8VUwyYOt5V" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="https://www.awin1.com/cread.php?awinmid=17697&awinaffid=1212984&clickref=<?= $id ?>&ued=https%3A%2F%2Fwww.dafiti.com.br%2F" target="_blank" class="btn btn-sm btn-dark">Resgatar 3,0% de cashback</a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 shadow">
                                    <img src="data:image/png;base64,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" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="https://www.awin1.com/cread.php?awinmid=17817&awinaffid=1212984&clickref=<?= $id ?>&ued=http%3A%2F%2Fqueropassagem.com.br" target="_blank" class="btn btn-sm btn-dark">Resgatar 2,5% de cashback</a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 shadow">
                                    <img src="https://ui.awin.com/images/upload/merchant/profile/24644.png?1629212838" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="https://www.awin1.com/cread.php?awinmid=24644&awinaffid=1212984&clickref=<?= $id ?>&ued=https%3A%2F%2Fwww.fiever.com.br%2F" target="_blank" class="btn btn-sm btn-dark">Resgatar 3,5% de cashback</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class="card shadow radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">Eventos</h5>
                            <hr>
                        </div>

                    </div>
                    <span class="mb-3 mt-2 text-muted" style="font-size: 10px; padding: 10px !important">Eventos produzidos pela MundoDream</span><br>
                    <div class="card bg-dark shadow radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mt-0 ">Dreamfest - Mega Festival Geek</h5>
                                    <p class="mb-0 text-muted">10* e 11 de Junho de 2023 - Centro de eventos da PUCRS<br>
                                        Porto Alegre - RS</p>
                                </div>
                                <div class="d-grid" style="padding: 10px;">
                                    <?php if (usuario_logado()->is_membro) : ?>
                                        <?php if ($temingresso != 0) : ?>
                                            <a href="<?= site_url('/checkout/geraingressomembro/9') ?>" class="btn btn-secondary shadow disabled">Você já realizou checkin</a>
                                        <?php else : ?>
                                            <a href="<?= site_url('/checkout/geraingressomembro/9') ?>" class="btn btn-primary shadow">Realizar check-in <span class=" badge rounded-pill bg-danger">Liberado!</span></a>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="<?= site_url('/carrinho') ?>" target="_blank" class="btn btn-primary shadow ">COMPRAR INGRESSOS</a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="mb-3 mt-2 text-muted" style="font-size: 10px; padding: 10px !important">Eventos parceiros</span><br>
                    <div class="card bg-dark shadow radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mt-0 ">Sensei Party - CarnaSensei</h5>
                                    <p class="mb-0 text-muted">25 de fevereiro de 2023 - R. Guilherme Alves, 1547<br>
                                        Porto Alegre - RS</p>
                                </div>
                                <div class="d-grid" style="padding: 10px;">
                                    <?php if (usuario_logado()->is_membro) : ?>
                                        <a href="<?= site_url('/checkout/geraingressomembro/10') ?>" class="btn btn-warning shadow ">Realizar check-in</a>
                                    <?php else : ?>
                                        <p>Gratuidade liberada apenas para membros do DreamClube!<a href="<?= site_url('/carrinho?adicionar=4') ?>" target="_blank"> <strong> Virar membro</strong></a></p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3">
            <div class="card shadow bg-dark radius-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5> <img src="<?php echo site_url('recursos/img/dreamcoin.png'); ?>" alt="" class="rounded-circle" width="34" height="34">
                                Saldo da conta </h5>

                        </div>
                        <div class="row ">
                            <div class="col col-5">
                                <p class="mb-0 text-muted" style="font-size: 10px;">DREAMCOIN</p>
                                <h4 class="mb-0"><?php echo usuario_logado()->pontos; ?></h4>
                            </div>
                            <div class="col col-2">
                                <i class="bi bi-plus-lg text-muted" style="margin-left: -10px"></i>
                            </div>
                            <div class="col col-5">
                                <p class="mb-0 text-muted" style="font-size: 10px;">CASHBACK</p>
                                <h4 class="mb-0"><span style="font-size: 10px; margin-left: -20px"> R$ </span> <?php echo usuario_logado()->saldo; ?></h4>
                            </div>

                        </div><!--end row-->

                    </div>

                </div>
            </div>
            <?php if ($card == null) : ?>
                <div class="card shadow bg-dark radius-10">
                    <div class="card-body">
                        <h5>Seu DreamCard </h5>
                        Você ainda não solicitou o seu cartão de membro!
                    </div>
                    <div class="d-grid" style="padding: 10px;">
                        <a href="<?= site_url('/carrinho?adicionar=4') ?>" target="_blank" class="btn btn-primary">Solicitar cartão</a>
                    </div>
                </div>
            <?php else : ?>

                <div class="card shadow bg-purple radius-10">
                    <div class="card-body">
                        <h5>Seu DreamCard <span class="badge bg-success"><?= $card->status ?></span></h5>
                        <div class="d-flex align-items-center gap-3">
                            <div class="fs-1">
                                <i class="bi bi-credit-card-2-back-fill"></i>
                            </div>
                            <div class="">
                                <p class="mb-0 fs-6"><strong><?= $card->matricula ?></strong> </p>
                            </div>
                        </div>
                        <?php echo esc(usuario_logado()->nome); ?><br>
                        Expira em: <?= date("d/m/Y", strtotime($card->expiration)) ?>

                    </div>

                </div>
                <?php if ($card->status == 'Confecção') : ?>
                    <div class="col-lg-12">
                        <div class="row" style="padding-left: 20px; padding-right: 20px; padding-bottom: 20px; margin-top: -16px">
                            <a href="<?= site_url('/pedidos/recebercartao') ?>" class="btn btn-outline-danger bt-sm btn-block">Receber meu cartão em casa!</a>

                        </div>
                    </div>

                <?php elseif ($card->status == 'Enviado') : ?>
                    <div class="col-lg-12">
                        <div class="row" style="padding-left: 20px; padding-right: 20px; padding-bottom: 20px; margin-top: -16px">
                            <a href="https://melhorrastreio.com.br/rastreio/<?= $card->rastreio ?>" target="_blank" class="btn btn-outline-success bt-sm btn-block">Acompanhe a entrega</a>

                        </div>
                    </div>

                <?php elseif ($card->status == 'Preparando') : ?>
                    <div class="col-lg-12">
                        <div class="row" style="padding-left: 20px; padding-right: 20px; padding-bottom: 20px; margin-top: -16px">
                            <a href="<?= site_url('/pedidos/recebercartao') ?>" class="btn btn-outline-success bt-sm btn-block disabled">Aguardando rastreio</a>


                        </div>
                    </div>

                <?php endif; ?>
            <?php endif; ?>

            <div class="card shadow bg-dark radius-10">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5>Conquistas </h5>

                        </div>
                        <div class="col-lg-4">
                            <a href="javascript:;" class="btn btn-sm btn-outline-dark mb-3"></i>Todos</a>
                        </div>
                        <div class="row" style="margin: 5px;">
                            <?php if (usuario_logado()->is_membro) : ?>
                                <div class="col-3 font-35 shadow"> <i class=" bx bx-mouse-alt" style="color: #ffd700" title="Cadastro realizado"></i></div>
                                <div class="col-3 font-35 shadow"> <i class="bx bx-face" style="color: #ffd700" title="Pioneiro"></i></div>
                                <div class="col-3 font-35 shadow"> <i class="bx bx-crown" style="color: #ffd700" title="Premium"></i></div>
                            <?php else : ?>
                                <div class="col-3 font-35 shadow"> <i class=" bx bx-mouse-alt" style="color: #ffd700" title="Cadastro realizado"></i></div>
                            <?php endif; ?>


                        </div>
                    </div>

                </div>
            </div>
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