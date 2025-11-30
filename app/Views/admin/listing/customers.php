<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container">
        <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carnet d'adresses</li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
        </nav>
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Gestion des clients</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <a class="btn btn-primary btnrounded" href="<?= base_url('admin/create/customer'); ?>">
                                <i class="fas fa-plus"></i> Nouveau client</a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->
        <section class="row section <?= checkModuleAccess(null, 'admins'); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-hover table-striped" id="table1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Type</th>
                                    <th>Etat</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                if (isset($customers) && (!empty($customers))):
                                    foreach ($customers as $key => $value):
                                        $customer_uid = $value['client_uid'];
                                        $status = $value['client_status'];
                                        //$count++;
                                        ?>
                                        <tr class="small <?= ($status == 'actif') ? '' : 'alert alert-warning'; ?>">
                                            <td class="text-capitalize"><?= $count++; ?></td>
                                            <td class="text-capitalize"><?= $value['client_name']; ?></td>
                                            <td class="text-capitalize"><?= $value['client_phone']; ?></td>
                                            <td class="text-capitalize"><?= $value['client_type']; ?></td>

                                            <td class="text-capitalize">
                                                <a data-bs-toggle="offcanvas"
                                                data-bs-target="#password_change<?= $count; ?>"
                                                aria-controls="password_change<?= $count; ?>"
                                                href="javascript:void();" class="btn <?= ($status == 'actif') ? 'btn-success' : 'btn-danger'; ?> btn-sm">
                                                            <span class="text-capitalize" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Cliquer pour mettre à jour le statut"><i
                                                                        class="fas fa-sync"></i> <?= $status; ?></span>
                                                </a>
                                            </td>
                                    
                                            <td class="text-end">
                                            
                                                    <a href="<?= base_url('admin/edit/customer/' . $customer_uid); ?>"
                                                    class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Modification des infos">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= base_url('admin/details/customer/' . $customer_uid); ?>"
                                                    class="btn btn-dark btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Afficher les détails">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                        <!-- change password users -->
                                        <div class="offcanvas offcanvas-end  bg-gray-200"
                                            id="password_change<?= $count; ?>">
                                            <div class="offcanvas-header text-center">
                                                <h4 class="offcanvas-title d-inline-flex">
                                                    Mise à jour du statut d'un client <?= $value['client_name']; ?>
                                                </h4>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="offcanvas"
                                                        aria-label="Close"></button>

                                            </div>

                                            <div class="offcanvas-body">
                                                <?php
                                                $validation = \Config\Services::validation();
                                                $aleatoire_value = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz";
                                                $new_pass_generate = substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(10, 20))), 0, 10);
                                                //echo $session->getFlashdata('form');
                                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                echo form_open('admin/changeStatus/customer/' . ($customer_uid), $attributes);
                                                ?>
                                                <?= csrf_field() ?>
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="asset_password" class="control-label">
                                                                <span class="text-danger">*</span> 
                                                            Etat du client</label>
                                                            
                                                            <select class="choices form-select <?= ($validation->hasError('type')) ? ' is-invalid' : '' ?>"
                                                        title="Type Expatrié" name="type" id="type">
                                                    <option disabled>- Sélectionnez -</option>
                                                    <?php
                                                    $types_values = array(
                                                        'actif' => 'Actif',
                                                        'inactif' => 'Désactivé',
                                                    );
                                                    foreach ($types_values as $value => $display_text) { ?>
                                                        <option value="<?= $value; ?>" <?= ($value == $status)? "selected": set_select("type", $value); ?>><?= $display_text; ?></option>
                                                    <?php } ?>
                                                </select>

                                                <span class="text-danger"><?= displayFormError($validation, 'type'); ?></span>
                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="text-center mt-3 ">
                                                        <button type="submit"
                                                                class="btn btn-success btn-block"
                                                                style="border-radius: 100px;">
                                                                Valider les modifications
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>

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