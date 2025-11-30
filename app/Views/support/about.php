<div class="content-wrapper">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Centre d'aide</li>
                    <li class="breadcrumb-item active" aria-current="page">A propos du produit</li>
                </ol>
            </nav>
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">A propos de l'application</h1>
                    <p>
                        En savoir plus sur la solution de gestion des etablissements scolaires(
                            Vision, Fonctionnalites et Modules, Portee du projet, etc.
                        )
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
                                    Concu pour ameliorer la vie de travailleur au sein des espaces scolaires
                                </span>
                                <br>
                            </address>
                        </div>
                        <div class="col-lg-3 col-sm-3 invoice-col small">
                            <address>

                                <span class="font-weight-bold h5">
                                    <b>Version: v2.2.0</b><br>
                                    <hr><b>Langage: PHP & JS</b><br>
                                    <hr><b>SGBD:MySQL</b><br>

                                </span>
                            </address>
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