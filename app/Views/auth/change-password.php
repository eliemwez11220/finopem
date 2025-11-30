<div class="container">
    <div class="text-center">
        
                <?php $pic_profile = (session()->avataruser) ? 'public/uploads/images/' . session()->avataruser : 'punblic/img/avatar.jpeg'; ?>
                <img src="<?= base_url($pic_profile); ?>" alt="..." class="avatar avatar-lg" />

            
                <h2 class="text-uppercase font-weight-bold text-center">
                    <?= session()->nameuser; ?>
                </h2>
           
    </div>
    <div class="text-center">
        <p class="font-weight-bold lined lined-center p-3">
            <span class="h3 font-weight-bold text-primary">
                Changement du mot de passe
            </span>
            <br>
            Cher utilisateur, veuillez mettre à jour votre mot de passe pour renforcer la sécurité de votre compte
            Ditotase Magschool.
        </p>
    </div>
    <div class="py-3">

        <?php
        $validation = \Config\Services::validation();
        $attributes = array('role' => 'form', 'autocomplete' => 'off');
        echo form_open(base_url('changeDefaultPassword'), $attributes);
        ?>
        <input type="text" name="username" id="username-fake" style="display:none;">
        <input type="password" name="password-fake" id="password-fake" style="display:none;">

        <div class="form-group">
            <label for="pass" class="form-label text-uppercase font-weight-bold">
            <span class="text-danger">*</span>Créez un nouveau mot de passe</label>
            <div class="input-group shadow-lg">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-lock text-primary"></i>
                    </span>
                </div>
                <input type="password"
                    class="font-weight-bold password py-4 form-control form-control-lg border-left-0 <?= ($validation->hasError('pass')) ? ' is-invalid' : '' ?>"
                    id="pass" placeholder="Ex: XXXXXXX" name="pass" autofocus value="<?= set_value('password'); ?>">
            </div>
            <div id="floatingInputPass" class="form-text">
                <span class="text-danger"><?= displayFormError($validation, 'pass'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="cpass" class="form-label text-uppercase font-weight-bold">
            <span class="text-danger">*</span>Confirmer le mot de passe créé</label>
            <div class="input-group shadow-lg">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-key text-primary"></i>
                    </span>
                </div>
                <input type="password"
                    class="font-weight-bold password py-4 form-control form-control-lg border-left-0 <?= ($validation->hasError('cpass')) ? ' is-invalid' : '' ?>"
                    id="cpass" placeholder="Ex: XXXXXXX" name="cpass" value="<?= set_value('password'); ?>">
            </div>
            <div id="floatingInputPass" class="form-text">
                <span class="text-danger"><?= displayFormError($validation, 'cpass'); ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col text-start float-left ml-1">
                <div class="form-check mt-3">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" onclick="showPass();">
                        <span id="passmsg" class="fw-bold">Afficher le mot de passe</span> <i id="eyepass"
                            class="fas fa-eye-slash"></i>
                    </label>
                </div>
            </div>
            <div class="col text-right text-end float-right">

                <button class="btn btnrounded btn-primary btn-lg py-3" type="submit">
                <i class="fas fa-check-circle"></i> Valider le mot de passe
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>