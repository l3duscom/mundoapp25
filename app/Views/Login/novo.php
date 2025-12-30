<?php echo $this->extend('Layout/Autenticacao/principal_autenticacao'); ?>

<?php echo $this->section('titulo') ?> <?php echo $titulo; ?> <?php echo $this->endSection() ?>

<?php echo $this->section('estilos') ?>
<link rel="stylesheet" href="<?php echo site_url('recursos/auth/css/login-modern.css'); ?>">
<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>

<div class="login-page">
  <!-- Background Fullscreen -->
  <div class="bg-container">
    <img src="<?php echo $background; ?>" alt="Background" class="bg-image" loading="eager">
  </div>
  <div class="bg-overlay"></div>

  <!-- Card de Login Glassmorphism -->
  <div class="glass-card">
    <div class="brand-section">
      <h1 class="brand-title">Mundo Dream</h1>
      <p class="brand-subtitle">Acesse sua conta para continuar</p>
    </div>

    <?php echo form_open('/', ['id' => 'form', 'class' => 'form-modern']); ?>

    <div id="response"></div>

    <?php if (session()->getFlashdata('sucesso')): ?>
      <div class="alert-modern alert-success-modern">
        <i class="fa fa-check-circle"></i> <?php echo session()->getFlashdata('sucesso'); ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('erro')): ?>
      <div class="alert-modern alert-danger-modern">
        <i class="fa fa-exclamation-circle"></i> <?php echo session()->getFlashdata('erro'); ?>
      </div>
    <?php endif; ?>

    <div class="input-group">
      <input type="email" id="login-username" name="email" class="modern-input" placeholder="Seu e-mail" required autocomplete="email">
      <i class="fa fa-envelope input-icon"></i>
    </div>

    <div class="input-group">
      <input type="password" id="login-password" name="password" class="modern-input" placeholder="Sua senha" required autocomplete="current-password">
      <i class="fa fa-lock input-icon"></i>
    </div>

    <button type="submit" id="btn-login" class="btn-primary-modern">
      <span class="btn-text">Entrar</span>
    </button>

    <?php echo form_close(); ?>

    <div class="divider">
      <span>ou</span>
    </div>

    <a href="<?php echo site_url('esqueci'); ?>" class="btn-secondary-modern">
      <i class="fa fa-key"></i> Esqueceu a senha?
    </a>

    <div class="form-footer">
      <p style="color: rgba(255,255,255,0.8); font-size: 13px; margin-top: 16px;">
        Ainda não tem conta? 
        <a href="https://dreamfest.com.br/ingressos" target="_blank" class="form-link" style="font-weight: 600;">
          Compre seu ingresso
        </a>
      </p>
    </div>
  </div>

  <!-- Bottom Section - Eventos & Promoções -->
  <?php if (!empty($eventos)): ?>
  <div class="bottom-section">
    <div class="bottom-content">
      
      <?php if (!empty($eventos)): ?>
      <div class="events-section">
        <h3 class="section-title">
          <i class="fa fa-calendar-check"></i> Próximos Eventos
        </h3>
        <div class="events-carousel">
          <?php foreach ($eventos as $evento): ?>
          <a href="<?php echo site_url('ingressos/' . $evento->slug); ?>" class="event-card" style="text-decoration: none;">
            <?php if (!empty($evento->cover)): ?>
            <img src="<?php echo site_url('uploads/eventos/' . $evento->cover); ?>" alt="<?php echo esc($evento->nome); ?>" class="event-image">
            <?php else: ?>
            <div class="event-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa fa-ticket" style="font-size: 40px; color: rgba(255,255,255,0.5);"></i>
            </div>
            <?php endif; ?>
            <div class="event-info">
              <h4 class="event-name"><?php echo esc($evento->nome); ?></h4>
              <p class="event-date">
                <i class="fa fa-calendar"></i>
                <?php echo date('d/m/Y', strtotime($evento->data_inicio)); ?>
              </p>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
  <?php endif; ?>

</div>

<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<script>
$(document).ready(function() {

  $("#form").on('submit', function(e) {
    e.preventDefault();

    var $btn = $("#btn-login");
    var $btnText = $btn.find('.btn-text');
    var originalText = $btnText.text();

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
        $btn.addClass('btn-loading');
        $btnText.text('Verificando...');
        $btn.prop('disabled', true);
      },
      success: function(response) {
        $btn.removeClass('btn-loading');
        $btnText.text(originalText);
        $btn.prop('disabled', false);

        $('[name=csrf_ordem]').val(response.token);

        if (!response.erro) {
          // Login bem-sucedido - redirecionar
          $btnText.text('Redirecionando...');
          $btn.addClass('btn-loading');
          window.location.href = "<?php echo site_url(); ?>" + response.redirect;
        }

        if (response.erro) {
          // Exibir erros
          $("#response").html('<div class="alert-modern alert-danger-modern"><i class="fa fa-exclamation-circle"></i> ' + response.erro + '</div>');

          if (response.erros_model) {
            $.each(response.erros_model, function(key, value) {
              $("#response").append('<div class="alert-modern alert-danger-modern" style="margin-top: 8px;"><i class="fa fa-times-circle"></i> ' + value + '</div>');
            });
          }
        }
      },
      error: function() {
        alert('Não foi possível processar a solicitação. Por favor entre em contato com o suporte técnico.');
        $btn.removeClass('btn-loading');
        $btnText.text(originalText);
        $btn.prop('disabled', false);
      }
    });
  });

  // Animação de entrada para eventos (scroll horizontal com mouse wheel)
  $('.events-carousel').on('wheel', function(e) {
    if (e.originalEvent.deltaY !== 0) {
      e.preventDefault();
      this.scrollLeft += e.originalEvent.deltaY;
    }
  });

  // Tooltip para cupons
  $('.promo-badge').on('click', function() {
    var codigo = $(this).attr('title').replace('Use o código: ', '');
    
    // Copiar para clipboard
    navigator.clipboard.writeText(codigo).then(function() {
      var $badge = $(this);
      var originalHtml = $badge.html();
      $badge.html('<i class="fa fa-check"></i> Código copiado!');
      setTimeout(function() {
        $badge.html(originalHtml);
      }, 2000);
    }.bind(this));
  });

});
</script>
<?php echo $this->endSection() ?>