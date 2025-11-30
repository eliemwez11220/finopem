<section class="content">
    <div class="container-fluid">

        <?php $total_discount_amount = 0;?>
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
                        Exhonérations de
                        <span class="text-danger">
                            <?= (session()->has('choosedclassename')) ? session()->get('choosedclassename') : ""; ?>
                        </span>
                        <?php $feepaid_choosed = (session()->has('feepaidchoosed')) ? session()->get('feepaidchoosed'):''; ?>
                                    
                        {<span class="text-primary">
                            <?= (!empty($feepaid_choosed)) ? $feepaid_choosed['fee_name'] : "Frais"; ?>
                        </span>}
                        <span class="text-dark">
                            (<?= (!empty($feepaid_choosed)) ? $feepaid_choosed['fee_currency_payable'] : ""; ?>)
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
                                        if (isset($exemp_fees) && (!empty($exemp_fees))) {
                                            foreach ($exemp_fees as $exemp_fee) {
                                                $fees_counter++;
                                                $feedetail_id = $exemp_fee['feedetail_id'];
                                                $total_fee = $exemp_fee['feedetail_cost_payable'];
                                                $fee_total_payable = $exemp_fee['fee_total_payable'];
                                                ?>
                                                <th colspan="3" class="text-uppercase font-weight-bold text-center">
                                                    <b><?= $exemp_fee['feedetail_name']; ?></b>
                                                </th>
                                            <?php }
                                        } ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="small text-uppercase">
                                        <th>#</th>
                                        <th>Identité élève</th>
                                        <?php for ($ifees = 1; $ifees <= $fees_counter; $ifees++) { ?>
                                            <th class="text-center small"><b>Montant</b></th>
                                            <th class="text-center small"><b>Bourse</b></th>
                                            <th class="text-center small"><b>Bugdet</b></th>
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
                                                    
                                                    $total_fees_amount = 0;
                                                    $total_paid_amount = 0;
                                                    if (isset($exemp_fees) && (!empty($exemp_fees))) {
                                                        //GET ALL FEES CLASSES
                                                        foreach ($exemp_fees as $reponse) {

                                                            $feedetail_id = $reponse['feedetail_id'];
                                                            $total_fee = $reponse['feedetail_cost_payable'];
                                                            $fee_total_payable = $reponse['fee_total_payable'];
                                                            $total_paid = 0;
                                                            $total_to_paid = 0;
                                                            $total_discount = 0;
                                                            $classe_exemption = 0;
                                                            $student_exemption = 0;

                                                            // GET ALL STUDENTS EXEMPTIONS
                                                            if (isset($feesexemptions) && is_array($feesexemptions) && (!empty($feesexemptions))) {
                                                                foreach ($feesexemptions as $discount) {
                                                                    if (($discount['feediscount_feedetail_id'] == $reponse['feedetail_id']) && ($discount['exemption_currency'] == $reponse['fee_currency_payable'])) {

                                                                        if (isset($studentexemptions) && is_array($studentexemptions) && (!empty($studentexemptions))) {
                                                                            foreach ($studentexemptions as $studentexemption) {
                                                                                if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                                    if ($studentexemption['feestudent_inscription_id'] == $student['inscription_id']) {
                                                                                        $student_exemption = $studentexemption['exemption_cost_discount'];
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        //classe exemption
                                                                        if (isset($classesexemptions) && is_array($classesexemptions) && (!empty($classesexemptions))) {
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


                                                            $balance = $total_fee - $total_discount;

                                                            $total_to_paid = $total_fee - $total_discount;
                                                            $total_fees_amount += $feesPayable[$reponse['feedetail_id']] = $total_to_paid;
                                                            $total_discount_amount +=$total_discount;
                                                            ?>
                                                            <td class="text-center">
                                                                <span class="text-center badge badge-dark">
                                                                    <b><?= number_format($total_fee, 1, ',', ' '); ?></b>
                                                                </span>
                                                            </td>
                                                            <td class="font-weight-bold text-center">
                                                                <span class="font-weight-bold badge badge-warning">
                                                                    <b>
                                                                        <?= number_format($total_discount, 1, ',', ' '); ?>

                                                                    </b>
                                                                </span>
                                                            </td>
                                                            <td class="font-weight-bold text-center">
                                                                <span class="font-weight-bold badge badge-primary">
                                                                    <b>
                                                                        <?= number_format($total_to_paid, 1, ',', ' '); ?>

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

                <div class="row">
                    <?php if ($total_discount_amount !=0):
                    $sess_currency_feepaidchoosed = session()->has('feepaidchoosed') ? session()->get('feepaidchoosed'):'';
                    $sess_currency_feepaid = (!empty($sess_currency_feepaidchoosed)) ? $sess_currency_feepaidchoosed['fee_currency_payable']:'';
                   if (isset($exemp_fees) && !empty($exemp_fees)):
                        foreach ($exemp_fees as $key => $recette):
                            if (($recette['exemption_currency'] == $sess_currency_feepaid)):
                                $exemption_amount = $recette['exemption_cost_discount'];
                                $exemption_currency = $recette['exemption_currency'];

                                ?>
                                <div class="col-lg-4 col-sm-6 col-md-4 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1 font-weight-bold">
                                            <i class="fas fa-tags"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text font-weight-bold text-uppercase border-bottom mb-2">
                                                Bourse [<?= trim($recette['exemption_name']); ?>]
                                            </span>

                                            <span class="font-weight-bold text-uppercase">
                                               Sur <b class="text-danger"><?= trim($recette['feedetail_name']); ?></b>
                                                [<?= number_format($exemption_amount, 2, ',', ' '); ?>]
                                                <b class="text-danger"><?= trim($exemption_currency); ?></b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endif; ?>
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
                                La classe choisie n'a aucun élève inscrit. Sélectionnez une autre classe
                            </h3>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>