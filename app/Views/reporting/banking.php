<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('repbanking'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="font-weight-bold text-uppercase py-3 lined lined-center">
                        Opérations bancaires
                    </h1>
                </div>
                <?php 
                    $request = \Config\Services::request(); 
                    //$start = $request->getGet('startdate');
                    //$end = $request->getGet('enddate');

                    $validation = \Config\Services::validation(); 
                    $form_attrib = array(
                        'role'=>"form", 'id'=>"reporting_filter_data", 'method'=>"get"
                    );
                    ?>
                <?= form_open(base_url('reporting/filter/banking'), $form_attrib); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <label for="start_date"><span class="text-danger">*</span>Date début</label>
                            <input type="date"
                                class="form-control <?= ($validation->hasError('start_date')) ? ' is-invalid' : '' ?>"
                                id="start_date" name="startdate" aria-describedby="start_date" required
                                value="<?= (!empty($start))? $start :set_value('start_date'); ?>" />

                            <div id="start_date" class="form-text">
                                <span class="text-danger"><?= displayFormError($validation, 'start_date'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <label for="end_date"><span class="text-danger">*</span>Date fin</label>
                            <div class="input-group">
                                <input type="date"
                                    class="form-control <?= ($validation->hasError('end_date')) ? ' is-invalid' : '' ?>"
                                    id="end_date" placeholder="Patient" name="enddate" aria-describedby="end_date"
                                    required value="<?= (!empty($end))? $end : set_value('end_date'); ?>" />


                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info text-uppercase"
                                        title="Bouton de recherche">
                                        <i class="fa fa-search"></i> valider
                                    </button>
                                </div>
                            </div>
                            <div id="end_date" class="form-text">
                                <span class="text-danger"><?= displayFormError($validation, 'end_date'); ?></span>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
    </section>
    <?php  if (isset($transactions) && !empty($transactions)): ?>
    <section class="content">
        <div class="container-fluid">
        <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="font-weight-bold text-uppercase py-3" style="border:2px solid black">
                            Transactions bancaires
                        </h1>
                    </div>
                    <div class="table-responsive">
                        <table id="datatablesReportingActions"
                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-uppercase small">
                                    <th width="1px">#</th>
                                    <th>Date</th>
                                    <th>Caisse</th>
                                    <th>Compte & Banque</th>
                                    <th>Montant</th>
                                    <th>Type</th>
                                    <th>Etat</th>
                                    <th>Notes</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $count = 1;
                                            foreach ($transactions as $keytr => $transaction): 
                                            $status = ($transaction['transaction_status']);
                                            $transaction_amount = ($transaction['transaction_amount']);
                                            $currency = ($transaction['transaction_currency']);
                                            
                                            ?>
                                <tr class="small">

                                    <td><?= $count++; ?></td>
                                    <td><?= $transaction['transaction_created_at']; ?></td>
                                    <td class="text-uppercase"><?= ($transaction['cashbox_name']); ?></td>
                                    <td class="text-uppercase">
                                        <?= ($transaction['bank_account_number']); ?> -
                                        <?= ($transaction['bank_name']); ?>
                                    </td>

                                    <td class="text-uppercase">
                                        <?= number_format(($transaction_amount), 2, ',', ' '). ' '.$currency; ?>
                                    </td>

                                    <td class="small">
                                        <?= ($transaction['transaction_type'] == 'cashbox') ? ' Sortie Caisse': ' Entrée Caisse'; ?>
                                    </td>

                                    <td>
                                        <span class="badge  badge-<?= setStatusColors($status); ?> text-capitalize">
                                            <?= ($status == 'cancel') ? 'Annulée' : 'Exécutée'; ?></span>

                                    </td>
                                    <td><?= ($transaction['transaction_notes']); ?></td>

                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>