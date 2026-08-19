<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Laporan Data Jenis Servis') ?></title>
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
        <a href="<?= site_url('admin/laporan/servis') ?>" class="btn-action btn-back">
            &larr; Kembali ke Laporan Servis
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
            <h2 class="report-title">LAPORAN DATA JENIS SERVIS & JASA BENGKEL</h2>
            <p class="report-period">
                <?php if (!empty($q)): ?>
                    <strong>Kata Kunci Pencarian:</strong> "<?= esc($q) ?>"
                <?php else: ?>
                    Semua Data Jenis Servis & Jasa Layanan
                <?php endif; ?>
                (s/d <?= date('d F Y') ?>)
            </p>
        </div>

        <!-- Data Table -->
        <table class="report-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th style="width: 110px;">Kode Servis</th>
                    <th>Nama Jenis Servis</th>
                    <th class="text-end" style="width: 120px;">Biaya Jasa (Rp)</th>
                    <th class="text-center" style="width: 110px;">Estimasi Waktu</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $totalBiaya = 0;
                    if (!empty($servisList)): 
                        $no = 1; 
                        foreach ($servisList as $item): 
                            $namaJenis = $item['jenis_servis'] ?? $item['Jenis_servis'] ?? '-';
                            $biaya     = (float)($item['biaya'] ?? $item['Biaya'] ?? 0);
                            $ket       = $item['keterangan'] ?? $item['Keterangan'] ?? '-';
                            $estimasi  = !empty($item['estimasi_waktu']) ? $item['estimasi_waktu'] . ' menit' : '-';
                            $totalBiaya += $biaya;
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><strong>#<?= esc($item['kodeservis']) ?></strong></td>
                        <td><strong><?= esc($namaJenis) ?></strong></td>
                        <td class="text-end fw-bold">Rp <?= number_format($biaya, 0, ',', '.') ?></td>
                        <td class="text-center"><?= esc($estimasi) ?></td>
                        <td><?= esc($ket ?: '-') ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 20px;">Tidak ada data jenis servis yang ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="tfoot-summary">
                    <td colspan="3" class="text-end">TOTAL / RATA-RATA:</td>
                    <td class="text-end">Rp <?= number_format($totalBiaya, 0, ',', '.') ?></td>
                    <td colspan="2" class="text-center">Total Servis: <?= number_format(count($servisList ?? []), 0, ',', '.') ?> Jenis</td>
                </tr>
            </tfoot>
        </table>

        <!-- Signatures & Footer -->
        <div class="signature-block">
            <div style="width: 300px;">
                <p style="margin: 0 0 6px 0; font-weight: bold;">Catatan / Informasi:</p>
                <ul style="margin: 0; padding-left: 18px; font-size: 11px; color: #475569;">
                    <li>Total Jenis Layanan Servis: <strong><?= number_format(count($servisList ?? []), 0, ',', '.') ?> jenis</strong></li>
                    <li>Estimasi waktu & tarif biaya jasa dapat berubah sesuai kebijakan bengkel.</li>
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
