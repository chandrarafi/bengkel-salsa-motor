<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_satuan' => 'Pcs',
                'keterangan'  => 'Satuan per buah/biji barang',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_satuan' => 'Liter',
                'keterangan'  => 'Satuan volume cairan (oli/pelumas/bensin)',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_satuan' => 'Botol',
                'keterangan'  => 'Satuan kemasan botol',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_satuan' => 'Set',
                'keterangan'  => 'Satuan paket/set komponen lengkap',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_satuan' => 'Box',
                'keterangan'  => 'Satuan kemasan kotak/kardus',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_satuan' => 'Roll',
                'keterangan'  => 'Satuan gulungan (kabel/selang/isolasi)',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_satuan' => 'Unit',
                'keterangan'  => 'Satuan unit kendaraan/mesin',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('satuan')->insertBatch($data);
    }
}
