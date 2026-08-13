<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Persalinan</h6>
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
            <a href="<?= site_url('persalinan-ibus/' . $ibu['ibuID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:baby-carriage-fill" class="icon text-lg"></iconify-icon>
                Persalinan
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:note-plus" class="icon text-lg"></iconify-icon>
                Tambah Persalinan
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12 mb-10">
    <div id="table-bayi" class="card basic-data-table mb-20">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Pilih Bidan</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    ID
                                </label>
                            </div>
                        </th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">
                                        <?= esc($user['userID']) ?>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= esc($user['userNama']) ?></h6>
                                </div>

                            </td>
                            <td><?= esc($user['userEmail']) ?></td>
                            <td><span class="<?= esc($user['userRole']) == "Administrator" ? "bg-success-focus text-success-main" : (esc($user['userRole']) == "Bidan" ? "bg-info-focus text-info-main" : "bg-danger-focus text-danger-main") ?> px-24 py-4 rounded-pill fw-medium text-sm"><?= esc($user['userRole']) ?></span></td>
                            <td>
                                <button onclick="selectDataBidan('<?= esc($user['userID']) ?>','<?= esc($user['userNama']) ?>')" type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-14 py-6 text-sm">Pilih</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Input Data</h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('add-persalinans') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="ibuID" value="<?= esc($ibu['ibuID']) ?>">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Persalinan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalPersalinan" class="form-control" placeholder="Masukan Tanggal Persalinan" required>
                        <div class="invalid-feedback">
                            Tanggal Persalinan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jam Persalinan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:time-fill"></iconify-icon>
                        </span>
                        <input type="time" name="jamPersalinan" class="form-control" placeholder="Masukan Jam Persalinan" required>
                        <div class="invalid-feedback">
                            Jam Persalinan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cara Persalinan</label>
                    <div class="icon-field has-validation">
                        <select name="caraPersalinan" class="form-select" required>
                            <option value="" disabled selected>Pilih Cara Plasenta</option>
                            <option value="Normal">Normal</option>
                            <option value="Caesar">Caesar</option>
                            <option value="Vakum">Vakum</option>
                            <option value="Forceps">Forceps</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <div class="invalid-feedback">
                            Cara Persalinan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Petugas</label>
                    <div class="has-validation">
                        <input type="hidden" id="petugasPersalinan" name="petugasPersalinan">
                        <div class="input-group">
                            <input type="text" id="petugasNama" name="petugasNama" class="form-control" placeholder="Pilih Data Petugas" readonly>
                            <button type="button" onclick="showDataBidan()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                        </div>
                        <div class="invalid-feedback">
                            Data Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tekanan Darah(mmHg)</label>
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
                    <label class="form-label">Nadi(mmHg)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="nadi" class="form-control" placeholder="Masukan Nadi" required>
                        <div class="invalid-feedback">
                            Nadi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Temperatur('C)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="temperature" class="form-control" placeholder="Masukan Temperatur" required>
                        <div class="invalid-feedback">
                            Temperatur dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tinggi Fundus Uteri(cm)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="tinggiFundusUteri" class="form-control" placeholder="Masukan Tinggi Fundus Uteri" required>
                        <div class="invalid-feedback">
                            Tinggi Fundus Uteri dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kontraksi Uterus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kontraksiUterus" class="form-control" placeholder="Masukan Kontraksi Uterus" required>
                        <div class="invalid-feedback">
                            Kontraksi Uterus dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kandungan Kemih</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kandunganKemih" class="form-control" placeholder="Masukan Kandungan Kemih" required>
                        <div class="invalid-feedback">
                            Kandungan Kemih dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pendarahan(mm)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="pendarahan" class="form-control" placeholder="Masukan Pendarahan" required>
                        <div class="invalid-feedback">
                            Pendarahan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Keadaan Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:enum-fill"></iconify-icon>
                        </span>
                        <select name="keadaanIbu" class="form-select" required>
                            <option value="" disabled selected>Pilih Keadaan Ibu</option>
                            <option value="baik">baik</option>
                            <option value="kurang baik">kurang baik</option>
                            <option value="buruk">buruk</option>
                        </select>
                        <div class="invalid-feedback">
                            Keadaan Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Keadaan Bayi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:enum-fill"></iconify-icon>
                        </span>
                        <select name="keadaanBayi" class="form-select" required>
                            <option value="" disabled selected>Pilih Keadaan Bayi</option>
                            <option value="sehat">sehat</option>
                            <option value="sakit">sakit</option>
                            <option value="meninggal">meninggal</option>
                        </select>
                        <div class="invalid-feedback">
                            Keadaan Bayi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Presentasi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:enum-fill"></iconify-icon>
                        </span>
                        <select name="presentasi" class="form-select" required>
                            <option value="" disabled selected>Pilih Presentasi</option>
                            <option value="kelapa">kepala</option>
                            <option value="bahu">bahu</option>
                            <option value="bokong">bokong</option>
                        </select>
                        <div class="invalid-feedback">
                            Presentasi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Kala 1</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalKala1" class="form-control" placeholder="Masukan Tanggal Kala 1" required>
                        <div class="invalid-feedback">
                            Tanggal Kala 1 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jam Kala 1</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:time-fill"></iconify-icon>
                        </span>
                        <input type="time" name="jamKala1" class="form-control" placeholder="Masukan Jam Kala 1" required>
                        <div class="invalid-feedback">
                            Jam Kala 1 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Kala 2</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalKala2" class="form-control" placeholder="Masukan Tanggal Kala 2" required>
                        <div class="invalid-feedback">
                            Tanggal Kala 2 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jam Kala 2</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:time-fill"></iconify-icon>
                        </span>
                        <input type="time" name="jamKala2" class="form-control" placeholder="Masukan Jam Kala 2" required>
                        <div class="invalid-feedback">
                            Jam Kala 2 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir Bayi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalLahirBayi" class="form-control" placeholder="Masukan Tanggal Lahir Bayi" required>
                        <div class="invalid-feedback">
                            Tanggal Lahir Bayi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Plasenta Lahir</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalPlasentaLahir" class="form-control" placeholder="Masukan Tanggal Plasenta Lahir" required>
                        <div class="invalid-feedback">
                            Tanggal Plasenta Lahir dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kondisi Plasenta</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:enum-fill"></iconify-icon>
                        </span>
                        <select name="kondisiPlasenta" class="form-select" required>
                            <option value="" disabled selected>Pilih Kondisi Plasenta</option>
                            <option value="baik">baik</option>
                            <option value="buruk">buruk</option>
                        </select>
                        <div class="invalid-feedback">
                            Kondisi Plasenta dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Manajemen Kala 3</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="manajemenKala3" class="form-control" placeholder="Masukan Manajemen Kala 3" required>
                        <div class="invalid-feedback">
                            Manajemen Kala 3 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kondisi Kala 4</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="kondisiKala4" class="form-control" placeholder="Masukan Kondisi Kala 4" required>
                        <div class="invalid-feedback">
                            Kondisi Kala 4 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah Pendarahan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="jumlahPendarahan" class="form-control" placeholder="Masukan Jumlah Pendarahan" required>
                        <div class="invalid-feedback">
                            Jumlah Pendarahan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tekanan Darah Kala 4</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="tekananDarahKala4" class="form-control" placeholder="Masukan Tekanan Darah Kala 4" required>
                        <div class="invalid-feedback">
                            Tekanan Darah Kala 4 dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Terjadinya Komplikasi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:enum-fill"></iconify-icon>
                        </span>
                        <select name="terjadinyaKomplikasi" class="form-select" required>
                            <option value="" disabled selected>Pilih Terjadinya Komplikasi</option>
                            <option value="ya">ya</option>
                            <option value="tidak">tidak</option>
                        </select>
                        <div class="invalid-feedback">
                            Terjadinya Komplikasi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Keterangan Komplikasi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <textarea name="keteranganKomplikasi" class="form-control" placeholder="Masukan Keterangan Komplikasi" required></textarea>
                        <div class="invalid-feedback">
                            Keterangan Komplikasi dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">IMD (Inisiasi Menyusui Dini)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:enum-fill"></iconify-icon>
                        </span>
                        <select name="imd" class="form-select" required>
                            <option value="" disabled selected>Pilih IMD</option>
                            <option value="ya">ya</option>
                            <option value="tidak">tidak</option>
                        </select>
                        <div class="invalid-feedback">
                            IMD dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('kehamilan-ibus/' . esc($ibu['ibuID'])) ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:back-fill" class="text-xl"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:save-fill" class="text-xl"></iconify-icon> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#table-bayi').hide();
    });

    function showDataBidan() {
        $('#tambah-table-bayi').hide();
        $('#table-bayi').show();
    }

    function selectDataBidan(petugasPersalinan, petugasNama) {
        $('#petugasPersalinan').val(petugasPersalinan);
        $('#petugasNama').val(petugasNama);
        $('#table-bayi').hide();
        $('#tambah-table-bayi').show();
    }

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