<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
		body, html {
			height: 100%;
		}

		body {
			background: -webkit-linear-gradient(left, #537629, #c1d966);
			
		}

		.digit-group input {
			width: 35px;
			height: 50px;
			background-color: lighten(#0f0f1a, 5%);
			border: none;
			line-height: 50px;
			text-align: center;
			font-size: 24px;
			font-weight: 200;
			color: black;
			margin: 0 2px;
			font-family: 'qc-medium';
			border-radius: 4px;
		}
	</style>
  	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  	<script src="<?= base_url('assets/js/otp.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

	<!-- **** Loading Spinner **** -->
	<?= $this->include('Components/loadingSpinner'); ?>
	<!-- **** Alert Info **** -->
	<?= $this->include('Components/alertInfo'); ?>

	<section class="" style="height: 100vh;display: flex;justify-content: center;align-items: center;flex-direction: column;">
		<div class="text-white text-center mb-4">
			<h2 style="font-family: 'qc-semibold';font-size: 36px;">VERIFIKASI AKUN</h2>
			<p>masukan kode OTP yang anda terima <br> dari email</p>
		</div>

		<div class="digit-group" data-group-name="digits" data-autosubmit="true" autocomplete="off" >
			<input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
			<input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
			<input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
			<input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
			<input type="text" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
			<input type="text" id="digit-6" name="digit-6" data-previous="digit-5" />
		</div>
	</section>
<?= $this->endSection(); ?>