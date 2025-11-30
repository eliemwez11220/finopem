<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Modification d'un contrat de travail</h1>
                </div>
                <div class="col-12 col-lg-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Travailleurs</li>
                            <li class="breadcrumb-item active" aria-current="page">Contrats</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($contract) && (!empty($contract))): ?>
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-primary text-center">
                <h3 class="text-uppercase fw-bold text-white">
                    Contrat ID: <?= $contract['contract_code']; ?>
                </h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php
            $validation = \Config\Services::validation();
            $session = \Config\Services::session();
           
                $attributes = array('role' => "form", 'class' => "form", 'data-parsley-validate' => "data-parsley-validate");
                echo form_open_multipart(base_url('worker/update/contract/'.$contract['contract_uid']), $attributes);
                ?>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                        
                            <div class="form-floating">
                                <select
                                    class="form-select select2 form-control <?php if ($validation->hasError('worker')) {echo 'is-invalid'; } ?>"
                                    id="worker" name="worker" required>
                                    <option selected disabled>--Choisissez un travailleur</option>
                                    <?php if (isset($workers) && !empty($workers)): ?>
                                    <?php foreach ($workers as $worker): ?>
                                    <option value="<?= $worker['agent_uid'] ?>"
                                        <?= ($contract['contract_agent_uid']== $worker['agent_uid']) ? 'selected': set_select('worker', esc($worker['agent_uid'])); ?>>
                                        <?= htmlspecialchars($worker['agent_firstname'] . ' ' . $worker['agent_lastname']); ?>
                                        <?= htmlspecialchars($worker['agent_surname']); ?>
                                        [<?= htmlspecialchars($worker['agent_code']); ?>]
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="worker" class="form-label">
                                <span class="text-danger">*</span>Travailleur</label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'worker'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                        
                            <div class="form-floating">
                                <select
                                    class="form-select select2 form-control <?php if ($validation->hasError('category')) {echo 'is-invalid'; } ?>"
                                    id="category" name="category" required>
                                    <option selected disabled>--Choisissez une catégorie</option>
                                    <?php if (isset($categories) && !empty($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['category_uid'] ?>"
                                        <?= ($contract['contract_category_uid']== $category['category_uid']) ? 'selected':set_select('category', esc($category['category_uid'])); ?>>
                                        <?= htmlspecialchars($category['category_name']); ?>
                                        [<?= htmlspecialchars($category['category_code']); ?>]
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="category" class="form-label">
                                <span class="text-danger">*</span>Catégorie travailleur</label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'category'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select
                                    class="form-select form-control <?php if ($validation->hasError('type')) {echo 'is-invalid'; } ?>"
                                    id="type" name="type" required>
                                    <option value="" selected disabled>Choisissez un type</option>
                                    <option value="CDI"
                                        <?= ($contract['contract_type']== 'CDI') ? 'selected': set_select('type', 'CDI'); ?>>
                                        CDI</option>
                                    <option value="CDD"
                                        <?= ($contract['contract_type']== 'CDD') ? 'selected':set_select('type', 'CDD'); ?>>
                                        CDD</option>
                                    <option value="Stage"
                                        <?= ($contract['contract_type']== 'Stage') ? 'selected':set_select('type', 'Stage'); ?>>
                                        Stage</option>
                                    <option value="freelance"
                                        <?= ($contract['contract_type']== 'freelance') ? 'selected':set_select('type', 'freelance'); ?>>
                                        Freelance</option>
                                </select>

                                <label for="type" class="control-label">
                                    <span class="text-danger">*</span>Type de Contrat
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'type'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-floating mb-3">
                                <select
                                    class="form-control form-control-lg form-select <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                    id="status" name="status">
                                    <option disabled selected>-Sélectionnez statut-</option>
                                    <?php $invoices_status = getStatusValues();
                                            foreach ($invoices_status as $in_key => $inv_value) { ?>
                                    <option value="<?= $in_key; ?>"
                                        <?= ($contract['contract_status'] == $in_key) ? 'selected':set_select("status", $in_key); ?>>
                                        <?= $inv_value; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="status" class="form-label">
                                    <span class="text-danger">*</span>Statut du contrat</label>
                                <span class="invalid-feedback text-danger">
                                    <?= displayFormError($validation, 'status'); ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="date"
                                    class="form-control <?php if ($validation->hasError('start_date')) {echo 'is-invalid'; } ?>"
                                    id="start_date" name="start_date"
                                    value="<?= ($contract['contract_start_date']) ? $contract['contract_start_date']: set_value('start_date') ?>">

                                <label for="start_date" class="form-label"><span class="text-danger">*</span>Date de
                                    Début</label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'start_date'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="<?= ($contract['contract_end_date']) ? $contract['contract_end_date']:set_value('end_date') ?>">
                                <label for="end_date" class="form-label">Date de Fin</label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'end_date'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <input type="text" class="form-control <?php if ($validation->hasError('agent_phone')) {
                                echo 'is-invalid';
                            } ?>" name="agent_phone" id="agent_phone" placeholder="Ex:+243858533285"
                                    value="<?= ($contract['contract_phone_service']) ? $contract['contract_phone_service']:set_value('agent_phone') ?>" />
                                <label for="agent_phone" class="control-label">
                                    <span class="text-danger"></span>Numéro de service
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'agent_phone'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="email" class="form-control <?php if ($validation->hasError('agent_email')) {
                                echo 'is-invalid';
                            } ?>" name="agent_email" id="agent_email" placeholder="Ex:ilunga@ditotase.com"
                                    value="<?= ($contract['contract_email_service']) ? $contract['contract_email_service']:set_value('agent_email') ?>" />
                                <label for="agent_email" class="control-label">
                                    <span class="text-danger"></span>E-mail de service
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'agent_email'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="date" name="date_affec" class="form-control <?php if ($validation->hasError('date_affec')) {
                                echo 'is-invalid';
                            } ?>" id="date_affec" placeholder="Ex:12/12/2000"
                                    value="<?= ($contract['contract_date']) ? $contract['contract_date']:set_value('date_affec'); ?>" />

                                <label for="date_affec" class="control-label">
                                    <span class="text-danger"></span>Date de signature du contrat
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'date_affec'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="place_affec" class="form-control <?php if ($validation->hasError('place_affec')) {
                                echo 'is-invalid';
                            } ?>" id="place_affec" placeholder="Ex:Likasi"
                                    value="<?= ($contract['contract_place']) ? $contract['contract_place']:set_value('place_affec'); ?>" />

                                <label for="place_affec" class="control-label">
                                    <span class="text-danger"></span>Lieu de signature du contrat
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'place_affec'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="salary" name="salary" step="0.01"
                                    placeholder="EX:1000"
                                    value="<?= ($contract['contract_salary']) ? $contract['contract_salary']:set_value('salary') ?>">
                                <label for="salary" class="form-label">Salaire mensuel</label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'salary'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" name="notes" class="form-control <?php if ($validation->hasError('notes')) {
                                echo 'is-invalid';
                            } ?>" id="notes" placeholder="Ex:because we believe"
                                    value="<?= ($contract['contract_notes']) ? $contract['contract_notes']:set_value('notes'); ?>" />

                                <label for="notes" class="control-label">
                                    <span class="text-danger"></span>Notes d'observation sur ce contrat
                                </label>
                                <?php if (isset($validation)): ?>
                                <span class="text-danger invalid-feedback">
                                    <?= displayFormError($validation, 'notes'); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-right float-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                            Appliquer les modifications du contrat</button>
                    </div>
                    <?= form_close(); ?>

                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>