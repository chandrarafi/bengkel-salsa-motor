<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $kategori = $this->db->table('kategori')->get()->getResultArray();
        $satuan   = $this->db->table('satuan')->get()->getResultArray();

        $katMap = [];
        foreach ($kategori as $k) {
            $katMap[$k['namakategori']] = $k['idkategori'];
        }

        $satMap = [];
        foreach ($satuan as $s) {
            $satMap[$s['nama_satuan']] = $s['idsatuan'];
        }

        $defaultKat = reset($katMap) ?: 1;
        $defaultSat = reset($satMap) ?: 1;

        $data = [
            [
                'kode'        => 'BRG0000001',
                'nama_barng'  => 'Oli MPX 2 Matik 0.8L',
                'idkategori'  => $katMap['Oli & Pelumas'] ?? $defaultKat,
                'idsatuan'    => $satMap['Botol'] ?? $defaultSat,
                'harga'       => 55000,
                'gambar'      => null,
                'stok'        => 35,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'kode'        => 'BRG0000002',
                'nama_barng'  => 'Oli Shell Advance AX7 10W-40',
                'idkategori'  => $katMap['Oli & Pelumas'] ?? $defaultKat,
                'idsatuan'    => $satMap['Botol'] ?? $defaultSat,
                'harga'       => 65000,
                'gambar'      => null,
                'stok'        => 20,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'kode'        => 'BRG0000003',
                'nama_barng'  => 'Kampas Rem Depan Vario 150',
                'idkategori'  => $katMap['Sistem Pengereman'] ?? $defaultKat,
                'idsatuan'    => $satMap['Set'] ?? $defaultSat,
                'harga'       => 45000,
                'gambar'      => null,
                'stok'        => 15,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'kode'        => 'BRG0000004',
                'nama_barng'  => 'Busi Honda Genuine CPR9EA-9',
                'idkategori'  => $katMap['Sparepart Mesin'] ?? $defaultKat,
                'idsatuan'    => $satMap['Pcs'] ?? $defaultSat,
                'harga'       => 25000,
                'gambar'      => null,
                'stok'        => 50,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'kode'        => 'BRG0000005',
                'nama_barng'  => 'Ban Luar FDR Sport XR Evo 90/80-14',
                'idkategori'  => $katMap['Ban & Velg'] ?? $defaultKat,
                'idsatuan'    => $satMap['Pcs'] ?? $defaultSat,
                'harga'       => 240000,
                'gambar'      => null,
                'stok'        => 10,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('barang')->insertBatch($data);
    }
}
