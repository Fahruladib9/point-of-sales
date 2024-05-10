<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_users';
    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_users',
        'username',
        'password',
        'nama',
        'akses',
    ];

    public function showData()
    {
        return $this->orderBy('id_users', 'DESC')->findAll();
    }
}
