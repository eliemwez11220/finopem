<div class="content-wrapper">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Centre d'aide</li>
                    <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                </ol>
            </nav>

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

                    <div class="card-body">
                        <div class="text-center py-5 bg-info">

                            <h1 class="app-page-title mb-0 font-weight-bold text-uppercase">
                                Suggestions des nouvelles fonctionnalités</h1>
                        </div>

                        <?php $validation = \Config\Services::validation();
                        $attributes = array('role' => "form", 'class' => "formsend");
                        echo form_open_multipart(base_url('feedback'), $attributes); ?>
                        <div class="row">
                        <input type="hidden" name="schooltoken" value="<?= $school['school_token']; ?>" />
                           
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="schoolname"
                                        class="form-control text-capitalize <?= ($validation->hasError('schoolname')) ? ' is-invalid' : '' ?>"
                                        id="schoolname" value="<?= $school['school_fullname']; ?>" />
                                    <label for="schoolname" class="label-control"><span class="text-danger">*</span>
                                        Etablissement</label>
                                    <span class="invalid-feedback">
                                        <?= displayFormError($validation, 'schoolname'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="schoolname"
                                        class="form-control text-capitalize <?= ($validation->hasError('schoolname')) ? ' is-invalid' : '' ?>"
                                        id="schoolname" value="<?= session()->get('username'); ?>" />
                                    <label for="schoolname" class="label-control">
                                        <span class="text-danger">*</span>
                                        Agent</label>
                                    <span class="invalid-feedback">
                                        <?= displayFormError($validation, 'schoolname'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div class="form-floating mb-2">

                                    <textarea rows="10" cols="30" class="form-control" name="notes"
                                        placeholder="Ex:Décrivez-nous votre suggestion sur la nouvelle fonctionnalité"
                                        id="notes" autofocus><?= set_value('notes'); ?></textarea>
                                    <label for="notes" class="control-label">
                                        <span class="text-danger">*</span>Vos suggestions
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-floating mb-2">

                                    <input type="file" name="attachfile"
                                        class="form-control <?= ($validation->hasError('attachfile')) ? ' is-invalid' : '' ?>"
                                        id="attachfile" />
                                    <label for="attachfile" class="label-control"><span class="text-danger"></span>
                                        Piece jointe(Capture ou Document) descriptif </label>
                                    <span class="invalid-feedback">
                                        <?= displayFormError($validation, 'attachfile'); ?>
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btnrounded">
                                <i class="fas fa-send"></i> Envoyer ma suggestion
                            </button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>
</div>