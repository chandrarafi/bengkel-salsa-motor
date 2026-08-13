<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'email',
        'password',
        'level',
        'no_hp',
        'alamat',
        'foto',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'level' => 'required|in_list[pimpinan,admin,pelanggan]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
            'valid_email' => 'Format email tidak valid.',
        ],
    ];
}
