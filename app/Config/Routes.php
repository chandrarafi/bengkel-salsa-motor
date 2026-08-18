<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Landing::index');

// Auth routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');

// Dashboard protected route (Admin & Pimpinan)
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Customer Area (Pelanggan) Routes
$routes->group('pelanggan', ['filter' => 'auth'], static function ($routes) {
    $routes->get('profil', 'Pelanggan::profil');
    $routes->post('profil/update', 'Pelanggan::updateProfil');
    $routes->post('profil/password', 'Pelanggan::updatePassword');
    $routes->get('riwayat', 'Pelanggan::riwayat');
    $routes->get('riwayat/detail/(:segment)', 'Pelanggan::detailServis/$1');
    $routes->get('riwayat/cetak/(:segment)', 'Pelanggan::cetakNota/$1');

    // Booking Servis
    $routes->get('booking', 'Pelanggan::booking');
    $routes->post('booking/simpan', 'Pelanggan::simpanBooking');
    $routes->get('booking/pembayaran/(:num)', 'Pelanggan::pembayaranBooking/$1');
    $routes->post('booking/proses-pembayaran', 'Pelanggan::prosesPembayaranBooking');
    $routes->post('booking/expirate', 'Pelanggan::expirateBooking');
    $routes->get('riwayat-booking', 'Pelanggan::riwayatBooking');
    $routes->post('booking/upload-ulang', 'Pelanggan::uploadUlangBukti');
    $routes->get('booking/batal/(:num)', 'Pelanggan::batalBooking/$1');
});

$routes->get('profil', 'Pelanggan::profil', ['filter' => 'auth']);
$routes->post('profil/update', 'Pelanggan::updateProfil', ['filter' => 'auth']);
$routes->post('profil/password', 'Pelanggan::updatePassword', ['filter' => 'auth']);
$routes->get('riwayat-servis', 'Pelanggan::riwayat', ['filter' => 'auth']);
$routes->get('riwayat-servis/detail/(:segment)', 'Pelanggan::detailServis/$1', ['filter' => 'auth']);
$routes->get('riwayat-servis/cetak/(:segment)', 'Pelanggan::cetakNota/$1', ['filter' => 'auth']);

$routes->get('booking', 'Pelanggan::booking', ['filter' => 'auth']);
$routes->post('booking/simpan', 'Pelanggan::simpanBooking', ['filter' => 'auth']);
$routes->get('booking/pembayaran/(:num)', 'Pelanggan::pembayaranBooking/$1', ['filter' => 'auth']);
$routes->post('booking/proses-pembayaran', 'Pelanggan::prosesPembayaranBooking', ['filter' => 'auth']);
$routes->post('booking/expirate', 'Pelanggan::expirateBooking', ['filter' => 'auth']);
$routes->get('riwayat-booking', 'Pelanggan::riwayatBooking', ['filter' => 'auth']);

// Admin Route Group (Admin only)
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    // User Management routes
    $routes->group('users', static function ($routes) {
        $routes->get('/', 'Users::index');
        $routes->get('create', 'Users::create');
        $routes->post('store', 'Users::store');
        $routes->get('edit/(:num)', 'Users::edit/$1');
        $routes->post('update/(:num)', 'Users::update/$1');
        $routes->get('delete/(:num)', 'Users::delete/$1');
        $routes->post('delete/(:num)', 'Users::delete/$1');
    });

    // Kategori Management routes
    $routes->group('kategori', static function ($routes) {
        $routes->get('/', 'Kategori::index');
        $routes->get('create', 'Kategori::create');
        $routes->post('store', 'Kategori::store');
        $routes->get('edit/(:num)', 'Kategori::edit/$1');
        $routes->post('update/(:num)', 'Kategori::update/$1');
        $routes->get('delete/(:num)', 'Kategori::delete/$1');
        $routes->post('delete/(:num)', 'Kategori::delete/$1');
    });

    // Satuan Management routes
    $routes->group('satuan', static function ($routes) {
        $routes->get('/', 'Satuan::index');
        $routes->get('create', 'Satuan::create');
        $routes->post('store', 'Satuan::store');
        $routes->get('edit/(:num)', 'Satuan::edit/$1');
        $routes->post('update/(:num)', 'Satuan::update/$1');
        $routes->get('delete/(:num)', 'Satuan::delete/$1');
        $routes->post('delete/(:num)', 'Satuan::delete/$1');
    });

    // Barang Management routes
    $routes->group('barang', static function ($routes) {
        $routes->get('/', 'Barang::index');
        $routes->get('create', 'Barang::create');
        $routes->post('store', 'Barang::store');
        $routes->get('edit/(:segment)', 'Barang::edit/$1');
        $routes->post('update/(:segment)', 'Barang::update/$1');
        $routes->get('delete/(:segment)', 'Barang::delete/$1');
        $routes->post('delete/(:segment)', 'Barang::delete/$1');
    });

    // Servis Management routes
    $routes->group('servis', static function ($routes) {
        $routes->get('/', 'Servis::index');
        $routes->get('create', 'Servis::create');
        $routes->post('store', 'Servis::store');
        $routes->get('edit/(:segment)', 'Servis::edit/$1');
        $routes->post('update/(:segment)', 'Servis::update/$1');
        $routes->get('delete/(:segment)', 'Servis::delete/$1');
        $routes->post('delete/(:segment)', 'Servis::delete/$1');
    });

    // Barang Masuk (Stock In Transaction) routes
    $routes->group('barangmasuk', static function ($routes) {
        $routes->get('/', 'BarangMasuk::index');
        $routes->get('create', 'BarangMasuk::create');
        $routes->post('store', 'BarangMasuk::store');
        $routes->get('edit/(:segment)', 'BarangMasuk::edit/$1');
        $routes->post('update/(:segment)', 'BarangMasuk::update/$1');
        $routes->get('cetak/(:segment)', 'BarangMasuk::cetak/$1');
        $routes->post('addTemp', 'BarangMasuk::addTemp');
        $routes->get('getTemp', 'BarangMasuk::getTemp');
        $routes->post('deleteTemp', 'BarangMasuk::deleteTemp');
        $routes->get('detail/(:segment)', 'BarangMasuk::detail/$1');
        $routes->get('delete/(:segment)', 'BarangMasuk::delete/$1');
        $routes->post('delete/(:segment)', 'BarangMasuk::delete/$1');
    });

    // Penjualan Barang (Sales Transaction / POS) routes
    $routes->group('penjualan', static function ($routes) {
        $routes->get('/', 'Penjualan::index');
        $routes->get('create', 'Penjualan::create');
        $routes->post('store', 'Penjualan::store');
        $routes->get('edit/(:segment)', 'Penjualan::edit/$1');
        $routes->post('update/(:segment)', 'Penjualan::update/$1');
        $routes->get('cetak/(:segment)', 'Penjualan::cetak/$1');
        $routes->post('addTemp', 'Penjualan::addTemp');
        $routes->get('getTemp', 'Penjualan::getTemp');
        $routes->post('deleteTemp', 'Penjualan::deleteTemp');
        $routes->get('detail/(:segment)', 'Penjualan::detail/$1');
        $routes->get('show/(:segment)', 'Penjualan::show/$1');
        $routes->post('pay', 'Penjualan::pay');
        $routes->get('delete/(:segment)', 'Penjualan::delete/$1');
        $routes->post('delete/(:segment)', 'Penjualan::delete/$1');
    });

    // Transaksi Servis (Work Order & Service POS) routes
    $routes->group('transaksiservis', static function ($routes) {
        $routes->get('/', 'TransaksiServis::index');
        $routes->get('create', 'TransaksiServis::create');
        $routes->get('proses-booking/(:num)', 'TransaksiServis::prosesBooking/$1');
        $routes->post('store', 'TransaksiServis::store');
        $routes->get('edit/(:segment)', 'TransaksiServis::edit/$1');
        $routes->post('update/(:segment)', 'TransaksiServis::update/$1');
        $routes->get('show/(:segment)', 'TransaksiServis::show/$1');
        $routes->get('cetak/(:segment)', 'TransaksiServis::cetak/$1');
        $routes->post('addTemp', 'TransaksiServis::addTemp');
        $routes->get('getTemp', 'TransaksiServis::getTemp');
        $routes->post('deleteTemp', 'TransaksiServis::deleteTemp');
        $routes->post('pay', 'TransaksiServis::pay');
        $routes->post('updateStatus', 'TransaksiServis::updateStatus');
        $routes->get('delete/(:segment)', 'TransaksiServis::delete/$1');
        $routes->post('delete/(:segment)', 'TransaksiServis::delete/$1');
    });

    // Kelola Booking Servis Online & Approval Pembayaran
    $routes->group('booking', static function ($routes) {
        $routes->get('/', 'Booking::index');
        $routes->get('detail/(:num)', 'Booking::detail/$1');
        $routes->get('approve/(:num)', 'Booking::approvePembayaran/$1');
        $routes->post('approve/(:num)', 'Booking::approvePembayaran/$1');
        $routes->post('tolak/(:num)', 'Booking::tolakPembayaran/$1');
        $routes->post('update-status/(:num)', 'Booking::updateStatus/$1');
        $routes->get('hapus/(:num)', 'Booking::hapus/$1');
    });
});
