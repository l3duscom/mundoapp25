<!doctype html>
<html lang="en" class="dark-theme">

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-44FJHSWB33"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-44FJHSWB33');
    </script>

    <meta name="facebook-domain-verification" content="gd9jp802dz0kny6q3pji6wltw3q598" />

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P9B2HCD8');
    </script>
    <!-- End Google Tag Manager -->


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo site_url('recursos/theme/'); ?>images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="<?php echo site_url('recursos/theme/'); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?php echo site_url('recursos/theme/'); ?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>css/style.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="<?php echo site_url('recursos/theme'); ?>css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?php echo site_url('recursos/theme/'); ?>css/dark-theme.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>css/light-theme.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>css/semi-dark.css" rel="stylesheet" />
    <link href="<?php echo site_url('recursos/theme/'); ?>css/header-colors.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <a href="https://wa.me/5551993406154?text=Preciso%20de%20ajuda!" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
  z-index:1000;" target="_blank">
        <i style="margin-top:16px" class="fa fa-whatsapp"></i>
    </a>
    -->
    <script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/77fdf192-452c-453b-9bf5-fca1767024f5-loader.js"></script>

    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '393991432344364');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=393991432344364&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <title><?= env('LICENCED'); ?> - <?php echo $this->renderSection('titulo'); ?> </title>

    <?php echo $this->renderSection('estilos'); ?>
</head>

<body>

    <?php $imagem = usuario_logado()->imagem; ?>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3">
                    <i class="bi bi-list"></i>
                </div>

                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item search-toggle-icon">
                            <a class="nav-link" href="#">
                                <div class="">
                                    <i class="bi bi-search"></i>
                                </div>
                            </a>
                        </li>




                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">

                                <?php if (usuario_logado()->imagem == null) : ?>
                                    <img src="<?php echo site_url('recursos/img/usuario_sem_imagem.png'); ?>" alt="" class="user-img">
                                <?php else : ?>
                                    <img src=" <?php echo site_url("usuarios/imagem/$imagem"); ?>" alt="" class="user-img">
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">

                                            <?php if (usuario_logado()->imagem == null) : ?>
                                                <img src="<?php echo site_url('recursos/img/usuario_sem_imagem.png'); ?>" alt="" class="rounded-circle" width="54" height="54">
                                            <?php else : ?>
                                                <img src="<?php echo site_url("usuarios/imagem/$imagem"); ?>" alt="" class="rounded-circle" width="54" height="54">
                                            <?php endif; ?>
                                            <div class="ms-3">
                                                <h6 class="mb-0 dropdown-user-name"><?= usuario_logado()->nome ?></h6>
                                                <small class="mb-0 dropdown-user-designation text-secondary">
                                                    <?php if (usuario_logado()->is_membro) : ?>
                                                        PREMIUM <i class="bx bx-crown" style="color: #ffd700" title="Premium"></i>
                                                </small>
                                            <?php else : ?>
                                                <small class="mb-0 dropdown-user-designation text-secondary">FREE

                                                </small>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo site_url('usuarios/editarsenha'); ?>">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-person-fill"></i></div>
                                            <div class="ms-3"><span>Perfil</span></div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-lock-fill"></i></div>
                                            <div class="ms-3"><span>Logout</span></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="<?php echo site_url('recursos/theme/'); ?>images/logo-md.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <?php if (usuario_logado()->is_membro) : ?>
                        <h4 class="logo-text"><span style="color: #ffd700; font-size:10px; margin-left: -10px">PREMIUM</span></h4>

                    <?php elseif (usuario_logado()->is_admin) : ?>
                        <h4 class="logo-text"><span style="color: #ffd700; font-size:10px !important"></span>ADMIN</h4>
                    <?php else : ?>
                        <h4 class="logo-text"><span style="font-size:10px"></span>START</h4>
                    <?php endif; ?>
                </div>




                <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
                </div>
            </div>
            <!-- NAV CLI -->
            <ul class="metismenu" id="menu">

                <?php if (usuario_logado()->is_admin) : ?>
                    <li class="menu-label">ADMIN</li>
                    <li>
                        <a href="<?php echo site_url('/'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/clientes'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Clientes</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/ingressos/add'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Add Ingressos</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/pedidos/gerenciar'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Pedidos</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/eventos'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Eventos</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/concursos'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Concursos</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/usuarios'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Usuários</div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('/grupos'); ?>">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                            </div>
                            <div class="menu-title">Permissões</div>
                        </a>
                    </li>

                    <hr>

                <?php endif; ?>
                <li>
                    <a href="<?php echo site_url('console/dashboard'); ?>">
                        <div class="parent-icon"><i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <!-- Tab links 
                <li>
                    <a href="#" class="text-muted">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-game"></i>
                        </div>
                        <div class="menu-title">Missões</div>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="text-muted">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-diamond"></i>
                        </div>
                        <div class="menu-title">Conquistas</div>
                    </a>
                </li>
                -->
                <li>
                    <a href="<?php echo site_url('pedidos'); ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-detail"></i>
                        </div>
                        <div class="menu-title">Meus Pedidos </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('ingressos'); ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-purchase-tag-alt"></i>
                        </div>
                        <div class="menu-title">Meus Ingressos </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('console/meets'); ?>">
                        <div class="parent-icon"><i class='bx bx-camera'></i>
                        </div>
                        <div class="menu-title">Meus Meet & Greet <span class="badge bg-danger">novo</span></div>
                    </a>
                </li>
                <!--
                <li class="menu-label">BENEFÍCIOS</li>
                <li> <?php if (usuario_logado()->is_membro) : ?>
                        <a href="#" class="text-muted">
                            <div class="parent-icon"><i class="fadeIn animated bx bx-cart"></i>
                            </div>
                            <div class="menu-title">Lojas
                                <i class="fadeIn animated bx bx-crown align-middle text-muted" style="padding-left:10px" title="Membro Premium"></i>
                            </div>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo site_url('console/premium'); ?>" class="text-muted">
                            <div class="parent-icon"><i class="fadeIn animated bx bx-cart"></i>
                            </div>
                            <div class="menu-title">Lojas
                                <i class="fadeIn animated bx bx-crown align-middle" style="color: #ffd700; padding-left:10px" title="Seja Premium"></i>
                            </div>
                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if (usuario_logado()->is_membro) : ?>
                        <a href="#" class="text-muted">
                            <div class="parent-icon"><i class="fadeIn animated bx bx-dollar-circle"></i>
                            </div>
                            <div class="menu-title">Cashback
                                <i class="fadeIn animated bx bx-crown align-middle text-muted" style="padding-left:10px" title="Membro Premium"></i>
                            </div>
                        </a>
                    <?php else : ?>
                        <a href="#" class="text-muted">
                            <div class="parent-icon"><i class="fadeIn animated bx bx-dollar-circle"></i>
                            </div>
                            <div class="menu-title">Cashback
                                <i class="fadeIn animated bx bx-crown align-middle" style="color: #ffd700; padding-left:10px" title="Seja Premium"></i>
                            </div>
                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="#" class="text-muted">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-book-alt"></i>
                        </div>
                        <div class="menu-title">Cursos</div>
                    </a>
                </li>

                <li class="menu-label">EVENTOS</li>
                <li>
                    <a href="#" class="text-muted">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-calendar-check"></i>
                        </div>
                        <div class="menu-title"> Meus eventos</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="text-muted">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-calendar"></i>
                        </div>
                        <div class="menu-title">Eventos abertos</div>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo site_url('concursos/my'); ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-cube-alt"></i>
                        </div>
                        <div class="menu-title">Concursos
                        </div>
                    </a>
                </li>
                <li class="menu-label">EXTRAS</li>
                <li>
                    <a href="<?php echo site_url('usuarios/editarsenha'); ?>">
                        <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="menu-title">Alterar senha</div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('logout'); ?>">
                        <div class="parent-icon"><i class="bi bi-lock-fill"></i>
                        </div>
                        <div class="menu-title">Sair</div>
                    </a>
                </li>
                <li>

                </li>

            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">


            <?php echo $this->include('Layout/_mensagens'); ?>

            <?php echo $this->renderSection('conteudo'); ?>




        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <!--End Back To Top Button-->



    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src="<?php echo site_url('recursos/theme/'); ?>js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?php echo site_url('recursos/theme/'); ?>js/jquery.min.js"></script>
    <script src="<?php echo site_url('recursos/theme/'); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo site_url('recursos/theme/'); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?php echo site_url('recursos/theme/'); ?>plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?php echo site_url('recursos/theme/'); ?>js/pace.min.js"></script>

    <script src="<?php echo site_url('recursos/theme/'); ?>plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="<?php echo site_url('recursos/theme/'); ?>js/index2.js"></script>
    <!--app-->
    <script src="<?php echo site_url('recursos/theme/'); ?>js/app.js"></script>
    <script src="<?php echo site_url('recursos/'); ?>js/front.js"></script>

    <script>
        //new PerfectScrollbar(".best-product")
    </script>
    <?php echo $this->renderSection('scripts'); ?>


</body>

</html>