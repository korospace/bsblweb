<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="<?= base_url(); ?>">
  <meta id="meta-title" property="og:title" content="" />
  <meta id="meta-description" property="og:description" content="" />
  <meta id="meta-img" property="og:image" itemprop="image" content="">

  <link rel="shortcut icon" href="<?= base_url('assets/images/banksampah-logo.webp'); ?>" type="image/x-icon">
  <title><?= $title ?></title>

  <!-- Global Css -->
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

    .swal2-confirm {
      background-color: #c1d966 !important;
    }
    ::-webkit-scrollbar {
        width: 5px;
    }
    ::-webkit-scrollbar-track {
        background: #ffffff;
    }
    ::-webkit-scrollbar-thumb {
        background: #5cb85c;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #5cb85c;
    }
  </style>
  
  <!-- Render Css -->
  <?= $this->renderSection('contentCss'); ?>

</head>

<body>
  <!-- Global Html -->

  <!-- Render Html -->
  <?= $this->renderSection('content'); ?>
  
  <!-- Global Js -->
  <script src="<?= base_url('assets/js/core/jquery-2.1.0.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/core/popper.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/plugins/axios.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/plugins/sweetalert2.min.js'); ?>"></script>
  <script>
    const TOKEN   = '<?= (isset($token)) ? $token : null; ?>';
    const BASEURL = '<?= base_url(); ?>';
    const APIURL  = BASEURL;
    // const APIURL  = 'https://t-gadgetcors.herokuapp.com/https://bsbl.herokuapp.com';
  </script>
  
  <!-- Render Js -->
  <?= $this->renderSection('jsComponent'); ?>
  <?= $this->renderSection('contentJs'); ?>

</body>

</html>