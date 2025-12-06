<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- ====== Start Reporting Header -->
    <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
    <!-- ====== End Reporting Header -->

    <section class="content <?= checkModuleAccess('repstudents'); ?>">
        <div class="container-fluid">
            <h1 class="font-weight-bold text-uppercase text-center printoff">
                <i class="nav-icon fas fa-users"></i> Registre des étudiants
            </h1>
            <?php if (session()->has('choosedclassename')): ?>
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                        <div class="text-center shadow-lg py-3 mb-2" style="border:2px solid black">
                            <h1 class="text-uppercase font-weight-bold h3">
                                Registre des étudiants inscrits en <?= session()->get('choosedclassename'); ?>
                            </h1>
                        </div>

                        <div class="table-responsive">
                            <table id="datatablesReportingActions"
                                class="table table-sm table-bordered table-hover table-head-fixed">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Postnom</th>
                                        <th>Prénom</th>
                                        <th>Sexe</th>
                                        <th>Provenance</th>
                                        <th>Naissance</th>
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
                                            if (session()->get('studentchoosedclasse') == $value['inscription_classe_id']):
                                            if ($value['inscription_status'] == 'actif' && (session()->get('choosedsectionid') == $value['section_id'])):
                                                $studentavatar = $value['student_picture'];

                                        $avatar = base_url('public/uploads/images/' . $studentavatar);

                                        
                                        $defavatar = ($value['student_gender'] == 'masculin')? 'avatar.png':'expertwoman.png';
                                        $pathdefavatar = base_url('public/img/'.$defavatar);

                                                ?>
                                                <tr class="small">
                                                    <td scope="1">
                                                        <img src="<?= (!empty($studentavatar)) ? $avatar: $pathdefavatar; ?>"
                                                            alt="..." class="avatar avatar-xs">
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
                                                    <td class="text-uppercase">
                                                        <?= trim($value['inscription_origin_school']); ?>
                                                    </td>
                                                    <td class="text-uppercase">
                                                        <?= trim($value['student_born_place']); ?>,
                                                        <?= date("d/m/Y", strtotime($value['student_birthday'])); ?>
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

            <?php else: ?>

                <?php if (isset($classes) && !empty($classes)):
                    if (session()->has('choosedsectionid')):
                        $branch_access = session()->get('choosedsectionid');
                          
                            foreach ($classes as $key => $classe):
                                if ($branch_access == $classe['section_id']): ?>
                                    <div class="row mb-3" style="page-break-after: always!important;">
                                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                                            <!-- ====== Start Reporting Header -->
                                            <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                                            <!-- ====== End Reporting Header -->
                                            <div class="text-center shadow-lg py-3 mb-2" style="border:2px solid black">
                                                <h1 class="text-uppercase font-weight-bold h3">
                                                    Registre des étudiants inscrits en

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
                                                            <th>Nom</th>
                                                            <th>Postnom</th>
                                                            <th>Prénom</th>
                                                            <th>Sexe</th>
                                                            <th>Provenance</th>
                                                            <th>Naissance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $count = 1;
                                                        $students_listing = array();
                                                        if (session()->has('studentsclasses')) {
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
                                                                    if ($value['inscription_status'] == 'actif' && (session()->get('choosedsectionid') == $value['section_id'])):
                                                                        $studentavatar = $value['student_picture'];

                                                                        $avatar = base_url('public/uploads/images/' . $studentavatar);
                                
                                                                        
                                                                        $defavatar = ($value['student_gender'] == 'masculin')? 'avatar.png':'expertwoman.png';
                                                                        $pathdefavatar = base_url('public/img/'.$defavatar);
                                
                                                                                ?>
                                                                                <tr class="small">
                                                                                    <td scope="1">
                                                                                        <img src="<?= (!empty($studentavatar)) ? $avatar: $pathdefavatar; ?>"
                                                                                            alt="..." class="avatar avatar-xs">
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

                                                                        <td class="text-uppercase">
                                                                            <?= trim($value['inscription_origin_school']); ?>
                                                                        </td>

                                                                        <td class="text-uppercase">
                                                                            <?= trim($value['student_born_place']); ?>,
                                                                            <?= date("d/m/Y", strtotime($value['student_birthday'])); ?>
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