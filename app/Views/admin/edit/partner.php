<?php if (isset($customer) && (!empty($customer))): ?>
    <div class="app-content pt-3 p-md-3 p-lg-4 <?= checkModuleAccess(null, 'admins'); ?>">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carnet d'adresses</li>
                    <li class="breadcrumb-item active" aria-current="page">Partenaires</li>
                </ol>
            </nav>

            <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 h5 fw-bold text-capitalize">
                        <?= $customer['client_name']; ?>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm"
                                   href="<?= base_url('admin/view/partners'); ?>">
                                    <i class="fas fa-chevron-left"></i> Liste
                                </a>
                                    <a class="btn btn-danger btn-sm"
                                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce Partenaire ?'); false;"
                                   href="<?= base_url('admin/remove/partner/'.$customer['client_uid']); ?>">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                                <a class="btn btn-success btn-sm"
                                   href="<?= base_url('admin/details/partner/'.$customer['client_uid']); ?>">
                                    <i class="fas fa-info-circle"></i> Détails
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <div class="alert alert-primary">
            <div class="text-center">
                <h1 class="app-title">Modification fiche d'un Partenaire</h1>
            </div></div>
            <div class="basic-choices">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-200">
                            <div class="card-content">
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'id' => 'form-client');
                                echo form_open_multipart(base_url('admin/saveCustomer/update/' . $customer['client_uid']), $attributes);
                                ?>
                                <input type="hidden" value="customer" name="client_type">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                        id="name" placeholder="Ex: Ilunga" name="name"
                                                        aria-describedby="floatingInputHelpNumber"
                                                        value="<?= (set_value('name'))?set_value('name'): $customer['client_name']; ?>"
                                                />
                                                <label for="name">Nom du client <span
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
                                                        class="form-control <?= ($validation->hasError('jobtitle')) ? ' is-invalid' : '' ?>"
                                                        id="jobtitle" placeholder="Ex: Ilunga" name="jobtitle"
                                                        aria-describedby="jobtitle"
                                                        value="<?= (set_value('jobtitle'))?set_value('jobtitle'):$customer['client_jobtitle']; ?>"
                                                />
                                                <label for="jobtitle">Profession du client <span
                                                            class="text-danger">(*)</span></label>
                                                <div id="jobtitle" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'jobtitle'); ?></span>
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
                                                        value="<?= (set_value('email'))?set_value('email'):$customer['client_email']; ?>"
                                                />
                                                <label for="email">E-mail du client<span
                                                            class="text-danger">(*)</span></label>
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
                                                        id="phone" placeholder="Ex: +243858533285" name="phone"
                                                        value="<?= (set_value('phone'))?set_value('phone'):$customer['client_phone']; ?>"
                                                        aria-describedby="floatingInputHelpPhone"
                                                />
                                                <label for="phone">Numéro Téléphone du client<span
                                                            class="text-danger">(*)</span></label>
                                                <div id="floatingInputHelpPhone" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <select class="choices form-select text-capitalize <?= ($validation->hasError('type_user')) ? ' is-invalid' : '' ?>"
                                                    title="Type client" name="type_user" id="type_user">
                                                <option disabled selected>Type de client</option>

                                                <?php
                                                $old_type_db = $customer['client_type'];

                                                $types_values = array(
                                                    'entreprise' => "Entreprise",
                                                    'particulier' => "Particulier",
                                                    'association' => "Association",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                                    <option value="<?= $key; ?>" 
                                                    <?= ($old_type_db == $key) ? 'selected' : set_select("type_user", $key); ?>>
                                                        <?= ucfirst($value); ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?= displayFormError($validation, 'type_user'); ?></span>
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <select class="choices form-select text-capitalize <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                                    title="Role Agent" name="status" id="status">
                                                <option disabled selected>Etat du client (*)</option>

                                                <?php
                                                $old_status_db = $customer['client_status'];

                                                $types_values = array(
                                                    'actif' => "Activé",
                                                    'inactif' => "Désactivé",
                                                    'blocked' => "Bloqué",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                                    <option value="<?= $key; ?>" 
                                                    <?= ($old_status_db == $key) ? 'selected' : set_select("status", $key); ?>>
                                                        <?= ucfirst($value); ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?= displayFormError($validation, 'status'); ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('city')) ? ' is-invalid' : '' ?>"
                                                        id="city" placeholder="Ex: Ilunga" name="city"
                                                        aria-describedby="city"
                                                        value="<?= (set_value('city'))?set_value('city'):$customer['client_city']; ?>"
                                                />
                                                <label for="city">Ville <span
                                                            class="text-danger"></span></label>
                                                <div id="city" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'city'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('country')) ? ' is-invalid' : '' ?>"
                                                        id="country" placeholder="Ex: Ilunga" name="country"
                                                        aria-describedby="country"
                                                        value="<?= (set_value('country'))?set_value('country'):$customer['client_country']; ?>"
                                                />
                                                <label for="country">Pays <span
                                                            class="text-danger"></span></label>
                                                <div id="country" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'country'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-2">
                                                <input
                                                        type="text"
                                                        class="form-control <?= ($validation->hasError('whatsapp')) ? ' is-invalid' : '' ?>"
                                                        id="whatsapp" placeholder="Ex: Ilunga" name="whatsapp"
                                                        aria-describedby="whatsapp"
                                                        value="<?= (set_value('whatsapp'))?set_value('whatsapp'): $customer['client_whatsapp']; ?>"
                                                />
                                                <label for="whatsapp">WhatsApp Contact <span
                                                            class="text-danger"></span></label>
                                                <div id="whatsapp" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'whatsapp'); ?></span>
                                                </div>
                                            </div>
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
                                                <label for="avatar"> Logo ou Photo du client </label>
                                                <div id="floatingInputHelpcavatar" class="form-text">
                                                    <span class="text-danger"><?= displayFormError($validation, 'avatar'); ?></span>
                                                </div>
                                            </div>

                                            <!-- OLD PICTURE -->
                                            <input type="hidden" id="old_client_image" name="old_client_image"
                                                    value="<?= $customer['client_image']; ?>"
                                            />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="address" class="label-control"><span
                                                        class="text-danger">-</span>
                                                Adresse du client</label>
                                            <textarea
                                                    class="form-control form-control-lg <?= ($validation->hasError('address')) ? ' is-invalid' : '' ?>"
                                                    name="address" rows="5" cols="30" id="address"
                                                    placeholder="Décrivez l'adresse ici..."><?= (set_value('address'))?set_value('address'):$customer['client_address']; ?></textarea>
                                            <span class="text-danger"><?= displayFormError($validation, 'address'); ?></span>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="about" class="label-control"><span
                                                        class="text-danger">-</span>
                                                Observation ou A propos du client</label>
                                            <textarea
                                                    class="form-control form-control-lg <?= ($validation->hasError('about')) ? ' is-invalid' : '' ?>"
                                                    name="about" rows="5" cols="30" id="about"
                                                    placeholder="Décrivez a propos du client ici..."><?= (set_value('about'))?set_value('about'):$customer['client_about']; ?></textarea>
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
<?php endif; ?>