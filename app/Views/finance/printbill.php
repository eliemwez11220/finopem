<div class="content-wrapper <?= checkModuleAccess('expenses'); ?>">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="text-uppercase font-weight-bold">
                            <a href="<?= base_url('finances/expenses') ?>" class="btn btn-info">
                                <i class="fa fa-reply-all fa-lg"></i>
                            </a>
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Gestion Financière</li>
                                <li class="breadcrumb-item active">Transactions bancaires</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-xs-12 offset-lg-2">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <?php if(isset($expense) && !empty($expense)): ?>
                            <div class="text-center">
                                <h3 class="py-3" style="border:2px solid black">
                                    <span class="text-center text-uppercase font-weight-bold">
                                        Bon de sortie caisse n° <b><?= $expense['expense_code'];?></b> du
                                        <?= date("d/m/Y H:i:s", strtotime($expense['expense_created_at'])); ?>
                                    </span>
                                </h3>
                            </div>
                            <div class="row py-5">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <h5 class="font-weight-bold text-uppercase border">
                                                <b>Bénéficiaire : <?= ($expense['expense_requested_by']); ?></b>
                                            </h5>
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <h5 class="font-weight-bold text-uppercase border">
                                                <b>Approuvé par : <?= ($expense['expense_approved_by']); ?></b>
                                            </h5>
                                        </div>
                                        
                                        <div class="col-lg-12 col-sm-12">
                                            <h5 class="py-3 font-weight-bold text-uppercase border">
                                                <b>Motif : <?= ($expense['expense_notes']); ?></b>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="text-center">
                                    <h5 class="text-uppercase"><b>Montant</b></h5>
                                    <p class="h5 shadow-lg font-weight-bold ">
                                    <b>
                                        <?= (!empty($expense['expense_cdf_amount'])) ? number_format($expense['expense_cdf_amount'], 2, ',', ' ').' CDF' : ''; ?>
                                    </b>
                                    </p>
                                    <p class="h3 shadow-lg font-weight-bold ">
                                    <b>
                                        <?= (!empty($expense['expense_cdf_amount'])) ? number_format($expense['expense_usd_amount'], 2, ',', ' ').' USD':''; ?>
                                    </b>
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                            <!-- ====== Start Reporting Header -->
                            <?php include(APPPATH. ('Views/reporting/footer.php')); ?>
                            <!-- ====== End Reporting Header -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script>
window.addEventListener("load", window.print());
</script>