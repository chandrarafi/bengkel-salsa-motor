<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>

<!-- Page Title & Breadcrumb -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h5 class="fw-bold mb-1">Dashboard Bengkel Motor</h5>
        <p class="text-secondary-light text-sm mb-0">Selamat datang! Ringkasan operasional servis, stok sparepart, dan transaksi hari ini.</p>
    </div>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
    </ul>
</div>

<!-- Stat Cards Grid -->
<div class="row gy-4 mb-24">
    <!-- Card 1: Servis Hari Ini -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card p-24 shadow-none radius-12 border h-100 bg-gradient-start-1">
            <div class="card-body p-0">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-16">
                    <div class="w-50-px h-50-px radius-12 bg-primary-50 text-primary-600 d-flex justify-content-center align-items-center text-2xl">
                        <iconify-icon icon="solar:settings-minimalistic-bold-duotone"></iconify-icon>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-12 py-6 radius-8 text-xs font-semibold">
                        <i class="ri-arrow-up-line me-1"></i> +4 Motor
                    </span>
                </div>
                <span class="text-secondary-light fw-medium text-sm d-block mb-4">Servis Selesai Hari Ini</span>
                <h4 class="fw-bold mb-0 text-dark"><?= esc($stats['servisHariIni']) ?> Motor</h4>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Pendapatan -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card p-24 shadow-none radius-12 border h-100 bg-gradient-start-2">
            <div class="card-body p-0">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-16">
                    <div class="w-50-px h-50-px radius-12 bg-purple-50 text-purple d-flex justify-content-center align-items-center text-2xl">
                        <iconify-icon icon="solar:wallet-money-bold-duotone"></iconify-icon>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-12 py-6 radius-8 text-xs font-semibold">
                        <i class="ri-arrow-up-line me-1"></i> +15%
                    </span>
                </div>
                <span class="text-secondary-light fw-medium text-sm d-block mb-4">Pendapatan Servis & Sparepart</span>
                <h4 class="fw-bold mb-0 text-dark"><?= esc($stats['totalPendapatan']) ?></h4>
            </div>
        </div>
    </div>

    <!-- Card 3: Stok Sparepart -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card p-24 shadow-none radius-12 border h-100 bg-gradient-start-3">
            <div class="card-body p-0">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-16">
                    <div class="w-50-px h-50-px radius-12 bg-info-50 text-info d-flex justify-content-center align-items-center text-2xl">
                        <iconify-icon icon="solar:box-minimalistic-bold-duotone"></iconify-icon>
                    </div>
                    <span class="badge bg-info-subtle text-info border border-info-subtle px-12 py-6 radius-8 text-xs font-semibold">
                        Stok Aman
                    </span>
                </div>
                <span class="text-secondary-light fw-medium text-sm d-block mb-4">Total Stok Sparepart</span>
                <h4 class="fw-bold mb-0 text-dark"><?= esc($stats['stokSparepart']) ?></h4>
            </div>
        </div>
    </div>

    <!-- Card 4: Antrian Servis -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card p-24 shadow-none radius-12 border h-100 bg-gradient-start-4">
            <div class="card-body p-0">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-16">
                    <div class="w-50-px h-50-px radius-12 bg-warning-50 text-warning d-flex justify-content-center align-items-center text-2xl">
                        <iconify-icon icon="solar:clock-circle-bold-duotone"></iconify-icon>
                    </div>
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-12 py-6 radius-8 text-xs font-semibold">
                        Menunggu
                    </span>
                </div>
                <span class="text-secondary-light fw-medium text-sm d-block mb-4">Antrian Servis Saat Ini</span>
                <h4 class="fw-bold mb-0 text-dark"><?= esc($stats['antrianServis']) ?></h4>
            </div>
        </div>
    </div>
</div>

<!-- Charts & Workshop Summary Section -->
<div class="row gy-4 mb-24">
    <!-- Main Performance Chart -->
    <div class="col-xxl-8">
        <div class="card radius-12 border shadow-none h-100">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                <h6 class="text-lg fw-semibold mb-0">Grafik Pendapatan & Jumlah Servis Mingguan</h6>
                <span class="badge bg-light text-dark border">Agustus 2026</span>
            </div>
            <div class="card-body p-24">
                <div id="bengkelChart" style="min-height: 320px;"></div>
            </div>
        </div>
    </div>

    <!-- Workshop Operational Status -->
    <div class="col-xxl-4">
        <div class="card radius-12 border shadow-none h-100">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Status Operasional Bengkel</h6>
            </div>
            <div class="card-body p-24">
                <div class="mb-20">
                    <div class="d-flex align-items-center justify-content-between mb-8">
                        <span class="text-secondary-light fw-medium">Penggunaan Pit Servis (4 / 5 Pit)</span>
                        <span class="fw-semibold text-primary-600">80%</span>
                    </div>
                    <div class="progress progress-sm radius-4" style="height: 8px;">
                        <div class="progress-bar bg-primary-600" role="progressbar" style="width: 80%;"></div>
                    </div>
                </div>

                <div class="mb-20">
                    <div class="d-flex align-items-center justify-content-between mb-8">
                        <span class="text-secondary-light fw-medium">Ketersediaan Mekanik</span>
                        <span class="fw-semibold text-success">3 Mekanik Bertugas</span>
                    </div>
                    <div class="progress progress-sm radius-4" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"></div>
                    </div>
                </div>

                <div class="mb-24">
                    <div class="d-flex align-items-center justify-content-between mb-8">
                        <span class="text-secondary-light fw-medium">Stok Oli Mesin Utama</span>
                        <span class="fw-semibold text-info">85% Tersedia</span>
                    </div>
                    <div class="progress progress-sm radius-4" style="height: 8px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 85%;"></div>
                    </div>
                </div>

                <div class="p-16 radius-8 bg-neutral-100 border d-flex align-items-center gap-3">
                    <div class="w-40-px h-40-px radius-8 bg-primary-100 text-primary-600 d-flex justify-content-center align-items-center flex-shrink-0 text-xl">
                        <iconify-icon icon="solar:wrench-bold"></iconify-icon>
                    </div>
                    <div>
                        <h6 class="text-sm fw-semibold mb-1">Bengkel Siap Beroperasi</h6>
                        <span class="text-xs text-secondary-light">Semua pit servis & perlatan dalam kondisi baik.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Motor Service Table -->
<div class="card radius-12 border shadow-none mb-24">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Daftar Servis & Transaksi Bengkel Terbaru</h6>
        <button class="btn btn-sm btn-primary">
            <i class="ri-add-line me-1"></i> Tambah Servis Baru
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-24">No. Nota</th>
                        <th>Pelanggan & Motor</th>
                        <th>Jenis Servis</th>
                        <th>Mekanik</th>
                        <th>Biaya Total</th>
                        <th>Status</th>
                        <th class="text-end pe-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentServices as $item) : ?>
                        <tr>
                            <td class="ps-24 font-monospace fw-semibold text-primary-600"><?= esc($item['nota']) ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="w-36-px h-36-px radius-circle bg-primary-100 text-primary-600 d-flex justify-content-center align-items-center font-bold">
                                        <iconify-icon icon="solar:motorbike-bold"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="text-sm fw-semibold mb-0"><?= esc($item['pelanggan']) ?></h6>
                                        <span class="text-xs text-secondary-light"><?= esc($item['motor']) ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-medium text-secondary-light"><?= esc($item['servis']) ?></span></td>
                            <td><span class="text-sm fw-medium text-dark"><i class="ri-user-star-line me-1 text-primary-600"></i><?= esc($item['mekanik']) ?></span></td>
                            <td><span class="fw-bold text-dark"><?= esc($item['biaya']) ?></span></td>
                            <td>
                                <?php if ($item['status'] === 'Selesai') : ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-12 py-6 radius-8 text-xs font-semibold">Selesai</span>
                                <?php elseif ($item['status'] === 'Dikerjakan') : ?>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-12 py-6 radius-8 text-xs font-semibold">Dikerjakan</span>
                                <?php else : ?>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-12 py-6 radius-8 text-xs font-semibold">Antri</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-24">
                                <button class="btn btn-sm btn-icon btn-light text-secondary me-1" title="Detail Servis">
                                    <iconify-icon icon="solar:eye-linear"></iconify-icon>
                                </button>
                                <button class="btn btn-sm btn-icon btn-light text-primary" title="Cetak Nota">
                                    <iconify-icon icon="solar:printer-linear"></iconify-icon>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof ApexCharts !== 'undefined') {
            var options = {
                series: [{
                    name: 'Pendapatan (Ribu Rp)',
                    data: [850, 1200, 950, 1400, 1100, 1800, 1650]
                }, {
                    name: 'Jumlah Motor Servis',
                    data: [12, 18, 14, 20, 16, 25, 24]
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                colors: ['#4880FF', '#FF9F43'],
                xaxis: {
                    categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
                },
                tooltip: { x: { format: 'dd/MM/yy' } }
            };

            var chart = new ApexCharts(document.querySelector("#bengkelChart"), options);
            chart.render();
        }
    });
</script>
<?= $this->endSection() ?>