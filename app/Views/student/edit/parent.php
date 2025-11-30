<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content pt-3 p-md-3 p-lg-4">
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
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    $validation = \Config\Services::validation();
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open(base_url('edit-parent/'.$parent['parent_id']), $attributes);
                    ?>

                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1>Modification fiche parents</h1>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nom_pere_eleve" class="control-label">
                                            <span class="text-danger">*</span>Nom du père
                                        </label>
                                        <input type="text" class="form-control text-capitalize" name="nom_pere_eleve"
                                            id="nom_pere_eleve" autocomplete="off"
                                            value="<?= ($parent['parent_father_name'])? ($parent['parent_father_name']): set_value('nom_pere_eleve') ?>"
                                            style="border-radius: 10px!important;" />
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="phone_pere"><span class="text-danger"></span>Numéro
                                            téléphone du père
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_pere" id="phone_pere"
                                                value="<?= ($parent['parent_father_phone'])? ($parent['parent_father_phone']):set_value('phone_pere') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="phone_pere"><span class="text-danger"></span>Numéro
                                            téléphone 2 du père
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_pere2" id="phone_pere2"
                                                value="<?= ($parent['parent_father_phone2'])? ($parent['parent_father_phone2']):set_value('phone_pere2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="profession_pere" class="control-label">
                                            <span class="text-danger"></span> Profession du père
                                        </label>
                                        <input type="text" class="form-control text-capitalize" name="profession_pere"
                                            id="profession_pere" autocomplete="off"
                                            value="<?= ($parent['parent_father_job'])? ($parent['parent_father_job']):set_value('profession_pere') ?>"
                                            style="border-radius: 10px!important;" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nom_mere_eleve" class="control-label">
                                            <span class="text-danger">*</span>Nom de la mère
                                        </label>
                                        <input type="text" class="form-control text-capitalize" name="nom_mere_eleve"
                                            id="nom_mere_eleve" autocomplete="off"
                                            value="<?= ($parent['parent_mother_name'])? ($parent['parent_mother_name']):set_value('nom_mere_eleve') ?>"
                                            style="border-radius: 10px!important;" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="phone_mere"><span class="text-danger"></span>Numéro
                                            téléphone de la mère
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_mere" id="phone_mere"
                                                value="<?= ($parent['parent_mother_phone'])? ($parent['parent_mother_phone']):set_value('phone_mere') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="phone_mere"><span class="text-danger"></span>Numéro
                                            téléphone 2 de la mère
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_mere2" id="phone_mere2"
                                                value="<?= ($parent['parent_mother_phone2'])? ($parent['parent_mother_phone2']):set_value('phone_mere2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="profession_mere" class="control-label">
                                            <span class="text-danger"></span> Profession de la mère
                                        </label>
                                        <input type="text" class="form-control text-capitalize" name="profession_mere"
                                            id="profession_mere" autocomplete="off"
                                            value="<?= ($parent['parent_mother_job'])? ($parent['parent_mother_job']):set_value('profession_mere') ?>"
                                            style="border-radius: 10px!important;" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nom_tuteur_eleve" class="control-label">
                                            <span class="text-danger"></span> Nom du tuteur
                                        </label>
                                        <input type="text" class="form-control text-capitalize" name="nom_tuteur_eleve"
                                            id="nom_tuteur_eleve" autocomplete="off"
                                            value="<?= ($parent['parent_tutor_name'])? ($parent['parent_tutor_name']):set_value('nom_tuteur_eleve') ?>"
                                            style="border-radius: 10px!important;" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="telephone_tuteur"><span class="text-danger"></span>Numéro
                                            téléphone du tuteur
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_tuteur"
                                                id="telephone_tuteur"
                                                value="<?= ($parent['parent_tutor_phone'])? ($parent['parent_tutor_phone']):set_value('telephone_tuteur') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="telephone_tuteur"><span class="text-danger"></span>Numéro
                                            téléphone 2 du tuteur
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="telephone_tuteur2"
                                                id="telephone_tuteur2"
                                                value="<?= ($parent['parent_tutor_phone2'])? ($parent['parent_tutor_phone2']):set_value('telephone_tuteur2') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="profession_tuteur" class="control-label">
                                            <span class="text-danger"></span> Profession du tuteur
                                        </label>
                                        <input type="text" class="form-control text-capitalize" name="profession_tuteur"
                                            id="profession_tuteur" autocomplete="off"
                                            value="<?= ($parent['parent_tutor_job'])? ($parent['parent_tutor_job']):set_value('profession_tuteur') ?>"
                                            style="border-radius: 10px!important;" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- radio -->
                                    <div class="form-floating">
                                        <select id="type_parent" name="type_parent" title="sexe"
                                            class="form-control <?= ($validation->hasError('type_parent')) ? ' is-invalid' : '' ?>"
                                            style="width: 100%;">
                                            <option selected="selected" disabled>-- Sélectionnez --
                                            </option>
                                            <option value="biologique"
                                                <?= ($parent['parent_type'] == 'biologique') ? 'selected' : set_select('type_parent', 'biologique'); ?>>
                                                Biologique
                                            </option>
                                            <option value="adoptif"
                                                <?= ($parent['parent_type'] == 'adoptif') ? 'selected': set_select('type_parent', 'adoptif'); ?>>
                                                Adoptif
                                            </option>
                                            <option value="adoptif"
                                                <?= ($parent['parent_type'] == 'brother') ? 'selected': set_select('type_parent', 'brother'); ?>>
                                                Frère
                                            </option>
                                            <option value="adoptif"
                                                <?= ($parent['parent_type'] == 'sister') ? 'selected': set_select('type_parent', 'sister'); ?>>
                                                Soeur
                                            </option>
                                            <option value="familial"
                                                <?= ($parent['parent_type'] == 'familial') ? 'selected' : set_select('type_parent', 'familial'); ?>>
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
                                <div class="col-sm-12 col-lg-8">
                                    <div class="form-group float-right">
                                        <label class="phone_sms">
                                            <span class="text-danger">*</span>Personne Responsable à contacter en
                                            cas d'urgence
                                        </label>
                                        <div class="input-group">
                                            <div class="icheck-success d-inline mr-3">
                                                <input type="radio" name="phone_sms"
                                                    <?= ($parent['parent_emergency'] == 'pere')? 'checked':''; ?>
                                                    id="pere" value="pere">
                                                <label for="pere">
                                                    Père
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline mr-3 ml-3">
                                                <input type="radio" name="phone_sms"
                                                    <?= ($parent['parent_emergency'] == 'mere')? 'checked':''; ?>
                                                    id="mere" value="mere">
                                                <label for="mere">
                                                    Mère
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="radio"
                                                    <?= ($parent['parent_emergency'] == 'tuteur')? 'checked':''; ?>
                                                    name="phone_sms" id="tuteur" value="tuteur">
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
                                            téléphone du responsable principal
                                            :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone_primary"
                                                id="phone_primary"
                                                value="<?= ($parent['parent_primary_phone'])? ($parent['parent_primary_phone']):set_value('phone_primary') ?>"
                                                data-inputmask='"mask": "+243999999999"' data-mask
                                                placeholder="Ex: 858533285" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email_tuteur">
                                            <span class="text-danger"></span>Adresse E-mail du responsable principal
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email_tuteur"
                                                id="email_tuteur"
                                                value="<?= ($parent['parent_primary_email'])? ($parent['parent_primary_email']):set_value('email_tuteur') ?>"
                                                autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">
                                    <div class="form-floating">
                                        <textarea rows="5" cols="30" class="form-control bg-light" name="notes"
                                            placeholder="Plus de détails sur les parents"
                                            id="notes"><?= ($parent['parent_notes']) ? ($parent['parent_notes']) :set_value('notes'); ?></textarea>
                                        <label for="notes" class="control-label">
                                            <span class="text-danger"></span>Observation sur les parents
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h5 class="font-weight-bold">
                                        <span class="text-danger">*</span>Adresse de résidence
                                    </h5>
                                </div>

                                <?php if(isset($zone) && !empty($zone)): ?>
                                <input type="hidden" name="address_id" id="address_id"
                                    value="<?= esc($zone['address_id']) ?>" />


                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_number"
                                        id="address_number" autocomplete="off"
                                        value="<?= ($zone['address_home_code']) ? ucwords($zone['address_home_code']): set_value('address_number') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: 15B" />
                                    <label for="address_number" class="control-label">
                                        Numéro de la maison
                                    </label>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_name"
                                        id="address_name" autocomplete="off"
                                        value="<?= ($zone['address_area_name']) ? ucwords($zone['address_area_name']): set_value('address_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Savonnier" />
                                    <label for="address_name" class="control-label">
                                        <span class="text-danger">*</span>Nom de l'avenue
                                    </label>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_street_name"
                                        id="address_street_name" autocomplete="off"
                                        value="<?= ($zone['address_street_name']) ? ucwords($zone['address_street_name']): set_value('address_street_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Sapins" />
                                    <label for="address_street_name" class="control-label">
                                        Rue<span class="text-danger">(Facultatif)</span>
                                    </label>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-2">
                                    <div class="form-floating">
                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('student_area')) ? ' is-invalid' : '' ?>"
                                            id="student_area" name="student_area" data-dropdown-css-class="select2-info"
                                            style="width: 100%;">
                                            <option selected disabled> sélectionnez un quartier </option>

                                            <?php if (isset($quartiers) && !empty($quartiers)):
                                                foreach ($quartiers as $quartierkey => $quartier): ?>
                                            <option value="<?= esc($quartier['district_id']); ?>"
                                                <?= ($zone['address_district_id'] == $quartier['district_id']) ? 'selected': set_select('student_area', esc($quartier['district_id'])); ?>>
                                                <?= ucwords($quartier['district_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('student_area')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_area'); ?></span>
                                        <?php } ?>
                                        <label for="student_area"><span class="text-danger">*</span>Quartier de
                                            l'élève</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-2">
                                    <div class="form-floating">

                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                            id="student_commune" name="student_commune"
                                            data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected disabled> sélectionnez une commune </option>

                                            <?php if (isset($communes) && !empty($communes)):
                                                foreach ($communes as $comkey => $commune): ?>
                                            <option value="<?= esc($commune['municipality_id']); ?>"
                                                <?= ($zone['address_municipality_id'] == $commune['municipality_id']) ? 'selected': set_select('student_commune', esc($commune['municipality_id'])); ?>>
                                                <?= ucwords($commune['municipality_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('student_commune')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_commune'); ?></span>
                                        <?php } ?>
                                        <label for="student_commune"><span class="text-danger">*</span>Commune de
                                            l'élève</label>
                                    </div>
                                </div>
                                <?php else: ?>

                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_number"
                                        id="address_number" autocomplete="off"
                                        value="<?= set_value('address_number') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: 15B" />
                                    <label for="address_number" class="control-label">
                                        Numéro de la maison
                                    </label>
                                </div>


                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_name"
                                        id="address_name" autocomplete="off" value="<?= set_value('address_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Savonnier" />
                                    <label for="address_name" class="control-label">
                                        <span class="text-danger">*</span>Nom de l'avenue
                                    </label>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-2 form-floating">
                                    <input type="text" class="form-control text-capitalize" name="address_street_name"
                                        id="address_street_name" autocomplete="off"
                                        value="<?= set_value('address_street_name') ?>"
                                        style="border-radius: 10px!important;" placeholder="Ex: Sapins" />
                                    <label for="address_street_name" class="control-label">
                                        Rue<span class="text-danger">(Facultatif)</span>
                                    </label>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-2">
                                    <div class="form-floating">

                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('student_area')) ? ' is-invalid' : '' ?>"
                                            id="student_area" name="student_area" data-dropdown-css-class="select2-info"
                                            style="width: 100%;">
                                            <option selected disabled> sélectionnez un quartier </option>
                                            <?php if (isset($quartiers) && !empty($quartiers)):
                                                foreach ($quartiers as $quartierkey => $quartier): ?>
                                            <option value="<?= esc($quartier['district_id']); ?>"
                                                <?= set_select('student_area', esc($quartier['district_id'])); ?>>
                                                <?= ucwords($quartier['district_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('student_area')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_area'); ?></span>
                                        <?php } ?>
                                        <label for="student_area"><span class="text-danger">*</span>Quartier de
                                            l'élève</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6 mb-2">
                                    <div class="form-floating">

                                        <select
                                            class="form-control select2 select2-info <?= ($validation->hasError('tuteurEleve')) ? ' is-invalid' : '' ?>"
                                            id="student_commune" name="student_commune"
                                            data-dropdown-css-class="select2-info" style="width: 100%;">
                                            <option selected disabled> sélectionnez une commune </option>
                                            <?php if (isset($communes) && !empty($communes)):
                                                foreach ($communes as $comkey => $commune): ?>
                                            <option value="<?= esc($commune['municipality_id']); ?>"
                                                <?= set_select('student_commune', esc($commune['municipality_id'])); ?>>
                                                <?= ucwords($commune['municipality_name']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if ($validation->hasError('student_commune')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('student_commune'); ?></span>
                                        <?php } ?>
                                        <label for="student_commune"><span class="text-danger">*</span>Commune de
                                            l'élève</label>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-info btn-rounded text-uppercase btn-lg">
                                    <i class="fa fa-check-circle"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>