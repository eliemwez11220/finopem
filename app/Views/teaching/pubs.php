<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6 col-lg-6">
                    <h5 class="font-weight-bold text-uppercase text-left">Publications Résultats</h5>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Publications</li>
                        <li class="breadcrumb-item active">Résultats Scolaires</li>
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
                                    <option selected>--Sélectionnez une classe--</option>
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
            <?php if (session()->has('studentchoosedclasse')): ?>
                <div class="row mb-2">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="text-center py-3">
                                <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                    class="btn btn-success btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour publier les resultats disponibles">
                                        <i class="fa fa-check-circle"></i> Publier les résultats
                                    </span>
                                </a>
                                <a data-toggle="modal" data-target="#suspend_element" href="#"
                                    class="btn btn-danger btn-sm text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour suspendre la publication">
                                        <i class="fa fa-window-close"></i> Suspendre la publication
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
                                                        <th width="1px">Disponibilité</th>

                                                        <th>Code</th>
                                                        <th>Noms</th>
                                                        <th>Classe</th>
                                                        <th>Période</th>
                                                        <th>Place</th>
                                                        <th>%</th>
                                                        <th>Points</th>
                                                        <th>Application</th>
                                                        <th>Conduite</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if (isset($results) && !empty($results)):
                                                        foreach ($results as $key => $result):
                                                            $status = (!empty(esc($result['result_status'])) ? esc($result['result_status']) : 'inactif');
                                                            $available = esc($result['result_available']);
                                                            $classe = session()->get('studentchoosedclasse');
                                                            if (($classe == $result['classe_id']) && ($result['annualperiod_status'] == 'actif' && $result['period_status'] == 'actif')):
                                                                if (($status == 'published') OR ($status == 'pending')):
                                                                    $percentage = $result['result_percentage'];
                                                                    $points_obtained = floatval($result['result_points_obtained']);
                                                                    $points_maximum = floatval($result['result_points_maximum']);
                                                                    $result_percentage = ($percentage != 0) ? $percentage : ($points_obtained * 100 / $points_maximum);
                                                                    

                                                                    ?> 
                                                                    <tr class="small">
                                                                        <td width="1px" class="text-center">
                                                                            <a href="<?= base_url('teaching/resultStatus/' . ($result['result_id'])); ?>"
                                                                                class="btn btn-xs btn-outline-<?= ($available == 0) ? 'danger' : 'success'; ?>">
                                                                                <span data-toggle="tooltip" data-placement="top"
                                                                                    title="Cliquer pour valider cette information">
                                                                                    <i
                                                                                        class="fa fa-<?= ($available == 0) ? 'window-close' : 'check-circle'; ?> fa-lg"></i>
                                                                                    <?= ($available == 0) ? 'Indisponible' : 'Disponible'; ?></span>
                                                                            </a>
                                                                        </td>
                                                                        <td class="text-uppercase">
                                                                            <?= strtoupper($result['student_code']); ?> 
                                                                            </td>
                                                                        <td>
                                                                            <?= strtoupper($result['student_firstname']); ?>
                                                                            <?= strtoupper($result['student_lastname']); ?>
                                                                            <?= strtoupper($result['student_surname']); ?>
                                                                            </td>
                                                                            
                                                                            <td class="text-uppercase">
                                                                            <?= strtoupper(trim($result['classe_shortname'])); ?>

                                                                        </td>
                                                                        <td class="text-uppercase"><?= trim($result['period_shortname']); ?>
                                                                        </td>
                                                                        <td class="text-capitalize"><?= trim($result['result_place']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= number_format($result_percentage, 2); ?>
                                                                        </td>
                                                                        
                                                                        <td><?= trim($result['result_points_obtained']); ?>/<?= trim($result['result_points_maximum']); ?></td>
                                                                    <td><?= trim($result['result_decision']); ?></td>
                                                                    <td><?= trim($result['result_application']); ?></td>
                                                                        <td class="text-uppercase">
                                                                            <a href="<?= base_url('teaching/status/result/' . esc($status) . '/' . esc($result['result_id'])); ?>"
                                                                                onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                                                <span
                                                                                    class="badge badge-<?= setStatusColors($status); ?> text-uppercase py-1">
                                                                                    <?= getStatusValues($status); ?>
                                                                                </span>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                <?php endif; ?>
                                                            <?php endif; ?>
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



                <!-- Creation nouvelle annee scolaire -->
                <div class="modal fade" id="nouvel_element">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-uppercase">
                                <h4 class="modal-title font-weight-bold">Publication résultats</h4>

                                <p> Mise en ligne des resultats disponibles </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                                </button>
                            </div>
                            <?php
                            $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('teaching-pubs'), $attributes);
                            ?>
                            <div class="modal-body">
                                <input type="hidden" value="1" name="pubs">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <select id="classe" name="classe" title="Classe"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                                <option disabled selected>--Sélectionnez une classe--</option>
                                                <option value="all">Toutes les classes</option>
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

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                                </button>
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                    Publier les résultats
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <!-- Creation nouvelle annee scolaire -->
                <div class="modal fade" id="suspend_element">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-uppercase">
                                <h4 class="modal-title font-weight-bold">Suspension Publication</h4>

                                <p> Retirer les resultats en ligne </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                                </button>
                            </div>
                            <?php
                            $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('teaching-pubs'), $attributes);
                            ?>
                            <div class="modal-body">
                                <input type="hidden" value="0" name="pubs">
                                <div class="row">

                                    <div class="col-lg-12 col-sm-12 mb-2">
                                        <div class="form-floating">
                                            <select id="classe" name="classe" title="Classe"
                                                class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info">
                                                <option disabled selected>--Sélectionnez une classe--</option>
                                                <option value="all">Toutes les classes</option>
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

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                                </button>
                                <button type="submit" class="btn btn-info btn-sm text-uppercase">
                                    Suspendre la publication des résultats
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