<div class="content-wrapper">
    <section class="content <?= checkModuleAccess('bills'); ?>">
        <div class="card">
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <h1 class="font-weight-bold text-uppercase lined lined-center  text-center">
                            <i class="nav-icon fas fa-donate"></i> Reçus de paiements
                        </h1>
                    </div>
                    <div class="col-sm-12 col-lg-6 border-right">
                        <p>
                            Consulter les reçus de paiements effectués par les étudiants en sélectionnant
                            une période donnée.
                            Notez que vous pouvez aussi filtrer les reçus par section organisée en utilisant le menu
                            déroulant
                            prévu à cet effet.
                        </p>
                        <?php
                        $request = \Config\Services::request();
                        //$start = $request->getGet('startdate');
                        //$end = $request->getGet('enddate');
                        
                        $validation = \Config\Services::validation();
                        $form_attrib = array(
                            'role' => "form",
                            'id' => "bills_filter_data",
                            'method' => "get"
                        );
                        ?>
                        <?= form_open(base_url('payments-bills'), $form_attrib); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label for="start_date"><span class="text-danger">*</span>Date début</label>
                                    <input type="date"
                                        class="form-control <?= ($validation->hasError('start_date')) ? ' is-invalid' : '' ?>"
                                        id="start_date" name="started" aria-describedby="start_date" required
                                        value="<?= (!empty($start)) ? $start : set_value('start_date'); ?>" />

                                    <div id="start_date" class="form-text">
                                        <span
                                            class="text-danger"><?= displayFormError($validation, 'start_date'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-2">
                                    <label for="end_date"><span class="text-danger">*</span>Date fin</label>
                                    <div class="input-group">
                                        <input type="date"
                                            class="form-control <?= ($validation->hasError('end_date')) ? ' is-invalid' : '' ?>"
                                            id="end_date" name="closing" aria-describedby="end_date" required
                                            value="<?= (!empty($end)) ? $end : set_value('end_date'); ?>" />


                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info text-uppercase"
                                                title="Bouton de recherche">
                                                <i class="fa fa-search"></i> valider
                                            </button>
                                        </div>
                                    </div>
                                    <div id="end_date" class="form-text">
                                        <span
                                            class="text-danger"><?= displayFormError($validation, 'end_date'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="text-center mr-3">
                            <!-- CREATION RAPIDE DEW RECU -->
                            <p>
                                Vous avez la possibilité d'encoder rapidement un reçu de paiement sans
                                passer par la perception de frais de l'étudiant.
                                L'encodage rapide de reçu est utile pour les paiements en espèces non numérisés.
                                Pour ce faire, cliquez sur le bouton ci-dessous.
                            </p>
                            <a href="<?= base_url('encodingBillPayment'); ?>" class="btn btn-success">
                                <i class="fas fa-check-circle"></i>
                                Encodage rapide des reçus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (isset($bills) && !empty($bills)): ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="row card-header">
                    <div class="col-lg-12 col-sm-12">
                        <form role="form" id="ajax_form_sections" method="get">
                            <div class="form-floating" style="width: 100%!important;">
                                <select id="ajax_sections" name="ajax_sections" title="Classe"
                                    class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                    <option disabled selected>--sélectionnez une Faculté--</option>
                                    <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                    <option value="all">Toutes les Facultés</option>
                                    <?php endif; ?>
                                    <?php
                                            $sections_listing = [];
                                            if (session()->has('usersbranchs')) {
                                                if (session()->get('usersbranchs') == 'none') {
                                                    $sparents_listing = [];
                                                } else {
                                                    $sections_listing = session()->usersbranchs;
                                                }
                                            } else {
                                                if (isset($sections)) {
                                                    $sections_listing = $sections;
                                                }
                                            }

                                            if ((!empty($sections_listing))):
                                                foreach ($sections_listing as $key => $value): ?>
                                    <option value="<?= trim($value['section_id']); ?>"
                                        <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id'])) ? 'selected' : set_select('ajax_sections', trim($value['section_id'])); ?>>
                                        <?= strtoupper(trim($value['section_name'])); ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="ajax_sections" class="text-uppercase font-weight-bold">
                                    <span class="text-danger">*</span>Facultés</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if (session()->has('choosedsectionid')): ?>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <fieldset>
                                <table class="table table-bordered table-sm" id="datatablesExample2">
                                    <thead>
                                        <tr class="small text-uppercase font-weight-bold">
                                            <th>Actions</th>
                                            <th>Reçu</th>
                                            <th>Date</th>
                                            <th>Frais</th>
                                            <th>Etudiant </th>
                                            <th>Promotion </th>
                                            <th>Statut </th>
                                            <th>Edition</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($bills as $payment) {
                                                    $user_id = session()->has('userid') ? session()->get('userid') : '';
                                                    if (($user_id == $payment['payment_user_id']) or (session()->admin == TRUE) or (session()->all == TRUE)) {
                                                        if (session()->get('choosedsectionid') == $payment['section_id']) {

                                                            $currency = $payment['fee_currency_payable'];
                                                            $currency_paid = ($currency == 'usd') ? '$' : 'Fc';
                                                            $pay_token = $payment['paydetails_token'];
                                                            $pay_amount = $payment['paydetails_paid_amount'];

                                                            $pay_usd_amount = $payment['paydetails_usd_amount'];
                                                            $pay_cdf_amount = $payment['paydetails_cdf_amount'];

                                                            $pay_returned_amount = $payment['paydetails_return_amount'];

                                                            $pay_exchange = $payment['payment_exchange'];

                                                            $fee_payable = $payment['feedetail_cost_payable'];

                                                            $notes = $payment['payment_notes'];
                                                            $status = (!empty(($payment['paydetails_status'])) ? ($payment['paydetails_status']) : 'inactif');

                                                            $total_amount_usd = ($pay_usd_amount != 0) ? $pay_usd_amount + ($pay_cdf_amount / $pay_exchange) : 0;
                                                            $total_amount_cdf = ($pay_usd_amount != 0) ? $pay_cdf_amount + ($pay_usd_amount * $pay_exchange) : 0;

                                                            $balance_amount = $pay_returned_amount;
                                                            $balance_currency = ($currency == 'usd') ? '$' : 'Fc';
                                                            ?>
                                        <tr class="small">
                                            <td class="font-weight-bold">
                                                <?php if (($status != 'cancel')) { ?>
                                                <?php $access_delete = (session()->bills_deleted == 'on' OR session()->admin == TRUE OR session()->all == TRUE)? '': 'disabled'; ?>

                                                <?php $user_access = ($payment['payment_date'] == date('Y-m-d') && ($access_delete != 'disabled')) ? 'disabled': ''; ?>

                                                <a href="<?= base_url('payment/cancelPaydetails/' . $pay_token); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment annuler ce paiement?');"
                                                    class="btn btn-sm btn-danger <?= $user_access; ?>">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour annuler ce Reçu de paiement">
                                                        <i class="fa fa-window-close"></i>
                                                    </span>
                                                </a>
                                                <a href="<?= base_url('payment/printbill/' . $payment['payment_token']); ?>"
                                                    class="btn btn-sm btn-success">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour imprimer le Reçu de ce paiement">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                </a>
                                                <a href="<?= base_url('payment/bill/' . $payment['payment_token']); ?>"
                                                    class="btn btn-sm btn-info">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour afficher les détails de ce reçu">
                                                        <i class="fa fa-info-circle"></i>
                                                    </span>
                                                </a>
                                                <?php } else { ?>
                                                <a href="<?= base_url('payment/remove/paydetails/' . $payment['paydetails_id']); ?>"
                                                    class="btn btn-sm btn-outline-danger <?= $access_delete; ?>"
                                                    onclick="return confirm('Etes-vous vraiment sûr de vouloir supprimer définitivement ce paiement [<?= $payment['fee_name']; ?> - <?= $payment['feedetail_name']; ?>]?');">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer définitivement ce paiement">
                                                        Supprimer
                                                    </span>
                                                </a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['payment_code']; ?>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['payment_date']; ?>
                                            </td>

                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['fee_name']; ?>
                                            </td>

                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['student_firstname']; ?>
                                                <?= $payment['student_lastname']; ?>
                                                - <?= $payment['student_code']; ?>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= (!empty($payment['classe_shortname'])) ? $payment['classe_shortname'] : $payment['degree_shortname'] . ' ' . ($payment['classe_subname']) . ' ' . ($payment['option_name']); ?>
                                            </td>
                                            <td class="font-weight-bold text-uppercase">
                                                <span
                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-success' : 'badge-danger'; ?> text-capitalize">
                                                    <?= ($status == 'actif') ? 'Validé' : 'Annulé'; ?> </span>
                                            </td>
                                            <td class="text-uppercase font-weight-bold">
                                                <?= $payment['payment_created_at']; ?>
                                            </td>
                                        </tr>
                                        <?php } } } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                            <hr>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>