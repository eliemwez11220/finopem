<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('profile'); ?>">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion etablissements</li>
                                <li class="breadcrumb-item active" aria-current="page">Listing</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="card-tools float-right">
                            <a class="btn btn-info btnrounded"  href="<?= base_url('admincustomer/createschool'); ?>">
                                <i class="fas fa-plus"></i> Ajouter un etablissement</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="text-center">
                <h1 class="alert alert-info font-weight-bold">Mes etablissements</h1>
            </div>
            <div class="row">
                <?php if(isset($schools) && (! empty($schools))):?>
                <?php  foreach($schools as $school): ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card shadow-lg card-radius">
                            <div class="card-body text-center">
                            <?php 
                             $logo = $school['school_logo']; 
                             $path_logo = base_url('public/uploads/images/'.$logo);
                             $magstore_logo = base_url('public/img/logo/favicon.png');
                             $valid_logo = (!empty($logo))? $path_logo: $magstore_logo;
                             ?>
                             <img src="<?= $valid_logo; ?>" alt="..." class="school-logo school-logo-medium">
                            
                                <h3 class="h5 font-weight-bold text-uppercase">
                                    <?= $school['school_fullname']; ?>
                                </h3>
                                <a class="btn btn-info btnrounded" 
                href="<?= base_url('admincustomer/startedSession/'.$school['school_token']); ?>">
                    <i class="fas fa-info-circle"></i> Consulter</a>
                            </div>
                        </div>
                    </div>
                <?php  endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>