<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- FOR XSS ATTACKS -->
    <meta charset="utf-8">
    <?= csrf_meta() ?>
    <!-- Locale -->
    <!-- To the Future  Meta Tags -->
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title> <?= (isset($title)) ? $title : ' Tableau de bord '; ?> | FINOPEM</title>

    <link rel="icon" type="image/png" href="<?= base_url('public/img/logo/favicon.png'); ?>" />

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?= base_url('public/vendors/epos/bs.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/vendors/epos/page.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url(relativePath: 'public/vendors/epos/fa.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url(relativePath: 'public/vendors/epos/icons.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url(relativePath: 'public/vendors/epos/font.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('public/vendors/fontawesome/css/all.min.css'); ?>">
    <!-- Select2 for select items options-->
    <link rel="stylesheet" href="<?= base_url('public/css/main-styles.css'); ?>">
    <style type="text/css" media="print">
    .printoff {
        display: none !important;
    }

    @media print {
        @page {
            max-height: 100% !important;
            max-width: 100% !important;
            width: 100% !important;
            height: 100% !important;
            margin: 2px !important;
            /*margin-bottom: 30px !important;
            margin-left: 1px !important;
            margin-right: 1px !important;*/
            padding: 0 !important;
            /*zoom: 120% !important;
            size: A4 <-?=((isset($orientation)) ? $orientation : "portrait") ?>;*/
        }
    }
    </style>
    <style>
    body {
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-weight: 400;
    }
    .wrapper{
        max-height: 100% !important;
            max-width: 100% !important;
            width: 100% !important;
            height: 100% !important;
        /*overflow-x:clip;
            overflow-y:auto*/
    }
    </style>
</head>

<body onload="window.print();">
    <?php $date_day = date('Y-m-d'); ?>

    <div class="wrapper">
        <div class="printoff">
            <div class="jumbotron text-center bg-info">
                <h1 class="lined lined-center text-uppercase">Impression reçu</h1>
                <p>
                        <a href="<?= base_url('payments'); ?>" class="btn btn-danger">
                            <i class="fa fa-reply-all fa-lg"></i> Accueil
                        </a>
                        <a href="<?= base_url('payments'); ?>" class="btn btn-primary">
                            <i class="fa fa-plus fa-lg"></i> Nouveau
                        </a>
                        <a href="<?= base_url('payments-bills'); ?>" class="btn btn-info">
                            <i class="fa fa-list fa-lg"></i> Listing
                        </a>
                        <?php  if(session()->has('paymenttoken') OR ($bill['payment_date'] ==  $date_day)): ?>
                        <a href="javascript:void();" class="btn btn-success btn-rounded" onclick="window.print();"><i
                                class="fa fa-print"></i> Imprimer</a>
                        <?php endif; ?>
                    </p>
            </div>
        </div>
        <section class="invoice text-center">
            <div class="row">
            <div class="col-sm-3 col-lg-3"></div>
                <div class="col-sm-6 col-lg-6">
                    <div class="row invoice-info">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <?php  $logo = (session()->schoollogo) ? base_url('public/uploads/images/'.session()->schoollogo):''; 
                                $magstore_logo = base_url('public/img/logo/favicon.png');
                                $valid_logo = (session()->schoollogo)? $logo: $magstore_logo;
                            ?>
                                <img src="<?= $valid_logo; ?>" alt="..." class="school-logo school-logo-small">


                                <p class="h5 text-uppercase">
                                    <b class="text-center font-weight-bold fw-bold">
                                        <?= (session()->schoolfname) ? (session()->schoolfname) : 'DITOTASE MAGSCHOOL'; ?>
                                    </b>
                                </p>
                                <b class="text-center font-weight-bold fw-bold">
                                    <?= (session()->schoolslogan) ? (session()->schoolslogan) : ''; ?>
                                    </b>
                            </div>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-12 ">
                            <address class="small text-center">
                                <strong>
                                    <b>
                                        Adresse:
                                        <?= (session()->schooladdress) ? (session()->schooladdress) : ''; ?><br>
                                        Telephone: <?= (session()->schoolphone) ? (session()->schoolphone) : ''; ?><br>
                                        Email:
                                        <?= (session()->schoolemail) ? (session()->schoolemail) : ''; ?></b></strong>
                            </address>
                        </div>

                    </div>
                    <?php if(isset($bill) && !empty($bill)): ?>
                    <div class="row invoice-info">
                        <div class="col-sm-12">
                            <address style="border:2px solid black" class="text-center text-uppercase small">
                                <strong class="font-weight-bold">
                                    reçu n° <b><?= $bill['payment_code'];?></b> du
                                    <?= date("d/m/Y H:i:s", strtotime($bill['payment_created_at'])); ?>
                                </strong>
                                <br>
                                <b>Année <?= (session()->schoolyear) ? session()->schoolyear : ''; ?></b>
                            </address>

                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-12">
                            <address class="text-uppercase">
                                <b>Etudiant : <?= esc($bill['student_firstname']); ?>
                                    <?= esc($bill['student_lastname']); ?>
                                    <?= esc($bill['student_surname']); ?>
                                    <br>
                                    Promotion:
                                    <?= (!empty($bill['classe_shortname'])) ? $bill['classe_shortname']:$bill['degree_shortname'].' '.($bill['classe_subname']).' '.($bill['option_name']); ?>
                                </b>
                            </address>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Table row -->
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
                                        $fee_balance = $payable_amount - $pay_amount;
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
                                        </td>
                                        <td class="small font-weight-bold">
                                            <b class="">
                                                <?= ($payment['paydetails_type'] == 'deposit') ? number_format($fee_balance, 2, ',', ' ').''.$currency_paid: '0.00'; ?>
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
                                                $ <?= number_format($montant_total_usd, 0, ',', ' '); ?>
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
                                                $ <?= number_format($amount_paid_usd, 0, ',', ' '); ?>
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
                                                $ <?= number_format($amount_returned_usd, 0, ',', ' '); ?>
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
                                            <h5 class="text-uppercase" style="border:2px solid black">
                                                Printed by : <span class="font-weight-bold">
                                                    <?= session()->get('name'); ?>
                                                    <?= substr(session()->get('lastname'), 0, 1).'.'; ?>
                                                    (<?= session()->get('usercode'); ?>)</br>
                                                    <b class="small">
                                                        <?= date('l d-m-Y'." à ".'H:i:s'); ?></b>
                                                </span>
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Call of Duty</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome</td>
                                <td>$64.50</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Need for Speed IV</td>
                                <td>247-925-726</td>
                                <td>Wes Anderson umami biodiesel</td>
                                <td>$50.00</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Monsters DVD</td>
                                <td>735-845-642</td>
                                <td>Terry Richardson helvetica tousled street art master</td>
                                <td>$10.70</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Grown Ups Blue Ray</td>
                                <td>422-568-642</td>
                                <td>Tousled lomo letterpress</td>
                                <td>$25.99</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">

                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango
                        imeem plugg dopplr
                        jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                </div>

                <div class="col-xs-6">
                    <p class="lead">Amount Due 2/22/2014</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$265.24</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div> -->
                </div>
            </div>
        </section>

    </div>

</body>

</html>