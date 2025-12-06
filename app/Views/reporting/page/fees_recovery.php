
<?php if (session()->has('studentsclasses')): ?>
    <?php 
    $students_listing = array();
    if (session()->has('studentsclasses')) {

        $students_session = session()->get('studentsclasses');

        if ($students_session == 'none') {
            $students_listing = array();
        } else {
            $students_listing = $students_session;
        }
    } else {
        if (isset($students)) {
            $students_listing = $students;
        }
    }
    if (!empty($students_listing)):
        foreach ($students_listing as $key => $student):
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
                                Recouvrement
                                <span class="text-primary">
                                    <?php $feepaidchoosed = (session()->has('feepaidchoosed')) ? session()->get('feepaidchoosed'):''; ?>
                                    <?= (!empty($feepaidchoosed)) ? $feepaidchoosed['fee_name'] : "Frais"; ?>
                                </span>
                                <span class="text-danger">
                                    <?= (session()->has('choosedclassename')) ? session()->get('choosedclassename') : ""; ?>
                                </span>
                            </h3>
                        </div>



                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                <blockquote>
                                    <p class="text-dark">La situation annuelle de paiement de l’étudiant

                                        [<span class="text-primary text-uppercase font-weight-bold">
                                            <?= strtoupper($student['student_firstname']); ?>
                                            <?= strtoupper($student['student_lastname']); ?>
                                            <?= strtoupper($student['student_surname']); ?>
                                            -
                                        </span>

                                        immatriculé:
                                        <span class="text-primary text-uppercase font-weight-bold">
                                            <?= strtoupper($student['student_code']); ?>
                                        </span>
                                        de la
                                        <span class="text-primary text-uppercase font-weight-bold">
                                            <?= setDegresLevels($student['degree_code']); ?>
                                            <?= strtoupper($student['classe_subname']); ?>
                                            <?= strtoupper($student['option_name']); ?>
                                        </span>] pour l’année scolaire <b><?= session()->get('schoolyear'); ?></b>  se présente comme suite :
                                    </p>
                                </blockquote>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <fieldset>
                                    <table class="table table-bordered table-sm" id="datatablesExample">
                                        <thead>
                                            <tr class="small">
                                                <th>#</th>
                                                <th>DESCRIPTION FRAIS</th>

                                                <th>OBSERVATION</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            $total_fee = 0;
                                            $balance = 0;
                                            $count_records = 0;
                                            $total_fees_amount = 0;
                                            $total_paid_amount = 0;
                                            $total_discount_amount = 0;
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
                                                    $total_paid = 0;
                                                    $total_to_paid = 0;
                                                    $total_discount = 0;
                                                    $classe_exemption = 0;
                                                    $student_exemption = 0;
                                                    // GET ALL STUDENTS EXEMPTIONS
                                                    if (isset($feesexemptions) && (!empty($feesexemptions))&& is_array($feesexemptions)) {

                                                        foreach ($feesexemptions as $discount) {
                                                            if ($discount['feediscount_feedetail_id'] == $reponse['feedetail_id']) {
                                                                //Student Exemption
                            
                                                                if (isset($studentexemptions) && (!empty($studentexemptions)) && is_array($studentexemptions)) {
                                                                    foreach ($studentexemptions as $studentexemption) {
                                                                        if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                            if ($studentexemption['feestudent_inscription_id'] == $student['inscription_id']) {
                                                                                $student_exemption = $studentexemption['exemption_cost_discount'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                //classe exemption
                                                                if (isset($classesexemptions) && (!empty($classesexemptions)) && is_array($classesexemptions)) {
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

                                                    if (isset($payments) && (!empty($payments)) && is_array($payments)) {
                                                        foreach ($payments as $pay) {
                                                            if ($pay['paydetails_fee_id'] == $reponse['feedetail_id']) {
                                                                if ($pay['payment_student_id'] == $student['inscription_id']) {
                                                                    $total_paid = $pay['paydetails_paid_amount'];
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $balance = ($total_fee - $total_discount) - $total_paid;
                                                    $total_paid_amount += $total_paid;

                                                    $total_to_paid = $total_fee - $total_discount;
                                                    $total_fees_amount += $total_fee;
                                                    $total_discount_amount += $total_discount;
                                                    $currency = ($reponse['fee_currency_payable'] == 'usd') ? '$' : 'Fc';
                                                    $balance_net = ($total_fees_amount - $total_discount_amount) - $total_paid_amount;

                                                    //$i++;
                                                    ?>
                                                    <tr class="">
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

                                                        <td class="font-weight-bold text-uppercase">
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
                                                            <i class="fa <?= ($balance == 0) ? 'fa-check-circle' : ''; ?>"></i>

                                                        </td>

                                                    </tr>
                                                <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <hr>
                                <p>
                                    NB : En cas de réclamation, veuillez passer à la préfecture de l’école avec les reçus imprimés pour
                                    harmonisation. Franche collaboration !
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>