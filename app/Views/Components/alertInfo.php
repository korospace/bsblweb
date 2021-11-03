<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/alertinfo.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('jsComponent'); ?>
    <script>
        function showAlert(data) {
            if ($('#alert').hasClass(`show`)) {
                hideAlert()
                setTimeout(() => {
                    $('#alert #message').html(data.message);
                    $('#alert #close').addClass(`${(data.btnclose == true) ? '' : 'd-none'}`);
                    $('#alert').addClass(`alert-${data.type} show`);
                }, 500);                
            } 
            else {
                $('#alert #message').html(data.message);
                $('#alert #close').addClass(`${(data.btnclose == true) ? '' : 'd-none'}`);
                $('#alert').addClass(`alert-${data.type} show`);
            }
        }

        function hideAlert() {
            $('#alert #message').html('custom text');
            $('#alert #close').removeClass('d-none');
            $('#alert').removeClass('show alert-success alert-danger alert-warning alert-info');
        }
        
        if(!navigator.onLine){
            showAlert({
                message: `<strong>Ups . . .</strong> koneksi anda terputus!`,
                btnclose: false,
                type:'danger'
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
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
  <div
    id="alert" 
    class="container-fluid position-fixed alert alert-dismissible fade"
    style="top:0;z-index:10000;" role="alert">
      <span id="message">custom text</span>
      <button id="close" type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
<?= $this->endSection(); ?>