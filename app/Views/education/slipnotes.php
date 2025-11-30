<div class="content-wrapper <?= checkModuleAccess('education'); ?>">
    <section class="content pt-2 p-md-2 p-lg-2 printoff">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignements</li>
                            <li class="breadcrumb-item active" aria-current="page">Cotations des élèves</li>

                        </ol>
                    </nav>
                </div>

                <div class="col-sm-6 col-lg-6">
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
        </div>
    </section>

    <section class="content printoff">
        <div class="container-fluid">
            
            <?php if (session()->has('choosedsectionid')): ?>
            <div class="row mb-2">
                <div class="col-lg-6 col-sm-12">
                    <form role="form" id="form_students_classes" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option selected>--Sélectionnez une classe--</option>
                                <?php if (isset($classes) && !empty($classes)):
                                        foreach ($classes as $key => $clasvalue):
                                            $branch_access = session()->get('choosedsectionid');
                                            if (($branch_access == $clasvalue['section_id'])):

                                                $classe_sess = session()->has('studentchoosedclasse') ? session()->get('studentchoosedclasse') : '';
                                    ?>
                                <option value="<?= esc($clasvalue['classe_id']); ?>"
                                    <?= ($classe_sess == $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                    <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                    <?= ucfirst($clasvalue['classe_subname']); ?>
                                    <?= ucfirst($clasvalue['option_name']); ?>
                                </option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="ajax_students_classes">
                                <span class="text-danger">*</span>Classes des élèves
                            </label>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <form role="form" id="form_ajax_reporting" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">

                            <select id="ajax_student_reporting" name="ajax_student_reporting" title="Eleve"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez un élève-- </option>

                                <?php 
                            if (isset($students) && !empty($students)):
                                foreach ($students as $key => $studentval):
                                    $classe_choosed = session()->get('studentchoosedclasse');
                                    $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid') : '';
                                if (($branch_access == $studentval['section_id']) && ($classe_choosed == $studentval['classe_id'])):
                                    if ($studentval['inscription_status'] == 'actif'):
                            ?>
                                <option value="<?= trim($studentval['inscription_id']); ?>"
                                    <?= (session()->has('studentchoosed') && (session()->get('studentchoosed') == $studentval['inscription_id'])) ? 'selected' : set_select('ajax_student', esc($studentval['inscription_id'])); ?>>
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
                                <span class="text-danger">*</span>élèves
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (isset($quotes_students) && !empty($quotes_students)): ?>
                <!-- ====== Start Reporting Header -->
                <?php include(APPPATH . ('Views/reporting/header.php')); ?>
                        <!-- ====== End Reporting Header -->
            <div class="card">
                <div class="card-header bg-primary text-center" style="border:2px solid black">
                    <h1 class="text-uppercase font-weight-bold lined lined-center" style="border-bottom: 3px dotted black; padding-bottom: 20px;">

                       Fiche de résultats scolaires
                    </h1>


                    <h2 class="text-uppercase font-weight-bold mt-3">
                        Élève: 
                        <?= strtoupper($info_student['student_firstname']); ?>
                        <?= strtoupper($info_student['student_lastname']); ?>
                        <?= strtoupper($info_student['student_surname']); ?>
                        (Matricule:
                        <?= $info_student['student_code']; ?>)
                    </h2>
                    <h2 class="text-uppercase font-weight-bold">
                        Classe: 
                        <?= setDegresLevels(trim($info_student['degree_code']), 'f'); ?>
                        <?= strtoupper(trim($info_student['classe_subname'])); ?>
                        <?= strtoupper(trim($info_student['option_name'])); ?>
                    |
                        Section: 
                        <?= strtoupper($info_student['section_name']); ?>
                    </h2>
                    <h2 class="text-uppercase font-weight-bold">
                        Année scolaire: 
                        <?= strtoupper($info_student['year_started']); ?>-<?= strtoupper($info_student['year_ended']); ?>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>Cours</th>
                                            <th class="text-center">Points Obtenus</th>
                                            <th class="text-center">Pondération</th>
                                            <th>Observation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $total_period = 0; 
                                            $total_course_max = 0; 
                                            $pourcentage = 0; 
                                        ?>
                                    <?php 
                                    $grouped_results = [];
                                    foreach ($quotes_students as $result) {
                                        if ($result['grade_student_id'] == $info_student['inscription_id']) {
                                            $course_name = strtoupper($result['course_name']);
                                            $period = strtoupper($result['period_shortname']);
                                            $points_obtained = floatval($result['grade_total']);
                                            $period_point = floatval($result['courseclasse_period_point']);
                                            $notes = esc($result['grade_notes']);

                                            
                                            $total_period += $points_obtained;
                                            $total_course_max += $period_point;
                                            $pourcentage = $total_period / $total_course_max;
                                        ?>
                                        <tr>
                                            <td><?= $course_name; ?></td>
                                                <td class="text-center"><?= $points_obtained; ?></td>
                                                <td class="text-center"><?= $period_point; ?></td>
                                                <td><?= $notes; ?></td>
                                            </tr>
                                        <?php
                                    }
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-uppercase font-weight-bold">
                                            <td>Total</td>
                                            <td class="text-center"><?=$total_period; ?></td>
                                            <td class="text-center"><?=$total_course_max; ?></td>
                                            <td class="text-center"></td>
                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="text-center py-3" style="border:2px dotted black">
                                <h3 class="text-uppercase font-weight-bold">
                                    Moyenne Générale: <?= number_format($pourcentage, 2); ?>%
                                </h3>
                                <h4 class="text-uppercase font-weight-bold">
                                    Statut du résultat: 
                                    <?php if ($pourcentage >= 50): ?>
                                    <span class="text-success font-weight-bold">Réussite</span>
                                    <?php else: ?>
                                    <span class="text-danger font-weight-bold">Échec</span>
                                    <?php endif; ?>
                                </h4>
                            </div>

                            <div class="text-right mt-3">
                                <p class="font-weight-bold mb-4">Fait à <?= (session()->has('schoolcity')) ? (session()->get('schoolcity')) : 'Lubumbashi'; ?>, le <?= date('d/m/Y'); ?></p>
                                <p class="font-weight-bold">Signature de l'enseignant: ______________________</p>
                            </div>

                            <div class="text-center mt-4 printoff">
                                <button class="btn btn-primary" onclick="window.print();">
                                    <i class="fas fa-print"></i>
                                    Imprimer la fiche de résultat
                                </button>

                                <?php 
                                $slipnote_type = '';
                                if($info_student['section_name'] == 'Primaire') {
                                    $slipnote_type = 'primary';
                                } elseif($info_student['section_name'] == 'Secondaire') {
                                    $slipnote_type = 'secondary';
                                } elseif($info_student['section_name'] == 'Maternelle') {
                                    $slipnote_type = 'kindergarten';
                                } else {
                                    $slipnote_type = 'slipnote';
                                }
                                ?>

                                <a href="<?= base_url('education/details/'.$slipnote_type.'/'.$info_student['student_token']); ?>" class="btn btn-secondary">
                                    <i class="fas fa-book"></i>
                                    Afficher le bulletin scolaire
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-warning text-center">
                Aucun résultat disponible. Veuillez choisir un élève et une section valide !
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>