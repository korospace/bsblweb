<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
    <style>
        .loading{
            width: 160px;
            height: 160px;
            border-radius: 6px;
            background-color: white;
        }

        .fade-in{
            animation: fade-in .4s !important;
        }
        
        .fade-out{
            animation: fade-out .2s !important;
        }
        
        .bounce-in {
            animation: bounce-in .5s !important;
        }
        
        .bounce-out {
            animation: bounce-out .5s alternate !important;
        }

        /* Animasi */
        @keyframes fade-in {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes fade-out {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes bounce-in {
            0% {
                transform: scale(0.7);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes bounce-out {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0.7);
            }
        }
    </style>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
    <script>
        // show spinner
        function showLoadingSpinner() {
            $('#loading-spinner-wraper').addClass('d-flex fade-in');
            $('#loading-spinner-wraper div.loading').addClass('bounce-in'); 
        }

        // hide spinner
        function hideLoadingSpinner() {
            $('#loading-spinner-wraper div.loading').addClass('bounce-out'); 
            setTimeout(() => {
                $('#loading-spinner-wraper').addClass('fade-out');
                setTimeout(() => {
                    $('#loading-spinner-wraper').removeClass('d-flex fade-in fade-out');
                    $('#loading-spinner-wraper div.loading').removeClass('bounce-in bounce-out'); 
                }, 200);
            }, 50);
        }
    </script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div
      id="loading-spinner-wraper"
      class="position-fixed d-none justify-content-center align-items-center" 
      style="top:0;bottom:0;left:0;right:0;z-index:100;background-color:rgba(0,0,0,0.4);">
        <div 
          class="loading d-flex justify-content-center align-items-center">
            <img
              style="width: 30%;"
              src="assets/images/spinner.svg">
        </div>
    </div>
<?= $this->endSection(); ?>