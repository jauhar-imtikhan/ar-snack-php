<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('kategori') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="" aria-current="page">Edit Kategori</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Edit Kategori</h4>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" class="form-edit-kategori" autocomplete="off">
                    <input type="hidden" name="id" value="<?= $kategories['kategori_id'] ?>">
                    <div class="form-group">
                        <label for="namakategori">Nama Kategori</label>
                        <input type="text" name="namakategori" id="namakategori" value="<?= $kategories['kategori_name'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsikategori">Deskripsi Kategori</label>
                        <textarea name="deskripsikategori" id="deskripsikategori" class="form-control" style="height: 90px;"><?= $kategories['kategori_deskripsi'] ?></textarea>
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
        $('.form-edit-kategori').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= site_url('admin/prosess_edit_kategori') ?>',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#btn-add-kategori-submit').attr('disabled', 'disabled');
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
                    $('#btn-add-kategori-submit').removeAttr('disabled');
                },
                error: function(err) {
                    Toast.fire({
                        icon: 'error',
                        title: err.responseJSON.message
                    })
                }
            })
        })
    })
</script>