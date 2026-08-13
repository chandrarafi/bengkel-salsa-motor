<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServisSeeder extends Seeder
{
    public function run()
    {
        $forge = \Config\Database::forge();
        
        if (!$this->db->fieldExists('estimasi_waktu', 'servis')) {
            $forge->addColumn('servis', [
                'estimasi_waktu' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 30,
                    'after'      => 'Keterangan',
                ],
            ]);
        }

        if (!$this->db->fieldExists('created_at', 'servis')) {
            $forge->addColumn('servis', [
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        }

        $data = [
            [
                'kodeservis'     => 'SRV0000001',
                'Jenis_servis'   => 'Servis Rutin / Ringan',
                'Biaya'          => 45000,
                'Keterangan'     => 'Pembersihan karburator/throttle body, cek busi, oli, dan tekanan angin ban',
                'estimasi_waktu' => 30,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'kodeservis'     => 'SRV0000002',
                'Jenis_servis'   => 'Servis Lengkap + Clean CVT',
                'Biaya'          => 85000,
                'Keterangan'     => 'Pembersihan mangkok CVT, v-belt, roller, ganti grease, dan tune up injeksi',
                'estimasi_waktu' => 60,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'kodeservis'     => 'SRV0000003',
                'Jenis_servis'   => 'Ganti Oli & Cek Pengereman',
                'Biaya'          => 20000,
                'Keterangan'     => 'Jasa penggantian oli mesin/gardan + penyetelan rem depan belakang',
                'estimasi_waktu' => 15,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'kodeservis'     => 'SRV0000004',
                'Jenis_servis'   => 'Tune Up Injeksi & Reset ECU',
                'Biaya'          => 60000,
                'Keterangan'     => 'Diagnosa injeksi via scanner, pembersihan injector, dan reset ECU/TP',
                'estimasi_waktu' => 45,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'kodeservis'     => 'SRV0000005',
                'Jenis_servis'   => 'Overhaul / Turun Mesin',
                'Biaya'          => 250000,
                'Keterangan'     => 'Servis berat pembongkaran mesin, skir klep, ganti ring piston/piston kit',
                'estimasi_waktu' => 240,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $item) {
            $existing = $this->db->table('servis')->where('kodeservis', $item['kodeservis'])->get()->getRow();
            if ($existing) {
                $this->db->table('servis')->where('kodeservis', $item['kodeservis'])->update($item);
            } else {
                $this->db->table('servis')->insert($item);
            }
        }
    }
}
