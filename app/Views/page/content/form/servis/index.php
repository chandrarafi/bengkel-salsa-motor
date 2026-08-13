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

    /* Form Input Normalization */
    .form-control-sm, .form-select-sm {
        height: 38px !important;
        font-size: 13px !important;
        border-color: #d1d5db;
    }
    textarea.form-control-sm {
        height: auto !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Kelola Master Jasa Servis</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Master Jasa Servis</li>
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

<!-- Servis Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Jasa Servis Motor</h6>
        <button type="button" class="btn btn-primary-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addServisModal">
            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah Jasa Servis
        </button>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 110px;">Kode Servis</th>
                        <th scope="col">Jenis / Nama Jasa Servis</th>
                        <th scope="col">Biaya Jasa</th>
                        <th scope="col" class="text-center" style="width: 120px;">Estimasi Waktu</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-center" style="width: 90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $servisList = $servis ?? [];
                        if (!empty($servisList)) : 
                            $no = 1; 
                            foreach ($servisList as $item) : 
                                $jenisVal      = $item['jenis_servis'] ?? $item['Jenis_servis'] ?? '';
                                $biayaVal      = $item['biaya'] ?? $item['Biaya'] ?? 0;
                                $keteranganVal = $item['keterangan'] ?? $item['Keterangan'] ?? '';
                                $estimasiVal   = $item['estimasi_waktu'] ?? 30;
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($item['kodeservis']) ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-neutral-800 text-sm d-block mb-0"><?= esc($jenisVal) ?></span>
                            </td>
                            <td>
                                <span class="fw-bold text-success-main text-xs">Rp <?= number_format((float)$biayaVal, 0, ',', '.') ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info-focus text-info-main px-10 py-4 rounded-pill fw-medium text-xs d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:clock-circle-bold-duotone"></iconify-icon>
                                    <?= esc($estimasiVal) ?> Menit
                                </span>
                            </td>
                            <td>
                                <span class="text-secondary-light text-xs"><?= esc($keteranganVal ?: '-') ?></span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white border-0 text-xs edit-servis-btn" 
                                            data-kodeservis="<?= esc($item['kodeservis']) ?>" 
                                            data-jenis="<?= esc($jenisVal) ?>" 
                                            data-biaya="<?= esc($biayaVal) ?>" 
                                            data-estimasi="<?= esc($estimasiVal) ?>" 
                                            data-keterangan="<?= esc($keteranganVal) ?>" 
                                            title="Edit Jasa Servis">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </button>
                                    <button type="button" onclick="confirmDelete('<?= esc($item['kodeservis']) ?>', '<?= esc($jenisVal) ?>')" class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" title="Hapus Jasa Servis">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center text-secondary-light py-4">Belum ada data jasa servis.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Servis -->
<div class="modal fade" id="addServisModal" tabindex="-1" aria-labelledby="addServisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content radius-12 border-0">
            <div class="modal-header border-bottom border-neutral-200 px-20 py-14">
                <h6 class="modal-title text-base fw-bold" id="addServisModalLabel">Tambah Jasa Servis Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addServisForm" action="<?= site_url('admin/servis/store') ?>" method="post" class="needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="modal-body p-20">
                    <div class="row g-3">
                        <!-- Kode Servis -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Kode Servis <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:qr-code-bold-duotone"></iconify-icon>
                                </span>
                                <input type="text" name="kodeservis" id="add_kodeservis" class="form-control form-control-sm radius-8" placeholder="Contoh: SRV0000006" maxlength="10" required>
                            </div>
                            <div class="invalid-feedback" id="add_kodeservis_feedback">Kode servis wajib diisi.</div>
                        </div>

                        <!-- Jenis / Nama Servis -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Jenis / Nama Jasa Servis <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                                </span>
                                <input type="text" name="jenis_servis" id="add_jenis_servis" class="form-control form-control-sm radius-8" placeholder="Contoh: Servis Ringan + Ganti Oli" maxlength="50" required>
                            </div>
                            <div class="invalid-feedback" id="add_jenis_servis_feedback">Jenis jasa servis wajib diisi.</div>
                        </div>

                        <!-- Biaya -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Biaya Jasa Servis (Rp) <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:tag-price-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="biaya" id="add_biaya" class="form-control form-control-sm radius-8" placeholder="Contoh: 45000" min="0" required>
                            </div>
                            <div class="invalid-feedback" id="add_biaya_feedback">Biaya jasa servis wajib diisi.</div>
                        </div>

                        <!-- Estimasi Waktu (Menit) -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Estimasi Waktu Pengerjaan (Menit)</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:clock-circle-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="estimasi_waktu" id="add_estimasi_waktu" class="form-control form-control-sm radius-8" placeholder="Contoh: 30" min="0" value="30">
                            </div>
                            <div class="invalid-feedback" id="add_estimasi_waktu_feedback">Estimasi waktu harus berupa angka menit.</div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-md-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Keterangan / Rincian Servis <small class="text-secondary-light fw-normal">(Opsional)</small></label>
                            <textarea name="keterangan" id="add_keterangan" class="form-control form-control-sm radius-8" rows="3" placeholder="Jelaskan rincian penanganan atau garansi servis..."></textarea>
                            <div class="invalid-feedback" id="add_keterangan_feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-20 px-20 d-flex align-items-center gap-2">
                    <button type="button" class="border border-danger-600 bg-danger-600 text-white text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium" data-bs-dismiss="modal">
                        <iconify-icon icon="mingcute:back-fill" class="text-base text-white"></iconify-icon> Batal
                    </button>
                    <button type="submit" id="addServisSubmitBtn" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Jasa Servis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Servis -->
<div class="modal fade" id="editServisModal" tabindex="-1" aria-labelledby="editServisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content radius-12 border-0">
            <div class="modal-header border-bottom border-neutral-200 px-20 py-14">
                <h6 class="modal-title text-base fw-bold" id="editServisModalLabel">Edit Data Jasa Servis</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editServisForm" action="<?= site_url('admin/servis/update/0') ?>" method="post" class="needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="modal-body p-20">
                    <div class="row g-3">
                        <!-- Kode Servis (Readonly) -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Kode Servis</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:qr-code-bold-duotone"></iconify-icon>
                                </span>
                                <input type="text" name="kodeservis" id="edit_kodeservis" class="form-control form-control-sm radius-8 bg-neutral-100" readonly>
                            </div>
                        </div>

                        <!-- Jenis / Nama Servis -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Jenis / Nama Jasa Servis <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                                </span>
                                <input type="text" name="jenis_servis" id="edit_jenis_servis" class="form-control form-control-sm radius-8" placeholder="Jenis jasa servis" maxlength="50" required>
                            </div>
                            <div class="invalid-feedback" id="edit_jenis_servis_feedback">Jenis jasa servis wajib diisi.</div>
                        </div>

                        <!-- Biaya -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Biaya Jasa Servis (Rp) <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:tag-price-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="biaya" id="edit_biaya" class="form-control form-control-sm radius-8" placeholder="Biaya jasa servis" min="0" required>
                            </div>
                            <div class="invalid-feedback" id="edit_biaya_feedback">Biaya jasa servis wajib diisi.</div>
                        </div>

                        <!-- Estimasi Waktu (Menit) -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Estimasi Waktu Pengerjaan (Menit)</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:clock-circle-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="estimasi_waktu" id="edit_estimasi_waktu" class="form-control form-control-sm radius-8" placeholder="Estimasi menit" min="0">
                            </div>
                            <div class="invalid-feedback" id="edit_estimasi_waktu_feedback">Estimasi waktu harus berupa angka menit.</div>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-md-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Keterangan / Rincian Servis <small class="text-secondary-light fw-normal">(Opsional)</small></label>
                            <textarea name="keterangan" id="edit_keterangan" class="form-control form-control-sm radius-8" rows="3" placeholder="Keterangan rincian servis..."></textarea>
                            <div class="invalid-feedback" id="edit_keterangan_feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-20 px-20 d-flex align-items-center gap-2">
                    <button type="button" class="border border-danger-600 bg-danger-600 text-white text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium" data-bs-dismiss="modal">
                        <iconify-icon icon="mingcute:back-fill" class="text-base text-white"></iconify-icon> Batal
                    </button>
                    <button type="submit" id="editServisSubmitBtn" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Perubahan
                    </button>
                </div>
            </form>
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
                    zeroRecords: "Tidak ada data jasa servis yang ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ jasa servis",
                    infoEmpty: "Menampilkan 0 jasa servis",
                    infoFiltered: "(disaring dari _MAX_ total jasa servis)",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        }

        // Auto-generate Kode Servis on Add Modal open if empty
        $('#addServisModal').on('show.bs.modal', function() {
            $('#addServisForm')[0].reset();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block').text('');
            
            if (!$('#add_kodeservis').val()) {
                var randomNum = Math.floor(1000000 + Math.random() * 9000000);
                $('#add_kodeservis').val('SRV' + randomNum);
            }
        });

        // Populate Edit Modal
        $('.edit-servis-btn').on('click', function() {
            var kodeservis = $(this).data('kodeservis');
            var jenis = $(this).data('jenis');
            var biaya = $(this).data('biaya');
            var estimasi = $(this).data('estimasi');
            var keterangan = $(this).data('keterangan');

            $('#edit_kodeservis').val(kodeservis);
            $('#edit_jenis_servis').val(jenis).removeClass('is-invalid');
            $('#edit_biaya').val(biaya).removeClass('is-invalid');
            $('#edit_estimasi_waktu').val(estimasi).removeClass('is-invalid');
            $('#edit_keterangan').val(keterangan).removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block').text('');

            $('#editServisForm').attr('action', '<?= site_url('admin/servis/update/') ?>' + kodeservis);
            var editModal = new bootstrap.Modal(document.getElementById('editServisModal'));
            editModal.show();
        });

        // AJAX Submit: Add Servis
        $('#addServisForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = $(form).serialize();
            var $btn = $('#addServisSubmitBtn');
            var originalBtnHtml = $btn.html();

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block').text('');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        $('#addServisModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(field, msg) {
                                $('#add_' + field).addClass('is-invalid');
                                $('#add_' + field + '_feedback').addClass('d-block').text(msg);
                            });
                        } else if (response.message) {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Terjadi kesalahan sistem.';
                    Swal.fire({ icon: 'error', title: 'Error', text: msg });
                }
            });
        });

        // AJAX Submit: Edit Servis
        $('#editServisForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = $(form).serialize();
            var $btn = $('#editServisSubmitBtn');
            var originalBtnHtml = $btn.html();

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block').text('');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        $('#editServisModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(field, msg) {
                                $('#edit_' + field).addClass('is-invalid');
                                $('#edit_' + field + '_feedback').addClass('d-block').text(msg);
                            });
                        } else if (response.message) {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
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

    function confirmDelete(kodeservis, jenis) {
        Swal.fire({
            title: 'Hapus Jasa Servis?',
            text: 'Jasa servis "' + jenis + '" (Kode: ' + kodeservis + ') akan dihapus permanen.',
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
                    url: '<?= site_url('admin/servis/delete/') ?>' + kodeservis,
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
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data jasa servis.' });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
