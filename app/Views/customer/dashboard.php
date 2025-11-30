<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid mb-3">
            <div class="card">
                <blockquote>
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-xs-12">
                            <div class="form-floating">
                                <select id="ajax_school" name="ajax_school" class="form-control">
                                    <option selected disabled>--sélectionnez--</option>

                                    <?php if (isset($schools) && !empty($schools)):
                                        foreach ($schools as $schoolkey => $school): ?>
                                    <option value="<?= ($school['school_id']);?>"
                                        <?= (session()->has('schoolchoosed') && (session()->get('schoolchoosed')==$school['school_id']))? 'selected' : set_select('ajax_school', ($school['school_id']));?>>
                                        <?= strtoupper($school['school_fullname']);?>
                                        [<?= strtoupper($school['school_code']);?>]
                                    </option>
                                    <?php endforeach;?>
                                    <?php endif;?>

                                </select>
                                <label for="ajax_school" class="control-label">
                                    <span class="text-danger">*</span>Etablissement
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-12 <?= (session()->has('schoolchoosed')) ? '':'d-none' ?>">
                            <div class="form-floating">
                                <select id="year" name="year" class="form-control ">
                                    <option selected disabled>--sélectionnez--</option>

                                    <?php if (isset($years) && !empty($years)): 
                                    $yearchoosed = (session()->has('yearchoosed'))?session()->get('yearchoosed'):''; 
                                    foreach ($years as $yearkey => $yearvalue): ?>
                                    <option value="<?= ($yearvalue['year_id']);?>"
                                        <?= ($yearchoosed ==$yearvalue['year_id'])? 'selected' : set_select('year', ($yearvalue['year_id']));?>>
                                        <?= ($yearvalue['year_started']);?>-<?= ($yearvalue['year_ended']);?>
                                    </option>
                                    <?php endforeach;?>
                                    <?php endif;?>

                                </select>
                                <label for="year" class="control-label">
                                    <span class="text-danger">*</span>Année d'études
                                </label>

                            </div>
                        </div>
                    </div>
                </blockquote>

            </div>
            <div class="row">

                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold">Tableau de bord
                        [<?= (session()->has('schoolyear')) ? session()->schoolyear : '-'; ?>]</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <div class="dropdown">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="font-weight-bold">Actions rapides</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('admincustomer/finances'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Finances
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('admincustomer/students'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Inscriptions
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="<?php echo base_url('admincustomer/statistics'); ?>"
                                        class="btn btn-outline-primary btn-block">
                                        Statistiques
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
    <?php  if (session()->has('yearchoosed')): ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <?= (isset($nb_eleves) ? $nb_eleves : ''); ?>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold text-uppercase">
                                Effectif Elèves</span>
                            <span class="info-box-number small ">

                            </span>
                        </div>
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <?= (isset($garcons) ? $garcons: ''); ?>
                        </span>
                        <div class="info-box-content"><span class="info-box-text text-uppercase">Total</span>
                            <span class="info-box-number font-weight-bold">Elèves Garçons</span>
                        </div>
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <?= (isset($filles) ? $filles: ''); ?>
                        </span>
                        <div class="info-box-content"><span class="info-box-text text-uppercase">Total</span>
                            <span class="info-box-number font-weight-bold">Elèves Filles</span>
                        </div>
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-users"></i>
                        </span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1">
                            <?= (isset($nb_parents) ? $nb_parents: ''); ?>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase font-weight-bold">Parents</span>

                        </div>
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-user-secret"></i></span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3 ">
                        <span class="info-box-icon bg-info elevation-1">
                            <?= (isset($nb_classes) ? $nb_classes: ''); ?>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase">Classes</span>
                            <span class="info-box-number small font-weight-bold ">

                            </span>
                        </div>
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-cogs"></i></span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1">
                            <?= (isset($nb_agents) ? $nb_agents: ''); ?>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase">Agents</span>
                            <span class="info-box-number small font-weight-bold ">

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
            <!-- /.row -->
            <div class="row mb-2">
                <div class="col-12 col-lg-12 col-sm-12">
                    <div class="row">
                        <?php if (isset($sections) && !empty($sections)):
                    $section_total = 0;
                    $section_man = 0;
                    $section_woman = 0;
                    foreach ($sections as $keysec => $section): ?>

                        <div class="col-12 col-lg-4 col-sm-12">

                            <div class="text-center py-3 mt-2 my-2" style="border:2px solid blue; border-radius:15px">
                                <h3 class="text-uppercase font-weight-bold">
                                    <?= $section['section_name']; ?>
                                </h3>
                                <?php 
                        if (isset($students) && !empty($students)):
                            $student_total = 0;
                            $student_man = 0;
                            $student_woman = 0;
                            foreach ($students as $studkey => $studval): 
                                if($studval['section_id'] == $section['section_id']){

                                    $student_total++;

                                    if($studval['student_gender'] == 'masculin'){

                                        $student_man++;

                                    }else{

                                        $student_woman++;
                                    }
                                }
                        ?>
                                <?php endforeach; ?>
                                <?php 
                            $section_total = $student_total;
                            $section_man =$student_man;
                            $section_woman =$student_woman;
                            ?>
                                <?php endif; ?>
                                <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1">
                                        <?= $section_total; ?>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text font-weight-bold text-uppercase mb-2">

                                            <i class="fas fa-users"></i> élèves inscrits
                                        </span>
                                        <span class="info-box-text font-weight-bold text-uppercase">
                                            <span class="font-weight-bold">
                                                <?= $section_woman; ?></span>
                                            Fille(s) / <span class="font-weight-bold">
                                                <?= $section_man; ?></span> Garçon(s)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-12 col-lg-4 col-sm-12 clearfix">
                    <?php if (isset($sections) && !empty($sections)):
                        $section_total = 0;
                        $section_man = 0;
                        $section_woman = 0;
                        foreach ($sections as $keysec => $section): ?>
                            <div class="row">
                                <div class="col-12 col-lg-12 col-sm-12">

                                    <div class="text-center py-3 mb-2" style="border:2px solid blue; border-radius:15px">
                                        <h3 class="text-uppercase font-weight-bold h5">
                                            <?= $section['section_name']; ?>
                                        </h3>
                                        <?php
                                        if (isset($students) && !empty($students)):
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

                                                    <i class="fas fa-users"></i> élèves inscrits
                                                </span>
                                                <span class="info-box-text font-weight-bold text-uppercase">
                                                    <span class="font-weight-bold">
                                                        <?= $section_woman; ?></span>
                                                    Fille(s) / <span class="font-weight-bold">
                                                        <?= $section_man; ?></span> Garçon(s)
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>