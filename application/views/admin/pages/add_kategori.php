<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('kategori') ?>">Kategori</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('admin/tambah_kategori') ?>" aria-current="page">Tambah Kategori</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Tambah Kategori</h4>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" class="form-add-kategori" autocomplete="off">
                    <div class="form-group">
                        <label for="namakategori">Nama Kategori</label>
                        <input type="text" name="namakategori" id="namakategori" class="form-control">
                        <span class="text-danger namakategori"></span>
                    </div>
                    <div class="form-group">
                        <label for="deskripsikategori">Deskripsi Kategori</label>
                        <textarea name="deskripsikategori" id="deskripsikategori" class="form-control" style="height: 90px;"></textarea>
                        <span class="text-danger deskripsikategori"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right" id="btn-add-kategori-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-add-kategori').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/proses_tambah_kategori') ?>',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btn-add-kategori-submit').attr('disabled', 'disabled')
                },
                success: function(res) {
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
                    $('#btn-add-kategori-submit').removeAttr('disabled', 'disabled')
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
</script>