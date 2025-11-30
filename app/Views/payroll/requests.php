<div class="content-wrapper <?= checkModuleAccess('requests'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Gestion demandes d'avances sur Salaire</h1>

                </div>
                <div class="col-12 col-lg-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestion de la paie</li>
                            <li class="breadcrumb-item active" aria-current="page">Avances sur salaire</li>
                        </ol>
                    </nav>
                    <p class="float-right">

                        <!-- Button to trigger the offcanvas -->
                        <a href="#" data-toggle="modal" data-target="#addCategoryOffcanvas"
                            aria-controls="addCategoryOffcanvas" title="Ajouter cette catégorie"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Nouvelle demande
                        </a>
                    </p>
                </div>
            </div>
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
                                        <?php if (isset($requests) && !empty($requests)): ?>
                                        <?php foreach ($requests as $agent): ?>
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
        </div>
    </div>

    <?php if (isset($requests) && (!empty($requests))): ?>
    <?php
        $totalContracts = count($requests);
        $pendingContracts = count(array_filter($requests, function ($request) {
            return strtolower($request['request_status']) === 'pending';
        }));
        $activeContracts = count(array_filter($requests, function ($request) {
            return strtolower($request['request_status']) === 'validated' || strtolower($request['request_status']) === 'actif';
        }));
        $expiredContracts = count(array_filter($requests, function ($request) {
            return strtolower($request['request_status']) === 'rejected' || strtolower($request['request_status']) === 'inactif'; 
        }));
        $cancelledContracts = count(array_filter($requests, function ($request) {
            return strtolower($request['request_status']) === 'cancel';
        }));
        
        $totalAmountGranted = array_reduce($requests, function ($carry, $request) {
            if (strtolower($request['request_status']) === 'validated' || strtolower($request['request_status']) === 'actif') {
                //if ($request['request_period'] == date('m')) {
                    $carry += $request['request_amount'];
                //}
            }
            return $carry;
        }, 0);
        ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="card bg-primary">
                        <div class="card-body text-center">
                            <h6>Total</h6>
                            <h3><?= $totalContracts ?> </h3>
                            <small>Demandes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="card bg-dark">
                        <div class="card-body text-center">
                            <h6>En attente</h6>
                            <h3><?= $pendingContracts ?> </h3>
                            <small>Demandes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="card bg-success">
                        <div class="card-body text-center">
                            <h6>Accordées</h6>
                            <h3><?= $activeContracts ?></h3>
                            <small>Demandes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="card bg-warning">
                        <div class="card-body text-center">
                            <h6>Rejetées</h6>
                            <h3><?= $expiredContracts ?> </h3>
                            <small>Demandes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="card bg-danger">
                        <div class="card-body text-center">
                            <h6>Annulées</h6>
                            <h3><?= $cancelledContracts; ?> </h3>
                            <small>Demandes</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="card bg-primary">
                        <div class="card-body text-center">
                            <h6>Montant</h6>
                            <h3><?= number_format($totalAmountGranted, 0); ?> </h3>
                            <small>Accordé ce mois-ci</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
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

                            <?php foreach ($requests as $request):
                            if (isset($_GET['agent_filter']) && !empty($_GET['agent_filter']) && $_GET['agent_filter'] != $request['agent_code']) {
                                continue; // Skip payments that don't match the filter
                            }
                            if (isset($_GET['month']) && !empty($_GET['month']) && $_GET['month'] != $request['request_period']) {
                                continue; // Skip payments that don't match the filter
                            }
                                    $worker_name = $request['agent_firstname'] . ' ' . $request['agent_lastname'] . ' ' . $request['agent_surname'];
                                    //$position = isset($request['fonction_name']) ? $request['fonction_name'] : 'N/A';
                                ?>
                            <tr class="small">
                                <td>
                                    <span class="text-primary font-weight-bold">
                                        <?= htmlspecialchars($request['request_code']) ?>
                                    </span>
                                </td>
                                <td class="text-uppercase">
                                    <a href="<?= base_url('worker/agent/' . $request['agent_uid']); ?>"
                                        class="text-primary">
                                        <span class="small font-weight-bold"><?= htmlspecialchars($worker_name) ?></span>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($request['category_name']); ?></td>
                                <td><?= monthYearly($request['request_period']) ?></td>
                                <td><?= number_format($request['request_amount'], 2, ',', ' ') ?></td>
                                <td class="text-capitalize"><?= htmlspecialchars($request['request_notes']) ?></td>
                                <td class="text-capitalize">
                                    <span class="badge bg-<?= setStatusColors($request['request_status']); ?>">
                                        <?= getStatusValues($request['request_status']) ?>
                                    </span>
                                </td>


                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#requestDetailsModal<?= $request['request_uid'] ?>">
                                        <i class="fas fa-eye"></i> Détails
                                    </button>
                                    <a href="<?= base_url('worker/remove/request/' . $request['request_uid']); ?>"
                                        class="btn btn-danger btn-sm <?= ($request['request_status'] != 'cancel') ? 'disabled':'' ?>"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer cette demande">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <button type="button" class="<?= ($request['request_status'] != 'pending') ? 'disabled':'' ?> btn btn-outline-primary btn-sm" data-toggle="modal"
                                        data-target="#requestUpdateModal<?= $request['request_uid'] ?>">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal DETAILS-->
                            <div class="modal fade" id="requestDetailsModal<?= $request['request_uid'] ?>"
                                tabindex="-1"
                                aria-labelledby="requestDetailsModalLabel<?= $request['request_uid'] ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title font-weight-bold"
                                                id="requestDetailsModalLabel<?= $request['request_uid'] ?>">
                                                Détails Demande du Travailleur <?= htmlspecialchars($worker_name) ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="text-danger"><i
                                                        class="fa fa-window-close"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="py-3">
                                                <li><strong>Demande ID:</strong>
                                                    <span class="badge bg-primary">
                                                        <?= htmlspecialchars($request['request_code']) ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Travailleur:</strong>
                                                    <a href="<?= base_url('worker/agent/' . $request['agent_uid']); ?>"
                                                        class="text-decoration-none">
                                                        <span class="badge bg-primary">
                                                            <?= htmlspecialchars($worker_name) ?>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <strong>Mois demande:</strong>
                                                    <span class="badge bg-primary">
                                                        <?= monthYearly($request['request_period']) ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Date demande:</strong>
                                                    <span class="badge bg-primary">
                                                        <?= htmlspecialchars($request['request_date']) ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Montant avance:</strong>
                                                    <span class="badge bg-primary">
                                                        <?= number_format($request['request_amount'], 2, ',', ' ') ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Statut:</strong>
                                                    <span
                                                        class="badge bg-<?= setStatusColors($request['request_status']); ?>">
                                                        <?= getStatusValues($request['request_status']) ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <strong>Motif:</strong>
                                                    <span class="badge bg-primary">

                                                        <?= htmlspecialchars($request['request_notes'] ?? 'N/A') ?>
                                                    </span>

                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">

                                            <a href="<?= base_url('worker/request/validate/' . $request['request_uid']); ?>"
                                                class="btn btn-primary btn-sm <?= ($request['request_status'] == 'pending') ? '':'disabled' ?>">
                                                <i class="fas fa-edit"></i> Accepter la demande</a>

                                                <a href="<?= base_url('worker/request/reject/' . $request['request_uid']); ?>"
                                                class="btn btn-outline-warning btn-sm <?= ($request['request_status'] == 'pending') ? '':'disabled' ?>"
                                                onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?');">
                                                <i class="fas fa-window-close"></i> Rejeter la demande</a>

                                            <a href="<?= base_url('worker/request/cancel/' . $request['request_uid']); ?>"
                                                class="btn btn-outline-danger btn-sm <?= ($request['request_status'] == 'cancel') ? 'disabled':'' ?>"
                                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?');">
                                                <i class="fas fa-window-close"></i> Annuler la demande</a>

                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                <i class="fas fa-x"></i> Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal DETAILS-->
                            <div class="modal fade" id="requestUpdateModal<?= $request['request_uid'] ?>"
                                tabindex="-1"
                                aria-labelledby="requestUpdateModalLabel<?= $request['request_uid'] ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title font-weight-bold"
                                                id="requestUpdateModalLabel<?= $request['request_uid'] ?>">
                                                Modification Demande du Travailleur <?= htmlspecialchars($worker_name) ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="text-danger"><i
                                                        class="fa fa-window-close"></i></span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('worker/request/update/'.esc($request['request_uid'])); ?>" method="post" class="">
                    
                                        <div class="modal-body">
                                           

                                               
                                            <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select class="form-select form-control" id="worker" name="worker" required>
                                    <option selected disabled>--Choisissez un agent</option>
                                    <?php if (isset($workers) && !empty($workers)): ?>
                                    <?php foreach ($workers as $worker): ?>
                                    <option value="<?= $worker['contract_uid'] ?>"
                                        <?= ($worker['contract_uid'] == $request['request_agent_uid']) ? 'selected': set_select('worker', esc($worker['contract_uid'])); ?>>
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
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    value="<?= ($request['request_amount']) ? ($request['request_amount']): old('amount'); ?>" placeholder="Ex: 100 000" required>
                                <label for="amount" class="form-label"><span class="text-danger">*</span>Montant
                                    sollicité</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="month" name="month" required>
                                    <option selected disabled>--Choisissez un mois</option>
                                    <?php foreach (monthYearly() as $month => $label): ?>
                                    <option value="<?= htmlspecialchars($month); ?>"
                                        <?= ($month == $request['request_period']) ? 'selected':set_select('month', $month); ?>>
                                        <?= htmlspecialchars($label); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="month" class="form-label">
                                    <span class="text-danger">*</span>Mois à déduire</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="status" name="status" required>
                                    <option value="pending" <?= ($request['request_status'] == 'pending') ? 'selected':''; ?> >Demande En attente</option>
                                    <option value="actif" <?= ($request['request_status'] == 'actif') ? 'selected':''; ?>>Demande Approuvée</option>
                                    <option value="inactif" <?= ($request['request_status'] == 'inactif') ? 'selected':''; ?>>Demande Rejetée</option>
                                    <option value="cancel" <?= ($request['request_status'] == 'cancel') ? 'selected':''; ?>>Demande Annulée</option>
                                </select>
                                <label for="status" class="form-label"><span class="text-danger">*</span>Statut de la
                                    demande</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="notes" name="notes"
                                    placeholder="Ex: Decrivez cette demande" rows="3"
                                    required><?= ($request['request_notes']) ? ($request['request_notes']):old('notes'); ?></textarea>
                                <label for="notes" class="form-label"><span class="text-danger">*</span>Motif
                                    demande</label>
                            </div>
                        </div>

                    </div>
                
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check-circle"></i> Valider les modifications</button>
                                                
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
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
        </div>
    </section>
    <?php else: ?>
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-warning text-center">
                <h5><i class="icon fas fa-info-circle"></i> Aucune demande d'avance sur salaire trouvée pour ce mois-ci!</h5>
                Veuillez créer une nouvelle demande pour commencer.
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
                    Création d'une nouvelle demande d'avance sur salaire
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('worker/request/create'); ?>" method="post" class="">
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
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    value="<?= old('amount'); ?>" placeholder="Ex: 100 000" required>
                                <label for="amount" class="form-label"><span class="text-danger">*</span>Montant
                                    sollicité</label>
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
                                    <span class="text-danger">*</span>Mois à déduire</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="status" name="status" required>
                                    <option value="pending">Demande En attente</option>
                                    <option value="actif">Demande Approuvée</option>
                                    <option value="inactif">Demande Rejetée</option>
                                    <option value="cancel">Demande Annulée</option>
                                </select>
                                <label for="status" class="form-label"><span class="text-danger">*</span>Statut de la
                                    demande</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="notes" name="notes"
                                    placeholder="Ex: Decrivez cette demande" rows="3"
                                    required><?= old('notes'); ?></textarea>
                                <label for="notes" class="form-label"><span class="text-danger">*</span>Motif
                                    demande</label>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Soumettre la demande
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal -->

