<?php if (isset($user) && (!empty($user))): ?>
    <div class="content-wrapper <?= checkModuleAccess(null, 'admins'); ?>">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administration</li>
                    <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
                </ol>
            </nav>

            <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 h5 fw-bold text-capitalize">
                        <?= $user['user_firstname']; ?>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm"
                                   href="<?= base_url('admin/view/users'); ?>">
                                    <i class="fas fa-chevron-left"></i> Liste
                                </a>
                                <a class="btn btn-success btn-sm"
                                   href="<?= base_url('admin/details/user/'.$user['user_id']); ?>">
                                    <i class="fas fa-info-circle"></i> Détails
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <div class="alert alert-primary">
            <div class="text-center">
                <h1 class="app-title">Modification compte Utilisateur</h1>
            </div></div>
            <div class="basic-choices">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-200">
                            <div class="card-content">
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(base_url('admin/updateAccount/' . $user['user_id']), $attributes);
                                ?>
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                        id="name" placeholder="Ex: Ilunga" name="name"
                                                        aria-describedby="floatingInputHelpNumber"
                                                        value="<?= $user['user_firstname']; ?>" autofocus
                                                />
                                                <label for="name">Nom Agent<span
                                                            class="text-danger">(*)</span></label>
                                                <div id="floatingInputHelpNumber" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'name'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('lastname')) ? ' is-invalid' : '' ?>"
                                                        id="lastname" placeholder="Patient" name="lastname"
                                                        aria-describedby="floatingInputHelpMArk"
                                                        value="<?= $user['user_lastname']; ?>"
                                                />
                                                <label for="lastname">Prénom Agent<span
                                                            class="text-danger">(*)</span></label>
                                                <div id="floatingInputHelpMArk" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'lastname'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                                        id="username" placeholder="Ex: eliel" name="username"
                                                        value="<?= $user['user_name']; ?>"
                                                        aria-describedby="username"
                                                />
                                                <label for="username"> <span class="text-danger">*</span>Nom d'utilisateur ou Identifiant</label>
                                                <div id="username" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'username'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                        id="email" placeholder="Ex: ilunga.patient@ditotase.com"
                                                        name="email"
                                                        aria-describedby="floatingInputHelpModel"
                                                        value="<?= $user['user_email']; ?>"
                                                />
                                                <label for="email">Adresse mail Agent<span
                                                            class="text-danger"></span></label>
                                                <div id="floatingInputHelpModel" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'email'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('phone')) ? ' is-invalid' : '' ?>"
                                                        id="phone" placeholder="+243858533285" name="phone"
                                                        value="<?= $user['user_phone']; ?>"
                                                        aria-describedby="floatingInputHelpPhone"
                                                />
                                                <label for="phone">Numéro Téléphone Agent<span
                                                            class="text-danger">(*)</span></label>
                                                <div id="floatingInputHelpPhone" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <select class="form-control form-select form-control-lg <?= ($validation->hasError('type_user')) ? ' is-invalid' : '' ?>"
                                                    title="Role Agent" name="type_user" id="type_user">
                                                <option disabled selected>Type de compte (*)</option>

                                                <?php
                                                $old_type_db = $user['user_type'];

                                                $types_values = array(
                                                    'sysadmin' => "Administrateur système",
                                                    'agent' => "Utilisateur système",
                                                    'admin' => "Administrateur / Gestionnaire",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                                    <option value="<?= $key; ?>" <?= ($old_type_db == $key) ? 'selected' : set_select("type_user", $key); ?>>
                                                        <?= ucfirst($value); ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger">
                                                <?= displayFormError($validation, 'type_user'); ?>
                                            </span>
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <select class="form-control form-select form-control-lg <?= ($validation->hasError('roleuid')) ? ' is-invalid' : '' ?>"
                                                    title="Role Agent" name="roleuid" id="roleuid">
                                                <option disabled selected>Rôle ou fonction de l'agent (*)</option>
                                                <?php
                                                $old_role_db = $user['user_role_id'];
                                                 if(isset($users_roles) && (!empty($users_roles))){
                                                foreach ($users_roles as $key => $value) { ?>
                                                    <option value="<?= $value['role_id']; ?>" <?= ($old_role_db == $value['role_id']) ? 'selected' :set_select("roleuid", $value['role_id']); ?>>
                                                        <?= ucfirst($value['role_name']); ?></option>
                                                <?php }} ?>
                                            </select>
                                            <span class="text-danger"><?= displayFormError($validation, 'roleuid'); ?></span>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <select class="form-control form-select form-control-lg  <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                                    title="Statut Agent" name="status" id="status">
                                                <option disabled selected>Etat du compte (*)</option>

                                                <?php
                                                $old_status_db = $user['user_status'];

                                                $types_values = array(
                                                    'actif' => "Activé",
                                                    'inactif' => "Désactivé",
                                                    'blocked' => "Bloqué",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                                    <option value="<?= $key; ?>" <?= ($old_status_db == $key) ? 'selected' : set_select("status", $key); ?>>
                                                        <?= ucfirst($value); ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?= displayFormError($validation, 'status'); ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="file"
                                                        class="form-control <?= ($validation->hasError('avatar')) ? ' is-invalid' : '' ?>"
                                                        id="avatar" placeholder="Ex: XXLOLL29303JF" name="avatar"
                                                        value="<?= set_value('avatar'); ?>"
                                                        aria-describedby="floatingInputHelpcavatar"
                                                />
                                                <label for="avatar">Photo de profil du compte</label>
                                                <div id="floatingInputHelpcavatar" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'avatar'); ?></span>
                                                </div>
                                            </div>

                                            <!-- OLD PICTURE -->
                                            <input type="hidden" id="old_avatar" name="old_avatar"
                                                    value="<?= $user['user_avatar']; ?>"
                                            />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="address" class="label-control"><span
                                                        class="text-danger">(Optional)</span>
                                                Adresse de résidence de l'agent</label>
                                            <textarea
                                                    class="form-control form-control-lg <?= ($validation->hasError('address')) ? ' is-invalid' : '' ?>"
                                                    name="address" rows="5" cols="30" id="address"
                                                    placeholder="Décrivez l'adresse ici..."><?= $user['user_address']; ?></textarea>
                                            <span class="text-danger"><?= displayFormError($validation, 'address'); ?></span>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="about" class="label-control"><span
                                                        class="text-danger">(Optional)</span>
                                                A propos de l'agent</label>
                                            <textarea
                                                    class="form-control form-control-lg <?= ($validation->hasError('about')) ? ' is-invalid' : '' ?>"
                                                    name="about" rows="5" cols="30" id="about"
                                                    placeholder="Décrivez l'adresse ici..."><?= $user['user_notes']; ?></textarea>
                                            <span class="text-danger"><?= displayFormError($validation, 'about'); ?></span>
                                        </div>
                                    </div>
                                    <div class="my-3 text-center">
                                        <button class="btn  btn-primary btn-lg rounded-2 py-3 btnrounded"
                                                type="submit">
                                           <i class="fas fa-check-circle"></i> Enregistrer les modifications
                                        </button>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>