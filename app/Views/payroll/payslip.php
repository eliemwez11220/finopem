<div class="content-wrapper <?= checkModuleAccess('payslip'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12 order-md-1 order-last">
                    <div class="text-center bg-dark py-3 mb-2">
                        <h1 class="font-weight-bold">Récapitulatif de Paie des agents</h1>

                        <nav aria-label="breadcrumb" class="breadcrumb-header text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion de la paie</li>
                                <li class="breadcrumb-item active" aria-current="page">Récapitulatif de Paie</li>
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
                            <i class="fas fa-print"></i> Imprimer Récapitulatif
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
    <section class="content" style="page-break-after: always!important;">
        <div class="container">
            <div class="card">
                <div class="card-footer">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->
                </div>
                <div class="card-header bg-primary text-white py-2" style="border:2px solid black">
                    <div class="text-center text-uppercase">
                        <h3 class="text-center font-weight-bold">
                            Récapitulatif de la Paie des agents
                        </h3>
                        <p class="text-uppercase font-weight-bold"><i>
                            Enveloppe salariale du Mois -
                                <b><?= isset($period) ? monthYearly($period):monthYearly(date('m')); ?>
                                </b>
                                <?= date('Y'); ?>
                            </i>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Agent</th>
                                    <th>Matricule</th>
                                    <th>Rémunération Brute</th>
                                    <th>Avantages</th>
                                    <th>Retenues</th>
                                    <th>Net à Payer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                    $salary_total_payable = 0; 
                                    $salary_total_brute = 0; 
                                    $salary_total_advantage = 0; 
                                    $salary_total_deductions = 0;
                                    $total_deductions_amount = 0; 
                                    $count = 1; 
                                    ?>
                                <?php if (isset($payments) && !empty($payments)): ?>
                                <?php foreach ($payments as $payment): ?>
                                <?php 
                                if (isset($_GET['agent_filter']) && !empty($_GET['agent_filter']) && $_GET['agent_filter'] != $payment['agent_code']) {
                                    continue; // Skip payments that don't match the filter
                                }
                                if (isset($_GET['month']) && !empty($_GET['month']) && $_GET['month'] != $payment['payment_period']) {
                                    continue; // Skip payments that don't match the filter
                                }
                                $worker_name = $payment['agent_firstname'] . ' ' . $payment['agent_lastname'] . ' ' . $payment['agent_surname'];
                                $payment_salary = floatval($payment['category_cost_day']) * intval($payment['payment_work_days']);
                                $leave_hospital = $payment['payment_leave_hospital'] * ($payment['category_cost_day']);
                                $annual_leave = $payment['payment_leave_days'] * ($payment['category_cost_day']);
                                $supp130 = $payment['payment_overtime_130'] * ($payment['category_cost_day'] / 8) * 1.30;
                                $supp160 = $payment['payment_overtime_160'] * ($payment['category_cost_day'] / 8) * 1.60;
                                $supp200 = $payment['payment_overtime_200'] * ($payment['category_cost_day'] / 8) * 2;
                                $night_days = $payment['payment_night_days'] * ($payment['category_cost_day'] / 8) * 2;
                                $total_brut_salary = $payment_salary + $leave_hospital + $annual_leave + $supp130 + $supp160 + $supp200 + $night_days;

                                $payment_transport = $payment['category_cost_transport'] * $payment['payment_work_days'];
                                $payment_location = $payment['category_cost_location'] * $payment['payment_work_days'];
                                $payment_hospital = $payment['category_cost_hospital'] * $payment['payment_work_days'];
                                $payment_amount_bonus = $payment['payment_amount_bonus'];
                                $salary_advantage = $payment_transport + $payment_location + $payment_hospital + $payment_amount_bonus;

                                $total_request_amount = 0;
                                if (isset($requests) && !empty($requests)) {
                                    foreach ($requests as $request) {
                                        if ($request['request_status'] == 'actif' && $request['request_period'] == $payment['payment_period'] && $request['request_agent_uid'] == $payment['contract_uid']) {
                                            $brut_request_amount = floatval($request['request_amount']);
                                            $total_request_amount += ($brut_request_amount > 0) ? $brut_request_amount : 0;
                                        }
                                    }
                                }
                            ?>
                                <?php
                                // Assuming the following functions are defined elsewhere in your code
                                $exchange = $payment['category_cost_exchange']; // GET LATEST EXCHANGE VALUE
                                $currency = $payment['category_currency']; // GET LATEST TAX VALUE
                                
                                ?>
                                <?php $cnss= calculRetenues($total_brut_salary, 'inss_salarie'); ?>
                                <?php $ipr = calculateTax($total_brut_salary, $currency, $exchange); ?>
                                <?php $onem = 0;//calculRetenues($total_brut_salary, 'onem'); ?>
                                <?php $inpp = 0;//calculRetenues($total_brut_salary, 'inpp'); ?>
                                <?php $cotisation = $onem + $inpp; ?>
                                <?php $total_deductions_amount = $total_request_amount + $inpp + $cnss + $onem+ $ipr; ?>
                                <?php $salary_net_payable = ($total_brut_salary + $salary_advantage) - $total_deductions_amount; ?>
                                <?php 
                                
                                    $salary_total_payable += $salary_net_payable ; 
                                    $salary_total_brute += $total_brut_salary; 
                                    $salary_total_advantage += $salary_advantage; 
                                    $salary_total_deductions += $total_deductions_amount; 
                                ?>
                                <tr>
                                <td><?= $count++; ?></td>
                                <td><?= strtoupper($worker_name); ?></td>
                                <td><?= esc($payment['agent_code']); ?></td>
                                <td><?= number_format($total_brut_salary, 2); ?></td>
                                <td><?= number_format($salary_advantage, 2); ?></td>
                                <td><?= number_format($total_deductions_amount, 2); ?></td>
                                <td><?= number_format($salary_net_payable, 2); ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <strong>Total Général(<?= strtoupper($currency); ?>)</strong>
                                    </td>
                                    <td>
                                        <b><?= number_format($salary_total_brute, 2); ?></b>
                                    </td>
                                    <td>
                                        <b><?= number_format($salary_total_advantage, 2); ?></b>
                                    </td>
                                    <td>
                                        <b><?= number_format($salary_total_deductions, 2); ?></b>
                                    </td>
                                    <td>
                                        <b><?= number_format($salary_total_payable, 2); ?></b>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucune donnée disponible</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>