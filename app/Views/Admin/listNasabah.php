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
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/soft-ui-dashboard.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
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
			<!-- Navbar -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
				navbar-scroll="true">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
						</ol>
						<h6 class="font-weight-bolder mb-0">Tables</h6>
					</nav>
					<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
						<div class="ms-md-auto pe-md-3 d-flex align-items-center">
							<ul class="navbar-nav  justify-content-end">
								<li class="nav-item d-flex align-items-center">
									<a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
										<i class="fa fa-user me-sm-1"></i>
										<span class="d-sm-inline d-none">Log Out</span>
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
						<div class="card mb-4">
							<div class="card-header pb-0">
								<h6>List Nasabah</h6>
								<div class="input-group">
									<span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
									<input type="text" class="form-control" placeholder="Cari Nasabah">
								</div>
							</div>
							<div class="card-body px-0 pt-0 pb-2">
								<div class="table-responsive p-0">
									<table class="table align-items-center mb-0">
										<thead>
											<tr>
												<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
													Number
												</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
													Address</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Join
													Date</th>
												<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action
												</th>
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
													<span class="text-xs font-weight-bold"> Jl. Ciledug Raya, RT.10/RW.2, Petukangan Utara, Kec.
														Pesanggrahan, Kota Jakarta Selatan </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 07/11/2021 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="info" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
														data-original-title="Edit user">
														Detil
													</a>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="../pages/form-timbang.php" class="text-secondary font-weight-bold text-xs"
														data-toggle="tooltip" data-original-title="Edit user">
														Sampah
													</a>
												</td>
											</tr>
											<tr>
												<td class="align-middle text-sm">
													<span class="text-xs text-name font-weight-bold"> Rilo Anggoro Saputra </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 06020002 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> Komplek Lippo Karawaci 1200, Jl. Boulevard Diponegoro,
														Bencongan, Kec. Klp. Dua, Tangerang, Banten </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 13/11/2021 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
														data-original-title="Edit user">
														Detil
													</a>
												</td>
											</tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Jl. Ciledug Raya, RT.10/RW.2, Petukangan Utara, Kec.
													Pesanggrahan, Kota Jakarta Selatan </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 07/11/2021 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
													data-original-title="Edit user">
													Detil
												</a>
											</td>
											</tr>
											<tr>
												<td class="align-middle text-sm">
													<span class="text-xs text-name font-weight-bold"> Rilo Anggoro Saputra </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 06020002 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> Komplek Lippo Karawaci 1200, Jl. Boulevard Diponegoro,
														Bencongan, Kec. Klp. Dua, Tangerang, Banten </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 13/11/2021 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
														data-original-title="Edit user">
														Detil
													</a>
												</td>
											</tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Jl. Ciledug Raya, RT.10/RW.2, Petukangan Utara, Kec.
													Pesanggrahan, Kota Jakarta Selatan </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 07/11/2021 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
													data-original-title="Edit user">
													Detil
												</a>
											</td>
											</tr>
											<tr>
												<td class="align-middle text-sm">
													<span class="text-xs text-name font-weight-bold"> Rilo Anggoro Saputra </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 06020002 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> Komplek Lippo Karawaci 1200, Jl. Boulevard Diponegoro,
														Bencongan, Kec. Klp. Dua, Tangerang, Banten </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 13/11/2021 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
														data-original-title="Edit user">
														Detil
													</a>
												</td>
											</tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Jl. Ciledug Raya, RT.10/RW.2, Petukangan Utara, Kec.
													Pesanggrahan, Kota Jakarta Selatan </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 07/11/2021 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
													data-original-title="Edit user">
													Detil
												</a>
											</td>
											</tr>
											<tr>
												<td class="align-middle text-sm">
													<span class="text-xs text-name font-weight-bold"> Rilo Anggoro Saputra </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 06020002 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> Komplek Lippo Karawaci 1200, Jl. Boulevard Diponegoro,
														Bencongan, Kec. Klp. Dua, Tangerang, Banten </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 13/11/2021 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
														data-original-title="Edit user">
														Detil
													</a>
												</td>
											</tr>
											<td class="align-middle text-sm">
												<span class="text-xs text-name font-weight-bold"> Heru Saputro </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 06020001 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> Jl. Ciledug Raya, RT.10/RW.2, Petukangan Utara, Kec.
													Pesanggrahan, Kota Jakarta Selatan </span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold"> 07/11/2021 </span>
											</td>
											<td class="align-middle text-center text-sm">
												<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
													data-original-title="Edit user">
													Detil
												</a>
											</td>
											</tr>
											<tr>
												<td class="align-middle text-sm">
													<span class="text-xs text-name font-weight-bold"> Rilo Anggoro Saputra </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 06020002 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> Komplek Lippo Karawaci 1200, Jl. Boulevard Diponegoro,
														Bencongan, Kec. Klp. Dua, Tangerang, Banten </span>
												</td>
												<td class="align-middle text-center text-sm">
													<span class="text-xs font-weight-bold"> 13/11/2021 </span>
												</td>
												<td class="align-middle text-center text-sm">
													<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
														data-original-title="Edit user">
														Detil
													</a>
												</td>
											</tr>
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
<?= $this->endSection(); ?>