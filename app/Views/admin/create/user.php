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
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Création nouvel utilisateur</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm" href="<?= base_url('admin/view/users'); ?>">
                                    <i class="fas fa-chevron-left"></i> Liste Utilisateurs</a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <div class="basic-choices">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-200">
                            <div class="card-content">
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(base_url('admin/saveAccount'), $attributes);
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
                                                        value="<?= set_value('name'); ?>" autofocus
                                                />
                                                <label for="name"><span class="text-danger">*</span>Nom Agent</label>
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
                                                        value="<?= set_value('lastname'); ?>"
                                                />
                                                <label for="lastname"><span class="text-danger">*</span>Prénom Agent</label>
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
                                                        id="login_name" placeholder="Ex: eliel" name="username"
                                                        value="<?= set_value('username'); ?>"
                                                        aria-describedby="login_name" autocomplete="off"
                                                />
                                                <label for="login_name"> <span class="text-danger">*</span>Nom d'utilisateur ou Identifiant</label>
                                                <div id="user_name" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'username'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input type="text"
                                                        class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                        id="email" placeholder="Ex: ilunga@ditotase.com"
                                                        name="email" aria-describedby="floatingInputHelpModel"
                                                        value="<?= set_value('email'); ?>" />
                                                <label for="email"> 
                                                    <span class="text-danger"></span>Adresse mail utilisateur
                                                </label>
                                                <div id="floatingInputHelpModel" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'email'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input type="text"
                                                        class="form-control <?= ($validation->hasError('phone')) ? ' is-invalid' : '' ?>"
                                                        id="phone" placeholder="+243858533285" name="phone"
                                                        value="<?= set_value('phone'); ?>"
                                                        aria-describedby="floatingInputHelpPhone"  />
                                                <label for="phone">
                                                    <span class="text-danger">*</span>Numéro Téléphone Agent</label>
                                                <div id="floatingInputHelpPhone" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-floating mb-2">
                                            <select class="form-control form-select form-control-lg <?= ($validation->hasError('type_user')) ? ' is-invalid' : '' ?>"
                                                    title="Role Agent" name="type_user" id="type_user">
                                                <option disabled selected>-selectionnez-</option>
                                                <?php
                                                $types_values = array(
                                                    'sysadmin' => "Administrateur système",
                                                    'agent' => "Utilisateur système",
                                                    'admin' => "Administrateur / Gestionnaire",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                                    <option value="<?= $key; ?>" <?= set_select("type_user", $key); ?>>
                                                        <?= ucfirst($value); ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="type_user"><span class="text-danger">*</span>Type de compte</label>
                                            <span class="text-danger"><?= displayFormError($validation, 'type_user'); ?></span>
                                        </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <select class="form-control form-select form-control-lg <?= ($validation->hasError('roleuid')) ? ' is-invalid' : '' ?>"
                                                        title="Role Agent" name="roleuid" id="roleuid">
                                                    <option disabled selected>-selectionnez-</option>
                                                    <?php if(isset($users_roles) && (!empty($users_roles))){
                                                    foreach ($users_roles as $key => $value) { ?>
                                                        <option value="<?= $value['role_id']; ?>" <?= set_select("roleuid", $value['role_id']); ?>>
                                                            <?= ucfirst($value['role_name']); ?></option>
                                                    <?php } } ?>
                                                </select>
                                                <label for="roleuid"><span class="text-danger">*</span>Rôle ou fonction de l'agent</label>
                                                <span class="text-danger"><?= displayFormError($validation, 'roleuid'); ?></span>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('address')) ? ' is-invalid' : '' ?>"
                                                        id="address" placeholder="Ex: Avenue, Quartier, Commune" name="address"
                                                        value="<?= set_value('address'); ?>"
                                                        aria-describedby="address"
                                                />
                                                <label for="address" class="label-control"><span
                                                        class="text-danger"></span>
                                                Adresse de résidence de l'agent</label>
                                                <span class="text-danger">
                                                    <?= displayFormError($validation, 'address'); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-12">
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
                                        </div>
                                        
                                        <div class="col-sm-6">
                                        <input type="password"  id="pass_fake" name="pass_fake"  value="pass_fake" class="d-none"  />
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="password"
                                                        class="password form-control <?= ($validation->hasError('pass')) ? ' is-invalid' : '' ?>"
                                                        id="pass" placeholder="Ex: XXLOLL29303JF" name="pass"
                                                        value="<?= set_value('pass'); ?>"
                                                        aria-describedby="floatingInputHelpPass"
                                                />
                                                <label for="pass"><span class="text-danger">*</span>Créez un mot de passe agent
                                                    </label>
                                                <div id="floatingInputHelpPass" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'pass'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="password"
                                                        class="password form-control <?= ($validation->hasError('cpass')) ? ' is-invalid' : '' ?>"
                                                        id="cpass" placeholder="Ex: XXLOLL29303JF" name="cpass"
                                                        value="<?= set_value('cpass'); ?>"
                                                        aria-describedby="floatingInputHelpcPass"
                                                />
                                                <label for="cpass"><span class="text-danger">*</span>Confirmer le mot de passe crée</label>
                                                <div id="floatingInputHelpcPass" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'cpass'); ?></span>
                                                </div>
                                            </div>
                                        </div>           
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group mt-2">
                                                <div class="form-floatinginput-group">
                                                    <div class="input-group-text bg-transparent" id="inputGroupPrepend">
                                                        <button title="Afficher Password" onclick="showPass();" type="button"
                                                            class="btn btn-default bg-transparent" style="border:none!important;">
                                                            <i id="eyepass" class="fas fa-eye"></i> Afficher le mot de passe
                                                        </button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group mt-2 text-center">
                                                <label for="expire_pass" class="form-label text-dark small">
                                                    
                                                <span class="text-danger">*</span>Le mot de passe expire à la prémière connexion ?
                                                    <input type="checkbox" class="form-control <?= ($validation->hasError('expire_pass')) ? ' is-invalid' : '' ?>"
                                                                id="expire_pass" name="expire_pass" checked>
                                                </label>
                                                <div id="floatingInputHelpcavatar" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'expire_pass'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="text-right mt-2">
                                                <button class="btn  btn-info btn-lg rounded-2 btnrounded" type="submit">
                                                    <i class="fas fa-check-circle"></i> Valider la création du compte
                                                </button>
                                            </div>
                                        </div>
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
