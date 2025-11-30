<div class="content-wrapper <?= checkModuleAccess('salaries'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Gestion paiement Salaires</h1>

                    <p class="text-subtitle text-primary fw-bold">
                        Paiements des salaires mensuels des agents et autres travailleurs de l'organisation.
                    </p>

                </div>
                <div class="col-12 col-lg-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestion de la paie</li>
                            <li class="breadcrumb-item active" aria-current="page">Paiment salaires</li>
                        </ol>
                    </nav>
                    <p class="float-right">

                        <!-- Button to trigger the offcanvas -->
                        <a href="#" data-toggle="modal" data-target="#addCategoryOffcanvas"
                            aria-controls="addCategoryOffcanvas" title="Ajouter un paiement salaire"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Nouveau paiement salaire
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-12 col-sm-12">
                    <form method="get" class="mb-3 printoff">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <select name="month" id="month" class="form-select form-control">
                                        <option selected disabled>--Choisissez un mois--</option>
                                        <?php foreach (monthYearly() as $month => $month_label): ?>
                                        <option value="<?= $month; ?>"
                                            <?= isset($_GET['month']) && $_GET['month'] == $month ? 'selected' : ''; ?>>
                                            <?= $month_label; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="month" class="form-label">Mois</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <select name="agent_filter" id="agent_filter" class="form-select form-control">
                                        <option value="">Tous les agents</option>
                                        <?php if (isset($payments) && !empty($payments)): ?>
                                        <?php foreach ($payments as $agent): ?>
                                        <option value="<?= $agent['agent_code']; ?>"
                                            <?= isset($_GET['agent_filter']) && $_GET['agent_filter'] == $agent['agent_code'] ? 'selected' : ''; ?>>
                                            <?= $agent['agent_firstname'] . ' ' . $agent['agent_lastname']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="agent_filter" class="form-label">Filtrer par agent</label>
                                </div>
                            </div>

                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    <i class="fas fa-filter"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php if (isset($payments) && !empty($payments)): ?>
            <div class="card">
                <div class="card-header bg-primary text-uppercase text-center">
                    <h1 class="font-weight-bold">Paiement Salaire Mensuel des agents</h1>
                    <p class="text-uppercase font-weight-bold"><i>
                            Mois de
                            <b><?= isset($period) ? monthYearly($period):monthYearly(date('m')); ?>
                            </b>
                            <?= date('Y'); ?>
                        </i>
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatablesExample2">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Travailleur</th>
                                    <th>Catégorie</th>
                                    <th>Mois</th>
                                    <th>Salaire</th>
                                    <th>Primes</th>
                                    <th>Total</th>
                                    <th>Jours</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($payments as $payment):
                                if (isset($_GET['agent_filter']) && !empty($_GET['agent_filter']) && $_GET['agent_filter'] != $payment['agent_code']) {
                                    continue; // Skip payments that don't match the filter
                                }
                                if (isset($_GET['month']) && !empty($_GET['month']) && $_GET['month'] != $payment['payment_period']) {
                                    continue; // Skip payments that don't match the filter
                                }
                                    $worker_name = $payment['agent_firstname'] . ' ' . $payment['agent_lastname'] . ' ' . $payment['agent_surname'];
                                    $payment_salary = ($payment['payment_amount'] !=0) ? floatval($payment['payment_amount']): floatval($payment['category_cost_day']) * intval($payment['payment_work_days']);
                                    $payment_amount = $payment_salary + floatval($payment['payment_amount_bonus']);
                                ?>
                                <tr class="small">
                                    <td>
                                        <span class=" font-weight-bold">
                                            <?= htmlspecialchars($payment['payment_code']) ?>
                                        </span>
                                    </td>
                                    <td class="text-uppercase">
                                        <a href="<?= base_url('worker/agent/' . $payment['agent_uid']); ?>"
                                            class="text-primary">
                                            <span
                                                class="small font-weight-bold"><?= htmlspecialchars($worker_name) ?></span>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($payment['category_name']); ?></td>
                                    <td><?= monthYearly($payment['payment_period']) ?></td>
                                    <td><?= number_format($payment_salary, 2, ',', ' ') ?></td>
                                    <td><?= number_format(floatval($payment['payment_amount_bonus']), 2, ',', ' ') ?></td>
                                    <td><?= number_format($payment_amount, 2, ',', ' ') ?></td>
                                    <td class="text-capitalize"><?= htmlspecialchars($payment['payment_work_days']) ?></td>
                                    <td class="text-capitalize">
                                        <span class="badge bg-<?= setStatusColors($payment['payment_status']); ?>">
                                            <?= getStatusValues($payment['payment_status']) ?>
                                        </span>
                                    </td>


                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#paymentDetailsModal<?= $payment['payment_uid'] ?>">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <a href="<?= base_url('worker/remove/payment/' . $payment['payment_uid']); ?>"
                                            class="btn btn-danger btn-sm <?= ($payment['payment_status'] != 'cancel') ? 'disabled':'' ?>"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement salaire ?');"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Supprimer ce paiement">
                                            <i class="fas fa-window-close"></i>
                                        </a>
                                        <button type="button"
                                            class="<?= ($payment['payment_status'] != 'pending') ? 'disabled':'' ?> btn btn-outline-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#paymentUpdateModal<?= $payment['payment_uid'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>


                                <!-- Modal DETAILS-->
                                <div class="modal fade" id="paymentDetailsModal<?= $payment['payment_uid'] ?>"
                                    tabindex="-1"
                                    aria-labelledby="paymentDetailsModalLabel<?= $payment['payment_uid'] ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title font-weight-bold"
                                                    id="paymentDetailsModalLabel<?= $payment['payment_uid'] ?>">
                                                    Détails Paiement du Travailleur
                                                    <?= htmlspecialchars($worker_name) ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-danger"><i
                                                            class="fa fa-window-close"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="py-3">
                                                    <li><strong>Paiement ID:</strong>
                                                        <span class="badge bg-primary">
                                                            <?= htmlspecialchars($payment['payment_code']) ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Travailleur:</strong>
                                                        <a href="<?= base_url('worker/agent/' . $payment['agent_uid']); ?>"
                                                            class="text-decoration-none">
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($worker_name) ?>
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <strong>Mois payé:</strong>
                                                        <span class="badge bg-primary">
                                                            <?= monthYearly($payment['payment_period']) ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Date payée:</strong>
                                                        <span class="badge bg-primary">
                                                            <?= htmlspecialchars($payment['payment_date']) ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Montant payé:</strong>
                                                        <span class="badge bg-primary">
                                                            <?= number_format($payment_amount, 2, ',', ' ') ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Montant Primes:</strong>
                                                        <span class="badge bg-primary">
                                                            <?= number_format($payment['payment_amount_bonus'], 2, ',', ' ') ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Nombre de jours prestés:</strong>
                                                        <span class="badge bg-primary">
                                                            <?= number_format($payment['payment_work_days'], 2, ',', ' ') ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Statut:</strong>
                                                        <span
                                                            class="badge bg-<?= setStatusColors($payment['payment_status']); ?>">
                                                            <?= getStatusValues($payment['payment_status']) ?>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <strong>Notes:</strong>
                                                        <span class="badge bg-primary">

                                                            <?= htmlspecialchars($payment['payment_notes'] ?? 'N/A') ?>
                                                        </span>

                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">

                                                <a href="<?= base_url('worker/payment/validate/' . $payment['payment_uid']); ?>"
                                                    class="btn btn-primary btn-sm <?= ($payment['payment_status'] == 'pending') ? '':'disabled' ?>">
                                                    <i class="fas fa-edit"></i> Valider le paiement</a>

                                                <a href="<?= base_url('worker/payment/reject/' . $payment['payment_uid']); ?>"
                                                    class="btn btn-outline-warning btn-sm <?= ($payment['payment_status'] == 'pending') ? '':'disabled' ?>"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?');">
                                                    <i class="fas fa-window-close"></i> Rejeter le paiement</a>

                                                <a href="<?= base_url('worker/payment/cancel/' . $payment['payment_uid']); ?>"
                                                    class="btn btn-outline-danger btn-sm <?= ($payment['payment_status'] == 'cancel') ? 'disabled':'' ?>"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?');">
                                                    <i class="fas fa-window-close"></i> Annuler le paiement</a>

                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">
                                                    <i class="fas fa-x"></i> Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal DETAILS-->
                                <div class="modal fade" id="paymentUpdateModal<?= $payment['payment_uid'] ?>"
                                    tabindex="-1"
                                    aria-labelledby="paymentUpdateModalLabel<?= $payment['payment_uid'] ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title font-weight-bold"
                                                    id="paymentUpdateModalLabel<?= $payment['payment_uid'] ?>">
                                                    Modification paiement du Travailleur
                                                    <?= htmlspecialchars($worker_name) ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-danger"><i
                                                            class="fa fa-window-close"></i></span>
                                                </button>
                                            </div>
                                            <form
                                                action="<?= base_url('worker/payment/update/'.esc($payment['payment_uid'])); ?>"
                                                method="post" class="">

                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                            <div class="form-floating">
                                                                <select class="form-select form-control" id="worker"
                                                                    name="worker" required>
                                                                    <option selected disabled>--Choisissez un agent
                                                                    </option>
                                                                    <?php if (isset($workers) && !empty($workers)): ?>
                                                                    <?php foreach ($workers as $worker): ?>
                                                                    <option value="<?= $worker['contract_uid'] ?>"
                                                                        <?= ($worker['contract_uid'] == $payment['payment_agent_uid']) ? 'selected': set_select('worker', esc($worker['contract_uid'])); ?>>
                                                                        <?= htmlspecialchars($worker['agent_firstname'] . ' ' . $worker['agent_lastname']); ?>
                                                                        <?= htmlspecialchars($worker['agent_surname']); ?>
                                                                        [<?= htmlspecialchars($worker['agent_code']); ?>]
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                                <label for="worker" class="form-label">
                                                                    <span class="text-danger">*</span>Agent à
                                                                    payer
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-12">
                                                            <div class="form-floating mb-2">
                                                                <select class="form-control form-select" id="month"
                                                                    name="month" required>
                                                                    <option selected disabled>--Choisissez un mois
                                                                    </option>
                                                                    <?php foreach (monthYearly() as $month => $label): ?>
                                                                    <option value="<?= htmlspecialchars($month); ?>"
                                                                        <?= ($month == $payment['payment_period']) ? 'selected':set_select('month', $month); ?>>
                                                                        <?= htmlspecialchars($label); ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <label for="month" class="form-label">
                                                                    <span class="text-danger">*</span>Mois à
                                                                    payer</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-12">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="amount" name="amount"
                                                                    value="<?= ($payment_amount) ? ($payment_amount): old('amount'); ?>"
                                                                    placeholder="Ex: 100 000">
                                                                <label for="amount" class="form-label"><span
                                                                        class="text-danger"></span>Montant à payer</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-12">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="bonus" name="bonus"
                                                                    value="<?= ($payment['payment_amount_bonus']) ? ($payment['payment_amount_bonus']):old('bonus'); ?>"
                                                                    placeholder="Ex: 100 000">
                                                                <label for="bonus" class="form-label">
                                                                    <span class="text-danger"></span>Primes et
                                                                    Gratifications (optionnelle)
                                                                </label>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="days" name="days"
                                                                    value="<?= ($payment['payment_work_days']) ? ($payment['payment_work_days']):old('days'); ?>"
                                                                    placeholder="Ex: 26">
                                                                <label for="days" class="form-label">
                                                                    <span class="text-danger"></span>Nombre des jours
                                                                    prestés
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="off_days" name="off_days"
                                                                    value="<?= ($payment['payment_off_days']) ? ($payment['payment_off_days']):old('off_days'); ?>"
                                                                    placeholder="Ex: 5">
                                                                <label for="off_days" class="form-label">
                                                                    <span class="text-danger"></span>Nombre des jours
                                                                    d'absences
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="hospital_days" name="hospital_days"
                                                                    value="<?= ($payment['payment_hospital_days']) ? ($payment['payment_hospital_days']):old('hospital_days'); ?>"
                                                                    placeholder="Ex: 5">
                                                                <label for="hospital_days" class="form-label">
                                                                    <span class="text-danger"></span>Nombre des jours
                                                                    congés maladies
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="leave_days" name="leave_days"
                                                                    value="<?= ($payment['payment_leave_days']) ? ($payment['payment_leave_days']):old('leave_days'); ?>"
                                                                    placeholder="Ex: 5">
                                                                <label for="leave_days" class="form-label">
                                                                    <span class="text-danger"></span>Nombre des jours
                                                                    congés annuels
                                                                </label>
                                                            </div>
                                                        </div>

                                                        
                                                       
                                                        <div class=" col-sm-12 col-lg-12">
                                                            <div class="form-floating mb-2">
                                                                <textarea class="form-control" id="notes" name="notes"
                                                                    placeholder="Ex:Notes"
                                                                    rows="3"><?= ($payment['payment_notes']) ? ($payment['payment_notes']):old('notes'); ?></textarea>
                                                                <label for="notes" class="form-label"><span
                                                                        class="text-danger"></span>Notes d'observation</label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-check-circle"></i> Valider les
                                                        modifications</button>

                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">
                                                        <i class="fas fa-window-close"></i> Fermer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning text-center">
                        <h5><i class="icon fas fa-info-circle"></i> Aucun paiement salaire trouvé de ce mois-ci!</h5>
                        Veuillez créer un nouveau paiement du mois encours pour commencer.
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<!-- modal -->
<div class="modal modal-end" tabindex="-1" id="addCategoryOffcanvas" aria-labelledby="addCategoryOffcanvasLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="font-weight-bold text-uppercase" id="addCategoryOffcanvasLabel">
                    Création d'un nouveau paiement salaire agent
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('worker/payment/create'); ?>" method="post" class="">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select class="form-select form-control" id="workercreate" name="worker" required>
                                    <option selected disabled>--Choisissez un agent</option>
                                    <?php if (isset($workers) && !empty($workers)): ?>
                                    <?php foreach ($workers as $worker): ?>
                                    <option value="<?= $worker['contract_uid'] ?>"
                                        <?= set_select('worker', esc($worker['contract_uid'])); ?>>
                                        <?= htmlspecialchars($worker['agent_firstname'] . ' ' . $worker['agent_lastname']); ?>
                                        <?= htmlspecialchars($worker['agent_surname']); ?>
                                        [<?= htmlspecialchars($worker['agent_code']); ?>]
                                        |
                                        <?= htmlspecialchars($worker['category_name']); ?>
                                        | Salaire mensuel:
                                        <?= number_format($worker['category_cost_salary'], 2, ',', ' ') ?>
                                        <?= strtoupper($worker['category_currency']); ?></option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="workercreate" class="form-label">
                                    <span class="text-danger">*</span>Agent à payer
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="month" name="month" required>
                                    <option selected disabled>--Choisissez un mois</option>
                                    <?php foreach (monthYearly() as $month => $label): ?>
                                    <option value="<?= htmlspecialchars($month); ?>"
                                        <?= set_select('month', $month); ?>>
                                        <?= htmlspecialchars($label); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="month" class="form-label">
                                    <span class="text-danger">*</span>Mois à payer</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    value="<?= old('amount'); ?>" placeholder="Ex: 100 000">
                                <label for="amount" class="form-label">
                                    <span class="text-danger"></span>Montant à payer(Si pas defini dans la catégorie)
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="bonus" name="bonus"
                                    value="<?= old('bonus'); ?>" placeholder="Ex: 100 000">
                                <label for="bonus" class="form-label">
                                    <span class="text-danger"></span>Primes et Gratifications (optionnelle)
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="days" name="days"
                                    value="<?= old('days'); ?>" placeholder="Ex: 26">
                                <label for="days" class="form-label">
                                    <span class="text-danger"></span>Nombre des jours prestés
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="off_days" name="off_days"
                                    value="<?= old('off_days'); ?>" placeholder="Ex: 3">
                                <label for="off_days" class="form-label">
                                    <span class="text-danger"></span>Nombre des jours
                                    d'absences
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="hospital_days"
                                    name="hospital_days" value="<?= old('hospital_days'); ?>" placeholder="Ex: 5">
                                <label for="hospital_days" class="form-label">
                                    <span class="text-danger"></span>Nombre des jours
                                    congés maladies
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="leave_days" name="leave_days"
                                    value="<?= old('leave_days'); ?>" placeholder="Ex: 18">
                                <label for="leave_days" class="form-label">
                                    <span class="text-danger"></span>Nombre des jours
                                    congés annuels
                                </label>
                            </div>
                        </div>
                        
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="notes" name="notes"
                                    placeholder="Ex: Notes supplementaires" rows="3"><?= old('notes'); ?></textarea>
                                <label for="notes" class="form-label"><span class="text-danger"></span>
                                    Observation</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Valider le paiement salaire
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal -->