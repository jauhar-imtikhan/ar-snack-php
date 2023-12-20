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


<div class="card mt-4">
    <div class="card-body">
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
                <label for="kategoriproduk">Kategori Produk</label>
                <select name="kategoriproduk" id="kategoriproduk" class="form-control" data-toggle="select2">
                    <option value="">Pilih Kategori</option>
                </select>
                <span class="text-danger kategoriproduk"></span>
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
                <label for="galleryproduct">Foto Produk</label>
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
</script>