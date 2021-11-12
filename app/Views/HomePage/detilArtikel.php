<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
</style>

<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/artikel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/artikel/style.css'); ?>">


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
<script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/detilArtikel.js'); ?>"></script>

<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
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
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="blog-single-main">
                    <div class="row">
                        <div class="col-12">
                            <div class="image position-relative">
                                <img src="<?= base_url('/assets/images/default-thumbnail.webp'); ?>" alt="#" class="w-100 position-relative" style="z-index: 1;">
                                <img src="<?= base_url('/assets/images/default-thumbnail.webp'); ?>" alt="#" id="blog-img" class="w-100 h-100 position-absolute" style="z-index: 10;left:0;">
                            </div>
                            <div class="blog-detail">
                                <h2 class="blog-title" id="blog-title"></h2>
                                <div class="blog-meta">
                                    <span class="author" id="blog-date"></span>
                                </div>
                                <div class="content" id="blog-content">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="main-sidebar">
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
                    <div class="single-widget recent-post">
                        <h3 class="title">Artikel Rekomendasi</h3>
                        <!-- Single Post -->
                        <div id="blog-recommended">

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