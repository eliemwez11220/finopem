<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= base_url('student/listing'); ?>" class="btn btn-info btn-rounded text-uppercase">
                        <i class="fas fa-reply fa-lg"></i> </a>

                    <a href="<?= base_url('student/editForm/inscription/'.$student['inscription_id']); ?>"
                        class="btn btn-primary btn-rounded text-uppercase">
                        <i class="fa fa-edit"></i> Modifier dossier étudiant
                    </a>
                    <a data-toggle="modal" data-target="#offcanvasimages" data-backdrop="static" data-keyboard="false"
                        href="#" class="btn btn-success  text-uppercase">
                        <span data-toggle="tooltip" data-placement="top" title="Cliquer pour modifier la photo">
                            <i class="fa fa-plus"></i> Changer photo étudiant
                        </span>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Dossiers</li>
                        <li class="breadcrumb-item active">Etudiants</li>
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
                                    <h1 class="font-weight-bold text-uppercase border-bottom border-danger">Détails
                                        dossier étudiant </h1>
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
                                            <?= setDegresLevels(($student['degree_code'])); ?>
                                            <?= ucfirst(($student['classe_subname'])); ?>
                                            <?= ucfirst(($student['option_name'])); ?>
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
                                            <td>Matricule étudiant</td>
                                            <td class="text-uppercase"><?= (($student['student_code'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Identifiant</td>
                                            <td class="text-uppercase"><?= (($student['student_sernie_id'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nom étudiant</td>
                                            <td class="text-uppercase"><?= (($student['student_firstname'])); ?> </td>
                                        </tr>

                                        <tr>
                                            <td>Postnom étudiant</td>
                                            <td class="text-uppercase"><?= (($student['student_lastname'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Prenom étudiant</td>
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

                                        <tr>
                                            <td>Ecole provenance</td>
                                            <td class="text-uppercase"><?= (($student['inscription_origin_school'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Numéro permanent</td>
                                            <td class="text-uppercase"><?= (($student['student_permanent_code'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Province d'origine</td>
                                            <td class="text-uppercase"><?= (($student['student_province'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Territoire d'origine</td>
                                            <td class="text-uppercase"><?= (($student['student_territory'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Secteur d'origine</td>
                                            <td class="text-uppercase"><?= (($student['student_sector'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Groupement d'origine</td>
                                            <td class="text-uppercase"><?= (($student['student_grouping'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Village d'origine</td>
                                            <td class="text-uppercase"><?= (($student['student_village'])); ?>
                                            </td>
                                        </tr>

                                        <td>Catégorie</td>
                                        <td class="text-uppercase"><?= (($student['student_type'])); ?> </td>
                                        </tr>

                                        <tr>
                                            <td>Statut</td>
                                            <td class="text-uppercase"><?= (($student['student_status'])); ?> </td>
                                        </tr>
                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Infos sur la promotion
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sous-promo</td>
                                            <td class="text-uppercase">
                                                <?= ucfirst(($student['classe_subname'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Degrès</td>
                                            <td class="text-uppercase">
                                                <?= ucfirst(($student['classe_subname'])); ?>
                                                <?= setDegresLevels(($student['degree_code'])); ?>
                                                <?= (($student['degree_name'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Section</td>
                                            <td class="text-uppercase"><?= (($student['section_name'])); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Filiere</td>
                                            <td class="text-uppercase"><?= (($student['option_name'])); ?> </td>
                                        </tr>
                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Infos sur les responsables
                                                </strong>
                                                <a href="<?= base_url('student/details/parent/'. esc($student['parent_id'])); ?>"
                                                    class="btn btn-xs btn-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-lg">Voir fiche contact</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tuteur</td>
                                            <td class="text-uppercase">
                                                <?= (($student['parent_tutor_name'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Père</td>
                                            <td class="text-uppercase">
                                                <?= (($student['parent_father_name'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mère</td>
                                            <td class="text-uppercase">
                                                <?= (($student['parent_mother_name'])); ?>
                                            </td>
                                        </tr>


                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Contact & Localisation étudiant
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
                                        <tr>
                                            <td>Adresse</td>
                                            <td class="text-uppercase"><?= (($student['student_address'])); ?> </td>
                                        </tr>

                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Observation générale, Santé et application
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Observation Générale</td>
                                            <td class="text-uppercase"><?= (($student['student_notes'])); ?> </td>
                                        </tr>


                                        <tr class="alert alert-secondary">
                                            <td colspan="2" class="text-uppercase">
                                                <strong>
                                                    Journalisation des actions effectuées sur étudiants
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
                                        <tr>
                                            <td>Date suppression</td>
                                            <td class="text-uppercase">
                                                <?= (isset($student) ? esc($student['student_deleted_at']) : ''); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">

                            <h5 class="text-uppercase font-weight-bold">Fiche de renseignement sur étudiant </h5>

                            <a href="" class="btn btn-default btn-sm text-uppercase" target="_blank">
                                Voir les details de la fiche</a>
                            <embed src="" type="application/pdf" controls
                                style="height:50%!important;width:100%!important;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <blockquote>
                                <div class="text-left">
                                    <span class="font-weight-bold h3">
                                        <i class="fas fa-folder"></i>
                                        DOCUMENTS ET AUTRES BIENS DEPOSES
                                    </span>
                                </div>
                                <div class="card-tools float-right">
                                    <a data-toggle="modal" data-target="#nouvel_element" href="#"
                                        class="btn btn-info text-uppercase">
                                        <span data-toggle="tooltip" data-placement="top"
                                            title="Cliquer pour créer un nouveau type">
                                            <i class="fa fa-plus"></i> Nouvel élément
                                        </span>
                                    </a>
                                </div>
                            </blockquote>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-hover" id="datatablesExample2">
                                    <thead>
                                        <tr class="text-uppercase text-center small">
                                            <th class="text-center">#</th>
                                            <th>Désignation</th>
                                            <th>Catégorie</th>
                                            <th>Quantité</th>
                                            <th>Observation</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th>Delivrée</th>
                                            <th>Validité</th>
                                            <th>Référence</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($documents)&& (!empty($documents))) :
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($documents as $document) :
                                            $status = (!empty(($document['document_status'])) ? ($document['document_status']) : 'inactif');
                                             ?>
                                        <tr class="small">
                                            <td class="text-center"><?= $count++; ?></td>
                                            <td class="text-uppercase">
                                                <?= $document['document_name']; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= setDocumentType($document['document_type']); ?>
                                            </td>
                                            <td class="text-uppercase"><?= (($document['document_quantity'])); ?> </td>
                                            <td class="text-uppercase"><?= $document['document_notes']; ?></td>
                                            <td class="text-uppercase">
                                                <a href="<?= base_url('student/changeStatus/document/' . ($status) . '/' . ($document['document_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= $document['document_created_at']; ?></td>
                                            <td class="text-uppercase"><?= $document['document_delivery_date']; ?></td>
                                            <td class="text-uppercase"><?= $document['document_validity_date']; ?></td>
                                            <td class="text-uppercase"><?= $document['document_number']; ?></td>

                                            <td>
                                                <a data-toggle="modal"
                                                    data-target="#update_<?= $document['document_id']; ?>" href="#"
                                                    class="btn btn-primary  btn-sm">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <a class="btn btn-sm btn-outline-danger"
                                                    href="<?= base_url('student/remove/document/'.$document['document_id']); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment annulé ce document? cette opération est irreversible après confirmation.');">

                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer">
                                                        <i class="fa fa-window-close"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Creation nouvelle annee scolaire -->
                                        <div class="modal fade" id="update_<?= $document['document_id']; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modification de
                                                            <?= $document['document_name']; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true" class="text-danger"><i
                                                                    class="fa fa-window-close"></i></span>
                                                        </button>
                                                    </div>
                                                    <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('studentAddDocuments/'.$student['student_token'].'/'.$document['document_token']), $attributes);
            ?>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-sm-12 col-lg-8 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text" id="<?= 'doc_name'.'1'; ?>"
                                                                        name="<?= 'doc_name'; ?>" class="form-control"
                                                                        placeholder="(Ex: Bulletin ou Papier)"
                                                                        required="true" autofocus="true"
                                                                        value="<?= $document['document_name']; ?>">
                                                                    <label for="<?= 'doc_name'.'1'; ?>"> <span
                                                                            class="text-danger">*</span>
                                                                        Désignation</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-lg-4 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="number" id="<?= 'doc_qty'.'1'; ?>"
                                                                        name="<?= 'doc_qty'; ?>" min="1" max="10"
                                                                        class="form-control text-uppercase"
                                                                        placeholder="Ex: 2" required="true"
                                                                        autocomplete="off" step=".01"
                                                                        value="<?= $document['document_quantity']; ?>">
                                                                    <label for="<?= 'doc_qty'.'1'; ?>"> <span
                                                                            class="text-danger">*</span>Quantité
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <!-- radio -->
                                                                <div class="form-floating">
                                                                    <select id="<?= 'doc_type'.'1'; ?>"
                                                                        name="<?= 'doc_type'; ?>" title="Type"
                                                                        class="form-control <?= ($validation->hasError('doc_type'.'1')) ? ' is-invalid' : '' ?>"
                                                                        style="width: 100%;">
                                                                        <option selected disabled>-- Sélectionnez --
                                                                        </option>
                                                                        <option value="document"
                                                                            <?= ($document['document_type'] == 'document') ? 'selected':''; ?>>
                                                                            Document physique déposé</option>
                                                                        <option value="divers"
                                                                            <?= ($document['document_type'] == 'divers') ? 'selected':''; ?>>
                                                                            Bien matériel déposé </option>
                                                                        <option value="confusque"
                                                                            <?= ($document['document_type'] == 'confusque') ? 'selected':''; ?>>
                                                                            Bien confusqué </option>
                                                                    </select>
                                                                    <label form="<?= 'doc_type'.'1'; ?>"><span
                                                                            class="text-danger">*</span>Type
                                                                        d'élément </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text" id="<?= 'doc_number'.'1'; ?>"
                                                                        name="<?= 'doc_number'; ?>" class="form-control"
                                                                        placeholder="Ex: xxxxxx"
                                                                        value="<?= $document['document_number']; ?>">
                                                                    <label for="<?= 'doc_number'.'1'; ?>"> <span
                                                                            class="text-danger"></span>
                                                                        Numéro de Référence</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="date" id="<?= 'doc_delivery'.'1'; ?>"
                                                                        name="<?= 'doc_delivery'; ?>"
                                                                        class="form-control"
                                                                        value="<?= $document['document_delivery_date']; ?>">
                                                                    <label for="<?= 'doc_delivery'.'1'; ?>"> <span
                                                                            class="text-danger"></span>
                                                                        Date de
                                                                        <?= ($document['document_type'] == 'document') ? 'délivrance':'fabrication'; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="date" id="<?= 'doc_validity'.'1'; ?>"
                                                                        name="<?= 'doc_validity'; ?>"
                                                                        class="form-control"
                                                                        value="<?= $document['document_validity_date']; ?>">
                                                                    <label for="<?= 'doc_validity'.'1'; ?>"> <span
                                                                            class="text-danger"></span>
                                                                        Date
                                                                        <?= ($document['document_type'] == 'document') ? 'de validité':'d\'expiration'; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-12 mb-2">
                                                                <div class="form-floating mb-3">

                                                                    <textarea name="<?= 'doc_notes'; ?>"
                                                                        id="<?= 'doc_notes'.'1'; ?>" cols="30" rows="5"
                                                                        maxlength="500" placeholder="Descrivez ici..."
                                                                        class="form-control"><?= $document['document_notes']; ?></textarea>
                                                                    <label for="<?= 'doc_notes'.'1'; ?>">
                                                                        <span
                                                                            class="text-danger"></span>Observation</label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Fermer le mode edition</button>
                                                        <button type="submit"
                                                            class="btn btn-info btn-sm text-uppercase">Enregistrer les
                                                            modifications</button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
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

    <div class="modal fade" id="offcanvasimages">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title d-inline-flex">
                        <span id="offcanvasEditLabel" class="h5 text-uppercase">
                            Changement photo de proifil de l'étudiant
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