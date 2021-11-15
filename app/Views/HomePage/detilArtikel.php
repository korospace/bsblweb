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
        #blog-content blockquote{
            background: #F6F6F6;
            padding: 20px;
            margin: 0;
            color: #555;
            border-left: 3px solid #c1d966;
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

        .widegt_about p {
            color: #FFF;
            margin-bottom: 20px;
        }
        .widegt_about .social li {
            display: inline-block;
            margin-right: 10px;
        }
        .widegt_about .social li a {
            display: block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            background-color: #f9e6d4;
            color: #537629;
            font-size: 14px;
            -webkit-transition: all all 0.5s ease-out 0s;
            -moz-transition: all all 0.5s ease-out 0s;
            -ms-transition: all all 0.5s ease-out 0s;
            -o-transition: all all 0.5s ease-out 0s;
            transition: all all 0.5s ease-out 0s;
        }
        .widegt_about .social li a:hover,
        .widegt_about .social li a:focus {
            background-image: -moz-linear-gradient(0deg, #c1d966 0%, #c1d966 100%);
            background-image: -webkit-linear-gradient(0deg, #c1d966 0%, #c1d966 100%);
            background-image: -ms-linear-gradient(0deg, #c1d966 0%, #c1d966 100%);
            color: #fff;
            box-shadow: 2.5px 4.33px 15px 0px rgba(254, 176, 0, 0.4);
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
                            <h3 class="title">Kategori Lainnya</h3>
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
                            <h3 class="title">Artikel Lainnya</h3>
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
    
	<footer class="">
		<div class="pt-5" style="background-image:url('<?= base_url('assets/images/footer-bg.png'); ?>');background-repeat: no-repeat;background-size: cover;">
			<div class="container-fluid px-5 pt-5 pt-lg-0">
				<div class="row mt-5 pb-5 px-4">
					<div class="col-12 col-md-2 mt-5 mt-md-0">
						<div class="widget widget_link">
							<h4 class="text-white" style="font-weight: bold;">Links</h4>
							<div class="mt-4 d-flex flex-column">
								<a class="text-white mb-3" href="/">Home</a>
								<a class="text-white mb-3" href="#activity">Kegiatan</a>
								<a class="text-white mb-3" href="#services">Layanan</a>
								<a class="text-white mb-3" href="#contact-us">Kontak Kami</a>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-5 mt-5 mt-md-0">
						<div class="widget widget_contact">
							<h4 class="text-white" style="font-weight: bold;">Contact Us</h4>
							<div class="mt-4">
								<div class="d-flex">
									<div class="icon mr-3">
										<i class="fas fa-phone-alt" style="color:#C1D966;"></i>
									</div>
									<div class="info d-flex flex-column" style="line-height: 1.5;">
										<a class="text-white" target="_blank" href="https://wa.me/6281385624543?text=Assalamualaikum%20Umi%20Utik,%20saya%20ingin%20bertanya%20mengenai%20banksampah%20budiluhur">
											+62 813-8562-4543
										</a>
										<a class="text-white" target="_blank" href="https://wa.me/6287871911407?text=Assalamualaikum%20Umi%20Utik,%20saya%20ingin%20bertanya%20mengenai%20banksampah%20budiluhur">
											+62 878-7191-1407
										</a>
									</div>
								</div>
								<div class="d-flex mt-3">
									<div class="icon mr-3">
										<i class="fas fa-envelope" style="color:#C1D966;"></i>
									</div>
									<div class="info d-flex flex-column" style="line-height: 1.5;">
										<a class="text-white" href="mailto:bankasampahbudiluhur@gmail.com">
											bankasampahbudiluhur@gmail.com
										</a>
										<a class="text-white" href="mailto:bsblservice@gmail.com">
											bsblservice@gmail.com
										</a>
									</div>
								</div>
								<div class="d-flex mt-3">
									<div class="icon mr-3">
										<i class="fas fa-map-marker-alt" style="color:#C1D966;"></i>
									</div>
									<div class="info text-white" style="line-height: 1.5;">
										Jl. H. Gaim No.50, RT.10/RW.2, Petukangan Utara, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta.
									</div>
								</div>
							</div>
						</div>
					</div>
          
					<div class="col-12 col-md-5 mt-5 mt-md-0">
						<div class="widget widegt_about">
							<h4 class="text-white" style="font-weight: bold;">Social media</h4>
							<p class="mt-4 text-white">
								"Kebersihan menjadi awal dari penilaian baik buruknya seseorang. Kepribadian yang baik
                				akan menjaga kebersihan dirinya, lingkungannya, dan sekitarnya."
							</p>
							<ul class="social">
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="https://www.instagram.com/banksampah.ubl/"><i class="fab fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>

			<div class="container-fluid mt-5 py-3 d-flex justify-content-center">
				<p class="text-light">Copyright &copy; 2020 All rights reserved.</p>
			</div>
		</div>
	</footer>

<!-- footer section ends -->

<?= $this->endSection(); ?>