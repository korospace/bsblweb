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
<link rel="stylesheet" href="<?= base_url('assets/css/homepage.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script src="<?= base_url('assets/js/font-awesome.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/scrollreveal.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/owl-carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/imgfix.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.counterup.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/homepage.js'); ?>"></script>
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
	<div class="cards">
		<div class="container">
			<div class="text-center">
				<h1>Aktivitas KKN Bank Sampah Budi Luhur</h1>
			</div>
			<div class="container">
				<div class="card-columns grid">
					<div class="card">
						<a href="#">
							<img class="card-img-top"
								src="https://images.unsplash.com/photo-1535025639604-9a804c092faa?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=6cb0ceb620f241feb2f859e273634393&auto=format&fit=crop&w=500&q=80"
								alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Lorem ipsum dolor sit amet.</h5>
								<p class="card-text">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium ad alias,
									aliquid amet
									aspernatur atque culpa cum debitis dicta doloremque, dolorum ea eos et excepturi
									explicabo facilis
									harum illo impedit incidunt laborum laudantium...
								</p>
								<p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>1000<i
											class="far fa-user"></i>admin<i class="fas fa-calendar-alt"></i>Jan 20,
										2018</small></p>
							</div>
						</a>
					</div>
					<div class="card">
						<a href="#">
							<img class="card-img-top"
								src="https://images.unsplash.com/photo-1472076638602-b1f8b1ac0b4a?ixlib=rb-0.3.5&s=63c9de7246b535be56c8eaff9b87dd89&auto=format&fit=crop&w=500&q=80"
								alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
									Consequatur,
									doloremque!</h5>
								<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
									Distinctio iusto maxime
									nemo omnis praesentium similique.</p>
								<p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>1000<i
											class="far fa-user"></i>admin<i class="fas fa-calendar-alt"></i>Jan 20,
										2018</small></p>
							</div>
						</a>
					</div>
					<div class="card">
						<a href="#">
							<img class="card-img-top"
								src="https://images.unsplash.com/photo-1535086181678-5a5c4d23aa7d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=34c86263bec2c8f74ceb74e9f4c5a5fc&auto=format&fit=crop&w=500&q=80"
								alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Lorem ipsum dolor sit amet, consectetur.</h5>
								<p class="card-text">Amet commodi deleniti enim laboriosam odio placeat praesentium quis
									ratione rerum
									suscipit.</p>
								<p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>1000<i
											class="far fa-user"></i>admin<i class="fas fa-calendar-alt"></i>Jan 20,
										2018</small></p>
							</div>
						</a>
					</div>
					<div class="card">
						<a href="#">
							<img class="card-img-top"
								src="https://images.unsplash.com/photo-1535074153497-b08c5aa9c236?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=d2aaf944a59f16fe1fe72f5057b3a7dd&auto=format&fit=crop&w=500&q=80"
								alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Lorem ipsum dolor sit amet, consectetur.</h5>
								<p class="card-text">This is a longer card with supporting text below as a natural
									lead-in to additional
									content. This content is a little bit longer.</p>
								<p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>1000<i
											class="far fa-user"></i>admin<i class="fas fa-calendar-alt"></i>Jan 20,
										2018</small></p>
							</div>
						</a>
					</div>
					<div class="card">
						<a href="#">
							<img class="card-img-top"
								src="https://images.unsplash.com/photo-1535124406821-d2848dfbb25c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=98c434d75b44c9c23fc9df2a9a77d59f&auto=format&fit=crop&w=500&q=80"
								alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Lorem ipsum dolor sit amet.</h5>
								<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At,
									consequatur culpa
									cumque deserunt dignissimos error explicabo fugiat harum ipsam magni minus mollitia
									nemo perferendis
									qui repellendus rerum saepe vel voluptate voluptatem voluptatum!
									<p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>1000<i
												class="far fa-user"></i>admin<i class="fas fa-calendar-alt"></i>Jan 20,
											2018</small></p>
							</div>
						</a>
					</div>
					<div class="card">
						<a href="#">
							<img class="card-img-top"
								src="https://images.unsplash.com/photo-1508015926936-4eddcc6d4866?ixlib=rb-0.3.5&s=10b3a8717ab609be8d7786cab50c4e0b&auto=format&fit=crop&w=500&q=80"
								alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h5>
								<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque
									commodi debitis
									eaque explicabo fuga maiores necessitatibus, neque omnis optio vel!</p>
								<p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>1000<i
											class="far fa-user"></i>admin<i class="fas fa-calendar-alt"></i>Jan 20,
										2018</small></p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- footer section starts  -->

	<footer class="deneb_footer">
		<div class="widget_wrapper" style="background-image: url(assets/images/footer-bg.png);">
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