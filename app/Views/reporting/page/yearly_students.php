
<?php if (session()->has('choosedsection')):
    $choosedsection = session()->get('choosedsection'); ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->
                </div>
            </div>

            
            <div class="row">
                    <?php 
                     $section_total_students = 0;
                     $section_students_active = 0;
                     $section_students_inactive = 0;

                     $students_section = 0;
                     $students_section_man = 0;
                     $students_section_woman = 0;
                     $students_section_active = 0;
                     $students_section_inactive = 0;

                    $sections_listing = [];
                    if (session()->has('usersbranchs')) {
                        if (session()->get('usersbranchs') == 'none') {
                            $sparents_listing = [];
                        } else {
                            $sections_listing = session()->usersbranchs;
                        }
                    } else {
                        if (isset($sections)) {
                            $sections_listing = $sections;
                        }
                    }
                    if (!empty($sections_listing)):
                       
                        foreach ($sections_listing as $keysec => $section): ?>
                            <div class="col-4 col-lg-4 col-sm-4">

                                <div class="text-center py-3 mt-2 my-2" style="border:2px solid blue; border-radius:15px">
                                    <h3 class="text-uppercase font-weight-bold">
                                        <?= $section['section_name']; ?>
                                    </h3>
                                    <?php
                                    if (isset($students) && !empty($students)):
                                        $sec_student_total = 0;
                                        $sec_student_man = 0;
                                        $sec_student_woman = 0;
                                        $sec_student_active = 0;
                                        $sec_student_inactive = 0;
                                        foreach ($students as $studkey => $studval):
                                            if ($studval['section_id'] == $section['section_id']) {

                                                $sec_student_total++;

                                                if ($studval['student_gender'] == 'masculin') {

                                                    $sec_student_man++;

                                                } else {

                                                    $sec_student_woman++;
                                                }
                                                if ($studval['student_status'] == 'actif') {
                                                    $sec_student_active++;
                                                }else {

                                                    $sec_student_inactive++;
                                                }
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                        
                                    <?php endif; ?>
                                    <?php
                                        $students_section = $sec_student_total;
                                        $students_section_man = $sec_student_man;
                                        $students_section_woman = $sec_student_woman;
                                        $students_section_active += $sec_student_active;
                                        $students_section_inactive += $sec_student_inactive;

                                        
                                        ?>
                                    <div class="info-box">
                                        
                                        <div class="info-box-content">
                                            <span class="info-box-text font-weight-bold text-uppercase">
                                                élèves inscrits</span>
                                        </div>
                                        <span class="info-box-icon bg-info elevation-1">
                                            <?= $students_section; ?>
                                        </span>
                                    </div>
                                    <p><i class="fas fa-users"></i>
                                        <span class="font-weight-bold">
                                            <?= $students_section_woman; ?></span>
                                        Fille(s) / <span class="font-weight-bold">
                                            <?= $students_section_man; ?></span> Garçon(s)
                                    </p>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php
                                        $section_total_students += $students_section;
                                        $section_students_active += $students_section_active;
                                        $section_students_inactive += $students_section_inactive;

                                        
                                        ?>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">

                            
                            <span class="info-box-icon">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Eleves Actifs
                                </span>
                            </div>
                            <span class="info-box-icon bg-success  elevation-1 font-weight-bold">
                                <?= $section_students_active ; ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">

                           
                            <span class="info-box-icon">
                                <i class="fas fa-window-close"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Abandons
                                </span>
                            </div>
                            <span class="info-box-icon bg-success elevation-1 font-weight-bold">
                                <?= $section_students_inactive; ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">

                           
                            <span class="info-box-icon">
                                <i class="fas fa-tags"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Total
                                </span>
                            </div>
                            <span class="info-box-icon bg-success elevation-1 font-weight-bold">
                                <?= $section_total_students; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="shadow-lg text-center" style="border:2px solid black">
                <h3 class="text-uppercase font-weight-bold py-3">
                    <span class="text-primary small font-weight-bold">
                        <?= setReporting(session()->get('reportingtype'), "Effectifs annuel des élèves"); ?> -
                        <?= session()->schoolyear; ?>

                        <b class="<?= (session()->has('choosedsectionname')) ? '' : 'd-none'; ?>">
                            de la section
                            <?= (session()->has('choosedsectionname')) ? session()->choosedsectionname : ''; ?>
                        </b>
                    </span>
                </h3>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">

                    <div class="table-responsive">
                        <table id="datatablesWithoutActions"
                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-uppercase font-weight-bold">
                                    <th>#</th>
                                    <th>Classes</th>
                                    <th colspan="3" class="text-center">Effectifs</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr class="text-uppercase text-center font-weight-bold">
                                    <td colspan="2"></td>
                                    <td>F</td>
                                    <td>G</td>
                                    <td>Total</td>
                                </tr>
                                <?php
                                $student_total_man1 = 0;
                                $student_total_woman1 = 0;
                                $classe_counter = 1;


                                $student_total1 = 0;
                                $student_man1 = 0;
                                $student_woman1 = 0;

                                if (isset($classes) && !empty($classes)):
                                    foreach ($classes as $classe):
                                        $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                        if (($branch_access == $classe['section_id']) or (session()->admin == TRUE) or (session()->all == TRUE)):

                                            if ($classe['section_id'] == $choosedsection['section_id']):
                                                if (isset($students) && !empty($students)):
                                                    //$student_total1 = 0;
                                                    $student_f = 0;
                                                    $student_g = 0;
                                                    foreach ($students as $key2 => $parent):

                                                        if ($parent['inscription_classe_id'] == $classe['classe_id']) {

                                                            $student_total1 += 1;

                                                            if ($parent['student_gender'] == 'masculin' && ($parent['inscription_classe_id'] == $classe['classe_id'])) {

                                                                //$student_man1+=1;
                                                                $student_g++;

                                                            } elseif ($parent['student_gender'] == 'feminin' && ($parent['inscription_classe_id'] == $classe['classe_id'])) {


                                                                $student_f++;
                                                                //$student_woman1+=1;
                            
                                                            } else {

                                                            }
                                                        }
                                                        ?>
                                                    <?php endforeach; ?>
                                                    <?php
                                                    $student_man1 = $student_g;
                                                    $student_woman1 = $student_f;
                                                    ?>
                                                <?php endif; ?>
                                                <tr class="">
                                                    <td><?= $classe_counter++; ?></td>
                                                    <td class="text-uppercase">
                                                        <?= (!empty($classe['classe_shortname'])) ? $classe['classe_shortname'] : $classe['degree_shortname'] . ' ' . ($classe['classe_subname']) . ' ' . ($classe['option_name']); ?>
                                                    </td>
                                                    <td class="text-center"><?= $student_man1; ?></td>
                                                    <td class="text-center"><?= $student_woman1; ?></td>
                                                    <td class="text-center"><b><?= $student_man1 + $student_woman1; ?></b></td>
                                                </tr>

                                                <?php
                                                $student_total_man1 += $student_man1;
                                                $student_total_woman1 += $student_woman1;
                                                ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <tr class="font-weight-bold">
                                    <td colspan="2">
                                        <span class="float-right font-weight-bold">Effectif Total</span>
                                    </td>
                                    <td class="text-center"><?= $student_total_man1; ?></td>
                                    <td class="text-center"><?= $student_total_woman1; ?></td>
                                    <td class="text-center"><b><?= $student_total1; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    
        <?php 
            $all_sections = [];
            if (session()->has('allsections')) {
                if (session()->get('allsections') == 'none') {
                    $all_sections = [];
                } else {
                    $all_sections = session()->get('allsections');
                }
            }elseif (session()->has('usersbranchs')) {
                if (session()->get('usersbranchs') == 'none') {
                    $all_sections = [];
                } else {
                    $all_sections = session()->get('usersbranchs');
                }
            } else {
                if (isset($sections)) {
                    $all_sections = $sections;
                }
            }
        ?>
        <?php if (!empty($all_sections)): ?>
        <div class="card">
            <div class="card-header" style="page-break-after: always!important;">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    </div>
                </div>

                <div class="shadow-lg text-center mb-3" style="border:2px solid black">
                    <h3 class="text-uppercase font-weight-bold py-3">
                        <span class="text-primary small font-weight-bold">
                            <?= setReporting(session()->get('reportingtype'), "effectif global des élèves inscrits"); ?>
                        </span>
                    </h3>
                </div>
                <div class="row">
                    <?php if (isset($all_sections) && !empty($all_sections)):
                        $section_total = 0;
                        $section_man = 0;
                        $section_woman = 0;
                        foreach ($all_sections as $keysec => $section): ?>
                            <div class="col-4 col-lg-4 col-sm-4">

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
                                            if ($studval['section_id'] == $section['section_id']) {

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
                                       
                                        <div class="info-box-content">
                                            <span class="info-box-text font-weight-bold text-uppercase">
                                                élèves inscrits</span>
                                        </div>
                                        <span class="info-box-icon bg-info elevation-1">
                                            <?= $section_total; ?>
                                        </span>
                                    </div>
                                    <p><i class="fas fa-users"></i>
                                        <span class="font-weight-bold">
                                            <?= $section_woman; ?></span>
                                        Fille(s) / <span class="font-weight-bold">
                                            <?= $section_man; ?></span> Garçon(s)
                                    </p>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1">
                                <?= (isset($nb_eleves) ? $nb_eleves : ''); ?>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Effectif
                                </span>
                                <span class="info-box-number font-weight-bold">Global</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1">
                                <?= (isset($garcons) ? $garcons : ''); ?>
                            </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Effectif</span>
                                <span class="info-box-number font-weight-bold">Garçons</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1">
                                <?= (isset($filles) ? $filles : ''); ?>
                            </span>
                            <div class="info-box-content"><span class="info-box-text text-uppercase">Effectif</span>
                                <span class="info-box-number font-weight-bold">Filles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">

                            <span class="info-box-icon bg-success  elevation-1 font-weight-bold">
                                <?= (isset($nb_eleves) ? $nb_eleves : ''); ?>
                            </span>
                            <span class="info-box-icon">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Eleves Actifs
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">

                            <span class="info-box-icon bg-success elevation-1 font-weight-bold">
                                <?= (isset($students_inactive) ? $students_inactive : ''); ?>
                            </span>
                            <span class="info-box-icon">
                                <i class="fas fa-window-close"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Abandons
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="info-box">

                            <span class="info-box-icon bg-success elevation-1 font-weight-bold">
                                <?= ((isset($students_inactive)) && (isset($nb_eleves))) ? $students_inactive + $nb_eleves : ''; ?>
                            </span>
                            <span class="info-box-icon">
                                <i class="fas fa-tags"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    Total
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($all_sections as $allsecvalue): ?>
                <div class="card-body" style="page-break-after: always!important;">
                    <div class="shadow-sm">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                                <!-- ====== Start Reporting Header -->
                                <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                                <!-- ====== End Reporting Header -->
                            </div>
                        </div>

                        <div class="shadow-lg text-center" style="border:2px solid black">
                            <h3 class="text-uppercase font-weight-bold py-3">
                                <span class="text-primary small font-weight-bold">
                                    <?= setReporting(session()->get('reportingtype'), "effectif des élèves"); ?>
                                    <b> de la section <?= $allsecvalue['section_name']; ?> </b>
                                </span>
                            </h3>
                        </div>
                        <div class="row mt-3 border border-radius">
                            <div class="col-sm-12 col-lg-12">
                                <div class="table-responsive">
                                    <fieldset>

                                        <table id="datatablesWithoutActions"
                                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                            <thead>
                                                <tr class="text-uppercase font-weight-bold">
                                                    <th>#</th>
                                                    <th>Classes</th>
                                                    <th colspan="3" class="text-center">Effectifs</th>
                                                </tr>
                                                <tr class="text-uppercase font-weight-bold">
                                                    <th colspan="2"></th>
                                                    <th class="text-center">F</th>
                                                    <th class="text-center">G</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $classe_counter = 1;


                                                $student_totl_globe = 0;
                                                $student_globe_man = 0;
                                                $student_globe_woman = 0;

                                                $student_total_globe = 0;
                                                $student_man_globe = 0;
                                                $student_woman_globe = 0;

                                                if (isset($classes) && !empty($classes)):
                                                    foreach ($classes as $classe):
                                                        $branch_access = session()->has('branch_section_id') ? session()->get('branch_section_id') : '';
                                                        if (($branch_access == $classe['section_id'])):

                                                            if (($classe['section_id'] == $allsecvalue['section_id'])):

                                                                if (isset($students) && !empty($students)):
                                                                    $student_man_globe_loc = 0;
                                                                    $student_woman_globe_loc = 0;
                                                                    foreach ($students as $key2 => $parent):

                                                                        if ($parent['inscription_classe_id'] == $classe['classe_id']) {

                                                                            $student_totl_globe += 1;

                                                                            if ($parent['student_gender'] == 'masculin' && ($parent['inscription_classe_id'] == $classe['classe_id'])) {

                                                                                //$student_man1+=1;
                                                                                $student_man_globe_loc++;

                                                                            } elseif ($parent['student_gender'] == 'feminin' && ($parent['inscription_classe_id'] == $classe['classe_id'])) {


                                                                                $student_woman_globe_loc++;
                                                                                //$student_woman1+=1;
                                    
                                                                            } else {

                                                                            }
                                                                        }
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                                <tr class="">
                                                                    <td><?= $classe_counter++; ?></td>
                                                                    <td class="text-uppercase font-weight-bold">
                                                                        <?= (!empty($classe['classe_shortname'])) ? $classe['classe_shortname'] : $classe['degree_shortname'] . ' ' . ($classe['classe_subname']) . ' ' . ($classe['option_name']); ?>
                                                                    </td>
                                                                    <td class="text-center"><?= $student_man_globe_loc; ?></td>
                                                                    <td class="text-center"><?= $student_woman_globe_loc; ?></td>
                                                                    <td class="text-center">
                                                                        <b><?= $student_woman_globe_loc + $student_man_globe_loc; ?></b>
                                                                    </td>
                                                                </tr>

                                                                <?php
                                                                $student_man_globe += $student_woman_globe_loc;
                                                                $student_woman_globe += $student_man_globe_loc;

                                                                $student_total_globe = $student_man_globe + $student_woman_globe;
                                                                // $student_man_globe = 0;
                                                                // $student_woman_globe = 0;
                                                                ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                                <tr class="font-weight-bold">
                                                    <td colspan="2">
                                                        <span class="float-right font-weight-bold">Effectif Total</span>
                                                    </td>
                                                    <td class="text-center"><?= $student_man_globe; ?></td>
                                                    <td class="text-center"><?= $student_woman_globe; ?></td>
                                                    <td class="text-center"><b><?= $student_total_globe; ?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>