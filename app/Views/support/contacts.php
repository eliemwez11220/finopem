<div class="content-wrapper">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Centre d'aide</li>
                    <li class="breadcrumb-item active" aria-current="page">Assistance</li>
                </ol>
            </nav>
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Assistance technique</h1>
                    <p>
                        Contactez-nous pour une assistance technique pour vous aider dans votre 
                        utilisation de notre solution de gestion scolaire en induant votre 
                        etablissement 
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($school) && (!empty($school))): ?>

    <!-- Main content -->
    <section class="content mt-0">
        <div class="container-fluid">
            <div class="card">

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 invoice-col border-right">

                            <div class="logo">
                                <img src="<?= base_url('public/img/logo/favicon.png'); ?>" alt="DITOTASE"
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-7 invoice-col small border-right">
                            <address class="text-center">
                                <span class="h1 text-uppercase font-weight-bold">
                                    <b>
                                        MAGSCHOOL
                                    </b>
                                </span>
                                <hr><b class="h5">SYSTEME DE GESTION SCOLAIRE</b><br>
                                <br>
                                <span class="text-uppercase font-weight-bold h5">
                                    41, Avenue Mwepu, Lubumbashi, HAUT-KATANGA, RDC
                                </span>
                                <br>
                            </address>
                        </div>
                        <div class="col-lg-3 col-sm-3 invoice-col small">
                            <address>

                                <span class="text-uppercase font-weight-bold h5">
                                    <b>
                                        <i class="fab fa-whatsapp"></i> 
                                        <a href="https://wa.me/+243858533285">
                                            +243 85 85 332 85
                                        </a>
                                    </b><br>
                                    <hr><b>
                                    <i class="fas fa-phone"></i> 
                                        <a href="tel:+243997276670">
                                        +243 99 72 766 70
                                        </a>
                                    </b><br>
                                    <hr><b>
                                    <i class="fas fa-envelope"></i> 
                                        <a href="mailto:magschool@ditotase.com" class="text-lowercase">
                                            magschool@ditotase.com
                                        </a>
                                    </b><br>

                                </span>
                            </address>
                        </div>

                    </div>
                </div>
            </div>



            <div class="text-center border-bottom py-5">
                <h5 class="app-card-title text-uppercase fw-bold">
                Ditotase est une agence digitale spécialisée dans la formation professionnelle en numérique, le marketing digitale et le développement d'applications ainsi que la création des sites internet d'entreprise modernes. Nous accompagnons les entreprises dans leur transformation numérique avec de solutions logicielles sur-mesure. Basée à Lubumbashi en République Démocratique du Congo."
                </h5>
            </div>
            <div class="row">
               
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-body p-3 px-4 w-100">

                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Responsable du projet</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        M. Vivien Mumba
                                    </h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Numéro de contact du Responsable</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <a href="tel:+243997276670" target="_blank">+243 99 72 766 70</a>
                                    </h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->

                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Adresse mail</span>
                                    </h5>
                                    <h3 class="app-card-title text-lowercase fw-bold">
                                        <a href="mailto:vivien.mumba@ditotase.com" target="_blank">vivien.mumba@ditotase.com</a>
                                    </h3>

                                </div>

                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Website</span>
                                    </h5>
                                    <h3 class="app-card-title text-lowercase fw-bold">
                                        <a href="https://ditotase.com" target="_blank">www.ditotase.com</a>
                                    </h3>

                                </div>

                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>WhatsApp</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <a href="https://wa.me/+243997276670" target="_blank">+243 997 276 670</a>
                                    </h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->

                        </div>
                    </div>
                    <!--//col-lg-6-->
                </div>
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-body p-3 px-4 w-100">

                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Devéloppeur du projet</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        M. Elie Mwez
                                    </h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Numéro de contact Devéloppeur</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <a href="tel:+243977090011" target="_blank">+243 977 090 011</a>
                                    </h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->

                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Adresse mail</span>
                                    </h5>
                                    <h3 class="app-card-title text-lowercase fw-bold">
                                        <a href="mailto:rubuz@ditotase.com" target="_blank">rubuz@ditotase.com</a>
                                    </h3>

                                </div>

                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Website</span>
                                    </h5>
                                    <h3 class="app-card-title text-lowercase fw-bold">
                                        <a href="https://ditotase.com" target="_blank">www.ditotase.com</a>
                                    </h3>

                                </div>

                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>WhatsApp</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <a href="https://wa.me/+243858533285" target="_blank">+243 85 85 332 85</a>
                                    </h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->

                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <!--//row-->
            </div>
            <!--//row-->


        </div>
    </section>
</div>

<div class="modal fade" id="offcanvasimages">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title d-inline-flex">
                    <span id="offcanvasEditLabel" class="h5 text-uppercase">
                        Changement du logo de l'école
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">
                            <i class="fa fa-window-close"></i>
                        </span>
                    </button>
            </div>
            <div class="modal-body">
                <?php $validation = \Config\Services::validation();
                $attributes = array('role' => "form", 'class' => "formsend");
                echo form_open_multipart(base_url('school/changelogo/'.$school['school_id']), $attributes); ?>
                <div class="row">
                    <input type="hidden" name="schooltoken" value="<?= $school['school_token']; ?>" />
                    <div class="col-md-12 form-group">
                        <label for="logo" class="label-control">
                            <span class="text-danger">*</span>Charger le logo de l'école</label>
                        <input type="file" name="logo"
                            class="form-control btnrounded <?= ($validation->hasError('logo')) ? ' is-invalid' : '' ?>"
                            id="logo">
                        <span class="invalid-feedback"><?= displayFormError($validation, 'logo'); ?></span>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="picture" class="label-control"><span class="text-danger"></span>
                            Photo de couverture de l'école</label>
                        <input type="file" name="picture"
                            class="form-control btnrounded <?= ($validation->hasError('picture')) ? ' is-invalid' : '' ?>"
                            id="picture">
                        <span class="invalid-feedback"><?= displayFormError($validation, 'picture'); ?></span>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btnrounded">
                        Valider le changement du logo</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- ====== END FEEDBACK====== -->
<?php endif; ?>
</div>