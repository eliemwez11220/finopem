<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <blockquote>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-floating">
                            <select id="ajax_school" name="ajax_school" class="form-control">
                                <option selected disabled>--sélectionnez--</option>

                                <?php if (isset($schools) && !empty($schools)):
                                        foreach ($schools as $schoolkey => $school): ?>
                                <option value="<?= ($school['school_id']);?>"
                                    <?= (session()->has('schoolchoosed') && (session()->get('schoolchoosed')==$school['school_id']))? 'selected' : set_select('ajax_school', ($school['school_id']));?>>
                                    <?= strtoupper($school['school_fullname']);?>
                                    [<?= strtoupper($school['school_code']);?>]
                                </option>
                                <?php endforeach;?>
                                <?php endif;?>

                            </select>
                            <label for="ajax_school" class="control-label">
                                <span class="text-danger">*</span>Etablissement
                            </label>
                        </div>
                    </div>
                </div>
            </blockquote>
        </div>
    </section>
    <?php  if (session()->has('schoolchoosed') && (session()->has('schooldata'))): ?>

    <div class="card-body printoff">
        <?php  $request = \Config\Services::request(); 
        $validation = \Config\Services::validation(); 
                    $form_attrib = array(
                        'role'=>"form", 'id'=>"reporting_filter_data", 'method'=>"get"
                    );
                    ?>
        <?= form_open(base_url('admincustomer/finances/'), $form_attrib); ?>
        <div class="row">

            <div class="col-lg-5 col-sm-5 col-xs-12 mt-3">
                <div class="form-floating">
                    <select id="year" name="year"
                        class="form-control <?php if ($validation->hasError('year')) {echo 'is-invalid';}?>">
                        <option selected disabled>--sélectionnez--</option>

                        <?php if (isset($years) && !empty($years)):
                        $yearchoosed = (isset($year) && (!empty($year)))?$year['year_id']:''; 
                                    foreach ($years as $yearkey => $yearvalue): ?>
                        <option value="<?= ($yearvalue['year_id']);?>"
                            <?= ($yearchoosed ==$yearvalue['year_id'])? 'selected' : set_select('year', ($yearvalue['year_id']));?>>
                            <?= ($yearvalue['year_started']);?>-<?= ($yearvalue['year_ended']);?>
                        </option>
                        <?php endforeach;?>
                        <?php endif;?>

                    </select>
                    <label for="year" class="control-label">
                        <span class="text-danger">*</span>Année d'études
                    </label><?php if (isset($validation)): ?>
                    <span class="invalid-feedback">
                        <?=display_validation_error($validation, 'year');?>
                    </span>
                    <?php endif;?>

                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group mb-2">
                    <label for="start_date"><span class="text-danger">*</span>Date début</label>
                    <input type="date"
                        class="form-control <?= ($validation->hasError('start_date')) ? ' is-invalid' : '' ?>"
                        id="start_date" name="startdate" aria-describedby="start_date" required
                        value="<?= (!empty($start))? $start :set_value('start_date'); ?>" />

                    <div id="start_date" class="form-text">
                        <span class="text-danger"><?= displayFormError($validation, 'start_date'); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-12">
                <div class="form-group mb-2">
                    <label for="end_date"><span class="text-danger">*</span>Date fin</label>
                    <div class="input-group">
                        <input type="date"
                            class="form-control <?= ($validation->hasError('end_date')) ? ' is-invalid' : '' ?>"
                            id="end_date" placeholder="Patient" name="enddate" aria-describedby="end_date" required
                            value="<?= (!empty($end))? $end : set_value('end_date'); ?>" />


                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info text-uppercase" title="Bouton de recherche">
                                <i class="fa fa-search"></i> valider
                            </button>
                        </div>
                    </div>
                    <div id="end_date" class="form-text">
                        <span class="text-danger"><?= displayFormError($validation, 'end_date'); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
    <?php if(isset($year) && (!empty($year))):?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <?php  
                    $schooldata = session()->get('schooldata');

                    $logo_cover = $schooldata['school_picture_cover']; ?>

                    <div class="card">
                        <div class="card-footer mt-0"
                            style="background: url(<?= base_url('public/uploads/images/'.$logo_cover); ?>);background-repeat: no-repeat; background-size: cover;">

                            <div class="text-center">
                                <h1 class=" text-uppercase font-weight-bold">
                                    <b><?= $schooldata['school_fullname']; ?></b>
                                </h1>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5 border-right">
                                    <div class="text-right">
                                        <address class="ml-1">

                                            <span class="text-uppercase font-weight-bold small">
                                                Adresse:
                                                <?= wordwrap($schooldata['school_address'], 30, "<br>\n"); ?>
                                            </span>
                                            <br>
                                            <span class="font-weight-bold">
                                                Téléphone:<?= $schooldata['school_phone']; ?>
                                                <br>Email: <span class="text-lowercase">
                                                    <?= $schooldata['school_email']; ?>
                                                </span>
                                            </span>
                                            <br>

                                        </address>
                                    </div>
                                </div>

                                <?php  if(!empty($schooldata['school_logo'])): ?>
                                <div class="col-lg-2 col-sm-2">
                                    <div class="text-center">
                                        <?php   $logo = base_url('public/uploads/images/'.$schooldata['school_logo']); 
                                        $magstore_logo = base_url('public/img/logo/favicon.png');
                                        $valid_logo = (!empty($schooldata['school_logo']))? $logo: $magstore_logo;
                                ?>
                                        <div class="">
                                            <img src="<?= $valid_logo; ?>" alt="<?= $logo; ?>"
                                                class="school-logo school-logo-medium">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="col-lg-5 col-sm-5 small border-left">
                                    <div class="text-left">
                                        <span class="text-uppercase">
                                            <b>
                                                Année scolaire :
                                                <?=  $year['year_started'] .'-'. $year['year_ended']; ?>
                                            </b>
                                        </span>
                                        <br>
                                        <span class="text-uppercase">
                                            <b>Classe: Générale
                                            </b>
                                        </span>
                                        <br>
                                        <span class="text-uppercase">
                                            <b>Rapport du
                                                <?= isset($start) ? date("d/m/Y", strtotime($start)): date('d/m/Y'); ?>
                                                au
                                                <?= isset($end) ? date("d/m/Y", strtotime($end)): date('d/m/Y'); ?>
                                            </b>
                                        </span>
                                        <br>
                                        <span class="text-uppercase font-weight-bold">
                                            <b>Edition du <?= date("d/m/Y H:i:s"); ?></b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow-lg text-center" style="border:2px solid black">
                <h1 class="text-uppercase font-weight-bold py-3">
                    Situation financière
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
                                            <th colspan="3">Description frais</th>
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
                                    $montant_total_cdf =0;
                                    if (isset($fees) && !empty($fees)):
                                        foreach ($fees as $key => $ligne):  ?>
                                        <tr class="small">
                                            <td class="text-uppercase" rowspan="<?= $ligne['fee_total_payable']+1; ?>">
                                                <h6 class="font-weight-bold middle">
                                                    <?= ($ligne['fee_name']); ?>
                                                </h6>
                                            </td>
                                            <?php if (isset($feesdetails) && !empty($feesdetails)):
                                        foreach ($feesdetails as $key => $feedet):  
                                            if ($feedet['feedetail_fee_id'] == $ligne['fee_id']):?>

                                        <tr class="small">
                                            <td class="font-weight-bold text-uppercase">
                                            </td>
                                            <td class="font-weight-bold text-uppercase">
                                                <?= ($feedet['feedetail_name']); ?>
                                            </td>
                                            <?php if (isset($payments) && !empty($payments)):
                                                foreach ($payments as $key => $value):
                                                     //if($payment['payment_user_id'] == session()->userid OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                                       
                                                    $devise = (!empty(($value['fee_currency_payable'])) ? esc($value['fee_currency_payable']) : '');
                                                    $taux = (!empty(($value['payment_exchange'])) ? esc($value['payment_exchange']) : '0');
                                                    
                                                    if ($value['paydetails_fee_id'] == $feedet['feedetail_id']){

                                                        $montant_versement = $value['paydetails_paid_amount'];
                                                        //$montant_versement_usd = $value['paydetails_usd_amount'];
                                                        //$montant_versement_cdf = $value['paydetails_cdf_amount'];


                                                        $montant_versement_usd = ($devise == 'usd') ? $montant_versement:0;
                                                        $montant_versement_cdf = ($devise == 'cdf') ? $montant_versement:0;

                                                        $montant_total_cdf = ($devise == 'usd') ? ($montant_versement * $taux) + $montant_versement_cdf:$montant_versement_cdf;

                                                        $montant_total_percu_usd += $montant_versement_usd;
                                                        $montant_total_percu_cdf += $montant_versement_cdf;
                                                        $montant_global_percu_cdf = ($devise == 'usd') ? ($montant_total_percu_usd * $taux) + $montant_total_percu_cdf:$montant_total_percu_cdf;
                                                    
                                                ?>


                                            <td class="font-weight-bold">
                                                <?= number_format($montant_versement_usd, 2, ',', ' '); ?>
                                            </td>
                                            <td class="font-weight-bold">
                                                <?= number_format($montant_versement_cdf, 2, ',', ' '); ?>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php endif; ?>

                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr class="font-weight-bold">
                                            <td colspan="3" class="text-right text-uppercase">Total Général Perçu</td>
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
            <div class="printoff">
                <div class="text-center ">
                    <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-sm"
                        onclick="window.print();">
                        <i class="fa fa-print"></i> Imprimer ce rapport</a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endif; ?>
</div>