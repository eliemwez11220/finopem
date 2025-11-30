<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6 col-lg-6">
                    <h5 class="font-weight-bold text-uppercase text-left">Résultats</h5>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Résultats</li>
                        <li class="breadcrumb-item active">Scolaires</li>
                    </ol>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <form role="form" id="ajax_form_sections" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_sections" name="ajax_sections" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez une section--</option>
                                <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                    <option value="all">Toutes les sections</option>
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
                                <span class="text-danger">*</span>Sections organisées</label>
                        </div>
                    </form>
                </div>

                <div class="col-sm-3 col-lg-3">
                    <?php if (session()->has('choosedsectionid')): ?>
                        <form role="form" id="form_students_classes" method="get">
                            <div class="form-floating input-group" style="width: 100%!important;">
                                <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                    class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                    <option disabled selected>--Sélectionnez une classe--</option>
                                    <?php if (isset($classes) && !empty($classes)):
                                        foreach ($classes as $key => $clasvalue):
                                            $branch_access = session()->get('choosedsectionid');
                                            if (($branch_access == $clasvalue['section_id'])):

                                                $classe_sess = session()->has('studentchoosedclasse') ? session()->get('studentchoosedclasse') : '';
                                                ?>
                                                <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                    <?= ($classe_sess == $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                                    <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                    <?= ucfirst($clasvalue['classe_subname']); ?>
                                                    <?= ucfirst($clasvalue['option_name']); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="ajax_students_classes"><span class="text-danger">*</span>Classes des
                                    élèves</label>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </section>
    <section class="content <?= checkModuleAccess('timing'); ?>">
        <div class="container-fluid">
            <?php if (session()->has('choosedsectionid') && session()->has('studentchoosedclasse')): ?>

                <div class="row mb-2">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="text-center py-3">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-info btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer les Critères de validation">
                                        <i class="fa fa-plus"></i> Critères de validation des résultats
                                    </span>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="datatablesExample2"
                                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr class="text-uppercase small">
                                                        <th width="1px">Actions</th>
                                                        <th>Frais Critère</th>
                                                        <th>Classe</th>
                                                        <th>Période</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($results_criteria) && !empty($results_criteria)):
                                                        foreach ($results_criteria as $key => $valcriteria):
                                                            $status = esc($valcriteria['criteria_status']);
                                                           
                                                            $branch_access = session()->get('studentchoosedclasse');

                                                            if (($branch_access == $valcriteria['criteria_classe_id']) && ($valcriteria['annualperiod_status'] == 'actif' && $valcriteria['period_status'] == 'actif')):

                                                            ?>
                                                                <tr class="small">
                                                                   <td>
                                                                   <?php $access_delete = (session()->admin == TRUE or session()->all == TRUE) ? '' : 'disabled'; ?>

                                                                   <a href="<?= base_url('teaching/remove/criteria/' . ($valcriteria['criteria_id'])); ?>"
                                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer ce Critère?'); false;">
                                                                    <span data-toggle="tooltip" data-placement="top"
                                                                        title="Cliquer pour supprimer ce Critère">
                                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                                </a>
                                                                   </td>
                                                                    <td class="text-uppercase">
                                                                        <?= trim($valcriteria['fee_name']); ?>
                                                                        <?= trim($valcriteria['feedetail_name']); ?>
                                                                    </td>
                                                                    <td class="text-uppercase">
                                                                        <?= setDegresLevels($valcriteria['degree_code'], 'f'); ?>
                                                                        <?= ucfirst($valcriteria['classe_subname']); ?>
                                                                        <?= ucfirst($valcriteria['option_name']); ?>
                                                                    </td>
                                                                    <td class="text-uppercase fw-bold"><?= trim($valcriteria['period_name']); ?></td>
                                                                    <td class="text-uppercase">
                                                                        <a href="<?= base_url('teaching/status/criteria/' . esc($status) . '/' . esc($valcriteria['criteria_id'])); ?>"
                                                                            onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                                            <span
                                                                                class="badge badge-<?= setStatusColors($status); ?> text-uppercase py-1">
                                                                                <?= getStatusValues($status); ?>
                                                                            </span>
                                                                        </a>
                                                                    </td>
                                                                </tr>

                                                            <?php endif; ?>
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
                </div>



                <!-- Creation nouvelle annee scolaire -->
                <div class="modal fade" id="nouvel_element">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Configuration Critère</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                                </button>
                            </div>
                            <?php
                            $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('teaching-criteria'), $attributes);
                            ?>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <select id="classe" name="classe" title="Classe"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                                <option disabled selected>--Sélectionnez une classe--</option>
                                                <?php if (isset($classes) && !empty($classes)):
                                                    foreach ($classes as $key => $clasvalue):
                                                        $branch_access = session()->get('choosedsectionid');
                                                        if (($branch_access == $clasvalue['section_id'])):

                                                            $classe_sess = session()->has('studentchoosedclasse') ? session()->get('studentchoosedclasse') : '';
                                                            ?>
                                                            <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                                <?= ($classe_sess == $clasvalue['classe_id']) ? 'selected' : set_select('classe', esc($clasvalue['classe_id'])); ?>>
                                                                <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                                <?= ucfirst($clasvalue['classe_subname']); ?>
                                                                <?= ucfirst($clasvalue['option_name']); ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <label for="classe">
                                                <span class="text-danger">*</span>Classes des
                                                élèves</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                <div class="form-floating mb-2">

                                    <select
                                        class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('period')) ? ' is-invalid' : '' ?>"
                                        id="period" name="period" data-dropdown-css-class="select2-info"
                                        style="width: 100%;">
                                        <option disabled>sélectionnez une période
                                        </option>

                                        <?php if (isset($yearlyperiods) && !empty($yearlyperiods)):
                                            foreach ($yearlyperiods as $perkey => $pervalue):
                                                $branch_access = session()->get('choosedsectionid');
                                                if (($branch_access == $pervalue['section_id'])):
                                                    if ($pervalue['annualperiod_status'] == 'actif' && $pervalue['period_status'] == 'actif'):
                                        ?>
                                                        <option selected value="<?= esc($pervalue['annualperiod_id']); ?>" <?= set_select('period', esc($pervalue['annualperiod_id'])); ?>>

                                                            <?= strtoupper($pervalue['period_name']); ?>
                                                            (<?= strtoupper($pervalue['period_shortname']); ?>)
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="period"><span class="text-danger">*</span>
                                        Périodes d'encodage</label>
                                    <?php if ($validation->hasError('period')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError(field: 'period'); ?></span>
                                    <?php } ?>

                                </div>
                            </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-floating">

                                            <select id="fee" name="fee" title="fee"
                                                class="form-control select2 select2-info text-uppercase font-weight-bold"
                                                data-dropdown-css-class="select2-info">
                                                <option disabled selected>-- sélectionnez le frais-- </option>

                                                <?php if (isset($feesclasses) && !empty($feesclasses)):
                                                    foreach ($feesclasses as $keyfee => $feesclasse): ?>
                                                        <option value="<?= esc($feesclasse['feedetail_id']); ?>"
                                                            <?= set_select('fee', esc($feesclasse['feedetail_id'])); ?>>
                                                            <?= strtoupper($feesclasse['fee_name']); ?> -
                                                            <?= (strtoupper($feesclasse['feedetail_name'])); ?>

                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <label for="fee" class="font-weight-bold">
                                                <span class="text-danger">*</span>Frais a vérifier
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                                </button>
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                    Valider les résultats
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>