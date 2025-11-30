<?php if (isset($customer) && (!empty($customer))): ?>
    <div class="app-content pt-3 p-md-3 p-lg-4 <?= checkModuleAccess(null, 'admins'); ?>">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carnet d'adresses</li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
            </nav>

            <div class="row g-3 mb-4 align-items-center justify-content-between printoff">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0 h5 fw-bold text-capitalize">
                        <?= $customer['client_name']; ?>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                
                                
                                <a class="btn btn-dark btn-sm"
                                   href="<?= base_url('admin/view/customers'); ?>">
                                    <i class="fas fa-chevron-left"></i> Liste
                                </a>
                                <a class="btn btn-danger btn-sm"
                                    onclick="return confirm('Etes-vous sûr de vouloir supprimer ce client ?'); false;"
                                   href="<?= base_url('admin/remove/customer/'.$customer['client_uid']); ?>">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                                <a class="btn btn-primary btn-sm"
                                   href="<?= base_url('admin/edit/customer/'.$customer['client_uid']); ?>">
                                    <i class="fas fa-edit"></i> Editer
                                </a>
                                <a class="btn btn-success btn-sm"
                                    onclick="return confirm('Etes-vous sûr de vouloir publier ce client sur votre site internet ?'); false;"
                                   href="<?= base_url('admin/publish/customer/'.$customer['client_category'].'/'.$customer['client_uid']); ?>">
                                    <i class="fas fa-reply"></i> Publier
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->
            <div class="alert alert-primary">
            <div class="text-center">
                <h1>Fiche d'informations sur un client</h1>
            </div></div>
            <div class="row section">
                
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-body px-4 w-100">
                            
                            <div class="text-center">
                                <img src="<?= base_url('public/uploads/images/' . $customer['client_image']); ?>"
                                                            alt="IMG" class="avatar avatar-xxl"/>
                            </div><!--//icon-holder-->
                             <div class="row align-items-center border-bottom py-3">
                                <div class="col-auto">
                                    <div class="">
                                       <i class="fas fa-user fa-lg"></i>
                                    </div><!--//icon-holder-->
                                </div><!--//col-->
                                <div class="col-auto">
                                    <h5 class="fw-bold border-bottom small">
                                        <span>Nom du client</span>
                                    </h5>
                                    <h5 class="app-card-title text-uppercase fw-bold">
                                        <?= $customer['client_name']; ?>
                                    </h5>
                                </div><!--//col-->
                            </div><!--//row-->

                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-info-circle"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Titre du client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_jobtitle']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->

                            <div class="item border-bottom py-3">
                                <div class="row  align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-envelope"></i></div>
                                        </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Téléphone</strong></div>
                                        <span class="h5 fw-bold text-capitalize">
                                            <?= $customer['client_phone']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        </div><!--//row-->
                    </div><!--//item-->
                </div><!--//col-->
                <div class="col-12 col-lg-8">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                           
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-envelope"></i></div>
                                       
                                    </div><!--//col-->
                                    <div class="col-auto">
                                    <div class="item-data"><strong>Email</strong></div>
                                        <span class="h5 fw-bold text-lowercase">
                                            <?= $customer['client_email']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row  align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fab fa-whatsapp"></i></div>
                                        </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>WhatsApp</strong></div>
                                        <span class="h5 fw-bold text-capitalize">
                                            <?= $customer['client_whatsapp']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-users"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Code du client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_login']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-map-marker"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Adresse du client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_address']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-info-circle"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>A propos du client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_about']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        </div><!--//app-card-header-->
                    </div><!--//app-card-->
                </div><!--//col-->
                <div class="col-12 col-lg-12">
                    <div class="app-card app-card-account shadow-lg d-flex flex-column align-items-start">
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-info-circle"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Localisation du client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_city']; ?> - <?= $customer['client_country']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3 bg-info">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-info-circle"></i></div>
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Catégorie du client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_category']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-sync"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Statut client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_status']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->

                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-book"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Type de client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_type']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->

                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-calendar"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Date de création client</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_created_at']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><i class="fas fa-calendar"></i></div>
                                        
                                    </div><!--//col-->
                                    <div class="col-auto">
                                        <div class="item-data"><strong>Dernière mise à jour</strong></div>
                                        <span class="fw-bold text-capitalize">
                                            <?= $customer['client_updated_at']; ?>
                                        </span>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//item-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->

            </div>
        </div>
    </div>
<?php endif; ?>