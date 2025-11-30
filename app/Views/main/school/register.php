<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <h5 class="font-weight-bold text-uppercase">
                                Configuration de la fiche de présentation de l'établissement
                            </h5>
                        </div>
                        <?php  if(session()->schoolid): ?>
                        <div class="card-header">
                            <div class="card-title">
                                <a href="<?= base_url('overview') ?>" class="btn btn-info btn-sm text-uppercase">
                                    <i class="fas fa-reply fa-lg"></i>
                                </a>
                            </div>
                            <div class="card-tools float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('overview') ?>" class="">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active">Nouvel établissement</li>
                                </ol>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="card-body bg-light">
                            <?php
                        $validation = \Config\Services::validation();
                        //form attributes
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('register'), $attributes);
                        ?>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('fullname')) {
                                                   echo 'is-invalid';
                                               } ?>" name="fullname" id="fullname"
                                            placeholder="Ex: Ditotase University"
                                            value="<?= set_value('fullname') ?>" autofocus />
                                        <label for="fullname" class="control-label">
                                            <span class="text-danger">*</span>Nom complet de l'établissement

                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback text-danger">
                                            <?= display_validation_error($validation, 'fullname'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?php if ($validation->hasError('init_identify')) {
                                                   echo 'is-invalid';
                                               } ?>" name="init_identify" id="init_identify" placeholder="Ex: CSD"
                                            value="<?= set_value('init_identify') ?>" />
                                        <label for="init_identify" class="control-label">
                                            <span class="text-danger"></span>Initial d'immatriculation de
                                            l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'init_identify'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?php if ($validation->hasError('shortname')) {
                                                   echo 'is-invalid';
                                               } ?>" name="shortname" id="shortname"
                                            placeholder="Ex: Ditotase University"
                                            value="<?= set_value('shortname') ?>" />
                                        <label for="shortname" class="control-label">
                                            <span class="text-danger">*</span>Acronyme ou Sigle de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'shortname'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <select id="school_type" name="school_type" class="form-control text-capitalize <?php if ($validation->hasError('school_type')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <?php
                                            $typesecoles = setSchoolTypes();
                                                foreach ($typesecoles as $key => $value): ?>
                                            <option value="<?= esc($key); ?>"
                                                <?= set_select('school_type', esc($key)); ?>>
                                                <?= ucfirst(esc($value)); ?>
                                                <?php endforeach; ?>
                                        </select>
                                        <label for="school_type" class="control-label">
                                            <span class="text-danger">*</span>Régime de gestion de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'school_type'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <select id="school_category" name="school_category" class="form-control  text-capitalize <?php if ($validation->hasError('school_category')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <?php
                                            $categories = setSchoolCategory();
                                                foreach ($categories as $key => $value): ?>
                                            <option value="<?= esc($key); ?>"
                                                <?= set_select('school_category', esc($key)); ?>>
                                                <?= ucfirst(esc($value)); ?>
                                                <?php endforeach; ?>
                                        </select>
                                        <label for="school_category" class="control-label">
                                            <span class="text-danger">*</span>Catégorie d'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'school_category'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?php if ($validation->hasError('school_phone')) {
                                                   echo 'is-invalid';
                                               } ?>" name="school_phone" id="school_phone"
                                            placeholder="Ex:+243858533285" value="<?= set_value('school_phone') ?>" />
                                        <label for="school_phone" class="control-label">
                                            <span class="text-danger">*</span>Numéro de contact de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'school_phone'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="email" class="form-control " name="school_email" id="school_email"
                                            placeholder="Ex:+243858533285" value="<?= set_value('school_email') ?>" />
                                        <label for="school_email" class="control-label">
                                            <span class="text-danger"></span>E-mail de l'établissement
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Ex:10 Lumumba, Lubumbashi, RDC"
                                            value="<?= set_value('address'); ?>" />
                                        <label for="address" class="control-label">
                                            <span class="text-danger">*</span>Adresse de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'address'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control " name="school_decree" id="school_decree"
                                            placeholder="Ex:MIN/EPSP/0025/005"
                                            value="<?= set_value('school_decree') ?>" />
                                        <label for="school_decree" class="control-label">
                                            <span class="text-danger"></span>Arrete ministeriel de l'établissement
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="school_antenna_code" class="form-control" id="school_antenna_code"
                                            placeholder="EX: 7110"
                                            value="<?= set_value('school_antenna_code'); ?>" />

                                        <label for="school_antenna_code" class="control-label">
                                            <span class="text-danger"></span>Code Antenne de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'school_antenna_code'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="school_code" class="form-control" id="school_code"
                                            placeholder="EX: 7-7110-25120-024"
                                            value="<?= set_value('school_code'); ?>" />

                                        <label for="school_code" class="control-label">
                                            <span class="text-danger"></span>Code d'identification de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'school_code'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <textarea name="notes" id="notes" class="form-control"
                                            placeholder="Plus de détails sur l'établissement"><?= set_value('notes'); ?></textarea>

                                        <label for="notes" class="control-label">
                                            <span class="text-danger"></span>A propos de l'établissement(Décrivez le
                                            fonctionnement de votre structure)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="text-center alert alert-info font-weight-bold">
                                        <h3>Informations sur le responsable de l'établissement</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control text-capitalize" name="school_manager"
                                            id="school_manager" placeholder="Ex:Gestionnaire ou Entreprise"
                                            value="<?= set_value('school_manager') ?>" />
                                        <label for="school_manager" class="control-label">
                                            <span class="text-danger">*</span>Nom du responsable
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?php if ($validation->hasError('manager_phone')) {
                                                   echo 'is-invalid';
                                               } ?>" name="manager_phone" id="manager_phone"
                                            placeholder="Ex:+243858533285" value="<?= set_value('manager_phone') ?>" />
                                        <label for="manager_phone" class="control-label">
                                            <span class="text-danger">*</span>Numéro de contact du responsable
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'manager_phone'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="email" class="form-control " name="manager_email"
                                            id="manager_email" placeholder="Ex:name@domain.com"
                                            value="<?= set_value('manager_email') ?>" />
                                        <label for="manager_email" class="control-label">
                                            <span class="text-danger"></span>E-mail du responsable
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control " name="school_city" id="school_city"
                                            placeholder="Ex:Lubumbashi" value="<?= set_value('school_city') ?>" />
                                        <label for="school_city" class="control-label">
                                            <span class="text-danger"></span>Ville du responsable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-primary">
                                <div class="text-center">
                                    <h1 class="text-uppercase fw-bold">Configuration compte administrateur</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="password"
                                            class="form-control password <?= ($validation->hasError('pass')) ? ' is-invalid' : '' ?>"
                                            id="pass" placeholder="Ex: XXLOLL29303JF" name="pass"
                                            value="<?= set_value('pass'); ?>"
                                            aria-describedby="floatingInputHelpPass" />
                                        <label for="pass"><span class="text-danger">*</span>Créez un mot de passe
                                            utilisateur
                                        </label>
                                        <div id="floatingInputHelpPass" class="form-text">
                                            <span
                                                class="text-danger"><?= displayFormError($validation, 'pass'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="password"
                                            class="form-control password <?= ($validation->hasError('cpass')) ? ' is-invalid' : '' ?>"
                                            id="cpass" placeholder="Ex: XXLOLL29303JF" name="cpass"
                                            value="<?= set_value('cpass'); ?>"
                                            aria-describedby="floatingInputHelpcPass" />
                                        <label for="cpass"><span class="text-danger">*</span>Confirmer le mot de passe
                                            crée

                                        </label>
                                        <div id="floatingInputHelpcPass" class="form-text">
                                            <span
                                                class="text-danger"><?= displayFormError($validation, 'cpass'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-12">
                                    <div class="input-group-append">
                                        <div class="input-group-text bg-transparent right-radius"
                                            id="inputGroupPrepend">
                                            <button title="Afficher Password" onclick="showPass();" type="button"
                                                class="btn btn-default bg-transparent" style="border:none!important;">
                                                <i id="eyepass" class="fas fa-eye text-dark"></i> Afficher le mot de
                                                passe
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-info btn-lg text-uppercase">
                                    Valider fiche établissement
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div>