<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration de monnaie de change</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Monnaie de change</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Gestion des monnaies</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle monnaie">
                                        <i class="fa fa-plus"></i> Nouvelle monnaie
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
                                        <th>Monnaie</th>
                                        <th>Valeur locale</th>
                                        <th>Valeur de change</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th width="1px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($currencies) && !empty($currencies)):
                                        foreach ($currencies as $key => $value):
                                            $status = (!empty(esc($value['currency_status'])) ? esc($value['currency_status']) : 'inactif');
                                            ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['currency_code']); ?></td>
                                                <td class="text-uppercase"><?= setCurrency($value['currency_name']); ?></td>
                                                <td class="text-capitalize text-center"><?= ($value['currency_local_value']); ?></td>
                                                <td class="text-uppercase text-center"><?= ($value['currency_change_value']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('fees/changeStatus/currency/' . esc($status) . '/' . esc($value['currency_id'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= ($value['currency_created_at']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                              
                                                </td>
                                            </tr>
                                            <!-- update year modal -->
                                            <div class="modal fade" id="update_<?= $count; ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-center">

                                                            <h4 class="modal-title d-inline-flex font-weight-bold text-uppercase">
                                                                Modification monnaie <?= setCurrency($value['currency_name']); ?></h4>
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
                                                        echo form_open(base_url('update-currency/' . $value['currency_id']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">  
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                    <div class="form-floating">
                                                                        <select id="currency_name" name="currency_name" class="form-control <?php if ($validation->hasError('currency_currency')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" required>
                                                                            <option selected aria-checked=""disabled>--
                                                                                Sélectionnez --</option>
                                                                            <?php
                                                                            $currency = setCurrency();
                                                                            foreach ($currency as $currencykey => $valuecurrency): ?>
                                                                                <option value="<?= esc($currencykey); ?>"
                                                                                    <?= ($value['currency_name'] == $currencykey) ? 'selected': set_select('currency_name', esc($currencykey)); ?>>
                                                                                    <?= strtoupper(($valuecurrency)); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <label for="currency_name" class="control-label">
                                                                            <span class="text-danger">*</span>Monnaie de change
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                    <div class="form-floating">
                                                                        <input type="text"
                                                                            class="form-control text-uppercase bg-white"
                                                                            name="currency_value"
                                                                            id="currency_value" placeholder="0.00"
                                                                            value="<?= ($value['currency_local_value']) ? $value['currency_local_value']: old('currency_value'); ?>"
                                                                            />
                                                                            <label for="currency_value" class="control-label">
                                                                            <span class="text-danger">*</span>Valeur locale
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                    <div class="form-floating">
                                                                        <input type="text"
                                                                            class="form-control text-capitalize"
                                                                            name="change_value"
                                                                            id="change_value" placeholder="0.00"
                                                                            value="<?= ($value['currency_change_value']) ? $value['currency_change_value']:old('change_value'); ?>"
                                                                            />
                                                                            <label for="change_value" class="control-label">
                                                                            <span class="text-danger">*</span>Valeur de change
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
                <h4 class="modal-title">Configuration d'une nouvelle monnaie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-currency'), $attributes);
            ?>
                <div class="modal-body">
                    <div class="row">  
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="currency_name" name="currency_name" class="form-control <?php if ($validation->hasError('currency_currency')) {
                                    echo 'is-invalid';
                                } ?>" required>
                                    <option selected aria-checked=""disabled>--
                                        Sélectionnez --</option>
                                    <?php
                                    $currency = setCurrency();
                                    foreach ($currency as $currencykey => $valuecurrency): ?>
                                        <option value="<?= esc($currencykey); ?>"
                                            <?= set_select('currency_name', esc($currencykey)); ?>>
                                            <?= strtoupper(($valuecurrency)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="currency_name" class="control-label">
                                    <span class="text-danger">*</span>Monnaie de change
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control text-uppercase bg-white"
                                    name="currency_value"
                                    id="currency_value" placeholder="0.00"
                                    value="<?= old('currency_value'); ?>"
                                    />
                                    <label for="currency_value" class="control-label">
                                    <span class="text-danger">*</span>Valeur locale
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control text-capitalize"
                                    name="change_value"
                                    id="change_value" placeholder="0.00"
                                    value="<?= old('change_value'); ?>"
                                    />
                                    <label for="change_value" class="control-label">
                                    <span class="text-danger">*</span>Valeur de change
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

