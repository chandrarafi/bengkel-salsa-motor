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

    /* Large & Responsive Modal Cari Barang */
    #cariBarangModal .modal-dialog {
        max-width: 1100px !important;
        width: 92% !important;
        margin: 1.75rem auto !important;
    }
    #cariBarangModal .dataTables_filter input {
        height: 38px !important;
        border-radius: 8px !important;
        border: 1px solid #d1d5db !important;
        padding: 6px 12px !important;
        font-size: 13px !important;
        outline: none !important;
        box-shadow: none !important;
        min-width: 220px !important;
    }
    #cariBarangModal .dataTables_length select {
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
    <h6 class="fw-semibold mb-0 text-lg">Input Barang Masuk Baru</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium">
            <a href="<?= site_url('admin/barangmasuk') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                Barang Masuk
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Input Baru</li>
    </ul>
</div>

<form id="storeBarangMasukForm" action="<?= site_url('admin/barangmasuk/store') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="row g-4 mb-24">
        <!-- Left Box: Header Info -->
        <div class="col-lg-5">
            <div class="card radius-12 border h-100">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14">
                    <h6 class="card-title mb-0 text-base fw-bold">Informasi Faktur Pembelian</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row g-3">
                        <!-- No Faktur -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">No. Faktur <span class="text-danger-600">*</span></label>
                            <input type="text" name="faktur" id="faktur" class="form-control form-control-sm radius-8 fw-bold text-primary-600" value="<?= esc($autoFaktur) ?>" required>
                            <div class="invalid-feedback" id="faktur_feedback">No. Faktur wajib diisi.</div>
                        </div>

                        <!-- Tanggal Faktur -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Tanggal Faktur <span class="text-danger-600">*</span></label>
                            <input type="date" name="tanggalfaktur" id="tanggalfaktur" class="form-control form-control-sm radius-8" value="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback" id="tanggalfaktur_feedback">Tanggal faktur wajib diisi.</div>
                        </div>

                        <!-- Keterangan / Supplier (Besar Textarea) -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Keterangan / Supplier <small class="text-secondary-light fw-normal">(Opsional)</small></label>
                            <textarea name="keterangan" id="keterangan" class="form-control form-control-sm radius-8" rows="5" style="min-height: 120px;" placeholder="Tuliskan catatan transaksi, nama toko supplier, alamat, atau nomor telepon supplier..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Box: Add Item Form -->
        <div class="col-lg-7">
            <div class="card radius-12 border h-100">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14">
                    <h6 class="card-title mb-0 text-base fw-bold">Pilih & Tambah Item Barang</h6>
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

                        <!-- Harga Beli -->
                        <div class="col-md-4">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Harga Beli (Rp) <span class="text-danger-600">*</span></label>
                            <input type="number" id="input_detailhargabeli" class="form-control form-control-sm radius-8" placeholder="Contoh: 40000" min="0">
                            <div class="invalid-feedback" id="input_detailhargabeli_feedback"></div>
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-md-4">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Harga Jual (Rp) <span class="text-danger-600">*</span></label>
                            <input type="number" id="input_detailhargajual" class="form-control form-control-sm radius-8" placeholder="Contoh: 50000" min="0">
                            <div class="invalid-feedback" id="input_detailhargajual_feedback"></div>
                        </div>

                        <!-- Jumlah -->
                        <div class="col-md-4">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Jumlah (Qty) <span class="text-danger-600">*</span></label>
                            <input type="number" id="input_jumlah" class="form-control form-control-sm radius-8" placeholder="1" min="1" value="1">
                            <div class="invalid-feedback" id="input_jumlah_feedback"></div>
                        </div>

                        <!-- Button Add Item -->
                        <div class="col-12 text-end mt-12">
                            <button type="button" id="btnAddTemp" class="btn btn-outline-primary-600 radius-8 px-20 py-8 text-sm d-inline-flex align-items-center gap-2">
                                <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah Item ke Daftar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Temporary Table Card -->
    <div class="card radius-12 border mb-24">
        <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
            <h6 class="card-title mb-0 text-base fw-bold">Daftar Item Barang Masuk</h6>
            <div class="d-flex align-items-center gap-2">
                <span class="text-xs text-secondary-light">Total Pembelian:</span>
                <span class="fw-bold text-success-main text-lg" id="cartGrandTotal">Rp 0</span>
            </div>
        </div>
        <div class="card-body p-20">
            <div class="table-responsive">
                <table class="table bordered-table align-middle text-sm mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">#</th>
                            <th style="width: 110px;">Kode</th>
                            <th>Nama Barang</th>
                            <th class="text-end">Harga Beli</th>
                            <th class="text-end">Harga Jual</th>
                            <th class="text-center" style="width: 80px;">Qty</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-center" style="width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tempCartBody">
                        <tr>
                            <td colspan="8" class="text-center text-secondary-light py-4">Belum ada item barang yang ditambahkan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Action Footer Buttons -->
    <div class="d-flex align-items-center justify-content-end gap-2 mb-30">
        <a href="<?= site_url('admin/barangmasuk') ?>" class="border border-neutral-400 bg-neutral-100 text-neutral-700 text-sm px-20 py-10 radius-8 d-flex align-items-center gap-2 fw-medium">
            <iconify-icon icon="mingcute:close-line" class="text-base"></iconify-icon> Batal
        </a>
        <button type="submit" id="btnSubmitFinal" class="btn btn-primary-600 radius-8 px-24 py-10 text-sm d-flex align-items-center gap-2 fw-semibold">
            <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Transaksi Barang Masuk
        </button>
    </div>
</form>

<!-- Modal Cari & Pilih Barang (Large & Clean Spacing) -->
<div class="modal fade" id="cariBarangModal" tabindex="-1" aria-labelledby="cariBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16">
                <div class="d-flex align-items-center gap-2">
                    <div class="w-36-px h-36-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-lg">
                        <iconify-icon icon="solar:box-minimalistic-bold-duotone"></iconify-icon>
                    </div>
                    <div>
                        <h6 class="modal-title text-base fw-bold mb-0" id="cariBarangModalLabel">Cari & Pilih Barang / Sparepart</h6>
                        <span class="text-xs text-secondary-light">Klik tombol 'Pilih' pada baris barang yang ingin ditambahkan</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <th class="text-center" style="width: 80px;">Stok</th>
                                <th class="text-end" style="width: 110px;">Harga Beli</th>
                                <th class="text-end" style="width: 110px;">Harga Jual</th>
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
                                    <td class="text-center"><span class="badge bg-info-focus text-info-main px-8 py-3 rounded-pill text-xs fw-bold"><?= esc($brg['stok']) ?></span></td>
                                    <td class="text-end fw-semibold text-xs text-warning-main">Rp <?= number_format(($brg['harga_beli'] ?? 0), 0, ',', '.') ?></td>
                                    <td class="text-end fw-bold text-xs text-success-main">Rp <?= number_format(($brg['harga_jual'] ?? 0), 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary-600 radius-8 px-12 py-6 text-xs d-inline-flex align-items-center gap-1 select-barang-btn"
                                                data-kode="<?= esc($brg['kode']) ?>"
                                                data-nama="<?= esc($brg['nama_barng']) ?>"
                                                data-hargabeli="<?= (float)($brg['harga_beli'] ?? 0) ?>"
                                                data-hargajual="<?= (float)($brg['harga_jual'] ?? 0) ?>"
                                                data-stok="<?= esc($brg['stok']) ?>">
                                            <iconify-icon icon="mingcute:check-line"></iconify-icon> Pilih
                                        </button>
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

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var tableCariBarang;

    $(document).ready(function() {
        // Load initial temporary items
        loadTempCart();

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
            var hargaBeli = parseFloat($(this).data('hargabeli')) || 0;
            var hargaJual = parseFloat($(this).data('hargajual')) || 0;

            $('#input_kode').val(kode);
            $('#input_nama_display').val('#' + kode + ' - ' + nama).removeClass('is-invalid');
            $('#input_detailhargabeli').val(hargaBeli);
            $('#input_detailhargajual').val(hargaJual);
            $('#input_jumlah').val(1);

            $('#cariBarangModal').modal('hide');
        });

        // Add item to temporary cart
        $('#btnAddTemp').on('click', function() {
            var kode      = $('#input_kode').val();
            var hargaBeli = $('#input_detailhargabeli').val();
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
                url: '<?= site_url('admin/barangmasuk/addTemp') ?>',
                type: 'POST',
                data: {
                    kode: kode,
                    detailhargabeli: hargaBeli,
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
                        $('#input_detailhargabeli').val('');
                        $('#input_detailhargajual').val('');
                        $('#input_jumlah').val(1);
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
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menambahkan item.' });
                }
            });
        });

        // Submit final transaction
        $('#storeBarangMasukForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
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
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = response.redirect_url || '<?= site_url('admin/barangmasuk') ?>';
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
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Terjadi kesalahan sistem.';
                    Swal.fire({ icon: 'error', title: 'Error', text: msg });
                }
            });
        });
    });

    function loadTempCart() {
        $.ajax({
            url: '<?= site_url('admin/barangmasuk/getTemp') ?>',
            type: 'GET',
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                if (response.status) {
                    $('#cartGrandTotal').text(response.totalharga_formatted);

                    var html = '';
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(idx, item) {
                            html += '<tr>' +
                                '<td class="text-center text-xs">' + (idx + 1) + '</td>' +
                                '<td><span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#' + item.detailbrgkode + '</span></td>' +
                                '<td><span class="fw-semibold text-neutral-800 text-xs">' + item.nama_barng + '</span></td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.detailhargabeli) + '</td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.detailhargajual) + '</td>' +
                                '<td class="text-center"><span class="badge bg-primary-focus text-primary-600 px-8 py-3 rounded-pill text-xs fw-bold">' + item.jumlah + ' ' + (item.nama_satuan || '') + '</span></td>' +
                                '<td class="text-end fw-bold text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(item.subtotal) + '</td>' +
                                '<td class="text-center">' +
                                    '<button type="button" onclick="deleteTempItem(' + item.id + ')" class="w-26-px h-26-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0 text-xs" title="Hapus Item">' +
                                        '<iconify-icon icon="mingcute:delete-2-line"></iconify-icon>' +
                                    '</button>' +
                                '</td>' +
                            '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="8" class="text-center text-secondary-light py-4">Belum ada item barang yang ditambahkan.</td></tr>';
                    }
                    $('#tempCartBody').html(html);
                }
            }
        });
    }

    function deleteTempItem(id) {
        $.ajax({
            url: '<?= site_url('admin/barangmasuk/deleteTemp') ?>',
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
