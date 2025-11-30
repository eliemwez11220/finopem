<div class="content-wrapper">
<?php if (isset($exemption) && !empty($exemption)):?>    
<section class="content-header mt-1">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Accueil</a></li>
              <li class="breadcrumb-item">
              <a href="<?= base_url('fees/exemptions') ?>">Exhonérations</a>
              </li>
              <li class="breadcrumb-item active">Exhonération classes</li>
            </ol>
          </div>
      </div>
        <div class="card-body">
          <div class="row mb-2 text-center">
              <div class="col-sm-12 col-lg-12">
                <h1 class="font-weight-bold text-uppercase">
                  configuration exhonération par classe</h1>
                <h2 class="text-uppercase text-danger font-weight-bold">
                Bourse <?= (($exemption['exemption_name'])); ?> | réduction de 
                    <?= (number_format($exemption['exemption_cost_discount'], 2,',', ' ')); ?>  
                    <?= (($exemption['exemption_currency'])); ?> 
                </h2>
                </div>
            </div>
        </div>
      </div>
    </section>

      <section class="content">
          <div class="container-fluid">
              <blockquote>
                  <div class="container row">
                      <div class="col-sm-12 card">
                          <div class="card-header text-uppercase font-weight-bold">
                              <h3><i class="fas fa-list"></i>
                                Attribution de la bourse [<span class="text-danger text-uppercase">
                                  <?= $exemption['exemption_name'];?></span> ] 
                                  DANS DES CLASSES
                                  <a href="<?php  echo base_url('fees/exemptions'); ?>" class="btn btn-info">
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
                              echo form_open(base_url('config-exemption-classe/' . $exemption['exemption_id']), $attributes);
                              ?>
                                <table class="table table-sm">
                                      <thead>
                                          <tr>
                                              <th>CLASSES </th>
                                              <th>OPTION</th>
                                              <th>BOURSE</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td colspan="2"><b>SELECTIONNER TOUTES LES CLASSES</b></td>
                                              <td>  <span class="text-danger font-weight-bold">
                                              Appliquer a toutes ?
                                               </span> <input type="checkbox" name="select_alls" id="select_alls"
                                               />
                                               </td>
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
                                              <span class="text-danger font-weight-bold text-uppercase small">
                                                <?= $exemption['exemption_name'];?>
                                               </span>  accordée ?
                                                  <input class="chechbox" type="checkbox" value="<?= $key['classe_id']; ?>"
                                                      name="etatClasse<?= $key['classe_id']; ?>" 
                                                      <?php if (isset($classesexemptions) && !empty($classesexemptions)){ 
                                                          foreach ($classesexemptions as $reponse) {
                                                              if ($reponse['exemptionclasse_classe_id'] == $key['classe_id']) {
                                                                  echo " checked";
                                                        }}}?>>
                                                    
                                              </td>
                                          </tr>
                                          <?php $compte++; }?>
                                      </tbody>
                                </table>
                            <?php } else { ?>
                                  <div class="text-center">
                                      <div class="alert alert-info">
                                          <h3>Aucune classe enregistrée</h3>
                                      </div>
                                  </div> 
                            <?php }?>
                                  <div class="form-group float-right">
                                      <button type="submit" name="btn_save" class="btn btn-info">
                                          <i class="fa fa-check-circle"></i> Valider la configuration de la bourse</button>
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