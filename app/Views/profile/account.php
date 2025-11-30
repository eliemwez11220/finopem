<div class="content-wrapper mb-3">
    <div class="container">
        
            <div class="row  align-items-center justify-content-between">
                <div class="col-auto">
                    <nav aria-label="breadcrumb" class="text-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            <li class="breadcrumb-item active" aria-current="page">Compte</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm" 
                                href="<?= base_url('profile/page/profile'); ?>">
                                    <i class="fas fa-chevron-left"></i> Retour au profile</a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div>
        <div class="text-center alert alert-primary">
            <h1 class="fw-bold text-center">Mise à jour du profil compte</h1>
        </div>
        <?php if (isset($user) && (!empty($user))): ?>
            <div class="basic-choices">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-200">
                            <div class="card-content">
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(base_url('profileUpdateAccount/' . $user['user_id']), $attributes);
                                ?>
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-12">
                                            <div class="form-group mb-2">
                                            <label for="username">
                                            <span class="text-danger">*</span>Pseudonyme de connexion</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>"
                                                        id="username" name="username"
                                                        value="<?= $user['user_name']; ?>"
                                                        aria-describedby="username"
                                                />
                                                <div id="username" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'username'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="name"><span class="text-danger">*</span>Nom compte</label>
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                        id="name" placeholder="Ex: Ilunga" name="name"
                                                        aria-describedby="floatingInputHelpNumber"
                                                        value="<?= $user['user_firstname']; ?>"
                                                />
                                                
                                                <div id="floatingInputHelpNumber" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'name'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="lastname">
                                            <span class="text-danger">*</span>Prénom compte</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('lastname')) ? ' is-invalid' : '' ?>"
                                                        id="lastname" placeholder="Patient" name="lastname"
                                                        aria-describedby="floatingInputHelpMArk"
                                                        value="<?= $user['user_lastname']; ?>"
                                                />
                                                <div id="floatingInputHelpMArk" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'lastname'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="email">
                                            <span class="text-danger">*</span>E-mail compte</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                        id="email" placeholder="Ex: ilunga.patient@ditotase.com"
                                                        name="email"
                                                        aria-describedby="floatingInputHelpModel"
                                                        value="<?= $user['user_email']; ?>"
                                                />
                                                <div id="floatingInputHelpModel" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'email'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="phone">
                                            <span class="text-danger">*</span>Numéro Téléphone</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('phone')) ? ' is-invalid' : '' ?>"
                                                        id="phone" placeholder="+243858533285" name="phone"
                                                        value="<?= $user['user_phone']; ?>"
                                                        aria-describedby="floatingInputHelpPhone"
                                                />
                                                <div id="floatingInputHelpPhone" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="gender">
                                            <span class="text-danger">*</span>Sexe de l'compte</label>
                                            <select class="form-select form-control <?= ($validation->hasError('gender')) ? ' is-invalid' : '' ?>"
                                                    title="Sexe Agent" name="gender" id="gender">
                                                <option disabled selected>Sélectionnez</option>

                                                <?php
                                                $old_la_db = $user['user_gender'];
                                                $types_values2 = array(
                                                    'man' => "Homme",
                                                    'woman' => "Femme",
                                                );
                                                foreach ($types_values2 as $key => $value) { ?>
                                                    <option value="<?= $key; ?>" <?= ($old_la_db == $key) ? 'selected' : set_select("gender", $key); ?>>
                                                        <?= ucfirst($value); ?></option>
                                                <?php } ?>
                                            </select>
                                                
                                                <div id="gender" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'gender'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                                <label for="language" class="label-control">
                                                <span class="text-danger">*</span>Langues</label>
                                                <select class="form-select form-control <?= ($validation->hasError('language')) ? ' is-invalid' : '' ?>"
                                                        title="Langue Agent" name="language" id="language">
                                                    <option disabled selected>Langues parlées</option>

                                                    <?php
                                                    $old_la_db = $user['user_language'];
                                                    $types_values2 = array(
                                                        'en' => "Anglais",
                                                        'fr' => "Français",
                                                    );
                                                    foreach ($types_values2 as $key => $value) { ?>
                                                        <option value="<?= $key; ?>" <?= ($old_la_db == $key) ? 'selected' : set_select("language", $key); ?>>
                                                            <?= ucfirst($value); ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?= displayFormError($validation, 'language'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6  mt-2">
                                            <div class="form-group">
                                            <label for="address" class="label-control">
                                                Adresse domicilaire </label>
                                            <textarea
                                                    class="form-control text-capitalize <?= ($validation->hasError('address')) ? ' is-invalid' : '' ?>"
                                                    name="address" rows="5" cols="30" id="address"
                                                    placeholder="Décrivez l'adresse ici..."><?= $user['user_address']; ?></textarea>
                                            <span class="text-danger"><?= displayFormError($validation, 'address'); ?></span>
                                        </div>
                                        </div>
                                        <div class="col-sm-6  mt-2">
                                            <div class="form-group">
                                                <label for="about" class="label-control">
                                                    A propos 
                                                </label>
                                           
                                            <textarea
                                                    class="form-control <?= ($validation->hasError('about')) ? ' is-invalid' : '' ?>"
                                                    name="about" rows="5" cols="30" id="about"
                                                    placeholder="Décrivez l'adresse ici..."><?= $user['user_notes']; ?></textarea>
                                            <span class="text-danger"><?= displayFormError($validation, 'about'); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="my-3 text-center">
                                        <button class="btn  btn-primary btn-lg rounded-2 py-3 btnrounded"
                                                type="submit">
                                           <i class="fas fa-check-circle"></i> Sauvegarder les modifications
                                        </button>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

