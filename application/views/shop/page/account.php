<style>
    .table-responsive {
        scrollbar-width: thin;
    }

    .table-responsive::-webkit-scrollbar {
        width: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: url('<?= base_url('assets/img/form-bg.jpg') ?>');

        border-radius: 6px;

    }

    .table-responsive::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        /* warna track scroll bar */
    }

    .table-responsive:hover {
        scrollbar-color: #5f55eb #f1f1f1;
    }
</style>
<div class="row p-3" style="width: 100vw;">
    <div class="col-12 col-md-4 mt-3">
        <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Profile</a>
            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Order <span class="badge badge-warning"><?= $notif_invoice ?></span></a>

            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
            <a class="list-group-item list-group-item-action text-danger" href="<?= site_url('logout') ?>">Logout <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
    <div class="col-12 col-md-8 mt-3">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <form method="post" action="" class="form-profile">
                            <div class="form-group">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input id="namalengkap" value="<?= $user['nama_lengkap'] ?>" class="form-control" type="text" name="namalengkap">
                            </div>
                            <div class="form-group">
                                <label for="nowhatsapp">No. Whatsapp</label>
                                <input id="nowhatsapp" value="<?= $user['no_whatsapp'] ?>" class="form-control" type="text" name="nowhatsapp">
                            </div>
                            <div class="form-group">
                                <label for="alamatpengiriman">Alamat</label>
                                <textarea id="alamatpengiriman" class="form-control" name="alamatpengiriman" style="height: 70px;"><?= $user['alamat_pengiriman'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block float-right" type="submit" id="btn-update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order</h5>
                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order ID</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Resi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="renderOrderList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Settings</h5>
                        <button type="button" onclick="deleteAccount('<?= $user['user_id'] ?>')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete Akun</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalOrder" class="modal fade" data-backdrop="static" data-keyboard="false" style="z-index: 99999999999999;" tabindex="-1" role="dialog" aria-labelledby="modalOrderTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="background: white;">
            <div class="modal-header" style="background: white;">
                <h5 class="modal-title" id="modalOrderTitle">Lacak Pesanan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: white;">
                <ul class="list-group" id="renderTracking"></ul>
            </div>
            <div class="modal-footer" id="modalOrderFooter" style="background: white; border-radius: 0 0 10px 10px;">

            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?= $_ENV["MIDTRANS_URL"] ?>/snap/snap.js" data-client-key="<?= $_ENV["MIDTRANS_CLIENT_KEY"] ?>"></script>
<script type="text/javascript">
    moment.locale("id")
    $(document).ready(function() {
        const dataProfile = {
            namalengkap: $('#namalengkap').val(),
            nowhatsapp: $('#nowhatsapp').val(),
            alamat: $('#alamat').val(),
            alamatpengiriman: $('#alamatpengiriman').val(),
        }
        $('.form-profile').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('rest/shop/updateProfile') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#btn-update').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        }).then((success) => {
                            location.reload();
                        })
                    }
                },
                complete: function() {
                    $('#btn-update').removeAttr('disabled');
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
        getOrderList()
    })

    function getOrderList() {
        $.ajax({
            url: '<?= site_url('rest/shop/orderList') ?>',
            method: 'get',
            success: function(res) {
                // console.log(res);
                $.each(res, function(i, key) {
                    let btn = `<div class="d-inline-flex align-items-center" style="gap: 9px;">
                                 <button class="btn btn-warning btn-sm text-white" type="button" data-waybill="${key.invoice_waybill}" data-courier="${key.invoice_expedition_code}" data-id="${key.invoice_id}" onclick="editOrder(this)"><i class="fas fa-eye"></i></button>
                               </div>`
                    $('#renderOrderList').append(
                        $('<tr>'),
                        $('<td>').text(i + 1),
                        $('<td>').text(key.invoice_id),
                        $('<td>').text(key.invoice_payment_method),
                        $('<td>').text(key.invoice_waybill),
                        $('<td>').html(btn),
                        $('</tr>'),

                    );
                })
            },
            error: function(err) {
                // console.log(err);
                if (err.status == 500 && err.responseJSON.message == "Gagal mengambil data order") {
                    $('#renderOrderList').append('<tr><td colspan="6" class="text-center text-danger">Anda tidak memiliki data order apapun!</td></tr>')
                }
            }
        })
    }

    function editOrder(el) {
        let id = $(el).data('id');
        let waybill = $(el).data('waybill');
        let courier = $(el).data('courier');
        $('#modalOrder').modal('show')
        $.ajax({
            url: '<?= site_url('rest/shop/tracking_paket/') ?>' + waybill + '/' + courier,
            method: 'get',
            success: function(data) {
                let res = $.parseJSON(data);
                console.log(res);
                $('#renderTracking').empty()
                $.each(res.history, function(i, key) {
                    let status = ""
                    if (key.status == 'confirmed') {
                        status += "Pesanan Terkonfirmasi"
                    } else if (key.status == "allocated") {
                        status += "Pesanan Telah Diserahkan Ke Kurir"
                    } else if (key.status == "pickingUp") {
                        status += "Pesanan Sedang Di Ambil Oleh Kurir"
                    } else if (key.status == "picked") {
                        status += "Pesanan Telah Di Ambil Oleh Kurir"
                    } else if (key.status == "droppingOff") {
                        status += "Pesanan Sedang Menuju Alamat Tujuan"
                    } else if (key.status == "delivered") {
                        status += "Pesanan Sudah Sampai Alamat Tujuan"
                    }
                    let element = `<li class="list-group-item">
    <span>${i+1}). ${status}</span></br>
<small>Tanggal : ${moment(key.eventDate).format('lll')}</small>
    </li>`
                    $('#renderTracking').append(element)
                })
                $('#modalOrderFooter').html(` <button class="btn btn-primary" type="button" onclick="orderDelivered('${id}')">Pesanan, Sudah Saya Terima</button>`)

            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    function orderDelivered(id) {
        $('#modalOrder').modal('hide')
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger my-2 mx-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Pesanan Sudah Anda Terima?",
            text: "Jika Pesan Sudah Anda Terima, Anda Tidak Dapat Mengembalikannya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Pesan Sudah Saya Terima!",
            cancelButtonText: "Belum, Pesanan Belum Saya Terima!",
            reverseButtons: true,

        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('rest/shop/save_sales_data') ?>',
                    method: 'post',
                    data: {
                        _id: id,
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terima Kasih',
                                text: 'Telah Belanja Di Toko Kami',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        }
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
    }

    function deleteAccount(id) {
        Swal.fire({
            title: "Masukkan Password Anda",
            input: "password",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Delete",
            cancelButtonText: "Kembali",
            showLoaderOnConfirm: true,
            preConfirm: async (login) => {
                try {
                    const githubUrl = `<?= site_url('rest/shop/delete_akun/') ?>${login}/<?= $user['user_id'] ?>`;
                    const response = await fetch(githubUrl);
                    // console.log(response);
                    if (!response.ok) {
                        let data = await response.json();
                        if (response.status == 404) {
                            return Swal.showValidationMessage(`${JSON.stringify("Maaf, Silahkan Coba Lagi")}`);
                        } else if (response.status == 400) {
                            return Swal.showValidationMessage(`${data.message}`);
                            // console.log(data.message);
                        } else {
                            return Swal.showValidationMessage(`${JSON.stringify("Maaf, Silahkan Coba Lagi")}`);
                        }
                    }
                    return response.json();
                } catch (error) {
                    Swal.showValidationMessage(`Gagal: ${error}`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: result.value.message,
                    }).then((success) => {
                        window.location.href = result.value.url;
                    })
                }
            }
        });
    }
</script>