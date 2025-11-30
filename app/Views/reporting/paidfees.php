<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('reppaidfees'); ?>">
    <section class="content-header printoff">
        <div class="container-fluid">
            <h1 class="font-weight-bold text-uppercase text-center printoff">
                <i class="nav-icon fas fa-donate"></i> Rapport de perception par frais
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
                            Situation journalière de la caisse
                        </h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
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
                                                $montant_total_cdf = 0;

                                                if (isset($fees) && !empty($fees)):
                                                    foreach ($fees as $key => $ligne):
                                                        $montant_versement_usd = 0;
                                                        $montant_versement_cdf = 0;
                                                        ?>
                                                        <tr class="">
                                                            <td class="text-uppercase" rowspan="<?= $ligne['fee_total_payable'] + 1; ?>">
                                                                <span class="font-weight-bold middle">
                                                                    <?= trim($ligne['fee_name']); ?>
                                                                </span>
                                                            </td>
                                                            <?php if (isset($feesdetails) && !empty($feesdetails)):
                                                                foreach ($feesdetails as $key => $feedet):
                                                                    if ($feedet['feedetail_fee_id'] == $ligne['fee_id']): ?>
                                                                    <tr class="">
                                                                        <td class="font-weight-bold text-uppercase">
                                                                            <?= trim($feedet['feedetail_name']); ?>
                                                                        </td>

                                                                        <?php if (isset($payments) && !empty($payments)):
                                                                            foreach ($payments as $key => $value):
                                                                                if ($value['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                                                                    //if ($value['section_id'] == session()->get('choosedsectionid')):
                                            
                                                                                    $devise = (!empty(($value['fee_currency_payable'])) ? esc($value['fee_currency_payable']) : '');
                                                                                    $taux = (!empty(($value['payment_exchange'])) ? esc($value['payment_exchange']) : '0');

                                                                                    if ($value['paydetails_fee_id'] == $feedet['feedetail_id']):

                                                                                        $montant_versement = $value['paydetails_paid_amount'];

                                                                                        $montant_versement_usd = ($devise == 'usd') ? $montant_versement : 0;
                                                                                        $montant_versement_cdf = ($devise == 'cdf') ? $montant_versement : 0;

                                                                                        $montant_total_cdf = ($devise == 'usd') ? ($montant_versement * $taux) + $montant_versement_cdf : $montant_versement_cdf;

                                                                                        $montant_total_percu_usd += $montant_versement_usd;
                                                                                        $montant_total_percu_cdf += $montant_versement_cdf;
                                                                                        $montant_global_percu_cdf = ($devise == 'usd') ? ($montant_total_percu_usd * $taux) + $montant_total_percu_cdf : $montant_total_percu_cdf;

                                                                                        ?>



                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>

                                                                        <td class="font-weight-bold">
                                                                            <?= ($montant_versement_usd == 0) ? ' - ' : number_format($montant_versement_usd, 2, ',', ' '); ?>
                                                                        </td>
                                                                        <td class="font-weight-bold">
                                                                            <?= ($montant_versement_cdf == 0) ? ' - ' : number_format($montant_versement_cdf, 2, ',', ' '); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                            <?php endforeach; ?>

                                                        <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <tr class="font-weight-bold">
                                                    <td colspan="2" class="text-right text-uppercase">Total Général Perçu</td>
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
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
</div>