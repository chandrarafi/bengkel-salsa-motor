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
        padding: 8px 12px !important;
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
    <h6 class="fw-semibold mb-0 text-lg">Laporan Data Jenis Servis & Jasa Bengkel</h6>
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
        <li class="fw-medium text-secondary-light">Laporan Jenis Servis</li>
    </ul>
</div>

<!-- Filter Card -->
<div class="card radius-12 border mb-24">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
        <h6 class="card-title mb-0 text-base fw-bold d-flex align-items-center gap-2">
            <iconify-icon icon="solar:filter-bold-duotone" class="text-primary-600 text-xl"></iconify-icon>
            Pencarian Laporan Jenis Servis
        </h6>
        <?php 
            $queryStr = http_build_query(array_filter([
                'q' => $q,
            ]));
            $cetakUrl = site_url('admin/laporan/servis/cetak') . ($queryStr ? '?' . $queryStr : '');
        ?>
        <a href="<?= $cetakUrl ?>" target="_blank" class="btn btn-danger-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:printer-bold" class="text-base"></iconify-icon> Cetak PDF / Print
        </a>
    </div>
    <div class="card-body p-20">
        <form method="get" action="<?= site_url('admin/laporan/servis') ?>" class="row g-3 align-items-end">
            <div class="col-md-6 col-lg-5">
                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Kata Kunci Pencarian</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                    </span>
                    <input type="text" name="q" class="form-control form-control-sm radius-8" value="<?= esc($q) ?>" placeholder="Cari kode, nama servis, atau keterangan...">
                </div>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-2 fw-semibold">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon> Cari Servis
                </button>
                <?php if (!empty($q)): ?>
                    <a href="<?= site_url('admin/laporan/servis') ?>" class="btn btn-outline-neutral-400 text-neutral-700 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-1">
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
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Jenis Servis & Layanan <?= !empty($q) ? '(Kata Kunci: "' . esc($q) . '")' : '' ?></h6>
        <span class="text-xs text-secondary-light">
            Total Servis: <strong><?= number_format(count($servisList ?? []), 0, ',', '.') ?> jenis</strong>
        </span>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 110px;">Kode Servis</th>
                        <th scope="col">Nama Jenis Servis</th>
                        <th scope="col" class="text-end">Biaya Jasa (Rp)</th>
                        <th scope="col" class="text-center">Estimasi Waktu</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-center">Tgl Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $items = $servisList ?? [];
                        if (!empty($items)) : 
                            $no = 1; 
                            foreach ($items as $item) : 
                                $namaJenis = $item['jenis_servis'] ?? $item['Jenis_servis'] ?? '-';
                                $biaya     = (float)($item['biaya'] ?? $item['Biaya'] ?? 0);
                                $ket       = $item['keterangan'] ?? $item['Keterangan'] ?? '-';
                                $estimasi  = !empty($item['estimasi_waktu']) ? $item['estimasi_waktu'] . ' menit' : '-';
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($item['kodeservis']) ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-neutral-800 text-sm d-block mb-0"><?= esc($namaJenis) ?></span>
                            </td>
                            <td class="text-end fw-bold text-success-main text-xs">
                                Rp <?= number_format($biaya, 0, ',', '.') ?>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info-focus text-info-main px-10 py-4 rounded-pill fw-medium text-xs">
                                    <?= esc($estimasi) ?>
                                </span>
                            </td>
                            <td class="text-xs text-secondary-light">
                                <?= esc($ket ?: '-') ?>
                            </td>
                            <td class="text-center text-xs text-secondary-light">
                                <?= !empty($item['created_at']) ? date('d/m/Y', strtotime($item['created_at'])) : '-' ?>
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
                    zeroRecords: "Tidak ada jenis servis yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ servis",
                    infoEmpty: "Menampilkan 0 servis",
                    infoFiltered: "(disaring dari _MAX_ total servis)",
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
