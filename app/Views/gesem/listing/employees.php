<div class="text-center">

    <a class="btn btn-primary" data-toggle="collapse" data-target="#offcanvas" href="#" role="button" id="btn_offcanvas"
        aria-controls="offcanvas" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-plus"></i> Nouvel agent
    </a>


</div>
<!-- ====== SIDEBAR RIGHT VISIBLE ON MOBILE DEVICE ONLY======-->
<div class="offcanvas" tabindex="-1" id="offcanvas" aria-labelledby="offcanvas">
    <div class="offcanvas-header text-white">
        <span id="offcanvas" class="h3 fw-bold">Ajout d'une nouvelle Information</span>
        <button type="button" class="btn-close" data-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('create-classe-degrees'), $attributes);
            ?>
        <div class="modal-body">
            <div class="text-center">
                <h1 class="alert alert-primary font-weight-bold text-uppercase">Dossier Nouvel Agent</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="degre_level" id="degre_level" min="1" max="100"
                            value="<?= old('degre_level'); ?>" placeholder="Ex:2" />

                        <label for="degre_level" class="control-label">
                            <span class="text-danger">*</span>Niveau d'études
                        </label>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                    <div class="form-floating">

                        <input type="text" class="form-control text-capitalize" name="long_name" id="long_name"
                            value="<?= old('long_name'); ?>" placeholder="Deuxième" />
                        <label for="long_name" class="control-label">
                            <span class="text-danger">*</span>Libellé degré en toute lettres
                        </label>
                    </div>

                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 mb-3">

                    <div class="form-floating">

                        <input type="text" class="form-control text-capitalize" name="short_name" id="short_name"
                            value="<?= old('short_name'); ?>" placeholder="2ème" />
                        <label for="short_name" class="control-label">
                            <span class="text-danger">*</span>Le libellé degré en abrégé
                        </label>
                    </div>

                </div>

            </div>
        </div>
        <div class="modal-footer text-right">
           
            <button type="submit" class="btn btn-info text-uppercase">
                Enregistrer le dossier
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>