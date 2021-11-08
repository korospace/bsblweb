<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
		#btn-toggle{
			left: 0;
			transition: all 0.3s;
			transform: translateX(0px);
		}

		#btn-toggle.active{
			/* left: auto !important;
			right: 0 !important; */
			transform: translateX(25px);
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
		const PASSADMIN = '<?= $password; ?>';
	</script>
	<script src="<?= base_url('assets/js/core/jquery-2.1.0.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/core/soft-ui-dashboard.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.listnasabah.js'); ?>"></script>
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
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">List nasabah</li>
						</ol>
						<h6 class="font-weight-bolder mb-0">List nasabah</h6>
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
									<input id="search-nasabah" type="text" class="form-control h-100 px-2" placeholder="nama lengkap/id nasabah" style="max-height: 39px;">
								</div>
								<div class="input-group col-12 col-sm-1 p-0" style="min-width: 90px;">
									<button class="btn btn-success mt-4 mt-sm-0 text-xxs" data-toggle="modal" data-target="#modalAddEditNasabah" onclick="openModalAddEditNsb('addnasabah')" style="width: 100%;">tambah</button>
								</div>
							</div>
							<!-- container table -->
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0 position-relative" style="min-height: 380px;max-height: 380px;overflow: auto;font-family: 'qc-semibold';">
									<!-- spinner -->
									<div id="list-nasabah-spinner" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
										<img src="<?= base_url('assets/images/spinner.svg');?>" style="width: 30px;" />
									</div>
									<!-- message not found -->
									<div id="list-nasabah-notfound" class="d-none position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
										<h6 id="text-notfound" class='opacity-6'></h6>
									</div>
									<!-- table -->
									<table id="table-nasabah" class="table table-striped text-center mb-0">
										<thead class="position-sticky bg-white" style="top: 0;">
											<tr>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
													#
												</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
													ID Nasabah
												</th>
												<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
													Nama lengkap
												</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
													Ter-verifikasi
												</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
													Action
												</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
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

	<!-- modals Add / Edit nasabah -->
	<div class="modal fade" id="modalAddEditNasabah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<form id="formAddEditNasabah" class="modal-dialog modal-dialog-centered" role="document" onsubmit="crudNasabah(this,event);">
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
					<!-- **** nama lengkap **** -->
					<div class="input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray px-4 border-md">
									<i class="fa fa-user text-muted"></i>
								</span>
							</div>
							<input type="text" class="form-control px-2" id="nama" name="nama_lengkap" autocomplete="off" placeholder="Masukan nama lengkap">
						</div>
						<small
							id="nama-error"
							class="text-danger"></small>
					</div>
					<!-- **** username **** -->
					<div class="input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray px-4 border-md">
									<i class="fas fa-at text-muted"></i>
								</span>
							</div>
							<input type="text" class="form-control px-2" id="username" name="username" autocomplete="off" placeholder="Masukan username">
						</div>
						<small
							id="username-error"
							class="text-danger"></small>
					</div>
					<!-- **** email **** -->
					<div class="addnasabah-item input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text bg-gray px-4 border-md border-right-0">
								<i class="fa fa-envelope text-muted"></i>
							</span>
							</div>
							<input type="text" class="form-control px-2" id="email" name="email" autocomplete="off" placeholder="Masukan email">
						</div>
						<small
							id="email-error"
							class="text-danger"></small>
					</div>
					<!-- **** password **** -->
					<div class="addnasabah-item input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
									<i class="fa fa-lock text-muted"></i>
								</span>
							</div>
							<input type="password" class="form-control px-2" id="password" name="password" autocomplete="off" placeholder="masukan password">
						</div>
						<small
							id="password-error"
							class="text-danger"></small>
					</div>
					<!-- **** tgl lahir **** -->
					<div class="input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray px-4 border-md">
									<i class="fas fa-calendar-alt text-muted"></i>
								</span>
							</div>
							<input type="date" class="form-control px-2 h-100" id="tgllahir" name="tgl_lahir">
						</div>
						<small
							id="tgllahir-error"
							class="text-danger"></small>
					</div>
					<!-- kelamin -->
					<input type="hidden" name="kelamin">
					<div class="input-group col-lg-6 mb-2 form-group">
						<div class="form-check">
							<input class="form-check-input" type="radio" id="kelamin-laki-laki" value="laki-laki" />
							<label class="form-check-label" for="kelamin-laki-laki">
							Laki Laki
							</label>
						</div>
					</div>
					<div class="input-group col-lg-6 mb-4 form-group">
						<div class="form-check">
							<input class="form-check-input" type="radio" id="kelamin-perempuan" value="perempuan" />
							<label class="form-check-label" for="kelamin-perempuan">
							Perempuan
							</label>
						</div>
					</div>
					<!-- **** alamat **** -->
					<div class="input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
									<i class="fas fa-map-marker-alt text-muted"></i>
								</span>
							</div>
							<input type="text" class="form-control px-2" id="alamat" name="alamat" autocomplete="off" placeholder="Masukan alamat lengkap">
						</div>
						<small
							id="alamat-error"
							class="text-danger"></small>
					</div>
					<!-- **** RT RW KODEPOS **** -->
					<div class="addnasabah-item form-row mb-4" style="padding-right: 2px;">
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray px-4 border-md border-right-0">
										<i class="fas fa-home text-muted"></i>
									</span>
								</div>
								<input type="text" class="form-control" id="rt" name="rt" autocomplete="off" placeholder="RT">
							</div>
							<small
								id="rt-error"
								class="text-danger"></small>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray px-4 border-md border-right-0">
										<i class="fas fa-home text-muted"></i>
									</span>
								</div>
								<input type="text" class="form-control" id="rw" name="rw" autocomplete="off" placeholder="RW">
							</div>
							<small
								id="rw-error"
								class="text-danger"></small>
						</div>
						<div class="col-12 mt-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray px-4 border-md border-right-0">
										<i class="fas fa-mail-bulk text-muted"></i>
									</span>
								</div>
								<input type="text" class="form-control" id="kodepos" name="kodepos" autocomplete="off" placeholder="KODE POS">
							</div>
							<small
								id="kodepos-error"
								class="text-danger"></small>
						</div>
					</div>
					<!-- **** no telp **** -->
					<div class="input-group col-lg-12 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
									<i class="fa fa-phone-square text-muted"></i>
								</span>
							</div>
							<input type="text" class="form-control px-2" id="notelp" name="notelp" autocomplete="off" placeholder="Masukan no.telp">
						</div>
						<small
							id="notelp-error"
							class="text-danger"></small>
					</div>
					<!-- **** is verify **** -->
					<div class="editnasabah-item mb-3">
						<label class="form-check-label">
							verifikasi akun
						</label>
						<div class="mt-2 position-relative p-0 d-flex align-items-center" style="border-radius: 14px;width: 50px;height: 25px;box-shadow: inset 0 0 4px 0px rgba(0, 0, 0, 0.4);">
							<div id="btn-toggle" class="bg-secondary rounded-circle position-absolute" style="width: 25px;height: 25px;">
								<input type="checkbox" name="is_verify" class="cursor-pointer" style="width: 25px;height: 25px;opacity: 0;">
							</div>
						</div>
					</div>

					<!-- **** Uang, Antam, Ubs, Galery24 **** -->
					<hr class="editnasabah-item horizontal dark mt-2 mb-2">
					<h6 class="editnasabah-item font-italic opacity-8">Edit saldo</h6>
					<div class="editnasabah-item form-row mt-2 mb-4" style="padding-right: 2px;">
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md border-right-0" style="padding-left: 0.8rem;padding-right: 0.8rem;max-height: 35px;">
										<i class="fas fa-money-bill-wave-alt text-muted"></i>
									</span>
								</div>
								<input type="text" class="form-control pl-2" id="saldo_uang" name="saldo_uang" autocomplete="off">
							</div>
							<small
								id="saldo_uang-error"
								class="text-danger"></small>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md border-right-0 text-xxs" style="padding-left: 0.8rem;padding-right: 0.8rem;max-height: 35px;">
										ANT
									</span>
								</div>
								<input type="text" class="form-control pl-2" id="saldo_antam" name="saldo_antam" autocomplete="off">
							</div>
							<small
								id="saldo_antam-error"
								class="text-danger"></small>
						</div>
						<div class="col-6 mt-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md border-right-0 text-xxs" style="padding-left: 0.8rem;padding-right: 0.8rem;max-height: 35px;">
										UBS
									</span>
								</div>
								<input type="text" class="form-control pl-2" id="saldo_ubs" name="saldo_ubs" autocomplete="off">
							</div>
							<small
								id="saldo_ubs-error"
								class="text-danger"></small>
						</div>
						<div class="col-6 mt-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md border-right-0 text-xxs" style="padding-left: 0.8rem;padding-right: 0.8rem;max-height: 35px;">
										G24
									</span>
								</div>
								<input type="text" class="form-control pl-2" id="saldo_galery24" name="saldo_galery24" autocomplete="off">
							</div>
							<small
								id="saldo_galery24-error"
								class="text-danger"></small>
						</div>
					</div>
					<!-- **** change password **** -->
					<hr class="editnasabah-item horizontal dark mt-2 mb-2">
					<h6 class="editnasabah-item font-italic opacity-8">Ubah password (opsionial)</h6>
					<div class="editnasabah-item input-group col-lg-12 mt-2 mb-4 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
									<i class="fa fa-lock text-muted"></i>
								</span>
							</div>
							<input type="password" class="form-control px-2" id="newpass" name="new_password" autocomplete="off" placeholder="password baru">
						</div>
						<small
							id="newpass-error"
							class="text-danger"></small>
					</div>
				</div>

				<!-- modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
					<button id="submit" type="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;">
						<span id="text">Simpan</span>
						<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 20px;">
					</button>
				</div>
			</div>
		</form>
	</div>
<?= $this->endSection(); ?>