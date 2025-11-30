<div class="content-wrapper <?= checkModuleAccess('scholarships'); ?>">
    <section class="content-header mt-1">
    <div class="card">
        <div class="card-body">
          <div class="row mb-2 text-center">
              <div class="col-sm-12 col-lg-12">
                <h1 class="font-weight-bold text-uppercase">
                  configuration bourses des élèves</h1>
                  <p class="font-weight-bold h5">
                    Veuillez sélectionner un  élève bénéficiaire d'une bourse dans la liste ci-dessous
              
                  </p>
                    <form role="form" id="form_ajax_students" method="get">
                        <div class="input-group input-group" style="width: 100%!important;">
                          <label for="ajax_student"></label>
                            <select id="ajax_student" name="ajax_student" title="Eleve"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                <option disabled selected>--sélectionnez un élève-- </option>
                                
                                <?php $count = 1;
                                if (isset($studentsinscriptions) && !empty($studentsinscriptions)):
                                  foreach ($studentsinscriptions as $keystudent => $studentval): ?>
                                  <option value="<?= esc($studentval['inscription_id']); ?>"
                                  <?= (session()->studentchoosed && (session()->studentchoosed == $studentval['inscription_id']))?'selected':set_select('ajax_student', esc($studentval['inscription_id'])); ?>>
                                            <?= strtoupper($studentval['student_firstname']); ?>
                                            <?= strtoupper($studentval['student_lastname']); ?>
                                            <?= strtoupper($studentval['student_surname']); ?>
                                            (<?= strtoupper($studentval['student_code']); ?>) |
                                            <?= setDegresLevels(($studentval['degree_code'])); ?>
                                            <?= strtoupper(($studentval['classe_subname'])); ?>
                                            <?= strtoupper(($studentval['option_name'])); ?>
                                        </option>
                                  <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>

    <?php if (isset(session()->studentchoosed) && !empty(session()->studentchoosed)):?>
      <section class="content">
          <div class="container-fluid">
              
              <blockquote>
                  <div class="container row">
                      <div class="col-sm-12 card">
                      <?php if(isset($student) && !empty($student)):?>
                        <div class="card-header">
                              <h3><i class="fas fa-list"></i>
                                BOURSES ACCORDEES A L'ELEVE 
                                [<span class="text-danger text-uppercase">
                                    <?= strtoupper($student['student_firstname']); ?>
                                    <?= strtoupper($student['student_lastname']); ?>
                                    <?= strtoupper($student['student_surname']); ?>
                                -      
                                </span>
                                
                                ID:
                                <span class="text-danger text-uppercase font-weight-bold">
                                <?= strtoupper($student['student_code']); ?>
                                </span>
                                | CLASSE:
                                <span class="text-danger text-uppercase font-weight-bold">
                                <?= setDegresLevels(($student['degree_code'])); ?>
                                            <?= strtoupper(($student['classe_subname'])); ?>
                                            <?= strtoupper(($student['option_name'])); ?>
                                </span>] 
                                  <a href="<?php  echo base_url('fees/scholarships'); ?>" class="btn btn-info">
                                      <i class="fa fa-reply-all fa-lg"></i>
                                  </a>
                              </h3>
                          </div>
                          <?php endif; ?>
                          <div class="card-body p-0">
                            <?php if(isset($exemptions) && !empty($exemptions)){ 
                              $num=1;
                              $resultats1=0;
                              $compte = 0;
                              $validation = \Config\Services::validation();
                              $attributes = array('role' => 'form', 'autocomplete' => 'off');
                              echo form_open(base_url('config-scholarship-student/' . session()->studentchoosed), $attributes);
                              ?>
                                <table class="table table-sm">
                                      <thead>
                                          <tr>
                                              <th>EXHONERATION </th>
                                              <th>MONTANT</th>
                                              <th>AFFECTATION</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td colspan="2"><b>SELECTIONNER TOUTES LES EXHONERATIONS</b></td>
                                              <td> 
                                                <input class="ml-5" type="checkbox" name="select_alls" id="select_alls" />
                                             </td>
                                          </tr>
                                          <?php foreach ($exemptions as $exemption) {?>
                                          <tr>
                                              <td class="text-uppercase">
                                                  <?= $exemption['exemption_name'];?>
                                              </td>
                                              <td class="text-uppercase">
                                                  <?= number_format($exemption['exemption_cost_discount'], 2, ',', ' ');?>
                                                  <?= $exemption['exemption_currency'];?>
                                                </td>
                                              <td class="">
                                                  <input class="ml-5 chechbox" type="checkbox" value="<?= $exemption['exemption_id']; ?>"
                                                      name="exemption_status<?= $exemption['exemption_id']; ?>" 
                                                      <?php  
                                                        if (isset($studentexemptions) && !empty($studentexemptions)){ 
                                                          //$checked = FALSE;
                                                          foreach ($studentexemptions as $reponse) {
                                                              if ($reponse['feestudent_exemption_id'] == $exemption['exemption_id']) {
                                                                  echo "checked";
                                                              }
                                                          }
                                                        }
                                                      ?>>
                                                    
                                              </td>
                                          </tr>
                                          <?php $compte++; }?>
                                      </tbody>
                                </table> 
                            <?php }?>
                                  <div class="form-group float-right">
                                      <button type="submit" name="btn_save" class="btn btn-info">
                                          <i class="fa fa-check-circle"></i> Valider la configuration de la bourse </button>
                                  </div>
                             <?= form_close(); ?>
                          </div>
                      </div>
                  </div>
              </blockquote>
      </div>
      </section>
  <?php endif; ?>
</div>