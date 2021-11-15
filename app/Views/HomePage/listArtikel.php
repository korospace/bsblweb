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
	
	<footer class="">
		<div class="pt-5" style="background-image:url('<?= base_url('assets/images/footer-bg.png'); ?>');background-repeat: no-repeat;background-size: cover;">
			<div class="container-fluid pt-5 pt-lg-0">
				<div class="row mt-5 pb-5 px-4">
					<div class="col-12 col-md-2 mt-5 mt-md-0">
						<div class="widget widget_link">
							<h4 class="text-white" style="font-weight: bold;">Links</h4>
							<ul class="mt-4">
								<li class="pb-2"><a class="text-white" href="/">Home</a></li>
								<li class="pb-2"><a class="text-white" href="#activity">Kegiatan</a></li>
								<li class="pb-2"><a class="text-white" href="#services">Layanan</a></li>
								<li class="pb-2"><a class="text-white" href="#contact-us">Kontak Kami</a></li>
							</ul>
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
									<div class="info d-flex flex-column">
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
									<div class="info d-flex flex-column">
										<a class="text-white" href="bankasampahbudiluhur@gmail.com">
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
									<div class="info text-white">
										Jl. H. Gaim No.50, RT.10/RW.2, Petukangan Utara, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta.
									</div>
								</div>
							</div>
						</div>
					</div>
          
					<div class="col-12 col-md-5 mt-5 mt-md-0">
						<div class="widget widegt_about">
							<h4 class="text-white" style="font-weight: bold;">Social media</h4>
							<p class="mt-4 text-white">Quisque orci nisl, viverra et sem ac, tincidunt egestas massa. Morbi est arcu, hendrerit ac vehicula condimentum, euismod nec tortor praesent consequat urna.</p>
							<ul class="social">
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-instagram"></i></a></li>
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