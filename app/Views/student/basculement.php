<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('students'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">Basculement annuel des étudiants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Dossiers</li>
                        <li class="breadcrumb-item active">Classement étudiants</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (isset($years) && count($years) > 1): ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9 col-sm-9">
                                <div class="tab-content" id="vert-tabs-right-tabContent">
                                    <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel"
                                        aria-labelledby="vert-tabs-right-home-tab">
                                        <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <form role="form" method="get">
                                                        <div class="input-group input-group" style="width: 100%!important;">
                                                            <select id="ajax_students_classes" name="classe"
                                                                    class="form-control select2 select2-info"
                                                                    data-dropdown-css-class="select2-info">

                                                                    <option disabled selected>-- Sélectionnez une promotion à basculer--
                                                                    </option>
                                                                <?php
                                                                    $count = 1;
                                                                    if (isset($classes) && !empty($classes)):
                                                                        foreach ($classes as $key => $value): 
                                                                            $branch_access = session()->has('branch_section_id') ? session()->get('branch_section_id'):'';
                                                                            if (($branch_access == $value['section_id']) OR (session()->get('all') == TRUE)):
                                                                        ?>
                                                                            <option value="<?= esc($value['classe_id']); ?>" 
                                                                            <?= (session()->has('studentchoosedclasse') && (session()->get('studentchoosedclasse') == $value['classe_id']))?'selected':set_select('classe', esc($value['classe_id'])); ?>>
                                                                                <?= setDegresLevels(($value['degree_code'])); ?>
                                                                                <?= ucfirst(($value['classe_subname'])); ?> 
                                                                                <?= ucfirst(($value['option_name'])); ?>
                                                                            </option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                            </select>
                                                            
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <div class="card card-light">
                                            
                                            <?php
                                                //form validation services call
                                                $validation = \Config\Services::validation();
                                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                echo form_open(base_url('basculementAnnuelClasse'), $attributes);
                                            ?>

                                            <?php if ((session()->has('studentchoosedclasse')) && (isset($students) OR ((session()->has('studentsclasses'))))): ?>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                    
                                                            <div class="text-sm">
                                                                <div class="table-responsive">
                                                                    <table id="datatablesWithoutActions"
                                                                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                                        <thead>
                                                                        <tr class="text-uppercase">
                                                                            <th>#</th>
                                                                            <th>Classement</th>
                                                                            <th>Matricule</th>
                                                                            <th>Noms étudiants</th>
                                                                            <th>Ancienne promotion</th>
                                                                            
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                            $count = 1;
                                                                            $students_listing =  array();
                                                                            if((session()->has('studentsclasses'))){
                                                                                if(session()->get('studentsclasses') == 'none'){
                                                                                    $students_listing =  array();
                                                                                }else{
                                                                                    $students_listing = session()->get('studentsclasses');
                                                                                }
                                                                            }else{
                                                                                if (isset($students)){
                                                                                    $students_listing =  $students;
                                                                                }
                                                                            }
                                                                        
                                                                            if (isset($students_listing) && (!empty($students_listing))):
                                                                                foreach ($students_listing as $key => $value):
                                                                                $classe_old_db  = setDegresLevels(($value['degree_code'])) .'-'. ucfirst(($value['classe_subname'])) .'-'. ucfirst(($value['option_name'])); ?>
                                                                            <tr>
                                                                                <td><?= $count++; ?></td>
                                                                                <td>
                                                                                    <input type="checkbox"
                                                                                        name="EleveIdentifiant[]" checked
                                                                                        value="<?= esc($value['student_id']); ?>">

                                                                                </td>
                                                                                <td class="text-uppercase"><?= esc($value['student_code']); ?></td>
                                                                                <td class="text-uppercase">
                                                                                <?= esc($value['student_firstname']); ?>  
                                                                                <?= esc($value['student_lastname']); ?> 
                                                                                <?= esc($value['student_surname']); ?>
                                                                                </td>
                                                                                <td class="text-uppercase">
                                                                                    <input type="text" class="text-uppercase font-weight-bolder"
                                                                                        name="classe_uid_ancienne"
                                                                                        value="<?= $classe_old_db; ?>">
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                    
                                                        <hr>

                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?php if ((session()->has('studentchoosedclasse'))): ?>
                                                            <input type="hidden"
                                                                name="classe_ancienne"
                                                                value="<?= session()->get('studentchoosedclasse'); ?>">
                                                        <?php endif; ?>

                                                        <div class="form-group">
                                                            <label for="classe_uid_nouvelle"><span
                                                                        class="text-danger">*</span>Nouvelle promotion</label>
                                                            <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('classe_uid_nouvelle')) ? ' is-invalid' : '' ?>"
                                                                    id="classe_uid_nouvelle"
                                                                    name="classe_uid_nouvelle"
                                                                    data-dropdown-css-class="select2-info"
                                                                    style="width: 100%;">
                                                                <option selected="selected" disabled>-- Sélectionnez une
                                                                    promotion --
                                                                </option>
                                                                <?php
                                                                $count = 1;
                                                                if (isset($classes) && !empty($classes)):
                                                                    foreach ($classes as $key => $value): 
                                                                        if((session()->get('studentchoosedclasse') != $value['classe_id'])): ?>
                                                                            <option value="<?= esc($value['classe_id']); ?>" <?= set_select('classe_uid_nouvelle', esc($value['classe_id'])); ?>>
                                                                                <?= setDegresLevels($value['degree_code'], 'f'); ?>
                                                                                    <?= ucwords($value['classe_subname']); ?> 
                                                                                    <?= ucwords($value['option_name']); ?>
                                                                                </option>
                                                                            </option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <?php if ($validation->hasError('classe_uid_nouvelle')) { ?>
                                                                <span class="invalid-feedback"> <?= $validation->getError('classe_uid_nouvelle'); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-floating">
                                                            <textarea name="notes"  id="notes" cols="30" rows="3"
                                                                        class="form-control"><?= set_value('notes') ?> </textarea>
                                                            <label for="notes">Notes sur le basculement de cette promotion</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit"
                                                        class="btn btn-info btn-sm  text-uppercase">
                                                    <i class="fa fa-check-circle"></i>
                                                        Baculer les étudiants sélectionnés
                                                </button>
                                            </div>
                                            <?php else: ?>

                                                <?php $request = \Config\Services::request(); 
                                                if ($request->getGet('classe')): ?>
                                                    <div class="text-uppercase small text-center alert alert-secondary">
                                                        <span>
                                                            <strong>
                                                                Aucune donnée trouvée. Il est possible que le basculement de cette année soit déjà effectué
                                                            </strong>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?= form_close(); ?>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-right-globale" role="tabpanel"
                                        aria-labelledby="vert-tabs-right-profile-tab">
                                        <!-- /.card-header -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="text-uppercase small text-center">
                                                        <strong>
                                                            Basculement global des étudiants
                                                        </strong>
                                                    </h3>
                                                </div>
                                            </div>
                                            <?php
                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                            echo form_open(base_url('basculementAnnuelGlobal'), $attributes);
                                            ?>
                                            <div class="card-body">

                                                <div class="table-responsive-sm">
                                                    <table id="datatablesExampleAffectation"
                                                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                        <thead>
                                                        <tr class="text-uppercase">
                                                            <th width="1px">#</th>
                                                            <th>Ancienne promotion </th>
                                                            <th>Nouvelle promotion</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        if (isset($classes) && !empty($classes)):
                                                            $count = 1;
                                                            $countClasses = count($classes);
                                                            //for ($i = 1; $i <= $countClasses; $i++):
                                                            foreach ($classes as $key => $value): 
                                                                $branch_access = session()->has('branch_section_id') ? session()->get('branch_section_id'):'';
                                                                            if (($branch_access == $value['section_id']) OR (session()->get('all') == TRUE)):
                                                                        ?>
                                                                <tr>
                                                                    <td width="1px"><?= $count++; ?></td>
                                                                    <td width="2px" class="text-center">
                                                                        <div class="form-group">
                                                                            <label for="classe_uid_ancienne_global<?= $count; ?>"></label>
                                                                            <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('classe_uid_ancienne_global')) ? ' is-invalid' : '' ?>"
                                                                                    id="classe_uid_ancienne_global<?= $count; ?>"
                                                                                    name="classe_uid_ancienne_global[]"
                                                                                    data-dropdown-css-class="select2-info"
                                                                                    style="width: 100%;">
                                                                                <option selected
                                                                                        value="<?= esc($value['classe_id']); ?>" <?= set_select('classe_uid_ancienne_global', esc($value['classe_id'])); ?>>
                                                                                        <?= setDegresLevels(($value['degree_code'])); ?>
                                                                                        <?= ucfirst(($value['classe_subname'])); ?> 
                                                                                        <?= ucfirst(($value['option_name'])); ?>
                                                                                </option>
                                                                            </select>
                                                                            <?php if ($validation->hasError('classe_uid_ancienne_global')) { ?>
                                                                                <span class="invalid-feedback"> <?= $validation->getError('classe_uid_ancienne_global'); ?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </td>

                                                                    <td width="2px" class="text-center">
                                                                        <div class="form-group">
                                                                            <label for="classe_uid_nouvelle_global<?= $count; ?>"></label>
                                                                            <select class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('classe_uid_nouvelle_global')) ? ' is-invalid' : '' ?>"
                                                                                    id="classe_uid_nouvelle_global<?= $count; ?>"
                                                                                    name="classe_uid_nouvelle_global[]"
                                                                                    data-dropdown-css-class="select2-info"
                                                                                    style="width: 100%;">
                                                                                <option selected="selected" disabled>--
                                                                                    Selectionnez une
                                                                                    promotion --
                                                                                </option>
                                                                                <?php

                                                                                foreach ($classes as $key2 => $value2): 
                                                                                    $branch_access = session()->has('branch_section_id') ? session()->get('branch_section_id'):'';
                                                                            if (($branch_access == $value2['section_id']) OR (session()->get('all') == TRUE)):
                                                                        ?>
                                                                                    <option value="<?= esc($value2['classe_id']); ?>" <?= set_select('classe_uid_nouvelle_global', esc($value2['classe_id'])); ?>>
                                                                                        <?= setDegresLevels(($value2['degree_code'])); ?>
                                                                                        <?= ucfirst(($value2['classe_subname'])); ?> 
                                                                                        <?= ucfirst(($value2['option_name'])); ?>
                                                                                    </option>
                                                                                    <?php endif; ?>
                                                                                    <?php endforeach; ?>

                                                                            </select>
                                                                            <?php if ($validation->hasError('classe_uid_nouvelle_global')) { ?>
                                                                                <span class="invalid-feedback"> <?= $validation->getError('classe_uid_nouvelle_global'); ?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="submit"
                                                        class="btn btn-info btn-sm text-uppercase">
                                                    <i class="fa fa-check-circle"></i>
                                                    Enregistrer le bascullement global
                                                </button>
                                            </div>
                                            <?= form_close(); ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-3">
                                <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab"
                                    role="tablist" aria-orientation="vertical">
                                    <a class="btn btn-xs btn-outline-info nav-link active" id="vert-tabs-right-home-tab"
                                    data-toggle="pill"
                                    href="#vert-tabs-right-home" role="tab" aria-controls="vert-tabs-right-home"
                                    aria-selected="true"><span class="text-uppercase">Basculement par promotion</span></a>
                                
                                    <a class="btn btn-xs btn-outline-info nav-link" id="vert-tabs-right-globale-tab"
                                    data-toggle="pill"
                                    href="#vert-tabs-right-globale" role="tab" aria-controls="vert-tabs-right-globale"
                                    aria-selected="false"><span class="text-uppercase">Basculement par étudiant</span></a>
                            
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    <?php else: ?>
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-warning text-center">
                                <h1 class="font-weight-bold text-uppercase small">
                                    <i class="fa fa-warning text-danger" style="color: red"></i>
                                    Pour effectuer un basculement annuel des étudiants, 
                                    vous devez créer une nouvelle année
                                </h1>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- /.content -->
</div>