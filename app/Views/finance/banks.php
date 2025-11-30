<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('banking'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="font-weight-bold">Configuration des comptes bancaires</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('overview') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Gestion financiere</li>
                        <li class="breadcrumb-item active">Comptes bancaires</li>
                    </ol>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-<?= (isset($bank) && !empty($bank)) ?'primary':'info'; ?>">
                    <div class="text-center  py-3">
                        <h4 class="h3 font-weight-bold">
                            <?= (isset($bank) && !empty($bank)) ?'Modification du compte bancaire - '.$bank['bank_account_number']:'Gestion des comptes bancaires'; ?>
                        </h4>
                    </div>
                </div>
                <div class="card-body shadow-lg">
                    <?php
                            $validation = \Config\Services::validation();
                            //new code generated automatically
                            //form attributes
                            $route_name = (isset($bank) && !empty($bank)) ? 'update-bank-account/'.$bank['bank_id']:'create-bank-account';
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url($route_name), $attributes);
                            ?>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" min="1" max="100"
                                    class="form-control <?php if($validation->hasError( 'account_number')){echo 'is-invalid';} ?>"
                                    name="account_number" id="account_number" placeholder="Ex: 1225251045-58"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_account_number']:set_value('account_number'); ?>"
                                    autofocus />
                                <label for="account_number" class="control-label">
                                    <span class="text-danger">*</span>Numéro de compte bancaire
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'account_number'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" min="1" max="100"
                                    class="form-control <?php if($validation->hasError( 'account_name')){echo 'is-invalid';} ?>"
                                    name="account_name" id="account_name" placeholder="Ex: DITOTASE SARL"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_account_name']:set_value('account_name'); ?>" />
                                <label for="account_name" class="control-label">
                                    <span class="text-danger">*</span>Nom de compte bancaire
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'account_name'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text" min="1" max="100"
                                    class="form-control <?php if($validation->hasError( 'account_code')){echo 'is-invalid';} ?>"
                                    name="account_code" id="account_code" placeholder="Ex: DITOTASE SARL"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_account_code']:set_value('account_code'); ?>" />
                                <label for="account_code" class="control-label">
                                    <span class="text-danger"></span>Code Swift de compte bancaire
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'account_code'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <select
                                    class="form-select form-control <?= ($validation->hasError('currency')) ? ' is-invalid' : '' ?>"
                                    title="currency" name="currency" id="devise">
                                    <option disabled>- selectionnez un état -</option>
                                    <?php
                                    $db_account_currency = (isset($bank) && !empty($bank)) ? $bank['bank_account_currency']: '';
                                    $currency = setCurrency();
                                    foreach ($currency as $currencykey => $valuecurrency): ?>
                                    <option value="<?= ($currencykey); ?>"
                                        <?= ($db_account_currency == $currencykey) ? 'selected': set_select('currency_name', esc($currencykey)); ?>>
                                        <?= strtoupper(($valuecurrency)); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="currency" class="label-control">
                                    <span class="text-danger">*</span>Devise du compte bancaire</label>

                                <span class="text-danger"><?= displayFormError($validation, 'currency'); ?></span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">

                                <select id="account_type" name="account_type"
                                    class="form-control  <?php if($validation->hasError( 'account_type')){echo 'is-invalid';} ?>">
                                    <option disabled>-- Sélectionnez un type--</option>
                                    <?php $db_account_type = (isset($bank) && !empty($bank)) ? $bank['bank_account_type']: '';?>
                                    <option value="courant"
                                        <?= ($db_account_type == 'courant') ? 'selected': set_select('account_type', 'courant'); ?>>
                                        Compte courant
                                    </option>
                                    <option value="epargne"
                                        <?= ($db_account_type == 'epargne') ? 'selected': set_select('account_type', 'epargne'); ?>>
                                        Compte épargne
                                    </option>

                                </select>
                                <label for="account_type" class="control-label">
                                    <span class="text-danger">*</span>Type de compte bancaire
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'account_type'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control bg-light  <?php if($validation->hasError( 'bank_phone')){echo 'is-invalid';} ?>"
                                    name="bank_phone" id="bank_phone" placeholder="Ex: +243858533285"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_phone']:set_value('bank_phone'); ?>" />
                                <label for="bank_phone" class="control-label">
                                    <span class="text-danger"></span>Numéro de contact du compte bancaire
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'bank_phone'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control bg-light  <?php if($validation->hasError( 'bank_mail')){echo 'is-invalid';} ?>"
                                    name="bank_mail" id="bank_mail" placeholder="Ex: ditotase@gmail.com"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_email']:set_value('bank_mail'); ?>" />
                                <label for="bank_mail" class="control-label">
                                    <span class="text-danger"></span>Adresse mail du compte bancaire
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'bank_mail'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control bg-light  <?php if($validation->hasError( 'bank_name')){echo 'is-invalid';} ?>"
                                    name="bank_name" id="bank_name" placeholder="Ex: RAWBANK"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_name']:set_value('bank_name'); ?>" />
                                <label for="bank_name" class="control-label">
                                    <span class="text-danger">*</span>Nom de la banque
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'bank_name'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12 mb-2">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control bg-light  <?php if($validation->hasError( 'bank_address')){echo 'is-invalid';} ?>"
                                    name="bank_address" id="bank_address"
                                    placeholder="Ex: 10, Av. Lumumba, Lubumbashi, RDC"
                                    value="<?= (isset($bank) && !empty($bank)) ? $bank['bank_address']:set_value('bank_address'); ?>" />
                                <label for="bank_address" class="control-label">
                                    <span class="text-danger">*</span>Adresse de localisation de la banque
                                </label>
                                <?php if(isset($validation)): ?>
                                <span class="invalid-feedback">
                                    <?= display_validation_error($validation, 'bank_address'); ?>
                                </span>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                            <div class="form-floating">

                                <textarea rows="5" cols="30" class="form-control bg-light" name="notes"
                                    placeholder="Plus de détails sur le compte. Ex: Ouverture et Fermeture"
                                    id="notes"><?= (isset($bank) && !empty($bank)) ? $bank['bank_notes']: set_value('notes'); ?></textarea>
                                <label for="notes" class="control-label">
                                    <span class="text-danger"></span>Notes interne sur le compte
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-xs-12 mt-3 text-center">
                            <button type="submit"
                                class="btn btn-<?= (isset($bank) && !empty($bank)) ?'primary':'info'; ?> text-uppercase">
                                <?= (isset($bank) && !empty($bank)) ? 'Valider les modifications': 'Enregistrer le compte bancaire'; ?>
                            </button>
                            <a href="<?= base_url('finances/banks'); ?>"
                                class="btn btn-<?= (isset($bank) && !empty($bank)) ?'danger':''; ?> text-uppercase">
                                <?= (isset($bank) && !empty($bank)) ? 'Annuler la modification': ''; ?>
                            </a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table id="datatablesExample2"
                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-uppercase small">
                                    <th width="1px">Actions</th>

                                    <th>Compte</th>
                                    <th>Entrées</th>
                                    <th>Sorties</th>
                                    <th>Solde</th>
                                    <th>Propriétaire</th>
                                    <th>Banque</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $count = 1;
                                        if (isset($banks) && !empty($banks)):
                                            foreach ($banks as $bankkey => $bank_value):
                                                $status = (!empty(esc($bank_value['bank_status'])) ? esc($bank_value['bank_status']) : 'inactif');
                                                ?>
                                <tr class="small">
                                    <td width="1px" class="text-center">
                                        <a href="<?= base_url('finances/edit/bank/'.$bank_value['bank_token']); ?>"
                                            class="btn btn-xs btn-outline-warning">
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="Cliquer pour modifier cette information">
                                                <i class="fa fa-edit fa-2x"></i></span>
                                        </a>
                                        <a data-toggle="modal" data-target="#update_<?= $bank_value['bank_id']; ?>"
                                            href="#" class="btn btn-xs  btn-info">
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="Cliquer pour voir les details de cette information">
                                                <i class="fa fa-info-circle fa-2x"></i></span>

                                        </a>
                                    </td>

                                    <td class="text-uppercase">
                                        <?= $bank_value['bank_account_number']; ?>
                                        (<?= ($bank_value['bank_account_currency']); ?>)
                                    </td>



                                    <td class="text-uppercase"><?= number_format($bank_value['bank_credit_amount'], 2, ',', ' '); ?></td>
                                    <td class="text-uppercase"><?= number_format($bank_value['bank_debit_amount'], 2, ',', ' '); ?></td>
                                    <td class="text-uppercase">
                                        <?= number_format($bank_value['bank_credit_amount'] - $bank_value['bank_debit_amount'], 2, ',', ' '); ?>
                                    </td>
                                    <td class="text-capitalize"><?= ($bank_value['bank_account_name']); ?></td>
                                    <td class="text-uppercase font-weight-bold"><?= ($bank_value['bank_name']); ?></td>
                                    <td>
                                        <a href="<?= base_url('finances/changeStatus/bank/' . ($status) . '/' . ($bank_value['bank_id'])); ?>"
                                            onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                            <span
                                                class="badge  <?= (($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                <?= $status; ?> </span>
                                        </a>
                                    </td>
                                </tr>
                                <!-- update year modal -->
                                <div class="modal fade" id="update_<?= $bank_value['bank_id']; ?>">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">

                                                <h4 class="modal-title d-inline-flex text-uppercase font-weight-bold">
                                                    Détails compte <?= $bank_value['bank_account_number']; ?> de
                                                    <?= ($bank_value['bank_name']); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">
                                                        <i class="fa fa-window-close"></i>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12 small">
                                                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                                            <div class="app-card-body p-3 px-4 w-100">

                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-donate"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Numéro de compte</span>
                                                                        </h5>
                                                                        <h3
                                                                            class="app-card-title text-uppercase fw-bold">
                                                                            <?= $bank_value['bank_account_number']; ?>
                                                                        </h3>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 small">
                                                        <address>

                                                            <span class="text-uppercase">
                                                                <b>Entrées:
                                                                    <?= number_format($bank_value['bank_credit_amount'], 2, ',', ' ') . ' '. $bank_value['bank_account_currency']; ?></b><br>
                                                                <hr><b>Sorties:
                                                                    <?= number_format($bank_value['bank_debit_amount'], 2, ',', ' '). ' '. $bank_value['bank_account_currency']; ?></b><br>
                                                                <hr><b>Solde:
                                                                    <?= number_format($bank_value['bank_credit_amount'] - $bank_value['bank_debit_amount'], 2, ',', ' '). ' '. $bank_value['bank_account_currency']; ?></b><br>

                                                            </span>
                                                        </address>
                                                    </div>
                                                    <div class="col-12 col-lg-6 small">
                                                        <div
                                                            class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                                            <div class="app-card-body p-3 px-4 w-100">

                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-user"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Nom du compte</span>
                                                                        </h5>
                                                                        <h3
                                                                            class="app-card-title text-uppercase fw-bold">
                                                                            <?= $bank_value['bank_account_name']; ?>
                                                                        </h3>

                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->
                                                                <hr>
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-phone"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Numéro de contact</span>
                                                                        </h5>
                                                                        <h3
                                                                            class="app-card-title text-uppercase fw-bold">
                                                                            <?= $bank_value['bank_phone']; ?></h3>

                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->

                                                                <hr>
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Adresse mail</span>
                                                                        </h5>
                                                                        <h3
                                                                            class="app-card-title text-lowercase fw-bold">
                                                                            <?= $bank_value['bank_email']; ?></h3>

                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->
                                                                <hr>
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-map-marker"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Adresse de la banque</span>
                                                                        </h5>
                                                                        <p
                                                                            class="small app-card-title text-uppercase h5 fw-bold">
                                                                            <?= $bank_value['bank_address']; ?></p>

                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->

                                                            </div>
                                                            <!--//app-card-body-->
                                                        </div>
                                                        <!--//app-card-->
                                                    </div>
                                                    <!--//col-->
                                                    <div class="col-12 col-lg-6">
                                                        <div
                                                            class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                                            <div class="app-card-body p-3 px-4 w-100">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-user-secret"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Code Swift du compte</span>
                                                                        </h5>
                                                                        <h3
                                                                            class="app-card-title text-uppercase fw-bold">
                                                                            <?= $bank_value['bank_account_code']; ?>
                                                                        </h3>

                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->
                                                                <hr>
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-bookmark"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Nom de la banque</span>
                                                                        </h5>
                                                                        <h3
                                                                            class="app-card-title text-uppercase fw-bold">
                                                                            <?= $bank_value['bank_name']; ?></h3>
                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->
                                                                <hr>

                                                               
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="">
                                                                            <i class="fas fa-info-circle"></i>
                                                                        </div>
                                                                        <!--//icon-holder-->
                                                                    </div>
                                                                    <!--//col-->
                                                                    <div class="col-auto">
                                                                        <h5 class="text-muted small">
                                                                            <span>Observation</span>
                                                                        </h5>
                                                                        <p
                                                                            class="small app-card-title text-uppercase fw-bold">
                                                                            <?= $bank_value['bank_notes']; ?></p>

                                                                    </div>
                                                                    <!--//col-->
                                                                </div>
                                                                <!--//row-->
                                                            </div>
                                                            <!--//app-card-->
                                                        </div>
                                                        <!--//col-lg-6-->
                                                    </div>
                                                    <!--//row-->
                                                </div>
                                                <!--//row-->
                                            </div>
                                            <div class="modal-footer text-right">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end update year modal -->
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>