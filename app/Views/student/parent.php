<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('parents'); ?>">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">

            <div class="row mb-2">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dossiers scolaires</li>
                            <li class="breadcrumb-item active" aria-current="page">Parents</li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('student/parents'); ?>"
                                    class="btn btn-info btn-rounded text-uppercase float-right">
                                    <i class="fas fa-reply fa-lg"></i>
                                </a>
                            </li>
                        </ol>
                    </nav>

                </div>

            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <?php
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('student-create-parent'), $attributes);
                    ?>

                        <div class="card">
                            <div class="card-header bg-info text-center">
                                <h1 class="=text-uppercase font-weight-bold">Création fiche parent</h1>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-floating mb-2">

                                            <input type="text" class="form-control text-capitalize"
                                                name="nom_pere_eleve" id="nom_pere_eleve" autocomplete="off"
                                                value="<?= set_value('nom_pere_eleve') ?>"
                                                style="border-radius: 10px!important;" placeholder="Ex: Ilunga Jean" />
                                            <label for="nom_pere_eleve" class="control-label">
                                                <span class="text-danger">*</span>Nom du père
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-floating  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_pere" id="phone_pere"
                                                value="<?= set_value('phone_pere') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="Numéro téléphone du père">


                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_pere2" id="phone_pere2"
                                                value="<?= set_value('phone_pere2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="Second numéro téléphone du père ">


                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">

                                            <input type="text" class="form-control text-capitalize"
                                                name="nom_mere_eleve" id="nom_mere_eleve" autocomplete="off"
                                                value="<?= set_value('nom_mere_eleve') ?>"
                                                style="border-radius: 10px!important;" placeholder="Ex: Melanie Moya" />
                                            <label for="nom_mere_eleve" class="control-label">
                                                <span class="text-danger">*</span>Nom de la mère
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_mere" id="phone_mere"
                                                value="<?= set_value('phone_mere') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="numéro téléphone de la mère ">


                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_mere2" id="phone_mere2"
                                                value="<?= set_value('phone_mere2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="Second numéro téléphone de la mère ">


                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">

                                            <input type="text" class="form-control text-capitalize"
                                                name="nom_tuteur_eleve" id="nom_tuteur_eleve" autocomplete="off"
                                                value="<?= set_value('nom_tuteur_eleve') ?>"
                                                style="border-radius: 10px!important;" placeholder="Ex: Jean Ilunga" />
                                            <label for="nom_tuteur_eleve" class="control-label">
                                                <span class="text-danger"></span> Nom du tuteur
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_tuteur"
                                                id="telephone_tuteur" value="<?= set_value('telephone_tuteur') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="numéro téléphone du tuteur">

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_tuteur2"
                                                id="telephone_tuteur2" value="<?= set_value('telephone_tuteur2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off" data-toggle="tooltip"
                                                data-placement="bottom" title="second numéro téléphone du tuteur">

                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">
                                           
                                            <input type="text" class="form-control text-capitalize"
                                                name="profession_pere" id="profession_pere" autocomplete="off"
                                                value="<?= set_value('profession_pere') ?>"
                                                style="border-radius: 10px!important;" placeholder="Ex:Informaticien" />
                                                <label for="profession_pere" class="control-label">
                                                <span class="text-danger"></span> Profession du père
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">
                                           
                                            <input type="text" class="form-control text-capitalize"
                                                name="profession_mere" id="profession_mere" autocomplete="off"
                                                value="<?= set_value('profession_mere') ?>"
                                                style="border-radius: 10px!important;"  placeholder="Ex:vendeuse"/>
                                                <label for="profession_mere" class="control-label">
                                                <span class="text-danger"></span> Profession de la mère
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="form-floating">
                                            
                                            <input type="text" class="form-control text-capitalize"
                                                name="profession_tuteur" id="profession_tuteur" autocomplete="off"
                                                value="<?= set_value('profession_tuteur') ?>"
                                                style="border-radius: 10px!important;"  placeholder="Ex:Courtier"/>
                                                <label for="profession_tuteur" class="control-label">
                                                <span class="text-danger"></span> Profession du tuteur
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="phone_sms"><span class="text-danger">*</span>Personne
                                                Responsable à contacter en cas d'urgence
                                                :</label>
                                            <div class="input-group">
                                                <div class="icheck-success d-inline mr-3">
                                                    <input type="radio" name="phone_sms" checked id="pere" value="pere">
                                                    <label for="pere">
                                                        Père
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline mr-3 ml-3">
                                                    <input type="radio" name="phone_sms" id="mere" value="mere">
                                                    <label for="mere">
                                                        Mère
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input type="radio" name="phone_sms" id="tuteur" value="tuteur">
                                                    <label for="tuteur">
                                                        Tuteur
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="phone_primary"><span class="text-danger">*</span>Numéro
                                                téléphone principal du responsable à contacter d'urgence
                                                :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="phone_primary"
                                                    id="phone_primary" value="<?= set_value('phone_primary') ?>"
                                                    data-inputmask='"mask": "+243999999999"' data-mask
                                                    placeholder="Ex: 858533285" autocomplete="off">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email_tuteur">
                                                <span class="text-danger"></span>Adresse E-mail principale du
                                                responsable à contacter
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email_tuteur"
                                                    id="email_tuteur" value="<?= set_value('email_tuteur') ?>"
                                                    autocomplete="off">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 mb-2">
                                        <!-- radio -->
                                        <div class="form-floating">
                                            <select id="type_parent" name="type_parent" title="sexe"
                                                class="form-control <?= ($validation->hasError('type_parent')) ? ' is-invalid' : '' ?>"
                                                style="width: 100%;">
                                                <option selected="selected" disabled>-- Sélectionnez --
                                                </option>
                                                <option value="biologique"
                                                    <?= set_select('type_parent', 'biologique'); ?>>
                                                    Biologique
                                                </option>
                                                <option value="adoptif"
                                                    <?= set_select('type_parent', 'adoptif'); ?>>
                                                    Adoptif
                                                </option>
                                                <option value="adoptif"
                                                    <?= set_select('type_parent', 'brother'); ?>>
                                                    Frère
                                                </option> 
                                                <option value="adoptif"
                                                    <?= set_select('type_parent', 'sister'); ?>>
                                                    Soeur
                                                </option>
                                                <option value="familial"
                                                    <?= set_select('type_parent', 'familial'); ?>>
                                                    Autre(Lien Familial)
                                                </option>
                                            </select>
                                            <label form="type_parent"><span class="text-danger">*</span>Type de parent
                                            </label>
                                            <?php if ($validation->hasError('type_parent')) { ?>
                                            <span class="invalid-feedback">
                                                <?= $validation->getError('type_parent'); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 mb-2">
                                        <div class="form-floating">

                                            <input type="text" class="form-control" name="adresseEleve"
                                                id="adresseEleve" value="<?= set_value('adresseEleve') ?>"
                                                placeholder="Ex: 10 Avenue Mwepu, Lubumbashi, Katanga, RDC">
                                            <label for="adresseEleve">
                                                <span class="text-danger">*</span>Adresse de résidence du responsable
                                                principal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-lg">
                                    <i class="fa fa-check-circle"></i> Enregistrer les informations
                                </button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <?= form_close(); ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>