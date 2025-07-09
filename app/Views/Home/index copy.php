<?php echo $this->extend('Layout/principal'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>


<span style="font-size: 20px; color: #333">Olá <strong><?php echo esc(usuario_logado()->nome); ?>,</strong> seja bem vindo de volta!</span>
<p style="font-size: 12px;">Licenciado para <strong><?= env('LICENCED'); ?></strong></p>

<div class="row">

    <div class="col-lg-12">
        <div class="block">
            Versão 3.<strong>2</strong>.0.1 liberada com sucesso!
        </div>
    </div>
</div>


<?php echo $this->endSection() ?>




<?php echo $this->section('scripts') ?>

<!-- Aqui coloco os scripts da view-->

<?php echo $this->endSection() ?>