<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <h5 class="font-weight-bold text-uppercase">
                                Configuration fiche de présentation d'un nouvel établissement
                            </h5>
                        </div>
                     
                            <div class="card-header">
                                <div class="card-title">
                                    <a href="<?= base_url('admincustomer/schools') ?>" class="btn btn-info btn-sm text-uppercase">
                                    <i class="fas fa-reply fa-lg"></i>
                                    </a>
                                </div>
                                <div class="card-tools float-right">
                                <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?= base_url('admincustomer/dashboad') ?>" class="">Accueil</a>
                                        </li>
                                        <li class="breadcrumb-item active">Etablissements</li>
                                        <li class="breadcrumb-item active">Nouvel établissement</li>
                                    </ol>
                                </div>
                            </div>
                        
                        <div class="card-body bg-light">
                        <?php
                        $validation = \Config\Services::validation();
                        //form attributes
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('admincustomer/registerschool'), $attributes);
                        ?>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        
                                        <input type="text"
                                               class="form-control text-capitalize <?php if ($validation->hasError('fullname')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="fullname" id="fullname" placeholder="Ex: Complexe Scolaire Ditotase"
                                               value="<?= set_value('fullname') ?>" autofocus
                                             />
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
                                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                                    <div class="form-floating">
                                      
                                        <input type="text"
                                               class="form-control <?php if ($validation->hasError('shortname')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="shortname"
                                               id="shortname" placeholder="Ex: C.S.Ditotase SCHOOL"
                                               value="<?= set_value('shortname') ?>"/>
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
                                        <select id="school_type" name="school_type"
                                                class="form-control text-capitalize <?php if ($validation->hasError('school_type')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                            <option selected="selected" disabled>-- Sélectionnez --</option>
                                            <?php
                                            $typesecoles = setSchoolTypes();
                                                foreach ($typesecoles as $key => $value): ?>
                                                    <option value="<?= esc($key); ?>" <?= set_select('school_type', esc($key)); ?>>
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
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        
                                        <input type="text"
                                               class="form-control <?php if ($validation->hasError('school_phone')) {
                                                   echo 'is-invalid';
                                               } ?>"
                                               name="school_phone"
                                               id="school_phone" placeholder="Ex:+243858533285"
                                               value="<?= set_value('school_phone') ?>"/>
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
                                        
                                        <input type="email"
                                               class="form-control "
                                               name="school_email"
                                               id="school_email" placeholder="Ex:contact@ditotase.com"
                                               value="<?= set_value('school_email') ?>"/>
                                               <label for="school_email" class="control-label">
                                            <span class="text-danger"></span>E-mail de l'établissement
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="address" class="form-control" 
                                        id="address" placeholder="Ex:10 Lumumba, Lubumbashi, RDC" 
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
                                        
                                        <input type="text"
                                               class="form-control "
                                               name="school_decree"
                                               id="school_decree" placeholder="Ex:MIN/EPSP/0025/005"
                                               value="<?= set_value('school_decree') ?>"/>
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
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text"
                                               class="form-control text-capitalize"
                                               name="school_manager"
                                               id="school_manager" placeholder="Ex:Gestionnaire ou Entreprise"
                                               value="<?= set_value('school_manager') ?>"/>
                                               <label for="school_manager" class="control-label">
                                            <span class="text-danger"></span>Nom du gestionnaire de l'établissement
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <textarea name="notes" id="notes" class="form-control" 
                                        placeholder="Plus de détails sur l'établissement"><?= set_value('notes'); ?></textarea>
                                        
                                        <label for="notes" class="control-label">
                                            <span class="text-danger"></span>A propos de l'établissement(Décrivez le fonctionnement de votre structure)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-info btn-lg text-uppercase">
                                    Valider la fiche
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
