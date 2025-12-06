<?php

$uri = service('uri');
// Disable throwing exceptions
$uri->setSilent();
$totalSegments = $uri->getTotalSegments();
$url = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$url2 = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$url3 = ($totalSegments >= 3) ? $uri->getSegment(3) : '';
?>
<section class="content-header printoff">
    <div class="container-fluid">
        <div class="shadow-sm">
            <div class="row">
                <div class="col-sm-3 col-lg-3">
                     <!-- ====== Start Section Filter Header -->
                     <?php include(APPPATH . ('Views/reporting/section_filter.php')); ?>
                            <!-- ====== End Section Filter Header -->
                </div>
                <div class="col-sm-4 col-lg-4">
                    <form role="form" id="ajax_students_form" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--Selectionnez une promotion--</option>

                                <?php
                                if (session()->has('choosedsectionid')):
                                    if (isset($classes) && !empty($classes)):
                                        ?>
                                        <option value="all">Toutes les promotion</option>
                                        <?php foreach ($classes as $key => $classeval):
                                            if ($classeval['section_id'] == session()->get('choosedsectionid')):
                                                ?>
                                                <option  value="<?= esc($classeval['classe_id']); ?>"
                                                    <?= (session()->has('studentchoosedclasse') && (session()->studentchoosedclasse == $classeval['classe_id'])) ? 'selected' : set_select('ajax_students_classes', esc($classeval['classe_id'])); ?>>
                                                    <?= setDegresLevels($classeval['degree_code'], 'f'); ?>
                                                    <?= trim($classeval['classe_subname']); ?>
                                                    <?= trim($classeval['option_name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>


                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                            <label for="ajax_students_classes" class="font-weight-bold">
                                <span class="text-danger">*</span>Promotions
                            </label>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3 col-lg-3">
                <?php $reporting = session()->get('reportingtype'); ?>
                <div class="<?= (($url2== 'recovery') OR ($url2== 'listing') OR ($url2=='students') OR ($url2=='parent') OR ($reporting == 'student_identity') OR ($reporting == 'school_annuary') OR ($reporting == 'phone_annuary') OR ($reporting == 'yearly_students') OR ($reporting == 'student_serni'))?'d-none':''; ?>">

                    <form role="form" id="form_ajax_fees_classes" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">

                            <select id="ajax_fees_paid" name="ajax_fees_paid" title="Frais"
                                class="form-control select2 select2-info text-uppercase font-weight-bold"
                                data-dropdown-css-class="select2-info">
                                <option disabled selected>-- sélectionnez le frais-- </option>
                                <option value="all">Tous les frais</option>
                                <?php if (isset($fees) && !empty($fees)):
                                    foreach ($fees as $keyfee => $fee): ?>
                                        <option value="<?= esc($fee['fee_id']); ?>" <?= (session()->has(key: 'feechoosed') && (session()->feechoosed == $fee['fee_id'])) ? 'selected' : set_select('ajax_fees_paid', esc($fee['fee_id'])); ?>>
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
                </div>
                <div class="col-sm-2 col-lg-2">
                    <div
                        class="float-right <?= (current_url() == base_url('export/students') or current_url() == base_url('export/parents')) ? 'd-none' : ''; ?>">
                        <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-lg"
                            onclick="print()">
                            <i class="fa fa-print"></i> Imprimer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>