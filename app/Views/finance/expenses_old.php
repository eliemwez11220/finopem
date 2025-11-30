<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Mouvements - Décaissemements</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Gestion Financiere</li>
                        <li class="breadcrumb-item active">Prélèvements</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <?php if(isset($cashbox) && (!empty($cashbox))):?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <blockquote class="py-5">
                        <h1 class="font-weight-bold text-uppercase lined lined-center">
                            <i class="nav-icon fas fa-donate"></i> Sortie de fonds
                        </h1>
                        <p class="font-weight-bold h5 text-center">
                            Sélectionner une caisse pour décaisser les fonds
                        </p>

                        <form role="form" id="form_cashbox" method="get">
                            <div class="form-floating">
                                <select name="cashbox_id" id="cashbox_id" class="form-control">
                                    <option disabled selected>Choisissez une caisse</option>
                                    <?php if (isset($cashbox)):
                                        foreach ($cashbox as $key => $value) : ?>
                                    <option value="<?= esc($value['cashbox_id']); ?>"
                                        <?= (session()->has('cashboxchoosed') && (session()->cashboxchoosed == $value['cashbox_id']))?'selected':set_select('cashbox_id', esc($value['cashbox_id'])); ?>>
                                        <?= strtoupper($value['cashbox_name']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </form>
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-lg-6 col-sm-12">
                <?php if (session()->has('cashboxdata')) : ?>
                    <?php

                    $cashboxdata = session()->cashboxdata;
                    $cashbox_id = $cashboxdata['cashbox_id'];
                    $cashbox_debit = $cashboxdata['cashbox_debit_amount'];
                    $cashbox_credit = $cashboxdata['cashbox_credit_amount'];
                    $cashbox_balance = (session()->cashboxavailable) ? session()->cashboxavailable: $cashbox_credit - $cashbox_debit;
                    $input_alias_prefix = ($cashboxdata['cashbox_currency'] == 'usd') ? '$':'Fc';
                    $currency_amount = ($cashboxdata['cashbox_currency'] == 'usd') ? 'USD':'CDF';

                    if($cashbox_balance != 0):
                        //form validation manager
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('cashbox-create-expense'), $attributes);
                        ?>
                    <div class="card">
                        <input type="hidden" name="cashbox_currency" id="cashbox_currency"
                            value="<?= ($cashboxdata['cashbox_currency']); ?>" readonly />
                        <input type="hidden" name="cashboxid" id="cashboxid" value="<?= $cashbox_id; ?>" readonly />
                        <div class="card-header">
                            <div class="row">

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                        <input class="form-control text-left float-left" type="text"
                                            name="cashbox_available_amount" id="cashbox_available_amount"
                                            value="<?= ($cashbox_balance); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $input_alias_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" disabled readonly />

                                        <label for="cashbox_available_amount" class="control-label">
                                            <span class="text-danger">*</span>Solde disponible dans la caisse
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                        <input class="form-control text-left float-left" type="text"
                                            name="expense_amount" id="expense_amount"
                                            value="<?= old('expense_amount'); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $input_alias_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" autofocus />
                                        <?php if ($validation->hasError('expense_amount')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('expense_amount'); ?></span>
                                        <?php } ?>
                                        <label for="expense_amount" class="control-label">
                                            <span class="text-danger">*</span>Montant a décaisser en <?= $currency_amount; ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" name="requested_by" id="requested_by"
                                            value="<?= old('requested_by') ?>" placeholder="Ex: Agent Mumba" />
                                        <?php if ($validation->hasError('requested_by')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('requested_by'); ?></span>
                                        <?php } ?>
                                        <label for="requested_by" class="control-label">
                                            <span class="text-danger">*</span>Bénéficiaire
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control" name="approved_by" id="approved_by"
                                            value="<?= old('approved_by') ?>" placeholder="Ex: Manager Mumba" />
                                        <?php if ($validation->hasError('approved_by')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('approved_by'); ?></span>
                                        <?php } ?>
                                        <label for="approved_by" class="control-label">
                                            <span class="text-danger">*</span>Approbateur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-floating">

                                        <textarea name="notes" id="notes" cols="30" rows="3"
                                            placeholder="Ex: Achat carburant"
                                            class="form-control"><?= old('notes');?></textarea>
                                        <?php if ($validation->hasError('notes')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('notes'); ?></span>
                                        <?php } ?>
                                        <label for="notes"><span class="text-danger">*</span>Motif
                                            décaissemement</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-tools float-right mt-3">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase">
                                    <i class="fa fa-check-circle"></i> Valider la sortie
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                    <?php else: ?>
                        <blockquote class="py-5">
                            <div class="alert alert-info">
                                <h3>
                                    Le solde de la caisse que vous avez choisi est de 
                                    <span class="text-danger">0.00</span>
                                </h3>
                            </div>
                        </blockquote>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .content -->
    </section>
    <!-- Main content -->
    <?php if (isset($expenses) && !empty($expenses)):?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h3 class="font-weight-bold text-uppercase">
                                Décaissemements effectuées</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th width="1px">Actions</th>
                                            <th>Date</th>
                                            <th>Caisse</th>
                                            <th>USD</th>
                                            <th>CDF</th>
                                            <th>Beneficiaire</th>
                                            <th>Approbateur</th>
                                            <th>Statut</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                            foreach ($expenses as $key => $value): 
                                                if($value['expense_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                            $status = ($value['expense_status']);
                                            $echange = ($value['expense_exchange']);
                                            $mnt_sorti_usd = ($value['expense_usd_amount']);
                                            $mnt_sorti_cdf = ($value['expense_cdf_amount']);
                                            $currency_cashbox = ($value['cashbox_currency']);
                                            
                                            $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                            $expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';

                                            if($value['expense_type'] == 'expense'):
                                                ?>
                                        <tr class="small">
                                            <td width="1px" class="text-center">
                                            <?php if($status == 'cancel'): ?>
                                                <a href=" <?= base_url('finances/remove/expense/' . $value['expense_id']); ?>" 
                                                    class="btn btn-xs btn-danger" onclick="return confirm('Voulez-vous vraiment annuler cette operation?');">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer definitivement cette sortie">
                                                        <i class="fa fa-trash fa-lg"></i> Supprimer</span>
                                                </a>
                                                <?php else: ?>
                                                <a data-toggle="modal" data-target="#update_<?= $value['expense_id']; ?>" href="#"
                                                    class="btn btn-xs btn-outline-warning d-none <?= ($value['expense_date'] == date('Y-m-d')) ? '':'disabled'; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>

                                                <a data-toggle="modal" data-target="#cancel_<?= $value['expense_id']; ?>" href="#"
                                                    class="btn btn-xs btn-outline-danger <?= ($value['expense_date'] == date('Y-m-d')) ? '':'disabled'; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour annuler cette information">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                                <a href=" <?= base_url('finances/printexpense/' . $value['expense_token']); ?>" 
                                                    class="btn btn-xs btn-info">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour imprimer le bon de sortie">
                                                        <i class="fa fa-print fa-2x"></i></span>
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= ($value['expense_created_at']); ?></td>
                                            <td class="text-uppercase"><?= ($value['cashbox_name']); ?></td>

                                            <td class="text-uppercase">
                                                <?= number_format(($mnt_sorti_usd), 2, ',', ' '); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= number_format(($mnt_sorti_cdf), 2, ',', ' '); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($value['expense_requested_by']); ?></td> 
                                                <td class="text-uppercase">
                                                <?= ($value['expense_approved_by']); ?></td>
                                                <td> <span
                                                        class="badge  <?= ($status == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= ($status == 'actif') ? 'Executée':'Annulée'; ?> </span>
                                                
                                            </td>
                                            <td><?= ($value['expense_notes']); ?></td>
                                            
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="cancel_<?= $value['expense_id']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title d-inline-flex font-weight-bold text-uppercase">
                                                            Annulation d'une dépense
                                                        </h4>
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
                                                        echo form_open(base_url('cashbox-cancel-expense/' . $value['expense_id']), $attributes);
                                                        ?>
                                                    <div class="modal-body">
                                                        <div class="row"> 
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-floating">
                                                                    <textarea name="notes" id="notes" cols="30" rows="10"
                                                                        placeholder="Dites pourquoi vous voulez annuler cette sortie"
                                                                        class="form-control" required><?= old('notes');?></textarea>
                                                                    <?php if ($validation->hasError('notes')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('notes'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="notes"><span
                                                                            class="text-danger">*</span>Motif d'annulation</label>
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
                                                            Valider l'annulation
                                                        </button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end update year modal -->
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $value['expense_id']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4
                                                            class="modal-title d-inline-flex font-weight-bold text-uppercase">
                                                            Modification decaissement</h4>
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
                                                        echo form_open(base_url('cashbox-update-expense/' . $value['expense_id']), $attributes);
                                                        ?>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="cashbox_currency" id="cashbox_currency" value="<?= $currency_cashbox; ?>" readonly />
                                                    <input type="hidden" name="cashboxid" id="cashboxid" value="<?= $value['expense_cashbox_id']; ?>" readonly />
                        
                                                        <div class="row">                      
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating  mb-2">
                                                                    <input class="form-control text-left float-left"
                                                                        type="text" name="expense_amount"
                                                                        id="expense_amount"
                                                                        value="<?= $amount_expense; ?>" data-mask
                                                                        data-inputmask="'alias': 'currency', 'prefix':'<?= $expense_input_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                                                        style="text-align: left!important;" autofocus />
                                                                    <?php if ($validation->hasError('expense_amount')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('expense_amount'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="expense_amount" class="control-label">
                                                                        <span class="text-danger">*</span>Montant
                                                                        sollicité

                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">

                                                                    <input type="text" class="form-control"
                                                                        name="requested_by" id="requested_by"
                                                                        value="<?= $value['expense_requested_by']; ?>"
                                                                        placeholder="Ex: Agent Mumba" />
                                                                    <?php if ($validation->hasError('requested_by')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('requested_by'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="requested_by" class="control-label">
                                                                        <span class="text-danger">*</span>Bénéficiaire
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">

                                                                    <input type="text" class="form-control"
                                                                        name="approved_by" id="approved_by"
                                                                        value="<?= $value['expense_approved_by']; ?>"
                                                                        placeholder="Ex: Manager Mumba" />
                                                                    <?php if ($validation->hasError('approved_by')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('approved_by'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="approved_by" class="control-label">
                                                                        <span class="text-danger">*</span>Approbateur
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-floating">

                                                                    <textarea name="notes" id="notes" cols="30" rows="3"
                                                                        placeholder="Ex: Achat carburant"
                                                                        class="form-control"><?= $value['expense_notes'];?></textarea>
                                                                    <?php if ($validation->hasError('notes')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('notes'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="notes"><span
                                                                            class="text-danger">*</span>Motif
                                                                        décaissemement</label>
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
                                        <?php endif; ?>
                                        <?php } ?>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <?php endif; ?>
    <?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="text-uppercase font-weight-bold text-danger">
                            Vous n'avez aucune caisse configurée pour décaisser des fonds
                        </h5>
                        <a href="<?= base_url('finances/cashbox'); ?>" class="btn btn-info">Configurer la caisse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>