<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <?php  if(isset($school) && (!empty($school))): ?>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <a href="<?= base_url('admincustomer/startedSession/'.$school['school_token']) ?>"
                            class="btn btn-info btn-sm text-uppercase">
                            <i class="fas fa-reply-all fa-lg"></i>
                        </a>
                    </div>
                    <div class="card-tools float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('profile') ?>" class="">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Vue d'ensemble</li>
                            <li class="breadcrumb-item active">Fiche Ecole</li>
                        </ol>
                    </div>
                </div>
                <div class="card-header bg-primary text-center py-3">
                    <h5 class="font-weight-bold text-uppercase">
                        Modification de la fiche de présentation de l'établissement
                    </h5>
                </div>
                <div class="card-body">
                    <?php
                        $validation = \Config\Services::validation();
                        //form attributes
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('admincustomer/editschool/'.$school['school_id']), $attributes);
                        ?>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('fullname')) {
                                                   echo 'is-invalid';
                                               } ?>" name="fullname" id="fullname"
                                    placeholder="Ex: Complexe Scolaire Ditotase"
                                    value="<?= ($school['school_fullname']) ? $school['school_fullname']: set_value('fullname') ?>"
                                    autofocus />
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

                                <input type="text" class="form-control <?php if ($validation->hasError('shortname')) {
                                                   echo 'is-invalid';
                                               } ?>" name="shortname" id="shortname"
                                    placeholder="Ex: C.S.Ditotase SCHOOL"
                                    value="<?= ($school['school_shortname']) ? $school['school_shortname']:set_value('shortname') ?>" />
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
                                        <?= ($school['school_type'] == $key) ? 'selected': set_select('school_type', esc($key)); ?>>
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

                                <select id="school_status" name="school_status" class="form-control text-capitalize <?php if ($validation->hasError('school_status')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                    <option selected="selected" disabled>-- Sélectionnez --</option>
                                    <?php
                                            $statusecoles = getStatusValues();
                                                foreach ($statusecoles as $keyst => $value): ?>
                                    <option value="<?= esc($keyst); ?>"
                                        <?= ($school['school_status'] == $keyst) ? 'selected':set_select('school_status', esc($key)); ?>>
                                        <?= ucfirst(esc($value)); ?>
                                        <?php endforeach; ?>
                                </select>
                                <label for="school_status" class="control-label">
                                    <span class="text-danger">*</span>Statut d'établissement
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'school_status'); ?>
                                </span>
                                <?php endif; ?>

                            </div>

                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('school_phone')) {
                                                   echo 'is-invalid';
                                               } ?>" name="school_phone" id="school_phone"
                                    placeholder="Ex:+243858533285"
                                    value="<?= ($school['school_phone']) ? $school['school_phone']:set_value('school_phone') ?>" />
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
                                    placeholder="Ex:+243858533285"
                                    value="<?= ($school['school_email']) ? $school['school_email']:set_value('school_email') ?>" />
                                <label for="school_email" class="control-label">
                                    <span class="text-danger"></span>E-mail de l'établissement
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control text-capitalize" name="school_manager"
                                    id="school_manager" placeholder="Ex:Rumbu Mike"
                                    value="<?= ($school['school_manager_name']) ? $school['school_manager_name']:set_value('school_manager') ?>" />
                                <label for="school_manager" class="control-label">
                                    <span class="text-danger"></span>Nom du Gestionnaire
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Ex:10 Lumumba, Lubumbashi, RDC"
                                    value="<?= ($school['school_address']) ? $school['school_address']:set_value('address'); ?>" />

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
                                <input type="text" name="register_number" class="form-control" id="register_number"
                                    placeholder="EX: CABMIN/EPSP/25120/024"
                                    value="<?= ($school['school_ministry_decree']) ? $school['school_ministry_decree']:set_value('register_number'); ?>" />

                                <label for="register_number" class="control-label">
                                    <span class="text-danger"></span>Arreté ministériel
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'register_number'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control <?php if ($validation->hasError('init_identify')) {
                                                   echo 'is-invalid';
                                               } ?>" name="init_identify" id="init_identify" minlength="3" maxlength="3"
                                            placeholder="Ex: CSD"
                                            value="<?= ($school['school_init_identify']) ? $school['school_init_identify']:set_value('init_identify') ?>" />
                                        <label for="init_identify" class="control-label">
                                            <span class="text-danger"></span>Initial d'immatriculation de l'établissement
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'init_identify'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="school_antenna_code" class="form-control" id="school_antenna_code"
                                            placeholder="EX: 7110"
                                            value="<?= ($school['school_antenna_code']) ? $school['school_antenna_code']:set_value('school_antenna_code'); ?>" />

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
                                            value="<?= ($school['school_code']) ? $school['school_code']:set_value('school_code'); ?>" />

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
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="school_slogan" class="form-control" id="school_slogan"
                                    placeholder="EX: ORA LABORA"
                                    value="<?= ($school['school_slogan']) ? $school['school_slogan']:set_value('school_slogan'); ?>" />

                                <label for="school_slogan" class="control-label">
                                    <span class="text-danger"></span>Slogan
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'school_slogan'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="school_website" class="form-control" id="school_website"
                                    placeholder="EX: http://ditotaseschool.com"
                                    value="<?= ($school['school_website']) ? $school['school_website']:set_value('school_website'); ?>" />

                                <label for="school_website" class="control-label">
                                    <span class="text-danger"></span>Website
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'school_website'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="city" class="form-control" id="city"
                                    placeholder="EX: Lubumbashi"
                                    value="<?= ($school['school_city']) ? $school['school_city']:set_value('city'); ?>" />

                                <label for="city" class="control-label">
                                    <span class="text-danger"></span>Ville
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'city'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="province" class="form-control" id="province"
                                    placeholder="EX: Katanga"
                                    value="<?= ($school['school_province']) ? $school['school_province']:set_value('province'); ?>" />

                                <label for="province" class="control-label">
                                    <span class="text-danger"></span>Province
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'province'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="country" class="form-control" id="country"
                                    placeholder="EX: RDC"
                                    value="<?= ($school['school_country']) ? $school['school_country']:set_value('country'); ?>" />

                                <label for="country" class="control-label">
                                    <span class="text-danger"></span>Pays
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'country'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <textarea name="notes" id="notes" class="form-control" row="10"
                                    placeholder="Plus de détails sur l'établissement"><?= ($school['school_notes']) ? $school['school_notes']:set_value('notes'); ?></textarea>

                                <label for="notes" class="control-label">
                                    <span class="text-danger"></span>A propos de l'établissement(Décrivez le
                                    fonctionnement de votre structure)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-info btn-lg text-uppercase">
                            Valider la création de la fiche école
                        </button>
                    </div>
                    <?php echo form_close(); ?>
                </div><!-- /.card-body -->

            </div><!-- /.card -->
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div>