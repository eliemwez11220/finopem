<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('expenses'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-lg-6">
                    <div class="shadow-sm">
                        <form role="form" id="ajax_form_sections" method="get">
                            <div class="form-floating input-group" style="width: 100%!important;">
                                <select id="ajax_sections" name="ajax_sections" title="Classe"
                                    class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                    <option disabled selected>--sélectionnez une section--</option>
                                    <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                        <option value="all">Toutes les sections</option>
                                    <?php endif; ?>
                                    <?php
                                    $sections_listing = [];
                                    if (session()->has('usersbranchs')) {
                                        if (session()->get('usersbranchs') == 'none') {
                                            $sparents_listing = [];
                                        } else {
                                            $sections_listing = session()->usersbranchs;
                                        }
                                    } else {
                                        if (isset($sections)) {
                                            $sections_listing = $sections;
                                        }
                                    }

                                    if ((!empty($sections_listing))):
                                        foreach ($sections_listing as $key => $value): ?>
                                            <option value="<?= trim($value['section_id']); ?>"
                                                <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('ajax_sections', trim($value['section_id'])); ?>>
                                                <?= strtoupper(trim($value['section_name'])); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="ajax_sections">
                                    <span class="text-danger">*</span>Sections organisées</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Gestion financière</li>
                        <li class="breadcrumb-item active">Prélèvements</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <?php  if (session()->has('choosedsectionid')):  ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12">
                    <blockquote class="py-5">
                        <h1 class="font-weight-bold text-uppercase lined lined-center">
                            <i class="nav-icon fas fa-donate"></i> Sortie de fonds
                        </h1>

                        <form role="form" id="form_cashbox" method="get">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="form-floating">
                                        <select id="ajax_fees_paid" name="ajax_fees_paid" title="Frais"
                                            class="form-control select2 select2-info text-uppercase font-weight-bold"
                                            data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- Sélectionnez le frais-- </option>
                                            
                                            <?php if (isset($feesclasses) && !empty($feesclasses)):
                                                foreach ($feesclasses as $keyfee => $fee): 
                                                    $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                                    if (($branch_access == $fee['section_id']) or (session()->admin == TRUE) or (session()->all == TRUE)):
                    
                                                ?>
                                            <option value="<?= esc($fee['fee_id']); ?>"
                                                <?= (session()->has(key: 'feechoosed') && (session()->feechoosed == $fee['fee_id'])) ? 'selected' : set_select('ajax_fees_paid', esc($fee['fee_id'])); ?>>
                                                <?= strtoupper($fee['fee_name']); ?>
                                                - Payable en <?= strtoupper($fee['fee_currency_payable']); ?>
                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="ajax_fees_paid">
                                            <span class="text-danger">*</span>Frais concernés
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </blockquote>
                </div>
                <!-- left column -->
                <div class="col-lg-6 col-sm-12">
                    <?php if (session()->has('feepaidchoosed')) : ?>
                        
                    <?php

                    $cashboxfee = session()->feepaidchoosed;
                    $fee_name = $cashboxfee['fee_name'];
                    $fee_id = $cashboxfee['fee_id'];
                    $cashbox_debit = 0;
                    $cashbox_credit = 0;
                    $cashbox_balance = 0;
                    $input_alias_prefix = ($cashboxfee['fee_currency_payable'] == 'usd') ? '$':'Fc';
                    $fee_currency = trim($cashboxfee['fee_currency_payable']);
                    $currency_amount = ($fee_currency  == 'usd') ? 'USD':'CDF';

                    $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                
                    ?>

                   <!-- ==== GET ALL PAYMENTS -->
                    <?php $fee_paid_amount = 0;
                    if (isset($feespayments) && !empty($feespayments)){
                        foreach ($feespayments as $keypaid => $paidvalue){
                            if($paidvalue['payment_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                if ($branch_access == $paidvalue['section_id']){

                                $fee_paid_amount += floatval($paidvalue['paydetails_paid_amount']);
                            ?>

                    <?php }}}} ?>
                        <!-- ==== GET ALL PAYMENTS -->
                    <?php 
                    $usd_expense_amount = 0;
                    $cdf_expense_amount = 0;
                    $expense_amount = 0;
                    if (isset($feesexpenses) && !empty($feesexpenses)){
                        foreach ($feesexpenses as $keyfeesexpense => $feeexpense){
                            if($feeexpense['expense_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                if ($branch_access == $feeexpense['expense_section_id']){
                                if($feeexpense['expense_type'] == 'expense'){

                                $usd_expense_amount = floatval($feeexpense['expense_usd_amount']);
                                $cdf_expense_amount = floatval($feeexpense['expense_cdf_amount']);
                                $expense_exchange = floatval($feeexpense['expense_exchange']);

                                $expense_amount += ($fee_currency  == 'usd') ? $usd_expense_amount:$cdf_expense_amount;

                            ?>

                    <?php }}}}} ?>
                    <?php 
                    
                    $cashbox_credit = $fee_paid_amount;
                    $cashbox_debit = $expense_amount;
                    $cashbox_balance = $fee_paid_amount - $expense_amount;
                    ?>

                
                <?php
                    if($cashbox_balance > 0):
                        //form validation manager
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('cashbox-create-expense'), $attributes);
                        ?>
                    <div class="card">
                        <input type="hidden" name="cashbox_currency" id="cashbox_currency"
                            value="<?= $fee_currency; ?>" readonly />
                        <input type="hidden" name="cashboxid" id="cashboxid" value="<?= $fee_id; ?>" readonly />
                        <div class="card-header">
                            <div class="row">

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating  mb-2">
                                        <input class="form-control text-left float-left" type="text"
                                            name="cashbox_available_amount" id="cashbox_available_amount"
                                            value="<?= trim($cashbox_balance); ?>" data-mask
                                            data-inputmask="'alias': 'currency', 'prefix':'<?= $input_alias_prefix; ?> ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                            style="text-align: left!important;" readonly />

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
                                            <span class="text-danger">*</span>Montant a décaisser en
                                            <?= $currency_amount; ?>

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
                            <h3 class="text-center">
                                Oops ! Le solde de la caisse que vous avez choisi est de
                                <span class="text-danger">0.00</span> veuillez percevoir davanatage.
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
    <?php if (isset($feesexpenses) && !empty($feesexpenses)):?>
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
                                            <th>Montant</th>
                                            <th>Bénéficiaire</th>
                                            <th>Approbateur</th>
                                            <th>Statut</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $section_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                     
                                            foreach ($feesexpenses as $key => $value): 
                                                if($value['expense_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                            $status = trim($value['expense_status']);
                                            if ($section_access == $value['expense_section_id']){
                                            if($value['expense_type'] == 'expense'):
                                            $echange = floatval($value['expense_exchange']);
                                            $mnt_sorti_usd = floatval($value['expense_usd_amount']);
                                            $mnt_sorti_cdf = floatval($value['expense_cdf_amount']);
                                            $currency_cashbox = trim($value['fee_currency_payable']);
                                            
                                            $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_cdf;
                                            $expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';
                                            
                                                ?>
                                        <tr class="small">
                                            <td width="1px" class="text-center">
                                                <?php if($status == 'cancel'): ?>
                                                <a href=" <?= base_url('finances/remove/expense/' . $value['expense_id']); ?>"
                                                    class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Voulez-vous vraiment annuler cette operation?');">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer definitivement cette sortie">
                                                        <i class="fa fa-trash fa-lg"></i> Supprimer</span>
                                                </a>
                                                <?php else: ?>
                                                <a data-toggle="modal"
                                                    data-target="#update_<?= $value['expense_id']; ?>" href="#"
                                                    class="btn btn-xs btn-outline-warning d-none <?= ($value['expense_date'] == date('Y-m-d')) ? '':'disabled'; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>

                                                <a data-toggle="modal"
                                                    data-target="#cancel_<?= $value['expense_id']; ?>" href="#"
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
                                            <td><?= trim($value['expense_created_at']); ?></td>
                                            <td class="text-uppercase"><?= trim($value['fee_name']); ?></td>

                                            <td class="text-uppercase font-weight-bold">
                                                <?= number_format($amount_expense, 2, ',', ' '); ?>
                                           
                                                <?= $currency_cashbox; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['expense_requested_by']); ?></td>
                                            <td class="text-uppercase">
                                                <?= trim($value['expense_approved_by']); ?></td>
                                            <td> <span
                                                    class="badge  <?= ($status == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                    <?= ($status == 'actif') ? 'Executée':'Annulée'; ?> </span>

                                            </td>
                                            <td><?= trim($value['expense_notes']); ?></td>

                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="cancel_<?= $value['expense_id']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4
                                                            class="modal-title d-inline-flex font-weight-bold text-uppercase">
                                                            Annulation Décaissement 
                                                            
                                                            <span class="text-uppercase font-weight-bold small text-danger">
                                                            <?= trim($value['fee_name']); ?>  <br>
                                                            <?= number_format($amount_expense, 2, ',', ' '); ?>
                                                        
                                                                <?= $currency_cashbox; ?>
                                                            </span>
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
                                                    <input type="hidden" name="currency" id="currency" value="<?= $fee_currency; ?>" readonly />
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                <div class="form-floating">
                                                                    <textarea name="notes" id="notes" cols="30"
                                                                        rows="10"
                                                                        placeholder="Dites pourquoi vous voulez annuler cette sortie"
                                                                        class="form-control"
                                                                        required><?= old('notes');?></textarea>
                                                                    <?php if ($validation->hasError('notes')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('notes'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="notes"><span
                                                                            class="text-danger">*</span>Motif
                                                                        d'annulation</label>
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
                                        <?php }} ?>
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
    <?php endif; ?>
</div>