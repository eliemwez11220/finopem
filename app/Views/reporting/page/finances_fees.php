<section class="content-header printoff">
    <div class="container-fluid">
        <div class="shadow-sm">
            <div class="row">
                <div class="col-sm-3 col-lg-3">
                    <form role="form" id="ajax_form_sections" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_sections" name="ajax_sections" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez une section--</option>
                                <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                    <option value="all">Toutes les sections</option>
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
                                <span class="text-danger">*</span>Sections organisées</label>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <form role="form" id="form_ajax_fees_classes" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_fees_paid" name="ajax_fees_paid" title="Frais"
                                class="form-control select2 select2-info text-uppercase font-weight-bold"
                                data-dropdown-css-class="select2-info">
                                <option disabled selected>-- sélectionnez le frais-- </option>
                                <option value="all">Tous les frais</option>
                                <?php if (isset($fees) && !empty($fees)):
                                    $fee_choosed = session()->has('feepaidid') ? session()->feepaidid : '';
                                    foreach ($fees as $keyfee => $fee): ?>
                                        <option value="<?= esc($fee['fee_id']); ?>" <?= ($fee_choosed == $fee['fee_id']) ? 'selected' : set_select('ajax_fees_paid', esc($fee['fee_id'])); ?>>
                                            <?= strtoupper($fee['fee_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="ajax_fees_paid">
                                <span class="text-danger">*</span>Frais
                            </label>
                        </div>
                    </form>
                </div>

                <div class="col-sm-3 col-lg-3">
                    <!-- GET ALL FEES DETAILS -->
                    <form role="form" id="form_ajax_fees_classes" method="get">
                        <div class="form-floating " style="width: 100%!important;">
                            <select id="ajax_fees_classes" name="ajax_fees_classes" title="Classe"
                                class="form-control select2 select2-info text-uppercase font-weight-bold"
                                data-dropdown-css-class="select2-info">
                                <option disabled selected>-- sélectionnez le frais-- </option>
                                <option selected>Tous les frais </option>

                                <?php if (isset($detailsfees) && !empty($detailsfees)):
                                    $feechoosed = session()->has('feepaidid') ? session()->feepaidid : '';
                                    $feedetailchoosed = session()->has('feedetailchoosed') ? session()->feedetailchoosed : '';
                                    foreach ($detailsfees as $keyfee => $fee_detail):
                                        if ($fee_detail['fee_id'] == $feechoosed):
                                            ?>
                                            <option value="<?= esc($fee_detail['feedetail_id']); ?>"
                                                <?= ($fee_detail['feedetail_id'] == $feedetailchoosed) ? 'selected' : set_select('ajax_fees_classes', esc($fee_detail['feedetail_id'])); ?>>
                                                <?= trim(strtoupper($fee_detail['feedetail_name'])); ?>

                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="ajax_fees_classes" class="font-weight-bold">
                                <span class="text-danger">*</span>
                                Frais de contrôle
                            </label>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2 col-lg-2">
                    <div
                        class="float-right <?= (current_url() == base_url('export/students') or current_url() == base_url('export/parents')) ? 'd-none' : ''; ?>">
                        <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-lg"
                            onclick="window.print();">
                            <i class="fa fa-print"></i> Imprimer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (session()->has('choosedsectionid')): ?>
    <?php if (session()->has('feepaidid')): ?>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    </div>
                </div>
                <?php if (session()->has('feechoosedclasse')): ?>
                    <div class="shadow-lg text-center" style="border:2px solid black">
                        <h3 class="text-uppercase font-weight-bold py-3">
                            Contrôle Frais
                            <<<span class="text-primary">
                                <?= session()->feechoosedclasse['fee_name']; ?>
                                <?= session()->feechoosedclasse['feedetail_name']; ?>
                                </span>>>
                                <?= trim(strtoupper(session()->feechoosedclasse['fee_currency_payable'])); ?>

                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="datatablesReportingActions">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th>Classe</th>
                                            <th class="text-center">Effectif</th>
                                            <th class="text-center">Budget</th>
                                            <th class="text-center">Cash </th>
                                            <th class="text-center">Solde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $count_students = 1;
                                        $total_student_classe = 0;
                                        $total_fees_payable = 0;
                                        $total_fees_payments = 0;
                                        $total_balance_payable = 0;
                                        $total_discount_amount = 0;


                                        $fees_amount = 0;
                                        $fee_payable_amount = 0;
                                        
                                        $total_discount = 0;
                                        $balance_amount = 0;

                                        $total_fees_amount = 0;
                                        $total_paid_amount = 0;
                                        $total_off_amount = 0;
                                        $currency = '';
                                        $count = 1;
                                        $total_students = 0;

                                        if (isset($classesfees) && (!empty($classesfees))):

                                            // Initialisation d'un tableau pour compter les étudiants et calculer le budget par classe
                                            $compteEtudiants = [];
                                            $budgetParClasse = [];

                                            foreach ($classesfees as $keyclasse => $valclasse) {

                                                $compteEtudiants[$valclasse['classe_id']] = 0; // Initialiser le compteur
                            
                                                if (isset($feesstudents) && !empty($feesstudents)) {
                                                    foreach ($feesstudents as $studentkey => $student) {

                                                        if ($student['inscription_classe_id'] == $valclasse['classe_id']) {

                                                            $compteEtudiants[$valclasse['classe_id']]++;

                                                        }
                                                    }
                                                }
                                                // Calculer le budget par étudiant
                                                $budgetParClasse[$valclasse['classe_id']] = $valclasse['feedetail_cost_payable'] * max(1, $compteEtudiants[$valclasse['classe_id']]);

                                            }

                                            foreach ($classesfees as $classek => $classe):

                                                if($classe['feedetail_id'] == session()->feechoosedclasse['feedetail_id']):
                                                    
                                                $effectif_classe = $compteEtudiants[$classe['classe_id']];
                                                $total_students += $effectif_classe;
                                                $currency = ($classe['fee_currency_payable'] == 'usd') ? '$' : 'Fc';
                                                $fees_amount =$budgetParClasse[$classe['classe_id']];
                                                ?>
                                                <tr class="text-uppercase">
                                                    <td scope="1"><?= $count++; ?></td>

                                                    <td class="text-uppercase">
                                                        <?= trim($classe['classe_shortname']); ?>
                                                    </td>
                                                    <td class="text-uppercase">
                                                        <center><?= $compteEtudiants[$classe['classe_id']]; ?></center>
                                                    </td>

                                                    <?php
                                                    
                                                    $payments_amount = 0;
                                                        $discount_student_amount = 0;
                                                        $discount_classe_amount = 0;
                                                    // GET ALL STUDENTS EXEMPTIONS
                                                    if (isset($feesexemptions) && !empty($feesexemptions)) {
                                                        foreach ($feesexemptions as $discount) {
                                                          //Student Exemption
                                                            if (isset($studentexemptions) && !empty($studentexemptions)) {
                                                                foreach ($studentexemptions as $studentexemption) {
                                                                    if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                        if ($studentexemption['inscription_classe_id'] == $classe['classe_id']) {

                                                                            $discount_student_amount = $studentexemption['exemption_cost_discount'];

                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            //classe exemption
                                                            if (isset($classesexemptions) && !empty($classesexemptions)) {
                                                                foreach ($classesexemptions as $classeexemption) {
                                                                    if ($classeexemption['exemptionclasse_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                        if ($classeexemption['exemptionclasse_classe_id'] == $classe['classe_id']) {

                                                                            $discount_classe_amount = $classeexemption['exemption_cost_discount'];

                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $total_discount = $discount_student_amount + ($discount_classe_amount * $effectif_classe);

                                                    if (isset($feespayments) && !empty($feespayments)) {
                                                        foreach ($feespayments as $pay) {

                                                            if ($pay['inscription_classe_id'] == $classe['classe_id']) {

                                                                $payments_amount = $pay['paydetails_paid_amount'];

                                                            }
                                                        }
                                                    }

                                                    $total_student_classe += $effectif_classe;
                                                    $fee_payable_amount = $fees_amount - $total_discount;

                                                    $total_fees_payable += $fee_payable_amount;
                                                    $total_fees_payments += $payments_amount;

                                                    $balance_amount = $fee_payable_amount - $payments_amount;

                                                    $total_discount_amount += $total_discount;
                                                    //$total_payable += $total_to_paid - $total_discount;
                                
                                                    $total_balance_payable = $total_fees_payable - $total_fees_payments;

                                                    ?>

                                                    <td class="font-weight-bold text-center">
                                                        <b><?= number_format($fee_payable_amount, 2, ',', ' '); ?></b>
                                                     </td>
                                                    <td class="font-weight-bold text-center">
                                                        <b> <?= number_format($payments_amount, 2, ',', ' '); ?></b>
                                                    </td>
                                                    <td class="font-weight-bold text-center">
                                                        <b><?= number_format($balance_amount, 2, ',', ' '); ?></b>
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-uppercase font-weight-bold">
                                            <td colspan="2" class="text-right">Totaux</td>

                                            <td class="text-dark text-center">
                                                <center>
                                                <?= number_format($total_students, 0, ',', ' ') . ''; ?>
                                                </center>
                                            </td>
                                            <td class="text-dark text-center">
                                                <?= number_format($total_fees_payable, 2, ',', ' ') . '' . $currency; ?>
                                            </td>
                                            <td class="text-dark text-center">
                                                <?= number_format($total_fees_payments, 2, ',', ' ') . '' . $currency; ?>
                                            </td>
                                            <td class="text-dark text-center">
                                                <?= number_format($total_balance_payable, 2, ',', ' ') . '' . $currency; ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>