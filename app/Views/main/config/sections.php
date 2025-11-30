<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold text-uppercase">Paramètrages des Facultés</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Paramètrages</li>
                                <li class="breadcrumb-item active">Facultés</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess('sections'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Gestion des Facultés</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-info btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer une nouvelle section">
                                        <i class="fa fa-plus"></i> Nouvelle Faculté
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Libellé</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count = 1;
                                    if (isset($sections) && !empty($sections)):
                                        foreach ($sections as $key => $value):
                                            $status = (!empty(esc($value['section_status'])) ? esc($value['section_status']) : 'inactif');
                                            ?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['section_code']); ?></td>
                                            <td class="text-capitalize"><?= ($value['section_name']); ?></td>
                                            <td>
                                                <a href="<?= base_url('main/changeStatus/section/' . esc($status) . '/' . esc($value['section_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= ($value['section_created_at']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a data-toggle="modal" data-target="#update_<?= $count; ?>" href="#"
                                                    class="btn btn-xs btn-outline-warning">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                                <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>

                                                <a href="<?= base_url('main/remove/section/' . ($value['section_id'])); ?>"
                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer cette section?'); false;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer cette section">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $count; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title font-weight-bold">Modification de la
                                                            Faculté <?= esc($value['section_name']); ?></h4>
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
                                                        echo form_open(base_url('edit-classe-section/' . $value['section_id']), $attributes);
                                                        ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        name="section_name" id="section_name" placeholder="Sciences Economiques & Financiere"
                                                                        value="<?= (!empty(($value['section_name']))) ? ($value['section_name']) : old('section_name') ?>" />
                                                                    <label for="section_name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé de la
                                                                        Faculté
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control"
                                                                        name="section_code" id="section_code" placeholder="SCOFI"
                                                                        value="<?= (!empty(($value['section_code']))) ? ($value['section_code']) : old('section_code') ?>" />
                                                                    <label for="section_code" class="control-label">
                                                                        <span class="text-danger"></span>Code de la
                                                                        Faculté
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-uppercase">Ajout d'une nouvelle Faculté</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-classe-section'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="section_name" id="section_name_add"
                                value="<?= old('section_name'); ?>" placeholder="Ex:Sciences Economiques & Financiere" />
                            <label for="section_name_add" class="control-label">
                                <span class="text-danger">*</span>Libellé de la Faculté
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="section_code" id="section_code_add"
                                value="<?= old('section_code') ?>"  placeholder="SCOFI"/>
                            <label for="section_code_add" class="control-label">
                                <span class="text-danger"></span>Code de la Faculté
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