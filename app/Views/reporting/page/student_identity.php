<div class="row printoff">
    <div class="col-sm-12 col-lg-12">
        <blockquote>
            <form role="form" id="form_ajax_reporting" method="get">
                <div class="form-floating input-group" style="width: 100%!important;">
                    
                    <select id="ajax_student_reporting" name="ajax_student_reporting" title="Eleve"
                        class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                        <option disabled selected>--sélectionnez un étudiant-- </option>
                        <option value="all">Tous les étudiants</option>
                        <?php $students_listing = array();
                            if (session()->has('studentsclasses')) {

                                $students_session = session()->get('studentsclasses');

                                if ($students_session == 'none') {
                                    $students_listing = array();
                                } else {
                                    $students_listing = $students_session;
                                }
                            } else {
                                if (isset($students)) {
                                    $students_listing = $students;
                                }
                            }
                            if (!empty($students_listing)):

                            foreach ($students_listing as $key => $studentval):
                                $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                if (($branch_access == $studentval['section_id'])):
                                    if ($studentval['inscription_status'] == 'actif'):
                                    ?>
                                    <option value="<?= trim($studentval['inscription_id']); ?>" <?= (session()->has('studentchoosed') && (session()->studentchoosed == $studentval['inscription_id'])) ? 'selected' : set_select('ajax_student', esc($studentval['inscription_id'])); ?>>
                                            <?= strtoupper($studentval['student_firstname']); ?>
                                            <?= strtoupper($studentval['student_lastname']); ?>
                                            <?= strtoupper($studentval['student_surname']); ?>
                                            (<?= strtoupper($studentval['student_code']); ?>) |
                                            <?= setDegresLevels(trim($studentval['degree_code']), 'f'); ?>
                                            <?= strtoupper(trim($studentval['classe_subname'])); ?>
                                            <?= strtoupper(trim($studentval['option_name'])); ?>
                                        </option>
                                <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <label for="ajax_student_reporting" class="text-capitalize">
                        <span class="text-danger">*</span>étudiants</label>
                </div>
            </form>
        </blockquote>
    </div>
</div>
<?php if ((session()->has('reportingdata')) && (session()->has('studentchoosed'))): ?>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->
                </div>
            </div>
            <?php
            $student_choosed_id = session()->has('studentchoosed') ? session()->get('studentchoosed'):'';
            $student = (session()->has('reportingdata')) ? session()->reportingdata['student'] : '';
            if (!empty($student)):
                ?>
                <div class="shadow-lg text-center" style="border:2px solid black">
                    <h3 class="text-uppercase font-weight-bold py-3">
                        <span class="text-primary small font-weight-bold">
                            <?= setReporting(session()->get('reportingtype'), "Communiqué de conformisation d'inscription "); ?>
                            <br>Dossier étudiant No <?= $student['student_code']; ?>
                        </span>
                    </h3>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <blockquote>
                            <p class="text-dark font-weight-bold">Chers parents,
                                conformément aux données complétées à l’école lors de l’inscription
                                de l’enfant

                                [<span class="text-primary text-uppercase font-weight-bold">
                                    <?= trim($student['student_firstname']); ?>
                                    <?= trim($student['student_lastname']); ?>
                                    <?= trim($student['student_surname']); ?>
                                    -
                                </span>

                                immatriculé:
                                <span class="text-primary text-uppercase font-weight-bold">
                                    <?= trim($student['student_code']); ?>
                                </span>
                                de la
                                <span class="text-primary text-uppercase font-weight-bold">
                                    <?= setDegresLevels(($student['degree_code'])); ?>
                                    <?= trim(($student['classe_subname'])); ?>
                                    <?= trim(($student['option_name'])); ?>
                                </span>] pour l’année <?= session()->schoolyear; ?>, sa fiche d’information se présente comme
                                suite :
                            </p>
                        </blockquote>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="table-responsive">
                        <table id="datatablesWithoutActions"
                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-uppercase">
                                    <th colspan="2" class=" font-weight-bold bg-info">
                                        Informations de base sur l'enfant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Nom étudiant</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['student_firstname'])); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Postnom étudiant</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['student_lastname'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Prenom étudiant</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['student_surname'])); ?>
                                    </td>
                                </tr>


                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Sexe</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['student_gender'])); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Date de naissance</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (!empty($student['student_birthday'])) ? date("d/m/Y", strtotime($student['student_birthday'])) : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Lieu de naissance</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['student_born_place'])); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Ecole provenance</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['inscription_origin_school'])); ?>
                                    </td>
                                </tr>


                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Observation Générale</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= (trim($student['student_notes'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Classe inscrite</td>
                                    <td class="text-uppercase font-weight-bold">
                                        <?= setDegresLevels(($student['degree_code'])); ?>
                                        <?= trim(($student['classe_subname'])); ?>
                                        <?= (trim($student['section_name'])); ?>
                                        <?= ($student['section_name'] == 'secondaire' or $student['section_name'] == 'sécondaire') ? $student['option_name'] : ''; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="table-responsive">
                        <table id="datatablesWithoutActions"
                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-uppercase">
                                    <th colspan="2" class=" font-weight-bold bg-info">
                                        <b>COORDONNÉES SUR RESPONSABLE</b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td rowspan="2" class="align-middle">
                                        <i class="fas fa-arrow-right"></i> Père
                                    </td>
                                    <td class="text-uppercase font-weight-bold">
                                    Nom: <?= (trim($student['parent_father_name'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase font-weight-bold">
                                        Tél:<?= $student['parent_father_phone']; ?> /
                                        <?= $student['parent_father_phone2']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="align-middle"><i class="fas fa-arrow-right"></i> Mère</td>
                                    <td class="text-uppercase font-weight-bold">
                                    Nom:<?= (trim($student['parent_mother_name'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase font-weight-bold">
                                        Tél:<?= $student['parent_mother_phone']; ?> /
                                        <?= $student['parent_mother_phone2']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="align-middle"><i class="fas fa-arrow-right"></i> Tuteur</td>
                                    <td class="text-uppercase font-weight-bold">
                                    Nom:<?= (trim($student['parent_tutor_name'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase font-weight-bold">
                                        Tél:<?= $student['parent_tutor_phone']; ?> / <?= $student['parent_tutor_phone2']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> E-mail</td>
                                    <td class="text-lowercase font-weight-bold">
                                        <?= (trim($student['parent_primary_email'])); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-arrow-right"></i> Adresse</td>
                                    <td class="text-capitalize font-weight-bold">
                                        <?= (trim($student['parent_primary_address'])); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="text-center">
                        <blockquote>
                            <div class="text-left text-uppercase">
                                <span class="font-weight-bold h5">
                                    Documents déposés à l’école
                                </span>
                            </div>
                        </blockquote>
                    </div>
                    <table id="datatablesReportingActionsx"
                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="text-center">#</th>
                                <th>Désignation</th>
                                <th class="text-center">Nombre</th>
                                <th>Remarques</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (isset($documents) && (!empty($documents))): ?>

                                <?php $count = 1;
                                foreach ($documents as $document):
                                    if ($document['document_student_id'] == $student['student_id']):
                                        if ($document['document_type'] == 'document'): ?>
                                            <tr class="small">
                                                <td class="text-center"><?= $count++; ?></td>
                                                <td class="text-uppercase font-weight-bold">
                                                    <?= trim($document['document_name']); ?>
                                                </td>
                                                <td class="text-uppercase font-weight-bold text-center">
                                                    <?= number_format($document['document_quantity'], 0); ?>
                                                </td>
                                                <td class="text-uppercase"><?= $document['document_notes']; ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="text-center">
                        <blockquote>
                            <div class="text-left text-uppercase">
                                <span class="font-weight-bold h5">
                                    Biens déposés à l’école
                                </span>
                            </div>
                        </blockquote>
                    </div>
                    <table id="datatablesReportingActionsx"
                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="text-center">#</th>
                                <th>Désignation</th>
                                <th class="text-center">Quantité</th>
                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (isset($documents) && (!empty($documents))): ?>

                                <?php $count = 1;
                                foreach ($documents as $document):
                                    if ($document['document_student_id'] == $student['student_id']):
                                        if ($document['document_type'] != 'document'): ?>
                                            <tr class="small">
                                                <td class="text-center"><?= $count++; ?></td>
                                                <td class="text-uppercase font-weight-bold">
                                                    <?= trim($document['document_name']); ?>
                                                </td>
                                                <td class="text-uppercase font-weight-bold text-center">
                                                    <?= number_format($document['document_quantity'], 0); ?>
                                                </td>
                                                <td class="text-uppercase"><?= $document['document_notes']; ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">

            <p class="font-weight-bold">
                NB : Pour nous permettre d’harmoniser notre base de données, nous vous prions de bien vouloir vérifier les
                informations, de compléter les éléments manquants et de proposer des correctifs au stylo rouge en
                cas d’erreur de transcription tout en prenant soins de barré l’information erronée ; enfin, apposé
                votre signature en bas dans la zone concernée.
            </p>
        </div>
    </div>
<?php else: ?>
    <?php if (isset($students) && (!empty($students))): ?>
        <?php foreach ($students as $student):
            if ($student['inscription_status'] == 'actif'):
            ?>
            <div class="card" style="page-break-after: always!important;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>

                    <div class="shadow-lg text-center" style="border:2px solid black">
                        <h3 class="text-uppercase font-weight-bold py-3">
                            <span class="text-primary small font-weight-bold">
                                <?= setReporting(session()->get('reportingtype'), "Communiqué de conformisation d'inscription "); ?>
                                <br> Dossier étudiant No <?= $student['student_code']; ?>
                            </span>
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <blockquote>
                                <p class="text-dark font-weight-bold">Chers parents,
                                    conformément aux données complétées à l’école lors de l’inscription
                                    de l’enfant

                                    [<span class="text-primary text-uppercase font-weight-bold">
                                        <?= trim($student['student_firstname']); ?>
                                        <?= trim($student['student_lastname']); ?>
                                        <?= trim($student['student_surname']); ?>
                                        -
                                    </span>

                                    immatriculé:
                                    <span class="text-primary text-uppercase font-weight-bold">
                                        <?= trim($student['student_code']); ?>
                                    </span>
                                    de la
                                    <span class="text-primary text-uppercase font-weight-bold">
                                        <?= setDegresLevels(($student['degree_code'])); ?>
                                        <?= trim(($student['classe_subname'])); ?>
                                        <?= trim(($student['option_name'])); ?>
                                    </span>] pour l’année <?= session()->schoolyear; ?>, sa fiche d’information se présente comme
                                    suite :
                                </p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th colspan="2" class=" font-weight-bold bg-info">
                                                Informations de base sur l'enfant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Nom étudiant</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['student_firstname']); ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Postnom étudiant</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['student_lastname']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Prenom étudiant</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['student_surname']); ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Sexe</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['student_gender']); ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Date de naissance</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= (!empty($student['student_birthday'])) ? date("d/m/Y", strtotime($student['student_birthday'])) : ''; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Lieu de naissance</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['student_born_place']); ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Ecole provenance</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['inscription_origin_school']); ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Observation Générale</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= trim($student['student_notes']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Classe inscrite</td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= setDegresLevels(($student['degree_code'])); ?>
                                                <?= ucfirst(($student['classe_subname'])); ?>
                                                <?= trim($student['section_name']); ?>
                                                <?= ($student['section_name'] == 'secondaire' or $student['section_name'] == 'sécondaire') ? $student['option_name'] : ''; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="table-responsive">
                                <table id="datatablesWithoutActions"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th colspan="2" class=" font-weight-bold bg-info">
                                                <b>COORDONNÉES SUR RESPONSABLE</b>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td rowspan="2" class="align-middle">
                                                <i class="fas fa-arrow-right"></i> Père
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                Nom:<?= trim($student['parent_father_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase font-weight-bold">
                                                Tél:<?= $student['parent_father_phone']; ?> /
                                                <?= $student['parent_father_phone2']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" class="align-middle"><i class="fas fa-arrow-right"></i> Mère</td>
                                            <td class="text-uppercase font-weight-bold">
                                            Nom:<?= trim($student['parent_mother_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase font-weight-bold">
                                                Tél:<?= $student['parent_mother_phone']; ?> /
                                                <?= $student['parent_mother_phone2']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" class="align-middle"><i class="fas fa-arrow-right"></i> Tuteur</td>
                                            <td class="text-uppercase font-weight-bold">
                                            Nom:<?= trim($student['parent_tutor_name']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase font-weight-bold">
                                                Tél:<?= $student['parent_tutor_phone']; ?> / <?= $student['parent_tutor_phone2']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> E-mail</td>
                                            <td class="text-lowercase font-weight-bold">
                                                <?= trim($student['parent_primary_email']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fas fa-arrow-right"></i> Adresse</td>
                                            <td class="text-capitalize font-weight-bold">
                                                <?= trim($student['parent_primary_address']); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="text-center">
                                <blockquote>
                                    <div class="text-left text-uppercase">
                                        <span class="font-weight-bold h5">
                                            Documents déposés à l’école
                                        </span>
                                    </div>
                                </blockquote>
                            </div>
                            <table id="datatablesReportingActionsx"
                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th class="text-center">#</th>
                                        <th>Désignation</th>
                                        <th class="text-center">Nombre</th>
                                        <th>Remarques</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if (isset($documents) && (!empty($documents))): ?>

                                        <?php $count = 1;
                                        foreach ($documents as $document):
                                            if ($document['document_student_id'] == $student['student_id']):
                                                if ($document['document_type'] == 'document'): ?>
                                                    <tr class="small">
                                                        <td class="text-center"><?= $count++; ?></td>
                                                        <td class="text-uppercase font-weight-bold">
                                                            <?= $document['document_name']; ?>
                                                        </td>
                                                        <td class="text-uppercase font-weight-bold text-center">
                                                            <?= number_format($document['document_quantity'], 0); ?>
                                                        </td>
                                                        <td class="text-uppercase"><?= $document['document_notes']; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="text-center">
                                <blockquote>
                                    <div class="text-left text-uppercase">
                                        <span class="font-weight-bold h5">
                                            Biens déposés à l’école
                                        </span>
                                    </div>
                                </blockquote>
                            </div>
                            <table id="datatablesReportingActionsx"
                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th class="text-center">#</th>
                                        <th>Désignation</th>
                                        <th class="text-center">Quantité</th>
                                        <th>Observation</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if (isset($documents) && (!empty($documents))): ?>

                                        <?php $count = 1;
                                        foreach ($documents as $document):
                                            if ($document['document_student_id'] == $student['student_id']):
                                                if ($document['document_type'] != 'document'): ?>
                                                    <tr class="small">
                                                        <td class="text-center"><?= $count++; ?></td>
                                                        <td class="text-uppercase font-weight-bold">
                                                            <?= $document['document_name']; ?>
                                                        </td>
                                                        <td class="text-uppercase font-weight-bold text-center">
                                                            <?= number_format($document['document_quantity'], 0); ?>
                                                        </td>
                                                        <td class="text-uppercase"><?= $document['document_notes']; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center">
                        <hr>
                        <p class="font-weight-bold">
                            NB : Pour nous permettre d’harmoniser notre base de données, nous vous prions de bien vérifier les
                            informations, de compléter les éléments manquants et de proposer des correctifs au stylos rouge en
                            cas d’erreur de transcription tout en prenant soins de barré l’information erronée ; enfin, apposé
                            votre signature en bas dans la zone concernée.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>