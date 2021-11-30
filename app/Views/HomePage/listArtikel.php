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
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/artikel.css'); ?>">
    <!-- ** production ** -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/listartikel.css'); ?>"> -->
	<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/artikel/listArtikel.min.css'); ?>"> -->
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

	<!-- ***** Header Area Start ***** -->
	<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-sm-5 position-sticky" style="top: 0;z-index: 10;">
        <a class="logo navbar-brand" href="<?= base_url('/'); ?>">
            <img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt=""
                width="65" height="55">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/'); ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategori
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>

	<section class="wrapper d-flex position-relative" style="margin-top: 30px;z-index: 0;">
		<div class="container-fluid pl-5 pr-5">
			<div class="w-100 h-100 d-flex align-items-center d-none" id="img-404">
				<img src="<?= base_url('assets/images/artikel-404.webp') ?>" alt="" style="min-width:100%;max-width:100%; opacity:0.7;">
			</div>

			<div class="row" id="container-article">
				<?php for ($i=0; $i < 6; $i++) { ?>
					<div class="col-12 col-sm-6 col-md-4 mb-5">
						<div class="card text-white position-relative skeleton" style="box-shadow: none;min-height: 220px;border-radius: 10px;">
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
	
	<!-- **** footer artikiel **** -->
    <?= $this->include('Components/artikelFooter'); ?>
	
<?= $this->endSection(); ?>