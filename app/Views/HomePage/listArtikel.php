<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
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
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script>
	const KATEGORI = '<?= $kategori; ?>';
</script>
<script src="<?= base_url('assets/js/artikel.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

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
						<a class="logo">
							<img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt="" width="65"
								height="55">
						</a>
						<!-- ***** Logo End ***** -->

						<!-- ***** Menu Start ***** -->
						<ul class="nav">
							<li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
							<li class="scroll-to-section"><a href="#activity" class="menu-item">Kegiatan</a></li>
							<li class="scroll-to-section"><a href="#services" class="menu-item">Layanan</a></li>
							<li class="scroll-to-section"><a href="#contact-us" class="menu-item">Contact Us</a></li>
						</ul>
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
	<section class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-4 pt-5">
					<div class="card text-white card-has-bg click-col"
						style="background-image:url('<?= base_url('assets/images/Picture42.jpg'); ?>'); object-fit: contain;">
						<div class="card-img-overlay d-flex flex-column">
							<div class="card-body">
								<small class="card-meta mb-2">Thought Leadership</small>
								<h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem Ipsum Sit Amet Consectetur
										dipisi?</a></h4>
								<small><i class="far fa-clock"></i> October 15, 2020</small>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-body">
									<small><i class="far fa-clock"></i> October 15, 2020</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 pt-5">
					<div class="card text-white card-has-bg click-col"
					style="background-image:url('<?= base_url('assets/images/Picture48.jpg'); ?>');">
						<div class="card-img-overlay d-flex flex-column">
							<div class="card-body">
								<small class="card-meta mb-2">Thought Leadership</small>
								<h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem Ipsum Sit Amet Consectetur
										dipisi?</a></h4>
								<small><i class="far fa-clock"></i> October 15, 2020</small>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-body">
									<small><i class="far fa-clock"></i> October 15, 2020</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 pt-5">
					<div class="card text-white card-has-bg click-col"
					style="background-image:url('<?= base_url('assets/images/Picture301.jpg'); ?>');">
						<div class="card-img-overlay d-flex flex-column">
							<div class="card-body">
								<small class="card-meta mb-2">Thought Leadership</small>
								<h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem Ipsum Sit Amet Consectetur
										dipisi?</a></h4>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-body">
									<small><i class="far fa-clock"></i> October 15, 2020</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 pt-4">
					<div class="card text-white card-has-bg click-col"
						style="background-image:url('<?= base_url('assets/images/Picture42.jpg'); ?>');">
						<div class="card-img-overlay d-flex flex-column">
							<div class="card-body">
								<small class="card-meta mb-2">Thought Leadership</small>
								<h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem Ipsum Sit Amet Consectetur
										dipisi?</a></h4>
								<small><i class="far fa-clock"></i> October 15, 2020</small>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-body">
									<small><i class="far fa-clock"></i> October 15, 2020</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 pt-4">
					<div class="card text-white card-has-bg click-col"
					style="background-image:url('<?= base_url('assets/images/Picture48.jpg'); ?>');">
						<div class="card-img-overlay d-flex flex-column">
							<div class="card-body">
								<small class="card-meta mb-2">Thought Leadership</small>
								<h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem Ipsum Sit Amet Consectetur
										dipisi?</a></h4>
								<small><i class="far fa-clock"></i> October 15, 2020</small>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-body">
									<small><i class="far fa-clock"></i> October 15, 2020</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 pt-4">
					<div class="card text-white card-has-bg click-col"
					style="background-image:url('<?= base_url('assets/images/Picture301.jpg'); ?>');">
						<div class="card-img-overlay d-flex flex-column">
							<div class="card-body">
								<small class="card-meta mb-2">Thought Leadership</small>
								<h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem Ipsum Sit Amet Consectetur
										dipisi?</a></h4>
							</div>
							<div class="card-footer">
								<div class="media">
									<div class="media-body">
									<small><i class="far fa-clock"></i> October 15, 2020</small>
									</div>
								</div>
							</div>
						</div>
					</div>
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
								<p>Quisque orci nisl, viverra et sem ac, tincidunt egestas massa. Morbi est arcu, hendrerit ac vehicula
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