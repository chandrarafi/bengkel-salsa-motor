<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Riwayat</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:note-alt" class="icon text-lg"></iconify-icon>
                Pelayanan Pasien
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('ibus') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:mother-nurse" class="icon text-lg"></iconify-icon>
                Ibu
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('view-ibus/' . $ibu['ibuID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $ibu['ibuRM'] ?>
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('kehamilan-ibus/' . $ibu['ibuID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:history" class="icon text-lg"></iconify-icon>
                Riwayat
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:note-plus" class="icon text-lg"></iconify-icon>
                Tambah Riwayat
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
            <form action="<?= site_url('add-riwayats') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="ibuID" value="<?= esc($ibu['ibuID'])  ?>">
                <div class="col-md-4">
                    <label class="form-label">Kehamilan Ke</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="kehamilan" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Kehamilan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Gravida</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="gravida" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Gravida dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Partus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="partus" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Partus dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Abortus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="abortus" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Abortus dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lahir Mati</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="lahirMati" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Lahir Mati dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal HPL</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalHPL" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Tanggal HPL dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal HPHT</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalHPHT" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Tanggal HPHT dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Taksiran Persalinan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="taksiranPersalinan" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Taksiran Persalinan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Persalinan Sebelumnya</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="persalinanSebelumnya" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Persalinan Sebelumnya dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="bbSebelum" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Berat Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-10">
                    <label class="form-label">Tinggi Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="tb" class="form-control" placeholder="Masukan Data" required>
                        <div class="invalid-feedback">
                            Data Tinggi Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('kehamilan-ibus/' . esc($ibu['ibuID'])) ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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