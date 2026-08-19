<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    .form-control-sm, .form-select-sm {
        height: 38px !important;
        font-size: 13px !important;
        border-color: #d1d5db;
    }
    textarea.form-control-sm {
        height: auto !important;
    }
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

    /* Large & Responsive Modal Cari Barang & Pelanggan */
    #cariBarangModal .modal-dialog,
    #cariPelangganModal .modal-dialog {
        max-width: 1100px !important;
        width: 92% !important;
        margin: 1.75rem auto !important;
    }
    #cariBarangModal .dataTables_filter input,
    #cariPelangganModal .dataTables_filter input {
        height: 38px !important;
        border-radius: 8px !important;
        border: 1px solid #d1d5db !important;
        padding: 6px 12px !important;
        font-size: 13px !important;
        outline: none !important;
        box-shadow: none !important;
        min-width: 220px !important;
    }
    #cariBarangModal .dataTables_length select,
    #cariPelangganModal .dataTables_length select {
        height: 38px !important;
        border-radius: 8px !important;
        border: 1px solid #d1d5db !important;
        padding: 4px 12px !important;
        font-size: 13px !important;
    }
    #tableCariBarang {
        width: 100% !important;
    }
    #tableCariBarang th {
        background-color: #f1f5f9 !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 12px 14px !important;
        color: #334155 !important;
    }
    #tableCariBarang td {
        font-size: 13px !important;
        padding: 10px 14px !important;
        vertical-align: middle !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Kasir Transaksi Penjualan Baru</h6>
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
        <li class="fw-medium text-secondary-light">Kasir Baru</li>
    </ul>
</div>

<form id="storePenjualanForm" action="<?= site_url('admin/penjualan/store') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="row g-4 mb-24">
        <!-- Left Box: Header Info -->
        <div class="col-lg-5">
            <div class="card radius-12 border h-100">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14">
                    <h6 class="card-title mb-0 text-base fw-bold">Informasi Penjualan & Pelanggan</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row g-3">
                        <!-- No Faktur -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">No. Faktur Penjualan <span class="text-danger-600">*</span></label>
                            <input type="text" name="faktur" id="faktur" class="form-control form-control-sm radius-8 fw-bold text-primary-600" value="<?= esc($autoFaktur) ?>" required>
                            <div class="invalid-feedback" id="faktur_feedback">No. Faktur wajib diisi.</div>
                        </div>

                        <!-- Tanggal Faktur -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Tanggal Transaksi <span class="text-danger-600">*</span></label>
                            <input type="date" name="tglfaktur" id="tglfaktur" class="form-control form-control-sm radius-8" value="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback" id="tglfaktur_feedback">Tanggal wajib diisi.</div>
                        </div>

                        <!-- Nama Pelanggan (Searchable Modal) -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Pelanggan / Pembeli <span class="text-danger-600">*</span></label>
                            <div class="input-group">
                                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control form-control-sm radius-start-8 fw-semibold" value="Pelanggan Umum" placeholder="Nama pelanggan..." required>
                                <button type="button" class="btn btn-outline-primary-600 text-sm px-14 py-8 d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#cariPelangganModal">
                                    <iconify-icon icon="solar:user-hand-up-bold-duotone" class="text-base"></iconify-icon> Cari Pelanggan
                                </button>
                                <button type="button" class="btn btn-neutral-200 text-neutral-800 fw-bold text-sm px-14 py-8 radius-end-8" id="btnResetPelangganUmum" title="Set ke Pelanggan Umum">
                                    Umum
                                </button>
                            </div>
                            <span class="text-xxs text-secondary-light d-block mt-1">Ketik nama langsung atau klik <strong>'Cari Pelanggan'</strong> untuk memilih dari data member terdaftar.</span>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Catatan / Keterangan <small class="text-secondary-light fw-normal">(Opsional)</small></label>
                            <textarea name="keterangan" id="keterangan" class="form-control form-control-sm radius-8" rows="3" style="min-height: 80px;" placeholder="Catatan transaksi penjualan kasir..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Box: Add Item Form -->
        <div class="col-lg-7">
            <div class="card radius-12 border h-100">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14">
                    <h6 class="card-title mb-0 text-base fw-bold">Pilih & Tambah Sparepart / Barang</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row g-3">
                        <!-- Pilih Barang (Pencarian Modal) -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Pilih Barang / Sparepart <span class="text-danger-600">*</span></label>
                            <div class="input-group">
                                <input type="hidden" id="input_kode" name="kode">
                                <input type="text" id="input_nama_display" class="form-control form-control-sm radius-start-8 bg-neutral-100" placeholder="Klik tombol 'Cari Barang' untuk memilih..." readonly style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#cariBarangModal">
                                <button type="button" class="btn btn-primary-600 text-sm px-16 py-8 radius-end-8 d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#cariBarangModal">
                                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon> Cari Barang
                                </button>
                            </div>
                            <div class="invalid-feedback" id="input_kode_feedback">Silakan pilih barang terlebih dahulu.</div>
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Harga Jual (Rp) <span class="text-danger-600">*</span></label>
                            <input type="number" id="input_detailhargajual" class="form-control form-control-sm radius-8" placeholder="Contoh: 50000" min="0">
                            <div class="invalid-feedback" id="input_detailhargajual_feedback"></div>
                        </div>

                        <!-- Jumlah & Stok Sisa -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Jumlah (Qty) <span class="text-danger-600">*</span> <span id="label_stok_info" class="text-xs text-primary-600 ms-1 fw-bold"></span></label>
                            <input type="number" id="input_jumlah" class="form-control form-control-sm radius-8" placeholder="1" min="1" value="1">
                            <div class="invalid-feedback" id="input_jumlah_feedback"></div>
                        </div>

                        <!-- Button Add Item -->
                        <div class="col-12 text-end mt-12">
                            <button type="button" id="btnAddTemp" class="btn btn-outline-primary-600 radius-8 px-20 py-8 text-sm d-inline-flex align-items-center gap-2">
                                <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Temporary Cart Table Card & Payment Calculator -->
    <div class="card radius-12 border mb-24">
        <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
            <h6 class="card-title mb-0 text-base fw-bold">Daftar Keranjang Penjualan</h6>
            <div class="d-flex align-items-center gap-2">
                <span class="text-xs text-secondary-light">Total Pembelian:</span>
                <span class="fw-bold text-success-main text-xl" id="cartGrandTotal">Rp 0</span>
            </div>
        </div>
        <div class="card-body p-20">
            <div class="table-responsive mb-20">
                <table class="table bordered-table align-middle text-sm mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">#</th>
                            <th style="width: 110px;">Kode</th>
                            <th>Nama Barang</th>
                            <th class="text-end">Harga Jual</th>
                            <th class="text-center" style="width: 80px;">Qty</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-center" style="width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tempCartBody">
                        <tr>
                            <td colspan="7" class="text-center text-secondary-light py-4">Belum ada barang di keranjang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Action Footer Buttons -->
    <div class="d-flex align-items-center justify-content-end gap-2 mb-30">
        <a href="<?= site_url('admin/penjualan') ?>" class="border border-neutral-400 bg-neutral-100 text-neutral-700 text-sm px-20 py-10 radius-8 d-flex align-items-center gap-2 fw-medium">
            <iconify-icon icon="mingcute:close-line" class="text-base"></iconify-icon> Batal
        </a>
        <button type="submit" id="btnSubmitFinal" class="btn btn-primary-600 radius-8 px-24 py-10 text-sm d-flex align-items-center gap-2 fw-semibold">
            <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Transaksi Penjualan
        </button>
    </div>
</form>

<!-- Modal Cari & Pilih Barang -->
<div class="modal fade" id="cariBarangModal" tabindex="-1" aria-labelledby="cariBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1100px !important; width: 92% !important;">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:box-minimalistic-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="cariBarangModalLabel" style="font-size: 16px !important; text-align: left !important;">
                            Cari & Pilih Barang / Sparepart
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1" style="text-align: left !important;">Klik tombol 'Pilih' pada barang yang akan dijual</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table align-middle text-sm mb-0" id="tableCariBarang">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th style="width: 120px;">Kode Barang</th>
                                <th>Nama Barang / Sparepart</th>
                                <th style="width: 130px;">Kategori</th>
                                <th style="width: 90px;">Satuan</th>
                                <th class="text-center" style="width: 80px;">Stok Available</th>
                                <th class="text-end" style="width: 130px;">Harga Jual</th>
                                <th class="text-center" style="width: 90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($barang)): $no = 1; foreach ($barang as $brg): ?>
                                <tr>
                                    <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                                    <td><span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($brg['kode']) ?></span></td>
                                    <td><span class="fw-semibold text-neutral-800 text-xs d-block"><?= esc($brg['nama_barng']) ?></span></td>
                                    <td><span class="text-xs text-secondary-light"><?= esc($brg['nama_kategori'] ?? '-') ?></span></td>
                                    <td><span class="text-xs text-secondary-light"><?= esc($brg['nama_satuan'] ?? '-') ?></span></td>
                                    <td class="text-center">
                                        <?php if ((int)$brg['stok'] > 0): ?>
                                            <span class="badge bg-success-focus text-success-main px-8 py-3 rounded-pill text-xs fw-bold"><?= esc($brg['stok']) ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-focus text-danger-main px-8 py-3 rounded-pill text-xs fw-bold">Habis (0)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end fw-bold text-xs text-success-main">Rp <?= number_format(($brg['harga_jual'] ?? 0), 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <?php if ((int)$brg['stok'] > 0): ?>
                                            <button type="button" class="btn btn-sm btn-primary-600 radius-8 px-12 py-6 text-xs d-inline-flex align-items-center gap-1 select-barang-btn"
                                                    data-kode="<?= esc($brg['kode']) ?>"
                                                    data-nama="<?= esc($brg['nama_barng']) ?>"
                                                    data-harga="<?= esc($brg['harga_jual'] ?? 0) ?>"
                                                    data-stok="<?= esc($brg['stok']) ?>">
                                                <iconify-icon icon="mingcute:check-line"></iconify-icon> Pilih
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-neutral-200 text-neutral-400 radius-8 px-12 py-6 text-xs" disabled>
                                                Stok Habis
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cari & Pilih Pelanggan -->
<div class="modal fade" id="cariPelangganModal" tabindex="-1" aria-labelledby="cariPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1100px !important; width: 92% !important;">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="cariPelangganModalLabel" style="font-size: 16px !important; text-align: left !important;">
                            Cari & Pilih Pelanggan / Member
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1" style="text-align: left !important;">Pilih pelanggan terdaftar dari database</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table align-middle text-sm mb-0" id="tableCariPelanggan" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th>Nama Pelanggan</th>
                                <th>No. HP / WA</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th class="text-center" style="width: 90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pelangganList)): $no = 1; foreach ($pelangganList as $p): ?>
                                <tr>
                                    <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                                    <td>
                                        <span class="fw-semibold text-neutral-800 text-xs d-block"><?= esc($p['nama']) ?></span>
                                        <span class="badge bg-primary-focus text-primary-600 text-xxs">Pelanggan Member</span>
                                    </td>
                                    <td><span class="fw-medium text-neutral-700 text-xs"><?= esc($p['no_hp'] ?: '-') ?></span></td>
                                    <td><span class="text-xs text-secondary-light"><?= esc($p['email'] ?: '-') ?></span></td>
                                    <td><span class="text-xs text-secondary-light"><?= esc($p['alamat'] ?: '-') ?></span></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary-600 radius-8 px-12 py-6 text-xs d-inline-flex align-items-center gap-1 select-pelanggan-btn"
                                                data-nama="<?= esc($p['nama']) ?>">
                                            <iconify-icon icon="mingcute:check-line"></iconify-icon> Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-secondary-light py-4">Belum ada pelanggan terdaftar. Silakan pilih 'Pelanggan Umum' atau ketik langsung.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var tableCariBarang;
    var tableCariPelanggan;
    var currentGrandTotal = 0;

    $(document).ready(function() {
        // Load initial temporary items
        loadTempCart();

        // Handle Pelanggan Modal selection & Reset button
        $(document).on('click', '.select-pelanggan-btn', function() {
            var nama = $(this).data('nama');
            $('#nama_pelanggan').val(nama);
            $('#cariPelangganModal').modal('hide');
        });

        $('#btnResetPelangganUmum').on('click', function() {
            $('#nama_pelanggan').val('Pelanggan Umum');
        });

        // Initialize DataTables on Modal Search Pelanggan
        if ($('#tableCariPelanggan').length) {
            tableCariPelanggan = $('#tableCariPelanggan').DataTable({
                autoWidth: false,
                language: {
                    search: "Cari Pelanggan:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Tidak ada pelanggan yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ pelanggan",
                    infoEmpty: "Menampilkan 0 pelanggan",
                    infoFiltered: "(disaring dari _MAX_ total pelanggan)",
                    paginate: { first: "«", last: "»", next: "›", previous: "‹" }
                }
            });
        }

        $('#cariPelangganModal').on('shown.bs.modal', function () {
            if (tableCariPelanggan) {
                tableCariPelanggan.columns.adjust().draw();
            }
        });

        // Initialize DataTables on Modal Search Table
        if ($('#tableCariBarang').length) {
            tableCariBarang = $('#tableCariBarang').DataTable({
                autoWidth: false,
                language: {
                    search: "Cari Barang:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Tidak ada barang yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ barang",
                    infoEmpty: "Menampilkan 0 barang",
                    infoFiltered: "(disaring dari _MAX_ total barang)",
                    paginate: { first: "«", last: "»", next: "›", previous: "‹" }
                }
            });
        }

        // Adjust DataTables column widths when modal opens
        $('#cariBarangModal').on('shown.bs.modal', function () {
            if (tableCariBarang) {
                tableCariBarang.columns.adjust().draw();
            }
        });

        // Event handler: Select barang from modal search table
        $(document).on('click', '.select-barang-btn', function() {
            var kode      = $(this).data('kode');
            var nama      = $(this).data('nama');
            var hargaJual = parseFloat($(this).data('harga')) || 0;
            var stok      = parseInt($(this).data('stok')) || 0;

            $('#input_kode').val(kode);
            $('#input_nama_display').val('#' + kode + ' - ' + nama).removeClass('is-invalid');
            $('#input_detailhargajual').val(hargaJual);
            $('#input_jumlah').val(1).attr('max', stok);
            $('#label_stok_info').text('(Stok: ' + stok + ')');

            $('#cariBarangModal').modal('hide');
        });

        // Live calculation for Change Amount
        $('#bayar').on('input', function() {
            calculateChange();
        });

        // Quick pay buttons
        $('.quick-pay-btn').on('click', function() {
            var val = $(this).data('val');
            if (val === 'pas') {
                $('#bayar').val(currentGrandTotal);
            } else {
                $('#bayar').val(parseFloat(val));
            }
            calculateChange();
        });

        // Add item to temporary cart
        $('#btnAddTemp').on('click', function() {
            var kode      = $('#input_kode').val();
            var hargaJual = $('#input_detailhargajual').val();
            var jumlah    = $('#input_jumlah').val();

            $('.form-control, .form-select').removeClass('is-invalid');

            if (!kode) {
                $('#input_nama_display').addClass('is-invalid');
                Swal.fire({ icon: 'warning', title: 'Pilih Barang', text: 'Silakan klik tombol Cari Barang untuk memilih item terlebih dahulu.' });
                return;
            }

            var $btn = $(this);
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menambahkan...');

            $.ajax({
                url: '<?= site_url('admin/penjualan/addTemp') ?>',
                type: 'POST',
                data: {
                    kode: kode,
                    detailhargajual: hargaJual,
                    jumlah: jumlah
                },
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalHtml);
                    if (response.status) {
                        loadTempCart();
                        // Reset input item
                        $('#input_kode').val('');
                        $('#input_nama_display').val('');
                        $('#input_detailhargajual').val('');
                        $('#input_jumlah').val(1);
                        $('#label_stok_info').text('');
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(field, msg) {
                                $('#input_' + field).addClass('is-invalid');
                            });
                        }
                        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalHtml);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menambahkan item ke keranjang.' });
                }
            });
        });

        // Submit final POS transaction with confirmation dialog
        $('#storePenjualanForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Simpan Transaksi Penjualan?',
                text: 'Apakah data barang dan pelanggan yang diinput sudah sesuai?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Simpan Transaksi',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    processSavePenjualan(form);
                }
            });
        });

        function processSavePenjualan(form) {
            var formData = $(form).serialize();
            var $btn = $('#btnSubmitFinal');
            var originalBtnHtml = $btn.html();

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block').text('');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan Transaksi...');

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
                            title: 'Transaksi Berhasil Disimpan!',
                            text: response.message + ' Halaman akan dialihkan ke Rincian Detail & Pembayaran.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = response.show_url || response.redirect_url || '<?= site_url('admin/penjualan') ?>';
                        });
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(field, msg) {
                                $('#' + field).addClass('is-invalid');
                                $('#' + field + '_feedback').addClass('d-block').text(msg);
                            });
                        }
                        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Gagal menyimpan transaksi penjualan.';
                    Swal.fire({ icon: 'error', title: 'Error', text: msg });
                }
            });
        }
    });

    function loadTempCart() {
        $.ajax({
            url: '<?= site_url('admin/penjualan/getTemp') ?>',
            type: 'GET',
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                if (response.status) {
                    currentGrandTotal = parseFloat(response.totalharga) || 0;
                    $('#cartGrandTotal').text(response.totalharga_formatted);

                    var html = '';
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(idx, item) {
                            html += '<tr>' +
                                '<td class="text-center text-xs">' + (idx + 1) + '</td>' +
                                '<td><span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#' + item.detailbrgkode + '</span></td>' +
                                '<td><span class="fw-semibold text-neutral-800 text-xs">' + item.nama_barng + '</span></td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.detailhargajual) + '</td>' +
                                '<td class="text-center"><span class="badge bg-primary-focus text-primary-600 px-8 py-3 rounded-pill text-xs fw-bold">' + item.jumlah + ' ' + (item.nama_satuan || '') + '</span></td>' +
                                '<td class="text-end fw-bold text-xs text-success-main">Rp ' + new Intl.NumberFormat('id-ID').format(item.subtotal) + '</td>' +
                                '<td class="text-center">' +
                                    '<button type="button" onclick="deleteTempItem(' + item.id + ')" class="w-26-px h-26-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0 text-xs" title="Hapus Item">' +
                                        '<iconify-icon icon="mingcute:delete-2-line"></iconify-icon>' +
                                    '</button>' +
                                '</td>' +
                            '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="7" class="text-center text-secondary-light py-4">Belum ada barang di keranjang.</td></tr>';
                    }
                    $('#tempCartBody').html(html);
                    calculateChange();
                }
            }
        });
    }

    function calculateChange() {
        var bayarVal = parseFloat($('#bayar').val()) || 0;
        var kembali = bayarVal - currentGrandTotal;
        if (kembali >= 0) {
            $('#displayKembali').css('color', '#16a34a').text('Rp ' + new Intl.NumberFormat('id-ID').format(kembali));
        } else {
            $('#displayKembali').css('color', '#dc2626').text('Kurang Rp ' + new Intl.NumberFormat('id-ID').format(Math.abs(kembali)));
        }
    }

    function deleteTempItem(id) {
        $.ajax({
            url: '<?= site_url('admin/penjualan/deleteTemp') ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                if (response.status) {
                    loadTempCart();
                }
            }
        });
    }
</script>
<?= $this->endSection() ?>
