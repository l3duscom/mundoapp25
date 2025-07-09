<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Mundo Dream | <?php echo $this->renderSection('titulo'); ?> </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>vendor/css-hamburgers/hamburgers.min.css">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Custom Font Icons CSS-->
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>css/util.css">
  <!-- Google fonts - Muli-->
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>css/main.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>vendor/select2/select2.min.css">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?php echo site_url('recursos/auth/'); ?>vendor/css-hamburgers/hamburgers.min.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="<?php echo site_url('recursos/auth/'); ?>images/icons/favicon.ico">
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

  <!-- Espaço reservado para renderizar os estilos de cada view  que estender esse layout -->
  <?php echo $this->renderSection('estilos'); ?>

</head>

<body>


  <!-- Espaço reservado para renderizar o conteúdo de cada view  que estender esse layout -->
  <?php echo $this->renderSection('conteudo'); ?>




  <!-- JavaScript files-->

  <!-- JavaScript files-->
  <script src="<?php echo site_url('recursos/auth/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?php echo site_url('recursos/auth/'); ?>vendor/bootstrap/js/popper.js"> </script>
  <script src="<?php echo site_url('recursos/auth/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo site_url('recursos/auth/'); ?>vendor/select2/select2.min.js"></script>
  <script src="<?php echo site_url('recursos/auth/'); ?>vendor/tilt/tilt.jquery.min.js"></script>
  <script>
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>

  <!-- Espaço reservado para renderizar os scripts de cada view que estender esse layout -->
  <?php echo $this->renderSection('scripts'); ?>

</body>

</html>