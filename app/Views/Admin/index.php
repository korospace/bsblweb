<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
		.kategori-list:hover{
			background-color: #E9ECEF !important;
		}

		.kategori-list .checklist{
			display: none !important;
		}

		.kategori-list.active .checklist{
			display: inherit !important;
		}
	</style>
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
							<div class="input-group col-12 col-sm-6">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray px-4 border-md border-right-0" style="max-height: 39px;">
										<i class="fas fa-search text-muted"></i>
									</span>
								</div>
								<input id="search-sampah" type="text" class="form-control h-100 px-2" placeholder="kategori/jenis sampah" style="max-height: 39px;">
							</div>
							<div class="input-group col-12 col-sm-1 p-0" style="min-width: 90px;">
								<button class="btn btn-success mt-4 mt-sm-0 text-xxs" data-toggle="modal" data-target="#modalAddEditSampah" onclick="openModalAddEditSmp('addsampah')" style="width: 100%;">tambah</button>
							</div>
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

<!-- modals Add / Edit sampah -->
<div class="modal fade show" id="modalAddEditSampah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<form id="formAddEditSampah" class="modal-dialog modal-dialog-centered" role="document">
	<input type="hidden" name="id">
	<div class="modal-content" style="overflow: hidden;">

		<!-- modal header -->
		<div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<!-- modal body -->
		<div class="modal-body row position-relative">

			<!-- spinner -->
			<div id="list-nasabah-spinner" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
				<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
			</div>

			<input type="hidden" name="id">
			<!-- **** JENIS,HARGA **** -->
			<div class="addnasabah-item form-row align-items-center mb-4" style="padding-right: 2px;">
				<div class="col-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text bg-gray px-4 border-md border-right-0">
								<i class="fas fa-recycle text-muted"></i>
							</span>
						</div>
						<input type="text" class="form-control px-2" id="jenis" name="jenis" autocomplete="off" placeholder="Jenis sampah">
					</div>
					<small
						id="jenis-error"
						class="text-danger"></small>
				</div>
				<div class="col-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text bg-gray px-4 border-md border-right-0">
								<i class="fas fa-money-bill-wave-alt text-muted"></i>
							</span>
						</div>
						<input type="number" class="form-control px-2" id="harga" name="harga" autocomplete="off" placeholder="Harga">
					</div>
					<small
						id="harga-error"
						class="text-danger"></small>
				</div>
			</div>
			<!-- **** KATEGORI **** -->
			<div class="input-group col-lg-12 mb-4 form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text bg-gray px-4 border-md">
							<i class="fas fa-clipboard-list text-muted"></i>
						</span>
					</div>
					<input type="text" class="form-control px-2" id="kategori" name="kategori" autocomplete="off" placeholder="Pilihi kategori dibawah">
				</div>
				<small
					id="kategori-error"
					class="text-danger"></small>
			</div>

			<!-- LIST KATEGORI -->
			<div class="input-group col-lg-12 mb-4 form-group">
				<div class="container-fluid border-radius-sm p-2" style="border: 0.5px solid #D2D6DA;">
					<!-- header -->
					<div class="container-fluid d-flex p-0">
						<input id="NewkategoriSampah" type="text" class="form-control px-2 text-xxs border-radius-sm" placeholder="ketik kategori baru" style="max-width: 150px;max-height: 30px;border: 0.5px solid #D2D6DA;" autocomplete="off">
						<button id="btnAddKategoriSampah" class="badge badge-success border-0 border-radius-sm text-xxs text-lowercase ml-2">
							<span id="text">Simpan</span>
							<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 14px;">
						</button>
					</div>
					<!-- body -->
					<div id="kategori-sampah-wraper" class="container-fluid border-radius-sm p-0 mt-2 position-relative" style="min-height: 150px;max-height: 150px;overflow: auto;border: 0.5px solid #D2D6DA;">
						
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
			<button id="btn-add-edit-sampah" type="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;">
				<span id="text">Simpan</span>
				<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 20px;">
			</button>
		</div>
	</div>
	</form>
</div>
<?= $this->endSection(); ?>