<?php if ($carts) { ?>

    <style>
        .qty {
            width: 30%;
            text-align: center;
            outline: none;
            border: transparent;
            font-size: larger;
        }

        .divider {
            border: 1px solid #dee2e6;
        }
    </style>
    <div class="row p-5 animated fadeIn wow" data-wow-delay="0.5s">
        <div class="col-12 col-md-6">
            <?php foreach ($carts as $cart) {
                echo cart_list($cart['cart_product_img'], $cart['cart_product_name'], $cart['cart_qty'], $cart['cart_id']);
            } ?>

        </div>
        <div class="col-12 col-md-6 mt-4">
            <div class="card " style="width: auto;">
                <div class="card-header text-white" style="background-color: #5f55eb;">
                    <h3 class="card-title">Informasi</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" value="<?= $total_berat ?>" id="total_berat">
                        <input type="hidden" name="id-destination" id="id-destination">
                        <?php if ($users['kode_kota_pengiriman'] == null) { ?>
                            <div class="row">

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="namapenerima" id="namapenerima" placeholder="Nama Penerima" class="form-control">
                                        <span class="text-danger namapenerima"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nowhatsapp" id="nowhatsapp" placeholder="No. Whatsapp" class="form-control">
                                        <span class="text-danger nowhatsapp"></span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="alamat" placeholder="Alamat Lengkap" id="alamat" style="height: 90px;" class="form-control"></textarea>
                                        <span class="text-danger alamat"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <button type="button" id="btn-saveaddress" onclick="saveAddress()" class="btn btn-primary btn-sm float-right">Simpan Alamat</button>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" id="destination_id" value="<?= user_login()['kode_kota_pengiriman'] ?>">

                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <style>
                                        .addrr {
                                            background: rgba(164, 164, 164, 0.18);
                                            height: auto;
                                            padding: 10px;
                                            color: rgba(0, 0, 0, 0.77);
                                            border-radius: 5px;

                                        }
                                    </style>
                                    <div id="new_address" class="row"></div>
                                    <div class="form-group" id="address">
                                        <div class="addrr d-flex flex-column">
                                            <p><?= user_login()['alamat_pengiriman'] ?></p>
                                            <button type="button" onclick="editAddress()" class="btn btn-success btn-sm float-right" style="background-color: rgba(40, 184, 35, 0.66);"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="custom-control" id="fieldcekaddress">
                                        <button type="button" id="cekaddress" class="btn btn-primary btn-md folat-right">Pilih Jasa Pengiriman</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="divider mt-3"></div>
                        <div class="form-group mt-3">
                            <ul class="list-group" id="renderExpedisi" style="overflow-y: scroll; max-height: 150px;"></ul>
                        </div>
                        <div class="divider mt-3"></div>
                        <div class="form-group mt-3">
                            <ul class="list-group" id="renderPaket" style="overflow-y: scroll; max-height: 150px;"></ul>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 mt-4">
            <div class="" style="background-color: #5f55eb; border-radius: 5px; color: white; padding: 10px; height: auto;">
                <div class="row d-flex align-items-center">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <input type="hidden" name="sub_total" value="<?= $total_harga ?>" id="sub_total">
                            <div class="col-12 col-md-12">
                                <h5>Sub Total : <?= Rp($total_harga) ?></h5>
                            </div>
                            <?php if ($checkout) { ?>
                                <?php if ($checkout['checkout_status'] == 'pending') { ?>
                                    <div class="col-12 col-md-12">
                                        <h5>Total: <span id="total"><?= Rp($checkout['checkout_total_price']) ?></span></h5>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-12 col-md-12">
                                    <h5>Total: <span id="total"></span></h5>
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="button" id="btn-checkout" class="btn btn-block">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Order Biteship -->
    <div class="d-flex justify-content-center">
        <div id="createOrderModal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="100" role="dialog" style="z-index: 99999999999;" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content" style="background: white;">
                    <div class="modal-header" style="background: white;">
                        <h5 class="modal-title" id="my-modal-title">Detail Alamat Penerima</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background: white;">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="detailnamapenerima">Nama Penerima <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="detailnamapenerima" name="detailnamapenerima">
                                        <span class="text-danger detailnamapenerima"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="detailnowhatsapp">No. Whatsapp <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" value="<?= user_login()['no_whatsapp'] ?>" id="detailnowhatsapp" name="detailnowhatsapp">
                                        <span class="text-danger detailnowhatsapp"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="detailkodepos">Kode Pos <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" id="detailkodepos" name="detailkodepos">
                                        <span class="text-danger detailkodepos"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="detailemail">Email <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" value="<?= user_login()['email'] ?>" id="detailemail" name="detailemail">
                                        <span class="text-danger detailemail"></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="detailalamat">Alamat Lengkap <small class="text-danger">*</small></label>
                                        <textarea class="form-control" id="detailalamat" name="detailalamat" style="height: 70px;"></textarea>
                                        <span class="text-danger detailalamat"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="detailcatatanalamat">Catatan Alamat <small class="text-danger">*</small></label>
                                        <textarea class="form-control" placeholder="*Warna Cat Rumah, Patokan Rumah" id="detailcatatanalamat" name="detailcatatanalamat" style="height: 70px;"></textarea>
                                        <span class="text-danger detailcatatanalamat"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="detailcatatankurir">Catatan Ke Kurir</label>
                                        <textarea placeholder="Optional" id="detailcatatankurir" class="form-control" name="detailcatatankurir" style="height: 70px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="validateDatas" id="validateDatas">
                                        <label class="custom-control-label" for="validateDatas">Apakah data di atas sudah benar</label>
                                    </div>
                                    <span class="text-danger validateDatas"></span>
                                    <br>
                                    <span class="text-danger mt-3">* Wajib di isi</span>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer" style="background: white; border-radius: 0 0 5px 5px;">
                        <button type="button" id="continuecheckoutbtn" class="btn btn-success">Lanjutkan Checkout &RightArrow;</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= $_ENV["MIDTRANS_URL"] ?>/snap/snap.js" data-client-key="<?= $_ENV["MIDTRANS_CLIENT_KEY"] ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#alamat').on('input', debounce(searchAddress, 1000));
            $('#detailkodepos').on('input', function() {
                let maxLength = 5;
                let inputVal = $(this).val();
                if (inputVal.length > maxLength) {
                    $(this).val(inputVal.slice(0, maxLength));
                }
            })
            $('#cekaddress').click(function() {
                $.ajax({
                    url: '<?= site_url('rest/shop/cek_ongkir') ?>',
                    method: 'post',
                    success: function(data) {
                        let res = $.parseJSON(data)
                        // console.log(res);
                        $.each(res.pricing, function(i, k) {
                            let format_duration = "";

                            if (k.shipment_duration_unit == "hours") {
                                format_duration += 'Jam'
                            } else if (k.shipment_duration_unit == "days") {
                                format_duration = 'Hari'
                            } else if (k.shipment_duration_unit == "weeks") {
                                format_duration = 'Minggu'
                            } else if (k.shipment_duration_unit == "months") {
                                format_duration = 'Bulan'
                            } else if (k.shipment_duration_unit == "years") {
                                format_duration = 'Tahun'
                            }

                            let element = `<li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="${k.courier_code}${k.type}">
                                <label class="custom-control-label" for="${k.courier_code}${k.type}">(${k.courier_name}) ${k.courier_service_name} || Estimasi: ${k.shipment_duration_range} ${format_duration} || (${Rp(k.price)})</label>
                                </div>
                                </li>`;
                            $('#renderPaket').append(element)
                            $('#' + k.courier_code + k.type).click(function() {
                                let sub_total = $('#sub_total').val()
                                $('#total').html(`${Rp(parseInt(sub_total) + parseInt(k.price))}`)
                                createOrder(k.company, k.type)
                            })
                        })
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })

            $('#validateDatas').click(function() {
                if ($(this).is(':checked') == true) {
                    $(this).val('1')
                    $(this).attr('checked', 'checked')
                } else {
                    $(this).removeAttr('checked', 'checked')
                    $(this).val('')
                }
            })
            $('#btn-checkout').click(function() {
                $.ajax({
                    url: '<?= site_url('rest/shop/payment') ?>',
                    method: 'post',
                    data: {
                        total_price: $('#total').text(),
                    },
                    success: function(res) {
                        // console.log(res);
                        if (res.token) {
                            window.snap.pay(res.token, {
                                onSuccess: function(result) {
                                    // console.log(result);
                                    updateCheckout(result)
                                },
                                onPending: function(result) {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: result.status_message
                                    })

                                },
                                onError: function(result) {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: result.status_message
                                    })
                                },
                                onClose: function() {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Pembayaran dibatalkan'
                                    })
                                }
                            })
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        if (err.status == 400) {
                            Toast.fire({
                                icon: 'error',
                                title: err.responseJSON.message
                            })
                        }
                    }
                })
            })

        })

        function updateCheckout(payment) {
            // console.log(payment);
            $.ajax({
                url: '<?= site_url('rest/shop/update_payment') ?>',
                method: 'post',
                data: {
                    payment_method: payment.payment_type,
                    midtrans_code: payment.pdf_url
                },
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        window.location.href = '<?= site_url('account') ?>'
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function createOrder(courier_company, courier_type) {
            $('#createOrderModal').modal('show')
            $('#continuecheckoutbtn').click(function() {
                continueCheckout(courier_type, courier_company)
            })
        }

        function continueCheckout(courier_type, courier_company) {
            if ($('#validateDatas').is(':checked') == false) {
                $('.validateDatas').html('Anda harus ceklist data diatas')
                return
            }

            $.ajax({
                url: '<?= site_url('rest/shop/create_order') ?>',
                method: 'post',
                data: {
                    detailnamapenerima: $('#detailnamapenerima').val(),
                    detailnowhatsapp: $('#detailnowhatsapp').val(),
                    detailkodepos: $('#detailkodepos').val(),
                    detailemail: $('#detailemail').val(),
                    detailalamat: $('#detailalamat').val(),
                    detailcatatanalamat: $('#detailcatatanalamat').val(),
                    validateDatas: $('#validateDatas').attr('checked'),
                    courier_type: courier_type,
                    courier_company: courier_company
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#continuecheckoutbtn').attr('disabled', 'disabled');
                },
                success: function(data) {
                    let res = $.parseJSON(data)
                    // console.log(res);
                    if (res.success == true) {
                        createInvoice(res.courier.company, res.id, res.items)
                    } else {
                        const SwalToast = Swal.mixin({
                            toast: true,
                            position: "bottom-end",
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        if (res.code == 40002020) {
                            SwalToast.fire({
                                icon: 'error',
                                title: 'Kode Pos tidak ditemukan',
                                target: '#createOrderModal',
                                customClass: {
                                    title: 'text-dark',
                                }
                            })
                        } else if (res.code == 40002009) {
                            SwalToast.fire({
                                icon: 'error',
                                title: 'Expedisi yang anda pilih tidak mendukung COD',
                                target: '#createOrderModal',
                                customClass: {
                                    title: 'text-dark',
                                }
                            })
                        } else if (res.code == 40002021) {
                            SwalToast.fire({
                                icon: 'error',
                                title: 'Ada kesalahan pada data expedisi yang anda pilih, Silahkan gunakan expedisi lain',
                                target: '#createOrderModal',
                                customClass: {
                                    title: 'text-dark',
                                }
                            })
                        } else {
                            SwalToast.fire({
                                icon: 'error',
                                title: 'Ada kesalahan ',
                                target: '#createOrderModal',
                                customClass: {
                                    title: 'text-dark',
                                }
                            })
                        }
                    }
                },
                complete: function() {
                    $('#continuecheckoutbtn').removeAttr('disabled');
                },
                error: function(err) {
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(i, key) {
                            $('.' + i).html(key)
                            // console.log(err.responseJSON.errors.validateDatas);

                        })
                    }
                }
            })
        }

        function createInvoice(expedition, expedition_id, item) {
            $.ajax({
                url: '<?= site_url('rest/shop/create_invoice') ?>',
                method: 'post',
                data: {
                    expedition: expedition,
                    expedition_id: expedition_id,
                    product_by_id: item,
                    total_price: $('#total').text(),
                },
                beforeSend: function() {
                    $('#createOrderModal').modal('hide')
                    $('#continuecheckoutbtn').attr('disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    }
                },
                complete: function() {
                    $('#continuecheckoutbtn').removeAttr('disabled')
                },
                error: function(err) {
                    // console.log(err);
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                    if (err.status == 400) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        })
                    }
                }
            })
        }



        function saveAddress() {
            let city = $('#id-destination').val()
            let alamat = $('#alamat').val()

            $.ajax({
                url: '<?= site_url('rest/shop/update_alamat_pengiriman') ?>',
                method: 'post',
                data: {
                    city_id: city,
                    alamat: alamat,
                    namapenerima: $('#namapenerima').val(),
                    nowhatsapp: $('#nowhatsapp').val()
                },
                beforeSend: function() {
                    $('#btn-saveaddress').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    }
                },
                complete: function() {
                    $('#btn-saveaddress').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 500) {
                        Toast.fire({
                            icon: 'error',
                            title: err.responseJSON.mesage
                        })
                    }
                    if (err.status == 406) {
                        $.each(err.responseJSON.errors, function(i, k) {
                            $('.' + i).html(k)
                        })
                    }
                }
            })
        }

        function searchAddress() {
            let query = $('#alamat').val();
            $.ajax({
                url: '<?= site_url('rest/shop/get_areas?query=') ?>' + query,
                method: 'get',
                success: function(data) {
                    $('#renderExpedisi').html('');
                    let res = $.parseJSON(data);

                    $.each(res.areas, function(i, k) {

                        if (k.name) {
                            let element = `<li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="${k.id}" class="custom-control-input" id="${k.id}">
                                <label class="custom-control-label" for="${k.id}">${k.name}</label>
                                </div>
                                </li>`;

                            $('#renderExpedisi').append(element);
                            $('#' + k.id).click(function() {
                                $('#id-destination').val(k.id)
                                $('#alamat').val(k.name)
                                $('#renderExpedisi').html('')
                            })
                        } else {
                            let element = `<li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                <label class="custom-control-label">Alamat Tidak Ditemukan</label>
                                </div>
                                </li>`;

                            $('#renderExpedisi').append(element);
                        }
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function editAddress() {
            $('#address').html("")
            let element = ` <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="alamat" placeholder="Alamat Lengkap" id="alamat" style="height: 90px;" class="form-control"></textarea>
                            <span class="text-danger alamat"></span>
                        </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <button type="button" id="btn-saveaddress" onclick="saveAddress()" class="btn btn-primary btn-sm float-right">Simpan Alamat</button>
                    </div>
                </div>`;
            $('#new_address').append(element)
            $('#alamat').on('input', debounce(searchAddress, 1000));
        }

        function delete_item_cart(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger mx-2"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Apakah anda yakin?",
                text: "Akan menghapus item ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak, Batalkan!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('rest/shop/delete_cart') ?>',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.status == 200) {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                }).then((success) => {
                                    location.reload();
                                    countCart()
                                })
                            }
                        },
                        error: function(err) {
                            if (err.status == 500) {
                                Toast.fire({
                                    icon: 'error',
                                    title: err.responseJSON.message
                                }).then((success) => {
                                    location.reload();
                                    countCart()
                                })
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Toast.fire({
                        title: "Anda membatalkan penghapusan",
                        icon: "error"
                    });
                }
            });



        }

        function add_qty(id) {
            $("#qty" + id).val(parseInt($("#qty" + id).val()) + 1);
            let qty = $('#qty' + id).val();
            $.ajax({
                url: '<?= site_url('rest/shop/update_qty') ?>',
                method: 'post',
                data: {
                    id: id,
                    type: 'add'
                },
                success: function(data) {
                    if (data.status == 200) {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function min_qty(id) {
            if ($('#qty' + id).val() == 1) {
                $("#qty" + id).val(1);
            } else {
                $("#qty" + id).val(parseInt($("#qty" + id).val()) - 1);
                let qty = $('#qty' + id).val();
                $.ajax({
                    url: '<?= site_url('rest/shop/update_qty') ?>',
                    method: 'post',
                    data: {
                        id: id,
                        type: 'min'
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        }
    </script>

<?php } else { ?>
    <h1 class="text-danger">Anda Tidak Memiliki Item</h1>
<?php } ?>