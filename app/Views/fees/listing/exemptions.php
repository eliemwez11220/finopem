<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Configuration Exhonérations</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                            href="<?= base_url('dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Exhonérations</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess('exemptions'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">
                                    Gestion des exhonérations et bourses</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element"
                                   href="#" class="btn btn-info text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                          title="Cliquer pour créer une nouvelle exhonération">
                                        <i class="fa fa-plus"></i> Nouvelle 
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
                                    <tr class="text-uppercase text-center small">
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Libellé</th>
                                        <th>Montant</th>
                                        <th>Monnaie</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th width="1px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($exemptions) && !empty($exemptions)):
                                        foreach ($exemptions as $key => $value):
                                            $status = (!empty(esc($value['exemption_status'])) ? esc($value['exemption_status']) : 'inactif');
                                            ?>
                                            <tr class="small text-center">
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['exemption_code']); ?></td>
                                                <td class="text-uppercase"><?= ($value['exemption_name']); ?></td>
                                               
                                                <td class="text-capitalize text-center">
                                                    <?= number_format($value['exemption_cost_discount'], 2, ',', ' '); ?>
                                                </td>
                                                <td class="text-uppercase text-center"><?= ($value['exemption_currency']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('fees/changeStatus/exemption/' . esc($status) . '/' . esc($value['exemption_id'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                        <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= ($value['exemption_created_at']); ?></td>
                                                <td width="1px" class="text-center">
                                                    <a data-toggle="modal"
                                                       data-target="#update_<?= $count; ?>"
                                                       href="#" class="btn btn-xs btn-outline-warning">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                    </a>
                                              
                                                    
                                                    <a href="<?= base_url('fees/config/discountexemption/' . esc($value['exemption_token'])); ?>"
                                                       class="btn btn-xs btn-info">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour configurer l'exhonération générale par frais">
                                                        <i class="fa fa-cogs fa-lg"></i></span>
                                                    </a> 
                                                    <a href="<?= base_url('fees/config/classeexemption/' . esc($value['exemption_id'])); ?>"
                                                       class="btn btn-xs btn-primary">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Cliquer pour configurer la bourse par classe">
                                                        <i class="fa fa-users-cog fa-lg"></i></span>
                                                    </a>
                                                    <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>
                                            
                                                    <a href="<?= base_url('fees/remove/exemption/' . ($value['exemption_id'])); ?>"
                                                        class="<?= $access_delete; ?> btn btn-xs btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer cette nomenclature?'); false;">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour supprimer cette exhonération frais">
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
                                                            exhonération <?= esc($value['exemption_name']); ?></h4>
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
                                                        echo form_open(base_url('update-exemption/' . $value['exemption_id']), $attributes);
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="row">                       
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                    <div class="form-floating">
                                                                       
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="exemption_name"
                                                                               id="exemption_name"
                                                                               value="<?= (!empty(($value['exemption_name']))) ? ($value['exemption_name']) : old('exemption_name') ?>"
                                                                              />
                                                                              <label for="exemption_name" class="control-label">
                                                                            <span class="text-danger">*</span>Libellé de l'exhonération
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                    <div class="form-floating">
                                                                        <select id="exemption_currency" name="exemption_currency" class="form-control <?php if ($validation->hasError('exemption_currency')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" required>
                                                                            <option selected aria-checked=""disabled>--
                                                                                Sélectionnez --</option>
                                                                            <?php
                                                                            $currency = setCurrency();
                                                                            foreach ($currency as $currencykey => $valuecurrency): ?>
                                                                                <option value="<?= esc($currencykey); ?>"
                                                                                    <?= ($value['exemption_currency'] == $currencykey) ? 'selected' :set_select('exemption_currency', esc($currencykey)); ?>>
                                                                                    <?= ucfirst(($valuecurrency)); ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <label for="exemption_currency" class="control-label">
                                                                            <span class="text-danger">*</span>Monnaie d'exhonération
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                    <div class="form-floating">
                                                                       
                                                                        <input type="text"
                                                                               class="form-control text-capitalize"
                                                                               name="exemption_payable"
                                                                               id="exemption_payable"
                                                                               value="<?= (!empty(($value['exemption_cost_discount']))) ? ($value['exemption_cost_discount']) : old('exemption_payable') ?>"
                                                                              />
                                                                              <label for="exemption_payable" class="control-label">
                                                                            <span class="text-danger">*</span>Montant d'exhonération
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
                <h4 class="modal-title">Configuration d'une nouvelle exhonération</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-exemption'), $attributes);
            ?>
                <div class="modal-body">
                    <div class="row">                       
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control text-uppercase bg-white"
                                    name="exemption_name"
                                    id="exemption_name"
                                    value="<?= old('exemption_name') ?>" placeholder="Ex: Nouvel inscrit"
                                    />
                                    <label for="exemption_name" class="control-label">
                                    <span class="text-danger">*</span>Libellé de l'exhonération
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select id="exemption_currency" name="exemption_currency" class="form-control <?php if ($validation->hasError('exemption_currency')) {
                                    echo 'is-invalid';
                                } ?>" required>
                                    <option selected aria-checked=""disabled>--
                                        Sélectionnez --</option>
                                    <?php
                                    $currency = setCurrency();
                                    foreach ($currency as $currencykey => $valuecurrency): ?>
                                        <option value="<?= esc($currencykey); ?>"
                                            <?= set_select('exemption_currency', esc($currencykey)); ?>>
                                            <?= ucfirst(($valuecurrency)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="exemption_currency" class="control-label">
                                    <span class="text-danger">*</span>Monnaie d'exhonération
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control text-capitalize"
                                    name="exemption_payable"
                                    id="exemption_payable" placeholder="Ex: 100"
                                    value="<?= old('exemption_payable') ?>"
                                    />
                                    <label for="exemption_payable" class="control-label">
                                    <span class="text-danger">*</span>Montant d'exhonération
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

