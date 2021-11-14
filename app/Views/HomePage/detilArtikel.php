<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
    <!-- ** develoment ** -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/artikel/style.css'); ?>"> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/artikel-layout.min.css'); ?>"> -->
    <!-- ** production ** -->
    <link rel="stylesheet" href="<?= base_url('assets/css/purge/artikel/detilArtikel.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/purge/artikel-layout/detilArtikel.css'); ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/detilartikel.css'); ?>"> -->
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
    <style>
        .categor-list li, .categor-list a {
            margin: 0 !important;
            height: 34px !important;
            /* padding: 12px 0 12px 0 !important; */
        }
        #blog-content li,#blog-content ul,#blog-content ol{
            list-style: inside !important;
        }
        #blog-content ol li{
            list-style-type: decimal !important;
            line-height: 30px !important;
        }
        #blog-content li{
            line-height: 30px !important;
        }
        #blog-content p{
            line-height: 20px !important;
            margin-bottom: 10px !important;
        }
        .skeleton{
            border-radius: 4px;
            background-color: #777777;
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        #blog-title.skeleton{
            width: 280px;
            height: 24px;
        }
        #blog-date.skeleton{
            width: 148px;
            height: 20px;
        }
        #single-post #title.skeleton{
            width: 200px;
            height: 18px;
        }
        #single-post #date.skeleton{
            width: 148px;
            height: 14px;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
    <script>
        const IDARTIKEL = '<?= $idArtikel; ?>';
    </script>
    <script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/waypoints.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/owl-carousel.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/imgfix.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/scrollreveal.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/detilArtikel.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

    <!-- **** Alert Info **** -->
    <?= $this->include('Components/alertInfo'); ?>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container-fluid px-4 px-sm-5">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a class="logo" href="<?= base_url('/'); ?> ">
                            <img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt=""
                                width="65" height="55">
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
        
    </header>
    <!-- ***** Header Area End ***** -->
    <section class="blog-single section">
        <div class="container-fluid px-4 px-sm-5">
            <div class="row position-relative">

                <div id="img-404" class="w-100 h-100 d-flex justify-content-center align-items-center d-none">
                    <img src="<?= base_url('assets/images/artikel-404.webp') ?>" alt="" style="max-width:100%; opacity:0.7;">
                </div>

                <div class="col-lg-8 col-12 main-content">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image position-relative skeleton">
                                    <img src="<?= base_url('/assets/images/skeleton-thumbnail.webp'); ?>" alt="#" class="w-100" style="opacity: 0;">
                                    <img src="" alt="" id="blog-img" class="w-100 h-100 position-absolute d-none" style="z-index: 10;left:0;">
                                </div>
                                <div class="blog-detail">
                                    <h2 id="blog-title" class="blog-title skeleton"></h2>
                                    <div class="blog-meta">
                                        <span id="blog-date" class="author skeleton"></span>
                                    </div>
                                    <div class="content" id="blog-content">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 sidebar-content pt-4">
                    <div class="main-sidebar mt-1">
                        <!-- Single Widget -->
                        <div class="single-widget search">
                            <div class="form">
                                <input type="email" placeholder="Search Here...">
                                <a class="button" href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Artikel Lainnya</h3>
                            <ul class="categor-list">
                                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                                <li><a href="<?= base_url('/homepage/webinar'); ?>">Webinar</a></li>
                                <li><a href="<?= base_url('/homepage/kkn'); ?>">KKN</a></li>
                                <li><a href="<?= base_url('/homepage/sosial%20dan%20edukasi'); ?>">Sosialisasi & Edukasi</a></li>
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post pb-5">
                            <h3 class="title">Artikel Rekomendasi</h3>
                            <!-- Single Post -->
                            <div id="blog-recommended" class="row">
                                <?php for ($i=0; $i < 4; $i++) { ?>
                                    <a id="single-post" class="col-12 col-sm-6 col-lg-12 mb-4" href="">
                                        <div class="image position-relative skeleton">
                                            <img src="<?= base_url('/assets/images/skeleton-thumbnail.webp'); ?>" alt="" class="w-100" style="opacity: 0;">
                                        </div>
                                        <div class="content mt-4">
                                            <h5 id="title" class="text-muted skeleton">
                                                
                                            </h5>
                                            <ul class="comment mt-2">
                                                <li id="date" class="skeleton"></li>
                                            </ul>
                                        </div>
                                    </a>
                                    <hr width="">
                                <?php } ?>
                            </div>
                            <!-- End Single Post -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Single Widget -->
    <!-- footer section starts  -->

    <footer class="deneb_footer">
        <div class="widget_wrapper" style="background-image:url('<?= base_url('assets/images/footer-bg.png'); ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="widget widegt_about">
                            <div class="widget_title">
                                <img src="assets/images/logo_1.png" class="img-fluid" alt="">
                                <p>Quisque orci nisl, viverra et sem ac, tincidunt egestas massa. Morbi est arcu,
                                    hendrerit ac vehicula
                                    condimentum, euismod nec tortor praesent consequat urna.</p>
                            </div>
                            <ul class="social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="widget widget_link">
                            <div class="widget_title">
                                <h4>Links</h4>
                            </div>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="#activity">Kegiatan</a></li>
                                <li><a href="#services">Layanan</a></li>
                                <li><a href="#contact-us">Kontak Kami</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="widget widget_contact">
                            <div class="widget_title">
                                <h4>Contact Us</h4>
                            </div>
                            <div class="contact_info">
                                <div class="single_info">
                                    <div class="icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="info">
                                        <p><a>1800-121-3637</a></p>
                                        <p><a>+91 924-614-7999</a></p>
                                    </div>
                                </div>
                                <div class="single_info">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info">
                                        <p><a href="mailto:info@deneb.com">bankasampahbudiluhur@gmail.com</a></p>
                                        <p><a href="mailto:services@deneb.com">bsblservice.com</a></p>
                                    </div>
                                </div>
                                <div class="single_info">
                                    <div class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info">
                                        <p>
                                            <a>Jl. H. Gaim No.50, RT.10/RW.2, Petukangan Utara, Kec. Pesanggrahan, Kota
                                                Jakarta Selatan, Daerah Khusus Ibukota Jakarta.</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright_text">
                            <p>Copyright &copy; 2020 All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!-- footer section ends -->

<?= $this->endSection(); ?>