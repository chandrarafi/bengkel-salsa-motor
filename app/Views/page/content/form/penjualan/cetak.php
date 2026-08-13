<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Struk Penjualan Kasir') ?></title>
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
            background: #ffffff;
            padding: 25px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px dashed #cbd5e1;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 1px dashed #000000;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            margin: 0 0 4px 0;
            text-transform: uppercase;
        }

        .brand-address {
            font-size: 11px;
            margin: 0;
            line-height: 1.3;
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
            padding-bottom: 6px;
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

        .receipt-divider {
            border-top: 1px dashed #000000;
            margin: 10px 0;
        }

        .totals-block {
            font-size: 12px;
            margin-bottom: 16px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
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
            margin-top: 15px;
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
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
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
                max-width: 100%;
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
        <a href="<?= site_url('admin/penjualan') ?>" class="btn-action btn-back">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="btn-action btn-print">
            Cetak Struk
        </button>
    </div>

    <!-- Thermal Struk Card -->
    <div class="receipt-card">
        <div class="receipt-header">
            <h1 class="brand-name">BENGKEL SALSA MOTOR</h1>
            <p class="brand-address">Jl. Raya Bengkel Utama No. 45</p>
            <p class="brand-address">Telp / WA: 0812-3456-7890</p>
        </div>

        <div class="receipt-info">
            <div class="receipt-info-row">
                <span>No. Struk:</span>
                <strong>#<?= esc($header['faktur']) ?></strong>
            </div>
            <div class="receipt-info-row">
                <span>Tanggal:</span>
                <span><?= date('d/m/Y H:i', strtotime($header['created_at'] ?? $header['tglfaktur'])) ?></span>
            </div>
            <div class="receipt-info-row">
                <span>Pelanggan:</span>
                <span><?= esc($header['nama_pelanggan'] ?: 'Pelanggan Umum') ?></span>
            </div>
            <div class="receipt-info-row">
                <span>Kasir:</span>
                <span><?= esc(session()->get('userName') ?: 'Admin Kasir') ?></span>
            </div>
        </div>

        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-center" style="width: 40px;">Qty</th>
                    <th class="text-end" style="width: 80px;">Harga</th>
                    <th class="text-end" style="width: 90px;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($details)): foreach ($details as $item): ?>
                        <tr>
                            <td colspan="4"><strong><?= esc($item['nama_barng']) ?></strong></td>
                        </tr>
                        <tr>
                            <td style="color: #475569; padding-left: 6px;">#<?= esc($item['detailbrgkode']) ?></td>
                            <td class="text-center"><?= esc($item['jumlah']) ?></td>
                            <td class="text-end"><?= number_format($item['detailhargajual'], 0, ',', '.') ?></td>
                            <td class="text-end"><strong><?= number_format($item['subtotal'], 0, ',', '.') ?></strong></td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>

        <div class="totals-block">
            <div class="totals-row grand-total">
                <span>TOTAL:</span>
                <span>Rp <?= number_format($header['totalharga'], 0, ',', '.') ?></span>
            </div>
            <div class="totals-row">
                <span>TUNAI / BAYAR:</span>
                <span>Rp <?= number_format($header['bayar'], 0, ',', '.') ?></span>
            </div>
            <div class="totals-row">
                <span>KEMBALI:</span>
                <span>Rp <?= number_format($header['kembali'], 0, ',', '.') ?></span>
            </div>
        </div>

        <div class="receipt-footer">
            <p style="margin: 0 0 4px 0; font-weight: bold;">-- TERIMA KASIH --</p>
            <p style="margin: 0;">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.</p>
            <p style="margin: 4px 0 0 0; font-style: italic;">Simpan struk ini sebagai bukti pembayaran sah.</p>
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