
<div class="content-wrapper">
    <section class="content printoff">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-sm-12 col-lg-12">

                    <form role="form" id="ajax_reporting_form" method="get">
                        <div class="input-group form-floating shadow-sm" style="width: 100%!important;">
                            <select id="ajax_reporting" name="ajax_reporting" title="Rapport"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option selected="selected">-- Sélectionnez un rapport--</option>
                                <?php
                                //$reporting = session()->has('reporting') ? session()->get('reporting'):'';
                                $typesecoles = setReporting();
                                foreach ($typesecoles as $key => $value):

                                    ?>
                                    <option <?= disabledAccessModule($key); ?> value="<?= trim($key); ?>"
                                        <?= (session()->has('reportingtype') && session()->get('reportingtype') == $key) ? 'selected' : set_select('ajax_reporting', ($key)); ?>>

                                        <?= trim($value); ?>

                                    <?php endforeach; ?>

                            </select>
                            <label for="ajax_students">
                                <span class="text-danger">*</span>Edition Rapport
                            </label>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php if (session()->has('reportingtype')): ?>
        <?php if ((session()->get('reportingtype') != 'finances_fees')): ?>
            <!-- ====== Start Reporting Header -->
            <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
            <!-- ====== End Reporting Header -->
        <?php endif; ?>

        <?php if ((session()->has('choosedsectionid')) OR (session()->get('reportingtype') == 'finances_fees')): ?>
            
            <?php include(APPPATH . ('Views/reporting/page/' . session()->get('reportingtype')) . '.php'); ?>

        <?php endif; ?>
    <?php endif; ?>
</div>