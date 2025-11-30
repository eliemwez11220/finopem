<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6 col-lg-6">
                    <h5 class="font-weight-bold text-uppercase text-left">Consultation Résultats</h5>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Consultation</li>
                        <li class="breadcrumb-item active">Résultats Scolaires</li>
                    </ol>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="">
                        <form id="formSearchAdvanced" method="get" action="<?= base_url('resultsearch'); ?>">
                            <div class="d-inline shadow-lg">
                                <div class="input-group">
                                    <input class="form-control form-control-lg" type="search" name="query"
                                        id="student-search" placeholder="Saisissez votre numéro matricule élève pour consulter vos Résultats"
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
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (isset($student) && (!empty($student))): ?>
        <?php $studentavatar = $student['student_picture'];
        $avatar = base_url('public/uploads/images/' . $studentavatar);
        $defavatar = ($student['student_gender'] == 'masculin') ? 'avatar.png' : 'expertwoman.png';
        $pathdefavatar = base_url('public/img/' . $defavatar);
        ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- ====== Start Reporting Header -->
                <?php include APPPATH . ('Views/reporting/header.php'); ?>
                <!-- ====== End Reporting Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12 text-center">
                                        <h1 class="font-weight-bold text-uppercase">
                                            Résultat synthètique de l'élève
                                    
                                    
                                        <br>
                                        <<<span class="text-danger border">
                                            <?= $result['period_name']; ?>
                                            </span>>>
                                    </h1>
                                    <p class="text-uppercase h1 lined lined-center">
                                        <i class="bi bi-mortarboard-fill"></i>
                                        [ <span class="text-success fw-bold">
                                            <?= $result['year_started']; ?>-
                                            <?= $result['year_ended']; ?>
                                        </span> ]
                                        <i class="bi bi-mortarboard-fill"></i>
                                    </p>
                                    <hr>
                                </div>
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="d-flex">
                                        <img src="<?= (!empty($studentavatar)) ? $avatar : $pathdefavatar; ?>" alt="..."
                                            class="avatar avatar-lg">

                                        <h5 class="text-uppercase font-weight-bold ml-3">
                                            N° ID: <?= (($student['student_code'])); ?> <br />
                                            <span class="text-primary">
                                                <?= (($student['student_firstname'])); ?>
                                                <?= (($student['student_lastname'])); ?>
                                                <?= (($student['student_surname'])); ?>
                                            </span>
                                            <br />
                                            <span class="text-danger">
                                                <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                                <?= ucfirst(($student['classe_subname'])); ?>
                                                <?= ucfirst(($student['option_name'])); ?>
                                            </span>
                                        </h5>
                                    </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                    <div class="text-center mt-2">
                                        <?php if (isset($result) && (!empty($result))): ?>
                                            <?php if ($result['result_available'] == 0 && ($result['result_status'] != 'published')): ?>
                                                <span class="font-weight-bold text-danger mt-3 text-center">
                                                    Résultats non disponible. Réessayer plus tard !
                                                </span>
                                            <?php elseif ($result['result_available'] == 0 && ($result['result_status'] == 'published')): ?>
                                                <span class="font-weight-bold text-danger text-center h5">
                                                    Désolé, vous devez être en order avec la comptabilité pour avoir accès aux résultats ! 
                                                </span>
                                            <?php else: ?>
                                                <h5 class="font-weight-bold text-center text-uppercase">
                                                <?php 
                                                    $percentage =$result['result_percentage'];
                                                    $result_percentage = ($percentage != 0) ?$percentage: ($result['result_points_obtained'] * 100 / $result['result_points_maximum']);
                                                    ?>
                                                    Notes: <?= number_format($percentage, 2); ?>%
                                                    <br>
                                                    <?= $result['result_place']; ?><?= ($result['result_place'] == 1) ? 'ère' : 'ème'; ?>
                                                    de la classe.
                                                    
                                                </h5>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="alert alert-danger mt-3 text-center">
                                                    Résultats Introuvables. Réessayer plus tard !
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($result) && (!empty($result))): ?>
                                <?php if ($result['result_available'] == 1 && ($result['result_status'] == 'published')): ?>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatablesWithoutActions"
                                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr class="text-uppercase">
                                                        <th width="20%"></th>
                                                        <th width="80%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>Numéro Serni</td>
                                                        <td class="text-uppercase"><?= (($student['student_sernie_id'])); ?></td>
                                                    </tr>


                                                    <tr>
                                                        <td>Sexe</td>
                                                        <td class="text-uppercase"><?= (($student['student_gender'])); ?> </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Date de naissance</td>
                                                        <td class="text-uppercase"><?= (($student['student_birthday'])); ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lieu de naissance</td>
                                                        <td class="text-uppercase"><?= (($student['student_born_place'])); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Ecole provenance</td>
                                                        <td class="text-uppercase"><?= (($student['inscription_origin_school'])); ?>
                                                        </td>
                                                    </tr>

                                                   
                                                    <tr class="alert alert-secondary">
                                                        <td colspan="2" class="text-uppercase">
                                                            <strong>
                                                                Infos sur parents
                                                            </strong>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tuteur</td>
                                                        <td class="text-uppercase">
                                                            <?= (($student['parent_tutor_name'])); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Père</td>
                                                        <td class="text-uppercase">
                                                            <?= (($student['parent_father_name'])); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mère</td>
                                                        <td class="text-uppercase">
                                                            <?= (($student['parent_mother_name'])); ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="alert alert-info">
                                                        <td colspan="2" class="text-uppercase">
                                                            <strong>
                                                                Résultat scolaire de l'élève
                                                            </strong>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Place</td>
                                                        <td class="text-lowercase font-weight-bold">

                                                            <?= $result['result_place']; ?><?= ($result['result_place'] == 1) ? 'ère' : 'ème'; ?> de la classe
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pourcentage</td>
                                                        <td class="text-uppercase">
                                                        <?php 
                                                    $percentage =$result['result_percentage'];
                                                    $result_percentage = ($percentage != 0) ?$percentage: ($result['result_points_obtained'] * 100 / $result['result_points_maximum']);
                                                    ?>
                                                    <?= number_format($percentage, 2); ?>%
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Points obtenus</td>
                                                        <td class="text-uppercase font-weight-bold <?= ($result['result_points_obtained'] !=0) ? 'bg-info':''; ?>">
                                                            <?= ($result['result_points_obtained'] !=0) ? $result['result_points_obtained']:'Confère Bulletin élève'; ?>
                                                            <?= ($result['result_points_maximum'] !=0) ? '/'. $result['result_points_maximum']:''; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Conduite</td>
                                                        <td class="text-uppercase">
                                                            <?= $result['result_application']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Application</td>
                                                        <td class="text-uppercase">
                                                            <?= $result['result_decision']; ?>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">

                                        <a href="#" onclick="print()"
                                            class="btn btn-success btn-sm text-uppercase printoff">Imprimer (CTRL + P)</a>

                                        <embed src="" type="application/pdf" controls
                                            style="height:50%!important;width:100%!important;">

                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <?php if (isset($student) && (empty($student))): ?>
            <div class="container">
                <div class="card ">
                    <div class="shadow-lg alert alert-danger ">
                        <h3 class="mt-3 text-center">
                            Résultats Introuvables. Réessayer plus tard !
                        </h3>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
