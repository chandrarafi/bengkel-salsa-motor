<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiServisModel extends Model
{
    protected $table            = 'detail_transaksi_servis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'detfaktur',
        'detserviskode',
        'detbiaya',
        'detailbrgkode',
        'detailhargajual',
        'detjml',
        'dettotaljual',
    ];

    public function getDetailWithInfo($faktur)
    {
        return $this->select('detail_transaksi_servis.*, servis.jenis_servis, barang.nama_barng, satuan.nama_satuan')
                    ->join('servis', 'servis.kodeservis = detail_transaksi_servis.detserviskode', 'left')
                    ->join('barang', 'barang.kode = detail_transaksi_servis.detailbrgkode', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('detail_transaksi_servis.detfaktur', $faktur)
                    ->findAll();
    }
}
