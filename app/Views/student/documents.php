<div class="content-wrapper <?= checkModuleAccess('students'); ?>">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Documents et Autres Biens</li>
                        <li class="col-sm-6">
                            <a href="<?= base_url('student/listing'); ?>"
                                class="btn btn-info btn-rounded text-uppercase btn-sm">
                                <i class="fas fa-reply fa-lg"></i> Voir listing
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <?php if (isset($student) && (! empty($student))): ?>
        <div class="container-fluid">
            <div class="row">
                <div card="col-sm-12">

                    <blockquote>
                        <h3 class="text-dark"><i class="fas fa-user-circle"></i>
                        étudiant
                            [<span class="text-primary text-uppercase">
                                <?= strtoupper($student['student_firstname']); ?>
                                <?= strtoupper($student['student_lastname']); ?>
                                <?= strtoupper($student['student_surname']); ?>
                                -
                            </span>

                            ID:
                            <span class="text-primary text-uppercase font-weight-bold">
                                <?= strtoupper($student['student_code']); ?>
                            </span>
                            DE :
                            <span class="text-primary text-uppercase font-weight-bold">
                                <?= setDegresLevels(($student['degree_code'])); ?>
                                <?= strtoupper(($student['classe_subname'])); ?>
                                <?= strtoupper(($student['option_name'])); ?>
                            </span>]

                        </h3>
                        <div class="text-left h3">
                            <span class="font-weight-bold">
                                <i class="fas fa-folder"></i>
                                DOCUMENTS ET AUTRES BIENS DEPOSES
                            </span>

                        </div>
                    </blockquote>

                    <?php
                $validation = \Config\Services::validation();
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url('studentAddDocuments/'.$student['student_token']), $attributes);
                ?>
                    <div class="card">
                        <fieldset class="card-body card-radius">
                            <legend class="text-center text-dark py-3 border-bottom">
                                <h5>Veuillez saisir les informations requises ci-dessous pour 
                                     prendre en compte tous les documents et biens déposés</h5>
                            </legend>
                            <?php 
                    $nb = $student['student_documents'];
                    $save_libelle = "Elément";
                    
                    if ($nb==1) { ?>
                            <div class="row">

                                <div class="col-sm-1 mb-2">
                                    <div class="form-floating">
                                        <input type="text" id="<?= 'doc_code'.'1'; ?>" name="<?= 'doc_code'.'1'; ?>"
                                            class="form-control" readonly value="<?= setReferenceCode(); ?>">
                                        <label for="<?= 'doc_code'.'1'; ?>"> <span class="text-danger">*</span>
                                            <?= $save_libelle; ?></label>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" id="<?= 'doc_name'.'1'; ?>" name="<?= 'doc_name'.'1'; ?>"
                                            class="form-control" placeholder="(Ex: Bulletin ou Papier)" required="true"
                                            autofocus="true">
                                        <label for="<?= 'doc_name'.'1'; ?>"> <span
                                                class="text-danger">*</span>Désignation /
                                            Nom document</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-2">
                                    <!-- radio -->
                                    <div class="form-floating">
                                        <select id="<?= 'doc_type'.'1'; ?>" name="<?= 'doc_type'.'1'; ?>" title="Type"
                                            class="form-control <?= ($validation->hasError('doc_type'.'1')) ? ' is-invalid' : '' ?>"
                                            style="width: 100%;">
                                            <option selected disabled>-- Sélectionnez -- </option>
                                            <option value="document">Document déposé</option>
                                            <option value="divers">Bien déposé</option>
                                        </select>
                                        <label form="<?= 'doc_type'.'1'; ?>"><span class="text-danger">*</span>Type
                                            d'élément </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-2">
                                    <div class="form-floating">
                                        <input type="number" id="<?= 'doc_qty'.'1'; ?>" name="<?= 'doc_qty'.'1'; ?>"
                                            min="1" max="10" class="form-control text-uppercase" placeholder="Ex: 2"
                                            required="true" autocomplete="off" step=".01">
                                        <label for="<?= 'doc_qty'.'1'; ?>"> <span class="text-danger">*</span>Quantité
                                            </label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-floating mb-3">

                                        <textarea name="<?= 'doc_notes'.'1'; ?>" id="<?= 'doc_notes'.'1'; ?>" cols="30"
                                            rows="5" maxlength="500" placeholder="Descrivez ici..."
                                            class="form-control"></textarea>
                                        <label for="<?= 'doc_notes'.'1'; ?>">
                                            <span class="text-danger">*</span>Observation</label>

                                    </div>
                                </div>
                            </div>
                            <?php }else{
                        for ($i=1; $i <= $nb; $i++) {  ?>
                            <div class="row">

                                <div class="col-sm-1 mb-2">
                                    <div class="form-floating">
                                        <input type="text" id="<?= 'doc_code'.$i; ?>" name="<?= 'doc_code'.$i; ?>"
                                            class="form-control border-none" readonly value="<?= setReferenceCode().$i; ?>">
                                        <label for="<?= 'doc_code'.$i; ?>"> 
                                            #<?= $i; ?>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" id="<?= 'doc_name'.$i; ?>" name="<?= 'doc_name'.$i; ?>"
                                            class="form-control" placeholder="(Ex: Bulletin ou Papier)" required="true"
                                            autofocus="true">
                                        <label for="<?= 'doc_name'.$i; ?>"> <span
                                                class="text-danger">*</span>Désignation /
                                            Nom document</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-2">
                                    <!-- radio -->
                                    <div class="form-floating">
                                        <select id="<?= 'doc_type'.$i; ?>" name="<?= 'doc_type'.$i; ?>" title="Type"
                                            class="form-control <?= ($validation->hasError('doc_type'.$i)) ? ' is-invalid' : '' ?>"
                                            style="width: 100%;">
                                            <option selected disabled>-- Sélectionnez -- </option>
                                            <option value="document">Document déposé</option>
                                            <option value="divers">Bien déposé</option>
                                        </select>
                                        <label form="<?= 'doc_type'.$i; ?>"><span class="text-danger">*</span>Type
                                            d'élément </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-2">
                                    <div class="form-floating">
                                        <input type="number" id="<?= 'doc_qty'.$i; ?>" name="<?= 'doc_qty'.$i; ?>"
                                            min="1" max="10" class="form-control text-uppercase" placeholder="Ex: 2"
                                            required="true" autocomplete="off" step=".01">
                                        <label for="<?= 'doc_qty'.$i; ?>"> <span class="text-danger">*</span>Quantité
                                            </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-floating mb-3">
                                        <textarea name="<?= 'doc_notes'.$i; ?>" id="<?= 'doc_notes'.$i; ?>" cols="30"
                                            rows="5" maxlength="500" placeholder="Descrivez ici..."
                                            class="form-control"></textarea>
                                        <label for="<?= 'doc_notes'.$i; ?>">
                                            <span class="text-danger">*</span>Observation</label>

                                    </div>
                                </div>

                            </div>
                            <?php }} ?>
                            <?php ?>


                            <div class="form-group text-right">
                                <button type="submit" name="btn_save" class="btn btn-info">
                                    <i class="fa fa-check-circke"></i> Valider la saisie de données</button>
                            </div>
                        </fieldset>
                        <?= form_close(); ?>
                        <?php else: ?>
                        <div class="card-footer alert alert-light text-danger text-center">
                            <p class="h3">
                                Veuillez determiner au moins un document ou un bien

                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>