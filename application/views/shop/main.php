<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$data_hero_section = $this->db->get_where("tbl_hero_section", ['hero_section_id' => '1'])->row_array();
$data_favicon = $this->db->get_where('tbl_favicon', ['favicon_id' => '1'])->row_array();
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $data_seo['meta_description'] ?>" />
    <meta name="keywords" content=<?= $data_seo['meta_keyword'] ?>" />
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>


</head>

<body style="scroll-behavior: smooth;">


    <div id="page-wrap">

        <div id="na-header-wrapper">

            <div class="site-header header-fixed navbar navbar-expand-lg main-navbar-nav navbar-light">
                <div class="container">
                    <a id="logo" class="logo" href="#">
                        <h3 class="img-logo text-white"><?= $data_toko['nama_toko'] ?></h3>
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
                                <a role="button" class="nav-link" href="<?= base_url('cart?user_id=' . $this->session->userdata('user_id')) ?>"><i class="fas fa-shopping-cart"></i> <span class="badge badge-warning" id="count_cart"></span></a>
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
                <h1 class="animated fadeIn wow" data-wow-delay="0.4s"><?= $data_hero_section['hero_section_title'] ?></h1>
                <span class="sub-title animated fadeInDown wow" data-wow-delay="0.2s"><?= $data_hero_section['hero_section_deskripsi'] ?></span>

                <div class="d-flex justify-content-center">
                    <img class="animated fadeIn wow  h-50 w-50" style="border-radius: 10px; max-width: 500px; height: auto" data-wow-delay="0.5s" src="<?= base_url('uploads/frontend/hero-section/') . $data_hero_section['hero_section_img'] ?>" alt="Product">
                </div>
            </div>

        </div>

    </div>
    <div class="d-flex justify-content-center">
        <h1 class="animated fadeIn mt-3 wow" data-wow-delay="1.2s"><?= $title ?></h1>
    </div>
    <div class="d-flex justify-content-center animated fadeIn wow" data-wow-delay="1.2s">
        <div class="row p-2 ">
            <?php
            if (empty($page)) {
                echo '<h1 class="text-center text-danger">Halaman tidak ditemukan</h1>';
            } else {
                if (file_exists(APPPATH . '/views/shop/page/' . $page . '.php')) {
                    include APPPATH . '/views/shop/page/' . $page . '.php';
                } else {
                    echo '<h1 class="text-center text-danger">File tidak ditemukan</h1>';
                }
            }
            ?>

        </div>

    </div>

    <div class="d-flex justify-content-center ">
        <nav class="animated fadeIn wow" data-wow-delay="0.4s">
            <?php if ($this->uri->segment(2) == "") : ?>
                <?php error_reporting(0) ?>
            <?php endif; ?>

            <?php echo $this->pagination->create_links() ?>
        </nav>

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

            <p class="copyright"><?= $data_toko['copyright'] ?></p>
        </div>
    </footer>

    <!-- Modal trigger button -->


    <!-- Modal Body -->
    <div class="modal fade" id="modalId" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: white;">
                    <h5 class="modal-title" id="modalTitleId">Cari Produk</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body" style="background: white;">

                    <form action="<?= site_url('produk/') . $this->uri->segment(2) . '?keyword=' ?>" method="get" class="form-search-product">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" autofocus tabindex="1" placeholder="Cari..." name="keyword" id="" class="form-control">
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="background: white; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mnProduk').addClass('active');
            countCart()
        });

        function countCart() {
            $.ajax({
                url: '<?= site_url('rest/shop/countcart') ?>',
                method: 'get',
                success: function(res) {
                    $('#count_cart').text(res);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }

        function Rp(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp ' + rupiah;
        }

        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
                toast.style.zIndex = 9999999
            }
        });
    </script>
    <input style="top: 340px; opacity: 0; border: 5px solid white; box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px inset, rgba(0, 0, 0, 0.1) 0px 0px 16px; padding: 15px; background: rgb(255, 41, 184) none repeat scroll 0% 0%; margin: 0px 0px 10px; position: fixed; left: 20px; color: rgb(255, 255, 255); height: 40px; z-index: 9999;" type="hidden" class="jscolor colorpcikewebjs" value="FF29B8" autocomplete="off">
</body>

</html>