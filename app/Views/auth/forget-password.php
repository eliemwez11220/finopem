<div class="container">
    <div class="text-center py-3">
        <p class="font-weight-bold lined lined-center p-3">
            <a href="<?= base_url(); ?>" class="h3 font-weight-bold mb-3">
                Réinitialisation du mot de passe
            </a>
            <br>
            Indiquez votre adresse mail lié à votre compte
            utilisateur pour réinitialiser votre mot de passe oublié.
        </p>
    </div>
    <?php $validation = \Config\Services::validation();
        $attributes = array('role' => 'form', 'autocomplete' => 'off');
        echo form_open(base_url('resetPassword'), $attributes);
    ?>
    
        <div class="form-group">
            <label for="username" class="form-label text-uppercase font-weight-bold">
                <span class="text-danger">*</span>Adresse E-mail
            </label>
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-envelope text-primary"></i>
                    </span>
                </div>
                <input type="email" name="email"
                    class="text-dark font-weight-bold py-4 form-control form-control-lg border-left-0  <?= ($validation->hasError('email')) ? ' is-invalid border-dark' : '' ?>"
                    id="email" placeholder="Ex: name@domain.com" autofocus>
            </div>
            <div id="floatingInputUsername" class="form-text">
                <span class="text-danger"><?= displayFormError($validation, 'email'); ?></span>
            </div>
        </div>

        <div class="row my-3 d-flex">
            <div class="col-lg-4 col-sm-12 float-left">
                <a href="<?= base_url(); ?>" class="btn btn-danger  btn-lg py-3 fw-bold">
                    <i class="fas fa-chevron-left"></i> Accueil
                </a>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="text-right float-right">
                    <button class="btn btn-primary btn-lg py-3" type="submit">
                    <i class="fas fa-check-circle"></i> Réinitialiser mot de passe
                    </button>
                </div>
            </div>
        </div>
   
    <?= form_close(); ?>
</div>