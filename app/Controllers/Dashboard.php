<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard Bengkel Motor',
            'stats' => [
                'servisHariIni'   => '24',
                'totalPendapatan' => 'Rp 8.500.000',
                'stokSparepart'   => '450 Item',
                'antrianServis'   => '5 Motor',
            ],
            'recentServices' => [
                [
                    'nota'      => '#SRV-2026-001',
                    'pelanggan' => 'Budi Santoso',
                    'motor'     => 'Honda Vario 150 (B 4512 KBC)',
                    'servis'    => 'Servis Rutin + Ganti Oli Shell AX7',
                    'mekanik'   => 'Agus Prasetyo',
                    'biaya'     => 'Rp 175.000',
                    'status'    => 'Selesai',
                ],
                [
                    'nota'      => '#SRV-2026-002',
                    'pelanggan' => 'Rian Kurniawan',
                    'motor'     => 'Yamaha NMAX 155 (B 3109 SGF)',
                    'servis'    => 'Ganti Kampas Rem & Tune Up CVT',
                    'mekanik'   => 'Bambang',
                    'biaya'     => 'Rp 320.000',
                    'status'    => 'Dikerjakan',
                ],
                [
                    'nota'      => '#SRV-2026-003',
                    'pelanggan' => 'Dwi Cahyono',
                    'motor'     => 'Honda Beat FI (B 6721 WQ)',
                    'servis'    => 'Servis Injeksi & Filter Udara',
                    'mekanik'   => 'Agus Prasetyo',
                    'biaya'     => 'Rp 140.000',
                    'status'    => 'Selesai',
                ],
                [
                    'nota'      => '#SRV-2026-004',
                    'pelanggan' => 'Eko Hendra',
                    'motor'     => 'Kawasaki KLX 150 (B 5542 TRE)',
                    'servis'    => 'Ganti Rantai & Gear Set',
                    'mekanik'   => 'Joko',
                    'biaya'     => 'Rp 480.000',
                    'status'    => 'Antri',
                ],
                [
                    'nota'      => '#SRV-2026-005',
                    'pelanggan' => 'Fery Wijaya',
                    'motor'     => 'Suzuki Satria F150 (B 1289 POK)',
                    'servis'    => 'Ganti Aki & Servis Kelistrikan',
                    'mekanik'   => 'Bambang',
                    'biaya'     => 'Rp 290.000',
                    'status'    => 'Dikerjakan',
                ],
            ],
        ];

        return view('page/content/dashboard', $data);
    }
}
