<?php if (session()->has('choosedsectionid')): ?>
    <?php
    $uri = service('uri');
    // Disable throwing exceptions
    $uri->setSilent();
    $totalSegments = $uri->getTotalSegments();

    $urlReport1 = ($totalSegments >= 0) ? $uri->getSegment(1) : '';
    $urlReport2 = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
    $urlReport3 = ($totalSegments >= 3) ? $uri->getSegment(3) : '';
    $report_name = (!empty($urlReport3)) ? $urlReport3 : $urlReport2;
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $form_attrib = array(
        'role' => "form",
        'id' => "reporting_filter_data",
        'method' => "get"
    );
    ?>
    <?= form_open(base_url('reporting/filter/'.$report_name), $form_attrib); ?>
    <div class="row">
        <div class="col-lg-5 col-sm-5 col-xs-12">
            <div class="form-floating">
                <select id="agent" name="agent" class="form-control <?php if ($validation->hasError('agent')) {
                    echo 'is-invalid';
                } ?>">
                    <option selected disabled>--sélectionnez--</option>
                    <?php if (session()->admin == TRUE or session()->all == TRUE): ?>

                        <option value="all">Tout</option>

                    <?php endif; ?>

                    <?php if (isset($users) && !empty($users)):
                        foreach ($users as $userkey => $uservalue):
                            if ($uservalue['user_id'] == session()->userid or (session()->admin == TRUE) or (session()->all == TRUE)):
                                $agent_sess = isset($agent) ? $agent : session()->userid;
                                ?>
                                <option value="<?= ($uservalue['user_id']); ?>" <?= ($agent_sess == $uservalue['user_id']) ? 'selected' : set_select('agent', ($uservalue['user_id'])); ?>>
                                    <?= strtoupper($uservalue['user_firstname']); ?>
                                    <?= strtoupper($uservalue['user_lastname']); ?>
                                    [<?= strtoupper($uservalue['role_name']); ?>]
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
                <label for="agent" class="control-label">
                    <span class="text-danger">*</span>Agent
                </label><?php if (isset($validation)): ?>
                    <span class="invalid-feedback">
                        <?= display_validation_error($validation, 'agent'); ?>
                    </span>
                <?php endif; ?>

            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-xs-12">
            <div class="form-group mb-2">
                <label for="start_date"><span class="text-danger">*</span>Date début</label>
                <input type="date" class="form-control <?= ($validation->hasError('start_date')) ? ' is-invalid' : '' ?>"
                    id="start_date" name="startdate" aria-describedby="start_date" required
                    value="<?= (!empty($start)) ? $start : set_value('start_date'); ?>" />

                <div id="start_date" class="form-text">
                    <span class="text-danger"><?= displayFormError($validation, 'start_date'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12">
            <div class="form-group mb-2">
                <label for="end_date"><span class="text-danger">*</span>Date fin</label>
                <div class="input-group">
                    <input type="date" class="form-control <?= ($validation->hasError('end_date')) ? ' is-invalid' : '' ?>"
                        id="end_date" placeholder="Patient" name="enddate" aria-describedby="end_date" required
                        value="<?= (!empty($end)) ? $end : set_value('end_date'); ?>" />


                    <div class="input-group-append">
                        <button type="submit" class="btn btn-info text-uppercase" title="Bouton de recherche">
                            <i class="fa fa-search"></i> valider
                        </button>
                    </div>
                </div>
                <div id="end_date" class="form-text">
                    <span class="text-danger"><?= displayFormError($validation, 'end_date'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
<?php endif; ?>