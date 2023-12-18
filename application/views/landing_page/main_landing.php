<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ar Snack Eceran & Grosir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website Agen Snack Ar Snack Eceran & Grosir" />
    <meta name="keywords" content="agen snack, snack eceran, snack grosir, snack, snack lebaran, makanan ringan, kathering" />
    <meta name="author" content="nanothemes.co" />


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

        <?php include APPPATH . 'views\landing_page\components\navbar.php'; ?>

        <?php include APPPATH . 'views\landing_page\components\keunggulan.php'; ?>


    </div>


    <!-- ==========================================================================================================
													  Guide Videos
		 ========================================================================================================== -->

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

    <!-- ==========================================================================================================
													  LIST PRODUCTS
		 ========================================================================================================== -->

    <div id="produk" class="na-products">
        <h2 class="box-title center animated fadeIn wow mb-5" data-wow-delay="0.2s">Produk</h2>
        <div class="container animated fadeIn wow" data-wow-delay="0.5s">
            <div class="owl-carousel owl-theme" data-number="4" data-number-table="3" data-number-mintable="2" data-number-mobile="2" data-dots="true" data-arrows="false" data-loop="true">

                <div class="item wow">
                    <img class="img-product" src="<?= base_url('assets/') ?>img/snack.jpg" alt="product 1">
                    <div class="name-product">Quick Swap Smart Battery Premium Quality</div>
                    <div class="price-product">$46.00</div>
                </div>
                <div class="item wow">
                    <img class="img-product" src="<?= base_url('assets/') ?>img/snack.jpg" alt="product 2">
                    <div class="name-product">Zenmuse A7 Gimbal For Sony A7s 500</div>
                    <div class="price-product">$69.00</div>
                </div>
                <div class="item wow">
                    <img class="img-product" src="<?= base_url('assets/') ?>img/snack.jpg" alt="product 3">
                    <div class="name-product">Zenmuse X5 Gimbal And Camera Silhouette</div>
                    <div class="price-product">$46.00</div>
                </div>
                <div class="item wow">
                    <img class="img-product" src="<?= base_url('assets/') ?>img/snack.jpg" alt="product 4">
                    <div class="name-product">Inspire 1 – Zenmuse X3 Gimbal Adapter</div>
                    <div class="price-product">$52.00</div>
                </div>
                <div class="item wow">
                    <img class="img-product" src="<?= base_url('assets/') ?>img/snack.jpg" alt="product 5">
                    <div class="name-product">Inspire 1 Quadcopter – 4K Camera Premium Quality</div>
                    <div class="price-product">$54.00</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-md">Lebih Lengkap</a>
        </div>
    </div>

    <!-- ==========================================================================================================
													  Request Form
		 ========================================================================================================== -->
    <div id="na-form" class="na-form">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <h2 class="box-title animated fadeInLeft wow" data-wow-delay="0.2s">Tanya Seputar</h2>
                    <p class="animated fadeInLeft wow" data-wow-delay="0.2s">Ar Snack</p>
                    <form class="form-request nimated fadeInLeft wow" data-wow-delay="0.4s" method="post" name="contact_form" action="">
                        <input type="text" name="name" placeholder="Nama Lengkap:">
                        <input type="text" name="email" placeholder="Email:">
                        <input type="text" name="phone" placeholder="No. Whatsapp:">
                        <textarea name="message" placeholder="Alamat:"></textarea>
                        <button type="submit" class="btn btn-submit" style=":hover {color: black}">Tanya Sekarang</button>
                    </form>
                </div>
                <div class="col-md-6 padding-let-sm">
                    <h2 class="box-title animated fadeInRight wow" data-wow-delay="0.2s">Informasi Kontak</h2>
                    <p class="animated fadeInRight wow" data-wow-delay="0.2s">Ar Snack</p>
                    <div class="ground-information animated fadeInRight wow" data-wow-delay="0.4s">

                        <div class="item-ico">
                            <i class="fa fa-envelope"></i>
                            <div class="ground-text">
                                <span class="name">Email</span>
                                <span class="des">admin@arsnack.com</span>
                            </div>
                        </div>
                        <div class="item-ico">
                            <i class="fa fa-phone"></i>
                            <div class="ground-text">
                                <span class="name">NO. Whatsapp</span>
                                <span class="des">+62 812 3456 789</span>
                            </div>
                        </div>
                        <div class="item-ico">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="ground-text">
                                <span class="name">Alamat Toko Kami</span>
                                <span class="des">Kwaron, Kec. Diwek, Kabupaten Jombang, Jawa Timur 61471</span>
                            </div>
                        </div>

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
                        <h4 class="img-logo">Ar Snack</h4>
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

            <p class="copyright">&copy; <?= date('Y') ?> Ar Snack. All rights reserved. Developed by <a href="https://github.com/jauhar-imtikhan/" target="_blank">Jauhar Imtikhan</a>.</p>

        </div>
    </footer>


    </div> <!-- main page wrapper -->

    <script src="<?= base_url('assets/') ?>js/jquery.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.js"></script>
    <script src="<?= base_url('assets/') ?>js/owl.carousel.js"></script>
    <script src="<?= base_url('assets/') ?>js/wow.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/main.js"></script>
    <script type="module" src=" <?= base_url('js/test.js') ?>"></script>

    <input style="top: 340px; opacity: 0; border: 5px solid white; box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px inset, rgba(0, 0, 0, 0.1) 0px 0px 16px; padding: 15px; background: rgb(255, 41, 184) none repeat scroll 0% 0%; margin: 0px 0px 10px; position: fixed; left: 20px; color: rgb(255, 255, 255); height: 40px; z-index: 9999;" class="jscolor colorpcikewebjs" value="FF29B8" autocomplete="off">
</body>

</html>