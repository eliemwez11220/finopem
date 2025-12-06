<div class="content-wrapper <?= checkModuleAccess('bills'); ?>">
    <?php $date_day = date('Y-m-d'); ?>
    <section class="content">
        <div class="printoff card">
            <div class="card-footer text-center">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <a href="<?= base_url('payments'); ?>" class="btn btn-primary">
                            <i class="fa fa-reply-all fa-lg"></i> Nouveau
                        </a>
                        <a href="<?= base_url('payments-bills'); ?>" class="btn btn-info">
                            <i class="fa fa-list fa-lg"></i> Listing
                        </a>
                        <?php  if(isset($bill) && (!empty($bill))): ?>
                        <a href="<?= base_url('payment/printbill/'.$bill['payment_token']); ?>"
                            class="btn btn-success btn-rounded"><i class="fa fa-print"></i> Imprimer</a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-6 offset-lg-3">
                    <div class="shadow-lg">
                        <div class="text-center py-3">
                                <?php   
                                          $logo = (session()->schoollogo) ? base_url('public/uploads/images/'.session()->schoollogo):''; 
                                          $magstore_logo = base_url('public/img/logo/favicon.png');
                                          $valid_logo = (session()->schoollogo)? $logo: $magstore_logo;
                                      ?>
                               <img src="<?= $valid_logo; ?>" alt="..." class="school-logo school-logo-medium">
                               
                           
                            <h3 class="text-uppercase font-weight-bold lined lined-center">
                                <b><?= (session()->schoolfname) ? (session()->schoolfname) : 'DITOTASE MAGSCHOOL MANAGEMENT'; ?></b>
                            </h3>
                            <address class="">

                                <span class="text-uppercase font-weight-bold">
                                    Adresse:
                                    <?= (session()->schooladdress) ? (session()->schooladdress) : 'Application de gestion des ecoles'; ?>
                                </span>
                                <br>
                                <span class="font-weight-bold border-right ">
                                    Contacts:<?= (session()->schoolphone) ? (session()->schoolphone) : ''; ?>
                                    <span class="text-lowercase">
                                        | <?= (session()->schoolemail) ? (session()->schoolemail) : ''; ?>
                                    </span>
                                </span>
                                
                                <p>========================================</p>
                            </address>

                        </div>

                        <?php if(isset($bill) && !empty($bill)): ?>

                        <div class="text-center">
                            <p style="border:2px solid black">
                                <span class="text-center text-uppercase font-weight-bold">
                                    reçu n° <b><?= $bill['payment_code'];?></b> du
                                    <?= date("d/m/Y", strtotime($bill['payment_date'])); ?>
                                </span>
                                <br>
                                <span class="text-uppercase small font-weight-bold">
                                    <b>Année 
                                        <?= (session()->schoolyear) ? session()->schoolyear : ''; ?>
                                        
                                    </b>
                                </span>
                            </p>


                            <p class="h5 text-uppercase border py-3 text-center">
                                <b>Etudiant : <?= esc($bill['student_firstname']); ?>
                                    <?= esc($bill['student_lastname']); ?>
                                    <?= esc($bill['student_surname']); ?>
                                    <br>
                                    Promotion:
                                    <?= (!empty($bill['classe_shortname'])) ? $bill['classe_shortname']:$bill['degree_shortname'].' '.($bill['classe_subname']).' '.($bill['option_name']); ?>
                                </b>
                            </p>
                        </div>

                        <?php endif; ?>

                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="small text-uppercase">
                                            <th>Description</th>
                                            <th>Budget</th>
                                            <th>Payé</th>
                                            <th>Solde</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php  if (isset($paydetails) && !empty($paydetails)){
                                  $montant_total_cdf = 0;
                                  $montant_total_usd = 0;
                                  $montant_total_solde = 0;
                                  $amount_returned_cdf = 0;
                                  $amount_returned_usd = 0;
                                  $total_amount_paid = 0;
                                  $total_amount_payable = 0;
                                  $total_amount_balance = 0;
                                  $amount_paid_usd = 0;
                                  $amount_paid_cdf = 0;
                                  
                                    foreach ($paydetails as $payment) {
                                        $total_old_paid = 0;
                                        if (isset($payments) && !empty($payments)){ 
                                            foreach ($payments as $pay) {
                                                if ($pay['paydetails_fee_id'] == $payment['feedetail_id']) {

                                                    $total_old_paid += $pay['paydetails_paid_amount'];

                                                } 
                                            }
                                        } 
                                        $currency = $payment['fee_currency_payable'];
                                        $currency_paid = ($currency == 'usd') ? '$':'Fc';
                                        $type_paid = ($payment['paydetails_type'] == 'balance') ? '$':'Fc';
                                        $pay_token = $payment['paydetails_token'];
                                        $pay_amount = $payment['paydetails_paid_amount'];
                                        $pay_usd_amount = $payment['paydetails_usd_amount'];
                                        $pay_cdf_amount = $payment['paydetails_cdf_amount'];

                                        $pay_returned_amount = $payment['paydetails_return_amount'];
                                        $payable_amount = $payment['paydetails_fee_amount'];
                                        
                                        $pay_exchange = $payment['payment_exchange'];
                                        
                                        $fee_total_payable = $payment['fee_total_payable'];
                                        
                                        $montant_total_cdf += $pay_cdf_amount;
                                        $montant_total_usd += $pay_usd_amount;
                                        $fee_balance = $payable_amount - ($pay_amount + $total_old_paid);
                                        $total_amount_payable += $payable_amount;    
                                        $total_amount_balance += $fee_balance;   
                                        //$total_amount_paid += $pay_amount;     

                                        $amount_paid_usd += ($currency == 'usd') ? $pay_amount:0;
                                        $amount_paid_cdf += ($currency == 'cdf') ? $pay_amount:0;
                                        
                                        $amount_returned_cdf += ($currency == 'cdf') ? $pay_returned_amount:0;
                                        $amount_returned_usd += ($currency == 'usd') ? $pay_returned_amount:0;
                                           
                                        $montant_total_solde = ($montant_total_usd * $pay_exchange) + $montant_total_cdf;
                                        ?>
                                        <tr class="small">
                                            <td class="small text-uppercase font-weight-bold">
                                            <b>
                                            <span style="<?= ($fee_total_payable == 1) ? 'display:none':''; ?>"><?= $payment['fee_name']; ?></span>
                                            <span class="text-primary">[<?= $payment['feedetail_name']; ?>]</span>
                                            </b>
                                            </td>

                                            <td class="small font-weight-bold">
                                                <b class="">
                                                    <?= number_format($payable_amount, 0, ',', ' ') .''.$currency_paid; ?>
                                                </b>
                                            </td>
                                            <td class="small font-weight-bold">
                                                <b class="">
                                                    <?= number_format($pay_amount, 0, ',', ' ') .''.$currency_paid; ?>
                                                </b>
                                                <b>=>(+<?= number_format($total_old_paid, 0, ',', ' '); ?>)</b>
                                            </td>
                                            <td class="small font-weight-bold">
                                                <b class="">
                                                    <?= number_format($fee_balance, 2, ',', ' ').''.$currency_paid; ?>
                                                </b>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        <tr class="small">
                                            <td colspan="4">
                                                <p class="font-weight-bold text-uppercase mt-2 text-center">
                                                    <b>Récapitulatif du versément</b>
                                                </p>
                                            </td>
                                        </tr>

                                        <tr class="small text-dark">
                                            <td class="text-uppercase">
                                                <b>Montant</b>
                                            </td>

                                            <td colspan="2" class="text-uppercase">
                                                <b class="font-weight-bold">
                                                    CDF
                                                </b>
                                            </td>
                                            <td class="text-uppercase">
                                                <b class="font-weight-bold">
                                                    USD</b>
                                            </td>


                                        </tr>
                                        <tr class="small text-dark">
                                            <td class="text-uppercase">
                                                <b>Déposé:</b>
                                            </td>

                                            <td colspan="2" class="text-uppercase">
                                                <b class="font-weight-bold">
                                                    <?= number_format($montant_total_cdf, 0, ',', ' '); ?>
                                                </b>
                                            </td>
                                            <td class="text-uppercase text-left">
                                                <b class="font-weight-bold">
                                                    $ <?= number_format($montant_total_usd, 2, ',', ' '); ?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="small">
                                            <td class="text-uppercase">
                                                <b class="font-weight-bold">
                                                    Perçu:
                                                </b>
                                            </td>
                                            <td colspan="2" class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    <?= number_format($amount_paid_cdf, 0, ',', ' '); ?>
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-left text-left">
                                                <b class="font-weight-bold">
                                                    $ <?= number_format($amount_paid_usd, 2, ',', ' '); ?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr class="small">
                                            <td class="text-uppercase">
                                                <b class="font-weight-bold">
                                                    Remis:
                                                </b>
                                            </td>
                                            <td colspan="2" class="text-uppercase border-right">
                                                <b class="font-weight-bold">
                                                    <?= number_format($amount_returned_cdf, 0, ',', ' '); ?>
                                                </b>
                                            </td>
                                            <td class="text-uppercase border-left text-left">
                                                <b class="font-weight-bold">
                                                    <?= number_format($amount_returned_usd, 2, ',', ' '); ?>
                                                </b>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                        <tr class="small">
                                            <td>
                                                <?php $student_data = strtoupper($bill['student_firstname'] .' '. $bill['student_lastname'].' '.$bill['student_surname']. ' ID '.$bill['student_code']. ' OF '. $bill['degree_shortname'].' '.$bill['classe_subname'].' '.$bill['option_name']); ?>
                                                <?php $qrcode_value = $bill['payment_code'].' from '.strtoupper(session()->get('schoolfname')).' at '.$bill['payment_created_at']. ' to '.$student_data; ?>
                                                <img src="<?= base_url('qrcode/' . setSlugTitle($qrcode_value)); ?>"
                                                    alt="..." class="school-logo school-logo-large">
                                            </td>
                                            <td colspan="3">
                                                <div style="border:2px solid black">

                                               
                                                <h5 class="py-3 text-uppercase">
                                                    Printed by : <br/> <span class="font-weight-bold">
                                                        <?= session()->get('name'); ?>
                                                        <?= substr(session()->get('lastname'), 0, 1).'.'; ?>
                                                    </span>
                                                    <br>
                                                </h5>
                                                <h5 class="small">
                                                    <b> Edition du 
                                                    <?= setFrenchDays(strtolower(date('l'))); ?> <?= date('d/m/Y'." à ".'H:i:s'); ?>
                                                    </b>
                                                </h5>
                                                </div>
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
</div>