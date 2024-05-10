<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     *                                                     or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => \App\Filters\F_Auth::class,
        'admin'         => \App\Filters\F_Admin::class,
        'kasir'         => \App\Filters\F_Kasir::class,
        'login'         => \App\Filters\F_Login::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        'auth' => [
            'before' => [
                '/', '/product', '/product/*', '/edit-product/*', '/update-product/*', '/delete-product/*', '/kategori', '/kategori/*', '/update-kategori/*', '/edit-kategori/*', '/delete-kategori/*', '/unit', '/unit/*', '/edit-unit/*', '/update-unit/*', '/delete-unit/*', '/suplier', '/suplier/*', '/edit-suplier/*', '/update-suplier/*', '/delete-suplier/*', '/users', '/users/*', '/edit-users/*', '/update-users/*', '/delete-users/*', '/stok-masuk', '/stok-masuk/*', '/delete-stok-masuk/*', '/stok-keluar', '/show-data-keluar/*', '/stok-keluar/*', '/delete-stok-keluar/*', '/kasir', '/tambah-cart/*', '/show-cart/*', '/show', '/delete-cart', '/delete-cart/*', '/update-cart/*', '/riwayat-penjualan', 'riwayat-penjualan/*', '/kode-transaksi', '/delete-riwayat-penjualan/*'
            ]
        ],
        'kasir' => [
            'before' => [
                '/', '/product', '/product/*', '/edit-product/*', '/update-product/*', '/delete-product/*', '/kategori', '/kategori/*', '/update-kategori/*', '/edit-kategori/*', '/delete-kategori/*', '/unit', '/unit/*', '/edit-unit/*', '/update-unit/*', '/delete-unit/*', '/suplier', '/suplier/*', '/edit-suplier/*', '/update-suplier/*', '/delete-suplier/*', '/users', '/users/*', '/edit-users/*', '/update-users/*', '/delete-users/*', '/stok-masuk', '/stok-masuk/*', '/delete-stok-masuk/*', '/stok-keluar', '/show-data-keluar/*', '/stok-keluar/*', '/delete-stok-keluar/*', '/riwayat-penjualan', 'riwayat-penjualan/*', '/delete-riwayat-penjualan/*'
            ]
        ],
        'admin' => [
            'before' => [
                '/kasir', '/tambah-cart/*', '/show-cart/*', '/show', '/delete-cart', '/delete-cart/*', '/update-cart/*', '/kode-transaksi'
            ]
        ],
        'login' => [
            'before' => [
                '/login'
            ]
        ],
    ];
}
