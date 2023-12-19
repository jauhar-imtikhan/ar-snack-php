<div class="row">
    <div class="col-md-12">
        <div class="p-0 text-center">
            <div class="member-card">
                <div class="avatar-xxl member-thumb mb-2 center-page mx-auto">
                    <style>
                        .member-star:hover {
                            cursor: pointer;
                        }
                    </style>
                    <img src="<?= base_url('uploads/user-profile/') . user_login()['img_profile'] ?>" class="rounded-circle img-thumbnail" alt="profile-image">
                    <i id="UbahFotoProfile" class="fas fa-edit member-star text-secondary" data-toggle="tooltip" data-placement="top" title="Ubah foto profile"></i>
                </div>

                <div class="">
                    <h5 class="mt-3"><?= ucfirst(user_login()['nama_lengkap']) ?></h5>
                    <p class="text-muted"><?= ucfirst(user_login()['role']) ?></p>
                </div>

                <p class="text-muted mt-2">
                    <?= user_login()['alamat'] ?>
                </p>



            </div>

        </div>
        <!-- end card-box -->

    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- end -->

<div class="mt-5">
    <ul class="nav nav-tabs tabs-bordered">
        <li class="nav-item">
            <a href="#profile-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                Profile
            </a>
        </li>
        <li class="nav-item">
            <a href="#changepass" data-toggle="tab" aria-expanded="true" class="nav-link">
                Ubah Password
            </a>
        </li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="profile-b1">
            <!-- Personal-Information -->
            <div class="panel card panel-fill">
                <div class="card-header">
                    <h5 class="font-16 m-1">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-update-profile">
                        <div class="form-group">
                            <label for="FullName">Nama Lengkap</label>
                            <input type="text" name="namalengkap" value="<?= ucfirst($data_user['nama_lengkap']) ?>" id="FullName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Phone">No. Whatsapp</label>
                            <input type="number" name="nowhatsapp" value="<?= $data_user['no_whatsapp'] ?>" id="Phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="AboutMe">Alamat Lengkap</label>
                            <textarea name="alamat" style="height: 125px" id="AboutMe" class="form-control"> <?php
                                                                                                                if ($data_user['alamat'] == null) {
                                                                                                                    echo "Anda belum setting alamat, Silahkan setting dahulu";
                                                                                                                } else {
                                                                                                                    echo $data_user['alamat'];
                                                                                                                }
                                                                                                                ?>
                        </textarea>
                        </div>
                        <button id="btn-update-profile" class="btn btn-primary waves-effect waves-light width-md float-right" type="submit">Simpan</button>
                    </form>

                </div>
            </div>
            <!-- Personal-Information -->
        </div>

        <div class="tab-pane " id="changepass">
            <!-- Personal-Information -->
            <div class="panel card panel-fill">
                <div class="card-header">
                    <h5 class="font-16 m-1">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-update-password">
                        <div class="form-group">
                            <label for="password_lama">Password Lama</label>
                            <input type="password" name="password_lama" id="password_lama" class="form-control">
                            <span class="text-danger password_lama"></span>
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>
                            <input type="password" name="password_baru" id="password_baru" class="form-control">
                            <span class="text-danger password_baru"></span>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="shopass">
                                <label class="form-check-label" for="shopass">
                                    Tampilkan Password
                                </label>
                            </div>
                        </div>

                        <button id="btn-update-password" class="btn btn-primary waves-effect waves-light width-md float-right" type="submit">Simpan</button>
                    </form>

                </div>
            </div>
            <!-- Personal-Information -->
        </div>
    </div>
</div>

<div id="UbahFotoProfileModal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Foto Profile</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div id="renderImgPreview">
                        <img style="max-width: 30%;" src="<?= base_url('uploads/user-profile/') . user_login()['img_profile'] ?>" alt="">
                    </div>

                </div>
                <form action="" method="post" class="form-update-foto" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" name="img_profile" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile" data-browse="Cari">Pilih File</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" id="btn-update-foto" class="btn btn-primary">Update Foto</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#shopass').on('change', function() {
            if ($(this).is(':checked')) {
                $('#password_baru').attr('type', 'text')
                $('#password_lama').attr('type', 'text')
            } else {
                $('#password_baru').attr('type', 'password')
                $('#password_lama').attr('type', 'password')

            }
        })

        $("#UbahFotoProfile").click(function() {
            $('#UbahFotoProfileModal').modal('show')
        })

        $('#customFile').on('change', function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {

                    let img_edit = e.target.result
                    $('#renderImgPreview').html(`<img  style="max-width: 30%;" src="${img_edit}" alt="${'foto profile '+ img_edit}">`)
                }
                reader.readAsDataURL(file);
            } else {
                $('#renderImgPreview').html("");
            }
        });
        $('.form-update-foto').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?= site_url('admincontroller/update_foto_profile') ?>',
                method: 'post',
                data: new FormData(this),
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('#btn-update-foto').attr('disabled', 'disabled')
                },
                success: function(res) {
                    console.log(res);

                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        }).then((success) => {
                            location.reload();
                        })
                    }
                },
                complete: function() {
                    $('#btn-update-foto').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    console.log(err);

                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Internal Server Error'
                        })
                    }

                    if (err.status == 400) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
        $('#UbahFotoProfileModal').on('hidden.bs.modal', function(event) {
            $('#renderImgPreview').html(`<img style="max-width: 30%;" src="<?= base_url('uploads/user-profile/') . user_login()['img_profile'] ?>" />`);
        })

        $('.form-update-profile').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('update_profile') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-update-profile').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    }

                },
                complete: function() {
                    $('#btn-update-profile').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    console.log(err);
                    if (res.status == 500) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.message
                        })
                    }

                }
            })
        })

        $('.form-update-password').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('update_password') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-update-password').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    }
                },
                complete: function() {
                    $('#btn-update-password').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                    if (err.status == 401) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.message
                        })
                    }
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $('.' + key).html(value);
                        })
                    }
                }
            })
        })

    })
</script>