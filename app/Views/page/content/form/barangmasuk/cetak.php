<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Cetak Faktur Barang Masuk') ?></title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f1f5f9;
            margin: 0;
            padding: 20px;
            color: #1e293b;
        }
        .invoice-card {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #dc2626;
            letter-spacing: 0.5px;
            margin: 0 0 4px 0;
        }
        .brand-subtitle {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }
        .invoice-badge {
            text-align: right;
        }
        .invoice-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 6px 0;
            text-transform: uppercase;
        }
        .invoice-number {
            font-size: 14px;
            font-weight: 700;
            color: #2563eb;
            background-color: #eff6ff;
            padding: 4px 12px;
            border-radius: 6px;
            display: inline-block;
        }
        .info-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background-color: #f8fafc;
            padding: 16px 20px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .info-box {
            font-size: 13px;
        }
        .info-box strong {
            display: block;
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .info-box span {
            font-weight: 600;
            color: #1e293b;
        }
        table.invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        table.invoice-table th {
            background-color: #f1f5f9;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 12px 14px;
            border-bottom: 2px solid #cbd5e1;
            text-align: left;
        }
        table.invoice-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            color: #334155;
        }
        table.invoice-table td.text-center, table.invoice-table th.text-center {
            text-align: center;
        }
        table.invoice-table td.text-end, table.invoice-table th.text-end {
            text-align: right;
        }
        .summary-box {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }
        .summary-table {
            width: 320px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 8px 12px;
            font-size: 14px;
        }
        .summary-table tr.total-row td {
            font-size: 16px;
            font-weight: 800;
            color: #16a34a;
            border-top: 2px solid #e2e8f0;
        }
        .signature-grid {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
        }
        .signature-box {
            text-align: center;
            width: 220px;
            font-size: 13px;
        }
        .signature-line {
            margin-top: 70px;
            border-bottom: 1.5px dashed #94a3b8;
        }
        .no-print-bar {
            max-width: 850px;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }
        .btn-print {
            background-color: #2563eb;
            color: #ffffff;
        }
        .btn-print:hover {
            background-color: #1d4ed8;
        }
        .btn-back {
            background-color: #64748b;
            color: #ffffff;
        }
        .btn-back:hover {
            background-color: #475569;
        }

        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
            }
            .invoice-card {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            .no-print-bar {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Non-Printable Action Bar -->
    <div class="no-print-bar">
        <a href="<?= site_url('admin/barangmasuk') ?>" class="btn-action btn-back">
            &larr; Kembali ke Riwayat
        </a>
        <button onclick="window.print()" class="btn-action btn-print">
            🖨️ Cetak Faktur (Print)
        </button>
    </div>

    <!-- Invoice Sheet -->
    <div class="invoice-card">
        <div class="invoice-header">
            <div>
                <h1 class="brand-title">BENGKEL SALSA MOTOR</h1>
                <p class="brand-subtitle">Spesialis Servis Motor, Injeksi, Tune Up & Penjualan Sparepart</p>
                <p class="brand-subtitle" style="margin-top: 2px;">Jl. Raya Bengkel Utama No. 45 - Telp / WA: 0812-3456-7890</p>
            </div>
            <div class="invoice-badge">
                <h2 class="invoice-title">Faktur Barang Masuk</h2>
                <div class="invoice-number">#<?= esc($header['faktur']) ?></div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <strong>Tanggal Transaksi</strong>
                <span><?= date('d F Y', strtotime($header['tanggalfaktur'])) ?></span>
            </div>
            <div class="info-box">
                <strong>Nomor Faktur</strong>
                <span>#<?= esc($header['faktur']) ?></span>
            </div>
            <div class="info-box">
                <strong>Keterangan / Supplier</strong>
                <span><?= esc($header['keterangan'] ?: '-') ?></span>
            </div>
            <div class="info-box">
                <strong>Petugas Admin</strong>
                <span><?= esc(session()->get('userName') ?: 'Admin Bengkel') ?></span>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 40px;">#</th>
                    <th style="width: 110px;">Kode</th>
                    <th>Nama Barang / Sparepart</th>
                    <th class="text-end">Harga Beli</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-center" style="width: 90px;">Qty</th>
                    <th class="text-end" style="width: 140px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1; 
                    if (!empty($details)):
                        foreach ($details as $row): 
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><strong>#<?= esc($row['detailbrgkode']) ?></strong></td>
                        <td><?= esc($row['nama_barng']) ?></td>
                        <td class="text-end">Rp <?= number_format($row['detailhargabeli'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($row['detailhargajual'], 0, ',', '.') ?></td>
                        <td class="text-center"><strong><?= esc($row['jumlah']) ?> <?= esc($row['nama_satuan'] ?? '') ?></strong></td>
                        <td class="text-end"><strong>Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></strong></td>
                    </tr>
                <?php 
                        endforeach; 
                    else: 
                ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada rincian item barang.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="summary-box">
            <table class="summary-table">
                <tr class="total-row">
                    <td>Total Pembelian:</td>
                    <td class="text-end">Rp <?= number_format($header['totalharga'], 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>

        <div class="signature-grid">
            <div class="signature-box">
                <p style="margin: 0;">Supplier / Pengirim,</p>
                <div class="signature-line"></div>
                <p style="margin-top: 6px; font-weight: 600; color: #64748b;">( Tanda Tangan & Stempel )</p>
            </div>
            <div class="signature-box">
                <p style="margin: 0;">Penerima / Admin Bengkel,</p>
                <div class="signature-line"></div>
                <p style="margin-top: 6px; font-weight: 600; color: #1e293b;"><?= esc(session()->get('userName') ?: 'Admin Bengkel') ?></p>
            </div>
        </div>
    </div>

    <script>
        // Trigger auto print window on load
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                window.print();
            }, 400);
        });
    </script>
</body>
</html>
