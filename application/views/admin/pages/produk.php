<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/produk') ?>" aria-current="page">Produk</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="">
            <h4>Produk</h4>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= site_url('admin/tambah_produk') ?>" class="btn btn-primary waves-effect waves-light width-sm float-right"><i class="fas fa-plus"></i> Tambah Produk</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="tableProduct">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        let table = $('#tableProduct').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,

        })

        getProduct()

        function getProduct() {
            $.ajax({
                url: "<?= site_url('admin/get_product') ?>",
                dataType: "json",
                method: 'get',
                success: function(res) {
                    table.clear();
                    let dt = [];

                    $.each(res.data, function(i, x) {
                        const datas = {
                            id: x.id_produk,
                            nama: x.nama_produk,
                            harga_beli: x.harga_beli,
                            harga_jual: x.harga_jual,
                            kode_produk: x.kode_produk,
                            kategori: x.nama_kategori,

                        }

                        const btn = `<div class="d-flex flex-wrap" style="gap: 9px;">
                                        <a href="<?= site_url('admin/edit_produk/') ?>${datas.id}" class="btn btn-sm btn-warning text-white" data-toggle="tooltip"  data-placement="top" title="Edit Produk"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger" data-id="${datas.id}" onclick="hapusProduct(this)"  data-toggle="tooltip" data-placement="top" title="Hapus Produk"><i class="fas fa-trash"></i></button>
                                    </div>`;

                        dt = [i + 1, datas.nama, datas.harga_jual, datas.harga_beli, datas.kategori, btn]
                        table.rows.add([dt]).draw();
                    })
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }

    })
</script>