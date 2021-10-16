<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
    <script>
        function showAlert(data) {
            $('#alert #message').html(data.message);
            $('#alert #close').addClass(`${(data.btnclose == true) ? '' : 'd-none'}`);
            $('#alert').addClass(`alert-${data.type} show`);
        }

        function hideAlert() {
            $('#alert #message').html('custom text');
            $('#alert #close').removeClass('d-none');
            $('#alert').removeClass('show');
        }
    </script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
  <div
    id="alert" 
    class="container-fluid position-fixed alert alert-dismissible fade"
    style="top:0;" role="alert">
      <span id="message">custom text</span>
      <button id="close" type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
<?= $this->endSection(); ?>