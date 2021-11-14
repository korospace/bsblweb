<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
		body {}

		section.wrapper {
			margin-left: 0 !important;
			margin-right: 0 !important;
			min-height: 490px;
		}

        .skeleton{
            background: rgb(193, 217, 102) !important;
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: .8;
            }
            50% {
                opacity: .5;
            }
        }

		@media (max-width:990px) {
			body {
				overflow: hidden;
			}
		}
	</style>

    <!-- ** develoment ** -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"> -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/artikel.min.css'); ?>"> -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/sidebar/style.css'); ?>"> -->
    <!-- ** production ** -->
    <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/listartikel.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/purge/artikel/listArtikel.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/sidebar/style.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script>
		const KATEGORI = '<?= $kategori; ?>';
	</script>
	<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/waypoints.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/owl-carousel.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/imgfix.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/scrollreveal.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>

	<script src="<?= base_url('assets/js/listArtikel.js'); ?>"></script>
	<script src="<?= base_url('assets/js/dropdown/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/dropdown/popper.min.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<!-- **** Alert info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<!-- ***** Header Area Start ***** -->
	<header class="header-area">
		<div class="container-fluid px-5">
			<div class="row">
				<div class="col-12">
					<nav class="main-nav">
						<a class="logo" href="<?= base_url('/'); ?> ">
							<img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt="" width="65" height="55">
						</a>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<section class="wrapper d-flex" style="margin-top: 100px;">
		
		<div class="container-fluid pl-5 pr-0">
			<div class="w-100 h-100 d-flex align-items-center d-none" id="img-404">
				<img src="<?= base_url('assets/images/artikel-404.webp') ?>" alt="" style="max-width:100%; opacity:0.7;">
			</div>

			<div class="row" id="container-article">
				<?php for ($i=0; $i < 6; $i++) { ?>
					<div class="col-sm-6 col-lg-4 mb-5">
						<div class="card text-white position-relative skeleton" style="box-shadow: none;">
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="col-5 col-md-3">
				<div class="main-sidebar mt-0">
					<div class="single-widget search">
						<div class="form">
							<input type="email" placeholder="Search Here...">
							<a class="button" href="#"><i class="fa fa-search"></i></a>
						</div>
					</div>
					<div class="single-widget category">
						<h3 class="title">Artikel Lainnya</h3>
						<ul class="categor-list">
							<li><a href="<?= base_url('/'); ?>">Home</a></li>
							<li><a href="<?= base_url('/homepage/webinar'); ?>">Webinar</a></li>
							<li><a href="<?= base_url('/homepage/kkn'); ?>">KKN</a></li>
							<li><a href="<?= base_url('/homepage/sosial%20dan%20edukasi'); ?>">Sosialisasi & Edukasi</a></li>
						</ul>
					</div>
				</div>
			</div>
	</section>
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