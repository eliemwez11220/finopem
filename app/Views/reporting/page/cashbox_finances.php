<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                <!-- ====== Start Reporting Header -->
                <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                <!-- ====== End Reporting Header -->
            </div>
        </div>
        <?php //if(//session()->has('choosedsectionname')):?>
        <div class="shadow-lg text-center" style="border:2px solid black">
            <h1 class="text-uppercase font-weight-bold py-3 h3">
                Synthèse de la situation des caisses
                <span class="<?= (session()->has('choosedsectionname')) ? '' : 'd-none'; ?>">
                    <b> - section
                        <?= (session()->has('choosedsectionname')) ? session()->choosedsectionname : ''; ?>
                    </b>
                </span>
            </h1>
        </div>
        <div class="card">
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <?php if(session()->has('feechoosed')): ?>
                        <div class="row">
                            <?php
                        $count = 1;
                        
                        if (isset($feespays) && !empty($feespays)):
                            foreach ($feespays as $key => $recette):
                                
                                    $fee_currency = $recette['fee_currency_payable'];
                                    $feechoosed = session()->get('feechoosed');
                                    if ($feechoosed == $recette['fee_id']): ?>
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
                                                       
                                                        if ($pay['fee_id'] == $recette['fee_id']){

                                                            $payment_amount += $pay['paydetails_paid_amount'];
                                                            $pay_amount = $payment_amount;
                                                        } ?>
                                        <?php endforeach; ?>
                                        <?php  ?>
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
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php else:?>
                        <div class="row">
                            <?php
                        $count = 1;
                        
                        if (isset($feespays) && !empty($feespays)):
                            foreach ($feespays as $key => $recette):
                                if ($recette['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                                                                 
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
                                                        if ($pay['payment_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                       
                                                        if ($pay['fee_id'] == $recette['fee_id']){

                                                            $payment_amount += $pay['paydetails_paid_amount'];
                                                            $pay_amount = $payment_amount;
                                                        } ?>
                                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php  ?>
                                        <?php
                                                    $fee_expense_amount = 0;
                                                    if (isset($expenses) && !empty($expenses)):
                                                        foreach ($expenses as $keyexp => $expense):
                                                            $expense_usd_amount = 0;
                                                            $expense_cdf_amount = 0;
                                                            if ($expense['expense_user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                       
                                                            if ($expense['fee_id'] == $recette['fee_id']):
                                                                if (($expense['expense_type'] != 'exchange')):
                                                                    $expense_usd_amount += $expense['expense_usd_amount'];
                                                                    $expense_cdf_amount += $expense['expense_cdf_amount'];
                                                                    $fee_expense_amount = ($fee_currency == 'usd') ? $expense_usd_amount : $expense_cdf_amount;

                                                                    ?>
                                        <?php endif; ?>
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
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>