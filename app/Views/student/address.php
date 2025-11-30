<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper <?= checkModuleAccess('inscription'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header printoff">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">Gestion des adresses élèves</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard') ?>">Accueil</a>
                        </li>
                        <li class="breadcrumb-item active">Dossiers</li>
                        <li class="breadcrumb-item active">Adresses élèves</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content printoff mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 col-sm-6 col-lg-3">
                    <div class="nav flex-column nav-tabs nav-tabs-left h-100" id="vert-tabs-right-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'municipality') ? 'active' : ''); ?>"
                            id="follow_municipalitys" data-toggle="pill" href="#follow_municipalitys_tab" role="tab"
                            aria-controls="follow_municipalitys_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Communes des élèves
                            </span>
                        </a>
                        <a class="text-left btn btn-sm btn-outline-primary nav-link <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'quartiers') ? 'active' : ''); ?>"
                            id="quartiers_municipalitys_tab_btn" data-toggle="pill" href="#quartiers_municipalitys_tab"
                            role="tab" aria-controls="quartiers_municipalitys_tab" aria-selected="true">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Quartiers des élèves
                            </span>
                        </a>

                       <!--  <a class="text-left btn btn-sm btn-outline-primary nav-link <-?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'zones') ? 'active' : ''); ?>"
                            id="zones_students_tab_btn" data-toggle="pill" href="#zones_students_tab"
                            role="tab" aria-controls="zones_students_tab" aria-selected="false">
                            <span class="text-uppercase font-weight-bold">
                                <i class="fas fa-angle-double-right"></i>
                                Zones résidentielles
                            </span>
                        </a> -->
                    </div>
                </div>
                <div class="col-9 col-sm-6 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="vert-tabs-right-tabContent">
                                <!-- DECLARATION DES INCIDENTS -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'municipality') ? 'show active' : ''); ?>"
                                    id="follow_municipalitys_tab" role="tabpanel"
                                    aria-labelledby="follow_municipalitys_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Gestion des communes
                                                </h3>
                                                <a data-toggle="modal" data-target="#create_new_municipality" href="#"
                                                    class="btn btn-primary btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer une commune">
                                                        <i class="fa fa-plus"></i> Ajouter une commune
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold text-capitalize">
                                                            <th>Actions</th>
                                                            <th>Désignation</th>
                                                            <th>Date</th>
                                                            <th>Etat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($communes) && !empty($communes)):
                                                            $count = 1;
                                                        ?>
                                                        <?php foreach ($communes as $municipalitykey => $municipality):
                                                                $commune_status = strtolower($municipality['municipality_status']); ?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('student/remove/municipality/' . $municipality['municipality_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commune ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#municipalityModal<?= $municipality['municipality_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($municipality['municipality_name']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($municipality['municipality_created_at']); ?>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge badge-<?= ($commune_status == 'actif') ? 'success':'danger'; ?> text-capitalize">
                                                                    <?= $commune_status; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing course configuration -->
                                                        <div class="modal fade"
                                                            id="municipalityModal<?= $municipality['municipality_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="municipalityModalLabel<?= $municipality['municipality_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="municipalityModalLabel<?= $municipality['municipality_id']; ?>">
                                                                            Modifier une commune
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form id="form_municipality" role="form"
                                                                        action="<?= base_url('student/municipality'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden"
                                                                                name="municipality_token"
                                                                                value="<?= $municipality['municipality_token']; ?>">
                                                                            <input type="hidden" name="action"
                                                                                value="update">
                                                                            <div class="text-center">
                                                                                <h2>Modification d'une commune</h2>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="municipality_name"
                                                                                            id="municipality_name"
                                                                                            value="<?= (!empty($municipality['municipality_name'])) ? $municipality['municipality_name']: old('municipality_name'); ?>"
                                                                                            placeholder="Ex: Commune de ..."
                                                                                            required />
                                                                                        <label for="municipality_name">
                                                                                            <span
                                                                                                class="text-danger">*</span>Nom
                                                                                            de la commune
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status"
                                                                                            name="municipality_status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($municipality['municipality_status'] == 'actif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($municipality['municipality_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>

                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Etat
                                                                                            de la commune</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning">
                                                                                <i class="fas fa-check-circle"></i>
                                                                                Enregistrer les modifications
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- SANCTIONS DISCIPLINAIRES -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'quartiers') ? 'show active' : ''); ?>"
                                    id="quartiers_municipalitys_tab" role="tabpanel"
                                    aria-labelledby="quartiers_municipalitys_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Gestion des quartiers des élèves
                                                </h3>
                                                <a data-toggle="modal" data-target="#create_new_sanction" href="#"
                                                    class="btn btn-success btn-sm text-uppercase">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour créer un quartier">
                                                        <i class="fa fa-plus"></i> Ajouter un nouveau quartier
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold text-capitalize">
                                                            <th>Actions</th>
                                                            <th>Commune</th>
                                                            <th>Quartier</th>
                                                            <th>Date</th>
                                                            <th>Notes</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($quartiers) && !empty($quartiers)):
                                                            $count = 1;
                                                        ?>
                                                        <?php foreach ($quartiers as $sanc_index => $district):
                                                            $status = esc($district['district_status']); 
                                                        ?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('student/remove/district/' . $district['district_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sanction ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#editSanctionModal<?= $district['district_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($district['municipality_name']); ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($district['district_name']); ?>
                                                            </td>
                                                            <td><?= $district['district_created_at']; ?>
                                                            </td>
                                                            <td class="text-uppercase small">
                                                                <?= esc($district['district_notes']); ?></td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status; ?>
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Modal for editing sanction -->
                                                        <div class="modal fade"
                                                            id="editSanctionModal<?= $district['district_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editSanctionModalLabel<?= $district['district_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="editSanctionModalLabel<?= $district['district_id']; ?>">
                                                                            Modifier le quartier
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="<?= base_url('student/municipalityDistrict'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="district_token" value="<?= $district['district_token']; ?>">
                                                                            <input type="hidden" name="action" value="update">
                                                                            <div class="text-center">
                                                                                <h2>Modification d'un quartier</h2>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="municipality"
                                                                                            name="municipality"
                                                                                            required>
                                                                                            <option disabled>
                                                                                                --Sélectionnez une
                                                                                                commune--</option>
                                                                                            <?php if (isset($communes) && !empty($communes)): ?>
                                                                                            <?php foreach ($communes as $key_municipality => $sancmunicipality): ?>
                                                                                            <option
                                                                                                value="<?= esc($sancmunicipality['municipality_id']); ?>"
                                                                                                <?= ($sancmunicipality['municipality_id'] == $district['district_municipality_id']) ? 'selected':''; ?>>
                                                                                                <?= strtoupper($sancmunicipality['municipality_name']); ?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                        <label for="municipality">
                                                                                            <span
                                                                                                class="text-danger">*</span>Commune
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="district_name"
                                                                                            id="district_name"
                                                                                            value="<?= (!empty($district['district_name'])) ? $district['district_name']: old('district_name'); ?>"
                                                                                            placeholder="Ex: BEL-AIR ..."
                                                                                            required />
                                                                                        <label for="district_name">
                                                                                            <span
                                                                                                class="text-danger">*</span>Nom
                                                                                            du quartier
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status"
                                                                                            name="district_status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($district['district_status'] == 'actif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($district['district_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>

                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Etat
                                                                                            du quartier</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-capitalize"
                                                                                            name="district_notes"
                                                                                            id="district_notes"
                                                                                            value="<?= (!empty($district['district_notes'])) ? $district['district_notes']: old('district_notes'); ?>"
                                                                                            placeholder="Ex: Infos supplementaires" />
                                                                                        <label for="district_notes"
                                                                                            class="control-label">
                                                                                            <span
                                                                                                class="text-danger"></span>Notes
                                                                                            d'observation sur le
                                                                                            quartier
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning">
                                                                                <i class="fas fa-check-circle"></i>
                                                                                Enregistrer les modifications</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Disponibilites des enseignants -->
                                <div class="tab-pane fade <?= (session()->has('sess_tab') && (session()->get('sess_tab') == 'zones') ? 'show active' : ''); ?>"
                                    id="zones_students_tab" role="tabpanel"
                                    aria-labelledby="zones_students_tab">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center mb-2">
                                                <h3 class="font-weight-bold lined lined-center">
                                                    Gestion zones résidentielles des élèves
                                                </h3>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table tables-sm table-bordered table-striped datatables">
                                                    <thead>
                                                        <tr class="small font-weight-bold">
                                                            <th>Actions</th>
                                                            <th>Commune</th>
                                                            <th>Quartier</th>
                                                            <th>Maison</th>
                                                            <th>Avenue</th>
                                                            <th>Rue</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($zones) && !empty($zones)):
                                                            $count = 1;
                                                        ?>
                                                        <?php foreach ($zones as $index => $address):
                                                                $status_evaluation = esc($address['address_status']); ?>
                                                        <tr class="small">
                                                            <td>
                                                                <a href="<?= base_url('student/remove/address/' . $address['address_id']); ?>"
                                                                    class="btn btn-danger btn-sm" title="Supprimer"
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette zone ?');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Modifier" data-toggle="modal"
                                                                    data-target="#editAddressModal<?= $address['address_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= $address['municipality_name']; ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= esc($address['district_name']); ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= esc($address['address_home_code']); ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= $address['address_area_name']; ?>
                                                            </td>
                                                            <td class="text-uppercase">
                                                                <?= $address['address_street_name']; ?>
                                                            </td>

                                                            <td>
                                                                <span
                                                                    class="badge  <?= (esc($status_evaluation) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                                    <?= $status_evaluation; ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal for editing address -->
                                                        <div class="modal fade"
                                                            id="editAddressModal<?= $address['address_id']; ?>"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="editAddressModalLabel<?= $address['address_id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-warning">
                                                                        <h5 class="modal-title text-uppercase"
                                                                            id="editAddressModalLabel<?= $address['address_id']; ?>">
                                                                            Modifier une zone résidentielle
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="<?= base_url('student/municipalityAddress'); ?>"
                                                                        method="post">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="address_token" value="<?= $address['address_token']; ?>">
                                                                            <input type="hidden" name="action" value="update">
                                                                            <div class="text-center">
                                                                                <h2>Modification d'une zone résidentielle </h2>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="municipality"
                                                                                            name="municipality"
                                                                                            required>
                                                                                            <option disabled>
                                                                                                --Sélectionnez une
                                                                                                commune--</option>
                                                                                            <?php if (isset($communes) && !empty($communes)): ?>
                                                                                            <?php foreach ($communes as $key_municipality => $sancmunicipality): ?>
                                                                                            <option
                                                                                                value="<?= esc($sancmunicipality['municipality_id']); ?>"
                                                                                                <?= ($sancmunicipality['municipality_id'] == $address['address_municipality_id']) ? 'selected':''; ?>>
                                                                                                <?= strtoupper($sancmunicipality['municipality_name']); ?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                        <label for="municipality">
                                                                                            <span class="text-danger">*</span>Commune
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="select2 form-control text-uppercase"
                                                                                            id="district"
                                                                                            name="district"
                                                                                            required>
                                                                                            <option disabled>
                                                                                                --Sélectionnez un
                                                                                                quartier--</option>
                                                                                            <?php if (isset($quartiers) && !empty($quartiers)): ?>
                                                                                            <?php foreach ($quartiers as $key_district => $sancdistrict): ?>
                                                                                            <option
                                                                                                value="<?= esc($sancdistrict['district_id']); ?>"
                                                                                                <?= ($sancdistrict['district_id'] == $address['address_district_id']) ? 'selected':''; ?>>
                                                                                                <?= strtoupper($sancdistrict['district_name']); ?>
                                                                                            </option>
                                                                                            <?php endforeach; ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                        <label for="district">
                                                                                            <span class="text-danger">*</span>Quartier
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="address_home_code"
                                                                                            id="address_home_code"
                                                                                            value="<?= (!empty($address['address_home_code'])) ? $address['address_home_code']: old('address_home_code'); ?>"
                                                                                            placeholder="Ex: MAISON N° 12 ..."
                                                                                            required />
                                                                                        <label for="address_home_code">
                                                                                            <span
                                                                                                class="text-danger">*</span>Numéro
                                                                                            de la maison
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="address_area_name"
                                                                                            id="address_area_name"
                                                                                            value="<?= (!empty($address['address_area_name'])) ? $address['address_area_name']: old('address_area_name'); ?>"
                                                                                            placeholder="Ex: AVENUE JEAN-JAQUES ..."
                                                                                            required />
                                                                                        <label for="address_area_name">
                                                                                            <span
                                                                                                class="text-danger">*</span>Nom
                                                                                            de l'avenue
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 col-sm-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <input type="text"
                                                                                            class="form-control text-uppercase"
                                                                                            name="address_street_name"
                                                                                            id="address_street_name"
                                                                                            value="<?= (!empty($address['address_street_name'])) ? $address['address_street_name']: old('address_street_name'); ?>"
                                                                                            placeholder="Ex: RUE DU COMMERCE ..."
                                                                                            required />
                                                                                        <label for="address_street_name">
                                                                                            <span
                                                                                                class="text-danger">*</span>Nom
                                                                                            de la rue
                                                                                        </label>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-sm-12 col-lg-12 mb-2">
                                                                                    <div class="form-floating">
                                                                                        <select
                                                                                            class="form-control text-uppercase"
                                                                                            id="status"
                                                                                            name="address_status"
                                                                                            required>
                                                                                            <option value="actif"
                                                                                                <?= ($address['address_status'] == 'actif') ? 'selected':''; ?>>
                                                                                                Actif</option>
                                                                                            <option value="inactif"
                                                                                                <?= ($address['address_status'] == 'inactif') ? 'selected':''; ?>>
                                                                                                Inactif</option>

                                                                                        </select>
                                                                                        <label for="status"><span
                                                                                                class="text-danger">*</span>Etat de la zone</label>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Annuler</button>
                                                                            <button type="submit"
                                                                                class="btn btn-warning">
                                                                                <i class="fas fa-check-circle"></i>
                                                                                Enregistrer les modifications</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Periode predefinies de la journée des enseignants -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- DECLARATION D'UN INCIDENT-->
<div class="modal fade" id="create_new_municipality">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title font-weight-bold text-uppercase">Gestion des communes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('student/municipality'), $attributes);
            ?>
            <div class="modal-body">
                <input type="hidden" name="action" value="create">
                <div class="text-center">
                    <h2>Création d'une nouvelle commune</h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" name="municipality_name"
                                id="municipality_name" value="<?= old('municipality_name'); ?>"
                                placeholder="Ex: Commune de ..." required />
                            <label for="municipality_name">
                                <span class="text-danger">*</span>Nom
                                de la commune
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="municipality_status" required>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>

                            </select>
                            <label for="status"><span class="text-danger">*</span>Etat
                                de la commune</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle"></i> Enregistrer la commune
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- SANCTIONS -->
<div class="modal fade" id="create_new_sanction">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title font-weight-bold text-uppercase">
                    Création d'un nouveau quartier
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <?php
            $validation = \Config\Services::validation();
            $attributes = array('role' => 'form', 'autocomplete' => 'off');
            echo form_open(base_url('student/municipalityDistrict'), $attributes);
            ?>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <select class="select2 form-control text-uppercase" id="municipality" name="municipality"
                                required>
                                <option disabled>--Sélectionnez une commune--</option>
                                <?php if (isset($communes) && !empty($communes)): ?>
                                <?php foreach ($communes as $key_commune => $commune): ?>
                                <option value="<?= esc($commune['municipality_id']); ?>">
                                    <?= strtoupper($commune['municipality_name']); ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="municipality">
                                <span class="text-danger">*</span>Commune
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" name="district_name"
                                id="district_name" value="<?= old('district_name'); ?>" placeholder="Ex: BEL-AIR ..."
                                required />
                            <label for="district_name">
                                <span class="text-danger">*</span>Nom
                                du quartier
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="status" name="district_status" required>
                                <option value="actif">
                                    Actif</option>
                                <option value="inactif">
                                    Inactif</option>

                            </select>
                            <label for="status"><span class="text-danger">*</span>Etat
                                du quartier</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-capitalize" name="district_notes"
                                id="district_notes" value="<?= old('district_notes'); ?>"
                                placeholder="Ex: Infos supplementaires" />
                            <label for="district_notes" class="control-label">
                                <span class="text-danger"></span>Notes
                                d'observation sur le
                                quartier
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Fermer
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Enregistrer le quartier
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: "Sélectionnez une option",
        allowClear: true
    });
});
</script>