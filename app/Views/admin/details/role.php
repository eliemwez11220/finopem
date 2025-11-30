<?php if (isset($role) && (!empty($role))): ?>
<div class="content-wrapper <?= checkModuleAccess(null, 'admins'); ?>">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administration</li>
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>

            <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 text-uppercase">
                        Rôle: <?= $role['role_name']; ?>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-dark btn-sm"
                                   href="<?= base_url('admin/view/roles'); ?>">
                                    <i class="fas fa-chevron-left"></i> Retour à la liste</a>
                                    <a class="btn btn-danger btn-sm"
                                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce rôle ?'); false;"
                                   href="<?= base_url('admin/remove/role/'.$role['role_id']); ?>">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="">
                                       <i class="fas fa-users"></i>
                                    </div><!--//icon-holder-->
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h3 class="app-card-title text-uppercase fw-bold"><?= ($role['role_name']); ?></h3>
                                    <h5 class="app-card-title text-muted small">Mise à jour :
                                        <span class="text-end"><?= $role['role_updated_at']; ?></span>
                                    </h5>
                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//app-card-header-->
                        <div class="app-card-body px-4 w-100">


                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Dernière mise à jour</strong></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"><?= $role['role_updated_at']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Crée le </strong></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"><?= $role['role_created_at']; ?></span>
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
                                        <div class="item-label mb-2"><strong>Libellé</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                    <span class="h5 fw-bold text-capitalize">
                                        <?= $role['role_name']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Etat du rôle</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                    <span class="h5 fw-bold text-capitalize">
                                        <?= $role['role_status']; ?></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Description du rôle</strong></div>
                                        <!-- -->
                                        <div class="item-data"><?= $role['role_notes']; ?></div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div>

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </div>

            <section class="section mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">Liste des utilisateurs liés à ce rôle</h3>
                    </div><!--//row-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-striped" id="datatablesExample2">
                                <thead>
                                <tr>
                                <th>Date Ajout</th>
                                    <th>Nom</th>
                                    <th>Role</th>
                                    <th>Type</th>
                                    <th>Etat</th>
                                    <th>Session</th>
                                    
                                    <th class="text-end">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                if (isset($users) && (!empty($users))):
                                    foreach ($users as $key => $user):
                                        $session = $user['user_session_status'];
                                        $user_id = $user['user_id'];
                                        $status = $user['user_status'];
                                        $count++;
                                        ?>
                                        <tr class="small <?= ($status == 'actif' OR $status == 'active') ? '' : 'alert alert-warning'; ?>">
                                            <td class="text-capitalize"><?= $user['user_created_at']; ?></td>
                                            <td class="">
                                                <img src="<?= base_url('public/uploads/images/' . $user['user_avatar']); ?>"
                                                    alt="<?= substr($user['user_firstname'], 0,1); ?>" class="avatar avatar-sm"/>
                                                <span class="text-uppercase small fw-bold"><?= ($user['user_firstname']); ?></span>
                                            </td>
                                            <td class="text-capitalize"><?= $user['role_name']; ?></td>
                                            <td class="text-capitalize"><?= $user['user_type']; ?></td>

                                            <td class="text-capitalize <?= ($status == 'actif') ? 'badge bg-success' : 'badge bg-danger'; ?>">
                                                <?= $status; ?></td>
                                            <td class="text-capitalize <?= ($session == 'online') ? 'text-success' : 'text-danger'; ?>">
                                                <?= $session; ?>
                                            </td>
                                           
                                            <!-- end update year modal -->
                                            <td class="text-end">
                                                <?php if ($status != 'actif' && $status != 'active'): ?>
                                                    <a href="<?= base_url('admin/changeAccountStatus/' . $status . '/' . $user['user_id']); ?>"
                                                    class="btn btn-success btn-sm btnrounded"
                                                    onclick="return confirm('Changer le statut de ce compte?');">
                                                        <i class="fas fa-unlock"></i> Activer
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= base_url('admin/edit/user/' . $user_id); ?>"
                                                    class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('admin/details/user/' . $user_id); ?>"
                                                    class="btn btn-dark btn-sm">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php endif; ?>