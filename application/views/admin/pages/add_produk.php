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

<form action="" method="post" autocomplete="off" class="form-addproduk" enctype="multipart/form-data">
    <input type="hidden" name="produk_id" id="produk_id" value="<?= generaterandomint(8) ?>">
    <div class="row mt-4">
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <input type="text" name="kodeproduk" placeholder="Kode Produk" id="kodeproduk" class="form-control">
                                <span class="text-danger kodeproduk"></span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="namaproduk" placeholder="Nama Produk" id="namaproduk" class="form-control">
                                <span class="text-danger namaproduk"></span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="beratproduk" placeholder="Berat Produk" id="beratproduk" class="form-control">
                                <span class="text-danger beratproduk"></span>
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
                                <input type="text" name="hargajualproduk" placeholder="Harga Jual" id="hargajualproduk" class="form-control">
                                <span class="text-danger hargajualproduk"></span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="hargabeliproduk" placeholder="Harga Beli" id="hargabeliproduk" class="form-control">
                                <span class="text-danger hargabeliproduk"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <select name="kategoriproduk" id="kategoriproduk" class="form-control" data-toggle="select2">
                                    <option value="">Pilih Kategori</option>
                                </select>
                                <span class="text-danger kategoriproduk"></span>
                            </div>
                            <div class="form-group mt-3">

                                <input type="number" placeholder="Stock Produk" name="stockproduk" id="stockproduk" class="form-control">
                                <span class="text-danger stockproduk"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Variant Produk <i data-toggle="modal" data-target="#modalAddVariant" class="fas fa-plus float-right" style="cursor: pointer;"></i> </div>
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
                    <textarea style="opacity: 0;" name="deskripsi" id="deskripsi" cols="3"></textarea>
                    <span class="text-danger deskripsi"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <button type="submit" id="btnSubmit" class="btn btn-primary float-right">Simpan</button>
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
                <form action="" method="post" class="form-addvariant" autocomplete="off">
                    <input type="hidden" name="idproduct" id="idproduct">
                    <div class="form-group">
                        <label for="namavariant">Nama Variant</label>
                        <input type="text" name="namavariant" id="namavariant" class="form-control">
                        <span class="text-danger namavariant"></span>
                    </div>
                    <div class="form-group">
                        <label for="sizevariant">Ukuran Variant</label>
                        <input type="text" name="sizevariant" id="sizevariant" class="form-control">
                        <span class="text-danger sizevariant"></span>
                    </div>
                    <div class="form-group">
                        <label for="hargavariant">Harga Variant</label>
                        <input type="number" name="hargavariant" id="hargavariant" class="form-control">
                        <span class="text-danger hargavariant"></span>
                    </div>
                    <div class="form-group">
                        <label for="beratvariant">Berat Variant</label>
                        <input type="number" name="beratvariant" id="beratvariant" class="form-control">
                        <span class="text-danger beratvariant"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmitVariant" class="btn btn-info">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEditVariant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalEditVariantTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditVariantTitle">Edit Varian Produk</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-editvariant">
                    <input type="hidden" name="idproducte" id="idproducte">
                    <div class="form-group">
                        <label for="namavariante">Nama Variant</label>
                        <input type="text" name="namavariante" id="namavariante" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sizevariante">Ukuran Variant</label>
                        <input type="text" name="sizevariante" id="sizevariante" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hargavariante">Harga Variant</label>
                        <input type="number" name="hargavariante" id="hargavariante" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="beratvariante">Berat Variant</label>
                        <input type="number" name="beratvariante" id="beratvariante" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmitVariant" class="btn btn-info">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>



<script src="https://cdn.tiny.cloud/1/jms2tweywgkzz1rnsadif6d4hoxe24xqkvmrqstu4e9ov9ff/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
        let formChanged = false;

        function setFormChanged() {
            formChanged = true;
        }
        $('form :input').on('input', function() {
            setFormChanged();
        })

        $(window).bind('beforeunload', function(event) {
            // event.preventDefault()
            if (formChanged) {
                return event.originalEvent.returnValue = 'Apakah anda ingin meninggalkan halaman ini? Data yang diubah tidak akan disimpan.'
            }
        })

        $('#idproduct').val($('#produk_id').val());
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

        $('.form-addvariant').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/create_variant') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btnSubmitVariant').attr('disabled', 'disabled');
                },
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                        addVariant($('#produk_id').val())
                    }
                },
                complete: function() {
                    $('#btnSubmitVariant').removeAttr('disabled');
                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
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


        $('.form-editvariant').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/update_variant') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btnSubmitVariant').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                        $('#modalEditVariant').modal('hide')
                        addVariant($('#produk_id').val())
                    }
                },
                complete: function() {
                    $('#btnSubmitVariant').removeAttr('disabled');
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

    function addVariant(id) {

        $.ajax({
            url: '<?= site_url('admin/get_variant/') ?>' + id,
            method: 'get',
            success: function(res) {
                if (res.data.length > 0) {
                    $('#renderVariant').empty();
                    $.each(res.data, function(i, v) {
                        $('#renderVariant').append(
                            `<li class="list-group-item" >
                                    <div class="row">
                                    <div class="col-6">
                                    ${v.variant_name}
                                    </div>
                                    <div class="col-6">
                                    <div class="d-flex justify-content-end" style="gap: 5px;">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeVariant(this)" data-id="${v.variant_id}"><i class="fas fa-times"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="editVariant(this)" data-id="${v.variant_id}"><i class="fas fa-pen"></i></button>
                                        </div>
                                    </div>
                                    </div>
                                </li>`
                        )
                    })

                    $('#modalAddVariant').modal('hide')
                    $('#modalAddVariant').on('hidden.bs.modal', function() {
                        $('#namavariant').val('');
                        $('#hargavariant').val('');
                        $('#sizevariant').val('');
                        $('#beratvariant').val('');
                    })
                } else {
                    $('#renderVariant').empty()
                }
            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    function removeVariant(el) {
        let id = $(el).data('id')
        let produk_ids = $('#produk_id').val()
        $.ajax({
            url: '<?= site_url('admin/delete_variant/') ?>' + id + '/' + produk_ids,
            method: 'post',
            success: function(res) {
                if (res.status == 200) {

                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    })
                    if (res.return === false) {
                        $('#renderVariant').empty()
                    } else {
                        addVariant($('#produk_id').val())
                    }
                }
            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    function editVariant(el) {
        let id = $(el).data('id')
        $('#modalEditVariant').modal('show')
        $.ajax({
            url: '<?= site_url('admin/get_variant_by_id/') ?>' + id,
            method: 'get',
            success: function(res) {
                // console.log(res);
                $('#idproducte').val(res.data.variant_id)
                $('#namavariante').val(res.data.variant_name)
                $('#hargavariante').val(res.data.variant_price)
                $('#sizevariante').val(res.data.variant_size)
                $('#beratvariante').val(res.data.variant_weight)
            }
        })
    }
</script>