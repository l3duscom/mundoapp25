<?php echo $this->extend('Layout/externo'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>


<link rel="stylesheet" type="text/css" href="<?php echo site_url('recursos/vendor/datatable/datatables-combinado.min.css') ?>" />



<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<script type="text/javascript">
    setTimeout(function() {
        window.location.href = "<?= $url ?>"; /*******Dentro do = " ColeAqui.html"; vocês botam link da página de vocês .html *******/
    }, 3000);
</script><!--Fim /Script-->
<div class="row">
    <div class="col-lg-8">
        <div class="block">
            <div class="block-body">
                <div class="card shadow radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card shadow-none w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        <div class=" mt-5  d-flex align-items-center">

                                            <div class="spinner-border  d-flex align-items-center" style="width: 3rem; height: 3rem; justify-content: center;
align-items: center;" role="status"> <span class="visually-hidden">Loading...</span>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-0">
                            <div class="card border shadow-none w-100">
                                <div class="card-body">
                                    Lançamento oficial dia 6 de fevereiro às 20h
                                </div>
                            </div>
                        </div>







                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">


                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <h5 class="mb-0">Buscando grupo</h4>
                                    <p class="mb-0">Preparando seu desconto</p>
                            </div>
                            <div class="ms-auto fs-3 ">
                                <i class="fadeIn animated bx bx-whatsapp" style="font-size: 45px;"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 42%"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>



<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>






<?php echo $this->endSection() ?>