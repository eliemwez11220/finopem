<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold text-capitalize">charges horaires</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Horaires</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Vue d'affichage des horaires par semaine -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <!-- ====== Start Reporting Header -->
                        <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
                    
                            <div class="row bg-info py-3" style="border:2px solid black">
                                <div class="col-sm-12 col-lg-12 text-center">
                                    <h3 class="font-weight-bold text-uppercase">Horaires de cours</h3>
                               
                                    <div class="printoff">
                                        <div class="text-right">
                                            <a href="javascript:void();" class="btn btn-outline-light text-uppercase btn-sm"
                                                onclick="print()">
                                                <i class="fa fa-print"></i> Imprimer charges horaires</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped" id="datatablesReportingActions">
                                    <thead>
                                        <tr class="text-center small">
                                            <th>Jour</th>
                                            <th>Heure</th>
                                            <th>Enseignant</th>
                                            <th>Cours</th>
                                            <th>Classe</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($weekly_schedule) && !empty($weekly_schedule)): ?>
                                        <?php foreach ($weekly_schedule as $schedule): ?>
                                        <tr class="small">
                                            <td class="text-center">
                                                <?= setFrenchDays($schedule['schedule_day_week'], 'number'); ?></td>
                                            <td class="text-center">
                                                <?= date('H:i', strtotime($schedule['schedule_start_time'])); ?> à
                                                <?= date('H:i', strtotime($schedule['schedule_end_time'])); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= esc($schedule['teacher_firstname']); ?>
                                                <?= esc($schedule['teacher_lastname']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= esc($schedule['course_name']); ?></td>
                                            <td class="text-uppercase">
                                                <?= setDegresLevels($schedule['degree_code'], 'f'); ?>
                                                <?= ucwords($schedule['classe_subname']); ?>
                                                <?= ucwords($schedule['option_name']); ?>
                                            </td>
                                            <td class="text-lowercase">
                                                <a href="<?= esc($schedule['schedule_notes']); ?>" title="Accèder au cours" target="_blank">
                                                <?= esc($schedule['schedule_notes']); ?>
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
            </div>
        </div>
    </section>
</div>
