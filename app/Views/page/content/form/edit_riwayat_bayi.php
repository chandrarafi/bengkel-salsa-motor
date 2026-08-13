<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Riwayat Bayi</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:note-alt" class="icon text-lg"></iconify-icon>
                Pelayanan Pasien
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('bayis') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:baby-fill" class="icon text-lg"></iconify-icon>
                Bayi
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('view-bayis/' . $bayi['bayiID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $bayi['bayiNoRM'] ?>
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('riwayat-bayis/' . $bayi['bayiID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:history-line" class="icon text-lg"></iconify-icon>
                Riwayat Bayi
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:edit" class="icon text-lg"></iconify-icon>
                Edit <?= $riwayat_bayi['riwayatBayiID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data <?= esc($riwayat_bayi['riwayatBayiID']) ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-riwayat-bayi') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="riwayatBayiID" value="<?= esc($riwayat_bayi['riwayatBayiID']) ?>">
                <input type="hidden" name="bayiID" value="<?= esc($riwayat_bayi['bayiID']) ?>">
                <div class="col-md-6">
                    <label class="form-label">Berat Badan (kg)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="bbBayi" class="form-control" placeholder="Masukkan Berat Badan" value="<?= esc($riwayat_bayi['bbBayi']) ?>" required>
                        <div class="invalid-feedback">
                            Berat Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Panjang Badan (cm)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="panjangBayi" class="form-control" placeholder="Masukkan Panjang Badan" value="<?= esc($riwayat_bayi['panjangBayi']) ?>" required>
                        <div class="invalid-feedback">
                            Panjang Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Golongan Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="golonganDarah" class="form-control" placeholder="Masukkan Golongan Darah" value="<?= esc($riwayat_bayi['golonganDarah']) ?>" required>
                        <div class="invalid-feedback">
                            Golongan Darah dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Buku KIA/KMS</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="bukuKIAKMS" class="form-control" placeholder="Masukkan Buku KIA/KMS" value="<?= esc($riwayat_bayi['bukuKIAKMS']) ?>" required>
                        <div class="invalid-feedback">
                            Buku KIA/KMS dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Keadaan Lahir</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="keadaanLahir" class="form-control" placeholder="Masukkan Keadaan Lahir" value="<?= esc($riwayat_bayi['keadaanLahir']) ?>" required>
                        <div class="invalid-feedback">
                            Keadaan Lahir dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Komplikasi Lahir</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="komplikasiLahir" class="form-control" placeholder="Masukkan Komplikasi Lahir" value="<?= esc($riwayat_bayi['komplikasiLahir']) ?>" required>
                        <div class="invalid-feedback">
                            Komplikasi Lahir dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Resusitasi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="resusitasi" class="form-control" placeholder="Masukkan Resusitasi" value="<?= esc($riwayat_bayi['resusitasi']) ?>" required>
                        <div class="invalid-feedback">
                            Resusitasi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('riwayat-bayis/' . esc($riwayat_bayi['bayiID'])) ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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