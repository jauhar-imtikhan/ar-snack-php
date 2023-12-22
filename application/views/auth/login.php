<?php
$data_toko = $this->db->get_where("tbl_config_toko", ['config_toko_id' => '1'])->row_array();
$data_seo = $this->db->get_where('tbl_seo', ['seo_id' => '1'])->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Halaman Login | <?= $data_toko['nama_toko'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= $data_seo['meta_description'] ?>" name="description" />
    <meta content="<?= $data_seo['meta_author'] ?>" name="author" />
    <meta content="<?= $data_seo['meta_keyword'] ?>" name="keyword" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/admin-') ?>assets/images/favicon.ico">
    <!-- App css -->
    <link href="<?= base_url('assets/admin-') ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin-') ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
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
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4 mt-3">
                                <a href="<?= base_url('admin') ?>">
                                    <h3><?= $data_toko['nama_toko'] ?></h3>
                                </a>

                            </div>
                            <form action="" class="mt-2 px-2 form-login" method="post">
                                <div class="form-group">
                                    <label for="emailaddress">Alamat Email</label>
                                    <input class="form-control" name="email" type="text" id="emailaddress" placeholder="contoh@arsnack.com">
                                    <span class="text-danger email"></span>
                                </div>
                                <div class="form-group ">
                                    <a href="<?= site_url('auth/forgot') ?>" class="text-muted float-right">Lupa Password?</a>
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Masukan Passowrd Anda">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="showpass"><i id="childshowpass" class="fas fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger password"></span>
                                </div>
                                <div class="text-center mb-3">
                                    <button class="btn btn-primary btn-block" id="btn-login" type="submit"> Login </button>
                                </div>
                            </form>
                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mb-0">Belum punya akun? <a href="<?= base_url('auth/register') ?>" class="text-dark ml-1"><b>Daftar</b></a></p>
                                </div>
                            </div>
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

            $('.form-login').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= site_url('login') ?>',
                    method: 'post',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-login').attr('disabled', 'disabled')
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            }).then((success) => {
                                window.location.href = res.url
                            })

                        }
                    },
                    complete: function() {
                        $('#btn-login').removeAttr('disabled', 'disabled')
                    },
                    error: function(err) {
                        console.log(err);
                        if (err.status == 422) {
                            $.each(err.responseJSON.errors, function(key, value) {
                                $('.' + key).html(value);
                            })
                        }

                        if (err.status == 401) {
                            Toast.fire({
                                icon: 'error',
                                title: err.responseJSON.message
                            })
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>