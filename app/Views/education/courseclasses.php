<div class="content-wrapper <?= checkModuleAccess('courses'); ?>">
    <div class="content pt-2 p-md-2 p-lg-2">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignements</li>
                            <li class="breadcrumb-item active" aria-current="page">Configuration Cours</li>
                            <li class="ml-3">
                                <a href="<?= base_url(relativePath: 'education/courses'); ?>"
                                    class="btn btn-dark btn-sm text-uppercase"
                                    title="Cliquer pour  afficher la liste des enseignants">
                                    <i class="fa fa-reply-all"></i> Revenir a la liste des cours
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($course['course_code']) && (!empty($course['course_code']))): ?>
        <section class="content">
            <div class="container-fluid">
                <div class="text-center alert alert-primary">
                    <h1 class="font-weight-bold text-uppercase">
                        Configuration du cours <span class="text-danger"><?= $course['course_name']; ?></span> par classe
                    </h1>

                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
                        <ul class="list-group text-uppercase">
                            <li class="list-group-item"><strong><i class="fa fa-bookmark"></i> Code cours:</strong>
                                <?= isset($course['course_code']) ? esc($course['course_code']) : 'N/A'; ?></li>

                            <li class="list-group-item"><strong><i class="fa fa-bookmark"></i> Sigle Cours:</strong>
                                <?= isset($course['course_shortname']) ? esc($course['course_shortname']) : 'N/A'; ?></li>

                            <li class="list-group-item"><strong><i class="fa fa-bookmark"></i> Cours:</strong>
                                <?= isset($course['course_name']) ? esc($course['course_name']) : 'N/A'; ?></li>

                            <li class="list-group-item"><strong><i class="fa fa-bookmark"></i> Branche:</strong>
                                <?= isset($course['branch_name']) ? esc($course['branch_name']) : 'N/A'; ?></li>
                            <li class="list-group-item"><strong><i class="fa fa-bookmark"></i> Sigle branche:</strong>
                                <?= isset($course['branch_shortname']) ? esc($course['branch_shortname']) : 'N/A'; ?></li>

                            <li class="list-group-item"><strong><i class="fa fa-book"></i> Notes sur le cours:</strong>
                                <?= isset($course['course_notes']) ? esc($course['course_notes']) : 'N/A'; ?></li>
                            <li class="list-group-item"><strong><i class="fa fa-book"></i> Notes sur la branche:</strong>
                                <?= isset($course['branch_notes']) ? esc($course['branch_notes']) : 'N/A'; ?></li>

                        </ul>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <div class="card">
                            <?php
                            $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'id' => 'create_form_classe');
                            echo form_open(base_url('education/courseclasses/' . $course['course_token']), $attributes);
                            ?>
                            <div class="card-body">
                                <input type="hidden" name="course" id="course" value="<?= $course['course_id']; ?>">
                                <input type="hidden" name="action" id="action" value="create">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                        <div class="form-floating">
                                            <select class="select2 form-control text-uppercase" id="classe" name="classe"
                                                required>
                                                <option disabled selected>--Sélectionnez une classe--</option>
                                                <?php if (isset($classes) && !empty($classes)): ?>
                                                    <?php foreach ($classes as $classe): ?>
                                                        <option value="<?= esc($classe['classe_id']); ?>"
                                                            <?= set_select('classe', esc($classe['classe_id'])); ?>>
                                                            <?= setDegresLevels($classe['degree_code'], 'f'); ?>
                                                            <?= $classe['classe_subname']; ?>
                                                            <?= $classe['section_name']; ?>
                                                            [<?= $classe['option_name']; ?>]
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <label for="classe" class="control-label">
                                                <span class="text-danger">*</span>Classe du cours
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                        <div class="form-floating">
                                            <input type="number" min="1" class="form-control" name="week_hours"
                                                id="week_hours" value="<?= set_value('week_hours') ?>" placeholder="Ex:8" />
                                            <label for="week_hours" class="control-label">
                                                <span class="text-danger">*</span>Total heures par semaine du cours
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                        <div class="form-floating">
                                            <select class="form-control text-uppercase" id="is_mandatory"
                                                name="is_mandatory" required>
                                                <option value="oui" <?= set_select('is_mandatory', 'oui'); ?>>Oui</option>
                                                <option value="non" <?= set_select('is_mandatory', 'non'); ?>>Non</option>
                                            </select>
                                            <label for="is_mandatory"><span class="text-danger">*</span>Le cours est-il
                                                obligatoire pour l'examen?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                        <div class="form-floating">
                                            <input type="number" min="1" class="form-control" step="0.01"
                                                name="period_point" id="period_point"
                                                value="<?= set_value('period_point') ?>" placeholder="Ex:4" />
                                            <label for="period_point" class="control-label">
                                                <span class="text-danger">*</span>Pondération par période du cours
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-6 mb-2">
                                        <div class="form-floating">
                                            <select class="form-control select2" id="slipnote_place" name="slipnote_place"
                                                required>
                                                <?php
                                                for ($i = 1; $i <= 50; $i++): ?>
                                                    <option value="<?= $i; ?>" <?= set_select('slipnote_place', $i); ?>>
                                                        <?= $i; ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                            <label for="slipnote_place"><span class="text-danger">*</span>Place d'affichage
                                                sur le bulletin</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 mb-2">
                                        <div class="form-floating">
                                            <select class="form-control text-uppercase" id="status" name="status" required>
                                                <option value="actif" <?= set_select('status', 'actif'); ?>>Actif</option>
                                                <option value="inactif" <?= set_select('status', 'inactif'); ?>>Inactif
                                                </option>
                                            </select>
                                            <label for="status"><span class="text-danger">*</span>Statut du cours</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="notes" id="notes"
                                                value="<?= set_value('notes') ?>" placeholder="Note supplementaires" />
                                            <label for="notes" class="control-label">
                                                <span class="text-danger"></span>Notes interne sur la configuration du cours
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12 mb-2">
                                        <div class="form-floating">

                                            <select
                                                class="form-control select2 select2-info <?= ($validation->hasError('maxima')) ? ' is-invalid' : '' ?>"
                                                id="maxima" name="maxima" data-dropdown-css-class="select2-info"
                                                style="width: 100%;">
                                                <option selected disabled>--Sélectionnez un maxima </option>
                                                <option value="new">Créer un nouveau groupe maxima</option>
                                                <?php if (isset($maximas) && !empty($maximas)):
                                                    foreach ($maximas as $keymaxima => $maxima):
                                                ?>
                                                        <option value="<?= esc($maxima['maxima_id']); ?>"
                                                            <?= set_select('maxima', esc($maxima['maxima_id'])); ?>>

                                                            <?= strtoupper($maxima['section_name']); ?>

                                                            <?= ucwords($maxima['maxima_name']); ?> |
                                                            [PERIODE:<?= ucwords($maxima['maxima_total_period']); ?>
                                                            [EXAMEN:<?= ucwords($maxima['maxima_total_exam']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if ($validation->hasError('maxima')) { ?>
                                                <span class="invalid-feedback">
                                                    <?= $validation->getError('maxima'); ?></span>
                                            <?php } ?>
                                            <label for="address_street"><span class="text-danger">*</span>Groupe Maxima sur
                                                le bulletin</label>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="row" id="inputs_show" style="display:none;">
                                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                                <div class="form-floating mb-2">
                                                    <input type="number" min="1" step="0.01" class="form-control"
                                                        id="max_period_point" name="max_period_point"
                                                        value="<?= set_value('max_period_point'); ?>" placeholder="Ex: 20">
                                                    <label for="max_period_point">
                                                        <span class="text-danger">*</span>Maxima période
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                                <div class="form-floating mb-2">
                                                    <input type="number" min="1" step="0.01" class="form-control"
                                                        id="max_exam_point" name="max_exam_point"
                                                        value="<?= set_value('max_exam_point'); ?>" placeholder="Ex: 40">
                                                    <label for="max_exam_point">
                                                        <span class="text-danger">*</span>Maxima examen
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="maxima_name"
                                                        id="maxima_name" value="<?= set_value('maxima_name') ?>"
                                                        placeholder="Ex: Groupe I" />
                                                    <label for="maxima_name" class="control-label">
                                                        <span class="text-danger"></span>Libellé Maxima sur le bulletin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                                <div class="form-floating">

                                                    <select id="section" name="section" title="section"
                                                        class="form-control select2 select2-info"
                                                        data-dropdown-css-class="select2-info">
                                                        <option disabled selected>--sélectionnez une section--</option>

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
                                                                    <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('section', trim($value['section_id'])); ?>>
                                                                    <?= strtoupper(trim($value['section_name'])); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <label for="maxima_name" class="control-label">
                                                        <span class="text-danger">*</span>Section
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle"></i> Valider la configuration
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-uppercase font-weight-bold py-3">
                            Configurations précédentes de ce cours dans des classes
                        </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table tables-sm table-bordered table-striped" id="datatablesExample2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cours</th>
                                    <th>Classe</th>
                                    <th>Semaine</th>
                                    <th>Pondération</th>
                                    <th>Place Bulletin</th>
                                    <th>Examen</th>
                                    <th>Notes</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($courses_classes) && !empty($courses_classes)):
                                    $count = 1;
                                ?>
                                    <?php foreach ($courses_classes as $index => $course_class):
                                        if ($course_class['courseclasse_course_id'] == $course['course_id']):
                                            $status = esc($course_class['courseclasse_status']);
                                    ?>
                                            <tr class="small">
                                                <td><?= $count++; ?></td>
                                                <td class="text-uppercase">
                                                    <?= esc($course_class['course_name']); ?>
                                                    [<?= esc($course_class['branch_shortname']); ?>]
                                                </td>
                                                <td class="text-uppercase">
                                                    <?= setDegresLevels($course_class['degree_code'], 'f'); ?>
                                                    <?= $course_class['classe_subname']; ?>
                                                    <?= $course_class['option_name']; ?>
                                                </td>
                                                <td class="text-center"><?= esc($course_class['courseclasse_weekhours']); ?> Heures</td>
                                                <td class="text-center">
                                                    <?= esc($course_class['courseclasse_period_point']); ?> Pts
                                                </td>
                                                <td class="text-center">
                                                    <?= esc($course_class['courseclasse_slip_place']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-uppercase">
                                                        <?= esc($course_class['courseclasse_is_mandatory']); ?>
                                                    </span>
                                                </td>
                                                <td><?= esc($course_class['courseclasse_notes']); ?></td>

                                                <td>
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('education/remove/courseclasses/' . $course_class['courseclasse_id']); ?>"
                                                        class="btn btn-danger btn-sm" title="Supprimer"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette configuration ?');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-warning btn-sm" title="Modifier"
                                                        data-toggle="modal"
                                                        data-target="#editCourseModal<?= $course_class['courseclasse_id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal for editing course configuration -->
                                            <div class="modal fade" id="editCourseModal<?= $course_class['courseclasse_id']; ?>"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="editCourseModalLabel<?= $course_class['courseclasse_id']; ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title text-uppercase"
                                                                id="editCourseModalLabel<?= $course_class['courseclasse_id']; ?>">
                                                                Modifier la configuration du cours</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="<?= base_url('education/courseclasses/' . $course_class['course_token']); ?>"
                                                            method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="course"
                                                                    value="<?= $course_class['courseclasse_course_id']; ?>">
                                                                <input type="hidden" name="token"
                                                                    value="<?= $course_class['courseclasse_token']; ?>">
                                                                <input type="hidden" name="action" value="update">
                                                                <div class="row">

                                                                    <div class="col-sm-12 col-lg-12">
                                                                        <div class="form-floating mb-2">
                                                                            <select class="select2 form-control text-uppercase"
                                                                                id="classe<?= $course_class['courseclasse_id']; ?>"
                                                                                name="classe" required>
                                                                                <?php foreach ($classes as $classe): ?>
                                                                                    <option value="<?= esc($classe['classe_id']); ?>"
                                                                                        <?= $classe['classe_id'] == $course_class['classe_id'] ? 'selected' : ''; ?>>
                                                                                        <?= setDegresLevels($classe['degree_code'], 'f'); ?>
                                                                                        <?= $classe['classe_subname']; ?>
                                                                                        <?= $classe['section_name']; ?>
                                                                                        [<?= $classe['option_name']; ?>]
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <label for="classe<?= $course_class['courseclasse_id']; ?>">
                                                                                <span class="text-danger">*</span>Classe</label>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <div class="form-floating mb-2">
                                                                            <input type="number" min="1" class="form-control"
                                                                                id="week_hours<?= $course_class['courseclasse_id']; ?>"
                                                                                name="week_hours"
                                                                                value="<?= esc($course_class['courseclasse_weekhours']); ?>"
                                                                                required>
                                                                            <label
                                                                                for="week_hours<?= $course_class['courseclasse_id']; ?>">
                                                                                <span class="text-danger">*</span>Total heures par
                                                                                semaine</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <div class="form-floating mb-2">
                                                                            <input type="number" min="1" step="0.01"
                                                                                class="form-control"
                                                                                id="period_point<?= $course_class['courseclasse_id']; ?>"
                                                                                name="period_point"
                                                                                value="<?= esc($course_class['courseclasse_period_point']); ?>"
                                                                                required>
                                                                            <label
                                                                                for="period_point<?= $course_class['courseclasse_id']; ?>">
                                                                                <span class="text-danger">*</span>Pondération par
                                                                                période</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <div class="form-floating mb-2">
                                                                            <select class="form-control select2" id="slipnote_place"
                                                                                name="slipnote_place" required>
                                                                                <?php for ($i = 1; $i <= 50; $i++): ?>
                                                                                    <option value="<?= $i; ?>"
                                                                                        <?= $course_class['courseclasse_slip_place'] == $i ? 'selected' : set_select('slipnote_place', $i); ?>>
                                                                                        <?= $i; ?>
                                                                                    </option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                            <label for="slipnote_place">
                                                                                <span class="text-danger">*</span>Place d'affichage sur
                                                                                le
                                                                                bulletin</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <div class="form-floating mb-2">
                                                                            <select class="form-control text-uppercase"
                                                                                id="is_mandatory<?= $course_class['courseclasse_id']; ?>"
                                                                                name="is_mandatory" required>
                                                                                <option value="oui"
                                                                                    <?= $course_class['courseclasse_is_mandatory'] == 'oui' ? 'selected' : ''; ?>>
                                                                                    Oui</option>
                                                                                <option value="non"
                                                                                    <?= $course_class['courseclasse_is_mandatory'] == 'non' ? 'selected' : ''; ?>>
                                                                                    Non</option>
                                                                            </select>
                                                                            <label
                                                                                for="is_mandatory<?= $course_class['courseclasse_id']; ?>">
                                                                                <span class="text-danger">*</span>Obligatoire pour
                                                                                l'examen</label>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <div class="form-floating mb-2">
                                                                            <select class="form-control text-uppercase"
                                                                                id="status<?= $course_class['courseclasse_id']; ?>"
                                                                                name="status" required>
                                                                                <option value="actif"
                                                                                    <?= $course_class['courseclasse_status'] == 'actif' ? 'selected' : ''; ?>>
                                                                                    Actif</option>
                                                                                <option value="inactif"
                                                                                    <?= $course_class['courseclasse_status'] == 'inactif' ? 'selected' : ''; ?>>
                                                                                    Inactif</option>
                                                                            </select>
                                                                            <label for="status<?= $course_class['courseclasse_id']; ?>">
                                                                                <span class="text-danger">*</span>Statut du
                                                                                cours</label>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-6">
                                                                        <div class="form-floating mb-2">
                                                                            <input type="text" class="form-control"
                                                                                id="notes<?= $course_class['courseclasse_id']; ?>"
                                                                                name="notes"
                                                                                value="<?= esc($course_class['courseclasse_notes']); ?>">
                                                                            <label
                                                                                for="notes<?= $course_class['courseclasse_id']; ?>">Notes
                                                                                internes</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-12 col-lg-12 mb-2">
                                                                        <div class="form-floating">

                                                                            <select class="form-control select2 select2-info"
                                                                                id="maxima<?= $course_class['courseclasse_id']; ?>"
                                                                                name="maxima" data-dropdown-css-class="select2-info"
                                                                                style="width: 100%;">
                                                                                <option selected disabled>--Sélectionnez un maxima
                                                                                </option>
                                                                                <?php if (isset($maximas) && !empty($maximas)):
                                                                                    foreach ($maximas as $keymaxima => $maxima):
                                                                                ?>
                                                                                        <option value="<?= esc($maxima['maxima_id']); ?>"
                                                                                            <?= ($course_class['courseclasse_maxima_id'] == $maxima['maxima_id']) ? 'selected' : set_select('maxima', esc($maxima['maxima_id'])); ?>>

                                                                                            <?= strtoupper($maxima['section_name']); ?>

                                                                                            <?= ucwords($maxima['maxima_name']); ?> |
                                                                                            [PERIODE:<?= ucwords($maxima['maxima_total_period']); ?>
                                                                                            [EXAMEN:<?= ucwords($maxima['maxima_total_exam']); ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                            <label
                                                                                for="maxima<?= $course_class['courseclasse_id']; ?>"><span
                                                                                    class="text-danger">*</span>Groupe Maxima sur
                                                                                le bulletin</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-warning">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    Modifier la configuration</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title text-uppercase font-weight-bold py-3">
                            Configurations précédentes des cours par classe
                        </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table tables-sm table-bordered table-striped" id="datatablesExample2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cours</th>
                                    <th>Classe</th>
                                    <th>Semaine</th>
                                    <th>Pondération</th>
                                    <th>Place Bulletin</th>
                                    <th>Examen</th>
                                    <th>Notes</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($courses_classes) && !empty($courses_classes)):
                                    $count = 1;
                                ?>
                                    <?php foreach ($courses_classes as $index => $course_class):
                                        $status = esc($course_class['courseclasse_status']); ?>
                                        <tr class="small">
                                            <td><?= $count++; ?></td>
                                            <td class="text-uppercase">
                                                <?= esc($course_class['course_name']); ?>
                                                [<?= esc($course_class['branch_shortname']); ?>]
                                            </td>
                                            <td class="text-uppercase">
                                                <?= setDegresLevels($course_class['degree_code'], 'f'); ?>
                                                <?= $course_class['classe_subname']; ?>
                                                <?= $course_class['option_name']; ?>
                                            </td>
                                            <td class="text-center"><?= esc($course_class['courseclasse_weekhours']); ?> Heures</td>
                                            <td class="text-center">
                                                <?= esc($course_class['courseclasse_period_point']); ?> Pts
                                            </td>
                                            <td class="text-center">
                                                <?= esc($course_class['courseclasse_slip_place']); ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-uppercase">
                                                    <?= esc($course_class['courseclasse_is_mandatory']); ?>
                                                </span>
                                            </td>
                                            <td><?= esc($course_class['courseclasse_notes']); ?></td>

                                            <td>
                                                <span
                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                    <?= $status; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('education/remove/courseclasses/' . $course_class['courseclasse_id']); ?>"
                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette configuration ?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <button type="button" class="btn btn-warning btn-sm" title="Modifier"
                                                    data-toggle="modal"
                                                    data-target="#editCourseModal<?= $course_class['courseclasse_id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal for editing course configuration -->
                                        <div class="modal fade" id="editCourseModal<?= $course_class['courseclasse_id']; ?>"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="editCourseModalLabel<?= $course_class['courseclasse_id']; ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title text-uppercase"
                                                            id="editCourseModalLabel<?= $course_class['courseclasse_id']; ?>">
                                                            Modifier la configuration du cours</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="<?= base_url('education/courseclasses/' . $course_class['course_token']); ?>"
                                                        method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="course"
                                                                value="<?= $course_class['courseclasse_course_id']; ?>">
                                                            <input type="hidden" name="token"
                                                                value="<?= $course_class['courseclasse_token']; ?>">
                                                            <input type="hidden" name="action" value="update">
                                                            <div class="row">

                                                                <div class="col-sm-12 col-lg-12">
                                                                    <div class="form-floating mb-2">
                                                                        <select class="select2 form-control text-uppercase"
                                                                            id="classe<?= $course_class['courseclasse_id']; ?>"
                                                                            name="classe" required>
                                                                            <?php foreach ($classes as $classe): ?>
                                                                                <option value="<?= esc($classe['classe_id']); ?>"
                                                                                    <?= $classe['classe_id'] == $course_class['classe_id'] ? 'selected' : ''; ?>>
                                                                                    <?= setDegresLevels($classe['degree_code'], 'f'); ?>
                                                                                    <?= $classe['classe_subname']; ?>
                                                                                    <?= $classe['section_name']; ?>
                                                                                    [<?= $classe['option_name']; ?>]
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <label for="classe<?= $course_class['courseclasse_id']; ?>">
                                                                            <span class="text-danger">*</span>Classe</label>

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-floating mb-2">
                                                                        <input type="number" min="1" class="form-control"
                                                                            id="week_hours<?= $course_class['courseclasse_id']; ?>"
                                                                            name="week_hours"
                                                                            value="<?= esc($course_class['courseclasse_weekhours']); ?>"
                                                                            required>
                                                                        <label
                                                                            for="week_hours<?= $course_class['courseclasse_id']; ?>">
                                                                            <span class="text-danger">*</span>Total heures par
                                                                            semaine</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-floating mb-2">
                                                                        <input type="number" min="1" step="0.01"
                                                                            class="form-control"
                                                                            id="period_point<?= $course_class['courseclasse_id']; ?>"
                                                                            name="period_point"
                                                                            value="<?= esc($course_class['courseclasse_period_point']); ?>"
                                                                            required>
                                                                        <label
                                                                            for="period_point<?= $course_class['courseclasse_id']; ?>">
                                                                            <span class="text-danger">*</span>Pondération par
                                                                            période</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-floating mb-2">
                                                                        <select class="form-control select2" id="slipnote_place"
                                                                            name="slipnote_place" required>
                                                                            <?php for ($i = 1; $i <= 50; $i++): ?>
                                                                                <option value="<?= $i; ?>"
                                                                                    <?= $course_class['courseclasse_slip_place'] == $i ? 'selected' : set_select('slipnote_place', $i); ?>>
                                                                                    <?= $i; ?>
                                                                                </option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                        <label for="slipnote_place">
                                                                            <span class="text-danger">*</span>Place d'affichage sur
                                                                            le
                                                                            bulletin</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-floating mb-2">
                                                                        <select class="form-control text-uppercase"
                                                                            id="is_mandatory<?= $course_class['courseclasse_id']; ?>"
                                                                            name="is_mandatory" required>
                                                                            <option value="oui"
                                                                                <?= $course_class['courseclasse_is_mandatory'] == 'oui' ? 'selected' : ''; ?>>
                                                                                Oui</option>
                                                                            <option value="non"
                                                                                <?= $course_class['courseclasse_is_mandatory'] == 'non' ? 'selected' : ''; ?>>
                                                                                Non</option>
                                                                        </select>
                                                                        <label
                                                                            for="is_mandatory<?= $course_class['courseclasse_id']; ?>">
                                                                            <span class="text-danger">*</span>Obligatoire pour
                                                                            l'examen</label>

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-floating mb-2">
                                                                        <select class="form-control text-uppercase"
                                                                            id="status<?= $course_class['courseclasse_id']; ?>"
                                                                            name="status" required>
                                                                            <option value="actif"
                                                                                <?= $course_class['courseclasse_status'] == 'actif' ? 'selected' : ''; ?>>
                                                                                Actif</option>
                                                                            <option value="inactif"
                                                                                <?= $course_class['courseclasse_status'] == 'inactif' ? 'selected' : ''; ?>>
                                                                                Inactif</option>
                                                                        </select>
                                                                        <label for="status<?= $course_class['courseclasse_id']; ?>">
                                                                            <span class="text-danger">*</span>Statut du
                                                                            cours</label>

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-floating mb-2">
                                                                        <input type="text" class="form-control"
                                                                            id="notes<?= $course_class['courseclasse_id']; ?>"
                                                                            name="notes"
                                                                            value="<?= esc($course_class['courseclasse_notes']); ?>">
                                                                        <label
                                                                            for="notes<?= $course_class['courseclasse_id']; ?>">Notes
                                                                            internes</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                    <div class="form-floating">

                                                                        <select class="form-control select2 select2-info"
                                                                            id="maxima<?= $course_class['courseclasse_id']; ?>"
                                                                            name="maxima" data-dropdown-css-class="select2-info"
                                                                            style="width: 100%;">
                                                                            <option selected disabled>--Sélectionnez un maxima
                                                                            </option>
                                                                            <?php if (isset($maximas) && !empty($maximas)):
                                                                                foreach ($maximas as $keymaxima => $maxima):
                                                                            ?>
                                                                                    <option value="<?= esc($maxima['maxima_id']); ?>"
                                                                                        <?= ($course_class['courseclasse_maxima_id'] == $maxima['maxima_id']) ? 'selected' : set_select('maxima', esc($maxima['maxima_id'])); ?>>

                                                                                        <?= strtoupper($maxima['section_name']); ?>

                                                                                        <?= ucwords($maxima['maxima_name']); ?> |
                                                                                        [PERIODE:<?= ucwords($maxima['maxima_total_period']); ?>
                                                                                        [EXAMEN:<?= ucwords($maxima['maxima_total_exam']); ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                        <label
                                                                            for="maxima<?= $course_class['courseclasse_id']; ?>"><span
                                                                                class="text-danger">*</span>Groupe Maxima sur
                                                                            le bulletin</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-warning">
                                                                <i class="fas fa-check-circle"></i>
                                                                Modifier la configuration</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1 class="text-uppercase font-weight-bold">
                                Configuration maximas
                            </h1>
                            <div class="mt-3">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-primary btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer une nouvelle configuration">
                                        <i class="fa fa-plus"></i> Nouvelle configuration maxima
                                    </span>
                                </a>
                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id=""
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap datatables">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Libellé</th>
                                            <th>Periode</th>
                                            <th>Examen</th>
                                            <th>Section</th>
                                            <th>Observation</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if (isset($maximas) && !empty($maximas)):
                                            foreach ($maximas as $maxkey => $maxima):
                                                $status = (!empty(esc($maxima['maxima_status'])) ? esc($maxima['maxima_status']) : 'inactif');
                                        ?>
                                                <tr>
                                                    <td><?= $count++; ?></td>
                                                    <td><?= esc($maxima['maxima_code']); ?></td>
                                                    <td class="text-capitalize"><?= esc($maxima['maxima_name']); ?></td>
                                                    <td class="text-center"><?= esc($maxima['maxima_total_period']); ?></td>
                                                    <td class="text-center"><?= esc($maxima['maxima_total_exam']); ?></td>
                                                    <td class="text-uppercase small"><?= esc($maxima['section_name']); ?></td>
                                                    <td class="text-capitalize"><?= esc($maxima['maxima_notes']); ?></td>
                                                    <td>
                                                        <span
                                                            class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= $status; ?>
                                                        </span>

                                                    </td>
                                                    <td class="text-uppercase"><?= esc($maxima['maxima_created_at']); ?></td>
                                                    <td width="1px" class="text-center">
                                                        <a data-toggle="modal" data-target="#update_<?= $count; ?>" href="#"
                                                            class="btn btn-xs btn-outline-warning">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour modifier cette information">
                                                                <i class="fa fa-edit fa-2x"></i></span>
                                                        </a>
                                                        <?php $access_delete = (session()->admin == TRUE or session()->all == TRUE) ? '' : 'disabled'; ?>

                                                        <a href="<?= base_url('education/remove/maxima/' . ($maxima['maxima_id'])); ?>"
                                                            class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                            onclick="return confirm('Etes-vous sur de vouloir supprimer cette configuration de maxima?'); false;">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="Cliquer pour supprimer cette configuration de maxima">
                                                                <i class="fa fa-window-close fa-2x"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- update year modal -->
                                                <div class="modal fade" id="update_<?= $count; ?>">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h4 class="modal-title d-inline-flex">Modification
                                                                    maxima <?= esc($maxima['maxima_name']); ?></h4>
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
                                                            echo form_open(base_url('education/maxima'), $attributes);
                                                            ?>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="token" id="token"
                                                                    value="<?= $maxima['maxima_token']; ?>">
                                                                <input type="hidden" name="action" id="action" value="update">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                        <div class="form-floating">
                                                                            <input type="text"
                                                                                class="form-control text-capitalize" name="maxima_name"
                                                                                id="maxima_name<?= $maxima['maxima_id']; ?>"
                                                                                value="<?= (!empty(($maxima['maxima_name']))) ? ($maxima['maxima_name']) : old('branch_name') ?>" />
                                                                            <label for="maxima_name<?= $maxima['maxima_id']; ?>" class="control-label">
                                                                                <span class="text-danger">*</span>Libellé maxima
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                        <div class="form-floating mb-2">
                                                                            <input type="number" min="1" step="0.01" class="form-control" id="max_period_point<?= $maxima['maxima_id']; ?>"
                                                                                name="max_period_point" value="<?= (!empty(($maxima['maxima_total_period']))) ? ($maxima['maxima_total_period']) : old('max_period_point'); ?>"
                                                                                placeholder="Ex: 20">
                                                                            <label for="max_period_point<?= $maxima['maxima_id']; ?>">
                                                                                <span class="text-danger">*</span>Maxima période
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                        <div class="form-floating mb-2">
                                                                            <input type="number" min="1" step="0.01" class="form-control" id="max_exam_point<?= $maxima['maxima_id']; ?>"
                                                                                name="max_exam_point" value="<?= (!empty(($maxima['maxima_total_exam']))) ? ($maxima['maxima_total_exam']) : old('max_exam_point'); ?>" placeholder="Ex: 40">
                                                                            <label for="max_exam_point<?= $maxima['maxima_id']; ?>">
                                                                                <span class="text-danger">*</span>Maxima examen
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                        <div class="form-floating">

                                                                            <select id="section<?= $maxima['maxima_id']; ?>" name="section" title="section"
                                                                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                                                                <option disabled selected>--sélectionnez une section--</option>

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
                                                                                            <?= ($maxima['maxima_section_id'] == $value['section_id']) ? 'selected' : set_select('section', trim($value['section_id'])); ?>>
                                                                                            <?= strtoupper(trim($value['section_name'])); ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                            <label for="section<?= $maxima['maxima_id']; ?>" class="control-label">
                                                                                <span class="text-danger">*</span>Section
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-lg-12 mb-2">
                                                                        <div class="form-floating">
                                                                            <select class="form-control text-uppercase"
                                                                                id="status<?= $maxima['maxima_id']; ?>" name="status" required>
                                                                                <option value="actif"
                                                                                    <?= ($maxima['maxima_status'] == 'actif') ? 'selected' : ''; ?>>
                                                                                    Actif</option>
                                                                                <option value="inactif"
                                                                                    <?= ($maxima['maxima_status'] == 'inactif') ? 'selected' : ''; ?>>
                                                                                    Inactif</option>
                                                                            </select>
                                                                            <label for="status<?= $maxima['maxima_id']; ?>"><span
                                                                                    class="text-danger">*</span>Statut</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                        <div class="form-floating">
                                                                            <input type="text"
                                                                                class="form-control text-capitalize"
                                                                                name="notes" id="notes<?= $maxima['maxima_id']; ?>"
                                                                                value="<?= (!empty(($maxima['maxima_notes']))) ? ($maxima['maxima_notes']) : old('branch_notes') ?>" />
                                                                            <label for="notes<?= $maxima['maxima_id']; ?>" class="control-label">
                                                                                <span class="text-danger"></span>Notes interne
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">

                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Fermer
                                                                </button>
                                                                <button type="submit" class="btn btn-primary text-uppercase">
                                                                    <i class="fas fa-check-circle"></i> Enregistrer les
                                                                    modifications

                                                                </button>
                                                            </div>
                                                            <?php echo form_close(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end update year modal -->
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
    </section>
</div>
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">Ajout d'une nouvelle configuration maxima</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/maxima'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating mb-2">
                            <input type="number" min="1" step="0.01" class="form-control" id="max_period_point"
                                name="max_period_point" value="<?= set_value('max_period_point'); ?>"
                                placeholder="Ex: 20">
                            <label for="max_period_point">
                                <span class="text-danger">*</span>Maxima période
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating mb-2">
                            <input type="number" min="1" step="0.01" class="form-control" id="max_exam_point"
                                name="max_exam_point" value="<?= set_value('max_exam_point'); ?>" placeholder="Ex: 40">
                            <label for="max_exam_point">
                                <span class="text-danger">*</span>Maxima examen
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="maxima_name" id="maxima_name"
                                value="<?= set_value('maxima_name') ?>" placeholder="Ex: Groupe I" />
                            <label for="maxima_name" class="control-label">
                                <span class="text-danger"></span>Libellé Maxima sur le bulletin
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                            <select id="section" name="section" title="section"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez une section--</option>

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
                                            <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('section', trim($value['section_id'])); ?>>
                                            <?= strtoupper(trim($value['section_name'])); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="maxima_name" class="control-label">
                                <span class="text-danger">*</span>Section
                            </label>
                        </div>
                    </div>



                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="status" required>
                                <option value="actif">
                                    Actif</option>
                                <option value="inactif">
                                    Inactif</option>
                            </select>
                            <label for="status"><span class="text-danger">*</span>Statut</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="notes" id="notes"
                                value="<?= old('notes'); ?>" placeholder="Ex: Infos supplementaires" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes interne
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Valider la configuration
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>