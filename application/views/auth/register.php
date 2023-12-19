<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | AR SNACK </title>
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
    <link src="<?= base_url('assets/toast') ?>/css/toastr.min.css?v1.0" rel="stylesheet" type="text/css" />
    <style>
        #showpass:hover {
            cursor: pointer;
            background: transparent;
        }

        #showpass {
            background: transparent;
        }
    </style>
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
                            <form action="" method="post" class="mt-2 px-2 form-register">
                                <div class="row">
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Nama Lengkap</label>
                                            <input class="form-control" type="text" id="namalengkap" name="namalengkap" placeholder="Masukan Nama Lengkap Anda">
                                            <span class="text-danger namalengkap"></span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="emailaddress">No. Whatsapp</label>
                                            <input class="form-control" type="number" id="nowhatsapp" name="nowhatsapp" placeholder="Masukan No. Whatsapp Anda">
                                            <span class="text-danger nowhatsapp"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emailaddress">Alamat Email</label>
                                    <input class="form-control" type="text" name="email" id="emailaddress" placeholder="contoh@arsnack.com">
                                    <span class="text-danger email"></span>
                                </div>
                                <div class="form-group ">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Masukan Passowrd Anda">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="showpass"><i id="childshowpass" class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger password"></span>
                                </div>
                                <div class="form-group">
                                    <label for="useroption">Daftar Sebagai</label>
                                    <div class="d-flex " style="gap: 10px;">
                                        <div class="form-group form-check">
                                            <input type="radio" name="role" value="user" class="form-check-input" id="useroption">
                                            <label class="form-check-label" for="useroption">User</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="radio" name="role" value="member" class="form-check-input" id="memberoption">
                                            <label class="form-check-label" for="memberoption">Member</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <button id="btn-register" class="btn btn-primary btn-block" type="submit"> Daftar </button>
                                </div>
                            </form>
                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mb-0">Sudah punya akun? <a href="<?= base_url('auth') ?>" class="text-dark ml-1"><b>Login</b></a></p>
                                </div>

                                <!-- end card-body -->
                            </div>
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
            $(document).ready(function() {
                const exclusiveCheckboxes = document.querySelectorAll('.form-check-input');

                exclusiveCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        // Jika checkbox ini dicentang, nonaktifkan checkbox lainnya
                        if (this.checked) {
                            exclusiveCheckboxes.forEach(otherCheckbox => {
                                if (otherCheckbox !== this) {
                                    otherCheckbox.checked = false;
                                }
                            });
                        }
                    });
                });

                $('#showpass').click(function(e) {
                    let icons = e.target.classList
                    if (icons.value == 'fas fa-eye') {
                        icons.value = 'fas fa-eye-slash'
                        $('#password').attr('type', 'text')
                    } else {
                        icons.value = 'fas fa-eye'
                        $('#password').attr('type', 'password')

                    }
                })
                $('.form-register').submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                        method: "POST",
                        url: "<?= site_url('register') ?>",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        dataType: "JSON",
                        beforeSend: function() {
                            $('#btn-register').attr('disabled', 'disabled');
                        },
                        success: function(data) {
                            // console.log(data);

                            if (data.status == 201) {

                                Toast.fire({
                                    icon: "success",
                                    title: data.message
                                });
                            }
                            if (data.status == 200) {
                                Toast.fire({
                                    icon: "success",
                                    title: data.message
                                })

                            }
                        },
                        complete: function() {
                            $('#btn-register').removeAttr('disabled', 'disabled');
                        },
                        error: function(data) {

                            if (data.status == 422) {
                                $.each(data.responseJSON.errors, function(key, value) {
                                    $('.' + key).html(value);
                                })
                            }

                            if (data.status == 500) {
                                console.log(data.responseJSON);
                            }
                        }
                    })
                })
            })
        </script>

</body>

</html>