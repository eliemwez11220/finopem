<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <div class="card-body">
                <?php
                $request = \Config\Services::request();
                //$start = $request->getGet('startdate');
                //$end = $request->getGet('enddate');
                
                $validation = \Config\Services::validation();
                $form_attrib = array(
                    'role' => "form",
                    'id' => "reporting_filter_data",
                    'method' => "get"
                );
                ?>
                <?= form_open(base_url('reporting/filter/cashflow'), $form_attrib); ?>
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="form-group mb-2">
                            <label for="start_date"><span class="text-danger">*</span>Date début</label>
                            <input type="date"
                                class="form-control <?= ($validation->hasError('start_date')) ? ' is-invalid' : '' ?>"
                                id="start_date" name="startdate" aria-describedby="start_date" required
                                value="<?= (!empty($start)) ? $start : set_value('start_date'); ?>" />

                            <div id="start_date" class="form-text">
                                <span class="text-danger"><?= displayFormError($validation, 'start_date'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="form-group mb-2">
                            <label for="end_date"><span class="text-danger">*</span>Date fin</label>
                            <div class="input-group">
                                <input type="date"
                                    class="form-control <?= ($validation->hasError('end_date')) ? ' is-invalid' : '' ?>"
                                    id="end_date" placeholder="Patient" name="enddate" aria-describedby="end_date"
                                    required value="<?= (!empty($end)) ? $end : set_value('end_date'); ?>" />


                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info text-uppercase"
                                        title="Bouton de recherche">
                                        <i class="fa fa-search"></i> valider
                                    </button>
                                </div>
                            </div>
                            <div id="end_date" class="form-text">
                                <span class="text-danger"><?= displayFormError($validation, 'end_date'); ?></span>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-3">
                        <div class="form-floating">
                            <select id="user_id" name="user_id"
                                class="form-control <?php if ($validation->hasError('user_id')) {
                                    echo 'is-invalid';
                                } ?>">
                                <option selected disabled>--sélectionnez agent--</option>
                                <?php if (isset($users) && !empty($users)):
                                    foreach ($users as $userkey => $uservalue): ?>
                                        <option value="<?= ($uservalue['user_id']); ?>" <?= set_select('user_id', ($uservalue['user_id'])); ?>>
                                            <?= strtoupper($uservalue['user_firstname']); ?>
                                            <?= strtoupper($uservalue['user_lastname']); ?>
                                            (<?= strtoupper($uservalue['user_name']); ?>) -
                                            [<?= strtoupper($uservalue['role_name']); ?>]
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </select>
                            <label for="user_id" class="control-label">
                                <span class="text-danger">*</span>Utilisateur
                            </label><?php if (isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'user_id'); ?>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php if (isset($payments) && !empty($payments)): ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="font-weight-bold text-uppercase py-3" style="border:2px solid black">
                                Trésorerie
                            </h1>
                        </div>

                        <?php
                        $total_cash_usd = 0;
                        $total_cash_cdf = 0;
                        $count = 1;
                        $montant_total_cdf = 0;
                        $montant_total_usd = 0;
                        $montant_total_solde = 0;
                        $amount_returned_usd = 0;
                        $amount_returned_cdf = 0;
                        $total_amount_paid = 0;
                        $total_amount_payable = 0;
                        $total_amount_balance = 0;
                        $amount_paid_usd = 0;
                        $amount_paid_cdf = 0;
                        foreach ($payments as $payment) {
                            $currency = $payment['fee_currency_payable'];
                            $currency_paid = ($currency == 'usd') ? '$' : 'Fc';
                            $pay_token = $payment['paydetails_token'];
                            $pay_amount = $payment['paydetails_paid_amount'];
                            $pay_usd_amount = $payment['paydetails_usd_amount'];
                            $pay_cdf_amount = $payment['paydetails_cdf_amount'];

                            $pay_returned_amount = $payment['paydetails_return_amount'];

                            $pay_exchange = $payment['payment_exchange'];


                            $notes = $payment['payment_notes'];
                            $status = (!empty(($payment['paydetails_status'])) ? ($payment['paydetails_status']) : 'inactif');

                            $total_amount_usd = ($pay_usd_amount != 0) ? $pay_usd_amount + ($pay_cdf_amount / $pay_exchange) : 0;
                            $total_amount_cdf = ($pay_usd_amount != 0) ? $pay_cdf_amount + ($pay_usd_amount * $pay_exchange) : 0;

                            $balance_amount = $pay_returned_amount;
                            $balance_currency = ($currency == 'usd') ? '$' : 'Fc';
                            $montant_total_cdf += $pay_cdf_amount;
                            $montant_total_usd += $pay_usd_amount;

                            $amount_paid_usd += ($currency == 'usd') ? $pay_amount : 0;
                            $amount_paid_cdf += ($currency == 'cdf') ? $pay_amount : 0;

                            $amount_returned_cdf += ($currency == 'cdf') ? $pay_returned_amount : 0;
                            $amount_returned_usd += ($currency == 'usd') ? $pay_returned_amount : 0;
                            $total_amount_paid += $pay_amount;
                            $montant_total_solde = ($montant_total_usd * $pay_exchange) + $montant_total_cdf;

                            $total_cash_usd = $montant_total_usd;
                            $total_cash_cdf = $montant_total_cdf;
                            ?>

                        <?php } ?>



                        <?php if (isset($expenses) && !empty($expenses)):
                            $total_cashbox_balance_usd = 0;
                            $total_cashbox_balance_cdf = 0;

                            /* ================== GET ALL EXPENSES ======*/
                            $count = 1;
                            $total_expense_cdf = 0;
                            $total_expense_usd = 0;
                            foreach ($expenses as $keyexpense => $expense):
                                if ($expense['expense_type'] == 'expense'):
                                    $status = ($expense['expense_status']);
                                    $echange = ($expense['expense_exchange']);
                                    $mnt_sorti_usd = ($expense['expense_usd_amount']);
                                    $mnt_sorti_cdf = ($expense['expense_cdf_amount']);
                                    $currency_cashbox = ($expense['cashbox_currency']);

                                    $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                    $expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';
                                    $total_expense_cdf += $mnt_sorti_cdf;
                                    $total_expense_usd += $mnt_sorti_usd;

                                endif;
                            endforeach;

                            /*=================== RETURNING MONEY ============*/
                            $count = 1;
                            $total_operation_usd = 0;
                            $total_operation_cdf = 0;
                            foreach ($expenses as $key => $value):
                                if ($value['expense_type'] == 'returning'):

                                    $status = ($value['expense_status']);
                                    $echange = ($value['expense_exchange']);
                                    $mnt_sorti_usd = ($value['expense_usd_amount']);
                                    $mnt_sorti_cdf = ($value['expense_cdf_amount']);
                                    $currency_cashbox = ($value['cashbox_currency']);

                                    $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                    $expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';

                                    $total_operation_usd += $mnt_sorti_usd;
                                    $total_operation_cdf += $mnt_sorti_cdf;
                                endif;
                            endforeach;
                            //=============== CHANGE MONEY ============= */
                            $count = 1;
                            $total_change_usd_in = 0;
                            $total_change_usd_out = 0;
                            $total_change_cdf_in = 0;
                            $total_change_cdf_out = 0;

                            foreach ($expenses as $keychange => $change):
                                if ($change['expense_type'] == 'exchange'):

                                    $change_echange = ($change['expense_exchange']);
                                    $change_usd = ($change['expense_usd_amount']);
                                    $change_cdf = ($change['expense_cdf_amount']);
                                    $currency_cashbox = ($change['cashbox_currency']);

                                    $total_change_usd_in += ($change['expense_category'] == 'usdin') ? $change_usd : 0;
                                    $total_change_usd_out += ($change['expense_category'] == 'usdout') ? $change_usd : 0;

                                    $total_change_cdf_in += ($change['expense_category'] == 'usdout') ? $change_cdf : 0;
                                    $total_change_cdf_out += ($change['expense_category'] == 'usdin') ? $change_cdf : 0;

                                endif;
                            endforeach;
                            ?>




                            <div class="table-responsive">
                                <table id="datatablesReportingActions1"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th class="text-center">#</th>
                                            <th class="text-right">Désignation</th>
                                            <th>TOTAL USD</th>
                                            <th>TOTAL CDF</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $total_amount_revenue_usd = $total_cash_usd + $total_change_usd_in;
                                        $total_amount_revenue_cdf = $total_cash_cdf + $total_change_cdf_in;

                                        $total_amount_expenses_usd = $total_expense_usd + $total_operation_usd + $total_change_usd_out;
                                        $total_amount_expenses_cdf = $total_expense_cdf + $total_operation_cdf + $total_change_cdf_out;

                                        $total_cashbox_balance_usd = $total_amount_revenue_usd - $total_amount_expenses_usd;
                                        $total_cashbox_balance_cdf = $total_amount_revenue_cdf - $total_amount_expenses_cdf; ?>

                                        <tr class="text-dark small">
                                            <td class="text-center">
                                                <b>1.</b>
                                            </td>
                                            <td class="text-right">
                                                <b>Perception Frais</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_cash_usd, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_cash_cdf, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="text-dark small">
                                            <td class="text-center">
                                                <b>2.</b>
                                            </td>
                                            <td class="text-right">
                                                <b>Echange monnaie</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_change_usd_in, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_change_cdf_in, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="bg-secondary text-white">
                                            <td class="text-center">
                                                <b>I.</b>
                                            </td>
                                            <td class="text-uppercase text-right">
                                                <b>Total Entrées</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_amount_revenue_usd, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_amount_revenue_cdf, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="text-dark small">
                                            <td class="text-center">
                                                <b>4.</b>
                                            </td>
                                            <td class="text-right">
                                                <b>Dépenses gestion</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_expense_usd, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_expense_cdf, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="text-dark small">
                                            <td class="text-center">
                                                <b>5.</b>
                                            </td>
                                            <td class="text-right">
                                                <b>Remboursement</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_operation_usd, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_operation_cdf, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="text-dark small">
                                            <td class="text-center">
                                                <b>6.</b>
                                            </td>
                                            <td class="text-right">
                                                <b>Echange monnaie</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_change_usd_out, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_change_cdf_out, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="bg-secondary text-white">
                                            <td class="text-center">
                                                <b>II.</b>
                                            </td>
                                            <td class="text-uppercase text-right">
                                                <b>Total Sorties</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_amount_expenses_usd, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    - <?= number_format($total_amount_expenses_cdf, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white">
                                            <td class="text-center">
                                                <b>III.</b>
                                            </td>
                                            <td class="text-uppercase text-right">
                                                <b>Solde caisse</b>
                                            </td>

                                            <td class="text-uppercase border-left">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_cashbox_balance_usd, 2, ',', ' '); ?>$
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    <?= number_format($total_cashbox_balance_cdf, 2, ',', ' '); ?>Fc
                                                </b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>
    <?php endif; ?>
</div>