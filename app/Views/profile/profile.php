<?php if (isset($user) && (!empty($user))): ?>
<div class="content-wrapper mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="text-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                <li class="breadcrumb-item active" aria-current="page">Compte</li>
            </ol>
        </nav>

        <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <a class="btn btn-dark btn-sm" href="javascript:history.back();">
                                <i class="fas fa-chevron-left"></i> Retour</a>
                            <a href="<?= base_url('profile/edit/account/' . $user['user_id']); ?>"
                                class="btn btn-primary btn-sm btnrounded">
                                <i class="fas fa-edit"></i> Editer profile
                            </a>
                            <a href="<?= base_url('profile/edit/password/' . $user['user_id']); ?>"
                                class="btn btn-danger btn-sm btnrounded">
                                <i class="fas fa-sync"></i> Changer mot de passe
                            </a>
                            <a href="<?= base_url('profile/edit/avatar/' . $user['user_id']); ?>" class="btn btn-success btn-sm btnrounded">
                                <i class="fas fa-image"></i> Changer photo
                            </a>
                            <a href="<?= base_url('profile/edit/security/' . $user['user_id']); ?>"
                                class="btn btn-dark btn-sm btnrounded">
                                <i class="fas fa-cog"></i> Gérer la sécurité
                            </a>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//row-->

        <div class="row section">
            <div class="col-12 col-lg-6 col-sm-12">
                <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
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
                                <h5 class="app-card-title text-danger fw-bold">ID : <span
                                        class="text-end"><?= $user['user_code']; ?>
                                    </span></h5>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">


                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Email </strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary">
                                        <?= $user['user_email']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Téléphone</strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 text-primary fw-bold">
                                        <?= $user['user_phone']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Nom Agent</strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $user['user_firstname']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Prénom Agent</strong></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $user['user_lastname']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Pseudo(login)</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $user['user_name']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
            <div class="col-12 col-lg-6 col-sm-12">
                <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                    <div class="app-card-body px-4 w-100">
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Etat du compte</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $user['user_status']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Role</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold text-primary text-capitalize">
                                        <?= $user['role_name']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Type compte</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5  fw-bold text-primary text-capitalize">
                                        <?= $user['user_type']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Langue</strong></div>
                                    <!-- <div class="item-data">James Doe</div> -->
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5  fw-bold text-primary text-uppercase">
                                        <?= $user['user_language']; ?></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->

                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2"><strong>Adresse </strong></div>

                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="small fw-bold text-primary text-uppercase">
                                        <?= $user['user_address']; ?>
                                    </span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label mb-2">
                                        <strong>A propos du compte</strong>
                                    </div>
                                    <div class="item-data text-primary text-capitalize">
                                        <?= $user['user_notes']; ?></div>
                                </div>
                                <!--//col-->
                                <div class="col text-end">
                                    <span class="h5 fw-bold "></span>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->


                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
        </div>
    </div>
</div>
<?php endif; ?>