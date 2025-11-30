<?php if (isset($school) && (!empty($school))): ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header printoff">
        <div class="container">
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('admincustomer/dashboard') ?>">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Vue d'ensemble</li>
                                <li class="breadcrumb-item active">Presentation</li>
                            </ol>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <a href="<?= base_url('admincustomer/schools') ?>" class="btn btn-info btn-sm text-uppercase">
                                <i class="fas fa-reply-all fa-lg"></i>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-tools float-right">
                                <?php if (isset($school) && (!empty($school))): ?>

                                <a class="btn btn-info btnrounded"
                                    href="<?= base_url('admincustomer/editschool/'.$school['school_id']); ?>">
                                    <i class="fas fa-edit"></i> Modifier la fiche</a>

                                <?php endif; ?>
                                <a data-toggle="modal" data-target="#offcanvasimages" data-backdrop="static"
                                    data-keyboard="false" href="#" class="btn btn-primary btn-sm  text-uppercase">
                                    <span data-toggle="tooltip" data-placement="top"
                                        title="Cliquer pour modifier le logo">
                                        <i class="fa fa-plus"></i> Changer le logo
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mt-0">
        <div class="container-fluid">
            <div class="card">
                <?php  $logo_cover = isset($school) ? ($school['school_picture_cover']) : ''; ?>

                <div class="card-footer"
                    style="background-image: url(<?= base_url('public/uploads/images/'.$logo_cover); ?>);">
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 invoice-col border-right">
                            <?php 
                             $logo = isset($school) ? ($school['school_logo']) : ''; 
                             $path_logo = base_url('public/uploads/images/'.$logo);
                             $magstore_logo = base_url('public/img/logo/favicon.png');
                             $valid_logo = (!empty($logo))? $path_logo: $magstore_logo;
                             ?>
                            <div class="logo">
                                <img src="<?= $valid_logo; ?>" alt="..." class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-7 col-sm-7 invoice-col small border-right">
                            <address class="text-center">
                                <span class="h1 text-uppercase font-weight-bold">
                                    <b>
                                        <?= isset($school) ? ($school['school_fullname']) : ''; ?>
                                    </b>
                                </span>
                                <hr><b><?= isset($school) ? ($school['school_slogan']) : ''; ?></b><br>
                                <br>
                                <span class="text-uppercase font-weight-bold h5">
                                    <?= isset($school) ? ($school['school_address']) : ''; ?>
                                </span>
                                <br>
                                <span class="text-uppercase font-weight-bold">
                                    Téléphone:<?= isset($school) ? ($school['school_phone']) : 'N/A'; ?> -
                                    Email:<?= isset($school) ? ($school['school_email']) : 'N/A'; ?>
                                </span>

                                <hr><b>ARRET MINISTERIEL:
                                    <?= isset($school) ? ($school['school_ministry_decree']) : 'N/A'; ?></b><br>

                            </address>
                        </div>
                        <div class="col-lg-3 col-sm-3 invoice-col small">
                            <address>

                                <span class="text-uppercase">
                                    <b>PAYS: <?= isset($school) ? ($school['school_country']) : 'N/A'; ?></b><br>
                                    <hr><b>Province:
                                        <?= isset($school) ? ($school['school_province']) : 'N/A'; ?></b><br>
                                    <hr><b>Ville: <?= isset($school) ? ($school['school_city']) : 'N/A'; ?></b><br>

                                </span>
                            </address>
                        </div>

                    </div>
                </div>
            </div>



            <div class="text-center border-bottom">
                <h5 class="app-card-title text-uppercase fw-bold">
                    <?= $school['school_notes']; ?>
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
                                        <span>Responsable de l'école</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_manager_name']; ?></h3>

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
                                        <span>Numéro de contact</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_phone']; ?></h3>

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
                                        <?= $school['school_email']; ?></h3>

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
                                        <?= $school['school_website']; ?></h3>

                                </div>

                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-map-marker"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Adresse de l'école</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase h5 fw-bold">
                                        <?= $school['school_address']; ?></h3>

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
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-body p-3 px-4 w-100">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-user-secret"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Code d'identification de l'école</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_code']; ?></h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Sigle de l'école</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_shortname']; ?></h3>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                            <hr>

                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Slogan de l'école</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_slogan']; ?></h3>

                                </div>
                                <!--//col-->
                            </div>
                            <hr>

                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-sync"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Etat de l'école</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_status']; ?></h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Date de création</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_created_at']; ?></h3>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-lg-6-->
                </div>
                <!--//row-->
            </div>
            <!--//row-->
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="printoff">
                        <div class="text-center ">
                            <a href="javascript:void();" class="btn btn-success btn-rounded text-uppercase btn-sm"
                                onclick="window.print();">
                                <i class="fa fa-print"></i> Imprimer cette fiche</a>
                        </div>
                    </div>
                </div>
            </div>

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
                echo form_open_multipart(base_url('admincustomer/changelogo/'.$school['school_id']), $attributes); ?>
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