<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
  	<!-- ** develoment ** -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"> -->
	<!-- ** production ** -->
	<link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/admin.listartikel.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-icons.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-svg.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/soft-ui-dashboard.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script>
		const PASSADMIN = '<?= $password; ?>';
	</script>
	<script src="<?= base_url('assets/js/core/jquery-2.1.0.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/core/soft-ui-dashboard.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	<!-- <script src="<?= base_url('assets/js/admin.artikel.js'); ?>"></script> -->
	<script src="<?= base_url('assets/js/admin.artikel.min.js'); ?>"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<body class="g-sidenav-show bg-gray-100">
		<!-- **** Sidebar **** -->
		<?= $this->include('Components/adminSidebar'); ?>

		<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
			<!-- navbar -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">List artikel</li>
						</ol>
						<h6 class="font-weight-bolder mb-0">List artikel</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-auto pe-md-3 d-flex align-items-center">
							<ul class="navbar-nav justify-content-end">
								<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
									<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
										<div class="sidenav-toggler-inner">
											<i class="sidenav-toggler-line"></i>
											<i class="sidenav-toggler-line"></i>
											<i class="sidenav-toggler-line"></i>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			
			<!-- End Navbar -->
			<div class="container-fluid py-4">
				<div class="row">
					<div class="col-12">
						<div class="card mb-4" style="overflow: hidden;font-family: 'qc-semibold';">
							<!-- search input -->
							<div class="card-header form-row pb-0 d-flex justify-content-between" style="font-family: 'qc-semibold';">
								<div class="input-group col-12 col-sm-6">
									<div class="input-group-prepend">
										<span class="input-group-text bg-gray px-4 border-md border-right-0" style="max-height: 39px;">
											<i class="fas fa-search text-muted"></i>
										</span>
									</div>
									<input id="search-artikel" type="text" class="form-control h-100 px-2" placeholder="judul artikel/kategori artikel" style="max-height: 39px;">
								</div>
								<div class="input-group col-12 col-sm-1 p-0" style="min-width: 90px;">
									<a class="btn btn-success mt-4 mt-sm-0 text-xxs" href="<?= base_url('admin/addartikel');?>" style="width: 100%;">tambah</a>
								</div>
							</div>
							<!-- container list -->
							<div class="card-body pl-4 pr-3 pb-2">
								<div class="p-0 position-relative" style="min-height: 380px;max-height: 380px;overflow: auto;font-family: 'qc-semibold';">
									<!-- spinner -->
									<div id="list-artikel-spinner" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
										<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
									</div>
									<!-- message not found -->
									<div id="list-artikel-notfound" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
										<h6 id="text-notfound" class='opacity-6'></h6>
									</div>
									<!-- Card List Article  -->
									<div id="container-list-artikel" class="container-fluid p-0 row">
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- FOOTER -->
				<footer class="footer pt-3  ">
					<div class="container-fluid">
						<div class="row align-items-center justify-content-lg-between">
							<div class="col-lg-6 mb-lg-0 mb-4">
								<div class="copyright text-center text-sm text-muted text-lg-start">
									© <script>
										document.write(new Date().getFullYear())
									</script>,
									Bank Sampah Budi Luhur
								</div>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</main>
	</body>
<?= $this->endSection(); ?>