<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <!-- ====== Start Reporting Header -->
    <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
    <section class="content <?= checkModuleAccess(feature: 'parent'); ?>">
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->

                </div>
            </div>
            <div class="shadow-lg text-center" style="border:2px solid black">
                <h1 class="text-uppercase font-weight-bold">
                    Contacts etudiants - <?= session()->schoolyear; ?>
                </h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table id="datatablesReportingActions" class="table table-sm">
                                    <thead>
                                        <tr class="text-uppercase small">
                                            <th>No</th>
                                            <th>Père</th>
                                            <th>Mère</th>
                                            <th>Tuteur</th>
                                            <th>Contacts</th>
                                            <th>Adresse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $countparent = 1;
                                        $sparents_listing =  array();
                                        if((session()->parentsclasses)){
                                            if(session()->parentsclasses == 'none'){
                                                $sparents_listing =  array();
                                            }else{
                                                $sparents_listing = session()->parentsclasses;
                                            }
                                        }else{
                                            if (isset($parents)){
                                                $sparents_listing =  $parents;
                                            }
                                        }
                                   
                                    if ((!empty($sparents_listing))):
                                        foreach ($sparents_listing as $key => $parent):
                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid'):'';
                                            if (($branch_access == $parent['section_id'])):
                                          ?>
                                        <tr class="font-weight-bold shadow-lg small border-bottom">
                                            <td><b>#<?= $countparent++; ?></b></td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_father_name']); ?>
                                                [<?= trim($parent['parent_father_phone']); ?>]
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_mother_name']); ?>
                                                [<?= trim($parent['parent_mother_phone']); ?>]
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_tutor_name']); ?>
                                                [<?= trim($parent['parent_tutor_phone']); ?>]
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_primary_phone']); ?>
                                                <br>
                                                <span class="text-lowercase">
                                                    <?= trim($parent['parent_primary_email']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= wordwrap($parent['parent_primary_address'], 25, "<br>\n");  ?>
                                            </td>

                                        </tr>
                                        <?php
                                        $count = 1;
                                        $countstd=1;
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
                                   
                                    if ((!empty($students_listing))):?>
                                        <?php foreach ($students_listing as $key => $value): 
                                          $branch_access = session()->has('branch_section_id') ? session()->get('branch_section_id'):'';
                                          if (($branch_access == $value['option_section_id']) OR (session()->admin == TRUE) OR (session()->all == TRUE)):
                                        
                                            if($value['student_parent_id'] == $parent['parent_id']): ?>
                                        <tr class="small border-left">
                                            <td scope="1"><?= $countstd++; ?></td>
                                            <td class="text-uppercase">
                                                <?= trim($value['student_code']); ?></td>
                                            <td class="text-uppercase">
                                                <?= trim($value['student_firstname']); ?>
                                                <?= trim($value['student_lastname']); ?>
                                                <?= trim($value['student_surname']); ?>

                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($value['student_gender'] == 'masculin')?'M':'F'; ?></td>
                                            <td class="text-uppercase">
                                                <?= setDegresLevels(($value['degree_code'])); ?>
                                                <?= trim($value['classe_subname']); ?>
                                                <?= trim($value['option_name']); ?>
                                            </td>

                                            <td class="text-uppercase">
                                                <?= trim($value['student_born_place']); ?>,
                                                le <?= date("d/m/Y", strtotime($value['student_birthday'])); ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- === INCLUDE FOOTER === -->
            <?php include(APPPATH . 'Views/reporting/footer.php'); ?>

        </div>
    </section>
</div>