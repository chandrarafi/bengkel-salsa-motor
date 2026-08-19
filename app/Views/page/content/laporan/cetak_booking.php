<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Laporan Booking Servis') ?></title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
            color: #1e293b;
        }

        .report-paper {
            max-width: 960px;
            margin: 0 auto;
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .header-kop {
            text-align: center;
            margin-bottom: 24px;
            position: relative;
        }

        .report-title-block {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-title {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 6px 0;
            color: #0f172a;
            text-decoration: underline;
        }

        .report-period {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        table.report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 20px;
        }

        table.report-table th {
            background-color: #f1f5f9;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            white-space: nowrap;
        }

        table.report-table td {
            padding: 7px 10px;
            border: 1px solid #cbd5e1;
            vertical-align: middle;
        }

        table.report-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .tfoot-summary td {
            background-color: #e2e8f0 !important;
            font-weight: 700;
            border: 1px solid #94a3b8 !important;
            padding: 8px 10px;
        }

        .signature-block {
            display: flex;
            justify-content: space-between;
            margin-top: 35px;
            font-size: 12px;
            page-break-inside: avoid;
        }

        .signature-box {
            text-align: center;
            width: 220px;
        }

        .signature-space {
            height: 65px;
        }

        .no-print-bar {
            max-width: 960px;
            margin: 0 auto 15px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        .btn-print {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-back {
            background-color: #64748b;
            color: #ffffff;
        }

        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
                color: #000000;
            }

            .report-paper {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
                border: none;
            }

            .no-print-bar {
                display: none !important;
            }

            table.report-table th, table.report-table td {
                border-color: #475569 !important;
            }
        }
    </style>
</head>

<body>

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="no-print-bar">
        <a href="<?= site_url('admin/laporan/booking') ?>" class="btn-action btn-back">
            &larr; Kembali ke Laporan Booking
        </a>
        <button onclick="window.print()" class="btn-action btn-print">
            Cetak PDF / Print
        </button>
    </div>

    <!-- Official Report Document Paper -->
    <div class="report-paper">
        <!-- Kop Surat -->
        <div class="header-kop" style="margin-bottom: 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 12px; border-bottom: 2px solid #0f172a;">
                <div style="flex: 0 0 140px; text-align: left;">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo Bengkel Salsa Motor" style="height: 46px; max-width: 140px; object-fit: contain;">
                </div>
                <div style="flex: 1; text-align: center; padding: 0 10px;">
                    <h1 style="margin: 0 0 2px 0; font-size: 20px; font-weight: 800; text-transform: uppercase; color: #0f172a; letter-spacing: 0.5px;">BENGKEL SALSA MOTOR</h1>
                    <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 2px;">Spesialis Servis Motor & Penjualan Suku Cadang Resmi</div>
                    <p style="margin: 0; font-size: 10.5px; color: #475569; line-height: 1.3;">Jl. Raya Bengkel Utama No. 45 | Telepon/WA: 0812-3456-7890</p>
                </div>
                <div style="flex: 0 0 140px;"></div>
            </div>
        </div>

        <!-- Document Title -->
        <div class="report-title-block">
            <h2 class="report-title">LAPORAN BOOKING SERVIS ONLINE</h2>
            <p class="report-period">
                <strong>Periode:</strong> 
                <?php if (!empty($tgl_awal) || !empty($tgl_akhir)): ?>
                    <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : date('d F Y') ?>
                <?php else: ?>
                    Semua Data Booking (s/d <?= date('d F Y') ?>)
                <?php endif; ?>
                <?php if (!empty($status_booking)): ?>
                    | <strong>Status:</strong> <?= esc(ucfirst($status_booking)) ?>
                <?php endif; ?>
            </p>
        </div>

        <!-- Data Table -->
        <table class="report-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th style="width: 110px;">Kode Booking</th>
                    <th class="text-center" style="width: 100px;">Jadwal Servis</th>
                    <th>Pelanggan & Kontak</th>
                    <th>Kendaraan & Nopol</th>
                    <th>Jenis Servis</th>
                    <th class="text-end" style="width: 90px;">DP Servis</th>
                    <th class="text-center" style="width: 90px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookingList)): $no = 1; foreach ($bookingList as $b): 
                    $dp     = (float)($b['biaya'] ?? 0);
                    $tglBkg = !empty($b['tgl_booking']) ? date('d/m/Y', strtotime($b['tgl_booking'])) : '-';
                    $jamBkg = !empty($b['jam_booking']) ? date('H:i', strtotime($b['jam_booking'])) : '';
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><strong>#<?= esc($b['kode_booking']) ?></strong></td>
                        <td class="text-center">
                            <?= esc($tglBkg) ?> <?= esc($jamBkg) ?>
                        </td>
                        <td>
                            <strong><?= esc($b['nama_pelanggan']) ?></strong><br>
                            <span style="font-size: 10px; color: #64748b;"><?= esc($b['no_hp'] ?: '-') ?></span>
                        </td>
                        <td>
                            <?= esc($b['merkkendaraan'] ?: '-') ?>
                            <?php if (!empty($b['nopol'])): ?>
                                (<strong><?= esc($b['nopol']) ?></strong>)
                            <?php endif; ?>
                        </td>
                        <td><?= esc($b['jenis_servis'] ?: '-') ?></td>
                        <td class="text-end fw-bold">Rp <?= number_format($dp, 0, ',', '.') ?></td>
                        <td class="text-center"><strong><?= esc(ucfirst($b['status_booking'] ?: '-')) ?></strong></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 20px;">Tidak ada data booking servis untuk periode ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="tfoot-summary">
                    <td colspan="6" class="text-end">TOTAL KESELURUHAN DP DITERIMA:</td>
                    <td class="text-end">Rp <?= number_format($totalDP ?? 0, 0, ',', '.') ?></td>
                    <td class="text-center">Total: <?= number_format($totalBooking ?? 0, 0, ',', '.') ?> Data</td>
                </tr>
            </tfoot>
        </table>

        <!-- Signatures & Footer -->
        <div class="signature-block">
            <div style="width: 300px;">
                <p style="margin: 0 0 6px 0; font-weight: bold;">Ringkasan Booking:</p>
                <ul style="margin: 0; padding-left: 18px; font-size: 11px; color: #475569;">
                    <li>Total Pengajuan Booking: <strong><?= number_format($totalBooking ?? 0, 0, ',', '.') ?> data</strong></li>
                    <li>Total Nominal DP Terkumpul: <strong>Rp <?= number_format($totalDP ?? 0, 0, ',', '.') ?></strong></li>
                </ul>
            </div>
            <div class="signature-box">
                <p style="margin: 0 0 4px 0;">Kota, <?= date('d F Y') ?></p>
                <p style="margin: 0; font-weight: bold;">Mengetahui / Penanggung Jawab,</p>
                <div class="signature-space"></div>
                <p style="margin: 0; font-weight: bold; text-decoration: underline;"><?= esc(session()->get('userName') ?: 'Admin / Pimpinan') ?></p>
                <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">Bengkel Salsa Motor</p>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>

</html>
