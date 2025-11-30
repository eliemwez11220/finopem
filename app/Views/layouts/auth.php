<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- for hacker -->
    <?= csrf_meta() ?>
    <meta charset="utf-8">
    <!-- Locale -->
    <!-- To the Future  Meta Tags -->
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?= (isset($title)) ? $title : 'Management Application'; ?> - finopem
    </title>
    <meta name="title" content="finopem - Solution logicielle conçue pour les établissements scolaires basés en RDC.">
    <meta name="description"
        content="finopem est une solution logicielle de gestion scolaire, conçue pour les établissements scolaires basés en RDC. Disponible en version web et mobile.">
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
    <link rel="stylesheet" href="<?= base_url('public/vendors/bootstrap/css/bootstrap.css'); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/fontawesome/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/toastify/toastify.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/vendors/sweetalert2/css/sweetalert2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/translate.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/main-styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/auth-styles.css'); ?>">
    <?php if (ENVIRONMENT == 'production') { ?>
    <link rel="manifest" href="<?= base_url('public/manifest.json'); ?>" />
    <?php } ?>
    <style>
    @media print {
        .printoff {
            display: none !important;
        }
    }

    body {
        background: #f7f9fc !important;
        font-family: 'Segoe UI', sans-serif !important;
        color: #333 !important;
    }

    .modal {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .brandlogo {
        width: 10rem !important;
        height: 4rem !important;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
    }
    </style>
</head>
<?php

$uri = service('uri');
// Disable throwing exceptions
$uri->setSilent();
$totalSegments = $uri->getTotalSegments();
$urlParam1 = ($totalSegments >= 0) ? $uri->getSegment(1) : '';
$urlParam2 = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$urlParam3 = ($totalSegments >= 3) ? $uri->getSegment(3) : '';


?>

<body>
    <div class="container-scroller">
        <div class="container page-body-wrapper full-page-wrapper">
            <div class="content-wrapper auth auth-img-bg" style="background: #f7f9fc!important;">
                <div class="row mb-3">
                    <div class="col-sm-6 col-lg-5">
                        <div class="text-center mt-5">
                            <div class="py-5">
                                <h1 class="font-weight-bold text-primary text-uppercase">
                                    ✨ <a href="<?= base_url(); ?>"><b>finopem</b></a> ✨
                                </h1>
                            </div>

                            <p class="mb-3 font-weight-bold text-primary">
                                Transformez la gestion de votre établissement universitaire
                                avec une solution intuitive et complète,
                                adaptée à vos besoins de gestion finanicière et administrative.
                            </p>
                            <hr>
                            <p class="mb-3 lead">
                                Votre allié pour une gestion moderne. Une solution
                                logicielle conçue pour les établissements universitaires basés en RDC.
                                Donnez un nouvel élan à votre établissement en adoptant
                                une gestion efficace et adaptée aux enjeux actuels. Ensemble, transformons l’éducation
                                pour construire l'avenir !
                            </p>

                            <div class="row text-center py-3 <?= (($urlParam1 == 'signup') OR ($urlParam1 == 'register') OR ($urlParam1 == 'signupCheckCredentials') OR ($urlParam1 == 'signupGettingStarted')) ? 'd-none':''; ?>">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="text-center mt-3">
                                        <a href="<?= base_url('signup'); ?>" class="btn btn-primary btn-lg">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            S'inscrire en tant qu'étudiant utilisateur
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">

                        <div class="auth-form-transparent card-radius card shadow-lg mt-5">
                            <div class="py-5">
                                <?php
                            //load page content
                            if (isset($_view) && $_view) {
                                echo view($_view);
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- content-wrapper ends -->
        </div><!-- page-body-wrapper ends -->
    </div>
    <?php $link_developper = "https://ditotase.com"; ?>
    <div class="container-fluid bg-info py-5">
        <div class="container bg-transparent">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="text-center">
                        <div class="py-3">
                            <a href="<?= $link_developper; ?>" class="brandlogo">
                                <img class="brandlogo" src="<?= base_url('public/img/logo/ditotase.png'); ?>"
                                    alt="Ditotase" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="text-center mt-5">
                        <ul class="list-inline text-white small">
                            
                            <li class="list-inline-item"><a href="<?= base_url('legal/features'); ?>"
                                    class="text-white">Fonctionnalités</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/mentions'); ?>"
                                    class="text-white">Mentions légales</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/conditions'); ?>"
                                    class="text-white">Conditions d'utilisation</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/privacypolicy'); ?>"
                                    class="text-white">Politique de confidentialité</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/cookies'); ?>"
                                    class="text-white">Politique sur les cookies</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/licenses'); ?>"
                                    class="text-white">Licence d'utilisation</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/contacts'); ?>"
                                    class="text-white">Contacts</a></li>
                            <li class="list-inline-item"><a href="<?= base_url('legal/faqs'); ?>"
                                    class="text-white">Aide(FAQ)</a></li>
                        </ul>
                        <hr>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="text-center auth-brand-logo">
                        <p class="font-weight-bold text-white">
                            <span class="text-uppercase small ml-1">
                                <b>Finopem</b> &copy; <?= date('Y'); ?>
                                - Tous droits réservés |
                                <span class="text-lowercase">v2.2.0</span>
                            </span>
                        </p>

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
                            <img class="avatar avatar-xs" src="<?= base_url('public/img/lang/us.jpg'); ?>"
                                alt="English" />
                            <span class="text-center text-capitalize text-white font-weight-normal small">
                                Anglais
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="pwa-modal" class="modal">
        <div class="modal-content bg-primary text-white">
            <span class="close" id="close-modal">&times;</span>
            <h2><i class="fas fa-download"></i> Installer notre application </h2>
            <p>Profitez d’une meilleure expérience en installant <b>Finopem</b> sur votre appareil pour un accès rapide</p>

            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 offset-lg-4">
                    <button id="install-button" class="btn btn-primary">Installer maintenant</button>
                </div>
            </div>
        </div>
    </div>

    <!-- translate content if other language selected-->
    <div class="fixed-bottom" style="display: none!important;">
        <div id="google_translate_element2" style="display: none!important;">

        </div>
    </div>
    <script src="<?= base_url('public/vendors/jquery/jquery-app.min.js'); ?>"></script>
    <!-- APP SCRIPTS 4 -->
    <script src="<?= base_url('public/js/authscripts.js'); ?>"></script>

    <!-- ====== Start Include Toastify -->
    <?php include(APPPATH . ('Views/include/authpage.php')); ?>
    <!-- ====== End Toastify Include -->


    <?php if (ENVIRONMENT == 'production') { ?>
    <script>
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

    let deferredPrompt;

    window.addEventListener("beforeinstallprompt", (event) => {
        event.preventDefault();
        deferredPrompt = event;

        // Vérifier si l'application est déjà installée
        if (window.matchMedia("(display-mode: standalone)").matches || localStorage.getItem("pwaInstalled") ===
            "true") {
            return;
        }

        // Afficher la pop-up après 5 secondes
        setTimeout(() => {
            document.getElementById("pwa-modal").style.display = "flex";
        }, 5000);
    });

    // Gérer le bouton d'installation
    document.getElementById("install-button").addEventListener("click", () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === "accepted") {
                    console.log("L'utilisateur a installé l'application");
                    localStorage.setItem("pwaInstalled", "true");
                    document.getElementById("pwa-modal").style.display = "none";
                } else {
                    console.log("L'utilisateur a refusé l'installation");
                }
                deferredPrompt = null;
            });
        }
    });

    // Fermer la pop-up si l'utilisateur clique sur "X"
    document.getElementById("close-modal").addEventListener("click", () => {
        document.getElementById("pwa-modal").style.display = "none";
    });
    </script>

    <script defer src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
    <script defer src="<?= base_url('public/js/translate.js'); ?>"></script>

    <?php } ?>
</body>

</html>