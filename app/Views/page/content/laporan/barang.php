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
    .metric-card {
        border-radius: 12px;
        padding: 16px 20px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Laporan Data Barang & Sparepart</h6>
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
        <li class="fw-medium text-secondary-light">Laporan Barang</li>
    </ul>
</div>

<!-- Filter Card -->
<div class="card radius-12 border mb-24">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
        <h6 class="card-title mb-0 text-base fw-bold d-flex align-items-center gap-2">
            <iconify-icon icon="solar:filter-bold-duotone" class="text-primary-600 text-xl"></iconify-icon>
            Filter Laporan Barang berdasarkan Kategori
        </h6>
        <?php 
            $queryStr = http_build_query(array_filter([
                'idkategori' => $idkategori,
            ]));
            $cetakUrl = site_url('admin/laporan/barang/cetak') . ($queryStr ? '?' . $queryStr : '');
        ?>
        <a href="<?= $cetakUrl ?>" target="_blank" class="btn btn-danger-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:printer-bold" class="text-base"></iconify-icon> Cetak PDF / Print
        </a>
    </div>
    <div class="card-body p-20">
        <form method="get" action="<?= site_url('admin/laporan/barang') ?>" class="row g-3 align-items-end">
            <div class="col-md-6 col-lg-5">
                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Pilih Kategori Barang</label>
                <div class="icon-field">
                    <span class="icon">
                        <iconify-icon icon="solar:tag-horizontal-bold-duotone"></iconify-icon>
                    </span>
                    <select name="idkategori" class="form-select form-select-sm radius-8">
                        <option value="">-- Semua Kategori --</option>
                        <?php if (!empty($kategoriList)): foreach ($kategoriList as $kat): ?>
                            <option value="<?= $kat['idkategori'] ?>" <?= ($idkategori == $kat['idkategori']) ? 'selected' : '' ?>>
                                <?= esc($kat['namakategori']) ?>
                            </option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center gap-2">
                <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-2 fw-semibold">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon> Filter Kategori
                </button>
                <?php if (!empty($idkategori)): ?>
                    <a href="<?= site_url('admin/laporan/barang') ?>" class="btn btn-outline-neutral-400 text-neutral-700 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-1">
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
        <h6 class="card-title mb-0 text-base fw-bold">Data Barang <?= !empty($selectedKategori) ? 'Kategori: ' . esc($selectedKategori['namakategori']) : '(Semua Kategori)' ?></h6>
        <span class="text-xs text-secondary-light">
            Kategori: <?= !empty($selectedKategori) ? esc($selectedKategori['namakategori']) : 'Semua Kategori' ?>
        </span>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 90px;">Kode</th>
                        <th scope="col">Nama Barang / Sparepart</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Satuan</th>
                        <th scope="col" class="text-end">Harga Beli</th>
                        <th scope="col" class="text-end">Harga Jual</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-end">Total Asset (Beli)</th>
                        <th scope="col" class="text-center">Tgl Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $barangList = $barang ?? [];
                        if (!empty($barangList)) : 
                            $no = 1; 
                            foreach ($barangList as $item) : 
                                $stok      = (int)($item['stok'] ?? 0);
                                $hargaBeli = (float)($item['harga_beli'] ?? 0);
                                $hargaJual = (float)($item['harga_jual'] ?? 0);
                                $subAsset  = $stok * $hargaBeli;
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($item['kode']) ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-neutral-800 text-sm d-block mb-0"><?= esc($item['nama_barng']) ?></span>
                            </td>
                            <td>
                                <span class="badge bg-primary-focus text-primary-600 px-10 py-4 rounded-pill fw-medium text-xs d-inline-flex align-items-center gap-1">
                                    <?= esc($item['namakategori'] ?: 'Tanpa Kategori') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info-focus text-info-main px-10 py-4 rounded-pill fw-medium text-xs d-inline-flex align-items-center gap-1">
                                    <?= esc($item['nama_satuan'] ?: 'Tanpa Satuan') ?>
                                </span>
                            </td>
                            <td class="text-end fw-semibold text-warning-main text-xs">
                                Rp <?= number_format($hargaBeli, 0, ',', '.') ?>
                            </td>
                            <td class="text-end fw-bold text-success-main text-xs">
                                Rp <?= number_format($hargaJual, 0, ',', '.') ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    if ($stok > 10) {
                                        echo '<span class="badge bg-success-focus text-success-main px-8 py-3 rounded-pill fw-semibold text-xs">' . $stok . '</span>';
                                    } elseif ($stok > 0) {
                                        echo '<span class="badge bg-warning-focus text-warning-main px-8 py-3 rounded-pill fw-semibold text-xs">' . $stok . '</span>';
                                    } else {
                                        echo '<span class="badge bg-danger-focus text-danger-main px-8 py-3 rounded-pill fw-semibold text-xs">Habis</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-end fw-bold text-neutral-800 text-xs">
                                Rp <?= number_format($subAsset, 0, ',', '.') ?>
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
                    zeroRecords: "Tidak ada data barang yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ barang",
                    infoEmpty: "Menampilkan 0 barang",
                    infoFiltered: "(disaring dari _MAX_ total barang)",
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
