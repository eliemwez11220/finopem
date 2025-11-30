<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-footer bg-primary">
                    <div class="row">

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
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title">
                        <h3 class="text-uppercase text-center font-weight-bold">
                            Messageries
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
                                                                if (($value['message_recipient'] == session()->email)):
                                                                    ?>

                            <div class="card-header" id="headingOne<?= $value['message_id']; ?>">
                                <h5 class="mb-0 text-uppercase small font-weight-bold">
                                    <a data-toggle="modal" data-target="#update_<?= $value['message_id']; ?>" href="#"
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

                                            <h4 class="modal-title text-uppercase font-weight-bold">
                                                Objet: <?= $value['message_subject']; ?>
                                            </h4>
                                            <ul class="modal-title text-uppercase font-weight-bold small">
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
    </section>
    <?php endif; ?>
</div>