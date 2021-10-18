<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
  <link rel="stylesheet" href="assets/css/SignUp.css">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/signup.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

  <!-- **** Loading Spinner **** -->
  <?= $this->include('Components/loadingSpinner'); ?>
  <!-- **** Alert Info **** -->
  <?= $this->include('Components/alertInfo'); ?>

  <div class="container">
    <div class="row py-5 mt-4 align-items-center">
      <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
        <img src="assets/images/left-image.png" alt="" class="img-fluid mb-3 d-none d-md-block" />
        <h1>Buat Akun Bank Sampah</h1>
        <p class="font-italic text-muted mb-0">Mari bergabung bersama kami demi lingkungan
          yang lebih baik</p>
      </div>
      <div class="col-md-7 col-lg-6 ml-auto">
        <form id="formRegister">
          <div class="row">
            <!-- **** nama lengkap **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray px-4 border-md border-right-0">
                    <i class="fa fa-user text-muted"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="nama-regist" name="nama_lengkap" autocomplete="off" placeholder="Masukan nama lengkap anda">
              </div>
              <small
                id="nama-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** username **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray px-4 border-md border-right-0">
                    <i class="fa fa-user text-muted"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="username-regist" name="username" autocomplete="off" placeholder="Masukan username anda">
              </div>
              <small
                id="username-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** email **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray px-4 border-md border-right-0">
                    <i class="fa fa-envelope text-muted"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="email-regist" name="email" autocomplete="off" placeholder="Masukan email anda">
              </div>
              <small
                id="email-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** password **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray border-md border-right-0" style="padding-left: 1.66rem;padding-right: 1.66rem;">
                  <i class="fa fa-lock text-muted"></i>
                  </span>
                </div>
                <input type="password" class="form-control" id="password-regist" name="password" autocomplete="off" placeholder="Masukan password">
              </div>
              <small
                id="password-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** tgl lahir **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray border-md border-right-0" style="padding: 1rem 1.55rem;">
                    <i class="fas fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="date" class="form-control h-100" id="tgllahir-regist" name="tgl_lahir">
              </div>
              <small
                id="tgllahir-regist-error"
                class="text-danger"></small>
            </div>
            <div class="input-group col-lg-6 mb-4 form-group">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="kelamin" id="kelamin-laki" value="laki-laki" />
                <label class="form-check-label" for="kelamin-laki">
                  Laki Laki
                </label>
              </div>
              <small
                id="kelamin-regist-error"
                class="text-danger"></small>
            </div>
            <div class="input-group col-lg-6 mb-4 form-group">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="kelamin" id="kelamin-perempuan" value="perempuan" />
                <label class="form-check-label" for="kelamin-perempuan">
                  Perempuan
                </label>
              </div>
              <small
                id="kelamin-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** RW **** -->
            <div class="input-group col-lg-6 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray px-4 border-md border-right-0">
                    <i class="fas fa-home"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="rw-regist" name="rw" autocomplete="off" placeholder="RW">
              </div>
              <small
                id="rw-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** RT **** -->
            <div class="input-group col-lg-6 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray px-4 border-md border-right-0">
                    <i class="fas fa-home"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="rt-regist" name="rt" autocomplete="off" placeholder="RT">
              </div>
              <small
                id="rt-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** CODE POS **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray px-4 border-md border-right-0">
                    <i class="fas fa-home"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="kodepos-regist" name="kodepos" autocomplete="off" placeholder="KODE POS">
              </div>
              <small
                id="kodepos-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** alamat **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray border-md border-right-0" style="padding-left: 1.66rem;padding-right: 1.66rem;">
                    <i class="fas fa-map-marker-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="alamat-regist" name="alamat" autocomplete="off" placeholder="Masukan alamat lengkap anda">
              </div>
              <small
                id="alamat-regist-error"
                class="text-danger"></small>
            </div>
            <!-- **** no telp **** -->
            <div class="input-group col-lg-12 mb-4 form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-gray border-md border-right-0" style="padding-left: 1.66rem;padding-right: 1.66rem;">
                  <i class="fa fa-phone-square"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="notelp-regist" name="notelp" autocomplete="off" placeholder="Masukan no.telp anda">
              </div>
              <small
                id="notelp-regist-error"
                class="text-danger"></small>
            </div>
            <div class="form-group col-lg-12 mx-auto mb-0">
              <button type="submit" class="btn btn-success btn-block py-2 btn-costum">
                <span class="font-weight-bold">Buat Akun</span>
              </button>
            </div>
            <div class="text-center w-100 mt-4">
              <p class="text-muted font-weight-bold">Apakah Sudah Memiliki Akun? <a href="login"
                  class="text-primary ml-2">Login</a>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?= $this->endSection(); ?>