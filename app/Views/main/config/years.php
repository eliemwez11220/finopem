<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="font-weight-bold">Paramètrages des années académiques</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Paramètrages</li>
                                <li class="breadcrumb-item active">Années Académiques</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content <?= checkModuleAccess('years'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold">Liste des années Académiques</h5>
                            </div>
                            <div class="card-tools float-right">
                                <a data-toggle="modal" data-target="#nouvelle_annee" href="#"
                                    class="btn btn-dark  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour créer une nouvelle année">
                                        <i class="fa fa-plus"></i> Nouvelle Année
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
                                            <th>#</th>
                                            <th>Année d'études</th>
                                            <th>Début</th>
                                            <th>Fin</th>
                                            <th>Statut</th>
                                            <th>Ouverture</th>
                                            <th>Femeture</th>
                                            <th width="1px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                    $count = 1;
                                    if (isset($years) && !empty($years)):
                                        foreach ($years as $key => $value):
                                            $status = (!empty(($value['year_status'])) ? ($value['year_status']) : 'inactif');
                                            ?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['year_started']); ?>-<?= esc($value['year_ended']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= ($value['year_started']); ?></td>
                                            <td class="text-uppercase"><?= ($value['year_ended']); ?></td>
                                            <td>
                                                <a href="<?= base_url('main/changeStatus/year/' . esc($status) . '/' . esc($value['year_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= ($status == 'actif') ? 'Ouverte' : 'Fermée'; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= esc($value['year_start_date']); ?></td>
                                            <td class="text-uppercase"><?= esc($value['year_close_date']); ?></td>
                                            <td width="1px" class="text-center">
                                                <a href="<?= base_url('main/editForm/year/' . esc($value['year_id'])); ?>"
                                                    class="btn btn-xs btn-outline-warning" data-toggle="modal"
                                                    data-target="#edit_year_<?= esc($value['year_id']); ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier cette information">
                                                        <i class="fa fa-edit fa-2x"></i></span>
                                                </a>
                                                <?php $access_delete = (session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>

                                                <a href="<?= base_url('main/remove/year/' . ($value['year_id'])); ?>"
                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer cette annee?'); false;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer cette annee">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Creation nouvelle annee scolaire -->
                                        <div class="modal fade" id="edit_year_<?= esc($value['year_id']); ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title font-weight-bold">Modification de l'année
                                                            <?= esc($value['year_started']); ?>-<?= esc($value['year_ended']); ?>
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true" class="text-danger"><i
                                                                    class="fa fa-window-close"></i></span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open(base_url('edit-school-year/'.esc($value['year_token'])), $attributes);
                                                    ?>
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">

                                                                    <input type="text"
                                                                        class="form-control bg-light text-capitalize"
                                                                        name="start_year" id="start_year"
                                                                        value="<?= esc($value['year_started']) ? esc($value['year_started']) : set_value('start_year') ?>"
                                                                        required autofocus />
                                                                    <label for="start_year" class="control-label">
                                                                        <span class="text-danger">*</span>Année Début
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                                                                <div class="form-floating">

                                                                    <input type="text"
                                                                        class="form-control bg-light text-capitalize"
                                                                        name="end_year" id="end_year"
                                                                        value="<?= esc($value['year_ended']) ? esc($value['year_ended']) : set_value('end_year') ?>"
                                                                        required />
                                                                    <label for="end_year" class="control-label">
                                                                        <span class="text-danger">*</span>Année
                                                                        fermeture
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <div class="form-floating">
                                                                    <input type="date"
                                                                        class="form-control bg-light text-capitalize"
                                                                        name="started_year_at" id="started_year_at"
                                                                        value="<?= esc($value['year_start_date']) ? esc($value['year_start_date']) :set_value('started_year_at') ?>" />
                                                                    <label for="started_year_at" class="control-label">
                                                                        <span class="text-danger">*</span>Date
                                                                        d'ouverture </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                                                <div class="form-floating">

                                                                    <input type="date"
                                                                        class="form-control bg-light text-capitalize"
                                                                        name="closing_year_at" id="closing_year_at"
                                                                        value="<?= esc($value['year_close_date']) ? esc($value['year_close_date']) :set_value('closing_year_at') ?>" />
                                                                    <label for="closing_year_at" class="control-label">
                                                                        <span class="text-danger">*</span>Date de
                                                                        fermeture
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mt-3">
                                                                <div class="form-floating">

                                                                    <textarea rows="5" cols="30"
                                                                        class="form-control bg-light" name="notes"
                                                                        placeholder="Plus de détails sur la nouvelle"
                                                                        id="notes"><?= esc($value['year_notes']) ? esc($value['year_notes']) :set_value('notes'); ?></textarea>
                                                                    <label for="notes" class="control-label">
                                                                        <span class="text-danger"></span>Observation
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Annuler </button>
                                                        <button type="submit"
                                                            class="btn btn-info text-uppercase">Valider les
                                                            modifications de l'année</button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
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
<div class="modal fade" id="nouvelle_annee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">Lancement d'une nouvelle année académique</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $last_year = '';
            $new_year = '';
            $mounth = date('m');
            switch ($mounth) {
                case '06':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    $next_year = date('Y') + 2;
                    break;
                case '07':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    $next_year = date('Y') + 2;
                    break;
                case '08':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    $next_year = date('Y') + 2;
                    break;
                case '09':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    $next_year = date('Y') + 2;
                    break;
                case '10':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    $next_year = date('Y') + 2;
                    break;
                case '12':
                    $last_year = date('Y');
                    $new_year = date('Y') + 1;
                    $next_year = date('Y') + 2;
                    break;
                default:
                    $last_year = date('Y') - 1;
                    $previous_year = date('Y') - 2;
                    $new_year = date('Y');
            }
            //$school_year = $last_year . '-' . $new_year;
            //new code generated automatically
            //$aleatoire_value = "0123456789";
            //$new_code_generate = "Y" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5);

            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-school-year'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="text" class="form-control bg-light text-capitalize" name="start_year"
                                id="start_year"
                                value="<?= (!empty($last_year)) ? $last_year : set_value('start_year') ?>" required
                                autofocus />
                            <label for="start_year" class="control-label">
                                <span class="text-danger">*</span>Année Début </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="text" class="form-control bg-light text-capitalize" name="end_year"
                                id="end_year" value="<?= (!empty($new_year)) ? $new_year : set_value('end_year') ?>"
                                required />
                            <label for="end_year" class="control-label">
                                <span class="text-danger">*</span>Année fermeture
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-floating">
                            <input type="date" class="form-control bg-light text-capitalize" name="started_year_at"
                                id="started_year_at" value="<?= set_value('started_year_at') ?>" />
                            <label for="started_year_at" class="control-label">
                                <span class="text-danger">*</span>Date d'ouverture </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-floating">

                            <input type="date" class="form-control bg-light text-capitalize" name="closing_year_at"
                                id="closing_year_at" value="<?= set_value('closing_year_at') ?>" />
                            <label for="closing_year_at" class="control-label">
                                <span class="text-danger">*</span>Date de fermeture
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mt-3">
                        <div class="form-floating">

                            <textarea rows="5" cols="30" class="form-control bg-light" name="notes"
                                placeholder="Plus de détails sur la nouvelle"
                                id="notes"><?= set_value('notes'); ?></textarea>
                            <label for="notes" class="control-label">
                                <span class="text-danger"></span>Observation
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-info text-uppercase">Lancer l'année académique</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->