<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('admin/produk') ?>">Produk</a></li>
            <li class="breadcrumb-item active"><a href="#" aria-current="page">Edit Produk</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="">
            <h4>Edit Produk</h4>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" class="form-editproduk" autocomplete="off">
                    <input type="hidden" name="id" value="<?= $products['id_produk'] ?>">
                    <div class="form-group">
                        <label for="kodeproduk">Kode Produk</label>
                        <input type="text" value="<?= $products['kode_produk'] ?>" name="kodeproduk" id="kodeproduk" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="namaproduk">Nama Produk</label>
                        <input type="text" value="<?= $products['nama_produk'] ?>" name="namaproduk" id="namaproduk" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="hargajualproduk">Harga Jual Produk</label>
                        <input type="text" value="<?= $products['harga_jual'] ?>" name="hargajualproduk" id="hargajualproduk" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="hargabeliproduk">Harga Beli Produk</label>
                        <input type="text" value="<?= $products['harga_beli'] ?>" name="hargabeliproduk" id="hargabeliproduk" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="kategoriproduk">Kategori Produk</label>
                        <select name="kategoriproduk" id="kategoriproduk" class="form-control" data-toggle="select2">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategories as $kategori) { ?>
                                <option value="<?= $kategori['kategori_id'] ?>" <?php if ($products['nama_kategori'] == $kategori['kategori_name']) echo 'selected' ?>>
                                    <?= $kategori['kategori_name'] ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="imageproduct">Foto Produk</label>
                        <div id="renderImageProduct" class="mb-3 d-flex flex-wrap" style="gap: 9px;">
                            <img src="<?= base_url('uploads/foto-product/') . $products['gambar_produk'] ?>" alt="foto produk ar snack <?= $products['gambar_produk'] ?>" style="max-width: 20%;" />
                        </div>
                        <div class="custom-file">
                            <input type="file" name="imageproduct" class="custom-file-input" id="imageproduct">
                            <label class="custom-file-label" for="imageproduct" data-browse="Cari">Pilih File</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="galleryproduct">Gallery Produk</label>
                        <div id="renderGalleryProduct" class="mb-3 d-flex flex-wrap" style="gap: 9px;">
                            <?php
                            $encoded = json_decode($products['detail_foto_produk'], true);
                            foreach ($encoded as $key => $value) {
                                echo '<img src="' . base_url('uploads/foto-product/') . $value . '" alt=" Foto produk ar snack ' . $value . '" style="max-width: 20%;" />';
                            }
                            ?>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="galleryproduct[]" maxlength="5" class="custom-file-input" id="galleryproduct" multiple>
                            <label class="custom-file-label" for="galleryproduct" data-browse="Cari">Pilih File</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <button id="btnSubmit" class="btn btn-primary float-right" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
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

        $('.form-editproduk').submit(function(e) {
            e.preventDefault();
            const form = new FormData(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger mx-2"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Apakah anda yakin?",
                text: "Ingin menyimpan perubahan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Saya yakin!",
                cancelButtonText: "Tidak, Batalkan!",
                reverseButtons: true,
                allowOutsideClick: false,

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('admin/update_product') ?>",
                        method: 'post',
                        data: form,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            console.log(res);
                        },
                        error: function(err) {
                            if (err.status == 304) {
                                Toast.fire({
                                    icon: 'error',
                                    title: err.responseJSON.message
                                })
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Toast.fire({
                        icon: 'info',
                        title: 'Data tidak jadi di hapus!'
                    })
                }
            });
        })
    })
</script>