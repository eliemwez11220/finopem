<div class="content-wrapper">
    <section class="content-header printoff">
        <div class="container-fluid">
            <blockquote>
                <div class="row">
                    <div class="col-lg-8 col-sm-8 col-xs-12">
                        <div class="form-floating">
                            <select id="ajax_school" name="ajax_school" class="form-control">
                                <option selected disabled>--sélectionnez--</option>

                                <?php if (isset($schools) && !empty($schools)):
                                        foreach ($schools as $schoolkey => $school): ?>
                                <option value="<?= ($school['school_id']);?>"
                                    <?= (session()->has('schoolchoosed') && (session()->get('schoolchoosed')==$school['school_id']))? 'selected' : set_select('ajax_school', ($school['school_id']));?>>
                                    <?= strtoupper($school['school_fullname']);?>
                                    [<?= strtoupper($school['school_code']);?>]
                                </option>
                                <?php endforeach;?>
                                <?php endif;?>

                            </select>
                            <label for="ajax_school" class="control-label">
                                <span class="text-danger">*</span>Etablissement
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12 <?= (session()->has('schoolchoosed')) ? '':'d-none' ?>">
                        <div class="form-floating">
                            <select id="year" name="year" class="form-control ">
                                <option selected disabled>--sélectionnez--</option>

                                <?php if (isset($years) && !empty($years)):
                        $yearchoosed = (isset($year) && (!empty($year)))?$year['year_id']:''; 
                                    foreach ($years as $yearkey => $yearvalue): ?>
                                <option value="<?= ($yearvalue['year_id']);?>"
                                    <?= ($yearchoosed ==$yearvalue['year_id'])? 'selected' : set_select('year', ($yearvalue['year_id']));?>>
                                    <?= ($yearvalue['year_started']);?>-<?= ($yearvalue['year_ended']);?>
                                </option>
                                <?php endforeach;?>
                                <?php endif;?>

                            </select>
                            <label for="year" class="control-label">
                                <span class="text-danger">*</span>Année d'études
                            </label>

                        </div>
                    </div>
                </div>
            </blockquote>
            <blockquote class="<?= session()->has('yeardata') && (session()->has('schooldata')) ? '': 'd-none'; ?>">
                <div class="row printoff">
                    <div class="col-sm-12 col-lg-12">
                        <form role="form" id="ajax_form_sections" method="get">
                            <div class="form-floating input-group mt-3" style="width: 100%!important;">
                                <select id="ajax_sections" name="ajax_sections" title="Classe"
                                    class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
                                    <option disabled selected>--sélectionnez une section--</option>
                                    <option value="all">Toutes les sections</option>
                                    <?php if (isset($sections) && !empty($sections)):
                                foreach ($sections as $key => $value):?>
                                    <option value="<?= esc($value['section_id']); ?>"
                                        <?= (session()->has('choosedsectionid') && (session()->choosedsectionid == $value['section_id']))?'selected':set_select('ajax_sections', esc($value['section_id'])); ?>>
                                        <?= ucfirst(($value['section_name'])); ?>
                                    </option>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="ajax_sections">
                                    <span class="text-danger">*</span>Sections organisées</label>
                            </div>
                        </form>
                    </div>
                </div>
            </blockquote>
        </div>
    </section>
    <?php  if (session()->has('yeardata') && (session()->has('schooldata'))): ?>

    <?php if(isset($year) && (!empty($year))):?>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
            <?php  
                    $schooldata = session()->get('schooldata');

                    $logo_cover = $schooldata['school_picture_cover']; ?>

            <div class="card">
                <div class="card-footer mt-0"
                    style="background: url(<?= base_url('public/uploads/images/'.$logo_cover); ?>);background-repeat: no-repeat; background-size: cover;">

                    <div class="text-center">
                        <h1 class=" text-uppercase font-weight-bold">
                            <b><?= $schooldata['school_fullname']; ?></b>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-sm-5 border-right">
                            <div class="text-right">
                                <address class="ml-1">

                                    <span class="text-uppercase font-weight-bold small">
                                        Adresse:
                                        <?= wordwrap($schooldata['school_address'], 30, "<br>\n"); ?>
                                    </span>
                                    <br>
                                    <span class="font-weight-bold">
                                        Téléphone:<?= $schooldata['school_phone']; ?>
                                        <br>Email: <span class="text-lowercase">
                                            <?= $schooldata['school_email']; ?>
                                        </span>
                                    </span>
                                    <br>

                                </address>
                            </div>
                        </div>

                        <?php  if(!empty($schooldata['school_logo'])): ?>
                        <div class="col-lg-2 col-sm-2">
                            <div class="text-center">
                                <?php   $logo = base_url('public/uploads/images/'.$schooldata['school_logo']); 
                                        $magstore_logo = base_url('public/img/logo/favicon.png');
                                        $valid_logo = (!empty($schooldata['school_logo']))? $logo: $magstore_logo;
                                ?>
                                <div class="">
                                    <img src="<?= $valid_logo; ?>" alt="<?= $logo; ?>"
                                        class="school-logo school-logo-medium">
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="col-lg-5 col-sm-5 small border-left">
                            <div class="text-left">
                                <span class="text-uppercase">
                                    <b>
                                        Année scolaire :
                                        <?=  $year['year_started'] .'-'. $year['year_ended']; ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b>Classe: Générale
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase">
                                    <b>Rapport du
                                        <?= isset($start) ? date("d/m/Y", strtotime($start)): date('d/m/Y'); ?>
                                        au
                                        <?= isset($end) ? date("d/m/Y", strtotime($end)): date('d/m/Y'); ?>
                                    </b>
                                </span>
                                <br>
                                <span class="text-uppercase font-weight-bold">
                                    <b>Edition du <?= date("d/m/Y H:i:s"); ?></b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php   if (session()->has('choosedsection')) : 
    $choosedsection = session()->get('choosedsection'); ?>
    <div class="card">
        <div class="card-header">
            <div class="shadow-lg text-center" style="border:2px solid black">
                <h3 class="text-uppercase font-weight-bold py-3">
                    <span class="text-primary small font-weight-bold">

                        effectifs des élèves inscrits - <?=$year['year_started'] .'-'. $year['year_ended']; ?>

                        <b class="<?= (session()->has('choosedsectionname')) ? '' : 'd-none'; ?>">
                            - section
                            <?= (session()->has('choosedsectionname')) ? session()->choosedsectionname : ''; ?>
                        </b>
                    </span>
                </h3>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12">

                    <div class="table-responsive">
                        <table id="datatablesWithoutActions"
                            class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>#</th>
                                    <th>Classes</th>
                                    <th colspan="3" class="text-center">Effectifs</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr class="text-uppercase text-center font-weight-bold">
                                    <td colspan="2"></td>
                                    <td class="text-center">F</td>
                                    <td class="text-center">G</td>
                                    <td class="text-center">Total</td>
                                </tr>
                                <?php 
                         $student_total_man1 = 0;
                         $student_total_woman1 =0;
                                    $classe_counter = 1;

                                            
                                    $student_total1 = 0;
                                    $student_man1 = 0;
                                    $student_woman1 = 0;

                                    if (isset($classes) && !empty($classes)):
                                        foreach($classes as $classe):
                                                 
                                                if($classe['section_id'] == $choosedsection['section_id']):
                                                    if (isset($students) && !empty($students)):
                                                        //$student_total1 = 0;
                                                        $student_f = 0;
                                                        $student_g = 0;
                                                foreach ($students as $key2 => $parent):

                                                    if($parent['inscription_classe_id'] == $classe['classe_id']){

                                                        $student_total1+= 1;
                                
                                                        if($parent['student_gender'] == 'masculin' && ($parent['inscription_classe_id'] == $classe['classe_id'])){
                                                        
                                                            //$student_man1+=1;
                                                            $student_g++;

                                                        }elseif($parent['student_gender'] == 'feminin' && ($parent['inscription_classe_id'] == $classe['classe_id'])){
                                
                                
                                                            $student_f++;
                                                            //$student_woman1+=1;

                                                        }else{

                                                        }
                                                    }
                                            ?>
                                <?php endforeach; ?>
                                <?php 
                            $student_man1 = $student_g;
                            $student_woman1 =$student_f;
                            ?>
                                <?php endif; ?>
                                <tr class="">
                                    <td><?= $classe_counter++; ?></td>
                                    <td class="text-uppercase">
                                        <?= (!empty($classe['classe_shortname'])) ? $classe['classe_shortname']:$classe['degree_shortname'].' '.($classe['classe_subname']).' '.($classe['option_name']); ?>
                                    </td>
                                    <td class="text-center"><?= $student_woman1; ?></td>
                                    <td class="text-center"><?= $student_man1; ?></td>
                                    <td class="text-center"><b><?= $student_man1 + $student_woman1; ?></b></td>
                                </tr>

                                <?php 
                            $student_total_man1 += $student_man1;
                            $student_total_woman1 +=$student_woman1;
                            ?>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>

                                <tr class="font-weight-bold">
                                    <td colspan="2">
                                        <span class="float-right font-weight-bold">Effectif Total</span>
                                    </td>
                                    <td class="text-center"><?= $student_total_woman1; ?></td>
                                    <td class="text-center"><?= $student_total_man1; ?></td>
                                    <td class="text-center"><b><?= $student_total1; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php if ((session()->has('allsections')) OR (isset($sections))): ?>
    <?php  $all_sections = session()->has('allsections') ? session()->get('allsections'):$sections;?>
    <div class="card" style="page-break-after: always!important;">
        <div class="card-header">
            <div class="shadow-lg text-center mb-3" style="border:2px solid black">
                <h3 class="text-uppercase font-weight-bold py-3">
                    <span class="text-primary small font-weight-bold">
                        Effectif global des élèves inscrits -
                        <?=$year['year_started'] .'-'. $year['year_ended']; ?>

                    </span>
                </h3>
            </div>
            <div class="row">
                <?php if (isset($all_sections) && !empty($all_sections)):
                    $section_total = 0;
                    $section_man = 0;
                    $section_woman = 0;
                    foreach ($all_sections as $keysec => $section): ?>
                <div class="col-4 col-lg-4 col-sm-4">

                    <div class="text-center py-3 mt-2 my-2" style="border:2px solid blue; border-radius:15px">
                        <h3 class="text-uppercase font-weight-bold">
                            <?= $section['section_name']; ?>
                        </h3>
                        <?php 
                        if (isset($students) && !empty($students)):
                            $student_total = 0;
                            $student_man = 0;
                            $student_woman = 0;
                            foreach ($students as $studkey => $studval): 
                                if($studval['section_id'] == $section['section_id']){

                                    $student_total++;

                                    if($studval['student_gender'] == 'masculin'){

                                        $student_man++;

                                    }else{

                                        $student_woman++;
                                    }
                                }
                        ?>
                        <?php endforeach; ?>
                        <?php 
                            $section_total = $student_total;
                            $section_man =$student_man;
                            $section_woman =$student_woman;
                            ?>
                        <?php endif; ?>

                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <?= $section_total; ?>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text font-weight-bold text-uppercase">
                                    élèves inscrits</span>
                            </div>
                        </div>
                        <p><i class="fas fa-users"></i>
                            <span class="font-weight-bold">
                                <?= $section_woman; ?></span>
                            Fille(s) / <span class="font-weight-bold">
                                <?= $section_man; ?></span> Garçon(s)
                        </p>

                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1 font-weight-bold">
                            <?= (isset($nb_eleves) ? $nb_eleves : ''); ?>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold text-uppercase">
                                Effectif
                            </span>
                            <span class="info-box-number font-weight-bold">Global</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1 font-weight-bold">
                            <?= (isset($garcons) ? $garcons: ''); ?>
                        </span>
                        <div class="info-box-content"><span class="info-box-text text-uppercase">Effectif</span>
                            <span class="info-box-number font-weight-bold">Garçons</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1 font-weight-bold">
                            <?= (isset($filles) ? $filles: ''); ?>
                        </span>
                        <div class="info-box-content"><span class="info-box-text text-uppercase">Effectif</span>
                            <span class="info-box-number font-weight-bold">Filles</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <div class="info-box">

                        <span class="info-box-icon bg-success  elevation-1 font-weight-bold">
                            <?= (isset($nb_eleves) ? $nb_eleves : ''); ?>
                        </span>
                        <span class="info-box-icon">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold text-uppercase">
                                Eleves Actifs
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <div class="info-box">

                        <span class="info-box-icon bg-success elevation-1 font-weight-bold">
                            <?= (isset($students_inactive) ? $students_inactive : ''); ?>
                        </span>
                        <span class="info-box-icon">
                            <i class="fas fa-window-close"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold text-uppercase">
                                Abandons
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php if (! empty($all_sections)): ?>
    <?php foreach($all_sections as $allsecvalue): ?>
    <div class="card" style="page-break-after: always!important;">
        <div class="card-footer">
            <div class="shadow-lg text-center" style="border:2px solid black">
                <h3 class="text-uppercase font-weight-bold py-3">
                    <span class="text-primary small font-weight-bold">
                        effectifs des élèves inscrits - <?=$year['year_started'] .'-'. $year['year_ended']; ?>


                        <b> - section <?= $allsecvalue['section_name']; ?> </b>
                    </span>
                </h3>
            </div>
            <div class="row mt-3 border border-radius">
                <div class="col-sm-12 col-lg-12">
                    <div class="table-responsive">
                        <fieldset>

                            <table id="datatablesWithoutActions"
                                class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Classes</th>
                                        <th colspan="3" class="text-center">Effectifs</th>
                                    </tr>
                                    <tr class="text-uppercase">
                                        <th colspan="2"></th>
                                        <th class="text-center">F</th>
                                        <th class="text-center">G</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $classe_counter = 1;

                                            
                                    $student_totl_globe = 0;
                                    $student_globe_man = 0;
                                    $student_globe_woman = 0;
                                    
                                    $student_total_globe = 0;
                                    $student_man_globe = 0;
                                    $student_woman_globe = 0;
                                    $student_man_globe_loc = 0;
                                    $student_woman_globe_loc = 0;
                                    
                                    if (isset($classes) && !empty($classes)):
                                        foreach($classes as $classe):
                                        if (($classe['section_id'] == $allsecvalue['section_id'])):
                                                
                                            if (isset($students) && !empty($students)):
                                                
                                                foreach ($students as $key2 => $parent):

                                                    if($parent['inscription_classe_id'] == $classe['classe_id']){

                                                        $student_totl_globe+= 1;
                                
                                                        if($parent['student_gender'] == 'masculin' && ($parent['inscription_classe_id'] == $classe['classe_id'])){
                                                        
                                                            //$student_man1+=1;
                                                            $student_man_globe_loc++;

                                                        }elseif($parent['student_gender'] == 'feminin' && ($parent['inscription_classe_id'] == $classe['classe_id'])){
                                
                                
                                                            $student_woman_globe_loc++;
                                                            //$student_woman1+=1;

                                                        }else{

                                                        }
                                                    }
                                            ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <tr class="">
                                        <td><?= $classe_counter++; ?></td>
                                        <td class="text-uppercase font-weight-bold">
                                            <?= (!empty($classe['classe_shortname'])) ? $classe['classe_shortname']:$classe['degree_shortname'].' '.($classe['classe_subname']).' '.($classe['option_name']); ?>
                                        </td>
                                        <td class="text-center"><?= $student_woman_globe_loc; ?></td>
                                        <td class="text-center"><?= $student_man_globe_loc; ?></td>
                                        <td class="text-center">
                                            <b><?= $student_woman_globe_loc + $student_man_globe_loc; ?></b>
                                        </td>
                                    </tr>

                                    <?php 
                            $student_man_globe += $student_woman_globe_loc;
                            $student_woman_globe +=$student_man_globe_loc;

                            $student_total_globe =$student_man_globe + $student_woman_globe;
                           // $student_man_globe = 0;
                           // $student_woman_globe = 0;
                            ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                    <tr class="font-weight-bold">
                                        <td colspan="2">
                                            <span class="float-right font-weight-bold">Effectif Total</span>
                                        </td>
                                        <td class="text-center"><?= $student_man_globe; ?></td>
                                        <td class="text-center"><?= $student_woman_globe; ?></td>
                                        <td class="text-center"><b><?= $student_total_globe; ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-md-12">
            <div class="printoff">
                <div class="text-center ">
                    <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-sm"
                        onclick="window.print();">
                        <i class="fa fa-print"></i> Imprimer les statistiques </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>