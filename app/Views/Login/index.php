<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
  	<!-- ** develoment ** -->
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"> -->
	<!-- ** production ** -->
	<link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/login.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script>
		const LASTURL = '<?= $lasturl; ?>';
	</script>
	<script src="<?= base_url('assets/js/login.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('content'); ?>

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<div class="container-fluid register-wraper d-flex justify-content-center align-items-center p-0 p-md-5">
		<div class="w-100 h-100 register py-4 px-4">
			<div class="row h-100">
				<!-- side left -->
				<div class="col-md-4 register-left d-flex flex-column justify-content-center align-items-center">
					<img class="mt-0" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt="" />
					<div class="mt-3">
						<h3>Selamat Datang Kembali</h3>
						<p>Silahkan Login Untuk Ketampilan Dashboard</p>
					</div>
					<p class=" mt-2 mt-md-4">Belum Memiliki Akun? <br> <a class="text-link" href="<?= base_url('signup');?>">Daftar</a> | <a class="text-link" href="<?= base_url('/');?>">Home</a></p>
				</div>

				<!-- side right -->
				<div class="col-md-8 register-right mt-md-0">

					<!-- form wraper -->
					<div class="tab-content d-flex flex-column align-items-end pb-4" id="myTabContent">
						
						<!-- toggle switch -->
						<ul class="nav nav-tabs nav-justified mt-3" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nasabah</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Admin</a>
							</li>
						</ul>

						<!-- Login nasabah -->
						<div class="tab-pane fade show active pt-4 w-100" id="home" role="tabpanel" aria-labelledby="home-tab">
							<h3 class="register-heading text-center" style="color: #495057;">
								Masuk Sebagai Nasabah
							</h3>
							<form id="formLoginNasabah" class="row register-form pt-3 px-5">
								<div class="col-md-12">
									<div class="form-group position-relative px-0 px-md-5">
										<input type="text" name="email" id="nasabah-email" class="form-control" placeholder="Email" autocomplete="off" />
										<small id="nasabah-email-error" class="position-absolute text-danger"></small>
									</div>
									<div class="form-group position-relative px-0 px-md-5" style="margin-top: 30px;">
										<input type="password" name="password" id="nasabah-password" class="form-control" placeholder="Password" autocomplete="off" />
										<small id="nasabah-password-error" class="position-absolute text-danger"></small>
									</div>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<button type="submit" class="btnRegister mt-4" value="Login" style="max-width: 374px;max-height: 54px;">Login</button>
									<a id="btn-forgotpass" class="mt-3 text-secondary" href="">lupa password?</a>
								</div>
							</form>
						</div>

						<!-- Admin login -->
						<div class="tab-pane fade show pt-4 w-100" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<h3 class="register-heading text-center" style="color: #495057;">
								Masuk Sebagai Admin
							</h3>
							<form id="formLoginAdmin" class="row register-form pt-3 px-5">
								<div class="col-md-12">
									<div class="form-group position-relative px-0 px-md-5">
										<input type="text" id="admin-username" class="form-control" name="username" placeholder="Username" value="" 
										autocomplete="off" />
										<small id="admin-username-error" class="position-absolute text-danger"></small>
									</div>
									<div class="form-group position-relative px-0 px-md-5" style="margin-top: 30px;">
										<input type="password" id="admin-password" class="form-control" name="password" placeholder="Password" value="" 
										autocomplete="off" />
										<small id="admin-password-error" class="position-absolute text-danger"></small>
									</div>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<button type="submit" class="btnRegister mt-4" value="Login" style="max-width: 374px;max-height: 54px;">Login</button>
									<span class="mt-3 text-secondary" style="opacity: 0;cursor: context-menu;" href="">lupa password?</span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?= $this->endSection(); ?>