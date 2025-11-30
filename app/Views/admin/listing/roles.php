<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">Gestion des roles des utilisateurs</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('overview/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('admin/view/roles') ?>">Administration</a>
                                </li>
                                <li class="breadcrumb-item active">Roles</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Liste des rôles des agents</h1>
                </div>
                <div class="col-auto <?= checkModuleAccess(null, 'admins'); ?>">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-info rounded-5" href="javascript:void();"
                                data-toggle="modal" data-target="#offcanvasFeedback" aria-controls="offcanvasFeedback">
                                    <i class="fas fa-plus"></i> Nouveau rôle agent</a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <section class="section <?= checkModuleAccess(null, 'admins'); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-striped" id="datatablesExample2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Libellé</th>
                                    <th>Description</th>
                                    <th>Etat</th>
                                    <th>Date</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                if (isset($users_roles) && (!empty($users_roles))):
                                    foreach ($users_roles as $key => $role):
                                        $roleuid = $role['role_id']; ?>
                                        <tr class="small">
                                            <td class="text-capitalize"><?=  $count++; ?></td>
                                            <td class="text-uppercase"><?= $role['role_name']; ?></td>
                                            <td class=""><?= $role['role_notes']; ?></td>
                                            <td class="text-capitalize badge bg-info"><?= $role['role_status']; ?></td>
                                            <td><?= $role['role_created_at']; ?></td>
                                            <td class="text-end">
                                                <a href="<?= base_url('admin/edit/role/' . $roleuid); ?>"
                                                class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#offcanvasEdit<?= $count; ?>"
                                                aria-controls="offcanvasEdit<?= $count; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/details/role/' . $roleuid); ?>"
                                                class="btn btn-dark btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- ====== FEEDBACK FORM====== -->
                                        <div class="modal modal-end bg-gray-400" tabindex="-1" id="offcanvasEdit<?= $count; ?>"
                                            aria-labelledby="offcanvasFeedbackLabel" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <span id="offcanvasEditLabel" class="h5 text-uppercase">
                                                            Modification Rôle: <?= $role['role_name']; ?></span>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="text-danger">
                                                                    <i class="fa fa-window-close"></i></span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        $validation = \Config\Services::validation();
                                                        $session = \Config\Services::session();
                                                        $attributes = array('role' => "form", 'class' => "formsend");
                                                        echo form_open_multipart(base_url('admin/saveRole/update/'.$roleuid), $attributes); ?>
                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <label for="name" class="label-control"><span class="text-danger">*</span>Libellé Rôle</label>
                                                                <input type="text" name="name" value="<?= $role['role_name']; ?>"
                                                                    class="form-control btnrounded <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                                    id="name" placeholder="Libellé du type véhicule" required>
                                                                <span class="invalid-feedback"><?= displayFormError($validation, 'name'); ?></span>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group mb-2">
                                                                    <label for="status" class="label-control"><span class="text-danger">*</span>Etat du rôle</label>
                                                                    <select class="form-control <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                                                            title="Status" name="status" id="status">
                                                                        <option disabled selected>- selectionnez un état -</option>
                                                                        <?php
                                                                        $status_values = array(
                                                                            'actif' => 'Activé',
                                                                            'inactif' => 'Désactivé',
                                                                        );
                                                                        $status = (!empty($role['role_status'])) ? $role['role_status'] : '';

                                                                        foreach ($status_values as $value => $display_text) { ?>
                                                                            <option value="<?= $value; ?>" <?= ($status == $value) ? 'selected' : '';
                                                                            set_select("status", $value); ?>><?= $display_text; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <span class="text-danger"><?= displayFormError($validation, 'status'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="description" class="label-control"><span class="text-danger">(Optional)</span>Description du type</label>
                                                            <textarea class="form-control h-50 <?= ($validation->hasError('description')) ? ' is-invalid' : '' ?>"
                                                                    name="description" rows="3" cols="30" maxlength="500"
                                                                    placeholder="Décrivez ici..."><?= $role['role_notes']; ?></textarea>
                                                            <span class="invalid-feedback"><?= displayFormError($validation, 'description'); ?></span>
                                                        </div>
                                                        
                                                        <div class="text-center mt-4">
                                                            <button type="submit" class="btn btn-info btnrounded">Enregistrer les modifications</button>
                                                        </div>
                                                        <?= form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ====== END FEEDBACK====== -->
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- ====== FEEDBACK FORM====== -->
<div class="modal modal-end bg-gray-400" tabindex="-1" id="offcanvasFeedback"
     aria-labelledby="offcanvasFeedbackLabel" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span id="offcanvasEditLabel" class="h5 text-uppercase"> Nouveau role</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger">
                        <i class="fa fa-window-close"></i></span>
                    </button>
            </div>
            <div class="modal-body">
                <?php
                $validation = \Config\Services::validation();
                $session = \Config\Services::session();
                $attributes = array('role' => "form", 'class' => "formsend");
                echo form_open_multipart(base_url('admin/saveRole/create'), $attributes); ?>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="name" class="label-control"><span class="text-danger">*</span>Libellé Rôle Agent</label>
                        <input type="text" name="name" value="<?= old('name'); ?>"
                            class="form-control btnrounded <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                            id="name" placeholder="Nom du rôle" required>
                        <span class="invalid-feedback"><?= displayFormError($validation, 'name'); ?></span>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-2">
                            <label for="status" class="label-control"><span class="text-danger">*</span>Etat du rôle</label>
                            <select class="form-control <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                    title="Status" name="status" id="status">
                                <option disabled selected>- selectionnez un état -</option>
                                <?php
                                $status_values = array(
                                    'actif' => 'Activé',
                                    'inactif' => 'Désactivé',
                                );
                                //$status = (!empty($expat['expatriate_status'])) ? $expat['expatriate_status'] : '';
                                //($status == $value) ? 'selected' : '';
                                foreach ($status_values as $value => $display_text) { ?>
                                    <option value="<?= $value; ?>" <?=
                                    set_select("status", $value); ?>><?= $display_text; ?></option>
                                <?php } ?>
                            </select>

                            <span class="text-danger"><?= displayFormError($validation, 'status'); ?></span>

                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="description" class="label-control"><span class="text-danger">(Optional)</span>Description du rôle</label>
                    <textarea class="form-control h-50 <?= ($validation->hasError('description')) ? ' is-invalid' : '' ?>"
                            name="description" rows="5" maxlength="500"
                            placeholder="Décrivez ici..."><?= old('description'); ?></textarea>
                    <span class="invalid-feedback"><?= displayFormError($validation, 'description'); ?></span>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-info btnrounded">Enregistrer</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- ====== END FEEDBACK====== -->