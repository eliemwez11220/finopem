
<?php  $logo_cover = (session()->has('schoolpicture')) ? session()->get('schoolpicture') : ''; ?>

<div class="card">
    <div class="card-footer mt-0"
        style="background: url(<?= base_url('public/uploads/images/'.$logo_cover); ?>);background-repeat: no-repeat; background-size: cover;">

        <div class="text-center">
            <h1 class=" text-uppercase font-weight-bold">
                <b><?= (session()->has('schoolfname')) ? (session()->get('schoolfname')) : '  '; ?></b>
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-5 col-sm-5 border-right">
                <div class="text-right">
                    <address class="ml-1">

                        <span class="text-uppercase font-weight-bold small">
                            Adresse:
                            <?= (session()->has('schooladdress')) ? wordwrap(session()->get('schooladdress'), 30, "<br>\n") : ''; ?>
                        </span>
                        <br>
                        <span class="font-weight-bold">
                            Téléphone:<?= (session()->has('schoolphone')) ? (session()->get('schoolphone')) : ''; ?>
                            <br>Email: <span class="text-lowercase">
                                <?= (session()->has('schoolemail')) ? (session()->get('schoolemail')) : ''; ?>
                            </span>
                        </span>
                        <br>

                    </address>
                </div>
            </div>

            <?php  if(session()->has('schoollogo')): ?>
            <div class="col-lg-2 col-sm-2">
                <div class="text-center">
                    <?php   $logo = base_url('public/uploads/images/'.session()->get('schoollogo')); 
                                        $magstore_logo = base_url('public/img/logo/favicon.png');
                                        $valid_logo = (session()->get('schoollogo'))? $logo: $magstore_logo;
                                ?>
                    <div class="">
                        <img src="<?= $valid_logo; ?>" alt="<?= $logo; ?>" class="school-logo school-logo-medium">
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-lg-5 col-sm-5 small border-left">
                <div class="text-left">
                    <span class="text-uppercase">
                        <b>
                            Année scolaire :
                            <?= (session()->has('schoolyear')) ? session()->get('schoolyear') : '-'; ?>
                        </b>
                    </span>
                    <br>
                    <span class="text-uppercase <?= (session()->has('choosedsectionname')) ? '': 'd-none'; ?>">
                        <b>Section:
                            <?= (session()->has('choosedsectionname')) ? session()->get('choosedsectionname') : '-'; ?>
                        </b>
                    </span>
                    <br>
                    <span class="text-uppercase <?= (session()->has('choosedclassename')) ? '': 'd-none'; ?>">
                        <b>Classe:
                            <?= (session()->has('choosedclassename')) ? session()->get('choosedclassename') : '-'; ?>
                        </b>
                    </span>
                    <br>
                    <span class="text-uppercase">
                        <b>Rapport du
                            <?= isset($start) ? date("d/m/Y", strtotime($start)): date('d/m/Y'); ?> au
                            <?= isset($end) ? date("d/m/Y", strtotime($end)): date('d/m/Y'); ?>
                        </b>
                    </span>
                    <br>
                    <span class="text-uppercase font-weight-bold">
                        <b>Edition du <?= date("d/m/Y"); ?> à <b><?= date('H:i:s') ?></b></b>
                    </span>
                    <br>
                    <span class="text-uppercase font-weight-bold">
                        <b><?= isset($user) ? "Agent Percepteur: ". $user['user_firstname'].' '.$user['user_lastname']:''; ?></b>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>