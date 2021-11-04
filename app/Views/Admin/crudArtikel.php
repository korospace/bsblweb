<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
	#editor-container {
		height: 450px;
		border-radius : 10px;
		border: 0.5px solid #D2D6DA;
	}
	#toolbar-container {
		border-radius : 10px;
		margin-bottom: 20px;
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
	<script>
		const IDARTIKEL = '<?= (isset($idartikel)) ? $idartikel : '' ; ?>';
	</script>
	<script src="<?= base_url('assets/js/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/soft-ui-dashboard.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/katex.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/highlight.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/quill.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/image-resize.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/quill.imageCompressor.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	<script src="<?= base_url('assets/js/admin.artikel.js'); ?>"></script>
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
						<svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_302:4)">
						<path d="M6.50489 8.41773L3.20258 5.11542L6.50489 1.81312C6.79641 1.51129 6.79224 1.03151 6.49552 0.734794C6.1988 0.438075 5.71903 0.433906 5.4172 0.725423L1.57104 4.57158C1.27075 4.87196 1.27075 5.35889 1.57104 5.65927L5.4172 9.50542C5.61033 9.70539 5.89633 9.78559 6.16528 9.71519C6.43423 9.6448 6.64426 9.43476 6.71466 9.16582C6.78505 8.89687 6.70486 8.61087 6.50489 8.41773Z" fill="#252F40"/>
						</g>
						<defs>
						<clipPath id="clip0_302:4">
						<rect width="10" height="7" fill="white" transform="translate(7.49951 0.500031) rotate(90)"/>
						</clipPath>
						</defs>
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
				<div class="container-fluid py-1 px-0">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
							<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
							<li class="breadcrumb-item text-sm text-dark active" aria-current="page">
								<?= ($title == 'Admin | tambah artikel') ? 'Artikel baru' : 'Edit artikel' ?>
							</li>
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
			
			<!-- form -->
			<form id="formCrudArticle" class="pl-4 pr-5 pb-5 mt-2" style="font-family: 'qc-medium';">
				<div style="font-family: 'qc-medium';" class="row">
					<h2 class="col">Artikel</h2>
					<button type="" class="mt-1 btn btn-success col-12 col-sm-2" style="min-width:170px;letter-spacing: 1px;">
						<i class="far fa-paper-plane mr-1"></i>
						<?= (isset($idartikel)) ? 'Edit' : 'Publikasikan' ; ?> 
					</button>
				</div>
				
				<hr>
				<!-- Text Area Quill -->
				<div id="standalone-container">
					<div class="form-row mt-4 d-flex flex-column">
						<input type="hidden" name="id" id="idartikel">
						<div class="px-1">
							<i class="far fa-image text-muted"></i>
							<h6 class="text-muted" style="display:inline;">Thumbnail</h6>
						</div>
						<div class="position-relative col-12 col-sm-6 mt-1 mb-2">
							<img src="<?= base_url('assets/images/default-thumbnail.jpg'); ?>" alt="thumbnail" id="preview-thumbnail" class="img-thumbnail position-absolute" style="z-index: 10;min-width: 100%;max-width: 100%;max-height: 100%;;min-height: 100%;">
							<img src="<?= base_url('assets/images/default-thumbnail.jpg'); ?>" class="w-100" style="opacity: 0;">
						</div>
						<div class="input-group mt-2 col-12 col-sm-6">
							<input type="file" class="form-control" id="thumbnail" name="<?= (isset($idartikel)) ? 'new_thumbnail' : 'thumbnail' ; ?>" autocomplete="off" placeholder="thumbnail" style="min-height: 38px" onchange="changeThumbPreview(this);">
						</div>
						<small
							id="thumbnail-error"
							class="text-danger"></small>
					</div>
					<div class="form-row mt-5">
						<div class="col-12 col-sm-6 form-group">
							<i class="fas fa-pencil-alt mr-1 text-muted"></i>
							<h6 class="text-muted" style="display:inline;">Judul Artikel</h6>
							<input type="text" class="form-control mt-1" id="title" name="title" placeholder="Title" style="min-height: 38px" autocomplete="off">
							<small
								id="title-error"
								class="text-danger"></small>
						</div>
						<div class="col-12 col-sm-6 form-group">
							<i class="fas fa-list-ul mr-1 text-muted"></i>
							<h6 class="text-muted" style="display:inline;">Kategori</h6>
							<select id="kategori-berita-wraper" name="kategori" class="form-control py-1 px-2 mt-1 mb-2 d-block" style="min-height: 38px">
								
							</select>
							<?php if ($title !== 'Admin | edit artikel') { ?>
								<a href="" data-toggle="modal" data-target="#modalAddKategori" class="text-muted text-sm d-block text-right"><u>manage kategori</u></a>
							<?php } ?>
						</div>
					</div>
					<div id="toolbar-container" class="mt-4">
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

	<!-- Modal -->
	<div class="modal fade" id="modalAddKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form id="formAddKategoriBerita" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Manage kategori</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="input-group col-lg-12 px-0 form-group table-responsive rounded-0" style="max-height: 186px;overflow: auto;border: 0.5px solid #D2D6DA;">
						<table id="table-kategori-berita" class="table table-hover text-center mb-0" style="">
							<thead class="position-sticky bg-white" style="top: 0;">
								<tr>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										#
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Nama Kategori
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
					<hr class="horizontal dark mt-2 mb-2">
					<h6 class="font-italic opacity-8">Tambah kategori</h6>
					<div class="input-group col-lg-12 px-0 form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text bg-gray px-4 border-md">
									<i class="fas fa-clipboard-list text-muted"></i>
								</span>
							</div>
							<input type="text" class="form-control px-2" id="kategori_name" name="kategori_name" autocomplete="off" placeholder="masukan kategori baru">
						</div>
						<small
							id="kategori_name-error"
							class="text-danger"></small>
					</div>
				</div>
				<div class="modal-footer">
					<button id="submit" type="submit" class="btn btn-success d-flex justify-content-center align-items-center" style="height: 40.8px;">
						<span id="text">Simpan</span>
						<img id="spinner" class="d-none" src="<?= base_url('assets/images/spinner-w.svg');?>" style="width: 20px;">
					</button>
				</div>
			</form>
		</div>
	</div>
<?= $this->endSection(); ?>