<div class="auth-form-transparent card-radius card shadow-lg">
    <div class="text-center py-3">

        <p class="font-weight-bold lined lined-center p-3">
            <a href="<?= base_url(); ?>" class="h3 font-weight-bold">
                Confirmation de votre demande d'accès
            </a>
            <br>
            Un e-mail de réinitialisation du mot de passe de votre compte Ditotase Magschool vous a été envoyé.
            Accèder à votre boite mail pour confirmer la demande lancée. Vérifiez aussi vos spams !

        </p>
    </div>
    <?php
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'method' => 'GET');
                        echo form_open(base_url('root'), $attributes);
                        ?>
    <div class="py-3">
        <div class="form-group">
            <label for="username" class="form-label text-uppercase">Indiquer le code que vous avez reçu</label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-edit text-primary"></i>
                    </span>
                </div>
                <input type="text" name="access"
                    class="text-white fw-bold py-4 form-control form-control-lg border-left-0  <?= ($validation->hasError('token')) ? ' is-invalid border-dark' : '' ?>"
                    id="access" placeholder="Ex: 23738" autofocus>
            </div>
            <div id="floatingInputUsername" class="form-text">
                <span class="text-danger"><?= displayFormError($validation, 'access'); ?></span>
            </div>
        </div>
        <div class="row my-3 d-flex">
            <div class="col-lg-4 col-sm-12 float-left">
                <a href="<?= base_url('password/forget'); ?>" class="btn btn-danger  btn-lg py-3 fw-bold">
                    <i class="fas fa-chevron-left"></i> Renvoyer
                </a>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="text-right float-right">
                    <button class="btn btn-primary btn-lg py-3" type="submit">
                        Confirmer votre connexion
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>