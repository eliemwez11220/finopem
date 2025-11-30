<div class="content-wrapper <?= checkModuleAccess('attendances'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h1 class="text-uppercase font-weight-bold">
                        Prestations Supplémentaires
                    </h1>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestion de la paie</li>
                            <li class="breadcrumb-item active" aria-current="page">Heures Supplémentaires</li>
                            
                        </ol>
                    </nav>
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
                            <h3 class="font-weight-bold text-uppercase">Gestion des Heures Supplémentaires</h3>
                            <p>
                                Ce formulaire est utilisé pour enregistrer les heures supplémentaires des agents. 
                                Il permet de suivre la prestation des agents en dehors des heures normales travaillées pour la paie.
                            </p>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <?php
                        $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('worker/overtimehours/create'), $attributes);
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
                                            id="type" name="type">
                                            <option disabled>--Sélectionnez--</option>
                                            <?php
                                                    $status_values = array(
                                                        '130' => 'Heures Supplémentaires 130%',
                                                        '160' => 'Heures Supplémentaires 160%',
                                                        '200' => 'Heures Supplémentaires 200%',
                                                        'nuit' => 'Présences de nuit',
                                                    );
                                                    foreach ($status_values as $value => $display_text) { ?>
                                            <option value="<?= $value; ?>" <?= set_select("type", $value); ?>>
                                                <?= $display_text; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="type" class="form-label">
                                            <span class="text-danger">*</span>Type d'heures</label>
                                        <span class="invalid-feedback">
                                            <?= displayFormError($validation, 'type'); ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- Date du pointage -->
                                <div class="col-lg-6 col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="<?= $date_of_day; ?>"  max="<?= $date_of_day; ?>" />
                                        <label for="date" class="form-label">
                                            <span class="text-danger">*</span>Date de prestation</label>
                                    </div>
                                </div>
                                <!-- Heure d'arrivée -->
                                <div class="col-lg-6 col-sm-12 mb-2" id="hours">
                                    <div class="form-floating">
                                        <input type="number" name="hours" id="hours" class="form-control"
                                            value="<?= $time_in; ?>" value="<?= $time_in; ?>" placeholder="Ex:12" />
                                        <label for="hours" class="form-label">
                                            <span class="text-danger">*</span>Nombre d'heures prestées </label>
                                    </div>
                                </div>
                                <!-- NOTES -->
                                <div class="col-lg-12 col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Notes" id="notes"
                                            name="notes"><?= set_value('notes'); ?></textarea>
                                        <label for="notes" class="form-label">Observation sur la prestation</label>
                                    </div>
                                </div>
                                <!-- Bouton de validation -->
                                <div class="col-lg-12 col-sm-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-check-circle"></i> Valider la prestation
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
                                    <th>Nombre Heures</th>
                                    <th>Type Heures</th>
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
                                    <td><?= $attendance['attendance_hours']; ?> Heures</td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            <?= ($attendance['attendance_status'] == 'nuit') ? 'Heures de nuit':'Heures supp '.$attendance['attendance_status'].'%'; ?>  
                                        </span>
                                        
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