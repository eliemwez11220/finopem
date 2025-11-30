<div class="page-heading">
    <div class="page-title">
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
                $averageSalary = $totalContracts > 0 ? array_sum(array_column($contracts, 'contract_salary')) / $totalContracts : 0;
                ?>
        <section class="section">
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
        </section>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Contrat ID</th>
                            <th>Travailleur</th>
                            <th>Poste</th>
                            <th>Catégorie</th>
                            <th>Salaire</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($contracts as $contract): 
                $worker_name = $contract['agent_firstname'] .' '.$contract['agent_lastname'].' '.$contract['agent_surname'];
                $position = isset($contract['fonction_name']) ? $contract['fonction_name'] : 'N/A';
                ?>
                        <tr class="small">
                            <td>
                                <button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#contractDetailsModal<?= $contract['contract_uid'] ?>">
                                    <?= htmlspecialchars($contract['contract_code']) ?>
                                </button>
                            </td>
                            <td class="text-uppercase">
                                <a href="<?= base_url('worker/agent/'.$contract['agent_uid']); ?>" class="btn btn-default btn-sm" >
                                    <span class="small"><?= htmlspecialchars($worker_name) ?></span>
                                </a>
                            </td>
                            <td class="text-capitalize"><?= htmlspecialchars($position) ?></td>
                            <td class="text-capitalize"><?= htmlspecialchars($contract['category_name']) ?></td>
                         
                            <td><?= number_format($contract['contract_salary'], 2, ',', ' ') ?></td>
                            <td class="text-capitalize"><?= htmlspecialchars($contract['contract_type']) ?></td>
                            <td class="text-capitalize">
                                <span class="badge bg-<?= setStatusColors($contract['contract_status']); ?>">
                                    <?= getStatusValues($contract['contract_status']) ?>
                                </span>
                            </td>


                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#contractDetailsModal<?= $contract['contract_uid'] ?>">
                                    <i class="bi bi-eye"></i> Détails
                                </button>
                                <a href="<?= base_url('worker/remove/contract/'.$contract['contract_uid']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?');"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer ce contrat">
                                    <i class="bi bi-trash"></i>
                                </a>
                                
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="contractDetailsModal<?= $contract['contract_uid'] ?>" tabindex="-1"
                            aria-labelledby="contractDetailsModalLabel<?= $contract['contract_uid'] ?>"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="contractDetailsModalLabel<?= $contract['contract_uid'] ?>">
                                            Détails Contrat du Travailleur <?= htmlspecialchars($worker_name) ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
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
                                                <a href="<?= base_url('worker/agent/'.$contract['agent_uid']); ?>" class="text-decoration-none">
                                                <span class="badge bg-primary">
                                                    <?= htmlspecialchars($worker_name) ?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li><strong>Poste:</strong> 
                                                <span class="badge bg-primary">
                                                    <?= htmlspecialchars($position) ?>
                                                </span>
                                            </li>
                                            <li>
                                                <strong>Catégorie:</strong> 
                                                <span class="badge bg-primary">
                                                    <?= htmlspecialchars($contract['category_name']) ?>
                                                </span>

                                            </li>
                                            <li>
                                                <strong>Service:</strong>
                                                <span class="badge bg-primary">
                                                    <?= htmlspecialchars($contract['service_name']) ?>
                                                </span>
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
                                                <strong>Salaire:</strong>
                                                <span class="badge bg-primary">
                                                    <?= number_format($contract['contract_salary'], 2, ',', ' ') ?>
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
                                            </li> <li>
                                                <strong>Lieu de signature du contrat:</strong>
                                                <span class="badge bg-primary">
                                                    <?= htmlspecialchars($contract['contract_place']) ?>
                                                </span>
                                            </li>
                                            <li>
                                                <strong>Statut:</strong>
                                                <span class="badge bg-<?= setStatusColors($contract['contract_status']); ?>">
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
                                       
                                        <a href="<?= base_url('worker/update/contract/'.$contract['contract_uid']); ?>"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i> Modifier contrat</a>
                                        <a href="<?= base_url('worker/cancel/contract/'.$contract['contract_uid']); ?>"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir annuler ce contrat ?');">
                                            <i class="bi bi-x-circle"></i> Annuler contrat</a>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="bi bi-x"></i> Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>