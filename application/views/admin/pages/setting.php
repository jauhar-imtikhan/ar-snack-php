<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="<?= site_url('admin') ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('setting') ?>" aria-current="page">Settings</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Settings</h4>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 ">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pengaturan Toko</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="namatoko">Nama Toko</label>
                        <input type="text" value="<?= $data_toko['nama_toko'] ?>" name="namatoko" id="namatoko" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="logotok">Logo Toko</label>
                        <div class="custom-file">
                            <input type="file" name="logotoko" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile" data-browse="Cari">Pilih File</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>