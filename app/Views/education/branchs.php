<div class="content-wrapper <?= checkModuleAccess('branchs'); ?>">
    <div class="content pt-2 p-md-2 p-lg-2">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignements</li>
                            <li class="breadcrumb-item active" aria-current="page">Branches</li>
                            <li class="ml-3">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-primary btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer une nouvelle branche">
                                        <i class="fa fa-plus"></i> Nouvelle branche
                                    </span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1 class="text-uppercase font-weight-bold">
                                Configuration des branches
                            </h1>
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
                                            <th>Abrégé </th>
                                            <th>Type </th>
                                            <th>Observation</th>
                                            <th>Statut</th>
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
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['branch_code']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['branch_name']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['branch_shortname']); ?></td>
                                            <td class="text-capitalize"><?= setCourseType($value['branch_type']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['branch_notes']); ?></td>
                                            <td>
                                                <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> 
                                                    </span>
                                                
                                            </td>
                                            <td class="text-uppercase"><?= ($value['branch_created_at']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a data-toggle="modal" data-target="#update_<?= $count; ?>" href="#"
                                                    class="btn btn-xs btn-outline-warning">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                                <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>

                                                <a href="<?= base_url('education/remove/branch/' . ($value['branch_id'])); ?>"
                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer cette branch?'); false;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer cette branch">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $count; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h4 class="modal-title d-inline-flex">Modification
                                                            branch <?= esc($value['branch_name']); ?></h4>
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
                                                        echo form_open(base_url('education-branch'), $attributes);
                                                        ?>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="token" id="token"
                                                            value="<?= $value['branch_token']; ?>">
                                                        <input type="hidden" name="action" id="action"
                                                            value="update">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="name" id="name"
                                                                        value="<?= (!empty(($value['branch_name']))) ? ($value['branch_name']) : old('branch_name') ?>" />
                                                                    <label for="name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé de la branche
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="short_name" id="short_name"
                                                                        value="<?= (!empty(($value['branch_shortname']))) ? ($value['branch_shortname']) : old('branch_shortname') ?>" />
                                                                    <label for="short_name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé branche en abrégé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="type" name="type" required>
                                                                        <option value="general"
                                                                            <?= ($value['branch_type'] == 'general') ? 'selected' : ''; ?>>
                                                                            Général</option>
                                                                        <option value="scientifique"
                                                                            <?= ($value['branch_type'] == 'scientifique') ? 'selected' : ''; ?>>
                                                                            Scientifique</option>
                                                                        <option value="litteraire"
                                                                            <?= ($value['branch_type'] == 'litteraire') ? 'selected' : ''; ?>>
                                                                            Littéraire</option>
                                                                        <option value="technique"
                                                                            <?= ($value['branch_type'] == 'technique') ? 'selected' : ''; ?>>
                                                                            Technique</option>
                                                                        <option value="artistique"
                                                                            <?= ($value['branch_type'] == 'artistique') ? 'selected' : ''; ?>>
                                                                            Artistique</option>
                                                                        <option value="autre"
                                                                            <?= ($value['branch_type'] == 'autre') ? 'selected' : ''; ?>>
                                                                            Autre</option>
                                                                    </select>
                                                                    <label for="type"><span
                                                                            class="text-danger">*</span>Type de branche</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-12 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="status" name="status" required>
                                                                        <option value="actif"
                                                                            <?= ($value['branch_status'] == 'actif') ? 'selected' : ''; ?>>
                                                                            Actif</option>
                                                                        <option value="inactif"
                                                                            <?= ($value['branch_status'] == 'inactif') ? 'selected' : ''; ?>>
                                                                            Inactif</option>
                                                                    </select>
                                                                    <label for="status"><span
                                                                            class="text-danger">*</span>Statut</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="notes" id="notes"
                                                                        value="<?= (!empty(($value['branch_notes']))) ? ($value['branch_notes']) : old('branch_notes') ?>" />
                                                                    <label for="notes" class="control-label">
                                                                        <span class="text-danger"></span>Notes interne
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">

                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer
                                                        </button>
                                                        <button type="submit" class="btn btn-primary text-uppercase">
                                                            <i class="fas fa-check-circle"></i> Enregistrer les
                                                            modifications
                                                            
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
                <h4 class="modal-title font-weight-bold">Ajout d'une nouvelle branche</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education-branch'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="name" value="<?= old('name'); ?>"
                                placeholder="Ex:Mathématique" required />
                            <label for="name" class="control-label">
                                <span class="text-danger">*</span>Libellé de la branche
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="short_name" id="short_name"
                                value="<?= old('short_name'); ?>" placeholder="Ex: MATH" required />
                            <label for="short_name" class="control-label">
                                <span class="text-danger">*</span>Libellé branche en abrégé
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="type" name="type" required>
                                <option value="general">Général</option>
                                <option value="scientifique">Scientifique</option>
                                <option value="litteraire">Littéraire</option>
                                <option value="technique">Technique</option>
                                <option value="artistique">Artistique</option>
                                <option value="autre">Autre</option>
                            </select>
                            <label for="type"><span class="text-danger">*</span>Type de branche</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="status" required>
                                <option value="actif">
                                    Actif</option>
                                <option value="inactif">
                                    Inactif</option>
                            </select>
                            <label for="status"><span class="text-danger">*</span>Statut</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="notes" id="notes"
                                value="<?= old('notes'); ?>" placeholder="Ex: MATH" />
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Notes interne
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Enregistrer la branche
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>