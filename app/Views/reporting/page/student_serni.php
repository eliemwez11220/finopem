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
                        <option value="<?= trim($studentval['inscription_id']); ?>"
                            <?= (session()->has('studentchoosed') && (session()->studentchoosed == $studentval['inscription_id'])) ? 'selected' : set_select('ajax_student', esc($studentval['inscription_id'])); ?>>
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
        <?php
            $student_choosed_id = session()->has('studentchoosed') ? session()->get('studentchoosed') : '';
            $student = (session()->has('reportingdata')) ? session()->reportingdata['student'] : '';
            if (!empty($student)):
                $studentavatar = $student['student_picture'];

                $avatar = base_url('public/uploads/images/' . $studentavatar);


                $defavatar = ($student['student_gender'] == 'masculin') ? 'avatar.png' : 'expertwoman.png';
                $pathdefavatar = base_url('public/img/' . $defavatar);

                ?>


        <div class="row">
            <div class="col-lg-9 col-sm-9 text-center">
                <h3 class="text-uppercase font-weight-bold">
                    République Démocratique du Congo
                </h3>
                <img src="<?= base_url('public/img/rdc.png'); ?>" alt="..." class="avatar avatar-lg">
                <h3 class="text-uppercase font-weight-bold small">
                    Ministère de l'éducation nationale et de la nouvelle citoyenneté
                </h3>
                <h3 class="text-uppercase font-weight-bold small">
                    Province du Haut-Katanga
                </h3>
                <h3 class="text-uppercase font-weight-bold small">
                    Sous-division Lubumbashi I
                </h3>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="mt-5 text-center">
                    <img src="" alt="PHOTO" class="avatar avatar-xl" style="border:2px solid black" />
                </div>
            </div>
        </div>


        <div class="row  mt-3">
            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2 text-center mt-3 mb-3">
                <h3 class="text-uppercase font-weight-bold">
                    Antenne Sernie
                </h3>
                <h4 class="text-uppercase font-weight-bold">
                    Lubumbashi 1
                </h4>
                <h4 class="text-uppercase font-weight-bold">
                    Identification de l'étudiant
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="table-responsive" style="border:2px solid black">
                    <table id="datatablesWithoutActions"
                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr class="text-uppercase text-center">
                                <th width="5%"></th>
                                <th colspan="2" class=" font-weight-bold bg-info">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-uppercase">
                            <tr>
                                <td>No</td>
                                <td>Numéro étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_sernie_id']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Code Antenne</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= session()->has('schoolantenna') ? session()->get('schoolantenna'):''; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Code Ecole</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= session()->has('schoolidcode') ? session()->get('schoolidcode'):'7-711924'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Nom étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_firstname']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Postnom étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_lastname']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Prénom étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_surname']); ?>
                                </td>
                            </tr>


                            <tr>
                                <td>6</td>
                                <td>Sexe</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_gender']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Date de naissance</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= (!empty($student['student_birthday'])) ? date("d/m/Y", strtotime($student['student_birthday'])) : ''; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Lieu de naissance</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_born_place']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>9</td>
                                <td>Nationalité</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_nationality']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>10</td>
                                <td>Adresse</td>
                                <td class="text-capitalize font-weight-bold">
                                    <?= (trim($student['parent_primary_address'])); ?>
                                </td>
                            </tr>



                            <tr>
                                <td class="align-middle"> 11 </td>
                                <td class="align-middle"> Nom du Père </td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['parent_father_name']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle"> 12</td>
                                <td class="align-middle"> Nom de la Mère</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['parent_mother_name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"> 13</td>
                                <td class="align-middle">Téléphone principal</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= $student['parent_primary_phone']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>14</td>
                                <td>Code Niveau</td>
                                <td class="text-lowercase font-weight-bold">

                                </td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>Code Option</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['option_name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>Année Scolaire</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= session()->yearstarted; ?>-<?= session()->yearclosing; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>17 </td>
                                <td>Classe</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                    <?= trim($student['classe_subname']); ?>
                                    <?= trim($student['section_name']); ?>
                                    <?= trim($student['option_name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>Province d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_province']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>Territoire d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_territory']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Secteur d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_sector']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Groupement d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_grouping']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Village d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_village']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>Numéro permenant</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_permanent_code']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>Etat étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_status']); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-2">
                    <p class="font-weight-bold text-uppercase">
                        NB : Complétez obligatoirement tous les champs sauf le N° 14, 15 & 21 (qui seront compléter à
                        l'école).
                    </p>
                    <p class="font-weight-bold text-uppercase">
                        Chef d'Antenne
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
<?php if (isset($students) && (!empty($students))): ?>
<?php foreach ($students as $student):
            $studentavatar = $student['student_picture'];

            $avatar = base_url('public/uploads/images/' . $studentavatar);


            $defavatar = ($student['student_gender'] == 'masculin') ? 'avatar.png' : 'expertwoman.png';
            $pathdefavatar = base_url('public/img/' . $defavatar);

            ?>
<div class="card" style="page-break-after: always!important;">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-9 col-sm-9 text-center">
                <h3 class="text-uppercase font-weight-bold">
                    République Démocratique du Congo
                </h3>
                <img src="<?= base_url('public/img/rdc.png'); ?>" alt="..." class="avatar avatar-lg">
                <h3 class="text-uppercase font-weight-bold small">
                    Ministère de l'éducation nationale et de la nouvelle citoyenneté
                </h3>
                <h3 class="text-uppercase font-weight-bold small">
                    Province du Haut-Katanga
                </h3>
                <h3 class="text-uppercase font-weight-bold small">
                    Sous-division Lubumbashi I
                </h3>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="mt-5 text-center">
                    <img src="" alt="PHOTO" class="avatar avatar-xl" style="border:2px solid black" />
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 col-sm-12 col-xs-12 mb-2 text-center mt-3 mb-3">
                <h3 class="text-uppercase font-weight-bold">
                    Antenne Sernie
                </h3>
                <h4 class="text-uppercase font-weight-bold">
                    Lubumbashi 1
                </h4>
                <h4 class="text-uppercase font-weight-bold">
                    Identification de l'étudiant
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="table-responsive" style="border:2px solid black">
                    <table id="datatablesWithoutActions"
                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr class="text-uppercase text-center">
                                <th width="5%"></th>
                                <th colspan="2" class=" font-weight-bold bg-info">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-uppercase">
                            <tr>
                                <td>No</td>
                                <td>Numéro étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_sernie_id']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Code Antenne</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= session()->has('schoolantenna') ? session()->get('schoolantenna'):'7101'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Code Ecole</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= session()->has('schoolidcode') ? session()->get('schoolidcode'):'7-711924'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Nom étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_firstname']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Postnom étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_lastname']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Prénom étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_surname']); ?>
                                </td>
                            </tr>


                            <tr>
                                <td>6</td>
                                <td>Sexe</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_gender']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Date de naissance</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= (!empty($student['student_birthday'])) ? date("d/m/Y", strtotime($student['student_birthday'])) : ''; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Lieu de naissance</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_born_place']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>9</td>
                                <td>Nationalité</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_nationality']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>10</td>
                                <td>Adresse</td>
                                <td class="text-capitalize font-weight-bold">
                                    <?= (trim($student['parent_primary_address'])); ?>
                                </td>
                            </tr>



                            <tr>
                                <td class="align-middle"> 11 </td>
                                <td class="align-middle"> Nom du Père </td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['parent_father_name']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle"> 12</td>
                                <td class="align-middle"> Nom de la Mère</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['parent_mother_name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"> 13</td>
                                <td class="align-middle">Téléphone principal</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= $student['parent_primary_phone']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>14</td>
                                <td>Code Niveau</td>
                                <td class="text-lowercase font-weight-bold">
                                </td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>Code Option</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['option_name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>Année Scolaire</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= session()->yearstarted; ?>-<?= session()->yearclosing; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>17 </td>
                                <td>Classe</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= setDegresLevels($student['degree_code'], 'f'); ?>
                                    <?= trim($student['classe_subname']); ?>
                                    <?= trim($student['section_name']); ?>
                                    <?= trim($student['option_name']); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>Province d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_province']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>Territoire d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_territory']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Secteur d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_sector']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Groupement d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_grouping']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Village d'origine</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_village']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>Numéro permenant</td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= trim($student['student_permanent_code']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>Etat étudiant</td>
                                <td class="text-uppercase font-weight-bold">
                                    <?= trim($student['student_status']); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-2">
                    <p class="font-weight-bold text-uppercase">
                        NB : Complétez obligatoirement tous les champs sauf le N° 14, 15 & 21 (qui seront compléter à
                        l'école).
                    </p>
                    <p class="font-weight-bold text-uppercase">
                        Chef d'Antenne
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>