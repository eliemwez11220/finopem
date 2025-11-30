<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Gestion des opérations caisses</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Gestion Financiere</li>
                        <li class="breadcrumb-item active">Opérations caisses</li>
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
                            <i class="nav-icon fas fa-donate"></i> Fonctionnement
                        </h1>
                        <p class="font-weight-bold h5 text-center">
                            Sélectionner une caisse pour effectuer des opérations
                        </p>

                        <form role="form" id="form_cashbox" method="get">
                        <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating mb-2">
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
                                <label for="cashbox_id"><span class="text-danger">*</span>Classe</label>
                            </div>
                            </div>
                            </div>
                        </form>
                        <?php if (session()->has('cashboxdata')) : ?>
                        <form role="form" id="form_cashbox_type" method="get">
                            <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <select name="cashboxoperation" id="cashboxoperation" class="form-control">
                                            <option disabled selected>choisissez un type opération</option>
                                            <option value="exchange" <?= (session()->has('cashboxoperation') && (session()->get('cashboxoperation') == 'exchange')) ? 'selected': set_select('operation', 'exchange'); ?>>
                                                Echange de monnaie
                                            </option>
                                            <option value="returning" <?= (session()->has('cashboxoperation') && (session()->get('cashboxoperation') == 'returning')) ? 'selected': set_select('operation', 'returning'); ?>>
                                                Remboursement
                                            </option>
                                        </select>
                                        <label for="notes"><span class="text-danger">*</span>Type d'opération</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-lg-6 col-sm-12">
                    <?php if (session()->has('cashboxdata') && session()->has('cashboxoperation')) : ?>
                    <?php

                    $cashboxdata = session()->cashboxdata;
                    $cashbox_id = $cashboxdata['cashbox_id'];
                    $cashbox_debit = $cashboxdata['cashbox_debit_amount'];
                    $cashbox_credit = $cashboxdata['cashbox_credit_amount'];
                    $cashbox_balance = (session()->cashboxavailable) ? session()->cashboxavailable: $cashbox_credit - $cashbox_debit;
                    $input_alias_prefix = ($cashboxdata['cashbox_currency'] == 'usd') ? '$':'Fc';
                    
                    $debit_prefix = ($cashboxdata['cashbox_currency'] == 'usd') ? '$':'Fc';
                    $credit_prefix = ($cashboxdata['cashbox_currency'] == 'usd') ? 'Fc':'$';
                    $currency_credit = ($cashboxdata['cashbox_currency'] == 'usd') ? 'USD':'CDF';
                    $currency_debit = ($cashboxdata['cashbox_currency'] == 'usd') ? 'CDF':'USD';

                    if($cashbox_balance != 0):
                        //form validation manager
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('cashbox-create-operation'), $attributes);
                        ?>
                    <div class="card">
                        <input type="hidden" name="cashbox_currency" id="cashbox_currency"
                            value="<?= ($cashboxdata['cashbox_currency']); ?>" readonly />
                        <input type="hidden" name="cashboxid" id="cashboxid" value="<?= $cashbox_id; ?>" readonly />
                        <input type="hidden" name="operation" id="operation" value="<?= session()->get('cashboxoperation'); ?>" readonly />
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
                                        <input class="form-control text-left float-left" type="text" name="debit_amount"
                                            id="debit_amount" value="<?= old('debit_amount'); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $debit_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" autofocus />
                                        <?php if ($validation->hasError('debit_amount')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('debit_amount'); ?></span>
                                        <?php } ?>
                                        <label for="debit_amount" class="control-label">
                                            <span class="text-danger">*</span>Montant de sortie en <?= $currency_credit; ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <input class="form-control text-left float-left" type="text"
                                            name="credit_amount" id="credit_amount" value="<?= old('credit_amount'); ?>"
                                            data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $credit_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" <?= (session()->get('cashboxoperation') == 'exchange') ? 'required':''; ?> />
                                        <?php if ($validation->hasError('credit_amount')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('credit_amount'); ?></span>
                                        <?php } ?>
                                        <label for="credit_amount" class="control-label font-weight-bold">
                                            <span class="text-danger"><?= (session()->get('cashboxoperation') == 'exchange') ? '*':''; ?>
                                            </span>Montant d'entrée en <?= $currency_debit; ?>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-floating">

                                        <textarea name="notes" id="notes" cols="30" rows="3"
                                            placeholder="Ex: Changement dollars"
                                            class="form-control"><?= old('notes');?></textarea>
                                        <?php if ($validation->hasError('notes')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('notes'); ?></span>
                                        <?php } ?>
                                        <label for="notes"><span class="text-danger"></span>Notes interne sur
                                            l'opération</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-tools float-right mt-3">
                                <button type="submit" class="btn btn-primary btn-rounded text-uppercase">
                                    <i class="fa fa-check-circle"></i> Valider l'opération
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                    <?php else: ?>
                    <blockquote class="py-5">
                        <div class="alert alert-primary">
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
                        <div class="card-header bg-primary text-center">
                            <h3 class="font-weight-bold text-uppercase">
                                Opérations caisses effectuées</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">
                                        <th width="1px">Actions</th>
                                            <th>Date</th>
                                            <th>Caisse</th>
                                            <th>USD</th>
                                            <th>CDF</th>
                                            <th>Type</th>
                                            <th>Catégorie</th>
                                            <th>Etat</th>
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

                                            if($value['expense_type'] == 'returning' OR $value['expense_type'] == 'exchange'):
                                            ?>
                                        <tr class="small">
                                            <td width="1px" class="text-center">
                                                <?php if($status == 'cancel'): ?>
                                                    <a href=" <?= base_url('finances/remove/expense/' . $value['expense_id']); ?>"
                                                        class="btn btn-xs btn-danger" onclick="return confirm('Voulez-vous vraiment annuler cette operation?');">
                                                        <span data-toggle="tooltip" data-placement="top"
                                                            title="Cliquer pour supprimer definitivement cette operation">
                                                            <i class="fa fa-trash fa-lg"></i> Supprimer</span>
                                                    </a>
                                                <?php else: ?>
                                                    <a data-toggle="modal" data-target="#cancel_<?= $value['expense_id']; ?>" href="#"
                                                    class="btn btn-xs btn-outline-danger <?= ($value['expense_date'] == date('Y-m-d')) ? '':'disabled'; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour annuler cette information">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
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

                                            <td class="text-uppercase"><?= setExpenseType($value['expense_type']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= setExpenseCategory($value['expense_category']); ?></td>

                                            <td>
                                                <span
                                                    class="badge  badge-<?= setStatusColors($status); ?> text-capitalize">
                                                    <?= ($status == 'cancel') ? 'Annulée' : 'Exécutée'; ?></span>

                                            </td>
                                            <td><?= ($value['expense_notes']); ?></td>

                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $value['expense_id']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4
                                                            class="modal-title d-inline-flex font-weight-bold text-uppercase">
                                                            Annulation d'une opération
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
                                                                    <textarea name="notes" id="notes" cols="30"
                                                                        rows="10"
                                                                        placeholder="Dites pourquoi vous voulez annuler"
                                                                        class="form-control"
                                                                        required><?= old('notes');?></textarea>
                                                                    <?php if ($validation->hasError('notes')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('notes'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="notes"><span
                                                                            class="text-danger">*</span>Motif
                                                                        d'Annulation</label>
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