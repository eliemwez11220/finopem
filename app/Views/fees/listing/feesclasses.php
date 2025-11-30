<div class="content-wrapper">
    <section class="content-header mt-1 <?= checkModuleAccess('classesfees'); ?>">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Accueil</a></li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('fees/feestypes') ?>">Types Frais</a>
                            </li>
                            <li class="breadcrumb-item active">Frais classes</li>
                        </ol>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2 text-center">
                        <div class="col-sm-12 col-lg-12">
                            <h1 class="font-weight-bold text-uppercase">
                                configuration frais par classe</h1>
                            <p class="font-weight-bold h5">
                                Veuillez sélectionner un type de frais a configurer par classe dans
                                la liste ci-dessous
                            </p>

                            <form role="form" id="form_ajax_fees_classes" method="get">
                                <div class="input-group input-group" style="width: 100%!important;">
                                    <label for=""></label>
                                    <select id="ajax_fees_paid" name="ajax_fees_classes" title="Classe"
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info">
                                        <option disabled selected>-- sélectionnez le frais -- </option>

                                        <?php $count = 1;
                                if (isset($fees) && !empty($fees)):
                                  foreach ($fees as $key => $value): ?>
                                        <option value="<?= esc($value['fee_id']); ?>"
                                            <?= (session()->feechoosed && (session()->feechoosed == $value['fee_id']))?'selected':set_select('ajax_fees_classes', esc($value['fee_id'])); ?>>
                                            <?= (strtoupper($value['fee_name'])); ?> | Payable
                                            <?= (strtoupper($value['fee_total_payable'])); ?> fois en
                                            <?= (strtoupper($value['fee_currency_payable'])); ?>
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
    <?php if (isset(session()->feepaidchoosed) && !empty(session()->feepaidchoosed)):?>
    <section class="content">
        <div class="container-fluid">

            <blockquote>
                <div class="container row">
                    <div class="col-sm-12 card">
                        <div class="card-header">
                            <h3><i class="fas fa-list"></i>
                                AFFECTATION [<span class="text-danger text-uppercase">
                                    <?= session()->feepaidchoosed['fee_name'];?></span>]
                                DANS DES CLASSES
                                <a href="<?php  echo base_url('fees/details/feetype/'.session()->feepaidchoosed['fee_id']); ?>"
                                    class="btn btn-info">
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
                              echo form_open(base_url('config-fees-classe/' . session()->feepaidchoosed['fee_id']), $attributes);
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
                                        <td> <span class="text-danger font-weight-bold">
                                                Payable par tous ?
                                            </span> <input type="checkbox" name="select_alls" id="select_alls" />
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
                                                <?= session()->feepaidchoosed['fee_name'];?>
                                            </span> payable?
                                            <input class="chechbox" type="checkbox" value="<?= $key['classe_id']; ?>"
                                                name="etatClasse<?= $key['classe_id']; ?>" <?php if (isset($feesclasses) && !empty($feesclasses)){ 
                                                          foreach ($feesclasses as $reponse) {
                                                              if ($reponse['feeclasse_classe_id'] == $key['classe_id']) {
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