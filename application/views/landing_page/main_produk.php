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

        <div id="na-header-wrapper">

            <div class="site-header header-fixed navbar navbar-expand-lg main-navbar-nav navbar-light">
                <div class="container">
                    <a id="logo" class="logo" href="#">
                        <h3 class="img-logo text-white"> Ar Snack</h3>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="icon-toggler"></i>
                        <i class="icon-toggler"></i>
                        <i class="icon-toggler"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav nav-items-center ml-auto mr-auto">
                            <li class="nav-item " id="mnHome">
                                <a class="nav-link" href="<?= base_url() ?>">Beranda <span class="sr-only">(current)</span></a>
                            </li>


                            <li class="nav-item" id="mnProduk">
                                <a class="nav-link" href="<?= base_url('produk') ?>">Produk</a>
                            </li>
                            <li class="nav-item" id="search">
                                <a role="button" data-toggle="modal" data-target="#modalId" class="nav-link" href="#"><i class="fas fa-search"></i> </a>
                            </li>
                            <li class="nav-item" id="search">
                                <a role="button" class="nav-link" href="<?= base_url('cart?user_id=' . $this->session->userdata('id')) ?>"><i class="fas fa-shopping-cart"></i> <span class="badge badge-warning">3</span></a>
                            </li>

                        </ul>
                        <div class="btn-header">
                            <a class="btn-link" href="<?= base_url('login') ?>">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-header-hoder"></div>
            <!-- Slider =================================================== -->
            <div class="container na-slider">
                <h1 class="animated fadeIn wow" data-wow-delay="0.4s">AR Snack</h1>
                <span class="sub-title animated fadeInDown wow" data-wow-delay="0.2s">Pusat Snack Lebaran Eceran & Grosir</span>

                <div class="d-flex justify-content-center">
                    <img class="animated fadeInUp wow" data-wow-delay="1s" src="<?= base_url('assets/img/snack.jpg') ?>" style="border-radius: 10px;" alt="Product">
                </div>
            </div>



        </div>

    </div>
    <div class="d-flex justify-content-center">
        <div class="row mt-5 p-3">
            <?= ListProduk("1231231", "Snack", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, quod.", 10000, "snack.jpg", "Snack"); ?>
            <?= ListProduk("1231231", "Snack", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, quod.", 10000, "snack.jpg", "Snack"); ?>

        </div>

    </div>

    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
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

    <!-- Modal trigger button -->


    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: white;">
                    <h5 class="modal-title" id="modalTitleId">Cari Produk</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" style="background: white;">
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="input-group">

                                <input type="text" placeholder="Cari..." name="search" id="" class="form-control">
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Place to the bottom of scripts -->


    </div> <!-- main page wrapper -->

    <script src="<?= base_url('assets/') ?>js/jquery.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.js"></script>
    <script src="<?= base_url('assets/') ?>js/owl.carousel.js"></script>
    <script src="<?= base_url('assets/') ?>js/wow.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/main.js"></script>
    <script type="module" src=" <?= base_url('js/test.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#mnProduk').addClass('active');
        });
    </script>
    <input style="top: 340px; opacity: 0; border: 5px solid white; box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px inset, rgba(0, 0, 0, 0.1) 0px 0px 16px; padding: 15px; background: rgb(255, 41, 184) none repeat scroll 0% 0%; margin: 0px 0px 10px; position: fixed; left: 20px; color: rgb(255, 255, 255); height: 40px; z-index: 9999;" class="jscolor colorpcikewebjs" value="FF29B8" autocomplete="off">
</body>

</html>