<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('inscription'); ?>">
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
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">


                <?php if (session()->has('choosedsectionid')): ?>

                    <div class="col-md-12">
                        <?php

                        $last_student_code = (isset($student)) ? $student : '';
                        $valid_student_code = setStudentSchoolIdentification($last_student_code);

                        //form validation services call
                        $validation = \Config\Services::validation();

                        //form
                        $attributes = array('role' => 'form', 'autocomplete' => 'off');
                        echo form_open(base_url('register-student'), $attributes);
                        ?>
                        <div class="card card-light">
                            <div class="card-header alert alert-info">
                                <div class="text-center">
                                    <h1 class="text-uppercase font-weight-bold">Inscription des nouveaux élèves</h1>
                                    <p>
                                        Veuillez remplir le formulaire ci-dessous pour inscrire un nouvel élève
                                        avec des informations requises de son dossier scolaire.
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
                                                class="form-control select2 select2-info text-capitalize <?= ($validation->hasError('classeEleve')) ? ' is-invalid' : '' ?>"
                                                id="classeEleve" name="classeEleve" data-dropdown-css-class="select2-info"
                                                style="width: 100%;">
                                                <option selected="selected" disabled>Sélectionnez une classe</option>
                                                <?php if (isset($classes) && !empty($classes)):
                                                    $branch_access = session()->get('choosedsectionid');
                                                    foreach ($classes as $key => $clasvalue):
                                                        if (($branch_access == $clasvalue['section_id'])): ?>
                                                            <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                                <?= (session()->has('studentchoosedclasse') && (session()->get('studentchoosedclasse') == $clasvalue['classe_id'])) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                                                <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                                <?= strtoupper($clasvalue['classe_subname']); ?>
                                                                <?= strtoupper($clasvalue['option_name']); ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <label for="classeEleve"><span class="text-danger">*</span>Classe à
                                                inscrire</label>
                                            <?php if ($validation->hasError('classeEleve')) { ?>
                                                <span class="invalid-feedback">
                                                    <?= $validation->getError('classeEleve'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <!-- Nom eleve -->
                                        <div class="form-floating">
                                            <input type="text" name="nomEleve" id="nom_eleve" autocomplete="off"
                                                class="form-control <?= ($validation->hasError('nomEleve')) ? ' is-invalid' : '' ?>"
                                                placeholder="Ex: Ilunga" value="<?= set_value('nomEleve'); ?>" autofocus>

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
                                                placeholder="Ex: Kasongo" value="<?= set_value('postnomEleve'); ?>">
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
                                                placeholder="Ex: Prigana" value="<?= set_value('prenomEleve'); ?>">
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
                                                <option value="masculin" <?= set_select('sexeEleve', 'masculin'); ?>>
                                                    Masculin
                                                </option>
                                                <option value="feminin" <?= set_select('sexeEleve', 'feminin'); ?>>
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
                                                value="<?= set_value('nationality'); ?>">
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
                                                value="<?= set_value('lieuNaissanceEleve'); ?>">
                                            <?php if ($validation->hasError('lieuNaissanceEleve')) { ?>
                                                <span class="invalid-feedback">
                                                    <?= $validation->getError('lieuNaissanceEleve'); ?></span>
                                            <?php } ?>
                                            <label for="lieuNaissanceEleve"><span class="text-danger"></span>Lieu
                                                Naissance élève</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="form-floating">
                                            <input type="date"
                                                class="form-control datetimepicker-input <?= ($validation->hasError('dateNaissanceEleve')) ? ' is-invalid' : '' ?>"
                                                id="dateNaissanceEleve" value="<?= set_value('dateNaissanceEleve') ?>"
                                                name="dateNaissanceEleve" />

                                            <?php if ($validation->hasError('dateNaissanceEleve')) { ?>
                                                <span class="invalid-feedback">
                                                    <?= $validation->getError('dateNaissanceEleve'); ?></span>
                                            <?php } ?>
                                            <label for="dateNaissanceEleve"><span class="text-danger"></span>Date
                                                naissance élève:</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="form-floating">
                                            <input type="text" name="ecole_provenance" id="ecole_provenance"
                                                autocomplete="off" placeholder="Ex:Trecaz School"
                                                class="form-control <?= ($validation->hasError('ecole_provenance')) ? ' is-invalid' : '' ?>"
                                                value="<?= set_value('ecole_provenance'); ?>">
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
                                                value="<?= set_value('numero_sernie'); ?>">
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
                                                placeholder="Ex: 3" value="<?= set_value('documents'); ?>">
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
                                                placeholder="Ex: Pas de sport physique " value="<?= set_value('notes'); ?>">
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
                                                    <option value="<?= $confkey; ?>" <?= set_select('confession', $confkey); ?>>
                                                        <?= $valueconf; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php if ($validation->hasError('confession')) { ?>
                                                <span class="invalid-feedback">
                                                    <?= $validation->getError('confession'); ?></span>
                                            <?php } ?>
                                            <label form="confession"><span class="text-danger">*</span>Confession religieuse
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="student_province" id="student_province"
                                            autocomplete="off" placeholder="Ex:Lualaba"
                                            class="form-control <?= ($validation->hasError('student_province')) ? ' is-invalid' : '' ?>"
                                            value="<?=  set_value('student_province'); ?>">
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
                                            value="<?=  set_value('student_territory'); ?>">
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
                                            value="<?=  set_value('student_district'); ?>">
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
                                            value="<?=  set_value('student_village'); ?>">
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
                                            value="<?=  set_value('student_sector'); ?>">
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
                                            value="<?=  set_value('student_grouping'); ?>">
                                        <?php if ($validation->hasError('student_grouping')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_grouping'); ?></span>
                                        <?php } ?>
                                        <label for="student_grouping"><span class="text-danger"></span>Groupement
                                            d'origine</label>
                                    </div>
                                </div>
                                    <div class="col-sm-12 mb-2">
                                        <div class="form-floating">

                                            <select
                                                class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                                id="student_parent" name="tuteurEleve"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected disabled> sélectionnez un parent </option>
                                                <option value="new_parent">Ajouter un responsable</option>
                                                <?php
                                                $count = 1;
                                                if (isset($parents) && !empty($parents)):
                                                    foreach ($parents as $key => $value): ?>
                                                        <option value="<?= esc($value['parent_id']); ?>"
                                                            <?= set_select('tuteurEleve', esc($value['parent_id'])); ?>>
                                                            Père: <?= ucwords(strtolower($value['parent_father_name'])); ?> |
                                                            Mère:
                                                            <?= ucwords(strtolower($value['parent_mother_name'])); ?> |
                                                            Tuteur: <?= ucwords(strtolower($value['parent_tutor_name'])); ?>
                                                            | Tél:<?= ucwords(esc($value['parent_primary_phone'])); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if ($validation->hasError('tuteurEleve')) { ?>
                                                <span class="invalid-feedback">
                                                    <?= $validation->getError('tuteurEleve'); ?></span>
                                            <?php } ?>
                                            <label for="student_parent"><span class="text-danger">*</span>Responsable de
                                                l'élève</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="inputs_show" style="display:none;">
                                    <div class="col-sm-4">
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control text-capitalize" name="nom_pere_eleve"
                                                id="nom_pere_eleve" autocomplete="off"
                                                value="<?= set_value('nom_pere_eleve') ?>"
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
                                                value="<?= set_value('phone_pere') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="Numéro téléphone du père">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_pere2" id="phone_pere2"
                                                value="<?= set_value('phone_pere2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="Second numéro téléphone du père ">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">

                                            <input type="text" class="form-control text-capitalize" name="nom_mere_eleve"
                                                id="nom_mere_eleve" autocomplete="off"
                                                value="<?= set_value('nom_mere_eleve') ?>"
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
                                                value="<?= set_value('phone_mere') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="numéro téléphone de la mère ">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_mere2" id="phone_mere2"
                                                value="<?= set_value('phone_mere2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="Second numéro téléphone de la mère ">
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">

                                            <input type="text" class="form-control text-capitalize" name="nom_tuteur_eleve"
                                                id="nom_tuteur_eleve" autocomplete="off"
                                                value="<?= set_value('nom_tuteur_eleve') ?>"
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
                                                id="telephone_tuteur" value="<?= set_value('telephone_tuteur') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="numéro téléphone du tuteur">

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_tuteur2"
                                                id="telephone_tuteur2" value="<?= set_value('telephone_tuteur2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="second numéro téléphone du tuteur">

                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="phone_sms"><span class="text-danger">*</span>Personne
                                                Responsable à contacter en cas d'urgence
                                                :</label>
                                            <div class="input-group">
                                                <div class="icheck-success d-inline mr-3">
                                                    <input type="radio" name="phone_sms" checked id="pere" value="pere">
                                                    <label for="pere">
                                                        Père
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline mr-3 ml-3">
                                                    <input type="radio" name="phone_sms" id="mere" value="mere">
                                                    <label for="mere">
                                                        Mère
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input type="radio" name="phone_sms" id="tuteur" value="tuteur">
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
                                                    id="phone_primary" value="<?= set_value('phone_primary') ?>"
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
                                                    id="email_tuteur" value="<?= set_value('email_tuteur') ?>"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <h5 class="font-weight-bold">
                                            <span class="text-danger"></span>Adresse de résidence
                                        </h5>
                                    </div>

                                    <div class="col-sm-3 col-lg-3 mb-2">
                                        <div class="form-floating">

                                            <select
                                                class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                                id="student_commune" name="student_commune"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected disabled> sélectionnez une commune </option>
                                               <!--  <option value="new_commune">Nouvelle commune</option> -->
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
                                            <label for="student_commune"><span class="text-danger"></span>Commune de
                                                l'élève</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 mb-2">
                                        <div class="form-floating">
                                            <select
                                                class="form-control select2 select2-info <?= ($validation->hasError('student_area')) ? ' is-invalid' : '' ?>"
                                                id="student_area" name="student_area" data-dropdown-css-class="select2-info"
                                                style="width: 100%;">
                                                <option selected disabled> sélectionnez un quartier </option>
                                               <!--  <option value="new_area">Nouveau quartier</option> -->
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
                                            <label for="student_area"><span class="text-danger"></span>Quartier de
                                                l'élève</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 mb-2">
                                        <div class="form-floating">
                                            <select
                                                class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                                id="address_street" name="address_street"
                                                data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option selected disabled> sélectionnez une zone </option>
                                                <option value="new_zone">Nouvelle zone d'adresse</option>
                                                <?php if (isset($zones) && !empty($zones)):
                                                    foreach ($zones as $zonekey => $zone):
                                                ?>
                                                        <option value="<?= esc($zone['address_id']); ?>"
                                                            <?= set_select('address_street', esc($zone['address_id'])); ?>>
                                                            <?= ucwords($zone['address_home_code']); ?> |
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
                                            <label for="address_street"><span class="text-danger"></span>Avenue/Rue de
                                                l'élève</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3 form-floating mb-2" id="inputs_commune_show"
                                        style="display:none;">
                                        <input type="text" class="form-control text-capitalize" name="commune_name"
                                            id="commune_name" autocomplete="off" value="<?= set_value('commune_name') ?>"
                                            style="border-radius: 10px!important;" placeholder="Ex: Kampemba" />
                                        <label for="commune_name" class="control-label">
                                            <span class="text-danger">*</span>Nom de la commune
                                        </label>
                                    </div>
                                    <div class="col-sm-3 col-lg-3 form-floating mb-2" id="inputs_area_show"
                                        style="display:none;">
                                        <input type="text" class="form-control text-capitalize" name="area_name"
                                            id="area_name" autocomplete="off" value="<?= set_value('area_name') ?>"
                                            style="border-radius: 10px!important;" placeholder="Ex: Bel-Air" />
                                        <label for="area_name" class="control-label">
                                            <span class="text-danger">*</span>Nom du quartier
                                        </label>
                                    </div>
                                    <div class="col-sm-6 col-lg-6" id="inputs_zone_show" style="display:none;">
                                        <div class="row">
                                            <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                                <input type="text" class="form-control text-capitalize"
                                                    name="address_number" id="address_number" autocomplete="off"
                                                    value="<?= set_value('address_number') ?>"
                                                    style="border-radius: 10px!important;" placeholder="Ex: 15B" />
                                                <label for="address_number" class="control-label">
                                                    Numéro Maison
                                                </label>
                                            </div>
                                            <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                                <input type="text" class="form-control text-capitalize"
                                                    name="address_street_name" id="address_street_name" autocomplete="off"
                                                    value="<?= set_value('address_street_name') ?>"
                                                    style="border-radius: 10px!important;" placeholder="Ex: Sapins" />
                                                <label for="address_street_name" class="control-label">
                                                    Rue<span class="text-danger"></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                                <input type="text" class="form-control text-capitalize" name="address_name"
                                                    id="address_name" autocomplete="off"
                                                    value="<?= set_value('address_name') ?>"
                                                    style="border-radius: 10px!important;" placeholder="Ex: Savonnier" />
                                                <label for="address_name" class="control-label">
                                                    <span class="text-danger">*</span>Nom de l'avenue
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-inline">
                                <div class="text-left text-danger font-weight-bold">
                                    <span>N.B: (*) information obligatoire</span>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info btn-rounded text-uppercase">
                                        <i class="fas fa-check-circle fa-lg"></i> Valider l'inscription
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
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>