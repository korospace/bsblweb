<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
	body {}

	section.wrapper {
		margin: 0 !important;
		min-height: 490px;
	}

	@media (max-width:990px) {
		body {
			overflow: hidden;
		}
	}
</style>
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/artikel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/dropdown/bootstrap.dropdown.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/dropdown/owl.carousel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/dropdown/style.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script>
	const KATEGORI = '<?= $kategori; ?>';
</script>
<script src="<?= base_url('assets/js/artikel.js'); ?>"></script>
<script src="<?= base_url('assets/js/dropdown/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/dropdown/jquery-3.3.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/dropdown/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/dropdown/main.js'); ?>"></script>
<script src="<?= base_url('assets/js/dropdown/popper.min.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<body class="">

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert info **** -->
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
						<!-- ***** Logo End ***** -->

						<!-- ***** Menu Start ***** -->
						<!-- <ul class="nav">
							<li class="submenu">
								<a href="javascript:;">Artikel Lainnya</a>
								<ul>
									<li><a href="" class="menu-item">Webinar</a></li>
									<li><a href="" class="menu-item">KKN</a></li>
									<li><a href="" class="menu-item">Sosialisasi & Edukasi</a></li>
								</ul>
							</li>
						</ul> -->
						<a class='menu-trigger'>
							<span>Menu</span>
						</a>
						<!-- ***** Menu End ***** -->
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- ***** Header Area End ***** -->

	<!-- CARDS -->
	<section class="wrapper d-flex justify-content-center align-items-center">
		<div class="content">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-md-12">
						<div class="dropdown custom-dropdown">
							<a href="#" data-toggle="dropdown" class="dropdown-link" aria-haspopup="true"
								aria-expanded="false">
								<span class="icon-file-text-o mr-2"></span>Artikel Lainnya
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="#" class="dropdown-item">Webinar</a>
								<a href="#" class="dropdown-item">KKN</a>
								<a href="#" class="dropdown-item">NDSJN</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" id="container-article">
			<div class="col-12 d-none" id="img-404">
				<img src="<?= base_url('assets/images/404.jpg') ?>" alt="" style="max-width:100%; opacity:0.7;">
			</div>
		</div>
	</section>


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
										<p>125, Park street aven, Brocklyn,<span>Newyork.</span></p>
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