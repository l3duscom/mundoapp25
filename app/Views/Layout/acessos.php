<!doctype html>
<html lang="en" class="ligth-theme">

<head>
    <script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/6639d235-fa2e-48ea-8c75-671781a1155d-loader.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-44FJHSWB33"></script>
    <!--<script src="https://kit.fontawesome.com/f5b74051e7.js" crossorigin="anonymous"></script>-->











    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo site_url('recursos/front/'); ?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo site_url('recursos/front/'); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?php echo site_url('recursos/'); ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>css/style.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- loader-->
    <link href="<?php echo site_url('recursos/theme'); ?>css/pace.min.css" rel="stylesheet" />
    <!--Theme Styles-->
    <link href="<?php echo site_url('recursos/front/'); ?>css/dark-theme.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>css/light-theme.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>css/semi-dark.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/front/'); ?>css/header-colors.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


    <title><?= env('LICENCED'); ?> - <?php echo $this->renderSection('titulo'); ?> </title>

    <?php echo $this->renderSection('estilos'); ?>
</head>

<body>




    <!--start content-->
    <main class="page-content">


        <?php echo $this->include('Layout/_mensagens'); ?>

        <?php echo $this->renderSection('conteudo'); ?>




    </main>








    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="<?php echo site_url('recursos/front/'); ?>js/bootstrap.bundle.min.js"></script>
    <!-- CDN JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"></script>
    <!--plugins-->
    <script src="<?php echo site_url('recursos/front/'); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo site_url('recursos/front/'); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo site_url('recursos/front/'); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo site_url('recursos/front/'); ?>js/pace.min.js"></script>

    <script src="<?php echo site_url('recursos/front/'); ?>plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="<?php echo site_url('recursos/front/'); ?>js/index2.js"></script>
    <!--app-->
    <script src="<?php echo site_url('recursos/front/'); ?>js/app.js"></script>
    <script src="<?php echo site_url('recursos/'); ?>js/front.js"></script>

    <script>
        //new PerfectScrollbar(".best-product")
    </script>

    <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    <?php echo $this->renderSection('scripts'); ?>


</body>

</html>