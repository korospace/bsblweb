<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="shortcut icon" href="assets/images/banksampah-logo.png" type="image/x-icon"> -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/banksampah-logo.png'); ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <title><?= $title ?></title>

  <!-- Render Css -->
  <?= $this->renderSection('contentCss'); ?>

</head>

<body>
  <!-- Clobal Html -->
	<div 
	  id="alert-wraper"
	  class="container-fluid p-0 position-fixed"
	  style="top:0;">		
    
	</div>

  <!-- Render Content -->
  <?= $this->renderSection('content'); ?>
<<<<<<< HEAD
  <script src="assets/js/validator.min.js"></script>
  <script src="assets/js/sweetalert2.all.min.js"></script>
  <script src="assets/js/axios.min.js"></script>
  <script>
    let baseurl = 'https://t-gadgetcors.herokuapp.com/https://bsblbackend.herokuapp.com' // '<?= base_url() ?>';
    </script>
=======
  
  <!-- Global Js -->
  <script>
    const BASEURL = '<?= base_url(); ?>';
    const APIURL  = 'https://t-gadgetcors.herokuapp.com/https://bsblbackend.herokuapp.com';
  </script>
	<script src="<?= base_url('assets/js/axios.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/validator.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/sweetalert2.min.js'); ?>"></script>
  
>>>>>>> 19bf97d5cb8a34b1a583cfd70d717a44fa6eb681
  <!-- Render Js -->
  <?= $this->renderSection('contentJs'); ?>
  <script src="assets/js/jquery.validate.min.js"></script>

</body>

</html>