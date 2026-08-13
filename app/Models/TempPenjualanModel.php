<?php

namespace App\Models;

use CodeIgniter\Model;

class TempPenjualanModel extends Model
{
    protected $table            = 'temp_penjualan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'session_id',
        'detfaktur',
        'detailbrgkode',
        'detailhargajual',
        'jumlah',
        'subtotal',
    ];

    public function getTempWithBarang($sessionId)
    {
        return $this->select('temp_penjualan.*, barang.nama_barng, barang.stok as stok_tersedia, satuan.nama_satuan')
                    ->join('barang', 'barang.kode = temp_penjualan.detailbrgkode', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('temp_penjualan.session_id', $sessionId)
                    ->findAll();
    }
}
