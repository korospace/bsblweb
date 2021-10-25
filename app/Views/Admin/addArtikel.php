<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
	#standalone-container {
		margin: 5px 20px;
		max-width: 90%;
	}
	#editor-container {
		height: 450px;
		border-radius : 10px;
	}
	#toolbar-container {
		border-radius : 10px;
		margin-top: 70px;
	}
	</style>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-icons.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/nucleo-svg.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/soft-ui-dashboard.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/quill.snow.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/katex.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/monokai-sublime.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script src="<?= base_url('assets/js/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/soft-ui-dashboard.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	<!-- <script src="<?= base_url('assets/js/image-resize.min.js'); ?>"></script> -->
	<script src="<?= base_url('assets/js/katex.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/highlight.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/quill.min.js'); ?>"></script>
	<script>
		var quill = new Quill('#editor-container', {
			modules: {
			//	Masih error -> Sourcenya : image-resize.min.js
			// 	imageResize: {
            // 	displaySize: true
			// },
			formula: true,
			syntax: true,
			toolbar: '#toolbar-container'
			},
			placeholder: '...',
			theme: 'snow'
		});
	</script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<body class="g-sidenav-show bg-gray-100">
		<aside class="noprint sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main"  style="font-family: 'qc-semibold';">
			<div class="sidenav-header">
				<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav"></i>
				<a class="nav-link mt-4" href="<?= base_url('admin/listartikel');?>" style="display: flex;align-items: center;">
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
					<span class="nav-link-text ms-1">kembali</span>
				</a>
				<hr class="horizontal dark mt-2">
			</div>
		</aside>

		<main class="main-content position-relative h-100 mt-1 border-radius-lg"">
			<!-- navbar -->
			<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="false">
				<div class="container-fluid py-1 px-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah artikel</li>
						</ol>
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
			
			<!-- table -->
				<!-- Ini buat apa? -->
			<div>
				<a href="<?= base_url('admin/addartikel');?>"></a>
			</div>
			<h3 style="margin: 10px 15px;">Artikel Baru</h3>
			<hr>
			<form id="addNewArticle" style="margin: 10px 15px;>
				<!-- Text Area Quill -->
				<div id="standalone-container">
					<div class="form-group">
						<i class="fas fa-pencil-alt"></i>
						<h5 style="display:inline;">Judul Artikel</h5>
						<input type="text" class="form-control" placeholder="Judul">
					</div>
					<div class="form-group">
						<i class="fas fa-list-ul"></i>
						<h5 style="display:inline;">Kategori</h5>
						<select class="form-control">
							<option value="">Kategori</option>
							<option value="">Kategori</option>
							<option value="">Kategori</option>
						</select>
					</div>
					<button type="submit" class="btn btn-success" style="min-width:100px;float:right;">
						<i class="far fa-paper-plane"></i>
						Publikasikan 
					</button>
					<div id="toolbar-container">
						<span class="ql-formats">
							<select class="ql-font"></select>
							<select class="ql-size"></select>
						</span>
						<span class="ql-formats">
							<button class="ql-bold"></button>
							<button class="ql-italic"></button>
							<button class="ql-underline"></button>
							<button class="ql-strike"></button>
						</span>
						<span class="ql-formats">
							<select class="ql-color"></select>
							<select class="ql-background"></select>
						</span>
						<span class="ql-formats">
							<button class="ql-script" value="sub"></button>
							<button class="ql-script" value="super"></button>
						</span>
						<span class="ql-formats">
							<button class="ql-header" value="1"></button>
							<button class="ql-header" value="2"></button>
							<button class="ql-blockquote"></button>
							<button class="ql-code-block"></button>
						</span>
						<span class="ql-formats">
							<button class="ql-list" value="ordered"></button>
							<button class="ql-list" value="bullet"></button>
							<button class="ql-indent" value="-1"></button>
							<button class="ql-indent" value="+1"></button>
						</span>
						<span class="ql-formats">
							<button class="ql-direction" value="rtl"></button>
							<select class="ql-align"></select>
						</span>
						<span class="ql-formats">
							<button class="ql-link"></button>
							<button class="ql-image"></button>
							<button class="ql-video"></button>
							<button class="ql-formula"></button>
						</span>
						<span class="ql-formats">
							<button class="ql-clean"></button>
						</span>
					</div>
					<div id="editor-container"></div>
				</div>
			</form>

		</main>
	</body>
<?= $this->endSection(); ?>