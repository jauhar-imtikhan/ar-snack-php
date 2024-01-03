<style>
    .hero-section-null {
        border: 1px solid #dee2e6;
        width: auto;
        height: auto;
        padding: 40px;
        margin-bottom: 1rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        cursor: pointer;
        flex-wrap: wrap;
    }

    .text-hero-section {
        font-size: medium;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .hero-section-null:hover {
        background-color: rgba(234, 221, 228, 0.29);
        color: white;
    }
</style>
<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/hero_section') ?>" aria-current="page">Hero Section</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Hero Section</h4>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <?php if ($hero_section && file_exists(FCPATH . '/uploads/frontend/hero-section/' . $hero_section['hero_section_img'])) { ?>
                    <div id="renderImgHeroSection" class="hero-section-null mb-3">
                        <img style="border-radius: 10px; max-width: 200px;" src="<?= base_url('uploads/frontend/hero-section/' . $hero_section['hero_section_img']) ?>" class="img-fluid" alt="Responsive image">
                    </div>
                <?php } else { ?>

                    <div class="hero-section-null">
                        <span class="text-hero-section">No Image</span>
                        <i class="fas fa-upload" id="icon-upload"></i>
                        <span class="upload">Upload</span>
                    </div>
                <?php } ?>
                <form action="" method="post" enctype="multipart/form-data" class="form-image-hero-section-<?php if ($hero_section) {
                                                                                                                echo "edit";
                                                                                                            } else {
                                                                                                                echo "add";
                                                                                                            } ?>">
                    <input type="hidden" name="type" value="<?php if ($hero_section) {
                                                                echo "edit";
                                                            } else {
                                                                echo "add";
                                                            } ?>">
                    <input type="hidden" name="id" value="<?php if ($hero_section) {
                                                                echo $hero_section['hero_section_id'];
                                                            } ?>">
                    <div class="form-group">
                        <div class="custom-file d-none">
                            <input type="file" name="imageherosection" class="custom-file-input" id="imageherosection">
                            <label class="custom-file-label" for="imageherosection" data-browse="Cari">Pilih File</label>
                        </div>
                        <span class="text-danger imageherosection"></span>
                    </div>

                    <div class="form-group float-right">
                        <button type="submit" id="btn-upload-img" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" class="form-hero-section-<?php if (!$hero_section) {
                                                                            echo "add";
                                                                        } else {
                                                                            echo "edit";
                                                                        } ?> ">
                    <input type="hidden" name="type" value="<?php if (!$hero_section) {
                                                                echo "add";
                                                            } else {
                                                                echo "edit";
                                                            } ?>">

                    <input type="hidden" name="id" value="<?php if ($hero_section) {
                                                                echo $hero_section['hero_section_id'];
                                                            }  ?>">
                    <div class="form-group">
                        <label for="titleherosection">Title Hero Section</label>
                        <input type="text" value="<?php if ($hero_section) {
                                                        echo $hero_section['hero_section_title'];
                                                    } ?>" name="titleherosection" id="titleherosection" class="form-control">
                        <span class="text-danger titleherosection"></span>
                    </div>
                    <div class="form-group">
                        <label for="deskripsiherosection">Deskripsi Hero Section</label>
                        <textarea id="deskripsiherosection" class="form-control" name="deskripsiherosection" rows="3"><?php if ($hero_section) {
                                                                                                                            echo $hero_section['hero_section_deskripsi'];
                                                                                                                        } ?></textarea>
                        <span class="text-danger deskripsiherosection"></span>
                    </div>
                    <div class="form-group float-right">
                        <button type="submit" id="btn-save" class="btn btn-primary mb-0">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.hero-section-null').click(function() {
            $('#imageherosection').click();
        })

        $('#imageherosection').change(function() {
            $('.text-hero-section').html('');
            $('.upload').html('');
            $('#icon-upload').hide()
            $('.hero-section-null').append('<img src="' + URL.createObjectURL(event.target.files[0]) + '" class="img-fluid">');
        })

        $('.form-hero-section-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/restadmincontroller/hero_section') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-save').attr('disabled', 'disabled')
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
                    $('#btn-save').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $('.' + key).html(value)
                        })
                    }

                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
        $('.form-hero-section-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/restadmincontroller/hero_section') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-save').attr('disabled', 'disabled')
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
                    $('#btn-save').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $('.' + key).html(value)
                        })
                    }

                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
        $('.form-image-hero-section-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/restadmincontroller/upload_image_hero_section') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-upload-img').attr('disabled', 'disabled')
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
                    $('#btn-upload-img').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
        $('.form-image-hero-section-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/restadmincontroller/upload_image_hero_section') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-upload-img').attr('disabled', 'disabled')
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
                    $('#btn-upload-img').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 500) {
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