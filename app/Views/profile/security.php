<div class="content-wrapper mb-3">
    <div class="container">
        <div class="row  align-items-center justify-content-between">
            <div class="col-auto">
                <nav aria-label="breadcrumb" class="text-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <a class="btn btn-dark btn-sm" href="<?= base_url('profile/page/profile'); ?>">
                                <i class="fas fa-chevron-left"></i> Retour au profile</a>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <div class="text-center alert alert-primary">
            <h1 class="fw-bold text-center">Mise à jour de paramètres de sécurité</h1>
        </div>
        <?php if (isset($user) && (!empty($user))): ?>
        <div class="basic-choices">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-gray-200">
                        <div class="card-content">
                            <?php
                                $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open_multipart(base_url('profileUpdateSecurity/' . $user['user_id']), $attributes);
                                ?>
                            <div class="card-body">
                                <input type="hidden" name="page"
                                    value="<?= (isset($account) && (!empty($account))) ? 'update':'create' ?>">
                                <div class="row">

                                    <div class="col-sm-6 form-group">
                                    <div class="form-floating">
                                        
                                        <select
                                            class="form-control form-select <?= ($validation->hasError('question1')) ? ' is-invalid' : '' ?>"
                                            title="Question de sécurité 1" name="question1" id="question1">
                                            <option disabled selected>--sélectionnez--</option>

                                            <?php
                                                $old_question1_db = (isset($account) && (!empty($account))) ? $account['security_question_1']:'';

                                                $types_values = array(
                                                    'nom_fille_ainee' => "Quel est le nom de votre fille ainée?",
                                                    'marque_voiture' => "Quelle marque de voiture préférez-vous?",
                                                    'province_origine' => "Quelle est votre province d'origine?",
                                                    'oiseau' => "Quel oiseau préférez-vous?",
                                                    'animal_domestique' => "Quel est votre animal domestique preferez-vous?",
                                                    'date_engagement' => "Quelle est la date à laquelle vous étiez engagé",
                                                    'village_origine' => " Quelle est votre village d'origine?",
                                                    'date_anniversaire' => " Quelle est la date de votre anniversaire?",
                                                    'date_mariage' => " A quelle date êtes-vous marié?",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                            <option value="<?= $key; ?>"
                                                <?= ($old_question1_db == $key) ? 'selected' : set_select("question1", $key); ?>>
                                                <?= ucfirst($value); ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="question1" class="form-label"><span class="text-danger">*</span>Question de sécuirté 1</label>
                                        <span class="text-danger"><?= displayFormError($validation, 'question1'); ?></span>
                                    </div>
                                    </div>

                                    <div class="col-sm-6 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control <?= ($validation->hasError('reponse1')) ? ' is-invalid' : '' ?>"
                                                id="reponse1" placeholder="" name="reponse1"
                                                value="<?= (!empty($account['security_response_1']))?$account['security_response_1']: set_value('reponse1'); ?>"
                                                aria-describedby="reponse1" />
                                            <label for="reponse1"><span class="text-danger">*</span>Réponse de la question 1</label>
                                            <div id="reponse1" class="form-text">
                                                <span
                                                    class="text-danger"><?= displayFormError($validation, 'reponse1'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-floating">
                                        
                                        <select
                                            class="form-control form-select  <?= ($validation->hasError('question2')) ? ' is-invalid' : '' ?>"
                                            title="Role Agent" name="question2" id="question2">
                                            <option disabled selected>--sélectionnez--</option>

                                            <?php
                                                $old_q2_db = (isset($account) && (!empty($account))) ?$account['security_question_2']:'';
                                                $types_values2 = array(
                                                    'nom_fille_ainee' => "Quel est le nom de votre fille ainée?",
                                                    'marque_voiture' => "Quelle marque de voiture préférez-vous?",
                                                    'province_origine' => "Quelle est votre province d'origine?",
                                                    'oiseau' => "Quel oiseau préférez-vous?",
                                                    'animal_domestique' => "Quel est votre animal domestique preferez-vous?",
                                                    'date_engagement' => "Quelle est la date à laquelle vous étiez engagé",
                                                    'village_origine' => " Quelle est votre village d'origine?",
                                                    'date_anniversaire' => " Quelle est la date de votre anniversaire?",
                                                    'date_mariage' => " A quelle date êtes-vous marié?",
                                                );
                                                foreach ($types_values2 as $key => $value) { ?>
                                            <option value="<?= $key; ?>"
                                                <?= ($old_q2_db == $key) ? 'selected' : set_select("question2", $key); ?>>
                                                <?= ucfirst($value); ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="question2" class="form-label"><span class="text-danger">*</span>Question de sécuirté 2</label>
                                        <span class="text-danger"><?= displayFormError($validation, 'question2'); ?></span>
                                    </div>
                                    </div>

                                    <div class="col-sm-6 mb-2">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control <?= ($validation->hasError('reponse2')) ? ' is-invalid' : '' ?>"
                                                id="reponse2" placeholder="" name="reponse2"
                                                value="<?= (!empty($account['security_response_2']))?$account['security_response_2']: set_value('reponse2'); ?>"
                                                aria-describedby="reponse2" />
                                            <label for="reponse2"><span
                                                    class="text-danger">*</span>Réponse question numéro 2</label>
                                            <div id="reponse2" class="form-text">
                                                <span
                                                    class="text-danger"><?= displayFormError($validation, 'reponse2'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                    <div class="form-floating">
                                        <select
                                            class="form-control form-select <?= ($validation->hasError('question3')) ? ' is-invalid' : '' ?>"
                                            title="Role Agent" name="question3" id="question3">
                                            <option disabled selected>--sélectionnez--</option>

                                            <?php
                                                $old_q2_db = (isset($account) && (!empty($account))) ? $account['security_question_3']:'';
                                                $types_values2 = array(
                                                    'nom_fille_ainee' => "Quel est le nom de votre fille ainée?",
                                                    'nom_fils_aine' => "Quel est le nom de votre fils ainé?",
                                                    'marque_voiture' => "Quelle marque de voiture préférez-vous?",
                                                    'province_origine' => "Quelle est votre province d'origine?",
                                                    'oiseau' => "Quel oiseau préférez-vous?",
                                                    'animal_domestique' => "Quel est votre animal domestique preferez-vous?",
                                                    'date_engagement' => "Quelle est la date à laquelle vous étiez engagé",
                                                    'village_origine' => " Quelle est votre village d'origine?",
                                                    'date_anniversaire' => " Quelle est la date de votre anniversaire?",
                                                    'date_mariage' => " A quelle date êtes-vous marié?",
                                                );
                                                foreach ($types_values2 as $key => $value) { ?>
                                            <option value="<?= $key; ?>"
                                                <?= ($old_q2_db == $key) ? 'selected' : set_select("question3", $key); ?>>
                                                <?= ucfirst($value); ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="question3" class="form-label"><span class="text-danger">*</span>Question de sécuirté 3</label>
                                        
                                        <span class="text-danger"><?= displayFormError($validation, 'question3'); ?></span>
                                    </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">

                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control <?= ($validation->hasError('reponse3')) ? ' is-invalid' : '' ?>"
                                                id="reponse3" placeholder="" name="reponse3"
                                                value="<?= (!empty($account['security_response_3']))?$account['security_response_3']: set_value('reponse3'); ?>"
                                                aria-describedby="reponse3" />
                                            <label for="reponse3"><span class="text-danger">*</span>Réponse question numéro 2</label>
                                            <div id="reponse3" class="form-text">
                                                <span
                                                    class="text-danger"><?= displayFormError($validation, 'reponse3'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="my-3 text-center">
                                    <button class="btn  btn-primary btn-lg rounded-2 py-3 btnrounded" type="submit">
                                        <i class="fas fa-check-circle"></i> Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>