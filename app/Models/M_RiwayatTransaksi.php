<?php

namespace App\Models;

use CodeIgniter\Model;

class M_RiwayatTransaksi extends Model
{
    protected $table      = 'riwayat_transaksi';
    protected $primaryKey = 'id_riwayatTransaksi';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_riwayatTransaksi',
        'no_faktur',
        'id_product',
        'kode_product',
        'nama_product',
        'kasir',
        'jumlah',
        'total',
        'harga_beli',
        'harga_jual',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
