<div class="content-wrapper">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administration</li>
                    <li class="breadcrumb-item active" aria-current="page">Privilèges</li>
                </ol>
            </nav>
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Gestion des privilèges</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-primary btnrounded" href="#offcanvasFeedback">

                                    <i class="fas fa-plus"></i> Nouvel accès</a>
                            </div>
                        </div>
                        <!--//row-->
                    </div>
                    <!--//table-utilities-->
                </div>
                <!--//col-auto-->
            </div>
            <!--//row-->
            <section class="section <?= checkModuleAccess(null, 'admins'); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered" id="datatablesExample2">
                                <thead>
                                    <tr>
                                        
                                        <th>Rôle</th>
                                        <th>Module</th>
                                        <th>Rubrique</th>
                                        <th>Lire</th>
                                        <th>Créer</th>
                                        <th>Editer</th>
                                        <th>Supprimer</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                            $count = 1;
                            if (isset($users) && (!empty($users))):
                                foreach ($users as $key => $user):
                                    $count++;
                                    $access_id = $user['access_id'];
                                    $status = $user['access_status'];
                                    ?>
                                    <tr class="small">

                                    <td class="text-capitalize"><?= $user['role_name']; ?></td>
                                        <td class="text-uppercase small">
                                            <?= (!empty($user['access_type'])) ? setAccessModules($user['access_type']):$user['access_type']; ?>
                                        </td>
                                        <td class="text-uppercase small">
                                            <?= setModulesFeatures($user['access_name'], $user['access_type']); ?>
                                        </td>
                                        <td class="text-capitalize">
                                            <i
                                                class="fas <?= ($user['access_reading'] == "on")? "fa-check-circle text-success":"fa-window-close text-danger"; ?>"></i>
                                        </td>
                                        <td class="text-capitalize">
                                            <i
                                                class="fas <?= ($user['access_created'] == "on")? "fa-check-circle text-success":"fa-window-close text-danger"; ?>"></i>
                                        </td>
                                        <td class="text-capitalize">
                                            <i
                                                class="fas <?= ($user['access_updated'] == "on")? "fa-check-circle text-success":"fa-window-close text-danger"; ?>"></i>
                                        </td>
                                        <td class="text-capitalize">
                                            <i
                                                class="fas <?= ($user['access_deleted'] == "on")? "fa-check-circle text-success":"fa-window-close text-danger"; ?>"></i>
                                        </td>
                                        <td
                                            class="text-capitalize <?= ($status == 'actif') ? 'badge bg-success' : 'badge bg-danger'; ?>">
                                            <?= $status; ?></td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-dark btn-sm" data-toggle="modal"
                                                data-target="#offcanvasEdit<?= $count; ?>"
                                                aria-controls="offcanvasEdit<?= $count; ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm"
                                                onclick="return confirm('Etes-vous sûr de vouloir supprimer ce compte ?'); false;"
                                                href="<?= base_url('admin/remove/acces/'.$user['access_id']); ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal modal-end bg-gray-400" tabindex="-1"
                                        id="offcanvasEdit<?= $count; ?>" aria-labelledby="offcanvasEditLabel"
                                        data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="offcanvas-title d-inline-flex">
                                                        Annulation des accès
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true" class="text-danger">
                                                            <i class="fa fa-window-close"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                            $validation = \Config\Services::validation();
                                            $session = \Config\Services::session();
                                            $attributes = array('role' => "form", 'id' => "form-access-edit",'class' => "formsend");
                                            echo form_open_multipart(base_url('admin/grantUserAccess/revoke/'.$access_id), $attributes); ?>
                                                    <div class="row">

                                                        <div class="col-sm-12">
                                                            <div class="form-group mb-2">
                                                                <label for="status" class="label-control"><span
                                                                        class="text-danger">*</span>Etat des
                                                                    accès</label>
                                                                <select
                                                                    class="form-select form-control <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                                                    title="Status" name="status" id="status">
                                                                    <option disabled selected>- sélectionnez -</option>
                                                                    <?php
                                                            $status_values = array(
                                                                'actif' => 'Activé',
                                                                'inactif' => 'Désactivé',
                                                            );
                                                            $status = (!empty($user['access_status'])) ? $user['access_status'] : '';

                                                            foreach ($status_values as $value => $display_text) { ?>
                                                                    <option value="<?= $value; ?>" <?= ($status == $value) ? 'selected' : 
                                                                set_select("status", $value); ?>><?= $display_text; ?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span
                                                                    class="text-danger"><?= displayFormError($validation, 'status'); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group mb-2">
                                                                <label for="module" class="label-control"><span
                                                                        class="text-danger">*</span>Rubrique</label>
                                                                <select
                                                                    class="form-select form-control <?= ($validation->hasError('module')) ? ' is-invalid' : '' ?>"
                                                                    title="module" name="module" id="module">
                                                                    <option disabled selected>- sélectionnez -</option>
                                                                    <?php
                                                            $module_db = (!empty($user['access_type'])) ? $user['access_type'] : '';
                                                            $feature_db = (!empty($user['access_name'])) ? $user['access_name'] : '';

                                                            $modules_values = setModulesFeatures(null, $module_db);
                                                            foreach ($modules_values as $valuemod => $display_text_module) { ?>
                                                                    <option value="<?= $valuemod; ?>"
                                                                        <?= ($feature_db == $valuemod) ? 'selected' : set_select("module", $valuemod); ?>>
                                                                        <?= $display_text_module; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span
                                                                    class="text-danger"><?= displayFormError($validation, 'module'); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 form-group">
                                                            <label for="roleupdated" class="label-control">
                                                                <span class="text-danger">*</span>Role
                                                                utilisateurs</label>
                                                            <select
                                                                class="form-control form-select <?= ($validation->hasError('role')) ? ' is-invalid' : '' ?>"
                                                                title="Role Agent" name="role" id="roleupdated">
                                                                <option disabled selected>Rôle ou fonction de l'agent
                                                                    (*)</option>
                                                                <?php if(isset($users_roles) && (!empty($users_roles))){
                                                            $role_db = (!empty($user['access_role_id'])) ? $user['access_role_id'] : '';
                                                            foreach ($users_roles as $key => $role) { ?>
                                                                <option value="<?= $role['role_id']; ?>"
                                                                    <?= ($role_db == $role['role_id']) ? 'selected' : set_select("role", $role['role_id']); ?>>
                                                                    <?= ucfirst($role['role_name']); ?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span
                                                                class="text-danger"><?= displayFormError($validation, 'role'); ?></span>
                                                        </div>
                                                        <div class="col-sm-12 form-group bg-light text-center">
                                                            <h5>
                                                                Les droits d'accès pour le rôle choisi sur le module
                                                                sélectionné
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-floating">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        <?= (!empty($user['access_reading'])) ? 'checked': ''; ?>
                                                                        class="form-check-input" id="reading"
                                                                        name="reading"> Lecture

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-floating">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        <?= (!empty($user['access_created'])) ? 'checked': ''; ?>
                                                                        class="form-check-input" id="created"
                                                                        name="created" <?= ($module_db == 'reporting') ? 'disabled':''; ?>> Création

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-floating">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        <?= (!empty($user['access_updated'])) ? 'checked': ''; ?>
                                                                        class="form-check-input" id="updated"
                                                                        name="updated" <?= ($module_db == 'reporting') ? 'disabled':''; ?>> Edition

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-floating">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        <?= (!empty($user['access_deleted'])) ? 'checked': ''; ?>
                                                                        class="form-check-input" id="deleted"
                                                                        name="deleted" <?= ($module_db == 'reporting') ? 'disabled':''; ?>> Suppression

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="text-center mt-4">
                                                        <button type="submit"
                                                            class="btn btn-primary btnrounded">Enregistrer les
                                                            modifications</button>
                                                    </div>
                                                    <?= form_close(); ?>
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


        <div class="row" tabindex="-1" id="offcanvasFeedback">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                <div class="card-header bg-info text-center text-uppercase">
                        <h3>Privilèges utilisateurs - Droits d'accès aux modules</h3>
                    </div>
                    <div class="card-body">
                        <?php
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();
        $attributes = array('role' => "form", 'class' => "formsend");
        echo form_open_multipart(base_url('admin/grantUserAccess/create'), $attributes); ?>
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-floating">

                                            <select
                                                class="select2 select2 form-select form-control <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                title="name" name="module" id="name" onchange="accessModule()">
                                                <option disabled selected>- sélectionnez -</option>
                                                <?php
                        $modules_values = setAccessModules();
                        foreach ($modules_values as $value => $display_text) { ?>
                                                <option value="<?= $value; ?>"
                                                    <?= (session()->has('accessmodule') && (session()->get('accessmodule') == $value)) ? 'selected': set_select("name", $value); ?>>
                                                    <?= $display_text; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <label for="name" class="label-control">
                                                <span class="text-danger">*</span>Module</label>
                                            <span class="text-danger">
                                                <?= displayFormError($validation, 'name'); ?></span>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-floating">

                                            <select
                                                class="select2 select2 form-select form-control <?= ($validation->hasError('roleuid')) ? ' is-invalid' : '' ?>"
                                                title="Role Agent" name="role" id="roleuid">
                                                <option disabled selected>Rôle ou fonction de l'agent (*)</option>
                                                <?php if(isset($users_roles) && (!empty($users_roles))){
                        foreach ($users_roles as $key => $value) { ?>
                                                <option value="<?= $value['role_id']; ?>"
                                                    <?= set_select("roleuid", $value['role_id']); ?>>
                                                    <?= ucfirst($value['role_name']); ?></option>
                                                <?php }} ?>
                                            </select>
                                            <label for="role" class="label-control">
                                                <span class="text-danger">*</span>Role utilisateurs</label>
                                            <span
                                                class="text-danger"><?= displayFormError($validation, 'roleuid'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                            <h5 class="py-3  bg-light text-center">
                                        Les droits d'accès pour le rôle choisi sur le module sélectionné
                                    </h5>
                                <div class="form-group">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Rubrique </th>
                                                <th>Accès</th>
                                                <th>Lecture</th>
                                                <th>Ecriture</th>
                                                <th>Edition</th>
                                                <th>Suppression</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(session()->has('accessmodule')){
                                
                                $module_choosed = session()->get('accessmodule');
                                $modules_features = setModulesFeatures(null, $module_choosed);
                                
                                foreach ($modules_features as $vfeature => $dfeature) {
                                    if(!empty($dfeature)){
                                    ?>
                                            <tr>
                                                <td class="text-uppercase font-weight-bold">
                                                    <?= $dfeature;?>
                                                </td>
                                                <td>
                                                    <input class="chechbox" type="checkbox" value="<?= $vfeature; ?>"
                                                        name="feature_<?= $vfeature; ?>"
                                                        id="<?= ($vfeature== 'all') ? 'select_alls':''; ?>" />
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="reading_<?= $vfeature; ?>"
                                                            name="reading_<?= $vfeature; ?>" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="created_<?= $vfeature; ?>"
                                                            name="created_<?= $vfeature; ?>" <?= ($module_choosed == 'reporting') ? 'disabled':''; ?> />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="updated_<?= $vfeature; ?>"
                                                            name="updated_<?= $vfeature; ?>" <?= ($module_choosed == 'reporting') ? 'disabled':''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" id="deleted_<?= $vfeature; ?>"
                                                            name="deleted_<?= $vfeature; ?>" <?= ($module_choosed == 'reporting') ? 'disabled':''; ?> />
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php }}} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btnrounded">Accorder l'accès</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ====== END FEEDBACK====== -->