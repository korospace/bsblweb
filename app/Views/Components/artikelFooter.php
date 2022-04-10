<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
	<style>
        .widegt_about p {
            color: #FFF;
            margin-bottom: 20px;
        }
        .widegt_about .social li {
            display: inline-block;
            margin-right: 10px;
        }
        .widegt_about .social li a {
            display: block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            background-color: #f9e6d4;
            color: #537629;
            font-size: 14px;
            -webkit-transition: all all 0.5s ease-out 0s;
            -moz-transition: all all 0.5s ease-out 0s;
            -ms-transition: all all 0.5s ease-out 0s;
            -o-transition: all all 0.5s ease-out 0s;
            transition: all all 0.5s ease-out 0s;
        }
        .widegt_about .social li a:hover,
        .widegt_about .social li a:focus {
            background-image: -moz-linear-gradient(0deg, #c1d966 0%, #c1d966 100%);
            background-image: -webkit-linear-gradient(0deg, #c1d966 0%, #c1d966 100%);
            background-image: -ms-linear-gradient(0deg, #c1d966 0%, #c1d966 100%);
            color: #fff;
            box-shadow: 2.5px 4.33px 15px 0px rgba(254, 176, 0, 0.4);
        }
    </style>
    <!-- ** develoment ** -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"> -->
    <!-- ** production ** -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/artikelFooter.css'); ?>"> -->
<?= $this->endSection(); ?>

    <footer class="">
        <div class="pt-5" style="background-image:url('<?= base_url('assets/images/footer-bg.webp'); ?>');background-repeat: no-repeat;background-size: cover;">
            <div class="container-fluid pt-5 pt-lg-0">
                <div class="row mt-5 pb-5 px-4">
                    <div class="col-12 col-md-2 mt-5 mt-md-0">
                        <div class="widget widget_link">
                            <h4 class="text-white" style="font-weight: bold;">Links</h4>
                            <div class="mt-4 d-flex flex-column">
                                <a class="text-white mb-3" href="/">Home</a>
                                <a class="text-white mb-3" href="#activity">Kegiatan</a>
                                <a class="text-white mb-3" href="#services">Layanan</a>
                                <a class="text-white mb-3" href="#contact-us">Kontak Kami</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-5 mt-5 mt-md-0">
                        <div class="widget widget_contact">
                            <h4 class="text-white" style="font-weight: bold;">Contact Us</h4>
                            <div class="mt-4">
                                <div class="d-flex">
                                    <div class="icon mr-3">
                                        <i class="fas fa-phone-alt" style="color:#C1D966;"></i>
                                    </div>
                                    <div class="info d-flex flex-column" style="line-height: 1.5;">
                                        <a class="text-white" target="_blank" href="https://wa.me/6281385624543?text=Assalamualaikum%20Umi%20Utik,%20saya%20ingin%20bertanya%20mengenai%20banksampah%20budiluhur">
                                            +62 813-8562-4543
                                        </a>
                                        <a class="text-white" target="_blank" href="https://wa.me/6287871911407?text=Assalamualaikum%20Umi%20Utik,%20saya%20ingin%20bertanya%20mengenai%20banksampah%20budiluhur">
                                            +62 878-7191-1407
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="icon mr-3">
                                        <i class="fas fa-envelope" style="color:#C1D966;"></i>
                                    </div>
                                    <div class="info d-flex flex-column" style="line-height: 1.5;">
                                        <a class="text-white" href="bankasampahbudiluhur@gmail.com">
                                            bankasampahbudiluhur@gmail.com
                                        </a>
                                        <a class="text-white" href="mailto:bsblservice@gmail.com">
                                            bsblservice@gmail.com
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="icon mr-3">
                                        <i class="fas fa-map-marker-alt" style="color:#C1D966;"></i>
                                    </div>
                                    <div class="info text-white" style="line-height: 1.5;">
                                        Jl. H. Gaim No.50, RT.10/RW.2, Petukangan Utara, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 col-md-5 mt-5 mt-md-0">
                        <div class="widget widegt_about">
                            <h4 class="text-white" style="font-weight: bold;">Social media</h4>
                            <div class="social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid mt-5 py-3 d-flex justify-content-center">
                <p class="text-light">Copyright &copy; 2020 All rights reserved.</p>
            </div>
        </div>
    </footer>