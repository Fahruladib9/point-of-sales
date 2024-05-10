<?php

namespace App\Models;

use CodeIgniter\Model;

class M_StokKeluar extends Model
{
    protected $table      = 'stok_keluar';
    protected $primaryKey = 'id_stokKeluar';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_stokKeluar',
        'id_product',
        'kode_transaksi',
        'nama_product',
        'jumlah',
        'keterangan',
        'tanggal',
    ];

    public function showData()
    {
        return $this->orderBy('id_stokKeluar', 'DESC')->findAll();
    }

    public function tambah($data)
    {
        return $this->insert($data);
    }
}
