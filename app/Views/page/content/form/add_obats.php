<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Obat</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('obat') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
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
            <form action="<?= site_url('add-obats') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="col-md-6">
                    <label class="form-label">Nama Obat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="fluent:text-document-settings"></iconify-icon>
                        </span>
                        <input type="text" name="obatNama" class="form-control" placeholder="Masukkan Nama Obat" required>
                        <div class="invalid-feedback">
                            Nama obat dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok Obat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="fluent:text-bullet-list-square-edit"></iconify-icon>
                        </span>
                        <input type="number" name="obatStok" class="form-control" placeholder="Masukkan Stok Obat" required>
                        <div class="invalid-feedback">
                            Stok obat dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga Obat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="bi:currency-dollar"></iconify-icon>
                        </span>
                        <input type="number" name="obatHarga" class="form-control" placeholder="Masukkan Harga Obat" required>
                        <div class="invalid-feedback">
                            Harga obat dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('obat') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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