<div class="content-wrapper mb-3">
    <div class="container content-header">


        <?php if (isset($user) && (!empty($user))): ?>
        <div class="basic-choices">
            <!--//app-card-header-->
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="app-card-header p-3 border-bottom-0 mt-5">
                    
                        <div class="row align-items-center gx-3 mt-5">
                            <div class="col-auto">
                                <div class="">
                                    <img src="<?= base_url('public/uploads/images/' . $user['user_avatar']); ?>"
                                        alt="IMG" class="avatar avatar-lg" />
                                </div>
                                <!--//icon-holder-->
                            </div>
                            <!--//col-->
                            <div class="col-auto">
                                <h3 class="app-card-title text-uppercase fw-bold"><?= ($user['user_name']); ?></h3>
                                <h5 class="app-card-title text-muted">Dernier changement : <span
                                        class="text-end"><?= $user['user_updated_at']; ?></span></h5>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                        <div class="row align-items-center gx-3 mt-5">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm" 
                                href="<?= base_url('profile/page/profile'); ?>">
                                    <i class="fas fa-chevron-left"></i> Retour au profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header text-center bg-info">
                            <h1 class="fw-bold py-5">Changement du mot de passe</h1>
                        </div>
                        <div class="card-body">
                            <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(base_url('profileChangePassword/' . $user['user_id']), $attributes);
                                ?>
                            <div class="card-body">
                            <input type="text" name="username-fake" id="username-fake" style="display:none;">
                            <input type="password" name="password-fake" id="password-fake" style="display:none;">
        
                                <div class="row">

                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-floating mb-2">
                                            <input type="password"
                                                class="password form-control <?= ($validation->hasError('oldpass')) ? ' is-invalid' : '' ?>"
                                                id="oldpass" placeholder="Votre ancien mot de passe" name="oldpass"
                                                value="<?= set_value('oldpass'); ?>" autofocus
                                                autocomplete="off" />
                                            <label for="oldpass">
                                            <span class="text-danger">*</span>Saisissez votre mot de passe actuel</label>
                                            <div id="oldpass" class="form-text">
                                                <span
                                                    class="text-danger"><?= displayFormError($validation, 'oldpass'); ?></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-floating mb-2">
                                            <input type="password"
                                                class="password form-control <?= ($validation->hasError('pass')) ? ' is-invalid' : '' ?>"
                                                id="pass" placeholder="Ex: XXLOLL29303JF" name="pass"
                                                value="<?= set_value('pass'); ?>"
                                                aria-describedby="floatingInputHelpPass" />
                                            <label for="pass">
                                            <span class="text-danger">*</span>Créez un nouveau mot de passe</label>
                                            <div id="floatingInputHelpPass" class="form-text">
                                                <span
                                                    class="text-danger"><?= displayFormError($validation, 'pass'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group">
                                            <div class="form-floating mb-3">
                                                <input type="password"
                                                        class="password form-control <?= ($validation->hasError('cpass')) ? ' is-invalid' : '' ?>"
                                                        id="cpass" placeholder="Ex: XXLOLL29303JF" name="cpass"
                                                        value="<?= set_value('cpass'); ?>"
                                                        aria-describedby="floatingInputHelpcPass" />
                                                
                                                <label for="cpass">
                                                    <span class="text-danger">*</span>Confirmer le nouveau mot de passe créé
                                                </label>
                                                <div id="floatingInputHelpcPass" class="form-text">
                                                    <span class="text-danger">
                                                        <?= displayFormError($validation, 'cpass'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <div class="form-floating mb-3 input-group">
                                                <div class="input-group-text bg-transparent" id="inputGroupPrepend">
                                                    <button title="Afficher Password" onclick="showPass();" type="button"
                                                        class="btn btn-default bg-transparent" style="border:none!important;">
                                                        <i id="eyepass" class="fas fa-eye"></i> Afficher le mot de passe
                                                    </button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-8">
                                        <div class="text-right">
                                            <button class="btn  btn-info btn-lg rounded-2 btnrounded" type="submit">
                                                <i class="fas fa-check-circle"></i> Valider le changement
                                            </button>
                                        </div>
                                    </div>
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