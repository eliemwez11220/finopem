<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration Nomenclature frais</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Nomenclature frais</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess('configfees'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Gestion des nomenclatures frais</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer un nouveau type frais">
                                        <i class="fa fa-plus"></i> Nouvelle Nomenclature
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Libellé</th>
                                        <th>Paiement</th>
                                        <th>Payable</th>
                                        <th>Monnaie</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th width="1px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($fees) && !empty($fees)):
                                        foreach ($fees as $key => $value):
                                            $status = (!empty(esc($value['fee_status'])) ? esc($value['fee_status']) : 'inactif');
                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['fee_code']); ?></td>
                                                <td class="text-uppercase"><?= ($value['fee_name']); ?></td>
                                                <td class="text-uppercase"><?= setFeesTypes($value['fee_type']); ?></td>
                                                <td class="text-capitalize text-center"><?= ($value['fee_total_payable']); ?> fois</td>
                                                <td class="text-uppercase text-center"><?= ($value['fee_currency_payable']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('fees/changeStatus/fees/' . esc($status) . '/' . esc($value['fee_id'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= ($value['fee_created_at']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                              
                                                   <a href="<?= base_url('fees/details/feetype/' . esc($value['fee_id'])); ?>"
                                                       class="btn btn-xs btn-outline-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour voir les details">
                                                        <i class="fa fa-info-circle fa-2x"></i></span>
                                                    </a> 
                                                    <a href="<?= base_url('fees/config/feedetails/' . esc($value['fee_token'])); ?>"
                                                       class="btn btn-sm btn-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour configurer la nomenclature de frais">
                                                        <i class="fa fa-cogs fa-lg"></i></span>
                                                    </a> 
                                                    <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>
                                            
                                                    <a href="<?= base_url('fees/remove/feetype/' . ($value['fee_id'])); ?>"
                                                        class="<?= $access_delete; ?> btn btn-xs btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer cette nomenclature?'); false;">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour supprimer ce type frais">
                                                                <i class="fa fa-window-close fa-2x"></i></span>
                                                        </a>
                                                </td>
                                            </tr>
                                            <!-- update year modal -->
                                            <div class="modal fade" id="update_<?= $count; ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">

                                                            <h4 class="modal-title d-inline-flex">Modification
                                                                type frais <?= esc($value['fee_name']); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                            <span aria-hidden="true">
                                                                     <i class="fa fa-window-close"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <?php
                                                        $validation = \Config\Services::validation();
                                                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                        echo form_open(base_url('update-feetype/' . $value['fee_id']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">                       
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                    <div class="form-floating">
                                                                       
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="fee_name"
                                                                               id="fee_name"
                                                                               value="<?= (!empty(($value['fee_name']))) ? ($value['fee_name']) : old('fee_name') ?>"
                                                                              />
                                                                              <label for="fee_name" class="control-label">
                                                                            <span class="text-danger">*</span>Libellé du type frais
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                        <div class="form-floating">
                                                                            <select id="fee_type" name="fee_type" class="form-control <?php if ($validation->hasError('fee_type')) {
                                                                                echo 'is-invalid';
                                                                            } ?>" required>
                                                                                <option selected aria-checked=""disabled>--
                                                                                    Sélectionnez --</option>
                                                                                <?php
                                                                                $degre_level = setFeesTypes();
                                                                                foreach ($degre_level as $keysectype => $valuesectype): ?>
                                                                                    <option value="<?= esc($keysectype); ?>"
                                                                                        <?= ($value['fee_type'] == $keysectype) ? 'selected' : set_select('fee_type', esc($keysectype)); ?>>
                                                                                        <?= ucfirst(($valuesectype)); ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <label for="degre_level" class="control-label">
                                                                                <span class="text-danger">*</span>Type de paiement
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                    <div class="form-floating">
                                                                       
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="fee_payable"
                                                                               id="fee_payable"
                                                                               value="<?= (!empty(($value['fee_total_payable']))) ? ($value['fee_total_payable']) : old('fee_payable') ?>"
                                                                              />
                                                                              <label for="fee_payable" class="control-label">
                                                                            <span class="text-danger">*</span>Nombre de fois payables
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                    <div class="form-floating">
                                                                        <select id="fee_currency" name="fee_currency" class="form-control <?php if ($validation->hasError('fee_currency')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" required>
                                                                            <option selected aria-checked=""disabled>--
                                                                                Sélectionnez --</option>
                                                                            <?php
                                                                            $currency = setCurrency();
                                                                            foreach ($currency as $currencykey => $valuecurrency): ?>
                                                                                <option value="<?= esc($currencykey); ?>"
                                                                                    <?= ($value['fee_currency_payable'] == $currencykey) ? 'selected' :set_select('fee_currency', esc($currencykey)); ?>>
                                                                                    <?= ucfirst(($valuecurrency)); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <label for="fee_currency" class="control-label">
                                                                            <span class="text-danger">*</span>Monnaie de paiement
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                          
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                    data-dismiss="modal">Fermer
                                                            </button>
                                                            <button type="submit"
                                                                    class="btn btn-info btn-sm text-uppercase">
                                                                Enregistrer les modifications
                                                            </button>
                                                        </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end update year modal -->
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Configuration d'un nouveau type frais</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-feetype'), $attributes);
            ?>
                <div class="modal-body">
                    <div class="row">                       
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control text-uppercase bg-white"
                                    name="fee_name"
                                    id="fee_name" placeholder="Ex:Minerval"
                                    value="<?= old('fee_name') ?>"
                                    />
                                    <label for="fee_name" class="control-label">
                                    <span class="text-danger">*</span>Libellé du type frais
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="fee_type" name="fee_type" class="form-control <?php if ($validation->hasError('fee_type')) {
                                    echo 'is-invalid';
                                } ?>" required>
                                    <option selected aria-checked=""disabled>--
                                        Sélectionnez --</option>
                                    <?php
                                    $degre_level = setFeesTypes();
                                    foreach ($degre_level as $keysectype => $valuesectype): ?>
                                        <option value="<?= esc($keysectype); ?>"
                                            <?= set_select('fee_type', esc($keysectype)); ?>>
                                            <?= ucfirst(($valuesectype)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="fee_type" class="control-label">
                                    <span class="text-danger">*</span>Type de paiement
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="fee_currency" name="fee_currency" class="form-control <?php if ($validation->hasError('fee_currency')) {
                                    echo 'is-invalid';
                                } ?>" required>
                                    <option selected aria-checked=""disabled>--
                                        Sélectionnez --</option>
                                    <?php
                                    $currency = setCurrency();
                                    foreach ($currency as $currencykey => $valuecurrency): ?>
                                        <option value="<?= esc($currencykey); ?>"
                                            <?= set_select('fee_currency', esc($currencykey)); ?>>
                                            <?= ucfirst(($valuecurrency)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="fee_currency" class="control-label">
                                    <span class="text-danger">*</span>Monnaie de paiement
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-floating">
                                <input type="number"
                                    class="form-control text-capitalize"
                                    name="fee_payable"
                                    id="fee_payable" placeholder="Ex:2"
                                    value="<?= old('fee_payable') ?>" min="1" max="50"
                                    />
                                    <label for="fee_payable" class="control-label">
                                    <span class="text-danger">*</span>Nombre de fois payables
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer  </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

