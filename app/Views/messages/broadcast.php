<div class="content-wrapper <?= checkModuleAccess('sms'); ?>">
    <section class="content">
        <div class="container py-3">
            <div class="row">
                <div class="col-sm-6 col-lg-8">
                    <form role="form" id="ajax_form_sections" method="get">
                        <div class="form-floating input-group" style="width: 100%!important;">
                            <select id="ajax_sections" name="ajax_sections" title="Classe"
                                class="form-control select2 select2-info" data-dropdown-css-class="select2-info">
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
                <div class="col-sm-6 col-lg-4">
                    <nav aria-label="breadcrumb" class="container-fluid">
                        <ol class="breadcrumb bg-info">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Communication</li>
                            <li class="breadcrumb-item active" aria-current="page">Broadcast</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <?php if (session()->has('choosedsectionid')): ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-lg-8">
                    <h1 class="app-page-title mb-0 text-uppercase font-weight-bold">Messages Broadcast</h1>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card-tools float-right">
                        <a data-toggle="modal" data-target="#nouvel_element" href="#"
                            class="btn btn-primary text-uppercase">
                            <span data-toggle="tooltip" data-placement="top" title="Cliquer pour créer un contact">
                                <i class="fa fa-user-plus"></i> Repertoire contacts
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                                        <div class="card-body">
                                            <?php

                                                $sending_status = session()->has('schoolsmsstatus') ? session()->get('schoolsmsstatus') : 0;

                                                if ($sending_status == 1):


                                                    $validation = \Config\Services::validation();
                                                    //form
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open_multipart(base_url('sendMessageBroadcast'), $attributes);
                                                    ?>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-floating mb-3">
                                                        <select id="contact" name="contact"
                                                            class="form-control select2 select2-info"
                                                            data-dropdown-css-class="select2-info">

                                                            <option disabled selected>-- sélectionnez destinataire--
                                                            </option>
                                                            <?php if (isset($contacts) && (!empty($contacts))): ?>
                                                            <option value="all">Tous les contacts</option>

                                                            <?php foreach ($contacts as $key => $contact):
                                                                            $branch_access = session()->get('choosedsectionid');
                                                                            if (($branch_access == $contact['contact_section_id']) && ($contact['contact_status']=='actif')):
                                                                                    ?>
                                                            <option value="<?= ($contact['contact_id']); ?>"
                                                                <?= set_select('contact', $contact['contact_id']); ?>>

                                                                <?= strtoupper($contact['contact_name']); ?>
                                                                (<?= strtoupper($contact['contact_title']); ?>) | 
                                                                <?= $contact['contact_phone']; ?>
                                                                {<?= $contact['contact_email']; ?>}
                                                            </option>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            <?php else: ?>
                                                            <option selected disabled>
                                                                Aucun contact dans cette section. Veuillez choisir
                                                                une
                                                                autre
                                                            </option>
                                                            <?php endif; ?>
                                                        </select>
                                                        <label for="contact">
                                                            <span class="text-danger">*</span>Contacts
                                                        </label>
                                                        <?php if ($validation->hasError('contact')) { ?>
                                                        <span class="invalid-feedback">
                                                            <?= $validation->getError('contact'); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">

                                                        <textarea name="sms" id="sms" cols="30" rows="5"
                                                            maxlength="480" placeholder="Descrivez votre sms"
                                                            class="form-control <?= ($validation->hasError('sms')) ? ' is-invalid' : '' ?>"><?= set_value('sms'); ?></textarea>
                                                        <label for="sms">
                                                            <span class="text-danger">*</span>Votre SMS seulement(480
                                                            caractères max)</label>
                                                        <?php if ($validation->hasError('sms')) { ?>
                                                        <span class="invalid-feedback text-danger">
                                                            <?= $validation->getError('sms'); ?></span>
                                                        <?php } ?>
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
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-check-circle"></i>
                                                    Envoyer message
                                                </button>
                                            </div>

                                            <?php echo form_close(); ?>
                                            <?php else: ?>
                                            <div class="alert alert-info py-3">
                                                <p class="text-danger text-center font-weight-bold">
                                                    L'envoi de messages est désactivé. Vous ne pouvez pas envoyer
                                                    actuellement de sms aux parents!
                                                </p>

                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
            <div class="shadow-sm">
                <div class="text-center">
                    <h3 class="font-weight-bold text-uppercase">Repertoire de contacts</h3>
                </div>

                <div class="table-responsive">
                    <table id="datatablesExample2"
                        class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr class="text-uppercase small">
                                <th>Actions</th>
                                <th>Nom</th>
                                <th>Titre</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Code</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                                            if (isset($contacts) && !empty($contacts)):
                                                                $count = 1;
                                                                foreach ($contacts as $keycontact => $valcontact):
                                                                    $branch_access = session()->get('choosedsectionid');
                                                                    if (($branch_access == $valcontact['contact_section_id'])):
                                                                ?>
                            <tr class="small">
                                <td width="1px" class="text-center">
                                    <a data-toggle="modal" data-target="#update_msg_<?= $valcontact['contact_id']; ?>"
                                        href="#" class="btn btn-xs btn-info">
                                        <span data-toggle="tooltip" data-placement="top"
                                            title="Cliquer pour voir le message">
                                            <i class="fa fa-info-circle fa-2x"></i></span>
                                    </a>
                                </td>
                                <td class="text-uppercase small font-weight-bold">
                                    <a data-toggle="modal" data-target="#update_msg_<?= $valcontact['contact_id']; ?>"
                                        href="#" class="text-info">
                                        <?= trim($valcontact['contact_name']); ?>

                                    </a>
                                </td>

                                <td class="text-uppercase">
                                    <?= $valcontact['contact_title']; ?>
                                </td>
                                <td class="text-lowercase font-weight-bold">
                                    <?= $valcontact['contact_phone']; ?>
                                </td>
                                <td class="text-lowercase">
                                    <?= $valcontact['contact_email']; ?>
                                </td>
                                <td class="text-capitalize">
                                    <?= $valcontact['contact_address']; ?>
                                </td>
                                <td class="text-capitalize">
                                    

                                    <a href="<?= base_url('main/changeStatus/contact/' . $valcontact['contact_status'] . '/' . esc($valcontact['contact_id'])); ?>"
                                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                                    <span
                                                                        class="badge  badge-<?= setStatusColors($valcontact['contact_status']); ?>">
                                                                        <?= getStatusValues($valcontact['contact_status']); ?></span>
                                                                </a>
                                </td>
                                <td class="text-lowercase">
                                    <?= $valcontact['contact_created_at']; ?>
                                </td>
                                <td class="text-uppercase">
                                    <?= $valcontact['contact_code']; ?>
                                </td>
                            </tr>
                            <!-- update year modal -->
                            <div class="modal fade" id="update_msg_<?= $valcontact['contact_id']; ?>">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title text-uppercase font-weight-bold text-center">
                                                Modification contact <?= $valcontact['contact_name']; ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    <i class="fa fa-window-close"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-message-contact'), $attributes);
            ?>
            <div class="modal-body">
                <input type="hidden" name="token" value="<?= $valcontact['contact_token']; ?>"/>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="text" class="form-control text-capitalize" name="name" id="name"
                                autocomplete="off" value="<?= ($valcontact['contact_name']) ? $valcontact['contact_name']: old('name') ?>"
                                style="border-radius: 10px!important;" placeholder="Ex: Ilunga Jean" />
                            <label for="name" class="control-label">
                                <span class="text-danger">*</span>Nom du contact
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="title" id="title" value="<?= ($valcontact['contact_title']) ? $valcontact['contact_title']:old('title'); ?>"
                                placeholder="Ex:Gestionnaire" />
                            <label for="title" class="control-label">
                                <span class="text-danger"></span>Titre de votre contact
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating  input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="phone" id="phone"
                                value="<?= ($valcontact['contact_phone']) ? $valcontact['contact_phone']:old('phone') ?>" data-inputmask='"mask": "+243999999999"' data-mask
                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                data-placement="bottom" title="Numéro téléphone du contact" required>


                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating  input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" name="email" id="email"
                                value="<?= ($valcontact['contact_email']) ? $valcontact['contact_email']:old('email') ?>" data-inputmask="'alias': 'email'" data-mask
                                placeholder="Ex: ilunga@ditotase.com" autocomplete="off" data-toggle="tooltip"
                                data-placement="bottom" title="Adresse mail du contact">


                            <!-- /.input group -->
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="address" id="address"
                                value="<?= ($valcontact['contact_address']) ? $valcontact['contact_address']:old('address'); ?>" placeholder="Ex:Lubumbashi, RDC" />
                            <label for="address" class="control-label">
                                <span class="text-danger"></span>Adresse de votre contact
                            </label>
                        </div>

                    </div>

                </div>

            </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Fermer
                                            </button>
                                            <button type="submit" class="btn btn-info text-uppercase">
                                                Enregistrer les Modifications
                                            </button>
                                        </div>
                                        <?php echo form_close(); ?>
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
    </section>
    <?php endif; ?>
</div>


<!-- Creation nouvelle annee scolaire -->
<div class="modal fade" id="nouvel_element">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-uppercase">Nouveau contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-message-contact'), $attributes);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="text" class="form-control text-capitalize" name="name" id="name"
                                autocomplete="off" value="<?= set_value('name') ?>"
                                style="border-radius: 10px!important;" placeholder="Ex: Ilunga Jean" />
                            <label for="name" class="control-label">
                                <span class="text-danger">*</span>Nom du contact
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="title" id="title" value="<?= old('title'); ?>"
                                placeholder="Ex:Gestionnaire" />
                            <label for="title" class="control-label">
                                <span class="text-danger"></span>Titre de votre contact
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating  input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="phone" id="phone"
                                value="<?= set_value('phone') ?>" data-inputmask='"mask": "+243999999999"' data-mask
                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                data-placement="bottom" title="Numéro téléphone du contact" required>


                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 mb-2">
                        <div class="form-floating  input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" name="email" id="email"
                                value="<?= set_value('email') ?>" data-inputmask="'alias': 'email'" data-mask
                                placeholder="Ex: ilunga@ditotase.com" autocomplete="off" data-toggle="tooltip"
                                data-placement="bottom" title="Adresse mail du contact">


                            <!-- /.input group -->
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="address" id="address"
                                value="<?= old('address'); ?>" placeholder="Ex:Lubumbashi, RDC" />
                            <label for="address" class="control-label">
                                <span class="text-danger"></span>Adresse de votre contact
                            </label>
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-info text-uppercase">
                    Enregistrer le contact
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer la page
                </button>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>