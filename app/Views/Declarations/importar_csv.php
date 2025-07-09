<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


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

                Importar DICI <strong><?= $declaration ?></strong>
                <hr>
                <?php if ($id == 1) : ?>
                    <form action="<?= site_url('declarations/importCsvDiciScm') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
                        <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
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
                <?php endif; ?>
                <?php if ($id == 2) : ?>
                    <form action="<?= site_url('declarations/importCsvDiciScmTrim') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
                        <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
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
                <?php endif; ?>
                <?php if ($id == 3) : ?>
                    <form action="<?= site_url('declarations/importCsvDiciStfc') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
                        <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
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
                <?php endif; ?>
                <?php if ($id == 4) : ?>
                    <form action="<?= site_url('declarations/importCsvDiciTvpa') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
                        <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
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
                <?php endif; ?>
                <?php if ($id == 5) : ?>
                    <form action="<?= site_url('declarations/importCsvFust') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
                        <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
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
                <?php endif; ?>

            </div>



        </div> <!-- ./ block -->

    </div>


</div>


<?php echo $this->endSection() ?>