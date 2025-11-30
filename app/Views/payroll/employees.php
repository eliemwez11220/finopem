<div class="content-wrapper <?= checkModuleAccess('employees'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 order-md-1 order-last">
                    <h1>Dossiers employés</h1>
                    <p class="text-subtitle text-primary fw-bold">
                        Toute personne liée par un contrat de travail salarié à un employeur.
                        Il s'agit d'un travailleur salarié non indépendant.
                    </p>
                </div>
                <div class="col-12 col-lg-4 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Travailleurs</li>
                            <li class="breadcrumb-item active" aria-current="page">Employés</li>
                        </ol>
                    </nav>
                    <p class="float-start float-lg-end">
                        <a href="<?= base_url('worker/create'); ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle"></i> Ajouter un nouvel agent
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="datatablesExample2">
                        <thead>
                            <tr>
                                <th>Matricule</th>
                                <th>Noms</th>
                                <th>Sexe</th>
                                <th>Contacts</th>
                                <th>Etat-civil</th>
                                <th>Profession</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($agents) && (! empty($agents))): ?>
                            <?php foreach($agents as $agent): ?>
                            <tr>
                                <td><?= $agent['agent_code']; ?></td>
                                <td class="text-uppercase small fw-bold">
                                    <?= $agent['agent_firstname'].' '.$agent['agent_lastname']; ?>
                                </td>
                                <td class="text-capitalize"><?= $agent['agent_gender']; ?></td>
                                <td class="text-uppercase"><?= $agent['agent_phone']; ?></td>
                                <td class="text-capitalize"><?= getMaritalStatus($agent['agent_civility_status']); ?>
                                </td>
                                <td class="text-capitalize"><?= $agent['agent_title']; ?></td>
                                <td class="text-capitalize">
                                    <span class="badge bg-success"><?= $agent['agent_status']; ?></span>
                                </td>

                                <td>
                                    <a href="<?= base_url('worker/agent/'.$agent['agent_uid']); ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                    <a href="<?= base_url('worker/remove/agent/'.$agent['agent_uid']); ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">
                                        <i class="bi bi-trash"></i> Supprimer
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