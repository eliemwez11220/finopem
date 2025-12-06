<!--
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Apr-21
 * Time: 10:20 AM
 */
 -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <a href="<?= base_url('student/parents'); ?>"
                            class="btn btn-info btn-rounded text-uppercase btn-xs">
                            <i class="fas fa-reply fa-lg"></i> Liste contacts
                        </a>

                        <a href="<?= base_url('student/editForm/parent/' . $parent['parent_id']); ?>"
                            class="btn btn-primary btn-rounded text-uppercase btn-xs">
                            <i class="fa fa-edit"></i> Modifier fiche contact
                        </a>
                    </div>
                    <div class="card-tools float-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('overview') ?>">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Contacts</li>
                            <li class="breadcrumb-item active">étudiants</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (isset($parent) && (!empty($parent))): ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1 class="font-weight-bold text-uppercase">
                                Détails fiche contacts étudiants
                            </h1>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th width="20%"></th>
                                            <th width="80%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        <tr>
                                            <td>Identifiant contact</td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_code']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Téléphone Responsable Principal </td>
                                            <td class="text-uppercase">

                                                <?= (isset($parent)) ? esc($parent['parent_primary_phone']) : 'Aucun libelle'; ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Email Responsable Principal </td>
                                            <td class="text-lowercase">
                                                <a
                                                    href="mailto:<?= (isset($parent)) ? esc($parent['parent_primary_email']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_primary_email']) : 'Aucun libelle'; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Adresse résidence responsable Principal</td>
                                            <td class="text-uppercase">
                                                <?php if(isset($address) && !empty($address)): ?>

                                                No <?= $address['address_home_code']; ?>,
                                                Av. <?= $address['address_area_name']; ?>,
                                                Rue <?= $address['address_street_name']; ?>,
                                                Q/ <?= $address['district_name']; ?>,
                                                C/ <?= $address['municipality_name']; ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Nom du père </td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_father_name']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Profession du père </td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_father_job']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td> Téléphone du père </td>
                                            <td class="text-uppercase">
                                                <a
                                                    href="tel:<?= (isset($parent)) ? esc($parent['parent_father_phone']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_father_phone']) : ' '; ?>
                                                </a> /

                                                <a
                                                    href="tel:<?= (isset($parent)) ? esc($parent['parent_father_phone2']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_father_phone2']) : ' '; ?>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Nom de la mère </td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_mother_name']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Profession de la mère </td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_mother_job']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Téléphone de la mère </td>
                                            <td class="text-uppercase">
                                                <a
                                                    href="tel:<?= (isset($parent)) ? esc($parent['parent_mother_phone']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_mother_phone']) : ' '; ?>
                                                </a> / <a
                                                    href="tel:<?= (isset($parent)) ? esc($parent['parent_mother_phone2']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_mother_phone2']) : ' '; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nom Tuteur</td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_tutor_name']) : 'Aucun'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Profession Tuteur </td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_tutor_job']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Téléphone Tuteur </td>
                                            <td class="text-uppercase">
                                                <a
                                                    href="tel:<?= (isset($parent)) ? esc($parent['parent_tutor_phone']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_tutor_phone']) : ' '; ?>
                                                </a> / <a
                                                    href="tel:<?= (isset($parent)) ? esc($parent['parent_tutor_phone2']) : ''; ?>">
                                                    <?= (isset($parent)) ? esc($parent['parent_tutor_phone2']) : ' '; ?>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label for="timepicker">Statut visibilite:</label></td>
                                            <td class="text-uppercase">
                                                <span class="badge badge-info">
                                                    <?= (isset($parent)) ? esc($parent['parent_status']) : 'Aucun libelle'; ?>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Crée le</td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_created_at']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mise à jour le</td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_updated_at']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Supprimé le</td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_deleted_at']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="commentaire_annee">Observation ou commentaire:</label></td>
                                            <td class="text-uppercase">
                                                <?= (isset($parent)) ? esc($parent['parent_notes']) : 'Aucun libelle'; ?>
                                            </td>
                                        </tr>
                                        <?php if(isset($address) && !empty($address)): ?>
                                        <tr>
                                            <td>Commune</td>
                                            <td class="text-uppercase">
                                                <?= esc($address['municipality_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quartier</td>
                                            <td class="text-uppercase">
                                                <?= esc($address['district_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Avenue</td>
                                            <td class="text-uppercase">
                                                <?= esc($address['address_area_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rue</td>
                                            <td class="text-uppercase">
                                                <?= esc($address['address_street_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Numéro</td>
                                            <td class="text-uppercase">
                                                <?= esc($address['address_home_code']); ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!-- /.card-header -->
                        <div class="card-footer">
                            <div class="text-center font-weight-bold text-uppercase">
                                Liste des étudiants attachés
                            </div>
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">
                                        <th>Détails</th>
                                            <th>#</th>
                                            <th>Matricule</th>
                                            <th>Noms</th>
                                            <th>Sexe</th>
                                            <th>Promotion</th>
                                            <th>Etat</th>
                                            <th>Provenance</th>
                                            <th>Inscription</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        <?php
                                            $count = 1;
                                            if (isset($students) && !empty($students)):
                                                foreach ($students as $key => $value):
                                                    $status = (!empty(esc($value['student_status'])) ? esc($value['student_status']) : 'inactif');
                                                    ?>
                                        <tr class="small">
                                        <td width="2px" class="text-center">
                                                <a href="<?= base_url('student/editForm/inscription/' . esc($value['inscription_id'])); ?>"
                                                    class="btn btn-xs btn-outline-warning" data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>

                                                <a href="<?= base_url('student/details/inscription/' . esc($value['inscription_id'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                                </a>
                                            </td>
                                            <td scope="1"><?= $count++; ?></td>

                                            <td class="text-uppercase"><?= esc($value['student_code']); ?></td>
                                            <td class="text-uppercase">
                                                <?= esc($value['student_firstname']); ?>
                                                <?= esc($value['student_lastname']); ?>
                                                <?= esc($value['student_surname']); ?>

                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($value['student_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= setDegresLevels(($value['degree_code'])); ?>
                                                <?= ucfirst(($value['classe_subname'])); ?>
                                                <?= ucfirst(($value['option_name'])); ?>
                                            <td>
                                                <a href="<?= base_url('student/changeStatus/inscription/' . esc($status) . '/' . esc($value['inscription_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= esc($value['inscription_origin_school']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= esc($value['inscription_created_at']); ?>
                                            </td>
                                            
                                        </tr>
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
    </section>
    <?php endif; ?>
</div>