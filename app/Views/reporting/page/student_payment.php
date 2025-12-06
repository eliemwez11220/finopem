<section class="content">
    <div class="container-fluid">

        <?php if (session()->has('studentsclasses')): ?>
            <?php if (session()->has('feechoosed') && (session()->has('studentchoosedclasse'))): ?>

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    </div>
                </div>
                <div class="shadow-lg text-center" style="border:2px solid black">
                    <h3 class="text-uppercase font-weight-bold py-3">
                        Suivi de paiement en
                        <span class="text-danger">
                            <?= (session()->has('choosedclassename')) ? session()->choosedclassename : ""; ?>
                        </span>
                        {<span class="text-primary">
                            <?= (session()->has('feepaidchoosed')) ? session()->feepaidchoosed['fee_name'] : "Frais"; ?>
                        </span>}
                        <span class="text-dark">
                            Payable en
                            <?= (session()->has('feepaidchoosed')) ? session()->feepaidchoosed['fee_currency_payable'] : "Frais"; ?>
                        </span>
                    </h3>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="datatablesReportingActionsx">
                                <thead>
                                    <tr class="text-uppercase small">
                                        <th colspan="2"></th>
                                        <?php $fees_counter = 0;
                                        if (isset($feesclasses) && (!empty($feesclasses))) {
                                            foreach ($feesclasses as $reponse) {
                                                $fees_counter++;
                                                $feedetail_id = $reponse['feedetail_id'];
                                                $total_fee = $reponse['feedetail_cost_payable'];
                                                $fee_total_payable = $reponse['fee_total_payable'];

                                                ?>
                                                <th colspan="2" class="text-uppercase font-weight-bold text-center">
                                                    <b><?= $reponse['feedetail_name']; ?></b>
                                                </th>
                                            <?php }
                                        } ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="small text-uppercase">
                                        <th>#</th>
                                        <th>Identité étudiant</th>
                                        <?php for ($ifees = 1; $ifees <= $fees_counter; $ifees++) { ?>
                                            <th class="text-center small"><b>Bugdet</b></th>
                                            <th class="text-center small"><b>Cash</b></th>
                                        <?php } ?>
                                    </tr>

                                    <?php $count = 1;
                                    $students_listing = [];
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

                                        $feesPayable = [];
                                        $feesPayments = [];
                                        foreach ($students_listing as $keystd => $student):
                                            if ($student['inscription_status'] == 'actif'):
                                                ?>
                                                <tr class="small text-uppercase">
                                                    <td scope="1"><?= $count++; ?></td>
                                                    <td class="text-uppercase font-weight-bold">
                                                        <?= trim($student['student_firstname']); ?>

                                                        <?= trim($student['student_lastname']); ?>

                                                        <?= trim($student['student_surname']); ?>

                                                        (<?= ($student['student_gender'] == 'masculin') ? 'M' : 'F'; ?>)
                                                    </td>
                                                    <?php
                                                    $total_fee = 0;
                                                    $balance = 0;
                                                    $count_records = 0;
                                                    $total_discount_amount = 0;
                                                    $total_fees_amount = 0;
                                                    $total_paid_amount = 0;
                                                    if (isset($feesclasses) && (!empty($feesclasses))) {
                                                        //GET ALL FEES CLASSES
                                                        foreach ($feesclasses as $reponse) {

                                                            $feedetail_id = $reponse['feedetail_id'];
                                                            $total_fee = $reponse['feedetail_cost_payable'];
                                                            $fee_total_payable = $reponse['fee_total_payable'];
                                                            $total_paid = 0;
                                                            $total_to_paid = 0;
                                                            $total_discount = 0;
                                                            $classe_exemption = 0;
                                                            $student_exemption = 0;
                                                            //$feesPayable[$reponse['feedetail_id']] = $reponse['feedetail_cost_payable'] ;
                                
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

                                                            $total_to_paid = $total_fee - $total_discount;
                                                            $total_fees_amount += $feesPayable[$reponse['feedetail_id']] = $total_to_paid;
                                                            $total_paid_amount += $feesPayments[$reponse['feedetail_id']] = $total_paid;

                                                            ?>
                                                            <td class="text-center">
                                                                <span class="text-center badge badge-primary">
                                                                    <b><?= number_format($total_to_paid, 1, ',', ' '); ?></b>
                                                                </span>
                                                            </td>
                                                            <td class="font-weight-bold text-center">

                                                                <span class="font-weight-bold 
                                                                        <?php if ($balance == 0) {
                                                                            echo 'badge badge-success';
                                                                        } elseif (($balance != 0) && ($total_paid != 0)) {
                                                                            echo 'badge badge-warning';
                                                                        } else {
                                                                            echo '';
                                                                        }
                                                                        ?>">
                                                                    <b>

                                                                        <?= ($total_paid == 0) ? '' : number_format($total_paid, 1, ',', ' '); ?>

                                                                    </b>
                                                                </span>
                                                            </td>

                                                        <?php }
                                                    } ?>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- === INCLUDE FOOTER === -->
                <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
                <!-- === INCLUDE FOOTER === -->
            <?php endif; ?>
        <?php else: ?>
            <?php if (session()->has('studentchoosedclasse')): ?>
                <?php if (isset($students) && (count($students) > 0)): ?>
                    <div class="text-primary text-center">
                        <div class="text-uppercase ">
                            <h3 class="small font-weight-bold">
                                La classe choisie n'a aucun étudiant inscrit. Sélectionnez une autre classe
                            </h3>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>