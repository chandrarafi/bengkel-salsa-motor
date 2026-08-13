<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiServisSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Sample Transaksi Servis
        $faktur1 = 'SV-' . date('Ymd') . '-001';
        $faktur2 = 'SV-' . date('Ymd') . '-002';

        $db->table('transaksi_servis')->ignore(true)->insertBatch([
            [
                'faktur'         => $faktur1,
                'tglfaktur'      => date('Y-m-d'),
                'idpel'          => null,
                'nama_pelanggan' => 'Pelanggan Umum',
                'merkkendaraan' => 'Honda Vario 125',
                'nopol'          => 'B 3829 TGH',
                'alasan'         => 'Servis Ringan & Ganti Oli Mesin',
                'totalharga'     => 105000,
                'bayar'          => 120000,
                'kembali'        => 15000,
                'status'         => 'selesai',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'faktur'         => $faktur2,
                'tglfaktur'      => date('Y-m-d'),
                'idpel'          => null,
                'nama_pelanggan' => 'Budi Santoso',
                'merkkendaraan' => 'Yamaha NMAX 155',
                'nopol'          => 'B 6192 UJK',
                'alasan'         => 'Servis Injeksi & Rem Depan Bunyi',
                'totalharga'     => 145000,
                'bayar'          => 0,
                'kembali'        => 0,
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ]);

        // Details for faktur1
        $db->table('detail_transaksi_servis')->ignore(true)->insertBatch([
            [
                'detfaktur'       => $faktur1,
                'detserviskode'   => 'SRV001', // Servis Ringan
                'detbiaya'        => 50000,
                'detailbrgkode'   => null,
                'detailhargajual' => 0,
                'detjml'          => 1,
                'dettotaljual'    => 50000,
            ],
            [
                'detfaktur'       => $faktur1,
                'detserviskode'   => null,
                'detbiaya'        => 0,
                'detailbrgkode'   => 'BRG001', // Oli MPX2
                'detailhargajual' => 55000,
                'detjml'          => 1,
                'dettotaljual'    => 55000,
            ],
        ]);

        // Details for faktur2
        $db->table('detail_transaksi_servis')->ignore(true)->insertBatch([
            [
                'detfaktur'       => $faktur2,
                'detserviskode'   => 'SRV002', // Servis Injeksi
                'detbiaya'        => 75000,
                'detailbrgkode'   => null,
                'detailhargajual' => 0,
                'detjml'          => 1,
                'dettotaljual'    => 75000,
            ],
            [
                'detfaktur'       => $faktur2,
                'detserviskode'   => null,
                'detbiaya'        => 0,
                'detailbrgkode'   => 'BRG002', // Kampas Rem
                'detailhargajual' => 70000,
                'detjml'          => 1,
                'dettotaljual'    => 70000,
            ],
        ]);
    }
}
