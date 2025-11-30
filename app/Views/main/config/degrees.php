<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Paramètrages des niveaux d'études</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Paramètrages</li>
                                <li class="breadcrumb-item active">Niveaux d'études</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess('levels'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Gestion des Niveaux d'études</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-info text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer un nouveau">
                                        <i class="fa fa-plus"></i> Nouveau degrès
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>Niveau</th>
                                            <th>Libellé</th>
                                            <th>Abrégé</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if (isset($degrees) && !empty($degrees)):
                                            foreach ($degrees as $key => $value):
                                                $status = (!empty(esc($value['degree_status'])) ? esc($value['degree_status']) : 'inactif');
                                                $count++;
                                                ?>
                                        <tr>
                                            <td><?= trim($value['degree_code']); ?></td>
                                            <td class="text-capitalize"><?= trim($value['degree_name']); ?></td>
                                            <td class="text-capitalize"><?= trim($value['degree_shortname']); ?></td>
                                            <td>
                                                <a href="<?= base_url('main/changeStatus/degrees/' . esc($status) . '/' . esc($value['degree_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= esc($value['degree_created_at']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a data-toggle="modal" data-target="#update_<?= $value['degree_id']; ?>"
                                                    href="#" class="btn btn-xs btn-outline-warning">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                                <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>
                                            
                                            <a href="<?= base_url('main/remove/degree/' . ($value['degree_id'])); ?>"
                                               class="<?= $access_delete; ?> btn btn-xs btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer ce Niveau classe?'); false;">
                                                <span data-toggle="tooltip" data-placement="top"
                                                      title="Cliquer pour supprimer ce Niveau classe">
                                                      <i class="fa fa-window-close fa-2x"></i></span>
                                            </a>
                                            </td>
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $value['degree_id']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title d-inline-flex">Modification
                                                        Niveaux d'études <?= esc($value['degree_name']); ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">
                                                                <i class="fa fa-window-close"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                            $validation = \Config\Services::validation();
                                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                            echo form_open(base_url('edit-classe-degrees/' . $value['degree_id']), $attributes);
                                                            ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">

                                                                    <input type="number" min="1" max="100"
                                                                        class="form-control" name="degre_level"
                                                                        id="degre_level"
                                                                        value="<?= (!empty(($value['degree_code']))) ? ($value['degree_code']) : old('degre_level') ?>" />

                                                                    <label for="degre_level" class="control-label">
                                                                        <span class="text-danger">*</span>Niveau de
                                                                        Degrès
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                <div class="form-floating">

                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="long_name" id="long_name"
                                                                        value="<?= (!empty(($value['degree_name']))) ? ($value['degree_name']) : old('long_name') ?>" />
                                                                    <label for="long_name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé degré
                                                                        en toutes lettres
                                                                        du degrès
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                <div class="form-floating">

                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="short_name" id="short_name"
                                                                        value="<?= (!empty(($value['degree_shortname']))) ? ($value['degree_shortname']) : old('short_name'); ?>" />
                                                                    <label for="short_name" class="control-label">
                                                                        <span class="text-danger">*</span>Le degré en
                                                                        abrégé
                                                                        du degrès
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Fermer
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-info btn-sm text-uppercase">
                                                            Enregistrer les modifications
                                                        </button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end update year modal -->
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
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-uppercase">Ajout d'un Niveau d'études</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-classe-degrees'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="degre_level" id="degre_level" min="1"
                                max="100" value="<?= old('degre_level'); ?>" placeholder="Ex:2" />

                            <label for="degre_level" class="control-label">
                                <span class="text-danger">*</span>Niveau d'études
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                        <div class="form-floating">

                            <input type="text" class="form-control text-capitalize" name="long_name" id="long_name"
                                value="<?= old('long_name'); ?>" placeholder="Deuxième"/>
                            <label for="long_name" class="control-label">
                                <span class="text-danger">*</span>Libellé degré en toute lettres
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="short_name" id="short_name"
                                value="<?= old('short_name'); ?>" placeholder="2ème"/>
                            <label for="short_name" class="control-label">
                                <span class="text-danger">*</span>Le libellé degré en abrégé
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                </button>
                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                    Enregistrer
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>