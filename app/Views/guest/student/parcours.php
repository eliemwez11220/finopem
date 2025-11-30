<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Détails Parcours</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="card-tools printoff">
                        
                        <div class="float-right">
                        <a href="javascript:void();" class="text-uppercase btn btn-success btn-sm"
                            onclick="window.print();">
                            <i class="fa fa-print"></i> IMPRIMER(Ctrl + P)</a>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- tables -->
                    <?php if (isset($student) && (!empty($student))): ?>

                    <!--Card-->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header bg-info text-center">
                                <h1 class="text-uppercase font-weight-bold">
                                    <span class="h3 font-weight-bold">
                                        Parcours de l'apprenant
                                    </span>
                                    <br />
                                    <span class="text-primary h2">
                                        <?= (($student['student_firstname'])); ?>
                                        <?= (($student['student_lastname'])); ?>
                                        <?= (($student['student_surname'])); ?>,
                                    </span>

                                    <span class="text-danger h2">
                                        Matricule: <?= (($student['student_code'])); ?>
                                    </span>

                                </h1>

                            </div>

                        </div>
                        <!--Card content-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-hover" id="datatablesReportingActions">
                                    <thead>
                                        <tr class="text-uppercase text-center small">
                                            <th class="text-center">#</th>
                                            <th>Année</th>
                                            <th>Option</th>
                                            <th>Domaine</th>
                                            <th>Etat</th>
                                            <th>Incription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($parcours)&& (!empty($parcours))) :
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($parcours as $value) :
                                            $status = (!empty(esc($value['inscription_status'])) ? esc($value['inscription_status']) : 'inactif');
                                             ?>
                                        <tr class="small text-center">
                                            <td class="text-center"><?= $count++; ?></td>
                                            <td class="text-uppercase">
                                                <?= $value['year_started']; ?>-<?= $value['year_ended']; ?>
                                            </td>
                                            <td class="text-uppercase"><?= ucwords($value['option_name']); ?> </td>
                                            <td class="text-uppercase"><?= ucwords($value['section_name']); ?></td>
                                            <td class="text-uppercase">
                                                <a href="<?= base_url('student/changeStatus/inscription/' . esc($status) . '/' . esc($value['inscription_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= $value['inscription_date']; ?></td>

                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/.Card-->
                    <?php endif; ?>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvelle_annee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Enregistrement parcours élève</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php

                    //form validation services call
            $validation = \Config\Services::validation();

            $eleve_reference = isset($student) ? esc($student['student_id']) : '';
            
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('add-school-career/'.$eleve_reference), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="annee_scolaire" class="control-label">
                                <span class="text-danger">*</span> Année Scolaire
                            </label>
                            <select id="annee_scolaire" name="annee_scolaire" class="form-control select2 select2-info"
                                data-dropdown-css-class="select2-info">
                                <option disabled selected>-- Année Scolaire --</option>
                                <?php
                                            $count = 1;
                                            if (isset($years) && !empty($years)):
                                                foreach ($years as $key => $year): ?>
                                <option value="<?= esc($year['year_id']); ?>"
                                    <?= set_select('annee_scolaire', esc($year['year_id'])); ?>>
                                    <?= (esc($year['year_started'])); ?>-<?= (esc($year['year_ended'])); ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if ($validation->hasError('annee_libelle')) { ?>
                            <span class="invalid-feedback"> <?= $validation->getError('annee_libelle'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">

                        <div class="form-group">
                            <label for="classe_eleve"><span class="text-danger">*</span>Classe</label>
                            <select
                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('classe_eleve')) ? ' is-invalid' : '' ?>"
                                id="classe_eleve" name="classe_eleve" data-dropdown-css-class="select2-info"
                                style="width: 100%;">
                                <option selected="selected" disabled>-- Sélectionnez une classe --</option>
                                <?php
                                            $count = 1;
                                            if (isset($classes) && !empty($classes)):
                                                foreach ($classes as $key => $value): ?>
                                <option value="<?= esc($value['classe_id']); ?>"
                                    <?= set_select('classe_eleve', esc($value['classe_id'])); ?>>
                                    <?= setDegresLevels(($value['degree_code'])); ?>
                                    <?= ucfirst(($value['option_name'])); ?>
                                    <?= ucfirst(($value['section_name'])); ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php if ($validation->hasError('classe_eleve')) { ?>
                            <span class="invalid-feedback"> <?= $validation->getError('classe_eleve'); ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-xs-12">

                        <div class="form-group">
                            <label for="date_inscription"><span class="text-danger">*</span>Date d'inscription</label>
                            <div class="input-group date" id="date_format_abrege" data-target-input="nearest">
                                <input type="date"
                                    class="form-control datetimepicker-input <?= ($validation->hasError('date_inscription')) ? ' is-invalid' : '' ?>"
                                    id="date_inscription" value="<?= set_value('date_inscription') ?>"
                                    data-target="#date_format_abrege" name="date_inscription" />
                                <div class="input-group-append" data-target="#date_format_abrege"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <?php if ($validation->hasError('date_inscription')) { ?>
                            <span class="invalid-feedback"> <?= $validation->getError('date_inscription'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    </td>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="ecole_provenance"><span class="text-danger">*</span>
                                Ecole de ce parcours</label>
                            <input type="text" name="ecole_provenance" id="ecole_provenance"
                                class="form-control <?= ($validation->hasError('ecole_provenance')) ? ' is-invalid' : '' ?>"
                                value="<?= set_value('ecole_provenance'); ?>" placeholder="Nom Ecole Provenance">

                            <?php if ($validation->hasError('ecole_provenance')) { ?>
                            <span class="invalid-feedback"> <?= $validation->getError('ecole_provenance'); ?></span>
                            <?php } ?>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer parcours</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->