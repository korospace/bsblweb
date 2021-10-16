<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/SignUp.css">
<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>
  <script src="assets/js/jquery-2.1.0.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/scrollreveal.min.js"></script>
  <script src="assets/js/waypoints.min.js"></script>
  <script src="assets/js/jquery.counterup.min.js"></script>
  <script src="assets/js/imgfix.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/signup.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

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
          <div class="input-group col-lg-12 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fa fa-user text-muted"></i>
              </span>
            </div>
            <input id="firstName" type="text" name="nama_lengkap" placeholder="Masukan Nama Lengkap"
              class="form-control bg-white border-left-0 border-md"
              required   
            />
              <small
                id="nama-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-12 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fa fa-user text-muted"></i>
              </span>
            </div>
            <input id="firstName" type="text" name="username" placeholder="Masukan Username Anda"
              class="form-control bg-white border-left-0 border-md"
              required
              />
              <small
                id="username-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-12 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fa fa-envelope text-muted"></i>
              </span>
            </div>
            <input id="email" type="email" name="email" placeholder="Masukan Email Yang Terdaftar"
              class="form-control bg-white border-left-0 border-md" 
              required data-email
              />
              <small
                id="email-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-12 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fas fa-calendar-alt"></i>
              </span>
            </div>
            <input id="Date" type="date" name="tgl_lahir" placeholder="RW"
              class="form-control bg-white border-left-0 border-md" required/>
              <small
                id="tgl-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-6 mb-4 form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="kelamin" id="flexRadioDefault1" value="laki-laki"
              required />
              <label class="form-check-label" for="flexRadioDefault1">
                Laki Laki
              </label>
            </div>
            <small
              id="kelamin-nasabah-error"
              class="position-absolute text-danger"></small>
            <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-6 mb-4 form-group">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="kelamin" id="flexRadioDefault2" value="perempuan" 
              required />
              <label class="form-check-label" for="flexRadioDefault2">
                Perempuan
              </label>
            </div>
            <small
              id="kelamin-nasabah-error"
              class="position-absolute text-danger"></small>
            <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-12 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fas fa-map-marker-alt"></i>
              </span>
            </div>
            <input id="Address" type="add" name="alamat" placeholder="Alamat"
              class="form-control bg-white border-md border-left-0 pl-3"
              required />
              <small
                id="alamat-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-6 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fas fa-home"></i>
              </span>
            </div>
            <input id="rw" name="rw" placeholder="RW" class="form-control bg-white border-left-0 border-md" 
            required />
            <small
              id="rw-nasabah-error"
              class="position-absolute text-danger"></small>
            <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-6 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fas fa-home"></i>
              </span>
            </div>
            <input id="rt" name="rt" placeholder="RT" class="form-control bg-white border-left-0 border-md" 
            required />
            <small
                id="rt-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-6 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fas fa-home"></i>
              </span>
            </div>
            <input id="kodepos" name="kodepos" placeholder="KODE POS"
              class="form-control bg-white border-left-0 border-md" 
              required />
            <small
              id="kodepos-nasabah-error"
              class="position-absolute text-danger"></small>
            <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-6 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fa fa-phone-square"></i>
              </span>
            </div>
            <input id="hp" name="notelp" placeholder="Nomer Handphone"
              class="form-control bg-white border-left-0 border-md" required />
            <small
              id="notelp-nasabah-error"
              class="position-absolute text-danger"></small>
            <div class="invalid-feedback"></div>
          </div>
          <div class="input-group col-lg-12 mb-4 form-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white px-4 border-md border-right-0">
                <i class="fa fa-lock text-muted"></i>
              </span>
            </div>
            <input id="password" type="password" name="password" placeholder="Masukan Password"
              class="form-control bg-white border-left-0 border-md" required />
              <small
                id="password-nasabah-error"
                class="position-absolute text-danger"></small>
              <div class="invalid-feedback"></div>
          </div>
          <div class="form-group col-lg-12 mx-auto mb-0">
            <button type="submit" class="btn btn-success btn-block py-2 btn-costum">
              <span class="font-weight-bold">Buat Akun</span>
            </button>
          </div>
          <div class="text-center w-100">
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