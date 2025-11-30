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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Internal Errors - Magschool
    </title>
    <link rel="icon" type="image/png" href="<?= base_url('public/img/logo/favicon.png'); ?>" />
    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/bootstrap/css/bootstrap.css'); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/fontawesome/css/all.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/css/main-styles.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/auth-styles.css'); ?>">
    <style>
    .bg-primary {
        background-color: #0a2f53 !important;
    }
    </style>
</head>

<body>
    <div class="container text-center">
        <div class="row">
        <div class="col-sm-6 col-lg-6">
                <img class="img-fluid  h-100 w-100" src="<?= base_url('public/img/error-500.png'); ?>" alt="Not Found">
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="text-center mt-5">
                    <h1 class="error-title fw-bold lined lined-center">Dysfonctionnement Système!</h1>
                    <p class="lead">
                        Un dysfonctionnement système a été rencontré suite de votre action déclenchée.
                        Veuillez réessayer plus tard. Si le problème persiste,
                        veuillez contacter votre administrateur pour vous dépanner.
                    </p>
                    <hr>
                    <p>
                        La solution palliative est celle d'exécuter les actions ci-dessous.
                    </p>
                    <a href="<?= base_url(); ?>" class="btn btn-lg btn-danger">
                        Accueil</a>
                    <a href="javascript:history.back();" class="btn btn-lg btn-primary">
                        Page précédente</a>
                    <a href="mailto:magschool@ditotase.com" class="btn btn-lg btn-success">
                        Contactez le fournisseur</a>
                </div>
            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="shadow-lg fixed-bottom bg-primary">
            <div class="row">
                <?php $link_developper = "https://ditotase.com"; ?>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <p class="text-white float-right font-weight-bold  mt-4">
                        <b>Magschool</b> &copy; <?= date('Y'); ?> Tous droits réservés
                        <br>
                        <span class="text-sm">Designed & developped by
                            <a href="<?= $link_developper; ?>" rel="nofollow" target="_blank"
                                class="btn btn-danger">DITOTASE AGENCY</a>
                        </span>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 border-left border-primary">
                    <div class="float-left">
                        <a href="<?= $link_developper; ?>" class="mt-3">
                            <img class="brand-logo mt-3" src="<?= base_url('public/img/logo/ditotase.png'); ?>"
                                alt="Magstore Logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>