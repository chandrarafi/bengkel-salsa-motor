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
        <a href="<?= site_url('admin/transaksiservis') ?>" class="w-36-px h-36-px bg-neutral-100 text-neutral-700 rounded-circle d-flex align-items-center justify-content-center hover-bg-neutral-200" title="Kembali">
            <iconify-icon icon="mingcute:left-line" class="text-lg"></iconify-icon>
        </a>
        <h6 class="fw-semibold mb-0 text-lg">Detail Transaksi Servis #<?= esc($header['faktur']) ?></h6>
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
            <a href="<?= site_url('admin/transaksiservis') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                Transaksi Servis
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
                <h6 class="card-title mb-0 text-base fw-bold">Informasi Kendaraan & Pelanggan</h6>
                <div>
                    <?php 
                        $st = strtolower($header['status'] ?? 'antri');
                        $isPaid = ((float)$header['bayar'] > 0);
                        if ($isPaid): 
                    ?>
                        <span class="badge bg-success-50 text-success-600 border border-success-200 px-12 py-4 radius-6 text-xs fw-semibold">
                            Selesai (Lunas)
                        </span>
                    <?php elseif ($st === 'batal'): ?>
                        <span class="badge bg-danger-50 text-danger-600 border border-danger-200 px-12 py-4 radius-6 text-xs fw-semibold">
                            Dibatalkan
                        </span>
                    <?php else: ?>
                        <!-- Interactive Badge Dropdown (Without Icon) -->
                        <div class="dropdown d-inline-block">
                            <?php if ($st === 'selesai'): ?>
                                <button class="badge bg-success-50 text-success-600 border border-success-200 px-12 py-4 radius-6 text-xs fw-semibold dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" style="cursor: pointer;" title="Klik untuk ubah status">
                                    Selesai
                                </button>
                            <?php elseif ($st === 'proses'): ?>
                                <button class="badge bg-info-50 text-info-600 border border-info-200 px-12 py-4 radius-6 text-xs fw-semibold dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" style="cursor: pointer;" title="Klik untuk ubah status">
                                    Sedang Dikerjakan
                                </button>
                            <?php else: ?>
                                <button class="badge bg-warning-50 text-warning-600 border border-warning-200 px-12 py-4 radius-6 text-xs fw-semibold dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" style="cursor: pointer;" title="Klik untuk ubah status">
                                    Antri / Menunggu
                                </button>
                            <?php endif; ?>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-neutral-200">
                                <li><a class="dropdown-item text-xs update-status-btn" href="javascript:void(0)" data-faktur="<?= esc($header['faktur']) ?>" data-status="antri">Antri / Menunggu</a></li>
                                <li><a class="dropdown-item text-xs update-status-btn" href="javascript:void(0)" data-faktur="<?= esc($header['faktur']) ?>" data-status="proses">Sedang Dikerjakan</a></li>
                                <li><a class="dropdown-item text-xs update-status-btn" href="javascript:void(0)" data-faktur="<?= esc($header['faktur']) ?>" data-status="selesai">Selesai</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body p-20">
                <div class="row g-3">
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">No. Faktur Servis:</span>
                        <span class="badge bg-primary-focus text-primary-600 fw-bold text-sm px-10 py-4">#<?= esc($header['faktur']) ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Tanggal Transaksi:</span>
                        <span class="fw-semibold text-neutral-800 text-sm"><?= date('d F Y', strtotime($header['tglfaktur'])) ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Merk / Tipe Kendaraan:</span>
                        <span class="fw-bold text-neutral-900 text-sm"><?= esc($header['merkkendaraan'] ?: '-') ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Nomor Polisi (Plat):</span>
                        <span class="badge bg-neutral-200 text-neutral-800 font-mono text-sm px-10 py-4"><?= esc($header['nopol'] ?: '-') ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Nama Pelanggan:</span>
                        <span class="fw-semibold text-neutral-800 text-sm"><?= esc($header['nama_pelanggan'] ?: 'Pelanggan Umum') ?></span>
                    </div>
                    <div class="col-6">
                        <span class="text-xs text-secondary-light d-block mb-1">Waktu Masuk:</span>
                        <span class="text-xs text-neutral-700"><?= date('d/m/Y H:i', strtotime($header['created_at'] ?? $header['tglfaktur'])) ?></span>
                    </div>
                    <div class="col-12 border-top pt-12">
                        <span class="text-xs text-secondary-light d-block mb-1">Keluhan / Diagnosa Perbaikan:</span>
                        <span class="text-xs fw-semibold text-neutral-800"><?= esc($header['alasan'] ?: 'Servis Rutin Berkala') ?></span>
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
                    <?= $isPaid ? 'Ringkasan Pelunasan Servis' : 'Proses Pelunasan Pembayaran Servis' ?>
                </h6>
            </div>
            <div class="card-body p-20">
                <div class="d-flex align-items-center justify-content-between bg-neutral-50 p-16 radius-8 border mb-16">
                    <span class="text-sm fw-bold text-neutral-800">Total Biaya Servis:</span>
                    <span class="fw-bold text-neutral-900 text-xl" style="color: #0f172a !important;">Rp <?= number_format($header['totalharga'], 0, ',', '.') ?></span>
                </div>

                <?php if ($isPaid): ?>
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
                        <a href="<?= site_url('admin/transaksiservis/cetak/' . esc($header['faktur'])) ?>" target="_blank" class="btn btn-warning-600 radius-8 px-20 py-10 text-sm d-inline-flex align-items-center gap-2 fw-semibold">
                            <iconify-icon icon="solar:printer-bold-duotone" class="text-base"></iconify-icon> Cetak Nota Servis
                        </a>
                    </div>
                <?php elseif ($st === 'selesai'): ?>
                    <form id="payFormPage" action="<?= site_url('admin/transaksiservis/pay') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="faktur" value="<?= esc($header['faktur']) ?>">

                        <div class="mb-16">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Uang Pembayaran Pelanggan (Rp) <span class="text-danger-600">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-neutral-200 fw-bold text-neutral-700 text-sm">Rp</span>
                                <input type="number" name="bayar" id="page_bayar" class="form-control form-control-lg radius-end-8 fw-bold text-neutral-900" style="font-size: 18px;" placeholder="0" min="0" required>
                            </div>
                            
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
                            <div></div>
                            <button type="submit" id="btnSubmitPagePay" class="btn btn-success-600 radius-8 px-20 py-10 text-sm d-inline-flex align-items-center gap-2 fw-semibold">
                                <iconify-icon icon="mingcute:check-circle-fill" class="text-base"></iconify-icon> Proses Pembayaran & Selesaikan
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning bg-warning-50 text-warning-700 border border-warning-200 p-16 radius-8 mb-16">
                        <div class="d-flex align-items-center gap-2 mb-8">
                            <iconify-icon icon="solar:info-circle-bold-duotone" class="text-xl text-warning-600"></iconify-icon>
                            <span class="text-xs fw-semibold">Status Pengerjaan Servis: <strong><?= ($st === 'proses') ? 'Sedang Dikerjakan' : 'Antri / Menunggu' ?></strong></span>
                        </div>
                        <p class="text-xs text-neutral-600 mb-12">Pembayaran hanya dapat diproses apabila status pengerjaan servis telah diubah menjadi <strong>Selesai</strong>.</p>
                        <button type="button" class="btn btn-xs btn-success-600 radius-6 px-14 py-8 text-xs fw-semibold update-status-btn d-inline-flex align-items-center gap-1" data-faktur="<?= esc($header['faktur']) ?>" data-status="selesai">
                            <iconify-icon icon="solar:check-circle-bold-duotone"></iconify-icon> Set Status Selesai Sekarang
                        </button>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= site_url('admin/transaksiservis/edit/' . esc($header['faktur'])) ?>" class="btn btn-outline-success-600 text-xs px-12 py-8 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="lucide:edit"></iconify-icon> Edit Items
                        </a>
                        <button type="button" onclick="confirmCancelServis('<?= esc($header['faktur']) ?>')" class="btn btn-outline-danger-600 text-xs px-12 py-8 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="mingcute:close-circle-line"></iconify-icon> Batalkan Servis
                        </button>
                    </div>
                    <!-- note: cancel only available for non-selesai -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Item Details Table Card -->
<div class="card radius-12 border">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14">
        <h6 class="card-title mb-0 text-base fw-bold">Rincian Jasa Servis & Sparepart Digunakan</h6>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 40px;" class="text-center">#</th>
                        <th style="width: 110px;">Tipe Item</th>
                        <th>Deskripsi Jasa Servis / Sparepart</th>
                        <th class="text-end" style="width: 140px;">Biaya / Harga</th>
                        <th class="text-center" style="width: 90px;">Qty</th>
                        <th class="text-end" style="width: 150px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($details)): $no = 1; foreach ($details as $item): 
                        $isServis = !empty($item['detserviskode']);
                        $typeBadge = $isServis ? '<span class="badge bg-info-50 text-info-600 border border-info-200 px-10 py-4 radius-6 text-xs fw-semibold">Jasa Servis</span>' : '<span class="badge bg-warning-50 text-warning-600 border border-warning-200 px-10 py-4 radius-6 text-xs fw-semibold">Sparepart</span>';
                        $nameDesc = $isServis ? esc($item['jenis_servis']) : esc($item['nama_barng']);
                        $price = $isServis ? (float)$item['detbiaya'] : (float)$item['detailhargajual'];
                        $qtyStr = $isServis ? '1 Servis' : esc($item['detjml']) . ' ' . esc($item['nama_satuan'] ?? 'Pcs');
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td><?= $typeBadge ?></td>
                            <td><span class="fw-semibold text-neutral-800 text-xs d-block"><?= $nameDesc ?></span></td>
                            <td class="text-end text-xs">Rp <?= number_format($price, 0, ',', '.') ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-10 py-4 radius-6 text-xs fw-semibold"><?= $qtyStr ?></span>
                            </td>
                            <td class="text-end fw-bold text-xs text-success-main">Rp <?= number_format($item['dettotaljual'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary-light py-4">Belum ada rincian item servis.</td>
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
        $('#page_bayar').on('input', function() {
            calculatePageChange();
        });

        $('.page-quick-btn').on('click', function() {
            var val = $(this).data('val');
            if (val === 'pas') {
                $('#page_bayar').val(pageTotalHarga);
            } else {
                $('#page_bayar').val(parseFloat(val));
            }
            calculatePageChange();
        });

        $('#payFormPage').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var bayarVal = parseFloat($('#page_bayar').val()) || 0;

            if (bayarVal < pageTotalHarga) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Uang Bayar Kurang',
                    text: 'Uang pembayaran (Rp ' + new Intl.NumberFormat('id-ID').format(bayarVal) + ') kurang dari total biaya servis (Rp ' + new Intl.NumberFormat('id-ID').format(pageTotalHarga) + ').'
                });
                return;
            }

            Swal.fire({
                title: 'Proses Pembayaran & Selesaikan Servis?',
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
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                $btn.prop('disabled', false).html(originalBtnHtml);
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Transaksi Servis Selesai!',
                        text: response.message,
                        showCancelButton: true,
                        confirmButtonColor: '#2563eb',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Cetak Nota Servis',
                        cancelButtonText: 'Tutup'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            window.open(response.cetak_url, '_blank');
                        }
                        location.reload();
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                }
            },
            error: function() {
                $btn.prop('disabled', false).html(originalBtnHtml);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memproses pembayaran transaksi servis.' });
            }
        });
    }

    $(document).on('click', '.update-status-btn', function() {
        var faktur = $(this).data('faktur');
        var status = $(this).data('status');

        $.ajax({
            url: '<?= site_url('admin/transaksiservis/updateStatus') ?>',
            type: 'POST',
            data: { faktur: faktur, status: status },
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
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
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memperbarui status servis.' });
            }
        });
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

    function confirmCancelServis(faktur) {
        Swal.fire({
            title: 'Batalkan Transaksi Servis?',
            text: 'Faktur "#' + faktur + '" akan dibatalkan dan stok sparepart yang dipesan akan dikembalikan ke persediaan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Batalkan Servis',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('admin/transaksiservis/delete/') ?>' + faktur,
                    type: 'GET',
                    dataType: 'json',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Transaksi Dibatalkan!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = '<?= site_url('admin/transaksiservis') ?>';
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal membatalkan transaksi servis.' });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
