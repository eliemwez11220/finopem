<?php if (isset($user) && (!empty($user))): ?>
<div class="content-wrapper <?= checkModuleAccess(null, 'admins'); ?></div>">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administration</li>
                    <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>

            <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 text-uppercase">
                        <?= $user['user_firstname']; ?>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm"
                                   href="<?= base_url('admin/view/users'); ?>">
                                    <i class="fas fa-chevron-left"></i> Retour</a>
                                <?php $status = $user['user_status']; ?>
                                <a href="<?= base_url('admin/edit/user/' . $user['user_id']); ?>"
                                   class="btn btn-warning btn-sm btnrounded">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>

                                <a href="<?= base_url('admin/changeAccountStatus/'.$status.'/' . $user['user_id']); ?>"
                                   class="btn btn-success btn-sm btnrounded"
                                   onclick="return confirm('Changer le statut de ce compte?');">
                                    <?= ($status=='actif')? '<i class="fas fa-lock"></i> Désactiver':'<i class="fas fa-unlock"></i> Activer'; ?>
                                </a>
                                <a class="btn btn-danger btn-sm"
                                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce compte ?'); false;"
                                   href="<?= base_url('admin/remove/user/'.$user['user_id']); ?>">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <div class="row section">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="">
                                        <img src="<?= base_url('public/uploads/images/' . $user['user_avatar']); ?>"
                                             alt="IMG" class="avatar avatar-lg"/>
                                    </div><!--//icon-holder-->
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h3 class="app-card-title text-uppercase fw-bold"><?= ($user['user_firstname']); ?></h3>
                                    <h5 class="app-card-title text-muted">ID : <span
                                                class="text-end"><?= $user['user_code']; ?></span></h5>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4 w-100">

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Role</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                    <span class="h5 fw-bold text-capitalize">
                                        <?= $user['role_name']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Dernière connexion</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"><?= $user['user_created_at']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Dernière déconnexion</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"><?= $user['user_created_at']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->


                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email </strong></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-lowercase"><?= $user['user_email']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Téléphone</strong></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"><?= $user['user_phone']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Nom agent</strong></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-capitalize"><?= $user['user_firstname']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Prénom agent</strong></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-capitalize"><?= $user['user_lastname']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Type compte</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-capitalize"><?= $user['user_type']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Pseudo(login)</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-lowercase"><?= $user['user_name']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Etat du compte</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-capitalize"><?= $user['user_status']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-body px-4 w-100">
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Dernier changement du mot de
                                                passe </strong></div>
                                        <!-- -->
                                        <div class="item-data"><?= $user['user_created_at']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Dernière réinitialisation du mot de
                                                passe </strong></div>
                                        <div class="item-data"><?= $user['user_created_at']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Nombre de fois de réinitialisation du mot
                                                de passe </strong></div>
                                        <div class="item-data"><?= $user['user_created_at']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Dernière réinitialisation du mot de passe
                                                effectué par </strong></div>
                                        <div class="item-data"><?= $user['user_created_at']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Observation </strong></div>
                                        <div class="item-data"><?= $user['user_notes']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->


                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>A propos du compte</strong></div>
                                        <div class="item-data"><?= $user['user_notes']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Adresse </strong></div>
                                        <div class="item-data"><?= $user['user_address']; ?> </div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                    <span class="h5 fw-bold text-uppercase">
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->


                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </div>

        </div>
    </div>
    </div>
<?php endif; ?>