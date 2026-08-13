<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Antenatal</h6>
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
            <a href="<?= site_url('antenatal-ibus/' . $ibu['ibuID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:account-child" class="icon text-lg"></iconify-icon>
                Antenatal
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:note-plus" class="icon text-lg"></iconify-icon>
                Tambah Antenatal
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
            <form action="<?= site_url('add-antenatals') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="ibuID" value="<?= esc($ibu['ibuID'])  ?>">
                <div class="col-md-6">
                    <label class="form-label">Keluhan Sekarang</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="keluhanSekarang" class="form-control" placeholder="Masukan Keluhan" required>
                        <div class="invalid-feedback">
                            Keluhan Sekarang dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tekanan Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="text" name="tekananDarah" class="form-control" placeholder="Masukan Tekanan Darah" required>
                        <div class="invalid-feedback">
                            Tekanan Darah dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="beratBadan" class="form-control" placeholder="Masukan Berat Badan" required>
                        <div class="invalid-feedback">
                            Berat Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Umur Kehamilan (Minggu)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="umurKehamilan" class="form-control" placeholder="Masukan Umur Kehamilan" required>
                        <div class="invalid-feedback">
                            Umur Kehamilan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tinggi Fundus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="tinggiFundus" class="form-control" placeholder="Masukan Tinggi Fundus" required>
                        <div class="invalid-feedback">
                            Tinggi Fundus dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Letak Janin</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="letakJanin" class="form-control" placeholder="Masukan Letak Janin" required>
                        <div class="invalid-feedback">
                            Letak Janin dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Denyut Jantung</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="denyutJantung" class="form-control" placeholder="Masukan Denyut Jantung" required>
                        <div class="invalid-feedback">
                            Denyut Jantung dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lab</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="lab" class="form-control" placeholder="Masukan Data Lab" required>
                        <div class="invalid-feedback">
                            Data Lab dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pemeliharaan Khusus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="pemeliharaanKhusus" class="form-control" placeholder="Masukan Pemeliharaan Khusus" required>
                        <div class="invalid-feedback">
                            Pemeliharaan Khusus dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-10">
                    <label class="form-label">Tindakan Terapi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="tindakanTerapi" class="form-control" placeholder="Masukan Tindakan Terapi" required>
                        <div class="invalid-feedback">
                            Tindakan Terapi dibutuhkan
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