<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiServisModel extends Model
{
    protected $table            = 'transaksi_servis';
    protected $primaryKey       = 'faktur';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'faktur',
        'tglfaktur',
        'idpel',
        'nama_pelanggan',
        'merkkendaraan',
        'nopol',
        'alasan',
        'totalharga',
        'dp_booking',
        'bayar',
        'kembali',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
