<style>
    .qty {
        width: 20%;
        text-align: center;
        outline: none;
        border: transparent;
        font-size: larger;
    }
</style>

<div class="p-4 animated fadeIn wow" data-wow-delay="0.5s">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <img id="showimage" style="border-radius: 10px; cursor: pointer;" src="<?= base_url('uploads/foto-product/'); ?><?= $product['gambar_produk']; ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-12 col-md-12 d-flex mt-4 justify-content-center">
                            <div class="row d-flex" style="gap: 10px;">
                                <div class="col-6 col-md-6 my-2" style="max-width: 100px;  cursor: pointer;  border: 2px solid slategray; border-radius: 10px;">
                                    <img onclick="showimage('<?= $product['gambar_produk']; ?>')" style="border-radius: 10px;" src="<?= base_url('uploads/foto-product/'); ?><?= $product['gambar_produk']; ?>" class="img-fluid" alt="">
                                </div>
                                <?php foreach (json_decode($product['detail_foto_produk']) as $key) { ?>
                                    <div class="col-6 col-md-6 my-2" style="max-width: 100px;  cursor: pointer;  border: 2px solid slategray; border-radius: 10px;">
                                        <img onclick="showimage('<?= $key; ?>')" style="border-radius: 10px;" src="<?= base_url('uploads/foto-product/'); ?><?= $key; ?>" class="img-fluid" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6  mt-3">
                    <div class="row">
                        <div class="col-12">
                            <h2><?= ucfirst($product['nama_produk']); ?></h2>
                        </div>
                        <div class="col-12 mt-3">
                            <h3 class="float-left" id="price">
                                <?= Rp($product['harga_jual']) ?>
                            </h3>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 mt-3">
                                    <div class="d-flex flex-wrap" style="gap: 10px;">
                                        <button id="minqty" type="button" class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></button>
                                        <input id="qty" type="text" value="1" class="qty">
                                        <button id="addqty" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <input type="hidden" name="berat" id="berat" value="<?= $product['berat_produk'] ?>">
                                <div class="col-12 col-md-8 mt-3">
                                    <select name="" id="variant" class="form-control">
                                        <option value="">Pilih Varian</option>
                                        <?php
                                        $variants = $this->db->get_where('tbl_product_variant', ['variant_product_id' => $product['id_produk']])->result_array();
                                        // var_dump($variants);

                                        if ($variants) {

                                            foreach ($variants as $variant) {
                                                // print_r($variant);
                                                echo '<option value="' . $variant['variant_name'] . '" data-harga="' . $variant['variant_price'] . '" data-berat="' . $variant['variant_weight'] . '">' . $variant['variant_name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Tidak ada varian</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="mt-3" style="height: 200px;">
                                <?= $product['deskripsi_produk']; ?>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <button type="button" id="addtocart" class="btn btn-primary btn-lg btn-block"><i class="fas fa-cart-plus"></i> Keranjang</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#variant').change(function() {
            let berat = $(this).find(':selected').data('berat');
            let harga = $(this).find(':selected').data('harga');
            $('#berat').val(berat);
            $('#price').text(Rp(harga));
        })

        $("#addqty").click(function() {
            $("#qty").val(parseInt($("#qty").val()) + 1);
        })
        $("#minqty").click(function() {
            if ($('#qty').val() == 1) {
                $("#qty").val(1);
            } else {
                $("#qty").val(parseInt($("#qty").val()) - 1);

            }
        })

        $('#addtocart').click(function() {
            let qty = $('#qty').val();
            let variant = $('#variant').find(':selected').val();
            let nama = '<?= $product['nama_produk']; ?>';
            let harga = $('#price').text().replace(/[^0-9]/g, '');
            let id_barang = '<?= $product['id_produk'] ?>'

            $.ajax({
                url: '<?= base_url('rest/shop/addtocart'); ?>',
                method: 'post',
                data: {
                    qty: qty,
                    variant: variant,
                    nama: nama,
                    id_barang: id_barang,
                    harga: harga,
                    berat: $('#berat').val(),
                    img: '<?= $product['gambar_produk']; ?>',
                },
                beforeSend: function() {
                    $('#addtocart').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message,
                        }).then((success) => {
                            countCart()
                        })
                    }
                },
                complete: function() {
                    $('#addtocart').removeAttr('disabled');
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

    function showimage(id) {
        $('#showimage').empty();
        $('#showimage').attr('src', '<?= base_url('uploads/foto-product/'); ?>' + id);
    }
</script>