<div class="content-wrapper <?= checkModuleAccess('teachers'); ?>">
    <div class="content pt-2 p-md-2 p-lg-2">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12 col-lg-12">
                    <nav aria-label="breadcrumb" class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"
                                    class="text-primary">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignements</li>
                            <li class="breadcrumb-item active" aria-current="page">Enseignants</li>
                            <li class="ml-3">
                                <a href="#" class="btn btn-primary btn-sm text-uppercase" data-toggle="modal"
                                    data-target="#createTeacherModal" title="Cliquer pour ajouter un nouvel Enseignant">
                                    <i class="fa fa-plus"></i> Nouvel Enseignant
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-center">
                            <h1 class="text-uppercase font-weight-bold">
                                Repertoires des Enseignants
                            </h1>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesExample2"
                                    class="table table-sm table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-uppercase small">
                                            <th>#</th>
                                            <th>Matricule</th>
                                            <th>Noms</th>
                                            <th>Sexe</th>
                                            <th>Spécialité</th>
                                            <th>Contacts</th>
                                            <th>Type</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        if (isset($teachers) && (!empty($teachers))):
                                            foreach ($teachers as $key => $value):
                                                $status = (!empty(esc($value['teacher_status'])) ? esc($value['teacher_status']) : 'inactif');

                                                $teacheravatar = $value['teacher_picture'];

                                                $avatar = base_url('public/uploads/images/' . $teacheravatar);


                                                $defavatar = ($value['teacher_gender'] == 'masculin') ? 'avatar.png' : 'expertwoman.png';
                                                $pathdefavatar = base_url('public/img/' . $defavatar);

                                        ?>
                                        <tr class="small">
                                            <td scope="1">
                                                <a href="#" class="btn" data-toggle="modal"
                                                    data-target="#changeTeacherModal_<?= esc($value['teacher_id']); ?>"
                                                    title="Cliquer pour changer la photo">
                                                    <img src="<?= (!empty($teacheravatar)) ? $avatar : $pathdefavatar; ?>"
                                                        alt="..." class="avatar avatar-xs">
                                                </a>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['teacher_code']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['teacher_firstname']); ?>
                                                <?= trim($value['teacher_lastname']); ?>
                                                <?= trim($value['teacher_surname']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= ($value['teacher_gender'] == 'masculin') ? 'M' : 'F'; ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['teacher_speciality']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['teacher_phone']); ?>
                                            </td>
                                            <td class="text-uppercase">
                                                <?= trim($value['teacher_type']); ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('education/changeStatus/teacher/' . esc($status) . '/' . esc($value['teacher_id'])); ?>"
                                                    onclick="return confirm('Voulez-vous vraiment changer le statut de cet element?');">
                                                    <span
                                                        class="badge  <?= (esc($status) == 'actif') ? 'badge-info' : 'badge-danger'; ?> text-capitalize">
                                                        <?= $status; ?> </span>
                                                </a>
                                            </td>
                                            <td width="2px" class="text-center">

                                                <?php $access_delete = (session()->get('admin') == TRUE or session()->get('all') == TRUE) ? '' : 'disabled'; ?>
                                                <a href="<?= base_url('education/remove/teacher/' . ($value['teacher_id'])); ?>"
                                                    class="<?= $access_delete; ?> btn btn-xs btn-outline-danger"
                                                    onclick="return confirm('Etes-vous sur de vouloir supprimer ce candidat? Notez que son dossier sera detruit definitivement.'); false;">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour supprimer ce candidat">
                                                        <i class="fa fa-window-close fa-2x"></i></span>
                                                </a>
                                                <a href="#" class="btn btn-xs btn-outline-warning" data-toggle="modal"
                                                    data-target="#editTeacherModal_<?= esc($value['teacher_id']); ?>"
                                                    title="Cliquer pour modifier cette information">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>

                                                <a href="<?= base_url('education/details/teacher/' . esc($value['teacher_token'])); ?>"
                                                    class="btn btn-xs btn-outline-info" data-toggle="tooltip"
                                                    data-placement="bottom" title="Cliquer pour voir les details">
                                                    <i class="fa fa-info-circle fa-2x"></i>
                                                </a>
                                                <a data-toggle="modal"
                                                    data-target="#config_<?= esc($value['teacher_id']); ?>" href="#"
                                                    class="btn btn-xs btn-outline-dark">
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="Cliquer pour configurer le titulariat classe">
                                                        <i class="fa fa-cogs fa-2x"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal for editing a teacher -->
                                        <div class="modal fade" id="editTeacherModal_<?= esc($value['teacher_id']); ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="editTeacherModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title font-weight-bold text-uppercase"
                                                            id="editTeacherModalLabel">
                                                            Modification des Informations de l'Enseignant</h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    // Form validation services call
                                                    $validation = \Config\Services::validation();

                                                    // Form attributes
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open_multipart(base_url('education-teacher'), $attributes);
                                                    ?>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="token" id="editTeacherId"
                                                            value="<?= $value['teacher_token']; ?>">
                                                        <input type="hidden" name="action" id="editTeacherAction"
                                                            value="update">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text" name="code" id="editCode"
                                                                        class="form-control text-uppercase <?= ($validation->hasError('code')) ? ' is-invalid' : '' ?>"
                                                                        placeholder="Matricule" autocomplete="off"
                                                                        value="<?= ($value['teacher_code']) ? ($value['teacher_code']): set_value('code'); ?>"
                                                                        required>
                                                                    <?php if ($validation->hasError('code')) { ?>
                                                                    <span class="invalid-feedback">
                                                                        <?= $validation->getError('code'); ?></span>
                                                                    <?php } ?>
                                                                    <label for="editCode"><span
                                                                            class="text-danger">*</span>
                                                                        Matricule d'identification de l'Enseignant
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherFirstName"
                                                                        name="teacher_firstname"
                                                                        placeholder="Ex: Ilunga"
                                                                        value="<?= ($value['teacher_firstname']) ? ($value['teacher_firstname']): set_value('teacher_firstname'); ?>"
                                                                        required>
                                                                    <label for="editTeacherFirstName"><span
                                                                            class="text-danger">*</span>Nom de
                                                                        l'Enseignant</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherLastName" name="teacher_lastname"
                                                                        placeholder="Ex: Ilunga"
                                                                        value="<?= ($value['teacher_lastname']) ? ($value['teacher_lastname']): set_value('teacher_lastname'); ?>"
                                                                        required>
                                                                    <label for="editTeacherLastName"><span
                                                                            class="text-danger">*</span>Postnom</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherSurname" name="teacher_surname"
                                                                        placeholder="Ex: Peter"
                                                                        value="<?= ($value['teacher_surname']) ? ($value['teacher_surname']): set_value('teacher_surname'); ?>">
                                                                    <label for="editTeacherSurname">Prénom</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="editTeacherGender" name="teacher_gender"
                                                                        required>
                                                                        <option value="masculin"
                                                                            <?= ($value['teacher_gender'] == 'masculin') ? 'selected' : ''; ?>>
                                                                            Masculin
                                                                        </option>
                                                                        <option value="feminin"
                                                                            <?= ($value['teacher_gender'] == 'feminin') ? 'selected' : ''; ?>>
                                                                            Féminin
                                                                        </option>
                                                                    </select>
                                                                    <label for="editTeacherGender"><span
                                                                            class="text-danger">*</span>Sexe</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="editTeacherStatus" name="teacher_status"
                                                                        required>
                                                                        <option value="actif"
                                                                            <?= ($value['teacher_status'] == 'actif') ? 'selected' : ''; ?>>
                                                                            Actif</option>
                                                                        <option value="inactif"
                                                                            <?= ($value['teacher_status'] == 'inactif') ? 'selected' : ''; ?>>
                                                                            Inactif</option>
                                                                    </select>
                                                                    <label for="editTeacherStatus"><span
                                                                            class="text-danger">*</span>Statut</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <select class="form-control text-uppercase"
                                                                        id="editTeacherType" name="teacher_type"
                                                                        required>
                                                                        <option value="permanent"
                                                                            <?= ($value['teacher_type'] == 'permanent') ? 'selected' : ''; ?>>
                                                                            Permanent</option>
                                                                        <option value="contractuel"
                                                                            <?= ($value['teacher_type'] == 'contractuel') ? 'selected' : ''; ?>>
                                                                            Contractuel</option>
                                                                    </select>
                                                                    <label for="editTeacherType"><span
                                                                            class="text-danger">*</span>Type
                                                                        d'Enseignant</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherSpeciality"
                                                                        name="teacher_speciality"
                                                                        placeholder="Ex: INFORMATICIEN"
                                                                        value="<?= ($value['teacher_speciality']) ? ($value['teacher_speciality']): set_value('teacher_speciality'); ?>"
                                                                        required>
                                                                    <label for="editTeacherSpeciality"><span
                                                                            class="text-danger">*</span>Spécialité</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherPhone" name="teacher_phone"
                                                                        placeholder="Ex: +243858533285"
                                                                        value="<?= ($value['teacher_phone']) ? ($value['teacher_phone']): set_value('teacher_phone'); ?>"
                                                                        required>
                                                                    <label for="editTeacherPhone"><span
                                                                            class="text-danger">*</span>Numéro de
                                                                        Contacts</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-lowercase"
                                                                        id="editTeacherEmail" name="teacher_email"
                                                                        placeholder="Ex: ilunga@ditotase.com"
                                                                        value="<?= ($value['teacher_email']) ? ($value['teacher_email']): set_value('teacher_email'); ?>">
                                                                    <label for="editTeacherEmail">Adresse e-mail</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherBirthPlace"
                                                                        name="teacher_born_place"
                                                                        placeholder="Ex: Kinshasa"
                                                                        value="<?= ($value['teacher_born_place']) ? ($value['teacher_born_place']) : set_value('teacher_birth_place'); ?>">
                                                                    <label for="editTeacherBirthPlace"><span
                                                                            class="text-danger"></span>Lieu de
                                                                        Naissance</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="date" class="form-control"
                                                                        id="editTeacherBirthDate"
                                                                        name="teacher_born_date"
                                                                        placeholder="Ex: 1990-01-01"
                                                                        value="<?= ($value['teacher_born_date']) ? ($value['teacher_born_date']) : set_value('teacher_birth_date'); ?>">
                                                                    <label for="editTeacherBirthDate"><span
                                                                            class="text-danger"></span>Date de
                                                                        Naissance</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-lg-12 mb-2">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control text-uppercase"
                                                                        id="editTeacherAddress" name="teacher_address"
                                                                        placeholder="Ex: 123 Rue Principale"
                                                                        value="<?= ($value['teacher_address']) ? ($value['teacher_address']) : set_value('teacher_address'); ?>">
                                                                    <label for="editTeacherAddress"><span
                                                                            class="text-danger"></span>Adresse</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-lg-12 mb-2">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control text-uppercase"
                                                                        id="editTeacherNotes" name="teacher_notes"
                                                                        placeholder="Ex: Notes supplémentaires"><?= ($value['teacher_notes']) ? ($value['teacher_notes']) : set_value('teacher_notes'); ?></textarea>
                                                                    <label for="editTeacherNotes">Notes</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-warning">Modifier
                                                            l'enseignant</button>
                                                    </div>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for change a teacher -->
                                        <div class="modal fade"
                                            id="changeTeacherModal_<?= esc($value['teacher_id']); ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="changeTeacherModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title font-weight-bold text-uppercase"
                                                            id="changeTeacherModalLabel">
                                                            Modification photo de l'Enseignant</h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    // Form validation services call
                                                    $validation = \Config\Services::validation();

                                                    // Form attributes
                                                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                                                    echo form_open_multipart(base_url('education-teacher'), $attributes);
                                                    ?>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="token" id="editTeacherId"
                                                            value="<?= $value['teacher_token']; ?>">

                                                        <input type="hidden" name="teacher_firstname"
                                                            id="teacher_firstname"
                                                            value="<?= $value['teacher_firstname']; ?>">

                                                        <input type="hidden" name="teacher_phone" id="teacher_phone"
                                                            value="<?= $value['teacher_phone']; ?>">


                                                        <input type="hidden" name="db_teacher_picture"
                                                            id="db_teacher_picture"
                                                            value="<?= $value['teacher_picture']; ?>">
                                                        <input type="hidden" name="action" id="editTeacherAction"
                                                            value="picture">
                                                        <div class="row">
                                                            <div class="col-sm-8 col-lg-8 mb-2">
                                                                <img src="<?= (!empty($teacheravatar)) ? $avatar : $pathdefavatar; ?>"
                                                                    alt="..." class="avatar avatar-xxl">
                                                            </div>
                                                            <div class="col-sm-4 col-lg-4 mt-5 py-5">
                                                                <div class="form-floating">
                                                                    <input type="file"
                                                                        class="form-control-file form-control"
                                                                        id="teacherPicture" name="teacher_picture"
                                                                        required>
                                                                    <label for="teacherPicture">
                                                                        <span class="text-danger">*</span>
                                                                        Charger une photo de profil
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-success">Changer photo de
                                                            l'enseignant</button>
                                                    </div>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal for editing course configuration -->
                                        <div class="modal fade" id="config_<?= $value['teacher_id']; ?>" tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="editCourseModalLabel<?= $value['teacher_id']; ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-dark">
                                                        <h5 class="modal-title text-uppercase"
                                                            id="editCourseModalLabel<?= $value['teacher_id']; ?>">
                                                            Configuration titulariat d'une classe</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>


                                                    <form action="<?= base_url('education-teacher'); ?>" method="post">
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col-lg-12 col-sm-12">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item text-center bg-info">
                                                                            <h3 class="text-uppercase font-weight-bold">
                                                                                Titulaire Actuel:</h3>
                                                                        </li>
                                                                        <?php if(isset($holders) && (!empty($holders))): ?>
                                                                        <?php foreach($holders as $holder ): ?>
                                                                        <li class="list-group-item">
                                                                            <strong><i class="fa fa-bookmark"></i>
                                                                                Classe:</strong>
                                                                            <?= setDegresLevels($holder['degree_code'], 'f');?>
                                                                            <?= $holder['classe_subname'];?>
                                                                            <?= $holder['section_name'];?>
                                                                            [<?= $holder['option_name'];?>]
                                                                        </li>
                                                                        <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="teacher"
                                                                value="<?= $value['teacher_id']; ?>">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-12">
                                                                    <div class="form-floating mb-2">
                                                                        <select
                                                                            class="select2 form-control text-uppercase"
                                                                            id="classe<?= $value['teacher_id']; ?>"
                                                                            name="classe" required>
                                                                            <option disabled selected>--Sélectionnez une
                                                                                classe--</option>
                                                                            <?php if (isset($classes) && (!empty($classes))): ?>
                                                                            <?php foreach ($classes as $classe): ?>
                                                                            <option
                                                                                value="<?= esc($classe['classe_id']); ?>">
                                                                                <?= setDegresLevels($classe['degree_code'], 'f'); ?>
                                                                                <?= $classe['classe_subname']; ?>
                                                                                <?= $classe['section_name']; ?>
                                                                                [<?= $classe['option_name']; ?>]
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                            <?php endif; ?>
                                                                        </select>
                                                                        <label
                                                                            for="classe<?= $value['teacher_id']; ?>">Classe</label>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-12 col-lg-12">
                                                                    <div class="form-floating mb-2">
                                                                        <select class="form-control text-uppercase"
                                                                            id="status<?= $value['teacher_id']; ?>"
                                                                            name="status" required>
                                                                            <option value="actif">Actif</option>
                                                                            <option value="inactif">Inactif</option>
                                                                        </select>
                                                                        <label
                                                                            for="status<?= $value['teacher_id']; ?>">Statut</label>

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-12">
                                                                    <div class="form-floating mb-2">
                                                                        <input type="text" class="form-control"
                                                                            id="notes<?= $value['teacher_id']; ?>"
                                                                            name="notes" value="<?= old('notes'); ?>"
                                                                            placeholder="Observation sur le titulariat">
                                                                        <label
                                                                            for="notes<?= $value['teacher_id']; ?>">Notes
                                                                            internes</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-dark">
                                                                <i class="fas fa-check-circle"></i> Appliquer la
                                                                configuration</button>
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
            </div>
        </div>
    </section>
</div>
<!-- Modal for creating a new teacher -->
<div class="modal fade" id="createTeacherModal" tabindex="-1" role="dialog" aria-labelledby="createTeacherModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold text-uppercase" id="createTeacherModalLabel">
                    Création d'un Nouvel Enseignant</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php

            $last_teacher_code = '';
            if (isset($teachers) && !empty($teachers)) {
                // Sort teachers by creation date in descending order
                usort($teachers, function ($a, $b) {
                    return strtotime($b['teacher_created_at']) - strtotime($a['teacher_created_at']);
                });
                $last_teacher = reset($teachers); // Get the most recent teacher record
                $last_teacher_code = isset($last_teacher['teacher_code']) ? $last_teacher['teacher_code'] : '';
            }
                    //$last_teacher_code = (isset($teacher) && (!empty($teacher))) ? $teacher['teacher_code'] : '';
                    $last_teacher_number = intval($last_teacher_code);

                    $teacher_code_start =  substr(session()->get('yearstarted'), 2);
                    $teacher_code_end =  substr(session()->get('yearclosing'), 2);
                
                    $teacher_code =  $teacher_code_start.$teacher_code_end . '01';
                    $new_teacher_code = (!empty($last_teacher_number)) ? $last_teacher_number + 1 : $teacher_code;
                    
                    //form validation services call
                    $validation = \Config\Services::validation();

                    //form
                    $attributes = array('role' => 'form', 'autocomplete' => 'off');
                    echo form_open_multipart(base_url('education-teacher'), $attributes);
                    ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" name="code" id="code"
                                class="form-control text-uppercase <?= ($validation->hasError('code')) ? ' is-invalid' : '' ?>"
                                placeholder="Matricule" autocomplete="off"
                                value="<?= (set_value('code')) ? set_value('code') : $new_teacher_code ?>">
                            <?php if ($validation->hasError('code')) { ?>
                            <span class="invalid-feedback">
                                <?= $validation->getError('code'); ?></span>
                            <?php } ?>
                            <label for="code"><span class="text-danger">*</span>
                                Matricule d'identification de l'Enseignant
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" id="teacherFirstName"
                                name="teacher_firstname" placeholder="Ex: Ilunga"
                                value="<?= (set_value('teacher_firstname')) ? set_value('teacher_firstname') : ''; ?>"
                                required>

                            <label for="teacherFirstName"><span class="text-danger">*</span>Nom de l'Enseignant</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" id="teacher_lastname"
                                name="teacher_lastname" placeholder="Ex: Ilunga"
                                value="<?= (set_value('teacher_lastname')) ? set_value('teacher_lastname') : ''; ?>">

                            <label for="teacher_lastname"><span class="text-danger"></span>Postnom</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" id="teacher_surname"
                                name="teacher_surname" placeholder="Ex: Peter"
                                value="<?= (set_value('teacher_surname')) ? set_value('teacher_surname') : ''; ?>">

                            <label for="teacher_surname"><span class="text-danger"></span>Prénom</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="teacherGender" name="teacher_gender"
                                required>
                                <option value="masculin"
                                    <?= (set_value('teacher_gender') == 'masculin') ? 'selected' : ''; ?>>Masculin
                                </option>
                                <option value="feminin"
                                    <?= (set_value('teacher_gender') == 'feminin') ? 'selected' : ''; ?>>Féminin
                                </option>
                            </select>

                            <label for="teacherGender"><span class="text-danger">*</span>Sexe</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <select class="form-control text-uppercase" id="editTeacherType" name="teacher_type"
                                required>
                                <option value="permanent">Permanent</option>
                                <option value="contractuel">Contractuel</option>
                            </select>
                            <label for="editTeacherType">
                                <span class="text-danger">*</span>Type d'Enseignant</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" id="teacherSpeciality"
                                name="teacher_speciality" placeholder="Ex: INFORMATICIEN"
                                value="<?= (set_value('teacher_speciality')) ? set_value('teacher_speciality') : ''; ?>"
                                required>

                            <label for="teacherSpeciality"><span class="text-danger">*</span>Spécialité</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" id="teacherPhone"
                                name="teacher_phone" placeholder="Ex: +243858533285"
                                value="<?= (set_value('teacher_phone')) ? set_value('teacher_phone') : ''; ?>" required>
                            <label for="teacherPhone"><span class="text-danger">*</span>Numéro de Contacts</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-lowercase" id="teacher_email"
                                name="teacher_email" placeholder="Ex: ilunga@ditotase.com"
                                value="<?= (set_value('teacher_email')) ? set_value('teacher_email') : ''; ?>">
                            <label for="teacher_email">Adresse e-mail</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control text-uppercase" id="editTeacherAddress"
                                name="teacher_address" placeholder="Ex: 123 Rue Principale"
                                value="<?= set_value('teacher_address'); ?>">
                            <label for="editTeacherAddress"><span class="text-danger"></span>Adresse</label>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <textarea class="form-control text-uppercase" id="editTeacherNotes" name="teacher_notes"
                                placeholder="Ex: Notes supplémentaires"><?= set_value('teacher_notes'); ?></textarea>
                            <label for="editTeacherNotes">Notes</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 mb-2">
                        <div class="form-floating">
                            <input type="file" class="form-control-file form-control" id="teacherPicture"
                                name="teacher_picture">
                            <label for="teacherPicture">Photo de profil</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer l'enseignant</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>