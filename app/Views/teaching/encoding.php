<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-4 col-lg-4">
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

                <div class="col-sm-4 col-lg-4">
                    <?php if (session()->has('choosedsectionid')): ?>
                        <form role="form" id="form_students_classes" method="get">
                            <div class="form-floating input-group" style="width: 100%!important;">
                                <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                    class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                    <option selected>--Sélectionnez une classe--</option>
                                    <?php if (isset($classes) && !empty($classes)):
                                        foreach ($classes as $key => $clasvalue):
                                            $branch_access = session()->get('choosedsectionid');
                                            if (($branch_access == $clasvalue['section_id'])):

                                                $classe_sess = session()->has('studentchoosedclasse') ? session()->get('studentchoosedclasse') : '';
                                    ?>
                                                <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                    <?= ($classe_sess == $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                                    <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                    <?= ucfirst($clasvalue['classe_subname']); ?>
                                                    <?= ucfirst($clasvalue['option_name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="ajax_students_classes"><span class="text-danger">*</span>Classes des
                                    élèves</label>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4 col-lg-4">
                    <div class="text-center">
                        <a data-toggle="modal" data-target="#nouvel_element" href="#"
                            class="btn btn-primary btn-lg text-uppercase">
                            <span data-toggle="tooltip" data-placement="top"
                                title="Cliquer pour créer les Critéres de validation">
                                <i class="fa fa-plus"></i> Encodage rapide
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content <?= checkModuleAccess('timing'); ?>">
        <div class="container-fluid">
            <?php if (session()->has('choosedsectionid') && session()->has('studentchoosedclasse')): ?>
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <?php
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('teaching-encoding'), $attributes);
                        ?>

                        <div class="row">

                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">

                                    <select
                                        class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('period')) ? ' is-invalid' : '' ?>"
                                        id="period" name="period" data-dropdown-css-class="select2-info"
                                        style="width: 100%;">
                                        <option disabled>sélectionnez une période
                                        </option>

                                        <?php if (isset($yearlyperiods) && !empty($yearlyperiods)):
                                            foreach ($yearlyperiods as $perkey => $pervalue):
                                                $branch_access = session()->get('choosedsectionid');
                                                if (($branch_access == $pervalue['section_id'])):
                                                    if ($pervalue['annualperiod_status'] == 'actif' && $pervalue['period_status'] == 'actif'):
                                        ?>
                                                        <option selected value="<?= esc($pervalue['annualperiod_id']); ?>" <?= set_select('period', esc($pervalue['annualperiod_id'])); ?>>

                                                            <?= strtoupper($pervalue['period_name']); ?>
                                                            (<?= strtoupper($pervalue['period_shortname']); ?>)
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="period"><span class="text-danger">*</span>
                                        Périodes d'encodage</label>
                                    <?php if ($validation->hasError('period')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError(field: 'period'); ?></span>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">

                                    <select id="student" name="student" title="student"
                                        class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                        <option disabled selected>--sélectionnez un élève-- </option>

                                        <?php
                                        if (isset($students) && (!empty($students))):

                                            foreach ($students as $key => $studentval):
                                                $classe_choosed = session()->get('studentchoosedclasse');
                                                if (($classe_choosed == $studentval['classe_id'])):
                                                    $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                                    if (($branch_access == $studentval['section_id'])):

                                                        if ($studentval['inscription_status'] == 'actif'):
                                        ?>
                                                            <option value="<?= trim($studentval['inscription_id']); ?>"
                                                                <?= (session()->has('studentchoosed') && (session()->studentchoosed == $studentval['inscription_id'])) ? 'selected' : set_select('student', esc($studentval['inscription_id'])); ?>>
                                                                <?= strtoupper($studentval['student_firstname']); ?>
                                                                <?= strtoupper($studentval['student_lastname']); ?>
                                                                <?= strtoupper($studentval['student_surname']); ?>
                                                                (<?= strtoupper($studentval['student_code']); ?>)
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="student" class="text-capitalize">
                                        <span class="text-danger">*</span>élèves</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <select id="notes" name="notes" title="notes" class="form-control">
                                        <option value="B">B</option>
                                        <option value="E">E</option>
                                        <option value="TB">TB</option>
                                        <option value="AB">AB</option>
                                        <option value="ME">ME</option>
                                        <option value="MA">MA</option>
                                    </select>
                                    <label for="notes" class="text-capitalize">
                                        <span class="text-danger">*</span>Conduite élève</label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="place" id="place" min="1" max="100"
                                        value="<?= old('place'); ?>" placeholder="Ex:2" required autofocus />
                                    <label for="place" class="control-label">
                                        <span class="text-danger">*</span>Place
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="points" id="points" min="0" max="10000"
                                        value="<?= old('points'); ?>" placeholder="Ex:600" required />

                                    <label for="points" class="control-label">
                                        <span class="text-danger">*</span>Points obtenus
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="maxima" id="maxima" min="0" max="10000"
                                        value="<?= session()->has('maxima') ? session()->get('maxima') : old('maxima'); ?>" placeholder="Ex:600" required />

                                    <label for="maxima" class="control-label">
                                        <span class="text-danger">*</span>Maxima
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center py-2">
                            <button type="submit" class="btn btn-info btn-lg rounded-5 text-uppercase">
                                Valider l'encodage du résultat
                            </button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="datatablesExample2"
                                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr class="text-uppercase small">
                                                        <th width="1px">Actions</th>

                                                        <th>Code</th>
                                                        <th>Noms</th>
                                                        <th>Classe</th>
                                                        <th>Periode</th>
                                                        <th>Place</th>
                                                        <th>%</th>
                                                        <th>Points</th>
                                                        <th>Application</th>
                                                        <th>Conduite</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($results) && !empty($results)):
                                                        foreach ($results as $key => $result):
                                                            $status = (!empty(esc($result['period_status'])) ? esc($result['period_status']) : 'inactif');
                                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                                            if (($branch_access == $result['section_id'])):
                                                                $classe_choosed = session()->get('studentchoosedclasse');
                                                                if (($classe_choosed == $result['classe_id']) && ($result['annualperiod_status'] == 'actif' && $result['period_status'] == 'actif')):

                                                                    $percentage = $result['result_percentage'];
                                                                    $points_obtained = floatval($result['result_points_obtained']);
                                                                    $points_maximum = floatval($result['result_points_maximum']);
                                                                    $result_percentage = ($percentage != 0) ? $percentage : ($points_obtained * 100 / $points_maximum);

                                                    ?>
                                                                    <tr class="small">
                                                                        <td width="1px" class="text-center">
                                                                            <a data-toggle="modal"
                                                                                data-target="#update_<?= $result['result_id']; ?>" href="#"
                                                                                class="btn btn-xs btn-outline-warning">
                                                                                <span data-toggle="tooltip" data-placement="top"
                                                                                    title="Cliquer pour modifier cette information">
                                                                                    <i class="fa fa-edit fa-2x"></i></span>
                                                                            </a>
                                                                            <a href="<?= base_url('teaching/remove/result/' . ($result['result_id'])); ?>"
                                                                                class="btn btn-xs btn-outline-danger"
                                                                                onclick="return confirm('Etes-vous sur de vouloir supprimer ce resultat?'); false;">
                                                                                <span data-toggle="tooltip" data-placement="top"
                                                                                    title="Cliquer pour supprimer ce resultat">
                                                                                    <i class="fa fa-window-close fa-2x"></i></span>
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= strtoupper($result['student_code']); ?> 
                                                                            </td>
                                                                        <td>
                                                                            <?= strtoupper($result['student_firstname']); ?>
                                                                            <?= strtoupper($result['student_lastname']); ?>
                                                                            <?= strtoupper($result['student_surname']); ?>
                                                                            </td>
                                                                            
                                                                            <td class="text-uppercase">
                                                                            <?= strtoupper(trim($result['classe_shortname'])); ?>

                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= trim($result['period_shortname']); ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?= trim($result['result_place']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= number_format($result_percentage, 2, ','); ?>%
                                                                        </td>
                                                                        <td><?= trim($points_obtained); ?>/<?= trim($points_maximum); ?></td>
                                                                        <td><?= trim($result['result_decision']); ?></td>
                                                                        <td><?= trim($result['result_application']); ?></td>
                                                                        <td class="text-capitalize">
                                                                            <?= trim($result['result_status']); ?>
                                                                        </td>


                                                                    </tr>

                                                                    <!-- update year modal -->
                                                                    <div class="modal fade" id="update_<?= $result['result_id']; ?>">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header text-center">

                                                                                    <h4 class="modal-title d-inline-flex">Modification
                                                                                        Encodage
                                                                                        <?= strtoupper($result['student_firstname']); ?>
                                                                                        <?= strtoupper($result['student_lastname']); ?>
                                                                                        <?= strtoupper($result['student_surname']); ?>
                                                                                        (<?= strtoupper($result['student_code']); ?>) |
                                                                                        <?= strtoupper(trim($result['classe_shortname'])); ?>
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span aria-hidden="true">
                                                                                            <i class="fa fa-window-close"></i>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                                <?php
                                                                                $validation = \Config\Services::validation();
                                                                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                                                echo form_open(base_url('teaching-encoding'), $attributes);
                                                                                ?>
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="result_token"
                                                                                        id="result_token"
                                                                                        value="<?= (!empty(($result['result_token']))) ? ($result['result_token']) : old('result_token') ?>" />
                                                                                    <div class="row">

                                                                                        <div class="col-sm-12 col-lg-12 mb-2">
                                                                                            <div class="form-floating">

                                                                                                <select id="notes" name="notes"
                                                                                                    title="notes" class="form-control">

                                                                                                    <option value="B" <?= ($result['result_application'] == 'B') ? 'selected' : set_select('notes'); ?>>B</option>
                                                                                                    <option value="E" <?= ($result['result_application'] == 'E') ? 'selected' : set_select('notes'); ?>>E</option>
                                                                                                    <option value="TB" <?= ($result['result_application'] == 'TB') ? 'selected' : set_select('notes'); ?>>TB</option>
                                                                                                    <option value="AB" <?= ($result['result_application'] == 'AB') ? 'selected' : set_select('notes'); ?>>AB</option>
                                                                                                    <option value="ME" <?= ($result['result_application'] == 'ME') ? 'selected' : set_select('notes'); ?>>ME</option>
                                                                                                    <option value="MA" <?= ($result['result_application'] == 'MA') ? 'selected' : set_select('notes'); ?>>MA</option>
                                                                                                </select>
                                                                                                <label for="notes" class="text-capitalize">
                                                                                                    <span
                                                                                                        class="text-danger">*</span>Conduite
                                                                                                    élève</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-12 col-lg-12 mb-2">
                                                                                            <div class="form-floating">
                                                                                                <input type="number" class="form-control"
                                                                                                    name="place" id="place" min="0"
                                                                                                    max="100"
                                                                                                    value="<?= ($result['result_place']) ? $result['result_place'] : old('place'); ?>"
                                                                                                    placeholder="Ex:2" />

                                                                                                <label for="place" class="control-label">
                                                                                                    <span class="text-danger">*</span>Place
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-sm-12 col-lg-12 mb-2">
                                                                                            <div class="form-floating">
                                                                                                <input type="number" class="form-control" name="pource" id="pource" min="1" max="100"
                                                                                                    value="<?= (!empty($result_percentage)) ? $result_percentage : old('pource'); ?>" placeholder="Ex:60.50" step="0.01" />
                                                                                                <label for="pource" class="control-label">
                                                                                                    <span class="text-danger"></span>Pourcentage(%)
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-12 col-lg-12 mb-2">
                                                                                            <div class="form-floating">
                                                                                                <input type="number" class="form-control"
                                                                                                    name="points" id="points" min="0"
                                                                                                    max="10000"
                                                                                                    value="<?= (!empty($points_obtained)) ? $points_obtained : old('points'); ?>"
                                                                                                    placeholder="Ex:600" />

                                                                                                <label for="points" class="control-label">
                                                                                                    <span class="text-danger"></span>Points
                                                                                                    obtenus
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-12 col-lg-12 mb-2">
                                                                                            <div class="form-floating">
                                                                                                <input type="number" class="form-control"
                                                                                                    name="maxima" id="maxima" min="0"
                                                                                                    max="10000"
                                                                                                    value="<?= ($result['result_points_maximum']) ? $result['result_points_maximum'] : old('maxima'); ?>"
                                                                                                    placeholder="Ex:600" />

                                                                                                <label for="maxima" class="control-label">
                                                                                                    <span class="text-danger"></span>Maxima
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">

                                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                                        data-dismiss="modal">Fermer
                                                                                    </button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-info btn-sm text-uppercase">
                                                                                        Enregistrer les modifications
                                                                                    </button>
                                                                                </div>
                                                                                <?php echo form_close(); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end update year modal -->
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Encodages rapides</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('teaching-encoding'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">

                            <select
                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('period')) ? ' is-invalid' : '' ?>"
                                id="period" name="period" data-dropdown-css-class="select2-info"
                                style="width: 100%;">
                                <option disabled>sélectionnez une période
                                </option>

                                <?php if (isset($yearlyperiods) && !empty($yearlyperiods)):
                                    foreach ($yearlyperiods as $perkey => $pervalue):
                                        $branch_access = session()->get('choosedsectionid');
                                        if (($branch_access == $pervalue['section_id'])):
                                            if ($pervalue['annualperiod_status'] == 'actif' && $pervalue['period_status'] == 'actif'):
                                ?>
                                                <option selected value="<?= esc($pervalue['annualperiod_id']); ?>" <?= set_select('period', esc($pervalue['annualperiod_id'])); ?>>

                                                    <?= strtoupper($pervalue['period_name']); ?>
                                                    (<?= strtoupper($pervalue['period_shortname']); ?>)
                                                </option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="period"><span class="text-danger">*</span>
                                Périodes d'encodage</label>
                            <?php if ($validation->hasError('period')) { ?>
                                <span class="invalid-feedback">
                                    <?= $validation->getError(field: 'period'); ?></span>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">

                            <select id="studentrep" name="student" title="student"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez un élève-- </option>

                                <?php
                                if (isset($students) && (!empty($students))):

                                    foreach ($students as $key => $studentval):
                                        $classe_choosed = session()->get('studentchoosedclasse');
                                        if (($classe_choosed == $studentval['classe_id'])):
                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                            if (($branch_access == $studentval['section_id'])):

                                                if ($studentval['inscription_status'] == 'actif'):
                                ?>
                                                    <option value="<?= trim($studentval['inscription_id']); ?>"
                                                        <?= (session()->has('studentchoosed') && (session()->studentchoosed == $studentval['inscription_id'])) ? 'selected' : set_select('student', esc($studentval['inscription_id'])); ?>>
                                                        <?= strtoupper($studentval['student_firstname']); ?>
                                                        <?= strtoupper($studentval['student_lastname']); ?>
                                                        <?= strtoupper($studentval['student_surname']); ?>
                                                        (<?= strtoupper($studentval['student_code']); ?>)
                                                    </option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="studentrep" class="text-capitalize">
                                <span class="text-danger">*</span>élèves</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select id="notes" name="notes" title="notes" class="form-control">
                                <option value="B">B</option>
                                <option value="E">E</option>
                                <option value="TB">TB</option>
                                <option value="AB">AB</option>
                                <option value="ME">ME</option>
                                <option value="MA">MA</option>
                            </select>
                            <label for="notes" class="text-capitalize">
                                <span class="text-danger">*</span>Conduite élève</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="place" id="place" min="1" max="100"
                                value="<?= old('place'); ?>" placeholder="Ex:2" required />
                            <label for="place" class="control-label">
                                <span class="text-danger">*</span>Place
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="pource" id="pource" min="0" max="100"
                                value="<?= old('pource'); ?>" placeholder="Ex:60.50" step="0.01" required />
                            <label for="pource" class="control-label">
                                <span class="text-danger">*</span>Pourcentage(%)
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                </button>
                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                    Valider l'encodage rapide
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>