<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
  <style>
    #mitra .img_skeleton{
      width: 130px;
      height: 130px;
      border-radius: 50%;
    }
    #mitra .name_skeleton{
      width: 200px;
      height: 20px;
      margin-top: 20px;
      border-radius: 10px;
    }
    .skeleton{
      background: rgb(193, 217, 102) !important;
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
      0%, 100% {
        opacity: .8;
      }
      50% {
        opacity: .5;
      }
    }

    @media (max-width:992px) {
      body {
        overflow: hidden;
      }
      #contact-us #left-side{
        order: 2;
      }
      #contact-us #right-side{
        order: 1;
      }

    }
  </style>
  <!-- ** develoment ** -->
  <!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>"> -->
  <!-- ** production ** -->
  <link rel="stylesheet" href="<?= base_url('assets/css/purge/bootstrap/homepage.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/homepage.min.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
<script src="<?= base_url('assets/js/plugins/font-awesome.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/scrollreveal.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/imgfix.min.js'); ?>"></script>
<script src="https://apps.elfsight.com/p/platform.js"></script>
<script src="<?= base_url('assets/js/plugins/jquery.counterup.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/homepage.min.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

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
              <li class="scroll-to-section"><a href="#mitra" class="menu-item">Mitra</a></li>
              <li class="scroll-to-section"><a href="<?= base_url('penghargaan'); ?>" class="menu-item">Penghargaan</a></li>
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
  <div class="welcome-area" id="welcome" style="background-image: url(<?= base_url('assets/images/banner-bg1.webp'); ?>);">
    <div class="header-text">
      <div class="container">
        <div class="row">
          <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
            <h1> Bank Sampah Budi Luhur<em></em></h1>
            <p>Bank Sampah Budi Luhur diresmikan tanggal 17 April 2017, tujuan didirikan Bank Sampah Budi Luhur untuk
              membantu pemerintah mengurangi produksi pembuangan sampah dengan cara sosialisai sekaligus edukasi proses
              pemilihan sampah skala rumah tangga.</p>
            <a href="<?= base_url('register'); ?>" class="main-button-slider">BERGABUNG</a>
            <a href="<?= base_url('login'); ?>" class="main-button-slider ml-1">LOGIN</a>
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

        <div class="card-activity col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
          <div class="features-item skeleton h-100">
            <div class="features-icon h-100 d-flex flex-column align-items-center">
              <img class="icon" style="min-width: 80px;min-height: 80px;max-width: 80px;max-height: 80px;" src="" alt="">
              <h4 class="name" style="text-transform:uppercase;">
                WEBINAR
              </h4>
              <p class="description" style="flex: 1;">
                Curabitur pulvinar vel odio sed sagittis
              </p>
              <div class="button">
                <a href="<?= base_url('/homepage/webinar'); ?>" class="main-button">
                  Read More
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="card-activity col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4" data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
          <div class="features-item skeleton h-100">
            <div class="features-icon h-100 d-flex flex-column align-items-center">
              <!-- <h2>02</h2> -->
              <img class="icon" style="min-width: 80px;min-height: 80px;max-width: 80px;max-height: 80px;" src="" alt="">
              <h4 class="name" style="text-transform:uppercase;">
                KKN
              </h4>
              <p class="description" style="flex: 1;">
                Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.
              </p>
              
              <div class="button">
                <a href="<?= base_url('/homepage/kkn'); ?>" class="main-button">
                  Read More
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="card-activity col-md-12 col-lg-4 mb-md-4" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
          <div class="features-item skeleton h-100">
            <div class="features-icon h-100 d-flex flex-column align-items-center">
              <img class="icon" style="min-width: 80px;min-height: 80px;max-width: 80px;max-height: 80px;" src="" alt="">
              <h4 class="name" style="text-transform:uppercase;">
                Sosialisasi & Edukasi
              </h4>
              <p class="description" style="flex: 1;">
                Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.
              </p>
              
              <div class="button">
                <a href="<?= base_url('/homepage/sosial%20dan%20edukasi'); ?>" class="main-button">
                  Read More
                </a>
              </div>
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

  <!-- Mitra -->
  <div id="mitra" style="padding: 0 40px;margin-top:200px;">
    <h1 class="text-center mb-5 mt-5">Mitra Kami</h1>
    <div class="row justify-content-center align-items-center" id="container-mitra">
				<?php for ($i=0; $i < 6; $i++) { ?>
					<div class="col-12 col-sm-6 col-md-4 mb-5 h-100">
            <div class="card h-100" style="display:flex;flex-direction:column;justify-content:center;align-items:center;border:none;">
              <div class="img_skeleton skeleton"></div>
              <p class="name_skeleton skeleton"></p>
            </div>
          </div>
				<?php } ?>
    </div>
  </div>

  <!-- Instagram Feed -->
  <div style="padding: 0 40px;margin-top:80px;">
    <h1 class="text-center mb-5 mt-5">Ikuti Instagram Kami</h1>
    <div style="width: 100%;" class="elfsight-app-af63f7fb-2dc8-43cf-ac87-f3967815b740"></div>
  </div>

  <!-- Social Media Icon Fixed -->
  <div class="elfsight-app-5efed99f-297e-4eae-bda8-d9bb2b6ef831"></div>

  <div style="padding: 0 40px;margin-top:140px;">
    <h1 class="text-center mb-5 mt-5">Lokasi kami</h1>
    <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=budiluhur&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}</style><a href="https://www.embedgooglemap.net">google map in website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></div>
  </div>

  <!-- ***** Hubungi Kami ***** -->
  <footer id="contact-us">
    <div class="container">
      <div class="footer-content">
        <div class="row d-flex">
          <div id="left-side" class="col-lg-6 col-md-12 col-sm-12 mt-5 mt-sm-0">
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
          <div id="right-side" class="right-content col-lg-6 col-md-12 col-sm-12 ">
            <h2>Hubungi <em>Kami</em></h2>
            <p>
              Jika anda perlu menghubungi kami melalui email, anda dapat mengisi form ini
            </p>
            <ul class="social">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com/banksampah.ubl/"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </footer>

	<!-- **** footer artikiel **** -->
	<?= $this->include('Components/artikelFooter'); ?>
  
<?= $this->endSection(); ?>