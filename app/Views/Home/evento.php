<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>



<p style="padding-left: 20px;">
    <a class="btn btn-lg btn-dark" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="bi bi-eye-fill"></i>
    </a>
</p>
<div class="collapse" id="collapseExample">



    <div class="row row-cols-1 row-cols-lg-4 mt-5">
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0"><?= $total_ingressos; ?></h5>
                            <p class="mb-0">Ingressos</p>
                        </div>
                        <div class="fs-4">
                            R$ <?= number_format($valor_total[0]->total, 2, ',', '.') ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0"><?= $total_ingressos_hoje; ?></h5>
                            <p class="mb-0">Ingressos Hoje</p>
                        </div>
                        <div class="fs-4">
                            R$ <?= number_format($valor_hoje[0]->total, 2, ',', '.') ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0"><?= $total_ingressos_pendentes; ?></h5>
                            <p class="mb-0">Ingressos pendentes</p>
                        </div>
                        <div class="fs-4">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0"><?= $total_ingressos_cortesias; ?></h5>
                            <p class="mb-0">Cortesias</p>
                        </div>
                        <div class="fs-4">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!--end row-->
    <hr>
    <p class="mb-2" style="padding-left: 3px;">Ingressos por tipo:
    </p>
    <div class="row row-cols-1 row-cols-lg-4">
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0">Sábado</h5>
                        </div>
                        <div class="fs-4">
                            <?= $total_sabado; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0">Domingo</h5>
                        </div>
                        <div class="fs-4">
                            <?= $total_domingo; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0">EPIC PASS</h5>
                        </div>
                        <div class="fs-4">
                            <?= $total_epic; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0">VIP FULL</h5>
                        </div>
                        <div class="fs-4">
                            <?= $total_vip; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>



    <!-- /toogle #########################  -->











    <?php echo $this->endSection() ?>




    <?php echo $this->section('scripts') ?>

    <!-- Aqui coloco os scripts da view-->

    <?php echo $this->endSection() ?>