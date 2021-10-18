<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
	@font-face {
		font-family: 'qc-medium';
		src: url(<?= base_url('assets/fonts/Quicksand-Medium.ttf');
		?>);
	}

	@font-face {
		font-family: 'qc-semibold';
		src: url(<?= base_url('assets/fonts/Quicksand-SemiBold.ttf');
		?>);
	}

	section {
		font-family: 'qc-medium';
	}
</style>
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-icons.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-svg.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/soft-ui-dashboard.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/chartjs.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/soft-ui-dashboard.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/nasabah.js'); ?>"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<section id="container" class="d-none">
		<body class="g-sidenav-show bg-gray-100">
			<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
				id="sidenav-main">
				<div class="sidenav-header" style="font-family: 'qc-medium';">
					<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
						aria-hidden="true" id="iconSidenav"></i>
					<a class="navbar-brand m-0" href=""
						target="_blank">
						<img src="<?= base_url('assets/images/banksampah-logo.png');?>" class="navbar-brand-img h-100" alt="main_logo">
						<span class="ms-1 font-weight-bold">Profile Anda</span>
					</a>
				</div>
				<hr class="horizontal dark mt-0">
				<div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main" style="font-family: 'qc-medium';">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url('nasabah');?>">
								<div
									class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
									<svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink">
										<title>shop </title>
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
												<g transform="translate(1716.000000, 291.000000)">
													<g transform="translate(0.000000, 148.000000)">
														<path class="color-background opacity-6"
															d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
														</path>
														<path class="color-background"
															d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
														</path>
													</g>
												</g>
											</g>
										</g>
									</svg>
								</div>
								<span class="nav-link-text ms-1">Dashboard</span>
							</a>
						</li>
						<li class="nav-item mt-2">
							<a class="nav-link active" href="<?= base_url('profilenasabah');?>">
								<div
									class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
									<svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink">
										<title>customer-support</title>
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
												<g transform="translate(1716.000000, 291.000000)">
													<g transform="translate(1.000000, 0.000000)">
														<path class="color-background opacity-6"
															d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
														</path>
														<path class="color-background"
															d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
														</path>
														<path class="color-background"
															d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
														</path>
													</g>
												</g>
											</g>
										</g>
									</svg>
								</div>
								<span class="nav-link-text ms-1">Profile</span>
							</a>
						</li>
						<hr class="horizontal dark mt-4 mb-0">
						<li class="nav-item">
							<a id="btn-logout" class="nav-link" href="">
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
								<span class="nav-link-text ms-1">Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</aside>
			<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
				<!-- Navbar -->
				<nav class="navbar navbar-main bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
					<div class="container-fluid py-1">
						<nav aria-label="breadcrumb" style="font-family: 'qc-medium';">
							<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-5">
								<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
								<li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
							</ol>
							<h6 class="font-weight-bolder mb-0 text-white">Profile Nasabah</h6>
						</nav>
						<div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
							<div class="ms-md-auto pe-md-3 d-flex align-items-center">

							</div>
						</div>
					</div>
				</nav>
				<!-- End Navbar -->
				<div class="container-fluid">
					<div class="page-header min-height-300 border-radius-xl mt-4"
						style="background-image: url(<?= base_url('assets/images/curved-images/curved14.jpg');?>); background-position-y: 50%;">
						<span class="mask bg-gradient-primary opacity-6"></span>
					</div>
					<div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
						<div class="row gx-4">
							<div class="col-auto">
								<div class="avatar avatar-xl position-relative">
									<img src="<?= base_url('assets/images/bruce-mars.jpg');?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
								</div>
							</div>
							<div class="col-auto my-auto">
								<div class="h-100">
									<h5 id="email" class="mb-1" style="font-family: 'qc-semibold';">
										_ _ _ _ _
									</h5>
									<p class="mb-0 font-weight-bold text-sm" style="font-family: 'qc-medium';">
										id: <span id="idnasabah">_ _ _ _ _</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container-fluid py-4">
					<div class="row">
						<div class="col-12">
							<div class="card h-100">
								<div class="card-header pb-0 p-3">
									<div class="row">
										<div class="opacity-8 col-md-8 d-flex align-items-center">
											<h4 style="font-family: 'qc-medium';">Personoal information</h4 >
										</div>
										<div class="col-md-4 text-end">
											<a id="btn-edit-profile" class="shadow p-2  border-radius-sm" href="" data-toggle="modal" data-target="#modalEditProfile">
												<i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top"
													title="Edit Profile"></i>
											</a>
										</div>
									</div>
								</div>
								<div class="card-body mt-4 p-3">
									<table style="font-family: 'qc-medium';">
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
												<strong>Username</strong>
												&nbsp;&nbsp;&nbsp;
											</td>
											<td>: 
												&nbsp;&nbsp;&nbsp;
												<span id="username">_ _ _ _ _</span>
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
			</div>

			<!-- Edit profile -->
			<div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <form id="formEditProfile" class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit profile</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">
						<!-- **** nama lengkap **** -->
						<div class="input-group col-lg-12 mb-4 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray px-4 border-md">
										<i class="fa fa-user text-muted"></i>
									</span>
								</div>
								<input type="text" class="form-control" id="nama-edit" name="nama_lengkap" autocomplete="off" placeholder="Masukan nama lengkap anda">
							</div>
							<small
								id="nama-edit-error"
								class="text-danger"></small>
						</div>
						<!-- **** username **** -->
						<div class="input-group col-lg-12 mb-4 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray px-4 border-md">
										<i class="fa fa-user text-muted"></i>
									</span>
								</div>
								<input type="text" class="form-control" id="username-edit" name="username" autocomplete="off" placeholder="Masukan username anda">
							</div>
							<small
								id="username-edit-error"
								class="text-danger"></small>
						</div>
						<!-- **** tgl lahir **** -->
						<div class="input-group col-lg-12 mb-4 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md" style="padding: 1rem 1.55rem;">
										<i class="fas fa-calendar-alt"></i>
									</span>
								</div>
								<input type="date" class="form-control h-100" id="tgllahir-edit" name="tgl_lahir">
							</div>
							<small
								id="tgllahir-edit-error"
								class="text-danger"></small>
						</div>
						<!-- kelamin -->
						<input type="hidden" name="kelamin">
						<div class="input-group col-lg-6 mb-2 form-group">
							<div class="form-check">
								<input class="form-check-input" type="radio" id="kelamin-laki-laki" value="laki-laki" />
								<label class="form-check-label" for="kelamin-laki">
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
										<i class="fas fa-map-marker-alt"></i>
									</span>
								</div>
								<input type="text" class="form-control" id="alamat-edit" name="alamat" autocomplete="off" placeholder="Masukan alamat lengkap anda">
							</div>
							<small
								id="alamat-edit-error"
								class="text-danger"></small>
						</div>
						<!-- **** no telp **** -->
						<div class="input-group col-lg-12 mb-4 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
									<i class="fa fa-phone-square"></i>
								</span>
								</div>
								<input type="text" class="form-control" id="notelp-edit" name="notelp" autocomplete="off" placeholder="Masukan no.telp anda">
							</div>
							<small
								id="notelp-edit-error"
							class="text-danger"></small>
						</div>
						<hr class="horizontal dark mt-2 mb-2">
						<h6 class="font-italic opacity-8">Ubah password (opsionial)</h6>
						<!-- **** change password **** -->
						<div class="input-group col-lg-12 mt-2 mb-4 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
										<i class="fa fa-lock text-muted"></i>
									</span>
								</div>
								<input type="password" class="form-control" id="newpass-edit" name="new_password" autocomplete="off" placeholder="password baru">
							</div>
							<small
								id="newpass-edit-error"
								class="text-danger"></small>
						</div>
						<div class="input-group col-lg-12 mb-4 form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-gray border-md" style="padding-left: 1.66rem;padding-right: 1.66rem;">
										<i class="fa fa-lock text-muted"></i>
									</span>
								</div>
								<input type="password" class="form-control" id="oldpass-edit" name="old_password" autocomplete="off" placeholder="password lama">
							</div>
							<small
								id="oldpass-edit-error"
								class="text-danger"></small>
						</div>
					</div>
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
		</body>
	</section>
<?= $this->endSection(); ?>