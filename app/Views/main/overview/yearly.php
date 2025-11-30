<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Basculement des Années</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Années</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <div class="text-center">
                                <h1 class="text-uppercase font-weight-bold">
                                    Les années Académiques 
                                </h1>
                                <p>
                                    Pour basculer d'une année a une autre, veuillez cliquer sur le statut de l'année que vous désirez consulter
                                </p>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                       class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                    <tr class="text-uppercase text-center">
                                        <th>#</th>
                                        <th>Année d'étude</th>
                                        <th>Année Début</th>
                                        <th>Année Fin</th>
                                        <th>Statut</th>
                                        <th>Ouverture</th>
                                        <th>Femeture</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $count = 1;
                                    if (isset($years) && !empty($years)):
                                        foreach ($years as $key => $value):
                                            $status = (!empty(($value['year_status'])) ? ($value['year_status']) : 'inactif');
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $count++; ?></td>
                                                <td><?= esc($value['year_started']); ?>-<?= esc($value['year_ended']); ?></td>
                                                <td class="text-uppercase"><?= ($value['year_started']); ?></td>
                                                <td class="text-uppercase"><?= ($value['year_ended']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('yearly/'.$status.'/'. esc($value['year_token'])); ?>"
                                                       onclick="return confirm('Voulez-vous vraiment basculer vers cette année scolaire?');">
                                                        <span class="badge  <?= (($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                            <?= ($status == 'actif') ? 'Ouverte' : 'Fermée'; ?> </span>
                                                    </a>
                                                </td>
                                                <td class="text-uppercase"><?= esc($value['year_start_date']); ?></td>
                                                <td class="text-uppercase"><?= esc($value['year_close_date']); ?></td>
                                               
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
