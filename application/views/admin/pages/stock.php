<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/stock') ?>" aria-current="page">Stock</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Stock</h4>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="tableStock">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stock Produk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="modalEditStock" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Edit Stock Produk <span id="produknametitle"></span></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off" class="form-update-stok">
                    <input type="hidden" name="id" id="id">
                    <input type="number" name="stock" id="stock" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="buton" data-dismiss="modal" class="btn btn-warning btn-md">Kembali</button>
                <button type="submit" class="btn btn-success btn-md">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        let table = $('#tableStock').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,

        })
        getStock()

        function getStock() {
            $.ajax({
                url: '<?= site_url('rest/get_stock') ?>',
                method: 'get',
                success: function(res) {
                    let dt = []
                    table.clear()
                    $.each(res.data, function(i, k) {
                        const datas = {
                            no: i + 1,
                            id: k.prod_id,
                            nama: k.nama,
                            stock: k.stok
                        }
                        let btn = `
                                <div class="d-flex" style="gap: 9px;">
                                    <button type="button" data-id="${datas.id}" onclick="editStock(this)" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></button>
                                    <button type="button" data-nama="${datas.nama}" class="btn btn-danger btn-sm" data-id="${datas.id}" onclick="hapusStock(this)"><i class="fas fa-trash"></i></button>
                                </div>
                             `
                        dt = [datas.no, datas.nama, datas.stock, btn]
                        table.rows.add([dt]).draw();
                    })
                }
            })
        }

        $('.form-update-stok').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('restadmincontroller/update_stock') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        }).then((success) => {
                            $('#modalEditStock').modal('hide')
                            getStock()
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.responseJSON.status == false) {
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

    function hapusStock(el) {
        let id = $(el).data('id')
        let nama = $(el).data('nama')

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger mx-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah anda yakin?",
            text: "Jika anda menghapus data stock ini data produk terkait akan ikut terhapus, Dan anda tidak dapat mengembalikannya!",
            icon: "warning",
            input: "text",
            inputPlaceholder: "Masukkan kata " + nama,
            showCancelButton: true,
            confirmButtonText: "Ya, Saya yakin!",
            cancelButtonText: "Tidak, Batalkan!",
            reverseButtons: true,
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            preConfirm: async (text) => {
                try {
                    const url = "<?= site_url('restadmincontroller/hapus_stock/') ?>" + id + "/" + text;
                    const ReqBody = {
                        id: id,
                        id_confirm: text
                    }
                    const response = await fetch(url)

                    if (!response.ok) {
                        if (response.status == 404) {
                            return Swal.showValidationMessage(`${JSON.stringify("Url Tidak Ditemukan")}`);

                        } else if (response.status == 401) {
                            return Swal.showValidationMessage(`${JSON.stringify("Nama stok produk tidak sesuai")}`);
                        } else {
                            return Swal.showValidationMessage(`${JSON.stringify("Nama stok produk belum diisi")}`);
                        }
                    }

                    return text
                } catch (error) {
                    Toast.fire({
                        icon: 'error',
                        title: error
                    })
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: 'success',
                    title: `Berhasil Menghapus Stok ${result.value}`,
                }).then((success) => {
                    getStock()
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Toast.fire({
                    icon: 'info',
                    title: "Anda Membatalkan Penghapusan"
                })
            }
        });
    }

    function editStock(el) {
        $('#modalEditStock').modal('show')
        let id = $(el).data('id')
        $.ajax({
            url: '<?= site_url('restadmincontroller/get_stock_by_id/') ?>' + id,
            method: 'get',
            success: function(res) {
                $('#produknametitle').text(res.data.nama)
                $('#stock').val(res.data.stok)
                $('#id').val(res.data.prod_id)
            }
        })
    }
</script>