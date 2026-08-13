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
    
    /* Disable default Bootstrap SVG background icons (exclamation & checkmarks) */
    .form-control.is-invalid, .form-control.is-valid,
    .form-select.is-invalid, .form-select.is-valid,
    .was-validated .form-control:invalid, .was-validated .form-control:valid,
    .was-validated .form-select:invalid, .was-validated .form-select:valid {
        background-image: none !important;
        padding-right: 12px !important;
    }

    /* Valid state: retain normal border instead of green outline everywhere */
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
    <h6 class="fw-semibold mb-0 text-lg">Tambah User Baru</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium">
            <a href="<?= site_url('admin/users') ?>" class="hover-text-primary text-secondary-light">Kelola User</a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Tambah Data</li>
    </ul>
</div>

<?php 
    $errors = session('errors') ?? []; 
    if (empty($errors) && session('validation') && is_array(session('validation'))) {
        $errors = session('validation');
    }
?>

<?php if (!empty($errors)) : ?>
    <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-16 py-10 radius-8 text-sm d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="icon text-lg"></iconify-icon>
            <span>Mohon periksa kembali inputan Anda. Terjadi kesalahan validasi data.</span>
        </div>
        <button class="remove-button text-danger-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<div class="col-lg-12">
    <div class="card radius-12 border">
        <div class="card-header border-bottom border-neutral-200 px-20 py-14">
            <h6 class="card-title mb-0 text-base fw-bold">Form Tambah Pengguna Baru</h6>
        </div>
        <div class="card-body p-20">
            <form action="<?= site_url('admin/users/store') ?>" method="post" class="row g-3 needs-validation" novalidate>
                <?= csrf_field() ?>

                <div class="col-md-6">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Lengkap <span class="text-danger-600">*</span></label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="nama" class="form-control form-control-sm radius-8 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" placeholder="Masukkan Nama Lengkap" value="<?= old('nama') ?>" required>
                        <div class="invalid-feedback">
                            <?= !empty($errors['nama']) ? esc($errors['nama']) : 'Nama lengkap wajib diisi (minimal 3 karakter).' ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Alamat Email <span class="text-danger-600">*</span></label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" class="form-control form-control-sm radius-8 <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" placeholder="user@bengkelsalsa.com" value="<?= old('email') ?>" required>
                        <div class="invalid-feedback">
                            <?= !empty($errors['email']) ? esc($errors['email']) : 'Email valid wajib diisi.' ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Level Hak Akses <span class="text-danger-600">*</span></label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="solar:shield-user-outline"></iconify-icon>
                        </span>
                        <select name="level" class="form-select form-select-sm radius-8 <?= !empty($errors['level']) ? 'is-invalid' : '' ?>" required>
                            <option value="" disabled <?= old('level') ? '' : 'selected' ?>>-- Pilih Level Hak Akses --</option>
                            <option value="admin" <?= old('level') === 'admin' ? 'selected' : '' ?>>Administrator</option>
                            <option value="pimpinan" <?= old('level') === 'pimpinan' ? 'selected' : '' ?>>Pimpinan</option>
                            <option value="pelanggan" <?= old('level') === 'pelanggan' ? 'selected' : '' ?>>Pelanggan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= !empty($errors['level']) ? esc($errors['level']) : 'Pilih level hak akses user.' ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Kata Sandi <span class="text-danger-600">*</span></label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password" class="form-control form-control-sm radius-8 <?= !empty($errors['password']) ? 'is-invalid' : '' ?>" placeholder="Kata sandi (min 6 karakter)" required>
                        <div class="invalid-feedback">
                            <?= !empty($errors['password']) ? esc($errors['password']) : 'Kata sandi minimal 6 karakter.' ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">No. Telepon / HP</label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="solar:phone-calling-outline"></iconify-icon>
                        </span>
                        <input type="text" name="no_hp" class="form-control form-control-sm radius-8" placeholder="Contoh: 081234567890" value="<?= old('no_hp') ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Alamat</label>
                    <div class="icon-field">
                        <span class="icon">
                            <iconify-icon icon="solar:map-point-outline"></iconify-icon>
                        </span>
                        <input type="text" name="alamat" class="form-control form-control-sm radius-8" placeholder="Alamat tinggal pengguna" value="<?= old('alamat') ?>">
                    </div>
                </div>

                <div class="col-12 mt-20 d-flex align-items-center gap-2">
                    <a href="<?= site_url('admin/users') ?>" class="border border-danger-600 bg-danger-600 text-white text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium">
                        <iconify-icon icon="mingcute:back-fill" class="text-base text-white"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-8 text-sm d-flex align-items-center gap-1">
                        <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Data User
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
