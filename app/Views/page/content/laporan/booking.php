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
        vertical-align: middle !important;
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
    <h6 class="fw-semibold mb-0 text-lg">Laporan Booking Servis Online</h6>
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
        <li class="fw-medium text-secondary-light">Laporan Booking Servis</li>
    </ul>
</div>

<!-- Filter Card -->
<div class="card radius-12 border mb-24">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
        <h6 class="card-title mb-0 text-base fw-bold d-flex align-items-center gap-2">
            <iconify-icon icon="solar:filter-bold-duotone" class="text-primary-600 text-xl"></iconify-icon>
            Filter Laporan Booking Servis
        </h6>
        <?php 
            $queryStr = http_build_query(array_filter([
                'tgl_awal'       => $tgl_awal,
                'tgl_akhir'      => $tgl_akhir,
                'status_booking' => $status_booking,
            ]));
            $cetakUrl = site_url('admin/laporan/booking/cetak') . ($queryStr ? '?' . $queryStr : '');
        ?>
        <a href="<?= $cetakUrl ?>" target="_blank" class="btn btn-danger-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:printer-bold" class="text-base"></iconify-icon> Cetak PDF / Print
        </a>
    </div>
    <div class="card-body p-20">
        <form method="get" action="<?= site_url('admin/laporan/booking') ?>" class="row g-3 align-items-end">
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
                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Status Booking</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"></iconify-icon>
                    </span>
                    <select name="status_booking" class="form-select form-select-sm radius-8">
                        <option value="">-- Semua Status --</option>
                        <option value="menunggu_pembayaran" <?= ($status_booking == 'menunggu_pembayaran') ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                        <option value="menunggu_konfirmasi" <?= ($status_booking == 'menunggu_konfirmasi') ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                        <option value="dikonfirmasi" <?= ($status_booking == 'dikonfirmasi') ? 'selected' : '' ?>>Dikonfirmasi</option>
                        <option value="selesai" <?= ($status_booking == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                        <option value="dibatalkan" <?= ($status_booking == 'dibatalkan') ? 'selected' : '' ?>>Dibatalkan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-2 fw-semibold">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon> Filter
                </button>
                <?php if (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status_booking)): ?>
                    <a href="<?= site_url('admin/laporan/booking') ?>" class="btn btn-outline-neutral-400 text-neutral-700 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-1">
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
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Booking Servis Online <?= (!empty($tgl_awal) || !empty($tgl_akhir) || !empty($status_booking)) ? '(Terfilter)' : '' ?></h6>
        <div class="d-flex align-items-center gap-3 text-xs text-secondary-light">
            <span>Periode: <strong><?= !empty($tgl_awal) ? date('d/m/Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d/m/Y', strtotime($tgl_akhir)) : 'Hari Ini' ?></strong></span>
            <span>|</span>
            <span>Total Booking: <strong><?= number_format($totalBooking ?? 0, 0, ',', '.') ?> data</strong></span>
            <span>|</span>
            <span>Total DP Diterima: <strong class="text-success-main fw-bold">Rp <?= number_format($totalDP ?? 0, 0, ',', '.') ?></strong></span>
        </div>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 120px;">Kode Booking</th>
                        <th scope="col" class="text-center" style="width: 110px;">Jadwal Servis</th>
                        <th scope="col">Pelanggan & Kontak</th>
                        <th scope="col">Kendaraan & Nopol</th>
                        <th scope="col">Jenis Servis</th>
                        <th scope="col" class="text-end" style="width: 100px;">DP Servis</th>
                        <th scope="col" class="text-center">Status Pembayaran</th>
                        <th scope="col" class="text-center">Status Booking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $items = $bookingList ?? [];
                        if (!empty($items)) : 
                            $no = 1; 
                            foreach ($items as $b) : 
                                $dp = (float)($b['biaya'] ?? 0);
                                $tglBkg = !empty($b['tgl_booking']) ? date('d/m/Y', strtotime($b['tgl_booking'])) : '-';
                                $jamBkg = !empty($b['jam_booking']) ? date('H:i', strtotime($b['jam_booking'])) : '';
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-primary-focus text-primary-600 fw-bold text-xs">#<?= esc($b['kode_booking']) ?></span>
                            </td>
                            <td class="text-center text-xs">
                                <strong><?= esc($tglBkg) ?></strong>
                                <?php if ($jamBkg): ?>
                                    <div class="text-secondary-light"><?= esc($jamBkg) ?> WIB</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong class="text-neutral-800 text-xs d-block"><?= esc($b['nama_pelanggan']) ?></strong>
                                <span class="text-secondary-light text-xs"><?= esc($b['no_hp'] ?: '-') ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-xs"><?= esc($b['merkkendaraan'] ?: '-') ?></span>
                                <?php if (!empty($b['nopol'])): ?>
                                    <div class="badge bg-neutral-200 text-secondary-light text-xxs px-6 py-2 radius-4"><?= esc($b['nopol']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="text-xs">
                                <?= esc($b['jenis_servis'] ?: '-') ?>
                            </td>
                            <td class="text-end fw-bold text-success-main text-xs">
                                Rp <?= number_format($dp, 0, ',', '.') ?>
                            </td>
                            <td class="text-center">
                                <?php
                                    $stPay = $b['status_pembayaran'] ?? '';
                                    if ($stPay === 'lunas' || $stPay === 'disetujui') {
                                        echo '<span class="badge bg-success-focus text-success-main px-8 py-3 rounded-pill text-xs fw-bold">Lunas</span>';
                                    } elseif ($stPay === 'menunggu_konfirmasi') {
                                        echo '<span class="badge bg-warning-focus text-warning-main px-8 py-3 rounded-pill text-xs fw-bold">Menunggu Konfirmasi</span>';
                                    } elseif ($stPay === 'menunggu_pembayaran') {
                                        echo '<span class="badge bg-info-focus text-info-main px-8 py-3 rounded-pill text-xs fw-bold">Menunggu Bayar</span>';
                                    } else {
                                        echo '<span class="badge bg-neutral-200 text-secondary-light px-8 py-3 rounded-pill text-xs fw-bold">' . esc(ucfirst($stPay ?: '-')) . '</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                    $stBkg = $b['status_booking'] ?? '';
                                    if ($stBkg === 'dikonfirmasi') {
                                        echo '<span class="badge bg-primary-focus text-primary-600 px-8 py-3 rounded-pill text-xs fw-bold">Dikonfirmasi</span>';
                                    } elseif ($stBkg === 'selesai') {
                                        echo '<span class="badge bg-success-focus text-success-main px-8 py-3 rounded-pill text-xs fw-bold">Selesai</span>';
                                    } elseif ($stBkg === 'dibatalkan') {
                                        echo '<span class="badge bg-danger-focus text-danger-main px-8 py-3 rounded-pill text-xs fw-bold">Dibatalkan</span>';
                                    } else {
                                        echo '<span class="badge bg-warning-focus text-warning-main px-8 py-3 rounded-pill text-xs fw-bold">Pending</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center text-secondary-light py-4">Tidak ada data booking servis yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
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
                    zeroRecords: "Tidak ada booking servis yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ booking",
                    infoEmpty: "Menampilkan 0 booking",
                    infoFiltered: "(disaring dari _MAX_ total booking)",
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
