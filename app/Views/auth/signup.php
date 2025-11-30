<div class="row">
    <div class="col-sm-12">
        <div class="">
            <div class="text-center p-3">
                <p>
                    <a href="<?= base_url(); ?>" class="h3 font-weight-bold mb-3">
                        Création compte utilisateur
                    </a>
                    <br>
                    Veuillez remplir le formulaire ci-dessous pour créer votre compte
                    utilisateur. Assurez-vous d'utiliser un numéro matricule valide et de sélectionner la bonne
                    catégorie ainsi que votre établissement scolaire.
                </p>
                <p>

                    <i class="fas fa-info-circle"></i>
                    Vous avez déjà un compte utilisateur ?
                    <a href="<?= base_url('login'); ?>" class="btn btn-outline-primary">
                        Connectez-vous par ici
                    </a>

                </p>
            </div>
            <div class="p-3">
                <?php
                        $validation = \Config\Services::validation();
                        //form attributes
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('signupCheckCredentials'), $attributes);
                        ?>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select id="user_school" name="user_school" class="form-control text-capitalize <?php if ($validation->hasError('user_school')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                <option selected disabled>-- Sélectionnez --</option>
                                <?php if(isset($schools) && is_array($schools) && count($schools) > 0): 
                                                foreach ($schools as $schoolkey => $schoolvalue): ?>
                                <option value="<?= esc($schoolvalue['school_id']); ?>"
                                    <?= set_select('user_school', esc($schoolvalue['school_id'])); ?>>
                                    <?= strtoupper(esc($schoolvalue['school_fullname'])); ?>
                                    [<?= strtoupper(esc($schoolvalue['school_shortname'])); ?>]
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                            </select>

                            <label for="user_school" class="control-label font-weight-bold">
                                <span class="text-danger">*</span>Choisissez votre établissement
                            </label>
                            <?php if (isset($validation)): ?>
                            <span class="invalid-feedback">
                                <?= display_validation_error($validation, 'user_school'); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select id="user_category" name="user_category" class="form-control  text-capitalize <?php if ($validation->hasError('user_category')) {
                                                    echo 'is-invalid';
                                                } ?>" required>
                                <option disabled>-- Sélectionnez --</option>
                                <option value="student" selected>Elève</option>
                                <option value="parent">Parent</option>
                            </select>
                            <label for="user_category" class="control-label font-weight-bold">
                                <span class="text-danger">*</span>Catégorie
                            </label>
                            <?php if (isset($validation)): ?>
                            <span class="invalid-feedback">
                                <?= display_validation_error($validation, 'user_category'); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="text" class="form-control text-capitalize <?php if ($validation->hasError('user_code')) {
                                                   echo 'is-invalid';
                                               } ?>" name="user_code" id="user_code" placeholder="Ex: Ilunga"
                                value="<?= set_value('user_code') ?>" autofocus />
                            <label for="user_code" class="control-label font-weight-bold">
                                <span class="text-danger">*</span>Votre numéro matricule

                            </label>
                            <?php if (isset($validation)): ?>
                            <span class="invalid-feedback text-danger">
                                <?= display_validation_error($validation, 'user_code'); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg text-uppercase py-3">
                    <i class="fas fa-check-circle"></i> Vérifier compte utilisateur
                    </button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->