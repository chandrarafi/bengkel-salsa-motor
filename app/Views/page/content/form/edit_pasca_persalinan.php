<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Pasca Persalinan</h6>
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
            <a href="<?= site_url('pasca-persalinan-ibus/' . $ibu['ibuID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:baby-carriage-fill" class="icon text-lg"></iconify-icon>
                Pasca Persalinan
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:edit" class="icon text-lg"></iconify-icon>
                Edit <?= $pasca_persalinan['pemeriksaanRutinID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data <?= esc($pasca_persalinan['pemeriksaanRutinID']) ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-pasca-persalinans') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="pemeriksaanRutinID" value="<?= esc($pasca_persalinan['pemeriksaanRutinID']) ?>">
                <input type="hidden" name="ibuID" value="<?= esc($pasca_persalinan['ibuID']) ?>">

                <div class="col-md-6">
                    <label class="form-label">Tanggal Pemeriksaan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalPemeriksaan" class="form-control" value="<?= esc($pasca_persalinan['tanggalPemeriksaan']) ?>" required>
                        <div class="invalid-feedback">
                            Tanggal Pemeriksaan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jam Pemeriksaan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:time-fill"></iconify-icon>
                        </span>
                        <input type="time" name="jamPemeriksaan" class="form-control" value="<?= esc($pasca_persalinan['jamPemeriksaan']) ?>" required>
                        <div class="invalid-feedback">
                            Jam Pemeriksaan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tekanan Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="text" name="tekananDarah" class="form-control" placeholder="Masukan Tekanan Darah" value="<?= esc($pasca_persalinan['tekananDarah']) ?>" required>
                        <div class="invalid-feedback">
                            Tekanan Darah dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nadi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="nadi" class="form-control" placeholder="Masukan Nadi" value="<?= esc($pasca_persalinan['nadi']) ?>" required>
                        <div class="invalid-feedback">
                            Nadi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Suhu Tubuh</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="suhuTubuh" class="form-control" placeholder="Masukan Suhu Tubuh" value="<?= esc($pasca_persalinan['suhuTubuh']) ?>" required>
                        <div class="invalid-feedback">
                            Suhu Tubuh dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="beratBadan" class="form-control" placeholder="Masukan Berat Badan" value="<?= esc($pasca_persalinan['beratBadan']) ?>" required>
                        <div class="invalid-feedback">
                            Berat Badan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tinggi Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="tinggiBadan" class="form-control" placeholder="Masukan Tinggi Badan" value="<?= esc($pasca_persalinan['tinggiBadan']) ?>" required>
                        <div class="invalid-feedback">
                            Tinggi Badan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pernapasan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="pernapasan" class="form-control" placeholder="Masukan Pernapasan" value="<?= esc($pasca_persalinan['pernapasan']) ?>" required>
                        <div class="invalid-feedback">
                            Pernapasan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi Luka Episiotomi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kondisiLukaEpisiotomi" class="form-control" placeholder="Masukan Kondisi Luka Episiotomi" value="<?= esc($pasca_persalinan['kondisiLukaEpisiotomi']) ?>" required>
                        <div class="invalid-feedback">
                            Kondisi Luka Episiotomi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi Luka Caesar</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kondisiLukaCaesarean" class="form-control" placeholder="Masukan Kondisi Luka Caesar" value="<?= esc($pasca_persalinan['kondisiLukaCaesarean']) ?>" required>
                        <div class="invalid-feedback">
                            Kondisi Luka Caesar dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi Uterus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kondisiUterus" class="form-control" placeholder="Masukan Kondisi Uterus" value="<?= esc($pasca_persalinan['kondisiUterus']) ?>" required>
                        <div class="invalid-feedback">
                            Kondisi Uterus dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi Payudara</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kondisiPayudara" class="form-control" placeholder="Masukan Kondisi Payudara" value="<?= esc($pasca_persalinan['kondisiPayudara']) ?>" required>
                        <div class="invalid-feedback">
                            Kondisi Payudara dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kondisi Vagina</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kondisiVagina" class="form-control" placeholder="Masukan Kondisi Vagina" value="<?= esc($pasca_persalinan['kondisiVagina']) ?>" required>
                        <div class="invalid-feedback">
                            Kondisi Vagina dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Kesehatan Mental</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kesehatanMental" class="form-control" placeholder="Masukan Kesehatan Mental" value="<?= esc($pasca_persalinan['kesehatanMental']) ?>" required>
                        <div class="invalid-feedback">
                            Kesehatan Mental dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pemeriksaan Lab</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="pemeriksaanLab" class="form-control" placeholder="Masukan Pemeriksaan Lab" value="<?= esc($pasca_persalinan['pemeriksaanLab']) ?>" required>
                        <div class="invalid-feedback">
                            Pemeriksaan Lab dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Terapi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="terapi" class="form-control" placeholder="Masukan Terapi" value="<?= esc($pasca_persalinan['terapi']) ?>" required>
                        <div class="invalid-feedback">
                            Terapi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nasihat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="nasihat" class="form-control" placeholder="Masukan Nasihat" value="<?= esc($pasca_persalinan['nasihat']) ?>" required>
                        <div class="invalid-feedback">
                            Nasihat dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Komplikasi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="komplikasi" class="form-control" placeholder="Masukan Komplikasi" value="<?= esc($pasca_persalinan['komplikasi']) ?>" required>
                        <div class="invalid-feedback">
                            Komplikasi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Catatan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="catatan" class="form-control" placeholder="Masukan Catatan" value="<?= esc($pasca_persalinan['catatan']) ?>" required>
                        <div class="invalid-feedback">
                            Catatan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('pasca-persalinan-ibus/' . esc($pasca_persalinan['ibuID'])) ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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