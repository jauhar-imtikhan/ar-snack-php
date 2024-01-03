<?php
$data_toko = $this->db->get_where('tbl_config_toko', ['config_toko_id' => '1'])->row_array();
$hero_section = $this->db->get_where('tbl_hero_section', ['hero_section_id' => '1'])->row_array();
?>

<div id="na-header-wrapper" style="margin-bottom: 0">

    <div class="site-header header-fixed navbar navbar-expand-lg main-navbar-nav navbar-light">
        <div class="container">
            <a id="logo" class="logo" href="#">
                <h3 class="img-logo text-white"> <?= $data_toko['nama_toko'] ?></h3>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon-toggler"></i>
                <i class="icon-toggler"></i>
                <i class="icon-toggler"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-items-center ml-auto mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url() ?>">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#keunggulan">Keunggulan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#langkah-pembelian">Langkah Pembelian</a>
                    </li>
                    <li class="nav-item">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#produk">Produk</a>
                    </li>
                </ul>
                <div class="btn-header">
                    <?php if ($this->session->userdata('user_id')) { ?>
                        <a class="btn-link " href="<?= base_url('user/account') ?>"><i class="fas fa-user"></i></a>

                    <?php } else { ?>
                        <a class="btn-link" href="<?= base_url('login') ?>">Login</a>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="site-header-hoder"></div>
    <!-- Slider =================================================== -->
    <div class="container na-slider">
        <h1 class="animated fadeIn wow" data-wow-delay="0.4s"><?= $hero_section['hero_section_title'] ?></h1>
        <span class="sub-title animated fadeInDown wow" data-wow-delay="0.2s"><?= $hero_section['hero_section_deskripsi'] ?></span>
        <div class="d-flex justify-content-center">
            <img class="animated fadeInUp wow  h-50 w-50" style="border-radius: 10px; max-width: 500px; height: auto" data-wow-delay="1s" src="<?= base_url('uploads/frontend/hero-section/') . $hero_section['hero_section_img'] ?>" alt="Product">
        </div>
    </div>



</div>

<div class="container mt-5 mb-0">
    <p><?= $data_toko['deskripsi_toko'] ?></p>

</div>