<div class="content-wrapper <?= checkModuleAccess('sms'); ?>">
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6 col-lg-6">
                            <form role="form" id="ajax_form_sections" method="get">
                                <div class="form-floating input-group" style="width: 100%!important;">
                                    <select id="ajax_sections" name="ajax_sections" title="Classe"
                                        class="form-control select2 select2-info"
                                        data-dropdown-css-class="select2-info">
                                        <option disabled selected>--sélectionnez une section--</option>
                                        <?php if (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')): ?>
                                            <option value="all">Toutes les sections</option>
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
                                    <label for="ajax_sections">
                                        <span class="text-danger">*</span>Sections organisées</label>
                                </div>
                            </form>

                        </div>
                        <?php if (session()->has('choosedsectionid')): ?>
                            <div class="col-sm-6 col-lg-6">
                                <form role="form" id="form_students_classes" method="get">
                                    <div class="form-floating input-group" style="width: 100%!important;">
                                        <select id="ajax_students_classes" name="ajax_students_classes" title="Classe"
                                            class="form-control select2 select2-info"
                                            data-dropdown-css-class="select2-info">
                                            <option disabled selected>--Sélectionnez une classe--</option>
                                            <option value="all">Toutes les classes</option>
                                            <?php if (isset($classes) && !empty($classes)):
                                                foreach ($classes as $key => $clasvalue):
                                                    $branch_access = session()->get('choosedsectionid');
                                                    if (($branch_access == $clasvalue['section_id'])):

                                                        $classe_sess = session()->has('studentchoosedclasse') ? session()->get('studentchoosedclasse') : '';
                                                        ?>
                                                        <option value="<?= esc($clasvalue['classe_id']); ?>"
                                                            <?= ($classe_sess == $clasvalue['classe_id']) ? 'selected' : set_select('ajax_students_classes', esc($clasvalue['classe_id'])); ?>>
                                                            <?= setDegresLevels($clasvalue['degree_code'], 'f'); ?>
                                                            <?= ucfirst($clasvalue['classe_subname']); ?>
                                                            <?= ucfirst($clasvalue['option_name']); ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <label for="ajax_students_classes"><span class="text-danger">*</span>Classes des
                                            élèves</label>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="card-footer bg-info">
                    <div class="row">
                        <div class="col-sm-6 col-lg-8">
                            <h1 class="app-page-title mb-0">Envoi des sms aux parents</h1>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <nav aria-label="breadcrumb" class="container-fluid">
                                <ol class="breadcrumb bg-info">
                                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Communication</li>
                                    <li class="breadcrumb-item active" aria-current="page">SMS</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (session()->has('choosedsectionid')): ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 col-sm-2">
                            <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab"
                                role="tablist" aria-orientation="vertical">
                                <a class="btn btn-xs btn-outline-info nav-link active" id="vert-tabs-right-home-tab"
                                    data-toggle="pill" href="#vert-tabs-right-home" role="tab"
                                    aria-controls="vert-tabs-right-home" aria-selected="true"><span
                                        class="text-uppercase">Nouveau message</span>
                                </a>
                                <a class="btn btn-xs btn-outline-info nav-link" id="vert-tabs-right-listing-tab"
                                    data-toggle="pill" href="#vert-tabs-right-listing" role="tab"
                                    aria-controls="vert-tabs-right-listing" aria-selected="false"><span
                                        class="text-uppercase">Messages envoyés</span>
                                </a>
                                <a class="btn btn-xs btn-outline-info nav-link" id="vert-tabs-right-draft-tab"
                                    data-toggle="pill" href="#vert-tabs-right-draft" role="tab"
                                    aria-controls="vert-tabs-right-draft" aria-selected="false"><span
                                        class="text-uppercase">Brouillon</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-10 col-sm-10">
                            <div class="tab-content" id="vert-tabs-right-tabContent">
                                <div class="tab-pane fade show active" id="vert-tabs-right-home" role="tabpanel"
                                    aria-labelledby="vert-tabs-right-home-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <?php
                                            
                                            $sending_status = session()->has('schoolsmsstatus') ? session()->get('schoolsmsstatus') : 0;

                                            if($sending_status == 1):
            
    
                                            $validation = \Config\Services::validation();
                                            //form
                                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                            echo form_open_multipart(base_url('sendsms'), $attributes);
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-floating mb-3">
                                                        <select id="parent" name="parent"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">

                                                            <option disabled selected>-- sélectionnez destinataire--
                                                            </option>
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
                                                   
                                                    if ((!empty($sparents_listing))):?>
                                                            <option value="all">Tous les parents</option>

                                                            <?php foreach ($sparents_listing as $key => $parent):
                                                            $branch_access = session()->has('choosedsectionid') ? session()->get('choosedsectionid'):'';
                                                            if (($branch_access == $parent['section_id'])):
                                                        if(!empty($parent['parent_primary_phone'])):
                                                        ?>
                                                            <option value="<?= ($parent['parent_id']); ?>"
                                                                <?= set_select('parent', ($parent['parent_id'])); ?>>

                                                                Père: <?= strtoupper($parent['parent_father_name']); ?>
                                                                |
                                                                Mère:
                                                                <?= strtoupper($parent['parent_mother_name']); ?> |
                                                                Tuteur: <?= strtoupper($parent['parent_tutor_name']); ?>
                                                                | Tel:<?= $parent['parent_primary_phone']; ?>
                                                            </option>
                                                            <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            <?php else: ?>
                                                            <option selected disabled>
                                                                Aucun parent dans cette classe. Veuillez choisir une
                                                                autre classe
                                                            </option>
                                                            <?php endif; ?>
                                                        </select>
                                                        <label for="parent">
                                                            <span class="text-danger">*</span>Parents
                                                        </label>
                                                        <?php if ($validation->hasError('parent')) { ?>
                                                        <span class="invalid-feedback">
                                                            <?= $validation->getError('parent'); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">
                                                        
                                                        <textarea name="message" id="message" cols="30" rows="5" maxlength="480"
                                                            placeholder="Descrivez votre message"
                                                            class="form-control <?= ($validation->hasError('message')) ? ' is-invalid' : '' ?>"><?= set_value('message'); ?></textarea>
                                                            <label for="message">
                                                            <span class="text-danger">*</span>Votre message(480 caractères max)</label>
                                                        <?php if ($validation->hasError('message')) { ?>
                                                        <span class="invalid-feedback text-danger">
                                                            <?= $validation->getError('message'); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-3">
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-check-circle"></i>
                                                    Envoyer message
                                                </button>
                                            </div>

                                            <?php echo form_close(); ?>
                                            <?php else: ?>
                                                <div class="alert alert-info py-3">
                                                        <p class="text-danger text-center font-weight-bold">
                                                            L'envoi de messages est désactivé. Vous ne pouvez pas envoyer actuellement de sms aux parents!
                                                        </p>
                                                    
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-right-listing" role="tabpanel"
                                    aria-labelledby="vert-tabs-right-profile-tab">
                                    <!-- /.card-header -->
                                    <div class="card">
                                        <div class="card-header bg-primary">
                                            <div class="card-title">
                                                <h3 class="text-uppercase text-center font-weight-bold">
                                                    Tous les messages envoyés
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="datatablesExample2"
                                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                    <thead>
                                                        <tr class="text-uppercase small">

                                                            <th>Actions</th>
                                                            <th>Messages</th>
                                                            <th>Destinataire</th>
                                                            <th>Statut</th>
                                                            <th>Date</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        if (isset($messages) && !empty($messages)):
                                                            $count = 1;
                                                            foreach ($messages as $key => $value): 
                                                                if($value['message_category'] == 'parent' && ($value['message_type'] == 'sms')&& ($value['message_status'] == 'send')):
                                                                    ?>
                                                        <tr class="small">
                                                            <td width="1px" class="text-center">
                                                                <a data-toggle="modal"
                                                                    data-target="#update_<?= $value['message_id']; ?>"
                                                                    href="#" class="btn btn-xs btn-info">
                                                                    <span data-toggle="tooltip" data-placement="top"
                                                                        title="Cliquer pour voir le message">
                                                                        <i class="fa fa-info-circle fa-2x"></i></span>
                                                                </a>
                                                            </td>
                                                            <td class="text-uppercase small font-weight-bold">
                                                            <a data-toggle="modal"
                                                                    data-target="#update_<?= $value['message_id']; ?>"
                                                                    href="#" class="text-info">
                                                                    <?= character_limiter($value['message_body'], 30); ?>
                                                                </a>
                                                            </td>
                                                            
                                                            <td class="text-lowercase">
                                                                <?= $value['message_recipient']; ?>
                                                            </td>
                                                            <td class="text-capitalize badge badge-<?= setStatusColors($value['message_status']); ?>">
                                                                <?= getStatusValues($value['message_status']); ?>
                                                            </td>
                                                            <td class="text-lowercase">
                                                                <?= $value['message_created_at']; ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= $value['message_code']; ?>
                                                            </td>
                                                        </tr>
                                                        <!-- update year modal -->
                                                        <div class="modal fade"
                                                            id="update_<?= $value['message_id']; ?>">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">

                                                                        <h4 class="modal-title text-uppercase font-weight-bold">
                                                                            Objet: <?= $value['message_subject']; ?>
                                                                        </h4>
                                                                        <ul class="modal-title text-uppercase font-weight-bold small">
                                                                            <li>Envoyé à: <?= $value['message_recipient']; ?></li>
                                                                            <li>Créé le: <?= $value['message_created_at']; ?></li>
                                                                            <li>Envoyé le: <?= $value['message_updated_at']; ?></li>
                                                                        </ul>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">
                                                                                <i class="fa fa-window-close"></i>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                                <?= $value['message_body']; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm"
                                                                            data-dismiss="modal">Fermer
                                                                        </button>
                                                                            <p class="text-success font-weight-bold">Ce message a été envoyé avec succés. Voulez-vous le renvoyer ?</p>
                                                                            <a href="<?= base_url('resend-message/'.$value['message_token']); ?>"
                                                                                class="btn btn-info btn-sm  <?= ($sending_status == 1) ? '': 'disabled'; ?>"> Renvoyez ce message
                                                                            </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end update year modal -->
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="tab-pane fade" id="vert-tabs-right-draft" role="tabpanel"
                                    aria-labelledby="vert-tabs-right-profile-tab">
                                    <!-- /.card-header -->
                                    <div class="card">
                                        <div class="card-header bg-danger">
                                            <div class="card-title">
                                                <h3 class="text-uppercase text-center font-weight-bold">
                                                    Brouillon (messages non envoyés)
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="datatablesExample2"
                                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                                    <thead>
                                                        <tr class="text-uppercase small">
                                                            <th>Actions</th>
                                                            <th>Messages</th>
                                                            <th>Destinataire</th>
                                                            <th>Statut</th>
                                                            <th>Date</th>
                                                            <th>Code</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        if (isset($messages) && !empty($messages)):
                                                            $count = 1;
                                                            foreach ($messages as $keydraft => $msgvalue): 
                                                            if($msgvalue['message_category'] == 'parent' && ($msgvalue['message_type'] == 'sms')&& ($msgvalue['message_status'] == 'actif')):
                                                            ?>
                                                        <tr class="small">
                                                            <td width="1px" class="text-center">
                                                                <a data-toggle="modal"
                                                                    data-target="#update_<?= $msgvalue['message_id']; ?>"
                                                                    href="#" class="btn btn-xs btn-info">
                                                                    <span data-toggle="tooltip" data-placement="top"
                                                                        title="Cliquer pour voir le message">
                                                                        <i class="fa fa-info-circle fa-2x"></i></span>
                                                                </a>
                                                            </td>
                                                            <td class="text-uppercase small font-weight-bold">
                                                            <a data-toggle="modal"
                                                                    data-target="#update_msg_<?= $msgvalue['message_id']; ?>"
                                                                    href="#" class="text-info">
                                                                    <?= character_limiter($msgvalue['message_body'], 50); ?>
                                                                    
                                                                </a>
                                                            </td>
                                                            
                                                            <td class="text-lowercase">
                                                                <?= $msgvalue['message_recipient']; ?>
                                                            </td>
                                                            <td class="text-capitalize badge badge-<?= setStatusColors($msgvalue['message_status']); ?>">
                                                                <?= getStatusValues($msgvalue['message_status']); ?>
                                                            </td>
                                                            <td class="text-lowercase">
                                                                <?= $msgvalue['message_created_at']; ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= $msgvalue['message_code']; ?>
                                                            </td>
                                                        </tr>
                                                        <!-- update year modal -->
                                                        <div class="modal fade"
                                                            id="update_msg_<?= $msgvalue['message_id']; ?>">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">

                                                                        <h4 class="modal-title text-uppercase font-weight-bold text-center">
                                                                            Objet: <?= $msgvalue['message_subject']; ?>
                                                                        </h4>
                                                                        <ul class="modal-title text-uppercase font-weight-bold small">
                                                                            <li>Envoyé à: <?= $msgvalue['message_recipient']; ?></li>
                                                                            <li>Créé le: <?= $msgvalue['message_created_at']; ?></li>
                                                                            <li>Envoyé le: <?= $msgvalue['message_updated_at']; ?></li>
                                                                        </ul>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">
                                                                                <i class="fa fa-window-close"></i>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="text-center">
                                                                        <?php if($msgvalue['message_status'] == 'actif'){?>
                                                                            <p class="text-danger font-weight-bold">Ce message n'a pas été envoyé. Voulez-vous le renvoyer ?</p>
                                                                            <a href="<?= base_url('resend-message/'.$msgvalue['message_token']); ?>"
                                                                                class="btn btn-outline-danger btn-sm  <?= ($sending_status == 1) ? '': 'disabled'; ?>"> Renvoyez ce message
                                                                            </a>
                                                                            <hr>
                                                                        <?php } ?>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                                <?= $msgvalue['message_body']; ?>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm"
                                                                            data-dismiss="modal">Fermer
                                                                        </button>
                                                                        <?php if($msgvalue['message_status'] == 'actif'){?>
                                                                            <p class="text-primary font-weight-bold">Ce message n'a pas été envoyé. Voulez-vous le renvoyer ?</p>
                                                                            <a href="<?= base_url('resend-message/'.$msgvalue['message_token']); ?>"
                                                                                class="btn btn-primary btn-sm  <?= ($sending_status == 1) ? '': 'disabled'; ?>"> Renvoyez ce message
                                                                            </a>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end update year modal -->
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>