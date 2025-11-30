<div class="row">
    <div class="col-sm-12">
        <?php $user_data = session()->get('studenttoken'); ?>
        <div class="py-2 bg-primary text-center text-white">
            <div class="p-3">
                <h5 class="font-weight-bold text-uppercase text-danger">
                    <?= (session()->has('studentfname')) ? session()->get('studentfname'): ''; ?>
                    <?= (session()->has('studentlname')) ? session()->get('studentlname'): ''; ?>
                    -
                    ID:<?= (session()->has('studentcode')) ? session()->get('studentcode'): ''; ?>
                </h5>
                <h5 class="font-weight-bold text-uppercase">
                    Création compte utilisateur
                </h5>
                <p>
                    Remplissez le formulaire ci-dessous pour créer un compte utilisateur. Assurez-vous de fournir des
                    informations précises et à jour.
                </p>
            </div>
        </div>
        <div class="p-3">
            <?php
                        $validation = \Config\Services::validation();
                        //form attributes
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('signupGettingStarted'), $attributes);
                        ?>
            <input type="hidden" id="user_type" name="user_type" value="student" />
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php if ($validation->hasError('user_phone')) { echo 'is-invalid';
                                               } ?>" name="user_phone" id="user_phone" placeholder="Ex:+243858533285"
                            value="<?= (session()->set('studentphone')) ? session()->get('studentphone'):set_value('user_phone') ?>"
                            autofocus />
                        <label for="user_phone" class="control-label">
                            <span class="text-danger">*</span>Numéro WhatsApp ou Téléphone
                        </label>
                        <?php if (isset($validation)): ?>
                        <span class="invalid-feedback">
                            <?= display_validation_error($validation, 'user_phone'); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                    <div class="form-floating">

                        <input type="email" class="form-control " name="user_email" id="user_email"
                            placeholder="Ex:+243858533285"
                            value="<?= (session()->set('studentmail')) ? session()->get('studentmail'):  set_value('user_email') ?>" />
                        <label for="user_email" class="control-label">
                            <span class="text-danger"></span>Votre E-mail
                        </label>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                    <div class="form-floating">
                        <textarea name="notes" id="notes" class="form-control" maxlength="500" rows="3"
                            placeholder="Plus de détails sur vous"><?= set_value('notes'); ?></textarea>

                        <label for="notes" class="control-label">
                            <span class="text-danger"></span>A propos (Décrivez votre profil)
                        </label>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                    <div class="form-floating mb-2">
                        <input type="password"
                            class="form-control password <?= ($validation->hasError('pass')) ? ' is-invalid' : '' ?>"
                            id="pass" placeholder="Ex: XXLOLL29303JF" name="pass" value="<?= set_value('pass'); ?>"
                            aria-describedby="floatingInputHelpPass" />
                        <label for="pass" class="control-label">
                            <span class="text-danger">*</span>Créez un mot de passe utilisateur
                        </label>
                        <div id="floatingInputHelpPass" class="form-text">
                            <span class="text-danger"><?= displayFormError($validation, 'pass'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                    <div class="form-floating mb-2">
                        <input type="password"
                            class="form-control password <?= ($validation->hasError('cpass')) ? ' is-invalid' : '' ?>"
                            id="cpass" placeholder="Ex: XXLOLL29303JF" name="cpass" value="<?= set_value('cpass'); ?>"
                            aria-describedby="floatingInputHelpcPass" />
                        <label for="cpass" class="control-label">
                            <span class="text-danger">*</span>Confirmer le mot de passe crée

                        </label>
                        <div id="floatingInputHelpcPass" class="form-text">
                            <span class="text-danger"><?= displayFormError($validation, 'cpass'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                    <div class="input-group-append">
                        <div class="input-group-text bg-transparent right-radius" id="inputGroupPrepend">
                            <button title="Afficher Password" onclick="showPass();" type="button"
                                class="btn btn-default bg-transparent btn-block" style="border:none!important;">
                                <i id="eyepass" class="fas fa-eye text-dark"></i> Afficher le mot de passe
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg text-uppercase py-3">
                            <i class="fas fa-check-circle"></i> Créer compte utilisateur
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div><!-- /.card-body -->
    </div><!-- /.col -->
</div><!-- /.col -->