<div class="row printoff">
    <div class="col-sm-12 col-lg-12">
        <blockquote>
            <form role="form" id="form_ajax_reporting" method="get">
                <div class="form-floating input-group" style="width: 100%!important;">

                    <select id="ajax_student_reporting" name="ajax_student_reporting" title="Eleve"
                        class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                        <option disabled selected>--sélectionnez un étudiant-- </option>

                        <?php $students_listing = [];
                        if (session()->has('studentsclasses')) {

                            $students_session = session()->get('studentsclasses');

                            if ($students_listing != 'none') {

                                $students_listing = $students_session;
                            } else {

                                $students_listing = [];
                            }
                        } else {
                            if (isset($students)) {
                                $students_listing = $students;
                            }
                        }
                        if (!empty($students_listing) && ($students_listing != 'none')):

                        ?>
                            <option value="all">Tous les étudiants</option>
                            <?php foreach ($students_listing as $key => $studentval):
                                $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                if (($branch_access == $studentval['section_id'])):
                                    if ($studentval['inscription_status'] == 'actif'):
                            ?>
                                        <option value="<?= trim($studentval['inscription_id']); ?>"
                                            <?= (session()->has('studentchoosed') && (session()->get('studentchoosed') == $studentval['inscription_id'])) ? 'selected' : set_select('ajax_student', esc($studentval['inscription_id'])); ?>>
                                            <?= strtoupper($studentval['student_firstname']); ?>
                                            <?= strtoupper($studentval['student_lastname']); ?>
                                            <?= strtoupper($studentval['student_surname']); ?>
                                            (<?= strtoupper($studentval['student_code']); ?>) |
                                            <?= setDegresLevels(trim($studentval['degree_code']), 'f'); ?>
                                            <?= strtoupper(trim($studentval['classe_subname'])); ?>
                                            <?= strtoupper(trim($studentval['option_name'])); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                    <label for="ajax_student_reporting" class="text-capitalize">
                        <span class="text-danger">*</span>étudiants</label>
                </div>
            </form>
        </blockquote>
    </div>
</div>
<?php if ((session()->has('reportingdata')) && (session()->has('studentchoosed'))): ?>

    <div class="card">
        <div class="card-header">

            <?php
            $student_choosed_id = session()->has('studentchoosed') ? session()->get('studentchoosed') : '';
            $student_sess_data = session()->get('reportingdata');
            $student = $student_sess_data['student'];
            if (!empty($student)  && (session()->get('studentchoosedclasse') == $student['classe_id'])):
            ?>
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include APPPATH . ('Views/reporting/header.php'); ?>
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
                                <u><b>sauf erreur ou omission de notre part</b></u>,
                                conformément aux données de notre application de gestion de frais,
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
                                    <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                    <?= trim($student['classe_subname']); ?>
                                    <?= trim($student['option_name']); ?>
                                </span>] pour l’année scolaire <b><?= session()->get('schoolyear'); ?></b>
                                à la date du <?= date('d/m/Y H:i:s'); ?> se présente comme suite :
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
                                    $reporting_sess_data = session()->get('reportingdata');

                                    $fees_classes = (isset($feesclasses) && !empty($feesclasses)) ? $feesclasses : $reporting_sess_data['feesclasses'];

                                    $feesexemptions = $reporting_sess_data['feesexemptions'];
                                    $studentexemptions = $reporting_sess_data['studentexemptions'];
                                    $classesexemptions = $reporting_sess_data['classesexemptions'];
                                    $payments = $reporting_sess_data['payments'];
                                    $total_fees_amount_usd = 0;
                                    $total_fee = 0;
                                    $balance = 0;
                                    $count_records = 0;

                                    $total_fees_amount_cdf = 0;
                                    $total_paid_amount_cdf = 0;
                                    $total_discount_amount_cdf = 0;
                                    $balance_net_cdf = 0;


                                    $total_paid_amount_usd = 0;
                                    $total_discount_amount_usd = 0;
                                    $balance_net_usd = 0;
                                    if (!empty($fees_classes) && is_array($fees_classes)) {

                                        $count = 1;
                                        $i = 0;
                                        //GET ALL FEES CLASSES
                                        foreach ($fees_classes as $reponse) {
                                            //if ($reponse['feedetail_fee_id'] == session()->get('feechoosed')) {
                                            $count_records++;
                                            $feedetail_id = $reponse['feedetail_id'];
                                            $total_fee = $reponse['feedetail_cost_payable'];
                                            $inputs = false;
                                            $fee_total_payable = $reponse['fee_total_payable'];
                                            $fee_currency = $reponse['fee_currency_payable'];
                                            $currency = ($reponse['fee_currency_payable'] == 'usd') ? '$' : 'Fc';
                                            $total_paid = 0;
                                            $total_to_paid = 0;
                                            $total_discount = 0;
                                            $classe_exemption = 0;
                                            $student_exemption = 0;
                                            // GET ALL STUDENTS EXEMPTIONS
                                            if (!empty($feesexemptions)  && is_array($feesexemptions)) {
                                                foreach ($feesexemptions as $discount) {
                                                    if ($discount['feediscount_feedetail_id'] == $reponse['feedetail_id']) {
                                                        //Student Exemption
                                                        if (!empty($studentexemptions)  && is_array($studentexemptions)) {
                                                            foreach ($studentexemptions as $studentexemption) {
                                                                if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                    $student_exemption += $studentexemption['exemption_cost_discount'];
                                                                }
                                                            }
                                                        }
                                                        //classe exemption
                                                        if (!empty($classesexemptions)  && is_array($classesexemptions)) {
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

                                            if (!empty($payments) && is_array($payments)) {
                                                foreach ($payments as $pay) {
                                                    if ($pay['paydetails_fee_id'] == $reponse['feedetail_id']) {
                                                        $total_paid = $pay['paydetails_paid_amount'];
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

                                            //$i++;
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
                                                    <b><?= number_format($total_to_paid, 2, ',', ' '); ?> <?= $currency; ?></b>
                                                </td>
                                                <td class="font-weight-bold">

                                                    <b> <?= number_format($total_paid, 2, ',', ' '); ?> <?= $currency; ?></b>

                                                </td>
                                                <td class="font-weight-bold">
                                                    <b><?= number_format($balance, 2, ',', ' '); ?> <?= $currency; ?></b>
                                                </td>

                                                <td class="font-weight-bold text-uppercase">
                                                    <i class="fa <?= ($balance == 0) ? 'fa-check-circle' : ''; ?>"></i>
                                                    <b>
                                                        <?php
                                                        if ($balance == 0) {
                                                            echo 'Payé';
                                                        } elseif (($balance < 0) && ($total_paid > $total_to_paid)) {
                                                            echo 'Plus payé';
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
                                        //}
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
                            NB : Pour éviter d’inquiéter les étudiants pendant le recouvrement,
                            nous vous prions de vous acquitter des frais
                            restants dans le délai.
                        </p>


                        <ul>
                            <li>Nous vous informons que le paiement anticipatif est accepté au sein de l'école.</li>
                            <li>En cas de réclamation, veuillez passer à la direction de l’école avec les reçus
                                imprimés, le bordereau de versement ou autre pièce justificative pour
                                harmoniser la situation de l'étudiant.</li>
                        </ul>

                        <p class="text-center">Franche collaboration.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>

    <?php if (session()->has('studentsclasses')): ?>
        <?php $students_glob_listing = array();
        if (session()->has('studentsclasses')) {

            $students_glob_session = session()->get('studentsclasses');

            if ($students_glob_session == 'none') {
                $students_glob_listing = array();
            } else {
                $students_glob_listing = $students_glob_session;
            }
        } else {
            if (isset($students)) {
                $students_glob_listing = $students;
            }
        }
        if (!empty($students_glob_listing)):

            foreach ($students_glob_listing as $key => $student):
                $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                if ($branch_access == $student['section_id']):
                    if ($student['inscription_status'] == 'actif'):
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
                                                <u><b>sauf erreur ou omission de notre part</b></u>,
                                                conformément aux données de notre application de gestion de frais,
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
                                                    <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                                    <?= trim($student['classe_subname']); ?>
                                                    <?= trim($student['option_name']); ?>
                                                </span>] pour l’année scolaire <b><?= session()->get('schoolyear'); ?></b>
                                                à la date du <?= date('d/m/Y H:i:s'); ?> se présente comme suite :
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
                                                                    <b><?= number_format($total_to_paid, 2, ',', ' '); ?> <?= $currency; ?></b>
                                                                </td>
                                                                <td class="font-weight-bold">

                                                                    <b> <?= number_format($total_paid, 2, ',', ' '); ?> <?= $currency; ?></b>

                                                                </td>
                                                                <td class="font-weight-bold">
                                                                    <b><?= number_format($balance, 2, ',', ' '); ?> <?= $currency; ?></b>
                                                                </td>

                                                                <td class="font-weight-bold text-uppercase">
                                                                    <i class="fa <?= ($balance == 0) ? 'fa-check-circle' : ''; ?>"></i>
                                                                    <b>
                                                                        <?php
                                                                        if ($balance == 0) {
                                                                            echo 'Payé';
                                                                        } elseif (($balance < 0) && ($total_paid > $total_to_paid)) {
                                                                            echo 'Plus payé';
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
                                            NB : Pour éviter d’inquiéter les étudiants pendant le recouvrement,
                                            nous vous prions de vous acquitter des frais
                                            restants dans le délai.
                                        </p>


                                        <ul>
                                            <li>Nous vous informons que le paiement anticipatif est accepté au sein de l'école.</li>
                                            <li>En cas de réclamation, veuillez passer à la direction de l’école avec les reçus
                                                imprimés, le bordereau de versement ou autre pièce justificative pour
                                                harmoniser la situation de l'étudiant.</li>
                                        </ul>
                                        <p class="text-center">Franche collaboration.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>