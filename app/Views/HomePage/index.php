<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
<style>
  @media (max-width:990px) {
    body {
      overflow: hidden;
    }
  }
</style>
<!-- ** develoment ** -->
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
<!-- ** production ** -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/homepage.css'); ?>"> -->
<link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/homepage.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/scrollreveal.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/owl-carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/imgfix.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/jquery.counterup.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

<body class="">

  <!-- **** Loading Spinner **** -->
  <?= $this->include('Components/loadingSpinner'); ?>
  <!-- **** Alert info **** -->
  <?= $this->include('Components/alertInfo'); ?>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a class="logo">
              <img class="logo_nav" src="<?= base_url('assets/images/banksampah-logo.webp'); ?>" alt="" width="65" height="55">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
              <li class="scroll-to-section"><a href="#activity" class="menu-item">Kegiatan</a></li>
              <li class="scroll-to-section"><a href="#services" class="menu-item">Layanan</a></li>
              <li class="scroll-to-section"><a href="#contact-us" class="menu-item">Contact Us</a></li>
            </ul>
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

  <!-- ***** Welcome Area Start ***** -->
  <div class="welcome-area" id="welcome" style="background-image: url(<?= base_url('assets/images/banner-bg1.png'); ?>);">
    <div class="header-text">
      <div class="container">
        <div class="row">
          <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
            <h1> Bank Sampah Budi Luhur<em></em></h1>
            <p>Bank Sampah Budi Luhur diresmikan tanggal 17 April 2017, tujuan didirikan Bank Sampah Budi Luhur untuk
              membantu pemerintah mengurangi produksi pembuangan sampah dengan cara sosialisai sekaligus edukasi proses
              pemilihan sampah skala rumah tangga.</p>
            <a href="signup" class="main-button-slider">BERGABUNG</a>
            <a href="login" class="main-button-slider ml-1">LOGIN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Welcome Area End ***** -->

  <!-- Info Data Rubbish -->
  <section class="info rubbish">
    <div class="container">
      <h1 class="text-center pt-5 mb-4">Data Sampah</h1>
      <div id="totalSampahWraper" class="row">
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <span id="sampah-kertas" class="counter-value">0</span>
            <div class="counter-content">
              <h3>KG<br>Kertas</br></h3>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <span id="sampah-plastik" class="counter-value">0</span>
            <div class="counter-content">
              <h3>KG<br>Plastik</br></h3>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <span id="sampah-logam" class="counter-value">0</span>
            <div class="counter-content">
              <h3>KG<br>Logam</br></h3>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <span id="sampah-lain-lain" class="counter-value">0</span>
            <div class="counter-content">
              <h3>KG<br>Lain-Lain</br></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- ***** Activity Start ***** -->
  <section class="section" id="activity">
    <div class="container">
      <h1 class="text-center mb-5">Kegiatan Bank Sampah Budi Luhur</h1>
      <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
          <div class="features-item h-100">
            <div class="features-icon h-100">
              <!-- <h2>01</h2> -->
              <img src="<?= base_url('assets/images/features-icon-1.png'); ?>" alt="">
              <h4>WEBINAR</h4>
              <p>Curabitur pulvinar vel odio sed sagittis</p>
              <a href="<?= base_url('/homepage/webinar'); ?>" class="main-button">
                Read More
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
          <div class="features-item" style="height: 100%;">
            <div class="features-icon">
              <!-- <h2>02</h2> -->
              <img src="<?= base_url('assets/images/features-icon-2.png'); ?>" alt="">
              <h4>KKN</h4>
              <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              <a href="<?= base_url('/homepage/kkn'); ?>" class="main-button">
                Read More
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
          <div class="features-item" style="height: 100%;">
            <div class="features-icon">
              <img src="<?= base_url('assets/images/features-icon-3.png'); ?>" alt="">
              <h4>Sosialisasi & Edukasi</h4>
              <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              <a href="<?= base_url('/homepage/sosial%20dan%20edukasi'); ?>" class="main-button">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Features Big Item End ***** -->

  <!-- This tag is so bad kill other tag -->
  <div class="left-image-decor"></div>

  <!-- ***** Features Big Item Start ***** -->
  <section class="section" id="promotion">
    <div class="container">
      <div class="row">
        <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
          <img src="<?= base_url('assets/images/left-image.webp'); ?>" class="rounded img-fluid d-block mx-auto" alt="App">
        </div>
        <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
          <ul>
            <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
              <img src="assets/images/about-icon-01.png" alt="" />
              <div class="text">
                <h4>Mengurangi Sampah (Reduse)</h4>
                <p>Mengurangi penggunaan produk yang berpotensi menjadi sampah, karena penggunaan barang yang sulit
                  didaur ulang juga akan menjadi masalah baru
                </p>
              </div>
            </li>
            <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
              <img src="assets/images/about-icon-02.png" alt="" />
              <div class="text">
                <h4>Penggunaan Kembali (Reuse)</h4>
                <p>Penggunaan kembali adalah menggunakan lagi suatu barang lebih dari sekali. Ini mencakup
                  penggunaan kembali secara konvensional di mana barang dipakai lagi dengan fungsi yang sama,
                  dan penggunaan kembali di mana barang dipergunakan dengan fungsi yang berbeda.
                </p>
              </div>
            </li>
            <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
              <img src="assets/images/about-icon-03.png" alt="" />
              <div class="text">
                <h4>Daur Ulang (Recycle)</h4>
                <p>Daur ulang adalah proses untuk menjadikan suatu bahan bekas menjadi
                  bahan baru dengan tujuan mencegah adanya sampah yang sebenarnya dapat
                  menjadi sesuatu yang berguna
                </p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section class="service" id="services">
    <div class="right-image-decor"></div>
    <div class="container">
      <h1 class="text-center">Alur Layanan Bank Sampah</h1>
      <div class="row">
        <div class="col-md-12">
          <div class="main-timeline2">
            <div class="timeline">
              <span class="icon">1</span>
              <a class="timeline-content">
                <h3 class="title">Nasabah Melakukan Pendaftaran Akun Bank Sampah</h3>
              </a>
            </div>
            <div class="timeline">
              <span class="icon">2</span>
              <a class="timeline-content">
                <h3 class="title">Nasabah Melakukan Konsultasi Kepada Admin Bank Sampah</h3>
              </a>
            </div>
            <div class="timeline">
              <span class="icon">3</span>
              <a class="timeline-content">
                <h3 class="title">Nasabah Melakukan Penimbangan Sampah Dan Menabung Di Bank Sampah</h3>
              </a>
            </div>
            <div class="timeline">
              <span class="icon">4</span>
              <a class="timeline-content">
                <h3 class="title">Nasabah Mendapatkan Laporan Hasil Tabungan Di Bank Sampah</h3>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Services Ends -->

  <!-- ***** Hubungi Kami ***** -->
  <footer id="contact-us">
    <div class="container">
      <div class="footer-content">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="contact-form">
              <form id="contact">
                <div class="row">
                  <!-- name input -->
                  <div class="col-md-6 col-sm-12 mb-0 form-group position-relative">
                    <input id="contact-name" type="text" name="name" class="form-control" placeholder="Full Name" autocomplete="off" />
                    <small id="contact-name-error" class="error-message position-absolute text-danger" style="left: 16px;transform: translateY(-28px);"></small>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-0 form-group position-relative">
                    <input id="contact-email" type="text" name="email" class="form-control" placeholder="E-Mail Address" autocomplete="off" />
                    <small id="contact-email-error" class="error-message text-danger position-absolute" style="left: 16px;transform: translateY(-28px);"></small>
                  </div>
                  <div class="col-lg-12 form-group position-relative">
                    <textarea id="contact-message" name="message" rows="6" class="form-control position-relative" placeholder="Your Message"></textarea>
                    <small id="contact-message-error" class="error-message text-danger position-absolute" style="left: 16px;transform: translateY(-28px);"></small>
                  </div>
                  <div class="col-lg-12">
                    <button type="submit" id="form-submit" class="main-button">Send Message
                      Now</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- ***** Contact Form End ***** -->
          <div class="right-content col-lg-6 col-md-12 col-sm-12">
            <h2>Hubungi <em>Kami</em></h2>
            <p>Phasellus dapibus urna vel lacus accumsan, iaculis eleifend leo auctor. Duis at finibus odio.
              Vivamus ut pharetra arcu, in porta metus. Suspendisse blandit pulvinar ligula ut elementum.
              <br><br>If you need this contact form to send email to your inbox, you may follow our <a rel="nofollow" href="https://templatemo.com/contact" target="_parent">contact</a> page
              for more detail.
            </p>
            <ul class="social" style="text-align: left;">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com/banksampah.ubl/"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <!-- footer section starts  -->

  <footer class="">
    <div class="pt-5" style="background-image: url(assets/images/footer-bg.webp);background-repeat: no-repeat;background-size: cover;">
      <!-- <div class="widget_wrapper bg-danger" style=""> -->
      <div class="container-fluid px-5 pt-5 pt-lg-0">
        <div class="row mt-5 pb-5 px-4">

          <div class="col-12 col-md-2 mt-5 mt-md-0">
            <div class="widget widget_link">
              <h4 class="text-white" style="font-weight: bold;">Links</h4>
              <ul class="mt-4">
                <li class="pb-2"><a class="text-white" href="/">Home</a></li>
                <li class="pb-2"><a class="text-white" href="#activity">Kegiatan</a></li>
                <li class="pb-2"><a class="text-white" href="#services">Layanan</a></li>
                <li class="pb-2"><a class="text-white" href="#contact-us">Kontak Kami</a></li>
              </ul>
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
                  <div class="info d-flex flex-column">
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
                  <div class="info d-flex flex-column">
                    <a class="text-white" href="mailto:bankasampahbudiluhur@gmail.com">
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
                  <div class="info text-white">
                    Jl. H. Gaim No.50, RT.10/RW.2, Petukangan Utara, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah
                    Khusus Ibukota Jakarta.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-5 mt-5 mt-md-0">
            <div class="widget widegt_about">
              <h4 class="text-white" style="font-weight: bold;">Social media</h4>
              <p class="mt-4 text-white">
                "Kebersihan menjadi awal dari penilaian baik buruknya seseorang. Kepribadian yang baik
                akan menjaga kebersihan dirinya, lingkungannya, dan sekitarnya."
              </p>
              <ul class="social" style="text-align: left;">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/banksampah.ubl/"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid mt-5 py-3 d-flex justify-content-center">
        <p class="text-light">Copyright &copy; 2020 All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- footer section ends -->
</body>
<?= $this->endSection(); ?>