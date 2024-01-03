<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('admin/produk') ?>">Produk</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/tambah_produk') ?>" aria-current="page">Tambah Produk</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="">
            <h4>Tambah Produk</h4>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
    }
</style>

<form action="" method="post">
    <input type="hidden" name="produk_id" id="produk_id" value="<?= generaterandomint(8) ?>">
    <div class="row mt-4">
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <input type="text" name="" placeholder="Kode Produk" id="" class="form-control">
                                <span class="text-danger kodeproduk">error</span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="" placeholder="Nama Produk" id="" class="form-control">
                                <span class="text-danger namaproduk">error</span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="" placeholder="Berat Produk" id="" class="form-control">
                                <span class="text-danger beratproduk">error</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="imageproduct">Foto Produk</label>
                                <div id="renderImageProduct" class="mb-3 d-flex flex-wrap" style="gap: 9px;"></div>
                                <div class="custom-file">
                                    <input type="file" name="imageproduct" class="custom-file-input" id="imageproduct">
                                    <label class="custom-file-label" for="imageproduct" data-browse="Cari">Pilih File</label>
                                </div>
                                <span class="text-danger imageproduct"></span>
                            </div>
                            <div class="form-group">
                                <label for="galleryproduct">Gallery Produk</label>
                                <div id="renderGalleryProduct" class="mb-3 d-flex flex-wrap" style="gap: 9px;"></div>
                                <div class="custom-file">
                                    <input type="file" name="galleryproduct[]" maxlength="5" class="custom-file-input" id="galleryproduct" multiple>
                                    <label class="custom-file-label" for="galleryproduct" data-browse="Cari">Pilih File</label>
                                </div>
                                <span class="text-danger galleryproduct"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <input type="text" name="" placeholder="Harga Jual" id="" class="form-control">
                                <span class="text-danger hargajualproduk">error</span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="" placeholder="Harga Beli" id="" class="form-control">
                                <span class="text-danger hargabeliproduk">error</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategoriproduk">Kategori Produk</label>
                                <select name="kategoriproduk" id="kategoriproduk" class="form-control" data-toggle="select2">
                                    <option value="">Pilih Kategori</option>
                                </select>
                                <span class="text-danger kategoriproduk"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Variant Produk <i data-toggle="modal" data-target="#modalAddVariant" class="fas fa-plus float-right" style="cursor: pointer;"></i></div>
                            <ul class="list-group" id="renderVariant"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <textarea style="opacity: 0;" name="" id="" cols="3"></textarea>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="modalAddVariant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAddVariantTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddVariantTitle">Tambah Varian Produk</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-addvariant">
                    <div class="form-group">
                        <label for="namavariant">Nama Variant</label>
                        <input type="text" name="namavariant" id="namavariant" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sizevariant">Ukuran Variant</label>
                        <input type="text" name="sizevariant" id="sizevariant" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="beratvariant">Berat Variant</label>
                        <input type="text" name="beratvariant" id="beratvariant" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="addVariant()" class="btn btn-info">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>



<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<script src="https://cdn.tiny.cloud/1/jms2tweywgkzz1rnsadif6d4hoxe24xqkvmrqstu4e9ov9ff/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<!-- <link rel="stylesheet" href="<?= base_url('assets/admin-assets/libs/kanban-board/src/') ?>style.css" />
<script src="<?= base_url('assets/admin-assets/libs/kanban-board/src/') ?>script.js" defer></script> -->
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        placeholder: "Deskripsi Produk",
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("Maaf Fitur AI Hanya Tersedia Di Akun Premium")),
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#imageproduct').change(function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {

                    let img_edit = e.target.result
                    $('#renderImageProduct').html(`<img class="img-thumbnail" style="max-width: 20%; " src="${img_edit}" alt="${'foto galler product arsnack '+ img_edit}">`)
                }
                reader.readAsDataURL(file);
            } else {
                $('#renderImageProduct').html("");
            }

        })

        $('#galleryproduct').change(function() {
            $('#renderGalleryProduct').empty();
            let file = this.files;
            $.each(file, function(i, key) {
                let reader = new FileReader();
                reader.onload = function(e) {

                    let img_edit = e.target.result
                    $('#renderGalleryProduct').append(
                        `
                        <img class="img-thumbnail" style="max-width: 20%; " src="${img_edit}" alt="${'foto galler product arsnack '+ img_edit}">
                        `
                    )
                }
                reader.readAsDataURL(key);
            })
        })
        $.ajax({
            url: '<?= site_url('restadmincontroller/kategori') ?>',
            method: "get",
            dataType: "json",
            success: function(res) {
                $.each(res.data, function(i, v) {
                    $('select[data-toggle="select2"]').append('<option value="' + v.kategori_id + '">' + v.kategori_name + '</option>')
                })
            },

            error: function(err, textStatus, errorThrown) {
                console.log(err);
            }
        })


        $('.form-addproduk').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/create_product') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btnSubmit').attr('disabled', 'disabled');
                },
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        }).then((success) => {
                            location.reload()
                        })
                    }
                },
                complete: function() {
                    $('#btnSubmit').removeAttr('disabled');
                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $('.' + key).html(value);
                        })
                    }
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                    if (err.status == 400) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
    })

    function addVariant() {
        let namavariant = $('#namavariant').val();
        let hargavariant = $('#hargavariant').val();
        let sizevariant = $('#sizevariant').val();
        let beratvariant = $('#beratvariant').val();

        if (namavariant == '' || hargavariant == '' || sizevariant == '' || beratvariant == '') {
            Toast.fire({
                icon: 'warning',
                title: 'Data Tidak Boleh Kosong'
            })
        } else {
            const dataVariant = {
                namavariant: namavariant,
                hargavariant: hargavariant,
                sizevariant: sizevariant,
                beratvariant: beratvariant
            }
            $('#renderVariant').append(
                `<li class="list-group-item mt-2">
                <input type="hidden" name="datavariant[]" id="datavariant" value="${dataVariant}">
                ${namavariant}
                </li>`
            )
        }
        $('#modalAddVariant').modal('hide')
        $('#modalAddVariant').on('hidden.bs.modal', function() {
            $('#namavariant').val('');
            $('#hargavariant').val('');
            $('#sizevariant').val('');
            $('#beratvariant').val('');
        })
    }
</script>
<!-- testing product add -->
<!-- <div class="card mt-4">
    <div class="card-body">
        <div class="mb-3 float-right">
            <button data-toggle="modal" data-target="#modalAddVariant" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Variant</button>
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="form-addproduk" autocomplete="off">
            <div class="form-group">
                <label for="kodeproduk">Kode Produk</label>
                <input type="text" name="kodeproduk" id="kodeproduk" class="form-control">
                <span class="text-danger kodeproduk"></span>
            </div>
            <div class="form-group">
                <label for="namaproduk">Nama Produk</label>
                <input type="text" name="namaproduk" id="namaproduk" class="form-control">
                <span class="text-danger namaproduk"></span>
            </div>
            <div class="form-group">
                <label for="hargajualproduk">Harga Jual Produk</label>
                <input type="text" name="hargajualproduk" id="hargajualproduk" class="form-control">
                <span class="text-danger hargajualproduk"></span>
            </div>
            <div class="form-group">
                <label for="hargabeliproduk">Harga Beli Produk</label>
                <input type="text" name="hargabeliproduk" id="hargabeliproduk" class="form-control">
                <span class="text-danger hargabeliproduk"></span>
            </div>
            <div class="form-group">
                <label for="beratproduk">Berat Produk</label>
                <input type="number" name="beratproduk" placeholder="Satuan gram" id="beratproduk" class="form-control">
                <span class="text-danger beratproduk"></span>
            </div>
            <div class="form-group">
                <label for="kategoriproduk">Kategori Produk</label>
                <select name="kategoriproduk" id="kategoriproduk" class="form-control" data-toggle="select2">
                    <option value="">Pilih Kategori</option>
                </select>
                <span class="text-danger kategoriproduk"></span>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="3"></textarea>
                <span class="text-danger deskripsi"></span>
            </div>
            <div class="form-group">
                <label for="imageproduct">Foto Produk</label>
                <div id="renderImageProduct" class="mb-3 d-flex flex-wrap" style="gap: 9px;"></div>
                <div class="custom-file">
                    <input type="file" name="imageproduct" class="custom-file-input" id="imageproduct">
                    <label class="custom-file-label" for="imageproduct" data-browse="Cari">Pilih File</label>
                </div>
                <span class="text-danger imageproduct"></span>
            </div>
            <div class="form-group">
                <label for="galleryproduct">Gallery Produk</label>
                <div id="renderGalleryProduct" class="mb-3 d-flex flex-wrap" style="gap: 9px;"></div>
                <div class="custom-file">
                    <input type="file" name="galleryproduct[]" maxlength="5" class="custom-file-input" id="galleryproduct" multiple>
                    <label class="custom-file-label" for="galleryproduct" data-browse="Cari">Pilih File</label>
                </div>
                <span class="text-danger galleryproduct"></span>
            </div>
            <div class="form-group">
                <button id="btnSubmit" class="btn btn-primary float-right" type="submit">Tambah</button>
            </div>
            <div id="modalAddVariant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAddVariantTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddVariantTitle">Tambah Variant</h5>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namavariant">Nama Variant</label>
                                <input type="text" name="namavariant" id="namavariant" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sizevariant">Ukuran Variant</label>
                                <input type="text" name="sizevariant" id="sizevariant" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="beratvariant">Berat Variant</label>
                                <input type="number" name="beratvariant" id="beratvariant" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="hargavariant">Harga Variant</label>
                                <input type="number" name="hargavariant" id="hargavariant" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('#imageproduct').change(function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {

                    let img_edit = e.target.result
                    $('#renderImageProduct').html(`<img class="img-thumbnail" style="max-width: 20%; " src="${img_edit}" alt="${'foto galler product arsnack '+ img_edit}">`)
                }
                reader.readAsDataURL(file);
            } else {
                $('#renderImageProduct').html("");
            }

        })

        $('#galleryproduct').change(function() {
            $('#renderGalleryProduct').empty();
            let file = this.files;
            $.each(file, function(i, key) {
                let reader = new FileReader();
                reader.onload = function(e) {

                    let img_edit = e.target.result
                    $('#renderGalleryProduct').append(
                        `
                        <img class="img-thumbnail" style="max-width: 20%; " src="${img_edit}" alt="${'foto galler product arsnack '+ img_edit}">
                        `
                    )
                }
                reader.readAsDataURL(key);
            })
        })
        $.ajax({
            url: '<?= site_url('restadmincontroller/kategori') ?>',
            method: "get",
            dataType: "json",
            success: function(res) {
                $.each(res.data, function(i, v) {
                    $('select[data-toggle="select2"]').append('<option value="' + v.kategori_id + '">' + v.kategori_name + '</option>')
                })
            },

            error: function(err, textStatus, errorThrown) {
                console.log(err);
            }
        })


        $('.form-addproduk').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/create_product') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btnSubmit').attr('disabled', 'disabled');
                },
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        }).then((success) => {
                            location.reload()
                        })
                    }
                },
                complete: function() {
                    $('#btnSubmit').removeAttr('disabled');
                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $('.' + key).html(value);
                        })
                    }
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                    if (err.status == 400) {
                        Toast.fire({
                            icon: 'warning',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        })
    })
</script> -->