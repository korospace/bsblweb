<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
		html,body{
			height:100%;
		}
		#toggle,.switch-section{
			transition: all 0.3s;
		}
		.switch-section:hover{
			background-color: rgba(217, 228, 252, 0.5);
		}
	</style>
  	<!-- ** develoment ** -->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<!-- ** production ** -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/admin.transaksi.css'); ?>"> -->
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-icons.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-svg.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/soft-ui-dashboard.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script>
		const IDADMIN   = '<?= $idadmin; ?>';
		const PASSADMIN = '<?= $password; ?>';
	</script>
	<script src="<?= base_url('assets/js/core/jquery-2.1.0.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/core/soft-ui-dashboard.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/parent.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.session.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.transaksi.js'); ?>"></script>
	<!-- <script src="<?= base_url('assets/js/admin.transaksi.min.js'); ?>"></script> -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<body class="g-sidenav-show bg-gray-100" style="overflow: hidden;">
		<!-- **** Sidebar **** -->
		<?= $this->include('Components/adminSidebar'); ?>

		<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg d-flex flex-column">
			<!-- navbar -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">transaksi</li>
						</ol>
						<h6 class="font-weight-bolder mb-0">Halaman Transaksi</h6>
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
			<div class="container-fluid py-4 d-flex flex-column" style="flex: 1;max-height: 90%;overflow: hidden;">
				<div class="row" style="flex: 1;max-height: 96%;">
					<div class="col-12 h-100" style="max-height: 100%;">
						<div class="card mb-4 h-100 d-flex flex-column" style="max-height: 100%;overflow: hidden;font-family: 'qc-semibold';">
							<!-- toggle switch -->
							<div class="form-row py-2 d-flex justify-content-center" style="font-family: 'qc-semibold';">
								<div id="toggle-wraper" class="position-relative p-0 d-flex align-items-center text-xxs" style="border-radius: 4px;width: 320px;height: 25px;box-shadow: inset 0 0 4px 0px rgba(0, 0, 0, 0.4);">
									<div id="toggle" class="position-absolute d-flex justify-content-center align-items-center bg-success opacity-7 text-white" data-color="success" style="width: 80px;height: 23px;margin: 0 1px;z-index: 10;border-radius: 5px;">
										setor sampah
									</div>

									<div class="switch-section h-100 d-flex justify-content-center align-items-center cursor-pointer position-relative opacity-0" data-color="success" style="flex: 1;z-index: 9;">
										setor sampah
									</div>
									<div class="switch-section h-100 d-flex justify-content-center align-items-center cursor-pointer position-relative" data-color="warning" style="flex: 1;z-index: 9;">
										konversi saldo										
									</div>
									<div class="switch-section h-100 d-flex justify-content-center align-items-center cursor-pointer position-relative" data-color="danger" style="flex: 1;z-index: 9;">
										tarik saldo
									</div>
									<div class="switch-section h-100 d-flex justify-content-center align-items-center cursor-pointer position-relative" data-color="info" style="flex: 1;z-index: 9;">
										jual sampah										
									</div>
								</div>
							</div>
							<!-- search nasabah -->
							<div class="form-row p-0 d-flex mt-4 px-4" style="font-family: 'qc-semibold';">
								<div class="input-group col-3">
									<div class="input-group-prepend">
										<span class="input-group-text bg-gray pl-2 pr-2 border-md border-right-0" style="max-height: 39px;">
											<i class="fas fa-search text-muted"></i>
										</span>
									</div>
									<input id="search-admin" type="text" class="form-control form-control-sm h-100 px-2" placeholder="id nasabah" style="max-height: 39px;">
								</div>
								<div class="input-group p-0 col-1" style="min-width: 50px;max-width: 50px;">
									<button class="btn btn-dark h-100 mt-4 mt-sm-0 text-xxs p-1" data-toggle="modal" data-target="#modalAddEditAdmin" onclick="openModalAddEditAdm('addadmin')" style="width: 100%;">cari</button>
								</div>
								<div class="input-group p-0 col-12 mt-2 px-1">
									<table>
										<tr>
											<td>email</td>
											<td id="email-check">:</td>
										</tr>
										<tr>
											<td>username</td>
											<td id="username-check">:</td>
										</tr>
										<tr>
											<td>nama lengkap&nbsp;&nbsp;</td>
											<td id="nama-lengkap-check">:</td>
										</tr>
										<tr>
											<td>no.telepon</td>
											<td id="notelp-check">:</td>
										</tr>
										<tr>
											<td>alamat</td>
											<td id="alamat-check">:</td>
										</tr>
									</table>
								</div>
							</div>
							<!-- container table -->
							<div class="px-0 pt-0 pb-2 position-relative" style="flex: 1;overflow: hidden;font-family: 'qc-semibold';">
								
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