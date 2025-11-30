<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess(null, 'reporting'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff <?= checkModuleAccess('repcashbox'); ?>">
        <div class="container-fluid">
            <h1 class="font-weight-bold text-uppercase text-center printoff">
                <i class="nav-icon fas fa-donate"></i> Journal des operations caisses
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <?php if (session()->has('choosedsectionid')): ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header text-center" style="border:2px solid black">
                            <h1 class="text-uppercase font-weight-bold">
                                <b><i class="fas fa-chart-pie"></i>
                                    LIVRE DE CAISSE
                                    <i class="fas fa-chart-pie"></i> </b>
                            </h1>
                        </div>
                        <div class="card-body" style="page-break-after: always!important;">
                            <h1 class="font-weight-bold h3 py-3 text-center text-uppercase"
                                style="border:2px solid black">
                                <i class="nav-icon fas fa-donate"></i> Relevés [ <b>USD</b> ]
                            </h1>
                            <?php  
                                        $report_amount=0;  $day_date = date('Y-m-d');
                                        $start_date = (!empty($start))? $start :date('Y-m-d');
                                        $close_date = (!empty($end))? $end :date('Y-m-d');
                                        $yesterday = (!empty($yesterday))? $yesterday :date('Y-m-d', strtotime('-1 day', strtotime($start_date)));
                                        ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th><b>N°</b></th>
                                        <th><b>DATE</b></th>
                                        <th><b>REFERENCE</b></th>
                                        <th><b>OPERATION</b></th>
                                        <th><b>RECETTES {USD} </b></th>
                                        <th><b>DEPENSES {USD} </b></th>
                                        <th><b>SOLDE {USD}</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">
                                            <b style="float:right">REPORT CAISSE USD AU
                                                <?= isset($yesterday) ? $yesterday: date('d/m/Y', strtotime("yesterday")); ?>
                                                =
                                            </b>
                                        </td>
                                        <td class="bg-primary text-center font-weight-bold">
                                            <?php 
                                       
                                       $cash_reporting_amount_usd = 0;
                                       $expense_amount_usd = 0;
                                       $reporting_usd_amount = 0;
                                       /*============ GET REPORT AMOUNT CASH PAYMENTS ===========*/
                                       if(isset($payments_report) && !empty($payments_report)) { 
                                           foreach ($payments_report as $reporting_usd) {
                                            if(($reporting_usd['payment_user_id'] == session()->userid) OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                                    
                                               $currency_reporting_usd = $reporting_usd['fee_currency_payable'];
                                               //$statusreporting_usd = $reporting_usd['paydetails_status'];
                                                     
                                               if(($currency_reporting_usd == 'usd')){

                                                   $pay_amount_reporting_usd = $reporting_usd['paydetails_paid_amount'];
                                                   $cash_reporting_amount_usd +=$pay_amount_reporting_usd;
                                                   //$report_amount_cdf +=$pay_amount_reporting_cdf;
                                               }
                                            }
                                           }
                                       }
                                        /*============ GET REPORT AMOUNT EXPENSES ===========*/
                                        if(isset($expenses_report) && !empty($expenses_report)) { 
                                            foreach ($expenses_report as $expense_report_usd) {
                                                if(($expense_report_usd['expense_user_id'] == session()->userid) OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                                    $status_expense_report_usd = ($expense_report_usd['expense_status']);
                                                    $currency_reporting_expense_usd = ($expense_report_usd['fee_currency_payable']);
                                                    $expense_type_usd = ($expense_report_usd['expense_type']);

                                                    if(($currency_reporting_expense_usd == 'usd') && ($expense_type_usd != 'exchange')){
                                                        $expense_amount_reporting_usd = $expense_report_usd['expense_usd_amount'];
                                                        $expense_amount_usd +=$expense_amount_reporting_usd;
                                                    }
                                                }
                                            }
                                        }
                                        $reporting_usd_amount = $cash_reporting_amount_usd - $expense_amount_usd;
                                        $report_amount += $reporting_usd_amount;
                                        ?>
                                            <b><?= number_format($report_amount, 2, ',', ' '); ?> USD</b>
                                        </td>
                                    </tr>
                                    <?php  
                                    $count = 1;
                                    $total_payment_usd = 0;
                                    $total_payment_cdf = 0;

                                    if(isset($payments) && !empty($payments)) { 
                                     
                                    foreach ($payments as $payment) {
                                        if($payment['payment_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                        $currency = $payment['fee_currency_payable'];
                                        $currency_paid = ($currency == 'usd') ? '$':'Fc';
                                        
                                        $pay_amount = $payment['paydetails_paid_amount'];

                                        $pay_exchange = $payment['payment_exchange'];
                                        $status = (!empty(($payment['paydetails_status'])) ? ($payment['paydetails_status']) : 'inactif');
                                                   
                                        
                                        if(($status != 'cancel') && ($currency == 'usd')){
                                            
                                            $total_payment_usd += ($currency == 'usd') ? $pay_amount:0;

                                            $report_amount +=$pay_amount;

                                        ?>
                                    <tr class="">
                                        <td width="1" class="font-weight-bold">
                                            <?= $count++; ?>
                                        </td>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= $payment['payment_date']; ?>
                                        </td>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= $payment['payment_code']; ?>
                                        </td>
                                        <td class="small text-uppercase font-weight-bold">
                                            Paiement
                                            <?= $payment['fee_name']; ?>

                                            [<span class="text-primary font-weight-bold">
                                                <?= $payment['feedetail_name']; ?>
                                            </span>]
                                        </td>

                                        <td class="font-weight-bold text-center">
                                            <span class="">
                                                <?= number_format($pay_amount, 2, ',', ' '); ?>
                                            </span>
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            -
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format($report_amount, 2, ',', ' '); ?>
                                        </td>
                                    </tr>
                                    <?php }}}} ?>
                                    <?php
                                    $total_expense_cdf = 0;
                                    $total_expense_usd = 0;
                                        if(isset($expenses) && (!empty($expenses))):
                                        
                                            foreach ($expenses as $keyexpense => $expense): 
                                                if($expense['expense_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){

                                            $statusexpense = trim($expense['expense_status']);
                                            //$exchange = ($expense['expense_exchange']);
                                            $mnt_sorti_usd = trim($expense['expense_usd_amount']);
                                            //$mnt_sorti_cdf = ($expense['expense_cdf_amount']);
                                            $currency_cashbox = trim($expense['fee_currency_payable']);
                                            
                                            
                                            if(($expense['expense_type'] != 'exchange') && ($currency_cashbox == 'usd')):
                                                $amount_expense = ($currency_cashbox == 'usd') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                                //$expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';
                                                //$total_expense_cdf += $mnt_sorti_cdf;
                                               $total_expense_usd += $mnt_sorti_usd;
                                                $report_amount -= $mnt_sorti_usd;
                                            ?>
                                    <tr class="font-weight-bold">
                                        <td><?= $count++; ?></td>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= $expense['expense_date']; ?>
                                        </td>
                                        <td class="font-weight-bold"><?= trim($expense['expense_code']); ?></td>
                                        <td class="text-uppercase small font-weight-bold">
                                            <?= $expense['expense_notes']; ?>

                                            [ <span class="text-uppercase text-primary">
                                                <?= trim($expense['expense_requested_by']); ?>
                                            </span>]

                                        </td>
                                        <td class="font-weight-bold text-center">
                                            -
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format($mnt_sorti_usd, 2, ',', ' '); ?>
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format($report_amount, 2, ',', ' '); ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php } ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <tr class="font-weight-bold">
                                        <td colspan="4" class="text-uppercase font-weight-bold">
                                            Total des opérations</td>

                                        <td class="font-weight-bold text-center">
                                            <?= number_format($total_payment_usd, 2, ',', ' '); ?>
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format($total_expense_usd, 2, ',', ' '); ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-uppercase font-weight-bold">
                                            <h6 class="mt-3 font-weight-bold">
                                                SOLDE EN FIN DE JOURNEE AU
                                                <?= date("d/m/Y", strtotime($close_date)); ?>
                                            </h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="alert alert-primary">
                                                <b><?= number_format($report_amount, 2, ',', ' '); ?> USD</b>
                                            </h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <h1 class="font-weight-bold h3 py-3 text-center text-uppercase"
                                style="border:2px solid black">
                                <i class="nav-icon fas fa-donate"></i> Relevés [ <b>CDF</b> ]
                            </h1>
                            <?php $report_amount_cdf=0; $report_amount=0; $reportHier=0; $mt =0; $disponible=0; $day_date = date('Y-m-d');?>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th><b>N°</b></th>
                                        <th><b>DATE</b></th>
                                        <th><b>REFERENCE</b></th>
                                        <th><b>OPERATION</b></th>
                                        <th><b>RECETTES {CDF} </b></th>
                                        <th><b>DEPENSES {CDF} </b></th>
                                        <th><b>SOLDE {CDF}</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">
                                            <b style="float:right">REPORT CAISSE CDF AU
                                                <?= isset($yesterday) ? $yesterday: date('d/m/Y', strtotime("yesterday")); ?>
                                                =
                                            </b>
                                        </td>
                                        <td class="bg-primary text-center font-weight-bold">
                                            <?php 
                                        $cash_reporting_amount_cdf = 0;
                                        $expense_amount_cdf = 0;
                                        $reporting_cdf_amount = 0;
                                        /*============ GET REPORT AMOUNT CASH PAYMENTS ===========*/
                                        if(isset($payments_report) && !empty($payments_report)) { 
                                            foreach ($payments_report as $reporting_cdf) {
                                                if($reporting_cdf['payment_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                                $currency_reporting_cdf = $reporting_cdf['fee_currency_payable'];
                                                //$statusreporting_cdf = (!empty($reporting_cdf['paydetails_status']) ? ($reporting_cdf['paydetails_status']) : 'inactif');
                                                      
                                                if(($currency_reporting_cdf == 'cdf')){
                                                    $pay_amount_reporting_cdf = $reporting_cdf['paydetails_paid_amount'];
                                                    //$cash_reporting_amount_cdf +=$reporting_cdf['paydetails_cdf_amount'];
                                                    $cash_reporting_amount_cdf +=$pay_amount_reporting_cdf;
                                                }
                                            }
                                            }
                                        }
                                        /*============ GET REPORT AMOUNT EXPENSES ===========*/
                                       
                                        if(isset($expenses_report) && !empty($expenses_report)) { 
                                            foreach ($expenses_report as $expense_report_cdf) {
                                                if(($expense_report_cdf['expense_user_id'] == session()->userid)  OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                                //$status_expense_report_cdf = ($expense_report_cdf['expense_status']);
                                                $currency_reporting_cdf = trim($expense_report_cdf['fee_currency_payable']);
                                                $expense_type_cdf = trim($expense_report_cdf['expense_type']);
                                                
                                                //ALL OPERATIONS BASED ON EXPENSE AND RETURNING 
                                                if(($currency_reporting_cdf == 'cdf') && ($expense_type_cdf != 'exchange')){
                                                    $expense_amount_reporting_cdf = $expense_report_cdf['expense_cdf_amount'];
                                                    $expense_amount_cdf +=$expense_amount_reporting_cdf;
                                                }
                                            }
                                            }
                                        }
                                        $reporting_cdf_amount = $cash_reporting_amount_cdf - $expense_amount_cdf;
                                        $report_amount_cdf += $reporting_cdf_amount;
                                        ?>
                                            <b><?= number_format($report_amount_cdf, 2, ',', ' '); ?> CDF</b>
                                        </td>
                                    </tr>
                                    <?php  $count = 1; $total_payment_cdf = 0;
                                if(isset($payments) && !empty($payments)) {
                                      foreach ($payments as $payment) {
                                        if(($payment['payment_user_id'] == session()->userid)  OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                          $currency = $payment['fee_currency_payable'];
                                          $currency_paid = ($currency == 'usd') ? '$':'Fc';
                                          
                                          $pay_amount = $payment['paydetails_paid_amount'];
  
                                          $pay_exchange = $payment['payment_exchange'];
                                          $status = (!empty(($payment['paydetails_status'])) ? ($payment['paydetails_status']) : 'inactif');
                                                     
                                          
                                          if(($status != 'cancel') && ($currency == 'cdf')){
                                              
                                              $total_payment_cdf += ($currency == 'cdf') ? $pay_amount:0;
  
                                              $report_amount_cdf +=$pay_amount;
  
                                          ?>
                                    <tr class="">
                                        <td width="1" class="font-weight-bold">
                                            <?= $count++; ?>
                                        </td>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= $payment['payment_date']; ?>
                                        </td>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= $payment['payment_code']; ?>
                                        </td>
                                        <td class="small text-uppercase font-weight-bold">
                                            Paiement
                                            <?= $payment['fee_name']; ?>

                                            [<span class="text-primary font-weight-bold">
                                                <?= $payment['feedetail_name']; ?>
                                            </span>]
                                        </td>

                                        <td class="font-weight-bold text-center">
                                            <span class="">
                                                <?= number_format($pay_amount, 2, ',', ' '); ?>
                                            </span>
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            -
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format($report_amount_cdf, 2, ',', ' '); ?>
                                        </td>
                                    </tr>
                                    <?php }}}} ?>
                                    <?php
                                        if(isset($expenses) && (!empty($expenses))):
                                        $total_expense_cdf = 0;
                                            $total_expense_usd = 0;
                                            foreach ($expenses as $keyexpense => $expense): 
                                                if($expense['expense_user_id'] == session()->userid  OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                            $statusexpense = ($expense['expense_status']);
                                            //$exchange = ($expense['expense_exchange']);
                                            $mnt_sorti_cdf = ($expense['expense_cdf_amount']);
                                            $currency_cashbox = ($expense['fee_currency_payable']);
                                            
                                            
                                            if(($expense['expense_type'] == 'expense') && ($statusexpense != 'cancel') && ($currency_cashbox == 'cdf')):
                                                $amount_expense = ($currency_cashbox == 'cdf') ? $mnt_sorti_usd : $mnt_sorti_usd;
                                                //$expense_input_prefix = ($currency_cashbox == 'usd') ? '$' : 'Fc';
                                                $total_expense_cdf += $mnt_sorti_cdf;
                                                $report_amount_cdf -= $mnt_sorti_cdf;
                                            ?>
                                    <tr class="font-weight-bold">
                                        <td><?= $count++; ?></td>
                                        <td class="font-weight-bold"><?= ($expense['expense_date']); ?></td>
                                        <td class="font-weight-bold"><?= ($expense['expense_code']); ?></td>
                                        <td class="text-uppercase small font-weight-bold">
                                            <?= ($expense['expense_notes']); ?>

                                            [ <span class="text-uppercase text-primary">
                                                <?= ($expense['expense_requested_by']); ?>
                                            </span>]

                                        </td>
                                        <td class="font-weight-bold text-center">
                                            -
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format(($mnt_sorti_cdf), 2, ',', ' '); ?>
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format(($report_amount_cdf), 2, ',', ' '); ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php } ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <tr class="font-weight-bold">
                                        <td colspan="4" class="text-uppercase font-weight-bold">
                                            Total des opérations</td>

                                        <td class="font-weight-bold text-center">
                                            <?= number_format(($total_payment_cdf), 2, ',', ' '); ?>
                                        </td>
                                        <td class="font-weight-bold text-center">
                                            <?= number_format(($total_expense_cdf), 2, ',', ' '); ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-uppercase font-weight-bold">
                                            <h6 class="mt-3 font-weight-bold">
                                                SOLDE EN FIN DE JOURNEE AU
                                                <?= date("d/m/Y", strtotime($close_date)); ?>
                                            </h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="alert alert-info">
                                                <b><?= number_format(($report_amount_cdf), 2, ',', ' '); ?>
                                                    CDF</b>
                                            </h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- === INCLUDE FOOTER === -->
        <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
        <!-- === INCLUDE FOOTER === -->
    </section>

    <?php endif; ?>
</div>