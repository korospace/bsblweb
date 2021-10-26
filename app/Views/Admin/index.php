<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-icons.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-svg.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/soft-ui-dashboard.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
  	<script src="<?= base_url('assets/js/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/chartjs.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/soft-ui-dashboard.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.dashboard.js'); ?>"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<body class="g-sidenav-show  bg-gray-100">
	<!-- **** Sidebar **** -->
	<?= $this->include('Components/adminSidebar'); ?>
	
	<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
			navbar-scroll="true">
			<div class="container-fluid py-1 px-3">
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
			<div class="row" style="font-family: 'qc-semibold';">
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

			<div class="row my-4">
				<div class="col-lg-8 col-md-6 mb-md-0 mb-4">
					<div class="card">
						<div class="card-header pb-0">
							<div class="row">
								<div class="col-lg-6 col-7">
									<h6>Table Transaksi Terbaru</h6>
								</div>
							</div>
						</div>
						<div class="card-body px-0 pb-2">
							<div class="table-responsive">
								<table class="table align-items-center mb-0">
									<thead>
										<tr>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Nasabah</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
											</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rupiah
											</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Transaksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
										<tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Rp50.000 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Detil </span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="card-header pb-0">
							<h6>Orders overview</h6>
							<p class="text-sm">
								<i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
								<span class="font-weight-bold">24%</span> this month
							</p>
						</div>
						<div class="card-body p-3">
							<div class="timeline timeline-one-side">
								<div class="timeline-block mb-3">
									<span class="timeline-step">
										<i class="ni ni-bell-55 text-success text-gradient"></i>
									</span>
									<div class="timeline-content">
										<h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
										<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
									</div>
								</div>
								<div class="timeline-block mb-3">
									<span class="timeline-step">
										<i class="ni ni-html5 text-danger text-gradient"></i>
									</span>
									<div class="timeline-content">
										<h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
										<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
									</div>
								</div>
								<div class="timeline-block mb-3">
									<span class="timeline-step">
										<i class="ni ni-cart text-info text-gradient"></i>
									</span>
									<div class="timeline-content">
										<h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
										<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
									</div>
								</div>
								<div class="timeline-block mb-3">
									<span class="timeline-step">
										<i class="ni ni-credit-card text-warning text-gradient"></i>
									</span>
									<div class="timeline-content">
										<h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
										<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
									</div>
								</div>
								<div class="timeline-block mb-3">
									<span class="timeline-step">
										<i class="ni ni-key-25 text-primary text-gradient"></i>
									</span>
									<div class="timeline-content">
										<h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
										<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
									</div>
								</div>
								<div class="timeline-block">
									<span class="timeline-step">
										<i class="ni ni-money-coins text-dark text-gradient"></i>
									</span>
									<div class="timeline-content">
										<h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
										<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card mb-4" style="overflow: hidden;font-family: 'qc-semibold';">
						<!-- search input -->
						<div class="card-header form-row pb-0 d-flex justify-content-between" style="font-family: 'qc-semibold';">
							<input id="search-sampah" type="text" class="form-control h-100 col-12 col-sm-6" placeholder="kategori/jenis sampah" style="">
							<button class="btn btn-success mt-4 mt-sm-0 text-xxs" data-toggle="modal" data-target="#modalAddEditSampah" onclick="openModalAddEditSmp('addsampah')">tambah</button>
						</div>
						<!-- container table -->
						<div class="card-body px-0 pb-2">
							<div class="table-responsive p-0 position-relative" style="min-height: 380px;max-height: 380px;overflow: auto;font-family: 'qc-semibold';">
								<!-- spinner -->
								<div id="list-sampah-spinner" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
									<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
								</div>
								<!-- message not found -->
								<div id="list-sampah-notfound" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
									<h6 id="text-notfound" class='opacity-6'></h6>
								</div>
								<!-- table -->
								<table id="table-jenis-sampah" class="table table-striped text-center mb-0">
									<thead class="position-sticky bg-white" style="top: 0;">
										<tr>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												#
											</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Kategori
											</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Jenis
											</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Harga
											</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Jumlah(Kg)
											</th>
											<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Action
											</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
									<?php for ($i=0; $i < 0; $i++) { ?>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

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