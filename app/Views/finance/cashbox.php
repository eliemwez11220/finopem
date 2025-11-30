<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('cashbox'); ?>">
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
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Gestion Financière</li>
                        <li class="breadcrumb-item active">Encaissement</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (session()->has('choosedsectionid')): ?>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center py-3 bg-primary">
                                <h1 class="text-uppercase font-weight-bold">
                                    Situation journalière par monnaie</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <?php
                                    $count = 1;
                                    $daily = date('Y-m-d');
                                    $devise = '';

                                    $day_credit_amount = 0;
                                    $day_debit_amount = 0;
                                    //$day_balance_amount = 0;
                                
                                    if (isset($cashbox) && !empty($cashbox)):
                                        foreach ($cashbox as $keyday => $dayvalue):
                                            $devise = $dayvalue['cashbox_currency'];

                                            ?>
                                            <?php
                                            $daypay_usd_amount = 0;
                                            $daypay_cdf_amount = 0;
                                            $daypay_usd_money = 0;
                                            $daypay_cdf_money = 0;
                                            $money_cashbox = 0;
                                            $day_returned = 0;
                                            if (isset($daypayments) && !empty($daypayments)):
                                                foreach ($daypayments as $keydaypay => $daypay):

                                                    //if ($daypay['fee_currency_payable'] == $dayvalue['cashbox_currency']):
                                                    if ($daypay['payment_date'] == $daily):

                                                        $day_money_paid = floatval($daypay['paydetails_paid_amount']);
                                                        $day_paid_exchange = floatval($daypay['payment_exchange']);
                                                        $day_returned += floatval($daypay['paydetails_return_amount']);

                                                        $daypay_usd_amount += $daypay['paydetails_usd_amount'];
                                                        $daypay_cdf_amount += $daypay['paydetails_cdf_amount'];

                                                        $money_cashbox += $day_money_paid;


                                                        $daypay_usd_money = ($devise == 'usd' && ($daypay_cdf_amount != 0)) ? ($daypay_cdf_amount / $day_paid_exchange) + $money_cashbox : 0;
                                                        $daypay_cdf_money = ($devise == 'cdf' && ($daypay_usd_amount != 0)) ? ($daypay_cdf_amount / $day_paid_exchange) : 0;


                                                        ?>

                                                        <?php //endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php
                                            $day_credit_amount = ($devise == 'usd') ? $daypay_usd_amount : $daypay_cdf_amount;
                                            ?>
                                            <?php
                                            $dayexpense_usd_amount = 0;
                                            $dayexpense_cdf_amount = 0;
                                            $debit_money_usd = 0;
                                            $debit_money_cdf = 0;
                                            $money_out_cashbox = 0;
                                            if (isset($expenses) && !empty($expenses)):
                                                foreach ($expenses as $keydayexp => $dayexpense):

                                                    //if ($dayexpense['fee_currency_payable'] == $dayvalue['cashbox_currency']):
                                                    if ($dayexpense['expense_date'] == $daily):
                                                        if (($dayexpense['expense_type'] != 'exchange')):

                                                            $dayexpense_usd_amount += floatval($dayexpense['expense_usd_amount']);
                                                            $dayexpense_cdf_amount += floatval($dayexpense['expense_cdf_amount']);
                                                            $day_exchange = floatval($dayexpense['expense_exchange']);


                                                            $debit_money_usd = ($daypay_cdf_money + $daypay_usd_money - $day_returned - $dayexpense_usd_amount);

                                                            $debit_money_diffe = ($daypay_cdf_money + $daypay_usd_money - $day_returned - $dayexpense_usd_amount);

                                                            $debit_money_cdf = $debit_money_diffe * $day_exchange;

                                                            ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php //endif; ?>
                                                <?php endforeach; ?>
                                                <?php

                                                $day_debit_amount = ($devise == 'usd') ? $dayexpense_usd_amount : $dayexpense_cdf_amount;

                                                //$day_debit_amount = $money_out_cashbox;
                                
                                                //$day_debit_amount = ($devise == 'usd') ? $daypay_usd_money: $daypay_cdf_money;
                                
                                                //$day_debit_amount = ($devise == 'usd') ? $debit_money_usd : $debit_money_cdf;
                                                ?>
                                            <?php endif; ?>
                                            <?php $day_balance_amount = $day_credit_amount - $day_debit_amount; ?>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="py-3 mb-2" style="border:2px solid blue; border-radius:15px">
                                                    <h3 class="text-center text-uppercase font-weight-bold h5">
                                                        <?= $dayvalue['cashbox_name']; ?>
                                                    </h3>
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-primary elevation-1">
                                                            <i class="fas <?= ($devise == 'usd') ? 'fa-donate' : ''; ?>"></i>
                                                            <?= ($devise == 'usd') ? '' : 'FC'; ?>
                                                        </span>
                                                        <div class="info-box-content">
                                                            <ul class="dashboard-stat-list list-group py-3 text-uppercase">
                                                                <li class="list-group-item border-bottom shadow-sm mb-2 bg-info">

                                                                    <a href="">
                                                                        <b>
                                                                            Entrées
                                                                        </b>
                                                                        <span class="float-right font-weight-bold">
                                                                            <b><?= number_format($day_credit_amount, 2, '.', ' '); ?></b>

                                                                        </span>
                                                                    </a>

                                                                </li>
                                                                <li class="list-group-item border-bottom shadow-sm mb-2 bg-danger">
                                                                    <a href="">
                                                                        <b>
                                                                            Sorties
                                                                        </b>
                                                                        <span class="float-right font-weight-bold">
                                                                            <b><?= number_format($day_debit_amount, 2, '.', ' '); ?></b>

                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item border-bottom shadow-sm mb-2 bg-success">
                                                                    <a href="">
                                                                        <b>
                                                                            Solde
                                                                        </b>
                                                                        <span class="float-right font-weight-bold">
                                                                            <b><?= number_format($day_balance_amount, 2, '.', ' '); ?></b>

                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center py-3 bg-dark">
                                <h1 class="text-uppercase font-weight-bold">
                                    Situation globale des caisses par monnaie</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <?php
                                    $count = 1;
                                    $currency = '';
                                    if (isset($cashbox) && !empty($cashbox)):
                                        foreach ($cashbox as $key => $cashvalue):
                                            $currency = $cashvalue['cashbox_currency'];
                                            $debit_amount = $cashvalue['cashbox_debit_amount'];
                                            $credit_amount = $cashvalue['cashbox_credit_amount'];
                                            $balance_amount = $credit_amount - $debit_amount;
                                            ?>
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="py-3 mb-2" style="border:2px solid blue; border-radius:15px">
                                                    <h3 class="text-center text-uppercase font-weight-bold h5">
                                                        <?= $cashvalue['cashbox_name']; ?>
                                                    </h3>
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-dark elevation-1">

                                                            <i class="fas <?= ($currency == 'usd') ? 'fa-donate' : ''; ?>"></i>
                                                            <?= ($currency == 'usd') ? '' : 'FC'; ?>
                                                        </span>
                                                        <div class="info-box-content">
                                                            <ul class="dashboard-stat-list list-group py-3 text-uppercase">
                                                                <li class="list-group-item border-bottom shadow-sm mb-2 bg-info">

                                                                    <a href="">
                                                                        <b>
                                                                            Entrées
                                                                        </b>
                                                                        <span class="float-right font-weight-bold">
                                                                            <b><?= number_format($credit_amount, 2, '.', ' '); ?></b>

                                                                        </span>
                                                                    </a>

                                                                </li>
                                                                <li class="list-group-item border-bottom shadow-sm mb-2 bg-danger">
                                                                    <a href="">
                                                                        <b>
                                                                            Sorties
                                                                        </b>
                                                                        <span class="float-right font-weight-bold">
                                                                            <b><?= number_format($debit_amount, 2, '.', ' '); ?></b>

                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="list-group-item border-bottom shadow-sm mb-2 bg-success">
                                                                    <a href="">
                                                                        <b>
                                                                            Solde
                                                                        </b>
                                                                        <span class="float-right font-weight-bold">
                                                                            <b><?= number_format($balance_amount, 2, '.', ' '); ?></b>

                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="shadow-sm">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="text-center py-3 bg-info">
                            <h1 class="text-uppercase font-weight-bold">
                                Situation globale des caisses par frais</h1>
                        </div>
                        <div class="row">
                            <?php
                            $count = 1;

                            if (isset($feespays) && !empty($feespays)):
                                foreach ($feespays as $key => $recette):
                                    $fee_currency = $recette['fee_currency_payable'];
                                    //$branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                    //if (($branch_access == $recette['section_id']) or (session()->admin == TRUE) or (session()->all == TRUE)): ?>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1 font-weight-bold">
                                                <i class="fas fa-tags"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text font-weight-bold text-uppercase border-bottom mb-2">
                                                    Caisse [<?= trim($recette['fee_name']); ?>]
                                                </span>

                                                <?php
                                                $pay_amount = 0;
                                                $payment_amount = 0;
                                                foreach ($payments as $keypay => $pay):

                                                    if ($pay['fee_id'] == $recette['fee_id']) {

                                                        $payment_amount += $pay['paydetails_paid_amount'];
                                                        $pay_amount = $payment_amount;
                                                    } ?>
                                                <?php endforeach; ?>
                                                <?php ?>
                                                <?php
                                                $fee_expense_amount = 0;
                                                if (isset($expenses) && !empty($expenses)):
                                                    foreach ($expenses as $keyexp => $expense):
                                                        $expense_usd_amount = 0;
                                                        $expense_cdf_amount = 0;
                                                        if ($expense['fee_id'] == $recette['fee_id']):
                                                            if (($expense['expense_type'] != 'exchange')):
                                                                $expense_usd_amount += $expense['expense_usd_amount'];
                                                                $expense_cdf_amount += $expense['expense_cdf_amount'];
                                                                $fee_expense_amount = ($fee_currency == 'usd') ? $expense_usd_amount : $expense_cdf_amount;

                                                                ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                                <span class="font-weight-bold text-uppercase">
                                                    <?= number_format($pay_amount - $fee_expense_amount, 2, ',', ' '); ?>
                                                    <b class="text-danger">
                                                        <?= trim($fee_currency); ?></b>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center printoff mt-3">
                <a href="javascript:void();" class="btn btn-success text-uppercase btn-sm" onclick="window.print();">
                    <i class="fa fa-print"></i> Imprimer Situation caisses</a>
            </div>
        </div>

    <?php endif; ?>
</div>