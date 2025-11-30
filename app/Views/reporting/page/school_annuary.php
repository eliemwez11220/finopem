
<?php if ((session()->has('studentsclasses')) or (isset($students))): ?>
    <div class="card">
        <div class="card-header">
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
                        <?= setReporting(session()->get('reportingtype'), "Annuaire scolaire"); ?> 
                        <?= session()->schoolyear; ?>

                        <b class="<?= (session()->has('choosedclassename')) ? '' : 'd-none'; ?>">
                            de la
                            <?= (session()->has('choosedclassename')) ? session()->choosedclassename : ''; ?>
                        </b>
                    </span>
                </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row mt-3">

                        <?php
                        $countparent = 1;
                        $sparents_listing = array();
                        if ((session()->studentsclasses)) {
                            if (session()->studentsclasses == 'none') {
                                $sparents_listing = array();
                            } else {
                                $sparents_listing = session()->studentsclasses;
                            }
                        } else {
                            if (isset($students)) {
                                $sparents_listing = $students;
                            }
                        }

                        if ((!empty($sparents_listing))):
                            foreach ($sparents_listing as $key => $student):
                                $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                if (($branch_access == $student['section_id'])):
                                    if ($student['inscription_status'] == 'actif'):
                                        $studentavatar = $student['student_picture'];

                                        $avatar = base_url('public/uploads/images/' . $studentavatar);

                                        
                                        $defavatar = ($student['student_gender'] == 'masculin')? 'avatar.png':'expertwoman.png';
                                        $pathdefavatar = base_url('public/img/'.$defavatar);

                                    ?>
                                    <div class="col-sm-4 col-lg-4 col-xs-12">
                                        <div class="info-box d-flex">
                                            <span class="info-box-icon bg-info elevation-1 font-weight-bold">
                                                <img src="<?= (!empty($studentavatar)) ? $avatar: $pathdefavatar; ?>"
                                                    alt="..." class="avatar avatar-lg">
                                            </span>
                                            <div class="info-box-content">
                                                <h6 class="text-uppercase font-weight-bold ml-2">
                                                    SEXE: <?= ($student['student_gender'] == 'masculin')?'M':'F'; ?><br />
                                                    <span class="text-primary">
                                                        <?= trim($student['student_firstname']); ?>
                                                        <?= trim($student['student_lastname']); ?>
                                                        <?= trim($student['student_surname']); ?>
                                                    </span>
                                                    <br />
                                                    <span class="text-danger">
                                                        <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                                        <?= trim($student['classe_subname']); ?>
                                                        <?= trim($student['option_name']); ?>
                                                    </span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>