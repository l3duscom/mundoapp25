<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>



<div class="card rounded-4">
    <div class="card-body">
        <span style="font-size: 20px; ">Olá <strong><?php echo esc(usuario_logado()->nome); ?>,</strong> seja bem vindo de volta!</span>

    </div>

</div>

<?php foreach ($eventos as $evento) : ?>
    <?php if ($evento->ativo == 1) : ?>
                
            <div class="card rounded-4">
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="<?= site_url('home/evento/' . $evento->id) ?>" style="text-decoration: none; color: inherit;">
                            <?= $evento->nome ?>
                        </a>
                    </h3>
                     </div>
                </div>                                    
        <?php endif; ?>
<?php endforeach; ?>






    <?php echo $this->endSection() ?>




    <?php echo $this->section('scripts') ?>

    <!-- Aqui coloco os scripts da view-->

    <?php echo $this->endSection() ?>