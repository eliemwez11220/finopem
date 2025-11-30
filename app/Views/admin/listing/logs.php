<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">
                                Journal des accès au système
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('overview/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('admin/view/users') ?>">
                                        Administration</a>
                                </li>
                                <li class="breadcrumb-item active">Journalisation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        
        <section class="content">
        
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped" id="datatablesExample2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date journal</th>
                                <th>Agent</th>
                                <th>Opération</th>
                                <th>IPAdresse</th>
                                <th>Description</th>
                                <th class="text-end">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;
                            if (isset($userslogs) && (!empty($userslogs))):
                                foreach ($userslogs as $key => $log):
                                    $loguid = $log['log_id'];?>
                                        <tr class="small text-capitalize">
                                        <td><?= $count++; ?></td>
                                        <td><?= $log['log_created_at']; ?></td>
                                        <td><?= $log['user_firstname']; ?> <?= $log['user_lastname']; ?></td>
                                            
                                            <td class="text-capitalize"><?= $log['log_type']; ?></td>
                                            <td class="small"><?= $log['log_ipaddress']; ?></td>
                                            <td><?= $log['log_device']; ?> via <?= $log['log_platform']; ?></td>
                                            <td class="text-end">
                                                <a href="<?= base_url('admin/remove/log/' . $loguid); ?>"
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Supprimer ce journal?');">
                                                    <i class="fas fa-trash"></i>
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
        </section>
    </div>
</div>