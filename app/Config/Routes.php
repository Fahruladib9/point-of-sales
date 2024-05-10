<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Login
$routes->get('/login', 'C_Auth::index');
$routes->post('/proses-login', 'C_Auth::prosesLogin');
$routes->get('/logout', 'C_Auth::logout');
// Home admin
$routes->get('/', 'Home::index');
// Produk
$routes->get('/product', 'Data_Barang\C_Product::index');
$routes->post('/product/tambah', 'Data_Barang\C_Product::tambah');
$routes->get('/edit-product/(:any)', 'Data_Barang\C_Product::edit/$1');
$routes->post('/update-product/(:any)', 'Data_Barang\C_Product::update/$1');
$routes->post('/delete-product/(:any)', 'Data_Barang\C_Product::delete/$1');
// Kategori
$routes->get('/kategori', 'Data_Barang\C_Kategori::index');
$routes->post('/kategori/tambah', 'Data_Barang\C_Kategori::tambah');
$routes->get('/edit-kategori/(:any)', 'Data_Barang\C_Kategori::edit/$1');
$routes->post('/update-kategori/(:any)', 'Data_Barang\C_Kategori::update/$1');
$routes->post('/delete-kategori/(:any)', 'Data_Barang\C_Kategori::delete/$1');
// Unit
$routes->get('/unit', 'Data_Barang\C_Unit::index');
$routes->post('/unit/tambah', 'Data_Barang\C_Unit::tambah');
$routes->get('/edit-unit/(:any)', 'Data_Barang\C_Unit::edit/$1');
$routes->post('/update-unit/(:any)', 'Data_Barang\C_Unit::update/$1');
$routes->post('/delete-unit/(:any)', 'Data_Barang\C_Unit::delete/$1');
// Suplier
$routes->get('/suplier', 'Data_Barang\C_Suplier::index');
$routes->post('/suplier/tambah', 'Data_Barang\C_Suplier::tambah');
$routes->get('/edit-suplier/(:any)', 'Data_Barang\C_Suplier::edit/$1');
$routes->post('/update-suplier/(:any)', 'Data_Barang\C_Suplier::update/$1');
$routes->post('/delete-suplier/(:any)', 'Data_Barang\C_Suplier::delete/$1');
// Users
$routes->get('/users', 'C_Users::index');
$routes->post('/users/tambah', 'C_Users::tambah');
$routes->get('/edit-users/(:any)', 'C_Users::edit/$1');
$routes->post('/update-users/(:any)', 'C_Users::update/$1');
$routes->post('/delete-users/(:any)', 'C_Users::delete/$1');
// Stok masuk
$routes->get('/stok-masuk', 'Data_Barang\C_StokMasuk::index');
$routes->post('/stok-masuk/tambah', 'Data_Barang\C_StokMasuk::tambah');
$routes->post('/delete-stok-masuk/(:any)', 'Data_Barang\C_StokMasuk::delete/$1');
// Stok keluar
$routes->get('/stok-keluar', 'Data_Barang\C_StokKeluar::index');
$routes->get('/show-data-keluar/(:any)', 'Data_Barang\C_StokKeluar::show/$1'); // ambil data menggunakan ajax
$routes->post('/stok-keluar/tambah', 'Data_Barang\C_StokKeluar::tambah');
$routes->post('/delete-stok-keluar/(:any)', 'Data_Barang\C_StokKeluar::delete/$1');
// Riwayat penjualan
$routes->get('/riwayat-penjualan', 'Data_Barang\C_RiwayatPenjualan::index');
$routes->post('/delete-riwayat-penjualan/(:any)', 'Data_Barang\C_RiwayatPenjualan::delete/$1');
// Kasir
$routes->get('/kasir', 'C_Kasir::index');
$routes->post('/tambah-cart/(:any)', 'C_Kasir::tambah/$1');
$routes->get('/show-cart/(:any)', 'C_Kasir::showCart/$1');
$routes->get('/show', 'C_Kasir::show');
$routes->get('/delete-cart', 'C_Kasir::removeCart');
$routes->get('/delete-cart/(:any)', 'C_Kasir::deleteCart/$1');
$routes->post('/update-cart/(:any)', 'C_Kasir::updateCart/$1');
$routes->get('/kode-transaksi', 'C_Kasir::kodeTransaksi');
$routes->post('/add-cart', 'C_Kasir::addCart');
$routes->get('/cetak-struk/(:any)/(:any)', 'C_Kasir::cetak/$1/$2');
