<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Suplier extends Model
{
    protected $table      = 'suplier';
    protected $primaryKey = 'id_suplier';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_suplier',
        'suplier',
    ];

    public function showData()
    {
        return $this->orderBy('id_suplier', 'DESC')->findAll();
    }

    public function tambah($data)
    {
        return $this->insert($data);
    }
}
