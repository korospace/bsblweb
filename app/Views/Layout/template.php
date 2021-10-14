<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= base_url('logo.png'); ?>" type="image/x-icon">
    <title><?= $title ?></title>

    <!-- Css -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

  </head>
  <body>

    <!-- Render Section -->
    <?= $this->renderSection('content'); ?>

    <!-- JavaScript -->
    <!-- <script src="<?= base_url('aset/js/myjs.js'); ?>"></script> -->
  </body>
</html>