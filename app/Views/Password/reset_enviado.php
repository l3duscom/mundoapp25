<?php echo $this->extend('Layout/Autenticacao/principal_autenticacao'); ?>


<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>


<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os estilos da view-->

<?php echo $this->endSection() ?>



<?php echo $this->section('conteudo') ?>

<!-- Aqui coloco o conteudo da view-->

<div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo site_url('recursos/auth/images/img-01.png'); ?>" alt="IMG">
      </div>


      <div class="login100-form validate-form">
        <span class="login100-form-title">
          <?php echo $titulo; ?>
        </span>
        <center>
          <p>Não deixe de confefir a caixa de span.</p>
        </center>






        <div class="text-center p-t-20">
          <span class="txt2">
            <p>Licenciado para MundoDream</p>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>



<?php echo $this->endSection() ?>



<?php echo $this->section('scripts') ?>



<?php echo $this->endSection() ?>