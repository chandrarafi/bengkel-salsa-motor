<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">User</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('users') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Input Data</h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('add-users') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="userNama" class="form-control" placeholder="Masukan Nama Lengkap" required>
                        <div class="invalid-feedback">
                            Nama lengkap dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="userEmail" class="form-control" placeholder="Masukan Email" required>
                        <div class="invalid-feedback">
                            Email dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <select class="form-control radius-8 form-select" name="userRole">
                            <option>Administrator </option>
                            <option>Bidan </option>
                            <option>Owner</option>
                        </select>
                        <div class="invalid-feedback">
                            Role dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kata Sandi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="userPassword" class="form-control" placeholder="*******" required>
                        <div class="invalid-feedback">
                            Kata sandi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('users') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="mingcute:back-fill" class="text-xl"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="mingcute:save-2-fill" class="text-xl"></iconify-icon> Simpan
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

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
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