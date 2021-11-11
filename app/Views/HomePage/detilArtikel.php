<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
</style>

<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/artikel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/artikel/style.css'); ?>">


<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/owl-carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/imgfix.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>

<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

<!-- **** Loading Spinner **** -->
<?= $this->include('Components/loadingSpinner'); ?>
<!-- **** Alert Info **** -->
<?= $this->include('Components/alertInfo'); ?>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a class="logo" href="<?= base_url('/'); ?> ">
                        <img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt=""
                            width="65" height="55">
                    </a>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
<section class="blog-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="blog-single-main">
                    <div class="row">
                        <div class="col-12">
                            <div class="image">
                                <img src="https://via.placeholder.com/950x460" alt="#">
                            </div>
                            <div class="blog-detail">
                                <h2 class="blog-title">What are the secrets to start- up success?</h2>
                                <div class="blog-meta">
                                    <span class="author"><a><i class="fa fa-user"></i>By Admin</a><a><i
                                                class="fa fa-calendar"></i>Dec 24, 2018</a></span>
                                </div>
                                <div class="content">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus similique
                                        rerum aut doloremque labore repudiandae molestiae deleniti, saepe nemo eveniet.
                                        Quisquam, accusantium architecto? Minima error odit facilis iste non eaque earum
                                        recusandae eum sed doloribus consequatur illum maxime vitae aliquid a nam vero
                                        assumenda obcaecati vel impedit, aut natus quisquam.</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam
                                        necessitatibus, assumenda rem est id officiis quasi impedit hic esse molestiae
                                        dolores voluptatum perspiciatis? Dolorum iusto esse doloribus? Vitae recusandae
                                        sint tempore reiciendis accusantium ratione, sunt quibusdam magni, quasi
                                        inventore alias dolorem laborum odio! Quis possimus repellat dignissimos velit
                                        consequatur! Corporis alias eveniet consequatur error natus eos delectus odio
                                        iusto voluptatum.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium pariatur
                                        magnam ipsum reprehenderit voluptatibus adipisci veritatis hic aperiam et
                                        molestiae mollitia iure nihil quam autem impedit officiis recusandae ducimus
                                        esse fugit, corporis tenetur! Quod eaque corrupti, odio alias rerum assumenda,
                                        repellat quam ducimus accusamus sit voluptas reiciendis ab reprehenderit nostrum
                                        quidem laudantium labore optio facere a consequuntur dolorem deleniti.
                                        Exercitationem temporibus, autem quidem optio officiis nemo sequi eaque odit
                                        voluptatibus tempore voluptate obcaecati at aperiam.</p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <div class="comments">
                                <h3 class="comment-title">Comments (3)</h3>
                                <div class="single-comment">
                                    <img src="https://via.placeholder.com/80x80" alt="#">
                                    <div class="content">
                                        <h4>Alisa harm <span>At 8:59 pm On Feb 28, 2018</span></h4>
                                        <p>Enthusiastically leverage existing premium quality vectors with
                                            enterprise-wide innovation
                                            collaboration Phosfluorescently leverage others enterprisee
                                            Phosfluorescently leverage.</p>
                                        <div class="button">
                                            <a href="#" class="btn"><i class="fa fa-reply"
                                                    aria-hidden="true"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment left">
                                    <img src="https://via.placeholder.com/80x80" alt="#">
                                    <div class="content">
                                        <h4>john deo <span>Feb 28, 2018 at 8:59 pm</span></h4>
                                        <p>Enthusiastically leverage existing premium quality vectors with
                                            enterprise-wide innovation
                                            collaboration Phosfluorescently leverage others enterprisee
                                            Phosfluorescently leverage.</p>
                                        <div class="button">
                                            <a href="#" class="btn"><i class="fa fa-reply"
                                                    aria-hidden="true"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment">
                                    <img src="https://via.placeholder.com/80x80" alt="#">
                                    <div class="content">
                                        <h4>megan mart <span>Feb 28, 2018 at 8:59 pm</span></h4>
                                        <p>Enthusiastically leverage existing premium quality vectors with
                                            enterprise-wide innovation
                                            collaboration Phosfluorescently leverage others enterprisee
                                            Phosfluorescently leverage.</p>
                                        <div class="button">
                                            <a href="#" class="btn"><i class="fa fa-reply"
                                                    aria-hidden="true"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="reply">
                                <div class="reply-head">
                                    <h2 class="reply-title">Leave a Comment</h2>
                                    <form class="form" action="#">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Your Name<span>*</span></label>
                                                    <input type="text" name="name" placeholder="" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Your Email<span>*</span></label>
                                                    <input type="email" name="email" placeholder="" required="required">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Your Message<span>*</span></label>
                                                    <textarea name="message" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn">Post comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="main-sidebar">
                    <!-- Single Widget -->
                    <div class="single-widget search">
                        <div class="form">
                            <input type="email" placeholder="Search Here...">
                            <a class="button" href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <!--/ End Single Widget -->
                    <!-- Single Widget -->
                    <div class="single-widget category">
                        <h3 class="title">Artikel Lainnya</h3>
                        <ul class="categor-list">
                            <li><a href="#">Webinar</a></li>
                            <li><a href="#">KKN</a></li>
                            <li><a href="#">Sosialisasi & Edukasi</a></li>
                        </ul>
                    </div>
                    <!--/ End Single Widget -->
                    <!-- Single Widget -->
                    <div class="single-widget recent-post">
                        <h3 class="title">Artikel Rekomendasi</h3>
                        <!-- Single Post -->
                        <div class="single-post">
                            <div class="image">
                                <img src="https://via.placeholder.com/100x100" alt="#">
                            </div>
                            <div class="content">
                                <h5><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h5>
                                <ul class="comment">
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>Jan 11, 2020</li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Post -->
                        <!-- Single Post -->
                        <div class="single-post">
                            <div class="image">
                                <img src="https://via.placeholder.com/100x100" alt="#">
                            </div>
                            <div class="content">
                                <h5><a href="#">Lorem ipsum dolor sit amet.</a></h5>
                                <ul class="comment">
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>Mar 05, 2019</li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Post -->
                        <!-- Single Post -->
                        <div class="single-post">
                            <div class="image">
                                <img src="https://via.placeholder.com/100x100" alt="#">
                            </div>
                            <div class="content">
                                <h5><a href="#">Lorem ipsum dolor sit amet consectetur.</a></h5>
                                <ul class="comment">
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>June 09, 2019</li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Post -->
                        <!-- Single Post -->
                        <div class="single-post">
                            <div class="image">
                                <img src="https://via.placeholder.com/100x100" alt="#">
                            </div>
                            <div class="content">
                                <h5><a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing.</a></h5>
                                <ul class="comment">
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>June 09, 2021</li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Post -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Single Widget -->
<!-- footer section starts  -->

<footer class="deneb_footer">
    <div class="widget_wrapper" style="background-image:url('<?= base_url('assets/images/footer-bg.png'); ?>');">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="widget widegt_about">
                        <div class="widget_title">
                            <img src="assets/images/logo_1.png" class="img-fluid" alt="">
                            <p>Quisque orci nisl, viverra et sem ac, tincidunt egestas massa. Morbi est arcu,
                                hendrerit ac vehicula
                                condimentum, euismod nec tortor praesent consequat urna.</p>
                        </div>
                        <ul class="social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget widget_link">
                        <div class="widget_title">
                            <h4>Links</h4>
                        </div>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="#activity">Kegiatan</a></li>
                            <li><a href="#services">Layanan</a></li>
                            <li><a href="#contact-us">Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget widget_contact">
                        <div class="widget_title">
                            <h4>Contact Us</h4>
                        </div>
                        <div class="contact_info">
                            <div class="single_info">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="info">
                                    <p><a>1800-121-3637</a></p>
                                    <p><a>+91 924-614-7999</a></p>
                                </div>
                            </div>
                            <div class="single_info">
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info">
                                    <p><a href="mailto:info@deneb.com">bankasampahbudiluhur@gmail.com</a></p>
                                    <p><a href="mailto:services@deneb.com">bsblservice.com</a></p>
                                </div>
                            </div>
                            <div class="single_info">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info">
                                    <p>
                                        <a>Jl. H. Gaim No.50, RT.10/RW.2, Petukangan Utara, Kec. Pesanggrahan, Kota
                                            Jakarta Selatan, Daerah Khusus Ibukota Jakarta.</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright_text">
                        <p>Copyright &copy; 2020 All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- footer section ends -->

<?= $this->endSection(); ?>