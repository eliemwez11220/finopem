<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('exchanges'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Configuration</li>
                                <li class="breadcrumb-item active" aria-current="page">Taux de change</li>
                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-tools float-right">

                                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#offcanvasFeedback"
                                    aria-controls="offcanvasFeedback">
                                    <i class="fas fa-plus"></i> Nouveau taux</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php
    $date_jour_start = date('Y-m-d');
    //Date minimale
    //$date_max_naissance = new DateTime($date_jour);
    //$date_max_naissance->modify('-18 year');
    $date_max = ((new DateTime())->modify('+1 year'))->format('Y-m-d');
    $date_min = ((new DateTime())->modify('-1 day'))->format('Y-m-d');
    ?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="alert alert-info text-center">
                            <h1 class="app-page-title mb-0">Gestion de taux de change de monnaies</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table table-sm table-stripped" id="datatablesExample2">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Devise</th>
                                            <th scope="col">Taux</th>
                                            <th scope="col">Date Debut</th>
                                            <th scope="col">Date Fin</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                if (isset($exchanges) && (! empty($exchanges))):
                                    $count = 1;
                                    foreach ($exchanges as $key => $secvalue): ?>
                                        <tr class="small">
                                            <th scope="row"><?= $count++;?></th>
                                            <td class="text-uppercase">
                                                <?= setCurrency($secvalue['exchange_currency_id']);?>
                                            </td>
                                            <td><?= ($secvalue['exchange_value']);?></td>
                                            <td><?= $secvalue['exchange_start_date'];?></td>
                                            <td><?= $secvalue['exchange_end_date'];?></td>
                                            <td><?= $secvalue['exchange_created_at'];?></td>
                                            <td>
                                                <a class="btn text-capitalize btn-sm"
                                                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce secteur ?'); false;"
                                                    href="<?= base_url('fees/changeStatus/exchange/'.$secvalue['exchange_status'].'/'.$secvalue['exchange_id']); ?>">
                                                    <span
                                                        class="text-<?= setStatusColors($secvalue['exchange_status']);?>"><b>
                                                            <?= $secvalue['exchange_status'];?></b> </span>
                                                </a>

                                            </td>
                                            <td class="text-right">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#offcanvasEdit<?= $count; ?>"
                                                    aria-controls="offcanvasEdit<?= $count; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour modifier">
                                                        <i class="fas fa-edit"></i></span>
                                                </a>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="offcanvasEdit<?= $count; ?>" data-backdrop="static"
                                            data-keyboard="false">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- ====== FEEDBACK FORM====== -->
                                                    <div class="modal-header">
                                                        <span id="offcanvasEditLabel"
                                                            class="h5 text-uppercase font-weight-bold">
                                                            Modification: <?= $secvalue['exchange_name']; ?></span>
                                                        <button type="button" class="btn-close text-reset"
                                                            data-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <?php
                                            $validation = \Config\Services::validation();
                                            $session = \Config\Services::session();
                                            $attributes = array('role' => "form", 'class' => "formsend");
                                            echo form_open_multipart(base_url('update-exchange/'.$secvalue['exchange_id']), $attributes); ?>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12 mb-2">
                                                                <div class="form-floating">
                                                                    <select
                                                                        class="form-select form-control <?= ($validation->hasError('currency')) ? ' is-invalid' : '' ?>"
                                                                        title="currency" name="currency" id="devise">
                                                                        <option disabled selected>- selectionnez -
                                                                        </option>
                                                                        <?php
                                if(isset($currencies) && (! empty($currencies))){
                                    foreach ($currencies as $currencykey => $currency) { ?>
                                                                        <option value="<?= $currency['currency_id']; ?>"
                                                                            <?= set_select("currency", $currency['currency_id']); ?>>
                                                                            <?= setCurrency($currency['currency_name']); ?>
                                                                        </option>
                                                                        <?php }} ?>
                                                                        <?php
                                    $currency = setCurrency();
                                    foreach ($currency as $currencykey => $valuecurrency): ?>
                                                                        <option value="<?= esc($currencykey); ?>"
                                                                            <?= ($secvalue['exchange_currency_id'] == $currencykey) ? 'selected': set_select('currency_name', esc($currencykey)); ?>>
                                                                            <?= strtoupper(($valuecurrency)); ?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label for="currency" class="label-control">
                                                                        <span class="text-danger">*</span>Devise
                                                                    </label>
                                                                </div>
                                                                <span
                                                                    class="text-danger"><?= displayFormError($validation, 'currency'); ?></span>

                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text" name="exchange_value"
                                                                        value="<?= $secvalue['exchange_value']; ?>"
                                                                        class="form-control <?= ($validation->hasError('exchange_value')) ? ' is-invalid' : '' ?>"
                                                                        id="exchange_value" placeholder="Ex: CDF = 2800"
                                                                        required>
                                                                    <label for="exchange_value" class="label-control">
                                                                        <span class="text-danger">*</span>Valeur du taux
                                                                        de change</label>
                                                                    <span
                                                                        class="invalid-feedback"><?= displayFormError($validation, 'exchange_value'); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="date" name="exchange_started"
                                                                        value="<?= $secvalue['exchange_start_date']; ?>"
                                                                        class="form-control <?= ($validation->hasError('exchange_started')) ? ' is-invalid' : '' ?>"
                                                                        id="exchange_started" placeholder="01/07/2024"
                                                                        min="<?= date('Y-m-d'); ?>"
                                                                        max="<?= $date_max; ?>">
                                                                    <label for="exchange_started" class="label-control">
                                                                        <span class="text-danger">*</span>Date debut
                                                                        d'application du taux</label>
                                                                    <span
                                                                        class="invalid-feedback"><?= displayFormError($validation, 'exchange_started'); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="date" name="exchange_ended"
                                                                        value="<?= $secvalue['exchange_end_date']; ?>"
                                                                        class="form-control <?= ($validation->hasError('exchange_ended')) ? ' is-invalid' : '' ?>"
                                                                        id="exchange_ended" placeholder="01/07/2024"
                                                                        min="<?= date('Y-m-d'); ?>"
                                                                        min="<?= date('Y-m-d'); ?>"
                                                                        max="<?= $date_max; ?>">
                                                                    <label for="exchange_ended" class="label-control">
                                                                        <span class="text-danger"></span>Date fin
                                                                        d'application du taux</label>
                                                                    <span
                                                                        class="invalid-feedback"><?= displayFormError($validation, 'exchange_ended'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit"
                                                            class="btn btn-info btn-sm text-uppercase">Enregistrer les
                                                            modifications</button>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                                <?= form_close(); ?>
                                            </div>
                                        </div>
                                        <!-- ====== END FEEDBACK====== -->
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- End #container -->

<!-- ====== FEEDBACK FORM====== -->
<div class="modal fade" id="offcanvasFeedback" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">
                    Configuration d'un nouveau de change</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
                $validation = \Config\Services::validation();
                $session = \Config\Services::session();
                $attributes = array('role' => "form", 'class' => "formsend");
                echo form_open_multipart(base_url('create-exchange'), $attributes); ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="form-floating">
                            <select
                                class="form-select form-control <?= ($validation->hasError('currency')) ? ' is-invalid' : '' ?>"
                                title="currency" name="currency" id="devise">
                                <option disabled selected>- selectionnez un état -</option>
                                <?php
                                    $currency = setCurrency();
                                    foreach ($currency as $currencykey => $valuecurrency): ?>
                                <option value="<?= esc($currencykey); ?>"
                                    <?= set_select('currency_name', esc($currencykey)); ?>>
                                    <?= strtoupper(($valuecurrency)); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="currency" class="label-control">
                                <span class="text-danger">*</span>Devise </label>

                            <span class="text-danger"><?= displayFormError($validation, 'currency'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="form-floating">
                            <input type="text" name="exchange_value" value="<?= old('exchange_value'); ?>"
                                class="form-control <?= ($validation->hasError('exchange_value')) ? ' is-invalid' : '' ?>"
                                id="exchange_value" placeholder="Ex: CDF = 2800" required>
                            <label for="exchange_value" class="label-control">
                                <span class="text-danger">*</span>Valeur du taux de change</label>
                            <span
                                class="invalid-feedback"><?= displayFormError($validation, 'exchange_value'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="form-floating">
                            <input type="date" name="exchange_started" value="<?= old('exchange_started'); ?>"
                                class="form-control <?= ($validation->hasError('exchange_started')) ? ' is-invalid' : '' ?>"
                                id="exchange_started" placeholder="01/07/2024" min="<?= date('Y-m-d'); ?>"
                                max="<?= $date_max; ?>">
                            <label for="exchange_started" class="label-control">
                                <span class="text-danger">*</span>Date debut d'application du taux</label>
                            <span
                                class="invalid-feedback"><?= displayFormError($validation, 'exchange_started'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="form-floating">
                            <input type="date" name="exchange_ended" value="<?= old('exchange_ended'); ?>"
                                class="form-control <?= ($validation->hasError('exchange_ended')) ? ' is-invalid' : '' ?>"
                                id="exchange_ended" placeholder="01/07/2024" min="<?= date('Y-m-d'); ?>"
                                min="<?= date('Y-m-d'); ?>" max="<?= $date_max; ?>">
                            <label for="exchange_ended" class="label-control">
                                <span class="text-danger"></span>Date fin d'application du taux</label>
                            <span
                                class="invalid-feedback"><?= displayFormError($validation, 'exchange_ended'); ?></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info btn-sm text-uppercase">Valider la configuration</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- ====== END FEEDBACK====== -->