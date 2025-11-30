<div class="content-wrapper <?= checkModuleAccess('payslip'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12 order-md-1 order-last">
                    <div class="text-center bg-dark py-3 mb-2">
                        <h1 class="font-weight-bold">Bulletins de paie des agents</h1>
                        <nav aria-label="breadcrumb" class="breadcrumb-header text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion de la paie</li>
                                <li class="breadcrumb-item active" aria-current="page">Bulletins</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-md-1 order-first">
                    <form method="get" class="mb-3 printoff">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <select name="month" id="month" class="form-select form-control">
                                        <option value="">Tous les mois</option>
                                        <?php foreach (monthYearly() as $month => $month_label): ?>
                                        <option value="<?= $month; ?>"
                                            <?= isset($_GET['month']) && $_GET['month'] == $month ? 'selected' : ''; ?>>
                                            <?= $month_label; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="month" class="form-label">Mois</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <select name="agent_filter" id="agent_filter" class="form-select form-control">
                                        <option value="">Tous les agents</option>
                                        <?php if (isset($payments) && !empty($payments)): ?>
                                        <?php foreach ($payments as $agent): ?>
                                        <option value="<?= $agent['agent_code']; ?>"
                                            <?= isset($_GET['agent_filter']) && $_GET['agent_filter'] == $agent['agent_code'] ? 'selected' : ''; ?>>
                                            <?= $agent['agent_firstname'] . ' ' . $agent['agent_lastname']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="agent_filter" class="form-label">Filtrer par agent</label>
                                </div>
                            </div>

                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-filter"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-4 order-md-2 order-last">
                    <p class="float-right float-lg-end mt-1">
                        <a href="" class="btn btn-success btn-lg" onclick="window.print();">
                            <i class="fas fa-print"></i> Imprimer bulletin
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php
    $exchange = 0; //(session()->has('exchange')) ? session()->get('exchange'):0; // GET LATEST EXCHANGE VALUE
    $currency = ''; //(session()->has('company_currency')) ?  session()->get('company_currency'):'cdf'; // GET LATEST TAX VALUE
   ?>
    <section class="content">
        <div class="container">
            <?php if (isset($payments) && !empty($payments)): ?>
            <?php foreach ($payments as $payment): ?>
            <?php
                                // Assuming the following functions are defined elsewhere in your code
                                $exchange = $payment['category_cost_exchange']; // GET LATEST EXCHANGE VALUE
                                $currency = $payment['category_currency']; // GET LATEST TAX VALUE
                                
                                ?>
            <?php 
                    if (isset($_GET['agent_filter']) && !empty($_GET['agent_filter']) && $_GET['agent_filter'] != $payment['agent_code']) {
                        continue; // Skip payments that don't match the filter
                    }
                    if (isset($_GET['month']) && !empty($_GET['month']) && $_GET['month'] != $payment['payment_period']) {
                        continue; // Skip payments that don't match the filter
                    }
                    $worker_name = $payment['agent_firstname'] . ' ' . $payment['agent_lastname'] . ' ' . $payment['agent_surname'];
                    $payment_salary = floatval($payment['category_cost_day']) * intval($payment['payment_work_days']);
                    $payment_amount = $payment_salary + floatval($payment['payment_amount_bonus']);
                    ?>
            <div class="card" style="page-break-after: always!important;">
                <div class="card-footer">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->
                </div>

<div class="card-body">
    <div class="text-center py-2" style="border:2px solid black">
        <h3 class="font-weight-bold text-uppercase">
            BULLETIN DE PAIE <?= monthYearly($payment['payment_period']); ?>
            <?= date("Y", strtotime($payment['payment_date'])); ?>

        </h3>
        <h4 class="text-center text-uppercase font-weight-bold">
            <i><?= strtoupper($worker_name); ?></i>
        </h4>
    </div>

    <div class="row mt-3">
        <div class="col-sm-6 col-lg-6 small">
            <p>
                <strong>Référence :</strong>
                <span class="font-weight-bold"><i><?= $payment['payment_code']; ?></i></span>
                <span
                    class="<?= ($payment['payment_status'] != 'validated') ? 'badge badge-danger ':'d-none'; ?>">
                    Ce bulletin est invalide. Il n'est pas encore payé!
                </span>
            </p>
            <p><strong>Matricule :</strong>
                <span class="d-none"><?= esc($payment['agent_code']); ?></span>
            </p>
            <p><strong>Département :</strong> </p>
            <p><strong>Fonction :</strong> <?= strtoupper($payment['agent_title']); ?></p>
            <p><strong>Qualification :</strong> <?= strtoupper($payment['category_name']); ?></p>

        </div>
        <div class="col-sm-6 col-lg-6">
            <h4 class="font-weight-bold text-center bg-info py-1">POINTAGE</h4>
            <table class="table table-sm table-striped table-bordered">
                <tbody>
                    <tr>
                        <td><strong>Présences Jours :</strong></td>
                        <td><?= $payment['payment_work_days']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Congé Maladie :</strong> </td>
                        <td><?= $payment['payment_leave_hospital']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Congé Annuel :</strong> </td>
                        <td><?= $payment['payment_leave_days']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Absences :</strong> </td>
                        <td>
                            <?= $payment['category_number_working'] - $payment['payment_work_days'] - $payment['payment_leave_hospital'] - $payment['payment_leave_days']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h4 class="font-weight-bold text-center bg-info py-1" style="border:2px solid black">SALAIRE</h4>
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Rubriques Imposables</th>
                <th>Quantité</th>
                <th>Valeur</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Salaire de base</td>
                <td><?= $payment['payment_work_days']; ?></td>
                <td><?= number_format($payment['category_cost_day'], 2); ?></td>
                <td><?= number_format($payment_salary, 2); ?></td>
            </tr>
            <tr>
                <td>Congé maladie</td>
                <td><?= number_format($payment['payment_leave_hospital'], 0); ?></td>
                <td><?= number_format($payment['category_cost_day'], 2); ?></td>
                <?php $leave_hospital = $payment['payment_leave_hospital'] * ($payment['category_cost_day']); ?>
                <td><?= number_format($leave_hospital, 2); ?></td>
            </tr>
            <tr>
                <td>Congé Annuel</td>
                <td><?= number_format($payment['payment_leave_days'], 0); ?></td>
                <td><?= number_format($payment['category_cost_day'], 2); ?></td>
                <?php $annual_leave = $payment['payment_leave_days'] * ($payment['category_cost_day']); ?>
                <td><?= number_format($annual_leave, 2); ?></td>
            </tr>
            <tr>
                <td>Heures Supplémentaires 130%</td>
                <td><?= number_format($payment['payment_overtime_130'], 0); ?></td>
                <td><?= number_format($payment['category_cost_day'] / 8 * 1.30,  2); ?></td>
                <?php $supp130 = $payment['payment_overtime_130'] * ($payment['category_cost_day'] / 8) * 1.30; ?>
                <td><?= number_format($supp130, 2); ?></td>
            </tr>
            <tr>
                <td>Heures Supplémentaires 160%</td>
                <td><?= number_format($payment['payment_overtime_160'], 0); ?></td>
                <td><?= number_format($payment['category_cost_day'] / 8 * 1.60, 2); ?></td>
                <?php $supp160 = $payment['payment_overtime_160'] * ($payment['category_cost_day'] / 8) * 1.60; ?>
                <td><?= number_format($supp160, 2); ?></td>
            </tr>
            <tr>
                <td>Heures Supplémentaires 200%</td>
                <td><?= number_format($payment['payment_overtime_200'], 0); ?></td>
                <td><?= number_format($payment['category_cost_day'] / 8 * 2, 2); ?></td>
                <?php $supp200 = $payment['payment_overtime_200'] * ($payment['category_cost_day'] / 8) * 2; ?>
                <td><?= number_format($supp200, 2); ?></td>
            </tr>
            <tr>
                <td>Présences Nuit</td>
                <td><?= number_format($payment['payment_night_days'], 0); ?></td>
                <td><?= number_format($payment['category_cost_day'] / 8 * 2, 2); ?></td>
                <?php $night_days = $payment['payment_night_days'] * ($payment['category_cost_day'] / 8) * 2; ?>
                <td><?= number_format($night_days, 2); ?></td>
            </tr>
        </tbody>
    </table>
    <p class="font-weight-bold text-right bg-info" style="border:2px solid black">
        REMUNERATION BRUTE :
        <?php $total_brut_salary = $payment_salary + $leave_hospital + $annual_leave + $supp130 + $supp160 + $supp200 + $night_days; ?>
        <span class="badge badge-primary">
            <?= number_format($total_brut_salary, 2); ?>
        </span>
    </p>

    <!-- <h4 class="font-weight-bold text-center bg-info py-1">AVANTAGES</h4> -->
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Avantages</th>
                <th>Quantité</th>
                <th>Valeur</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Indemnité Transport</td>
                <td><?= number_format($payment['payment_work_days'], 2); ?></td>
                <td><?= number_format($payment['category_cost_transport'] / 8 * 2, 2); ?></td>
                <?php $payment_transport = $payment['category_cost_transport'] * $payment['payment_work_days']; ?>
                <td><?= number_format($payment_transport, 2); ?></td>
            </tr>
            <tr>
                <td>Allocation Familiale</td>
                <td><?= number_format($payment['payment_work_days'], 2); ?></td>
                <td>-</td>
                <td>-</td>

            </tr>
            <tr>
                <td>Indemnité Logement</td>
                <td><?= number_format($payment['payment_work_days'], 2); ?></td>
                <td><?= number_format($payment['category_cost_location'] / 8 * 2, 2); ?></td>
                <?php $payment_location = $payment['category_cost_location'] * $payment['payment_work_days']; ?>
                <td><?= number_format($payment_location, 2); ?></td>
            </tr>
            <tr>
                <td>Soins Médicaux</td>
                <td><?= number_format($payment['payment_work_days'], 2); ?></td>
                <td><?= number_format($payment['category_cost_hospital'] / 8 * 2, 2); ?></td>
                <?php $payment_hospital = $payment['category_cost_hospital'] * $payment['payment_work_days']; ?>
                <td><?= number_format($payment_hospital, 2); ?></td>
            </tr>
            <tr>
                <td>Autres</td>
                <td><?= number_format($payment['payment_work_days'], 2); ?></td>
                <td><?= number_format($payment['payment_amount_bonus'], 2); ?></td>
                <?php $payment_amount_bonus = $payment['payment_amount_bonus']; ?>
                <td><?= number_format($payment_amount_bonus, 2); ?></td>
            </tr>
        </tbody>
    </table>
    <p class="font-weight-bold text-right bg-info" style="border:2px solid black">
        SOUS TOTAL :
        <?php $salary_advantage = $payment_transport + $payment_location + $payment_hospital + $payment_amount_bonus; ?>
        <span class="badge badge-primary">
            <?= number_format($salary_advantage, 2); ?>
        </span>
    </p>

    <?php  $total_deductions_amount = 0; ?>
    <!-- <h4 class="font-weight-bold text-center bg-info py-1">RETENUES</h4> -->
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Retenues</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CNSS 5%</td>
                <td>
                    <?php $cnss= calculRetenues($total_brut_salary, 'inss_salarie'); ?>
                    <?= number_format($cnss, 2, ',', ' '); ?>
                </td>
            </tr>
            </tr>
            <tr>
                <td>IPR</td>
                <td>
                    <?php $ipr = calculateTax($total_brut_salary, $currency, $exchange); ?>
                    <?= number_format($ipr, 2, ',', ' '); ?>
                </td>
            </tr>
            <tr>
                <td>Cotisation Syndicale</td>
                <td>
                    <?php $onem = 0; //calculRetenues($total_brut_salary, 'onem'); ?>
                    <?php $inpp = 0; //calculRetenues($total_brut_salary, 'inpp'); ?>
                    <?php $cotisation = $onem + $inpp; ?>
                    <?= number_format($cotisation, 2, ',', ' '); ?>
                </td>
            </tr>
            <tr>
                <td>Avance sur salaire</td>
                <?php  $total_request_amount = 0;
                
                if(isset($requests) && (!empty($requests))):?>
                <?php foreach($requests as $request):
                $request_amount = 0; // Initialize request amount
                    // Check if the request is for advance salary and matches the worker ID
                    if($request['request_status'] == 'actif' && $request['request_period'] == $payment['payment_period']  && $request['request_agent_uid'] == $payment['contract_uid']){
                        $brut_request_amount = floatval($request['request_amount']);
                        $request_amount = ($brut_request_amount > 0) ? $brut_request_amount : 0;
                    }  
                    $total_request_amount += $request_amount; 
                    ?>
                <?php endforeach;?>
                <?php endif;?>
                <td><?= number_format($total_request_amount, 2); ?></td>
            </tr>
        </tbody>
    </table>
    <?php  $total_deductions_amount = $total_request_amount + $inpp + $cnss + $onem+ $ipr; ?>
    <p class="font-weight-bold text-right bg-info" style="border:2px solid black">TOTAL RETENUES : <span
            class="badge badge-primary"><?= number_format($total_deductions_amount, 2); ?></span>
    </p>

    <p class="font-weight-bold text-right bg-info py-1" style="border:2px solid black">NET A PAYER :
        <span class="badge badge-primary">
            <?php $salary_net_payable =($total_brut_salary + $salary_advantage) - $total_deductions_amount; ?>
            <?= number_format($salary_net_payable, 2); ?>
            <?= strtoupper($currency); ?>
        </span>
    </p>
    <div class="font-weight-bold">
        <div class="badge badge-primary float-left">Signature Employeur</div>
        <div class="badge badge-primary float-right">Signature Travailleur</div>
    </div>
</div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>