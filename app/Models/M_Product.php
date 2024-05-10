<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Product extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id_product';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_product',
        'kode_product',
        'nama_product',
        'kategori',
        'unit',
        'harga_beli',
        'harga_jual',
        'jumlah',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function lastKode()
    {
        return $this->select('kode_product')->orderBy('id_product', 'DESC')->first();
    }
}
