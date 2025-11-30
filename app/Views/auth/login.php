<div class="container mt-5">
    <p class="font-weight-bold text-center lined lined-center p-3">
        <a href="<?= base_url(); ?>" class="h3 font-weight-bold mb-3">
            Connexion à votre compte
        </a>
        <br>
        Connectez-vous en toute sécurité à votre compte utilisateur de votre espace scolaire en indiquant vos
        identifiants.
    </p>
    <?php
    
    //echo $server = $_SERVER['HTTP_REFERER'];
    $validation = \Config\Services::validation();
    $attributes = array('id' => 'form-login', 'autocomplete' => 'off');
    echo form_open(base_url('login'), $attributes);
    ?>

    <div class="gy-5">

        <input type="text" name="<?= setReferenceCode(); ?>" value="<?= setReferenceCode(); ?>" id="username-fake"
            style="display:none;">
        <input type="password" name="<?= setReferenceCode(); ?>" value="<?= setReferenceCode(); ?>" id="password-fake"
            style="display:none;">

        <div class="form-group">
            <div class="form-floating mb-3 input-group">
                <span class="input-group-text bg-transparent border-right-0 left-radius" id="login_name">
                    <i class="fas fa-user-circle"></i>
                </span>
                <input type="text"
                    class="form-control bg-transparent font-weight-bold right-radius border-left-0 <?= ($validation->hasError('username')) ? 'border-danger is-invalid' : '' ?>"
                    placeholder="Ex: trecaz@ditotase.com" aria-describedby="login_name" id="login_name" name="username"
                    value="<?= set_value('username'); ?>" autofocus autocomplete="off" />
                <label for="login_name" class="control-label text-dark font-weight-bold">
                    Votre Identifiant(E-mail /Téléphone /Pseudo)
                </label>

            </div>
            <span class="text-danger"><?= displayFormError($validation, 'username'); ?></span>
        </div>

        <div class="form-group">
            <div class="form-floating mb-3 input-group">
                <span class="input-group-text bg-transparent border-right-0 left-radius">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password"
                    class="font-weight-bold password form-control border-right-0 border-left-0 <?= ($validation->hasError('password')) ? 'border-danger is-invalid' : '' ?>"
                    id="login_key" placeholder="Ex: xxxxxxxxxxx" name="password" value="<?= set_value('password'); ?>"
                    autocomplete="new-password" />

                <div class="input-group-text bg-transparent right-radius border-left-0" id="inputGroupPrepend">
                    <button title="Afficher Password" onclick="showPass();" type="button"
                        class="btn btn-default bg-transparent" style="border:none!important;">
                        <i id="eyepass" class="fas fa-eye"></i>
                    </button>
                </div>
                <label for="login_key" class="control-label text-dark font-weight-bold">
                    Votre mot de passe
                </label>

            </div>
            <span class="text-danger"><?= displayFormError($validation, 'password'); ?></span>
        </div>

        <div class="row text-center">
            <div class="col-sm-6 col-lg-6">
                <a href="<?= base_url('password/forget'); ?>"
                    class="btn btn-outline-danger btn-lg py-3 left-radius right-radius">
                    Mot de passe oublié ?
                </a>
            </div>
            <div class="col-sm-6 col-lg-6">
                <button title="Connexion" class="btn btn-primary btn-lg py-3 left-radius right-radius" type="submit">
                    <i class="fas fa-check-circle"></i> Accéder au système
                </button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>