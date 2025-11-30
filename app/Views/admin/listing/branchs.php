<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Affectation des utilisateurs aux sections</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?=base_url('overview')?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Administration</li>
                                <li class="breadcrumb-item active">Affectation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess(null, 'admins'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">
                                    Gestion des affectations</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-info btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer une nouvelle affectation">
                                        <i class="fa fa-plus"></i> Nouvelle affectation
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
                                            <th>Agent</th>
                                            <th>Section</th>
                                            <th>Statut</th>
                                            <th>Notes</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if (isset($branchs) && !empty($branchs)):
                                            foreach ($branchs as $key => $value):
                                                $status = (!empty(esc($value['branch_status'])) ? esc($value['branch_status']) : 'inactif');
                                                ?>
                                        <tr class="small">

                                            <td><?=$count++;?></td>
                                            <td class="text-capitalize">
                                            <?= strtoupper($value['user_firstname']);?>
                                            <?= strtoupper($value['user_lastname']);?>
                                            (<?= strtoupper($value['user_name']);?>) - 
                                            [<?= strtoupper($value['role_name']);?>] 
                                            </td>
                                            <td class="text-capitalize"><?=($value['section_name']);?></td>
                                           
                                            <td>
                                                <a href="<?=base_url('admin/changeStatus/branch/' . esc($status) . '/' . esc($value['branch_id']));?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?=(esc($status) == 'actif') ? 'badge-info' : 'badge-danger';?> text-capitalize">
                                                        <?=$status;?> </span>
                                                </a>
                                            </td> 
                                            <td class="text-capitalize"><?=($value['branch_notes']);?></td>

                                            <td class="text-uppercase"><?=($value['branch_created_at']);?></td>
                                            <td width="1px" class="text-center">
                                                <a href="<?=base_url('admin/remove/branch/'.$value['branch_id']);?>"
                                                class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer cette affectation?');">
                                                   <i class="fas fa-window-close"></i> supprimer
                                                </a>
                                            </td>
                                        </tr>
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
                <h4 class="modal-title">Affectation des utilisateurs dans les sections</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
                $validation = \Config\Services::validation();
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url('create-user-branch'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <select id="user_id" name="user_id"
                                class="form-control <?php if ($validation->hasError('user_id')) {echo 'is-invalid';}?>">
                                <option selected disabled>--sélectionnez agent--</option>
                                <?php if (isset($users) && !empty($users)):
                                foreach ($users as $userkey => $uservalue): ?>
                                <option value="<?= ($uservalue['user_id']);?>"
                                    <?=set_select('user_id', ($uservalue['user_id']));?>>
                                    <?= strtoupper($uservalue['user_firstname']);?>
                                    <?= strtoupper($uservalue['user_lastname']);?>
                                    (<?= strtoupper($uservalue['user_name']);?>) - 
                                    [<?= strtoupper($uservalue['role_name']);?>] 
                                </option>
                                <?php endforeach;?>
                                <?php endif;?>

                            </select>
                            <label for="user_id" class="control-label">
                                <span class="text-danger">*</span>Utilisateur
                            </label><?php if (isset($validation)): ?>
                            <span class="invalid-feedback">
                                <?=display_validation_error($validation, 'user_id');?>
                            </span>
                            <?php endif;?>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <select id="section_id" name="section_id"
                                class="form-control <?php if ($validation->hasError('section_id')) {echo 'is-invalid';}?>">
                                <option selected disabled>--sélectionnez section--</option>
                                <?php if (isset($sections) && !empty($sections)):
                                foreach ($sections as $keysec => $valuesec): ?>
                                <option value="<?=esc($valuesec['section_id']);?>"
                                    <?=set_select('section_id', esc($valuesec['section_id']));?>>
                                    <?= strtoupper($valuesec['section_name']);?></option>
                                <?php endforeach;?>
                                <?php endif;?>

                            </select>
                            <label for="section_id" class="control-label">
                                <span class="text-danger">*</span>Section d'affectation
                            </label><?php if (isset($validation)): ?>
                            <span class="invalid-feedback">
                                <?=display_validation_error($validation, 'section_id');?>
                            </span>
                            <?php endif;?>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="notes" id="option_name"
                                value="<?=old('notes');?>" placeholder="Ex: courte description" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes interne
                            </label>
                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                    </button>
                    <button type="submit" class="btn btn-info btn-sm text-uppercase">
                        Affecter l'utilisateur
                    </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>