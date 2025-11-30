<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">

                    <a data-toggle="modal" data-target="#offcanvasimages" data-backdrop="static" data-keyboard="false"
                        href="#" class="btn btn-success  text-uppercase">
                        <span data-toggle="tooltip" data-placement="top" title="Cliquer pour modifier la photo">
                            <i class="fa fa-plus"></i> Changer photo
                        </span>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Compte</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if(isset($student) && (! empty($student))): ?>
    <?php $studentavatar = $student['student_picture'];
        $avatar = base_url('public/uploads/images/' . $studentavatar);
        $defavatar = ($student['student_gender'] == 'masculin')? 'avatar.png':'expertwoman.png';
        $pathdefavatar = base_url('public/img/'.$defavatar);
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12 text-center">
                                    <h1 class="font-weight-bold text-uppercase border-bottom border-danger">
                                        Détails Dossier Apprenant </h1>
                                </div>
                                <div class="col-sm-12 col-lg-6 d-flex">
                                    <img src="<?= (!empty($studentavatar)) ? $avatar: $pathdefavatar; ?>" alt="..."
                                        class="avatar avatar-lg">

                                    <h5 class="text-uppercase font-weight-bold ml-3">
                                        N° ID: <?= (($student['student_code'])); ?> <br />
                                        <span class="text-primary">
                                            <?= (($student['student_firstname'])); ?>
                                            <?= (($student['student_lastname'])); ?>
                                            <?= (($student['student_surname'])); ?>
                                        </span>
                                        <br />
                                        <span class="text-danger">
                                            <?= ucwords(($student['section_name'])); ?>
                                            <?= ucwords(($student['option_name'])); ?>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <h5 class="font-weight-bold text-center mt-3 text-uppercase small">
                                        Notes: <?= (($student['student_notes'])); ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
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
                                    <tbody>

                                        <tr>
                                            <td>Matricule</td>
                                            <td class="text-uppercase"><?= (($student['student_code'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nom</td>
                                            <td class="text-uppercase"><?= (($student['student_firstname'])); ?> </td>
                                        </tr>

                                        <tr>
                                            <td>Postnom</td>
                                            <td class="text-uppercase"><?= (($student['student_lastname'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Prenom</td>
                                            <td class="text-uppercase"><?= (($student['student_surname'])); ?> </td>
                                        </tr>


                                        <tr>
                                            <td>Sexe</td>
                                            <td class="text-uppercase"><?= (($student['student_gender'])); ?> </td>
                                        </tr>

                                        <tr>
                                            <td>Date de naissance</td>
                                            <td class="text-uppercase"><?= (($student['student_birthday'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Lieu de naissance</td>
                                            <td class="text-uppercase"><?= (($student['student_born_place'])); ?></td>
                                        </tr>

                                        <td>Catégorie</td>
                                        <td class="text-uppercase"><?= (($student['student_type'])); ?> </td>
                                        </tr>

                                        <tr>
                                            <td>Statut</td>
                                            <td class="text-uppercase"><?= (($student['student_status'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Domaine</td>
                                            <td class="text-uppercase"><?= (($student['section_name'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Option</td>
                                            <td class="text-uppercase"><?= (($student['option_name'])); ?> </td>
                                        </tr>

                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Contact & Localisation
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Téléphone</td>
                                            <td class="text-uppercase"><?= (($student['student_phone'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="text-uppercase"><?= (($student['student_email'])); ?> </td>
                                        </tr>


                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Journalisation des actions effectuées
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Date création</td>
                                            <td class="text-uppercase">
                                                <?= (isset($student) ? esc($student['student_created_at']) : ''); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dernière modification</td>
                                            <td class="text-uppercase">
                                                <?= (isset($student) ? esc($student['student_updated_at']) : ''); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="offcanvasimages">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title d-inline-flex">
                        <span id="offcanvasEditLabel" class="h5 text-uppercase">
                            Changement photo de proifil de l'élève
                        </span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">
                                <i class="fa fa-window-close"></i>
                            </span>
                        </button>
                </div>
                <div class="modal-body">
                    <?php $validation = \Config\Services::validation();
                $attributes = array('role' => "form", 'class' => "formsend");
                echo form_open_multipart(base_url('edit-student-registration/'.$student['student_id']), $attributes); ?>
                    <div class="row">
                        <input type="hidden" name="studenttoken" value="<?= $student['student_token']; ?>" />
                        <div class="col-md-12 form-group">
                            <label for="picture" class="label-control">
                                <span class="text-danger">*</span>Charger un fichier(PNG, JPG, JPEG, WEBP)</label>
                            <input type="file" name="picture"
                                class="form-control btnrounded <?= ($validation->hasError('picture')) ? ' is-invalid' : '' ?>"
                                id="picture">
                            <span class="invalid-feedback"><?= displayFormError($validation, 'picture'); ?></span>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btnrounded">
                            Valider la photo</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajout d'un nouveau document ou bien matériel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('addNewDocument/'.$student['student_token']), $attributes);
            ?>
            <div class="modal-body">

                <div class="row">

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="hidden" id="<?= 'doc_code'.'1'; ?>" name="<?= 'doc_code'.'1'; ?>"
                                class="form-control" value="<?= setReferenceCode(); ?>">
                            <label for="<?= 'doc_code'.'1'; ?>"> <span class="text-danger">*</span>Elément</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="text" id="<?= 'doc_name'.'1'; ?>" name="<?= 'doc_name'.'1'; ?>"
                                class="form-control" placeholder="(Ex: Bulletin ou Papier)" required="true"
                                autofocus="true">
                            <label for="<?= 'doc_name'.'1'; ?>"> <span class="text-danger">*</span>Désignation /
                                Nom document</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <!-- radio -->
                        <div class="form-floating">
                            <select id="<?= 'doc_type'.'1'; ?>" name="<?= 'doc_type'.'1'; ?>" title="Type"
                                class="form-control <?= ($validation->hasError('doc_type'.'1')) ? ' is-invalid' : '' ?>"
                                style="width: 100%;">
                                <option selected disabled>-- Sélectionnez -- </option>
                                <option value="document">Document physique déposé</option>
                                <option value="divers">Bien matériel déposé </option>
                                <option value="confusque">Bien confusqué </option>
                            </select>
                            <label form="<?= 'doc_type'.'1'; ?>"><span class="text-danger">*</span>Type
                                d'élément </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="number" id="<?= 'doc_qty'.'1'; ?>" name="<?= 'doc_qty'.'1'; ?>" min="1"
                                max="10" class="form-control text-uppercase" placeholder="Ex: 2" required="true"
                                autocomplete="off" step=".01">
                            <label for="<?= 'doc_qty'.'1'; ?>"> <span class="text-danger">*</span>Quantité
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating mb-3">

                            <textarea name="<?= 'doc_notes'.'1'; ?>" id="<?= 'doc_notes'.'1'; ?>" cols="30" rows="5"
                                maxlength="500" placeholder="Descrivez ici..." class="form-control"></textarea>
                            <label for="<?= 'doc_notes'.'1'; ?>">
                                <span class="text-danger">*</span>Observation</label>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Enregistrer </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>