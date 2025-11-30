<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h1>
                        Détails dossier travailleur
                    </h1>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Travailleurs</li>
                            <li class="breadcrumb-item active" aria-current="page">Détails</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($worker) && (!empty($worker))): ?>
    <section class="content">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <h1 class="text-uppercase fw-bold text-primary py-3">
                            <?= $worker['agent_firstname'].' '.$worker['agent_lastname']; ?>

                            <span class="text-danger">
                                [<?= getWorkerTypes($worker['agent_type']); ?>]
                            </span>
                        </h1>
                        <div class="text-center mb-2">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#update_quickly">
                                <i class="bi bi-pencil"></i> Modifier rapide
                            </button>

                            <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                data-target="#change_picture" onclick="setOffcanvasContent('changePicture')">
                                <i class="fas fa-sync"></i> Changer la photo
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#update_full">
                                <i class="fas fa-sync"></i> Editer dossier complet
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 col-sm-12">
                                <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                                    <div class="app-card-header p-3 border-bottom-0 text-center">
                                        <div class="row text-center">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="text-center">
                                                    <img src="<?= base_url('uploadShowFile/' . $worker['agent_picture']); ?>"
                                                        alt="..." class="avatar avatar-big" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="app-card-body px-4 w-100">
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Nom</strong></div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_firstname']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Postnom</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_lastname']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Prénom</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_surname']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Numéro Matricule</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_code']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Sexe du travailleur</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_gender']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Email du travailleur</strong></div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary">
                                                        <?= $worker['agent_email']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Téléphone du travailleur</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="text-primary fw-bold">
                                                        <?= $worker['agent_phone']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Profession</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_title']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-12 col-md-6 col-sm-12">


                    <div class="row">
                        <div class="col-12 col-lg-12 col-sm-12">
                            <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">

                                <div class="app-card-body px-4 w-100">
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label"><strong>Numéro sécurité sociale</strong></div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_social_number']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Nombre d'enfants</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_childrens']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Nombre des personnes à
                                                        charge</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_family_number']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Etat civil</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= getMaritalStatus($worker['agent_civility_status']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Nom du partenaire</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_partner_name']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Langue principale</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_languages']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label"><strong>Lieu de naissance</strong></div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary">
                                                    <?= $worker['agent_place_birthday']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label"><strong>Date de naissance</strong></div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="text-primary fw-bold">
                                                    <?= date("d/m/Y", strtotime($worker['agent_date_birthday'])); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Statut du travailleur</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_status']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Ville du travailleur</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_city']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2">
                                                    <strong>Province du travailleur</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_region']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2">
                                                    <strong>Nationalité du travailleur</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= countries($worker['agent_country']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2">
                                                    <strong>Adresse du travailleur</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_address']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2">
                                                    <strong>Date de création</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_created_at']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2">
                                                    <strong>Date de modification</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_updated_at']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Apropos du travailleur</strong>
                                                </div>
                                            </div>
                                            <div class="col text-right float-right ">
                                                <span class="fw-bold text-primary text-uppercase">
                                                    <?= $worker['agent_about']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal modal-center" id="update_quickly">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white fw-bold">
                    <h5 class="modal-title fw-bold" id="offcanvasActionLabel">Modification de la fiche du travailleur
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="offcanvasContent">

                    <?php
                    $validation = \Config\Services::validation();
                    $session = \Config\Services::session();
                    ?>
                    <?php
                $attributes = array('role' => "form", 'class' => "form", 'data-parsley-validate' => "data-parsley-validate");
                echo form_open_multipart(base_url('worker/update/'.$worker['agent_uid']), $attributes);
                ?>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('firstname')) {
                                echo 'is-invalid';
                            } ?>" name="firstname" id="firstname" placeholder="Ex:Ilunga" required
                                    value="<?= ($worker['agent_firstname']) ? $worker['agent_firstname'] : set_value('firstname') ?>"
                                    autofocus />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('lastname')) {
                                echo 'is-invalid';
                            } ?>" name="lastname" id="lastname" placeholder="Ex: Peter" required
                                    value="<?= ($worker['agent_lastname']) ? $worker['agent_lastname'] : set_value('lastname') ?>" />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('surname')) {
                                echo 'is-invalid';
                            } ?>" name="surname" id="surname" placeholder="Ex: Peter" required
                                    value="<?= ($worker['agent_surname']) ? $worker['agent_surname'] : set_value('surname') ?>" />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('agent_phone')) {
                                echo 'is-invalid';
                            } ?>" name="agent_phone" id="agent_phone" placeholder="Ex:+243858533285" required
                                    value="<?= ($worker['agent_phone']) ? $worker['agent_phone'] : set_value('agent_phone') ?>" />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="email" class="form-control <?php if ($validation->hasError('agent_email')) {
                                echo 'is-invalid';
                            } ?>" name="agent_email" id="agent_email" placeholder="Ex:ilunga@ditotase.com" required
                                    value="<?= ($worker['agent_email']) ? $worker['agent_email'] : set_value('agent_email') ?>" />
                                <label for="agent_email" class="control-label">
                                    <span class="text-danger">*</span>E-mail du travailleur
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'agent_email'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="gender" name="gender" class="form-control form-select <?php if ($validation->hasError('gender')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $agent_gender_db = $worker['agent_gender'];
                                            $gender_status = getGenders();
                                            foreach ($gender_status as $keygender => $gendervalue): ?>
                                    <option value="<?= esc($keygender); ?>"
                                        <?= ($agent_gender_db == $keygender) ? 'selected': set_select('gender', esc($keygender)); ?>>
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control " name="title" id="title"
                                    placeholder="Ex: Developpeur Web"
                                    value="<?= ($worker['agent_title']) ? $worker['agent_title'] : set_value('title') ?>" />
                                <label for="title" class="control-label">
                                    <span class="text-danger">*</span>
                                    Profession / Specialité
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control " name="address" id="address"
                                    placeholder="Ex: 43 Avenue Mwepu, Lubumbashi"
                                    value="<?= ($worker['agent_address']) ? $worker['agent_address'] : set_value('address') ?>" />
                                <label for="address" class="control-label">
                                    <span class="text-danger">*</span>
                                    Adresse du travailleur
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="city" class="form-control" id="city" placeholder="Ex:RDC"
                                    required
                                    value="<?= ($worker['agent_city']) ? $worker['agent_city'] : set_value('city'); ?>" />

                                <label for="city" class="control-label">
                                    <span class="text-danger">*</span>Ville du travailleur
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="region" class="form-control <?php if ($validation->hasError('region')) {
                                echo 'is-invalid';
                            } ?>" id="region" placeholder="Ex:Haut-Katanga" required
                                    value="<?= ($worker['agent_region']) ? $worker['agent_region'] : set_value('notes'); ?>" />

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
                    </div>
                    <div class="text-right float-right ">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Appliquer les modifications</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-center" tabindex="-1" id="update_full" aria-labelledby="offcanvasActionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white fw-bold">
                    <h5 class="modal-title fw-bold" id="offcanvasActionLabel">Edition de la fiche du travailleur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="offcanvasContent">

                    <?php
                    $validation = \Config\Services::validation();
                    $session = \Config\Services::session();
                    ?>
                    <?php
                $attributes = array('role' => "form", 'class' => "form");
                echo form_open(base_url('worker/edit/'.$worker['agent_uid']), $attributes);
                ?>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="agent_type" name="agent_type" class="form-control form-select <?php if ($validation->hasError('agent_type')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <!-- <option selected="selected" disabled>-- Sélectionnez --</option> -->
                                    <?php
                                    $worker_type_db = $worker['agent_type'];
                                    $worker_types = getWorkerTypes();
                                    foreach ($worker_types as $worker_type => $workervalue): ?>
                                    <option value="<?= esc($worker_type); ?>"
                                        <?= ($worker_type_db == $worker_type) ? 'selected': set_select('agent_type', esc($worker_type)); ?>>
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('social_number')) {
                                echo 'is-invalid';
                            } ?>" name="social_number" id="social_number" placeholder="Ex:18082024"
                                    value="<?= ($worker['agent_social_number']) ? $worker['agent_social_number'] : set_value('tax_number') ?>" />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="number" min="0" class="form-control <?php if ($validation->hasError('children_number')) {
                                echo 'is-invalid';
                            } ?>" name="children_number" id="children_number" placeholder="Ex: 1"
                                    value="<?= ($worker['agent_childrens']) ? $worker['agent_childrens'] : set_value('children_number') ?>" />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="number" min="0" class="form-control <?php if ($validation->hasError('person_support_number')) {
                                echo 'is-invalid';
                            } ?>" name="person_support_number" id="person_support_number" placeholder="Ex: 1"
                                    value="<?= ($worker['agent_family_number']) ? $worker['agent_family_number'] : set_value('person_support_number') ?>" />
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('partner_name')) {
                                echo 'is-invalid';
                            } ?>" name="partner_name" id="partner_name" placeholder="Ex:Sarah KABIKA"
                                    value="<?= ($worker['agent_partner_name']) ? $worker['agent_partner_name'] : set_value('idnat_number') ?>" />
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

                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="place_birthday" class="form-control <?php if ($validation->hasError('place_birthday')) {
                                echo 'is-invalid';
                            } ?>" id="place_birthday" placeholder="Ex:2024"
                                    value="<?= ($worker['agent_place_birthday']) ? $worker['agent_place_birthday'] : set_value('place_birthday'); ?>" />

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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="date" name="date_birthday" class="form-control <?php if ($validation->hasError('date_birthday')) {
                                echo 'is-invalid';
                            } ?>" id="date_birthday" placeholder="Ex:12/12/2000"
                                    value="<?= ($worker['agent_date_birthday']) ? $worker['agent_date_birthday'] : set_value('date_birthday'); ?>" />

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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="language" name="language" class="form-control form-select <?php if ($validation->hasError('language')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $agent_language_db = $worker['agent_languages'];
                                            $languages = getLanguages();
                                            foreach ($languages as $keylang => $langvalue): ?>
                                    <option value="<?= esc($keylang); ?>"
                                        <?= ($agent_language_db == $keylang) ? 'selected': set_select('language', esc($keylang)); ?>>
                                        <?= ucwords(esc($langvalue)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="language" class="control-label">
                                    <span class="text-danger">*</span>Langue parlée
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= displayFormError($validation, 'language'); ?>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="country" name="country" class="form-control form-select <?php if ($validation->hasError('country')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $agent_country_db = $worker['agent_country'];
                                            $countries = countries();
                                            foreach ($countries as $key => $value): ?>
                                    <option value="<?= esc($key); ?>"
                                        <?= ($agent_country_db == $key) ? 'selected': set_select('country', esc($key)); ?>>
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
                                <select id="marital_status" name="marital_status" class="form-control form-select <?php if ($validation->hasError('marital_status')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $agent_civility_db = $worker['agent_civility_status'];
                                            $civility_status = getMaritalStatus();
                                            foreach ($civility_status as $keycivility => $value): ?>
                                    <option value="<?= esc($keycivility); ?>"
                                        <?= ($agent_civility_db == $keycivility) ? 'selected': set_select('marital_status', esc($keycivility)); ?>>
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
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="notes" class="form-control <?php if ($validation->hasError('notes')) {
                                echo 'is-invalid';
                            } ?>" id="notes" placeholder="Ex:because we believe"
                                    value="<?= ($worker['agent_about']) ? $worker['agent_about'] : set_value('notes'); ?>" />

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
                    <div class="text-right float-right ">
                        <button type="submit" class="btn btn-warning"><i class="bi bi-check-circle"></i> Valider les
                            modifications</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-center" tabindex="-1" id="change_picture" aria-labelledby="offcanvasActionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white fw-bold">
                    <h5 class="modal-title fw-bold" id="offcanvasActionLabel">Changement de la photo du travailleur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="offcanvasContent">

                    <?php
            $validation = \Config\Services::validation();
            $session = \Config\Services::session();
            ?>
                    <h5 class="text-center">Changer la photo du travailleur</h5>
                    <?php
                $attributes = array('role' => "form", 'class' => "form", 'data-parsley-validate' => "data-parsley-validate");
                echo form_open_multipart(base_url('worker/picture/'.$worker['agent_uid']), $attributes);
                ?>
                    <div class="form-floating mb-2">
                        <input type="file" class="form-control" id="picture" name="picture">
                        <label for="picture">Télécharger une nouvelle photo</label>
                    </div>
                    <div class="text-right float-right ">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Appliquer le
                            changement de la photo</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
    <div class="alert alert-danger">
        <strong>Erreur!</strong> Aucun dossier trouvé.
    </div>
    <?php endif;?>
</div>