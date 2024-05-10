<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kategori extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_kategori',
        'kategori',
    ];

    public function showData()
    {
        return $this->orderBy('id_kategori', 'DESC')->findAll();
    }

    public function tambah($data)
    {
        return $this->insert($data);
    }
}
