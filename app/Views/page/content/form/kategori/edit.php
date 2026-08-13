<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    /* Clean & Professional Form Validation Styling */
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
    .icon-field .form-control, .icon-field .form-select {
        padding-left: 38px !important;
        font-size: 13px !important;
    }
    
    /* Disable default Bootstrap SVG background icons */
    .form-control.is-invalid, .form-control.is-valid,
    .form-select.is-invalid, .form-select.is-valid,
    .was-validated .form-control:invalid, .was-validated .form-control:valid,
    .was-validated .form-select:invalid, .was-validated .form-select:valid {
        background-image: none !important;
        padding-right: 12px !important;
    }

    /* Valid state: retain normal border */
    .was-validated .form-control:valid,
    .was-validated .form-select:valid,
    .form-control.is-valid,
    .form-select.is-valid {
        border-color: #d1d5db !important;
        box-shadow: none !important;
    }

    /* Invalid state: crisp red border */
    .was-validated .form-control:invalid,
    .was-validated .form-select:invalid,
    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.15) !important;
    }

    /* Clean & subtle validation error helper text */
    .invalid-feedback {
        font-size: 12px !important;
        color: #dc3545 !important;
        margin-top: 4px !important;
        font-weight: 500 !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Edit Kategori</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium">
            <a href="<?= site_url('admin/kategori') ?>" class="hover-text-primary text-secondary-light">Kelola Kategori</a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Edit Data</li>
    </ul>
</div>

<?php $validation = session('validation'); ?>

<?php if ($validation) : ?>
    <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-16 py-10 radius-8 text-sm d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="icon text-lg"></iconify-icon>
            <span>Mohon periksa kembali inputan Anda. Terjadi kesalahan validasi data.</span>
        </div>
        <button class="remove-button text-danger-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<div class="col-lg-8">
    <div class="card radius-12 border">
        <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
            <h6 class="card-title mb-0 text-base fw-bold">Edit Kategori: <?= esc($kategori['namakategori']) ?></h6>
            <span class="badge bg-neutral-200 text-secondary-light text-xs font-bold">ID: #<?= esc($kategori['idkategori']) ?></span>
        </div>
        <div class="card-body p-20">
            <form action="<?= site_url('admin/kategori/update/' . esc($kategori['idkategori'])) ?>" method="post" class="row g-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="idkategori" value="<?= esc($kategori['idkategori']) ?>">

                <div class="col-12">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Kategori <span class="text-danger-600">*</span></label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="solar:tag-horizontal-bold-duotone"></iconify-icon>
                        </span>
                        <input type="text" name="namakategori" class="form-control form-control-sm radius-8 <?= (isset($validation) && $validation->hasError('namakategori')) ? 'is-invalid' : '' ?>" placeholder="Masukkan Nama Kategori" value="<?= old('namakategori', $kategori['namakategori']) ?>" required>
                        <div class="invalid-feedback">
                            <?= (isset($validation) && $validation->hasError('namakategori')) ? $validation->getError('namakategori') : 'Nama kategori wajib diisi (minimal 3 karakter).' ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-20 d-flex align-items-center gap-2">
                    <a href="<?= site_url('admin/kategori') ?>" class="border border-danger-600 bg-danger-600 text-white text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium">
                        <iconify-icon icon="mingcute:back-fill" class="text-base text-white"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-1">
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
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<?= $this->endSection() ?>
