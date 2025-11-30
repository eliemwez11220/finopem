<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2 <?= checkModuleAccess('dashboard'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid mb-3">

            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold">Tableau de bord
                        [<?= (session()->schoolyear ? (session()->schoolyear) : date("Y")); ?>]</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <div class="dropdown">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="font-weight-bold">Actions rapides</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                <li
                                    class="dropdown-item <?= (session()->student == TRUE or session()->all == TRUE) ? '' : 'd-none'; ?>">
                                    <a href="<?php echo base_url('student/registration'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Inscription candidat
                                    </a>
                                </li>

                                <li
                                    class="dropdown-item <?= (session()->fees == TRUE or session()->all == TRUE) ? '' : 'd-none'; ?>">
                                    <a href="<?php echo base_url('payments'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Perception frais
                                    </a>
                                </li>
                                <li
                                    class="dropdown-item <?= (session()->reporting == TRUE or session()->all == TRUE) ? '' : 'd-none'; ?>">
                                    <a href="<?php echo base_url('reporting/payments'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Rapport journalier
                                    </a>
                                </li>
                                <li
                                    class="dropdown-item <?= (session()->reporting == TRUE or session()->all == TRUE) ? '' : 'd-none'; ?>">
                                    <a href="<?php echo base_url('reporting/cashbox'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Journal caisses
                                    </a>
                                </li>
                                <li
                                    class="dropdown-item <?= (session()->reporting == TRUE or session()->all == TRUE) ? '' : 'd-none'; ?>">
                                    <a href="<?php echo base_url('reporting/students'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Registre d'identification
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <!-- pie -->
                <div class="col-12 col-lg-4 col-sm-12 clearfix">
                    <div class="card">
                        <div class="header text-center">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 py-3">
                                    <h5 class="text-uppercase font-weight-bold">
                                        <b>Effectifs des étudiants</b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">

                            <!-- START CHART GRAPHICAL -->
                            <!-- <canvas id="pieChart"></canvas> -->
                            <canvas id="my_Pie_Chart"></canvas>
                            <!-- START CHART GRAPHICAL -->
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                                    <ul class="dashboard-stat-list list-group py-3">
                                        <li class="list-group-item border-bottom shadow-sm mb-2">

                                            <a href="<?= base_url('student/listing'); ?>">
                                                <b>
                                                    Effectif Global
                                                </b>
                                                <span class="float-right font-weight-bold">
                                                    <b><?= (isset($nb_eleves)) ? $nb_eleves : ''; ?></b>
                                                    <b>(<?= (isset($nb_eleves) && !empty($nb_eleves)) ? number_format(($nb_eleves * 100) / $nb_eleves, 1) : ''; ?>%)</b>
                                                </span>
                                            </a>

                                        </li>
                                        <li class="list-group-item border-bottom shadow-sm mb-2">
                                            <a href="<?= base_url('student/listing'); ?>">
                                                <b>
                                                    Total Hommes
                                                </b>
                                                <span class="float-right font-weight-bold">
                                                    <b><?= (isset($garcons) ? $garcons : ''); ?></b>
                                                    <b>(<?= (isset($garcons) && !empty($nb_eleves)) ? number_format(($garcons * 100) / $nb_eleves, 1) : ''; ?>%)</b>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="list-group-item border-bottom shadow-sm mb-2">
                                            <a href="<?= base_url('student/listing'); ?>">
                                                <b>
                                                    Total Femmes
                                                </b>
                                                <span class="float-right font-weight-bold">
                                                    <b><?= (isset($filles) ? $filles : ''); ?></b>

                                                    <b>(<?= (isset($filles) && !empty($nb_eleves)) ? number_format(($filles * 100) / $nb_eleves, 1) : ''; ?>%)</b>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-sm-12 clearfix">
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info elevation-1">
                                    <?= (isset($nb_parents) ? $nb_parents : ''); ?>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase font-weight-bold">Personnel</span>
                                    <span class="info-box-number small font-weight-bold">
                                        <a href="<?php echo base_url('payroll/employees'); ?>">
                                            Consulter les fiches
                                        </a>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-users"></i></span>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info elevation-1">
                                    <?= (isset($nb_sections) ? $nb_sections : ''); ?>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase font-weight-bold">Facultés</span>
                                    <span class="info-box-number small font-weight-bold ">
                                        <a href="<?php echo base_url('config/sections'); ?>">
                                            Voir le paramètrage
                                        </a>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-cogs"></i></span>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info elevation-1">
                                    <?= (isset($nb_options) ? $nb_options : ''); ?>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase font-weight-bold">Filières
                                        organisées</span>
                                    <span class="info-box-number small font-weight-bold ">
                                        <a href="<?php echo base_url('config/options'); ?>">
                                            Voir le paramètrage
                                        </a>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-cogs"></i></span>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info elevation-1">
                                    <?= (isset($nb_classes) ? $nb_classes : ''); ?>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase font-weight-bold">Promotions</span>
                                    <span class="info-box-number small font-weight-bold ">
                                        <a href="<?php echo base_url('config/classes'); ?>">
                                            Voir la configuration
                                        </a>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-cogs"></i></span>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info elevation-1">
                                    <?= (isset($nb_agents) ? $nb_agents : ''); ?>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase font-weight-bold">Utilisateurs</span>
                                    <span class="info-box-number small font-weight-bold ">
                                        <a href="<?php echo base_url('admin/view/users'); ?>">
                                            Voir les comptes
                                        </a>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-users-edit"></i></span>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-info elevation-1">
                                    <?= (isset($nb_teachers) ? $nb_teachers : ''); ?>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-uppercase font-weight-bold">Enseignants</span>
                                    <span class="info-box-number small font-weight-bold ">
                                        <a href="<?php echo base_url('education/teachers'); ?>">
                                            Voir les enseignants
                                        </a>
                                    </span>
                                </div>
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-users-cog"></i></span>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-light">
                            <div class="py-3 text-center">
                                <h4 class="gy-3 h5 text-uppercase font-weight-bold">
                                    <b>Transactions financières </b>
                                </h4>

                                <h5 class="gy-3 text-uppercase font-weight-bold">
                                    <b class="">Statistiques - Exercice
                                        <?= (session()->has('schoolyear')) ? session()->schoolyear : '-'; ?>
                                    </b>
                                </h5>
                                <hr>
                            </div>
                            <div class="mb-3" style="width: 100%; margin: auto;">
                                <canvas id="Finances_Pie_Chart"></canvas>
                            </div>
                            <div class="text-center">
                                <div class="py-3">
                                <a class="btn btn-outline-primary" href="<?php echo base_url('finances/cashbox'); ?>">
                                                Voir le détail des opérations
                                            </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-12 col-sm-12 clearfix">
                    <div class="row">
                        <?php if (isset($sections) && !empty($sections)):
                        $section_total = 0;
                        $section_man = 0;
                        $section_woman = 0;
                        foreach ($sections as $keysec => $section): ?>
                        <div class="col-12 col-lg-4 col-sm-12">
                            <div class="text-center py-3 mb-2" style="border:2px solid blue; border-radius:15px">
                                <h3 class="text-uppercase font-weight-bold h5">
                                    <?= $section['section_name']; ?>
                                </h3>
                                <?php if (isset($students) && !empty($students)):
                                            $student_total = 0;
                                            $student_man = 0;
                                            $student_woman = 0;
                                            foreach ($students as $studkey => $studval):
                                                if (($studval['section_id'] == $section['section_id']) && $studval['inscription_status'] == 'actif') {

                                                    $student_total++;

                                                    if ($studval['student_gender'] == 'masculin') {

                                                        $student_man++;

                                                    } else {

                                                        $student_woman++;
                                                    }
                                                }
                                                ?>
                                <?php endforeach; ?>
                                <?php
                                            $section_total = $student_total;
                                            $section_man = $student_man;
                                            $section_woman = $student_woman;
                                            ?>
                                <?php endif; ?>
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary elevation-1">
                                        <?= $section_total; ?>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text font-weight-bold text-uppercase mb-2">

                                            <i class="fas fa-users"></i> étudiants inscrits
                                        </span>
                                        <span class="info-box-text font-weight-bold text-uppercase">
                                            <span class="font-weight-bold">
                                                <?= $section_woman; ?></span>
                                            Femme(s) / <span class="font-weight-bold">
                                                <?= $section_man; ?></span> Homme(s)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-sm-12 clearfix">
                    <div class="card">
                        <div class="header text-center">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 py-3">
                                    <h5 class="text-uppercase font-weight-bold">
                                        <b>Fréquentation mensuelle</b>
                                        <br>
                                        Des étudiants inscrits
                                    </h5>
                                    <hr>
                                    <h5 class="gy-3 text-uppercase font-weight-bold">
                                        <b class="">Statistiques
                                            <?= (session()->has('schoolyear')) ? session()->schoolyear : '-'; ?>
                                        </b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="body bg-light">
                            <canvas id="horizontal_bar_chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <div class="py-3 text-center">
                                <h5 class="gy-3 text-uppercase font-weight-bold">
                                    <b class=" ">Finance - Exercice
                                        <?= (session()->has('schoolyear')) ? session()->schoolyear : '-'; ?>
                                    </b>
                                </h5>

                                <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="body chart">
                                        <canvas id="myChart"></canvas>
                                    </div>

                                    <!--<div class="chart">
                                         Sales Chart Canvas
                                        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                    </div>-->
                                    <!-- /.chart-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>