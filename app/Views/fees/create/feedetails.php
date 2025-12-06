<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Détails types frais</li>
                        <li class="col-sm-6">
                            <a href="<?= base_url('fees/feestypes'); ?>"
                                class="btn btn-info btn-rounded text-uppercase btn-sm">
                                <i class="fas fa-reply fa-lg"></i> Revenir a la liste
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <?php if (isset($fee) && (! empty($fee))): ?>
        <blockquote class="container-fluid">
            <div class="col-sm-12 card-radius">
                <div card="card shadow-lg">
                    <div class="card-header bg-info text-center">
                        <h1 class="text-uppercase font-weight-bold">
                            <span class="font-weight-bold"><i class="fas fa-cogs"></i>
                                Configuration </span>
                            <span class="text-danger"><?= trim($fee['fee_name']); ?></span>
                            <br />
                            <span class="text-uppercase h3">
                                En paiement
                                <span class="text-danger"><?= setFeesTypes($fee['fee_type']); ?>,</span>
                                en
                                <span class="text-danger"><?= trim($fee['fee_currency_payable']); ?> </span>
                                reparti en
                                <span class="text-danger"><?= trim($fee['fee_total_payable']); ?> fois</span>
                            </span>
                        </h1>
                    </div>

                    <?php
                if(isset($feesdetails) && (empty($feesdetails))):
                $validation = \Config\Services::validation();
                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                echo form_open(base_url('create-feedetails/'.$fee['fee_id']), $attributes);
                ?>
                    <fieldset class="card-body card-radius">
                        <legend class="text-center text-dark mt-2 border-bottom">
                            <h5>Veuillez saisir les informations requises ci-dessous pour valider la Configuration de ce
                                type frais</h5>
                        </legend>
                        <?php 
                    $nb = $fee['fee_total_payable'];
                    $typePaie = $fee['fee_type'];
                    $save_libelle = "";
                    if ($typePaie=="installment") {
                        $save_libelle = 'Tranche';
                    }elseif($typePaie=="annual"){
                        $save_libelle = 'Annuel';
                    }elseif($typePaie=="semi-annual"){
                        $save_libelle ="Semestre";
                    }elseif($typePaie=="quartly"){
                        $save_libelle ="Trimestre";
                    }elseif($typePaie=="monthly"){
                        $save_libelle ="Mois";
                    } else{
                        $save_libelle ="Jour";
                    }
                    if ($nb==1) { ?>
                        <div class="row">

                            <div class="col-sm-2 mb-2">
                                <div class="form-floating">
                                    <input type="text" id="<?= 'label_fees'.'1'; ?>"
                                        name="<?= 'txt_libelle_frais'.'1'; ?>" value="<?= $save_libelle; ?>"
                                        class="form-control" readonly>
                                    <label for="<?= 'label_fees'.'1'; ?>"> <span class="text-danger">*</span>Type
                                        paiement</label>
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-floating">
                                    <input type="text" id="<?= 'label_libelle'.'1'; ?>"
                                        name="<?= 'txt_save_libelle'.'1'; ?>" class="form-control"
                                        placeholder="(Ex: Inscription ou Fip)" required="true" autofocus="true">
                                    <label for="<?= 'label_libelle'.'1'; ?>"> <span class="text-danger">*</span>Libellé
                                        affichable sur le réçu</label>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="form-floating">
                                    <input type="text" id="<?= 'label_shortname'.'1'; ?>"
                                        name="<?= 'txt_shortname'.'1'; ?>" class="form-control"
                                        placeholder="Ex: FS AVRIL">
                                    <label for="<?= 'label_shortname'.'1'; ?>"><span
                                            class="text-danger"></span>Abbréviation</label>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="form-floating">
                                    <input type="number" id="<?= 'label_nbtranche'.'1'; ?>"
                                        name="<?= 'txt_nb_tranches'.'1'; ?>" min="1" max="1000000000"
                                        class="form-control text-uppercase" placeholder="Ex: 125.50" required="true"
                                        autocomplete="off" step=".01">
                                    <label for="<?= 'label_nbtranche'.'1'; ?>"> <span
                                            class="text-danger">*</span>Montant payable en <span
                                            class="text-uppercase"><?= $fee['fee_currency_payable'];?></span></label>
                                </div>
                            </div>
                        </div>
                        <?php }else{
                        for ($i=1; $i <= $nb; $i++) {  ?>
                        <div class="row">

                            <div class="col-sm-2 mb-2">
                                <div class="form-floating">
                                    <input type="text" id="<?= 'label_fees'.$i; ?>"
                                        name="<?= 'txt_libelle_frais'.$i; ?>" class="form-control"
                                        value="<?= ($typePaie=='installment' && ($i==1)) ? $i.'ère Tranche': setDegresLevels($i).' '.$save_libelle; ?>"
                                        readonly>
                                    <label for="<?= 'label_fees'.$i; ?>"> <span class="text-danger">*</span>Type
                                        paiement</label>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-floating">
                                    <input type="text" id="<?= 'label_libelle'.$i; ?>"
                                        name="<?= 'txt_save_libelle'.$i; ?>" class="form-control"
                                        placeholder="(Ex: <?= setMonthsYear($i); ?> ou <?= ($i==1) ? $i.'ère':$i.'ème'; ?> tranche)"
                                        required="true" autofocus="true">
                                    <label for="<?= 'label_libelle'.$i; ?>"> <span class="text-danger">*</span> Libellé
                                        affichable sur le réçu</label>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="form-floating">
                                    <input type="text" id="<?= 'label_shortname'.$i; ?>"
                                        name="<?= 'txt_shortname'.$i; ?>" class="form-control"
                                        placeholder="Ex:FS AVRIL">
                                    <label for="<?= 'label_shortname'.$i; ?>"><span
                                            class="text-danger"></span>Abbréviation</label>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="form-floating">
                                    <input type="number" id="<?= 'label_nbtranche'.$i; ?>"
                                        name="<?= 'txt_nb_tranches'.$i; ?>" min="1" max="1000000000"
                                        class="form-control text-uppercase" placeholder="Ex: 125.50" required="true"
                                        autocomplete="off" step=".01">
                                    <label for="<?= 'label_nbtranche'.$i; ?>"> <span class="text-danger">*</span>Montant
                                        payable en <span
                                            class="text-uppercase"><?= $fee['fee_currency_payable'];?></span></label>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                        <?php ?>


                        <div class="form-group text-right">
                            <button type="submit" name="btn_save" class="btn btn-info">
                                <i class="fa fa-check-circke"></i> Valider la Configuration</button>
                        </div>
                    </fieldset>
                    <?= form_close(); ?>
                    <?php else: ?>
                    <div class="card-footer alert alert-light text-danger text-center">
                        <p class="h3">
                            <i class="fa fa-info-circle fa-lg"></i>
                            Désolé, il semble que vous avez déjà configurer les différents frais payables
                            pour <span
                                class="text-info text-uppercase font-weight-bold"><?= (($fee['fee_name'])); ?></span>.
                            Vous ne pouvez plus configurer à nouveau.

                        </p>
                        <a href="<?= base_url('fees/details/feetype/' . esc($fee['fee_id'])); ?>"
                            class="btn btn-sm btn-info">
                            <span class="btn text-white " data-toggle="tooltip" data-placement="top"
                                title="Cliquer pour voir les details frais">
                                Consulter la configuration des frais
                            </span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </blockquote>
        <?php endif; ?>
    </section>
</div>