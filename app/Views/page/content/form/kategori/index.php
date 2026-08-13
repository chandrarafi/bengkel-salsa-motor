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

    /* Modal Form Icon & Input Normalization */
    .form-control-sm, .form-select-sm {
        height: 38px !important;
        font-size: 13px !important;
        border-color: #d1d5db;
    }
    .icon-field {
        position: relative !important;
    }
    .icon-field .icon {
        position: absolute !important;
        left: 12px !important;
        top: 19px !important;
        transform: translateY(-50%) !important;
        font-size: 16px !important;
        color: #9ca3af !important;
        pointer-events: none !important;
        z-index: 5 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 16px !important;
        width: 16px !important;
    }
    .icon-field .form-control {
        padding-left: 38px !important;
        font-size: 13px !important;
    }
    .form-control.is-invalid, .was-validated .form-control:invalid {
        background-image: none !important;
        padding-right: 12px !important;
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.15) !important;
    }
    .invalid-feedback {
        font-size: 12px !important;
        color: #dc3545 !important;
        margin-top: 4px !important;
        font-weight: 500 !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Kelola Kategori</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Kelola Kategori</li>
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

<!-- Kategori Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Kategori Barang</h6>
        <button type="button" class="btn btn-primary-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah Kategori
        </button>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px;">#</th>
                        <th scope="col" style="width: 100px;">ID Kategori</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col" style="width: 180px;">Tanggal Dibuat</th>
                        <th scope="col" class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($kategori as $item) : ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-neutral-200 text-secondary-light fw-bold text-xs">#<?= esc($item['idkategori']) ?></span>
                            </td>
                            <td>
                                <span class="fw-semibold text-neutral-800 text-sm"><?= esc($item['namakategori']) ?></span>
                            </td>
                            <td>
                                <span class="text-secondary-light text-xs"><?= esc($item['created_at'] ? date('d M Y, H:i', strtotime($item['created_at'])) : '-') ?></span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white border-0 text-xs edit-kategori-btn" data-id="<?= esc($item['idkategori']) ?>" data-nama="<?= esc($item['namakategori']) ?>" title="Edit Kategori">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </button>
                                    <button type="button" onclick="confirmDelete(<?= esc($item['idkategori']) ?>, '<?= esc($item['namakategori']) ?>')" class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" title="Hapus Kategori">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                    <form id="deleteForm_<?= esc($item['idkategori']) ?>" action="<?= site_url('admin/kategori/delete/' . esc($item['idkategori'])) ?>" method="get" class="d-none">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-12 border-0">
            <div class="modal-header border-bottom border-neutral-200 px-20 py-14">
                <h6 class="modal-title text-base fw-bold" id="addKategoriModalLabel">Tambah Kategori Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php 
                $errors = session('errors') ?? []; 
                if (empty($errors) && session('validation') && is_array(session('validation'))) {
                    $errors = session('validation');
                }
            ?>
            <form id="addKategoriForm" action="<?= site_url('admin/kategori/store') ?>" method="post" class="needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="modal-body p-20">
                    <div class="mb-3">
                        <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Kategori <span class="text-danger-600">*</span></label>
                        <div class="icon-field">
                            <span class="icon">
                                <iconify-icon icon="solar:tag-horizontal-bold-duotone"></iconify-icon>
                            </span>
                            <input type="text" name="namakategori" id="add_namakategori" class="form-control form-control-sm radius-8 <?= (session('modal') === 'add' && isset($errors['namakategori'])) ? 'is-invalid' : '' ?>" placeholder="Contoh: Sparepart Mesin" value="<?= session('modal') === 'add' ? old('namakategori') : '' ?>" required>
                            <div class="invalid-feedback" id="add_namakategori_feedback">
                                <?= (session('modal') === 'add' && isset($errors['namakategori'])) ? esc($errors['namakategori']) : 'Nama kategori wajib diisi (minimal 3 karakter).' ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-20 px-20 d-flex align-items-center gap-2">
                    <button type="button" class="border border-danger-600 bg-danger-600 text-white text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium" data-bs-dismiss="modal">
                        <iconify-icon icon="mingcute:back-fill" class="text-base text-white"></iconify-icon> Batal
                    </button>
                    <button type="submit" id="addKategoriSubmitBtn" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-12 border-0">
            <div class="modal-header border-bottom border-neutral-200 px-20 py-14">
                <h6 class="modal-title text-base fw-bold" id="editKategoriModalLabel">Edit Data Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKategoriForm" action="<?= site_url('admin/kategori/update/' . (session('edit_id') ?: '0')) ?>" method="post" class="needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="idkategori" id="edit_idkategori" value="<?= session('edit_id') ?: '' ?>">
                <div class="modal-body p-20">
                    <div class="mb-3">
                        <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Kategori <span class="text-danger-600">*</span></label>
                        <div class="icon-field">
                            <span class="icon">
                                <iconify-icon icon="solar:tag-horizontal-bold-duotone"></iconify-icon>
                            </span>
                            <input type="text" name="namakategori" id="edit_namakategori" class="form-control form-control-sm radius-8 <?= (session('modal') === 'edit' && isset($errors['namakategori'])) ? 'is-invalid' : '' ?>" placeholder="Masukkan Nama Kategori" value="<?= session('modal') === 'edit' ? old('namakategori') : '' ?>" required>
                            <div class="invalid-feedback" id="edit_namakategori_feedback">
                                <?= (session('modal') === 'edit' && isset($errors['namakategori'])) ? esc($errors['namakategori']) : 'Nama kategori wajib diisi (minimal 3 karakter).' ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0 pb-20 px-20 d-flex align-items-center gap-2">
                    <button type="button" class="border border-danger-600 bg-danger-600 text-white text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium" data-bs-dismiss="modal">
                        <iconify-icon icon="mingcute:back-fill" class="text-base text-white"></iconify-icon> Batal
                    </button>
                    <button type="submit" id="editKategoriSubmitBtn" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-1">
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
                    zeroRecords: "Tidak ada data kategori yang ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ kategori",
                    infoEmpty: "Menampilkan 0 kategori",
                    infoFiltered: "(disaring dari _MAX_ total kategori)",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        }

        // Reset add modal on open
        $('#addKategoriModal').on('show.bs.modal', function() {
            $('#addKategoriForm')[0].reset();
            $('#add_namakategori').removeClass('is-invalid');
        });

        // Handle Edit Button Click to populate Edit Modal
        $('.edit-kategori-btn').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#edit_idkategori').val(id);
            $('#edit_namakategori').val(nama).removeClass('is-invalid');
            $('#editKategoriForm').attr('action', '<?= site_url('admin/kategori/update/') ?>' + id);
            
            var editModal = new bootstrap.Modal(document.getElementById('editKategoriModal'));
            editModal.show();
        });

        // AJAX Submit: Tambah Kategori
        $('#addKategoriForm').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $('#addKategoriSubmitBtn');
            var originalBtnHtml = $btn.html();

            // Clear errors
            $('#add_namakategori').removeClass('is-invalid');

            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        $('#addKategoriModal').modal('hide');
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
                        if (response.errors && response.errors.namakategori) {
                            $('#add_namakategori').addClass('is-invalid');
                            $('#add_namakategori_feedback').text(response.errors.namakategori);
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

        // AJAX Submit: Edit Kategori
        $('#editKategoriForm').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $('#editKategoriSubmitBtn');
            var originalBtnHtml = $btn.html();

            // Clear errors
            $('#edit_namakategori').removeClass('is-invalid');

            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        $('#editKategoriModal').modal('hide');
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
                        if (response.errors && response.errors.namakategori) {
                            $('#edit_namakategori').addClass('is-invalid');
                            $('#edit_namakategori_feedback').text(response.errors.namakategori);
                        } else if (response.message) {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
                }
            });
        });
    });

    function confirmDelete(id, nama) {
        Swal.fire({
            title: 'Hapus Kategori?',
            text: 'Kategori "' + nama + '" akan dihapus permanen.',
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
                    url: '<?= site_url('admin/kategori/delete/') ?>' + id,
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
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghapus data kategori.' });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
