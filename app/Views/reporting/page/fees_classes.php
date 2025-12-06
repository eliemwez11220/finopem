
<?php if (session()->has('studentsclasses')): ?>
    <?php $students_listing = session()->get('studentsclasses');
    if(!empty($students_listing)):
    foreach ($students_listing as $key => $student):
        $branch_access = session()->has('branch_section_id') ? session()->get('branch_section_id') : '';
        if (($branch_access == $student['section_id']) or (session()->admin == TRUE) or (session()->all == TRUE)):
            //$student_choosed_id = $student['inscription_id'];
            ?>
            <div class="card" style="page-break-after: always!important;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>
                    <div class="shadow-lg text-center" style="border:2px solid black">
                        <h3 class="text-uppercase font-weight-bold py-3">
                            <span class="text-primary">
                                <?= setReporting(session()->get('reportingtype'), "Communiqué de paiement étudiant"); ?>
                                <?= reportingReferenceNumber(); ?>
                            </span>
                        </h3>
                    </div>



                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <blockquote>
                                <p class="text-dark">Chers parents,
                                    conformément aux données de notre application de gestion de frais scolaires,
                                    la situation annuelle de paiement de l’étudiant

                                    [<span class="text-primary text-uppercase font-weight-bold">
                                        <?= trim($student['student_firstname']); ?>
                                        <?= trim($student['student_lastname']); ?>
                                        <?= trim($student['student_surname']); ?>
                                        -
                                    </span>

                                    immatriculé:
                                    <span class="text-primary text-uppercase font-weight-bold">
                                        <?= trim($student['student_code']); ?>
                                    </span>
                                    de la
                                    <span class="text-primary text-uppercase font-weight-bold">
                                        <?= setDegresLevels(($student['degree_code'])); ?>
                                        <?= trim(($student['classe_subname'])); ?>
                                        <?= trim(($student['option_name'])); ?>
                                    </span>] pour l’année scolaire <b><?= session()->get('schoolyear'); ?></b> se présente comme suite :
                                </p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <fieldset>
                                <table class="table table-bordered table-sm" id="datatablesExample">
                                    <thead>
                                        <tr class="small text-uppercase font-weight-bold">
                                            <th>#</th>
                                            <th>Description frais</th>
                                            <th>Budget</th>
                                            <th>Payé</th>
                                            <th>Solde</th>
                                            <th>Observation</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        /*$feesclasses = session()->reportingdata['feesclasses'];
                                        $feesexemptions = session()->reportingdata['feesexemptions'];
                                        $studentexemptions = session()->reportingdata['studentexemptions'];
                                        $classesexemptions = session()->reportingdata['classesexemptions'];
                                        $payments = session()->reportingdata['payments'];*/
                                        $total_fee = 0;


                                        $balance = 0;
                                        $count_records = 0;

                                        $total_fees_amount_cdf = 0;
                                        $total_paid_amount_cdf = 0;
                                        $total_discount_amount_cdf = 0;
                                        $balance_net_cdf = 0;

                                        $total_fees_amount_usd = 0;
                                        $total_paid_amount_usd = 0;
                                        $total_discount_amount_usd = 0;
                                        $balance_net_usd = 0;
                                        $count = 1;
                                        $i = 0;
                                        if (isset($feesclasses) && (!empty($feesclasses))) {

                                           
                                            //GET ALL FEES CLASSES
                                            foreach ($feesclasses as $reponse) {
                                                $count_records++;
                                                $feedetail_id = $reponse['feedetail_id'];
                                                $total_fee = $reponse['feedetail_cost_payable'];
                                                $inputs = FALSE;
                                                $fee_total_payable = $reponse['fee_total_payable'];
                                                $fee_currency = $reponse['fee_currency_payable'];
                                                $currency = ($reponse['fee_currency_payable'] == 'usd') ? '$' : 'Fc';
                                                $total_paid = 0;
                                                $total_to_paid = 0;
                                                $total_discount = 0;
                                                $classe_exemption = 0;
                                                $student_exemption = 0;
                                                // GET ALL STUDENTS EXEMPTIONS
                                                if (isset($feesexemptions) && (!empty($feesexemptions))) {

                                                    foreach ($feesexemptions as $discount) {
                                                        if ($discount['feediscount_feedetail_id'] == $reponse['feedetail_id']) {
                                                            //Student Exemption
                            
                                                            if (isset($studentexemptions) && (!empty($studentexemptions))) {
                                                                foreach ($studentexemptions as $studentexemption) {
                                                                    if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                        if ($studentexemption['feestudent_inscription_id'] == $student['inscription_id']) {
                                                                            $student_exemption = $studentexemption['exemption_cost_discount'];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            //classe exemption
                                                            if (isset($classesexemptions) && (!empty($classesexemptions))) {
                                                                foreach ($classesexemptions as $classeexemption) {
                                                                    if ($classeexemption['exemptionclasse_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                        if ($classeexemption['exemptionclasse_classe_id'] == $student['inscription_classe_id']) {
                                                                            $classe_exemption = $classeexemption['exemption_cost_discount'];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }

                                                $total_discount += $student_exemption + $classe_exemption;

                                                if (isset($payments) && (!empty($payments))) {
                                                    foreach ($payments as $pay) {
                                                        if ($pay['paydetails_fee_id'] == $reponse['feedetail_id']) {
                                                            if ($pay['payment_student_id'] == $student['inscription_id']) {
                                                                $total_paid = $pay['paydetails_paid_amount'];
                                                            }
                                                        }
                                                    }
                                                }

                                                $balance = ($total_fee - $total_discount) - $total_paid;

                                                $total_paid_amount_usd += ($fee_currency == 'usd') ? $total_paid : 0;
                                                $total_paid_amount_cdf += ($fee_currency == 'cdf') ? $total_paid : 0;

                                                $total_to_paid = $total_fee - $total_discount;

                                                $total_fees_amount_usd += ($fee_currency == 'usd') ? $total_fee : 0;
                                                $total_fees_amount_cdf += ($fee_currency == 'cdf') ? $total_fee : 0;

                                                $total_discount_amount_usd += ($fee_currency == 'usd') ? $total_discount : 0;
                                                $total_discount_amount_cdf += ($fee_currency == 'cdf') ? $total_discount : 0;

                                                $balance_net_usd = ($total_fees_amount_usd - $total_discount_amount_usd) - $total_paid_amount_usd;
                                                $balance_net_cdf = ($total_fees_amount_cdf - $total_discount_amount_cdf) - $total_paid_amount_cdf;

                                                ?>

                                                <tr class="small">
                                                    <td>
                                                        <?= $count++; ?>
                                                    </td>
                                                    <td class="text-uppercase font-weight-bold text-primary">
                                                        <i class="fas fa-angle-double-right"></i>
                                                        <b>
                                                            <span
                                                                style="<?= ($fee_total_payable == 1) ? 'display:none' : ''; ?>"><?= $reponse['fee_name'] . " -"; ?></span>
                                                            <span class="text-primary"> <?= $reponse['feedetail_name']; ?> </span>
                                                        </b>
                                                    </td>


                                                    <td class="font-weight-bold text">
                                                        <b><?= number_format($total_to_paid, 2, ',', ' '); ?>                     <?= $currency; ?></b>
                                                    </td>
                                                    <td class="font-weight-bold">

                                                        <b> <?= number_format($total_paid, 2, ',', ' '); ?>                     <?= $currency; ?></b>

                                                    </td>
                                                    <td class="font-weight-bold">
                                                        <b><?= number_format($balance, 2, ',', ' '); ?>                     <?= $currency; ?></b>
                                                    </td>

                                                    <td class="font-weight-bold text-uppercase">
                                                        <i class="fa <?= ($balance == 0) ? 'fa-check-circle' : ''; ?>"></i>
                                                        <b>
                                                            <?php
                                                            if ($balance == 0) {
                                                                echo 'Payé';
                                                            } elseif (($balance != 0) && ($total_paid != 0)) {
                                                                echo 'Acompte';
                                                            } else {
                                                                echo 'Non en ordre';
                                                            }
                                                            ?>
                                                        </b>

                                                    </td>

                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>

                                    <tfoot>
                                        <tr class="text-uppercase font-weight-bold">
                                            <td colspan="2" class="text-right">Totaux USD</td>

                                            <td class="text-dark">
                                                <?= number_format($total_fees_amount_usd - $total_discount_amount_usd, 2, ',', ' ') . ' $'; ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= number_format($total_paid_amount_usd, 2, ',', ' ') . ' $'; ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= number_format($balance_net_usd, 2, ',', ' ') . ' $'; ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-uppercase font-weight-bold">
                                            <td colspan="2" class="text-right">Totaux CDF</td>

                                            <td class="text-dark">
                                                <?= number_format($total_fees_amount_cdf - $total_discount_amount_cdf, 2, ',', ' ') . ' Fc'; ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= number_format($total_paid_amount_cdf, 2, ',', ' ') . ' Fc'; ?>
                                            </td>
                                            <td class="text-dark">
                                                <?= number_format($balance_net_cdf, 2, ',', ' ') . ' Fc'; ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </fieldset>
                            <hr>
                            <p class="font-weight-bold">
                                Pour éviter d’inquiéter les étudiants pendant la période d’examen de fin
                                d’année qui arrive bientôt, nous vous prions de vous acquitter des frais
                                restants dans le délai.
                            </p>
                            <p>
                                NB : En cas de réclamation, veuillez passer à la préfecture de l’école avec les reçus imprimés pour
                                harmonisation.
                            </p>
                            <p class="text-center">Franche collaboration.</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>