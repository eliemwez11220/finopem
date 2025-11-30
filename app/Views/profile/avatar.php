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
                        <div class="row align-items-center gx-3 mt-5">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm" 
                                href="<?= base_url('profile/page/profile'); ?>">
                                    <i class="fas fa-chevron-left"></i> Retour au profile</a>
                            </div>
                        </div>
                        <!--//row-->
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header text-center bg-info">
                            <h1 class="fw-bold py-5">Changement de la photo de profil</h1>
                        </div>
                        <div class="card-body">
                            <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(base_url('profileChangePicture/' . $user['user_id']), $attributes);
                                ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-floating mb-2">
                                            <input type="file"
                                                class="form-control <?= ($validation->hasError('avatar')) ? ' is-invalid' : '' ?>"
                                                id="oldpass" placeholder="Votre photo" name="avatar"
                                                value="<?= set_value('avatar'); ?>" autofocus
                                                aria-describedby="avatar" />
                                            <label for="avatar">Charger une photo<span
                                                    class="text-danger">(*)</span></label>
                                            <div id="avatar" class="form-text">
                                                <span
                                                    class="text-danger"><?= displayFormError($validation, 'avatar'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-3 text-center">
                                    <button class="btn  btn-primary btn-lg rounded-2 py-3 btnrounded" type="submit">
                                        <i class="fas fa-check-circle"></i> Valider le changement
                                    </button>
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