<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
<!-- <link rel="stylesheet" href="assets/css/index.css"> -->
<link rel="stylesheet" href="assets/css/Login.css">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script>
<script src="assets/js/custom.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container register">
	<div class="row">
		<div class="col-md-3 register-left">
			<img src="assets/images/banksampah-logo.png" alt="" />
			<h3>Selamat Datang Kembali</h3>
			<p>Silahkan Login Untuk Ketampilan Dashboard</p>
			<p>Belum Memiliki Akun? <a class="text-link" href="signup">Daftar</a></p>
			<!-- <a>Belum Memiliki Akun? Silahkan Buat akun di bawah ini</a>
			<input type="submit" name="" value="Register" /> -->
		</div>
		<div class="col-md-9 register-right">
			<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
						aria-selected="true">Nasabah</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
						aria-selected="false">Admin</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<h3 class="register-heading">Masuk Sebagai Nasabah</h3>
					<div class="row register-form">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Masukan Email Anda" value="" />
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Masukan Password Anda" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btnRegister" value="Login">Login</button>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<h3 class="register-heading">Masuk Sebagai Admin</h3>
					<div class="row register-form">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Masukan Username Anda" value="" />
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Masukan Password Anda" value="" />
							</div>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btnRegister" value="Login">Login</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>