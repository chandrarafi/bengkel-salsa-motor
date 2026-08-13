<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Ibu</h6>
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
                <iconify-icon icon="material-symbols:edit" class="icon text-lg"></iconify-icon>
                Edit <?= $ibu['ibuRM'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data <?= esc($ibu['ibuID']) ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-ibus') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <?php
                $rtRwParts = explode('/', $ibu['ibuRtRw']);
                $rt = $rtRwParts[0];
                $rw = $rtRwParts[1];
                ?>
                <input type="hidden" name="ibuID" value="<?= esc($ibu['ibuID']) ?>">
                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:id-card"></iconify-icon>
                        </span>
                        <input type="number" name="ibuNIK" class="form-control" placeholder="Masukan NIK" value="<?= esc($ibu['ibuNIK']) ?>" required>
                        <div class="invalid-feedback">
                            NIK dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="ibuNama" class="form-control" placeholder="Masukan Nama Ibu" value="<?= esc($ibu['ibuNama']) ?>" required>
                        <div class="invalid-feedback">
                            Nama ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Suami</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="ibuSuami" class="form-control" placeholder="Masukan Nama Suami" value="<?= esc($ibu['ibuSuami']) ?>" required>
                        <div class="invalid-feedback">
                            Nama suami dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:calendar"></iconify-icon>
                        </span>
                        <input type="date" name="ibuTanggalLahir" class="form-control" placeholder="Masukan Tanggal Lahir Ibu" value="<?= esc($ibu['ibuTanggalLahir']) ?>" required>
                        <div class="invalid-feedback">
                            Tanggal Lahir Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No HP</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:phone"></iconify-icon>
                        </span>
                        <input type="number" name="ibuNoHP" class="form-control" placeholder="Masukan No HP" value="<?= esc($ibu['ibuNoHP']) ?>" required>
                        <div class="invalid-feedback">
                            No HP dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No BPJS</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:id-card"></iconify-icon>
                        </span>
                        <input type="text" name="ibuNoBPJS" class="form-control" placeholder="Masukan No BPJS" value="<?= esc($ibu['ibuNoBPJS']) ?>" required>
                        <div class="invalid-feedback">
                            No BPJS dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-3">
                    <label class="form-label">RT</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <input type="number" name="ibuRT" class="form-control" placeholder="Masukan RT" value="<?= esc($rt) ?>" required>
                        <div class="invalid-feedback">
                            RT dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">RW</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <input type="number" name="ibuRW" class="form-control" placeholder="Masukan RW" value="<?= esc($rw) ?>" required>
                        <div class="invalid-feedback">
                            RW dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kecamatan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <input type="text" name="ibuKecamatan" class="form-control" placeholder="Masukan Kecamatan" value="<?= esc($ibu['ibuKecamatan']) ?>" required>
                        <div class="invalid-feedback">
                            Kecamatan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Alamat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <textarea name="ibuAlamat" class="form-control" placeholder="Masukan Alamat" required><?= esc($ibu['ibuAlamat']) ?></textarea>
                        <div class="invalid-feedback">
                            Alamat dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pendidikan Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:book-text"></iconify-icon>
                        </span>
                        <input type="text" name="ibuPendidikan" class="form-control" placeholder="Masukan Pendidikan" value="<?= esc($ibu['ibuPendidikan']) ?>" required>
                        <div class="invalid-feedback">
                            Pendidikan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:clipboard-2"></iconify-icon>
                        </span>
                        <input type="text" name="ibuPekerjaan" class="form-control" placeholder="Masukan Pekerjaan" value="<?= esc($ibu['ibuPekerjaan']) ?>" required>
                        <div class="invalid-feedback">
                            Pekerjaan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Suami</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:clipboard-2"></iconify-icon>
                        </span>
                        <input type="text" name="suamiPekerjaan" class="form-control" placeholder="Masukan Pekerjaan" value="<?= esc($ibu['suamiPekerjaan']) ?>" required>
                        <div class="invalid-feedback">
                            Pekerjaan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Agama Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:message-dots-question-mark"></iconify-icon>
                        </span>
                        <select class="form-control radius-8 form-select" name="ibuAgama">
                            <option value="Islam" <?= esc($ibu['ibuAgama']) == 'Islam' ? 'selected' : '' ?>>Islam</option>
                            <option value="Budha" <?= esc($ibu['ibuAgama']) == 'Budha' ? 'selected' : '' ?>>Budha</option>
                            <option value="Hindu" <?= esc($ibu['ibuAgama']) == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                            <option value="Katolik" <?= esc($ibu['ibuAgama']) == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                            <option value="Konghucu" <?= esc($ibu['ibuAgama']) == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                            <option value="Kristen" <?= esc($ibu['ibuAgama']) == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                        </select>
                        <div class="invalid-feedback">
                            Agama dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gol Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:water-drop"></iconify-icon>
                        </span>
                        <select class="form-control radius-8 form-select" name="ibuGolDarah">
                            <option value="A" <?= esc($ibu['ibuGolDarah']) == 'A' ? 'selected' : '' ?>>A</option>
                            <option value="AB" <?= esc($ibu['ibuGolDarah']) == 'AB' ? 'selected' : '' ?>>AB</option>
                            <option value="B" <?= esc($ibu['ibuGolDarah']) == 'B' ? 'selected' : '' ?>>B</option>
                            <option value="O" <?= esc($ibu['ibuGolDarah']) == 'O' ? 'selected' : '' ?>>O</option>
                        </select>
                        <div class="invalid-feedback">
                            Gol Darah dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('ibus') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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