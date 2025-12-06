<div class="content-wrapper">
    <section class="content <?= checkModuleAccess('payments'); ?>">
        <div class="card">
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 text-center">
                        <h1 class="font-weight-bold text-uppercase lined lined-center">
                            <i class="nav-icon fas fa-hand-holding-usd"></i> Gestion Paiements frais
                        </h1>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="shadow-sm">
                            <form role="form" id="ajax_form_sections" method="get">
                                <div class="form-floating input-group" style="width: 100%!important;">
                                    <select id="ajax_sections" name="ajax_sections" title="Classe"
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info">
                                        <option disabled selected>--sélectionnez--</option>
                                        <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                        <option value="all">Toutes les facultés</option>
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
                                        <span class="text-danger">*</span>Facultés</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php  if (session()->has('choosedsectionid')):  ?>
                    <div class="col-sm-6 col-lg-5">
                        <div class="shadow-sm">
                            <form role="form" id="form_ajax_students" method="get">
                                <div class="form-floating input-group" style="width: 100%!important;">
                                    <label for="ajax_student"></label>
                                    <select id="ajax_student" name="ajax_student" title="Eleve"
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info">
                                        <option disabled selected>--sélectionnez un étudiant-- </option>

                                        <?php $count = 1;
                                if (isset($studentsinscriptions) && !empty($studentsinscriptions)):
                                  foreach ($studentsinscriptions as $keystudent => $studentval): 
                                    $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid'):'';
                                    if (($branch_access == $studentval['section_id'])):
                                  ?>
                                        <option value="<?= esc($studentval['inscription_id']); ?>"
                                            <?= (session()->has('studentchoosed') && (session()->studentchoosed == $studentval['inscription_id']))?'selected':set_select('ajax_student', esc($studentval['inscription_id'])); ?>>
                                            <?= strtoupper($studentval['student_firstname']); ?>
                                            <?= strtoupper($studentval['student_lastname']); ?>
                                            <?= strtoupper($studentval['student_surname']); ?>
                                            (<?= strtoupper($studentval['student_code']); ?>) |
                                            
                                            <?= strtoupper(trim($studentval['classe_shortname'])); ?>
                                        </option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="ajax_student" class="font-weight-bold text-uppercase">
                                        <span class="text-danger">*</span>
                                        étudiant
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <?php if(isset($student) && !empty($student)):?>
                       
                            <form role="form" id="form_ajax_fees_paid" method="get">
                                <div class="form-floating input-group" style="width: 100%!important;">
                                    <label for=""></label>
                                    <select id="ajax_fees_paid" name="ajax_fees_paid" title="Classe"
                                        class="form-control select2 select2-info text-uppercase font-weight-bold"
                                        data-dropdown-css-class="select2-info">
                                        <option disabled selected>-- sélectionnez le frais-- </option>

                                        <?php $count = 1;
                                        if (isset($feespayables) && !empty($feespayables)):
                                        foreach ($feespayables as $key => $value): ?>
                                        <option value="<?= esc($value['fee_id']); ?>"
                                            <?= (session()->feepaidid && (session()->feepaidid == $value['fee_id']))?'selected':set_select('ajax_fees_paid', esc($value['fee_id'])); ?>>
                                            <?= strtoupper($value['fee_name']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="ajax_fees_paid" class="font-weight-bold text-uppercase">
                                        <span class="text-danger">*</span>
                                        Frais a perception
                                    </label>
                                </div>
                            </form>
                        
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                    $date_jour_start = date('Y-m-d');
                    $paydate = session()->has('paydate') ? session()->get('paydate'): date('Y-m-d');
                    //Date minimale
                    //$date_max_naissance = new DateTime($date_jour);
                    //$date_max_naissance->modify('-18 year');
                    $date_max = ((new DateTime())->modify('+1 year'))->format('Y-m-d');
                    $date_min_admin = ((new DateTime())->modify('-90 day'))->format('Y-m-d');
                    $date_min_user = ((new DateTime())->modify('-5 day'))->format('Y-m-d');
                    $date_min =  (session()->admin == TRUE OR session()->all == TRUE)?$date_min_admin:$date_min_user;
                   
               if(isset($exchange) && !empty($exchange)):
                ?>
            <div class="card-body">
                <div class="row mb-2">
                    <?php if(isset($student) && !empty($student)):?>
                    <?php  if(isset(session()->feepaidchoosed) && !empty(session()->feepaidchoosed)): ?>
                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                        <blockquote>
                            <div class="text-left">
                                <span class="font-weight-bold h5">
                                    REPARTITION BUDGETAIRE
                                </span>
                                <span class="text-danger font-weight-bold text-uppercase">
                                    <?=  session()->get('feepaidchoosed')['fee_name']; ?>
                                    {<?=  session()->get('feepaidchoosed')['fee_currency_payable']; ?>}
                                </span>
                            </div>
                        </blockquote>
                    </div>
                    <div
                        class="col-lg-3 col-sm-6 col-xs-12 mb-2 <?= (! session()->has('feepaidchoosed')) ? 'd-none':''; ?>">
                        <h5 class="font-weight-bold small text-uppercase">
                            <span class="text-danger">*</span>Date de perception frais
                        </h5>
                        <form action="<?= base_url('paymentDateApplying'); ?>" id="form_date_apply" method="get">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="date" name="paydate" class="form-control" value="<?= $paydate; ?>"
                                    max="<?= date('Y-m-d'); ?>" min="<?= $date_min; ?>"/>

                                <div class="input-group-append ">
                                    <button type="submit"
                                        class="btn btn-primary">
                                        <i class="fas fa-check-circle"></i>Appliquer</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-xs-12 mb-2">
                        <?php
                //FORMULAIRE 
                    $fee_id = session()->feepaidchoosed['fee_id'];
                    $attributes = array('autocomplete' => 'off');
                    echo form_open(base_url('create-payment/'.$student['inscription_id'].'/'.$fee_id), $attributes);
                ?>

                        <h5 class="font-weight-bold small text-uppercase">
                            <span class="text-danger">*</span>TAUX DE CHANGE
                        </h5>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    1$ =
                                </span>
                            </div>
                            <input type="text" readonly name="exchange" class="form-control text-center"
                                value="<?= number_format($exchange['exchange_value'], 2); ?>" />
                            <div class="input-group-append ">
                                <span class="input-group-text">
                                    CDF
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php  if(isset($feesclasses) && !empty($feesclasses)):?>
                    <?php $access_fees = (session()->get('config') == TRUE OR session()->all == TRUE)? '': 'd-none'; ?>
                    <div class="col-md-12">
                        <div class="text-center" style="padding-bottom: 30px;padding-top: -50px;border-radius:6px;">

                            <fieldset>
                                <table class="table table-bordered table-sm" id="datatablesExample">
                                    <thead>
                                        <tr class="small">
                                            <th>FRAIS</th>
                                            <th class=" <?= $access_fees; ?>">MONTANT</th>
                                            <th class=" <?= $access_fees; ?>">BOURSE</th>

                                            <th>BUDGET</th>
                                            <th>CASH </th>
                                            <th>SOLDE</th>
                                            <th class="bg-info text-center">
                                                <h5 class="font-weight-bold text-uppercase">
                                                    PERCEPTION FRAIS AU 
                                                    <span class="text-primary">
                                                        <?= setFrenchDays(date("l", strtotime($paydate))); ?>
                                                        <?= date("d/m/Y", strtotime($paydate)); ?>
                                                    </span>
                                                    <?php if(session()->paymenttoken): ?>
                                                    <a href="<?= base_url('payment/printbill/' . session()->paymenttoken); ?>"
                                                        class="mt-1 btn btn-primary btn-lg" data-toggle="tooltip"
                                                        data-placement="top" title="Cliquer pour imprimer le reçu">
                                                        <i class="fas fa-print fa-lg"></i>
                                                        </span>
                                                    </a>

                                                    <?php endif; ?>
                                                </h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($feesclasses) && !empty($feesclasses)){ 
                                                
                                                $total_fee = 0;
                                                
                                               
                                                $balance = 0;
                                                $count_records = 0;
                                                $total_fees_amount = 0;
                                                $total_paid_amount = 0;
                                                $total_discount_amount = 0;
                                                $total_daily_paid = 0;
                                                $count=0;
                                                $i=0;
                                                //GET ALL FEES CLASSES
                                                foreach ($feesclasses as $reponse) {
                                                    $count_records++;
                                                    $feedetail_id = $reponse['feedetail_id'];
                                                    $total_fee = $reponse['feedetail_cost_payable'];
                                                    $inputs = FALSE;
                                                    
                                                    $total_paid = 0;
                                                    $total_to_paid = 0;
                                                    $total_discount = 0;
                                                    $classe_exemption = 0;
                                                    $student_exemption = 0;
                                                    // GET ALL STUDENTS EXEMPTIONS
                                                    if (isset($feesexemptions) && !empty($feesexemptions)){
                                                        foreach ($feesexemptions as $discount) {
                                                            if ($discount['feediscount_feedetail_id'] == $reponse['feedetail_id']) {
                                                                //Student Exemption
                                                                if (isset($studentexemptions) && !empty($studentexemptions)){ 
                                                                    foreach ($studentexemptions as $studentexemption) {
                                                                        if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                            $student_exemption += $studentexemption['exemption_cost_discount'];
                                                                        } 
                                                                    } 
                                                                }
                                                                //classe exemption
                                                                if (isset($classesexemptions) && !empty($classesexemptions)){ 
                                                                    foreach ($classesexemptions as $classeexemption) {
                                                                        if (($classeexemption['exemptionclasse_exemption_id'] == $discount['feediscount_exemption_id'])) {
                                                                           
                                                                            $classe_exemption += $classeexemption['exemption_cost_discount'];
                                                                            
                                                                        } 
                                                                    } 
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $total_discount += $student_exemption + $classe_exemption;

                                                    if (isset($payments) && !empty($payments)){ 
                                                        foreach ($payments as $pay) {
                                                            if ($pay['paydetails_fee_id'] == $reponse['feedetail_id']) {
                                                                $total_paid = $pay['paydetails_paid_amount'];
                                                                
                                                                //$today = date('Y-m-d');
                                                                if ($pay['payment_date'] == $paydate) {
                                                                    
                                                                    $total_daily_paid += $total_paid;

                                                                } 
                                                            } 
                                                        }
                                                    } 
                                                            
                                                    $balance = ($total_fee - $total_discount) - $total_paid;
                                                    $total_paid_amount += $total_paid;

                                                    $total_to_paid = $total_fee - $total_discount; 
                                                    $total_fees_amount += $total_fee;
                                                    $total_discount_amount += $total_discount;
                                                    $currency = ($reponse['fee_currency_payable'] == 'usd') ? '$':'Fc';
                                                    $balance_net =($total_fees_amount - $total_discount_amount)-$total_paid_amount;
                                                            
                                                ?>
                                        <tr class="small">
                                            <td class="d-none"><input type="hidden"
                                                    name="paidFeeclasseId<?= $feedetail_id; ?>"
                                                    value="<?= $feedetail_id; ?>"></td>
                                            <td class="text-uppercase font-weight-bold text-primary">
                                                <?= $reponse['feedetail_name']; ?></td>
                                            <td class="<?= $access_fees; ?>">
                                                <span class="badge badge-primary font-weight-bold">
                                                    <?= number_format($total_fee, 2, ',', ' '); ?>
                                                </span>
                                            </td>
                                            <td class="<?= $access_fees; ?>">
                                                <span class="badge badge-warning font-weight-bold">
                                                    <?= number_format($total_discount, 2, ',', ' '); ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold text">
                                                <span class="badge badge-dark">
                                                    <?= number_format($total_to_paid, 2, ',', ' '); ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">

                                                <span class="
                                                <?php  if ($balance == 0) {
                                                                echo 'badge badge-success';
                                                            } elseif (($balance != 0) && ($total_paid != 0)) {
                                                                echo 'badge badge-warning';
                                                            } else {
                                                                echo 'badge badge-primary';
                                                            }
                                                            ?>">
                                                    <?= number_format($total_paid, 2, ',', ' ');?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">
                                                <span class="badge badge-<?= ($balance ==0) ? 'success':'danger'; ?>">
                                                    <?= number_format($balance, 2, ',', ' ');?>
                                                </span>
                                            </td>

                                            <td class="shadow-lg">
                                                <div class="row">
                                                    <?php if($balance == 0){ ?>
                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                        <span class="text-uppercase text-success font-weight-bold">
                                                            100% Frais Payé <i class="far fa-check-circle"></i>
                                                        </span>
                                                    </div>
                                                    <?php }else{?>

                                                    <div
                                                        class="col-lg-6 col-sm-12 col-xs-12 mb-2 <?= ($i++ == 0) ? '':'d-none'; ?>">
                                                        <div class="form-floating  mb-2">
                                                            <input class="form-control text-left float-left" type="text"
                                                                name="USDAmount<?= $feedetail_id; ?>"
                                                                id="USDAmount<?= $feedetail_id; ?>" placeholder="0.00"
                                                                value="<?= old('USDAmount'.$feedetail_id); ?>" autofocus
                                                                max="<?= $total_to_paid; ?>" data-mask
                                                                data-inputmask="'alias': 'currency', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                                                style="text-align: left!important;" />

                                                            <label for="USDAmount<?= $feedetail_id; ?>"
                                                                class="control-label">
                                                                <span class="text-danger">*</span>Montant versé
                                                                en USD
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-sm-12 col-xs-12 mb-2 <?= ($i++ == 1) ? '':'d-none'; ?>">

                                                        <div class="form-floating  mb-2">
                                                            <input class="form-control text-left float-left" type="text"
                                                                name="CDFAmount<?= $feedetail_id; ?>"
                                                                id="CDFAmount<?= $feedetail_id; ?>" placeholder="0.00"
                                                                value="<?= old('CDFAmount'.$feedetail_id); ?>" autofocus
                                                                max="<?= $total_to_paid; ?>" data-mask
                                                                data-inputmask="'alias': 'currency', 'prefix':'FC ','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                                                style="text-align: left!important;" />

                                                            <label for="CDFAmount<?= $feedetail_id; ?>"
                                                                class="control-label">
                                                                <span class="text-danger">*</span>Montant versé
                                                                en CDF
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php  } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                        <tr class="text-uppercase font-weight-bold">
                                            <td>Totaux</td>
                                            <td class="<?= $access_fees; ?>">
                                                <span class="badge badge-primary small">
                                                    <?= number_format($total_fees_amount, 2, ',', ' ').' '.$currency; ?>
                                                </span>
                                            </td>
                                            <td class="<?= $access_fees; ?>">
                                                <span class="badge badge-warning small">
                                                    <?= number_format($total_discount_amount, 2, ',', ' ').' '.$currency; ?>
                                                </span>
                                            </td>
                                            <td class="small">
                                                <span class="badge badge-dark">
                                                    <?= number_format($total_fees_amount - $total_discount_amount, 2, ',', ' ').' '.$currency; ?>
                                                </span>
                                            </td>
                                            <td class="small">
                                                <span class="badge badge-<?= ($balance ==0) ? 'success':'primary'; ?>">
                                                    <?= number_format($total_paid_amount, 2, ',', ' ').' '.$currency; ?>
                                                </span>
                                            </td>
                                            <td class="small">
                                                <span
                                                    class="badge badge-<?= ($balance_net ==0) ? 'success':'danger'; ?>">
                                                    <?= number_format($balance_net, 2, ',', ' ').' '.$currency; ?>
                                                </span>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="<?= ($access_fees == 'd-none') ? '4':'6'; ?>" class="">
                                                <input type="hidden" name="nbPayableFees"
                                                    value="<?= $count_records; ?>">

                                                <input type="hidden" name="totalDiscountFees"
                                                    value="<?= $total_discount_amount; ?>">
                                                <input type="hidden" name="totalPayableFees"
                                                    value="<?= $total_fees_amount - $total_discount_amount; ?>">
                                                <input type="hidden" name="totalPaidFees"
                                                    value="<?= $total_paid_amount; ?>">
                                                <input type="hidden" name="balanceFees" value="<?= $balance_net; ?>">

                                                <div class="row">
                                                    <div class="form-floating col-lg-12 col-sm-12 col-xs-12">
                                                        <textarea name="notes" id="notes" class="form-control" rows="10"
                                                            cols="30"
                                                            placeholder="Ex: Nom de la personne qui paie"><?= old('notes'); ?></textarea>

                                                        <label for="notes"> <span class="text-danger"></span>Saisissez
                                                            une note
                                                            interne sur le paiement...</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center bg-info">
                                                
                                           
                                                <p class="badge badge-danger text-uppercase font-weight-bold h5">
                                                    Aujoud'hui, vous avez perçu pour cet élève, une somme de 
                                                    <?= number_format($total_daily_paid, 2, ',', ' ').' '.$currency; ?>
                                                </p>
                                                <br>
                                                <?php if($balance_net == 0): ?>
                                                <a href="" class="btn text-center mt-1">
                                                    <span class="h3 text-success font-weight-bold ">
                                                        <i class="far fa-check-circle fa-2x"></i>
                                                    </span>
                                                </a>
                                                <?php else: ?>
                                                <button type="submit"
                                                    class="mt-1 btn btn-outline-light btn-lg text-uppercase font-weight-bold">
                                                    <i class="far fa-check-circle"></i>
                                                    Valider le paiement
                                                </button>
                                                <?php if(session()->paymenttoken): ?>
                                                <a href="<?= base_url('payment/printbill/' . session()->paymenttoken); ?>"
                                                    class="mt-1 btn btn-primary btn-lg" data-toggle="tooltip"
                                                    data-placement="top" title="Cliquer pour imprimer le reçu">
                                                    <i class="fas fa-print fa-lg"></i>
                                                    </span>
                                                </a>
                                                <?php endif; ?>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <hr>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-md-12">
                        <p class="h5  alert alert-light text-danger text-center">
                            <i class="fa fa-info-circle fa-lg"></i>
                            Désolé, cet étudiant ne paie pas le frais <span class="font-weight-bold">
                                <?= session()->feepaidchoosed['fee_name']; ?>
                            </span> que vous avez sélectionné

                        </p>
                    </div>
                    <?php endif; ?>

                    <?= form_close(); ?>

                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
            <div class="card-footer text-uppercase alert alert-light text-primary text-center">
                <p class="font-weight-bold text-danger">
                    <i class="fa fa-info-circle fa-lg"></i>
                    Veuillez configurer le taux de change dans le module configuration frais en suivant le lien
                    ci-dessous pour percevoir les différents frais concernés
                </p>
                <a href="<?= base_url('fees/exchanges'); ?>" class="btn btn-lg btn-info">
                    <span class="btn text-white " data-toggle="tooltip" data-placement="top"
                        title="Cliquer pour configurer frais">
                        Configurer le taux de change
                    </span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php if(isset($student) && !empty($student)):?>
    <?php if (isset($paydetails) && !empty($paydetails)):?>
        <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h3 class="font-weight-bold">HISTORIQUE DE PAIEMENTS DU MEME FRAIS</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <fieldset>
                                <table class="table table-bordered table-sm" id="datatablesExample2">
                                    <thead>
                                        <tr class="small text-uppercase font-weight-bold">
                                            <th>ACTION</th>
                                            <th>DATE</th>
                                            <th>REFERENCE</th>
                                            <th>FRAIS PAYE</th>
                                            <th>MONTANT</th>
                                            <th>CASH USD</th>
                                            <th>CASH CDF</th>
                                            <th>RENDU</th>
                                            <th>TAUX </th>
                                            <th>STATUT </th>
                                            <th>NOTES </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php   
                                         $pay_date = session()->has('paydate') ? session()->get('paydate'): date('Y-m-d');
                                         
                                        foreach ($paydetails as $payment) {

                                        $currency = $payment['fee_currency_payable'];
                                        $currency_paid = ($currency == 'usd') ? '$':'Fc';
                                        $pay_token = $payment['paydetails_token'];
                                        $pay_amount = $payment['paydetails_paid_amount'];
                                        $pay_usd_amount = $payment['paydetails_usd_amount'];
                                        $pay_cdf_amount = $payment['paydetails_cdf_amount'];

                                        $pay_returned_amount = $payment['paydetails_return_amount'];
                                        
                                        $pay_exchange = $payment['payment_exchange'];
                                        
                                        $fee_payable = $payment['feedetail_cost_payable'];
                                        
                                        $notes = $payment['payment_notes'];
                                        $status = (!empty(($payment['paydetails_status'])) ? ($payment['paydetails_status']) : 'inactif');
                                                   
                                        $total_amount_usd = ($pay_usd_amount !=0) ? $pay_usd_amount + ($pay_cdf_amount / $pay_exchange):0;
                                        $total_amount_cdf = ($pay_usd_amount !=0) ? $pay_cdf_amount + ($pay_usd_amount * $pay_exchange):0;
                                        
                                        $balance_amount = $pay_returned_amount;
                                        $balance_currency = ($currency == 'usd') ? '$':'Fc';
                                        ?>
                                        <tr class="small">

                                            <td class="font-weight-bold">
                                                <?php if($payment['payment_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){?>

                                                <?php if(($status != 'cancel')){ ?>
                                                <a href="<?= base_url('payment/cancelPaydetails/' . $pay_token); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment annuler ce paiement?');"
                                                    class="btn btn-sm btn-danger <?= ($payment['payment_date'] == $pay_date) ? '':'disabled'; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour annuler ce paiement">
                                                        <i class="fa fa-window-close"></i>
                                                    </span>
                                                </a>
                                                <a href="<?= base_url('payment/printbill/' . $payment['payment_token']); ?>"
                                                    class="btn btn-sm btn-info">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour imprimer le recu de ce paiement">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                </a>
                                                <?php }else{ ?>
                                                <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>

                                                <a href="<?= base_url('payment/remove/paydetails/' . $payment['paydetails_id']); ?>"
                                                    class="<?= $access_delete; ?> btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Etes-vous vraiment sûr de vouloir supprimer définitivement ce paiement [<?= $payment['fee_name']; ?> - <?= $payment['feedetail_name']; ?>]?');">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer definitivement ce paiement">
                                                        Supprimer
                                                    </span>
                                                </a>
                                                <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['payment_created_at']; ?>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['payment_code']; ?>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['fee_name']; ?>
                                                [<span class="text-primary font-weight-bold">
                                                    <?= $payment['feedetail_name']; ?>
                                                </span>]
                                            </td>

                                            <td class="font-weight-bold">
                                                <span class="">
                                                    <?= number_format($pay_amount, 2, ',', ' ') .''.$currency_paid; ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">
                                                <span class="">
                                                    <?= number_format($pay_usd_amount, 2, ',', ' ') .'$'; ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">
                                                <span class="">
                                                    <?= number_format($pay_cdf_amount, 2, ',', ' ') .'Fc'; ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">
                                                <span class="">
                                                    <?= number_format($balance_amount, 2, ',', ' '); ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold">
                                                <span class="">
                                                    <?= number_format($pay_exchange, 2, ',', ' '); ?>
                                                </span>
                                            </td>
                                            <td class="font-weight-bold text-uppercase">
                                                <span
                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-success' : 'badge-danger'; ?> text-capitalize">
                                                    <?= ($status == 'actif') ? 'Validé':'Annulé'; ?> </span>
                                            </td>
                                            <td class="font-weight-bold text">
                                                <span class="text-uppercase small">
                                                    <?= $notes; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endif; ?>
</div>