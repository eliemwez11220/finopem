<div class="content-wrapper <?= checkModuleAccess('education'); ?>">
    <section class="content pt-2 p-md-2 p-lg-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignements</li>
                            <li class="breadcrumb-item active" aria-current="page">Cotations des élèves</li>

                        </ol>
                    </nav>
                </div>

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
                            <label for="ajax_students_classes">
                                <span class="text-danger">*</span>Classes des élèves
                            </label>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h1 class="text-uppercase font-weight-bold">
                        Transcription cotations des élèves
                    </h1>
                </div>
            </div>
            <?php if (session()->has('choosedsectionid') && session()->has('studentchoosedclasse')): ?>
            <div class="row mb-2">
                <div class="col-lg-4 col-sm-12">
                    <?php
                        $validation = \Config\Services::validation();
                        $attributes = array('role' => 'form', 'id' => 'form_studentquote', 'class' => 'form-horizontal');
                        echo form_open(base_url('education/studentquote'), $attributes);
                        ?>

                    <div class="row shadow-lg py-2">
                        <div class="col-sm-12 col-lg-12 mb-2">
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
                                    <span class="text-danger">*</span>élèves
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <select class="select2 form-control text-uppercase small" id="course" name="course"
                                    required>
                                    <option disabled selected>--Sélectionnez un cours--</option>
                                    <?php if (isset($courses_classes) && !empty($courses_classes)): ?>
                                    <?php foreach ($courses_classes as $course): ?>
                                    <option value="<?= esc($course['courseclasse_id']); ?>">
                                        <?= strtoupper($course['course_name']); ?>
                                        [<?= strtoupper($course['branch_name']); ?>]
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="course"><span class="text-danger">*</span>Cours concerné
                                </label>
                                <?php if ($validation->hasError('course')) { ?>
                                <span class="invalid-feedback">
                                    <?= $validation->getError(field: 'course'); ?></span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <select
                                    class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('annualperiod')) ? ' is-invalid' : '' ?>"
                                    id="annualperiod" name="annualperiod" data-dropdown-css-class="select2-info"
                                    style="width: 100%;">
                                    <option disabled selected>--Sélectionnez une période--
                                    </option>

                                    <?php if (isset($yearlyperiods) && !empty($yearlyperiods)):
                                    foreach ($yearlyperiods as $perkey => $pervalue):
                                        $branch_access = session()->get('choosedsectionid');
                                        if (($branch_access == $pervalue['section_id']) && ($pervalue['annualperiod_status'] == 'actif')):
                                            
                                ?>
                                    <option value="<?= esc($pervalue['annualperiod_id']); ?>"
                                        <?= set_select('annualperiod', esc($pervalue['annualperiod_id'])); ?>>

                                        <?= strtoupper($pervalue['period_name']); ?>
                                        (<?= strtoupper($pervalue['period_shortname']); ?>)
                                    </option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="annualperiod"><span class="text-danger">*</span>
                                    Période de cotation</label>
                                <?php if ($validation->hasError('annualperiod')) { ?>
                                <span class="invalid-feedback">
                                    <?= $validation->getError(field: 'annualperiod'); ?></span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="points" id="points" min="0" max="10000"
                                    value="<?= old('points'); ?>" placeholder="Ex:20" required />

                                <label for="points" class="control-label">
                                    <span class="text-danger">*</span>Point obtenu
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="notes" id="notes"
                                    value="<?= set_value('notes'); ?>" placeholder="Ex:600" />
                                <label for="notes" class="control-label">
                                    <span class="text-danger"></span>Observations
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12 mb-2">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info btn-lg">
                                    <i class="fas fa-check-circle"></i>
                                    Valider la cotation
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <div class="col-lg-8 col-sm-12">
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
                                                    <th>élève</th>
                                                    <th>Classe</th>
                                                    <th>Cours</th>
                                                    <th>Points</th>
                                                    <th>Période</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $count = 1;
                                                    if (isset($quotes_students) && !empty($quotes_students)):
                                                        foreach ($quotes_students as $key => $result):
                                                            $status = (!empty(esc($result['grade_status'])) ? esc($result['grade_status']) : 'inactif');
                                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                                            if (($branch_access == $result['section_id'])):
                                                                $classe_choosed = session()->get('studentchoosedclasse');
                                                                if ($classe_choosed == $result['classe_id']):

                                                                    $points_obtained = floatval($result['grade_total']);
                                                                    //$maxima_period = floatval($result['courseclasse_maxima_period']);
                                                                    //$maxima_exam = floatval($result['courseclasse_maxima_exam']);

                                                                    $period_point = floatval($result['courseclasse_period_point']);
                                                                    //$points_maximum = $period_point * 4;

                                                    ?>
                                                <tr class="small">
                                                    <td width="1px" class="text-center">
                                                        <a href="<?= base_url('education/studentslipnote/' . $result['student_token']); ?>"
                                                            class="btn btn-xs btn-info">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour afficher le bulletin">
                                                                <i class="fa fa-info-circle"></i></span>
                                                        </a>
                                                        <a data-toggle="modal"
                                                            data-target="#update_grade_<?= $result['grade_id']; ?>"
                                                            href="#" class="btn btn-xs btn-outline-warning">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour modifier cette information">
                                                                <i class="fa fa-edit"></i></span>
                                                        </a>
                                                        <a href="<?= base_url('education/remove/studentquote/' . $result['grade_id']); ?>"
                                                            class="btn btn-xs btn-outline-danger"
                                                            onclick="return confirm('Etes-vous sur de vouloir supprimer cette cotation?'); false;">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour supprimer cette cotation">
                                                                <i class="fa fa-window-close"></i></span>
                                                        </a>
                                                    </td>
                                                    <td class="text-uppercase small">
                                                        <?= strtoupper($result['student_firstname']); ?>
                                                        <?= strtoupper($result['student_lastname']); ?>
                                                        <?= strtoupper($result['student_surname']); ?>
                                                        [<?= strtoupper($result['student_code']); ?>]
                                                    </td>

                                                    <td class="text-uppercase small">
                                                        <?= setDegresLevels($result['degree_code'], 'f'); ?>
                                                        <?= strtoupper(trim($result['classe_subname'])); ?>
                                                        <?= strtoupper(trim($result['option_name'])); ?>
                                                    </td>
                                                    <td class="text-uppercase small">
                                                        <?= strtoupper($result['course_name']); ?>
                                                        [<?= strtoupper($result['branch_shortname']); ?>]
                                                    </td>
                                                    <td class="text-center">
                                                        <?= trim($points_obtained); ?>
                                                    </td>
                                                    <td>
                                                        <?= strtoupper($result['period_shortname']); ?>
                                                        (<?= strtoupper($result['period_name']); ?>)
                                                    </td>

                                                </tr>

                                                <!-- Modal for updating grade -->
                                                <div class="modal fade" id="update_grade_<?= $result['grade_id']; ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="updateGradeModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title text-uppercase font-weight-bold"
                                                                    id="updateGradeModalLabel">
                                                                    Modifier la cotation de l'élève
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post"
                                                                action="<?= base_url('education/studentquote'); ?>">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="token"
                                                                        value="<?= $result['grade_token']; ?>">
                                                                    <input type="hidden" name="action" value="update">
                                                                    <div class="row">

                                                                        <div class="col-lg-12 col-sm-12 mb-2">
                                                                            <div class="form-floating">

                                                                                <select
                                                                                    class="form-control select2 select2-info"
                                                                                    id="update_student_<?= $result['grade_id']; ?>"
                                                                                    name="student" required>
                                                                                    <option disabled>--sélectionnez un
                                                                                        élève--</option>
                                                                                    <?php if (isset($students) && !empty($students)): ?>
                                                                                    <?php foreach ($students as $student): ?>
                                                                                    <?php if ($student['classe_id'] == $result['classe_id'] && $student['section_id'] == $result['section_id']): ?>
                                                                                    <option
                                                                                        value="<?= esc($student['inscription_id']); ?>"
                                                                                        <?= ($student['inscription_id'] == $result['inscription_id']) ? 'selected' : ''; ?>>
                                                                                        <?= strtoupper($student['student_firstname']); ?>
                                                                                        <?= strtoupper($student['student_lastname']); ?>
                                                                                        <?= strtoupper($student['student_surname']); ?>
                                                                                        (<?= strtoupper($student['student_code']); ?>)
                                                                                    </option>
                                                                                    <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                                <label
                                                                                    for="update_student_<?= $result['grade_id']; ?>">
                                                                                    <span
                                                                                        class="text-danger">*</span>Élève
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-12 col-sm-12 mb-2">
                                                                            <div class="form-floating">

                                                                                <select
                                                                                    class="form-control select2 select2-info"
                                                                                    id="update_course_<?= $result['grade_id']; ?>"
                                                                                    name="course" required>
                                                                                    <option disabled>--Sélectionnez un
                                                                                        cours--</option>
                                                                                    <?php if (isset($courses_classes) && !empty($courses_classes)): ?>
                                                                                    <?php foreach ($courses_classes as $course): ?>
                                                                                    <option
                                                                                        value="<?= esc($course['courseclasse_id']); ?>"
                                                                                        <?= ($course['courseclasse_id'] == $result['courseclasse_id']) ? 'selected' : ''; ?>>
                                                                                        <?= strtoupper($course['course_name']); ?>
                                                                                        [<?= strtoupper($course['branch_name']); ?>]
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                                <label
                                                                                    for="update_course_<?= $result['grade_id']; ?>">
                                                                                    <span
                                                                                        class="text-danger">*</span>Cours
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-12 col-lg-12 mb-2">
                                                                            <div class="form-floating">
                                                                                <select
                                                                                    class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('annualperiod')) ? ' is-invalid' : '' ?>"
                                                                                    id="annualperiodUpdate<?= $result['grade_id']; ?>"
                                                                                    name="annualperiod"
                                                                                    data-dropdown-css-class="select2-info"
                                                                                    style="width: 100%;">
                                                                                    <option disabled selected>
                                                                                        --Sélectionnez une période--
                                                                                    </option>

                                                                                    <?php if (isset($yearlyperiods) && !empty($yearlyperiods)):
                                    foreach ($yearlyperiods as $perkey => $pervalue):
                                        $branch_access = session()->get('choosedsectionid');
                                        if (($branch_access == $pervalue['section_id']) && ($pervalue['annualperiod_status'] == 'actif')):
                                            
                                ?>
                                                                                    <option
                                                                                        value="<?= esc($pervalue['annualperiod_id']); ?>"
                                                                                        <?= ($pervalue['annualperiod_id'] == $result['grade_annualperiod_id']) ? 'selected' :set_select('annualperiod', esc($pervalue['annualperiod_id'])); ?>>

                                                                                        <?= strtoupper($pervalue['period_name']); ?>
                                                                                        (<?= strtoupper($pervalue['period_shortname']); ?>)
                                                                                    </option>
                                                                                    <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                    <?php endif; ?>
                                                                                </select>
                                                                                <label for="annualperiodUpdate<?= $result['grade_id']; ?>"><span
                                                                                        class="text-danger">*</span>
                                                                                    Période de cotation</label>
                                                                                <?php if ($validation->hasError('annualperiod')) { ?>
                                                                                <span class="invalid-feedback">
                                                                                    <?= $validation->getError(field: 'annualperiod'); ?></span>
                                                                                <?php } ?>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-sm-12 mb-2">
                                                                            <div class="form-floating">

                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    id="update_points_<?= $result['grade_id']; ?>"
                                                                                    name="points" min="0" 
                                                                                    value="<?= esc($result['grade_total']); ?>"
                                                                                    required>
                                                                                <label
                                                                                    for="update_points_<?= $result['grade_id']; ?>">
                                                                                    <span
                                                                                        class="text-danger">*</span>Points
                                                                                    obtenus
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-sm-12 mb-2">
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control"
                                                                                    id="update_notes_<?= $result['grade_id']; ?>"
                                                                                    name="notes" rows="3"
                                                                                    placeholder="Ex: note supplementaires"><?= esc($result['grade_notes']); ?></textarea>
                                                                                <label
                                                                                    for="update_notes_<?= $result['grade_id']; ?>">Observations</label>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Annuler la
                                                                        modification</button>
                                                                    <button type="submit" class="btn btn-warning">
                                                                        <i class="fas fa-check-circle"></i>
                                                                        Modifier la cotation
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>