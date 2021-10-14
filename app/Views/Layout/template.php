<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="assets/images/banksampah-logo.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <title><?= $title ?></title>

  <!-- Render Css -->
  <?= $this->renderSection('contentCss'); ?>

</head>

<body>

  <!-- Render Section -->
  <?= $this->renderSection('content'); ?>


  <script src="assets/js/axios.min.js"></script>
  <script>
    let baseurl = 'https://t-gadgetcors.herokuapp.com/https://bsblbackend.herokuapp.com' // '<?= base_url() ?>';
  </script>
  <!-- Render Js -->
  <?= $this->renderSection('contentJs'); ?>

</body>

</html>