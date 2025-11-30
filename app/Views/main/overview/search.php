<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('search'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">
                        Résultats de recherche d'informations
                    </h5>
                </div>
                <div class="col-sm-6">
                    <div class="card-tools float-right">
                        <a href="<?= base_url('student/registration'); ?>" class="btn btn-info btn-sm text-uppercase"
                            data-toggle="tooltip" data-placement="bottom"
                            title="Cliquer pour ajouter une nouvelle inscription">
                            <i class="fa fa-plus"></i> Inscrire nouvel étudiant
                        </a>
                        <a href="<?= base_url('payments'); ?>" class="btn btn-primary btn-sm text-uppercase"
                            data-toggle="tooltip" data-placement="bottom" title="Cliquer pour ajouter un paiement">
                            <i class="fa fa-plus"></i> Créer un nouveau paiement
                        </a>
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-5">
                        <div class="card-header float-left">
                            <div class="card-title">
                                <form id="formSearchAdvanced" method="post" action="<?= base_url('search'); ?>">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-inline">
                                                <div class="input-group">
                                                    <input class="form-control form-control-lg" type="search"
                                                        name="query"
                                                        placeholder="Saisissez le nom ou le numéro matricule de l'élève"
                                                        aria-label="Search" autofocus
                                                        value="<?= isset($query)?$query:set_value('query'); ?>"
                                                        style="border-top-left-radius: 100px!important; border-bottom-left-radius: 100px!important;">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-default btn-lg" type="submit"
                                                            style="border-top-right-radius: 100px!important; border-bottom-right-radius: 100px!important;">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h3 class="text-center text-uppercase font-weight-bold">informations sur dossier élève</h3>
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">
                                            <th>#</th>
                                            <th>Matricule</th>
                                            <th>Noms</th>
                                            <th>Sexe</th>
                                            <th>Promotion</th>
                                            <th>Année</th>
                                            <th>Inscription</th>
                                            <th>Contacts</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count = 1;
                                    
                                   
                                    if (isset($students) && (!empty($students))):
                                        foreach ($students as $key => $value):
                                            $status = (!empty(esc($value['student_status'])) ? esc($value['student_status']) : 'inactif');
                                            ?>
                                        <tr class="small">
                                            <td width="2px" scope="1" class="text-center">

                                                <a href="<?= base_url('student/details/inscription/' . esc($value['inscription_id'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                                </a>
                                            </td>

                                            <td class="text-uppercase"><?= esc($value['student_code']); ?></td>
                                            <td class="text-uppercase">
                                                <?= esc($value['student_firstname']); ?>
                                                <?= esc($value['student_lastname']); ?>
                                                <?= esc($value['student_surname']); ?>

                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($value['student_gender'] == 'masculin')?'M':'F'; ?></td>
                                            <td class="text-uppercase">
                                                <?= setDegresLevels($value['degree_code'], 'f'); ?>
                                                <?= esc(trim($value['classe_subname'])); ?>
                                                <?= esc(trim($value['option_name'])); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= $value['year_started']; ?>-<?= $value['year_ended']; ?></td>
                                            <td class="text-uppercase"><?= $value['inscription_date']; ?></td>
                                            <td class="text-uppercase">
                                                <span class="font-weight-bold">
                                                    <?= esc($value['parent_primary_phone']); ?></span>
                                                <br><span class="small font-weight-bold text-lowercase">
                                                    <?= esc($value['parent_primary_email']); ?></span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8">
                                                <h3 class="text-center text-uppercase font-weight-bold">
                                                    informations sur les paiements
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr class="text-uppercase small">
                                            <th>#</th>
                                            <th>Matricule</th>
                                            <th>Noms</th>
                                            <th>Genre</th>
                                            <th>Promotion</th>
                                            <th>Année</th>
                                            <th>Reçu Paiement</th>
                                            <th>Frais</th>
                                        </tr>
                                        <?php
                                    $count = 1;
                                    if (isset($payments) && (!empty($payments))):
                                        foreach ($payments as $key => $payment):?>
                                        <tr class="small">
                                            <td width="2px" scope="1" class="text-center">

                                                <a href="<?= base_url('payment/printbill/' . esc($payment['payment_token'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= trim($payment['student_code']); ?></td>
                                            
                                            <td class="text-uppercase">
                                                <?= esc($payment['student_firstname']); ?>
                                                <?= esc($payment['student_lastname']); ?>
                                                <?= esc($payment['student_surname']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($payment['student_gender'] == 'masculin')?'M':'F'; ?>
                                            </td>
                                            
                                            <td class="text-uppercase">
                                                <?= setDegresLevels($payment['degree_code'], 'f'); ?>
                                                <?= esc(trim($payment['classe_subname'])); ?>
                                                <?= esc(trim($payment['option_name'])); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= $payment['year_started']; ?>-<?= $payment['year_ended']; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                
                                                <a href="<?= base_url('payment/printbill/' . esc($payment['payment_token'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <?= trim($payment['payment_code']); ?>
                                                </a>
                                                du <?= trim($payment['payment_date']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= trim($payment['fee_name']); ?></td>
                                            
                                            
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>