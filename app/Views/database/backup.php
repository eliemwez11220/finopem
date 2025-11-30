<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= !checkModuleAccess('databases'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="text-uppercase font-weight-bold">Gestion des bases de données</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Vue d'ensemble</li>
                        <li class="breadcrumb-item active">Sauvegarde de données</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-lg-8">
                <div class="card">
                    <div class="card-header bg-info text-center">
                        <h3 class="font-weigt-bold">Bases des données sauvegardées</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesExample2"
                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Sauvegarde</th>
                                        <th>Taille</th>
                                        <th width="1px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $backup_path = WRITEPATH . 'database/';// Path to store the backup file
                                // Liste des fichiers et répertoires dans le répertoire
                                $files = scandir($backup_path, SCANDIR_SORT_DESCENDING);
                                if(!empty($files)){
                                    $count= 1; 
                                    // Parcourir les fichiers
                                    foreach ($files as $file) {
                                        if (!in_array($file, array('.', '..'))) { 
                                            $realfile = $backup_path.'/'.$file;
                                            $size_file_byte = filesize($realfile);
                                            //$size_file_kilo = $size_file_byte / 1024;
                                            $decimals = 2;
                                            $factor = floor((strlen($size_file_byte) - 1) / 3);
                                            if ($factor > 0) $sz = 'KMGT';
                                            $size_file_mega = sprintf("%.{$decimals}f", $size_file_byte / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
                                            ?>
                                    <tr class="small">
                                        <td><?= $count++; ?></td>
                                        <td><i class="fa fa-file fa-lg"></i> <?= $file; ?></td>
                                        <td class="font-weight-bold"><?= $size_file_mega; ?></td>
                                        <td><a href="<?= base_url('dbremovebackup/'.$file); ?>" class="btn btn-xs btn-outline-danger"
                                                onclick="return confirm('Voulez-vous vraiment nettoyer ce fichier de la base de données sauvegardée ?'); false;">
                                                <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                                                    title="Cliquer pour supprimer ce fichier de sauvegarde">
                                                    <i class="fa fa-window-close fa-lg"></i> Nettoyer
                                                </span>
                                            </a>
                                            <a href="<?= base_url('dbimport/'.$file); ?>" class="btn btn-success btn-xs"
                                            onclick="return confirm('Voulez-vous vraiment écraser la base de données existante et remplacer par celle-ci ?'); false;">
                                                <span class="font-weight-bold" data-toggle="tooltip" data-placement="top"
                                                    title="Cliquer pour restaurer cette sauvegarde">
                                                    <i class="fa fa-database fa-lg"></i> Restaurer
                                                </span>
                                            </a>
                                        </td>
                                        <?php } } } ?>
                                        
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                        <a href="<?= base_url('dbexport'); ?>" class="btn btn-info btn-sm">
                            <span data-toggle="tooltip" data-placement="top"
                                title="Cliquer pour effectuer une sauvegarde de la base actuelle">
                                <i class="fa fa-download fa-lg"></i> Sauvegarder la base de données manuellement
                            </span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12 col-lg-4">
                <blockquote class="py-5">
                    <h1 class="font-weight-bold text-uppercase lined lined-center">
                        <i class="nav-icon fas fa-upload"></i> Importation d'une base de données externe
                    </h1>
                    <p class="font-weight-bold h5 text-center">
                        Sélectionner un fichier sql d'une base de données
                    </p>
                    <?php $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open_multipart(base_url('dbimportsql'), $attributes);
            ?>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="file" class="form-control py-3" name="dbsql" id="dbsql"
                                value="<?= old('dbsql'); ?>" accept=".sql" required />
                            <?php if ($validation->hasError('dbsql')) { ?>
                            <span class="invalid-feedback">
                                <?= $validation->getError('dbsql'); ?></span>
                            <?php } ?>
                            <label for="dbsql" class="control-label">
                                <span class="text-danger">*</span>Charger un fichier SQL
                            </label>
                        </div>
                    </div>


                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary py-3" onclick="return confirm('Voulez-vous vraiment écraser la base de données existante et remplacer par celle-ci ?'); false;">
                    <i class="fa fa-upload fa-lg"></i> Valider l'importation de données
                </button>
            </div>
            <?php echo form_close(); ?>
                </blockquote>
                <blockquote class="py-3 border-danger">
                    <h1 class="font-weight-bold text-uppercase lined lined-center text-dark">
                        <i class="nav-icon fas fa-trash"></i> Réinitialisation de la base de données
                    </h1>
                    <p class="text-center">
                        Cette opération est irreversible, c'est-a-dire vous perdrez toutes les données en remettant la configuration d'usine du systéme
                    </p>
                    <div class="text-center">
                        <a href="<?= base_url('dbmigrate'); ?>" class="btn btn-danger btn-sm" 
                        onclick="return confirm('Voulez-vous vraiment remettre le systéme dans sa configuration initiale?'); false;">
                            <span data-toggle="tooltip" data-placement="top"
                                title="Cliquer pour remettre le systéme dans sa configuration d'usine">
                                <i class="fa fa-window-close fa-lg"></i> Réinitialiser le systéme 
                            </span>
                        </a>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
</div>
<!-- update year modal -->
<div class="modal fade" id="import_database">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">

                <h4 class="modal-title d-inline-flex font-weight-bold text-uppercase">
                    </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-window-close"></i>
                    </span>
                </button>
            </div>
            
        </div>
    </div>
</div>
<!-- end update year modal -->