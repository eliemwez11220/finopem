<div class="content-wrapper <?= checkModuleAccess('contracts'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Contrats de Travail</h1>

                </div>
                <div class="col-12 col-lg-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Travailleurs</li>
                            <li class="breadcrumb-item active" aria-current="page">Contrats Travail</li>
                        </ol>
                    </nav>
                    <p class="float-start float-lg-end">

                        <!-- Button to trigger the offcanvas -->
                        <a href="<?= base_url('worker/create/contract'); ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Ajouter un nouveau contrat
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($contracts) && (!empty($contracts))): ?>
        <?php
        $totalContracts = count($contracts);
        $activeContracts = count(array_filter($contracts, function ($contract) {
            return strtolower($contract['contract_status']) === 'actif';
        }));
        $expiredContracts = count(array_filter($contracts, function ($contract) {
            return strtolower($contract['contract_status']) === 'expire';
        }));
        $cancelledContracts = count(array_filter($contracts, function ($contract) {
            return strtolower($contract['contract_status']) === 'cancel';
        }));
        $averageSalary = $totalContracts > 0 ? array_sum(array_column($contracts, 'category_cost_salary')) / $totalContracts : 0;
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Contrats</h6>
                                <h3><?= $totalContracts ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Contrats Actifs</h6>
                                <h3><?= $activeContracts ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Contrats Expirés</h6>
                                <h3><?= $expiredContracts ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Annulés</h6>
                                <h3><?= $cancelledContracts; ?> </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Salaire Moyen</h6>
                                <h3><?= number_format($averageSalary, 2, ',', ' ') ?> </h3>
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
                                    <th>Contrat ID</th>
                                    <th>Travailleur</th>
                                    <th>Catégorie</th>
                                    <th>Téléphone</th>
                                    <th>Salaire</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($contracts as $contract):
                                    $worker_name = $contract['agent_firstname'] . ' ' . $contract['agent_lastname'] . ' ' . $contract['agent_surname'];
                                    //$position = isset($contract['fonction_name']) ? $contract['fonction_name'] : 'N/A';
                                ?>
                                    <tr class="small">
                                        <td>
                                            <span class="font-weight-bold" >
                                                <?= htmlspecialchars($contract['contract_code']) ?>
                                            </span>
                                        </td>
                                        <td class="text-uppercase">
                                            <a href="<?= base_url('worker/agent/' . $contract['agent_uid']); ?>"
                                                class="text-primary font-weight-bold">
                                                <span class="small font-weight-bold"><?= htmlspecialchars($worker_name) ?></span>
                                            </a>
                                        </td>
                                        <td><?= htmlspecialchars($contract['category_name']); ?></td>
                                        <td><?= htmlspecialchars($contract['contract_phone_service']); ?></td>
                                        <td><?= number_format($contract['category_cost_salary'], 2, ',', ' ') ?></td>
                                        <td class="text-capitalize"><?= htmlspecialchars($contract['contract_type']) ?></td>
                                        <td class="text-capitalize">
                                            <span class="badge bg-<?= setStatusColors($contract['contract_status']); ?>">
                                                <?= getStatusValues($contract['contract_status']) ?>
                                            </span>
                                        </td>


                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#contractDetailsModal<?= $contract['contract_uid'] ?>">
                                                <i class="fas fa-eye"></i> Détails
                                            </button>
                                            <a href="<?= base_url('worker/remove/contract/' . $contract['contract_uid']); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?');"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer ce contrat">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="<?= base_url('worker/update/contract/' . $contract['contract_uid']); ?>"
                                                        class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="contractDetailsModal<?= $contract['contract_uid'] ?>"
                                        tabindex="-1"
                                        aria-labelledby="contractDetailsModalLabel<?= $contract['contract_uid'] ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title font-weight-bold"
                                                        id="contractDetailsModalLabel<?= $contract['contract_uid'] ?>">
                                                        Détails Contrat du Travailleur <?= htmlspecialchars($worker_name) ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="py-3">
                                                        <li><strong>Contrat ID:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($contract['contract_code']) ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <strong>Travailleur:</strong>
                                                            <a href="<?= base_url('worker/agent/' . $contract['agent_uid']); ?>"
                                                                class="text-decoration-none">
                                                                <span class="badge bg-primary">
                                                                    <?= htmlspecialchars($worker_name) ?>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <strong>Date de Début:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($contract['contract_start_date']) ?>
                                                            </span>

                                                        </li>
                                                        <li>
                                                            <strong>Date de Fin:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($contract['contract_end_date']) ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <strong>Salaire Mensuel:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= number_format($contract['contract_salary'], 2, ',', ' ') ?>
                                                            </span>

                                                        </li>
                                                        <li>
                                                            <strong>Salaire journalier:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= number_format($contract['category_cost_day'], 2, ',', ' ') ?>
                                                            </span>

                                                        </li>
                                                        <li>
                                                            <strong>Salaire de base Catégorie:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= number_format($contract['category_cost_salary'], 2, ',', ' ') ?>
                                                            </span>

                                                        </li>
                                                        <li>
                                                            <strong>Catégorie:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= esc($contract['category_name']) ?>
                                                            </span>

                                                        </li>
                                                        <li>
                                                            <strong>Type de Catégorie:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= esc($contract['category_type']) ?>
                                                            </span>

                                                        </li>
                                                        <li>
                                                            <strong>Type de contrat:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($contract['contract_type']) ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <strong>Date de signature du contrat:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($contract['contract_date']) ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <strong>Lieu de signature du contrat:</strong>
                                                            <span class="badge bg-primary">
                                                                <?= htmlspecialchars($contract['contract_place']) ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <strong>Statut:</strong>
                                                            <span
                                                                class="badge bg-<?= setStatusColors($contract['contract_status']); ?>">
                                                                <?= getStatusValues($contract['contract_status']) ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <strong>Description:</strong>
                                                            <span class="badge bg-primary">

                                                                <?= htmlspecialchars($contract['contract_notes'] ?? 'N/A') ?>
                                                            </span>

                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">

                                                    <a href="<?= base_url('worker/update/contract/' . $contract['contract_uid']); ?>"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Modifier contrat</a>
                                                    <a href="<?= base_url('worker/cancel/contract/' . $contract['contract_uid']); ?>"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir annuler ce contrat ?');">
                                                        <i class="fas fa-x-circle"></i> Annuler contrat</a>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">
                                                        <i class="fas fa-x"></i> Fermer</button>
                                                </div>
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
    <?php endif; ?>
</div>