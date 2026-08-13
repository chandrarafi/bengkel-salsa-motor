<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Kamar</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('kamars') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data <?= esc($kamar['kamarID']) ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-kamars') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="kamarID" value="<?= esc($kamar['kamarID']) ?>">
                <div class="col-md-6">
                    <label class="form-label">Nama Kamar</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="eva:home-outline"></iconify-icon>
                        </span>
                        <input type="text" name="kamarNama" class="form-control" placeholder="Masukkan Nama Kamar" value="<?= esc($kamar['kamarNama']) ?>" required>
                        <div class="invalid-feedback">
                            Nama kamar dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipe Kamar</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="icon-park:apartment"></iconify-icon>
                        </span>
                        <input type="text" name="kamarTipe" class="form-control" placeholder="Masukkan Tipe Kamar" value="<?= esc($kamar['kamarTipe']) ?>" required>
                        <div class="invalid-feedback">
                            Tipe kamar dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Biaya Kamar</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="bx:bxs-dollar-circle"></iconify-icon>
                        </span>
                        <input type="number" name="kamarBiaya" class="form-control" placeholder="Masukkan Biaya Kamar" value="<?= esc($kamar['kamarBiaya']) ?>" required>
                        <div class="invalid-feedback">
                            Biaya kamar dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kapasitas</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="kapasitas" value="<?= esc($kamar['kapasitas']) ?>" class="form-control" placeholder="Masukkan Kapasitas Kamar" required>
                        <div class="invalid-feedback">
                            Kapasitas kamar dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('kamars') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="ant-design:arrow-left-outlined"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="iconoir:save" class="text-xl"></iconify-icon> Simpan
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