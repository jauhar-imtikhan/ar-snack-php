<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Blank Page | Simple - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/admin-') ?>assets/images/favicon.ico">
    <!-- App css -->
    <link href="<?= base_url('assets/admin-') ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <?php include APPPATH . 'views\admin\components\navbar.php'; ?>
        <!-- end Topbar --> <!-- ========== Left Sidebar Start ========== -->

        <div class="left-side-menu">


            <div class="user-box">
                <div class="float-left">
                    <img src="<?= base_url('assets/admin-') ?>assets/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
                </div>
                <div class="user-info">
                    <a href="#">Stanley Jones</a>
                    <p class="text-muted m-0">Administrator</p>
                </div>
            </div>

            <!--- Sidemenu -->
            <?php include APPPATH . 'views\admin\components\sidebar.php'; ?>
            <!-- End Sidebar -->

            <div class="clearfix"></div>


        </div>

        <div class="content-page">
            <div class="content">

                <!-- Start container-fluid -->
                <div class="container-fluid">

                    <!-- start  -->
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <h4 class="header-title">Blank Page</h4>
                            </div>

                        </div>
                    </div>
                    <!-- end -->

                </div>
                <!-- end container-fluid -->


            </div>
            <!-- end content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            &copy; AR SNACK all right reserved 2023 - <?= date('Y') ?> &copy; Admin Dashboard By <a href="https://github.com/jauhar-imtikhan">Jauhar Imtikhan</a>
                        </div>
                    </div>
                </div>
            </footer>


            <!-- end Footer -->
        </div>
        <!-- END content-page -->

    </div>
    <!-- END wrapper -->


    <!-- Right Sidebar -->
    <div class="right-bar">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close"></i>
            </a>
            <h5 class="font-16 m-0 text-white">Custom Tampilan</h5>
        </div>
        <div class="slimscroll-menu">

            <div class="p-4">
                <div class="mb-2">
                    <img src="<?= base_url('assets/admin-') ?>assets/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                    <label class="custom-control-label" for="light-mode-switch">Mode Terang</label>
                </div>

                <div class="mb-2">
                    <img src="<?= base_url('assets/admin-') ?>assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="<?= base_url('assets/admin-') ?>assets/css/bootstrap-dark.min.css" data-appStyle="<?= base_url('assets/admin-') ?>assets/css/app-dark.min.css" />
                    <label class="custom-control-label" for="dark-mode-switch">Mode Gelap</label>
                </div>

            </div>
        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
        <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Pilih Tampilan
    </a>

    <!-- Vendor js -->
    <script src="<?= base_url('assets/admin-') ?>assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url('assets/admin-') ?>assets/js/app.min.js"></script>

</body>

</html>