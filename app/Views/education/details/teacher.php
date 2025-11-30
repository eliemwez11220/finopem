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
                                <a href="<?= base_url(relativePath: 'education/teachers'); ?>"
                                    class="btn btn-dark btn-sm text-uppercase"
                                    title="Cliquer pour  afficher la liste des enseignants">
                                    <i class="fa fa-reply-all"></i> Revenir a la liste
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item text-center">
                            <img src="<?= isset($teacher['teacher_picture']) ? base_url('public/uploads/images/'.$teacher['teacher_picture']) : 'default-avatar.png'; ?>"
                                alt="Photo de l'enseignant" class="avatar avatar-xxl">
                        </li>
                        <li class="list-group-item"><strong><i class="fa fa-id-card"></i> Matricule:</strong>
                            <?= isset($teacher['teacher_code']) ? esc($teacher['teacher_code']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong><i class="fa fa-user"></i> Nom:</strong>
                            <?= isset($teacher['teacher_firstname']) ? esc($teacher['teacher_firstname']) : 'N/A'; ?>
                        </li>
                        <li class="list-group-item"><strong><i class="fa fa-user"></i> Postnom:</strong>
                            <?= isset($teacher['teacher_lastname']) ? esc($teacher['teacher_lastname']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong><i class="fa fa-user"></i> Prénom:</strong>
                            <?= isset($teacher['teacher_surname']) ? esc($teacher['teacher_surname']) : 'N/A'; ?></li>

                    </ul>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item"><strong><i class="fa fa-venus-mars"></i> Sexe:</strong>
                            <?= isset($teacher['teacher_gender']) ? ($teacher['teacher_gender'] === 'masculin' ? 'Masculin' : 'Féminin') : 'N/A'; ?>
                        </li>
                        <li class="list-group-item"><strong><i class="fa fa-briefcase"></i> Type:</strong>
                            <?= isset($teacher['teacher_type']) ? esc($teacher['teacher_type']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong><i class="fa fa-graduation-cap"></i> Spécialité:</strong>
                            <?= isset($teacher['teacher_speciality']) ? esc($teacher['teacher_speciality']) : 'N/A'; ?>
                        </li>
                        <li class="list-group-item"><strong><i class="fa fa-phone"></i> Numéro de Contacts:</strong>
                            <?= isset($teacher['teacher_phone']) ? esc($teacher['teacher_phone']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong><i class="fa fa-envelope"></i> Adresse e-mail:</strong>
                            <?= isset($teacher['teacher_email']) ? esc($teacher['teacher_email']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong><i class="fa fa-map-marker"></i> Adresse:</strong>
                            <?= isset($teacher['teacher_address']) ? esc($teacher['teacher_address']) : 'N/A'; ?></li>
                        <li class="list-group-item"><strong><i class="fa fa-map-pin"></i> Lieu de Naissance:</strong>
                            <?= isset($teacher['teacher_born_place']) ? esc($teacher['teacher_born_place']) : 'N/A'; ?>
                        </li>
                        <li class="list-group-item"><strong><i class="fa fa-calendar"></i> Date de Naissance:</strong>
                            <?= isset($teacher['teacher_born_date']) ? esc($teacher['teacher_born_date']) : 'N/A'; ?>
                        </li>
                        <li class="list-group-item"><strong><i class="fa fa-sticky-note"></i> Notes:</strong>
                            <?= isset($teacher['teacher_notes']) ? esc($teacher['teacher_notes']) : 'N/A'; ?></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-12">
                   
                    <ul class="list-group">
                        <li class="list-group-item text-center bg-info">
                            <h3 class="text-uppercase font-weight-bold">Titulariats</h3>
                        </li>
                        <?php if(isset($holders) && (!empty($holders))): ?>
                        <?php foreach($holders as $holder ): ?>
                        <li class="list-group-item text-uppercase">
                            <strong>
                                <i class="fa fa-bookmark"></i> 
                                <?= $holder['year_started']. '-'.$holder['year_ended'];?>:
                            </strong>
                            <?= setDegresLevels($holder['degree_code'], 'f');?>
                            <?= $holder['classe_subname'];?> <?= $holder['option_name'];?>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>