<div class="content-wrapper <?= checkModuleAccess('categories'); ?>">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Gestion des catégories</h3>
                    <p class="text-subtitle text-muted">
                        Explorer toutes les catégories des employés de tous les services confondus.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="javascript:history.back();">Configuration</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Barème salarial </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Catégorisation professionnelle de travailleurs</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-end">
                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#addCategoryOffcanvas" aria-controls="addCategoryOffcanvas"
                                    title="Ajouter cette catégorie">
                                    <i class="fas fa-plus"></i>Créer nouvelle catégorie
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped" id="datatablesExample2">
                            <thead>
                                <tr>
                                    <th>Classe</th>
                                    <th>Designation</th>
                                    <th>Ouvrables</th>
                                    <th>Congés</th>
                                    <th>Tension</th>
                                    <th>Taux</th>
                                    <th>Type</th>
                                    <th>Etat</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; if (isset($categories) && (! empty($categories))):?>
                                <?php foreach ($categories as $key => $value):
                                $count++;
                                $status = ($value['category_status'] == 'actif')? "bg-success":"bg-danger";
                                ?>
                                <tr>
                                    <td class="text-uppercase"><?= $value['category_classe']; ?></td>
                                    <td class="text-capitalize"><?= $value['category_name']; ?></td>
                                    <td class="text-capitalize"><?= $value['category_number_working']; ?>jrs</td>
                                    <td class="text-capitalize"><?= $value['category_number_holidays']; ?>jrs</td>
                                    <td class="text-capitalize"><?= $value['category_tension']; ?>%</td>
                                    <td class="text-capitalize">
                                        <?= number_format($value['category_cost_day'], 2); ?>
                                        <span class="text-uppercase">
                                            <?= $value['category_currency']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-capitalize badge bg-secondary">
                                            <?= $value['category_type']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-capitalize badge <?= $status; ?> ">
                                            <?= $value['category_status']; ?>
                                        </span>
                                    </td>
                                    <td class="text-uppercase text-center">

                                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#editCategoryOffcanvas_<?= $value['category_uid']; ?>"
                                            aria-controls="editCategoryOffcanvas_<?= $value['category_uid']; ?>"
                                            title="Modifier cette catégorie">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="Voir les détails de la catégorie"
                                            onclick="showCategoryDetails(<?= htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8'); ?>)">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        <a href="<?= base_url('worker/remove/agenttype/'.$value['category_uid']); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette categorie?');">
                                            <i class="fas fa-window-close"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Offcanvas -->
                                <div class="modal modal-end" id="editCategoryOffcanvas_<?= $value['category_uid']; ?>"
                                    aria-labelledby="editCategoryOffcanvasLabel_<?= $value['category_uid']; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="font-weight-bold text-uppercase"
                                                    id="editCategoryOffcanvasLabel_<?= $value['category_uid']; ?>">
                                                    <span class="">
                                                        Modification de la catégorie
                                                        <?= $value['category_name']; ?></span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-danger"><i
                                                            class="fa fa-window-close"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="<?= base_url('worker/category/update/' . $value['category_uid']); ?>"
                                                    method="post" class="">
                                                    <div class="row">
                                                        <div class=" col-sm-12 col-lg-12">
                                                            <div class="form-floating mb-2">
                                                                <input type="text" class="form-control"
                                                                    id="category_name_<?= $value['category_uid']; ?>"
                                                                    name="category_name"
                                                                    value="<?= htmlspecialchars($value['category_name'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    required placeholder="Ex: Directeurs">

                                                                <label
                                                                    for="category_name_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Nom de la catégorie</label>
                                                            </div>
                                                        </div>



                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <select class="form-control form-select"
                                                                    id="category_classe" name="category_classe"
                                                                    required>
                                                                    <?php for ($i = 1; $i <= 50; $i++): ?>
                                                                    <option value="<?= $i; ?>"
                                                                        <?= ($value['category_classe'] == $i) ? 'selected': set_select('category_classe', $i); ?>>
                                                                        <?= 'Classe ' . $i; ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                                <label for="category_classe" class="form-label"><span
                                                                        class="text-danger">*</span>Classification</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <select class="form-control form-select"
                                                                    id="category_level" name="category_level" required>
                                                                    <option value="0">Pas d'Echelon</option>
                                                                    <?php for ($i = 1; $i <= 50; $i++): ?>
                                                                    <option value="<?= $i; ?>"
                                                                        <?= ($value['category_level'] == $i) ? 'selected': set_select('category_level', $i); ?>>
                                                                        <?= 'Niveau ' . $i; ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                                <label for="category_level"
                                                                    class="form-label text-capitalize"><span
                                                                        class="text-danger">*</span>
                                                                    échelonnement </label>
                                                            </div>
                                                        </div>

                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <select class="form-select form-control"
                                                                    title="Devise" name="category_currency" id="currency">
                                                                    <option disabled selected>--Sélectionnez un état--
                                                                    </option>
                                                                    <?php
                                $currencies_listing = setCurrency();
                                foreach ($currencies_listing as $currency_value => $currency_text) { ?>
                                                                    <option value="<?= $currency_value; ?>"
                                                                        <?= ($value['category_currency'] == $currency_value) ? 'selected':set_select("currency", $currency_value); ?>>
                                                                        <?= $currency_text; ?></option>
                                                                    <?php } ?>
                                                                </select><label for="currency"
                                                                    class="label-control"><span
                                                                        class="text-danger">*</span>Devise </label>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <select class="form-control form-select"
                                                                    id="category_type_<?= $value['category_uid']; ?>"
                                                                    name="category_type" required>
                                                                    <option value="technicien"
                                                                        <?= $value['category_type'] == 'technicien' ? 'selected' :set_select('category_type', 'technicien'); ?>>
                                                                        Technicien</option>
                                                                    <option value="directeur"
                                                                        <?= $value['category_type'] == 'directeur' ? 'selected' :set_select('category_type', 'directeur'); ?>>
                                                                        Directeur</option>
                                                                    <option value="cadre"
                                                                        <?= $value['category_type'] == 'cadre' ? 'selected' : ''; ?>>
                                                                        Cadre</option>
                                                                    <option value="agent"
                                                                        <?= $value['category_type'] == 'agent' ? 'selected' : ''; ?>>
                                                                        Agent de maîtrise</option>
                                                                    <option value="ouvrier"
                                                                        <?= $value['category_type'] == 'ouvrier' ? 'selected' : ''; ?>>
                                                                        Ouvrier / Employé</option>
                                                                </select>
                                                                <label
                                                                    for="category_type_<?= $value['category_uid']; ?>"
                                                                    class="form-label"><span
                                                                        class="text-danger">*</span>Type de
                                                                    catégorie</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="category_tension" name="category_tension"
                                                                    value="<?= ($value['category_tension']) ? $value['category_tension']: set_value('category_tension'); ?>"
                                                                    placeholder="Ex: 150" required>
                                                                <label for="category_tension" class="form-label"><span
                                                                        class="text-danger">*</span>Tension
                                                                    salariale(%)</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="text" class="form-control"
                                                                    id="category_code_<?= $value['category_uid']; ?>"
                                                                    name="category_code"
                                                                    value="<?= htmlspecialchars($value['category_code'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: CXD">
                                                                <label
                                                                    for="category_code_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Code de la catégorie</label>
                                                            </div>
                                                        </div>

                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="category_cost_day_<?= $value['category_uid']; ?>"
                                                                    name="category_cost_day"
                                                                    value="<?= htmlspecialchars($value['category_cost_day'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: 32.5">
                                                                <label
                                                                    for="category_cost_day_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Salaire journalier</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="category_exchange<?= $value['category_uid']; ?>"
                                                                    name="category_exchange"
                                                                    value="<?= htmlspecialchars($value['category_cost_exchange'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: 32.5">
                                                                <label
                                                                    for="category_exchange<?= $value['category_uid']; ?>"
                                                                    class="form-label">Taux de change en monnaie
                                                                    étrangére</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="category_cost_transport_<?= $value['category_uid']; ?>"
                                                                    name="category_cost_transport"
                                                                    value="<?= htmlspecialchars($value['category_cost_transport'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: 3.5">
                                                                <label
                                                                    for="category_cost_transport_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Transport journalier</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="category_cost_location_<?= $value['category_uid']; ?>"
                                                                    name="category_cost_location"
                                                                    value="<?= htmlspecialchars($value['category_cost_location'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: 12.5">
                                                                <label
                                                                    for="category_cost_location_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Avantage logement(%)</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <select class="form-control form-select"
                                                                    id="category_status_<?= $value['category_uid']; ?>"
                                                                    name="category_status" required>
                                                                    <option value="actif"
                                                                        <?= $value['category_status'] == 'actif' ? 'selected' : ''; ?>>
                                                                        Actif</option>
                                                                    <option value="inactif"
                                                                        <?= $value['category_status'] == 'inactif' ? 'selected' : ''; ?>>
                                                                        Inactif</option>
                                                                </select>
                                                                <label
                                                                    for="category_status_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Statut</label>
                                                            </div>
                                                        </div>

                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" class="form-control"
                                                                    id="category_hours_working"
                                                                    name="category_hours_working"
                                                                    value="<?= ($value['category_hours_working']) ? $value['category_hours_working']: set_value('category_hours_working'); ?>"
                                                                    placeholder="Ex: 8">
                                                                <label for="category_hours_working"
                                                                    class="form-label"><span
                                                                        class="text-danger">*</span>Nombre d'heures par
                                                                    jour</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" class="form-control"
                                                                    id="category_number_working_<?= $value['category_uid']; ?>"
                                                                    name="category_number_working"
                                                                    value="<?= htmlspecialchars($value['category_number_working'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: 18">
                                                                <label
                                                                    for="category_number_working_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Nombre de jours ouvrables</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-6">
                                                            <div class="form-floating mb-2">
                                                                <input type="number" class="form-control"
                                                                    id="category_number_holidays_<?= $value['category_uid']; ?>"
                                                                    name="category_number_holidays"
                                                                    value="<?= htmlspecialchars($value['category_number_holidays'], ENT_QUOTES, 'UTF-8'); ?>"
                                                                    placeholder="Ex: 72">
                                                                <label
                                                                    for="category_number_holidays_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Nombre de jours de congés</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-sm-12 col-lg-12">
                                                            <div class="form-floating mb-2">
                                                                <textarea class="form-control"
                                                                    id="category_description_<?= $value['category_uid']; ?>"
                                                                    name="category_description"
                                                                    placeholder="Ex: Decrivez cette categorie"
                                                                    rows="3"><?= htmlspecialchars($value['category_description'], ENT_QUOTES, 'UTF-8'); ?></textarea>

                                                                <label
                                                                    for="category_description_<?= $value['category_uid']; ?>"
                                                                    class="form-label">Description</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Enregistrer les
                                                        modifications</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Offcanvas -->
                                <!-- Modal -->
                                <div class="modal fade" id="categoryDetailsModal" tabindex="-1"
                                    aria-labelledby="categoryDetailsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title font-weight-bold" id="categoryDetailsModalLabel">
                                                    Détails de la
                                                    catégorie</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="text-danger"><i
                                                            class="fa fa-window-close"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>Nom:</strong> <span class="badge bg-primary"
                                                                id="modal_category_name"></span></p>
                                                        <p><strong>Code:</strong> <span class="badge bg-primary"
                                                                id="modal_category_code"></span></p>
                                                        <p><strong>Taux journalier:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_cost_day"></span></p>
                                                        <p><strong>Tension salariale:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_tension"></span>%</p>
                                                        <p><strong>Salaire de base:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_cost_salary"></span></p>
                                                        <p><strong>Transport journalier:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_cost_transport"></span></p>

                                                        <p><strong>Avantages de logement:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_cost_location"></span>%</p>
                                                        <p><strong>Soins medicaux:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_cost_hospital"></span></p>
                                                        <p><strong>Taux de change currency:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_cost_exchange"></span></p>
                                                        <p><strong>Nombre de jours de congés:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_number_holidays"></span></p>
                                                        <p><strong>Nombre de jours ouvrables:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_number_working"></span></p>

                                                        <p><strong>Nombre d'heures par jour:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_hours_working"></span></p>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <p><strong>Classe:</strong> <span class="badge bg-primary"
                                                                id="modal_category_classe"></span></p>
                                                        <p><strong>Echelon:</strong> <span class="badge bg-primary"
                                                                id="modal_category_level"></span></p>
                                                        <p><strong>Type:</strong> <span class="badge bg-primary"
                                                                id="modal_category_type"></span></p>
                                                        <p><strong>Statut:</strong> <span class="badge bg-primary"
                                                                id="modal_category_status"></span>
                                                        </p>

                                                        <p><strong>Créé le:</strong> <span class="badge bg-primary"
                                                                id="modal_category_created_at"></span></p>
                                                        <p><strong>Créé par:</strong> <span class="badge bg-primary"
                                                                id="modal_category_created_by"></span></p>
                                                        <p><strong>Mis à jour le:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_updated_at"></span></p>
                                                        <p><strong>Mis à jour par:</strong> <span
                                                                class="badge bg-primary"
                                                                id="modal_category_updated_by"></span></p>
                                                        <p><strong>Supprimé le:</strong> <span class="badge bg-primary"
                                                                id="modal_category_deleted_at"></span></p>
                                                        <p><strong>Supprimé par:</strong> <span class="badge bg-primary"
                                                                id="modal_category_deleted_by"></span></p>

                                                        <p><strong>Description:</strong> <span class="badge bg-primary"
                                                                id="modal_category_description"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger text-uppercase"
                                                    data-dismiss="modal"><i class="bi bi-x"></i> Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                function showCategoryDetails(category) {
                                    document.getElementById('modal_category_code').textContent = category.category_code;
                                    document.getElementById('modal_category_name').textContent = category.category_name;
                                    document.getElementById('modal_category_classe').textContent = category
                                        .category_classe;
                                    document.getElementById('modal_category_level').textContent = category
                                        .category_level;
                                    document.getElementById('modal_category_tension').textContent = category
                                        .category_tension;
                                    document.getElementById('modal_category_cost_day').textContent = category
                                        .category_cost_day;
                                    document.getElementById('modal_category_cost_salary').textContent = category
                                        .category_cost_salary;
                                    document.getElementById('modal_category_cost_transport').textContent = category
                                        .category_cost_transport;
                                    document.getElementById('modal_category_cost_hospital').textContent = category
                                        .category_cost_hospital;
                                    document.getElementById('modal_category_cost_location').textContent = category
                                        .category_cost_location;
                                    document.getElementById('modal_category_cost_exchange').textContent = category
                                        .category_cost_exchange;
                                    document.getElementById('modal_category_type').textContent = category.category_type;
                                    document.getElementById('modal_category_status').textContent = category
                                        .category_status;
                                    document.getElementById('modal_category_number_holidays').textContent = category
                                        .category_number_holidays;
                                    document.getElementById('modal_category_number_working').textContent = category
                                        .category_number_working;
                                    document.getElementById('modal_category_hours_working').textContent = category
                                        .category_hours_working;
                                    document.getElementById('modal_category_description').textContent = category
                                        .category_description;
                                    document.getElementById('modal_category_created_at').textContent = category
                                        .category_created_at;
                                    document.getElementById('modal_category_created_by').textContent = category
                                        .category_created_by;
                                    document.getElementById('modal_category_updated_at').textContent = category
                                        .category_updated_at;
                                    document.getElementById('modal_category_updated_by').textContent = category
                                        .category_updated_by;
                                    document.getElementById('modal_category_deleted_at').textContent = category
                                        .category_deleted_at;
                                    document.getElementById('modal_category_deleted_by').textContent = category
                                        .category_deleted_by;

                                    var modal = new bootstrap.Modal(document.getElementById('categoryDetailsModal'));
                                    modal.show();
                                }
                                </script>


                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Offcanvas -->
<div class="modal modal-end" tabindex="-1" id="addCategoryOffcanvas" aria-labelledby="addCategoryOffcanvasLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="font-weight-bold text-uppercase" id="addCategoryOffcanvasLabel">
                    Création d'une nouvelle catégorie
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger"><i class="fa fa-window-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('worker/category/create'); ?>" method="post" class="">
                    <div class="row">
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    value="<?= set_value('category_name'); ?>" required placeholder="Ex: Directeurs">
                                <label for="category_name" class="form-label"><span class="text-danger">*</span>Nom de
                                    la
                                    catégorie</label>
                            </div>
                        </div>

                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="category_classe" name="category_classe"
                                    required>
                                    <?php for ($i = 1; $i <= 50; $i++): ?>
                                    <option value="<?= $i; ?>"><?= 'Classe ' . $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <label for="category_classe" class="form-label"><span
                                        class="text-danger">*</span>Classification</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="category_level" name="category_level"
                                    required>
                                    <option value="0">Pas d'Echelon</option>
                                    <?php for ($i = 1; $i <= 50; $i++): ?>
                                    <option value="<?= $i; ?>"><?= 'Niveau ' . $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <label for="category_level" class="form-label text-capitalize"><span
                                        class="text-danger">*</span>
                                    échelonnement </label>
                            </div>
                        </div>

                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <select class="form-select form-control" title="currency" name="category_currency" id="currency">
                                    <option disabled selected>--Sélectionnez un état--</option>
                                    <?php
                                $currencies_listing = setCurrency();
                                foreach ($currencies_listing as $currency_value => $currency_text) { ?>
                                    <option value="<?= $currency_value; ?>" <?=
                                    set_select("currency", $currency_value); ?>><?= $currency_text; ?></option>
                                    <?php } ?>
                                </select><label for="currency" class="label-control"><span
                                        class="text-danger">*</span>Devise </label>

                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <select class="form-control form-select" id="category_type" name="category_type"
                                    required>


                                    <option value="ouvrier" <?= set_select('category_type', 'ouvrier'); ?>>
                                        Ouvrier / Employé</option>

                                    <option value="agent" <?= set_select('category_type', 'agent'); ?>>
                                        Agent de maîtrise</option>

                                    <option value="technicien" <?= set_select('category_type', 'technicien'); ?>>
                                        Technicien</option>
                                    <option value="cadre" <?= set_select('category_type', 'cadre'); ?>>
                                        Cadre</option>
                                    <option value="directeur" <?= set_select('category_type', 'directeur'); ?>>
                                        Directeur</option>
                                </select>
                                <label for="category_type" class="form-label"><span class="text-danger">*</span>Type de
                                    catégorie</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="category_tension"
                                    name="category_tension" value="<?= set_value('category_tension'); ?>"
                                    placeholder="Ex: 150" required>
                                <label for="category_tension" class="form-label"><span
                                        class="text-danger">*</span>Tension
                                    salariale(%)</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="category_code" name="category_code"
                                    value="<?= set_value('category_code'); ?>" placeholder="Ex: CXD">
                                <label for="category_code" class="form-label">Code de la catégorie</label>
                            </div>
                        </div>

                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="category_cost_day"
                                    name="category_cost_day" value="<?= set_value('category_cost_day'); ?>"
                                    placeholder="Ex: 30 000">
                                <label for="category_cost_day" class="form-label">Salaire journalier</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="category_exchange"
                                    name="category_exchange" value="<?= set_value('category_exchange'); ?>"
                                    placeholder="Ex: 32.5">
                                <label for="category_exchange" class="form-label">Taux de change en monnaie
                                    étrangére</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="category_cost_transport"
                                    name="category_cost_transport" value="<?= set_value('category_cost_transport'); ?>"
                                    placeholder="Ex: 5 000">
                                <label for="category_cost_transport" class="form-label">Transport journalier</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" step="0.01" class="form-control" id="category_cost_location"
                                    name="category_cost_location" value="<?= set_value('category_cost_location'); ?>"
                                    placeholder="Ex: 150 000">
                                <label for="category_cost_location" class="form-label">Avantage Logement(%)</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="category_hours_working"
                                    name="category_hours_working" value="<?= set_value('category_hours_working'); ?>"
                                    placeholder="Ex: 8">
                                <label for="category_hours_working" class="form-label"><span
                                        class="text-danger">*</span>Nombre
                                    d'heures par jour</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="category_number_working"
                                    name="category_number_working" value="<?= set_value('category_number_working'); ?>"
                                    placeholder="Ex: 18">
                                <label for="category_number_working" class="form-label"><span
                                        class="text-danger">*</span>Nombre
                                    de jours ouvrables</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-6">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" id="category_number_holidays"
                                    name="category_number_holidays"
                                    value="<?= set_value('category_number_holidays'); ?>" placeholder="Ex: 72">
                                <label for="category_number_holidays" class="form-label"><span
                                        class="text-danger">*</span>Nombre de jours de congés</label>
                            </div>
                        </div>
                        <div class=" col-sm-12 col-lg-12">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="category_description" name="category_description"
                                    placeholder="Ex: Decrivez cette categorie"
                                    rows="3"><?= set_value('category_description'); ?></textarea>
                                <label for="category_description" class="form-label">Description</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Enregistrer la nouvelle catégorie</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Offcanvas -->