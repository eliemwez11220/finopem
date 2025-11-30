<?php

$uri = service('uri');
// Disable throwing exceptions
$uri->setSilent();
$totalSegments = $uri->getTotalSegments();
$urlParam1 = ($totalSegments >= 0) ? $uri->getSegment(1) : '';
$urlParam2 = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$urlParam3 = ($totalSegments >= 3) ? $uri->getSegment(3) : '';

$urlParams = $uri->getSegments();
$urlCurrent = current_url(true);//(uri_string());

$request = \Config\Services::request();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- FOR XSS ATTACKS -->
    <meta charset="utf-8">
    <?= csrf_meta() ?>

    <!--    <meta name="csrf_token_name" content="<-?= csrf_token() ?>">
    <meta name="csrf_token" content="<-?= csrf_hash() ?>"> -->
    <!-- Locale -->
    <!-- To the Future  Meta Tags -->
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($urlParam1 == "rapport"): ?>
    <title>Reporting - School Management</title>
    <?php else: ?>
    <title> <?= (isset($title)) ? $title : ' Tableau de bord '; ?> | finopem</title>
    <?php endif; ?>
    <meta name="description"
        content="finopem est une solution logicielle de gestion scolaire, conçue pour les établissements scolaires basés en RDC. Elle a été développée par Ditotase et est disponible en version web et mobile.">
    <meta name="keywords"
        content="finopem, gestion scolaire, gestion des inscriptions, application scolaire, application de formation, Ecole, Enseignement, Formation, Education, Etablissement scolaire, Outils pedagogiques">

    <meta name="author" content="Ditotase">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#287dd0">
    <meta name="msapplication-TileColor" content="#287dd0">
    <meta name="msapplication-TileImage" content="<?= base_url('public/img/192x192.png'); ?>">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-title" content="finopem" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#287dd0" />

    <link rel="icon" type="image/png" href="<?= base_url('public/img/favicon.png'); ?>" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?= base_url('public/favicon.ico'); ?>" />
    <link rel="shortcut icon" href="<?= base_url('public/img/favicon.svg'); ?>" />
    <link rel="apple-touch-icon" href="<?= base_url('public/img/apple-touch-icon.png'); ?>" sizes="180x180" />
    <!-- ========== All CSS files linkup ========= -->
    <!-- Font Awesome -->
    <link rel="preload" as="style" onload="this.rel='stylesheet'"
        href="<?= base_url('public/vendors/fontawesome/css/all.min.css'); ?>">
    <!-- Select2 Library-->
    <link rel="stylesheet" href="<?= base_url('public/vendors/select2/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/vendors/select2/css/select2-bootstrap4.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <!-- toastify Alert -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/toastify/toastify.min.css'); ?>" />
    <!-- DataTables  -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/datatables/datatables.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/vendors/datatables/buttons.datatables.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/vendors/summernote/summernote-bs4.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/jquery/jqueryui.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/vendors/adminlte/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/main-styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/app-styles.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/translate.css'); ?>">
    <link rel="manifest" href="<?= base_url('public/wpa/manifest.json'); ?>" />

    <style>
    @media print {
        @page {
            size: A4 <?=(isset($orientation) ? $orientation : "portrait") ?>;
        }
    }

    #ajax_reporting option:disabled {
        display: none !important;
    }

    select option:disabled {
        display: none !important;
    }
    </style>
</head>


<body
    class="hold-transition <?= ($urlParam1 == 'payments' or $urlParam1 == 'reporting' or $urlParam1 == 'payments-bills') ? 'sidebar-collapse' : 'sidebar-mini' ?> layout-fixed">
    <div class="wrapper" id="print_area">
        <!-- Navbar navbar-white navbar-light elevation-4-->
        <nav class="main-header navbar navbar-expand bg-navbar">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link">
                        <span><i class="fa fa-question-circle"></i></span>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                        <li><a href="#" class="dropdown-item">Documentation</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="#" class="dropdown-item">Aide en ligne</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="#" class="dropdown-item">Suggestions</a></li>
                    </ul>
                </li> -->
                <li class="nav-item <?= checkModuleAccess('search'); ?>">
                    <a href="#" class="nav-link d-none d-md-block" data-toggle="collapse"
                        data-target="#search-input-box">
                        <i class="fa fa-search"></i>
                    </a>
                </li>

                <li class="nav-item <?= checkModuleAccess('payments'); ?>">
                    <a href="<?= base_url('payments'); ?>"
                        class="d-none d-md-block btn btn-outline-primary nav-link <?= ($urlParam1 == 'payments') ? 'active' : '' ?>">
                        <span class="text-white font-weight-bold" data-toggle="tooltip" data-placement="top"
                            title="Perception frais">
                            <i class="fas fa-hand-holding-usd fa-lg"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= checkModuleAccess('bills'); ?>">
                    <a href="<?= base_url('payments-bills'); ?>"
                        class="d-none d-md-block nav-link <?= ($urlParam1 == 'payments-bills') ? 'btn btn-primary' : '' ?>">
                        <span class="text-white font-weight-bold" data-toggle="tooltip" data-placement="top"
                            title="Historique paiements">
                            <i class="fas fa-donate fa-lg"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= checkModuleAccess('inscription'); ?>">
                    <a href="<?= base_url('student/registration'); ?>"
                        class="d-none d-md-block btn btn-outline-primary nav-link <?= ($urlParam2 == 'registration') ? 'active' : '' ?>">
                        <span class="text-white font-weight-bold" data-toggle="tooltip" data-placement="top"
                            title="Inscription rapide">
                            <i class="fas fa-user-edit fa-lg"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= checkModuleAccess(null, 'reporting'); ?>">
                    <a href="<?= base_url('reporting'); ?>"
                        class="d-none d-md-block nav-link <?= ($urlParam1 == 'reporting') ? 'btn btn-primary' : '' ?>">
                        <span class="text-white font-weight-bold" data-toggle="tooltip" data-placement="top"
                            title="Edition rapports">
                            <i class="fas fa-print fa-lg"></i>
                        </span>
                    </a>
                </li>
                <?php if (session()->get('yearstarted')): ?>
                <li class="nav-item d-none d-md-block">
                    <a href="<?= base_url('yearly'); ?>"
                        class="nav-link <?= ((session()->get('profile') == 'student')) ? 'disabled':'' ?>">
                        <span class="text-white font-weight-bold" data-toggle="tooltip" data-placement="top"
                            title="Cliquer pour changer l'année académique">
                            <?= session()->get('yearstarted'); ?>-<?= session()->get('yearclosing'); ?>
                            <i
                                class="fa fa-<?= (session()->get('yearstatus') == 'actif') ? 'unlock text-success' : 'lock text-danger' ?>"></i>
                        </span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                <button id="btn-refresh" class="nav-link btn btn-sm btn-outline-danger">
                    <i class="fas fa-sync"></i></button>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php if (session()->has('isLoggedIn')): ?>
                <li
                    class="d-none d-md-block nav-item mr-4 position-relative <?= checkModuleAccess(null, 'messaging'); ?>">
                    <a href="<?= base_url('messages-validity'); ?>" class="btn btn-outline-light nav-link"
                        data-toggle="tooltip" data-placement="bottom" title="SMS Restants">
                        <i class="fas fa-comment"></i>
                        <span
                            class="position-absolute start-100 translate-middle badge rounded-pill bg-primary fw-bold">
                            <?= (session()->has('schoolsmscount')) ? session()->get('schoolsmscount') : 0; ?>
                        </span>
                    </a>
                </li>
                <li
                    class=" d-none d-md-block nav-item mr-2 position-relative <?= checkModuleAccess(feature: 'notifications'); ?>">
                    <a href="<?= base_url('notifications'); ?>" class="btn btn-outline-light nav-link"
                        data-toggle="tooltip" data-placement="bottom" title="Notifications non lues">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger fw-bold">
                            <?= (session()->has('notifications')) ? session()->get('notifications') : 0; ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a class="btn btn-outline-light nav-link" data-toggle="collapse" data-target="#offcanvas_help_users"
                        href="#" role="button" id="btn_offcanvas_help_users" aria-controls="offcanvas_help_users"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-question-circle fa-lg"></i>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light nav-link"
                        onclick="return confirm ('Voulez-vous vraiment quitter cette application ?');"
                        data-toggle="tooltip" data-placement="bottom" title="Fermer l'application">
                        <i class="text-danger fa fa-power-off fa-lg"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"
                        data-toggle="tooltip" data-placement="bottom" title="Paramètres du profil">

                        <img src="<?= (session()->has('avatar')) ? base_url('public/uploads/images/' . session()->get('avatar')) : base_url('public/img/logo/favicon.png'); ?>"
                            alt="..." class="avatar avatar-xs" />

                        <span class="text-uppercase font-weight-bold d-none d-md-inline">
                            <?= trim(session()->get('username')); ?>
                        </span><i class="right fas fa-angle-down"></i>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="collapse" id="search-input-box">
            <div class="container">
                <form id="formSearchAdvanced" method="post" action="<?= base_url('search'); ?>">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <div class="d-inline">
                                <div class="input-group">
                                    <input class="form-control form-control-lg" type="search" name="query"
                                        id="student-search"
                                        placeholder="Saisissez le nom ou le numéro matricule de l'élève"
                                        aria-label="Search" autofocus
                                        style="border-top-left-radius: 100px!important; border-bottom-left-radius: 100px!important;">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-lg" type="submit"
                                            style="border-top-right-radius: 100px!important; border-bottom-right-radius: 100px!important;">
                                            <i class="fas fa-search">Valider</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Sidebar Container -dark-primary nav-flat fixed-sidebar nav-child-indent nav-compact nav-flat  nav-legacy-->
        <aside
            class="main-sidebar sidebar-mini text-sm  fixed-sidebar nav-child-indent nav-compact  sidebar-no-expand bg-sidebar">
            <!-- Avatar brand -->
            <div class="bg-light brand-link mb-2 text-center">
                <?php  $sess_school_logo = (session()->has('schoollogo')) ? session()->get('schoollogo') : ''; ?>
                <?php  $school_logo = base_url('public/uploads/images/'.$sess_school_logo); ?>
                <?php  $default_logo = base_url('public/img/favicon.png'); ?>
                <a href="<?= base_url(); ?>" class="">
                <img src="<?= (!empty($sess_school_logo)) ? $school_logo: $default_logo; ?>" alt="..."
                class="avatar avatar-sm" />
                    <span class="badge bg-primary rounded-circle py-3 p-3 text-uppercase font-weight-bold border border-danger">
                    
                        <?php $schoolfname = (session()->has('schoolname') ) ? session()->get('schoolname'): 'Standard License'; ?>
                        <?= (!empty($schoolfname)) ? character_limiter($schoolfname, 20) : 'STANDARD'; ?>
                        - finopem 
                    </span>
                </a>
            </div>

            <!-- Sidebar -->
            <div class="sidebar mb-5">
                <!-- Sidebar Menu -->
                <nav class="mb-5">
                    <ul class="nav nav-pills nav-sidebar flex-column mb-5" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <?php if (! session()->has('isLoggedIn')) { ?>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Accueil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('login'); ?>"
                                class="nav-link  <?= ($urlParam1 == 'login') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Connexion</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('signup'); ?>"
                                class="nav-link  <?= ($urlParam1 == 'signup') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>Inscription</p>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if((session()->get('profile') == 'student')) { ?>
                        <li class="nav-item">
                            <a href="<?= base_url('guest/student/account'); ?>"
                                class="nav-link <?= ($urlParam3 == 'account') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Dossiers étudiants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('guest/student/courses'); ?>"
                                class="nav-link <?= ($urlParam3 == 'courses') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>Horaires de cours</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('guest/student/parcours'); ?>"
                                class="nav-link <?= ($urlParam3 == 'parcours') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Parcours Académiques</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('guest/student/results'); ?>"
                                class="nav-link <?= ($urlParam3 == 'results') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>Résultats périodiques</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('guest/student/messages'); ?>"
                                class="nav-link <?= ($urlParam3 == 'messages') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Communication</p>
                            </a>
                        </li>


                        <?php }elseif (session()->has('isCustomerLoggedIn')){ ?>
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Vue d'ensemble
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('admincustomer/dashboard'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'dashboard') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-tachometer-alt ml-3"></i>
                                        <p>
                                            Tableau de bord
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('admincustomer/schools'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'schools') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-bookmark ml-3"></i>
                                        <p>
                                            Etablissements
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('admincustomer/finances'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'finances') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-donate ml-3"></i>
                                        <p>
                                            Finances
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admincustomer/students'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'students') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-users ml-3"></i>
                                        <p>
                                            Inscriptions
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admincustomer/statistics'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'statistics') ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-chart-pie ml-3"></i>
                                        <p>
                                            Statistiques
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } else{ ?>
                        <?php if (session()->has('schoolname')): ?>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'overview'); ?> <?= ($urlParam1 == 'dashboard' or $urlParam1 == 'databases' or $urlParam1 == 'school-infosheet') ? 'menu-open' : '' ?>">
                            <a href="#"
                                class="nav-link <?= ($urlParam1 == 'dashboard' or $urlParam1 == 'databases' or $urlParam1 == 'school-infosheet') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Vue d'ensemble
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('dashboard'); ?>">
                                    <a href="<?= base_url('dashboard'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'dashboard') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-tachometer-alt ml-3"></i>
                                        <p>
                                            Tableau de bord
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess(feature: 'infosheet'); ?>">
                                    <a href="<?= base_url('school-infosheet'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'school-infosheet') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-bookmark ml-3"></i>
                                        <p>
                                            Fiche établissement
                                        </p>
                                    </a>
                                </li>
                                <li
                                    class="nav-item <?= (session()->get('profile') == 'sysadmin') ? '' : 'd-none'; ?> <?= checkModuleAccess('databases'); ?>">
                                    <a href="<?= base_url('databases'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'databases') ? 'active' : '' ?>">

                                        <i class="nav-icon fas fa-database ml-3"></i>
                                        <p>
                                            Sauvegarde données
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'finances'); ?> <?= ($urlParam3 == 'payment' or ($urlParam1 == 'payments-bills') or ($urlParam1 == 'payments')) ? 'menu-open' : '' ?>">
                            <a href="#"
                                class="nav-link <?= ($urlParam1 == 'payments'or ($urlParam1 == 'payment') or ($urlParam1 == 'payments-bills')) ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>
                                    Gestion paiements
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                               
                                <li class="nav-item <?= checkModuleAccess('payments'); ?>">
                                    <a href="<?= base_url('payments'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'payments' or ($urlParam1 == 'payment')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Perception frais</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('payments'); ?>">
                                    <a href="<?= base_url('payclearance'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'payclearances' or ($urlParam1 == 'payclearance')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Apurement paiements</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('bills'); ?>">
                                    <a href="<?= base_url('payments-bills'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'payments-bills') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>
                                            Reçus paiements
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview hidden <?= checkModuleAccess(null, 'students'); ?> <?= ($urlParam1 == 'student') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'student') ? 'active' : '' ?>">
                                <i class="nav-icon fa fa-folder-open"></i>
                                <p>
                                    Dossiers étudiants
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('inscription'); ?>">
                                    <a href="<?= base_url('student/registration'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'registration') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Inscription</p>
                                        <span class="badge badge-success right small">Nouvelle</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('inscription'); ?>">
                                    <a href="<?= base_url('student/oldregistration'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'oldregistration') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Réinscription</p>
                                        <span class="badge badge-primary right small">Ancien</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess(feature: 'registers'); ?>">
                                    <a href="<?= base_url('student/listing'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'listing') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Registre des étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('basculement'); ?>">
                                    <a href="<?= base_url('student/basculement'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'basculement') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Basculement étudiants</p>
                                        <span class="badge badge-info right small">Annuel</span>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('parents'); ?>">
                                    <a href="<?= base_url('student/parents'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'parents') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Contacts étudiants</p>
                                        <span class="badge badge-success right small">Fiches</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('parcours'); ?>">
                                    <a href="<?= base_url('student/parcours'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'parcours') ? 'active' : '' ?>">

                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>
                                            Parcours étudiants
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('address'); ?>">
                                    <a href="<?= base_url('student/address'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'student' && $urlParam2 == 'address') ? 'active' : '' ?>">

                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>
                                            Adresses étudiants
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'finances'); ?> <?= ($urlParam1 == 'finance' or $urlParam1 == 'finances') ? 'menu-open' : '' ?>">
                            <a href="#"
                                class="nav-link <?= ($urlParam1 == 'finance' or $urlParam1 == 'finances') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Gestion financière
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('cashbox'); ?>">
                                    <a href="<?= base_url('finances/cashbox'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'cashbox' or $urlParam3 == 'cashbox') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Situation caisses</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('expenses'); ?>">
                                    <a href="<?= base_url('finances/expenses'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'expenses' or $urlParam3 == 'expense' or $urlParam2 == 'printexpense') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Décaissement</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('operations'); ?>">
                                    <a href="<?= base_url('finances/operations'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'operations' or $urlParam3 == 'operation') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Opérations caisses</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('banking'); ?>">
                                    <a href="<?= base_url('finances/banks'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'banks' or $urlParam3 == 'bank') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Comptes bancaires</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('transactions'); ?>">
                                    <a href="<?= base_url('finances/transactions'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'transactions' or $urlParam3 == 'transaction') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Transactions bancaires</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'reporting'); ?> <?= ($urlParam1 == 'reporting') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'reporting') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Edition de rapports
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="<?= base_url('reporting'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'reporting') && ($urlParam2 == '')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Autres rapports</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('parent'); ?>">
                                    <a href="<?= base_url('reporting/parent'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'parent' or $urlParam3 == 'parent') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Contacts étudiants</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('replisting'); ?>">
                                    <a href="<?= base_url('reporting/listing'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'listing' or $urlParam3 == 'listing') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Listes étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('repstudents'); ?></li>">
                                    <a href="<?= base_url('reporting/students'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'students' or $urlParam3 == 'students') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Registre étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('repcashbox'); ?>">
                                    <a href="<?= base_url('reporting/cashbox'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'cashbox' or $urlParam3 == 'cashbox') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Journal caisses</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('reppayments'); ?>">
                                    <a href="<?= base_url('reporting/payments'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'payments' or $urlParam3 == 'payments') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Versements Journaliers</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('reppaidfees'); ?>">
                                    <a href="<?= base_url('reporting/paidfees'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'paidfees' or $urlParam3 == 'paidfees') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Perception par frais</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('repusersfees'); ?>">
                                    <a href="<?= base_url('reporting/usersfees'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'usersfees' or $urlParam3 == 'usersfees') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Perception par agents</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('repbanking'); ?>">
                                    <a href="<?= base_url('reporting/banking'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'banking' or $urlParam3 == 'banking') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Transactions bancaires</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('reprecovery'); ?>">
                                    <a href="<?= base_url('reporting/recovery'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'recovery' or $urlParam3 == 'recovery') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Recouvrement frais</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'fees'); ?> <?= ($urlParam1 == 'fees') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'fees') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p> Configuration
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item <?= checkModuleAccess(feature: 'configfees'); ?>">
                                    <a href="<?= base_url('fees/feestypes'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'feestypes' or ($urlParam3 == 'feetype')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Nomenclatures frais</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('classesfees'); ?>">
                                    <a href="<?= base_url('fees/feesclasses'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'feesclasses' or ($urlParam3 == 'feeclasse')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Frais par promotions</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('exemptions'); ?>">
                                    <a href="<?php echo base_url('fees/exemptions'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'exemptions' or ($urlParam3 == 'exemption') or ($urlParam2 == 'config' && $urlParam3 == 'discountexemption')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Exhonérations étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('scholarships'); ?>">
                                    <a href="<?php echo base_url('fees/scholarships'); ?>"
                                        class="nav-link <?= (($urlParam2 == 'scholarships') or ($urlParam3 == 'scholarship') or ($urlParam2 == 'config' && $urlParam3 == 'classeexemption')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Etudiants prises en charges</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('exchanges'); ?>">
                                    <a href="<?php echo base_url('fees/exchanges'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'exchanges' or ($urlParam3 == 'exchange')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Taux de change devises</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'settings'); ?> <?= ($urlParam1 == 'config') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'config') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Paramètrages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('years'); ?>">
                                    <a href="<?= base_url('config/years'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'years' or $urlParam3 == 'year') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Années Académiques</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('sections'); ?>">
                                    <a href="<?= base_url('config/sections'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'sections' or $urlParam3 == 'section') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Facultés organisées</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess(feature: 'options'); ?>">
                                    <a href="<?= base_url('config/options'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'options' or $urlParam3 == 'option') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Filières organisées</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('levels'); ?>">
                                    <a href="<?= base_url('config/degrees'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'degrees' or $urlParam3 == 'degrees') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Niveau d’études</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('classes'); ?>">
                                    <a href="<?= base_url('config/classes'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'classes' or $urlParam3 == 'classe') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Promotions</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item has-treeview <?= ((session()->get('profile') == 'sysadmin') OR (session()->get('profile') == 'admin') OR (session()->get('profile') == 'root')) ? '' : 'd-none'; ?> <?= checkModuleAccess(null, 'admins'); ?> <?= ($urlParam1 == 'admin') ? 'menu-open' : '' ?>">
                            <a href="#"
                                class="nav-link <?= ($urlParam2 == 'group' or $urlParam2 == 'account') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Administration
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('roles'); ?>">
                                    <a href="<?= base_url('admin/view/roles'); ?>"
                                        class="nav-link <?= ($urlParam3 == 'roles' or $urlParam3 == 'roles') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess(feature: 'users'); ?>">
                                    <a href="<?= base_url('admin/view/users'); ?>"
                                        class="nav-link <?= ($urlParam3 == 'users' or $urlParam3 == 'user') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Comptes</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('branchs'); ?>">
                                    <a href="<?= base_url('admin/view/branchs'); ?>"
                                        class="nav-link <?= ($urlParam3 == 'branchs' or $urlParam3 == 'branch') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Affectation utilisateurs</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('access'); ?></li>">
                                    <a href="<?= base_url('admin/view/access'); ?>"
                                        class="nav-link <?= ($urlParam3 == 'access' or $urlParam3 == 'privileges') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Accès aux modules</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('logs'); ?>">
                                    <a href="<?= base_url('admin/view/logs'); ?>"
                                        class="nav-link <?= ($urlParam3 == 'logs' or $urlParam3 == 'log') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Journalisation système</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('activity'); ?>">
                                    <a href="<?= base_url('admin/view/activities'); ?>"
                                        class="nav-link <?= ($urlParam3 == 'activities' or $urlParam3 == 'activity') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Activités systèmes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'messaging'); ?> <?= ($urlParam1 == 'message' or $urlParam1 == 'messages-validity') ? 'menu-open' : '' ?>">
                            <a href="#"
                                class="nav-link <?= ($urlParam1 == 'message' or $urlParam1 == 'messages-validity') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    Communication
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('activation', null); ?>">
                                    <a href="<?= base_url('messages-validity'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'messages-validity') ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-check-circle ml-3"></i>
                                        <p>Activation envoies</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('emails'); ?>">
                                    <a href="<?= base_url('message/emails'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'message' && $urlParam2 == 'emails') or $urlParam1 == 'sendemail') ? 'active' : '' ?>">
                                        <i class="fas fa-envelope nav-icon ml-3"></i>
                                        <p>Emails étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('sms'); ?>">
                                    <a href="<?= base_url('message/sms'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'message' && $urlParam2 == 'sms') or $urlParam1 == 'sendsms') ? 'active' : '' ?>">
                                        <i class="fas fa-comment nav-icon ml-3"></i>
                                        <p>SMS étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('broadcast'); ?>">
                                    <a href="<?= base_url('message/broadcast'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'message' && $urlParam2 == 'broadcast') or $urlParam1 == 'broadcast') ? 'active' : '' ?>">
                                        <i class="fas fa-binoculars nav-icon ml-3"></i>
                                        <p>Broadcast utilisateurs</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('messages'); ?>">
                                    <a href="<?= base_url('message/systems'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'message' && $urlParam2 == 'systems') or $urlParam1 == 'system') ? 'active' : '' ?>">
                                        <i class="fas fa-comments nav-icon ml-3"></i>
                                        <p>Messages systèmes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'tools'); ?> <?= ($urlParam1 == 'export') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'export') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-download"></i>
                                <p>
                                    Exportations données
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('expstudents'); ?>">
                                    <a href="<?= base_url('export/students'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'export' && $urlParam2 == 'students') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Etudiants</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('expparents'); ?>">
                                    <a href="<?= base_url('export/parents'); ?>"
                                        class="nav-link <?= ($urlParam1 == 'export' && $urlParam2 == 'parents') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Contacts</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'teaching'); ?> <?= ($urlParam1 == 'teaching') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'teaching') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>
                                    Résultats périodiques
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('timing'); ?>">
                                    <a href="<?= base_url('teaching/timing'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'teaching' && $urlParam2 == 'timing') or $urlParam3 == 'timing') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Configuration périodes</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('encoding'); ?>">
                                    <a href="<?= base_url('teaching/encoding'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'teaching' && $urlParam2 == 'encoding') or $urlParam3 == 'encoding') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Encodages résultats</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('schoolary'); ?>">
                                    <a href="<?= base_url('teaching/schoolary'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'teaching' && $urlParam2 == 'schoolary') or $urlParam3 == 'schoolary') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Critères publication</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('pubs'); ?>">
                                    <a href="<?= base_url('teaching/pubs'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'teaching' && $urlParam2 == 'pubs') or $urlParam3 == 'pubs') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Publications</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('results'); ?>">
                                    <a href="<?= base_url('teaching/results'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'teaching' && $urlParam2 == 'results') or $urlParam3 == 'results') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Consultation</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?= checkModuleAccess(null, 'education'); ?> <?= ($urlParam1 == 'education') ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= ($urlParam1 == 'education') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Enseignements
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('teachers'); ?>">
                                    <a href="<?= base_url('education/teachers'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'teachers') or $urlParam3 == 'teacher') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Enseignants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('branchs'); ?>">
                                    <a href="<?= base_url('education/branchs'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'branchs') or $urlParam3 == 'branch') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Branches Cours</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('courses'); ?>">
                                    <a href="<?= base_url('education/courses'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'courses') or $urlParam3 == 'course') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Cours organisés</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('courseclasses'); ?>">
                                    <a href="<?= base_url('education/courseclasses'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'courseclasses') or $urlParam3 == 'courseclasse') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Cours par promotions</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('workhours'); ?>">
                                    <a href="<?= base_url('education/workhours'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'workhours') or $urlParam3 == 'workhour') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Charges Horaires</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('studentquotes'); ?>">
                                    <a href="<?= base_url('education/studentquotes'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'studentquotes') or $urlParam2 == 'studentquote') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Cotations étudiants</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('slipnotes'); ?>">
                                    <a href="<?= base_url('education/slipnotes'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'slipnotes') or $urlParam2 == 'studentslipnote') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Bulletins étudiants</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('disciplinary'); ?>">
                                    <a href="<?= base_url('education/disciplinary'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'disciplinary') or $urlParam3 == 'disciplinary') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Disciplines Académiques</p>
                                    </a>
                                </li>
                                <li class="d-none nav-item <?= checkModuleAccess('exercises'); ?>">
                                    <a href=""
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'exercises') or $urlParam3 == 'exercise') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Travaux et Exercices</p>
                                    </a>
                                </li>
                                <li class="d-none nav-item <?= checkModuleAccess('directories'); ?>">
                                    <a href=""
                                        class="nav-link <?= (($urlParam1 == 'education' && $urlParam2 == 'directories') or $urlParam3 == 'directory') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Annuaires Académiques</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <?php $active_payroll = (($urlParam1 == 'payroll') or ($urlParam1 == 'worker')) ? TRUE : FALSE; ?>
                        <li
                            class="mb-5 <?= (session()->payroll == TRUE or session()->all == TRUE) ? "" : "d-none"; ?> nav-item has-treeview <?= ($active_payroll == TRUE) ? "menu-open" : ""; ?>">
                            <a href="#"
                                class="nav-link <?= (($urlParam1 == 'payroll') or ($urlParam1 == 'worker')) ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>
                                    Gestion de la paie
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= checkModuleAccess('employees'); ?>">
                                    <a href="<?= base_url('payroll/employees'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'employees' or ($urlParam2 == 'agent')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Dossiers Employés</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('categories'); ?>">
                                    <a href="<?= base_url('payroll/categories'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'categories' or ($urlParam2 == 'category')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Catégories Employés</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('contracts'); ?>">
                                    <a href="<?= base_url('payroll/contracts'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'contracts') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Contrats Employés</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('attendances'); ?>">
                                    <a href="<?= base_url('payroll/attendances'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'attendances') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Pointages présences</p>
                                    </a>
                                </li>

                                <li class="nav-item <?= checkModuleAccess('attendances'); ?>">
                                    <a href="<?= base_url('payroll/supphours'); ?>"
                                        class="nav-link <?= (($urlParam3 == 'supphours') OR ($urlParam2 == 'supphours')) ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Heures Supplémentaires</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('requests'); ?>">
                                    <a href="<?= base_url('payroll/requests'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'requests') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Avances Salaires</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('salaries'); ?>">
                                    <a href="<?= base_url('payroll/payments'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'payments') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Paiements Salaires</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('payslip'); ?>">
                                    <a href="<?= base_url('payroll/slipnotes'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'slipnotes') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Bulletins de paie</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('payslip'); ?>">
                                    <a href="<?= base_url('payroll/payslip'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'payslip') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Récapitulatif de paie</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('deductions'); ?>">
                                    <a href="<?= base_url('payroll/deductions'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'deductions') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Charges fiscales</p>
                                    </a>
                                </li>
                                <li class="nav-item d-none <?= checkModuleAccess('leaves'); ?>">
                                    <a href="<?= base_url('payroll/leaves'); ?>"
                                        class="nav-link <?= (($urlParam1 == 'payroll' && $urlParam2 == 'leaves') or $urlParam3 == 'leave') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right nav-icon ml-3"></i>
                                        <p>Congés Employés</p>
                                    </a>
                                </li>
                                <li class="nav-item <?= checkModuleAccess('badges'); ?>">
                                    <a href="<?= base_url('payroll/badges'); ?>"
                                        class="nav-link <?= ($urlParam2 == 'badges') ? 'active' : '' ?>">
                                        <i class="fas fa-angle-double-right ml-3"></i>
                                        <p>Badges Agents</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <div id="sectionPrintable">
            <?php
            if (isset($_view) && $_view)
                echo view($_view);
            ?>
            <!-- style="position:fixed;bottom:0;width: 100%" -->
            <?php
            $url = $urlParam1;
            $url2 = $urlParam2;
            $url3 = $urlParam3;
            ?>
            <div class="<?= ($urlParam1 == 'reporting') ? '' : 'd-none'; ?>">
                <div
                    class="<?= ($urlParam1 == 'reporting' && (($url2 == 'recovery') or ($url2 == 'parent') or ($url2 == 'students') or ($url2 == 'listing') or ($url2 == 'cashbox') or ($url2 == 'payments') or ($url3 == 'cashbox') or ($url3 == 'payments'))) ? 'd-none' : 'small'; ?>">
                    <div class="<?= (session()->has('reportingtype')) ? 'd-none' : 'signature'; ?>">
                        <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer small">
            <div class="printof text-center printoff">
                <div class="text-center mb-2">
                    <a href="<?= base_url('school-infosheet'); ?>"
                        class="small <?= (! session()->has('isLoggedIn')) ? 'd-none' : ''; ?>">
                        <img src="<?= (session()->has('schoollogo')) ? base_url('public/uploads/images/' . session()->get('schoollogo')) : ''; ?>"
                            alt="Magschool" class="avatar avatar-sm" />
                        <span class="text-uppercase rounded-circle py-2 p-3 border border-primary text-center">
                            <small class="font-weight-bold text-primary">
                                Licence:
                                <?= (session()->has('schoolfname')) ? session()->get('schoolfname') : 'Standard'; ?>
                            </small>
                        </span>
                    </a>
                </div>
                <hr>
                &copy;2020 - <?= date('Y') ?>
                <span class="text-uppercase">
                    <b>Magschool</b>
                </span> - All Rights Reserved
                <!-- Tous droits réservés --> |
                <span class="font-weight-bold"> <b>v2.2.0</b> </span> <br>
                <p class="font-weight-bold">Developped and Designed by
                    <a href="https://ditotase.com" target="_blank" class="btn btn-sm btn-outline-danger">
                        <strong>DITOTASE</strong></a>
                </p>
            </div>
        </footer>
        <!-- Control Sidebar-->
        <!-- Control sidebar content goes here -->
        <aside class="control-sidebar card bg-info">
            <div class="text-center mt-5">
                <img src="<?= (session()->get('avatar')) ? base_url('public/uploads/images/' . session()->get('avatar')) : base_url('public/img/avatar.png'); ?>"
                    alt="Avatar" class="img-circle text-center"
                    style="border-radius: 100px!important; width: 50px!important; height:50px!important;" />
                <h3 class="text-uppercase small">
                    <?= session()->get('username'); ?> - <?= session()->get('role'); ?>
                </h3>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-sm-12">
                    <div class="card-tabs">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-two-home-tab">
                                    <a href="<?= base_url('profile/page/manage'); ?>" class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <i class="fa fa-user-circle  avatar avatar-sm"></i>
                                            <div class="media-body ml-2">
                                                <h3 class="dropdown-item-title text-primary font-weight-bold">
                                                    Mon profil
                                                </h3>
                                                <p class="text-sm text-muted">Gérer votre compte </p>
                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= base_url('profile/page/password'); ?>" class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <i class="fa fa-lock   avatar avatar-sm"></i>
                                            <div class="media-body ml-2">
                                                <h3 class="dropdown-item-title text-primary font-weight-bold">
                                                    Mot de passe
                                                </h3>
                                                <p class="text-sm text-muted">Gérer votre sécurité </p>
                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= base_url('profile/page/picture'); ?>"
                                        class="dropdown-item btn btn-link">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <i class="fa fa-image   avatar avatar-sm"></i>
                                            <div class="media-body ml-2">
                                                <h3 class="dropdown-item-title text-primary font-weight-bold">
                                                    Photo profil
                                                </h3>
                                                <p class="text-sm text-muted">Gérer votre avatar </p>
                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= base_url('profile/page/preferences'); ?>" class="dropdown-item">
                                        <!-- Message Start -->
                                        <div class="media">
                                            <i class="fa fa-cog   avatar avatar-sm"></i>
                                            <div class="media-body ml-2">
                                                <h3 class="dropdown-item-title text-primary font-weight-bold">
                                                    Paramètres
                                                </h3>
                                                <p class="text-sm text-muted">Gérer vos préférences </p>
                                            </div>
                                        </div>
                                        <!-- Message End -->
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <div class="text-center">

                                        <h3 class="font-weight-bold text-center  text-uppercase mb-2 small">
                                            Préférences langues système
                                        </h3>
                                    </div>
                                    <div class="mb-5">
                                        <a href="#" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Cliquez pour naviguer dans la version française"
                                            onclick="doGTranslate('en|fr'); return false;">
                                            <img class="avatar avatar-xs"
                                                src="<?= base_url('public/img/lang/french.png'); ?>" alt="French" />
                                            <span
                                                class="text-center text-capitalize text-white font-weight-normal small">
                                                Français
                                            </span>
                                        </a> | <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Cliquez pour naviguer dans la version anglaise" class="btn"
                                            onclick="doGTranslate('fr|en'); return false;">
                                            <img class="avatar avatar-xs"
                                                src="<?= base_url('public/img/lang/us.jpg'); ?>" alt="English" />
                                            <span
                                                class="text-center text-capitalize text-white font-weight-normal small">
                                                Anglais
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- Modal Help Users -->
    <div class="modal fade" id="help_users_support_center">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assistance technique</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                    </button>
                </div>
                <?php
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url('support/helpcustomer'), $attributes);
                ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="code_annee_scolaire" class="control-label">
                                    <span class="text-danger">*</span> Titre Objet
                                </label>
                                <input type="text" class="form-control bg-light text-capitalize" name="title_help"
                                    id="code_annee_scolaire" value="<?= set_value('code_annee') ?>"
                                    style="border-radius: 10px!important;" required />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="code_annee_scolaire" class="control-label">
                                    <span class="text-danger">*</span> Message
                                </label>
                                <textarea name="message_help" class="form-control" rows="5"
                                    placeholder="Decrivez votre problème ici..."><?= set_value('message_help') ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-info btn-sm text-uppercase">Envoyer</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ====== SIDEBAR RIGHT VISIBLE ON MOBILE DEVICE ONLY======-->
    <div class="offcanvas offcanvas-end bg-primary text-white" tabindex="-1" id="offcanvas_help_users"
        aria-labelledby="offcanvas_help_users">
        <div class="offcanvas-header text-white">
            <span id="offcanvas_help_users" class="h3 fw-bold">Plus d'options</span>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mt-5">
            <h1 class="border-bottom font-weight-bold text-center  text-uppercase mb-2 small">
                Préférences langues système </h1>

            <div class="row text-center mb-5">
                <div class="col-sm-12">
                    <div class="m-0 list-unstyled">
                        <div classs="d-inline">
                            <a href="#" class="btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Cliquez pour naviguer dans la version française"
                                onclick="doGTranslate('en|fr'); return false;">
                                <img class="avatar avatar-xs" src="<?= base_url('public/img/lang/french.png'); ?>"
                                    alt="French" />
                                <span class="text-center text-capitalize text-white font-weight-normal small">
                                    Français
                                </span>
                            </a> | <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Cliquez pour naviguer dans la version anglaise" class="btn"
                                onclick="doGTranslate('fr|en'); return false;">
                                <img class="avatar avatar-xs" src="<?= base_url('public/img/lang/english.jpg'); ?>"
                                    alt="English" />
                                <span class="text-center text-capitalize text-white font-weight-normal small">
                                    Anglais
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row shortcuts px-4 text-center">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="border-bottom font-weight-bold text-uppercase small mb-3">
                        Paramètres Généraux</h1>
                </div>
                <div class="col-sm-4 shortcut-item mb-2">
                    <a href="<?= base_url('support/contacts'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Contactez-nous en envoyant vos messages
                                pour une assistance technique ou utilisateur.">
                        <span class="shortcut-media avatar  avatar-md bg-gradient-orange">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <small class="text-white">Assistance</small>
                    </a>
                </div>

                <div class="col-sm-4 shortcut-item mb-2">
                    <a href="<?= base_url('support/docs'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Consulter le manuel utilisateur 
                                  pour voir le fonctionnement du système.">
                        <span class="shortcut-media avatar avatar-md bg-gradient-green">
                            <i class="fas fa-book"></i>
                        </span>
                        <small class="text-white">Documentation</small>
                    </a>
                </div>
                <div class="col-sm-4 shortcut-item mb-2">
                    <a href="<?= base_url('support/feedback'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Envoyez-nous vos suggestions  à propos du fonctionnement du système en détaillant 
                                  vos attentes.">
                        <span class="shortcut-media avatar avatar-md bg-gradient-purple">
                            <i class="fas fa-marker"></i>
                        </span>
                        <small class="text-white">Feedback</small>
                    </a>
                </div>
                <div class="col-sm-4 shortcut-item mb-2">
                    <a href="<?= base_url('support/about'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="A propos de l'application. Informations sur le système actuel.">
                        <span class="shortcut-media avatar avatar-md bg-gradient-info">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <small class="text-white">Apropos</small>
                    </a>
                </div>
                <div class="col-sm-4 shortcut-item mb-2">
                    <a href="<?= base_url('support/calendar'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Accèder à votre agenda pour planifier vos activités et vos publications">
                        <span class="shortcut-media avatar avatar-md bg-gradient">
                            <i class="fas fa-calendar"></i>
                        </span>
                        <small class="text-white">Calendrier</small>
                    </a>
                </div>
                <div class="col-sm-4 shortcut-item mb-2">
                    <a href="<?= base_url('support/faqs'); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        title="Consulter la page d'aide. Les Questions Fréquements posées à propos de ce système.">
                        <span class="shortcut-media avatar avatar-md bg-gradient-yellow">
                            <i class="fas fa-question-circle"></i>
                        </span>
                        <small class="text-white">Aide(Faqs)</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- translate content if other language selected-->
    <div class="fixed-bottom" style="display: none!important;">
        <div id="google_translate_element2" style="display: none!important;"></div>
    </div>

    <script>
    /*to prevent Firefox FOUC, this must be here*/
    let FF_FOUC_FIX;
    </script>
    <!-- jQuery -->
    <script src="<?= base_url('public/vendors/jquery/jquery-app.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('public/vendors/bootstrap/js/bootstrap.bundle.min.js'); ?>" defer></script>
    <?php if ($urlParam1 == 'overview' or $urlParam1 == 'dashboard' or ($urlParam1 == 'admincustomer' && $urlParam1 == 'dashboard')): ?>
    <!-- ChartJS Chart.min.js-->
    <script src="<?= base_url('public/vendors/chart.js/chartlatest.js'); ?>"></script>
    <script src="<?= base_url('public/vendors/chart.js/chart.plugins.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('public/vendors/sparklines/sparkline.js'); ?>" defer></script>
    <?php endif; ?>
    <!-- Select2 -->
    <script src="<?= base_url('public/vendors/select2/js/select2.full.min.js'); ?>" defer></script>
    <script src="<?= base_url('public/vendors/moment/moment.min.js'); ?>" defer></script>
    <script src="<?= base_url('public/vendors/inputmask/min/jquery.inputmask.bundle.min.js'); ?>" defer></script>
    <script src="<?= base_url('public/js/library.js'); ?>"></script>

    <!-- DataTables -->
    <script src="<?= base_url('public/vendors/datatables/datatables.min.js'); ?>"></script>

    <?php if ($urlParam1 == 'admincustomer' OR $urlParam1 == 'guest' or $urlParam1 == 'export' or $urlParam1 == 'reporting' or $urlParam3 == 'parcours' or $urlParam2 == 'workhours' or $urlParam2 == 'disciplinary'): ?>
    <script src="<?= base_url('public/vendors/datatables/datatables.buttons.js'); ?>" defer></script>
    <script src="<?= base_url('public/vendors/datatables/buttons.datatables.js'); ?>" defer></script>
    <!-- For Excel and CSV Export -->
    <script src="<?= base_url('public/vendors/datatables/jszip.min.js'); ?>" defer></script>
    <!-- PDF Export -->
    <script src="<?= base_url('public/vendors/datatables/pdfmake.min.js'); ?>" defer></script>
    <script src="<?= base_url('public/vendors/datatables/vfsfonts.min.js'); ?>" defer></script>
    <!-- Others Buttons -->
    <script src="<?= base_url('public/vendors/datatables/buttons.html.min.js'); ?>" defer></script>
    <script src="<?= base_url('public/vendors/datatables/print.min.js'); ?>" defer></script>
    <?php endif; ?>
    <script src="<?= base_url('public/js/datatables.init.js'); ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url('public/vendors/adminlte/js/adminlte.min.js'); ?>" defer></script>
    <!-- MAIN script -->
    <script src="<?= base_url('public/js/main.js'); ?>"></script>

    <script src="<?= base_url('public/vendors/summernote/summernote-bs4.min.js'); ?>" defer></script>

    <script>
    $(document).ready(function() {
        $('#btn_offcanvas_help_users').on('click', function() {
            $('#offcanvas_help_users').toggleClass('open');
        });
        $('#btn_offcanvas').on('click', function() {
            $('#offcanvas').toggleClass('open');
        });
    });

    /*var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
    var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
        return new bootstrap.Offcanvas(offcanvasEl)
    });*/
    </script>
    <script>
    $(document).ready(function() {

        $('#composemessage').summernote();

        $('#floatingSelect2').select2({
            theme: 'bootstrap-5'
        });

        // Adjust the padding for the Select2 dropdown when it opens
        $('#floatingSelect2').on('select2:open', function() {
            $(this).parent().find('.select2-selection').css('padding', '0.75rem 1rem');
        });

        // Reset the padding for the Select2 dropdown when it closes
        $('#floatingSelect2').on('select2:close', function() {
            $(this).parent().find('.select2-selection').css('padding', '0.75rem 1rem');
        });

        //enable add new parent on register student
        $('#student_parent').on('change', function() {
            $selected_parent = $(this).val();
            if ($selected_parent === 'new_parent')
                $('#inputs_show').slideDown();
            else
                $('#inputs_show').slideUp();
        });
        //enable add new commune on register student
        $('#student_commune').on('change', function() {
            $selected_commune = $(this).val();
            if ($selected_commune === 'new_commune')
                $('#inputs_commune_show').slideDown();
            else
                $('#inputs_commune_show').slideUp();
        });
        //enable add new quartier on register student
        $('#student_area').on('change', function() {
            $selected_area = $(this).val();
            if ($selected_area === 'new_area')
                $('#inputs_area_show').slideDown();
            else
                $('#inputs_area_show').slideUp();
        });
        //enable add new street and area on register student
        $('#address_street').on('change', function() {
            $address_street = $(this).val();
            if ($address_street === 'new_zone')
                $('#inputs_zone_show').slideDown();
            else
                $('#inputs_zone_show').slideUp();
        });
        //enable add new parent on register student
        $('#maxima').on('change', function() {
            $selected_parent = $(this).val();
            if ($selected_parent === 'new')
                $('#inputs_show').slideDown();
            else
                $('#inputs_show').slideUp();
        });
    });
    </script>
    <!-- AJAX REQUEST-->
    <script>
    <?php header('Content-type: application/json'); ?>
    <?php if (($urlParam1 == 'reporting') or ($urlParam1 == 'finances') or ($urlParam1 == 'payments') or ($urlParam2 == 'scholarships') or ($urlParam2 == 'feesclasses')): ?>

    $('#ajax_student').on('change', function() {

        choosed_student = $(this).val();
        student_session = "<?= (session()->has('studentchoosed')) ? session()->get('studentchoosed') : ''; ?>";
        student_payment = "<?= (session()->has('paymenttoken')) ? session()->get('paymenttoken') : ''; ?>";

        if (choosed_student !== '') {
            if ((student_payment !== '') && (student_session !== '')) {

                if (confirm("Vous avez un paiement non imprimer. Voulez-vous continuer ?", false) == true) {
                    let urlBase = "<?= base_url('ajaxStudentRequest/'); ?>" + choosed_student;

                    $.ajax({
                        url: urlBase,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {

                            //console.log('student request');
                            location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                        }
                    });
                }

            } else {

                let urlBase = "<?= base_url('ajaxStudentRequest/'); ?>" + choosed_student;

                $.ajax({
                    url: urlBase,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {

                        //console.log('student request');
                        location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                    }
                });
            }
        }
    });

    $('#ajax_fees_paid').on('change', function() {
        choosed_paid_fees = $(this).val();
        if (choosed_paid_fees !== '') {

            let urlBase = "<?= base_url('ajaxFeesPaid/'); ?>" + choosed_paid_fees;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });

    <?php endif; ?>
    <?php if (($urlParam1 == 'fees') or ($urlParam2 == 'recovery') or ($urlParam1 == 'reporting')): ?>
    $('#ajax_fees_classes').on('change', function() {
        choosed_fees = $(this).val();
        if (choosed_fees !== '') {

            let urlBase = "<?= base_url('ajaxFeesClasse/'); ?>" + choosed_fees;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam1 == 'reporting') or ($urlParam1 == 'education') or ($urlParam1 == 'teaching') or ($urlParam2 == 'parcours') or ($urlParam2 == 'recovery') or ($urlParam2 == 'sms') or ($urlParam2 == 'emails') or ($urlParam2 == 'students') or ($urlParam2 == 'parents') or (($urlParam1 == 'student') && ($urlParam2 == 'listing') or ($urlParam2 == 'basculement'))): ?>

    <?php $choosed_page = (!empty($urlParam2)) ? $urlParam2 : $urlParam1; ?>

    $('#ajax_students_classes').on('change', function() {

        choosed_classe = $(this).val();

        if (choosed_classe !== '') {

            let urlBase = "<?= base_url('ajaxStudentListingClasse/' . $choosed_page); ?>" + "/" +
                choosed_classe;

            //console.log(urlBase);

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    //alert(data);
                    // console.log('lolly');
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam1 == 'finances') or ($urlParam2 == 'expenses')): ?>
    $('#cashbox_id').on('change', function() {
        choosed_cashbox = $(this).val();

        console.log('lolo');
        if (choosed_cashbox !== '') {
            let urlBase = "<?= base_url('cashbox/'); ?>" + choosed_cashbox;
            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {


                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });

    $('#cashboxoperation').on('change', function() {
        choosed_operation = $(this).val();
        if (choosed_operation !== '') {

            let urlBase = "<?= base_url('cashboxOperation/'); ?>" + choosed_operation;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam1 == 'finances') or ($urlParam2 == 'transactions')): ?>
    $('#bank_id').on('change', function() {
        bank_id = $(this).val();
        if (bank_id !== '') {

            let urlBase = "<?= base_url('banks/'); ?>" + bank_id;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>

    <?php if (($urlParam1 == 'reporting') OR ($urlParam1 == 'education')): ?>

    $('#ajax_reporting option:disabled').remove(); // Removes disabled options from the DOM


    $('#ajax_reporting').on('change', function() {

        reporting_choosed = $(this).val();

        if (reporting_choosed !== '') {
            let urlBase = "<?= base_url('editingreport/'); ?>" + reporting_choosed;
            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });

    $('#ajax_student_reporting').on('change', function() {
        student_reporting_choosed = $(this).val();
        if (student_reporting_choosed !== '') {
            let urlBase = "<?= base_url('studentreport/'); ?>" + student_reporting_choosed;
            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    </script>
    <script>
    <?php header('Content-type: application/json'); ?>
    $('#ajax_sections').on('change', function() {

        ajax_sections = $(this).val();

        if (ajax_sections !== '') {

            let urlBase = "<?= base_url('sectionRequest/'); ?>" + ajax_sections;

            $.ajax({
                url: urlBase + '?ts=' + new Date().getTime(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    console.log('Requête réussie:');
                    //console.log(data);
                    // Mettre à jour le token CSRF après une requête réussie
                    //csrfHash = data.csrfHash; // Supposons que le serveur renvoie un nouveau token

                    //$('meta[name="csrf_token"]').attr('content', csrfHash); // Mettre à jour le token dans la balise meta

                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST
                },
                error: function(xhr, status, error) {
                    console.log('Erreur lors de la requête:', error);
                }
            });
        }
    });
    </script>

    <script src="<?= base_url('public/vendors/jquery/jqueryui.min.js'); ?>"></script>
    <script>
    $(document).ready(function() {
        $('#student-search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url('search-student') ?>",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        query: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.student_firstname + ' ' + item
                                    .student_lastname + ' ' + item
                                    .student_surname,
                                value: item.student_code
                            };
                        }));
                    }
                });
            },
            minLength: 2
        });
    });
    </script>
    <script defer>
    <?php if (isset($fees) && isset($recettes) && isset($depenses)): ?>
    //statistiques de traitement de demandes de visas par mois
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre",
                "Octobre", "Novembre", "Decembre"
            ],
            //Passeports recus
            datasets: [{
                    label: '#PERCEPTION',
                    data: [<?= $fees[0]; ?>, <?= $fees[1]; ?>, <?= $fees[2]; ?>,
                        <?= $fees[3]; ?>,
                        <?= $fees[4]; ?>, <?= $fees[5]; ?>, <?= $fees[6]; ?>,
                        <?= $fees[7]; ?>,
                        <?= $fees[8]; ?>, <?= $fees[9]; ?>, <?= $fees[10]; ?>,
                        <?= $fees[11]; ?>
                    ],
                    backgroundColor: [
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    ],
                    borderColor: [
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                        'rgb(66, 133, 244)', 'rgb(66, 133, 244)',
                    ],
                    borderWidth: 1
                },

                {
                    label: '#RECETTES',
                    data: [<?= $recettes[0]; ?>, <?= $recettes[1]; ?>, <?= $recettes[2]; ?>,
                        <?= $recettes[3]; ?>,
                        <?= $recettes[4]; ?>, <?= $recettes[5]; ?>, <?= $recettes[6]; ?>,
                        <?= $recettes[7]; ?>,
                        <?= $recettes[8]; ?>, <?= $recettes[9]; ?>, <?= $recettes[10]; ?>,
                        <?= $recettes[11]; ?>
                    ],
                    backgroundColor: [
                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',
                    ],
                    borderColor: [
                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',

                        'rgba(0, 200, 81)', 'rgba(0, 200, 81)',
                    ],
                    borderWidth: 1
                },
                {
                    label: '#DEPENSES',
                    data: [<?= $depenses[0]; ?>, <?= $depenses[1]; ?>, <?= $depenses[2]; ?>,
                        <?= $depenses[3]; ?>,
                        <?= $depenses[4]; ?>, <?= $depenses[5]; ?>, <?= $depenses[6]; ?>,
                        <?= $depenses[7]; ?>,
                        <?= $depenses[8]; ?>, <?= $depenses[9]; ?>, <?= $depenses[10]; ?>,
                        <?= $depenses[11]; ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 90, 94)',
                        'rgb(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',

                        'rgb(255, 90, 94)',
                        'rgb(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)'
                    ],
                    borderColor: [
                        'rgb(255, 90, 94)',
                        'rgb(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',

                        'rgb(255, 90, 94)',
                        'rgb(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)',
                        'rgba(255, 90, 94)'
                    ],
                    borderWidth: 1
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    <?php endif; ?>
    </script>

    <?php if (isset($horizontal_bar_chart)): ?>
    <script type="text/javascript">
        // Données passées depuis le contrôleur PHP
    const horizontal_bar_chart = <?= json_encode($horizontal_bar_chart) ?>;
    // Calcul de la somme totale des données
    const totl_horizontal_bar_chart = horizontal_bar_chart.values.reduce((a, b) => a + b, 0);
    // Initialisation du graphique
    const ctx_horizontal_bar_chart = document.getElementById('horizontal_bar_chart').getContext('2d');
    new Chart(ctx_horizontal_bar_chart, {
        type: 'bar', //pie or doughnut
        data: {
            labels: horizontal_bar_chart.labels,
            datasets: [{
                label: 'Effectifs',
                data: horizontal_bar_chart.values,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'], // Couleurs
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Répartition des élèves par classe'
                },
                datalabels: {
                    color: '#fff',
                    anchor: 'end',
                    align: 'start',
                    formatter: function(value, context) {
                        let percentage = (value / totl_horizontal_bar_chart * 100).toFixed(1) + '%';
                        return value + ' (' + percentage + ')';
                    }
                }
            }
        },
        plugins: [ChartDataLabels],
    });
    </script>
    <?php endif; ?>
    <?php
    //Check if success has in session
    if (session()->has('success')){
        session()->remove('failed');
    } else{
        session()->remove('success');
    }
    $message = (session()->has('success')) ? session()->get('success') : session()->get('failed');
    $messageColor = (session()->has('failed')) ? 'red' : 'green';
    
    
    if (!empty($message)): 
    
    ?>
    <script src="<?= base_url('public/vendors/toastify/toastify.js'); ?>"></script>
    <script>
    Toastify({
        text: "<?= $message; ?>",
        duration: 5000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,

        style: {
            background: "<?= $messageColor; ?>",
        },
        onClick: function() {}
    }).showToast();
    </script>
    <?php session()->remove('failed');
        session()->remove('success'); ?>
    <?php endif; ?>
    <script>
    function showPass() {
        let inputs = document.getElementsByClassName('password');
        let icon = document.getElementById('eyepass');
        let passmsg = document.getElementById('passmsg');
        for (const input of inputs) {
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.add('fa-eye-slash');
                icon.classList.remove('fa-eye');
            } else if (input.type === 'text') {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }

    function accessModule() {

        var name = document.getElementById('name');
        var access_text = name.options[name.selectedIndex].text;
        var access_value = name.options[name.selectedIndex].value;

        if (access_value != '') {
            $(document).ready(function() {

                let urlBase = "<?= base_url('accessModule/'); ?>" + access_value;

                $.ajax({
                    url: urlBase,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {

                        location.reload(); //RELAOD PAGE FOR AJAX REQUEST
                    }
                });
            });
        }
    }

    function hideReporting() {

        let icon = document.getElementById('hide_status');
        let passmsg = document.getElementById('hide_info');

        $(document).ready(function() {

            let urlBase = "<?= base_url('reporting-hidden'); ?>";

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST
                }
            });
        });
    }


    function cashboxReportingHidden(btn_choosed) {

        let icon = document.getElementById('hide_status');
        let passmsg = document.getElementById('hide_info');

        $(document).ready(function() {

            let urlBase = "<?= base_url('cashboxHiddenAgent/'); ?>" + btn_choosed;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST
                }
            });
        });
    }
    </script>
    <?php if (ENVIRONMENT == 'production'): ?>
    <script defer src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
    <script defer src="<?= base_url('public/js/translate.js'); ?>"></script>
    <?php endif; ?>
    
    <?php if (isset($pie_chart)): ?>
    <!--  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> -->

    <script>
    // Données passées depuis le contrôleur PHP
    const pie_chart_Data = <?= json_encode($pie_chart) ?>;

    // Calcul de la somme totale des données
    const totalSum = pie_chart_Data.values.reduce((a, b) => a + b, 0);

    // Initialisation du graphique
    const ctx_pie_chart_Data = document.getElementById('my_Pie_Chart').getContext('2d');
    new Chart(ctx_pie_chart_Data, {
        type: 'pie', //pie or doughnut
        data: {
            labels: pie_chart_Data.labels,
            datasets: [{
                data: pie_chart_Data.values,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Couleurs
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        /*label: function (tooltipItem) {
                            const value = pie_chart_Data.values[tooltipItem.dataIndex];
                            return pie_chart_Data.labels[tooltipItem.dataIndex] + ': ' + value + '%';
                        }*/
                        label: function(tooltipItem) {
                            const value = pie_chart_Data.values[tooltipItem.dataIndex];
                            const percentage = ((value / totalSum) * 100).toFixed(1);
                            return pie_chart_Data.labels[tooltipItem.dataIndex] + ': ' + percentage + '%';
                        }
                    }
                },
                datalabels: {
                    /*formatter: (value, ctx) => {
                        const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1) + '%';
                        return percentage;
                    },*/
                    formatter: (value, ctx) => {
                        const percentage = ((value / totalSum) * 100).toFixed(1) + '%';
                        return percentage;
                    },
                    color: '#fff', // Couleur du texte
                    font: {
                        weight: 'bold',
                        size: 14
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Activation du plugin
    });
    </script>

    <?php endif; ?>
    <?php if (isset($finances_pie_chart) && !empty($finances_pie_chart)): ?>
    <script>
    // Données passées depuis le contrôleur PHP
    const pie_chart_finances = <?= json_encode($finances_pie_chart) ?>;
    // Calcul de la somme totale des données
    const total_finances = pie_chart_finances.values.reduce((a, b) => a + b, 0);

    // Initialisation du graphique
    const ctx_finances = document.getElementById('Finances_Pie_Chart').getContext('2d');
    new Chart(ctx_finances, {
        type: 'pie', //pie or doughnut
        data: {
            labels: pie_chart_finances.labels,
            datasets: [{
                data: pie_chart_finances.values,
                backgroundColor: ['#0000FF', '#FF0000', ], // Couleurs '#008000','#36A2EB', '#FF6384'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {

                        label: function(tooltipItem) {
                            const value = pie_chart_finances.values[tooltipItem.dataIndex];
                            const percentage = ((value / total_finances) * 100).toFixed(1);
                            return pie_chart_finances.labels[tooltipItem.dataIndex] + ': ' + percentage +
                                '%';
                        }
                    }
                },
                datalabels: {

                    formatter: (value, ctx) => {
                        const percentage = ((value / total_finances) * 100).toFixed(1) + '%';
                        return percentage;
                    },
                    color: '#fff', // Couleur du texte
                    font: {
                        weight: 'bold',
                        size: 14
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Activation du plugin
    });
    </script>
    <?php endif; ?>

    <?php if (session()->has('isCustomerLoggedIn')) : ?>
    <!-- INCLUDE Customer SCRIPTS -->
    <!-- AJAX REQUEST-->
    <script type="text/javascript">
    <?php header('Content-type: application/json'); ?>
    <?php if (($urlParam1 == 'reporting') or ($urlParam1 == 'payments') or ($urlParam2 == 'scholarships') or ($urlParam2 == 'feesclasses')): ?>

    $('#ajax_student').on('change', function() {

        choosed_student = $(this).val();

        if (choosed_student !== '') {

            let urlBase = "<?= base_url('ajaxStudentRequest/'); ?>" + choosed_student;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log('student request');
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });

    $('#ajax_fees_paid').on('change', function() {
        choosed_paid_fees = $(this).val();
        if (choosed_paid_fees !== '') {

            let urlBase = "<?= base_url('ajaxFeesPaid/'); ?>" + choosed_paid_fees;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });

    <?php endif; ?>
    <?php if (($urlParam1 == 'fees') or ($urlParam2 == 'recovery')): ?>
    $('#ajax_fees_classes').on('change', function() {
        choosed_fees = $(this).val();
        if (choosed_fees !== '') {

            let urlBase = "<?= base_url('ajaxFeesClasse/'); ?>" + choosed_fees;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam2 == 'recovery') or ($urlParam2 == 'sms') or ($urlParam2 == 'emails') or ($urlParam2 == 'students') or ($urlParam2 == 'parents') or (($urlParam1 == 'student') && ($urlParam2 == 'listing') or ($urlParam2 == 'basculement'))): ?>
    $('#ajax_students_classes').on('change', function() {
        choosed_classe = $(this).val();
        if (choosed_classe !== '') {

            let urlBase = "<?= base_url('ajaxStudentListingClasse/' . $urlParam2 . "/"); ?>" + choosed_classe;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log('lolly');
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam2 == 'dashboard') or ($urlParam2 == 'statistics') or ($urlParam2 == 'students') or ($urlParam2 == 'dashboad')): ?>
    $('#year').on('change', function() {
        year = $(this).val();
        if (year !== '') {

            let urlBase = "<?= base_url('school-students-yearly/'); ?>" + year;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam2 == 'statistics') or ($urlParam2 == 'finances') or ($urlParam2 == 'students') or ($urlParam2 == 'dashboard')): ?>
    $('#ajax_school').on('change', function() {
        ajax_school = $(this).val();
        if (ajax_school !== '') {

            let urlBase = "<?= base_url('school-finances/'); ?>" + ajax_school;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    <?php if (($urlParam2 == 'statistics')): ?>
    $('#ajax_sections').on('change', function() {
        ajax_sections = $(this).val();
        if (ajax_sections !== '') {

            let urlBase = "<?= base_url('sectionRequest/'); ?>" + ajax_sections;

            $.ajax({
                url: urlBase,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    //console.log(data);
                    location.reload(); //RELAOD PAGE FOR AJAX REQUEST

                }
            });
        }
    });
    <?php endif; ?>
    </script>
    <?php endif; ?>
    <script>
    document.getElementById('btn-refresh').addEventListener('click', () => {
        // Forcer un rechargement complet de la page
        location.reload(true);
    });
    // Enregistrement du Service Worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('<?= base_url('public/service-worker.js'); ?>')
        //navigator.serviceWorker.register('service-worker.js')
            .then(function(registration) {
                console.log('Service Worker enregistré avec succès:', registration);
            })
            .catch(function(error) {
                console.log('Échec de l\'enregistrement du Service Worker:', error);
            });
        // Vérifier les mises à jour du SW
        navigator.serviceWorker.getRegistration().then(reg => {
            if (reg) {
                reg.update(); // Met à jour le SW si une nouvelle version est dispo
            }
        });
    }

    document.getElementById('btn-refresh').addEventListener('click', () => {
        // Met à jour la page en vidant les caches
        if ('caches' in window) {
            caches.keys().then(function(names) {
                for (let name of names) caches.delete(name);
            });
        }
        location.reload(true);
    });
 
    function clearCache() {
        if ('serviceWorker' in navigator) {
            if (navigator.serviceWorker) {
                navigator.serviceWorker.ready.then((registration) => {
                    registration.active.postMessage({
                        action: 'clearCache'
                    });
                }).catch((error) => {
                    console.error('Error sending message to service worker:', error);
                });
            } else {
                console.warn('Service Worker not supported in this browser.');
            }
        }
    }

    // Appeler clearCache lorsque la fenêtre est complètement chargée
    window.addEventListener('load', () => {
        clearCache();
    });
    </script>
</body>
</html>