<div class="content-wrapper">
    <section class="content-header mt-1">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2 text-center">
                    <div class="col-sm-12 col-lg-12">
                        <h1 class="font-weight-bold text-uppercase">
                            Details configuration frais par classe
                        </h1>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <?php if (isset($fee) && !empty($fee)):?>
      <section class="content">
          <div class="container-fluid">
              
              <blockquote>
                  <div class="container row">
                      <div class="col-sm-12 card">
                            <div class="card-header">
                                <h3><i class="fas fa-cogs"></i>
                                AFFECTATION [<span class="text-danger text-uppercase">
                                    <?= $fee['feedetail_name'];?></span> ] 
                                    DANS DES CLASSES
                                    <a href="<?= base_url('fees/feesclasses'); ?>" class="btn btn-info">
                                        <i class="fa fa-reply-all fa-lg"></i>
                                    </a>
                                </h3>
                            </div>
                        
                          <div class="card-body p-0">
                            <?php if(isset($classes) && !empty($classes)){ 
                              $num=1;
                              $resultats1=0;
                              $compte = 0;
                              $validation = \Config\Services::validation();
                              $attributes = array('role' => 'form', 'autocomplete' => 'off');
                              echo form_open(base_url('config-fees-classe/' . $fee['feedetail_id']), $attributes);
                              
                              ?>
                                <table class="table table-sm">
                                      <thead>
                                          <tr>
                                              <th>CLASSES </th>
                                              <th>OPTION</th>
                                              <th>AFFECTATION</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td colspan="2"><b>SELECTIONNER TOUTES LES CLASSES</b></td>
                                              <td>  <span class="text-danger font-weight-bold">
                                              Payable par tous ?
                                               </span> <input type="checkbox" name="select_alls" id="select_alls"> </td>
                                          </tr>
                                          <?php foreach ($classes as $key) {?>
                                          <tr>
                                              <td class="text-uppercase">
                                                  <?= setDegresLevels($key['degree_code']);?>
                                                  <?= $key['classe_subname'];?>
                                                  <?= $key['section_name'];?>
                                              </td>
                                              <td class="text-uppercase">
                                                  <?= $key['option_name'];?></td>
                                              <td>
                                              <span class="text-danger font-weight-bold text-capitalize">
                                                <?= $fee['feedetail_name'];?>
                                               </span>  payable?
                                                  <input class="chechbox" type="checkbox" value="<?= $key['classe_id']; ?>"
                                                      name="etatClasse<?= $key['classe_id']; ?>" 
                                                      <?php  
                                                        if (isset($feesclasses)&& !empty($feesclasses)){ 
                                                          foreach ($feesclasses as $reponse) {
                                                              if ($reponse['feeclasse_classe_id'] == $key['classe_id']) {
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
                            <?php } else { ?>
                                  <div class="text-center">
                                      <div class="alert alert-info">
                                          <h3>Aucune Classe enregistrée</h3>
                                      </div>
                                  </div> 
                            <?php }?>
                                  <div class="form-group float-right">
                                      <button type="submit" name="btn_save" class="btn btn-info">
                                          <i class="fa fa-check-circle"></i> Valider la configuration </button>
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