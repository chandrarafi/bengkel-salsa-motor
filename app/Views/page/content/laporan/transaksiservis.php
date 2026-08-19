<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    .bordered-table th {
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 10px 12px !important;
        background-color: #f8fafc !important;
        color: #374151 !important;
        white-space: nowrap;
    }
    .bordered-table td {
        font-size: 13px !important;
        padding: 10px 12px !important;
        vertical-align: top !important;
        color: #4b5563 !important;
    }
    .dataTables_info, .dataTables_paginate {
        font-size: 13px !important;
        margin-top: 14px !important;
    }
    .pagination .page-link {
        padding: 4px 10px !important;
        font-size: 12px !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Laporan Transaksi Servis Bengkel (Work Order)</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Laporan</li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Laporan Transaksi Servis</li>
    </ul>
</div>

<!-- Filter Card -->
<div class="card radius-12 border mb-24">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
        <h6 class="card-title mb-0 text-base fw-bold d-flex align-items-center gap-2">
            <iconify-icon icon="solar:filter-bold-duotone" class="text-primary-600 text-xl"></iconify-icon>
            Filter Laporan Transaksi Servis
        </h6>
        <?php 
            $queryStr = http_build_query(array_filter([
                'tgl_awal'  => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'status'    => $status,
            ]));
            $cetakUrl = site_url('admin/laporan/transaksiservis/cetak') . ($queryStr ? '?' . $queryStr : '');
        ?>
        <a href="<?= $cetakUrl ?>" target="_blank" class="btn btn-danger-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:printer-bold" class="text-base"></iconify-icon> Cetak PDF / Print
        </a>
    </div>
    <div class="card-body p-20">
        <form method="get" action="<?= site_url('admin/laporan/transaksiservis') ?>" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Tanggal Awal</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="solar:calendar-date-bold-duotone"></iconify-icon>
                    </span>
                    <input type="date" name="tgl_awal" class="form-control form-control-sm radius-8" value="<?= esc($tgl_awal) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Tanggal Akhir</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="solar:calendar-date-bold-duotone"></iconify-icon>
                    </span>
                    <input type="date" name="tgl_akhir" class="form-control form-control-sm radius-8" value="<?= esc($tgl_akhir) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Status Transaksi</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"></iconify-icon>
                    </span>
                    <select name="status" class="form-select form-select-sm radius-8">
                        <option value="">-- Semua Status --</option>
                        <option value="proses" <?= ($status == 'proses') ? 'selected' : '' ?>>Proses Pengerjaan</option>
                        <option value="selesai" <?= ($status == 'selesai') ? 'selected' : '' ?>>Selesai Pengerjaan</option>
                        <option value="lunas" <?= ($status == 'lunas') ? 'selected' : '' ?>>Lunas / Selesai Bayar</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-2 fw-semibold">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon> Filter Data
                </button>
                <?php if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status)): ?>
                    <a href="<?= site_url('admin/laporan/transaksiservis') ?>" class="btn btn-outline-neutral-400 text-neutral-700 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="solar:restart-bold" class="text-base"></iconify-icon> Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Laporan Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Transaksi Servis Bengkel <?= (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status)) ? '(Terfilter)' : '' ?></h6>
        <div class="d-flex align-items-center gap-3 text-xs text-secondary-light">
            <span>Periode: <strong><?= !empty($tgl_awal) ? date('d/m/Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d/m/Y', strtotime($tgl_akhir)) : 'Hari Ini' ?></strong></span>
            <span>|</span>
            <span>Total Transaksi: <strong><?= number_format($totalFaktur ?? 0, 0, ',', '.') ?> faktur</strong></span>
            <span>|</span>
            <span>Total Omset Servis: <strong class="text-success-main fw-bold">Rp <?= number_format($totalNominal ?? 0, 0, ',', '.') ?></strong></span>
        </div>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 130px;">No. Faktur</th>
                        <th scope="col" class="text-center" style="width: 100px;">Tanggal</th>
                        <th scope="col" style="width: 140px;">Pelanggan & Kendaraan</th>
                        <th scope="col">Rincian Jasa Servis & Sparepart</th>
                        <th scope="col" class="text-end" style="width: 100px;">DP Booking</th>
                        <th scope="col" class="text-end" style="width: 120px;">Total Servis (Rp)</th>
                        <th scope="col" class="text-center" style="width: 90px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $items = $dataLaporan ?? [];
                        if (!empty($items)) : 
                            $no = 1; 
                            foreach ($items as $row) : 
                                $header    = $row['header'];
                                $details   = $row['details'];
                                $faktur    = $header['faktur'];
                                $tglFaktur = $header['tglfaktur'] ?? $header['created_at'] ?? '-';
                                $pelanggan = $header['nama_pelanggan'] ?: 'Pelanggan Umum';
                                $total     = (float)($header['totalharga'] ?? 0);
                                $dp        = (float)($header['dp_booking'] ?? 0);
                                $st        = $header['status'] ?? 'proses';
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-primary-focus text-primary-600 fw-bold text-xs">#<?= esc($faktur) ?></span>
                            </td>
                            <td class="text-center text-xs">
                                <?= !empty($tglFaktur) && $tglFaktur !== '-' ? date('d/m/Y', strtotime($tglFaktur)) : '-' ?>
                            </td>
                            <td>
                                <strong class="text-neutral-800 text-xs d-block"><?= esc($pelanggan) ?></strong>
                                <span class="text-secondary-light text-xs"><?= esc($header['merkkendaraan'] ?: '-') ?></span>
                                <?php if (!empty($header['nopol'])): ?>
                                    <div class="badge bg-neutral-200 text-secondary-light text-xxs px-6 py-2 radius-4 mt-1"><?= esc($header['nopol']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($details)): ?>
                                    <div class="d-flex flex-column gap-1">
                                        <?php foreach ($details as $d): ?>
                                            <div class="d-flex align-items-center justify-content-between text-xs border-bottom pb-1 mb-1">
                                                <span>
                                                    <?php if (!empty($d['jenis_servis'])): ?>
                                                        <span class="badge bg-info-focus text-info-main px-6 py-2 radius-4 me-1">Jasa</span>
                                                        <strong class="text-neutral-800"><?= esc($d['jenis_servis']) ?></strong>
                                                    <?php elseif (!empty($d['nama_barng'])): ?>
                                                        <span class="badge bg-primary-focus text-primary-600 px-6 py-2 radius-4 me-1">Part</span>
                                                        <strong class="text-neutral-800"><?= esc($d['nama_barng']) ?></strong>
                                                        <span class="text-secondary-light ms-1 font-normal">(<?= esc($d['detjml']) ?> <?= esc($d['nama_satuan'] ?: 'pcs') ?>)</span>
                                                    <?php else: ?>
                                                        <span class="text-neutral-800">Item Detail</span>
                                                    <?php endif; ?>
                                                </span>
                                                <span class="text-neutral-700 fw-semibold ms-2">
                                                    Rp <?= number_format($d['dettotaljual'], 0, ',', '.') ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-xs text-secondary-light">- Tidak ada rincian item -</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end text-xs text-secondary-light">
                                Rp <?= number_format($dp, 0, ',', '.') ?>
                            </td>
                            <td class="text-end fw-bold text-success-main text-xs">
                                Rp <?= number_format($total, 0, ',', '.') ?>
                            </td>
                            <td class="text-center">
                                <?php
                                    if ($st === 'lunas') {
                                        echo '<span class="badge bg-success-focus text-success-main px-8 py-3 rounded-pill fw-bold text-xs">Lunas</span>';
                                    } elseif ($st === 'selesai') {
                                        echo '<span class="badge bg-info-focus text-info-main px-8 py-3 rounded-pill fw-bold text-xs">Selesai</span>';
                                    } else {
                                        echo '<span class="badge bg-warning-focus text-warning-main px-8 py-3 rounded-pill fw-bold text-xs">Proses</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        if ($('#dataTable').length) {
            new DataTable('#dataTable', {
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Tidak ada transaksi servis yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ faktur",
                    infoEmpty: "Menampilkan 0 faktur",
                    infoFiltered: "(disaring dari _MAX_ total faktur)",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>
