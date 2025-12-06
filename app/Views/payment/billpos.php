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

    .wrapper {
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

    <div class="wrapper <?= checkModuleAccess('bills'); ?>">
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
                                <img src="<?= $valid_logo; ?>" alt="..." class="school-logo school-logo-medium">

                                <p class="h4 text-uppercase">
                                    <b class="text-center font-weight-bold fw-bold">
                                        <?= (session()->schoolfname) ? (session()->schoolfname) : ''; ?>
                                    </b>
                                    <br>
                                    <b class="text-center font-weight-bold fw-bold">
                                        <?= (session()->schoolslogan) ? (session()->schoolslogan) : ''; ?>
                                    </b>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row invoice-info" style="margin-top: -12px;">
                        <div class="col-sm-12 ">
                            <address class="small text-center">
                                <strong>
                                    <b>
                                        <?= (session()->schooladdress) ? (session()->schooladdress) : ''; ?><br>
                                        Téléphone: <?= (session()->schoolphone) ? (session()->schoolphone) : ''; ?><br>
                                    </b>

                                </strong>
                            </address>
                        </div>

                    </div>
                    <?php if(isset($bill) && !empty($bill)): ?>
                    <div class="row invoice-info">
                        <div class="col-sm-12">
                            <address style="border:2px solid black" class="text-center text-uppercase small">
                                <strong class="font-weight-bold">
                                    reçu n° <b><?= $bill['payment_code'];?></b> du
                                    <?= date("d/m/Y", strtotime($bill['payment_date'])); ?>
                                </strong>
                                <br>
                                <b>Année <?= (session()->schoolyear) ? session()->schoolyear : ''; ?></b>
                            </address>

                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-12" style="margin-top: -5px;">
                            <address class="text-left text-uppercase font-weight-bold">
                                <b>Etudiant : <?= esc($bill['student_firstname']); ?>
                                    <?= esc($bill['student_lastname']); ?>
                                    <?= esc($bill['student_surname']); ?>
                                    <br>
                                    Promotion :
                                    <?=  $bill['classe_shortname'];  ?> <br>
                                    <?php //(empty($bill['classe_shortname'])) ? $bill['classe_shortname']:$bill['degree_shortname'].' '.($bill['classe_subname']).' '.($bill['option_name']); ?>
                                    <?= (($bill['student_gender'])=="masculin") ? ' a payé':'  a payée';?> : <br>
                                </b>
                            </address>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped table-bordered">
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
                                    <ul class="text-left">
                                        <li class="small text-uppercase font-weight-bold">
                                            <b>
                                                <span
                                                    style="<?= ($fee_total_payable == 1) ? 'display:none':''; ?>"><?= $payment['fee_name']." -"; ?></span>
                                                <span class="text-primary"> <?= $payment['feedetail_name']; ?> [
                                                    <?= number_format($payable_amount, 0, ',', ' ') .' '.$currency_paid; ?>
                                                    ]</span>
                                                <br> Payé:
                                                <?= number_format($pay_amount, 0, ',', ' ') .' '.$currency_paid; ?>
                                                {Reste =
                                                <?= number_format($fee_balance, 2, ',', ' ').' '.$currency_paid; ?> }
                                            </b>
                                            <b>Acompte:<?= number_format($total_old_paid, 0, ',', ' '); ?></b>

                                        </li>
                                    </ul>
                                    <?php } ?>
                                    <?php } ?>
                                    <p class="font-weight-bold text-uppercase mt-2 text-center">
                                        <b style="border-bottom: 2px solid black;border-top: 2px solid black;"> ==
                                            Récapitulatif du versément ==</b>
                                    </p>
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
                                                <?= number_format($montant_total_cdf, 0, ',', ' ').' Fc'; ?>
                                            </b>
                                        </td>
                                        <td class="text-uppercase text-left">
                                            <b class="font-weight-bold">
                                                <?= number_format($montant_total_usd, 0, ',', ' ').' $'; ?>
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
                                                <?= number_format($amount_paid_cdf, 0, ',', ' ').' Fc'; ?>
                                            </b>
                                        </td>
                                        <td class="text-uppercase border-left text-left">
                                            <b class="font-weight-bold">
                                                <?= number_format($amount_paid_usd, 0, ',', ' ').' $'; ?>
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
                                                <?= number_format($amount_returned_cdf, 0, ',', ' ').' Fc'; ?>
                                            </b>
                                        </td>
                                        <td class="text-uppercase border-left text-left">
                                            <b class="font-weight-bold">
                                                <?= number_format($amount_returned_usd, 0, ',', ' ').' $'; ?>
                                            </b>
                                        </td>
                                    </tr>
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
                                                    <b> Edition du
                                                        <?= setFrenchDays(strtolower(date('l'))); ?>
                                                        <?= date('d/m/Y'." à ".'H:i:s'); ?>
                                                    </b>
                                                </span>
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>