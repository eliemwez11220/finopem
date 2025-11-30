<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('expparents', 'tools'); ?>">
    <!-- Content Header (Page header) -->
       <!-- ====== Start Reporting Header -->
       <?php include APPPATH . ('Views/reporting/classefilter.php'); ?>
    <!-- ====== End Reporting Header -->
    <?php if(session()->has('choosedsectionid')): ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="shadow-lg text-center" style="border:2px solid black">
                <h1 class="text-uppercase font-weight-bold">
                    Contacts parents - <?= session()->schoolyear; ?>
                </h1>
                <h3 class="text-uppercase">
                    <b>élèves de la
                        <?= (session()->choosedclassename) ? session()->choosedclassename : 'Générale'; ?>
                    </b>
                </h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="datatablesReportingActions" class="table table-sm">
                                    <thead>
                                        <tr class="text-uppercase small">
                                            <th>#</th>
                                            <th>Père</th>
                                            <th>Tel. Père</th>
                                            <th>Mère</th>
                                            <th>Tel. Mère</th>
                                            <th>Tuteur</th>
                                            <th>Tel. Tuteur</th>
                                            <th>Contacts</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $countparent = 1;
                                        $sparents_listing =  array();
                                        if((session()->parentsclasses)){
                                            if(session()->parentsclasses == 'none'){
                                                $sparents_listing =  array();
                                            }else{
                                                $sparents_listing = session()->parentsclasses;
                                            }
                                        }else{
                                            if (isset($parents)){
                                                $sparents_listing =  $parents;
                                            }
                                        }
                                   
                                    if ((!empty($sparents_listing))):
                                        foreach ($sparents_listing as $key => $parent):
                                            if($parent['section_id'] == session()->get('choosedsectionid')):
                                                ?>
                                        <tr class="small">
                                            <td><?= $countparent++; ?></td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_father_name']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_father_phone']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_mother_name']); ?>
                                                </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_mother_phone']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_tutor_name']); ?>
                                                </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_tutor_phone']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($parent['parent_primary_phone']); ?>
                                                </td>
                                            <td class="text-uppercase">
                                                <span class="text-lowercase">
                                                    <?= trim($parent['parent_primary_email']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= trim($parent['parent_primary_address']);  ?>
                                            </td>

                                        </tr>
                                        
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
    <?php endif; ?>
</div>