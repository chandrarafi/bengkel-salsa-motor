<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangMasukSeeder extends Seeder
{
    public function run()
    {
        $barangModel = new \App\Models\BarangModel();
        $barangList  = $barangModel->findAll();

        if (empty($barangList)) {
            return;
        }

        $faktur1 = 'BM-' . date('Ymd') . '-001';

        $existing = $this->db->table('barangmasuk')->where('faktur', $faktur1)->get()->getRow();
        if ($existing) {
            return;
        }

        $item1 = $barangList[0];
        $item2 = $barangList[1] ?? $item1;

        $qty1 = 10;
        $qty2 = 15;
        $cost1 = $item1['harga_beli'] ?? 0;
        $cost2 = $item2['harga_beli'] ?? 0;

        $sub1 = $cost1 * $qty1;
        $sub2 = $cost2 * $qty2;
        $total = $sub1 + $sub2;

        // Insert header
        $this->db->table('barangmasuk')->insert([
            'faktur'        => $faktur1,
            'tanggalfaktur' => date('Y-m-d'),
            'totalharga'    => $total,
            'keterangan'    => 'Pembelian stok awal sparepart supplier resmi',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        // Insert details
        $this->db->table('detailbarangmasuk')->insertBatch([
            [
                'detfaktur'       => $faktur1,
                'detailbrgkode'   => $item1['kode'],
                'detailhargajual' => $item1['harga_jual'] ?? 0,
                'detailhargabeli' => $cost1,
                'jumlah'          => $qty1,
                'subtotal'        => $sub1,
            ],
            [
                'detfaktur'       => $faktur1,
                'detailbrgkode'   => $item2['kode'],
                'detailhargajual' => $item2['harga_jual'] ?? 0,
                'detailhargabeli' => $cost2,
                'jumlah'          => $qty2,
                'subtotal'        => $sub2,
            ],
        ]);
    }
}
