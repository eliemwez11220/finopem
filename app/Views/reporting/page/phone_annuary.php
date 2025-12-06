
<?php if ((session()->has('parentsclasses')) or (isset($parents))): ?>
    <div class="card">
        <div class="card-footer">
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
                        <?= setReporting(session()->get('reportingtype'), "Annuaire téléphonique"); ?> -
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
                    <div class="table-responsive">
                        <table id="datatablesReportingActions" class="table table-sm">
                            <thead>
                                <tr class="text-uppercase small">
                                    <th>#</th>
                                    <th>Matricule</th>
                                    <th>Nom étudiant</th>
                                    <th>Sexe</th>
                                    <?php if (!session()->has('choosedclassename')): ?>
                                        <th>Classe</th>
                                    <?php endif; ?>
                                    <th>Père</th>
                                    <th>Mère</th>
                                    <th>Tuteur</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countparent = 1;
                                $sparents_listing = array();
                                if ((session()->parentsclasses)) {
                                    if (session()->parentsclasses == 'none') {
                                        $sparents_listing = array();
                                    } else {
                                        $sparents_listing = session()->parentsclasses;
                                    }
                                } else {
                                    if (isset($parents)) {
                                        $sparents_listing = $parents;
                                    }
                                }

                                if ((!empty($sparents_listing))):
                                    foreach ($sparents_listing as $key => $parent):
                                        $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                        if (($branch_access == $parent['section_id'])):
                                            ?>
                                            <tr class="small">
                                                <td><?= $countparent++; ?></td>
                                                <td class="text-uppercase"><?= trim($parent['student_code']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= trim($parent['student_firstname']); ?>
                                                    <?= trim($parent['student_lastname']); ?>
                                                    <?= trim($parent['student_surname']); ?>

                                                </td>
                                                <td class="text-uppercase">
                                                    <?= ($parent['student_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                                </td>
                                                <?php if (!session()->has('choosedclassename')): ?>
                                                    <td class="text-uppercase">
                                                        <?= (!empty($parent['classe_shortname'])) ? $parent['classe_shortname'] : $parent['degree_shortname'] . ' ' . ($parent['classe_subname']) . ' ' . ($parent['option_name']); ?>
                                                    </td>
                                                <?php endif; ?>
                                                <td class="text-uppercase">
                                                    <?= trim($parent['parent_father_name']); ?>
                                                    <br>
                                                    <?= trim($parent['parent_father_phone']); ?>
                                                    <br>
                                                    <?= trim($parent['parent_father_phone2']); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= trim($parent['parent_mother_name']); ?>
                                                    <br>
                                                    <?= trim($parent['parent_mother_phone']); ?>
                                                    <?= trim($parent['parent_mother_phone2']); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= trim($parent['parent_tutor_name']); ?>
                                                    <br>
                                                    <?= trim($parent['parent_tutor_phone']); ?>
                                                    <br>
                                                    <?= trim($parent['parent_tutor_phone2']); ?>
                                                </td>
                                                <td class="text-uppercase">
                                                    <span class="text-lowercase">
                                                        <?= trim($parent['parent_primary_email']); ?>
                                                    </span>
                                                </td>

                                            </tr>

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
        </div>
    </div>
<?php endif; ?>