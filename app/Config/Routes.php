<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->add('/',                'HomePage::index');
$routes->add('/homepage/(:any)', 'HomePage::listArtikel/$1');
$routes->add('/artikel/(:any)',  'HomePage::detilArtikel/$1');

$routes->group("register", function ($routes) {
    // VIEWS
    $routes->add('/',        'Register::registerNasabahView');
    // API
    $routes->post("nasabah", 'Register::nasabahRegister');
    $routes->post("admin",   'Register::adminRegister');
    $routes->add("(:any)",   "Notfound::PageNotFound");
});

$routes->group("otp", function ($routes) {
    // VIEWS
    $routes->add('/',       'Otp::otpView');
    // API
    $routes->post("verify", 'Otp::verifyOtp');
    $routes->add("(:any)",  "Notfound::PageNotFound");
});

$routes->group("login", function ($routes) {
    // VIEWS
    $routes->add('/',           'Login::nasabahLoginView');
    $routes->add('admin',       'Login::adminLoginView');
    // API
    $routes->post("forgotpass", 'Login::forgotPassword');
    $routes->post("nasabah",    'Login::nasabahLogin');
    $routes->post("admin",      'Login::adminLogin');
    $routes->add("(:any)",      "Notfound::PageNotFound");
});

$routes->group("nasabah", function ($routes) {
    // VIEWS
    $routes->add('/',                    'Nasabah::dashboardNasabah');
    $routes->add('profile',              'Nasabah::profileNasabah');
    // API
    $routes->get("sessioncheck",  "Nasabah::sessionCheck");
    $routes->get("getprofile",    "Nasabah::getProfile");
    $routes->put("editprofile",   "Nasabah::editProfile");
    $routes->delete("logout",     "Nasabah::logout");
    $routes->get("getsaldo",      "Nasabah::getSaldo");
    $routes->get('wilayah',      'Nasabah::getWilayah');
    $routes->post('sendkritik',   'Nasabah::sendKritik');
    $routes->add("(:any)",        "Notfound::PageNotFound");
});

$routes->group("admin", function ($routes) {
    // VIEWS
    $routes->add('/',                  'Admin::dashboardAdmin');
    $routes->add('transaksi',          'Admin::transaksiPage');
    $routes->add('listsampah',         'Admin::listSampahView');
    $routes->add('listadmin',          'Admin::listAdminView');
    $routes->add('listartikel',        'Admin::listArtikelView');
    $routes->add('listnasabah',        'Admin::listNasabahView');
    $routes->add('detilnasabah/(:any)','Admin::detilNasabahView/$1');
    $routes->add('addartikel',         'Admin::addArtikelView');
    $routes->add('editartikel/(:any)', 'Admin::editArtikelView/$1');
    $routes->add('profile',            'Admin::profileAdmin');
    // API
    $routes->post("login",           "Admin::login");
    $routes->post("confirmdelete",   "Admin::confirmDelete");
    $routes->get("sessioncheck",     "Admin::sessionCheck");
    $routes->get("getprofile",       "Admin::getProfile");
    $routes->put("editprofile",      "Admin::editProfile");
    $routes->delete("logout",        "Admin::logout");
    $routes->get("getnasabah",       "Admin::getNasabah");
    $routes->post("addnasabah",      "Admin::addNasabah");
    $routes->put("editnasabah",      "Admin::editNasabah");
    $routes->delete("deletenasabah", "Admin::deleteNasabah");
    $routes->get("getadmin",         "Admin::getAdmin");
    $routes->put("editadmin",        "Admin::editAdmin");
    $routes->delete("deleteadmin",   "Admin::deleteAdmin");
    $routes->add("(:any)",           "Notfound::PageNotFound");
});

$routes->group("artikel", function ($routes) {
    $routes->post("addkategori",      "Kategori::addKategori/kategori_artikel");
    $routes->delete("deletekategori", "Kategori::deleteKategori/kategori_artikel");
    $routes->get("getkategori",       "Kategori::getKategori/kategori_artikel");
    $routes->post("addartikel",       "Artikel::addArtikel");
    $routes->put("editartikel",       "Artikel::editArtikel");
    $routes->delete("deleteartikel",  "Artikel::deleteArtikel");
    $routes->get("getartikel",        "Artikel::getArtikel");
    $routes->get("relatedartikel",    "Artikel::getRelatedArtikel");
    $routes->add("(:any)",            "Notfound::PageNotFound");
});

$routes->group("sampah", function ($routes) {
    $routes->post("addkategori",      "Kategori::addKategori/kategori_sampah");
    $routes->delete("deletekategori", "Kategori::deleteKategori/kategori_sampah");
    $routes->get("getkategori",       "Kategori::getKategori/kategori_sampah");
    $routes->post("addsampah",        "Sampah::addSampah");
    $routes->put("editsampah",        "Sampah::editSampah");
    $routes->delete("deletesampah",   "Sampah::deleteSampah");
    $routes->get("getsampah",         "Sampah::getSampah");
    $routes->add("(:any)",            "Notfound::PageNotFound");
});


$routes->group("transaksi", function ($routes) {
    $routes->add('cetaktransaksi/(:any)','Transaksi::cetakTransaksi/$1');
    $routes->add('cetakrekap',           'Transaksi::cetakRekap');
    //API
    $routes->post("setorsampah",  "Transaksi::setorSampah");
    $routes->post("tariksaldo",   "Transaksi::tarikSaldo");
    $routes->post("pindahsaldo",  "Transaksi::pindahSaldo");
    $routes->post("jualsampah",   "Transaksi::jualSampah");
    $routes->get("sampahmasuk",   "Transaksi::getSampahMasuk");
    $routes->get("getsaldo",      "Transaksi::getSaldo");
    $routes->get("getdata",       "Transaksi::getData");
    $routes->get("rekapdata",     "Transaksi::rekapData");
    $routes->get("grafikssampah", "Transaksi::grafikSetorSampah");
    $routes->delete("deletedata", "Transaksi::deleteData");
    $routes->add("(:any)",        "Notfound::PageNotFound");
});

$routes->add('/(:any)', 'Notfound::PageNotFound');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
