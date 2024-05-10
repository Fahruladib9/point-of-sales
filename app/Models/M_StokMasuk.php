<?php

namespace App\Models;

use CodeIgniter\Model;

class M_StokMasuk extends Model
{
    protected $table      = 'stok_masuk';
    protected $primaryKey = 'id_stokMasuk';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_stokMasuk',
        'id_product',
        'kode_transaksi',
        'nama_product',
        'jumlah',
        'suplier',
        'tanggal',
    ];

    public function showData()
    {
        return $this->orderBy('id_stokMasuk', 'DESC')->findAll();
    }

    public function tambah($data)
    {
        return $this->insert($data);
    }
}
