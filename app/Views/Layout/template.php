<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="shortcut icon" href="assets/images/banksampah-logo.png" type="image/x-icon"> -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/banksampah-logo.png'); ?>" type="image/x-icon">
  <link rel="stylesheet"    href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap">
  <title><?= $title ?></title>

  <!-- Render Css -->
  <?= $this->renderSection('contentCss'); ?>

</head>

<body>
  <!-- Global Html -->

  <!-- Render Html -->
  <?= $this->renderSection('content'); ?>
  
  <!-- Global Js -->
	<script src="<?= base_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/popper.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/axios.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/validator.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sweetalert2.min.js'); ?>"></script>
  <script>
    const BASEURL = '<?= base_url(); ?>';
    const APIURL  = 'https://t-gadgetcors.herokuapp.com/https://bsblbackend.herokuapp.com';

    if(!navigator.onLine){
        showAlert({
            message: `<strong>Ups . . .</strong> koneksi anda terputus!`,
            btnclose: false,
            type:'danger' // success/warning/danger/info/light/dark/primary/secondary
        })
    }
    window.onoffline = () => {
        showAlert({
            message: `<strong>Ups . . .</strong> koneksi anda terputus!`,
            btnclose: false,
            type:'danger'
        })
    };
    window.ononline = () => {
        hideAlert();
    };
  </script>
  
  <!-- Render Js -->
  <?= $this->renderSection('contentJs'); ?>

</body>

</html>