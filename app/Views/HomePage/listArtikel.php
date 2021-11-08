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
<link rel="stylesheet" href="<?= base_url('assets/css/sidebar/reset.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/sidebar/style.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/owl-carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/imgfix.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>

<script>
	const KATEGORI = '<?= $kategori; ?>';
</script>
<script src="<?= base_url('assets/js/artikel.js'); ?>"></script>
<script src="<?= base_url('assets/js/dropdown/bootstrap.min.js'); ?>"></script>
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
		<div class="container col-lg-4 col-12">
			<div class="row">
				<div class="col-12">
					<nav class="main-nav">
						<!-- ***** Logo Start ***** -->
						<a class="logo" href="<?= base_url('/'); ?> ">
							<img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt=""
								width="65" height="55">
						</a>
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
		<div class="row" id="container-article">
			<div class="col-12 d-none" id="img-404">
				<img src="<?= base_url('assets/images/404.jpg') ?>" alt="" style="max-width:100%; opacity:0.7;">
			</div>
		</div>
		<div class="row" id="container-article">
			<div class="col-12 d-none" id="img-404">
				<img src="<?= base_url('assets/images/404.jpg') ?>" alt="" style="max-width:100%; opacity:0.7;">
			</div>
		</div>


		<div class=" col-4">
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
					<h3 class="title">Blog Categories</h3>
					<ul class="categor-list">
						<li><a href="#">Men's Apparel</a></li>
						<li><a href="#">Women's Apparel</a></li>
						<li><a href="#">Bags Collection</a></li>
						<li><a href="#">Accessories</a></li>
						<li><a href="#">Sun Glasses</a></li>
					</ul>
				</div>
				<!--/ End Single Widget -->
				<!-- Single Widget -->
				<div class="single-widget recent-post">
					<h3 class="title">Recent post</h3>
					<!-- Single Post -->
					<div class="single-post">
						<div class="image">
							<img src="https://via.placeholder.com/100x100" alt="#">
						</div>
						<div class="content">
							<h5><a href="#">Top 10 Beautyful Women Dress in the world</a></h5>
							<ul class="comment">
								<li><i class="fa fa-calendar" aria-hidden="true"></i>Jan 11, 2020</li>
								<li><i class="fa fa-commenting-o" aria-hidden="true"></i>35</li>
							</ul>
						</div>
					</div>
					<div class="single-post">
						<div class="image">
							<img src="https://via.placeholder.com/100x100" alt="#">
						</div>
						<div class="content">
							<h5><a href="#">Top 10 Beautyful Women Dress in the world</a></h5>
							<ul class="comment">
								<li><i class="fa fa-calendar" aria-hidden="true"></i>Mar 05, 2019</li>
								<li><i class="fa fa-commenting-o" aria-hidden="true"></i>59</li>
							</ul>
						</div>
					</div>
					<!-- End Single Post -->

				</div>
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