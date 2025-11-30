<!-- Content Wrapper. Contains page content -->
<main id="main" class="content-wrapper">
    <!-- ======= Breadcrumbs ======= -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Consultation</li>
                        <li class="breadcrumb-item active">Résultats</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <?php if (isset($school) && (!empty($school))): ?>
            
<?php  $logo_cover = (session()->has('schoolpicture')) ? session()->get('schoolpicture') : ''; ?>

<div class="card">
    <div class="card-footer mt-0"
        style="background: url(<?= base_url('public/uploads/images/'.$logo_cover); ?>);background-repeat: no-repeat; background-size: cover;">

        <div class="text-center">
            <h1 class=" text-uppercase font-weight-bold">
                <b><?= (session()->has('schoolfname')) ? (session()->get('schoolfname')) : '  '; ?></b>
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-5 col-sm-5 border-right">
                <div class="text-right">
                    <address class="ml-1">

                        <span class="text-uppercase font-weight-bold small">
                            Adresse:
                            <?= (session()->has('schooladdress')) ? wordwrap(session()->get('schooladdress'), 30, "<br>\n") : ''; ?>
                        </span>
                        <br>
                        <span class="font-weight-bold">
                            Téléphone:<?= (session()->has('schoolphone')) ? (session()->get('schoolphone')) : ''; ?>
                            <br>Email: <span class="text-lowercase">
                                <?= (session()->has('schoolemail')) ? (session()->get('schoolemail')) : ''; ?>
                            </span>
                        </span>
                        <br>

                    </address>
                </div>
            </div>

            <?php  if(session()->has('schoollogo')): ?>
            <div class="col-lg-2 col-sm-2">
                <div class="text-center">
                    <?php   $logo = base_url('public/uploads/images/'.session()->get('schoollogo')); 
                                        $magstore_logo = base_url('public/img/logo/favicon.png');
                                        $valid_logo = (session()->get('schoollogo'))? $logo: $magstore_logo;
                                ?>
                    <div class="">
                        <img src="<?= $valid_logo; ?>" alt="<?= $logo; ?>" class="school-logo school-logo-medium">
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-lg-5 col-sm-5 small border-left">
                <div class="text-left">
                    <span class="text-uppercase">
                        <b>
                            Periode de formation :
                            <?= (session()->has('schoolyear')) ? session()->get('schoolyear') : '-'; ?>
                        </b>
                    </span>
                    <br>
                    <span class="text-uppercase <?= (session()->has('choosedsectionname')) ? '': 'd-none'; ?>">
                        <b>Domaine de formation:
                            <?= (session()->has('choosedsectionname')) ? session()->get('choosedsectionname') : '-'; ?>
                        </b>
                    </span>
                    <br>
                    <span class="text-uppercase <?= (session()->has('choosedclassename')) ? '': 'd-none'; ?>">
                        <b>Option choisie:
                            <?= (session()->has('choosedclassename')) ? session()->get('choosedclassename') : '-'; ?>
                        </b>
                    </span>
                    <br>
                    <br>
                    <span class="text-uppercase font-weight-bold">
                        <b>Edition du <?= date("d/m/Y"); ?> à <b><?= date('H:i:s') ?></b></b>
                    </span>
                    <br>
                    <span class="text-uppercase font-weight-bold">
                        <b><?= isset($user) ? "Agent Percepteur: ". $user['user_firstname'].' '.$user['user_lastname']:''; ?></b>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php endif; ?>
        <?php if (isset($student) && (!empty($student))): ?>

            <div class="page-header d-flex align-items-center" style="background-image: url('');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="text-center fw-bold text-light h3">

                                        <?php if (isset($result) && (!empty($result))): ?>
                                            <?php if ($result['result_available'] == 0 && ($result['result_status'] != 'published')): ?>
                                                <div class="fw-bold alert alert-danger mt-3 text-center">
                                                    Désolé, vos résultats ne sont pas encore disponible sur la plateforme.
                                                    Veuillez réessayer plus tard !
                                                </div>
                                            <?php elseif ($result['result_available'] == 0 && ($result['result_status'] == 'published')): ?>
                                                <div class="fw-bold alert alert-danger text-center h5">
                                                    Désolé, vous devez être en order avec la comptabilité pour avoir
                                                    accès aux résultats !
                                                </div>
                                            <?php else: ?>
                                                <div class="fw-bold text-center py-3 bg-info text-uppercase">
                                                    <?php
                                                    $percentage = $result['result_percentage'];
                                                    $result_percentage = ($percentage != 0) ? $percentage : ($result['result_points_obtained'] * 100 / $result['result_points_maximum']);
                                                    ?>
                                                    <span class="fw-bold text-<?= ($percentage < 50) ? 'danger' : 'success'; ?>">
                                                        <?= ($percentage < 50) ? 'Dommage !' : 'Félicitations !'; ?>
                                                    </span>
                                                    Notes:
                                                    <span class="fw-bold text-<?= ($percentage < 50) ? 'danger' : 'success'; ?> h3">
                                                        <?= number_format($percentage, 2); ?>%
                                                    </span>
                                                    <br>
                                                    <?= $result['result_place']; ?><?= ($result['result_place'] == 1) ? 'ère' : 'ème'; ?>
                                                    de l'option choisie.

                                            </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="alert alert-danger mt-3 text-center">
                                                Désolé, vos résultats ne sont pas encore disponible sur la plateforme.
                                                Veuillez réessayer plus tard ou à l'heure indiquée!
                                                
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <?php if (isset($result) && (!empty($result))): ?>
                                <?php if ($result['result_available'] == 1 && (($result['result_status'] == 'published') OR ($result['result_status'] == 'actif'))): ?>
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12 text-center">
                                                <h1 class="fw-bold text-uppercase">
                                                    Résultat synthètique
                                                    <br>
                                                    <<<span class="text-danger">
                                                        <?= $result['period_name']; ?>
                                                        </span>>>
                                                </h1>
                                                <p class="text-uppercase h1">
                                                    <i class="bi bi-mortarboard-fill"></i>
                                                    [ <span class="text-success fw-bold">
                                                        <?= $result['year_started']; ?>-
                                                        <?= $result['year_ended']; ?>
                                                    </span> ]
                                                    <i class="bi bi-mortarboard-fill"></i>
                                                </p>
                                                <hr>
                                            </div>

                                            <div class="col-sm-12 col-lg-12 about">
                                                <div class="content ps-0 ps-lg-5">
                                                    <h4 class="fw-bold"> <i class="bi bi-person-circle"></i>
                                                        Coordonnées:</h4>

                                                    <ul style="margin-left: 20px!important;" class="h5">
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Matricule: <span class="fw-bold text-primary">
                                                                <?= trim($student['student_code']); ?>
                                                            </span>
                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Noms: <span class="fw-bold text-primary text-capitalize">
                                                                <?= trim($student['student_firstname']); ?>
                                                                <?= trim($student['student_lastname']); ?>
                                                                <?= trim($student['student_surname']); ?>
                                                            </span>
                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Sexe:<span class="fw-bold text-primary text-capitalize">
                                                                <?= trim($student['student_gender']); ?>
                                                            </span>

                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Option choisie: <span class="fw-bold text-primary">
                                                                <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                                                <?= trim($student['classe_subname']); ?>
                                                                <?= trim($student['option_name']); ?>
                                                            </span>
                                                        </li>
                                                    </ul>

                                                    <h4 class="fw-bold"> <i class="bi bi-journal-album"></i>
                                                        Résultat final:</h4>
                                                    <ul style="margin-left: 20px!important;" class="h5">
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Place: <span class="fw-bold text-primary">
                                                                <?= $result['result_place']; ?><?= ($result['result_place'] == 1) ? 'ère' : 'ème'; ?>
                                                            </span>
                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Pourcentage:
                                                            <?php
                                                            $percentage = $result['result_percentage'];
                                                            $result_percentage = ($percentage != 0) ? $percentage : ($result['result_points_obtained'] * 100 / $result['result_points_maximum']);
                                                            ?>
                                                            <span class="fw-bold  text-primary">
                                                                <?= number_format($percentage, 2); ?>%
                                                            </span>
                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Points obtenus:<span class="fw-bold text-<?= ($result['result_points_obtained'] != 0) ? 'primary' : 'danger'; ?>">
                                                                <?= ($result['result_points_obtained'] != 0) ? $result['result_points_obtained'] : 'Cfr Bulletin'; ?>
                                                            </span>

                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Maxima Général:<span class="fw-bold text-<?= ($result['result_points_maximum'] != 0) ? 'primary' : 'danger'; ?>">
                                                                <?= ($result['result_points_maximum'] != 0) ? $result['result_points_maximum'] : 'Cfr. Bulletin'; ?>
                                                            </span>

                                                        </li>
                                                    </ul>
                                                    <h4 class="fw-bold"> <i class="bi bi-mortarboard-fill"></i>
                                                        Appréciations:</h4>

                                                    <ul style="margin-left: 20px!important;" class="h5">
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Application: <span class="fw-bold text-primary">
                                                                <?php
                                                                $application = "";

                                                                if ($percentage >= 79.5 && $percentage <= 100) {
                                                                    $application = "E";
                                                                } elseif ($percentage >= 69.5 && $percentage < 79.5) {
                                                                    $application = "TB";
                                                                } elseif ($percentage >= 50 && $percentage < 69.5) {
                                                                    $application = "B";
                                                                } elseif ($percentage >= 39.5 && $percentage < 49.5) {
                                                                    $application = "ME";
                                                                } elseif ($percentage >= 0 && $percentage < 39.5) {
                                                                    $application = "MA";
                                                                }

                                                                echo $application;

                                                                ?>
                                                            </span>
                                                        </li>
                                                        <li><i class="bi bi-check-circle-fill"></i>
                                                            Conduite: <span class="fw-bold text-primary">
                                                                <?= trim($result['result_application']); ?>

                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">

                                        <a href="#" onclick="print()"
                                            class="btn btn-success btn-sm text-uppercase printoff">
                                            <i class="bi bi-printer-fill"></i>Imprimer (CTRL + P)
                                        </a>
                                        <a href="<?= base_url(); ?>"
                                            class="btn btn-primary btn-sm text-uppercase printoff">
                                            <i class="bi bi-star-fill"></i>Terminer
                                        </a>

                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php if (isset($student) && (empty($student))): ?>
                <div class="container">
                    <div class="card ">
                        <div class="shadow-lg alert alert-danger ">
                            <h3 class="mt-3 text-center">
                                Publication résultats non disponible. Réessayer plus tard !
                            </h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div><!-- End Breadcrumbs -->
</main>