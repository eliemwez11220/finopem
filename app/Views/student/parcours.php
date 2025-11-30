<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('parcours'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase ffont-weight-bold">Suivi scolaire - Parcours des élèves</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Parcours</li>
                    </ol>
                </div>
            </div>

            <div class="row mb-2">
            <div class="col-sm-6 col-lg-6">
                    <form role="form" id="ajax_form_sections" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_sections" name="ajax_sections" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez une section--</option>
                                <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                    <option value="all">Toutes les sections</option>
                                <?php endif; ?>
                                <?php
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

                                if ((!empty($sections_listing))):
                                    foreach ($sections_listing as $key => $value): ?>
                                        <option value="<?= trim($value['section_id']); ?>"
                                            <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('ajax_sections', trim($value['section_id'])); ?>>
                                            <?= strtoupper(trim($value['section_name'])); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="ajax_sections">
                                <span class="text-danger">*</span>Sections organisées</label>
                        </div>
                    </form>

                </div>
                <?php if (session()->has('choosedsectionid')): ?>
                    <div class="col-sm-6 col-lg-6">
                        <form role="form" id="form_students_classes" method="get">
                            <div class="form-floating input-group" style="width: 100%!important;">
                                <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                    class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                    <option disabled selected>--Sélectionnez une classe--</option>
                                    <option value="all">Toutes les classes</option>
                                    <?php if (isset($classes) && !empty($classes)):
                                        foreach ($classes as $key => $clasvalue):
                                            $branch_access = session()->get('choosedsectionid');
                                            if (($branch_access == $clasvalue['section_id'])):

                                                $classe_sess = session()->has('studentchoosedclasse') ? session()->get('studentchoosedclasse') : '';
                                                ?>
                                                <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                    <?= ($classe_sess == $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                                    <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                    <?= ucfirst($clasvalue['classe_subname']); ?>
                                                    <?= ucfirst($clasvalue['option_name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="ajax_students_classes"><span class="text-danger">*</span>Classes des
                                    élèves</label>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (session()->has('choosedsectionid')): ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1 class="text-uppercase font-weight-bold">
                            parcours des élèves inscrits en <?= session()->schoolyear; ?></h1>
                
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase small">
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Elève</th>
                                        <th>Sexe</th>
                                        <th>Statut</th>
                                        <th>Nationalité</th>
                                        <th>Sernie ID</th>
                                        <th>Naissance</th>
                                        <th>Parcours</th>
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
                                            $status = (!empty(($value['student_status'])) ? ($value['student_status']) : 'inactif');
                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid'):'';
                                                if (($branch_access == $value['section_id'])):?>
                                            <tr class="small">
                                                <td scope="1"><?= $count++; ?></td>

                                                <td class="text-uppercase"><?= trim($value['student_code']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= trim($value['student_firstname']); ?>  
                                                    <?= trim($value['student_lastname']); ?> 
                                                    <?= trim($value['student_surname']); ?>
                                                    
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= ($value['student_gender'] == 'masculin')?'M':'F'; ?></td>
                                                
                                                    <td>
                                                    <a href="<?= base_url('student/changeStatus/student/' . esc($status) . '/' . esc($value['student_id'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');" >
                                                        <span class="badge  <?= (($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= trim(($value['student_nationality'])); ?></td> 
                                                <td class="text-uppercase"><?= trim($value['student_sernie_id']); ?></td>
                                                <td class="text-uppercase">
                                                    <?= trim($value['student_born_place']); ?>, 
                                                    le <?= date("d/m/Y", strtotime($value['student_birthday'])); ?>
                                                </td>
                                                <td width="2px" class="text-center">
                                                   
                                                    <a href="<?= base_url('student/details/parcours/' . ($value['student_id'])); ?>"
                                                       class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                       data-placement="bottom"
                                                       title="Cliquer pour voir les details">
                                                        <i class="fa fa-search fa-2x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <?php endif; ?>
    <!-- /.content -->
</div>