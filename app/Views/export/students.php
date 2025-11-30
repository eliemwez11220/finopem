<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('expstudents', 'tools'); ?>">
    <!-- Content Header (Page header) -->
       <!-- ====== Start Reporting Header -->
       <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
    <!-- ====== End Reporting Header -->
    <?php if(session()->has('choosedsectionid')): ?>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    
                    <div class="text-center shadow-lg" style="border:2px solid black">
                        <h1 class="text-uppercase font-weight-bold">
                            Liste des élèves inscrits en <?= session()->schoolyear; ?>
                        </h1>
                        <h3 class="text-uppercase">
                        <b>Classe:
                            <?= (session()->has('choosedclassename')) ? session()->choosedclassename : 'Générale'; ?>
                        </b>
                    </h3>
                    </div>

                    <div class="table-responsive">
                        <table id="datatablesReportingActions"
                            class="table table-sm table-bordered table-hover table-head-fixed">
                            <thead>
                                <tr class="text-uppercase small">
                                    <th>#</th>
                                    <th>Classe</th>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Postnom</th>
                                    <th>Prenom</th>
                                    <th>Sexe</th>
                                    <th>Lieu Naissance</th>
                                    <th>Date Naissance</th>
                                    <th>Pere</th>
                                    <th>Tel Pere</th>
                                    <th>Mere</th>
                                    <th>Tel Mere</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    $students_listing =  array();
                                    if(session()->has('studentsclasses')){
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
                                            if($value['section_id'] == session()->get('choosedsectionid')):
                                                if ($value['inscription_status'] == 'actif'):
                                         ?>
                                <tr class="small">
                                    <td scope="1"><?= $count++; ?></td>
                                    <td class="text-uppercase">
                                        <?= (!empty($value['classe_shortname'])) ? $value['classe_shortname']:$value['degree_shortname'].' '.($value['classe_subname']).' '.($value['option_name']); ?>

                                    </td>
                                    <td class="text-uppercase">
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
                                        <?= ($value['student_gender'] == 'masculin')?'M':'F'; ?></td>
                                    
                                    <td class="text-uppercase">
                                        <?= trim($value['student_born_place']); ?></td>

                                    <td class="text-uppercase">
                                        <?= date("d/m/Y", strtotime($value['student_birthday'])); ?>
                                    </td>
                                    <td class="text-uppercase">
                                                <?= trim($value['parent_father_name']); ?>
                                                </td>
                                    <td class="text-uppercase">
                                                <?= trim($value['parent_father_phone']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['parent_mother_name']); ?>
                                                </td>
                                    <td class="text-uppercase">
                                                <?= trim($value['parent_mother_phone']); ?>
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
        </div>
    </section>

    <?php endif; ?>
</div>