<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('setting') ?>" aria-current="page">Settings</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Settings</h4>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 ">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item">
                <a href="<?= site_url('settings?page=pengaturan_toko') ?>" aria-expanded="false" class="nav-link ">
                    Pengaturan Toko
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('settings?page=seo') ?>" aria-expanded="true" class="nav-link">
                    SEO
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('settings?page=template_email') ?>" aria-expanded="true" class="nav-link">
                    Template Email
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('settings?page=sender_email') ?>" aria-expanded="true" class="nav-link">
                    Sender Email
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <?php if ($_GET['page'] == 'pengaturan_toko') { ?>

                <div class="tab-pane active" id="pengaturantoko">
                    <!-- Personal-Information -->
                    <div class="panel card panel-fill">
                        <div class="card-header">
                            <h5 class="font-16 m-1">Pengaturan Toko</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form-update-toko">
                                <div class="form-group">
                                    <label for="namatoko">Nama Toko</label>
                                    <input type="text" value="<?= $data_toko['nama_toko'] ?>" name="namatoko" id="namatoko" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="alamattoko">Alamat Toko</label>
                                    <textarea name="alamattoko" id="alamattoko" class="form-control" style="height: 90px;"><?= $data_toko['alamat_toko'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsitoko">Deskripsi Toko</label>
                                    <textarea name="deskripsitoko" id="deskripsitoko" class="form-control" style="90px"> <?= $data_toko['deskripsi_toko'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="copyrighttoko">Copyright Toko</label>
                                    <textarea name="copyrighttoko" id="copyrighttoko" class="form-control" style="90px"> <?= $data_toko['copyright'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                </div>

            <?php } elseif ($_GET['page'] == 'seo') { ?>

                <div class="tab-pane active" id="seo">
                    <!-- Personal-Information -->
                    <div class="panel card panel-fill">
                        <div class="card-header">
                            <h5 class="font-16 m-1">Pengaturan SEO</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form-update-seo">
                                <div class="form-group">
                                    <label for="metatitle">SEO Title</label>
                                    <input type="text" value="<?= $data_seo['meta_title'] ?>" name="metatitle" id="metatitle" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="metadescription">SEO Description</label>
                                    <input type="text" name="metadescription" value="<?= $data_seo['meta_description'] ?>" id="metadescription" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="metaauthor">SEO Author</label>
                                    <input name="metaauthor" id="metaauthor" class="form-control" value="<?= $data_seo['meta_keyword'] ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="metakeyword">SEO Keyword</label>
                                    <input style="background-color: #30434E; height: 80px;" name="metakeyword" id="metakeyword" data-role="tagsinput" placeholder="Tambah Keyword" class="form-control" value="<?= $data_seo['meta_keyword'] ?>" />
                                    <p class="text-warning">
                                        untuk memisahkan item satu dengan lainya gunakan <code>,(koma)</code>
                                    </p>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                </div>

            <?php } elseif ($_GET['page'] == 'template_email') { ?>
                <style>
                    .colors {
                        height: 37.39px;
                        outline: none;
                        padding: 0;
                        margin: 0;
                    }
                </style>
                <div class="tab-pane active" id="template_email">
                    <!-- Personal-Information -->
                    <div class="panel card panel-fill">
                        <div class="card-header">
                            <h5 class="font-16 m-1">Pengaturan Template Email</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 ">
                                    <form action="" method="post" class="form-update-template-email">
                                        <div class="form-group">
                                            <label for="templateemailtitle">Title Email</label>
                                            <input type="text" value="<?= $data_template_email['title_email'] ?>" name="templateemailtitle" id="templateemailtitle" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="templatemessageemail">Message Email</label>
                                            <input type="text" name="templatemessageemail" value="<?= $data_template_email['message'] ?>" id="templatemessageemail" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="templateemailaction">Message Action Email</label>
                                            <input name="templateemailaction" id="templateemailaction" class="form-control" value="<?= $data_template_email['action'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="templatebgcolor">Warna Background Body</label>
                                            <div class="input-group">
                                                <input class="form-control" readonly type="text" id="templatebgcolor_preview" value=" <?= $data_template_email['bg_card'] ?>" placeholder="Recipient's text" aria-label="Recipient's text" aria-describedby="my-addon">
                                                <div class="input-group-append ">
                                                    <input type="color" class="colors" value="<?= $data_template_email['bg_card'] ?>" name="templatebgcolor" id="templatebgcolor">
                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <style>
                                    .renders-preview {
                                        width: 100%;
                                        height: 46rem;
                                        padding: 20px;
                                        border-radius: 10px;
                                    }
                                </style>
                                <div class="col-12 ">
                                    <iframe id="myIframe" class="renders-preview" src="<?= site_url('admincontroller/preview_template_email') ?>" frameborder="0" scrolling="no"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                </div>

            <?php } else { ?>
                <div class="tab-pane active" id="seo">
                    <!-- Personal-Information -->
                    <div class="panel card panel-fill">
                        <div class="card-header">
                            <h5 class="font-16 m-1">Pengaturan Sender Email</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form-update-sender-email">
                                <div class="form-group">
                                    <label for="keyemail">API Key Email</label>
                                    <div class="input-group">
                                        <input type="password" value="<?= $data_sender_email['key_email'] ?>" name="keyemail" id="keyemail" class="form-control">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="showapiemail"><i class="fas fa-eye"></i></span>
                                        </div>
                                    </div>

                                    <p class="text-danger">Untuk mendapatkan API Key Email <a href="https://myaccount.google.com/apppasswords" target="_blank">Klik Disini</a></p>
                                </div>
                                <div class="form-group">
                                    <label for="emailfrom">Email From </label>
                                    <input type="text" name="emailfrom" value="<?= $data_sender_email['send_email'] ?>" id="emailfrom" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="nameemail">Name Email</label>
                                    <input name="nameemail" id="nameemail" class="form-control" value="<?= $data_sender_email['name_email'] ?>" />
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Personal-Information -->
                </div>
            <?php } ?>
        </div>


    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        // previewTemplateEmail()
        $('#showapiemail').click(function() {
            if ($('#keyemail').attr('type') == 'password') {
                $('#keyemail').attr('type', 'text')
                $(this).html('<i class="fas fa-eye-slash"></i>')
            } else {
                $(this).html('<i class="fas fa-eye"></i>')
                $('#keyemail').attr('type', 'password')
            }
        })

        $('#templatebgcolor').change(function() {
            $('#templatebgcolor_preview').val($(this).val())
        })

        $('.form-update-toko').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/update_toko') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true)
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
                    $('button[type="submit"]').prop('disabled', false)
                },
                error: function(err) {

                    if (err.responseJSON.status === false) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.error
                        })

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })

        $('.form-update-seo').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/update_seo') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true)
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
                    $('button[type="submit"]').prop('disabled', false)
                },
                error: function(err) {

                    if (err.responseJSON.status === false) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.error
                        })

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })

        $('.form-update-template-email').submit(function(e) {
            e.preventDefault();
        })

        $('#myIframe').on('load', function() {
            $(this).height($(this).contents().height());

        });

        $('.form-update-sender-email').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('restadmincontroller/update_sender_email') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true)
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
                    $('button[type="submit"]').prop('disabled', false)
                },
                error: function(err) {
                    if (err.responseJSON.status === false) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.error
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
    })



    // Panggil fungsi setIframeHeight saat konten iframe selesai dimuat
</script>