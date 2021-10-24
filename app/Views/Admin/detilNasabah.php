<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
		.rowCardWraper {
			height: 100% !important;
		}
		
		.detil-transaksi-logo img{
			width: 80px;
		}

		@media (max-width:768px) {
			.rowCardWraper {
				height: auto !important;
			}
		} 
		@media (max-width:422px) {
			.detil-transaksi-logo h4{
				font-size: 14px;
			}
			.detil-transaksi-logo img{
				width: 60px;
			}
			.detil-transaksi-header,
			#detil-transaksi-type ,
			#detil-transaksi-body {
				font-size: 8px;
			}
		} 
	</style>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-icons.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-svg.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/soft-ui-dashboard.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script>
		const IDNASABAH = '<?= $idnasabah; ?>';
	</script>
  	<script src="<?= base_url('assets/js/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/chartjs.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/soft-ui-dashboard.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.detilnasabah.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<body class="g-sidenav-show bg-gray-100">

	<aside class="noprint sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main"  style="font-family: 'qc-semibold';">
		<div class="sidenav-header">
			<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav"></i>
			<a class="nav-link mt-4" href="<?= base_url('admin/listnasabah');?>" style="display: flex;align-items: center;">
				<div
					class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
					<svg width='12px' height='12px' version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30.143 30.143"
						style="enable-background:new 0 0 30.143 30.143;" xml:space="preserve">
						<g>
							<path class="opacity-6" fill="#00000"
								d="M20.034,2.357v3.824c3.482,1.798,5.869,5.427,5.869,9.619c0,5.98-4.848,10.83-10.828,10.83
									c-5.982,0-10.832-4.85-10.832-10.83c0-3.844,2.012-7.215,5.029-9.136V2.689C4.245,4.918,0.731,9.945,0.731,15.801
									c0,7.921,6.42,14.342,14.34,14.342c7.924,0,14.342-6.421,14.342-14.342C29.412,9.624,25.501,4.379,20.034,2.357z" />
							<path class="opacity-6" fill="#00000"
								d="M14.795,17.652c1.576,0,1.736-0.931,1.736-2.076V2.08c0-1.148-0.16-2.08-1.736-2.08
									c-1.57,0-1.732,0.932-1.732,2.08v13.496C13.062,16.722,13.225,17.652,14.795,17.652z" />
						</g>
					</svg>
				</div>
				<span class="nav-link-text ms-1">kembali</span>
			</a>
			<hr class="horizontal dark mt-2">
		</div>
	</aside>
	<main class="noprint main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
			navbar-scroll="true">
			<div class="container-fluid py-1 px-3" style="font-family: 'qc-semibold';">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
						<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
						<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
					</ol>
					<h6 class="font-weight-bolder mb-0">Dashboard</h6>
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
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row" style="font-family: 'qc-medium';">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Kertas</p>
										<h5 id="sampah-kertas" class="font-weight-bolder mb-0">
											0 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fas fa-scroll"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row" style="font-family: 'qc-medium';">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Logam</p>
										<h5 id="sampah-logam" class="font-weight-bolder mb-0">
											0 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fas fa-trophy"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row" style="font-family: 'qc-medium';">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Plastik</p>
										<h5 id="sampah-plastik" class="font-weight-bolder mb-0">
											0 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fas fa-wine-bottle"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="card">
						<div class="card-body p-3">
							<div class="row" style="font-family: 'qc-medium';">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Lain-lain</p>
										<h5 id="sampah-lain-lain" class="font-weight-bolder mb-0">
											0 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="fas fa-wine-glass"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-lg-8">
					<div class="card z-index-2" style="min-height: 400px;max-height: 400px;font-family: 'qc-semibold';">
						<div class="card-header pb-0">
							<h6>Grafik Penyetoran</h6>
						</div>
						<div class="card-body p-3 mt-2">
							<div class="chart">
								<canvas id="chart-line" class="chart-canvas" height="300"></canvas>
							</div>
						</div>
					</div>
				</div>
				<!-- Transaksi -->
				<div class="col-lg-4 mt-4 mt-lg-0">
					<div class="card h-100" style="min-height: 400px;max-height: 400px;overflow: auto;">
						<div class="card-header bg-white position-sticky p-3" style="z-index: 10;top: 0;">
							<div class="row" style="font-family: 'qc-semibold';">
								<div class="col-6 d-flex align-items-center">
									<h6 class="mb-0">History</h6>
								</div>
							</div>
						</div>
						<div id="transaksi-wraper" class="card-body p-3 pb-0 d-flex justify-content-center align-items-center" style="font-family: 'qc-semibold';">
							
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid mt-5 p-0">
				<!-- card AND saldo -->
				<div class="row px-4">
					<div class="col-lg-12 p-0">
						<div class="row">
							<div class="col-xl-4 mb-4 mb-md-0 pl-0 pr-0 pr-md-2">
								<div class="card-id bg-transparent shadow-xl">
									<div class="overflow-hidden position-relative border-radius-md"
										style="background-image: url(<?= base_url('assets/images/curved-images/curved14.jpg'); ?>);">
										<span class="mask bg-gradient-dark"></span>
										<div class="card-body-id position-relative z-index-1 p-3">
											<i class="fas fa-wifi text-white p-2"></i>
											<h5 id="card-id" class="text-white mt-4 mb-5 pb-2" style="font-family: 'qc-medium';">_ _ _ _ _&nbsp;&nbsp;&nbsp;_ _ _
												_&nbsp;&nbsp;&nbsp;_</h5>
											<div class="d-flex">
												<div class="d-flex">
													<div class="me-4" style="font-family: 'qc-medium';">
														<p class="text-white text-sm opacity-8 mb-0">Username</p>
														<h6 id="card-username" class="text-white mb-0">_ _ _ _ _ _</h6>
													</div>
													<div style="font-family: 'qc-medium';">
														<p class="text-white text-sm opacity-8 mb-0">Tanggal Bergabung</p>
														<h6 id="card-date" class="text-white mb-0">_ _/_ _/_ _ _ _<h6>
													</div>
												</div>
												<div class="ms-auto w-20 d-flex align-items-end justify-content-end">
													<img class="w-60 mt-2" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>"
														alt="logo">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 mb-4 mb-md-0 pl-0 pr-0 pr-md-2">
								<div class="row d-flex justify-content-center rowCardWraper">
									<div class="col-sm-6 h-100 pr-sm-1">
										<div class="card h-100 border-radius-md">
											<div class="card-header p-3 text-center">
												<div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
													<i class="fas fa-money-bill-wave-alt"></i>
												</div>
											</div>
											<div class="card-body pt-0 pt-4 text-center" style="font-family: 'qc-medium';">
												<h6 class="text-center mb-0">Tunai</h6>
												<hr class="horizontal dark my-3">
												<h5 class="mb-0">Rp <span id="saldo-uang">0</span></h5>
											</div>
										</div>
									</div>
									<div class="col-sm-6 h-100 pl-sm-1 mt-sm-0 mt-4">
										<div class="card h-100 border-radius-md">
											<div class="card-header p-3 text-center">
												<div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
													<i class="fas fa-coins"></i>
												</div>
											</div>
											<div class="card-body pt-0 pt-4 text-center" style="font-family: 'qc-medium';">
												<h6 class="text-center mb-0">UBS</h6>
												<hr class="horizontal dark my-3">
												<h5 class="mb-0"><span id="saldo-ubs">0</span> g</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 mb-4 mb-md-0 pl-0 pr-0 pr-md-2">
								<div class="row d-flex justify-content-center rowCardWraper">
									<div class="col-sm-6 pr-sm-1 h-100">
										<div class="card h-100 border-radius-md">
											<div class="card-header p-3 text-center">
												<div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
													<i class="fas fa-coins"></i>
												</div>
											</div>
											<div class="card-body pt-0 pt-4 text-center" style="font-family: 'qc-medium';">
												<h6 class="text-center mb-0">Antam</h6>
												<hr class="horizontal dark my-3">
												<h5 class="mb-0"><span id="saldo-antam">0</span> g</h5>
											</div>
										</div>
									</div>
									<div class="col-sm-6 pl-sm-1 h-100 mt-sm-0 mt-4">
										<div class="card h-100 border-radius-md">
											<div class="card-header p-3 text-center">
												<div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
													<i class="fas fa-coins"></i>
												</div>
											</div>
											<div class="card-body pt-0 pt-4 text-center" style="font-family: 'qc-medium';">
												<h6 class="text-center mb-0">Gallery 24</h6>
												<hr class="horizontal dark my-3">
												<h5 class="mb-0"><span id="saldo-galery24">0</span> g</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Personal info -->
				<div id='personal-info' class="row mt-4">
					<div class="col-12">
						<div class="card h-100">
							<div class="card-header pb-0 p-3">
								<div class="row">
									<div class="opacity-8 col-md-8 d-flex align-items-center">
										<h4 style="font-family: 'qc-medium';">Personoal information</h4 >
									</div>
								</div>
							</div>
							<div class="card-body mt-4 p-3">
								<table style="font-family: 'qc-medium';">
									<tr>
										<td class="py-2" style="font-family: 'qc-semibold';">
											<strong>email</strong>
											&nbsp;&nbsp;&nbsp;
										</td>
										<td>: 
											&nbsp;&nbsp;&nbsp;
											<span id="email">_ _ _ _ _</span>
										</td>
									</tr>
									<tr>
										<td class="py-2" style="font-family: 'qc-semibold';">
											<strong>Nama lengkap</strong>
											&nbsp;&nbsp;&nbsp;
										</td>
										<td>: 
											&nbsp;&nbsp;&nbsp;
											<span id="nama-lengkap" class="text-capitalize">_ _ _ _ _</span>
										</td>
									</tr>
									<tr>
										<td class="py-2" style="font-family: 'qc-semibold';">
											<strong>Tanggal lahir</strong>
											&nbsp;&nbsp;&nbsp;
										</td>
										<td>: 
											&nbsp;&nbsp;&nbsp;
											<span id="tgl-lahir">_ _ _ _ _</span>
										</td>
									</tr>
									<tr>
										<td class="py-2" style="font-family: 'qc-semibold';">
											<strong>Jenis kelamin</strong>
											&nbsp;&nbsp;&nbsp;
										</td>
										<td>: 
											&nbsp;&nbsp;&nbsp;
											<span id="kelamin">_ _ _ _ _</span>
										</td>
									</tr>
									<tr>
										<td class="py-2" style="font-family: 'qc-semibold';">
											<strong>Alamat</strong>
											&nbsp;&nbsp;&nbsp;
										</td>
										<td>: 
											&nbsp;&nbsp;&nbsp;
											<span id="alamat">_ _ _ _ _</span>
										</td>
									</tr>
									<tr>
										<td class="py-2" style="font-family: 'qc-semibold';">
											<strong>No.telepon</strong>
											&nbsp;&nbsp;&nbsp;
										</td>
										<td>: 
											&nbsp;&nbsp;&nbsp;
											<span id="notelp">_ _ _ _ _</span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- Footer -->
				<footer class="footer mt-5">
					<div class="container-fluid p-0">
						<div class="mb-2">
							<div class="copyright text-center text-sm text-muted text-lg-start">
								© <script>
									document.write(new Date().getFullYear())
								</script>,
								Bank Sampah Budi Luhur
							</div>
						</div>
					</div>
				</footer>
			</div>
	</main>

</body>

<!-- **** Modal print transaksi **** -->
<div class="modal fade noprint" id="modalPrintTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Cetak bukti transaksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="modalPrintTransaksiTarget" class="modal-body w-100 position-relative" style="overflow: hidden;">
				<!-- spinner -->
				<div id="detil-transaksi-spinner" class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
					<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 60px;" />
				</div>
				<!-- header -->
				<div class="detil-transaksi-logo d-flex align-items-center justify-content-between py-2 px-4">
					<img src="<?= base_url('assets/images/banksampah-logo.png');?>" />
					<h4>bukti transaksi</h4>
				</div>
				<hr class="horizontal dark mt-2">
				<div class="px-4 detil-transaksi-header">
					<table>
						<tr>
							<td>TANGGAL&nbsp;&nbsp;&nbsp;</td>
							<td>: <span id="detil-transaksi-date"></span></td>
						</tr>
						<tr>
							<td>NAMA&nbsp;&nbsp;&nbsp;</td>
							<td>: <span id="detil-transaksi-nama" class="text-uppercase"></span></td>
						</tr>
						<tr>
							<td>ID.NASABAH&nbsp;&nbsp;&nbsp;</td>
							<td>: <span id="detil-transaksi-idnasabah"></span></td>
						</tr>
						<tr>
							<td>ID.TRANSAKSI&nbsp;&nbsp;&nbsp;</td>
							<td>: <span id="detil-transaksi-idtransaksi"></span></td>
						</tr>
					</table>
				</div>
				<hr class="horizontal dark mt-2">
				<h6 id="detil-transaksi-type" class="font-italic px-4"></h6>
				<div id="detil-transaksi-body" class="px-4 mt-2 table-responsive">
					
				</div>
			</div>
			<div class="modal-footer">
				<a id="btn-cetak-transaksi" href="" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;">
					<span id="text">Cetak</span>
					<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 20px;">
				</a>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>