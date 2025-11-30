<div class="content-wrapper">
    <section class="content-header printoff">
        <div class="container-fluid">
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
                    <select id="year" name="year"
                        class="form-control ">
                        <option selected disabled>--sélectionnez--</option>

                        <?php if (isset($years) && !empty($years)):
                        $yearchoosed = (isset($year) && (!empty($year)))?$year['year_id']:''; 
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
    </section>
    <?php  if (session()->has('yeardata') && (session()->has('schooldata'))): ?>

    <?php if(isset($year) && (!empty($year))):?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <?php  
                    $schooldata = session()->get('schooldata');

                    $logo_cover = $schooldata['school_picture_cover']; ?>

                    <div class="card">
                        <div class="card-footer mt-0"
                            style="background: url(<?= base_url('public/uploads/images/'.$logo_cover); ?>);background-repeat: no-repeat; background-size: cover;">

                            <div class="text-center">
                                <h1 class=" text-uppercase font-weight-bold">
                                    <b><?= $schooldata['school_fullname']; ?></b>
                                </h1>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5 border-right">
                                    <div class="text-right">
                                        <address class="ml-1">

                                            <span class="text-uppercase font-weight-bold small">
                                                Adresse:
                                                <?= wordwrap($schooldata['school_address'], 30, "<br>\n"); ?>
                                            </span>
                                            <br>
                                            <span class="font-weight-bold">
                                                Téléphone:<?= $schooldata['school_phone']; ?>
                                                <br>Email: <span class="text-lowercase">
                                                    <?= $schooldata['school_email']; ?>
                                                </span>
                                            </span>
                                            <br>

                                        </address>
                                    </div>
                                </div>

                                <?php  if(!empty($schooldata['school_logo'])): ?>
                                <div class="col-lg-2 col-sm-2">
                                    <div class="text-center">
                                        <?php   $logo = base_url('public/uploads/images/'.$schooldata['school_logo']); 
                                        $magstore_logo = base_url('public/img/logo/favicon.png');
                                        $valid_logo = (!empty($schooldata['school_logo']))? $logo: $magstore_logo;
                                ?>
                                        <div class="">
                                            <img src="<?= $valid_logo; ?>" alt="<?= $logo; ?>"
                                                class="school-logo school-logo-medium">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="col-lg-5 col-sm-5 small border-left">
                                    <div class="text-left">
                                        <span class="text-uppercase">
                                            <b>
                                                Année scolaire :
                                                <?=  $year['year_started'] .'-'. $year['year_ended']; ?>
                                            </b>
                                        </span>
                                        <br>
                                        <span class="text-uppercase">
                                            <b>Classe: Générale
                                            </b>
                                        </span>
                                        <br>
                                        <span class="text-uppercase">
                                            <b>Rapport du
                                                <?= isset($start) ? date("d/m/Y", strtotime($start)): date('d/m/Y'); ?>
                                                au
                                                <?= isset($end) ? date("d/m/Y", strtotime($end)): date('d/m/Y'); ?>
                                            </b>
                                        </span>
                                        <br>
                                        <span class="text-uppercase font-weight-bold">
                                            <b>Edition du <?= date("d/m/Y H:i:s"); ?></b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">

                    <div class="text-center shadow-lg" style="border:2px solid black">
                        <h1 class="text-uppercase font-weight-bold">
                            Liste des élèves inscrits en <?=$year['year_started'] .'-'. $year['year_ended']; ?>
                        </h1>
                    </div>

                    <div class="table-responsive">
                        <table id="datatablesReportingActions"
                            class="table table-sm table-bordered table-hover table-head-fixed">
                            <thead>
                                <tr class="text-uppercase small">
                                    <th>#</th>
                                    <th>Matricule</th>
                                    <th>Noms Elève</th>
                                    <th>Sexe</th>
                                    <th>Classe</th>
                                    <th>Nationalité</th>
                                    <th>Naissance</th>
                                    <th>Inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    $students_listing =  array();
                                    if((session()->studentsclasses)){
                                        if(session()->studentsclasses == 'none'){
                                            $students_listing =  array();
                                        }else{
                                            $students_listing = session()->studentsclasses;
                                        }
                                    }else{
                                        if (isset($students)){
                                            $students_listing =  $students;
                                        }
                                    }
                                   
                                    if (isset($students_listing) && (!empty($students_listing))):
                                        foreach ($students_listing as $key => $value):
                                          ?>
                                <tr class="small">
                                    <td scope="1"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?= esc($value['student_code']); ?></td>
                                    <td class="text-uppercase">
                                        <?= esc($value['student_firstname']); ?>
                                        <?= esc($value['student_lastname']); ?>
                                        <?= esc($value['student_surname']); ?>

                                    </td>
                                    <td class="text-uppercase">
                                        <?= ($value['student_gender'] == 'masculin')?'M':'F'; ?></td>
                                    <td class="text-uppercase">
                                        <?= (!empty($value['classe_shortname'])) ? $value['classe_shortname']:$value['degree_shortname'].' '.($value['classe_subname']).' '.($value['option_name']); ?>

                                    </td>
                                    <td class="text-uppercase"><?= (($value['student_nationality'])); ?></td>

                                    <td class="text-uppercase">
                                        <?= esc($value['student_born_place']); ?>,
                                        le <?= date("d/m/Y", strtotime($value['student_birthday'])); ?>
                                    </td>
                                    <td class="text-uppercase">
                                        <?= date("d/m/Y", strtotime($value['inscription_date'])); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="printoff">
                        <div class="text-center ">
                            <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-sm"
                                onclick="window.print();">
                                <i class="fa fa-print"></i> Imprimer ce rapport</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endif; ?>
</div>