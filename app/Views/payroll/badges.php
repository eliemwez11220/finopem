<div class="content-wrapper <?= checkModuleAccess('badges'); ?>">
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 col-sm-9">
                    <form method="get" class="mb-3 printoff">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <select name="agent_filter" id="agent_filter" class="form-select form-control">
                                        <option value="">Tous les agents</option>
                                        <?php if (isset($contracts) && !empty($contracts)): ?>
                                        <?php foreach ($contracts as $agent): ?>
                                        <option value="<?= $agent['agent_code']; ?>"
                                            <?= isset($_GET['agent_filter']) && $_GET['agent_filter'] == $agent['agent_code'] ? 'selected' : ''; ?>>
                                            <?= $agent['agent_firstname'] . ' ' . $agent['agent_lastname']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <label for="agent_filter" class="form-label">Filtrer par agent</label>
                                </div>
                            </div>

                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    <i class="fas fa-filter"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-3 col-sm-3">
                    <p class="float-right float-lg-end mt-1">
                        <a href="" class="btn btn-success btn-lg" onclick="window.print();">
                            <i class="fas fa-print"></i> Imprimer
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card" style="page-break-after: always!important;">
                <div class="card-footer">
                    <!-- ====== Start Reporting Header -->
                    <?php include(APPPATH. ('Views/reporting/header.php')); ?>
                    <!-- ====== End Reporting Header -->
                </div>
                <div class="text-center py-3 mb-3" style="border:2px solid black">
                    <h3 class="font-weight-bold text-uppercase">
                        BADGES DES AGENTS
                    </h3>
                </div>
            </div>
            <div class="row ">
                <?php if(isset($contracts) && (!empty($contracts))):?>
                <?php foreach ($contracts as $contract):
              if (isset($_GET['agent_filter']) && !empty($_GET['agent_filter']) && $_GET['agent_filter'] != $contract['agent_code']) {
                continue; // Skip payments that don't match the filter
            }
              ?>
                <div class="col-lg-4 col-sm-6 mb-2 mt-3" style="page-break-after: always!important;">
                    <div class="shadow-lg border border-primary py-3"
                        style="width: 300px;background-color: white;border: 4px solid #e91e63;border-radius: 15px;box-shadow: 0 4px 10px rgba(0,0,0,0.1);padding: 20px 15px;">
                        <!-- badge -->
                        <div class="text-center">
                            <!-- logo -->
                            <h1 class="text-uppercase font-weight-bold mb-3 h3">
                                <b><?= (session()->has('schoolfname')) ? (session()->get('schoolfname')) : '  '; ?></b>
                            </h1>
                            <img src="<?= (!empty($contract['agent_picture'])) ? base_url('public/uploads/images/' . $contract['agent_picture']) : base_url('public/uploads/images/'.session()->get('schoollogo')); ?>"
                                alt="..." class="avatar avatar-xl border border-primary">
                        </div>

                        <div class="mt-3">
                            <!-- info -->
                            <p><span class="h5 mb-0">Noms :</span> <span class="font-weight-bold text-uppercase">
                                    <?= $contract['agent_firstname'] . ' ' . $contract['agent_lastname']; ?>
                                </span></p><!-- label -->
                            <p><span class="h5 mb-0">Prénom :</span>
                                <span class="font-weight-bold text-uppercase"><?= $contract['agent_surname']; ?></span>
                            </p>
                            <p><span class="h5 mb-0">Poste :</span>
                                <span class="font-weight-bold text-uppercase"><?= $contract['agent_title']; ?></span>
                            </p>
                            <p><span class="h5 mb-0">Matricule :</span>
                                <span class="font-weight-bold text-uppercase"><?= $contract['agent_code']; ?></span>
                            </p>
                        </div>
                        <div class="card-footer text-center small text-muted">
                            <hr>
                            <!-- footer -->
                            <small>
                                En cas de perte, prière de ramener ce badge au siège de l’établissement scolaire sise
                                : <?= session()->has('schooladdress') ? session()->get('schooladdress') : ''; ?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>