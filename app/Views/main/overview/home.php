<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mb-2 <?= checkModuleAccess(null, 'overview'); ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Tableau de bord</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Vue d'ensemble</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-6">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-4"
                                    src="<?= (session()->schoollogo) ? base_url('public/uploads/images/'.session()->schoollogo) : base_url('public/img/logo/favicon.png'); ?>"
                                    alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username text-uppercase small font-weight-bold">
                                <?= session()->schoolname; ?>
                            </h3>
                            <h5 class="widget-user-desc text-uppercase small font-weight-bold">Gestionnaire :
                                <?= session()->schoolmanager; ?></h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Code ID <span
                                            class="float-right badge bg-primary text-capitalize"><?= session()->schoolcode; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Téléphone <span
                                            class="float-right badge bg-primary text-capitalize"><?= session()->schoolphone; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Email <span
                                            class="float-right badge bg-primary text-lowercase"><?= session()->schoolemail; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Adresse <span
                                            class="float-right badge bg-primary text-capitalize"><?= session()->schooladdress; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username text-uppercase"><?= session()->fullname; ?></h3>
                            <h5 class="widget-user-desc text-uppercase"><?= session()->role; ?> </h5>
                        </div>
                        <div class="avatar avatar-lg widget-user-image">
                            <img class="avatar avatar-lg"
                                src="<?= (session()->avatar) ? base_url('public/uploads/images/'.session()->avatar) : base_url('public/img/avatar.png'); ?>"
                                alt="Logo">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header text-capitalize">Identifiant</h5>
                                        <span class="description-text font-weight-bold"><?= session()->username; ?>
                                        </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">E-mail</h5>
                                        <span class="description-text font-weight-bold"><?= session()->email; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>