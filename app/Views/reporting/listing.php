<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- ====== Start Reporting Header -->
    <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
    <!-- ====== End Reporting Header -->
    <section class="content <?= checkModuleAccess('replisting'); ?>">
        <div class="container-fluid">
            <div class="row printoff">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="text-center">
                        <button id="btn_hide_reporting" onclick="hideReporting();" type="button"
                            class="btn btn-<?= (session()->has('status_reporting') && (session()->get('status_reporting') == 'hide')) ? 'danger' : 'info'; ?>">
                            <i id="hide_status" class="fas fa-<?= (session()->has('status_reporting') && (session()->get('status_reporting') == 'hide')) ? 'eye' : 'eye-slash'; ?>"></i>
                            <span id="hide_info">
                                <?= (session()->has('status_reporting') && (session()->get('status_reporting') == 'hide')) ? 'Afficher' : 'Masquer'; ?>
                                le matricule élève
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <?php if (session()->has('choosedclassename')): ?>
                <!-- ====== Start Reporting Header -->
                <?php include APPPATH . ('Views/reporting/header.php'); ?>
                <!-- ====== End Reporting Header -->
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <div class="text-center shadow-lg py-3 mb-2" style="border:2px solid black">
                            <h1 class="text-uppercase font-weight-bold h3">
                                Liste des élèves inscrits en <?= session()->get('choosedclassename'); ?>
                            </h1>
                        </div>

                        <div class="table-responsive">
                            <table id="datatablesReportingActions"
                                class="table table-sm table-bordered table-hover table-head-fixed">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th class="<?= (session()->has('status_reporting') && session()->get('status_reporting') == 'hide') ? 'd-none':''; ?>">
                                            Matricule</th>
                                        <th>Nom</th>
                                        <th>Postnom</th>
                                        <th>Prénom</th>
                                        <th>Sexe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $students_listing = array();
                                    if ((session()->studentsclasses)) {
                                        if (session()->studentsclasses == 'none') {
                                            $students_listing = array();
                                        } else {
                                            $students_listing = session()->studentsclasses;
                                        }
                                    } else {
                                        if (isset($students)) {
                                            $students_listing = $students;
                                        }
                                    }

                                    if (isset($students_listing) && (!empty($students_listing))):
                                        foreach ($students_listing as $key => $value):
                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';

                                            if (session()->get('studentchoosedclasse') == $value['inscription_classe_id']):
                                                if ($value['inscription_status'] == 'actif' && ($branch_access == $value['section_id'])):

                                                    ?>
                                                    <tr class="">
                                                        <td><?= $count++; ?></td>
                                                        <td
                                                            class="<?= (session()->has('status_reporting') && session()->get('status_reporting') == 'hide') ? 'd-none':''; ?>">
                                                            <?= trim($value['student_code']); ?>
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <?= trim($value['student_firstname']); ?>
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <?= trim($value['student_lastname']); ?>
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <?= trim($value['student_surname']); ?>

                                                        </td>
                                                        <td class="text-uppercase">
                                                            <?= ($value['student_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                                        </td>

                                                    </tr>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- === INCLUDE FOOTER === -->
                <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
                <!-- === INCLUDE FOOTER === -->
            <?php else: ?>
                <?php if (isset($classes) && !empty($classes)):
                    if (session()->has('choosedsectionid')):
                        $branch_access = session()->get('choosedsectionid');
                        foreach ($classes as $key => $classe):
                            if ($branch_access == $classe['section_id']):
                                ?>
                                <div class="row mb-3" style="page-break-after: always!important;">
                                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                                        <!-- ====== Start Reporting Header -->
                                        <?php include APPPATH . ('Views/reporting/header.php'); ?>
                                        <!-- ====== End Reporting Header -->
                                        <div class="text-center shadow-lg py-3 mb-2" style="border:2px solid black">
                                            <h1 class="text-uppercase font-weight-bold h3">
                                                Liste des élèves inscrits en

                                                <?= setDegresLevels($classe['degree_code'], 'f'); ?>
                                                <?= trim($classe['classe_subname']); ?>
                                                <?= trim($classe['option_name']); ?>
                                            </h1>
                                        </div>

                                        <div class="table-responsive">
                                            <table id="datatablesReportingActions"
                                                class="table table-sm table-bordered table-hover table-head-fixed">
                                                <thead>
                                                    <tr class="text-uppercase">
                                                        <th>#</th>
                                                        <th
                                                            class="<?= (session()->has('status_reporting') && session()->get('status_reporting') == 'hide') ? 'd-none':''; ?>">
                                                            Matricule</th>

                                                        <th>Nom</th>
                                                        <th>Postnom</th>
                                                        <th>Prénom</th>
                                                        <th>Sexe</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $students_listing = array();
                                                    if ((session()->studentsclasses)) {
                                                        if (session()->studentsclasses == 'none') {
                                                            $students_listing = array();
                                                        } else {
                                                            $students_listing = session()->studentsclasses;
                                                        }
                                                    } else {
                                                        if (isset($students)) {
                                                            $students_listing = $students;
                                                        }
                                                    }

                                                    if (isset($students_listing) && (!empty($students_listing))):
                                                        foreach ($students_listing as $key => $value):
                                                            if ($classe['classe_id'] == $value['inscription_classe_id']):
                                                                if ($value['inscription_status'] == 'actif'):
                                                                    ?>
                                                                    <tr class="">
                                                                        <td><?= $count++; ?></td>
                                                                        <td
                                                                            class="<?= (session()->has('status_reporting') && session()->get('status_reporting') == 'hide') ? 'd-none':''; ?>">
                                                                            <?= trim($value['student_code']); ?>
                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= trim($value['student_firstname']); ?>
                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= trim($value['student_lastname']); ?>
                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= trim($value['student_surname']); ?>

                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= ($value['student_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- === INCLUDE FOOTER === -->
                                        <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
                                        <!-- === INCLUDE FOOTER === -->
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</div>