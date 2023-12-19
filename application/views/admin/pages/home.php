<div class="header float-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="<?= site_url('admin') ?>" aria-current="page">Home</a></li>

        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div>
            <h4>Dashboard</h4>
        </div>
    </div>
</div>

<div>
    <div class="card-box widget-inline">
        <div class="row">
            <div class="col-xl-3 col-sm-6 widget-inline-box">
                <div class="text-center p-3">
                    <h2 class="mt-2"><i class="text-primary mdi mdi-access-point-network mr-2"></i> <b><?= countPaymentTotal() ?></b></h2>
                    <p class="text-muted mb-0">Total Penjualan </p>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 widget-inline-box">
                <div class="text-center p-3">
                    <h2 class="mt-2"> <b><?= Rp(countTotalPendapatan()) ?></b></h2>
                    <p class="text-muted mb-0">Total Pendapatan</p>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 widget-inline-box">
                <div class="text-center p-3">
                    <h2 class="mt-2"><i class="text-info mdi mdi-black-mesa mr-2"></i> <b><?= countUser() ?></b></h2>
                    <p class="text-muted mb-0">Jumlah Pengguna</p>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="text-center p-3">
                    <h2 class="mt-2"><i class="text-danger mdi mdi-cellphone-link mr-2"></i> <b>325</b></h2>
                    <p class="text-muted mb-0">Total Pengunjung</p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Selamat Datang Di Admin Panel Ar Snack</h3>
            </div>
        </div>
    </div>
</div>