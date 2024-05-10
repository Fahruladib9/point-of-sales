<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Unit extends Model
{
    protected $table      = 'unit';
    protected $primaryKey = 'id_unit';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_unit',
        'unit',
    ];

    public function showData()
    {
        return $this->orderBy('id_unit', 'DESC')->findAll();
    }

    public function tambah($data)
    {
        return $this->insert($data);
    }
}
