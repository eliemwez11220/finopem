<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="font-weight-bold">Configuration périodes</h5>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Résultats</li>
                        <li class="breadcrumb-item active">Périodes</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content <?= checkModuleAccess('timing'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="font-weight-bold">Périodes</h5>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right">
                                        <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                            class="btn btn-info btn-sm text-uppercase">
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="Cliquer pour créer une nouvelle periode">
                                                <i class="fa fa-plus"></i> Nouvelle période
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="datatablesExample2"
                                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                            <thead>
                                                <tr class="text-uppercase small">
                                                    <th>Code</th>
                                                    <th>Libellé</th>
                                                    <th>Abrégé</th>
                                                    <th>Statut</th>
                                                    <th width="1px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                if (isset($periods) && !empty($periods)):
                                                    foreach ($periods as $key => $value):
                                                        $status = (!empty(esc($value['period_status'])) ? esc($value['period_status']) : 'inactif');
                                                        $count++;
                                                        ?>
                                                        <tr class="small">
                                                            <td><?= ($value['period_code']); ?></td>
                                                            <td class="text-capitalize"><?= ($value['period_name']); ?></td>
                                                            <td class="text-capitalize"><?= ($value['period_shortname']); ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?= base_url('teaching/status/period/' . esc($status) . '/' . esc($value['period_id'])); ?>"
                                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                                    <span
                                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                        <?= $status; ?> </span>
                                                                </a>
                                                            </td>
                                                            <td width="1px" class="text-center">
                                                                <a data-toggle="modal"
                                                                    data-target="#update_<?= $value['period_id']; ?>" href="#"
                                                                    class="btn btn-xs btn-outline-warning">
                                                                    <span data-toggle="tooltip" data-placement="top"
                                                                        title="Cliquer pour modifier cette information">
                                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                                </a>
                                                                <?php $access_delete = (session()->admin == TRUE or session()->all == TRUE) ? '' : 'disabled'; ?>

                                                                <a href="<?= base_url('teaching/remove/period/' . ($value['period_id'])); ?>"
                                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer cette periode?'); false;">
                                                                    <span data-toggle="tooltip" data-placement="top"
                                                                        title="Cliquer pour supprimer cette periode">
                                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <!-- update year modal -->
                                                        <div class="modal fade" id="update_<?= $value['period_id']; ?>">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-center">

                                                                        <h4 class="modal-title d-inline-flex">Modification
                                                                            degrès classe <?= esc($value['period_name']); ?>
                                                                        </h4>
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
                                                                    echo form_open(base_url('teaching-timing'), $attributes);
                                                                    ?>


                                                                    <div class="modal-body">

                                                                        <input type="hidden" name="period_token"
                                                                            id="period_token"
                                                                            value="<?= (!empty(($value['period_token']))) ? ($value['period_token']) : old('period_token') ?>" />

                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                                <div class="form-floating">

                                                                                    <input type="text"
                                                                                        class="form-control text-capitalize"
                                                                                        name="long_name" id="long_name"
                                                                                        value="<?= (!empty(($value['period_name']))) ? ($value['period_name']) : old('long_name') ?>" />
                                                                                    <label for="long_name"
                                                                                        class="control-label">
                                                                                        <span
                                                                                            class="text-danger">*</span>Libellé
                                                                                        période
                                                                                        en toutes lettres
                                                                                        de la periode
                                                                                    </label>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                                                                <div class="form-floating">

                                                                                    <input type="text"
                                                                                        class="form-control text-capitalize"
                                                                                        name="short_name" id="short_name"
                                                                                        value="<?= (!empty(($value['period_shortname']))) ? ($value['period_shortname']) : old('short_name'); ?>" />
                                                                                    <label for="short_name"
                                                                                        class="control-label">
                                                                                        <span class="text-danger">*</span>Le
                                                                                        période en
                                                                                        abrégé de la periode
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

                    <!-- Creation nouvelle annee scolaire -->
                    <div class="modal fade" id="nouvel_element">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ajout d'une nouvelle periode</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="text-danger"><i
                                                class="fa fa-window-close"></i></span>
                                    </button>
                                </div>
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(base_url('teaching-timing'), $attributes);
                                ?>
                                <div class="modal-body">
                                    <div class="row">
                                        
                                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                            <div class="form-floating">

                                                <input type="text" class="form-control text-capitalize" name="long_name"
                                                    id="long_name" value="<?= old('long_name'); ?>"
                                                    placeholder="Deuxième" />
                                                <label for="long_name" class="control-label">
                                                    <span class="text-danger">*</span>Libellé période en toute lettres
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                                            <div class="form-floating">

                                                <input type="text" class="form-control text-capitalize"
                                                    name="short_name" id="short_name" value="<?= old('short_name'); ?>"
                                                    placeholder="2ème" />
                                                <label for="short_name" class="control-label">
                                                    <span class="text-danger">*</span>Le libellé période en abrégé
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
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="font-weight-bold">Périodes Annuelles</h5>
                                </div>
                                <div class="col-sm-12">
                                <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(base_url('teaching-annualperiod'), $attributes);
                                ?>
                                
                                    <div class="row">
                                        
                                    <div class="col-sm-12 col-lg-12 mb-2">
                                        <div class="form-floating">
                                           
                                            <select
                                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('period')) ? ' is-invalid' : '' ?>"
                                                id="period" name="period"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected="selected" disabled>sélectionnez une periode</option>
                              
                                                <?php if (isset($periods) && !empty($periods)):
                                                    foreach ($periods as $perkey => $pervalue): ?>
                                                            <option value="<?= esc($pervalue['period_id']); ?>"
                                                                <?= set_select('period', esc($pervalue['period_id'])); ?>>
                                                            
                                                                <?= strtoupper($pervalue['period_name']); ?>
                                                                (<?= strtoupper($pervalue['period_shortname']); ?>)
                                                            </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <label for="period">
                                                <span class="text-danger">*</span>Période à
                                            configurer</label>
                                            <?php if ($validation->hasError('period')) { ?>
                                            <span class="invalid-feedback">
                                                <?= $validation->getError(field: 'period'); ?></span>
                                            <?php } ?>

                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-12 col-lg-12 mb-2">
                                        <div class="form-floating">
                                           
                                            <select
                                                class="form-control select2 select2-info <?= ($validation->hasError('section')) ? ' is-invalid' : '' ?>"
                                                id="section" name="section"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected="selected" disabled>sélectionnez section</option>
                              
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
                                            <label for="section"><span class="text-danger">*</span>Section concernée</label>
                                            <?php if ($validation->hasError('section')) { ?>
                                            <span class="invalid-feedback">
                                                <?= $validation->getError(field: 'section'); ?></span>
                                            <?php } ?>

                                        </div>
                                    </div>
                                        
                                    </div>
                                
                                <div class="text-center">

                                    <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                        Configurer la période Annuelle
                                    </button>
                                </div>
                                <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="datatablesExample2"
                                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                            <thead>
                                                <tr class="text-uppercase small">
                                                    <th>Année</th>
                                                    <th>Section</th>
                                                    <th>Periode</th>
                                                    <th>Statut</th>
                                                    <th width="1px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                if (isset($yearlyperiods) && !empty($yearlyperiods)):
                                                    foreach ($yearlyperiods as $yearlyperkey => $yearlyper):
                                                        $status = (!empty(esc($yearlyper['annualperiod_status'])) ? esc($yearlyper['annualperiod_status']) : 'inactif');
                                                        $count++;
                                                        ?>
                                                        <tr class="small">
                                                            <td><?= trim($yearlyper['year_started']);?>-<?= trim($yearlyper['year_ended']);?></td>
                                                            <td class="text-capitalize"><?= trim($yearlyper['section_name']); ?></td>
                                                            <td class="text-capitalize">
                                                                <?= trim($yearlyper['period_name']); ?>
                                                                (<?= trim($yearlyper['period_shortname']); ?>)
                                                            </td>
                                                            <td>
                                                                <a href="<?= base_url('teaching/status/annualperiod/' . esc($status) . '/' . esc($yearlyper['annualperiod_id'])); ?>"
                                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                                    <span
                                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                        <?= $status; ?> </span>
                                                                </a>
                                                            </td>
                                                            <td width="1px" class="text-center">
                                                                
                                                                <a href="<?= base_url('teaching/remove/annualperiod/' . ($yearlyper['annualperiod_id'])); ?>"
                                                                    class="btn btn-xs btn-outline-danger"
                                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer cette periode?'); false;">
                                                                    <span data-toggle="tooltip" data-placement="top"
                                                                        title="Cliquer pour supprimer cette periode">
                                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                                </a>
                                                            </td>
                                                        </tr>
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
                </div>
            </div>
        </div>
    </section>
</div>