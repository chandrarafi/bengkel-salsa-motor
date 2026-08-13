<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table            = 'satuan';
    protected $primaryKey       = 'idsatuan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'nama_satuan',
        'keterangan',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules      = [
        'nama_satuan' => 'required|min_length[1]|max_length[100]',
    ];
    protected $validationMessages   = [
        'nama_satuan' => [
            'required'   => 'Nama satuan wajib diisi.',
            'min_length' => 'Nama satuan minimal 1 karakter.',
            'max_length' => 'Nama satuan maksimal 100 karakter.',
        ],
    ];
    protected $skipValidation       = false;
}
