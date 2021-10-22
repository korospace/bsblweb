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
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<body class="g-sidenav-show  bg-gray-100">
	<aside class="noprint sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
		id="sidenav-main">
		<div class="sidenav-header">
			<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
				aria-hidden="true" id="iconSidenav"></i>
			<a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.php"
				target="_blank">
				<img src="<?= base_url('assets/images/banksampah-logo.webp');?>" class="navbar-brand-img h-100" alt="main_logo">
				<span class="ms-1 font-weight-bold">Laporan BSBL</span>
			</a>
		</div>
		<hr class="horizontal dark mt-0">
		<div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="<?= base_url('admin/');?>">
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
					<a class="nav-link" href="<?= base_url('admin/profile');?>">
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
				<hr class="horizontal dark mt-2 mb-0">
				<li class="nav-item">
					<a class="nav-link" id="btn-logout" href="">
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
			<div class="row">
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Kertas</p>
										<h5 class="font-weight-bolder mb-0">
											10 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Logam</p>
										<h5 class="font-weight-bolder mb-0">
											15 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Plastik</p>
										<h5 class="font-weight-bolder mb-0">
											15 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Lain-Lain</p>
										<h5 class="font-weight-bolder mb-0">
											5 Kg
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row 2 -->
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-3">
					<div class="card">
						<a class="nav-link" href="<?= base_url('tables');?>">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-capitalize font-weight-bold">Nasabah</p>
											<h5 class="font-weight-bolder mb-0">
												100
											</h5>
										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
											<i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-3">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Admin</p>
										<h5 class="font-weight-bolder mb-0">
											2
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-3">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Relawan</p>
										<h5 class="font-weight-bolder mb-0">
											20
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mt-3">
					<div class="card">
						<div class="card-body p-3">
							<div class="row">
								<div class="col-8">
									<div class="numbers">
										<p class="text-sm mb-0 text-capitalize font-weight-bold">Pegawai</p>
										<h5 class="font-weight-bolder mb-0">
											8
										</h5>
									</div>
								</div>
								<div class="col-4 text-end">
									<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
										<i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
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