<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        $barangModel = new \App\Models\BarangModel();
        $barangList  = $barangModel->findAll();

        if (empty($barangList)) {
            return;
        }

        $faktur1 = 'PJ-' . date('Ymd') . '-001';

        $existing = $this->db->table('penjualan')->where('faktur', $faktur1)->get()->getRow();
        if ($existing) {
            return;
        }

        $item1 = $barangList[0];
        $item2 = $barangList[1] ?? $item1;

        $qty1 = 2;
        $qty2 = 1;

        $price1 = $item1['harga'];
        $price2 = $item2['harga'];

        $sub1 = $price1 * $qty1;
        $sub2 = $price2 * $qty2;
        $total = $sub1 + $sub2;
        $bayar = ceil($total / 50000) * 50000;
        if ($bayar < $total) {
            $bayar = $total + 10000;
        }
        $kembali = $bayar - $total;

        // Insert header
        $this->db->table('penjualan')->insert([
            'faktur'         => $faktur1,
            'tglfaktur'      => date('Y-m-d'),
            'nama_pelanggan' => 'Pelanggan Umum',
            'totalharga'     => $total,
            'bayar'          => $bayar,
            'kembali'        => $kembali,
            'keterangan'     => 'Penjualan suku cadang tunai kasir',
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

        // Insert details
        $this->db->table('detailpenjualan')->insertBatch([
            [
                'detfaktur'       => $faktur1,
                'detailbrgkode'   => $item1['kode'],
                'detailhargajual' => $price1,
                'jumlah'          => $qty1,
                'subtotal'        => $sub1,
            ],
            [
                'detfaktur'       => $faktur1,
                'detailbrgkode'   => $item2['kode'],
                'detailhargajual' => $price2,
                'jumlah'          => $qty2,
                'subtotal'        => $sub2,
            ],
        ]);
    }
}
