<div class="content-wrapper <?= checkModuleAccess('activation'); ?>">
    <div class="content pt-3 p-md-3 p-lg-4">
        <div class="container">
            <nav aria-label="breadcrumb" class="text-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Communication</li>
                    <li class="breadcrumb-item active" aria-current="page">Messages</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card bg-info py-3">
                <div class="card-title">
                    <h3 class="text-uppercase text-center font-weight-bold">
                        Activation envoies sms
                    </h3>
                </div>
            </div>
            <?php if(isset($school) && (!empty($school))): ?>
            <div class="row">
                <div class="col-sm-6 col-lg-6">
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
                                        <span>Nom expediteur</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_sms_sender']; ?>
                                    </h3>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                       <!--  <-?= //isset($sms_credits) ? $sms_credits:''; ?> -->
                                    </h3>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Nombre de SMS disponible</span>
                                    </h5>
                                    <h3 class="app-card-title text-uppercase fw-bold">
                                        <?= $school['school_sms_number']; ?>
                                    </h3>
                                </div>
                            </div>

                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <h5 class="text-muted small">
                                        <span>Statut envoi sms</span>
                                    </h5>
                                    <h3 class="app-card-title text-capitaliwe fw-bold">
                                        <?= ($school['school_sms_sending'] == 1) ? 'Activé':'Désactivé'; ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <?php $validation = \Config\Services::validation();
                                $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                echo form_open(base_url('sendingsms-activation'), $attributes);
                            ?>
                            <div class="row">

                                <div class="col-sm-12 col-lg-12">
                                    <div class="form-floating mb-3">
                                        <select
                                            class="form-select form-control <?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>"
                                            title="SMS Status" name="status" id="status">
                                            <option disabled selected>Statut d'envoi sms</option>

                                            <?php
                                                
                                                $types_values = array(
                                                    '1' => "Activé",
                                                    '0' => "Désactivé",
                                                );
                                                foreach ($types_values as $key => $value) { ?>
                                            <option value="<?= $key; ?>" <?= ($school['school_sms_sending'] == $key) ? 'selected':set_select("status", $key); ?>>
                                                <?= ucfirst($value); ?></option>
                                            <?php } ?>
                                        </select>

                                        <label for="status">
                                            <span class="text-danger">*</span>Statut Envoi SMS
                                        </label>
                                        <?php if ($validation->hasError('status')) { ?>
                                        <span class="invalid-feedback">
                                            <?= $validation->getError('status'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">

                                        <input type="text" name="sender" id="sender" placeholder="Ex: DITOTASE"
                                            value="<?= ($school['school_sms_sender']) ? $school['school_sms_sender']: set_value('sender'); ?>"
                                            class="form-control <?= ($validation->hasError('sender')) ? ' is-invalid' : '' ?>" />
                                        <label for="sender">
                                            <span class="text-danger">*</span>Nom expediteur SMS fourni par votre
                                            fournisseur</label>
                                        <?php if ($validation->hasError('sender')) { ?>
                                        <span class="invalid-feedback text-danger">
                                            <?= $validation->getError('sender'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="number" name="sms" id="sms" placeholder="Ex: 1200"
                                            value="<?= ($school['school_sms_number']) ? $school['school_sms_number']:set_value('sms'); ?>"
                                            class="form-control <?= ($validation->hasError('sms')) ? ' is-invalid' : '' ?>" />
                                        <label for="sms">
                                            <span class="text-danger">*</span>Nombre total de SMS sur votre Pack</label>
                                        <?php if ($validation->hasError('sms')) { ?>
                                        <span class="invalid-feedback text-danger">
                                            <?= $validation->getError('sms'); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-check-circle"></i>
                                    Valider l'activation
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- Main content -->
    <section class="content <?= checkModuleAccess('sections'); ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <div class="card-title">
                                <h5 class="font-weight-bold text-uppercase">Activation des Sections</h5>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Libellé</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th>Activation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count = 1;
                                    if (isset($sections) && !empty($sections)):
                                        foreach ($sections as $key => $value):
                                            $status = (!empty(esc($value['section_status'])) ? esc($value['section_status']) : 'inactif');
                                            $type = (!empty(esc($value['section_type'])) ? esc($value['section_type']) : 'inactif');
                                            ?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= esc($value['section_code']); ?></td>
                                            <td class="text-capitalize"><?= ($value['section_name']); ?></td>
                                            <td>
                                                <a href="<?= base_url('main/changeStatus/section/' . esc($status) . '/' . esc($value['section_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td class="text-uppercase"><?= ($value['section_created_at']); ?></td>
                                            
                                            <td>
                                                <a href="<?= base_url('main/changeStatus/sectionActivation/' . esc($type) . '/' . esc($value['section_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($type) == 'actif') ? 'badge-success' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $type; ?> </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>