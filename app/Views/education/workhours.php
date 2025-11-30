<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('workhours'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">Gestion des horaires</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Suivi enseignements</li>
                        <li class="breadcrumb-item active">Charges horaires</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content printoff">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 col-sm-6 col-lg-3">
                    <div class="nav flex-column nav-tabs nav-tabs-left h-100" id="vert-tabs-right-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'attribution') ? 'active':''); ?>"
                            id="teachers_courses_attributes" data-toggle="pill" href="#teachers_courses_attributes_tab"
                            role="tab" aria-controls="teachers_courses_attributes_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Attribution cours aux enseignants
                            </span>
                        </a>
                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'schedule') ? 'active':''); ?>"
                            id="courses_schedule_tab_btn" data-toggle="pill" href="#courses_schedule_tab" role="tab"
                            aria-controls="courses_schedule_tab" aria-selected="true">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Emploi du temps des enseignants
                            </span>
                        </a>

                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'availability') ? 'active':''); ?>"
                            id="courses_availability_tab_btn" data-toggle="pill" href="#courses_availability_tab"
                            role="tab" aria-controls="courses_availability_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Disponibilités des enseignants
                            </span>
                        </a>
                        <a class="d-none text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'period') ? 'show active':''); ?>"
                            id="defined_period_days" data-toggle="pill" href="#defined_period_days_tab" role="tab"
                            aria-controls="defined_period_days_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Périodes prédéfinies de la journée
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-9 col-sm-6 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="vert-tabs-right-tabContent">
                                <!-- Attribution des cours aux enseignants -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'attribution') ? 'show active':''); ?>"
                                    id="teachers_courses_attributes_tab" role="tabpanel"
                                    aria-labelledby="teachers_courses_attributes_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Attribution des cours aux enseignants
                                                </h3>
                                                <a data-toggle="modal" data-target="#new_teacher_attribution" href="#"
                                                    class="btn btn-dark btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer une nouvelle attribution d'un cours ">
                                                        <i class="fa fa-plus"></i> Ajouter une nouvelle attribution
                                                        d'un cours
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold">
                                                            <th>Actions</th>
                                                            <th>Enseignant</th>
                                                            <th>Cours</th>
                                                            <th>Classe</th>
                                                            <th>Type</th>
                                                            <th>Notes</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($courses_attributions) && !empty($courses_attributions)): 
                                                        $count=1;
                                                        ?>
                                                        <?php foreach ($courses_attributions as $index => $attribution): 
                                                        $status_attribution = esc($attribution['attribution_status']);?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('education/remove/attribution/' . $attribution['attribution_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette attribution ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#attributionModal<?= $attribution['attribution_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= esc($attribution['teacher_firstname']); ?>
                                                                <?= esc($attribution['teacher_lastname']); ?>
                                                                <?= esc($attribution['teacher_surname']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($attribution['course_name']); ?>
                                                                <?= esc($attribution['branch_name']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= setDegresLevels($attribution['degree_code'], 'f');?>
                                                                <?= ucwords($attribution['classe_subname']);?>
                                                                <?= ucwords($attribution['option_name']);?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($attribution['attribution_type']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($attribution['attribution_notes']); ?>
                                                            </td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status_attribution) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status_attribution; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing course configuration -->
                                                        <div class="modal fade"
                                                            id="attributionModal<?= $attribution['attribution_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="attributionModalLabel<?= $attribution['attribution_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="attributionModalLabel<?= $attribution['attribution_id']; ?>">
                                                                            Modifier attribution d'un cours
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="form_attribution" role="form"
                                                                        action="<?= base_url('education/attribution'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="token"
                                                                                value="<?= $attribution['attribution_token']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                value="update">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="courseUpdateAttrib"
                                                                                            name="course" required>
                                                                                            <option disabled selected>
                                                                                                --Sélectionnez un
                                                                                                cours--</option>
                                                                                            <?php if (isset($courses_classes) && !empty($courses_classes)): ?>
                                                                                            <?php foreach ($courses_classes as $course): ?>
                                                                                            <option
                                                                                                value="<?= esc($course['courseclasse_id']); ?>"
                                                                                                <?= ($attribution['attribution_course_id'] == $course['courseclasse_id']) ? 'selected':''; ?>>
                                                                                                <?= strtoupper($course['course_name']); ?>
                                                                                                [<?= strtoupper($course['branch_name']); ?>]
                                                                                                |

                                                                                                Classe:
                                                                                                <?= setDegresLevels($course['degree_code'], 'f');?>
                                                                                                <?= ucwords($course['classe_subname']);?>
                                                                                                <?= ucwords($course['option_name']);?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>

                                                                                        <label for="courseUpdateAttrib"
                                                                                            class="control-label text-uppercase">
                                                                                            <span
                                                                                                class="text-danger">*</span>Cours
                                                                                            a attribuer
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="teacher" name="teacher"
                                                                                            required>
                                                                                            <option disabled selected>
                                                                                                --Sélectionnez un
                                                                                                enseignant--</option>
                                                                                            <?php if (isset($teachers) && !empty($teachers)): ?>
                                                                                            <?php foreach ($teachers as $teacher): ?>
                                                                                            <option
                                                                                                value="<?= esc($teacher['teacher_id']); ?>"
                                                                                                <?= ($attribution['attribution_teacher_id'] == $teacher['teacher_id']) ? 'selected':''; ?>>

                                                                                                <?= ucwords($teacher['teacher_firstname']); ?>
                                                                                                <?= ucwords($teacher['teacher_lastname']); ?>
                                                                                                <?= ucwords($teacher['teacher_surname']); ?>

                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>

                                                                                        <label for="teacher"
                                                                                            class="control-label text-uppercase">
                                                                                            <span
                                                                                                class="text-danger">*</span>Enseignant
                                                                                            du cours
                                                                                        </label>
                                                                                    </div>
                                                                                </div>



                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="type" name="type"
                                                                                            required>
                                                                                            <option value="Permanent"
                                                                                                <?= ($attribution['attribution_type'] == 'Permanent') ? 'selected':''; ?>>
                                                                                                Permanent</option>
                                                                                            <option value="Temporaire"
                                                                                                <?= ($attribution['attribution_type'] == 'Temporaire') ? 'selected':''; ?>>
                                                                                                Temporaire</option>
                                                                                        </select>
                                                                                        <label for="type"><span
                                                                                                class="text-danger">*</span>Type
                                                                                            d'attribution</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status" name="status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($attribution['attribution_status'] == 'actif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($attribution['attribution_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>
                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Statut
                                                                                            attribution</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-capitalize"
                                                                                            name="notes" id="notes"
                                                                                            value="<?= ($attribution['attribution_notes']) ? $attribution['attribution_notes']:old('notes'); ?>"
                                                                                            placeholder="Ex: Infos supplementaires" />
                                                                                        <label for="notes"
                                                                                            class="control-label">
                                                                                            <span
                                                                                                class="text-danger"></span>Notes
                                                                                            sur cette attribution
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning">
                                                                                <i class="fas fa-check-circle"></i>
                                                                                Modifier l'attribution
                                                                            </button>
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
                                </div>
                                <!-- Emploi du temps des cours aux enseignants -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'schedule') ? 'show active':''); ?>"
                                    id="courses_schedule_tab" role="tabpanel" aria-labelledby="courses_schedule_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Configuration de l'emploi du temps des enseignants
                                                </h3>
                                                <a data-toggle="modal" data-target="#new_schedule" href="#"
                                                    class="btn btn-primary btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer un  nouvel emploi du temps d'un enseignant">
                                                        <i class="fa fa-plus"></i> Ajouter une nouvelle configuration de
                                                        l'emploi du
                                                        temps
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold">
                                                            <th>Actions</th>
                                                            <th>Enseignant</th>
                                                            <th>Cours</th>
                                                            <th>Classe</th>
                                                            <th>Jours</th>
                                                            <th>Heures</th>
                                                            <th>Notes</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($courses_schedules) && !empty($courses_schedules)): 
                                                        $count=1;
                                                        ?>
                                                        <?php foreach ($courses_schedules as $index => $course_schedule): 
                                                        $status = esc($course_schedule['schedule_status']);?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('education/remove/schedule/' . $course_schedule['schedule_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette configuration ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#editCourseModal<?= $course_schedule['schedule_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($course_schedule['teacher_firstname']); ?>
                                                                <?= esc($course_schedule['teacher_lastname']); ?>
                                                                <?= esc($course_schedule['teacher_surname']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                [<?= esc($course_schedule['branch_shortname']); ?>]
                                                                <?= esc($course_schedule['course_name']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= setDegresLevels($course_schedule['degree_code'], 'f');?>
                                                                <?= $course_schedule['classe_subname'];?>
                                                                <?= $course_schedule['option_name'];?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= setFrenchDays($course_schedule['schedule_day_week'], 'number'); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= date('H:i', strtotime($course_schedule['schedule_start_time'])); ?>
                                                                à
                                                                <?= date('H:i', strtotime($course_schedule['schedule_end_time'])); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($course_schedule['schedule_notes']); ?></td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing course configuration -->
                                                        <div class="modal fade"
                                                            id="editCourseModal<?= $course_schedule['schedule_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editCourseModalLabel<?= $course_schedule['schedule_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="editCourseModalLabel<?= $course_schedule['schedule_id']; ?>">
                                                                            Modifier la configuration de l'emploi du
                                                                            temps du cours</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="<?= base_url('education/schedules'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="token"
                                                                                value="<?= $course_schedule['schedule_token']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                value="update">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="course_classe2"
                                                                                            name="course_classe"
                                                                                            required>
                                                                                            <option disabled selected>
                                                                                                --Sélectionnez un
                                                                                                cours--</option>
                                                                                            <?php if (isset($courses_classes) && !empty($courses_classes)): ?>
                                                                                            <?php foreach ($courses_classes as $course_class): ?>
                                                                                            <option
                                                                                                value="<?= esc($course_class['courseclasse_id']); ?>"
                                                                                                <?= ($course_schedule['schedule_course_classe_id'] == $course_class['courseclasse_id']) ? 'selected':''; ?>>
                                                                                                Cours:
                                                                                                <?= strtoupper($course_class['course_name']); ?>
                                                                                                |

                                                                                                Classe:
                                                                                                <?= setDegresLevels($course_class['degree_code'], 'f');?>
                                                                                                <?= ucwords($course_class['classe_subname']);?>
                                                                                                <?= ucwords($course_class['option_name']);?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>

                                                                                        <label for="course_classe2"
                                                                                            class="control-label text-uppercase">
                                                                                            <span
                                                                                                class="text-danger">*</span>Cours
                                                                                            à planifier
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="day_of_week"
                                                                                            name="day_of_week" required>

                                                                                            <?php $days_of_week = setFrenchDays(null, 'number'); ?>
                                                                                            <?php foreach ($days_of_week as $day_key => $day_of_week): ?>
                                                                                            <option
                                                                                                value="<?= $day_key; ?>"
                                                                                                <?= ($course_schedule['schedule_day_week'] == $day_key) ? 'selected':''; ?>>
                                                                                                <?= $day_of_week; ?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>

                                                                                        </select>

                                                                                        <label for="type"><span
                                                                                                class="text-danger">*</span>Jour
                                                                                            de la semaine</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            step="0.01"
                                                                                            name="start_time"
                                                                                            id="start_time"
                                                                                            value="<?= ($course_schedule['schedule_start_time']) ? $course_schedule['schedule_start_time']: old('start_time'); ?>"
                                                                                            placeholder="Ex: 07:30"
                                                                                            required />
                                                                                        <label for="start_time"><span
                                                                                                class="text-danger">*</span>Heure
                                                                                            de début</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="end_time"
                                                                                            id="end_time"
                                                                                            value="<?= ($course_schedule['schedule_end_time']) ? $course_schedule['schedule_end_time']:old('end_time'); ?>"
                                                                                            placeholder="Ex: 08:00"
                                                                                            required />
                                                                                        <label for="end_time"><span
                                                                                                class="text-danger">*</span>Heure
                                                                                            de fin</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status" name="status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($course_schedule['schedule_status'] == 'actif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($course_schedule['schedule_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>
                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Statut</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-capitalize"
                                                                                            name="notes" id="notes"
                                                                                            value="<?= ($course_schedule['schedule_notes']) ? $course_schedule['schedule_notes']:old('notes'); ?>"
                                                                                            placeholder="Ex: Nom de la salle" />
                                                                                        <label for="notes"
                                                                                            class="control-label">
                                                                                            <span
                                                                                                class="text-danger"></span>Notes
                                                                                            sur l'emploi du temps
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning">
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
                                </div>
                                <!-- Disponibilites des enseignants -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'availability') ? 'show active':''); ?>"
                                    id="courses_availability_tab" role="tabpanel"
                                    aria-labelledby="courses_availability_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Configuration de la disponibilité des enseignants
                                                </h3>
                                                <a data-toggle="modal" data-target="#new_teacher_availability" href="#"
                                                    class="btn btn-success btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer un  nouvel emploi du temps d'un enseignant">
                                                        <i class="fa fa-plus"></i> Ajouter une nouvelle disponibilité
                                                        d'un enseignant
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold">
                                                            <th>Actions</th>
                                                            <th>Enseignant</th>
                                                            <th>Jours</th>
                                                            <th>Heures</th>
                                                            <th>Notes</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($teachers_availability) && !empty($teachers_availability)): 
                                                        $count=1;
                                                        ?>
                                                        <?php foreach ($teachers_availability as $index => $availability): 
                                                        $status_availability = esc($availability['availability_status']);?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('education/remove/availability/' . $availability['availability_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette configuration ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#availabilityModal<?= $availability['availability_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= esc($availability['teacher_firstname']); ?>
                                                                <?= esc($availability['teacher_lastname']); ?>
                                                                <?= esc($availability['teacher_surname']); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= setFrenchDays($availability['availability_day_week'], 'number'); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= date('H:i', strtotime($availability['availability_start_time'])); ?>
                                                                à
                                                                <?= date('H:i', strtotime($availability['availability_end_time'])); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($availability['availability_notes']); ?></td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status_availability) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status_availability; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing course configuration -->
                                                        <div class="modal fade"
                                                            id="availabilityModal<?= $availability['availability_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="availabilityModalLabel<?= $availability['availability_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="availabilityModalLabel<?= $availability['availability_id']; ?>">
                                                                            Modifier la disponibilité d'un enseignant
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="<?= base_url('education/availability'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="token"
                                                                                value="<?= $availability['availability_token']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                value="update">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="teacherUpdate"
                                                                                            name="teacher" required>
                                                                                            <option disabled selected>
                                                                                                --Sélectionnez un
                                                                                                enseignant--</option>
                                                                                            <?php if (isset($teachers) && !empty($teachers)): ?>
                                                                                            <?php foreach ($teachers as $teacher): ?>
                                                                                            <option
                                                                                                value="<?= esc($teacher['teacher_id']); ?>"
                                                                                                <?= ($availability['availability_teacher_id'] == $teacher['teacher_id']) ? 'selected':''; ?>>

                                                                                                <?= ucwords($teacher['teacher_firstname']); ?>
                                                                                                <?= ucwords($teacher['teacher_lastname']); ?>
                                                                                                <?= ucwords($teacher['teacher_surname']); ?>

                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>

                                                                                        <label for="teacherUpdate"
                                                                                            class="control-label text-uppercase">
                                                                                            <span
                                                                                                class="text-danger">*</span>Enseignant
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="day_of_week"
                                                                                            name="day_of_week" required>

                                                                                            <?php $days_of_week = setFrenchDays(null, 'number'); ?>
                                                                                            <?php foreach ($days_of_week as $day_key => $day_of_week): ?>
                                                                                            <option
                                                                                                value="<?= $day_key; ?>"
                                                                                                <?= ($availability['availability_day_week'] == $day_key) ? 'selected':''; ?>>
                                                                                                <?= $day_of_week; ?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>

                                                                                        </select>

                                                                                        <label for="day_of_week"><span
                                                                                                class="text-danger">*</span>Jour
                                                                                            de la semaine</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            step="0.01"
                                                                                            name="start_time"
                                                                                            id="start_time"
                                                                                            value="<?= ($availability['availability_start_time']) ? $availability['availability_start_time']: old('start_time'); ?>"
                                                                                            placeholder="Ex: 07:30"
                                                                                            required />
                                                                                        <label for="start_time">
                                                                                            <span
                                                                                                class="text-danger">*</span>Heure
                                                                                            de début
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="end_time"
                                                                                            id="end_time"
                                                                                            value="<?= ($availability['availability_end_time']) ? $availability['availability_end_time']:old('end_time'); ?>"
                                                                                            placeholder="Ex: 08:00"
                                                                                            required />
                                                                                        <label for="end_time">
                                                                                            <span
                                                                                                class="text-danger">*</span>Heure
                                                                                            de fin
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status" name="status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($availability['availability_status'] == 'actif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($availability['availability_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>
                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Statut</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-capitalize"
                                                                                            name="notes" id="notes"
                                                                                            value="<?= ($availability['availability_notes']) ? $availability['availability_notes']:old('notes'); ?>"
                                                                                            placeholder="Ex: Infos supplementaires" />
                                                                                        <label for="notes"
                                                                                            class="control-label">
                                                                                            <span
                                                                                                class="text-danger"></span>Notes
                                                                                            sur la disponibilité de
                                                                                            l'enseignant
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning">
                                                                                <i class="fas fa-check-circle"></i>
                                                                                Modifier la disponibilité</button>
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
                                </div>
                                <!-- Periode predefinies de la journée des enseignants -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Vue d'affichage des horaires par semaine -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    
                            <div class="row bg-info py-3" style="border:2px solid black">
                                <div class="col-sm-12 col-lg-12 text-center">
                                    <h3 class="font-weight-bold text-uppercase">Horaires par semaine</h3>
                               
                                    <div class="printoff">
                                        <div class="text-right">
                                            <a href="javascript:void();" class="btn btn-outline-light text-uppercase btn-sm"
                                                onclick="print()">
                                                <i class="fa fa-print"></i> Imprimer charges horaires</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped" id="datatablesReportingActions">
                                    <thead>
                                        <tr class="text-center small">
                                            <th>Jour</th>
                                            <th>Heure</th>
                                            <th>Enseignant</th>
                                            <th>Cours</th>
                                            <th>Classe</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($weekly_schedule) && !empty($weekly_schedule)): ?>
                                        <?php foreach ($weekly_schedule as $schedule): ?>
                                        <tr class="small">
                                            <td class="text-center">
                                                <?= setFrenchDays($schedule['schedule_day_week'], 'number'); ?></td>
                                            <td class="text-center">
                                                <?= date('H:i', strtotime($schedule['schedule_start_time'])); ?> à
                                                <?= date('H:i', strtotime($schedule['schedule_end_time'])); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= esc($schedule['teacher_firstname']); ?>
                                                <?= esc($schedule['teacher_lastname']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= esc($schedule['course_name']); ?></td>
                                            <td class="text-uppercase">
                                                <?= setDegresLevels($schedule['degree_code'], 'f'); ?>
                                                <?= ucwords($schedule['classe_subname']); ?>
                                                <?= ucwords($schedule['option_name']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= esc($schedule['schedule_notes']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun horaire trouvé</td>
                                        </tr>
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

<!-- Configuration d'un emploi du temps d'un enseignant -->
<div class="modal fade" id="new_schedule">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title font-weight-bold text-uppercase">Configuration emploi du temps</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/schedules'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control text-uppercase" id="course_classe" name="course_classe"
                                required>
                                <option disabled selected>--Sélectionnez un cours--</option>
                                <?php if (isset($courses_classes) && !empty($courses_classes)): ?>
                                <?php foreach ($courses_classes as $course_class): ?>
                                <option value="<?= esc($course_class['courseclasse_id']); ?>">
                                    Cours: <?= strtoupper($course_class['course_name']); ?> |

                                    Classe:
                                    <?= setDegresLevels($course_class['degree_code'], 'f');?>
                                    <?= ucwords($course_class['classe_subname']);?>
                                    <?= ucwords($course_class['option_name']);?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <label for="course_classe" class="control-label text-uppercase">
                                <span class="text-danger">*</span>Cours a planifier
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="day_of_week" name="day_of_week" required>
                                <option value="1">Lundi</option>
                                <option value="2">Mardi</option>
                                <option value="3">Mercredi</option>
                                <option value="4">Jeudi</option>
                                <option value="5">Vendredi</option>
                                <option value="6">Samedi</option>
                                <option value="7">Dimanche</option>
                            </select>

                            <label for="day_of_week"><span class="text-danger">*</span>Jour de la semaine</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" step="0.01" name="start_time"
                                id="start_time" value="<?= old('start_time'); ?>" placeholder="Ex: 07:30" required />
                            <label for="start_time"><span class="text-danger">*</span>Heure de début</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" name="end_time" id="end_time"
                                value="<?= old('end_time'); ?>" placeholder="Ex: 08:00" required />
                            <label for="end_time"><span class="text-danger">*</span>Heure de fin</label>
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
                                value="<?= old('notes'); ?>" placeholder="Ex: Nom de la salle" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes sur l'emploi du temps
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer la configuration
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Valider l'emploi du temps
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- Configuration d'un emploi du temps d'un enseignant -->
<div class="modal fade" id="new_teacher_availability">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title font-weight-bold text-uppercase">Configuration de la disponibilité d'un
                    enseignant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/availability'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control text-uppercase" id="teacher" name="teacher" required>
                                <option disabled selected>--Sélectionnez un enseignant--</option>
                                <?php if (isset($teachers) && !empty($teachers)): ?>
                                <?php foreach ($teachers as $teacher): ?>
                                <option value="<?= esc($teacher['teacher_id']); ?>">

                                    <?= ucwords($teacher['teacher_firstname']); ?>
                                    <?= ucwords($teacher['teacher_lastname']); ?>
                                    <?= ucwords($teacher['teacher_surname']); ?>

                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <label for="teacher" class="control-label text-uppercase">
                                <span class="text-danger">*</span>Enseignant
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="day_of_week" name="day_of_week" required>
                                <option value="1">Lundi</option>
                                <option value="2">Mardi</option>
                                <option value="3">Mercredi</option>
                                <option value="4">Jeudi</option>
                                <option value="5">Vendredi</option>
                                <option value="6">Samedi</option>
                                <option value="7">Dimanche</option>
                            </select>

                            <label for="day_of_week"><span class="text-danger">*</span>Jour de la semaine</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" step="0.01" name="start_time"
                                id="start_time" value="<?= old('start_time'); ?>" placeholder="Ex: 07:30" required />
                            <label for="start_time"><span class="text-danger">*</span>Heure de début</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" name="end_time" id="end_time"
                                value="<?= old('end_time'); ?>" placeholder="Ex: 08:00" required />
                            <label for="end_time"><span class="text-danger">*</span>Heure de fin</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="status" required>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                            </select>
                            <label for="status"><span class="text-danger">*</span>Statut</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="notes" id="notes"
                                value="<?= old('notes'); ?>" placeholder="Ex: Infos supplementaires" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes sur la disponibilité de l'enseignant
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer la configuration
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Valider la disponibilité
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Attribution des cours aux enseignants -->
<div class="modal fade" id="new_teacher_attribution">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title font-weight-bold text-uppercase">
                    Attribution des cours aux enseignants</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/attribution'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control text-uppercase" id="course" name="course" required>
                                <option disabled selected>--Sélectionnez un cours--</option>
                                <?php if (isset($courses_classes) && !empty($courses_classes)): ?>
                                <?php foreach ($courses_classes as $course): ?>
                                <option value="<?= esc($course['courseclasse_id']); ?>">
                                    <?= strtoupper($course['course_name']); ?>
                                    [<?= strtoupper($course['branch_name']); ?>] |

                                    Classe:
                                    <?= setDegresLevels($course['degree_code'], 'f');?>
                                    <?= ucwords($course['classe_subname']);?>
                                    <?= ucwords($course['option_name']);?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <label for="course" class="control-label text-uppercase">
                                <span class="text-danger">*</span>Cours a attribuer
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control text-uppercase" id="teacher" name="teacher" required>
                                <option disabled selected>--Sélectionnez un enseignant--</option>
                                <?php if (isset($teachers) && !empty($teachers)): ?>
                                <?php foreach ($teachers as $teacher): ?>
                                <option value="<?= esc($teacher['teacher_id']); ?>"
                                    <?= set_select('teacher', esc($teacher['teacher_id'])); ?>>
                                    <?= ucwords($teacher['teacher_firstname']); ?>
                                    <?= ucwords($teacher['teacher_lastname']); ?>
                                    <?= ucwords($teacher['teacher_surname']); ?>
                                    [<?= ucwords($teacher['teacher_code']); ?>]
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="teacher" class="control-label">
                                <span class="text-danger">*</span>Enseignant du cours
                            </label>
                        </div>
                    </div>


                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="type" name="type" required>
                                <option value="Temporaire">Temporaire</option>
                                <option value="Permanent">Permanent</option>
                            </select>
                            <label for="type"><span class="text-danger">*</span>Type d'attribution</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="status" required>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                            </select>
                            <label for="status"><span class="text-danger">*</span>Statut d'attribution</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="notes" id="notes"
                                value="<?= old('notes'); ?>" placeholder="Ex: Infos supplementaires" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes sur l'attribution du cours
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer l'attribution
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Valider l'attribution du cours
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Sélectionnez une option",
        allowClear: true
    });
});
</script>

<script>
$(document).ready(function() {
    // Initialize Select2 for course and teacher selection
    $('#course_classe, #teacher').select2({
        theme: 'bootstrap4',
        placeholder: "Sélectionnez une option",
        allowClear: true
    });

    // Initialize timepicker for start and end time inputs
    $('#start_time, #end_time').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '00',
        maxTime: '23:59',
        defaultTime: '',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});