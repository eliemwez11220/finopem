<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('parents'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content pt-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a></li>
                            <li class="breadcrumb-item active">Dossiers scolaires</li>
                            <li class="breadcrumb-item active">Parents</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4 col-lg-4">
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
                <div class="col-sm-4 col-lg-4">
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
                <div class="col-sm-4 col-lg-4">
                    <div class="float-right">
                        <a href="<?= base_url('student/parent'); ?>" class="btn btn-info btn-lg text-uppercase"
                            data-toggle="tooltip" data-placement="bottom" title="Cliquer pour ajouter un parent">
                            <i class="fa fa-plus"></i> Nouveau parent
                        </a>
                    </div>
                </div>
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
                                Gestion fiches parents d'élèves </h1>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">

                                            <th>Actions</th>
                                            <th>Elève</th>
                                            <th>Père</th>
                                            <th>Mère</th>
                                            <th>Tuteur</th>
                                            <th>Contacts</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count = 1;
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
                                        
                                        $branch_access = session()->get('choosedsectionid');
                                    if ((!empty($sparents_listing))):
                                        foreach ($sparents_listing as $key => $value):
                                            $status = (!empty(esc($value['parent_status'])) ? esc($value['parent_status']) : 'inactif');
                                   
                                            if (($branch_access == $value['section_id'])):
                                          ?>
                                        <tr class="small">
                                            <td width="2px" class="text-center">
                                                <a href="<?= base_url('student/editForm/parent/'. esc($value['parent_id'])); ?>"
                                                    class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>

                                                <a href="<?= base_url('student/details/parent/'. esc($value['parent_id'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                                </a>
                                            </td>

                                            <td class="text-uppercase">
                                                <?= trim($value['student_firstname']); ?>
                                                <?= trim($value['student_lastname']); ?>
                                                <?= trim($value['student_surname']); ?>
                                                <?php if($value['inscription_date'] == date('Y-m-d')): ?>
                                                <span class="badge badge-info">new</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['parent_father_name']); ?>
                                                <br>
                                                <span class="small font-weight-bold">
                                                    <?= trim($value['parent_father_job']); ?>
                                                    (<?= trim($value['parent_father_phone']); ?>)
                                                </span>

                                            </td>
                                            <td class="text-uppercase">
                                                <?= esc($value['parent_mother_name']); ?>
                                                <br><span class="small font-weight-bold">
                                                    <?= esc($value['parent_mother_job']); ?>
                                                    (<?= esc($value['parent_mother_phone']); ?>)
                                                </span>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= esc($value['parent_tutor_name']); ?>
                                                <br><span class="small font-weight-bold">
                                                    <?= esc($value['parent_tutor_job']); ?>
                                                    (<?= esc($value['parent_tutor_phone']); ?>)
                                                </span>
                                            </td>
                                            <td class="text-uppercase">
                                                <span class="font-weight-bold">
                                                    <?= esc($value['parent_primary_phone']); ?></span>

                                                <br><span class="small font-weight-bold text-lowercase">
                                                    <?= esc($value['parent_primary_email']); ?></span>
                                            </td>

                                            <td class="text-center">
                                                <a href="<?= base_url('student/changeStatus/parent/' . esc($status) . '/' . esc($value['parent_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>