<?php

namespace App\Models;

use CodeIgniter\Model;

class TempBarangMasukModel extends Model
{
    protected $table            = 'temp_barangmasuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'session_id',
        'detfaktur',
        'detailbrgkode',
        'detailhargajual',
        'detailhargabeli',
        'jumlah',
        'subtotal',
    ];

    public function getTempWithBarang($sessionId)
    {
        return $this->select('temp_barangmasuk.*, barang.nama_barng, satuan.nama_satuan')
                    ->join('barang', 'barang.kode = temp_barangmasuk.detailbrgkode', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('temp_barangmasuk.session_id', $sessionId)
                    ->findAll();
    }
}
