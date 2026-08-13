<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    /* DataTables & Compact Table Styles */
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

    /* Large & Spacious Detail Modal */
    #detailModal .modal-dialog {
        max-width: 950px !important;
        width: 92% !important;
        margin: 1.75rem auto !important;
    }
    #detailModal .modal-title {
        display: inline-block !important;
        text-align: left !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
    }
    #modalTotal {
        color: #0f172a !important;
    }
    #detailModalTable th {
        background-color: #f1f5f9 !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 12px 14px !important;
        color: #334155 !important;
    }
    #detailModalTable td {
        font-size: 13px !important;
        padding: 10px 14px !important;
        vertical-align: middle !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Transaksi Barang Masuk</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Barang Masuk</li>
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

<!-- Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Riwayat Transaksi Barang Masuk</h6>
        <a href="<?= site_url('admin/barangmasuk/create') ?>" class="btn btn-primary-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Input Barang Masuk Baru
        </a>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 140px;">No. Faktur</th>
                        <th scope="col" style="width: 110px;">Tanggal</th>
                        <th scope="col">Total Pembelian</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $list = $barangMasuk ?? [];
                        if (!empty($list)) : 
                            $no = 1; 
                            foreach ($list as $item) : 
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-primary-focus text-primary-600 fw-bold text-xs">#<?= esc($item['faktur']) ?></span>
                            </td>
                            <td>
                                <span class="fw-medium text-neutral-800 text-xs"><?= date('d/m/Y', strtotime($item['tanggalfaktur'])) ?></span>
                            </td>
                            <td>
                                <span class="fw-bold text-success-main text-xs">Rp <?= number_format($item['totalharga'], 0, ',', '.') ?></span>
                            </td>
                            <td>
                                <span class="text-secondary-light text-xs"><?= esc($item['keterangan'] ?: '-') ?></span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" onclick="showDetail('<?= esc($item['faktur']) ?>')" class="w-28-px h-28-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-info-main hover-text-white border-0 text-xs" title="Lihat Detail Barang">
                                        <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                    </button>
                                    <a href="<?= site_url('admin/barangmasuk/edit/' . esc($item['faktur'])) ?>" class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white border-0 text-xs" title="Edit Transaksi">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <a href="<?= site_url('admin/barangmasuk/cetak/' . esc($item['faktur'])) ?>" target="_blank" class="w-28-px h-28-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-warning-main hover-text-white border-0 text-xs" title="Cetak Faktur">
                                        <iconify-icon icon="solar:printer-bold-duotone"></iconify-icon>
                                    </a>
                                    <button type="button" onclick="confirmDelete('<?= esc($item['faktur']) ?>')" class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" title="Hapus Transaksi">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary-light py-4">Belum ada riwayat transaksi barang masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Barang Masuk (Large & Clean) -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:document-text-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="detailModalLabel" style="font-size: 16px !important; text-align: left !important;">
                            Rincian Barang Masuk <span id="modalFakturTitle" class="text-primary-600 fw-bold ms-1" style="font-size: 16px !important;"></span>
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1" style="text-align: left !important;">Detail item barang yang dibeli pada transaksi ini</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="row g-3 mb-16 bg-neutral-50 p-16 radius-8 border align-items-center">
                    <div class="col-md-4">
                        <span class="text-xs text-secondary-light d-block">Tanggal Faktur:</span>
                        <span class="fw-semibold text-neutral-800 text-xs" id="modalTanggal"></span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-xs text-secondary-light d-block">Catatan / Supplier:</span>
                        <span class="fw-semibold text-neutral-800 text-xs" id="modalKeterangan">-</span>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="text-xs text-secondary-light d-block">Total Pembelian:</span>
                        <span class="fw-bold text-neutral-900 text-base" id="modalTotal" style="color: #0f172a !important;"></span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table bordered-table align-middle text-sm mb-0" id="detailModalTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th style="width: 110px;">Kode Barang</th>
                                <th>Nama Barang / Sparepart</th>
                                <th class="text-end" style="width: 120px;">Harga Beli</th>
                                <th class="text-end" style="width: 120px;">Harga Jual</th>
                                <th class="text-center" style="width: 80px;">Qty</th>
                                <th class="text-end" style="width: 130px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="detailTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 pb-20 px-24 d-flex align-items-center justify-content-between">
                <a id="btnCetakModal" href="#" target="_blank" class="btn btn-outline-primary-600 text-sm px-16 py-8 radius-8 d-inline-flex align-items-center gap-2">
                    <iconify-icon icon="solar:printer-bold-duotone" class="text-base"></iconify-icon> Cetak Faktur Ini
                </a>
                <button type="button" class="btn btn-secondary text-sm px-20 py-8 radius-8" data-bs-dismiss="modal">Tutup</button>
            </div>
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
                    zeroRecords: "Tidak ada transaksi yang ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ transaksi",
                    infoEmpty: "Menampilkan 0 transaksi",
                    infoFiltered: "(disaring dari _MAX_ total transaksi)",
                    paginate: { first: "«", last: "»", next: "›", previous: "‹" }
                }
            });
        }
    });

    function showDetail(faktur) {
        $.ajax({
            url: '<?= site_url('admin/barangmasuk/detail/') ?>' + faktur,
            type: 'GET',
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                if (response.status) {
                    $('#modalFakturTitle').text('#' + response.header.faktur);
                    $('#modalTanggal').text(response.header.tanggalfaktur);
                    $('#modalKeterangan').text(response.header.keterangan || '-');
                    $('#modalTotal').text('Rp ' + new Intl.NumberFormat('id-ID').format(response.header.totalharga));
                    $('#btnCetakModal').attr('href', '<?= site_url('admin/barangmasuk/cetak/') ?>' + response.header.faktur);

                    var html = '';
                    if (response.details && response.details.length > 0) {
                        $.each(response.details, function(idx, item) {
                            html += '<tr>' +
                                '<td class="text-center text-xs text-secondary-light">' + (idx + 1) + '</td>' +
                                '<td><span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#' + item.detailbrgkode + '</span></td>' +
                                '<td><span class="fw-semibold text-neutral-800 text-xs">' + item.nama_barng + '</span></td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.detailhargabeli) + '</td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.detailhargajual) + '</td>' +
                                '<td class="text-center"><span class="badge bg-primary-focus text-primary-600 px-8 py-3 rounded-pill text-xs fw-bold">' + item.jumlah + ' ' + (item.nama_satuan || '') + '</span></td>' +
                                '<td class="text-end fw-bold text-xs text-success-main">Rp ' + new Intl.NumberFormat('id-ID').format(item.subtotal) + '</td>' +
                            '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="7" class="text-center text-secondary-light py-3">Tidak ada rincian item.</td></tr>';
                    }
                    $('#detailTableBody').html(html);

                    var modal = new bootstrap.Modal(document.getElementById('detailModal'));
                    modal.show();
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                }
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal mengambil detail transaksi.' });
            }
        });
    }

    function confirmDelete(faktur) {
        Swal.fire({
            title: 'Hapus Transaksi?',
            text: 'Faktur "' + faktur + '" akan dihapus dan stok barang akan dikembalikan (dikurangi).',
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
                    url: '<?= site_url('admin/barangmasuk/delete/') ?>' + faktur,
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
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus transaksi barang masuk.' });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
