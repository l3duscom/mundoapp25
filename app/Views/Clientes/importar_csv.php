<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->
<style>
    .pace {
        -webkit-pointer-events: none;
        pointer-events: none;

        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .pace-inactive {
        display: none;
    }

    .pace .pace-progress {
        background: #8BB006;
        position: fixed;
        z-index: 2000;
        top: 0;
        right: 100%;
        width: 100%;
        height: 2px;
    }
</style>

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<script>
    function anima() {
        Pace.restart();
    }
</script>


<div class="row">

    <div class="col-lg-6">

        <div class="block">

            <div class="block-body">

                <!-- Exibirá os retornos do backend -->
                <div id="response">

                    <?php if (session()->has('message')) { ?>
                        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php } ?>
                    <?php $validation = \Config\Services::validation(); ?>
                </div>

                Importar CSV <strong></strong>
                <hr>

                <form action="<?= site_url('clientes/importCsv') ?>" method="post" enctype="multipart/form-data">

                    <input type="hidden" id="status" name="status" value="ABERTA">
                    <?= csrf_field() ?>
                    <div class="form-group mb-3">
                        <div class="mb-3">
                            <input type="file" name="file" class="form-control" id="file">
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="submit" name="submit" value="Importar" class="btn btn-dark" />
                    </div>
                </form>

            </div>



        </div> <!-- ./ block -->

    </div>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

<?php echo $this->endSection() ?>