<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h1>
                        Détails Pointage travailleur
                    </h1>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                          
                            <li class="breadcrumb-item active" aria-current="page">Pointages</li>
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary btn-sm" href="<?= base_url('payroll/attendances'); ?>">
                                    <i class="fas fa-reply"></i>
                                    Revenir au pointage
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="btn btn-success btn-sm" onclick="window.print();">
                                    <i class="fas fa-print"></i> Imprimer journal
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($worker) && (!empty($worker))): ?>
    <section class="content">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <h1 class="text-uppercase fw-bold text-primary py-3">
                            <?= $worker['agent_firstname'].' '.$worker['agent_lastname']; ?>

                            <span class="text-danger">
                                [<?= getWorkerTypes($worker['agent_type']); ?>]
                            </span>
                        </h1>
                        <div class="row">
                            <div class="col-12 col-lg-12 col-sm-12">
                                <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                                    <div class="app-card-header p-3 border-bottom-0 text-center">
                                        <div class="row text-center">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="text-center">
                                                    <img src="<?= base_url('uploadShowFile/' . $worker['agent_picture']); ?>"
                                                        alt="..." class="avatar avatar-big" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="app-card-body px-4 w-100">
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Nom</strong></div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_firstname']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Postnom</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_lastname']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Prénom</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_surname']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Numéro Matricule</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_code']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Sexe</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_gender']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Email</strong></div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary">
                                                        <?= $worker['agent_email']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Téléphone</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="text-primary fw-bold">
                                                        <?= $worker['agent_phone']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Profession</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_title']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label"><strong>Numéro sécurité sociale</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_social_number']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Nombre d'enfants</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_childrens']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Nombre des personnes à
                                                            charge</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_family_number']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Etat civil</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= getMaritalStatus($worker['agent_civility_status']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item border-bottom py-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <div class="item-label mb-2"><strong>Nom du partenaire</strong>
                                                    </div>
                                                </div>
                                                <div class="col text-right float-right ">
                                                    <span class="fw-bold text-primary text-uppercase">
                                                        <?= $worker['agent_partner_name']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">

                    <div class="row">
                        <div class="col-12">
                            <div class="text-center py-3">
                                <h3 class="font-weight-bold text-uppercase">Pointages de prestations</h3>
                            </div>
                            <?php if (isset($attendances) && !empty($attendances)) : ?>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="card">
                                        <div class="card-footer text-uppercase text-center">
                                            <!-- Statistiques sur le pointage de l'agent -->
                                            <h5>Pointages:
                                                <span class="badge badge-primary">
                                                    <?= count($attendances); ?>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="card">
                                        <div class="card-footer text-uppercase text-center">
                                            <!-- Statistiques sur le pointage de l'agent -->
                                            <h5>Presences:
                                                <span class="badge badge-success">
                                                    <?= countAttendanceStatus($attendances, 'P'); ?>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="card">
                                        <div class="card-footer text-uppercase text-center">
                                            <!-- Statistiques sur le pointage de l'agent -->
                                            <h5>Absences:
                                                <span class="badge badge-danger">
                                                    <?= countAttendanceStatus($attendances, 'A'); ?>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="card">
                                        <div class="card-footer text-uppercase text-center">
                                            <!-- Statistiques sur le pointage de l'agent -->
                                            <h5>Maladie:
                                                <span class="badge badge-warning">
                                                    <?= countAttendanceStatus($attendances, 'M'); ?>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="card">
                                        <div class="card-footer text-uppercase text-center">
                                            <!-- Statistiques sur le pointage de l'agent -->
                                            <h5>Congés annuel:
                                                <span class="badge badge-warning">
                                                    <?= countAttendanceStatus($attendances, 'L'); ?>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="card">
                                        <div class="card-footer text-uppercase text-center">
                                            <!-- Statistiques sur le pointage de l'agent -->
                                            <h5>Heures supp:
                                                <span class="badge badge-warning">
                                                    <?php 
                                                    $hours130 = countAttendanceStatus($attendances, '130',1); 
                                                    $hours160 = countAttendanceStatus($attendances, '160',1); 
                                                    $hours200 = countAttendanceStatus($attendances, '200',1); 
                                                    $overtime = $hours130 + $hours160 + $hours200;
                                                    ?>
                                                    <?= $overtime; ?>
                                                </span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="datatablesExample2">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Heure d'arrivée</th>
                                            <th>Heure de départ</th>
                                            <th>Nombre heures</th>
                                            <th>Statut</th>
                                            <th>Notes</th>
                                            <th class="printoff">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $count = 1; ?>
                                        <?php foreach ($attendances as $attendance) : 
                                            $total_hours= '';
                                            if($attendance['attendance_type'] == 'exit'){
                                                $in_time = new DateTime($attendance['attendance_in_time']);
                                                $out_time = new DateTime($attendance['attendance_out_time']);
                                                $interval = $in_time->diff($out_time);
                                                $total_hours = $interval->format('%h:%i');
                                            } else {
                                                $total_hours = $attendance['attendance_hours'];
                                            }
                                            ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($attendance['attendance_date'])); ?></td>
                                            <td>
                                                <span class="<?= ($attendance['attendance_type'] == 'overtime') ? 'd-none' : ''; ?>">
                                                    <?= date('H:i', strtotime($attendance['attendance_in_time'])); ?>
                                                </span>
                                            </td>
                                            <td>
                                            <span class="<?= ($attendance['attendance_type'] == 'overtime') ? 'd-none' : ''; ?>">
                                                <?= ($attendance['attendance_type'] == 'exit') ? date('H:i', strtotime($attendance['attendance_out_time'])):'N/A'; ?>
                                             </span>
                                                </td>
                                            <td class="text-center">
                                                <?= $total_hours; ?>
                                            </td>
                                            <td>
                                                <?php if ($attendance['attendance_status'] == 'P') : ?>
                                                <span class="badge badge-success">Présent</span>
                                                <?php elseif ($attendance['attendance_status'] == 'A') : ?>
                                                <span class="badge badge-danger">Absent</span>
                                                <?php else : ?>
                                                <span class="badge badge-secondary <?= ($attendance['attendance_type'] == 'overtime') ? 'd-none' : ''; ?>">
                                                    <?= htmlspecialchars($attendance['attendance_status']); ?>
                                                </span>
                                                <span class="badge badge-secondary <?= ($attendance['attendance_type'] == 'overtime') ? '' : 'd-none'; ?>">
                                                    <?= ($attendance['attendance_status'] == 'nuit') ? 'Heures de nuit':'Heures supp '.$attendance['attendance_status'].'%'; ?>  
                                                </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="">
                                                <?= $attendance['attendance_notes']; ?>
                                            </td>
                                            <td class="printoff">
                                                <a href="<?= base_url('worker/remove/attendances/'.$attendance['attendance_token']); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce pointage?');">
                                                    <i class="fas fa-window-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                            <?php else : ?>
                            <div class="text-center alert alert-warning">
                                <h3>Aucun pointage trouvé.</h3>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php else: ?>
    <div class="alert alert-danger">
        <strong>Erreur!</strong> Aucun dossier trouvé.
    </div>
    <?php endif;?>
</div>