<?php if (isset($customer) && (!empty($customer))): ?>
<div class="content-wrapper mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="text-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                <li class="breadcrumb-item active" aria-current="page">Compte</li>
            </ol>
        </nav>
        <div class="text-center alert alert-primary">
            <h1 class="fw-bold text-center">Mise à jour du profil</h1>
        </div>
        

        <div class="row section">
            <div class="col-12 col-lg-6 col-sm-12">
                <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="">
                                    <img src="<?= base_url('public/uploads/images/' . $customer['customer_avatar']); ?>"
                                        alt="IMG" class="avatar avatar-lg" />
                                </div>
                                <!--//icon-holder-->
                            </div>
                            <!--//col-->
                            <div class="col-auto">
                                <h3 class="app-card-title text-uppercase fw-bold"><?= ($customer['customer_name']); ?>
                                </h3>
                                <h5 class="app-card-title text-danger fw-bold">ID : <span
                                        class="text-end"><?= $customer['customer_code']; ?>
                                    </span></h5>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">


                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Email </strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary">
                                        <?= $customer['customer_email']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Téléphone</strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 text-primary fw-bold">
                                        <?= $customer['customer_phone']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Nom Agent</strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $customer['customer_firstname']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Prénom Agent</strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $customer['customer_lastname']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Nom complet</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $customer['customer_name']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                    </div>
                    <!--//app-card-body-->
                    <div class="app-card-body px-4 w-100">
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Etat du compte</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $customer['customer_status']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Categorie </strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= setSchoolCategory($customer['customer_category']); ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Type compte</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5  fw-bold text-primary text-capitalize">
                                        <?= ($customer['customer_type'] == 'company') ? 'Entreprise':'Individuel'; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Langue</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5  fw-bold text-primary text-uppercase">
                                        <?= $customer['customer_language']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Adresse </strong></div>

                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="small fw-bold text-primary text-uppercase">
                                        <?= $customer['customer_address']; ?>
                                    </span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2">
                                        <strong>A propos du compte</strong>
                                    </div>
                                    <div class="item-data text-primary text-capitalize">
                                        <?= $customer['customer_notes']; ?></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold "></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->


                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
            <div class="col-12 col-lg-6 col-sm-12">
            <div class="basic-choices">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-200">
                            <div class="card-content">
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(base_url('admincustomer/profile'), $attributes);
                                ?>
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-12">
                                            <div class="form-group mb-2">
                                            <label for="customername">
                                            <span class="text-danger">*</span>Nom complet</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('customername')) ? ' is-invalid' : '' ?>"
                                                        id="customername" name="customername"
                                                        value="<?= $customer['customer_name']; ?>"
                                                        aria-describedby="customername"
                                                />
                                                <div id="customername" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'customername'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="name"><span class="text-danger"></span>Nom compte</label>
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                        id="name" placeholder="Ex: Ilunga" name="name"
                                                        aria-describedby="floatingInputHelpNumber"
                                                        value="<?= $customer['customer_firstname']; ?>"
                                                />
                                                
                                                <div id="floatingInputHelpNumber" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'name'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="lastname">
                                            <span class="text-danger"></span>Prénom compte</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('lastname')) ? ' is-invalid' : '' ?>"
                                                        id="lastname" placeholder="Patient" name="lastname"
                                                        aria-describedby="floatingInputHelpMArk"
                                                        value="<?= $customer['customer_lastname']; ?>"
                                                />
                                                <div id="floatingInputHelpMArk" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'lastname'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                            <label for="email">
                                            <span class="text-danger"></span>E-mail compte</label>
                                                
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>"
                                                        id="email" placeholder="Ex: ilunga.patient@ditotase.com"
                                                        name="email"
                                                        aria-describedby="floatingInputHelpModel"
                                                        value="<?= $customer['customer_email']; ?>"
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
                                                        value="<?= $customer['customer_phone']; ?>"
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
                                            <span class="text-danger">*</span>Categorie de clients</label>
                                            <select class="form-select form-control <?= ($validation->hasError('gender')) ? ' is-invalid' : '' ?>"
                                                    title="Sexe Agent" name="gender" id="gender">
                                                <option disabled selected>Sélectionnez</option>

                                                <?php
                                                $cat_db = $customer['customer_category'];
                                            $categories = setSchoolCategory();
                                                foreach ($categories as $key => $value): ?>
                                                    <option value="<?= esc($key); ?>" <?= ($cat_db == $key) ? 'selected': set_select('school_category', esc($key)); ?>>
                                                        <?= ucfirst(esc($value)); ?>
                                                <?php endforeach; ?>
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
                                                    $old_la_db = $customer['customer_language'];
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
                                        <div class="col-sm-12  mt-2">
                                            <div class="form-group">
                                            <label for="address" class="label-control">
                                                Adresse domicilaire </label>
                                            <textarea
                                                    class="form-control text-capitalize <?= ($validation->hasError('address')) ? ' is-invalid' : '' ?>"
                                                    name="address" rows="5" cols="30" id="address"
                                                    placeholder="Décrivez l'adresse ici..."><?= $customer['customer_address']; ?></textarea>
                                            <span class="text-danger"><?= displayFormError($validation, 'address'); ?></span>
                                        </div>
                                        </div>
                                        <div class="col-sm-12  mt-2">
                                            <div class="form-group">
                                                <label for="about" class="label-control">
                                                    A propos 
                                                </label>
                                           
                                            <textarea
                                                    class="form-control <?= ($validation->hasError('about')) ? ' is-invalid' : '' ?>"
                                                    name="about" rows="5" cols="30" id="about"
                                                    placeholder="Décrivez l'adresse ici..."><?= $customer['customer_notes']; ?></textarea>
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
            </div>
        </div>
    </div>
</div>
<?php endif; ?>