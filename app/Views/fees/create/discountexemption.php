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
                            <li class="breadcrumb-item active">Exhonération frais</li>
                        </ol>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2 text-center">
                        <div class="col-sm-12 col-lg-12">
                            <h1 class="font-weight-bold text-uppercase">
                                configuration exhonération par frais</h1>
                            <h2 class="text-uppercase text-primary font-weight-bold">
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
                            <h3 class="text-dark"><i class="fas fa-list"></i>
                                Affectation de la bourse [<span class="text-primary text-uppercase">
                                    <?= $exemption['exemption_name'];?></span> ]
                                aux frais
                                <a href="<?php  echo base_url('fees/exemptions'); ?>" class="btn btn-info">
                                    <i class="fa fa-reply-all fa-lg"></i>
                                </a>
                            </h3>
                        </div>

                        <div class="card-body p-0">
                            <?php if(isset($feesdetails) && !empty($feesdetails)){ 
                              $num=1;
                              $resultats1=0;
                              $compte = 0;
                              $validation = \Config\Services::validation();
                              $attributes = array('role' => 'form', 'autocomplete' => 'off');
                              echo form_open(base_url('config-fees-exemption/' . $exemption['exemption_id']), $attributes);
                              ?>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>LIBELLE FRAIS </th>
                                        <th>MONTANT PAYABLE</th>
                                        <th>AFFECTATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2"><b>SELECTIONNER TOUS LES FRAIS</b></td>
                                        <td> <span class="text-primary font-weight-bold">
                                                Appliquer a tout ?
                                            </span> <input type="checkbox" name="select_alls" id="select_alls" />
                                        </td>
                                    </tr>
                                    <?php foreach ($feesdetails as $key) {?>
                                    <tr>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= $key['fee_name'];?>
                                            <span
                                                class="text-danger font-weight-bold">[<?= $key['feedetail_name'];?>]</span>
                                        </td>
                                        <td class="text-uppercase">
                                            <?= number_format($key['feedetail_cost_payable'], 2, ',', ' ');?>
                                            <?= $key['fee_currency_payable'];?>
                                        </td>
                                        <td>
                                            réduction de
                                            <span class="text-primary font-weight-bold text-uppercase small">
                                                <?= (number_format($exemption['exemption_cost_discount'], 2,',', ' ')); ?>
                                                <?= (($exemption['exemption_currency'])); ?>
                                            </span> accordée ?
                                            <input class="chechbox" type="checkbox" value="<?= $key['feedetail_id']; ?>"
                                                name="etatClasse<?= $key['feedetail_id']; ?>" <?php if (isset($discountsexemptions) && !empty($discountsexemptions)){ 
                                                          foreach ($discountsexemptions as $reponse) {
                                                              if ($reponse['feediscount_feedetail_id'] == $key['feedetail_id']) {
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
                                    <h3>Aucun frais enregistré</h3>
                                </div>
                            </div>
                            <?php }?>
                            <div class="form-group float-right">
                                <button type="submit" name="btn_save" class="btn btn-info">
                                    <i class="fa fa-check-circle"></i> Valider la configuration des frais de la
                                    bourse</button>
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