<?php if ($data_product) { ?>

    <div class="row p-4">
        <?php foreach ($data_product as $key) { ?>
            <?php if (is_array($data_product) && count($data_product) ===  1) {
                echo ListProdukSingle($key['id_produk'], $key['nama_produk'], $key['deskripsi_produk'], $key['harga_jual'], $key['gambar_produk'], $key['nama_kategori'], $key['berat_produk']);
            } else {
                echo ListProduk($key['id_produk'], $key['nama_produk'], $key['deskripsi_produk'], $key['harga_jual'], $key['gambar_produk'], $key['nama_kategori'], $key['berat_produk']);
            } ?>
        <?php } ?>
    </div>

<?php } else { ?>
    <div class="row p-3">
        <div class="col-12">
            <div class="card" style="max-width: fit-content;">
                <div class="card-body">
                    <h5 class="card-title text-danger">Tidak ada produk yang anda cari</h5>
                </div>
            </div>
        </div>
    </div>


<?php } ?>