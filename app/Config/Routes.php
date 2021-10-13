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

$routes->group("nasabah", function ($routes) {
    $routes->post("register",     "Nasabah::register");
    $routes->post("verification", "Nasabah::verification");
    $routes->post("login",        "Nasabah::login");
    $routes->get("sessioncheck",  "Nasabah::sessionCheck");
    $routes->get("getprofile",    "Nasabah::getProfile");
    $routes->put("editprofile",   "Nasabah::editProfile");
    $routes->delete("logout",     "Nasabah::logout");
    $routes->get("getsaldo",      "Nasabah::getSaldo");
    $routes->post("sendkritik",   "Nasabah::sendKritik");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->group("admin", function ($routes) {
    $routes->post("login",           "Admin::login");
    $routes->get("sessioncheck",     "Admin::sessionCheck");
    $routes->get("getprofile",       "Admin::getProfile");
    $routes->put("editprofile",      "Admin::editProfile");
    $routes->delete("logout",        "Admin::logout");
    $routes->get("totalsaldo",       "Admin::getTotalSaldo");
    $routes->get("getnasabah",       "Admin::getNasabah");
    $routes->post("addnasabah",      "Admin::addNasabah");
    $routes->put("editnasabah",      "Admin::editNasabah");
    $routes->delete("deletenasabah", "Admin::deleteNasabah");
    $routes->get("getadmin",         "Admin::getAdmin");
    $routes->post("addadmin",        "Admin::addAdmin");
    $routes->put("editadmin",        "Admin::editAdmin");
    $routes->delete("deleteadmin",   "Admin::deleteAdmin");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->group("kategori_berita", function ($routes) {
    $routes->post("additem",      "KategoriBerita::addItem");
    $routes->get("getitem",       "KategoriBerita::getItem");
    $routes->delete("deleteitem", "KategoriBerita::deleteItem");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->group("berita_acara", function ($routes) {
    $routes->post("additem",      "BeritaAcara::addItem");
    $routes->get("getitem",       "BeritaAcara::getItem");
    $routes->put("edititem",      "BeritaAcara::editItem");
    $routes->delete("deleteitem", "BeritaAcara::deleteItem");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->group("kategori_sampah", function ($routes) {
    $routes->post("additem",      "KategoriSampah::addItem");
    $routes->get("getitem",       "KategoriSampah::getItem");
    $routes->delete("deleteitem", "KategoriSampah::deleteItem");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->group("sampah", function ($routes) {
    $routes->post("additem",      "Sampah::addItem");
    $routes->get("getitem",       "Sampah::getItem");
    $routes->get("totalitem",     "Sampah::totalItem");
    $routes->put("edititem",      "Sampah::editItem");
    $routes->delete("deleteitem", "Sampah::deleteItem");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->group("transaksi", function ($routes) {
    $routes->post("setorsampah", "Transaksi::setorSampah");
    $routes->post("tariksaldo",  "Transaksi::tarikSaldo");
    $routes->get("getdata",      "Transaksi::getData");
    $routes->post("pindahsaldo", "Transaksi::pindahSaldo");
    $routes->add("(:any)",        "Notfound::MethodNf");
});

$routes->add('/',       'Home::index');
$routes->add('/(:any)', 'Notfound::ControllerNf');

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
