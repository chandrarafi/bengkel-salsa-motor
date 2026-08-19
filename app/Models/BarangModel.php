<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'kode';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode',
        'nama_barng',
        'idkategori',
        'idsatuan',
        'harga_beli',
        'harga_jual',
        'gambar',
        'stok',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all barang with joined kategori and satuan
     */
    public function getBarangWithRelations()
    {
        return $this->select('barang.*, kategori.namakategori, satuan.nama_satuan')
                    ->join('kategori', 'kategori.idkategori = barang.idkategori', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->orderBy('barang.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get single barang with joined kategori and satuan
     */
    public function getBarangWithRelationsByKode($kode)
    {
        return $this->select('barang.*, kategori.namakategori, satuan.nama_satuan')
                    ->join('kategori', 'kategori.idkategori = barang.idkategori', 'left')
                    ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left')
                    ->where('barang.kode', $kode)
                    ->first();
    }
}
