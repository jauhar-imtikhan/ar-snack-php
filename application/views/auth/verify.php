<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Verifikasi Akun | AR SNACK </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="pusat snack eceran dan grosir" name="description" />
    <meta content="jauhar imtikhan" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/admin-') ?>assets/images/favicon.ico">
    <!-- App css -->
    <link href="<?= base_url('assets/admin-') ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>
    <div class="account-pages my-5 pt-5">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div id="alert"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4 mt-3">
                                <a href="<?= base_url('admin') ?>">
                                    <h3>
                                        AR SNACK
                                    </h3>
                                </a>

                            </div>
                            <p class="ml-2">Silahkan masukkan kode yang anda terima pada email anda</p>
                            <form action="" method="post" class="mt-2 px-2 form-verify" autocomplete="off">
                                <?php if (isset($_GET['email']) && isset($_GET['token'])) : ?>
                                    <input type="hidden" name="email" id="email" value="<?= $_GET['email'] ?>">
                                    <input type="hidden" name="token" id="token" value="<?= $_GET['token'] ?>">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="emailaddress">Kode Verifikasi</label>
                                    <input class="form-control" type="number" name="kodeverifikasi" id="kodeverfikasi">
                                    <span class="text-danger email"></span>
                                </div>

                                <div class="text-center mb-3">
                                    <button id="btn-register" class="btn btn-primary btn-block" type="submit"> Verifikasi </button>
                                </div>
                            </form>
                            <!-- end card -->
                        </div>

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="<?= base_url('assets/') ?>js/jquery.min.js"></script>
        <script src="<?= base_url('assets/admin-') ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url('assets/admin-') ?>assets/js/app.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).ready(function() {
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
                $('.form-verify').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?= site_url('verify') ?>',
                        method: 'post',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $('#btn-register').attr('disabled', 'disabled');
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.status == 200) {

                                Toast.fire({
                                    icon: "success",
                                    title: res.message
                                }).then((success) => {
                                    window.location.href = '<?= base_url('login') ?>'
                                })
                            }

                            if (res.status == 202) {

                                Toast.fire({
                                    icon: "warning",
                                    title: res.message
                                });
                            }
                        },
                        complete: function() {
                            $('#btn-register').removeAttr('disabled', 'disabled');
                        },
                        error: function(err) {
                            if (err.status == 400) {

                                Toast.fire({
                                    icon: "error",
                                    title: err.responseJSON.message
                                });
                            }
                            if (err.status == 400) {

                                Toast.fire({
                                    icon: "error",
                                    title: err.responseJSON.message
                                });
                            }

                            if (err.status == 401) {

                                Toast.fire({
                                    icon: "error",
                                    title: err.responseJSON.message
                                });
                            }
                            if (err.status == 500) {

                                Toast.fire({
                                    icon: "error",
                                    title: err.responseJSON
                                });
                            }


                            console.log(err);
                        }
                    })

                })
            })
        </script>

</body>

</html>