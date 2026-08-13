<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    .bordered-table th {
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 12px 14px !important;
        background-color: #f8fafc !important;
        color: #374151 !important;
        white-space: nowrap;
    }

    .bordered-table td {
        font-size: 13px !important;
        padding: 10px 14px !important;
        vertical-align: middle !important;
        color: #4b5563 !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= site_url('admin/penjualan') ?>" class="w-36-px h-36-px bg-neutral-100 text-neutral-700 rounded-circle d-flex align-items-center justify-content-center hover-bg-neutral-200" title="Kembali ke Riwayat">
            <iconify-icon icon="mingcute:left-line" class="text-lg"></iconify-icon>
        </a>
        <h6 class="fw-semibold mb-0 text-lg">Detail Transaksi Penjualan #<?= esc($header['faktur']) ?></h6>
    </div>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium">
            <a href="<?= site_url('admin/penjualan') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                Penjualan Barang
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Detail Transaksi</li>
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

<?php $isSelesai = (($header['status'] ?? '') === 'selesai'); ?>

<div class="row g-4 mb-24">
    <!-- Header Info Card -->
    <div class="col-lg-6">
        <div class="card radius-12 border h-100">
            <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
                <h6 class="card-title mb-0 text-base fw-bold">Informasi Faktur & Pelanggan</h6>
                <?php if ($isSelesai): ?>
                    <span class="badge bg-success-focus text-success-main px-12 py-4 radius-4 text-xs fw-bold">Selesai (Lunas)</span>
                <?php else: ?>
                    <span class="badge bg-warning-focus text-warning-main px-12 py-4 radius-4 text-xs fw-bold">Belum Lunas (Pending)</span>
                <?php endif; ?>
            </div>
            <div class="card-body p-20">
                <div class="row g-3">
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">No. Faktur Penjualan:</span>
                        <span class="badge bg-primary-focus text-primary-600 fw-bold text-sm px-10 py-4">#<?= esc($header['faktur']) ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Tanggal Transaksi:</span>
                        <span class="fw-semibold text-neutral-800 text-sm"><?= date('d F Y', strtotime($header['tglfaktur'])) ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Nama Pelanggan / Pembeli:</span>
                        <span class="fw-bold text-neutral-900 text-sm"><?= esc($header['nama_pelanggan'] ?: 'Pelanggan Umum') ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Waktu Dibuat:</span>
                        <span class="text-xs text-neutral-700"><?= date('d/m/Y H:i', strtotime($header['created_at'] ?? $header['tglfaktur'])) ?></span>
                    </div>
                    <div class="col-12 border-top pt-12">
                        <span class="text-xs text-secondary-light d-block mb-1">Catatan / Keterangan:</span>
                        <span class="text-xs text-neutral-700"><?= esc($header['keterangan'] ?: '-') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Processing / Summary Card -->
    <div class="col-lg-6">
        <div class="card radius-12 border h-100">
            <div class="card-header border-bottom border-neutral-200 px-20 py-14">
                <h6 class="card-title mb-0 text-base fw-bold">
                    <?= $isSelesai ? 'Ringkasan Pembayaran' : 'Proses Pembayaran Penjualan' ?>
                </h6>
            </div>
            <div class="card-body p-20">
                <div class="d-flex align-items-center justify-content-between bg-neutral-50 p-16 radius-8 border mb-16">
                    <span class="text-sm fw-bold text-neutral-800">Total Penjualan:</span>
                    <span class="fw-bold text-neutral-900 text-xl" style="color: #0f172a !important;">Rp <?= number_format($header['totalharga'], 0, ',', '.') ?></span>
                </div>

                <?php if ($isSelesai): ?>
                    <!-- Summary when paid -->
                    <div class="row g-3 mb-20">
                        <div class="col-6">
                            <span class="text-xs text-secondary-light d-block">Uang Pembayaran:</span>
                            <span class="fw-bold text-success-main text-base">Rp <?= number_format($header['bayar'], 0, ',', '.') ?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-xs text-secondary-light d-block">Uang Kembalian:</span>
                            <span class="fw-bold text-neutral-900 text-base" style="color: #0f172a !important;">Rp <?= number_format($header['kembali'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="<?= site_url('admin/penjualan/cetak/' . esc($header['faktur'])) ?>" target="_blank" class="btn btn-warning-600 radius-8 px-20 py-10 text-sm d-inline-flex align-items-center gap-2 fw-semibold">
                            <iconify-icon icon="solar:printer-bold-duotone" class="text-base"></iconify-icon> Cetak Struk Penjualan
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Payment Form when pending -->
                    <form id="payFormPage" action="<?= site_url('admin/penjualan/pay') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="faktur" value="<?= esc($header['faktur']) ?>">

                        <div class="mb-16">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Uang Pembayaran Pelanggan (Rp) <span class="text-danger-600">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-neutral-200 fw-bold text-neutral-700 text-sm">Rp</span>
                                <input type="number" name="bayar" id="page_bayar" class="form-control form-control-lg radius-end-8 fw-bold text-neutral-900" style="font-size: 18px;" placeholder="0" min="0" required>
                            </div>
                            <div class="invalid-feedback" id="page_bayar_feedback">Uang pembayaran wajib diisi.</div>

                            <!-- Quick Money Buttons -->
                            <div class="d-flex flex-wrap gap-2 mt-10">
                                <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs page-quick-btn" data-val="pas">Uang Pas</button>
                                <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs page-quick-btn" data-val="50000">50.000</button>
                                <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs page-quick-btn" data-val="100000">100.000</button>
                                <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs page-quick-btn" data-val="200000">200.000</button>
                            </div>
                        </div>

                        <div class="bg-primary-50 p-14 radius-8 text-end mb-16">
                            <span class="text-xs text-secondary-light d-block mb-1">Uang Kembalian:</span>
                            <h4 class="fw-bold text-neutral-900 mb-0" id="page_display_kembali" style="font-size: 22px; color: #0f172a !important;">Rp 0</h4>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <a href="<?= site_url('admin/penjualan/edit/' . esc($header['faktur'])) ?>" class="btn btn-outline-success-600 text-xs px-12 py-8 radius-8 d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="lucide:edit"></iconify-icon> Edit Items
                                </a>
                                <button type="button" onclick="confirmCancelPenjualan('<?= esc($header['faktur']) ?>')" class="btn btn-outline-danger-600 text-xs px-12 py-8 radius-8 d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="mingcute:close-circle-line"></iconify-icon> Batal Penjualan
                                </button>
                            </div>
                            <button type="submit" id="btnSubmitPagePay" class="btn btn-success-600 radius-8 px-20 py-10 text-sm d-inline-flex align-items-center gap-2 fw-semibold">
                                <iconify-icon icon="mingcute:check-circle-fill" class="text-base"></iconify-icon> Proses Pembayaran & Selesaikan
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Item Details Table Card -->
<div class="card radius-12 border">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Barang / Sparepart yang Dibeli</h6>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 40px;" class="text-center">#</th>
                        <th style="width: 120px;">Kode Barang</th>
                        <th>Nama Barang / Sparepart</th>
                        <th class="text-end" style="width: 140px;">Harga Jual</th>
                        <th class="text-center" style="width: 100px;">Qty</th>
                        <th class="text-end" style="width: 150px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($details)): $no = 1;
                        foreach ($details as $item): ?>
                            <tr>
                                <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                                <td><span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($item['detailbrgkode']) ?></span></td>
                                <td><span class="fw-semibold text-neutral-800 text-xs d-block"><?= esc($item['nama_barng']) ?></span></td>
                                <td class="text-end text-xs">Rp <?= number_format($item['detailhargajual'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <span class="badge bg-primary-focus text-primary-600 px-8 py-3 rounded-pill text-xs fw-bold">
                                        <?= esc($item['jumlah']) ?> <?= esc($item['nama_satuan'] ?? '') ?>
                                    </span>
                                </td>
                                <td class="text-end fw-bold text-xs text-success-main">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary-light py-4">Belum ada barang di transaksi ini.</td>
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
    var pageTotalHarga = <?= (float)($header['totalharga'] ?? 0) ?>;

    $(document).ready(function() {
        // Live calculation for page payment
        $('#page_bayar').on('input', function() {
            calculatePageChange();
        });

        // Quick pay buttons
        $('.page-quick-btn').on('click', function() {
            var val = $(this).data('val');
            if (val === 'pas') {
                $('#page_bayar').val(pageTotalHarga);
            } else {
                $('#page_bayar').val(parseFloat(val));
            }
            calculatePageChange();
        });

        // Submit Page Payment Form with confirmation dialog
        $('#payFormPage').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var bayarVal = parseFloat($('#page_bayar').val()) || 0;

            if (bayarVal < pageTotalHarga) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Uang Bayar Kurang',
                    text: 'Uang pembayaran (Rp ' + new Intl.NumberFormat('id-ID').format(bayarVal) + ') kurang dari total transaksi (Rp ' + new Intl.NumberFormat('id-ID').format(pageTotalHarga) + ').'
                });
                return;
            }

            Swal.fire({
                title: 'Proses Pembayaran & Selesaikan Transaksi?',
                text: 'Pastikan uang pembayaran Rp ' + new Intl.NumberFormat('id-ID').format(bayarVal) + ' dari pelanggan sudah diterima.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Proses Pembayaran',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    processSubmitPagePay(form);
                }
            });
        });

        function processSubmitPagePay(form) {
            var formData = $(form).serialize();
            var $btn = $('#btnSubmitPagePay');
            var originalBtnHtml = $btn.html();

            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Memproses Pembayaran...');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Transaksi Selesai!',
                            text: response.message,
                            showCancelButton: true,
                            confirmButtonColor: '#2563eb',
                            cancelButtonColor: '#64748b',
                            confirmButtonText: 'Cetak Struk Penjualan',
                            cancelButtonText: 'Tutup'
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                window.open(response.cetak_url, '_blank');
                            }
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memproses pembayaran.'
                    });
                }
            });
        }
    });

    function calculatePageChange() {
        var bayarVal = parseFloat($('#page_bayar').val()) || 0;
        var kembali = bayarVal - pageTotalHarga;
        if (kembali >= 0) {
            $('#page_display_kembali').css('color', '#16a34a').text('Rp ' + new Intl.NumberFormat('id-ID').format(kembali));
        } else {
            $('#page_display_kembali').css('color', '#dc2626').text('Kurang Rp ' + new Intl.NumberFormat('id-ID').format(Math.abs(kembali)));
        }
    }

    function confirmCancelPenjualan(faktur) {
        Swal.fire({
            title: 'Batalkan Transaksi Penjualan?',
            text: 'Faktur "#' + faktur + '" akan dibatalkan dan stok barang yang dipesan akan dikembalikan ke persediaan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Batalkan Penjualan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('admin/penjualan/delete/') ?>' + faktur,
                    type: 'GET',
                    dataType: 'json',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Penjualan Dibatalkan!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = '<?= site_url('admin/penjualan') ?>';
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal membatalkan transaksi penjualan.' });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>