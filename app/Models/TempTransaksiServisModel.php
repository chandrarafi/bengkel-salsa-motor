<?php

namespace App\Models;

use CodeIgniter\Model;

class TempTransaksiServisModel extends Model
{
    protected $table            = 'temp_transaksi_servis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'session_id',
        'detfaktur',
        'detserviskode',
        'detbiaya',
        'detailbrgkode',
        'detailhargajual',
        'detjml',
        'dettotaljual',
    ];

    public function getTempWithInfo($sessionId)
    {
        return $this->select('temp_transaksi_servis.*, servis.jenis_servis, barang.nama_barng, satuan.nama_satuan')
                    ->join('servis', 'servis.kodeservis = temp_transaksi_servis.detserviskode', 'left')
                    ->join('barang', 'barang.kode = temp_transaksi_servis.detailbrgkode', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('temp_transaksi_servis.session_id', $sessionId)
                    ->findAll();
    }
}
