<?php
$data_toko = $this->db->get_where('tbl_config_toko', ['config_toko_id' => '1'])->row_array();
$data_favicon = $this->db->get_where('tbl_favicon', ['favicon_id' => '1'])->row_array();
$data_seo = $this->db->get_where('tbl_seo', ['seo_id' => '1'])->row_array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= $data_seo['meta_description'] ?>" name="description" />
    <meta content="<?= $data_seo['meta_author'] ?>" name="author" />
    <meta content="<?= $data_seo['meta_title'] ?>" name="title" />
    <meta content="<?= $data_seo['meta_keyword'] ?>" name="keywords" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?= $data_favicon['favicon_field'] ?>
    <link href="<?= base_url('assets/admin-') ?>assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('assets/admin-assets/libs') ?>/codemirror/codemirror.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin-assets/libs') ?>/codemirror/theme/monokai.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>


    <?php include APPPATH . '/third_party/config_theme.php' ?>
</head>

<body>

    <div id="wrapper">


        <?php include APPPATH . 'views/admin/components/navbar.php'; ?>

        <div class="left-side-menu">


            <div class="user-box">
                <div class="float-left">
                    <img src="<?= base_url('uploads/user-profile/') . user_login()['img_profile'] ?>" alt="" class="avatar-md rounded-circle">
                </div>
                <div class="user-info">
                    <a href="#"><?= ucfirst(user_login()['nama_lengkap']) ?></a>
                    <p class="text-muted m-0"><?= ucfirst(user_login()['role']) ?></p>
                </div>
            </div>

            <?php include APPPATH . 'views/admin/components/sidebar.php'; ?>

            <div class="clearfix"></div>


        </div>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <?php
                    if (isset($page)) {
                        if (file_exists(APPPATH . 'views/admin/pages/' . $page . '.php')) {
                            include APPPATH . 'views/admin/pages/' . $page . '.php';
                        } else {
                            include APPPATH . 'views/errors/404.php';
                        }
                    } else {
                        include APPPATH . 'views/errors/404.php';
                    }


                    ?>

                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $data_toko['copyright'] ?>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>

            </div>
        </div>
    </div>


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
                    <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" />
                    <label class="custom-control-label" for="light-mode-switch">Mode Terang</label>
                </div>

                <div class="mb-2">
                    <img src="<?= base_url('assets/admin-') ?>assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="custom-control custom-switch mb-3">
                    <input checked type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="<?= base_url('assets/admin-') ?>assets/css/bootstrap-dark.min.css" data-appStyle="<?= base_url('assets/admin-') ?>assets/css/app-dark.min.css" />
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

    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/dataTables.select.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/jszip/jszip.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/buttons.print.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/select2/select2.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/moment/moment.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/switchery/switchery.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/libs/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/js/pages/form-advanced.init.js"></script>
    <script src="<?= base_url('assets/admin-') ?>assets/js/app.min.js"></script>
    <script src="<?= base_url('assets/admin-assets/libs') ?>/codemirror/codemirror.js"></script>
    <script src="<?= base_url('assets/admin-assets/libs') ?>/codemirror/mode/css/css.js"></script>
    <script src="<?= base_url('assets/admin-assets/libs') ?>/codemirror/mode/xml/xml.js"></script>
    <script src="<?= base_url('assets/admin-assets/libs') ?>/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $('#light-mode-switch').change(function(e) {
            if ($(this).prop('checked')) {
                db.ref('field_theme/theme_mode').set("light");

            }

        })

        $('#dark-mode-switch').change(function(e) {
            if ($(this).prop('checked')) {
                db.ref('field_theme/theme_mode').set("dark");
            }
        })

        function Rp(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp ' + rupiah;
        }

        function debounce(func, delay) {
            let timeoutId;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function() {
                    func.apply(context, args);
                }, delay);
            };
        }
    </script>
</body>

</html>