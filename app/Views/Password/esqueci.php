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
          Informe seu e-mail de acesso para iniciarmos a recuperação da senha.
        </span>

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



        <div class="container-login100-form-btn">
          <input id="btn-login" type="submit" class="login100-form-btn" value="Começar">

        </div>
        <?php echo form_close(); ?>
        <div class="text-center ">
          <span class="txt1">
            Lembrou
          </span>
          <a class="txt2" href="<?php echo site_url('login'); ?>">
            a sua senha de acesso?
          </a>
        </div>

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

<!-- Aqui coloco os scripts da view-->

<script>
  $(document).ready(function() {

    $("#form").on('submit', function(e) {


      e.preventDefault();


      $.ajax({

        type: 'POST',
        url: '<?php echo site_url('password/precessaesqueci'); ?>',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {

          $("#response").html('');
          $("#btn-esqueci").val('Por favor aguarde...');

        },
        success: function(response) {

          $("#btn-esqueci").val('Começar');
          $("#btn-esqueci").removeAttr("disabled");

          $('[name=csrf_ordem]').val(response.token);


          if (!response.erro) {

            // Tudo certo com a atualização do usuário
            // Podemos agora redirecioná-lo tranquilamente

            window.location.href = "<?php echo site_url("password/resetenviado"); ?>";


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
          $("#btn-esqueci").val('Começar');
          $("#btn-esqueci").removeAttr("disabled");

        }



      });


    });


    $("#form").submit(function() {

      $(this).find(":submit").attr('disabled', 'disabled');

    });


  });
</script>


<?php echo $this->endSection() ?>