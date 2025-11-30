<?php

$logo_cover = (session()->has('schoolpicture')) ? session()->get('schoolpicture') : '';
$uri = service('uri');
// Disable throwing exceptions
$uri->setSilent();
$totalSegments = $uri->getTotalSegments();
$url = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$url2 = ($totalSegments >= 1) ? $uri->getSegment(2) : '';
$url3 = ($totalSegments >= 3) ? $uri->getSegment(3) : '';
?>
<div class="<?= (session()->has('reportingtype')) ? 'd-none' : 'row mt-5 '; ?>">
        <div class="col-lg-4 col-sm-4 border-right">
            <div class="text-center">
                <p class="text-uppercase font-weight-bold">
                    <b>Noms & signature</b>
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4">
            <div class="text-center">
                <p class="text-uppercase font-weight-bold">
                    <b>LA DIRECTION </b>
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 border-left">
            <div class="text-center">
                <p class="text-uppercase font-weight-bold">
                    <b>Fait à <?= (session()->has('schoolcity')) ? (session()->get('schoolcity')) : 'Lubumbashi'; ?>, le
                        <?= date("d/m/Y"); ?></b>
                </p>
            </div>
        </div>
    </div>


<div class="row">
    <div class="col-lg-6 col-sm-6">
        <?php if (!session()->has('reportingtype') or (current_url() != base_url('reporting/listing')) or (current_url() != base_url('reporting/students'))) { ?>
            <div class="printoff <?= (($url == 'listing') or ($url == 'students')) ? 'd-none' : ''; ?>">
                <div class="text-right">
                    <a href="javascript:void();" class="btn btn-success text-uppercase btn-sm" onclick="print()">
                        <i class="fa fa-print"></i> Imprimer ce rapport</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- <div class="col-lg-6 col-sm-6">
        <div class="text-right float-right">
        <-?php $qrcode_value = 'Printed by ' . strtoupper(session()->get('name')) . ' FOR ' . strtoupper(session()->get('schoolfname')) . ' AT ' . date('l d.m.Y H:i:s'); ?>
            <img src="<-?= base_url('qrcode/' . urlencode($qrcode_value)); ?>" alt="QR Code"
                class="school-logo school-logo-medium">
        </div>
    </div> -->
</div>