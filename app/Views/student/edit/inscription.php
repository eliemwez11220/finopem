<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dossiers scolaires</li>
                            <li class="breadcrumb-item active" aria-current="page">Inscriptions</li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('student/listing'); ?>"
                                    class="btn btn-info btn-rounded text-uppercase float-right">
                                    <i class="fas fa-reply fa-lg"></i>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-sm-12 col-lg-12">
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
        </div><!-- /.container-fluid -->
    </section>
    <?php if (isset($student) && (!empty($student))): ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <?php $validation = \Config\Services::validation(); 
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('edit-student-registration/' . $student['inscription_id']), $attributes);
                            ?>
                    <div class="card card-light">
                        <div class="card-header alert alert-info">
                            <div class="text-center">
                                <h1 class="text-uppercase font-weight-bold">
                                    Modification dossier élève <br />
                                    <span class="text-primary">
                                        <?= (trim($student['student_firstname'])); ?>
                                        <?= (trim($student['student_lastname'])); ?>
                                        <?= (trim($student['student_surname'])); ?>
                                        - ID:<?= (trim($student['student_code'])); ?>
                                    </span>
                                </h1>
                                <p>
                                    Veuillez remplir le formulaire ci-dessous pour actualiser la fiche élève
                                    avec des informations requises de son dossier scolaire.
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="student_token" id="student_token"
                                    value="<?= ($student['student_token']) ? ($student['student_token']) : set_value('student_token'); ?>">
                                <!-- left column -->
                                <div class="col-sm-4">
                                    <!-- Matricule eleve (!empty($new_matricule_student_generate)) ? $new_matricule_student_generate : -->
                                    <div class="form-floating mb-2">

                                        <input type="text" name="matriculeEleve" id="matriculeEleve"
                                            class="form-control text-uppercase <?= ($validation->hasError('matriculeEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Matricule" autocomplete="off"
                                            value="<?= trim($student['student_code']) ? trim($student['student_code']) : set_value('matriculeEleve'); ?>">
                                        <label for="matriculeEleve"><span class="text-danger">*</span>Matricule
                                            d'identification</label>

                                        <?php if ($validation->hasError('matriculeEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('matriculeEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">

                                        <input type="text" name="ecole_provenance" id="ecole_provenance"
                                            autocomplete="off" placeholder="Ex: Ditotase School"
                                            class="form-control text-capitalize <?= ($validation->hasError('ecole_provenance')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['inscription_origin_school']) ? trim($student['inscription_origin_school']) : set_value('ecole_provenance'); ?>">
                                        <label for="ecole_provenance"><span class="text-danger"></span>Ecole de
                                            provenance</label>

                                        <?php if ($validation->hasError('ecole_provenance')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('ecole_provenance'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">

                                        <input type="text" name="numero_sernie" id="numero_sernie" autocomplete="off"
                                            placeholder="Ex:x125078x"
                                            class="form-control <?= ($validation->hasError('numero_sernie')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_sernie_id']) ? trim($student['student_sernie_id']) : set_value('numero_sernie'); ?>">
                                        <?php if ($validation->hasError('numero_sernie')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('numero_sernie'); ?></span>
                                        <?php } ?>
                                        <label for="numero_sernie"><span class="text-danger"></span>Numéro
                                            Sernie</label>
                                    </div>
                                </div><!-- left column -->
                                <div class="col-sm-4">
                                    <!-- Nom eleve -->
                                    <div class="form-floating mb-2">

                                        <input type="text" name="nomEleve" id="nom_eleve" autocomplete="off"
                                            class="form-control text-capitalize <?= ($validation->hasError('nomEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Nom élève"
                                            value="<?= trim($student['student_firstname']) ? trim($student['student_firstname']) : set_value('nomEleve'); ?>"
                                            autofocus>
                                        <label for="nom_eleve"><span class="text-danger">*</span>Nom</label>
                                        <?php if ($validation->hasError('nomEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('nomEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- PostNom eleve -->
                                    <div class="form-floating mb-2">

                                        <input type="text" name="postnomEleve" id="postnomEleve" autocomplete="off"
                                            class="form-control text-capitalize <?= ($validation->hasError('postnomEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Post-nom élève"
                                            value="<?= trim($student['student_lastname']) ? trim($student['student_lastname']) : set_value('postnomEleve'); ?>">
                                        <label for="postnomEleve">
                                            <span class="text-danger"></span>Postnom
                                        </label>
                                        <?php if ($validation->hasError('postnomEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('postnomEleve'); ?></span>
                                        <?php } ?>

                                    </div> <!-- prenom eleve -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">

                                        <input type="text" name="prenomEleve" id="prenom_Eleve" autocomplete="off"
                                            class="form-control text-capitalize <?= ($validation->hasError('prenomEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Prénom élève"
                                            value="<?= trim($student['student_surname']) ? trim($student['student_surname']) : set_value('prenomEleve'); ?>">
                                        <label for="prenom_Eleve"><span class="text-danger"></span>Prénom
                                        </label>
                                        <?php if ($validation->hasError('prenomEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('prenomEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">

                                        <select id="sexeEleve" name="sexeEleve" title="sexe"
                                            class="form-control <?= ($validation->hasError('sexeEleve')) ? ' is-invalid' : '' ?>"
                                            style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez --
                                            </option>
                                            <option value="masculin"
                                                <?= ($student['student_gender'] == 'masculin') ? 'selected' : set_select('sexeEleve', 'masculin'); ?>>
                                                Masculin
                                            </option>
                                            <option value="feminin"
                                                <?= ($student['student_gender'] == 'feminin') ? 'selected' : set_select('sexeEleve', 'feminin'); ?>>
                                                Feminin
                                            </option>
                                        </select>
                                        <label form="sexeEleve"><span class="text-danger">*</span>Sexe : </label>

                                        <?php if ($validation->hasError('sexeEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('sexeEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">

                                        <input type="text" name="nationality" id="nationality"
                                            placeholder="Ex:Congolaise"
                                            class="form-control <?= ($validation->hasError('nationality')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_nationality']) ? trim($student['student_nationality']) : set_value('nationality'); ?>">
                                        <label for="numero_sernie"><span class="text-danger"></span>Nationalité</label>
                                        <?php if ($validation->hasError('nationality')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('nationality'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">

                                        <input type="text" name="lieuNaissanceEleve" id="lieuNaissanceEleve"
                                            placeholder="Ex: Lubumbashi"
                                            class="form-control text-capitalize <?= ($validation->hasError('lieuNaissanceEleve')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_born_place']) ? trim($student['student_born_place']) : set_value('lieuNaissanceEleve'); ?>">

                                        <label for="lieuNaissanceEleve"><span class="text-danger"></span>Lieu
                                            Naissance
                                            élève</label>
                                        <?php if ($validation->hasError('lieuNaissanceEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('lieuNaissanceEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="date"
                                            class="form-control  <?= ($validation->hasError('dateNaissanceEleve')) ? ' is-invalid' : '' ?>"
                                            id="dateNaissanceEleve"
                                            value="<?= ($student['student_birthday']) ? ($student['student_birthday']) : set_value('dateNaissanceEleve') ?>"
                                            name="dateNaissanceEleve" />

                                        <label for="dateNaissanceEleve"><span class="text-danger"></span>Date
                                            naissance élève</label>

                                        <?php if ($validation->hasError('dateNaissanceEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('dateNaissanceEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-floating input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="phone_primary" id="phone_primary"
                                            value="<?= trim($student['student_phone']) ? trim($student['student_phone']) : set_value('phone_primary') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off">
                                        <label id="phone_primary" class="ml-5 text-primary"><span
                                                class="text-danger"></span>Numéro
                                            téléphone de l'élève</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="email_primary" id="email_primary"
                                            value="<?= trim($student['student_email']) ? trim($student['student_email']) : set_value('email_primary') ?>"
                                            autocomplete="off">
                                        <label class="ml-5 text-primary" for="email_primary">
                                            <span class="text-danger"></span>Adresse E-mail de l'élève
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_province" id="student_province"
                                            autocomplete="off" placeholder="Ex:Lualaba"
                                            class="form-control <?= ($validation->hasError('student_province')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_province']) ? trim($student['student_province']) : set_value('student_province'); ?>">
                                        <?php if ($validation->hasError('student_province')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_province'); ?></span>
                                        <?php } ?>
                                        <label for="student_province"><span class="text-danger"></span>Province
                                            d'origine</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_territory" id="student_territory"
                                            autocomplete="off" placeholder="Ex:Kapanga"
                                            class="form-control <?= ($validation->hasError('student_territory')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_territory']) ? trim($student['student_territory']) : set_value('student_territory'); ?>">
                                        <?php if ($validation->hasError('student_territory')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_territory'); ?></span>
                                        <?php } ?>
                                        <label for="student_territory"><span
                                                class="text-danger"></span>Territoire d'origine</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_district" id="student_district"
                                            autocomplete="off" placeholder="Ex:Kapanga"
                                            class="form-control <?= ($validation->hasError('student_district')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_district']) ? trim($student['student_district']) : set_value('student_district'); ?>">
                                        <?php if ($validation->hasError('student_district')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_district'); ?></span>
                                        <?php } ?>
                                        <label for="student_district"><span
                                                class="text-danger"></span>District d'origine</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_village" id="student_village"
                                            autocomplete="off" placeholder="Ex:Kasar"
                                            class="form-control <?= ($validation->hasError('student_village')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_village']) ? trim($student['student_village']) : set_value('student_village'); ?>">
                                        <?php if ($validation->hasError('student_village')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_village'); ?></span>
                                        <?php } ?>
                                        <label for="student_village"><span class="text-danger"></span>Village
                                            d'origine</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_sector" id="student_sector" autocomplete="off"
                                            placeholder="Ex:Mwant Yav"
                                            class="form-control <?= ($validation->hasError('student_sector')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_sector']) ? trim($student['student_sector']) : set_value('student_sector'); ?>">
                                        <?php if ($validation->hasError('student_sector')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_sector'); ?></span>
                                        <?php } ?>
                                        <label for="student_sector"><span class="text-danger"></span>Secteur
                                            d'origine</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_grouping" id="student_grouping"
                                            autocomplete="off" placeholder="Ex:Chiying"
                                            class="form-control <?= ($validation->hasError('student_grouping')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_grouping']) ? trim($student['student_grouping']) : set_value('student_grouping'); ?>">
                                        <?php if ($validation->hasError('student_grouping')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_grouping'); ?></span>
                                        <?php } ?>
                                        <label for="student_grouping"><span class="text-danger"></span>Groupement
                                            d'origine</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="permanent_code" id="permanent_code" autocomplete="off"
                                            placeholder="Ex:202501012023"
                                            class="form-control <?= ($validation->hasError('permanent_code')) ? ' is-invalid' : '' ?>"
                                            value="<?= trim($student['student_permanent_code']) ? trim($student['student_permanent_code']) : set_value('permanent_code'); ?>">
                                        <?php if ($validation->hasError('permanent_code')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('permanent_code'); ?></span>
                                        <?php } ?>
                                        <label for="permanent_code"><span class="text-danger"></span>Numéro permanent de
                                            l'élève</label>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-8">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" name="adresseEleve" id="adresseEleve"
                                            placeholder="Ex: Av Mwepu, Lubumbashi"
                                            value="<?= ($student['student_address']) ? ($student['student_address']) : set_value('adresseEleve') ?>">
                                        <label for="adresseEleve">
                                            <span class="text-danger"></span>Adresse de résidence élève</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="form-floating mb-2">

                                        <select
                                            class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('classeEleve')) ? ' is-invalid' : '' ?>"
                                            id="classeEleve" name="classeEleve" data-dropdown-css-class="select2-info"
                                            style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez une classe --
                                            </option>
                                            <?php if (isset($classes) && !empty($classes)):
                                                    foreach ($classes as $key => $clasvalue):
                                                        $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid'):$student['section_id'];
                                                        if (($branch_access == $clasvalue['section_id'])):


                                                            ?>
                                            <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                <?= ($student['inscription_classe_id']== $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                                <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                <?= ucfirst($clasvalue['classe_subname']); ?>
                                                <?= ucfirst($clasvalue['option_name']); ?>
                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="classeEleve"><span class="text-danger">*</span>Classe
                                            inscrite choisie</label>
                                        <?php if ($validation->hasError('classeEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('classeEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-floating mb-2">

                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                            id="tuteurEleve" name="tuteurEleve" data-dropdown-css-class="select2-info"
                                            style="width: 100%;">
                                            <option selected disabled>-- Sélectionnez un parent --</option>
                                            <?php
                                                    $count = 1;
                                                    if (isset($parents) && !empty($parents)):
                                                        foreach ($parents as $key => $value): ?>
                                            <option value="<?= esc($value['parent_id']); ?>"
                                                <?= ($student['student_parent_id'] == $value['parent_id']) ? 'selected' : set_select('tuteurEleve', esc($value['parent_id'])); ?>>
                                                Père: <?= ucfirst(strtolower($value['parent_father_name'])); ?> |
                                                Mère:
                                                <?= ucfirst(strtolower($value['parent_mother_name'])); ?> |
                                                Tuteur: <?= ucfirst(strtolower($value['parent_tutor_name'])); ?>
                                                | Tél:<?= (esc($value['parent_primary_phone'])); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="tuteurEleve"><span class="text-danger">*</span>Responsable de
                                            l'élève</label>
                                        <?php if ($validation->hasError('tuteurEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('tuteurEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 mt-3">
                                    <div class="form-floating">

                                        <textarea rows="5" cols="30" class="form-control bg-light" name="notes"
                                            placeholder="Plus de détails sur l'élève"
                                            id="notes"><?= ($student['student_notes']) ? ($student['student_notes']) : set_value('notes'); ?></textarea>
                                        <label for="notes" class="control-label">
                                            <span class="text-danger"></span>Observation sur l'élève
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-info btn-rounded text-uppercase">
                                <i class="fas fa-check-circle fa-lg"></i> Valider les modifications d'inscription
                            </button>
                            <a href="<?= base_url('student/listing'); ?>"
                                class="btn btn-danger btn-rounded text-uppercase">
                                <i class="fas fa-window-close fa-lg"></i> Annuler
                            </a>
                        </div>
                    </div>
                    <?= form_close(); ?>
                    <!-- /.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.container-fluid -->
    </section>
    <?php endif; ?>
</div><!-- /.container-fluid -->