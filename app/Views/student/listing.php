<div class="content-wrapper <?= checkModuleAccess('registers'); ?>">
    <div class="content pt-2 p-md-2 p-lg-2">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dossiers étudiants</li>
                            <li class="breadcrumb-item active" aria-current="page">Registre des étudiants</li>

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
                                <option disabled selected>--sélectionnez une faculté--</option>
                                <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                <option value="all">Toutes les Facultés</option>
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
                                <span class="text-danger">*</span>
                                Facultés
                            </label>
                        </div>
                    </form>
                </div>
                <?php if (session()->has('choosedsectionid')): ?>
                <div class="col-sm-4 col-lg-4">
                    <form role="form" id="form_students_classes" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--Sélectionnez une promotion--</option>
                                <option value="all">Toutes les promotions</option>
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
                            <label for="ajax_students_classes">
                                <span class="text-danger">*</span>Promotions
                            </label>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
                <div class="col-sm-4 col-lg-4">
                    <div class="float-right">
                        <a href="<?= base_url('student/registration'); ?>" class="btn btn-info btn-lg"
                            data-toggle="tooltip" data-placement="bottom"
                            title="Cliquer pour ajouter une nouvelle inscription">
                            <i class="fa fa-plus"></i> Nouvelle inscription
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center py-3">
                            <h1 class="text-uppercase font-weight-bold">
                                Liste des étudiants inscrits en <?= session()->schoolyear; ?></h1>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">

                                        <th>Actions</th>
                                            <th>#</th>
                                            <th>Matricule</th>
                                            <th>Noms</th>
                                            <th>Sexe</th>
                                            <th>Statut</th>
                                            <th>Provenance</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $students_listing = array();
                                        if (session()->studentsclasses) {
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


                                        if (session()->has('choosedsectionid')):
                                            if (isset($students_listing) && (!empty($students_listing))):
                                                foreach ($students_listing as $key => $value):
                                                    $branch_section = session()->get('choosedsectionid');
                                                    $status = (!empty(esc($value['inscription_status'])) ? esc($value['inscription_status']) : 'inactif');
                                                    if (($branch_section == $value['section_id'])):
                                                        $studentavatar = $value['student_picture'];

                                                                        $avatar = base_url('public/uploads/images/' . $studentavatar);
                                
                                                                        
                                                                        $defavatar = ($value['student_gender'] == 'masculin')? 'avatar.png':'expertwoman.png';
                                                                        $pathdefavatar = base_url('public/img/'.$defavatar);
                                
                                                                                ?>
                                        <tr class="small">
                                        <td width="2px" class="text-center">
                                                <a href="<?= base_url('student/editForm/inscription/' . esc($value['inscription_id'])); ?>"
                                                    class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>

                                                <a href="<?= base_url('student/details/inscription/' . esc($value['inscription_id'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                                </a>
                                                <?php $access_delete = (session()->admin == TRUE or session()->all == TRUE) ? '' : 'disabled'; ?>
                                                <a href="<?= base_url('student/remove/student/' . ($value['student_id'])); ?>"
                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer ce candidat? Notez que son dossier sera detruit definitivement.'); false;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer ce candidat">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                            </td>
                                            <td scope="1">

                                                <a href="<?= base_url('student/details/inscription/' . esc($value['inscription_id'])); ?>"
                                                    class="btn" data-toggle="tooltip" data-placement="bottom"
                                                    title="Cliquer pour voir les details">
                                                    <img src="<?= (!empty($studentavatar)) ? $avatar: $pathdefavatar; ?>"
                                                        alt="..." class="avatar avatar-xs">
                                                </a>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['student_code']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['student_firstname']); ?>
                                                <?= trim($value['student_lastname']); ?>
                                                <?= trim($value['student_surname']); ?>
                                                <?php if ($value['inscription_date'] == date('Y-m-d')): ?>
                                                <span class="badge badge-info">new</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($value['student_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('student/changeStatus/inscription/' . esc($status) . '/' . esc($value['inscription_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= esc($value['inscription_origin_school']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= esc($value['inscription_date']); ?>
                                            </td>
                                            
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
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
</div>