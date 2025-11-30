<div class="content-wrapper <?= checkModuleAccess('messages'); ?>">
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-footer bg-primary">
                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
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
                                    <label for="ajax_sections" class="text-primary">
                                        <span class="text-danger">*</span>Sections organisées</label>
                                </div>
                            </form>

                        </div>

                        <div class="col-sm-8 col-lg-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Communication</li>
                                    <li class="breadcrumb-item active" aria-current="page">Messages systèmes</li>
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
                    <div class="text-center">

                    <h1 class="app-page-title mb-0 font-weight-bold text-uppercase mt-2 ">Messagerie interne</h1>
                    </div>
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

                                                $validation = \Config\Services::validation();
                                                //form
                                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                echo form_open_multipart(base_url('messaging'), $attributes);
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="form-floating mb-3">
                                                            <select id="user" name="user"
                                                                class="form-control select2 select2-info"
                                                                data-dropdown-css-class="select2-info">

                                                                <option disabled selected>-- sélectionnez destinataire--
                                                                </option>
                                                                <?php if (isset($users) && (!empty($users))): ?>
                                                                    <option value="all">Tous les utilisateurs</option>

                                                                    <?php foreach ($users as $key => $parent):
                                                                        if ($parent['branch_section_id'] == session()->get('choosedsectionid')):
                                                                        if (!empty($parent['user_email']) or (!empty($parent['user_phone']))):
                                                                            ?>
                                                                            <option value="<?= ($parent['user_id']); ?>"
                                                                                <?= set_select('user', ($parent['user_id'])); ?>>
                                                                                <?= strtoupper($parent['user_firstname']); ?>
                                                                                <?= strtoupper($parent['user_lastname']); ?>
                                                                                {<?= strtolower($parent['user_email']); ?>}
                                                                                {<?= strtolower($parent['user_phone']); ?>} -
                                                                                <?= ucwords($parent['role_name']); ?>
                                                                            </option>
                                                                        <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <label for="user">
                                                                <span class="text-danger">*</span>Utilisateurs
                                                            </label>
                                                            <?php if ($validation->hasError('user')) { ?>
                                                                <span class="invalid-feedback">
                                                                    <?= $validation->getError('user'); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-floating mb-3">

                                                            <textarea name="sms" id="sms" cols="30" rows="5" maxlength="480"
                                                                placeholder="Descrivez votre message"
                                                                class="form-control <?= ($validation->hasError('sms')) ? ' is-invalid' : '' ?>"><?= set_value('message'); ?></textarea>
                                                            <label for="sms">
                                                                <span class="text-danger"></span>SMS Normal(480 caractères
                                                                max)</label>
                                                            <?php if ($validation->hasError('sms')) { ?>
                                                                <span class="invalid-feedback text-danger">
                                                                    <?= $validation->getError('sms'); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-lg-8 mb-2">
                                                        <div class="form-floating">
                                                            <input type="text" name="subject" id="subject"
                                                                placeholder="Titre. Ex:communiqué spécial"
                                                                class="form-control <?= ($validation->hasError('subject')) ? ' is-invalid' : '' ?>"
                                                                value="<?= set_value('subject'); ?>">
                                                            <?php if ($validation->hasError('subject')) { ?>
                                                                <span class="invalid-feedback">
                                                                    <?= $validation->getError('subject'); ?></span>
                                                            <?php } ?>
                                                            <label for="subject"><span class="text-danger">*</span>Objet du
                                                                message(Email seulement)</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-lg-4 mb-2">
                                                        <div class="form-floating">
                                                            <input type="file" name="attachment" id="attachment"
                                                                class="form-control <?= ($validation->hasError('attachment')) ? ' is-invalid' : '' ?>"
                                                                value="<?= set_value('attachment'); ?>">
                                                            <?php if ($validation->hasError('attachment')) { ?>
                                                                <span class="invalid-feedback">
                                                                    <?= $validation->getError('attachment'); ?></span>
                                                            <?php } ?>
                                                            <label for="attachment"><span class="text-danger"></span>Pièce
                                                                jointe(Email seulement)</label>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-group mb-3">
                                                            <label for="composemessage">
                                                                <span class="text-danger">*</span>Votre message(Email
                                                                seulement)</label>
                                                            <textarea name="message" id="composemessage" cols="30" rows="5"
                                                                placeholder="Description détaillée de votre message"
                                                                class="form-control"><?= set_value('message'); ?></textarea>

                                                            <?php if ($validation->hasError('message')) { ?>
                                                                <span class="invalid-feedback">
                                                                    <?= $validation->getError('message'); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right mt-3">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-check-circle"></i>
                                                        Envoyer message interne
                                                    </button>
                                                </div>

                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-right-listing" role="tabpanel"
                                        aria-labelledby="vert-tabs-right-profile-tab">
                                        <!-- /.card-header -->
                                        <div class="card">
                                            <div class="card-header bg-success">
                                                <div class="card-title">
                                                    <h3 class="text-uppercase text-center font-weight-bold">
                                                        Tous les messages envoyés
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <tbody>

                                                        <?php
                                                        if (isset($messages) && !empty($messages)):
                                                            $count = 1;
                                                            foreach ($messages as $key => $value):
                                                                if ($value['message_category'] == 'system' && ($value['message_type'] == 'email') && ($value['message_status'] == 'send')):
                                                                    ?>

                                                                    <div class="card-header"
                                                                        id="headingOne<?= $value['message_id']; ?>">
                                                                        <h5 class="mb-0 text-uppercase small font-weight-bold">
                                                                            <a data-toggle="modal"
                                                                                data-target="#update_<?= $value['message_id']; ?>"
                                                                                href="#"
                                                                                class="btn btn-link btn-sm btn-block text-left">
                                                                                <span data-toggle="tooltip" data-placement="top"
                                                                                    title="Cliquer pour voir le message">
                                                                                    <?= character_limiter($value['message_subject'], 50); ?>
                                                                                </span>

                                                                                <?php if (!empty($value['message_attachment'])): ?>
                                                                                    <span class="float-right text-right text-dark">
                                                                                        <i class="fa fa-paperclip fa-lg"></i>
                                                                                    </span>
                                                                                <?php endif; ?> | <?= $value['message_created_at']; ?>


                                                                            </a>

                                                                        </h5>
                                                                    </div>
                                                                    <!-- update year modal -->
                                                                    <div class="modal fade" id="update_<?= $value['message_id']; ?>">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <h4
                                                                                        class="modal-title text-uppercase font-weight-bold">
                                                                                        Objet: <?= $value['message_subject']; ?>
                                                                                    </h4>
                                                                                    <ul
                                                                                        class="modal-title text-uppercase font-weight-bold small">
                                                                                        <li>Envoyé à:
                                                                                            <?= $value['message_recipient']; ?>
                                                                                        </li>
                                                                                        <li>Créé le:
                                                                                            <?= $value['message_created_at']; ?>
                                                                                        </li>
                                                                                        <li>Envoyé le:
                                                                                            <?= $value['message_updated_at']; ?>
                                                                                        </li>
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
                                                                                        <?php if (!empty($value['message_attachment'])): ?>
                                                                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                                                <div class="text-center">
                                                                                                    <embed
                                                                                                        src="<?= base_url('public/uploads/files/' . $value['message_attachment']); ?>"
                                                                                                        controls width="100%" height="500">
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                                        data-dismiss="modal">Fermer
                                                                                    </button>
                                                                                    <p class="text-success font-weight-bold">Ce
                                                                                        message été envoyé avec succés. Voulez-vous
                                                                                        le renvoyer ?</p>
                                                                                    <a href="<?= base_url('resend-message/' . $value['message_token']); ?>"
                                                                                        class="btn btn-info btn-sm"> Renvoyez ce
                                                                                        message
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end update year modal -->
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

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
                                                <div class="accordion" id="accordionExample">
                                                    <div class="card">
                                                        <?php
                                                        if (isset($messages) && !empty($messages)):
                                                            $count = 1;
                                                            foreach ($messages as $keydraft => $msgvalue):
                                                                if ($msgvalue['message_category'] == 'parent' && ($msgvalue['message_type'] == 'email') && ($msgvalue['message_status'] == 'actif')):
                                                                    ?>


                                                                    <div class="card-header"
                                                                        id="headingOne<?= $msgvalue['message_id']; ?>">
                                                                        <h5 class="mb-0 text-uppercase small">
                                                                            <button class="btn btn-link btn-sm btn-block text-left"
                                                                                type="button" data-toggle="collapse"
                                                                                data-target="#collapseOne<?= $msgvalue['message_id']; ?>"
                                                                                aria-expanded="true"
                                                                                aria-controls="collapseOne<?= $msgvalue['message_id']; ?>">
                                                                                <?= character_limiter($msgvalue['message_subject'], 25); ?>
                                                                                <?php if (!empty($msgvalue['message_attachment'])): ?>
                                                                                    <span class="float-right text-right text-dark">
                                                                                        <i class="fa fa-paperclip fa-lg"></i>
                                                                                    </span>
                                                                                <?php endif; ?> | <?= $msgvalue['message_recipient']; ?>
                                                                                | <?= $msgvalue['message_created_at']; ?>
                                                                            </button>
                                                                        </h5>
                                                                    </div>

                                                                    <div id="collapseOne<?= $msgvalue['message_id']; ?>"
                                                                        class="collapse"
                                                                        aria-labelledby="headingOne<?= $msgvalue['message_id']; ?>"
                                                                        data-parent="#accordionExample">

                                                                        <div class="card">
                                                                            <div class="card-header">

                                                                                <h4
                                                                                    class="card-title text-uppercase font-weight-bold text-center">
                                                                                    Objet:
                                                                                    <?= $msgvalue['message_subject']; ?>
                                                                                </h4>
                                                                                <ul
                                                                                    class="card-title text-uppercase font-weight-bold small">
                                                                                    <li>Envoyé à:
                                                                                        <?= $msgvalue['message_recipient']; ?>
                                                                                    </li>
                                                                                    <li>Créé le:
                                                                                        <?= $msgvalue['message_created_at']; ?>
                                                                                    </li>
                                                                                    <li>Envoyé le:
                                                                                        <?= $msgvalue['message_updated_at']; ?>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="text-center">
                                                                                    <?php if ($msgvalue['message_status'] == 'actif') { ?>
                                                                                        <p class="text-danger font-weight-bold">
                                                                                            Ce message n'a pas été
                                                                                            envoyé.
                                                                                            Voulez-vous le renvoyer
                                                                                            ?</p>
                                                                                        <a href="<?= base_url('resend-message/' . $msgvalue['message_token']); ?>"
                                                                                            class="btn btn-outline-danger btn-sm">
                                                                                            Renvoyez ce message
                                                                                        </a>
                                                                                        <hr>
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                                                                        <?= $msgvalue['message_body']; ?>
                                                                                    </div>
                                                                                    <?php if (!empty($msgvalue['message_attachment'])): ?>
                                                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                                                            <div class="text-center">
                                                                                                <embed
                                                                                                    src="<?= base_url('public/uploads/files/' . $msgvalue['message_attachment']); ?>"
                                                                                                    controls width="100%" height="500">
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer justify-content-between">

                                                                                <?php if ($msgvalue['message_status'] == 'actif') { ?>
                                                                                    <p class="text-primary font-weight-bold">
                                                                                        Ce
                                                                                        message n'a pas été envoyé.
                                                                                        Voulez-vous
                                                                                        le renvoyer ?</p>
                                                                                    <a href="<?= base_url('resend-message/' . $msgvalue['message_token']); ?>"
                                                                                        class="btn btn-primary btn-sm">
                                                                                        Renvoyez
                                                                                        ce message
                                                                                    </a>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
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
            </div>
        </section>
    <?php endif; ?>
</div>