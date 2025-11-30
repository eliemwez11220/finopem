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
            <div class="row mb-2">
            <div class="col-sm-6 col-lg-6">
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

                <div class="col-sm-6 col-lg-6">
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
        </div><!-- /.container-fluid -->
    </section>

    <?php if (session()->has('choosedsectionid') && session()->has('studentchoosedclasse')): ?>
    <!-- Main content -->
    <section class="content printoff mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 col-sm-6 col-lg-3">
                    <div class="nav flex-column nav-tabs nav-tabs-left h-100" id="vert-tabs-right-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'incident') ? 'active' : ''); ?>"
                            id="follow_incidents" data-toggle="pill" href="#follow_incidents_tab" role="tab"
                            aria-controls="follow_incidents_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Suivi des incidents
                            </span>
                        </a>
                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'sanctions') ? 'active' : ''); ?>"
                            id="sanctions_incidents_tab_btn" data-toggle="pill" href="#sanctions_incidents_tab"
                            role="tab" aria-controls="sanctions_incidents_tab" aria-selected="true">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Sanctions des incidents
                            </span>
                        </a>

                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'evaluations') ? 'active' : ''); ?>"
                            id="evaluations_students_tab_btn" data-toggle="pill" href="#evaluations_students_tab"
                            role="tab" aria-controls="evaluations_students_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Conduites des élèves
                            </span>
                        </a>
                        <a class="d-none text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'evaluation') ? 'active' : ''); ?>"
                            id="courses_evaluation_tab_btn" data-toggle="pill" href="#courses_evaluation_tab" role="tab"
                            aria-controls="courses_evaluation_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Comportements positifs
                            </span>
                        </a>
                        <a class="d-none text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'period') ? 'show active' : ''); ?>"
                            id="notify_parents" data-toggle="pill" href="#notify_parents_tab" role="tab"
                            aria-controls="notify_parents_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Notification aux parents
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-9 col-sm-6 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="vert-tabs-right-tabContent">
                                <!-- DECLARATION DES INCIDENTS -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'incident') ? 'show active' : ''); ?>"
                                    id="follow_incidents_tab" role="tabpanel" aria-labelledby="follow_incidents_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Gestion des incidents des élèves
                                                </h3>
                                                <a data-toggle="modal" data-target="#create_new_incident" href="#"
                                                    class="btn btn-primary btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer un incident">
                                                        <i class="fa fa-plus"></i> Ajouter un incident
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold text-capitalize">
                                                            <th>Actions</th>
                                                            <th>Enseignant</th>
                                                            <th>élève</th>
                                                            <th>Classe</th>
                                                            <th>Gravité</th>
                                                            <th>Date</th>
                                                            <th>Type incident</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($incidents) && !empty($incidents)):
                                                            $count = 1;
                                                        ?>
                                                        <?php foreach ($incidents as $incidentkey => $incident):
                                                                $incident_gravity = esc($incident['incident_gravity']); ?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('education/remove/incident/' . $incident['incident_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet incident ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#incidentModal<?= $incident['incident_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($incident['teacher_firstname']); ?>
                                                                <?= esc($incident['teacher_lastname']); ?>
                                                                <?= esc($incident['teacher_surname']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($incident['student_firstname']); ?>
                                                                <?= esc($incident['student_lastname']); ?>
                                                                <?= esc($incident['student_surname']); ?>
                                                            </td>

                                                            <td class="text-uppercase small">
                                                                <?= setDegresLevels($incident['degree_code'], 'f'); ?>
                                                                <?= ucwords($incident['classe_subname']); ?>
                                                                <?= ucwords($incident['option_name']); ?>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-danger text-capitalize">
                                                                    <?= $incident_gravity; ?>
                                                                </span>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($incident['incident_date']); ?>
                                                            </td>

                                                            <td class="text-uppercase small">
                                                                <?= esc($incident['incident_type']); ?>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing course configuration -->
                                                        <div class="modal fade"
                                                            id="incidentModal<?= $incident['incident_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="incidentModalLabel<?= $incident['incident_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="incidentModalLabel<?= $incident['incident_id']; ?>">
                                                                            Modifier declaration incident
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="form_incident" role="form"
                                                                        action="<?= base_url('education/incident'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="token"
                                                                                value="<?= $incident['incident_token']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                value="update">
                                                                            <div class="text-center">
                                                                                <h2>Modification Déclaration d’un
                                                                                    Incident Disciplinaire</h2>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">

                                                                                        <select
                                                                                            class="form-control select2 select2-info"
                                                                                            id="student_incident<?= $incident['incident_id']; ?>"
                                                                                            name="student" required>
                                                                                            <option disabled selected>
                                                                                                --sélectionnez un
                                                                                                élève--</option>
                                                                                            <?php if (isset($students) && !empty($students)): ?>
                                                                                            <?php foreach ($students as $student): ?>
                                                                                            <option
                                                                                                value="<?= esc($student['inscription_id']); ?>"
                                                                                                <?= ($incident['incident_student_id'] == $student['inscription_id']) ? 'selected':set_select('student_incident', $student['inscription_id']) ?>>
                                                                                                <?= strtoupper($student['student_firstname']); ?>
                                                                                                <?= strtoupper($student['student_lastname']); ?>
                                                                                                <?= strtoupper($student['student_surname']); ?>
                                                                                                (<?= strtoupper($student['student_code']); ?>)
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                        <label
                                                                                            for="student_incident<?= $incident['incident_id']; ?>">
                                                                                            <span
                                                                                                class="text-danger">*</span>Élève
                                                                                            de l'incident
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            id="gravity<?= $incident['incident_id']; ?>"
                                                                                            name="gravity"
                                                                                            class="form-control form-select">
                                                                                            <option value="">--Niveau de
                                                                                                gravité --</option>
                                                                                            <option value="leger"
                                                                                                <?= ($incident['incident_gravity'] == 'leger') ? 'selected':''; ?>>
                                                                                                Léger</option>
                                                                                            <option value="moyen"
                                                                                                <?= ($incident['incident_gravity'] == 'moyen') ? 'selected':''; ?>>
                                                                                                Moyen</option>
                                                                                            <option value="grave"
                                                                                                <?= ($incident['incident_gravity'] == 'grave') ? 'selected':''; ?>>
                                                                                                Grave</option>
                                                                                        </select>
                                                                                        <label
                                                                                            for="gravity<?= $incident['incident_id']; ?>"><span
                                                                                                class="text-danger">*</span>Gravité</label>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            id="maxima<?= $incident['incident_id']; ?>"
                                                                                            name="type_incident"
                                                                                            class="form-control form-select">
                                                                                            <option selected disabled>--
                                                                                                Choisir --</option>
                                                                                            <optgroup label="Nouveau">
                                                                                                <option
                                                                                                    value="<?= $incident['incident_type']; ?>"
                                                                                                    <?= (incidentsTypes($incident['incident_type']) == 'none') ? 'selected':''; ?>>
                                                                                                    <?= $incident['incident_type']; ?>
                                                                                                </option>
                                                                                            </optgroup>
                                                                                            <?php
                                $incidents = incidentsTypes();
                                foreach ($incidents as $categorie => $types) { ?>
                                                                                            <optgroup
                                                                                                label="<?= $categorie; ?>">
                                                                                                <?php foreach ($types as $val_incident) { ?>
                                                                                                <option
                                                                                                    value="<?= $val_incident; ?>"
                                                                                                    <?= ($incident['incident_type'] == $val_incident) ? 'selected':''; ?>>
                                                                                                    <?= $val_incident; ?>
                                                                                                </option>
                                                                                                <?php } ?>
                                                                                            </optgroup>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                        <label
                                                                                            for="maxima<?= $incident['incident_id']; ?>"><span
                                                                                                class="text-danger">*</span>Type
                                                                                            d’incident</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="date"
                                                                                            value="<?= $incident['incident_date']; ?>"
                                                                                            id="date_incident<?= $incident['incident_id']; ?>"
                                                                                            name="date_incident"
                                                                                            class="form-control">
                                                                                        <label
                                                                                            for="date_incident<?= $incident['incident_id']; ?>"><span
                                                                                                class="text-danger">*</span>Date
                                                                                            de l’incident</label>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control form-select"
                                                                                            id="teacher_incident<?= $incident['incident_id']; ?>"
                                                                                            name="teacher" required>
                                                                                            <option disabled selected>
                                                                                                --Sélectionnez un
                                                                                                enseignant--</option>
                                                                                            <?php if (isset($teachers) && !empty($teachers)): ?>
                                                                                            <?php foreach ($teachers as $teacher): ?>
                                                                                            <option
                                                                                                value="<?= esc($teacher['teacher_id']); ?>"
                                                                                                <?= ($incident['incident_teacher_id'] == $teacher['teacher_id']) ? 'selected':''; ?>>
                                                                                                <?= ucwords($teacher['teacher_firstname']); ?>
                                                                                                <?= ucwords($teacher['teacher_lastname']); ?>
                                                                                                <?= ucwords($teacher['teacher_surname']); ?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>

                                                                                        <label
                                                                                            for="teacher_incident<?= $incident['incident_id']; ?>"
                                                                                            class="control-label">
                                                                                            <span
                                                                                                class="text-danger"></span>Enseignant
                                                                                            responsable
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <textarea
                                                                                            id="description<?= $incident['incident_id']; ?>"
                                                                                            name="description"
                                                                                            class="form-control"
                                                                                            placeholder="Décrire ce qui s’est passé..."><?= $incident['incident_description']; ?></textarea>

                                                                                        <label for="description"
                                                                                            <?= $incident['incident_id']; ?>><span
                                                                                                class="text-danger">*</span>Description
                                                                                            de l’incident</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <textarea
                                                                                            id="action_prise<?= $incident['incident_id']; ?>"
                                                                                            name="action_prise"
                                                                                            class="form-control"
                                                                                            placeholder="Exemple : élève isolé, avertissement oral, etc."><?= $incident['incident_actions']; ?></textarea>

                                                                                        <label
                                                                                            for="action_prise<?= $incident['incident_id']; ?>"><span
                                                                                                class="text-danger">*</span>Action
                                                                                            immédiate prise</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <textarea
                                                                                            id="commentaires<?= $incident['incident_id']; ?>"
                                                                                            name="commentaires"
                                                                                            class="form-control"
                                                                                            placeholder="Notes supplémentaires"><?= $incident['incident_notes']; ?></textarea>
                                                                                        <label
                                                                                            for="commentaires<?= $incident['incident_id']; ?>">Commentaires</label>
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
                                                                                Modifier la declaration de l'incident
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
                                <!-- SANCTIONS DISCIPLINAIRES -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'sanctions') ? 'show active' : ''); ?>"
                                    id="sanctions_incidents_tab" role="tabpanel"
                                    aria-labelledby="sanctions_incidents_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Enregistrement des sanctions des incidents
                                                </h3>
                                                <a data-toggle="modal" data-target="#create_new_sanction" href="#"
                                                    class="btn btn-success btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer une nouvelle sanction">
                                                        <i class="fa fa-plus"></i> Ajouter une nouvelle sanction
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold text-capitalize">
                                                            <th>Actions</th>
                                                            <th>élève</th>
                                                            <th>Classe</th>
                                                            <th>Incident</th>
                                                            <th>Sanction</th>
                                                            <th>Points</th>
                                                            <th>Temps</th>
                                                            <th>Notes</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($sanctions) && !empty($sanctions)):
                                                            $count = 1;
                                                        ?>
                                                        <?php foreach ($sanctions as $sanc_index => $sanction):
                                                            $status = esc($sanction['sanction_status']); 
                                                        ?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('education/remove/sanction/' . $sanction['sanction_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sanction ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#editSanctionModal<?= $sanction['sanction_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>

                                                            <td class="text-uppercase small">
                                                                <?= esc($sanction['student_firstname']); ?>
                                                                <?= esc($sanction['student_lastname']); ?>
                                                                <?= esc($sanction['student_surname']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= setDegresLevels($sanction['degree_code'], 'f'); ?>
                                                                <?= $sanction['classe_subname']; ?>
                                                                <?= $sanction['option_name']; ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($sanction['incident_type']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($sanction['sanction_type']); ?></td>
                                                            <td class="text-center"><?= $sanction['sanction_points']; ?>
                                                            </td>
                                                            <td class="text-center"><?= $sanction['sanction_timing']; ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($sanction['sanction_notes']); ?></td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing sanction -->
                                                        <div class="modal fade"
                                                            id="editSanctionModal<?= $sanction['sanction_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editSanctionModalLabel<?= $sanction['sanction_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="editSanctionModalLabel<?= $sanction['sanction_id']; ?>">
                                                                            Modifier la sanction d'un incident
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="<?= base_url('education/sanctions'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="token"
                                                                                value="<?= $sanction['sanction_token']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                value="update">


                                                                            <div class="row">

                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="incident"
                                                                                            name="incident" required>
                                                                                            <option disabled selected>
                                                                                                --Sélectionnez un
                                                                                                incident--</option>
                                                                                            <?php if (isset($sanctionsincidents) && !empty($sanctionsincidents)): ?>
                                                                                            <?php foreach ($sanctionsincidents as $key_incident => $sancincident): ?>
                                                                                            <option
                                                                                                value="<?= esc($sancincident['incident_id']); ?>"
                                                                                                <?= ($sanction['sanction_incident_id'] == $sancincident['incident_id']) ? 'selected':set_select('incident', esc($sancincident['incident_id'])); ?>>
                                                                                                <?= strtoupper($sancincident['incident_type']); ?>
                                                                                                |
                                                                                                Élève:
                                                                                                <?= ucwords($sancincident['student_firstname']); ?>
                                                                                                <?= ucwords($sancincident['student_lastname']); ?>
                                                                                                <?= ucwords($sancincident['student_surname']); ?>
                                                                                                [<?= strtoupper($sancincident['student_code']); ?>]
                                                                                                <?php endforeach; ?>
                                                                                                <?php endif; ?>
                                                                                        </select>
                                                                                        <label for="incident"
                                                                                            class="control-label text-uppercase">
                                                                                            <span
                                                                                                class="text-danger">*</span>Incident
                                                                                            déclaré
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select id="address_street"
                                                                                            name="sanction"
                                                                                            class="form-control form-select">
                                                                                            <option value="">--
                                                                                                Choisissez une santion
                                                                                                --</option>
                                                                                            <optgroup
                                                                                                label="Nouvelle sanction">
                                                                                                <option
                                                                                                    value="<?= $sanction['sanction_type']; ?>"
                                                                                                    <?= (setSanctionsTypes($sanction['sanction_type']) == 'none') ? 'selected':''; ?>>
                                                                                                    <?= $sanction['sanction_type']; ?>
                                                                                                </option>
                                                                                            </optgroup>
                                                                                            <?php
                                $sanctions_types = setSanctionsTypes();
                                foreach ($sanctions_types as $key_sanction_type => $sanction_types) { ?>
                                                                                            <optgroup
                                                                                                label="<?= $key_sanction_type; ?>">
                                                                                                <?php foreach ($sanction_types as $type_sanction) { ?>
                                                                                                <option
                                                                                                    value="<?= $type_sanction; ?>"
                                                                                                    <?= ($sanction['sanction_type'] == $type_sanction) ? 'selected': ''; ?>>
                                                                                                    <?= $type_sanction; ?>
                                                                                                </option>
                                                                                                <?php } ?>
                                                                                            </optgroup>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                        <label
                                                                                            for="address_street"><span
                                                                                                class="text-danger">*</span>Sanction
                                                                                            applicable
                                                                                            d’incident</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status" name="status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($sanction['sanction_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($sanction['sanction_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>

                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Etat
                                                                                            de la sanction</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            step="0.01" name="timing"
                                                                                            id="timing"
                                                                                            value="<?= (!empty($sanction['sanction_timing'])) ? $sanction['sanction_timing']: old('timing'); ?>"
                                                                                            placeholder="Ex: 30min ou 10 jours" />
                                                                                        <label for="timing">
                                                                                            <span
                                                                                                class="text-danger"></span>Durée
                                                                                            de la sanction (temps ou
                                                                                            jours)
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="number" id="points"
                                                                                            name="points"
                                                                                            class="form-control"
                                                                                            value="<?= (!empty($sanction['sanction_points'])) ? $sanction['sanction_points']:0; ?>">
                                                                                        <label for="points">Cotation
                                                                                            (points à retirer)</label>
                                                                                        <small>Exemple : 1 pour
                                                                                            comportement léger, 2 pour
                                                                                            comportement Moyen, 3 pour
                                                                                            comportement grave.</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="notes" id="notes"
                                                                                            value="<?= (!empty($sanction['sanction_notes'])) ? $sanction['sanction_notes']: old('notes'); ?>"
                                                                                            placeholder="Ex: Infos supplementaires" />
                                                                                        <label for="notes"
                                                                                            class="control-label">
                                                                                            <span
                                                                                                class="text-danger"></span>Notes
                                                                                            d'observation sur la
                                                                                            sanction
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
                                                                                Modifier la sanction</button>
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
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'evaluations') ? 'show active' : ''); ?>"
                                    id="evaluations_students_tab" role="tabpanel"
                                    aria-labelledby="evaluations_students_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Suivi conduites des élèves
                                                </h3>
                                                <a data-toggle="modal" data-target="#create_new_evaluation" href="#"
                                                    class="btn btn-dark btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer une nouvelle Evaluation de la conduite ">
                                                        <i class="fa fa-plus"></i> Ajouter une nouvelle évaluation
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold">
                                                            <th>Actions</th>
                                                            <th>ELEVE</th>
                                                            <th>CLASSE</th>
                                                            <th>PERIODE</th>
                                                            <th>MENTION</th>
                                                            <th>POINTS</th>
                                                            <th>Notes</th>
                                                            <th>Statut</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($evaluations) && !empty($evaluations)):
                                                            $count = 1;
                                                        ?>
                                                        <?php foreach ($evaluations as $index => $evaluation):
                                                                $status_evaluation = esc($evaluation['evaluation_status']); ?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('education/remove/evaluation/' . $evaluation['evaluation_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette evaluations ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <a href="<?= base_url('education/changeStatus/evaluation/' .$status_evaluation.'/'. $evaluation['evaluation_id']); ?>"
                                                                    class="btn btn-warning btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette evaluation ?');">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= esc($evaluation['student_firstname']); ?>
                                                                <?= esc($evaluation['student_lastname']); ?>
                                                                <?= esc($evaluation['student_surname']); ?>
                                                                <?= esc($evaluation['student_code']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= setDegresLevels($evaluation['degree_code'], 'f'); ?>
                                                                <?= $evaluation['classe_subname']; ?>
                                                                <?= $evaluation['option_name']; ?>
                                                            </td>
                                                            <td class="">
                                                            <?= strtoupper($evaluation['period_name']); ?>
                                                            (<?= strtoupper($evaluation['period_shortname']); ?>)
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $evaluation['evaluation_mention']; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $evaluation['evaluation_total_points']; ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($evaluation['evaluation_notes']); ?></td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status_evaluation) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status_evaluation; ?>
                                                                </span>
                                                            </td>
                                                            <td class="">
                                                                <?= $evaluation['evaluation_date']; ?>
                                                            </td>
                                                        </tr>
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
                                    <h3 class="font-weight-bold text-uppercase">
                                        Mesures displinaires
                                    </h3>
                                    <div class="printoff">
                                        <div class="text-right">
                                            <a href="javascript:void();"
                                                class="btn btn-outline-light text-uppercase btn-sm" onclick="print()">
                                                <i class="fa fa-print"></i> Imprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped" id="datatablesReportingActions">
                                    <thead>
                                        <tr class="small text-uppercase">
                                            <th>élève</th>
                                            <th>Classe</th>
                                            <th>Incident</th>
                                            <th>Sanction</th>
                                            <th>Points</th>
                                            <th>Temps</th>
                                            <th>Notes</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($sanctions) && !empty($sanctions)):
                                        $count = 1;
                                        foreach ($sanctions as $san_index => $val_sanction):
                                            $val_sanction_status = esc($val_sanction['sanction_status']); 
                                                        ?>
                                        <tr class="small">

                                            <td class="text-uppercase small">
                                                <?= esc($val_sanction['student_firstname']); ?>
                                                <?= esc($val_sanction['student_lastname']); ?>
                                                <?= esc($val_sanction['student_surname']); ?>
                                            </td>
                                            <td class="text-uppercase small">
                                                <?= setDegresLevels($val_sanction['degree_code'], 'f'); ?>
                                                <?= $val_sanction['classe_subname']; ?>
                                                <?= $val_sanction['option_name']; ?>
                                            </td>
                                            <td class="text-uppercase small">
                                                <?= esc($val_sanction['incident_type']); ?>
                                            </td>
                                            <td class="text-uppercase small">
                                                <?= esc($val_sanction['sanction_type']); ?></td>
                                            <td class="text-center"><?= $val_sanction['sanction_points']; ?>
                                            </td>
                                            <td class="text-center"><?= $val_sanction['sanction_timing']; ?>
                                            </td>
                                            <td class="text-uppercase small">
                                                <?= esc($val_sanction['sanction_notes']); ?></td>

                                            <td>
                                                <span
                                                    class="badge  <?= (esc($val_sanction_status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                    <?= ($val_sanction_status == 'actif') ? 'Encours': 'Levée'; ?>
                                                </span>
                                            </td>
                                        </tr>
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

    <?php else: ?>
    <section class="content printoff mb-5">
        <div class="container">
            <div class="alert alert-danger text-center">
                <h5><i class="icon fas fa-ban"></i> Aucune section !</h5>
                Vous n'avez pas encore selectionné de section pour gérer les incidents disciplinaires. <br>
                Veuillez d'abord pour choisir une section et classe valide ci-haut.
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>

<!-- DECLARATION D'UN INCIDENT-->
<div class="modal fade" id="create_new_incident">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title font-weight-bold text-uppercase">Gestion des incidents</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/incident'), $attributes);
            ?>
            <div class="modal-body">
                <div class="text-center">
                    <h2>Déclaration d’un Incident Disciplinaire</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control select2 select2-info" id="student_incident" name="student"
                                required>
                                <option disabled selected>--sélectionnez un
                                    élève--</option>
                                <?php if (isset($students) && !empty($students)): ?>
                                <?php foreach ($students as $student): ?>
                                <option value="<?= esc($student['inscription_id']); ?>"
                                    <?= set_select('student_incident', $student['inscription_id']) ?>>
                                    <?= strtoupper($student['student_firstname']); ?>
                                    <?= strtoupper($student['student_lastname']); ?>
                                    <?= strtoupper($student['student_surname']); ?>
                                    (<?= strtoupper($student['student_code']); ?>)
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="student_incident">
                                <span class="text-danger">*</span>Élève de l'incident
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select id="gravity" name="gravity" class="form-control form-select">
                                <option value="">--Niveau de gravité --</option>
                                <option value="leger">Léger</option>
                                <option value="moyen">Moyen</option>
                                <option value="grave">Grave</option>
                            </select>
                            <label for="gravity"><span class="text-danger">*</span>Gravité</label>

                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select id="maxima" name="type_incident" class="form-control form-select">
                                <option value="">-- Choisir --</option>
                                <optgroup label="Nouveau">
                                    <option value="new">Ajouter un type d’incident</option>
                                </optgroup>
                                <?php
                                $incidents = incidentsTypes();
                                foreach ($incidents as $categorie => $types) { ?>
                                <optgroup label="<?= $categorie; ?>">
                                    <?php foreach ($types as $typeincident) { ?>
                                    <option value="<?= $typeincident; ?>">
                                        <?= $typeincident; ?>
                                    </option>
                                    <?php } ?>
                                </optgroup>
                                <?php } ?>
                            </select>
                            <label for="maxima"><span class="text-danger">*</span>Type d’incident</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2" id="inputs_show" style="display:none;">
                        <div class="form-floating">
                            <input type="text" id="add_type_incident" name="new_type_incident" class="form-control"
                                placeholder="Ex: Vol">
                            <label for="enseignant"><span class="text-danger">*</span>Designation type incident</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="form-floating">
                            <input type="date" id="date_incident" name="date_incident" class="form-control">
                            <label for="date_incident"><span class="text-danger">*</span>Date de l’incident</label>

                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control form-select" id="teacher_incident" name="teacher"
                                required>
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

                            <label for="teacher_incident" class="control-label">
                                <span class="text-danger"></span>Enseignant responsable
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <textarea id="description" name="description" class="form-control"
                                placeholder="Décrire ce qui s’est passé..."></textarea>

                            <label for="description"><span class="text-danger">*</span>Description de l’incident</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <textarea id="action_prise" name="action_prise" class="form-control"
                                placeholder="Exemple : élève isolé, avertissement oral, etc."></textarea>

                            <label for="action_prise"><span class="text-danger">*</span>Action immédiate prise</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <textarea id="commentaires" name="commentaires" class="form-control"
                                placeholder="Notes supplémentaires"></textarea>
                            <label for="commentaires">Commentaires</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Enregistrer l'incident
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- SANCTIONS -->
<div class="modal fade" id="create_new_sanction">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title font-weight-bold text-uppercase">
                    Enregistrement d'une sanction disciplinaire
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/sanction'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control text-uppercase" id="incident" name="incident" required>
                                <option disabled selected>--Sélectionnez un incident--</option>
                                <?php if (isset($sanctionsincidents) && !empty($sanctionsincidents)): ?>
                                <?php foreach ($sanctionsincidents as $key_incident => $sancincident): ?>
                                <option value="<?= esc($sancincident['incident_id']); ?>"
                                    <?= set_select('incident', esc($sancincident['incident_id'])); ?>>
                                    <?= strtoupper($sancincident['incident_type']); ?> |
                                    Élève:
                                    <?= ucwords($sancincident['student_firstname']); ?>
                                    <?= ucwords($sancincident['student_lastname']); ?>
                                    <?= ucwords($sancincident['student_surname']); ?>
                                    [<?= strtoupper($sancincident['student_code']); ?>]
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                            </select>
                            <label for="incident" class="control-label text-uppercase">
                                <span class="text-danger">*</span>Incident déclaré
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select id="address_street" name="sanction" class="form-control form-select">
                                <option value="">-- Choisissez une santion --</option>
                                <optgroup label="Nouvelle sanction">
                                    <option value="new_zone">Ajouter une nouvelle sanction d’incident</option>
                                </optgroup>
                                <?php
                                $sanctions_types = setSanctionsTypes();
                                foreach ($sanctions_types as $key_sanction_type => $sanction_types) { ?>
                                <optgroup label="<?= $key_sanction_type; ?>">
                                    <?php foreach ($sanction_types as $type_sanction) { ?>
                                    <option value="<?= $type_sanction; ?>">
                                        <?= $type_sanction; ?>
                                    </option>
                                    <?php } ?>
                                </optgroup>
                                <?php } ?>
                            </select>
                            <label for="address_street"><span class="text-danger">*</span>Sanction applicable
                                d’incident</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2" id="inputs_zone_show" style="display:none;">
                        <div class="form-floating">
                            <input type="text" id="add_new_sanction" name="new_sanction" class="form-control"
                                placeholder="Ex: Vol">
                            <label for="enseignant"><span class="text-danger">*</span>Décrivez la nouvelle sanction
                                applicable</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="status" required>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>

                            </select>
                            <label for="status"><span class="text-danger">*</span>Etat de la sanction</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" step="0.01" name="timing" id="timing"
                                value="<?= old('timing'); ?>" placeholder="Ex: 30min ou 10 jours" />
                            <label for="timing">
                                <span class="text-danger"></span>Durée de la sanction (temps ou jours)
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <input type="number" id="points" name="points" class="form-control" value="1">
                            <label for="points">Cotation (points à retirer)</label>
                            <small>Exemple : 1 pour comportement léger, 2 pour comportement Moyen, 3 pour comportement
                                grave.</small>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="notes" id="notes"
                                value="<?= old('notes'); ?>" placeholder="Ex: Infos supplementaires" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes d'observation sur la sanction
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Valider la sanction
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- CONDUITES DES ELEVES -->
<div class="modal fade" id="create_new_evaluation">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title font-weight-bold text-uppercase">
                    Evaluation de la conduite des élèves
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education/evaluation'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control select2 select2-info" id="studentev" name="student"
                                required>
                                <option disabled selected>--sélectionnez un élève--</option>
                                <?php if (isset($students) && !empty($students)): ?>
                                <?php foreach ($students as $student): ?>
                                <option value="<?= esc($student['inscription_id']); ?>"
                                    <?= set_select('student', $student['inscription_id']) ?>>
                                    <?= strtoupper($student['student_firstname']); ?>
                                    <?= strtoupper($student['student_lastname']); ?>
                                    <?= strtoupper($student['student_surname']); ?>
                                    (<?= strtoupper($student['student_code']); ?>)
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="studentev">
                                <span class="text-danger">*</span>Élève Evalué
                            </label>
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
                                ?>
                                <option value="<?= esc($pervalue['annualperiod_id']); ?>"
                                    <?= set_select('annualperiod', esc($pervalue['annualperiod_id'])); ?>>
                                    <?= strtoupper($pervalue['period_name']); ?>
                                    (<?= strtoupper($pervalue['period_shortname']); ?>)
                                    / <?= strtoupper($pervalue['section_name']); ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="annualperiod"><span class="text-danger">*</span>
                                Période d'évaluation</label>
                            <?php if ($validation->hasError('annualperiod')) { ?>
                            <span class="invalid-feedback">
                                <?= $validation->getError(field: 'annualperiod'); ?></span>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="conduite" name="conduite" required>
                                <option value="excellent">Excellent</option>
                                <option value="très bien">Très Bien</option>
                                <option value="bien">Bien</option>
                                <option value="assez bien">Assez Bien</option>
                                <option value="passable">Passable</option>
                                <option value="insuffisant">Insuffisant</option>
                                <option value="médiocre">Médiocre</option>
                            </select>
                            <label for="conduite"><span class="text-danger">*</span>Mention de conduite</label>
                        </div>
                    </div>
                    <?php $daily_date= date('Y-m-d'); ?>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="date_eval" id="date_eval" max="<?= $daily_date; ?>"
                                value="<?= $daily_date; ?>" required />

                            <label for="points" class="control-label">
                                <span class="text-danger">*</span>Date d'évaluation de la conduite
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="points" id="points" min="0" max="10000"
                                value="<?= old('points'); ?>" placeholder="Ex:20" />

                            <label for="points" class="control-label">
                                <span class="text-danger"></span>Point d'évaluation obtenu
                            </label>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="notes" id="notes"
                                value="<?= old('notes'); ?>" placeholder="Ex: Infos supplementaires" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes sur l'évaluation de la conduite
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer l'évaluation
                </button>
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-check-circle"></i> Valider l'évaluation
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
</script>