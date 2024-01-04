<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $data_favicon = $this->db->get_where('tbl_favicon', ['favicon_id' => '1'])->row_array() ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $data_toko['nama_toko'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $data_seo['meta_description'] ?>" />
    <meta name="keywords" content="<?= $data_seo['meta_keyword'] ?>" />
    <meta name="author" content="<?= $data_seo['meta_author'] ?>" />
    <?= $data_favicon['favicon_field'] ?>

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/owl.theme.default.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/animate.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
    <!-- Theme style  -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">


</head>

<body style="scroll-behavior: smooth;">


    <div id="page-wrap">

        <?php include APPPATH . 'views/landing_page/components/navbar.php'; ?>

        <?php include APPPATH . 'views/landing_page/components/keunggulan.php'; ?>


    </div>



    <div id="langkah-pembelian" class="na-guide" style="height: fit-content;">
        <h2 class="box-title center animated fadeIn wow" data-wow-delay="0.2s">Cara Pembelian</h2>
        <p class="center animated fadeIn wow" data-wow-delay="0.5s">Langkah pembelian produk di tempat kami</p>
        <div class="container-full animated fadeIn wow" data-wow-delay="0.6s">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="card animated fadeIn wow" data-wow-delay="0.8s" style=" max-height: 15rem;">
                        <div class="d-flex justify-content-center mt-3">
                            <img class="card-img-top img-card" style="max-width: 50px;" src="<?= base_url('assets/icons/user.svg') ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">User Login</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="card animated fadeIn wow" data-wow-delay="0.8s" style=" max-height: 15rem;">
                        <div class="d-flex justify-content-center mt-3">
                            <img class="card-img-top img-card" style="max-width: 50px;" src="<?= base_url('assets/icons/produk-search.svg') ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">Memilih Produk</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="card animated fadeIn wow" data-wow-delay="0.8s" style=" max-height: 15rem;">
                        <div class="d-flex justify-content-center mt-3">
                            <img class="card-img-top img-card" style="max-width: 50px;" src="<?= base_url('assets/icons/checkout-icon.svg') ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">Keranjang</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="card animated fadeIn wow" data-wow-delay="0.8s" style=" max-height: 15rem;">
                        <div class="d-flex justify-content-center mt-3">
                            <img class="card-img-top img-card" style="max-width: 50px;" src="<?= base_url('assets/icons/credit-card-icon.svg') ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">Pembayaran</h5>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div id="produk" class="na-products">
        <h2 class="box-title center animated fadeIn wow mb-5" data-wow-delay="0.2s">Produk</h2>
        <div class="container animated fadeIn wow" data-wow-delay="0.5s">
            <div class="owl-carousel owl-theme" data-number="5" data-number-table="3" data-number-mintable="4" data-number-mobile="2" data-dots="true" data-arrows="false" data-loop="true">
                <?php
                foreach ($products as $product) {
                    echo product_carousel(
                        base_url('produk/detail/' . $product['id_produk']),
                        $product['nama_produk'],
                        $product['gambar_produk'],
                        intval($product['harga_jual']),

                    );
                }

                ?>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="<?= site_url('produk/1') ?>" class="btn btn-primary btn-md">Lebih Lengkap</a>
        </div>
    </div>
    <div id="na-form" class="na-form">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <style>
                        #btn-tanya-sekarang:hover {
                            background-color: rgba(176, 176, 176, 0.5);
                        }

                        #namalengkap:focus {
                            outline: none;
                        }

                        #email:focus {
                            outline: none;
                        }

                        #phone:focus {
                            outline: none;
                        }

                        #messages:focus {
                            outline: none;
                        }
                    </style>
                    <h2 class="box-title animated fadeInLeft wow" data-wow-delay="0.2s">Tanya Seputar</h2>
                    <p class="animated fadeInLeft wow" data-wow-delay="0.2s">Ar Snack</p>
                    <form class="form-request nimated fadeInLeft wow" data-wow-delay="0.4s" method="post" name="contact_form" action="">
                        <input autocomplete="off" type="text" id="namalengkap" name="name" placeholder="Nama Lengkap:">
                        <input autocomplete="off" type="text" id="email" name="email" placeholder="Email:">
                        <input autocomplete="off" type="text" id="phone" name="phone" placeholder="No. Whatsapp:">
                        <textarea name="message" id="messages" placeholder="Alamat:"></textarea>

                        <button type="submit" class="btn btn-submit text-white" id="btn-tanya-sekarang">Tanya Sekarang</button>
                    </form>
                </div>
                <div class="col-md-6 padding-let-sm">
                    <h2 class="box-title animated fadeInRight wow" data-wow-delay="0.2s">Informasi Kontak</h2>
                    <p class="animated fadeInRight wow" data-wow-delay="0.2s">Ar Snack</p>
                    <div class="ground-information animated fadeInRight wow" data-wow-delay="0.4s">
                        <?php
                        $em = $this->db->get_where('tbl_config_toko', ['config_toko_id' => 1])->row_array();
                        ?>
                        <a href="mailto:<?= $em['email_toko'] ?>" target="_blank" class="item-ico text-white" style="text-decoration: none;">
                            <i class="fa fa-envelope"></i>
                            <div class="ground-text">
                                <span class="name">Email</span>
                                <span class="des"><?= $em['email_toko'] ?></span>
                            </div>
                        </a>
                        <a href="https://wa.me/6285748840499?text=Hallo min" style="text-decoration: none;" target="_blank" class="item-ico text-white">
                            <i class="fa fa-phone"></i>
                            <div class="ground-text">
                                <span class="name">NO. Whatsapp</span>
                                <span class="des">Tanya Langsung Di Whatsapp</span>
                            </div>
                        </a>
                        <a href="https://maps.app.goo.gl/cLcFf5TBiK9ig7o68" target="_blank" class="item-ico text-white" style="text-decoration: none;">
                            <i class="fa fa-map-marker-alt" style="width: 29%;"></i>
                            <div class="ground-text">
                                <span class="name">Alamat Toko Kami</span>
                                <span class="des">Kwaron, Kec. Diwek, Kabupaten Jombang, Jawa Timur 61471</span>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer id="footer-outer" class="footer-outer">
        <div class="container footer-inner">

            <div class="footer-three-grid wow fadeIn animated" data-wow-delay="0.2s">
                <div class="column-1-3">
                    <a id="logo-footer" class="logo" href="#">
                        <h4 class="img-logo"><?= $data_toko['nama_toko'] ?></h4>
                    </a>
                </div>

                <div class="column-3-3 float-right">
                    <div class="social-icons-footer">
                        <a href="https://www.facebook.com/themenano"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/nmc2025/"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <p class="copyright">&copy; <?= date('Y') ?> <?= $data_toko['copyright'] ?></p>

        </div>
    </footer>


    </div> <!-- main page wrapper -->

    <script src="<?= base_url('assets/') ?>js/jquery.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.js"></script>
    <script src="<?= base_url('assets/') ?>js/owl.carousel.js"></script>
    <script src="<?= base_url('assets/') ?>js/wow.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/main.js"></script>


    <input type="hidden" style="top: 340px; opacity: 0; border: 5px solid white; box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px inset, rgba(0, 0, 0, 0.1) 0px 0px 16px; padding: 15px; background: rgb(255, 41, 184) none repeat scroll 0% 0%; margin: 0px 0px 10px; position: fixed; left: 20px; color: rgb(255, 255, 255); height: 40px; z-index: 9999;" class="jscolor colorpcikewebjs" value="FF29B8" autocomplete="off">
</body>

</html>