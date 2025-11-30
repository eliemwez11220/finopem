<?php if (isset($message) && (!empty($message))): ?>
    <div class="app-content pt-3 p-md-3 p-lg-4 <?= checkModuleAccess(null, 'admins'); ?>">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Communication</li>
                    <li class="breadcrumb-item active" aria-current="page">Messages</li>
                </ol>
            </nav>

            <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 text-uppercase">
                        Client: <?= $message['con_name']; ?>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn btn-outline-primary btn-sm"
                                   href="<?= base_url('admin/view/messages'); ?>">
                                    <i class="fas fa-chevron-left"></i> Liste
                                </a>
                                
                                    <a class="btn btn-danger btn-sm"
                                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce message ?'); false;"
                                   href="<?= base_url('admin/remove/message/'.$message['con_uid']); ?>">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                               
                                <a data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_response_msg" 
                                    aria-controls="offcanvas_response_msg" aria-expanded="false"
                                    class="btn btn-success btn-sm"
                                   href="<?= base_url('admin/edit/message/'.$message['con_uid']); ?>">
                                    <i class="fas fa-edit"></i> Répondre
                                </a>
                               
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <div class="row section">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="">
                                      Objet:
                                    </div><!--//icon-holder-->
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h3 class="app-card-title small text-uppercase fw-bold">
                                        <?= $message['con_subject']; ?>
                                    </h3>
                                    <div class="app-card-title">
                                        <h5 class="small">
                                            <span class="fw-bold text-end">Envoyé le:<?= $message['con_created_at']; ?></span>
                                        </h5>
                                    </div><!--//col-->
                                </div><!--//col-->
                            </div><!--//row-->
                        
                        <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Email</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold small text-lowercase">
                                            <?= $message['con_email']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Téléphone:</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                    <span class="h5 fw-bold text-capitalize">
                                        <?= $message['con_phone']; ?>
                                    </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Etat du message</strong></div>
                                        <!-- <div class="item-data">James Doe</div> -->
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="fw-bold text-capitalize">
                                            <?= $message['con_status']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        </div><!--//app-card-header-->
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-body px-4 w-100">
                            
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>
                                            Description du message
                                        </strong></div>
                                        <!-- -->
                                        <div class="item-data">
                                            <?= $message['con_description']; ?>
                                        </div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div>
                            <hr>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2">
                                            <h5>
                                                <span class="fw-bold text-end">
                                                Répondu le:<?= $message['con_updated_at']; ?></span>
                                            </h5>
                                            <strong>Réponse envoyée</strong>
                                        </div>
                                        <!-- -->
                                        <div class="item-data">
                                            <?= $message['con_response']; ?>
                                        </div>
                                    </div><!--//col-->
                                    <div class="col text-end">
                                        <span class="h5 fw-bold text-uppercase"></span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </div>
        </div>
    </div>
    <!-- END POPUP -->
<!-- ====== SIDEBAR RIGHT VISIBLE ON MOBILE DEVICE ONLY====== -->
<div class="offcanvas offcanvas-end bg-gray text-white" tabindex="-1" id="offcanvas_response_msg"
     aria-labelledby="offcanvas_response_msg_label">
    <div class="offcanvas-header text-white">
      <h5 class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
          <i class="fas fa-comments"></i>
          <span class="fs-5 fw-semibold">
            Répondre au Message de <br>
            <?= $message['con_name']; ?>
            <br>
            <?= $message['con_subject']; ?>
        </span>
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 100%!important;">
            
            <div class="list-group list-group-flush border-bottom scrollarea">
                <?= form_open(base_url('admin/responseMessage/'.$message['con_uid'])); ?>
                   <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control text-center" placeholder="Décrivez la réponse ici..." name="response" id="response" cols="30" rows="10"></textarea>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary btn-lg">Répondre au message</button>
                    </div>
                   </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>