<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'idkategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'namakategori',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules      = [
        'namakategori' => 'required|min_length[3]|max_length[100]',
    ];
    protected $validationMessages   = [
        'namakategori' => [
            'required'   => 'Nama kategori wajib diisi.',
            'min_length' => 'Nama kategori minimal 3 karakter.',
            'max_length' => 'Nama kategori maksimal 100 karakter.',
        ],
    ];
    protected $skipValidation       = false;
}
