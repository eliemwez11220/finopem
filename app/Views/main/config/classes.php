<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Paramètrages des promotions</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('overview') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Paramètrages</li>
                                <li class="breadcrumb-item active">Promotions</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content <?= checkModuleAccess('classes'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card-header -->
                    <div class="card">
                        <div class="card-header alert alert-primary">
                            <div class="text-center">
                                <h3 class="h3 font-weight-bold text-uppercase">
                                    Création d'une nouvelle Promotion
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row mb-2">

                                <div class="col-sm-12 col-lg-12">
                                    <form role="form" id="ajax_form_sections" method="get">
                                        <div class="form-floating input-group" style="width: 100%!important;">
                                            <select id="ajax_sections" name="ajax_sections" title="Classe"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                                <option disabled selected>--sélectionnez une faculté--</option>
                                                <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                                <option value="all">Toutes les facultés</option>
                                                <?php endif; ?>
                                                <?php
                                                $sections_listing = [];
                                                if (session()->has('usersbranchs')) {
                                                    if (session()->get('usersbranchs') == 'none') {
                                                        $sparents_listing = [];
                                                    } else {
                                                        $sections_listing = session()->usersbranchs;
                                                    }
                                                } else {
                                                    if (isset($sections)) {
                                                        $sections_listing = $sections;
                                                    }
                                                }

                                                if ((!empty($sections_listing))):
                                                    foreach ($sections_listing as $key => $value): ?>
                                                <option value="<?= trim($value['section_id']); ?>"
                                                    <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('ajax_sections', trim($value['section_id'])); ?>>
                                                    <?= strtoupper(trim($value['section_name'])); ?>
                                                </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <label for="ajax_sections">
                                                <span class="text-danger">*</span>Facultés organisées</label>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <?php if (session()->has('choosedsectionid')): ?>
                            <?php
                            $validation = \Config\Services::validation();
                            //new code generated automatically
                            //form attributes
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('create-classe'), $attributes);
                            ?>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating" style="width: 100%!important;">
                                        <select id="option_classe_add" name="option_classe" class="form-control select2 select2-info <?php if ($validation->hasError('option_classe')) {
                                            echo 'is-invalid';
                                        } ?>" data-dropdown-css-class="select2-info">
                                            <option selected="selected" disabled>-- Sélectionnez une filière--</option>
                                            <?php
                                            $count = 1;
                                            if (isset($options) && !empty($options)):
                                                foreach ($options as $optionkey => $optionvalue): 
                                                    if ($optionvalue['section_id'] == session()->get('choosedsectionid')):
                                            
                                                ?>
                                            <option value="<?= esc($optionvalue['option_id']); ?>"
                                                <?= set_select('option_classe', esc($optionvalue['option_id'])); ?>>
                                                <?= trim($optionvalue['option_name']); ?>
                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="option_classe_add">
                                            <span class="text-danger">*</span>Filières attachées
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'option_classe'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                                    <div class="form-floating mb-2" style="width: 100%!important;">

                                        <select id="degres_classe_add" name="degres_classe" class="form-control select2 select2-info <?php if ($validation->hasError('degres_classe')) {
                                            echo 'is-invalid';
                                        } ?>" data-dropdown-css-class="select2-info">
                                            <option selecteddisabled>-- Sélectionnez un degré --</option>
                                            <?php
                                            $count = 1;
                                            if (isset($degrees) && !empty($degrees)):
                                                foreach ($degrees as $key => $value): ?>
                                            <option value="<?= esc($value['degree_id']); ?>"
                                                <?= set_select('degres_classe', esc($value['degree_id'])); ?>>
                                                <?= setDegresLevels($value['degree_code'], 'f'); ?>(<?= esc($value['degree_name']); ?>)
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="degres_classe_add">
                                            <span class="text-danger">*</span>Degrès de la promotion
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'degres_classe'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                                    <div class="form-floating">
                                        <input type="number" min="1" max="100" class="form-control bg-light text-capitalize <?php if ($validation->hasError('places_classe')) {
                                            echo 'is-invalid';
                                        } ?>" name="places_classe" id="places_classe"
                                            placeholder="Nombre places Ex: 12"
                                            value="<?= set_value('places_classe'); ?>" />
                                        <label for="places_classe" class="control-label">
                                            <span class="text-danger">*</span>Capacité d'accueil des Etudiants
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'places_classe'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control bg-light  <?php if ($validation->hasError('classe_shortname')) {
                                            echo 'is-invalid';
                                        } ?>" name="classe_shortname" id="classe_shortname" placeholder="Ex: 3CG"
                                            value="<?= set_value('classe_shortname'); ?>" />
                                        <label for="classe_shortname" class="control-label">
                                            <span class="text-danger"></span>Abbréviation de la promotion
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'classe_shortname'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                                    <div class="form-floating mb-2">

                                        <select id="sub_classe_add" name="sub_classe" class="form-control <?php if ($validation->hasError('sub_classe')) {
                                            echo 'is-invalid';
                                        } ?>">
                                            <option selected disabled>--Sous-promotion--</option>
                                            <?php
                                            $sub_classes = setSubclasses();
                                            foreach ($sub_classes as $sub_classe_key2 => $sub_classe_value2): ?>
                                            <option value="<?= $sub_classe_value2; ?>"
                                                <?= set_select('sub_classe', $sub_classe_value2); ?>>
                                                <?= $sub_classe_value2; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="sub_classe_add">
                                            <span class="text-danger"></span>Sous promotion
                                        </label>
                                        <?php if (isset($validation)): ?>
                                        <span class="invalid-feedback">
                                            <?= display_validation_error($validation, 'sub_classe'); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                    <div class="form-floating">

                                        <textarea rows="5" cols="30" class="form-control bg-light" name="notes"
                                            placeholder="Plus de détails sur la nouvelle"
                                            id="notes"><?= set_value('notes'); ?></textarea>
                                        <label for="notes" class="control-label">
                                            <span class="text-danger"></span>Notes sur la promotion
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 mt-3 text-center">
                                    <button type="submit" class="btn btn-info text-uppercase">
                                    <i class="fas fa-check-circle"></i> Enregistrer la promotion</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <?php endif; ?>
                        </div>
                    
                    <?php if (session()->has('choosedsectionid')): ?>
                    <!-- /.card-header -->
                    <div class="card-footer">
                    <div class="alert alert-dark">
                            <div class="text-center">
                                <h3 class="h3 font-weight-bold text-uppercase">
                                    Liste des Promotions 
                                </h3>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table id="datatablesExample2"
                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr class="text-uppercase small">
                                        <th>Sous</th>
                                        <th>Niveau</th>
                                        <th>Filière</th>
                                        <th>Sigle</th>
                                        <th>Capacité</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Notes</th>
                                        <th width="1px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    if (isset($classes) && !empty($classes)):
                                        foreach ($classes as $key_classe => $classe_value):
                                            if ($classe_value['section_id'] == session()->get('choosedsectionid')):
                                            
                                            $status = (!empty(esc($classe_value['classe_status'])) ? esc($classe_value['classe_status']) : 'inactif');
                                            ?>
                                    <tr class="small">
                                        <td class="text-uppercase font-weight-bold">
                                            <?= ($classe_value['classe_subname']); ?>
                                        </td>
                                        <td><?= setDegresLevels($classe_value['degree_code']); ?>
                                        </td>
                                        <td class="text-capitalize"><?= ($classe_value['option_name']); ?></td>
                                        <td class="text-capitalize"><?= ($classe_value['classe_shortname']); ?></td>
                                        <td class="text-capitalize"><?= ($classe_value['classe_total_places']); ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('main/changeStatus/classe/' . esc($status) . '/' . esc($classe_value['classe_id'])); ?>"
                                                onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                <span
                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                    <?= $status; ?> </span>
                                            </a>
                                        </td>
                                        <td class="text-uppercase"><?= ($classe_value['classe_created_at']); ?></td>
                                        <td class="text-uppercase"><?= ($classe_value['classe_notes']); ?></td>
                                        <td width="1px" class="text-center">
                                            <a data-toggle="modal"
                                                data-target="#update_<?= $classe_value['classe_id']; ?>" href="#"
                                                class="btn btn-xs btn-outline-warning">
                                                <span data-toggle="tooltip" data-placement="top"
                                                    title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i></span>
                                            </a>
                                            <?php $access_delete = (session()->admin == TRUE or session()->all == TRUE) ? '' : 'disabled'; ?>

                                            <a href="<?= base_url('main/remove/classe/' . ($classe_value['classe_id'])); ?>"
                                                class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                onclick="return confirm('Etes-vous sur de vouloir supprimer cette classe?'); false;">
                                                <span data-toggle="tooltip" data-placement="top"
                                                    title="Cliquer pour supprimer cette classe">
                                                    <i class="fa fa-window-close fa-2x"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- update year modal -->
                                    <div class="modal fade" id="update_<?= $classe_value['classe_id']; ?>">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header text-center">

                                                    <h4
                                                        class="modal-title d-inline-flex text-uppercase font-weight-bold">
                                                        Modification de la
                                                        promotion<?= esc($classe_value['classe_name']); ?></h4>
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
                                                        echo form_open(base_url('edit-classe/' . $classe_value['classe_id']), $attributes);
                                                        ?>
                                                <div class="modal-body">
                                                    <div class="row">

                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="form-floating mb-2">
                                                               
                                                                <select id="option_classe" name="option_classe" class="form-control select2 select2-info <?php if ($validation->hasError('option_classe')) {echo 'is-invalid';} ?>" data-dropdown-css-class="select2-info">
                                                                    <option selected="selected" disabled>--
                                                                        Sélectionnez --</option>
                                                                    <?php $count = 1;
                                                                    if (isset($options) && !empty($options)):
                                                                    foreach ($options as $optionkey => $optionvalue): ?>
                                                                    <option
                                                                        value="<?= esc($optionvalue['option_id']); ?>"
                                                                        <?= ($classe_value['classe_option_id'] == $optionvalue['option_id']) ? 'selected' : set_select('option_classe', esc($optionvalue['option_id'])); ?>>
                                                                        <?= ucfirst(($optionvalue['option_name'])); ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                                <label for="option_classe" class="control-label">
                                                                    <span class="text-danger">*</span>
                                                                    Filières attachées
                                                                </label>
                                                                <?php if (isset($validation)): ?>
                                                                <span class="invalid-feedback">
                                                                    <?= display_validation_error($validation, 'option_classe'); ?>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="form-floating mb-2">
                                                               
                                                                <select id="degres_classe" name="degres_classe" class="form-control select2 select2-info <?php if ($validation->hasError('degres_classe')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" data-dropdown-css-class="select2-info">
                                                                    <option selected="selected" disabled>--
                                                                        Sélectionnez un degré --</option>
                                                                    <?php
                                                                            $count = 1;
                                                                            if (isset($degrees) && !empty($degrees)):
                                                                                foreach ($degrees as $key => $value): ?>
                                                                    <option value="<?= esc($value['degree_id']); ?>"
                                                                        <?= ($classe_value['classe_degree_id'] == $value['degree_id']) ? 'selected' : set_select('degres_classe', esc($value['degree_id'])); ?>>
                                                                        <?= setDegresLevels($value['degree_code'], 'f'); ?>(<?= esc($value['degree_name']); ?>)
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>

                                                                <label for="degres_classe" class="control-label">
                                                                    <span class="text-danger">*</span>Degrès de la
                                                                    promotion
                                                                </label>
                                                                <?php if (isset($validation)): ?>
                                                                <span class="invalid-feedback">
                                                                    <?= display_validation_error($validation, 'degres_classe'); ?>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="form-floating mb-2">

                                                                <select id="sub_classe" name="sub_classe" class="form-control select2 select2-info <?php if ($validation->hasError('sub_classe')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" data-dropdown-css-class="select2-info">
                                                                    <option selected disabled>--Sélectionnez--
                                                                    </option>
                                                                    <?php
                                                                            $sub_classes = setSubclasses();
                                                                            foreach ($sub_classes as $sub_classe_key => $sub_classe_value): ?>
                                                                    <option value="<?= $sub_classe_value; ?>"
                                                                        <?= ($classe_value['classe_subname'] == $sub_classe_value) ? 'selected' : set_select('sub_classe', $sub_classe_value); ?>>
                                                                        <?= $sub_classe_value; ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <label for="sub_classe" class="control-label">
                                                                    <span class="text-danger"></span>Sous-promotion
                                                                </label>
                                                                <?php if (isset($validation)): ?>
                                                                <span class="invalid-feedback">
                                                                    <?= display_validation_error($validation, 'sub_classe'); ?>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" min="1" max="100" class="form-control bg-light text-capitalize <?php if ($validation->hasError('places_classe')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" name="places_classe" id="places_classe"
                                                                    placeholder="Nombre places Ex: 12"
                                                                    value="<?= ($classe_value['classe_total_places']) ? $classe_value['classe_total_places'] : set_value('places_classe'); ?>" />
                                                                <label for="places_classe" class="control-label">
                                                                    <span class="text-danger">*</span>Capacité
                                                                    d'accueil étudiants
                                                                </label>
                                                                <?php if (isset($validation)): ?>
                                                                <span class="invalid-feedback">
                                                                    <?= display_validation_error($validation, 'places_classe'); ?>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-sm-6 col-xs-12">
                                                            <div class="form-floating mb-2">
                                                                <input type="text" class="form-control bg-light text-capitalize <?php if ($validation->hasError('classe_shortname')) {
                                                                            echo 'is-invalid';
                                                                        } ?>" name="classe_shortname"
                                                                    id="classe_shortname" placeholder="Ex: 3CG"
                                                                    value="<?= ($classe_value['classe_shortname']) ? $classe_value['classe_shortname'] : set_value('classe_shortname'); ?>" />
                                                                <label for="classe_shortname" class="control-label">
                                                                    <span class="text-danger"></span>Abbréviation de
                                                                    la promotion
                                                                </label>
                                                                <?php if (isset($validation)): ?>
                                                                <span class="invalid-feedback">
                                                                    <?= display_validation_error($validation, 'classe_shortname'); ?>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                            <div class="form-floating mb-2">

                                                                <textarea rows="5" cols="30"
                                                                    class="form-control bg-light" name="notes"
                                                                    placeholder="Plus de détails sur la nouvelle"
                                                                    id="notes"><?= ($classe_value['classe_notes']) ? $classe_value['classe_notes'] : set_value('notes'); ?></textarea>
                                                                <label for="notes" class="control-label">
                                                                    <span class="text-danger"></span>Notes sur la
                                                                    promotion
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Fermer
                                                    </button>
                                                    <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                                        <i class="fas fa-check-circle"></i>
                                                        Enregistrer les modifications
                                                    </button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end update year modal -->
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>