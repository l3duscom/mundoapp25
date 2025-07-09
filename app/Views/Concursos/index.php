<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<div class="row">


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Concursos</strong></div>

    </div>

    <!--end breadcrumb-->
    <div class="ms-auto">

    </div>


    <div class="row">
        <?php foreach ($concursos as $concurso) : ?>
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow radius-10">
                            <div class="card-body">

                                <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
                                    <div class="breadcrumb-title pe-3"><strong class="font-20"><?= $concurso->nome ?></strong></div>
                                    <div class="ps-3">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb mb-0 p-0">
                                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-calendar-star"></i></a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    <?= $concurso->nome_evento ?>

                                                </li>
                                            </ol>
                                        </nav>
                                    </div>

                                </div>
                                <div class="row">


                                    <hr class="mt-2">
                                    <div class="col-lg-4">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Código</p>

                                        <strong><?= $concurso->codigo ?></strong>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Júri</p>
                                        <strong><?= $concurso->juri ?> jurados</strong>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="mb-0 text-muted" style="font-size: 10px;">Status</p>
                                        <?php if ($concurso->ativo == 1) : ?>
                                            <strong><i class="fadeIn animated bx bx-circle" style="color: green; font-size: 18px;"></i> Ativo</strong>
                                        <?php else : ?>
                                            <strong><i class="fadeIn animated bx bx-circle" style="color: red;"></i> Inativo</strong>
                                        <?php endif ?>

                                    </div>


                                </div>
                                <hr class="mt-2">



                                <div class="col-lg-12">

                                    <a href="<?= site_url('/concursos/gerenciar/' . $concurso->id) ?>" class="btn btn-sm btn-primary mt-0 shadow">GERENCIAR CONCURSO / VOTAR</a>


                                </div>
                            </div>
                        </div>
                    </div>




                </div>




            <?php endforeach; ?>

            <hr>



            </div>


    </div>
</div>






<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<script type="text/javascript" src="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.js') ?>"></script>






<?php echo $this->endSection() ?>