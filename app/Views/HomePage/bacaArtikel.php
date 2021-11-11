<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
	body {}

	section.wrapper {
		margin-left: 0 !important;
		margin-right: 0 !important;
		min-height : 490px;
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

    <header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i> +62 (021) 555-582</li>
								<li><i class="ti-email"></i> support@lavish.co.id</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-power-off"></i><a href="#">Login</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="index.php"><img src="images/logo.png" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12"></div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar shopping">
								<a href="cart.php" class="single-icon"><i class="ti-bag"></i> <span class="total-count"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
												<li><a href="index.php">Home</a></li>
												<li><a href="#">Service</a></li>
												<li><a href="aboutus.php">About Us</a></li>
												<li><a href="contact.php">Contact Us</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->

	<!-- Start Blog Single -->
	<section class="blog-single section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-12">
					<div class="blog-single-main">
						<div class="row">
							<div class="col-12">
								<div class="image">
									<img src="https://via.placeholder.com/950x460" alt="#">
								</div>
								<div class="blog-detail">
									<h2 class="blog-title">What are the secrets to start- up success?</h2>
									<div class="blog-meta">
										<span class="author"><a href="#"><i class="fa fa-user"></i>By Admin</a><a href="#"><i
													class="fa fa-calendar"></i>Dec 24, 2018</a><a href="#"><i class="fa fa-comments"></i>Comment
												(15)</a></span>
									</div>
									<div class="content">
										<p>What a crazy time. I have five children in colleghigh school graduates.jpge or pursing post
											graduate studies Each of my children attends college far from home, the closest of which is more
											than 800 miles away. While I miss being with my older children, I know that a college experience
											can be the source of great growth and experience can be the source of source of great growth and
											can provide them with even greater in future.</p>
										<blockquote> <i class="fa fa-quote-left"></i> Do what you love to do and give it your very best.
											Whether it's business or baseball, or the theater, or any field. If you don't love what you're
											doing and you can't give it your best, get out of it. Life is too short. You'll be an old man
											before you know it. risus. Ut tincidunt, erat eget feugiat eleifend, eros magna dapibus diam.
										</blockquote>
										<p>What a crazy time. I have five children in colleghigh school graduates.jpge or pursing post
											graduate studies Each of my children attends college far from home, the closest of which is more
											than 800 miles away. While I miss being with my older children, I know that a college experience
											can be the source of great growth and experience can be the source of source of great growth and
											can provide them with even greater in future.</p>
										<p>What a crazy time. I have five children in colleghigh school graduates.jpge or pursing post
											graduate studies Each of my children attends college far from home, the closest of which is more
											than 800 miles away. While I miss being with my older children, I know that a college experience
											can be the source of great growth and experience can be the source of source of great growth and
											can provide them with even greater in future.</p>
									</div>
								</div>
								<div class="share-social">
									<div class="row">
										<div class="col-12">
											<div class="content-tags">
												<h4>Tags:</h4>
												<ul class="tag-inner">
													<li><a href="#">Glass</a></li>
													<li><a href="#">Pant</a></li>
													<li><a href="#">t-shirt</a></li>
													<li><a href="#">swater</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="comments">
									<h3 class="comment-title">Comments (3)</h3>
									<!-- Single Comment -->
									<div class="single-comment">
										<img src="https://via.placeholder.com/80x80" alt="#">
										<div class="content">
											<h4>Alisa harm <span>At 8:59 pm On Feb 28, 2018</span></h4>
											<p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation
												collaboration Phosfluorescently leverage others enterprisee Phosfluorescently leverage.</p>
											<div class="button">
												<a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
											</div>
										</div>
									</div>
									<!-- End Single Comment -->
									<!-- Single Comment -->
									<div class="single-comment left">
										<img src="https://via.placeholder.com/80x80" alt="#">
										<div class="content">
											<h4>john deo <span>Feb 28, 2018 at 8:59 pm</span></h4>
											<p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation
												collaboration Phosfluorescently leverage others enterprisee Phosfluorescently leverage.</p>
											<div class="button">
												<a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
											</div>
										</div>
									</div>
									<!-- End Single Comment -->
									<!-- Single Comment -->
									<div class="single-comment">
										<img src="https://via.placeholder.com/80x80" alt="#">
										<div class="content">
											<h4>megan mart <span>Feb 28, 2018 at 8:59 pm</span></h4>
											<p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation
												collaboration Phosfluorescently leverage others enterprisee Phosfluorescently leverage.</p>
											<div class="button">
												<a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
											</div>
										</div>
									</div>
									<!-- End Single Comment -->
								</div>
							</div>

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

</body>
<?= $this->endSection(); ?>