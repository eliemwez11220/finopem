<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('repusersfees'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <h1 class="font-weight-bold text-uppercase text-center printoff">
                <i class="nav-icon fas fa-donate"></i> Rapport de Perception frais par Agent
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
                    <div class="shadow-lg text-center" style="border:2px solid black">
                        <h1 class="text-uppercase font-weight-bold py-3">
                            Situation de la caisse par agent
                        </h1>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-uppercase font-weight-bold">
                                <th colspan="2" class="text-right">Agents</th>
                                <th>Dollars(USD)</th>
                                <th>Francs(CDF)</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $montant_user_usd = 0;
                            $montant_user_cdf = 0;
                            $montant_global_user_cdf = 0;
                            if (isset($agents) && (!empty($agents))): ?>
                                <?php foreach ($agents as $user_rec):
                                    if ($user_rec['user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):

                                        ?>
                                        <?php
                                        $count = 1;

                                        $montant_total_percu_usd_rec = 0;
                                        $montant_total_percu_cdf_rec = 0;
                                        $montant_global_percu_cdf_rec = 0;
                                        $montant_versement_rec = 0;
                                        $montant_versement_usd_rec = 0;
                                        $montant_versement_cdf_rec = 0;
                                        $montant_total_cdf_rec = 0;
                                        ?>

                                        <?php if (isset($payments) && !empty($payments)):
                                            foreach ($payments as $key => $value_rec):

                                                $devise_rec = (!empty(($value_rec['fee_currency_payable'])) ? esc($value_rec['fee_currency_payable']) : '');
                                                $taux_rec = (!empty(($value_rec['payment_exchange'])) ? esc($value_rec['payment_exchange']) : '0');

                                                if (($value_rec['payment_user_id'] == $user_rec['user_id'])) {

                                                    $montant_versement_rec = $value_rec['paydetails_paid_amount'];
                                                    //$montant_versement_usd = $value['paydetails_usd_amount'];
                                                    //$montant_versement_cdf = $value['paydetails_cdf_amount'];
                    

                                                    $montant_versement_usd_rec = ($devise_rec == 'usd') ? $montant_versement_rec : 0;
                                                    $montant_versement_cdf_rec = ($devise_rec == 'cdf') ? $montant_versement_rec : 0;

                                                    $montant_total_cdf_rec = ($devise_rec == 'usd') ? ($montant_versement_rec * $taux_rec) + $montant_versement_cdf_rec : $montant_versement_cdf_rec;

                                                    $montant_total_percu_usd_rec += $montant_versement_usd_rec;
                                                    $montant_total_percu_cdf_rec += $montant_versement_cdf_rec;
                                                    $montant_global_percu_cdf_rec = ($devise_rec == 'usd') ? ($montant_total_percu_usd_rec * $taux_rec) + $montant_total_percu_cdf_rec : $montant_total_percu_cdf_rec;


                                                    ?>
                                                <?php } ?>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr class="font-weight-bold">
                                            <td colspan="2" class="text-right text-uppercase">
                                                <?= trim($user_rec['user_firstname']); ?>
                                                <?= trim($user_rec['user_lastname']); ?>
                                            </td>
                                            <td class="font-weight-bold">
                                                $ <?= number_format($montant_total_percu_usd_rec, 2, ',', ' '); ?>
                                            </td>
                                            <td class="font-weight-bold">
                                                FC <?= number_format($montant_total_percu_cdf_rec, 2, ',', ' '); ?>
                                            </td>
                                        </tr>
                                        <?php $montant_user_usd += $montant_total_percu_usd_rec;
                                        $montant_user_cdf += $montant_total_percu_cdf_rec;
                                        $montant_global_user_cdf += $montant_global_percu_cdf_rec; ?>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>


                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold">
                                <td colspan="2" class="text-right text-uppercase">
                                    Total Général Perçu
                                </td>
                                <td class="font-weight-bold">
                                    $ <?= number_format($montant_user_usd, 2, ',', ' '); ?>
                                </td>
                                <td class="font-weight-bold">
                                    FC <?= number_format($montant_user_cdf, 2, ',', ' '); ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <?php
                    //$montant_user_usd = 0;
                    //$montant_user_cdf = 0;
                    $count_user = 1;
                    if (isset($agents) && (!empty($agents))): ?>
                        <?php foreach ($agents as $user):
                            if ($user['user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                ?>
                                <?php $status_reporting = (session()->has('status_reporting')) ? session()->get('status_reporting') : ''; ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="page-break-after: always!important;">
                                            <div class="col-sm-12">
                                                <h5 class="text-uppercase font-weight-bold py-3" style="border:2px solid black">

                                                    <?= $count_user++; ?>. Perception de
                                                    l'agent:<?= $user['user_firstname'] . ' ' . $user['user_lastname']; ?>
                                                    <span class="text-primary">[<?= $user['user_code']; ?>]</span>

                                                </h5>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table id="datatablesReportingActionsx" class="table table-sm table-bordered"
                                                        style="border: 2px;" cellpadding="5" cellspacing="0">
                                                        <thead>
                                                            <tr class="text-uppercase font-weight-bold">
                                                                <th colspan="2">Description</th>

                                                                <th>Dollars(USD)</th>
                                                                <th>Francs(CDF)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $count = 1;

                                                            $montant_total_percu_usd = 0;
                                                            $montant_total_percu_cdf = 0;
                                                            $montant_global_percu_cdf = 0;
                                                            $montant_versement = 0;
                                                            $montant_versement_usd = 0;
                                                            $montant_versement_cdf = 0;
                                                            $montant_total_cdf = 0;

                                                            if (isset($feesdetails) && !empty($feesdetails)):
                                                                foreach ($feesdetails as $key => $feedet): ?>

                                                                    <tr class="">

                                                                        <?php if (isset($payments) && !empty($payments)):
                                                                            foreach ($payments as $key => $value):
                                                                                //if($payment['payment_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                            
                                                                                $devise = (!empty(($value['fee_currency_payable'])) ? esc($value['fee_currency_payable']) : '');
                                                                                $taux = (!empty(($value['payment_exchange'])) ? esc($value['payment_exchange']) : '0');

                                                                                if (($value['paydetails_fee_id'] == $feedet['feedetail_id'])) {
                                                                                    if (($value['payment_user_id'] == $user['user_id'])) {

                                                                                        $montant_versement = $value['paydetails_paid_amount'];
                                                                                        //$montant_versement_usd = $value['paydetails_usd_amount'];
                                                                                        //$montant_versement_cdf = $value['paydetails_cdf_amount'];
                                            

                                                                                        $montant_versement_usd = ($devise == 'usd') ? $montant_versement : 0;
                                                                                        $montant_versement_cdf = ($devise == 'cdf') ? $montant_versement : 0;

                                                                                        $montant_total_cdf = ($devise == 'usd') ? ($montant_versement * $taux) + $montant_versement_cdf : $montant_versement_cdf;

                                                                                        $montant_total_percu_usd += $montant_versement_usd;
                                                                                        $montant_total_percu_cdf += $montant_versement_cdf;
                                                                                        $montant_global_percu_cdf = ($devise == 'usd') ? ($montant_total_percu_usd * $taux) + $montant_total_percu_cdf : $montant_total_percu_cdf;

                                                                                        //$montant_user_usd += $montant_total_percu_usd;
                                                                                        //$montant_user_cdf += $montant_total_percu_cdf;
                                                                                        //$montant_global_user_cdf += $montant_global_percu_cdf;
                                                                                        ?>
                                                                                        <td class="font-weight-bold text-uppercase">
                                                                                            <?= trim($feedet['fee_name']); ?>
                                                                                        </td>
                                                                                        <td class="font-weight-bold text-uppercase">
                                                                                            <?= trim($feedet['feedetail_name']); ?>
                                                                                        </td>
                                                                                        <td class="font-weight-bold">
                                                                                            <?= number_format($montant_versement_usd, 2, ',', ' '); ?>
                                                                                        </td>
                                                                                        <td class="font-weight-bold">
                                                                                            <?= number_format($montant_versement_cdf, 2, ',', ' '); ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php }
                                                                                } ?>

                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>


                                                                <?php endforeach; ?>
                                                            <?php endif; ?>

                                                            <tr class="font-weight-bold">
                                                                <td colspan="2" class="text-right text-uppercase">
                                                                    Total Perçu par <?= $user['user_firstname']; ?>
                                                                    <?= $user['user_lastname']; ?>
                                                                </td>
                                                                <td class="font-weight-bold">
                                                                    $ <?= number_format($montant_total_percu_usd, 2, ',', ' '); ?>
                                                                </td>
                                                                <td class="font-weight-bold">
                                                                    FC <?= number_format($montant_total_percu_cdf, 2, ',', ' '); ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
</div>