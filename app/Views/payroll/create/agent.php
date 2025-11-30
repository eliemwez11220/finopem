<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Création d'un nouveau travailleur</h1>
                </div>
                <div class="col-12 col-lg-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Travailleurs</li>
                            <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <?php
            $validation = \Config\Services::validation();
            $session = \Config\Services::session();
           
                $attributes = array('role' => "form", 'class' => "form", 'data-parsley-validate' => "data-parsley-validate");
                echo form_open_multipart(base_url('worker/create/agent'), $attributes);
                ?>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('firstname')) {
                                echo 'is-invalid';
                            } ?>" name="firstname" id="firstname" placeholder="Ex:Ilunga" required
                                    value="<?= set_value('firstname') ?>" autofocus />
                                <label for="firstname" class="control-label">
                                    <span class="text-danger">*</span>Nom du travailleur

                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'firstname'); ?>
                                </span>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('lastname')) {
                                echo 'is-invalid';
                            } ?>" name="lastname" id="lastname" placeholder="Ex: Peter" required
                                    value="<?=  set_value('lastname') ?>" />
                                <label for="lastname" class="control-label">
                                    <span class="text-danger">*</span>Postnom du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'lastname'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('surname')) {
                                echo 'is-invalid';
                            } ?>" name="surname" id="surname" placeholder="Ex: Peter" required
                                    value="<?=  set_value('surname') ?>" />
                                <label for="surname" class="control-label">
                                    <span class="text-danger">*</span>Prénom du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'surname'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="gender" name="gender" class="form-control form-select <?php if ($validation->hasError('gender')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $gender_status = getGenders();
                                            foreach ($gender_status as $keygender => $gendervalue): ?>
                                    <option value="<?= esc($keygender); ?>"
                                        <?= set_select('gender', esc($keygender)); ?>>
                                        <?= ucwords(esc($gendervalue)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="gender" class="control-label">
                                    <span class="text-danger">*</span>Sexe du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'gender'); ?>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('agent_phone')) {
                                echo 'is-invalid';
                            } ?>" name="agent_phone" id="agent_phone" placeholder="Ex:+243858533285" required
                                    value="<?= set_value('agent_phone') ?>" />
                                <label for="agent_phone" class="control-label">
                                    <span class="text-danger">*</span>Numéro de contact
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'agent_phone'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="email" class="form-control <?php if ($validation->hasError('agent_email')) {
                                echo 'is-invalid';
                            } ?>" name="agent_email" id="agent_email" placeholder="Ex:ilunga@ditotase.com" required
                                    value="<?= set_value('agent_email') ?>" />
                                <label for="agent_email" class="control-label">
                                    <span class="text-danger"></span>E-mail du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'agent_email'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control " name="title" id="title"
                                    placeholder="Ex: Developpeur Web" value="<?= set_value('title') ?>" />
                                <label for="title" class="control-label">
                                    <span class="text-danger"></span>
                                    Profession / Specialité
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'title'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control <?php if ($validation->hasError('partner_name')) {
                                echo 'is-invalid';
                            } ?>" name="partner_name" id="partner_name" placeholder="Ex:Sarah KABIKA"
                                    value="<?= set_value('partner_name') ?>" />
                                <label for="partner_name" class="control-label">
                                    <span class="text-danger"></span>Nom du partenaire(Conjoint ou Conjointe)
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'partner_name'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="number" min="0" class="form-control <?php if ($validation->hasError('children_number')) {
                                echo 'is-invalid';
                            } ?>" name="children_number" id="children_number" placeholder="Ex: 1"
                                    value="<?= set_value('children_number') ?>" />
                                <label for="children_number" class="control-label">
                                    <span class="text-danger"></span>Nombre d'enfants
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'children_number'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="number" min="0" class="form-control <?php if ($validation->hasError('person_support_number')) {
                                echo 'is-invalid';
                            } ?>" name="person_support_number" id="person_support_number" placeholder="Ex: 1"
                                    value="<?= set_value('person_support_number') ?>" />
                                <label for="person_support_number" class="control-label">
                                    <span class="text-danger"></span>Nombre des personnes à charge
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'person_support_number'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('social_number')) {
                                echo 'is-invalid';
                            } ?>" name="social_number" id="social_number" placeholder="Ex:18082024"
                                    value="<?= set_value('social_number') ?>" />
                                <label for="social_number" class="control-label">
                                    <span class="text-danger"></span>Numéro de sécurité sociale
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'social_number'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="place_birthday" class="form-control <?php if ($validation->hasError('place_birthday')) {
                                echo 'is-invalid';
                            } ?>" id="place_birthday" placeholder="Ex:2024"
                                    value="<?= set_value('place_birthday'); ?>" />

                                <label for="place_birthday" class="control-label">
                                    <span class="text-danger"></span>Lieu de naissance
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'place_birthday'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="date" name="date_birthday" class="form-control <?php if ($validation->hasError('date_birthday')) {
                                echo 'is-invalid';
                            } ?>" id="date_birthday" placeholder="Ex:12/12/2000"
                                    value="<?= set_value('date_birthday'); ?>" />

                                <label for="date_birthday" class="control-label">
                                    <span class="text-danger"></span>Date de naissance
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'date_birthday'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="marital_status" name="marital_status" class="form-control form-select <?php if ($validation->hasError('marital_status')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $civility_status = getMaritalStatus();
                                            foreach ($civility_status as $keycivility => $value): ?>
                                    <option value="<?= esc($keycivility); ?>"
                                        <?= set_select('marital_status', esc($keycivility)); ?>>
                                        <?= ucwords(esc($value)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="marital_status" class="control-label">
                                    <span class="text-danger">*</span>Etat civil du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'marital_status'); ?>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="agent_type" name="agent_type" class="form-control form-select <?php if ($validation->hasError('agent_type')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <!-- <option selected="selected" disabled>-- Sélectionnez --</option> -->
                                    <?php
                                    $worker_types = getWorkerTypes();
                                    foreach ($worker_types as $worker_type => $workervalue): ?>
                                    <option value="<?= esc($worker_type); ?>"
                                        <?= set_select('agent_type', esc($worker_type)); ?>>
                                        <?= ucwords(esc($workervalue)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="agent_type" class="control-label">
                                    <span class="text-danger">*</span>Type de travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'agent_type'); ?>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="city" class="form-control" id="city" placeholder="Ex:RDC"
                                    required value="<?= set_value('city'); ?>" />

                                <label for="city" class="control-label">
                                    <span class="text-danger">*</span>Ville du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'city'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="region" class="form-control <?php if ($validation->hasError('region')) {
                                echo 'is-invalid';
                            } ?>" id="region" placeholder="Ex:Haut-Katanga" required
                                    value="<?= set_value('region'); ?>" />

                                <label for="region" class="control-label">
                                    <span class="text-danger">*</span>Province du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'region'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control " name="address" id="address"
                                    placeholder="Ex: 43 Avenue Mwepu, Lubumbashi" value="<?= set_value('address') ?>" />
                                <label for="address" class="control-label">
                                    <span class="text-danger">*</span>
                                    Adresse du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'address'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="form-floating">
                                <select id="language" name="language"
                                    class="select2 form-control form-select <?php if ($validation->hasError('language')) {echo 'is-invalid';} ?>"
                                    required>
                                    <option disabled selected>-- Sélectionnez --</option>
                                    <?php $languages = getLanguages();
                                    foreach ($languages as $keylang => $langvalue): ?>
                                    <option value="<?= esc($keylang); ?>" <?= set_select('language', esc($keylang)); ?>>
                                        <?= ucwords(esc($langvalue)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="language" class="control-label">
                                    <span class="text-danger">*</span>Langue principale parlée</label>

                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'language'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">

                            <div class="form-floating">
                                <select id="country" name="country"
                                    class="select2 form-control form-select <?php if ($validation->hasError('country')) {echo 'is-invalid'; } ?>"
                                    required>

                                    <option disabled selected>-- Sélectionnez --</option>
                                    <?php
                                            $countries = countries();
                                            foreach ($countries as $key => $value): ?>
                                    <option value="<?= esc($key); ?>" <?= set_select('country', esc($key)); ?>>
                                        <?= ucwords(esc($value)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="country" class="control-label">
                                    <span class="text-danger">*</span>Nationalité du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'country'); ?>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="notes" class="form-control <?php if ($validation->hasError('notes')) {
                                echo 'is-invalid';
                            } ?>" id="notes" placeholder="Ex:because we believe" value="<?= set_value('notes'); ?>" />

                                <label for="notes" class="control-label">
                                    <span class="text-danger"></span>A propos du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'notes'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-right float-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i>
                            Valider la fiche du travailleur
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>