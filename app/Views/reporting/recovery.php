<div class="content-wrapper <?= checkModuleAccess('reprecovery'); ?>">
    <!-- ====== Start Reporting Header -->
 <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
<!-- ====== End Reporting Header -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header printoff">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12 text-center">
                            <h1 class="font-weight-bold text-uppercase">
                                <i class="nav-icon fas fa-donate"></i> Recouvrement frais
                            </h1>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <blockquote>
                                <!-- GET ALL FEES DETAILS -->
                                <form role="form" id="form_ajax_fees_classes" method="get">
                                    <div class="form-floating input-group" style="width: 100%!important;">
                                        <label for=""></label>
                                        <select id="ajax_fees_classes" name="ajax_fees_classes" title="Classe"
                                            class="form-control select2 select2-info text-uppercase font-weight-bold"
                                            data-dropdown-css-class="select2-info">
                                            <option disabled selected>-- sélectionnez le frais-- </option>

                                            <?php if (isset($feesclasses) && !empty($feesclasses)):
                                                foreach ($feesclasses as $keyfee => $feesclasse): ?>
                                                    <option value="<?= esc($feesclasse['feedetail_id']); ?>"
                                                        <?= (session()->has('feechoosed') && (session()->get('feechoosed') == $feesclasse['feedetail_id'])) ? 'selected' : set_select('ajax_fees_paid', esc($feesclasse['feedetail_id'])); ?>>
                                                        <?= strtoupper($feesclasse['fee_name']); ?> -
                                                        <?= strtoupper($feesclasse['feedetail_name']); ?>
                                                        | <?= strtoupper($feesclasse['fee_currency_payable']); ?>

                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="ajax_students_classes" class="font-weight-bold">
                                    <span class="text-danger">*</span>
                                    Frais de Recouvrement
                                </label>
                                    </div>
                                </form>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($students) && !empty($students)): ?>

                <?php if (session()->has('feechoosedclasse') && !empty(session()->get('feechoosedclasse'))): ?>
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
                                <?php $feechoosedclasse = session()->get('feechoosedclasse'); ?>
                                <?= $feechoosedclasse['fee_name']; ?>
                            </span>
                            Recouvrement
                            <span class="text-primary">
                                <?= $feechoosedclasse['feedetail_name']; ?>
                            </span>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="datatablesReportingActions">
                                    <thead>
                                        <tr class="small text-uppercase">
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Postnom</th>
                                            <th>Prenom</th>
                                            <th>Sexe</th>
                                            <th>Budget</th>
                                            <th>Cash </th>
                                            <th>Solde</th>
                                            <th>Observation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        $total_fee = 0;
                                        $balance = 0;
                                        $count_records = 0;
                                        $total_fees_amount = 0;
                                        $total_paid_amount = 0;
                                        $total_discount_amount = 0;
                                        $currency = '';
                                        $balance_net = 0;
                                        if (isset($students) && (!empty($students))):
                                            foreach ($students as $keystd => $student): 
                                                $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid'):'';
                                                if (($branch_access == $student['section_id'])):
                                            ?>
                                                <tr class="small text-uppercase">
                                                    <td scope="1"><?= $count++; ?></td>
                                                    
                                                    <td class="text-uppercase">
                                                        <?= trim($student['student_firstname']); ?>
                                                        </td>
                                                    <td class="text-uppercase">
                                                        <?= trim($student['student_lastname']); ?>
                                                        </td>
                                                    <td class="text-uppercase">
                                                        <?= trim($student['student_surname']); ?>
                                                    </td>
                                                    <td class="text-uppercase">
                                                        <?= ($student['student_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                                    </td>


                                                    <?php $feeclasse_data = session()->get('feechoosedclasse');

                                                    $i = 0;
                                                    //GET ALL FEES CLASSES
                                                    $count_records++;
                                                    $feedetail_id = $feeclasse_data['feedetail_id'];
                                                    $total_fee = $feeclasse_data['feedetail_cost_payable'];
                                                    $inputs = FALSE;
                                                    
                                                    $total_discount = 0;
                                                    $classe_exemption = 0;
                                                    $student_exemption = 0;
                                                    $total_paid = 0;
                                                    $total_to_paid = 0;

                                                    // GET ALL STUDENTS EXEMPTIONS
                                                    if (isset($feesexemptions) && !empty($feesexemptions) &&(is_array($feesexemptions))) {
                                                        foreach ($feesexemptions as $discount) {
                                                            //if ($discount['feediscount_feedetail_id'] == $feedetail_id) {
                                                                //Student Exemption
                                                                if (isset($studentexemptions) && !empty($studentexemptions) &&(is_array($studentexemptions))) {
                                                                    foreach ($studentexemptions as $studentexemption) {
                                                                        if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                            if ($studentexemption['feestudent_inscription_id'] == $student['inscription_student_id']) {
                                                                                $student_exemption += $studentexemption['exemption_cost_discount'];
                                                                            }

                                                                        }
                                                                    }
                                                                }
                                                                //classe exemption
                                                                if (isset($classesexemptions) && !empty($classesexemptions)&&(is_array(value: $classesexemptions))) {
                                                                    foreach ($classesexemptions as $classeexemption) {
                                                                        if ($classeexemption['exemptionclasse_exemption_id'] == $discount['feediscount_exemption_id']) {
                                                                            $classe_exemption += $classeexemption['exemption_cost_discount'];
                                                                        }
                                                                    }
                                                                }
                                                            //}
                                                        }
                                                    }

                                                    $total_discount = $student_exemption + $classe_exemption;

                                                    if (isset($payments) && !empty($payments) &&(is_array($payments))) {
                                                        foreach ($payments as $pay) {
                                                            if ($pay['payment_student_id'] == $student['inscription_id']) {
                                                                $total_paid = $pay['paydetails_paid_amount'];
                                                            }
                                                        }
                                                    }

                                                    $balance = ($total_fee - $total_discount) - $total_paid;
                                                    $total_paid_amount += $total_paid;

                                                    $total_to_paid = $total_fee - $total_discount;
                                                    $total_fees_amount += $total_fee;
                                                    $total_discount_amount += $total_discount;
                                                    $currency = ($feeclasse_data['fee_currency_payable'] == 'usd') ? '$' : 'Fc';
                                                    $balance_net = ($total_fees_amount - $total_discount_amount) - $total_paid_amount;

                                                    //$i++;
                                                    ?>

                                                    <td class="font-weight-bold text-center">
                                                        <b><?= number_format($total_to_paid, 2, ',', ' '); ?></b>
                                                    </td>
                                                    <td class="font-weight-bold text-center">
                                                        <b> <?= number_format($total_paid, 2, ',', ' '); ?></b>
                                                    </td>
                                                    <td class="font-weight-bold text-center">
                                                        <b><?= number_format($balance, 2, ',', ' '); ?></b>
                                                    </td>
                                                    <td class="font-weight-bold">
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
                                                        <i class="fa fa-<?= ($balance == 0) ? 'check-circle' : 'window-close'; ?>"></i>

                                                    </td>

                                                </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="text-uppercase font-weight-bold">
                                            <td colspan="5" class="text-right">Totaux</td>

                                            <td class="text-dark text-center">
                                                <?= number_format($total_fees_amount - $total_discount_amount, 2, ',', ' ') . '' . $currency; ?>
                                            </td>
                                            <td class="text-dark text-center">
                                                <?= number_format($total_paid_amount, 2, ',', ' ') . '' . $currency; ?>
                                            </td>
                                            <td class="text-dark text-center">
                                                <?= number_format($balance_net, 2, ',', ' ') . '' . $currency; ?>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- === INCLUDE FOOTER === -->
                    <?php include(APPPATH . 'Views/reporting/footer.php'); ?>
                    <!-- === INCLUDE FOOTER === -->
  
                <?php endif; ?>
            <?php else: ?>
                <?php if (isset($student) && (empty($student))): ?>
                    <div class="text-primary text-center">
                        <div class="text-uppercase ">
                            <h3 class="small font-weight-bold">
                                La classe choisie n'a aucun étudiant inscrit. Sélectionnez une autre classe
                            </h3>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</div>