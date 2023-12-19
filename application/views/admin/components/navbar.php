<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">



        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-bell noti-icon"></i>
                <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="font-16 m-0">
                        <span class="float-right">
                            <a href="" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div class="slimscroll noti-scroll">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                        <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info"><i class="mdi mdi-account-plus"></i></div>
                        <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="mdi mdi-heart"></i></div>
                        <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">3 days ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                        <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-heart"></i>
                        </div>
                        <p class="notify-details">Carlos Crouch liked <b>Admin</b>
                            <small class="text-muted">13 days ago</small>
                        </p>
                    </a>
                </div>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-primary text-center notify-item notify-all ">
                    View all
                    <i class="fi-arrow-right"></i>
                </a>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= base_url('uploads/user-profile/') . user_login()['img_profile'] ?>" alt="user-image" class="d-lg-none d-md-none mt-3 d-block rounded-circle">
                <img src="<?= base_url('uploads/user-profile/') . user_login()['img_profile'] ?>" alt="user-image" class="d-none d-lg-inline-block d-md-inline-block  rounded-circle">
                <span class="pro-user-name ml-1">
                    <?= ucfirst(user_login()['nama_lengkap']) ?><i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang</h6>
                </div>

                <!-- item-->
                <a href="<?= site_url('profile') ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-outline"></i>
                    <span>Profile</span>
                </a>

                <!-- item-->
                <a href="<?= site_url('settings') ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-settings-outline"></i>
                    <span>Settings</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="<?= site_url('logout') ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout-variant"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                <i class="mdi mdi-settings-outline noti-icon"></i>
            </a>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="index.html" class="logo text-center logo-dark">
            <span class="logo-lg">
                <!-- <img src="<?= base_url('assets/admin-') ?>assets/images/logo-dark.png" alt="" height="26"> -->
                <span class="logo-lg-text-dark">Simple</span>
            </span>
            <span class="logo-sm">
                <span class="logo-lg-text-dark">S</span>
                <!-- <img src="<?= base_url('assets/admin-') ?>assets/images/logo-sm.png" alt="" height="22"> -->
            </span>
        </a>

        <a href="index.html" class="logo text-center logo-light">
            <span class="logo-lg">
                <!-- <img src="<?= base_url('assets/admin-') ?>assets/images/logo-light.png" alt="" height="26"> -->
                <span class="logo-lg-text-light">Simple</span>
            </span>
            <span class="logo-sm">
                <span class="logo-lg-text-light">S</span>
                <!-- <img src="<?= base_url('assets/admin-') ?>assets/images/logo-sm.png" alt="" height="22"> -->
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

        <li class="d-none d-sm-block">
            <form class="app-search" action="" method="post">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" id="search" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li>
    </ul>
</div>