<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="<?= base_url('assets/images/banksampah-logo.webp'); ?>" type="image/x-icon">
  <link rel="stylesheet"    href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap">
  <title><?= $title ?></title>

  <!-- Global Css -->
  <style>
    .swal2-confirm {
    background-color: #c1d966 !important;
    }
  </style>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css'); ?>">
  
  <!-- Render Css -->
  <?= $this->renderSection('contentCss'); ?>

</head>

<body>
  <!-- Global Html -->

  <!-- Render Html -->
  <?= $this->renderSection('content'); ?>
  
  <!-- Global Js -->
  <script src="<?= base_url('assets/js/font-awesome.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/axios.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sweetalert2.min.js'); ?>"></script>
  <script>
    const TOKEN   = '<?= (isset($token)) ? $token : null; ?>';
    const BASEURL = '<?= base_url(); ?>';
    const APIURL  = 'https://t-gadgetcors.herokuapp.com/https://bsblbackend.herokuapp.com';
  </script>
  
  <!-- Render Js -->
  <?= $this->renderSection('jsComponent'); ?>
  <?= $this->renderSection('contentJs'); ?>

</body>

</html>