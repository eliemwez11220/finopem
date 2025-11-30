<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <a href="<?= base_url('education/slipnotes') ?>" class="text-uppercase btn btn-default btn-xs printoff">
                <i class="fa fa-arrow-circle-left"></i> VOIR LA LISTE</a>
                </div>
                <div class="col-sm-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview/type/dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Suivi scolaire</li>
                        <li class="breadcrumb-item active">Bulletin</li>
                        <li class="breadcrumb-item active">Secondaire</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header printoff">
                            <div class="card-title">
                                <h5 class="text-uppercase font-weight-bold">
                                    Bulletin de l'élève :
                                    <?= isset($info_student) ? strtoupper($info_student['student_firstname']): ''; ?>
                                    <?= isset($info_student) ?strtoupper($info_student['student_lastname']): ''; ?>
                                    <?= isset($info_student) ?strtoupper($info_student['student_surname']): ''; ?>
                                </h5>
                            </div>
                            <div class="card-tools">
                                <a href="#" class="btn btn-success btn-rounded text-uppercase btn-xs printoff"
                                    onclick="print();">
                                    <i class="fa fa-print"></i> Imprimer</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table width="100%">
                                <tr>
                                    <td rowspan="3" width="55px"><img src="<?= base_url('public/img/rdc.png'); ?>"
                                            width="50px" />
                                    </td>
                                    <td rowspan="3" style="text-align: center; vertical-align: middle;">
                                        <b>
                                            REPUBLIQUE DEMOCRATIQUE DU CONGO<br>
                                            MINISTERE DE L'ENSEIGNEMENT PRIMAIRE, SECONDAIRE ET PROFESSIONNEL
                                        </b>
                                    </td>
                                    <td rowspan="3" width="55px"><img src="<?= base_url('public/img/rdc.png'); ?>"
                                            width="50px" class="fr" /></td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td width="50%">N° ID:
                                        <b><?= isset($info_student) ?strtoupper($info_student['student_sernie_id']): ''; ?></b>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td width="50%">PROVINCE
                                        :<b><?= isset($info_student) ?strtoupper($info_student['student_province']): ''; ?></b>
                                    </td>
                                    <td width="50%">ELEVE : <span class="font-weight-bold text-uppercase">
                                            <?= isset($info_student) ? strtoupper($info_student['student_firstname']): ''; ?>
                                            <?= isset($info_student) ?strtoupper($info_student['student_lastname']): ''; ?>
                                            <?= isset($info_student) ?strtoupper($info_student['student_surname']): ''; ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">VILLE :
                                        <b><?= isset($info_student) ?strtoupper($info_student['student_address_area']): ''; ?></b>
                                    </td>
                                    <td width="50%">NE(E) A :
                                        <b><?= isset($info_student) ?strtoupper($info_student['student_born_place']): ''; ?></b>,
                                        le
                                        <b><?= isset($info_student) ?date("d/m/Y", strtotime($info_student['student_birthday'])): ''; ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" class="small text-uppercase">COMMUNE / TER.(1) :
                                        <b><?= isset($info_student) ?strtoupper($info_student['student_address']): ''; ?></b>
                                    </td>
                                    <td width="50%" class="small text-uppercase">CLASSE :
                                        <b>
                                            <?= isset($info_student) ? setDegresLevels(trim($info_student['degree_code']), 'f'): ''; ?>
                                            <?= isset($info_student) ? strtoupper(trim($info_student['option_name'])): ''; ?>

                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" class="text-uppercase">ECOLE :
                                        <b><?= session()->get('schoolfname'); ?></b></td>
                                    <td width="50%">N° PERM. :
                                        <b><?= isset($info_student) ?strtoupper($info_student['student_permanent_code']): ''; ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><br></td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align: center; vertical-align: middle;">
                                        BULLETIN DE LA <b>
                                            <span class="text-uppercase">
                                                <?= isset($info_student) ? setDegresLevels(trim($info_student['degree_code']), 'f'): ''; ?>
                                                <?= isset($info_student) ? strtoupper(trim($info_student['section_name'])): ''; ?>

                                            </span>
                                        </b> - ANNEE SCOLAIRE
                                        <b><?= isset($info_student) ?strtoupper($info_student['year_started']): ''; ?>-<?= isset($info_student) ?strtoupper($info_student['year_ended']): ''; ?></b>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <td style="text-align: center;" rowspan="3" align="center" valign="middle">
                                            <b>BRANCHES</b>
                                        </td>
                                        <td style="text-align: center;" colspan="4" align="center" valign="middle">
                                            PREMIER SEMESTRE
                                        </td>
                                        <td style="text-align: center;" colspan="4" align="center" valign="middle">
                                            SECOND SEMESTRE
                                        </td>
                                        <td style="text-align: center;" rowspan="3" align="center" valign="middle">T.G
                                        </td>
                                        <td style="text-align: center; background-color: black;" rowspan="3"
                                            align="center" valign="middle"></td>
                                        <td style="text-align: center;" rowspan="2" colspan="2" align="center"
                                            valign="middle">EXAMEN DE REP.
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2">TRAV. JOUR.</td>
                                        <td rowspan="2">EXAM.</td>
                                        <td rowspan="2">TOT.</td>
                                        <td colspan="2">TRAV. JOUR.</td>
                                        <td rowspan="2">EXAM.</td>
                                        <td rowspan="2">TOT.</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>P1</td>
                                        <td>P2</td>
                                        <td>P3</td>
                                        <td>P4</td>
                                        <td>%</td>
                                        <td>SIGN. PROF.</td>
                                    </tr>
                                    <?php  
                                    
                                if (isset($maximas) && !empty($maximas)):
                                    foreach ($maximas as $key => $max): 
                                        $exam_total = $max['maxima_total_exam'];
                                        $per_total = $max['maxima_total_period'];
                                        ?>
                                    <tr class="alert alert-secondary small">
                                        <td class="text-uppercase small font-weight-bold"> MAXIMA </td>
                                        <td class="text-center"><?= $per_total; ?></td>
                                        <td class="text-center"><?= $per_total; ?></td>
                                        <td class="text-center"><?= $exam_total; ?></td>
                                        <td class="text-center"><?= $per_total*4;; ?></td>
                                        <td class="text-center"><?= $per_total; ?></td>
                                        <td class="text-center"><?= $per_total; ?></td>
                                        <td class="text-center"><?= $exam_total; ?></td>
                                        <td class="text-center"><?= $per_total*4; ?></td>
                                        <td class="text-center"><?= $per_total*8; ?></td>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php  
                                    $count = 1;
                                    $tot1 = 0;
                                    $tot2 = 0;
                                    $totgen = 0;
                                    
                                     if (isset($courses) && !empty($courses)):
                                        foreach ($courses as $keycourse => $valuecourse):
                                            if (($valuecourse['courseclasse_maxima_id'] == $max['maxima_id'])):
                                                ?>
                                                <tr>
                                                    <td class="text-uppercase small">
                                                        <?= esc($valuecourse['course_name']); ?>
                                                    </td>     
                                    <?php     
                                $per1 = 0;
                                $per2 = 0;
                                $per3 = 0;
                                $per4 = 0;
                                $exam1 = 0;
                                $exam2 = 0;
                                if (isset($slipnote) && !empty($slipnote)):
                                    foreach ($slipnote as $key => $value):
                                        if (($value['grade_course_id'] == $valuecourse['courseclasse_id'])):
                                            if (strtoupper($value['period_shortname']) == 'P1'):
                                                $per1 = number_format($value['grade_total'], 2);
                                            elseif (strtoupper($value['period_shortname']) == 'P2'):
                                                $per2 = number_format($value['grade_total'], 2);
                                            elseif (strtoupper($value['period_shortname']) == 'P3'):
                                                $per3 = number_format($value['grade_total'], 2);
                                            elseif (strtoupper($value['period_shortname']) == 'P4'):
                                                $per4 = number_format($value['grade_total'], 2);
                                            elseif (strtoupper($value['period_shortname']) == 'E1'):
                                                $exam1 = number_format($value['grade_total'], 2);
                                            elseif (strtoupper($value['period_shortname']) == 'E2'):
                                                $exam2 = number_format($value['grade_total'], 2);
                                            endif;
                                        ?>
                                   <?php endif; ?>
                                   <?php endforeach; ?>
                                   <?php endif; ?>
                                   <?php
                                   $tot1 = $per1+$per2+$exam1;
                                   $tot2 = $per3+$per4+$exam2;
                                   $totgen = $tot1 + $tot2; 
                                   ?>
                                        <td class="text-center"><?= number_format($per1, 0); ?></td>
                                        <td class="text-center"><?= number_format($per2, 0); ?></td>
                                        <td class="text-center"><?= number_format($exam1, 0); ?></td>
                                        <td class="text-center"><?= number_format($tot1, 0); ?></td>
                                        <td class="text-center"><?= number_format($per3, 0); ?></td>
                                        <td class="text-center"><?= number_format($per4, 0); ?></td>
                                        <td class="text-center"><?= number_format($exam2, 0); ?></td>
                                        <td class="text-center"><?= number_format($tot2, 0); ?></td>
                                        <td class="text-center"><?= number_format($totgen, 0); ?></td>
                                        <td style="background-color: black;"></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                   
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                    <tr>
                                        <th>MAXIMA GENER.</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3" style="background-color: black;"></td>
                                    </tr>
                                    <tr>
                                        <th>TOTAUX</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td rowspan="5" style="background-color: black;"></td>
                                        <td colspan="2" rowspan="6" valign="top">
                                            <p>
                                                - PASSE (1) <br>
                                                - DOUBLE (1)<br>
                                                - A ECHOUE (1)<br><br>
                                                Le Chef de <br>l'établissement<br>
                                                Sceau de l'école<br>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>POURCENTAGE</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>PLACE/NBRE ELEVES.</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>APPLICATION</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" rowspan="2" style="background-color: black;"></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3" rowspan="2" style="background-color: black;">
                                    </tr>
                                    <tr>
                                        <th>CONDUITE</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">SIGN. DU RESPONSABLE</th>
                                        <td rowspan="2" colspan="4"></td>
                                        <td rowspan="2" colspan="5"></td>
                                    </tr>
                                    <table>
                                        <tr>
                                            <td colspan="3" width="100%">
                                                <p>
                                                    1. L'élève ne pourra passer dans la classe supérieure s'il n'a subi
                                                    avec succès un examen de repêchage en ..............
                                                    ................... .............. .......... ..........
                                                    ............ ................ ............... ............
                                                    ........... ........... ........... ........... ...........
                                                    <br>
                                                    2. L'élève passe dans la classe supérieure (1).
                                                    <br>
                                                    3. L'élève double sa classe (1).
                                                    <br>
                                                    4. L'élève a échoué et est à réorienter vers
                                                    ........................................... (1).
                                                    <span class="fr">Fait à .................................... Le
                                                        .............................................</span>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="6" valign="top" align="center">Signature de l'élève</td>
                                            <td rowspan="6" valign="top" align="center">Sceau de l'école</td>
                                            <td rowspan="6" valign="top" align="center">Le chef de l'établissement <br>
                                                Nom et signature
                                            </td>
                                        </tr>

                                    </table>
                                    <table>
                                        <tr>
                                            <td width="100%">
                                                <p>
                                                    (1) Biffer la mention inutile.
                                                    <br>
                                                    Note importante: Le bulletin est sans valeur s'il est raturé ou
                                                    surchargé.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </tbody>
                            </table>
                        </div>
                        <div class="footer">.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
</div>