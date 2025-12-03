<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Détails types frais</li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('fees/feestypes'); ?>"
                                class="btn btn-info btn-rounded text-uppercase btn-sm">
                                <i class="fas fa-reply fa-lg"></i> Revenir a la liste
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (isset($feetype) && (!empty($feetype))): ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1 class="text-uppercase font-weight-bold">
                                <span class="font-weight-bold h3">
                                    Details Configuration
                                </span>

                                <span class="text-primary h3 font-weight-bold">
                                    <?= trim(strtoupper($feetype['fee_name'])); ?>
                                </span>
                                <br />
                                <span class="text-uppercase h3">
                                    Paiement <span
                                        class="text-danger"><?= setFeesTypes($feetype['fee_type']); ?>,</span>
                                    en
                                    <span class="text-danger"><?= trim($feetype['fee_currency_payable']); ?></span>
                                    <span class="text-danger"><?= trim($feetype['fee_total_payable']); ?></span> fois
                                </span>

                            </h1>

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
                                            <th>Sigle</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count = 1;
                                    if (isset($feesdetails) && !empty($feesdetails)):
                                        foreach ($feesdetails as $key => $value):
                                            $status = (!empty(esc($value['feedetail_status'])) ? esc($value['feedetail_status']) : 'inactif');
                                            ?>
                                        <tr class="small">
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['feedetail_code']); ?></td>
                                            <td class="text-uppercase"><?= trim($value['feedetail_name']); ?></td>
                                            <td class="text-uppercase"><?= trim($value['feedetail_subname']); ?></td>
                                            <td class="text-uppercase text-center">
                                                <?= number_format($value['feedetail_cost_payable'], 2, ',', ' '); ?>
                                                <?= trim($feetype['fee_currency_payable']); ?>
                                                (<?= setFeesTypes($feetype['fee_type']); ?>)
                                            </td>
                                            <td>
                                                <a href="<?= base_url('fees/changeStatus/feedetail/' . esc($status) . '/' . esc($value['feedetail_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= ($value['feedetail_created_at']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a data-toggle="modal" data-target="#update_<?= $count; ?>" href="#"
                                                    class="btn btn-xs btn-outline-warning">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                                <a href="<?= base_url('fees/details/feeclasse/'. ($value['feedetail_id'])); ?>"
                                                    class="btn btn-sm btn-info">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour voir la configuration de ce frais par classe">
                                                        <i class="fa fa-info-circle fa-lg"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $count; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title d-inline-flex">Modification
                                                            <?= esc($value['feedetail_name']); ?></h4>
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
                                                        echo form_open(base_url('update-feedetails/' . $value['feedetail_id']), $attributes);
                                                        ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                <div class="form-floating">

                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="fee_name" id="fee_name"
                                                                        value="<?= (!empty(($value['feedetail_name']))) ? ($value['feedetail_name']) : old('fee_name') ?>" />
                                                                    <label for="fee_name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé frais
                                                                    </label>
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                <div class="form-floating">

                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="fee_payable" id="fee_payable"
                                                                        value="<?= (!empty(($value['feedetail_cost_payable']))) ? ($value['feedetail_cost_payable']) : old('fee_payable') ?>" />
                                                                    <label for="fee_payable" class="control-label">
                                                                        <span class="text-danger">*</span>Montant
                                                                        payable (en
                                                                        <?= setCurrency($feetype['fee_currency_payable']); ?>)
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control bg-light <?php if($validation->hasError( 'shortname')){echo 'is-invalid';} ?>"
                                                                        name="shortname" id="shortname"
                                                                        placeholder="Ex: FS AVRIL"
                                                                        value="<?= ($value['feedetail_subname']) ? $value['feedetail_subname']:set_value('shortname'); ?>" />
                                                                    <label for="shortname" class="control-label">
                                                                        <span class="text-danger"></span>Abbréviation
                                                                        frais
                                                                    </label>
                                                                    <?php if(isset($validation)): ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= display_validation_error($validation, 'shortname'); ?>
                                                                    </span>
                                                                    <?php endif;?>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>