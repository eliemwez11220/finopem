<div class="auth-form-transparent bg-primary card-radius card shadow-lg">

        <blockquote class="">
                    <h3 class="font-weight-bold text-uppercase lined lined-center">
                        <i class="nav-icon fas fa-database"></i> 
                        Importation de données
                    </h3>
                    <p class="font-weight-bold h5 text-center">
                        Veuillez sélectionner votre fichier .sql de votre base de données
                    </p>
                    <?php $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open_multipart(base_url('dbimportinit'), $attributes);
            ?>
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">

                            <input type="file" class="form-control py-3" name="dbsql" id="dbsql"
                                value="<?= old('dbsql'); ?>" accept=".sql" required />
                            <?php if ($validation->hasError('dbsql')) { ?>
                            <span class="invalid-feedback">
                                <?= $validation->getError('dbsql'); ?></span>
                            <?php } ?>
                            <label for="dbsql" class="control-label">
                                <span class="text-danger">*</span>Charger un fichier SQL
                            </label>
                        </div>
                    </div>


                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary py-3" onclick="return confirm('Voulez-vous vraiment écraser la base de données existante et remplacer par celle-ci ?'); false;">
                    <i class="fa fa-upload fa-lg"></i> Valider l'importation de données
                </button>
            </div>
            <?php echo form_close(); ?>
        </blockquote>
</div>