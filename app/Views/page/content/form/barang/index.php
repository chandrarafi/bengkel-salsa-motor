<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    /* DataTables & Compact Responsive Table Styles */
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
    <h6 class="fw-semibold mb-0 text-lg">Kelola Barang & Sparepart</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Kelola Barang</li>
    </ul>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-20 alert alert-success bg-success-100 text-success-600 border-success-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:check-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('success') ?>
        </div>
        <button class="remove-button text-success-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('error') ?>
        </div>
        <button class="remove-button text-danger-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<!-- Barang Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Data Barang & Sparepart</h6>
        <a href="<?= site_url('admin/barang/create') ?>" class="btn btn-primary-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah Barang
        </a>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 60px;" class="text-center">Gambar</th>
                        <th scope="col" style="width: 100px;">Kode</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-center" style="width: 90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $barangList = $barang ?? [];
                        if (!empty($barangList)) : 
                            $no = 1; 
                            foreach ($barangList as $item) : 
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td class="text-center">
                                <?php if (!empty($item['gambar']) && file_exists(ROOTPATH . 'public/uploads/barang/' . $item['gambar'])): ?>
                                    <img src="<?= base_url('uploads/barang/' . $item['gambar']) ?>" alt="<?= esc($item['nama_barng']) ?>" class="w-36-px h-36-px rounded-6 object-fit-cover border">
                                <?php else: ?>
                                    <div class="w-36-px h-36-px rounded-6 bg-neutral-100 text-neutral-400 d-inline-flex align-items-center justify-content-center border text-base">
                                        <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($item['kode']) ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-neutral-800 text-sm d-block mb-0"><?= esc($item['nama_barng']) ?></span>
                            </td>
                            <td>
                                <span class="badge bg-primary-focus text-primary-600 px-10 py-4 rounded-pill fw-medium text-xs d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:tag-horizontal-bold-duotone"></iconify-icon>
                                    <?= esc($item['namakategori'] ?: 'Tanpa Kategori') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info-focus text-info-main px-10 py-4 rounded-pill fw-medium text-xs d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                                    <?= esc($item['nama_satuan'] ?: 'Tanpa Satuan') ?>
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-neutral-800 text-xs">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                            </td>
                            <td class="text-center">
                                <?php 
                                    $stok = (int)$item['stok'];
                                    if ($stok > 10) {
                                        echo '<span class="badge bg-success-focus text-success-main px-8 py-3 rounded-pill fw-semibold text-xs">' . $stok . '</span>';
                                    } elseif ($stok > 0) {
                                        echo '<span class="badge bg-warning-focus text-warning-main px-8 py-3 rounded-pill fw-semibold text-xs">' . $stok . '</span>';
                                    } else {
                                        echo '<span class="badge bg-danger-focus text-danger-main px-8 py-3 rounded-pill fw-semibold text-xs">Habis</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <a href="<?= site_url('admin/barang/edit/' . $item['kode']) ?>" class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white text-xs" title="Edit Barang">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <button type="button" onclick="confirmDelete('<?= esc($item['kode']) ?>', '<?= esc($item['nama_barng']) ?>')" class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" title="Hapus Barang">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center text-secondary-light py-4">Belum ada data barang & sparepart.</td>
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
                    zeroRecords: "Tidak ada data barang yang ditemukan",
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

    function confirmDelete(kode, nama) {
        Swal.fire({
            title: 'Hapus Barang?',
            text: 'Barang "' + nama + '" (Kode: ' + kode + ') akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('admin/barang/delete/') ?>' + kode,
                    type: 'GET',
                    dataType: 'json',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: response.message,
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data barang.' });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
