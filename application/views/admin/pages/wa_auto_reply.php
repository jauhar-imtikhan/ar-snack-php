<style>
    .but-child {
        outline: none;
    }

    .btn,
    .btn-block,
    .but-child:focus {
        outline: none;
        border-color: transparent;
    }
</style>

<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/wa_gateway/auto_reply') ?>" aria-current="page">WA BOT Auto Reply</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Pesan Otomatis</h4>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <button type="button" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#modalPesanOtomatis"><i class="fas fa-plus"></i></button>

    </div>
    <div class="col-12">
        <div class="accordion" id="renderPesanOtomatis" style="width: 100%">

        </div>

    </div>
</div>
<div id="modalPesanOtomatis" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalPesanOtomatisTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesanOtomatisTitle">Tambah Pesan Otomatis</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-add-auto-reply">
                    <div class="form-group">
                        <label for="pesantriger">Triger Pesan</label>
                        <input type="text" name="pesantriger" id="pesantriger" class="form-control">
                        <span class="text-danger pesantriger"></span>
                    </div>
                    <div class="form-group">
                        <label for="pesanbalasan">Pesan Balasan</label>
                        <input type="text" name="pesanbalasan" id="pesanbalasan" class="form-control">
                        <span class="text-danger pesanbalasan"></span>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="statustriger" name="statustriger">
                            <label class="custom-control-label" for="statustriger">Aktifkan Pesan Otomatis</label>
                        </div>
                        <span class="text-danger statustriger"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn-add-auto-reply-submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        getPesanTriger()

        $('.form-add-auto-reply').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/wa_gateway/add_auto_reply') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-add-auto-reply-submit').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('#modalPesanOtomatis').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        }).then((success) => {
                            $('#renderPesanOtomatis').html("")
                            getPesanTriger()
                        })
                    }
                },
                complete: function() {
                    $('#btn-add-auto-reply-submit').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            $('.' + key).html(value)
                        })
                    }

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

    function getPesanTriger() {
        $.ajax({
            url: '<?= site_url('admin/wa_gateway/get_pesan_triger') ?>',
            method: 'get',
            success: function(res) {
                // console.log(res);

                $.each(res.data, function(i, key) {

                    let element = `  <div class="card">
                <div class="card-header" id="body${key.wa_bot_id}">
                    <div class="d-flex justify-content-between align-items-center">
                    
                    <h2 class="mb-0">
                        <button class="btn btn-block btn-link text-left" type="button" data-toggle="collapse" data-target="#child${key.wa_bot_id}" aria-expanded="true" aria-controls="collapseOne">
                       Data Triger "${key.wa_bot_pesan}"
                        </button>
                    </h2>
                  
                    <button type="buton" class="btn btn-danger btn-sm" data-id="${key.wa_bot_id}" onclick="hapusAutoReply(this)"><i class="fas fa-trash"></i></button>
                   
                    </div>
                </div>

                <div id="child${key.wa_bot_id}" class="collapse " aria-labelledby="body${key.wa_bot_id}" data-parent="#body${key.wa_bot_id}">
                    <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="triger${key.wa_bot_id}">Pesan Triger</label>
                            <input type="text" class="form-control" id="triger${key.wa_bot_id}" value="${key.wa_bot_pesan}" />
                        </div>
                        <div class="form-group">
                            <label for="balasan${key.wa_bot_id}">Pesan Balasan</label>
                            <input class="form-control" type="text" id="balasan${key.wa_bot_id}" value="${key.wa_bot_reply}"/>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="statustriger${key.wa_bot_id}" >
                                <label class="custom-control-label" for="statustriger${key.wa_bot_id}">Aktifkan Pesan Otomatis</label>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-primary btn-sm" id="btn-update${key.wa_bot_id}" onclick="editAutoReply('${key.wa_bot_id}')">Edit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>`;
                    $('#renderPesanOtomatis').append(element)
                    $('#statustriger' + key.wa_bot_id).prop('checked', key.wa_bot_status === "true" ? true : false)
                })

            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    function editAutoReply(id) {
        $.ajax({
            url: '<?= site_url('admin/wa_gateway/update_auto_reply/') ?>' + id,
            method: 'post',
            data: {
                triger: $('#triger' + id).val(),
                balasan: $('#balasan' + id).val(),
                status: $('#statustriger' + id).is(':checked') ? true : false
            },
            beforeSend: function() {
                $('#btn-update' + id).attr('disabled', 'disabled')
            },
            success: function(res) {
                if (res.status == 200) {
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    }).then((success) => {
                        $('#renderPesanOtomatis').html("")
                        getPesanTriger()
                    })
                }
            },
            error: function(err) {
                if (err.status == 400) {
                    Toast.fire({
                        icon: 'error',
                        title: err.responseJSON.message
                    })
                }
                if (err.status == 500) {
                    Toast.fire({
                        icon: 'error',
                        title: err.responseJSON
                    })
                }
            }
        })
    }

    function hapusAutoReply(el) {
        let id = $(el).data('id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger mx-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah anda yakin?",
            text: "Anda tidak dapat mengembalikan nya, Jika anda menghapus data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Saya yakin!",
            cancelButtonText: "Tidak, Batalkan!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('admin/wa_gateway/delete_auto_reply/') ?>' + id,
                    method: 'post',
                    success: function(res) {
                        if (res.status == 200) {
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            }).then((success) => {
                                $('#renderPesanOtomatis').html("")
                                getPesanTriger()
                            })
                        }
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
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Toast.fire({
                    icon: 'info',
                    title: 'Dibatalkan!'
                })
            }
        });
    }
</script>