<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('students'); ?>">
    <section class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dossiers étudiants</li>
                            <li class="breadcrumb-item active" aria-current="page">Réinscription</li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('student/listing'); ?>"
                                    class="btn btn-info btn-rounded text-uppercase float-right">
                                    <i class="fas fa-reply fa-lg"></i>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <form role="form" id="ajax_form_sections" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_sections" name="ajax_sections" title="promotion"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez une Facultés--</option>
                                <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                <option value="all">Toutes les Facultés</option>
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
                                <span class="text-danger">*</span>Facultés</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php if (session()->has('choosedsectionid')): ?>
    <section class="content mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="font-weight-bold">
                        <h3 class="font-weight-bold text-uppercase h4">Comment ça marche ?</h3>
                    </div>
                    <div class="about">
                        <div class="content ps-0 ps-lg-5 fw-bold">
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Saisir le numéro matricule de l'étudiant
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i> Choisir un site du système de l'établissement
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i> Cliquer sur vérifier les données
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">

                            <h3 class="font-weight-bold text-uppercase text-left h4">Vérification de l'étudiant</h3>
                            <form action="<?= base_url('onlineStudentRegistration'); ?>" method="GET" role="form">

                                <?php $validation = \Config\Services::validation(); ?>

                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="student" class="form-control" id="student"
                                                placeholder="Your student code"
                                                value="<?= isset($studentquery) ? $studentquery: set_value('student'); ?>"
                                                autofocus required>
                                            <label for="student"><span class="text-danger">*</span>Numéro matricule de
                                                l'étudiant</label>
                                            <?php if ($validation->hasError('student')) { ?>
                                            <span class="invalid-feedback text-danger">
                                                <?= $validation->getError('student'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <div class="form-floating mb-3">
                                            <select name="school" id="school" class="form-control">
                                                <option disabled>-- Sélectionnez un établissement --</option>
                                                <option value="local" selected
                                                    <?= (isset($schoolquery) && ($schoolquery == 'local')) ? 'selected':set_select('school', 'local'); ?>>
                                                    SITE LOCAL
                                                </option>

                                            </select>
                                            <label for="school"><span class="text-danger">*</span>Sites de l'établissements</label>
                                            <?php if ($validation->hasError('school')) { ?>
                                            <span class="invalid-feedback text-danger">
                                                <?= $validation->getError('school'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Vérifier les données</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (isset($student) && (!empty($student))): ?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php $last_student_code = (isset($laststudent) && (!empty($laststudent))) ? $laststudent : '';
                    $valid_student_code = setStudentSchoolIdentification($last_student_code);
                    //form validation services call
                    $validation = \Config\Services::validation();
                    //form
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('registerOldStudent'), $attributes);
                    ?>
                    <!-- GET OLD PARENT ID -->
                    <input type="hidden" name="tokenstudent" id="tokenstudent" value="<?= $student['student_token']; ?>"/>
                    <input type="hidden" name="parent_id" id="parent_id" value="<?= $student['parent_id']; ?>"/>

                    <div class="card card-light">
                        <div class="card-header alert alert-primary">
                            <div class="text-center">
                                <h1 class="text-uppercase font-weight-bold">
                                    Réinscription des anciens étudiants
                                </h1>
                                <h3 class="text-uppercase font-weight-bold">
                                    Dossier de l'étudiant <span class="text-danger">
                                        <?= strtoupper($student['student_lastname']) . ' ' . strtoupper($student['student_firstname']). ' '. strtoupper($student['student_surname']); ?>
                                    </span>
                                    actuellement en promotion de
                                    <span class="text-danger">
                                        <?= setDegresLevels($student['degree_code'], 'f') . ' ' . strtoupper($student['classe_subname']) . ' ' . strtoupper($student['option_name']); ?>
                                    </span>
                                    pour l'année académique
                                    <span class="text-danger">
                                        <?= $student['year_started']; ?>-
                                        <?= $student['year_ended']; ?>
                                    </span>
                                </h3>
                                <p>
                                    Veuillez remplir le formulaire ci-dessous pour actualiser les données de l'étudiant
                                    avec des informations requises de son dossier académique.
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="matriculeEleve" id="matriculeEleve"
                                            class="form-control text-uppercase <?= ($validation->hasError('matriculeEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Matricule" autocomplete="off"
                                            value="<?= (set_value('matriculeEleve')) ? set_value('matriculeEleve') : $valid_student_code ?>">
                                        <?php if ($validation->hasError('matriculeEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('matriculeEleve'); ?></span>
                                        <?php } ?>
                                        <label for="matriculeEleve"><span class="text-danger">*</span>Matricule
                                            d'identification</label>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-lg-8 mb-2">
                                    <div class="form-floating">
                                        <select
                                            class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('promotionEleve')) ? ' is-invalid' : '' ?>"
                                            id="promotionEleve" name="promotionEleve" data-dropdown-css-class="select2-info"
                                            style="width: 100%;">
                                            <option selected="selected" disabled>Sélectionnez une promotion</option>
                                            <?php if (isset($promotions) && !empty($promotions)):
                                $branch_access = session()->get('choosedsectionid');
                                foreach ($promotions as $key => $clasvalue):
                                    if (($branch_access == $clasvalue['section_id'])): ?>
                                            <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                <?= ($student['inscription_classe_id'] == $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_promotions', esc($clasvalue['classe_id'])); ?>>
                                                <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                <?= strtoupper($clasvalue['classe_subname']); ?>
                                                <?= strtoupper($clasvalue['option_name']); ?>
                                            </option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="promotionEleve"><span class="text-danger">*</span>promotion à
                                            inscrire</label>
                                        <?php if ($validation->hasError('promotionEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('promotionEleve'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <!-- Nom eleve -->
                                    <div class="form-floating">
                                        <input type="text" name="nomEleve" id="nom_eleve" autocomplete="off"
                                            class="form-control <?= ($validation->hasError('nomEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Ex: Ilunga"
                                            value="<?= (!empty($student['student_firstname'])) ? ($student['student_firstname']) : set_value('nomEleve'); ?>"
                                            autofocus>

                                        <?php if ($validation->hasError('nomEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('nomEleve'); ?></span>
                                        <?php } ?>
                                        <label for="nom_eleve"><span class="text-danger">*</span>Nom</label>

                                    </div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <!-- PostNom eleve -->
                                    <div class="form-floating">
                                        <input type="text" name="postnomEleve" id="postnomEleve" autocomplete="off"
                                            class="form-control <?= ($validation->hasError('postnomEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Ex: Kasongo"
                                            value="<?= (!empty($student['student_lastname'])) ? ($student['student_lastname']) :set_value('postnomEleve'); ?>">
                                        <label for="postnomEleve"><span class="text-danger"></span>Postnom
                                        </label>
                                        <?php if ($validation->hasError('postnomEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('postnomEleve'); ?></span>
                                        <?php } ?>
                                    </div> <!-- prenom eleve -->
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="prenomEleve" id="prenom_Eleve" autocomplete="off"
                                            class="form-control <?= ($validation->hasError('prenomEleve')) ? ' is-invalid' : '' ?>"
                                            placeholder="Ex: Prigana"
                                            value="<?= (!empty($student['student_surname'])) ? ($student['student_surname']) :set_value('prenomEleve'); ?>">
                                        <?php if ($validation->hasError('prenomEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('prenomEleve'); ?></span>
                                        <?php } ?>
                                        <label for="prenom_Eleve"><span class="text-danger"></span>Prénom
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <!-- radio -->
                                    <div class="form-floating">
                                        <select id="sexeEleve" name="sexeEleve" title="sexe"
                                            class="form-control <?= ($validation->hasError('sexeEleve')) ? ' is-invalid' : '' ?>"
                                            style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez --
                                            </option>
                                            <option value="masculin"
                                                <?= ($student['student_gender'] == 'masculin') ? 'selected': set_select('sexeEleve', 'masculin'); ?>>
                                                Masculin
                                            </option>
                                            <option value="feminin"
                                                <?= ($student['student_gender'] == 'feminin') ? 'selected': set_select('sexeEleve', 'feminin'); ?>>
                                                Feminin
                                            </option>
                                        </select>
                                        <?php if ($validation->hasError('sexeEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('sexeEleve'); ?></span>
                                        <?php } ?>
                                        <label form="sexeEleve"><span class="text-danger">*</span>Sexe </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="nationality" id="nationality" autocomplete="off"
                                            placeholder="Ex:Congolaise"
                                            class="form-control <?= ($validation->hasError('nationality')) ? ' is-invalid' : '' ?>"
                                            value="<?= (!empty($student['student_nationality'])) ? ($student['student_nationality']) :set_value('nationality'); ?>">
                                        <?php if ($validation->hasError('nationality')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('nationality'); ?></span>
                                        <?php } ?>
                                        <label for="nationality"><span class="text-danger"></span>Nationalité</label>

                                    </div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="lieuNaissanceEleve" id="lieuNaissanceEleve"
                                            autocomplete="off" placeholder="Ex: Kinshasa"
                                            class="form-control <?= ($validation->hasError('lieuNaissanceEleve')) ? ' is-invalid' : '' ?>"
                                            value="<?= (!empty($student['student_born_place'])) ? ($student['student_born_place']) :set_value('lieuNaissanceEleve'); ?>">
                                        <?php if ($validation->hasError('lieuNaissanceEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('lieuNaissanceEleve'); ?></span>
                                        <?php } ?>
                                        <label for="lieuNaissanceEleve"><span class="text-danger"></span>Lieu
                                            Naissance étudiant</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <input type="date"
                                            class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissanceEleve')) ? ' is-invalid' : '' ?>"
                                            id="dateNaissanceEleve"
                                            value="<?= (!empty($student['student_birthday'])) ? ($student['student_birthday']) :set_value('dateNaissanceEleve') ?>"
                                            name="dateNaissanceEleve" />

                                        <?php if ($validation->hasError('dateNaissanceEleve')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('dateNaissanceEleve'); ?></span>
                                        <?php } ?>
                                        <label for="dateNaissanceEleve"><span class="text-danger"></span>Date
                                            naissance étudiant:</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="ecole_provenance" id="ecole_provenance"
                                            autocomplete="off" placeholder="Ex:Trecaz School"
                                            class="form-control <?= ($validation->hasError('ecole_provenance')) ? ' is-invalid' : '' ?>"
                                            value="<?= (!empty($student['inscription_origin_school'])) ? ($student['inscription_origin_school']) :set_value('ecole_provenance'); ?>">
                                        <?php if ($validation->hasError('ecole_provenance')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('ecole_provenance'); ?></span>
                                        <?php } ?>
                                        <label for="ecole_provenance"><span class="text-danger"></span>Ecole de
                                            provenance</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="numero_sernie" id="numero_sernie" autocomplete="off"
                                            placeholder="Ex:2525T25"
                                            class="form-control <?= ($validation->hasError('numero_sernie')) ? ' is-invalid' : '' ?>"
                                            value="<?= (!empty($student['student_sernie_id'])) ? ($student['student_sernie_id']) :set_value('numero_sernie'); ?>">
                                        <?php if ($validation->hasError('numero_sernie')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('numero_sernie'); ?></span>
                                        <?php } ?>
                                        <label for="numero_sernie"><span class="text-danger"></span>Numéro
                                            Sernie</label>

                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <!-- PostNom eleve -->
                                    <div class="form-floating">
                                        <input type="number" name="documents" id="documents" min="0" max="10"
                                            class="form-control <?= ($validation->hasError('documents')) ? ' is-invalid' : '' ?>"
                                            placeholder="Ex: 3"
                                            value="<?= (!empty($student['student_documents'])) ? ($student['student_documents']) :set_value('documents'); ?>">
                                        <label for="documents"><span class="text-danger"></span>
                                            Documents et Autres biens déposés
                                        </label>
                                        <?php if ($validation->hasError('documents')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('documents'); ?></span>
                                        <?php } ?>

                                    </div> <!-- prenom eleve -->
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="notes" id="notes" autocomplete="off"
                                            class="form-control <?= ($validation->hasError('notes')) ? ' is-invalid' : '' ?>"
                                            placeholder="Ex: Pas de sport physique "
                                            value="<?= (!empty($student['student_notes'])) ? ($student['student_notes']) :set_value('notes'); ?>">
                                        <?php if ($validation->hasError('notes')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('notes'); ?></span>
                                        <?php } ?>
                                        <label for="prenom_Eleve"><span class="text-danger"></span>
                                            Observation(Cas d'une maladie)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-2">
                                    <div class="form-floating">
                                        <select id="confession" name="confession" title="confession"
                                            class="form-control <?= ($validation->hasError('confession')) ? ' is-invalid' : '' ?>"
                                            style="width: 100%;">
                                            <option selected disabled>-- Sélectionnez -- </option>
                                            <?php foreach (confessionReligieuse() as $confkey => $valueconf): ?>
                                            <option value="<?= $confkey; ?>"
                                                <?= ($student['student_confession'] == $confkey) ? 'selected': set_select('confession', $confkey); ?>>
                                                <?= $valueconf; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if ($validation->hasError('confession')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('confession'); ?></span>
                                        <?php } ?>
                                        <label form="confession">
                                            <span class="text-danger">*</span>Confession religieuse
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 py-3 text-center">
                                    <h3 class="text-danger text-uppercase font-weight-bold">Informations sur les
                                        Responsables de l'étudiant</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control text-capitalize" name="nom_pere_eleve"
                                            id="nom_pere_eleve" autocomplete="off"
                                            value="<?= (!empty($student['parent_father_name'])) ? ($student['parent_father_name']) :set_value('nom_pere_eleve') ?>"
                                            style="border-radius: 10px!important;" placeholder="Ex: Ilunga Jean" />
                                        <label for="nom_pere_eleve" class="control-label">
                                            <span class="text-danger">*</span>Nom du père
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating  input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="phone_pere" id="phone_pere"
                                            value="<?= (!empty($student['parent_father_phone'])) ? ($student['parent_father_phone']) :set_value('phone_pere') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                            data-placement="bottom" title="Numéro téléphone du père" />
                                        <label for="phone_pere" class="control-label ml-5">
                                            <span class="text-danger"></span>Téléphone du père
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating  input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="phone_pere2" id="phone_pere2"
                                            value="<?= (!empty($student['parent_father_phone_2'])) ? ($student['parent_father_phone_2']) :set_value('phone_pere2') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                            data-placement="bottom" title="Second numéro téléphone du père " />
                                        <label for="phone_pere2" class="control-label ml-5">
                                            <span class="text-danger"></span>Second téléphone du père
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control text-capitalize" name="nom_mere_eleve"
                                            id="nom_mere_eleve" autocomplete="off"
                                            value="<?= (!empty($student['parent_mother_name'])) ? ($student['parent_mother_name']) :set_value('nom_mere_eleve') ?>"
                                            style="border-radius: 10px!important;" placeholder="Ex: Melanie Moya" />
                                        <label for="nom_mere_eleve" class="control-label">
                                            <span class="text-danger">*</span>Nom de la mère
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating  input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="phone_mere" id="phone_mere"
                                            value="<?= (!empty($student['parent_mother_phone'])) ? ($student['parent_mother_phone']) :set_value('phone_mere') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                            data-placement="bottom" title="numéro téléphone de la mère " />
                                        <label for="phone_mere" class="control-label ml-5">
                                            <span class="text-danger"></span>Téléphone de la mère
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating  input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="phone_mere2" id="phone_mere2"
                                            value="<?= (!empty($student['parent_mother_phone_2'])) ? ($student['parent_mother_phone_2']) :set_value('phone_mere2') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                            data-placement="bottom" title="Second numéro téléphone de la mère " />
                                        <label for="phone_mere2" class="control-label ml-5">
                                            <span class="text-danger"></span>Second téléphone de la mère
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-4 mb-2">
                                    <div class="form-floating">

                                        <input type="text" class="form-control text-capitalize" name="nom_tuteur_eleve"
                                            id="nom_tuteur_eleve" autocomplete="off"
                                            value="<?= (!empty($student['parent_tutor_name'])) ? ($student['parent_tutor_name']) :set_value('nom_tuteur_eleve') ?>"
                                            style="border-radius: 10px!important;" placeholder="Ex: Jean Ilunga" />
                                        <label for="nom_tuteur_eleve" class="control-label">
                                            <span class="text-danger"></span> Nom du tuteur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="telephone_tuteur"
                                            id="telephone_tuteur"
                                            value="<?= (!empty($student['parent_tutor_phone'])) ? ($student['parent_tutor_phone']) :set_value('telephone_tuteur') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                            data-placement="bottom" title="numéro téléphone du tuteur">
                                        <label for="telephone_tuteur" class="control-label ml-5">
                                            <span class="text-danger"></span>Téléphone du tuteur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-floating input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="telephone_tuteur2"
                                            id="telephone_tuteur2"
                                            value="<?= (!empty($student['parent_tutor_phone_2'])) ? ($student['parent_tutor_phone_2']) :set_value('telephone_tuteur2') ?>"
                                            data-inputmask='"mask": "+243999999999"' data-mask
                                            placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                            data-placement="bottom" title="second numéro téléphone du tuteur">
                                        <label for="telephone_tuteur2" class="control-label ml-5">
                                            <span class="text-danger"></span>Second téléphone du tuteur
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="phone_sms"><span class="text-danger">*</span>Personne
                                            Responsable à contacter en cas d'urgence
                                            :</label>
                                        <div class="input-group">
                                            <div class="icheck-success d-inline mr-3">
                                                <input type="radio" name="phone_sms"
                                                    <?= ($student['parent_emergency'] == 'pere') ? 'checked' : ''; ?>
                                                    id="pere" value="pere">
                                                <label for="pere">
                                                    Père
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline mr-3 ml-3">
                                                <input type="radio" name="phone_sms"
                                                    <?= ($student['parent_emergency'] == 'mere') ? 'checked' : ''; ?>
                                                    id="mere" value="mere">
                                                <label for="mere">
                                                    Mère
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="phone_sms"
                                                    <?= ($student['parent_emergency'] == 'tuteur') ? 'checked' : ''; ?>
                                                    id="tuteur" value="tuteur">
                                                <label for="tuteur">
                                                    Tuteur
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="phone_primary"><span class="text-danger">*</span>Numéro
                                            téléphone du responsable à contacter d'urgence
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_primary"
                                                id="phone_primary"
                                                value="<?= (!empty($student['parent_primary_phone'])) ? ($student['parent_primary_phone']) :set_value('phone_primary') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email_tuteur">
                                            <span class="text-danger"></span>Adresse E-mail du responsable à contacter
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email_tuteur"
                                                id="email_tuteur"
                                                value="<?= (!empty($student['parent_primary_email'])) ? ($student['parent_primary_email']) :set_value('email_tuteur') ?>"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h5 class="font-weight-bold">
                                        <span class="text-danger">*</span>Adresse de résidence
                                    </h5>
                                </div>
                                <div class="col-sm-12 col-lg-12 mb-2">
                                    <div class="form-floating">
                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                            id="address_street" name="address_street"
                                            data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected disabled> sélectionnez une zone </option>

                                            <option value="new_zone">Nouvelle zone d'adresse</option>

                                            <?php if (isset($zones) && !empty($zones)):
                                            foreach ($zones as $zonekey => $zone):?>
                                            <option value="<?= esc($zone['address_id']); ?>"
                                                <?= ($zone['address_parent_id'] == $student['parent_id']) ? 'selected' : set_select('address_street', esc($zone['address_id'])); ?>>
                                                <?= ucwords($zone['municipality_name']); ?> |
                                                <?= ucwords($zone['district_name']); ?> |
                                                <?= ucwords($zone['address_area_name']); ?> |
                                                <?= ucwords($zone['address_street_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('address_street')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('address_street'); ?></span>
                                        <?php } ?>
                                        <label for="address_street"><span class="text-danger">*</span>Avenue/Rue de
                                            l'étudiant</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="inputs_zone_show" style="display:none;">
                                <div class="col-sm-6 col-lg-6 mb-2">
                                    <div class="form-floating">

                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                            id="student_commune" name="student_commune"
                                            data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected disabled> sélectionnez une commune </option>
                                            <option value="new_commune">Nouvelle commune</option>
                                            <?php if (isset($communes) && !empty($communes)):
                                            foreach ($communes as $comkey => $commune): ?>
                                            <option value="<?= esc($commune['municipality_id']); ?>"
                                                <?= set_select('student_commune', esc($commune['municipality_id'])); ?>>
                                                <?= strtoupper($commune['municipality_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('student_commune')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_commune'); ?></span>
                                        <?php } ?>
                                        <label for="student_commune"><span class="text-danger">*</span>Commune de
                                            l'étudiant</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-2">
                                    <div class="form-floating">
                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('student_area')) ? ' is-invalid' : '' ?>"
                                            id="student_area" name="student_area" data-dropdown-css-class="select2-info"
                                            style="width: 100%;">
                                            <option selected disabled> sélectionnez un quartier </option>
                                            <option value="new_area">Nouveau quartier</option>
                                            <?php if (isset($quartiers) && !empty($quartiers)):
                                foreach ($quartiers as $quartierkey => $quartier): ?>
                                            <option value="<?= esc($quartier['district_id']); ?>"
                                                <?= set_select('student_area', esc($quartier['district_id'])); ?>>
                                                <?= strtoupper($quartier['district_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('student_area')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_area'); ?></span>
                                        <?php } ?>
                                        <label for="student_area"><span class="text-danger">*</span>Quartier de
                                            l'étudiant</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6 form-floating mb-2" id="inputs_commune_show"
                                    style="display:none;">
                                    <input type="text" class="form-control text-capitalize" name="commune_name"
                                        id="commune_name" autocomplete="off" value="<?= set_value('commune_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Kampemba" />
                                    <label for="commune_name" class="control-label">
                                        <span class="text-danger">*</span>Saisissez le nom de la nouvelle commune
                                    </label>
                                </div>
                                <div class="col-sm-6 col-lg-6 form-floating mb-2" id="inputs_area_show"
                                    style="display:none;">
                                    <input type="text" class="form-control text-capitalize" name="area_name"
                                        id="area_name" autocomplete="off" value="<?= set_value('area_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Bel-Air" />
                                    <label for="area_name" class="control-label">
                                        <span class="text-danger">*</span>Saisissez le nom du nouveau quartier
                                    </label>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_name"
                                        id="address_name" autocomplete="off" value="<?= set_value('address_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Savonnier" />
                                    <label for="address_name" class="control-label">
                                        <span class="text-danger">*</span>Nom de l'avenue
                                    </label>
                                </div>

                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_street_name"
                                        id="address_street_name" autocomplete="off"
                                        value="<?= set_value('address_street_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Sapins" />
                                    <label for="address_street_name" class="control-label">
                                        Rue<span class="text-danger">(Facultatif)</span>
                                    </label>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_number"
                                        id="address_number" autocomplete="off"
                                        value="<?= set_value('address_number') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: 15B" />
                                    <label for="address_number" class="control-label">
                                        Numéro Maison
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-inline">
                            <div class="text-left text-danger font-weight-bold">
                                <span>N.B: (*) information obligatoire</span>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase">
                                    <i class="fas fa-check-circle fa-lg"></i> Valider la réinscription
                                </button>
                                <a href="<?= base_url('student/registration'); ?>"
                                    class="btn btn-danger btn-rounded text-uppercase">
                                    <i class="fas fa-window-close fa-lg"></i> Annuler
                                </a>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php else: ?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="alert alert-info alert-dismissible">
                        <h5><i class="icon fas fa-info-circle"></i> Information!</h5>
                        Veuillez sélectionner une section organisée pour continuer.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>