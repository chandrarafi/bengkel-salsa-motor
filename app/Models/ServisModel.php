<?php

namespace App\Models;

use CodeIgniter\Model;

class ServisModel extends Model
{
    protected $table            = 'servis';
    protected $primaryKey       = 'kodeservis';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kodeservis',
        'jenis_servis',
        'Jenis_servis',
        'biaya',
        'Biaya',
        'keterangan',
        'Keterangan',
        'estimasi_waktu',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
