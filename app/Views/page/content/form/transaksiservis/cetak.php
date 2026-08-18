<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Nota Servis Motor') ?></title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
        }

        body {
            background-color: #f1f5f9;
            margin: 0;
            padding: 20px;
            color: #000000;
        }

        .receipt-card {
            max-width: 380px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px dashed #cbd5e1;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 1px dashed #000000;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            text-transform: uppercase;
        }

        .brand-address {
            font-size: 11px;
            margin: 0;
            color: #334155;
        }

        .receipt-info {
            font-size: 11px;
            margin-bottom: 12px;
            border-bottom: 1px dashed #000000;
            padding-bottom: 10px;
        }

        .receipt-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        table.receipt-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 12px;
        }

        table.receipt-table th {
            text-align: left;
            border-bottom: 1px dashed #000000;
            padding-bottom: 4px;
            font-weight: 700;
        }

        table.receipt-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        table.receipt-table td.text-center,
        table.receipt-table th.text-center {
            text-align: center;
        }

        table.receipt-table td.text-end,
        table.receipt-table th.text-end {
            text-align: right;
        }

        .totals-block {
            font-size: 12px;
            margin-bottom: 16px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .totals-row.grand-total {
            font-size: 14px;
            font-weight: 800;
            border-top: 1px dashed #000000;
            border-bottom: 1px dashed #000000;
            padding: 6px 0;
            margin: 8px 0;
        }

        .receipt-footer {
            text-align: center;
            font-size: 10px;
            color: #475569;
            border-top: 1px dashed #000000;
            padding-top: 12px;
        }

        .no-print-bar {
            max-width: 380px;
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
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-family: sans-serif;
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
            }

            .receipt-card {
                box-shadow: none;
                padding: 0;
                border: none;
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
        <a href="<?= site_url('admin/transaksiservis') ?>" class="btn-action btn-back">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="btn-action btn-print">
            Cetak Nota Servis
        </button>
    </div>

    <!-- Thermal Receipt Container -->
    <div class="receipt-card">
        <!-- Header -->
        <div class="receipt-header">
            <h1 class="brand-name">BENGKEL SALSA MOTOR</h1>
            <p class="brand-address">Jl. Utama Bengkel Motor No. 123</p>
            <p class="brand-address">Telp / WA: 0812-3456-7890</p>
            <p class="brand-address" style="margin-top: 4px; font-weight: 700;">NOTA SERVIS & SPAREPART</p>
        </div>

        <!-- Transaction Info -->
        <div class="receipt-info">
            <div class="receipt-info-row">
                <span>No. Faktur</span>
                <span><strong>#<?= esc($header['faktur']) ?></strong></span>
            </div>
            <div class="receipt-info-row">
                <span>Tanggal</span>
                <span><?= date('d/m/Y H:i', strtotime($header['created_at'] ?? $header['tglfaktur'])) ?></span>
            </div>
            <div class="receipt-info-row">
                <span>Pelanggan</span>
                <span><?= esc($header['nama_pelanggan'] ?: 'Pelanggan Umum') ?></span>
            </div>
            <div class="receipt-info-row">
                <span>Motor / Plat</span>
                <span><strong><?= esc($header['merkkendaraan']) ?> (<?= esc($header['nopol']) ?>)</strong></span>
            </div>
            <div class="receipt-info-row">
                <span>Keluhan</span>
                <span><?= esc($header['alasan'] ?: '-') ?></span>
            </div>
        </div>

        <!-- Table Items -->
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Deskripsi Item</th>
                    <th class="text-center" style="width: 45px;">Qty</th>
                    <th class="text-end" style="width: 75px;">Biaya</th>
                    <th class="text-end" style="width: 85px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($details)): foreach ($details as $item): 
                    $isServis = !empty($item['detserviskode']);
                    $nameDesc = $isServis ? esc($item['jenis_servis']) : esc($item['nama_barng']);
                    $price = $isServis ? (float)$item['detbiaya'] : (float)$item['detailhargajual'];
                    $qty = $isServis ? 1 : (float)$item['detjml'];
                ?>
                    <tr>
                        <td colspan="4"><strong><?= $nameDesc ?></strong> <?= $isServis ? '<small>(Jasa)</small>' : '' ?></td>
                    </tr>
                    <tr>
                        <td style="color: #475569; padding-left: 6px;">
                            <?= $isServis ? '#' . esc($item['detserviskode']) : '#' . esc($item['detailbrgkode']) ?>
                        </td>
                        <td class="text-center"><?= $qty ?></td>
                        <td class="text-end"><?= number_format($price, 0, ',', '.') ?></td>
                        <td class="text-end"><strong><?= number_format($item['dettotaljual'], 0, ',', '.') ?></strong></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>

        <!-- Totals -->
        <?php 
            $dpVal = (float)($header['dp_booking'] ?? 0);
            $netVal = max(0, (float)$header['totalharga'] - $dpVal);
        ?>
        <div class="totals-block">
            <div class="totals-row">
                <span>Subtotal Servis & Part:</span>
                <span>Rp <?= number_format($header['totalharga'], 0, ',', '.') ?></span>
            </div>
            <?php if ($dpVal > 0): ?>
                <div class="totals-row" style="color: #16a34a; font-weight: bold;">
                    <span>DP Online Terbayar:</span>
                    <span>- Rp <?= number_format($dpVal, 0, ',', '.') ?></span>
                </div>
            <?php endif; ?>
            <div class="totals-row grand-total">
                <span>TOTAL PELUNASAN:</span>
                <span>Rp <?= number_format($netVal, 0, ',', '.') ?></span>
            </div>
            <div class="totals-row">
                <span>Uang Bayar Kasir:</span>
                <span>Rp <?= number_format($header['bayar'], 0, ',', '.') ?></span>
            </div>
            <div class="totals-row">
                <span>Uang Kembalian:</span>
                <span>Rp <?= number_format($header['kembali'], 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="receipt-footer">
            <p style="margin: 0 0 4px 0; font-weight: 700;">TERIMA KASIH ATAS KUNJUNGAN ANDA!</p>
            <p style="margin: 0 0 4px 0;">Garansi Servis 1 Minggu Pasca Perbaikan</p>
            <p style="margin: 0; font-size: 9px; font-style: italic;">Simpan nota ini sebagai bukti garansi servis.</p>
        </div>
    </div>

    <script>
        // Auto trigger print window
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 300);
        });
    </script>
</body>

</html>
