<div class="app-content pt-3 p-md-3 p-lg-4 <?= checkModuleAccess(null, 'admins'); ?>">
    <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-auto">
                    <h1>Création d'un service</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <a class="btn app-btn-primary btnrounded" href="<?= base_url('admin/view/users'); ?>">
                                    <i class="fas fa-chevron-left"></i> Fermer </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div>
        <div class="basic-choices">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-gray-200">
                        <div class="card-content">
                            <?php
                            $validation = \Config\Services::validation();
                            $attributes = array('role' => 'form', 'autocomplete' => 'off');
                            echo form_open(base_url('admin/saveService/create'), $attributes);
                            ?>
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-2">
                                            <input
                                                    type="text"
                                                    class="form-control <?= ($validation->hasError('name')) ? ' is-invalid' : '' ?>"
                                                    id="name" placeholder="Ex: Ilunga" name="name"
                                                    aria-describedby="floatingInputHelpNumber"
                                                    value="<?= set_value('name'); ?>" autofocus
                                            />
                                            <label for="name">Nom du service<span
                                                        class="text-danger">(*)</span></label>
                                            <div id="floatingInputHelpNumber" class="form-text">
                                                <span class="text-danger"><?= displayFormError($validation, 'name'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating mb-2">
                                            <input
                                                    type="text"
                                                    class="form-control <?= ($validation->hasError('price')) ? ' is-invalid' : '' ?>"
                                                    id="price" placeholder="Ex: 20" name="price"
                                                    aria-describedby="floatingInputHelpMArk"
                                                    value="<?= set_value('price'); ?>"
                                            />
                                            <label for="price">Prix du service en USD<span
                                                        class="text-danger">(*)</span></label>
                                            <div id="floatingInputHelpMArk" class="form-text">
                                                <span class="text-danger"><?= displayFormError($validation, 'price'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 form-group">
                                        <select class="choices form-select text-capitalize <?= ($validation->hasError('type_service')) ? ' is-invalid' : '' ?>"
                                                title="type_service" name="type_service" id="type_service">
                                            <option disabled selected>Type de service (*)</option>
                                            <?php
                                            $types_values = array(
                                                'corporate' => "Corporate",
                                                'professionnel' => "Professionnel",
                                            );
                                            foreach ($types_values as $key => $value) { ?>
                                                <option value="<?= $key; ?>" <?= set_select("type_service", $key); ?>>
                                                    <?= ucfirst($value); ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?= displayFormError($validation, 'type_service'); ?></span>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-floating mb-2">
                                            <div class="my-2 d-flex justify-content-between align-items-center">
                                                <div class="form-check">
                                                    <label for="stay_on_page" class="form-check-label text-dark">
                                                        <input type="checkbox" checked
                                                               class="form-check-input <?= ($validation->hasError('stay_on_page')) ? ' is-invalid' : '' ?>"
                                                               id="stay_on_page" name="stay_on_page">
                                                            Rester sur cette page après validation</label>
                                                </div>
                                            </div>
                                            <div id="floatingInputHelpcavatar" class="form-text">
                                                <span class="text-danger"><?= displayFormError($validation, 'stay_on_page'); ?></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 form-group">
                                        <label for="address" class="label-control"><span
                                                    class="text-danger">(-)</span> Description du service</label>
                                        <textarea
                                                class="form-control form-control-lg <?= ($validation->hasError('address')) ? ' is-invalid' : '' ?>"
                                                name="address" rows="10" cols="30"
                                                placeholder="Décrivez l'adresse ici..."><?= set_value('address'); ?></textarea>
                                        <span class="text-danger"><?= displayFormError($validation, 'address'); ?></span>
                                    </div>
                                </div>
                                <div class="my-3 text-center">
                                    <button class="btn  btn-primary btn-lg rounded-2 py-3 btnrounded"
                                            type="submit">
                                       Enregistrer le service
                                    </button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
