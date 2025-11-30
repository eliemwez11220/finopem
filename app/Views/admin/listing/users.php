<div class="content-wrapper">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Administration</li>
                        <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
                    </ol>
            </nav>
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Gestion des comptes</h1>
                </div>
                <div class="col-auto <?= checkModuleAccess(null, 'admins'); ?>">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-primary btnrounded" href="<?= base_url('admin/create/user'); ?>">
                                    <i class="fas fa-plus"></i> Nouveau compte</a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <section class="section <?= checkModuleAccess(null, 'admins'); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-hover table-striped" id="datatablesExample2">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Type</th>
                                    <th>Etat</th>
                                    <th>Session</th>
                                    <th class="text-end">MDP</th>
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
                                            <td>
                                                <img src="<?= base_url('public/uploads/images/' . $user['user_avatar']); ?>"
                                                    alt="<?= substr($user['user_firstname'], 0,1); ?>" class="avatar avatar"/>
                                                <span class="text-uppercase small fw-bold font-weight-bold">
                                                    <?= ($user['user_firstname']); ?>
                                                </span>
                                                </td>
                                            <td>

                                                <span class="text-lowercase fw-bold">
                                                    <?= ($user['user_email']); ?>
                                                </span>
                                            </td>
                                            <td class="text-capitalize"><?= $user['role_name']; ?></td>
                                            <td class="text-capitalize"><?= $user['user_type']; ?></td>

                                            <td class="text-capitalize <?= ($status == 'actif') ? 'badge bg-success' : 'badge bg-danger'; ?>">
                                                <?= $status; ?></td>
                                            <td class="text-capitalize <?= ($session == 'online') ? 'text-success' : 'text-danger'; ?>">
                                                <?= $session; ?>
                                            </td>

                                            <td class="text-end">
                                            <?php if ($user['user_type'] != 'root' OR session()->usertoken==$user['user_token']): ?>
                                                <a data-toggle="modal"
                                                data-target="#password_change<?= $count; ?>"
                                                aria-controls="password_change<?= $count; ?>"
                                                href="javascript:void();" class="btn btn-danger btn-sm">
                                                <span class="text-capitalize" data-toggle="tooltip"  data-placement="top"
                                                                title="Cliquer pour réinitialiser le mot de passe de ce compte">
                                                    <i class="fas fa-sync"></i></span>
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                            <!-- end update year modal -->
                                            <td class="text-end">
                                                <?php if ($user['user_type'] != 'root'): ?>
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
                                                <?php else: ?>
                                                        <a href="<?= base_url('admin/edit/user/' . $user_id); ?>"
                                                        class="btn btn-primary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <div class="modal modal-end bg-gray-400" tabindex="-1" id="password_change<?= $count; ?>"
                                            aria-labelledby="password_change_form" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                            
                                                        <h4 class="offcanvas-title d-inline-flex">
                                                            <img src="<?= base_url('public/uploads/images/' . $user['user_avatar']); ?>"
                                                                alt="<?= substr($user['user_firstname'], 0,1); ?>" class="img-circle"
                                                                style="border-radius: 100px!important; height: 35px; width: 40px;"/>
                                                            <span class="ml-2 text-uppercase small"><?= ($user['user_firstname']); ?></span>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="text-danger">
                                                                    <i class="fa fa-window-close"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3 class="text-center">Réinitialisation</h3>
                                                        <?php
                                                        $aleatoire_value = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZ";
                                                        $new_pass_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(10, 20))), 0, 10);
                                                        //echo $session->getFlashdata('form');
                                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                        echo form_open('admin/resetAccountPassword/' . esc($user['user_id']), $attributes);
                                                        ?>
                                                        <div class="row">
                                                            <p class="text-center">
                                                                <span class="small">
                                                                    (Le mot de passe ci-dessous a été généré automatiquement. 
                                                                    Vous pouvez le modifier manuellement
                                                                                en cas de besoin avant d'envoyer au 
                                                                                correspondant)</span>
                                                            </p>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="asset_password" class="control-label">
                                                                        <span class="text-danger">*</span> 
                                                                        Nouveau mot de
                                                                        passe
                                                                    </label>
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        name="asset_password"
                                                                        id="asset_password"
                                                                        value="<?= (!empty($new_pass_generate)) ? $new_pass_generate : set_value('asset_password') ?>"
                                                                        autofocus required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-group mt-3">
                                                                    <div class="icheck-info d-inline">
                                                                        <input type="checkbox" name="pass_expire"
                                                                            id="pass_expire<?= $count; ?>"
                                                                            checked="checked">
                                                                        <label for="pass_expire<?= $count; ?>">
                                                                            Mot de passe expire à la prémiere
                                                                            connexion
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="text-center mt-3 ">
                                                                <button type="submit"
                                                                        class="btn btn-danger btn-block"
                                                                        style="border-radius: 100px;">
                                                                    Réinitialiser le mot de passe
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- change password users -->
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
