<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailBarangMasukModel extends Model
{
    protected $table            = 'detailbarangmasuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'detfaktur',
        'detailbrgkode',
        'detailhargajual',
        'detailhargabeli',
        'jumlah',
        'subtotal',
    ];

    public function getDetailWithBarang($faktur)
    {
        return $this->select('detailbarangmasuk.*, barang.nama_barng, satuan.nama_satuan')
                    ->join('barang', 'barang.kode = detailbarangmasuk.detailbrgkode', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('detailbarangmasuk.detfaktur', $faktur)
                    ->findAll();
    }
}
