<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
    <style>
        #loading-spinner-wraper{
            display: none;
            position: fixed !important;
            align-items: center !important;
            justify-content: center !important;
            top:0 !important;
            left:0 !important;
            right:0 !important;
            bottom:0 !important;
            z-index:10000 !important;
            background-color:rgba(0,0,0,0.4) !important;
        }
        #loading-spinner-wraper.show{
            display: flex !important;
        }
        .loading{
            width: 160px !important;
            height: 160px !important;
            border-radius: 6px !important;
            background-color: white !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
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
    </style>
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
    <script>
        // show spinner
        function showLoadingSpinner() {
            $('#loading-spinner-wraper').addClass('show fade-in');
            $('#loading-spinner-wraper div.loading').addClass('bounce-in'); 
        }

        // hide spinner
        function hideLoadingSpinner() {
            $('#loading-spinner-wraper').addClass('fade-out');
            setTimeout(() => {
                $('#loading-spinner-wraper').removeClass('show fade-in fade-out');
                $('#loading-spinner-wraper div.loading').removeClass('bounce-in'); 
            }, 50);
        }
    </script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div
      id="loading-spinner-wraper">
        <div 
          class="loading">
            <img
              style="width: 30%;"
              src="<?= base_url('assets/images/spinner.svg'); ?>">
        </div>
    </div>
<?= $this->endSection(); ?>