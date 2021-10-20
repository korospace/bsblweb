<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/flex-slider.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/index.css'); ?>">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
  <script src="<?= base_url('assets/js/scrollreveal.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/waypoints.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/owl-carousel.js'); ?>"></script>
  <script src="<?= base_url('assets/js/imgfix.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/jquery.counterup.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/homePage.js'); ?>"></script>
<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

  <body>

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
                <img class="logo_nav" src="assets/images/banksampah-logo.png" alt="" width="65" height="55">
              </a>
              <!-- ***** Logo End ***** -->
              <!-- ***** Menu Start ***** -->
              <ul class="nav">
                <li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
                <!-- <li class="submenu">
                    <a href="javascript:;">Profile</a>
                    <ul>
                      <li><a href="" class="menu-item">About Us</a></li>
                      <li><a href="" class="menu-item">Features</a></li>
                      <li><a href="" class="menu-item">FAQ's</a></li>
                      <li><a href="" class="menu-item">Blog</a></li>
                    </ul>
                  </li> -->
                <li class="scroll-to-section"><a href="#activity" class="menu-item">Kegiatan</a></li>
                <!-- <li class="scroll-to-section"><a href="#testimonials" class="menu-item">Testimonials</a></li> -->
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
    <div class="welcome-area" id="welcome">
      <div class="header-text">
        <div class="container">
          <div class="row">
            <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12"
              data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
              <h1> Bank Sampah Budi Luhur<em></em></h1>
              <p>Bank Sampah Budi Luhur diresmikan tanggal 17 April 2017, tujuan didirikan Bank Sampah Budi Luhur untuk
                membantu pemerintah mengurangi produksi pembuangan sampah dengan cara sosialisai sekaligus edukasi proses
                pemilihan sampah skala rumah tangga.</p>
              <a href="signup" class="main-button-slider">BERGABUNG</a>
              <a href="login" class="main-button-slider">LOGIN</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ***** Welcome Area End ***** -->

      <!-- Info Data Rubbish -->
      <section class="info rubbish">
        <div class="container">
          <h1 class="text-center">Data Sampah</h1>
          <div id="totalSampahWraper" class="row">
            <div class="col-md-3 col-sm-6">
              <div class="counter">
                <span class="counter-value">0</span>
                <div class="counter-content">
                  <h3>KG<br>Kertas</br></h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="counter">
                <span class="counter-value">0</span>
                <div class="counter-content">
                  <h3>KG<br>Plastik</br></h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="counter">
                <span class="counter-value">0</span>
                <div class="counter-content">
                  <h3>KG<br>Logam</br></h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="counter">
                <span class="counter-value">0</span>
                <div class="counter-content">
                  <h3>KG<br>Lain-Lain</br></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- End Info Data Rubbish -->

    <!-- ***** Activity Start ***** -->
    <section class="section" id="activity">
      <div class="container">
        <h1 class="text-center">Kegiatan Bank Sampah Budi Luhur</h1>
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
            data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
            <div class="features-item">
              <div class="features-icon">
                <!-- <h2>01</h2> -->
                <img src="assets/images/features-icon-1.png" alt="">
                <h4>WEBINAR</h4>
                <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
                <a href="<?= base_url('/');?>" class="main-button">
                  Read More
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
            data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
            <div class="features-item">
              <div class="features-icon">
                <!-- <h2>02</h2> -->
                <img src="assets/images/features-icon-2.png" alt="">
                <h4>KKN</h4>
                <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
                <a href="Card-info.php" class="main-button">
                  Read More
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
            data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
            <div class="features-item">
              <div class="features-icon">
                <img src="assets/images/features-icon-3.png" alt="">
                <h4>PSL</h4>
                <p>Curabitur pulvinar vel odio sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
                <a href="dashboard/nasabah" class="main-button">
                  Read More
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="left-image-decor"></div>

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="promotion">
      <div class="container">
        <div class="row">
          <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
            data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
            <img src="assets/images/left-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
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
          <h1 class="text-center">Hubungi Kami</h1>
          <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
              <div class="contact-form">
                <form id="contact">
                  <div class="row">
                    <!-- name input -->
                    <div class="col-md-6 col-sm-12 mb-0 form-group position-relative">
                        <input
                          id="contact-name" 
                          type="text"
                          name="name" 
                          class="form-control" 
                          placeholder="Full Name" 
                          autocomplete="off" />
                          <small id="contact-name-error"class="error-message position-absolute text-danger" style="left: 16px;transform: translateY(-28px);"></small>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-0 form-group position-relative">
                        <input 
                          id="contact-email"
                          type="text" 
                          name="email" 
                          class="form-control" 
                          placeholder="E-Mail Address"
                          autocomplete="off"/>
                          <small id="contact-email-error"class="error-message text-danger position-absolute" style="left: 16px;transform: translateY(-28px);"></small>
                    </div>
                    <div class="col-lg-12 form-group position-relative">
                        <textarea 
                          id="contact-message" 
                          name="message" 
                          rows="6" 
                          class="form-control position-relative"
                          placeholder="Your Message"
                          ></textarea>
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
              <h2>More About <em>Lorem ipmsum</em></h2>
              <p>Phasellus dapibus urna vel lacus accumsan, iaculis eleifend leo auctor. Duis at finibus odio.
                Vivamus ut pharetra arcu, in porta metus. Suspendisse blandit pulvinar ligula ut elementum.
                <br><br>If you need this contact form to send email to your inbox, you may follow our <a rel="nofollow"
                  href="https://templatemo.com/contact" target="_parent">contact</a> page
                for more detail.</p>
            </div>
          </div>
        </div>
      </div>
      
    </footer>

    <!-- footer section starts  -->

    <div class="footer">
      <div class="box-container">
        <div class="box">
          <h3>about us</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet pariatur rerum consectetur architecto
            ad
            tempora blanditiis quo aliquid inventore a.</p>
        </div>
        <div class="box">
          <h3>quick links</h3>
          <a href="#welcome">Home</a>
          <a href="#activity">Kegiatan</a>
          <a href="#services">Layanan</a>
          <a href="#contact-us">Contact Us</a>
        </div>
        <div class="box">
          <h3>follow us</h3>
          <a href="#">facebook</a>
          <a href="#">instagram</a>
          <a href="#">pinterest</a>
          <a href="#">twitter</a>
        </div>
        <div class="box">
          <h3>contact info</h3>
          <div class="info">
            <i class="fas fa-phone"></i>
            <p> +62-456-7890 <br> +62-2222-333 </p>
          </div>
          <div class="info">
            <i class="fas fa-envelope"></i>
            <p> example@gmail.com <br> example@gmail.com </p>
          </div>
          <div class="info">
            <i class="fas fa-map-marker-alt"></i>
            <p> Jakarta, Indonesia - 12260 </p>
          </div>
        </div>
      </div>
      <h1 class="credit"> &copy; copyright @BankSampahBudiLuhur </h1>
    </div>

    <!-- footer section ends -->
  </body>
<?= $this->endSection(); ?>