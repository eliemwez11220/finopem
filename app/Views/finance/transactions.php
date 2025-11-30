<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('transactions'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="text-uppercase font-weight-bold">Gestion des Transactions bancaires</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Gestion Financière</li>
                                <li class="breadcrumb-item active">Transactions bancaires</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(isset($cashbox) && (!empty($cashbox))):?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <blockquote class="py-5  border-success">
                        <h1 class="font-weight-bold text-uppercase text-success lined lined-center">
                            <i class="nav-icon fas fa-donate"></i> Transactions bancaires <i
                                class="nav-icon fas fa-donate"></i>
                        </h1>
                        <p>
                            Effectuer vos transactions de la caisse vers le compte bancaire et vice-versa 
                        </p>

                        <form role="form" id="form_cashbox" method="get">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                    <div class="form-floating">
                                        <select name="cashbox_id" id="cashbox_id" class="form-control">
                                            <option disabled selected>Choisissez une caisse</option>
                                            <?php if (isset($cashbox) && (!empty(($cashbox)))):
                                        foreach ($cashbox as $key => $value) : ?>
                                            <option value="<?= esc($value['cashbox_currency']); ?>"
                                                <?= (session()->cashboxchoosed && (session()->cashboxchoosed == $value['cashbox_currency']))?'selected':set_select('cashbox_id', esc($value['cashbox_currency'])); ?>>
                                                <?= strtoupper($value['cashbox_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="cashbox_id"><span class="text-danger">*</span>Caisse d'opération</label>
                                    </div>
                                </div>
                                <?php if(session()->cashboxchoosed) : ?>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <select name="bank_id" id="bank_id" class="form-control">
                                            <option disabled selected>choisissez un compte bancaire</option>
                                            <?php if (isset($banks) && (!empty(($banks)))):
                                                foreach ($banks as $keybank => $bankvalue) : 
                                                
                                                ?>
                                            <option value="<?= ($bankvalue['bank_id']); ?>"
                                                <?= (session()->bankchoosed && (session()->bankchoosed == $bankvalue['bank_id']))?'selected':set_select('bank_id', ($bankvalue['bank_id'])); ?>>
                                                <?= strtoupper($bankvalue['bank_account_number']); ?>
                                                (<?= strtoupper($bankvalue['bank_account_currency']); ?>)
                                                 - <?= strtoupper($bankvalue['bank_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="bank_id"><span class="text-danger">*</span>Banque
                                            d'opération</label>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </form>
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-lg-6 col-sm-12">
                    <?php if (isset(session()->cashboxdata) && (session()->bankdata)) : ?>
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


                    
                    $bankaccount = session()->bankdata;
                    $bankaccount_id = $bankaccount['bank_id'];
                    $bankaccount_debit = $bankaccount['bank_debit_amount'];
                    $bankaccount_credit = $bankaccount['bank_credit_amount'];
                    $bank_balance = (session()->bankbalance) ? session()->bankbalance: $bankaccount_credit - $bankaccount_debit;
                    $bank_alias_prefix = ($bankaccount['bank_account_currency'] == 'usd') ? '$':'Fc';
                    
                        //form validation manager
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open_multipart(base_url('bank-create-transaction'), $attributes);
                        ?>
                    <div class="card">
                        <input type="hidden" name="transaction_currency" id="transaction_currency" value="<?= ($cashboxdata['cashbox_currency']); ?>" readonly />

                        <input type="hidden" name="cashboxid" id="cashboxid" value="<?= $cashbox_id; ?>" readonly />
                        <input type="hidden" name="bankid" id="bankid" value="<?= $bankaccount_id; ?>" readonly />
                        
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                        <input class="form-control text-left float-left" type="text"
                                            name="cashbox_available_amount" id="cashbox_available_amount"
                                            value="<?= ($cashbox_balance); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $input_alias_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" disabled readonly />

                                        <label for="cashbox_available_amount" class="control-label text-uppercase">
                                            <span class="text-danger">*</span>Solde caisse <?= $cashboxdata['cashbox_currency']; ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                        <input class="form-control text-left float-left " type="text"
                                            name="bank_balance_amount" id="bank_balance_amount"
                                            value="<?= ($bank_balance); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $bank_alias_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" disabled readonly />

                                        <label for="bank_balance_amount" class="control-label text-uppercase">
                                            <span class="text-danger">*</span>Solde Banque <?= $bankaccount['bank_account_currency']; ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                        <input class="form-control text-left float-left" type="text" name="transaction_amount"
                                            id="transaction_amount" value="<?= old('transaction_amount'); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $debit_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" autofocus />
                                        <?php if ($validation->hasError('transaction_amount')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('transaction_amount'); ?></span>
                                        <?php } ?>
                                        <label for="transaction_amount" class="control-label">
                                            <span class="text-danger">*</span>Montant Transaction en <?= $currency_credit; ?>

                                        </label>
                                    </div>
                                </div>
                  
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">
                                        <select name="transaction" id="transaction" class="form-control">
                                            <option disabled selected>Choisissez un type</option>
                                            <option value="cashbox" <?= set_select('transaction', 'cashbox'); ?>>
                                                Caisse vers Banque
                                            </option>
                                            <option value="bank" <?= set_select('transaction', 'bank'); ?>>
                                                Banque vers caisse
                                            </option>
                                        </select>
                                        <label for="transaction">
                                            <span class="text-danger">*</span>Type de Transaction</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                    <?php if(session()->has('slipfile')){?>

                                        <input type="text" value="<?= session()->get('slipfile'); ?>" class="form-control" disabled>
                                    <?php } ?>
                                        <input class="form-control" type="file" name="slip"
                                            id="slip" value="<?= old('slip'); ?>" accept=".pdf, .jpg, .png" />
                                        <?php if ($validation->hasError('slip')) { ?>
                                        <span class="invalid-feedback text-danger">
                                            <?= $validation->getError('slip'); ?></span>
                                        <?php } ?>
                                        <label for="slip" class="control-label">
                                            <span class="text-danger">*</span>Piece comptable(Bordereau ou Bon de caisse)

                                        </label>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-floating">

                                        <textarea name="notes" id="notes" cols="30" rows="3"
                                            placeholder="Ex: Depot d'especes"
                                            class="form-control"><?= old('notes');?></textarea>
                                        <?php if ($validation->hasError('notes')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('notes'); ?></span>
                                        <?php } ?>
                                        <label for="notes"><span class="text-danger"></span>Notes interne sur
                                            la transaction </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-tools float-right mt-3">
                                <button type="submit" class="btn btn-success btn-rounded text-uppercase">
                                    <i class="fa fa-check-circle"></i> Valider la transaction
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .content -->
    </section>
    <!-- Main content -->
    <?php if (isset($transactions) && !empty($transactions)):?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-center">
                            <h3 class="font-weight-bold text-uppercase">
                                Transactions
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">
                                            <th width="1px">Actions</th>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Caisse</th>
                                            <th>Banque</th>
                                            <th>Montant</th>
                                            <th>Type</th>
                                            <th>Etat</th>
                                            <th>Notes</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                            foreach ($transactions as $keytr => $transaction): 
                                                if($transaction['transaction_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                            $status = ($transaction['transaction_status']);
                                            $transaction_amount = ($transaction['transaction_amount']);
                                            $currency = ($transaction['transaction_currency']);
                                            
                                            ?>
                                        <tr class="small">
                                            <td width="1px" class="text-center">
                                                <?php if($status == 'cancel'): ?>
                                                <a href=" <?= base_url('finances/remove/transaction/' . $transaction['transaction_id']); ?>"
                                                    class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Voulez-vous vraiment annuler cette transaction?');">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer cette transaction">
                                                        <i class="fa fa-trash fa-lg"></i> Supprimer</span>
                                                </a>
                                                <?php else: ?>
                                                <a data-toggle="modal"
                                                    data-target="#update_<?= $transaction['transaction_id']; ?>" href="#"
                                                    class="btn btn-xs btn-outline-dark  <?= ($status == 'cancel') ? 'disabled' : ''; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour annuler cette transaction">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                                <a data-toggle="modal"
                                                    data-target="#details_<?= $transaction['transaction_id']; ?>" href="#"
                                                    class="btn btn-xs btn-info">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour voir les details cette transaction">
                                                        <i class="fa fa-info-circle fa-2x"></i></span>
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= ($transaction['transaction_created_at']); ?></td>
                                            <td class="text-uppercase"><?= ($transaction['transaction_code']); ?></td>
                                            <td class="text-uppercase"><?= ($transaction['cashbox_name']); ?></td>
                                            <td class="text-uppercase">
                                                <?= ($transaction['bank_account_number']); ?> -
                                                <?= ($transaction['bank_name']); ?>
                                            </td>

                                            <td class="text-uppercase">
                                                <?= number_format(($transaction_amount), 2, ',', ' '). ' '.$currency; ?>
                                            </td>

                                            <td class="text-uppercase">
                                                <?= ($transaction['transaction_type'] == 'cashbox') ? 'Caisse vers Banque': 'Banque vers Caisse'; ?>
                                            </td>
                                            
                                            <td>
                                                <span
                                                    class="badge  badge-<?= setStatusColors($status); ?> text-capitalize">
                                                    <?= ($status == 'cancel') ? 'Annulée' : 'Exécutée'; ?></span>

                                            </td>
                                            <td><?= ($transaction['transaction_notes']); ?></td>

                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $transaction['transaction_id']; ?>">
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
                                                        echo form_open(base_url('bank-cancel-transaction/' . $transaction['transaction_id']), $attributes);
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
                                                                        d'annulation de la transaction</label>
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
                                        <!-- details year modal -->
                                        <div class="modal fade" id="details_<?= $transaction['transaction_id']; ?>">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4
                                                            class="modal-title d-inline-flex font-weight-bold text-uppercase">
                                                            Détails transaction ID:<?= $transaction['transaction_code']; ?>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">
                                                                <i class="fa fa-window-close"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="text-center">
                                                                <embed src="<?= base_url('public/uploads/files/'.$transaction['transaction_attachment']); ?>" type="application/pdf" controls width="500" height="500">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Fermer
                                                        </button>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end details year modal -->
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