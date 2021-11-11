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
  	<!-- ** develoment ** -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"> -->
	<!-- ** production ** -->
	<link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/admin.dashboard.css'); ?>">
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
	<script src="<?= base_url('assets/js/plugins/chartjs.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	<!-- <script src="<?= base_url('assets/js/admin.dashboard.js'); ?>"></script> -->
	<script src="<?= base_url('assets/js/admin.dashboard.min.js'); ?>"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<body class="g-sidenav-show  bg-gray-100">
	<!-- **** Sidebar **** -->
	<?= $this->include('Components/adminSidebar'); ?>
	
	<main class="main-content position-relative mt-1 border-radius-lg ">
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
				<div class="col-12 mb-md-0 mb-4">
					<div class="card">
						<div class="card-header pb-0">
							<div class="row">
								<div class="col-lg-6 col-7">
									<h6>Transaksi Terbaru</h6>
								</div>
							</div>
						</div>
						<div class="card-body px-0 pb-2">
							<div class="table-responsive position-relative" style="min-height: 380px;max-height: 380px;overflow: auto;font-family: 'qc-semibold';">
								<!-- spinner -->
								<div id="transaksi-terbaru-spinner" class="position-absolute bg-white d-flex align-items-center justify-content-center pt-4" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
									<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
								</div>
								<!-- message not found -->
								<div id="transaksi-terbaru-notfound" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center pt-5" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
									<h6 id="text-notfound" class='opacity-6'></h6>
								</div>
								<!-- table -->
								<table id="table-transaksi-terbaru" class="table table-striped text-left mb-0">
									<thead class="position-sticky bg-white" style="z-index: 11;top: 0;">
										<tr>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												ID Transaksi
											</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Nama Nasabah
											</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Jenis transaksi
											</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Jumlah
											</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
												Tgl
											</th>
										</tr>
									</thead>
									<tbody>
										<?php for ($i=0; $i < 20 ; $i++) { ?>
										
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row my-4">
				<!-- grafik -->
				<div class="col-lg-8">
					<div class="card z-index-2 position-relative" style="min-height: 430px;max-height: 430px;overflow: hidden;font-family: 'qc-semibold';">
						<!-- header -->
						<div class="card-header pb-0" style="z-index: 11;">
							<h6>Grafik Penyetoran</h6>
						</div>
						<!-- spinner -->
						<div id="" class="spinner-wraper position-absolute bg-white d-flex align-items-center justify-content-center pt-5" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
							<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
						</div>
						<div class="card-body p-3 mt-2">
							<div class="chart">
								<canvas id="chart-line" class="chart-canvas"></canvas>
							</div>
						</div>
					</div>
				</div>
				<!-- Transaksi -->
				<div class="col-lg-4 mt-4 mt-lg-0">
					<div class="card h-100" style="min-height: 430px;max-height: 430px;overflow: auto;">
						<!-- header -->
						<div class="card-header bg-white position-sticky p-3" style="z-index: 11;top: 0;">
							<div class="row" style="font-family: 'qc-semibold';">
								<div class="col-12">
									<h6 class="mb-0">Rekap Transaksi</h6>
									<select id="filter-year" class="filter-transaksi custom-select custom-select-sm w-100 mt-3" style="max-height: 31px;">
										<?php $curYear = (int)date("Y"); ?>
										<?php for ($i=$curYear; $i >= 2017 ; $i--) { ?>
											<option value="<?= $i; ?>"><?= $i; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<!-- spinner -->
						<div id="" class="spinner-wraper position-absolute bg-white d-flex align-items-center justify-content-center pt-5" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
							<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
						</div>
						<div id="transaksi-wraper" class="card-body mt-2 pl-3 pr-3 pt-0 pb-0 d-flex justify-content-center align-items-center" style="font-family: 'qc-semibold';">

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
							<div class="input-group col-12 col-sm-5 col-md-4 col-lg-3 p-0 d-flex" style="">
								<button class="btn btn-success mt-4 mt-sm-0 text-xxs" data-toggle="modal" data-target="#modalAddEditSampah" onclick="openModalAddEditSmp('addsampah')" style="width: 50%;">tambah</button>
								<button class="btn btn-info mt-4 mt-sm-0 text-xxs" data-toggle="modal" data-target="#modalJualSampah" onclick="openModalJualSampah()" style="width: 50%;">jual</button>
							</div>
						</div>
						<!-- container table -->
						<div class="card-body px-0 pb-2">
							<div class="table-responsive p-0 position-relative" style="min-height: 380px;max-height: 380px;overflow: auto;font-family: 'qc-semibold';">
								<!-- spinner -->
								<div id="list-sampah-spinner" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center pt-4" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
									<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
								</div>
								<!-- message not found -->
								<div id="list-sampah-notfound" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center pt-5" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
									<h6 id="text-notfound" class='opacity-6'></h6>
								</div>
								<!-- table -->
								<table id="table-jenis-sampah" class="table table-striped text-center mb-0">
									<thead class="position-sticky bg-white" style="z-index: 11;top: 0;">
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

			<footer class="footer pt-3">
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
			<input type="hidden" name="id" id="id">
			<!-- **** JENIS **** -->
			<div class="input-group col-lg-12 mb-4 form-group">
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
			<!-- **** Harga,Jumlah **** -->
			<div class="addnasabah-item form-row mb-4" style="padding-right: 2px;">
				<div class="col">
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
				<div class="edit-item col-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text bg-gray px-4 border-md border-right-0">
								<i class="fas fa-balance-scale text-muted"></i>
							</span>
						</div>
						<input type="text" class="form-control px-2" id="jumlah" name="jumlah" autocomplete="off" placeholder="Jumlah(Kg)">
					</div>
					<small
						id="jumlah-error"
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
					<input type="text" class="form-control px-2" id="kategori" name="kategori" autocomplete="off" placeholder="Pilihi kategori dibawah" disabled>
				</div>
				<small
					id="kategori-error"
					class="text-danger"></small>
			</div>
			<!-- LIST KATEGORI -->
			<div class="input-group col-lg-12 mb-4 form-group">
				<div class="container-fluid border-radius-sm p-2" style="border: 0.5px solid #D2D6DA;">
					<!-- header -->
					<div class="add-item container-fluid mb-2 d-flex p-0">
						<input id="NewkategoriSampah" type="text" class="form-control px-2 text-xxs border-radius-sm" placeholder="ketik kategori baru" style="max-width: 150px;max-height: 30px;border: 0.5px solid #D2D6DA;" autocomplete="off">
						<a href="" id="btnAddKategoriSampah" class="badge badge-success border-0 border-radius-sm text-xxs text-lowercase ml-2 d-flex justify-conten-center align-items-center">
							<span id="text">Simpan</span>
							<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 14px;">
						</a>
					</div>
					<!-- body -->
					<div id="kategori-sampah-wraper" class="container-fluid border-radius-sm p-0 position-relative" style="min-height: 150px;max-height: 150px;overflow: auto;border: 0.5px solid #D2D6DA;">
						
					</div>
				</div>
			</div>
		</div>

		<!-- modal footer -->
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


<!-- **** Modal Jual Sampah **** -->
<div class="modal fade" id="modalJualSampah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<form id="formJualSampah" class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- modal header -->
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Jual sampah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<!-- modal body -->
			<div class="modal-body form-row">
				
				<!-- **** tgl transaksi **** -->
				<h6 class="font-italic opacity-8 col-12 text-sm">Tanggal transaksi</h6>
				<div class="input-group col-6 col-sm-4 mb-4 form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text bg-gray px-4 border-md">
								<i class="fas fa-calendar-alt text-muted"></i>
							</span>
						</div>
						<input type="date" class="form-control form-control-sm px-2 h-100" id="date" name="date">
					</div>
					<small
						id="date-error"
						class="text-danger"></small>
				</div>

				<!-- **** table **** -->
				<!-- <hr class="editnasabah-item horizontal col-12 dark mt-0 mb-4"> -->
				<div class="table-responsive col-12 mb-0" style="overflow: auto;font-family: 'qc-semibold';">
					<table id="table-jual-sampah" class="table table-sm text-center mb-0">
						<thead class="bg-white" style="border: 0.5px solid #E9ECEF;">
							<tr>
								<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border-right: 0.5px solid #E9ECEF;">
									#
								</th>
								<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border-right: 0.5px solid #E9ECEF;">
									jenis
								</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border-right: 0.5px solid #E9ECEF;">
									jumlah(kg)
								</th>
								<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
									harga
								</th>
							</tr>
						</thead>
						<tbody style="border: 0.5px solid #E9ECEF;">
							<tr id="special-tr">
								<td colspan="3" class="py-2" style="border-right: 0.5px solid #E9ECEF;">
									Total harga
								</td>
								<td colspan="4" class="p-2 text-left">
									Rp. <span id="total-harga"></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<!-- tambah baris -->
				<div class="input-group col-12 mt-2">
					<a href="" class="badge badge-info w-100 border-radius-sm" onclick="tambahBaris(event);">
						<i class="fas fa-plus text-white"></i>
					</a>
				</div>
			</div>

			<!-- modal footer -->
			<div class="modal-footer">
				<button id="submit" type="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;" onclick="doTransaksi(this,event);">
					<span id="text">Submit</span>
					<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 20px;">
				</button>
			</div>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>