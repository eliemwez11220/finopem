<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Gestion paiement Salaires</h1>
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

    <?php if (isset($payments) && !empty($payments)): ?>
       
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary text-uppercase">
                    <h1 class="font-weight-bold">Paiement Salaire Mensuel des agents</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="datatablesExample2">
                        <thead>
                            <tr>
                                <th>Demande ID</th>
                                <th>Travailleur</th>
                                <th>Catégorie</th>
                                <th>Mois</th>
                                <th>Montant</th>
                                <th>Motif</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($payments as $payment):
                                    $worker_name = $payment['agent_firstname'] . ' ' . $payment['agent_lastname'] . ' ' . $payment['agent_surname'];
                                    $payment_salary = floatval($payment['category_cost_day']) * intval($payment['payment_work_days']);
                                    $payment_amount = $payment_salary + floatval($payment['payment_amount_bonus']);
                                ?>
                            <tr class="small">
                                <td>
                                    <span class="text-primary font-weight-bold">
                                        <?= htmlspecialchars($payment['payment_code']) ?>
                                    </span>
                                </td>
                                <td class="text-uppercase">
                                    <a href="<?= base_url('worker/agent/' . $payment['agent_uid']); ?>"
                                        class="btn btn-default btn-sm">
                                        <span class="small"><?= htmlspecialchars($worker_name) ?></span>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($payment['category_name']); ?></td>
                                <td><?= monthYearly($payment['payment_period']) ?></td>
                                <td><?= number_format($payment_amount, 2, ',', ' ') ?></td>
                                <td class="text-capitalize"><?= htmlspecialchars($payment['payment_notes']) ?></td>
                                <td class="text-capitalize">
                                    <span class="badge bg-<?= setStatusColors($payment['payment_status']); ?>">
                                        <?= getStatusValues($payment['payment_status']) ?>
                                    </span>
                                </td>


                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#paymentDetailsModal<?= $payment['payment_uid'] ?>">
                                        <i class="fas fa-eye"></i> Détails
                                    </button>
                                    <a href="<?= base_url('worker/remove/payment/' . $payment['payment_uid']); ?>"
                                        class="btn btn-danger btn-sm <?= ($payment['payment_status'] != 'cancel') ? 'disabled':'' ?>"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Supprimer cette demande">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <button type="button"
                                        class="<?= ($payment['payment_status'] != 'pending') ? 'disabled':'' ?> btn btn-outline-primary btn-sm"
                                        data-toggle="modal"
                                        data-target="#paymentUpdateModal<?= $payment['payment_uid'] ?>">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                </td>
                            </tr>


                            <!-- Modal DETAILS-->
                            <div class="modal fade" id="paymentDetailsModal<?= $payment['payment_uid'] ?>" tabindex="-1"
                                aria-labelledby="paymentDetailsModalLabel<?= $payment['payment_uid'] ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title font-weight-bold"
                                                id="paymentDetailsModalLabel<?= $payment['payment_uid'] ?>">
                                                Détails Paiement du Travailleur <?= htmlspecialchars($worker_name) ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                <i class="fas fa-edit"></i> Accepter la demande</a>

                                            <a href="<?= base_url('worker/payment/reject/' . $payment['payment_uid']); ?>"
                                                class="btn btn-outline-warning btn-sm <?= ($payment['payment_status'] == 'pending') ? '':'disabled' ?>"
                                                onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?');">
                                                <i class="fas fa-window-close"></i> Rejeter la demande</a>

                                            <a href="<?= base_url('worker/payment/cancel/' . $payment['payment_uid']); ?>"
                                                class="btn btn-outline-danger btn-sm <?= ($payment['payment_status'] == 'cancel') ? 'disabled':'' ?>"
                                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?');">
                                                <i class="fas fa-window-close"></i> Annuler la demande</a>

                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                <i class="fas fa-x"></i> Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal DETAILS-->
                            <div class="modal fade" id="paymentUpdateModal<?= $payment['payment_uid'] ?>" tabindex="-1"
                                aria-labelledby="paymentUpdateModalLabel<?= $payment['payment_uid'] ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title font-weight-bold"
                                                id="paymentUpdateModalLabel<?= $payment['payment_uid'] ?>">
                                                Modification Demande du Travailleur
                                                <?= htmlspecialchars($worker_name) ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                <option selected disabled>--Choisissez un agent</option>
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
                                                                <span class="text-danger">*</span>Agent qui sollicite
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class=" col-sm-12 col-lg-12">
                                                        <div class="form-floating mb-2">
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="amount" name="amount"
                                                                value="<?= ($payment['payment_amount']) ? ($payment['payment_amount']): old('amount'); ?>"
                                                                placeholder="Ex: 100 000" required>
                                                            <label for="amount" class="form-label"><span
                                                                    class="text-danger">*</span>Montant
                                                                sollicité</label>
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-12 col-lg-12">
                                                        <div class="form-floating mb-2">
                                                            <select class="form-control form-select" id="status"
                                                                name="status" required>
                                                                <option value="pending"
                                                                    <?= ($payment['payment_status'] == 'pending') ? 'selected':''; ?>>
                                                                    Demande En attente</option>
                                                                <option value="actif"
                                                                    <?= ($payment['payment_status'] == 'actif') ? 'selected':''; ?>>
                                                                    Demande Approuvée</option>
                                                                <option value="inactif"
                                                                    <?= ($payment['payment_status'] == 'inactif') ? 'selected':''; ?>>
                                                                    Demande Rejetée</option>
                                                                <option value="cancel"
                                                                    <?= ($payment['payment_status'] == 'cancel') ? 'selected':''; ?>>
                                                                    Demande Annulée</option>
                                                            </select>
                                                            <label for="status" class="form-label"><span
                                                                    class="text-danger">*</span>Statut de la
                                                                demande</label>
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-12 col-lg-12">
                                                        <div class="form-floating mb-2">
                                                            <textarea class="form-control" id="notes" name="notes"
                                                                placeholder="Ex: Decrivez cette demande" rows="3"
                                                                required><?= ($payment['payment_notes']) ? ($payment['payment_notes']):old('notes'); ?></textarea>
                                                            <label for="notes" class="form-label"><span
                                                                    class="text-danger">*</span>Motif
                                                                demande</label>
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
    </section>
    <?php else: ?>
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info text-center">
                <h5><i class="icon fas fa-info-circle"></i> Aucun paiement salaire trouvé !</h5>
                Veuillez créer un nouveau paiement pour commencer.
            </div>
        </div>
    </section>
    <?php endif; ?>
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
                                <select class="form-select form-control" id="worker" name="worker" required>
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
                                    | Salaire journalier: <?= number_format($worker['category_cost_salary'], 2, ',', ' ') ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="worker" class="form-label">
                                    <span class="text-danger">*</span>Agent à payer
                                </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="month" name="month" required>
                                    <option selected disabled>--Choisissez un mois</option>
                                    <?php foreach (monthYearly() as $month => $label): ?>
                                        <option value="<?= htmlspecialchars($month); ?>" <?= set_select('month', $month); ?>>
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
                                <input type="number" step="0.01" class="form-control" id="days" name="days"
                                    value="<?= old('days'); ?>" placeholder="Ex: 100 000" required>
                                <label for="days" class="form-label">
                                    <span class="text-danger">*</span>Nombre des jours prestés</label>
                            </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    value="<?= old('amount'); ?>" placeholder="Ex: 100 000">
                                <label for="amount" class="form-label">
                                    <span class="text-danger"></span>Montant à payer(Si pas defini dans la catégorie)
                                </label>
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
                            </label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="notes" name="notes"
                                    placeholder="Ex: Notes supplementaires" rows="3"
                                    required><?= old('notes'); ?></textarea>
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