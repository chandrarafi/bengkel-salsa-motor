<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenjualanModel extends Model
{
    protected $table            = 'detailpenjualan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'detfaktur',
        'detailbrgkode',
        'detailhargajual',
        'jumlah',
        'subtotal',
    ];

    public function getDetailWithBarang($faktur)
    {
        return $this->select('detailpenjualan.*, barang.nama_barng, satuan.nama_satuan')
                    ->join('barang', 'barang.kode = detailpenjualan.detailbrgkode', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('detailpenjualan.detfaktur', $faktur)
                    ->findAll();
    }
}
