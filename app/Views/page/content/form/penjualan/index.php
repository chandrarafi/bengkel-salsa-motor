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
    <h6 class="fw-semibold mb-0 text-lg">Transaksi Penjualan Barang</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Penjualan Barang</li>
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
        <h6 class="card-title mb-0 text-base fw-bold">Riwayat Transaksi Penjualan</h6>
        <a href="<?= site_url('admin/penjualan/create') ?>" class="btn btn-primary-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Transaksi Penjualan Baru
        </a>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 140px;">No. Faktur</th>
                        <th scope="col" style="width: 100px;">Tanggal</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col" class="text-end">Total Penjualan</th>
                        <th scope="col" class="text-center" style="width: 120px;">Status</th>
                        <th scope="col">Rincian Pembayaran</th>
                        <th scope="col" class="text-center" style="width: 170px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $list = $penjualan ?? [];
                    if (!empty($list)) :
                        $no = 1;
                        foreach ($list as $item) :
                            $isSelesai = (($item['status'] ?? '') === 'selesai');
                    ?>
                            <tr>
                                <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                                <td>
                                    <span class="badge bg-primary-focus text-primary-600 fw-bold text-xs">#<?= esc($item['faktur']) ?></span>
                                </td>
                                <td>
                                    <span class="fw-medium text-neutral-800 text-xs"><?= date('d/m/Y', strtotime($item['tglfaktur'])) ?></span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-neutral-800 text-xs d-block"><?= esc($item['nama_pelanggan'] ?: 'Pelanggan Umum') ?></span>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-neutral-900 text-xs" style="color: #0f172a !important;">Rp <?= number_format($item['totalharga'], 0, ',', '.') ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if ($isSelesai) : ?>
                                        <span class="badge bg-success-focus text-success-main px-8 py-4 radius-4 text-xs fw-bold">Selesai (Lunas)</span>
                                    <?php else : ?>
                                        <span class="badge bg-warning-focus text-warning-main px-8 py-4 radius-4 text-xs fw-bold">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($isSelesai) : ?>
                                        <span class="text-xs d-block text-neutral-800">Bayar: <strong>Rp <?= number_format($item['bayar'], 0, ',', '.') ?></strong></span>
                                        <span class="text-xxs text-secondary-light">Kembali: Rp <?= number_format($item['kembali'], 0, ',', '.') ?></span>
                                    <?php else : ?>
                                        <span class="text-xs text-secondary-light font-italic">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="<?= site_url('admin/penjualan/show/' . esc($item['faktur'])) ?>" class="w-28-px h-28-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-info-main hover-text-white border-0 text-xs" title="Lihat Detail Penjualan">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </a>

                                        <?php if ($isSelesai) : ?>
                                            <!-- Transaksi Selesai: hanya Detail & Cetak -->
                                            <a href="<?= site_url('admin/penjualan/cetak/' . esc($item['faktur'])) ?>" target="_blank" class="w-28-px h-28-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-warning-main hover-text-white border-0 text-xs" title="Cetak Nota / Struk">
                                                <iconify-icon icon="solar:printer-bold-duotone"></iconify-icon>
                                            </a>
                                        <?php else : ?>
                                            <!-- Transaksi Pending: Detail, Edit, Hapus, Selesaikan Penjualan -->
                                            <a href="<?= site_url('admin/penjualan/edit/' . esc($item['faktur'])) ?>" class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white border-0 text-xs" title="Edit Transaksi">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <button type="button" onclick="confirmDelete('<?= esc($item['faktur']) ?>')" class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" title="Batalkan Transaksi Penjualan">
                                                <iconify-icon icon="mingcute:close-circle-line"></iconify-icon>
                                            </button>
                                            <button type="button" onclick="openPaymentModal('<?= esc($item['faktur']) ?>', '<?= esc($item['nama_pelanggan'] ?: 'Pelanggan Umum') ?>', <?= (float)$item['totalharga'] ?>)" class="btn btn-sm btn-success-600 text-xs px-10 py-4 radius-6 d-inline-flex align-items-center gap-1" title="Selesaikan Penjualan & Bayar">
                                                <iconify-icon icon="solar:card-transfer-bold-duotone"></iconify-icon> Bayar
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center text-secondary-light py-4">Belum ada riwayat transaksi penjualan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Penjualan -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="detailModalLabel" style="font-size: 16px !important; text-align: left !important;">
                            Rincian Penjualan <span id="modalFakturTitle" class="text-primary-600 fw-bold ms-1" style="font-size: 16px !important;"></span>
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1" style="text-align: left !important;">Detail barang/sparepart yang dibeli oleh pelanggan</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="row g-3 mb-16 bg-neutral-50 p-16 radius-8 border align-items-center">
                    <div class="col-md-3">
                        <span class="text-xs text-secondary-light d-block">Tanggal Transaksi:</span>
                        <span class="fw-semibold text-neutral-800 text-xs" id="modalTanggal"></span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-xs text-secondary-light d-block">Nama Pelanggan:</span>
                        <span class="fw-semibold text-neutral-800 text-xs" id="modalPelanggan">-</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-xs text-secondary-light d-block">Uang Bayar / Kembali:</span>
                        <span class="fw-medium text-neutral-800 text-xs" id="modalBayarKembali">-</span>
                    </div>
                    <div class="col-md-3 text-md-end">
                        <span class="text-xs text-secondary-light d-block">Total Penjualan:</span>
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
                                <th class="text-end" style="width: 130px;">Harga Jual</th>
                                <th class="text-center" style="width: 80px;">Qty</th>
                                <th class="text-end" style="width: 140px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="detailTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 pb-20 px-24 d-flex align-items-center justify-content-between">
                <a id="btnCetakModal" href="#" target="_blank" class="btn btn-outline-primary-600 text-sm px-16 py-8 radius-8 d-inline-flex align-items-center gap-2">
                    <iconify-icon icon="solar:printer-bold-duotone" class="text-base"></iconify-icon> Cetak Struk Penjualan
                </a>
                <button type="button" class="btn btn-secondary text-sm px-20 py-8 radius-8" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Selesaikan Penjualan (Pembayaran) -->
<div class="modal fade" id="pembayaranModal" tabindex="-1" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-success-50 text-success-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:card-transfer-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="pembayaranModalLabel" style="font-size: 16px !important; text-align: left !important;">
                            Selesaikan Penjualan & Pembayaran
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1" style="text-align: left !important;">Input nominal bayar untuk memproses transaksi lunas</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="payForm" action="<?= site_url('admin/penjualan/pay') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="faktur" id="pay_faktur">
                <div class="modal-body p-24">
                    <div class="bg-neutral-50 p-16 radius-8 border mb-16">
                        <div class="d-flex align-items-center justify-content-between mb-8">
                            <span class="text-xs text-secondary-light">No. Faktur:</span>
                            <span class="badge bg-primary-focus text-primary-600 fw-bold text-xs" id="pay_faktur_display">#</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-8">
                            <span class="text-xs text-secondary-light">Pelanggan:</span>
                            <span class="fw-semibold text-neutral-800 text-xs" id="pay_pelanggan_display">-</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-top pt-8">
                            <span class="text-xs fw-bold text-neutral-800">Total Penjualan:</span>
                            <span class="fw-bold text-neutral-900 text-base" id="pay_total_display" style="color: #0f172a !important;">Rp 0</span>
                        </div>
                    </div>

                    <div class="mb-16">
                        <label class="form-label text-sm fw-bold text-neutral-800 mb-1">Uang Pembayaran Pelanggan (Rp) <span class="text-danger-600">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-neutral-200 fw-bold text-neutral-700 text-sm">Rp</span>
                            <input type="number" name="bayar" id="pay_bayar" class="form-control form-control-lg radius-end-8 fw-bold text-neutral-900" style="font-size: 18px;" placeholder="0" min="0" required>
                        </div>
                        <div class="invalid-feedback" id="pay_bayar_feedback">Uang pembayaran wajib diisi.</div>

                        <!-- Quick Money Buttons -->
                        <div class="d-flex flex-wrap gap-2 mt-10">
                            <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs pay-quick-btn" data-val="pas">Uang Pas</button>
                            <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs pay-quick-btn" data-val="50000">50.000</button>
                            <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs pay-quick-btn" data-val="100000">100.000</button>
                            <button type="button" class="btn btn-xs btn-outline-neutral text-neutral-700 radius-4 text-xs pay-quick-btn" data-val="200000">200.000</button>
                        </div>
                    </div>

                    <div class="bg-primary-50 p-16 radius-8 text-end">
                        <span class="text-xs text-secondary-light d-block mb-1">Uang Kembalian:</span>
                        <h4 class="fw-bold text-neutral-900 mb-0" id="pay_display_kembali" style="font-size: 24px; color: #0f172a !important;">Rp 0</h4>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-20 px-24 d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-secondary text-sm px-20 py-8 radius-8" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="btnSubmitPay" class="btn btn-success-600 text-sm px-20 py-8 radius-8 d-inline-flex align-items-center gap-2 fw-semibold">
                        <iconify-icon icon="mingcute:check-circle-fill" class="text-base"></iconify-icon> Proses Pembayaran & Selesaikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var currentPayTotal = 0;

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
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        }

        // Live calculation in Payment Modal
        $('#pay_bayar').on('input', function() {
            calculatePayChange();
        });

        // Quick pay buttons in Payment Modal
        $('.pay-quick-btn').on('click', function() {
            var val = $(this).data('val');
            if (val === 'pas') {
                $('#pay_bayar').val(currentPayTotal);
            } else {
                $('#pay_bayar').val(parseFloat(val));
            }
            calculatePayChange();
        });

        // Submit Payment Form with confirmation dialog
        $('#payForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var bayarVal = parseFloat($('#pay_bayar').val()) || 0;

            if (bayarVal < currentPayTotal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Uang Bayar Kurang',
                    text: 'Uang pembayaran (Rp ' + new Intl.NumberFormat('id-ID').format(bayarVal) + ') kurang dari total transaksi (Rp ' + new Intl.NumberFormat('id-ID').format(currentPayTotal) + ').'
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
                    processSubmitModalPay(form);
                }
            });
        });

        function processSubmitModalPay(form) {
            var formData = $(form).serialize();
            var $btn = $('#btnSubmitPay');
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
                        $('#pembayaranModal').modal('hide');
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

    function openPaymentModal(faktur, namaPelanggan, totalharga) {
        currentPayTotal = parseFloat(totalharga) || 0;
        $('#pay_faktur').val(faktur);
        $('#pay_faktur_display').text('#' + faktur);
        $('#pay_pelanggan_display').text(namaPelanggan);
        $('#pay_total_display').text('Rp ' + new Intl.NumberFormat('id-ID').format(currentPayTotal));
        $('#pay_bayar').val('').removeClass('is-invalid');
        $('#pay_display_kembali').css('color', '#0f172a').text('Rp 0');

        var modal = new bootstrap.Modal(document.getElementById('pembayaranModal'));
        modal.show();
    }

    function calculatePayChange() {
        var bayarVal = parseFloat($('#pay_bayar').val()) || 0;
        var kembali = bayarVal - currentPayTotal;
        if (kembali >= 0) {
            $('#pay_display_kembali').css('color', '#16a34a').text('Rp ' + new Intl.NumberFormat('id-ID').format(kembali));
        } else {
            $('#pay_display_kembali').css('color', '#dc2626').text('Kurang Rp ' + new Intl.NumberFormat('id-ID').format(Math.abs(kembali)));
        }
    }

    function showDetail(faktur) {
        $.ajax({
            url: '<?= site_url('admin/penjualan/detail/') ?>' + faktur,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.status) {
                    $('#modalFakturTitle').text('#' + response.header.faktur);
                    $('#modalTanggal').text(response.header.tglfaktur);
                    $('#modalPelanggan').text(response.header.nama_pelanggan || 'Pelanggan Umum');
                    $('#modalTotal').text('Rp ' + new Intl.NumberFormat('id-ID').format(response.header.totalharga));

                    if ((response.header.status || '') === 'selesai') {
                        $('#modalBayarKembali').html('Bayar: <strong>Rp ' + new Intl.NumberFormat('id-ID').format(response.header.bayar) + '</strong><br>Kembali: Rp ' + new Intl.NumberFormat('id-ID').format(response.header.kembali));
                        $('#btnCetakModal').show().attr('href', '<?= site_url('admin/penjualan/cetak/') ?>' + response.header.faktur);
                    } else {
                        $('#modalBayarKembali').html('<span class="badge bg-warning-focus text-warning-main text-xs">Draft Pending</span>');
                        $('#btnCetakModal').hide();
                    }

                    var html = '';
                    if (response.details && response.details.length > 0) {
                        $.each(response.details, function(idx, item) {
                            html += '<tr>' +
                                '<td class="text-center text-xs text-secondary-light">' + (idx + 1) + '</td>' +
                                '<td><span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#' + item.detailbrgkode + '</span></td>' +
                                '<td><span class="fw-semibold text-neutral-800 text-xs">' + item.nama_barng + '</span></td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.detailhargajual) + '</td>' +
                                '<td class="text-center"><span class="badge bg-primary-focus text-primary-600 px-8 py-3 rounded-pill text-xs fw-bold">' + item.jumlah + ' ' + (item.nama_satuan || '') + '</span></td>' +
                                '<td class="text-end fw-bold text-xs text-success-main">Rp ' + new Intl.NumberFormat('id-ID').format(item.subtotal) + '</td>' +
                                '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="6" class="text-center text-secondary-light py-3">Tidak ada rincian item.</td></tr>';
                    }
                    $('#detailTableBody').html(html);

                    var modal = new bootstrap.Modal(document.getElementById('detailModal'));
                    modal.show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil detail transaksi.'
                });
            }
        });
    }

    function confirmDelete(faktur) {
        Swal.fire({
            title: 'Batalkan Transaksi Penjualan?',
            text: 'Faktur "#' + faktur + '" akan dibatalkan dan stok barang yang dipesan akan dikembalikan ke persediaan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Batalkan Penjualan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('admin/penjualan/delete/') ?>' + faktur,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal menghapus transaksi penjualan.'
                        });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>