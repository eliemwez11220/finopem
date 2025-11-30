<div class="content-wrapper <?= checkModuleAccess('attendances'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="text-center bg-dark py-3 mb-2 p-3">
                        <nav aria-label="breadcrumb" class="breadcrumb-header text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion de la paie</li>
                                <li class="breadcrumb-item active" aria-current="page">Pointages</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <h3 class="font-weight-bold text-uppercase">Pointages de prestations</h3>
                            <p>
                                Ce formulaire est utilisé pour enregistrer les heures d'arrivée et de départ des agents
                                chaque jour. Il permet de suivre la présence des agents et de calculer les heures
                                travaillées pour la paie.
                            </p>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <?php
                        $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('worker/attendances/create'), $attributes);
                            ?>
                            <?php 
                        $date_of_day = date('Y-m-d'); 
                        $time_in = date('H:i:s'); 
                        ?>
                            <div class="row">
                                <!-- Agent a pointer -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-floating">
                                        <select name="worker" id="worker" class="form-select form-control">
                                            <option disabled selected>--Indiquez un agent--</option>
                                            <?php if (isset($contracts) && !empty($contracts)) : ?>
                                            <?php foreach ($contracts as $agent) : ?>
                                            <option value="<?= $agent['contract_uid']; ?>"
                                                <?= set_select('worker', $agent['contract_uid']) ?>>
                                                <?= $agent['agent_firstname'] . ' ' . $agent['agent_lastname']. ' ' . $agent['agent_surname']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="worker" class="form-label">
                                            <span class="text-danger">*</span>Agent</label>
                                    </div>
                                </div>
                                <!-- Type de pointage -->
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-floating  mb-2">
                                        <select
                                            class="form-control form-select <?= ($validation->hasError('type')) ? ' is-invalid' : '' ?>"
                                            id="attendtype" name="type">
                                            <option disabled>--Sélectionnez--</option>
                                            <?php
                                                    $status_values = array(
                                                        'entry' => 'Entrée',
                                                        'exit' => 'Sortie',
                                                    );
                                                    foreach ($status_values as $value => $display_text) { ?>
                                            <option value="<?= $value; ?>" <?= set_select("type", $value); ?>>
                                                <?= $display_text; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="attendtype" class="form-label">
                                            <span class="text-danger">*</span>Type de pointage</label>
                                        <span class="invalid-feedback">
                                            <?= displayFormError($validation, 'type'); ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- Date du pointage -->
                                <div class="col-lg-6 col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="<?= $date_of_day; ?>" min="<?= $date_of_day; ?>"
                                            max="<?= $date_of_day; ?>" />
                                        <label for="date" class="form-label">
                                            <span class="text-danger">*</span>Date du pointage</label>
                                    </div>
                                </div>
                                <!-- Heure d'arrivée -->
                                <div class="col-lg-6 col-sm-12 mb-2" id="clock_in">
                                    <div class="form-floating">
                                        <input type="time" name="clock_in" id="clock_in" class="form-control"
                                            value="<?= $time_in; ?>" value="<?= $time_in; ?>" />
                                        <label for="clock_in" class="form-label">
                                            <span class="text-danger">*</span>Heure d'arrivée</label>
                                    </div>
                                </div>
                                <!-- Heure de départ -->
                                <div class="col-lg-6 col-sm-12 mb-2 d-none" id="clock_out">
                                    <div class="form-floating">
                                        <input type="time" name="clock_out" id="clock_out" class="form-control"
                                            value="<?= $time_in; ?>" value="<?= $time_in; ?>" />
                                        <label for="clock_out" class="form-label">
                                            <span class="text-danger">*</span>Heure de départ</label>
                                    </div>
                                </div>
                                <!-- STATUS -->
                                <div class="col-lg-6 col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <select
                                            class="form-control form-select <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                            id="status" name="status">
                                            <option disabled>--Sélectionnez--</option>
                                            <?php
                                                    $status_values = array(
                                                        'P' => 'Présent',
                                                        'A' => 'Absent',
                                                        'M' => 'Malade',
                                                        'C' => 'Circonstances',
                                                        'L' => 'Congé',
                                                    );
                                                    foreach ($status_values as $value => $display_text) { ?>
                                            <option value="<?= $value; ?>" <?= set_select("status", $value); ?>>
                                                <?= $display_text; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="status" class="form-label">
                                            <span class="text-danger">*</span>Statut</label>
                                        <span class="invalid-feedback">
                                            <?= displayFormError($validation, 'status'); ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- NOTES -->
                                <div class="col-lg-6 col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Notes" id="notes"
                                            name="notes"><?= set_value('notes'); ?></textarea>
                                        <label for="notes" class="form-label">Observation sur le pointage</label>
                                    </div>
                                </div>
                                <!-- Bouton de validation -->
                                <div class="col-lg-12 col-sm-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-check-circle"></i> Valider le pointage
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatablesExample2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Agent</th>
                                    <th>Date</th>
                                    <th>Heure d'arrivée</th>
                                    <th>Heure de départ</th>
                                    <th>Statut</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($attendances) && !empty($attendances)) : ?>
                                <?php $count = 1; ?>
                                <?php foreach ($attendances as $attendance) : ?>
                                <?php
                                        if (isset($_GET['agent_filter']) && !empty($_GET['agent_filter']) && $_GET['agent_filter'] != $attendance['agent_code']) {
                                            continue; // Skip attendances that don't match the filter
                                        }
                                    ?>
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= $attendance['agent_firstname'] . ' ' . $attendance['agent_lastname']; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($attendance['attendance_date'])); ?></td>
                                    <td><?= date('H:i', strtotime($attendance['attendance_in_time'])); ?></td>
                                    <td><?= ($attendance['attendance_type'] == 'exit') ? date('H:i', strtotime($attendance['attendance_out_time'])):'N/A'; ?>
                                    </td>
                                    <td>
                                        <?php if ($attendance['attendance_status'] == 'P') : ?>
                                        <span class="badge badge-success">Présent</span>
                                        <?php elseif ($attendance['attendance_status'] == 'A') : ?>
                                        <span class="badge badge-danger">Absent</span>
                                        <?php else : ?>
                                        <span class="badge badge-secondary">
                                            <?= htmlspecialchars($attendance['attendance_status']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="">
                                        <?= $attendance['attendance_notes']; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('worker/remove/attendances/'.$attendance['attendance_token']); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce pointage?');">
                                            <i class="fas fa-window-close"></i>
                                        </a>

                                        <a href="<?= base_url('worker/attendances/'.$attendance['attendance_employe_id']); ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-print"></i>
                                        </a>
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
    </section>
</div>