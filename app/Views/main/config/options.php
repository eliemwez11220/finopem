<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Paramètrages des Filières</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?=base_url('overview')?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Paramètrages</li>
                                <li class="breadcrumb-item active">Filières</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess('options'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Gestion des Filières</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-info btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer une nouvelle option">
                                        <i class="fa fa-plus"></i> Nouvelle Filière
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

                                            <th>Code</th>
                                            <th>Filière</th>
                                            <th>Faculté</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if (isset($options) && !empty($options)):
                                            foreach ($options as $key => $value):
                                                $status = (!empty(esc($value['option_status'])) ? esc($value['option_status']) : 'inactif');
                                                ?>
                                        <tr class="small">

                                            <td><?=esc($value['option_code']);?></td>
                                            <td class="text-uppercase small"><?= trim($value['option_name']);?></td>
                                            <td class="text-uppercase small"><?= trim($value['section_name']);?></td>

                                            <td>
                                                <a href="<?=base_url('main/changeStatus/option/' . esc($status) . '/' . esc($value['option_id']));?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?=(esc($status) == 'actif') ? 'badge-info' : 'badge-danger';?> text-capitalize">
                                                        <?=$status;?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= esc($value['option_created_at']);?></td>
                                            <td width="1px" class="text-center">
                                                <a data-toggle="modal"
                                                    data-target="#update_option_<?=$value['option_id'];?>" href="#"
                                                    class="btn btn-xs btn-outline-warning">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                                <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>
                                            
                                            <a href="<?= base_url('main/remove/option/' . ($value['option_id'])); ?>"
                                               class="<?= $access_delete; ?> btn btn-xs btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer cette option?'); false;">
                                                <span data-toggle="tooltip" data-placement="top"
                                                      title="Cliquer pour supprimer cette option">
                                                      <i class="fa fa-window-close fa-2x"></i></span>
                                            </a>
                                            </td>
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_option_<?=$value['option_id'];?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title d-inline-flex">Modification
                                                            option <?=esc($value['option_name']);?></h4>
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
        echo form_open(base_url('edit-classe-option/' . $value['option_id']), $attributes);
        ?>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-floating">
                                                                <select id="section_id" name="section_id"
                                class="form-control select2 select2-info <?php if ($validation->hasError('section_id')) {echo 'is-invalid';}?> "
                                                data-dropdown-css-class="select2-info">
                                                <option selected disabled>--Sélectionnez
                                                                            faculté --
                                                                        </option>
                                                                        <?php $count = 1;
    if (isset($sections) && !empty($sections)):
        $section_db = (!empty(($value['option_section_id']))) ? ($value['option_section_id']) : "";
        foreach ($sections as $keysec => $valuesec): ?>
                                                                        <option
                                                                            value="<?=esc($valuesec['section_id']);?>"
                                                                            <?= ($section_db == $valuesec['section_id']) ? 'selected': set_select('section_id', esc($valuesec['section_id']));?>>
                                                                            <?=ucfirst(($valuesec['section_name']));?>
                                                                        </option>
                                                                        <?php endforeach;?>
                                                                        <?php endif;?>

                                                                    </select>
                                                                    <label for="option_type" class="control-label">
                                                                        <span class="text-danger">*</span>Facultés
                                                                    </label><?php if (isset($validation)): ?>
                                                                    <span class="invalid-feedback">
                                                                        <?=display_validation_error($validation, 'section_id');?>
                                                                    </span>
                                                                    <?php endif;?>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        name="option_name" id="option_name"
                                                                        value="<?=(!empty(($value['option_name']))) ? ($value['option_name']) : old('option_name')?>" />
                                                                    <label for="option_name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé de la filière
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control"
                                                                        name="option_code" id="option_code"
                                                                        value="<?=(!empty(($value['option_code']))) ? ($value['option_code']) : old('option_code')?>" />
                                                                    <label for="option_code" class="control-label">
                                                                        <span class="text-danger">*</span>Abbreviation de la filière
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
                                        <?php endforeach;?>
                                        <?php endif;?>
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
                <h4 class="modal-title font-weight-bold text-uppercase">Ajout d'une nouvelle filière</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
                $validation = \Config\Services::validation();
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url('create-classe-option'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <select id="option_type" name="section_id"
                                class="form-control select2 select2-info <?php if ($validation->hasError('section_id')) {echo 'is-invalid';}?> "
                                                data-dropdown-css-class="select2-info">
                                <option selected disabled>--Sélectionnez faculté--</option>
                                <?php $count = 1;
if (isset($sections) && !empty($sections)):
    foreach ($sections as $keysec => $valuesec): ?>
                                <option value="<?=esc($valuesec['section_id']);?>"
                                    <?=set_select('section_id', esc($valuesec['section_id']));?>>
                                    <?=ucfirst(($valuesec['section_name']));?></option>
                                <?php endforeach;?>
                                <?php endif;?>

                            </select>
                            <label for="option_type">
                                <span class="text-danger">*</span>Facultés
                            </label><?php if (isset($validation)): ?>
                            <span class="invalid-feedback">
                                <?=display_validation_error($validation, 'section_id');?>
                            </span>
                            <?php endif;?>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                        <div class="form-floating">

                            <input type="text" class="form-control" name="option_name" id="option_name_add"
                                value="<?=old('option_name');?>" placeholder="Ex: Programmation" />
                            <label for="option_name_add" class="control-label">
                                <span class="text-danger">*</span>Libellé de la filière
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                        <div class="form-floating">

                            <input type="text" class="form-control" name="option_code" id="option_code_add"
                                value="<?=old('option_code');?>" placeholder="Ex: PROG" />
                            <label for="option_code_add" class="control-label">
                                <span class="text-danger"></span>Abbreviation de la filière
                            </label>
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
</div>