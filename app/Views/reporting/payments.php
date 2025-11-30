<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('reppayments'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff ">
        <div class="container-fluid">
            <h1 class="font-weight-bold text-uppercase text-center printoff">
                <i class="nav-icon fas fa-donate"></i> Rapport de Versements
            </h1>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 col-lg-3">
                        <div class="shadow-sm">
                            <!-- ====== Start Section Filter Header -->
                            <?php include(APPPATH . ('Views/reporting/section_filter.php')); ?>
                            <!-- ====== End Section Filter Header -->
                        </div>
                    </div>
                    <div class="col-sm-9 col-lg-9">
                         <!-- ====== Start Dates Filter Header -->
                         <?php include(APPPATH . ('Views/reporting/dates_filter.php')); ?>
                        <!-- ====== End Dates Filter Header -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (session()->has('choosedsectionid')): ?>
        <?php if (isset($daypayments) && !empty($daypayments)): ?>
            <section class="content" style="page-break-after: always!important;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>
                    <div class="shadow-lg text-center" style="border:2px solid black">
                        <h1 class="text-uppercase font-weight-bold py-3">
                            Versements Antérieures du jour
                        </h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="datatablesReporting" class="table table-sm table-head-fixed display"
                                            width="100%">
                                            <thead>
                                                <tr class="small text-uppercase">
                                                    <th>#</th>
                                                    <th>Date paie</th>
                                                    <th>Noms Eleve</th>
                                                    <th>Classe</th>
                                                    <!-- <th>Frais payé</th> -->
                                                    <th>Montant </th>
                                                    <th>Reçu</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                $date_paid_day = date('Y-m-d');
                                                            
                                                $ant_total_cash_usd = 0;
                                                $ant_total_cash_cdf = 0;
                                                $ant_count = 1;
                                                // $count_fees = 1;
                                                $ant_montant_total_cdf = 0;
                                                $ant_montant_total_usd = 0;
                                                $ant_montant_total_solde = 0;
                                                $ant_amount_returned_usd = 0;
                                                $ant_amount_returned_cdf = 0;
                                                $ant_total_amount_paid = 0;
                                                $ant_total_amount_payable = 0;
                                                $ant_total_amount_balance = 0;
                                                $ant_tot_amount_paid_usd = 0;
                                                $ant_tot_amount_paid_cdf = 0;
                                                ?>
                                                <?php if (isset($daypayfees) && !empty($daypayfees)):
                                                    foreach ($daypayfees as $daypayfee):
                                                        $daypayfee_date = date('Y-m-d', strtotime($daypayfee['payment_created_at']));

                                                            if (($daypayfee['payment_date'] != $date_paid_day) && ($daypayfee_date == $date_paid_day)):
                                                                if ($daypayfee['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                                                      
                                                        $antotal_fee_payable = $daypayfee['fee_total_payable'];
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" class="text-uppercase font-weight-bold">

                                                                <i class="fa fa-check-circle"></i>
                                                                <b>
                                                                    <span
                                                                        style="<?= ($antotal_fee_payable == 1) ? 'display:none' : ''; ?>">
                                                                        <?= $daypayfee['fee_name'] . " -"; ?></span>
                                                                    <span class="text-primary">
                                                                        <?= $daypayfee['feedetail_name']; ?>
                                                                    </span>
                                                                </b>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $ant_amount_paid_usd = 0;
                                                        $ant_amount_paid_cdf = 0;
                                                        foreach ($daypayments as $day_pay) {

                                                            $pay_edition = date('Y-m-d', strtotime($day_pay['payment_created_at']));

                                                            if (($day_pay['payment_date'] != $date_paid_day) && ($pay_edition == $date_paid_day)) {
                                                                if ($day_pay['feedetail_id'] == $daypayfee['feedetail_id']) {
                                                                    if ($day_pay['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)) {
                                                                        $ant_currency = $day_pay['fee_currency_payable'];
                                                                        $ant_fee_total_payable = $day_pay['fee_total_payable'];
                                                                        //$currency_paid = ($ant_currency == 'usd') ? '$' : 'Fc';
                                                                        //$pay_token = $day_pay['paydetails_token'];

                                                                        $daypay_amount = $day_pay['paydetails_paid_amount'];
                                                                        $ant_pay_usd_amount = $day_pay['paydetails_usd_amount'];
                                                                        $ant_pay_cdf_amount = $day_pay['paydetails_cdf_amount'];

                                                                        $ant_pay_returned_amount = $day_pay['paydetails_return_amount'];

                                                                        $ant_pay_exchange = $day_pay['payment_exchange'];


                                                                        //$ant_notes = $day_pay['payment_notes'];
                                                                        $ant_status = (!empty(($day_pay['paydetails_status'])) ? ($day_pay['paydetails_status']) : 'inactif');

                                                                        $ant_total_amount_usd = ($ant_pay_usd_amount != 0) ? $ant_pay_usd_amount + ($ant_pay_cdf_amount / $ant_pay_exchange) : 0;
                                                                        $ant_total_amount_cdf = ($ant_pay_usd_amount != 0) ? $ant_pay_cdf_amount + ($ant_pay_usd_amount * $ant_pay_exchange) : 0;

                                                                        $ant_balance_amount = $ant_pay_returned_amount;
                                                                        $ant_balance_currency = ($ant_currency == 'usd') ? '$' : 'Fc';
                                                                        $ant_montant_total_cdf += $ant_pay_cdf_amount;
                                                                        $ant_montant_total_usd += $ant_pay_usd_amount;

                                                                        $ant_amount_paid_usd += ($ant_currency == 'usd') ? $daypay_amount : 0;
                                                                        $ant_amount_paid_cdf += ($ant_currency == 'cdf') ? $daypay_amount : 0;

                                                                        $ant_amount_returned_cdf += ($ant_currency == 'cdf') ? $ant_pay_returned_amount : 0;
                                                                        $ant_amount_returned_usd += ($ant_currency == 'usd') ? $ant_pay_returned_amount : 0;
                                                                        $ant_total_amount_paid += $daypay_amount;
                                                                        $ant_montant_total_solde = ($ant_montant_total_usd * $ant_pay_exchange) + $ant_montant_total_cdf;

                                                                        $ant_total_cash_usd = $ant_montant_total_usd;
                                                                        $ant_total_cash_cdf = $ant_montant_total_cdf;
                                                                        ?>
                                                                        <tr class="small"
                                                                            style="<?= ($ant_status == 'cancel') ? 'text-decoration:line-through' : ''; ?>">
                                                                            <td width="1" class="font-weight-bold">
                                                                                <?= $ant_count++; ?>
                                                                            </td>
                                                                            <td class="text-uppercase font-weight-bold">
                                                                                <?= $day_pay['payment_date']; ?>
                                                                            </td>
                                                                            <td class="text-uppercase font-weight-bold">
                                                                                <?= trim($day_pay['student_firstname']); ?>
                                                                                <?= trim($day_pay['student_lastname']); ?>
                                                                                <?= trim($day_pay['student_surname']); ?>
                                                                            </td>
                                                                            <td class="text-uppercase font-weight-bold">
                                                                                <?= (!empty($day_pay['classe_shortname'])) ? $day_pay['classe_shortname'] : $day_pay['degree_shortname'] . ' ' . ($day_pay['classe_subname']) . ' ' . ($day_pay['option_name']); ?>
                                                                            </td>
                                                                            <td class="font-weight-bold">
                                                                                <span class="">
                                                                                    <?= number_format($daypay_amount, 2, ',', ' '); ?>
                                                                                </span>
                                                                                <span class="text-uppercase">
                                                                                    <?= $ant_currency; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <span class="font-weight-bold text-uppercase">
                                                                                    <?= $day_pay['payment_code']; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td class="font-weight-bold text-uppercase">
                                                                                <span class="text-<?= setStatusColors($ant_status); ?> text-capitalize">
                                                                                    <?= ($ant_status == 'actif') ? 'Encaissé' : 'Annulé'; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }
                                                                }
                                                            }
                                                        }
                                                        $ant_tot_amount_paid_usd += $ant_amount_paid_usd;
                                                        $ant_tot_amount_paid_cdf += $ant_amount_paid_cdf;
                                                        ?>
                                                        <tr class=" text-dark">
                                                            <td colspan="4" class="text-uppercase text-right border-right">
                                                                <b>Total <span class="text-danger font-weight-bold">
                                                                        <?= $daypayfee['feedetail_name']; ?></span>: USD=
                                                                    <?= number_format($ant_amount_paid_usd, 2, ',', ' '); ?> $
                                                                </b>
                                                            </td>

                                                            <td class="text-uppercase text-left border-left">
                                                                <b>CDF=
                                                                    <?= number_format($ant_amount_paid_cdf, 2, ',', ' '); ?> Fc
                                                                </b>
                                                            </td>
                                                            <td colspan="2" class="text-uppercase text-right">

                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="page-break-before: always!important;">

                            <table id="datatablesReporting2" class="table table-sm table-head-fixed display" width="100%">
                                <tbody>
                                </tbody>
                                <tfoot>

                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <p class="font-weight-bold text-uppercase py-3 h3" style="border:2px solid black">
                                            Synthèse versements Antérieures du jour</p>
                                        </td>
                                    </tr>

                                    <tr class="text-dark">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <b>Montant</b>
                                        </td>

                                        <td class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                En CDF
                                            </b>
                                        </td>
                                        <td colspan="6" class="text-uppercase">
                                            <b class="font-weight-bold">
                                                En USD</b>
                                        </td>


                                    </tr>
                                    <tr class=" text-dark">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <b>Déposé:</b>
                                        </td>

                                        <td class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                Fc <?= number_format($ant_montant_total_cdf, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                        <td colspan="6" class="text-uppercase">
                                            <b class="font-weight-bold">
                                                $ <?= number_format($ant_montant_total_usd, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <span class="font-weight-bold">
                                                Perçu:
                                            </span>
                                        </td>
                                        <td colspan="2" class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                Fc <?= number_format($ant_tot_amount_paid_cdf, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                        <td colspan="5" class="text-uppercase border-left">
                                            <b class="font-weight-bold">
                                                $ <?= number_format($ant_tot_amount_paid_usd, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <span class="font-weight-bold">
                                                Remis:
                                            </span>
                                        </td>
                                        <td colspan="2" class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                Fc <?= number_format($ant_amount_returned_cdf, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                        <td colspan="5" class="text-uppercase border-left">
                                            <b class="font-weight-bold">
                                                $ <?= number_format($ant_amount_returned_usd, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

            <?php if (isset($payments) && !empty($payments)): ?>

            <section class="content" style="page-break-after: always!important;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>
                    <div class="shadow-lg text-center" style="border:2px solid black">
                        <h1 class="text-uppercase font-weight-bold py-3">
                            Versements
                        </h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="datatablesReporting" class="table table-sm table-head-fixed display"
                                            width="100%">
                                            <thead>
                                                <tr class="small text-uppercase">
                                                    <th>#</th>
                                                    <th>Date paie</th>
                                                    <th>Noms Eleve</th>
                                                    <th>Classe</th>
                                                    <!-- <th>Frais payé</th> -->
                                                    <th>Montant </th>
                                                    <th>Reçu</th>
                                                    <th>Statut</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                $total_cash_usd = 0;
                                                $total_cash_cdf = 0;
                                                $count = 1;
                                                // $count_fees = 1;
                                                $montant_total_cdf = 0;
                                                $montant_total_usd = 0;
                                                $montant_total_solde = 0;
                                                $amount_returned_usd = 0;
                                                $amount_returned_cdf = 0;
                                                $total_amount_paid = 0;
                                                $total_amount_payable = 0;
                                                $total_amount_balance = 0;
                                                $tot_amount_paid_usd = 0;
                                                $tot_amount_paid_cdf = 0;
                                                ?>
                                                <?php if (isset($feespaid) && !empty($feespaid)):
                                                    foreach ($feespaid as $feepaid):
                                                        if ($feepaid['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                                                
                                                        $total_fee_payable = $feepaid['fee_total_payable'];
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" class="text-uppercase font-weight-bold">

                                                                <i class="fa fa-check-circle"></i>
                                                                <b>
                                                                    <span
                                                                        style="<?= ($total_fee_payable == 1) ? 'display:none' : ''; ?>">
                                                                        <?= $feepaid['fee_name'] . " -"; ?></span>
                                                                    <span class="text-primary">
                                                                        <?= $feepaid['feedetail_name']; ?>
                                                                    </span>
                                                                </b>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $amount_paid_usd = 0;
                                                        $amount_paid_cdf = 0;
                                                        foreach ($payments as $payment) {
                                                            if ($payment['feedetail_id'] == $feepaid['feedetail_id']) {
                                                                if ($payment['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)) {
                                                                    $currency = $payment['fee_currency_payable'];
                                                                    $fee_total_payable = $payment['fee_total_payable'];
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
                                                                    <tr class="small"
                                                                        style="<?= ($status == 'cancel') ? 'text-decoration:line-through' : ''; ?>">
                                                                        <td width="1" class="font-weight-bold">
                                                                            <?= $count++; ?>
                                                                        </td>
                                                                        <td class="text-uppercase font-weight-bold">
                                                                            <?= $payment['payment_date']; ?>
                                                                        </td>
                                                                        <td class="text-uppercase font-weight-bold">
                                                                            <?= trim($payment['student_firstname']); ?>
                                                                            <?= trim($payment['student_lastname']); ?>
                                                                            <?= trim($payment['student_surname']); ?>
                                                                        </td>
                                                                        <td class="text-uppercase font-weight-bold">
                                                                            <?= (!empty($payment['classe_shortname'])) ? $payment['classe_shortname'] : $payment['degree_shortname'] . ' ' . ($payment['classe_subname']) . ' ' . ($payment['option_name']); ?>
                                                                        </td>
                                                                        <td class="font-weight-bold">
                                                                            <span class="">
                                                                                <?= number_format($pay_amount, 2, ',', ' '); ?>
                                                                            </span>
                                                                            <span class="text-uppercase">
                                                                                <?= $currency; ?>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="font-weight-bold text-uppercase">
                                                                                <?= $payment['payment_code']; ?>
                                                                            </span>
                                                                        </td>
                                                                        <td class="font-weight-bold text-uppercase">
                                                                            <span class="text-<?= setStatusColors($status); ?> text-capitalize">
                                                                                <?= ($status == 'actif') ? 'Encaissé' : 'Annulé'; ?>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                <?php }
                                                            }
                                                        }
                                                        $tot_amount_paid_usd += $amount_paid_usd;
                                                        $tot_amount_paid_cdf += $amount_paid_cdf;
                                                        ?>
                                                        <tr class=" text-dark">
                                                            <td colspan="4" class="text-uppercase text-right border-right">
                                                                <b>Total <span class="text-danger font-weight-bold">
                                                                        <?= $feepaid['feedetail_name']; ?></span>: USD=
                                                                    <?= number_format($amount_paid_usd, 2, ',', ' '); ?> $
                                                                </b>
                                                            </td>

                                                            <td class="text-uppercase text-left border-left">
                                                                <b>CDF=
                                                                    <?= number_format($amount_paid_cdf, 2, ',', ' '); ?> Fc
                                                                </b>
                                                            </td>
                                                            <td colspan="2" class="text-uppercase text-right">

                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="page-break-before: always!important;">

                            <table id="datatablesReporting2" class="table table-sm table-head-fixed display" width="100%">
                                <tbody>
                                </tbody>
                                <?php $status_reporting = (session()->has('status_reporting')) ? session()->get('status_reporting') : ''; ?>
                                <tfoot class="<?= ($status_reporting == 'hide') ? 'd-none' : ''; ?>">

                                    <tr>
                                        <td colspan="7" class="text-center lined lined-center">
                                            <p class="font-weight-bold text-uppercase py-3 h3" style="border:2px solid black">
                                                Récapitulatif de la perception</p>
                                        </td>
                                    </tr>

                                    <tr class="text-dark">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <b>Montant</b>
                                        </td>

                                        <td class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                En CDF
                                            </b>
                                        </td>
                                        <td colspan="6" class="text-uppercase">
                                            <b class="font-weight-bold">
                                                En USD</b>
                                        </td>


                                    </tr>
                                    <tr class=" text-dark">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <b>Déposé:</b>
                                        </td>

                                        <td class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                Fc <?= number_format($montant_total_cdf, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                        <td colspan="6" class="text-uppercase">
                                            <b class="font-weight-bold">
                                                $ <?= number_format($montant_total_usd, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <span class="font-weight-bold">
                                                Perçu:
                                            </span>
                                        </td>
                                        <td colspan="2" class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                Fc <?= number_format($tot_amount_paid_cdf, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                        <td colspan="5" class="text-uppercase border-left">
                                            <b class="font-weight-bold">
                                                $ <?= number_format($tot_amount_paid_usd, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="3" class="text-uppercase text-right">
                                            <span class="font-weight-bold">
                                                Remis:
                                            </span>
                                        </td>
                                        <td colspan="2" class="text-uppercase border-right text-right">
                                            <b class="font-weight-bold">
                                                Fc <?= number_format($amount_returned_cdf, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                        <td colspan="5" class="text-uppercase border-left">
                                            <b class="font-weight-bold">
                                                $ <?= number_format($amount_returned_usd, 2, ',', ' '); ?>
                                            </b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row printoff">
                                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                                    <div class="text-center">
                                        <button id="btn_hide_reporting" onclick="hideReporting();" type="button"
                                            class="btn btn-<?= ($status_reporting == 'hide') ? 'info' : 'danger'; ?>">
                                            <i id="hide_status"
                                                class="fas fa-<?= ($status_reporting == 'hide') ? 'eye' : 'eye-slash'; ?>"></i>
                                            <span id="hide_info"><?= ($status_reporting == 'hide') ? 'Afficher' : 'Masquer'; ?>
                                                le
                                                récapitulatif</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            if (isset($expenses) && !empty($expenses)):
                $total_cashbox_balance_usd = 0;
                $total_cashbox_balance_cdf = 0;
                ?>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h3 class="font-weight-bold text-uppercase py-3" style="border:2px solid black">
                                                Opérations caisses - Décaissements
                                            </h3>

                                            <h3 class="font-weight-bold text-uppercase py-3">
                                                Dépenses(Charges de gestion)
                                            </h3>
                                        </div>
                                        <table id="datatables_expenses"
                                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                            <thead>

                                                <tr class="small text-uppercase">
                                                    <th>Date</th>
                                                    <th>Caisse</th>
                                                    <th>USD</th>
                                                    <th>CDF</th>

                                                    <th>Bénéficiaire</th>
                                                    <th>Approbateur</th>
                                                    <th>Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                $total_expense_cdf = 0;
                                                $total_expense_usd = 0;
                                                foreach ($expenses as $keyexpense => $expense):
                                                    if ($expense['expense_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)) {
                                                        if ($expense['expense_type'] == 'expense'):
                                                            $status = ($expense['expense_status']);
                                                            $echange = ($expense['expense_exchange']);
                                                            $mnt_sorti_usd = ($expense['expense_usd_amount']);
                                                            $mnt_sorti_cdf = ($expense['expense_cdf_amount']);
                                                            $currency_cashbox = ($expense['fee_currency_payable']);

                                                            $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                                            $expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';
                                                            $total_expense_cdf += $mnt_sorti_cdf;
                                                            $total_expense_usd += $mnt_sorti_usd;

                                                            ?>
                                                            <tr class="small">
                                                                <td><?= ($expense['expense_created_at']); ?></td>
                                                                <td class="text-uppercase"><?= ($expense['fee_name']); ?></td>

                                                                <td class="text-uppercase">
                                                                    <?= ($mnt_sorti_usd != 0) ? '-' : ''; ?>
                                                                    <?= number_format(($mnt_sorti_usd), 2, ',', ' '); ?>
                                                                </td>
                                                                <td class="text-uppercase">
                                                                    <?= ($mnt_sorti_cdf != 0) ? '-' : ''; ?>
                                                                    <?= number_format(($mnt_sorti_cdf), 2, ',', ' '); ?>
                                                                </td>

                                                                <td class="text-uppercase">
                                                                    <?= ($expense['expense_requested_by']); ?>
                                                                </td>
                                                                <td class="text-uppercase">
                                                                    <?= ($expense['expense_approved_by']); ?>
                                                                </td>
                                                                <td class="text-uppercase">
                                                                    <span
                                                                        class="badge badge-<?= setStatusColors($expense['expense_status']); ?>">
                                                                        <?= ($expense['expense_status'] == 'actif') ? ' Exécutée ' : 'Annulée'; ?>
                                                                    </span>
                                                                    <br>
                                                                    <?= ($expense['expense_notes']); ?>
                                                                </td>

                                                            </tr>

                                                        <?php endif; ?>
                                                    <?php } ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="font-weight-bold">
                                                    <td class="text-uppercase text-right" colspan="2">
                                                        Total Dépenses
                                                    </td>

                                                    <td class="text-uppercase">
                                                        <?= ($total_expense_usd != 0) ? '-' : ''; ?>
                                                        <?= number_format(($total_expense_usd), 2, ',', ' ') . ' $'; ?>
                                                    </td>
                                                    <td class="text-uppercase">
                                                        <?= ($total_expense_cdf != 0) ? '-' : ''; ?>
                                                        <?= number_format(($total_expense_cdf), 2, ',', ' ') . ' Fc'; ?>
                                                    </td>
                                                    <td class="text-uppercase" colspan="4">
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>


                                        <div class="table-responsive">
                                            <div class="text-center">
                                                <h3 class="font-weight-bold text-uppercase  py-3">Fonctionnement </h3>
                                            </div>
                                            <table id="datatables_returning"
                                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr class="text-uppercase">
                                                        <th>Date</th>
                                                        <th>Caisse</th>
                                                        <th>USD</th>
                                                        <th>CDF</th>
                                                        <th>Type</th>
                                                        <th>Etat</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    $total_operation_usd = 0;
                                                    $total_operation_cdf = 0;
                                                    foreach ($expenses as $key => $value):
                                                        if ($value['expense_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)) {
                                                            if ($value['expense_type'] == 'returning'):

                                                                $status = ($value['expense_status']);
                                                                $echange = ($value['expense_exchange']);
                                                                $mnt_sorti_usd = ($value['expense_usd_amount']);
                                                                $mnt_sorti_cdf = ($value['expense_cdf_amount']);
                                                                $currency_cashbox = ($value['fee_currency_payable']);

                                                                $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                                                $expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';

                                                                $total_operation_usd += $mnt_sorti_usd;
                                                                $total_operation_cdf += $mnt_sorti_cdf;
                                                                ?>
                                                                <tr class="small">
                                                                    <td><?= ($value['expense_created_at']); ?></td>
                                                                    <td class="text-uppercase"><?= ($value['fee_name']); ?></td>

                                                                    <td class="text-uppercase">
                                                                        <?= ($mnt_sorti_usd != 0) ? '-' : ''; ?>
                                                                        <?= number_format(($mnt_sorti_usd), 2, ',', ' '); ?>
                                                                    </td>
                                                                    <td class="text-uppercase">
                                                                        <?= ($mnt_sorti_cdf != 0) ? '-' : ''; ?>
                                                                        <?= number_format(($mnt_sorti_cdf), 2, ',', ' '); ?>
                                                                    </td>
                                                                    <td class="text-uppercase">
                                                                        <?= ($value['expense_type'] == 'returning') ? 'Remboursement' : 'Change monnaie'; ?>
                                                                    </td>
                                                                    <td class="text-uppercase">
                                                                        <span
                                                                            class="badge badge-<?= setStatusColors($value['expense_status']); ?>">
                                                                            <?= ($value['expense_status'] == 'actif') ? ' Exécutée ' : 'Annulée'; ?>
                                                                        </span>
                                                                    </td>
                                                                    <td><?= ($value['expense_notes']); ?></td>

                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                    <?php endforeach; ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr class="font-weight-bold">
                                                        <td class="text-uppercase text-right" colspan="2">
                                                            Total Remboursement
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <?= ($total_operation_usd != 0) ? '-' : ''; ?>
                                                            <?= number_format(($total_operation_usd), 2, ',', ' ') . ' $'; ?>
                                                        </td>
                                                        <td class="text-uppercase">
                                                            <?= ($total_operation_cdf != 0) ? '-' : ''; ?>
                                                            <?= number_format(($total_operation_cdf), 2, ',', ' ') . ' Fc'; ?>
                                                        </td>
                                                        <td class="text-uppercase" colspan="3"></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="7" class="text-center">
                                                            <h3 class="font-weight-bold text-uppercase py-3">
                                                                Echanges de monnaie
                                                            </h3>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-uppercase">
                                                        <th>Date</th>
                                                        <th>Caisse</th>
                                                        <th>USD</th>
                                                        <th>CDF</th>
                                                        <th>Opération</th>
                                                        <th>Etat</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                    <?php
                                                    $count = 1;
                                                    $total_change_usd_in = 0;
                                                    $total_change_usd_out = 0;
                                                    $total_change_cdf_in = 0;
                                                    $total_change_cdf_out = 0;

                                                    foreach ($expenses as $keychange => $change):
                                                        if ($change['expense_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)) {
                                                            if ($change['expense_type'] == 'exchange'):

                                                                $change_echange = ($change['expense_exchange']);
                                                                $change_usd = ($change['expense_usd_amount']);
                                                                $change_cdf = ($change['expense_cdf_amount']);
                                                                $currency_cashbox = ($change['fee_currency_payable']);

                                                                $total_change_usd_in += ($change['expense_category'] == 'usdin') ? $change_usd : 0;
                                                                $total_change_usd_out += ($change['expense_category'] == 'usdout') ? $change_usd : 0;

                                                                $total_change_cdf_in += ($change['expense_category'] == 'usdout') ? $change_cdf : 0;
                                                                $total_change_cdf_out += ($change['expense_category'] == 'usdin') ? $change_cdf : 0;

                                                                ?>
                                                                <tr class="small">
                                                                    <td><?= ($change['expense_created_at']); ?></td>
                                                                    <td class="text-uppercase"><?= ($change['fee_name']); ?></td>

                                                                    <td class="text-uppercase font-weight-bold">
                                                                        <span
                                                                            class="<?= ($change['expense_category'] == 'usdin') ? 'text-success' : 'text-danger'; ?>">
                                                                            <?= (($change_usd != 0) && $change['expense_category'] == 'usdin') ? '+' : '-'; ?>
                                                                            <?= number_format(($change_usd), 2, ',', ' '); ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-uppercase font-weight-bold">
                                                                        <span
                                                                            class="<?= ($change['expense_category'] == 'usdout') ? 'text-success' : 'text-danger'; ?>">
                                                                            <?= (($change_cdf != 0) && $change['expense_category'] == 'usdout') ? '+' : '-'; ?>
                                                                            <?= number_format(($change_cdf), 2, ',', ' '); ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-uppercase">
                                                                        <?= ($change['expense_category'] == 'usdin') ? 'ENTREE USD' : 'SORTIE USD'; ?>
                                                                    </td>
                                                                    <td class="text-uppercase">
                                                                        <span
                                                                            class="badge badge-<?= setStatusColors($change['expense_status']); ?>">
                                                                            <?= ($change['expense_status'] == 'actif') ? ' Exécutée ' : 'Annulée'; ?>
                                                                        </span>
                                                                    </td>
                                                                    <td><?= ($change['expense_notes']); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                    <tr class="font-weight-bold">
                                                        <td class="text-uppercase text-right" colspan="2">
                                                            Monnaie entrée
                                                        </td>

                                                        <td class="text-uppercase text-success">
                                                            +<?= number_format(($total_change_usd_in), 2, ',', ' ') . ' $'; ?>
                                                        </td>
                                                        <td class="text-uppercase text-success">
                                                            +<?= number_format(($total_change_cdf_in), 2, ',', ' ') . ' Fc'; ?>
                                                        </td>
                                                        <td class="text-uppercase" colspan="3">
                                                        </td>
                                                    </tr>
                                                    <tr class="font-weight-bold ">
                                                        <td class="text-uppercase text-right" colspan="2">
                                                            Monnaie sortie
                                                        </td>

                                                        <td class="text-uppercase text-danger">
                                                            - <?= number_format(($total_change_usd_out), 2, ',', ' ') . ' $'; ?>
                                                        </td>
                                                        <td class="text-uppercase text-danger">
                                                            - <?= number_format(($total_change_cdf_out), 2, ',', ' ') . ' Fc'; ?>
                                                        </td>
                                                        <td class="text-uppercase" colspan="3">
                                                        </td>
                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                                <div class="card" style="page-break-before: always!important;">
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <h3 class="font-weight-bold text-uppercase py-3" style="border:2px solid black">
                                                Trésorerie
                                            </h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="datatables_balance"
                                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr class="text-uppercase">

                                                        <th colspan="2" class="text-right">Désignation</th>
                                                        <th>USD</th>
                                                        <th>CDF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $total_amount_revenue_usd = ($tot_amount_paid_usd + $total_change_usd_in);
                                                    $total_amount_revenue_cdf = ($tot_amount_paid_cdf + $total_change_cdf_in);

                                                    $total_amount_expenses_usd = $total_expense_usd + $total_operation_usd + $total_change_usd_out;
                                                    $total_amount_expenses_cdf = $total_expense_cdf + $total_operation_cdf + $total_change_cdf_out;

                                                    $total_cashbox_balance_usd = $total_amount_revenue_usd - $total_amount_expenses_usd;
                                                    $total_cashbox_balance_cdf = $total_amount_revenue_cdf - $total_amount_expenses_cdf; ?>

                                                    <tr class="text-dark">
                                                        <td colspan="2" class="text-uppercase text-right">
                                                            <b>Entrées caisse</b>
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
                                                    <tr class="text-dark">
                                                        <td colspan="2" class="text-uppercase text-right">
                                                            <b>Sorties caisse</b>
                                                        </td>

                                                        <td class="text-uppercase border-left">
                                                            <b class="font-weight-bold">
                                                                -<?= number_format($total_amount_expenses_usd, 2, ',', ' '); ?>$
                                                            </b>
                                                        </td>
                                                        <td class="text-uppercase border-right">
                                                            <b class="font-weight-bold">
                                                                -<?= number_format($total_amount_expenses_cdf, 2, ',', ' '); ?>Fc
                                                            </b>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-dark">
                                                        <td colspan="2" class="text-uppercase text-right">
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
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->

                </section>
            <?php endif; ?>
            <!-- === INCLUDE FOOTER === -->
            <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
            <!-- === INCLUDE FOOTER === -->
        <?php endif; ?>
    <?php endif; ?>
</div>