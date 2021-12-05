<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
    <style>
        .categor-list li, .categor-list a {
            margin: 0 !important;
            height: 34px !important;
            /* padding: 12px 0 12px 0 !important; */
        }
        #blog-content li,#blog-content ul,#blog-content ol{
            list-style: inside !important;
        }
        #blog-content ol li{
            list-style-type: decimal !important;
            line-height: 30px !important;
        }
        #blog-content li{
            line-height: 30px !important;
        }
        #blog-content p{
            line-height: 20px !important;
            margin-bottom: 10px !important;
        }
        #blog-content blockquote{
            background: #F6F6F6;
            padding: 20px;
            margin: 0;
            color: #555;
            border-left: 3px solid #c1d966;
        }
        #blog-content img{
            max-width: 100% !important;
        }
        .skeleton{
            border-radius: 4px;
            background-color: #777777;
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        #blog-title.skeleton{
            width: 60%;
            height: 24px;
        }
        #blog-penulis.skeleton,#blog-date.skeleton{
            width: 148px;
            height: 16px;
        }
        #single-post #title.skeleton{
            width: 200px;
            height: 18px;
        }
        #single-post #date.skeleton{
            width: 148px;
            height: 14px;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .5;
            }
        }
    </style>
    <!-- ** develoment ** -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/artikel/style.css'); ?>"> -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/artikel-layout.min.css'); ?>"> -->
    <!-- ** production ** -->
    <link rel="stylesheet" href="<?= base_url('assets/css/purge/artikel/detilArtikel.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/purge/artikel-layout/detilArtikel.css'); ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/detilartikel.css'); ?>"> -->
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
    <script>
        const IDARTIKEL = '<?= $idArtikel; ?>';
    </script>
    <script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/detilArtikel.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

    <!-- **** Alert Info **** -->
    <?= $this->include('Components/alertInfo'); ?>

    <!-- ***** Header Area Start ***** -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-sm-5 position-sticky" style="top: 0;z-index: 10;">
        <a class="logo navbar-brand" href="<?= base_url('/'); ?>">
            <img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt=""
                width="65" height="55">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/'); ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategori
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- ***** Header Area End ***** -->

    <section class="blog-single section position-relative" style="padding-top: 0;z-index: 0;">
        <div class="container-fluid px-4 px-sm-5">
            <div class="row position-relative">

                <div id="img-404" class="w-100 h-100 d-flex justify-content-center align-items-center d-none">
                    <img src="<?= base_url('assets/images/artikel-404.webp') ?>" alt="" style="min-width:100%;max-width:100%; opacity:0.7;">
                </div>

                <div class="col-lg-8 col-12 main-content">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image position-relative skeleton">
                                    <img src="<?= base_url('/assets/images/skeleton-thumbnail.webp'); ?>" alt="#" class="w-100" style="opacity: 0;">
                                    <img src="" alt="" id="blog-img" class="w-100 h-100 position-absolute d-none" style="z-index: 10;left:0;">
                                </div>
                                <div class="blog-detail">
                                    <h2 id="blog-title" class="blog-title skeleton"></h2>
                                    <div class="blog-meta">
                                        <span id="blog-penulis" class="author skeleton mb-2"></span>
                                        <br>
                                        <span id="blog-date" class="author skeleton mt-1"></span>
                                    </div>
                                    <div id="blog-content" class="text-justify">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 sidebar-content pt-4">
                    <div class="main-sidebar mt-1">
                        <div class="single-widget recent-post pb-5">
                            <h3 class="title">Artikel Rekomendasi</h3>
                            <!-- Single Post -->
                            <div id="blog-recommended" class="row">
                                <?php for ($i=0; $i < 4; $i++) { ?>
                                    <a id="single-post" class="col-12 col-sm-6 col-lg-12 mb-4" href="">
                                        <div class="image position-relative skeleton">
                                            <img src="<?= base_url('/assets/images/skeleton-thumbnail.webp'); ?>" alt="" class="w-100" style="opacity: 0;">
                                        </div>
                                        <div class="content mt-4">
                                            <h5 id="title" class="text-muted skeleton">
                                                
                                            </h5>
                                            <ul class="comment mt-2">
                                                <li id="date" class="skeleton"></li>
                                            </ul>
                                        </div>
                                    </a>
                                    <hr width="">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Single Widget -->

    <!-- **** footer artikiel **** -->
    <?= $this->include('Components/artikelFooter'); ?>

<?= $this->endSection(); ?>