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
        <center>

          <h4 class="text-primary" style="padding-top:20px">
            Acesse sua conta
          </h4>
        </center>
        <hr>


        <?php echo form_open('/', ['id' => 'form', 'class' => 'form-validate']); ?>

        <div id="response">

        </div>


        <?php echo $this->include('Layout/_mensagens'); ?>
        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">

          <input id="login-username" class="input100" type="text" name="email" placeholder="Seu e-mail de acesso">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
          <input id="login-password" class="input100" type="password" name="password" placeholder="Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>

        <div class="container-login100-form-btn">
          <input id="btn-login" type="submit" class="login100-form-btn" value="Entrar">

        </div>
        <?php echo form_close(); ?>
        <hr>

        <div class="text-center " style="padding-top: 5px;">
          <a class="login100-form-btn" style="background-color: #666; font-size: 12px; heigth: 10px; !important" href="<?php echo site_url('esqueci'); ?>">
            Esqueceu a senha?
          </a>
        </div>

        <div class="text-center p-t-20">
          <span class="txt2">
            <p>Ainda não comprou os seus ingressos? <a href="https://dreamfest.com.br/ingressos" target="_blank"><strong>Compre o seu agora mesmo</strong></a> </p>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>








<?php echo $this->endSection() ?>



<?php echo $this->section('scripts') ?>

<!-- Aqui coloco os scripts da view-->

<script>
  $(document).ready(function() {

    $("#form").on('submit', function(e) {


      e.preventDefault();


      $.ajax({

        type: 'POST',
        url: '<?php echo site_url('login/criar'); ?>',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {

          $("#response").html('');
          $("#btn-login").val('Por favor aguarde...');

        },
        success: function(response) {

          $("#btn-login").val('Entrar');
          $("#btn-login").removeAttr("disabled");

          $('[name=csrf_ordem]').val(response.token);


          if (!response.erro) {

            // Tudo certo com a atualização do usuário
            // Podemos agora redirecioná-lo tranquilamente

            window.location.href = "<?php echo site_url(); ?>" + response.redirect;


          }

          if (response.erro) {

            // Exitem erros de validação


            $("#response").html('<div class="alert alert-danger">' + response.erro + '</div>');


            if (response.erros_model) {


              $.each(response.erros_model, function(key, value) {

                $("#response").append('<ul class="list-unstyled"><li class="text-danger">' + value + '</li></ul>');

              });

            }

          }

        },
        error: function() {

          alert('Não foi possível procesar a solicitação. Por favor entre em contato com o suporte técnico.');
          $("#btn-login").val('Entrar');
          $("#btn-login").removeAttr("disabled");

        }



      });


    });


    $("#form").submit(function() {

      $(this).find(":submit").attr('disabled', 'disabled');

    });


  });
</script>


<?php echo $this->endSection() ?>