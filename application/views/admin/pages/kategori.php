<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('kategori') ?>" aria-current="page">Kategori</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Kategori</h4>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="<?= site_url('admin/tambah_kategori') ?>" class="btn btn-primary waves-effect waves-light width-sm float-right"><i class="fas fa-plus"></i> Tambah Kategori</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="tableKategori">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        const table = $('#tableKategori').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })

        const response = async () => {
            await $.ajax({
                url: '<?= site_url('restadmincontroller/kategori') ?>',
                method: 'get',
                dataType: 'json',
                success: function(res) {
                    let dt = []
                    table.clear();
                    const Data = $.map(res.data, function(obj) {
                        const val = {
                            id: obj.kategori_id,
                            name: obj.kategori_name,
                            des: obj.kategori_deskripsi
                        }
                        return val;
                    })

                    $.each(Data, function(i, val) {
                        // console.log(val);
                        const datas = {
                            no: i + 1,
                            id: val.id,
                            name: val.name,
                            des: val.des,
                        }
                        let action = `<div class="d-flex flex-wrap" style="gap: 9px">
                                        <a href="<?= site_url('admin/edit_kategori/') ?>${datas.id}" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                                        <button type="button" data-id="${datas.id}" onclick="hapusKategori(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                      </div>`
                        dt = [datas.no, datas.name, datas.des, action];
                        table.rows.add([dt]).draw()
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }
        response()


    })

    function hapusKategori(e) {
        let id = $(e).data('id')
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger mx-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah anda yakin?",
            text: "Anda tidak bisa mengembalikan data ini, jika di hapus!",
            icon: "warning",
            inputPlaceholder: "Masukan Nama Kategori",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Ya, Saya yakin!",
            cancelButtonText: "Tidak, Batalkan!",
            reverseButtons: true,
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            preConfirm: async (text) => {
                try {


                    const url = "<?= site_url('admin/hapus_kategori/') ?>" + id + "/" + text;
                    const ReqBody = {
                        id: id,
                        id_confirm: text
                    }
                    const response = await fetch(url)
                    if (!response.ok) {
                        if (response.status == 404) {
                            return Swal.showValidationMessage(`${JSON.stringify("Url Tidak Ditemukan")}`);

                        } else if (response.status == 401) {
                            return Swal.showValidationMessage(`${JSON.stringify("Nama Kategori tidak Sesuai")}`);
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
                // console.log(result);
                Toast.fire({
                    icon: 'success',
                    title: `Berhasil Menghapus Kategori Dengan Nama ${result.value}`,
                }).then((success) => {
                    location.reload()
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Toast.fire({
                    icon: 'info',
                    title: 'Kategori Tidak Jadi Dihapus',
                }).then((success) => {
                    location.reload()
                })
            }
        });
    }
</script>