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

<!-- Html -->
<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<section id="container" class="d-none">

	<body class="g-sidenav-show bg-gray-100">

		<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
			id="sidenav-main">
			<div class="sidenav-header">
				<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
					aria-hidden="true" id="iconSidenav"></i>
				<a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.php"
					target="_blank">
					<img src="<?= base_url('assets/images/banksampah-logo.png');?>" class="navbar-brand-img h-100" alt="main_logo">
					<span class="ms-1 font-weight-bold">Laporan BSBL</span>
				</a>
			</div>
			<hr class="horizontal dark mt-0">
			<div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link  active" href="<?= base_url('nasabah/');?>">
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
						<a class="nav-link" href="<?= base_url('nasabah/profile');?>">
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
					<nav aria-label="breadcrumb" style="font-family: 'qc-medium';">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
						</ol>
						<h6 class="font-weight-bolder mb-0">Dashboard</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<ul class="navbar-nav  justify-content-end">
							<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
								<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
									<div class="sidenav-toggler-inner">
										<i class="sidenav-toggler-line"></i>
										<i class="sidenav-toggler-line"></i>
										<i class="sidenav-toggler-line"></i>
									</div>
								</a>
							</li>
							<li class="nav-item dropdown pe-2 d-flex align-items-center">
								<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
									<li class="mb-2">
										<a class="dropdown-item border-radius-md" href="javascript:;">
											<div class="d-flex py-1">
												<div class="my-auto">
													<img src="<?= base_url('assets/images/team-2.jpg'); ?>" class="avatar avatar-sm  me-3 ">
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1">
														<span class="font-weight-bold">New message</span> from Laur
													</h6>
													<p class="text-xs text-secondary mb-0">
														<i class="fa fa-clock me-1"></i>
														13 minutes ago
													</p>
												</div>
											</div>
										</a>
									</li>
									<li class="mb-2">
										<a class="dropdown-item border-radius-md" href="javascript:;">
											<div class="d-flex py-1">
												<div class="my-auto">
													<img src="../assets/images/small-logos/logo-spotify.svg"
														class="avatar avatar-sm bg-gradient-dark  me-3 ">
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1">
														<span class="font-weight-bold">New album</span> by Travis Scott
													</h6>
													<p class="text-xs text-secondary mb-0">
														<i class="fa fa-clock me-1"></i>
														1 day
													</p>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a class="dropdown-item border-radius-md" href="javascript:;">
											<div class="d-flex py-1">
												<div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
													<svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
														xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
														<title>credit-card</title>
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
																<g transform="translate(1716.000000, 291.000000)">
																	<g transform="translate(453.000000, 454.000000)">
																		<path class="color-background"
																			d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
																			opacity="0.593633743"></path>
																		<path class="color-background"
																			d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
																		</path>
																	</g>
																</g>
															</g>
														</g>
													</svg>
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="text-sm font-weight-normal mb-1">
														Payment successfully completed
													</h6>
													<p class="text-xs text-secondary mb-0">
														<i class="fa fa-clock me-1"></i>
														2 days
													</p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</li>
						</ul>
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
											<h5 class="font-weight-bolder mb-0">
												5 Kg
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
											<h5 class="font-weight-bolder mb-0">
												2 Kg
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
											<h5 class="font-weight-bolder mb-0">
												3 Kg
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
											<h5 class="font-weight-bolder mb-0">
												1 Kg
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
						<div class="card z-index-2" style="font-family: 'qc-semibold';">
							<div class="card-header pb-0">
								<h6>Grafik Penyetoran</h6>
							</div>
							<div class="card-body p-3 mt-6">
								<div class="chart">
									<canvas id="chart-line" class="chart-canvas" height="300"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!-- Transaksi -->
					<div class="col-lg-4">
						<div class="card h-100">
							<div class="card-header pb-0 p-3">
								<div class="row" style="font-family: 'qc-semibold';">
									<div class="col-6 d-flex align-items-center">
										<h6 class="mb-0">History</h6>
									</div>
									<div class="col-6 text-end">
										<button class="btn btn-outline-primary btn-sm mb-0">View All</button>
									</div>
								</div>
							</div>
							<div class="card-body p-3 pb-0">
								<ul class="list-group" style="font-family: 'qc-medium';">
									<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
										<div class="d-flex flex-column">
											<h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>
											<span class="text-xs">#MS-415646</span>
										</div>
										<div class="d-flex align-items-center text-sm">
											$180
											<button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
													class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
										</div>
									</li>
									<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
										<div class="d-flex flex-column">
											<h6 class="text-dark mb-1 font-weight-bold text-sm">February, 10, 2021</h6>
											<span class="text-xs">#RV-126749</span>
										</div>
										<div class="d-flex align-items-center text-sm">
											$250
											<button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
													class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
										</div>
									</li>
									<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
										<div class="d-flex flex-column">
											<h6 class="text-dark mb-1 font-weight-bold text-sm">April, 05, 2020</h6>
											<span class="text-xs">#FB-212562</span>
										</div>
										<div class="d-flex align-items-center text-sm">
											$560
											<button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
													class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
										</div>
									</li>
									<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
										<div class="d-flex flex-column">
											<h6 class="text-dark mb-1 font-weight-bold text-sm">June, 25, 2019</h6>
											<span class="text-xs">#QW-103578</span>
										</div>
										<div class="d-flex align-items-center text-sm">
											$120
											<button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
													class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
										</div>
									</li>
									<li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
										<div class="d-flex flex-column">
											<h6 class="text-dark mb-1 font-weight-bold text-sm">March, 01, 2019</h6>
											<span class="text-xs">#AR-803481</span>
										</div>
										<div class="d-flex align-items-center text-sm">
											$300
											<button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
													class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="container-fluid mt-4 p-0">
					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-xl-4 mb-xl-0 mb-4">
									<div class="card-id bg-transparent shadow-xl">
										<div class="overflow-hidden position-relative border-radius-xl"
											style="background-image: url(<?= base_url('assets/images/curved-images/curved14.jpg'); ?>);">
											<span class="mask bg-gradient-dark"></span>
											<div class="card-body-id position-relative z-index-1 p-3">
												<i class="fas fa-wifi text-white p-2"></i>
												<h5 id="card-id" class="text-white mt-4 mb-5 pb-2">_ _ _ _ _&nbsp;&nbsp;&nbsp;_ _ _
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
														<img class="w-60 mt-2" src="<?= base_url('assets/images/logos/banksampah-logo.png'); ?>"
															alt="logo">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-4 p-2 h-100">
									<div class="row d-flex justify-content-center">
										<div class="col-md-6 h-100">
											<div class="card">
												<div class="card-header mx-4 p-3 text-center">
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
										<div class="col-md-6 mt-md-0 mt-4">
											<div class="card">
												<div class="card-header mx-4 p-3 text-center">
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
								<div class="col-xs-6 col-md-4 p-2">
									<div class="row d-flex justify-content-center">
										<div class="col-md-6">
											<div class="card">
												<div class="card-header mx-4 p-3 text-center">
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
										<div class="col-md-6 mt-md-0 mt-4">
											<div class="card">
												<div class="card-header mx-4 p-3 text-center">
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
</section>
<?= $this->endSection(); ?>