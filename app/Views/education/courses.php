<div class="content-wrapper <?= checkModuleAccess('courses'); ?>">
    <div class="content pt-2 p-md-2 p-lg-2">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignements</li>
                            <li class="breadcrumb-item active" aria-current="page">Cours organisés</li>
                            <li class="ml-3">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-primary btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer un  nouveau cours">
                                        <i class="fa fa-plus"></i> Nouveau cours
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
                                Configuration des cours organisés
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
                                            <th>Branche</th>
                                            <th>Nom</th>
                                            <th>Abrégé </th>
                                            <th>Type</th>
                                            <th>Observation</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count = 1;
                                    if (isset($courses) && !empty($courses)):
                                        foreach ($courses as $key => $value):
                                            $status = (!empty(esc($value['course_status'])) ? esc($value['course_status']) : 'inactif');
                                            ?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['course_code']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['branch_name']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['course_name']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['course_shortname']); ?></td>
                                            <td class="text-capitalize"><?= setCourseType($value['course_type']); ?></td>
                                            <td class="text-capitalize"><?= esc($value['course_notes']); ?></td>
                                            <td>
                                                <span class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> 
                                                    </span>
                                            </td>
                                            <td class="text-uppercase"><?= esc($value['course_created_at']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('education/courseclasses/' . $value['course_token']); ?>" class="btn btn-xs btn-outline-dark">
                                                    <span data-toggle="tooltip" data-placement="top" title="Cliquer pour configurer ce cours dans une classe">
                                                        <i class="fa fa-cogs fa-lg fa-2x"></i>
                                                    </span>
                                                </a> 
                                                <a data-toggle="modal" data-target="#update_<?= $count; ?>" href="#"
                                                    class="btn btn-xs btn-outline-warning">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </span>
                                                </a>
                                                <?php $access_delete = (session()->get('admin') == TRUE or session()->get('all') == TRUE)? '': 'disabled'; ?>

                                                <a href="<?= base_url('education/remove/course/' . ($value['course_id'])); ?>"
                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer cette course?'); false;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer cette course">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- update year modal -->
                                        <div class="modal fade" id="update_<?= $count; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">

                                                        <h4 class="modal-title d-inline-flex">Modification du cours <?= esc($value['course_name']); ?></h4>
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
                                                        echo form_open(base_url('education-course'), $attributes);
                                                        ?>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="token" id="token"
                                                            value="<?= $value['course_token']; ?>">
                                                        <input type="hidden" name="action" id="action"
                                                            value="update">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="select2 form-control text-uppercase"
                                                                        id="branch2" name="branch" required>
                                                                        <?php if (isset($branchs) && !empty($branchs)): ?>
                                                                        <?php foreach ($branchs as $branch): ?>
                                                                        <option value="<?= esc($branch['branch_id']); ?>"
                                                                            <?= ($value['course_branch_id'] == $branch['branch_id']) ? 'selected' : ''; ?>>
                                                                            <?= esc($branch['branch_name']); ?></option>
                                                                        <?php endforeach; ?>
                                                                        <?php else: ?>
                                                                        <option value="" disabled>Aucune branche
                                                                            disponible</option>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                    <label for="branch2" class="control-label">
                                                                        <span class="text-danger">*</span>Branche du cours
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="name" id="name"
                                                                        value="<?= (!empty(($value['course_name']))) ? ($value['course_name']) : old('course_name') ?>" />
                                                                    <label for="name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé du cours
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-capitalize"
                                                                        name="short_name" id="short_name"
                                                                        value="<?= (!empty(($value['course_shortname']))) ? ($value['course_shortname']) : old('course_shortname') ?>" />
                                                                    <label for="short_name" class="control-label">
                                                                        <span class="text-danger">*</span>Libellé cours en abrégé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="type" name="type" required>
                                                                        <option value="beginner"  <?= ($value['course_type'] == 'beginner') ? 'selected' : ''; ?>>Debutant</option>
                                                                        <option value="intermediate" <?= ($value['course_type'] == 'intermediate') ? 'selected' : ''; ?>>Intermediaire</option>
                                                                        <option value="advanced" <?= ($value['course_type'] == 'advanced') ? 'selected' : ''; ?>>Avancé</option>
                                                                        <option value="expert" <?= ($value['course_type'] == 'expert') ? 'selected' : ''; ?>>Expert</option>
                                                                        <option value="professional" <?= ($value['course_type'] == 'professional') ? 'selected' : ''; ?>>Professionnel</option>

                                                                    </select>
                                                                    <label for="type"><span
                                                                            class="text-danger">*</span>Type de cours</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-12 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="status" name="status" required>
                                                                        <option value="actif"
                                                                            <?= ($value['course_status'] == 'actif') ? 'selected' : ''; ?>>
                                                                            Actif</option>
                                                                        <option value="inactif"
                                                                            <?= ($value['course_status'] == 'inactif') ? 'selected' : ''; ?>>
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
                                                                        value="<?= (!empty(($value['course_notes']))) ? ($value['course_notes']) : old('course_notes') ?>" />
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
                <h4 class="modal-title font-weight-bold">Ajout d'un nouveau cours</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('education-course'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                        <select class="select2 form-control text-uppercase" id="branch" name="branch" required>
                            <?php if (isset($branchs) && !empty($branchs)): ?>
                                <?php foreach ($branchs as $branch): ?>
                                    <option value="<?= esc($branch['branch_id']); ?>"><?= esc($branch['branch_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Aucune branche disponible</option>
                            <?php endif; ?>
                        </select>
                            
                            <label for="branch" class="control-label">
                                <span class="text-danger">*</span>Branche du cours
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" id="name" value="<?= old('name'); ?>"
                                placeholder="Ex:Grammaire" required />
                            <label for="name" class="control-label">
                                <span class="text-danger">*</span>Libellé du cours
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="short_name" id="short_name"
                                value="<?= old('short_name'); ?>" placeholder="Ex: GRAM" />
                            <label for="short_name" class="control-label">
                                <span class="text-danger"></span>Libellé cours en abrégé
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                        <select class="form-control text-uppercase" id="type" name="type">
                            <option value="beginner">Débutant</option>
                            <option value="intermediate">Intermédiaire</option>
                            <option value="advanced">Avancé</option>
                            <option value="expert">Expert</option>
                            <option value="professional">Professionnel</option>

                        </select>
                            <label for="type"><span class="text-danger"></span>Niveau du cours</label>
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
                                value="<?= old('notes'); ?>" placeholder="Ex: Notes supplemnetaires" />
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
                    <i class="fas fa-check-circle"></i> Enregistrer le cours
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>