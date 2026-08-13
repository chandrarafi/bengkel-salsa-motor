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
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $persalinan['persalinanID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Persalinan <?= esc($persalinan['persalinanID']) ?> Rekam Medis <?= esc($ibu['ibuRM']) ?> (<?= esc($ibu['ibuNama']) ?>)</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-persalinan') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <input type="hidden" name="persalinanID" value="<?= esc($persalinan['persalinanID']) ?>">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Persalinan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:calendar-fill"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalPersalinan" class="form-control" value="<?= esc($persalinan['tanggalPersalinan']) ?>" readonly required>
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
                            <input type="time" name="jamPersalinan" class="form-control" value="<?= esc($persalinan['jamPersalinan']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Jam Persalinan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cara Persalinan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="caraPersalinan" class="form-control" placeholder="Masukan Cara Persalinan" value="<?= esc($persalinan['caraPersalinan']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Cara Persalinan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Petugas Persalinan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="petugasPersalinan" class="form-control" placeholder="Masukan Petugas Persalinan" value="<?= esc($persalinan['userNama']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Petugas Persalinan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tekanan Darah</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="text" name="tekananDarah" class="form-control" placeholder="Masukan Tekanan Darah" value="<?= esc($persalinan['tekananDarah']) ?>" readonly required>
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
                            <input type="number" name="nadi" class="form-control" placeholder="Masukan Nadi" value="<?= esc($persalinan['nadi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Nadi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Temperature</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="number" name="temperature" class="form-control" placeholder="Masukan Temperature" value="<?= esc($persalinan['temperature']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Temperature dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tinggi Fundus Uteri</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="tinggiFundusUteri" class="form-control" placeholder="Masukan Tinggi Fundus Uteri" value="<?= esc($persalinan['tinggiFundusUteri']) ?>" readonly required>
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
                            <input type="text" name="kontraksiUterus" class="form-control" placeholder="Masukan Kontraksi Uterus" value="<?= esc($persalinan['kontraksiUterus']) ?>" readonly required>
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
                            <input type="text" name="kandunganKemih" class="form-control" placeholder="Masukan Kandungan Kemih" value="<?= esc($persalinan['kandunganKemih']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Kandungan Kemih dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pendarahan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="pendarahan" class="form-control" placeholder="Masukan Pendarahan" value="<?= esc($persalinan['pendarahan']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Pendarahan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Keadaan Ibu</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="keadaanIbu" class="form-control" placeholder="Masukan Keadaan Ibu" value="<?= esc($persalinan['keadaanIbu']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Keadaan Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Keadaan Bayi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="keadaanBayi" class="form-control" placeholder="Masukan Keadaan Bayi" value="<?= esc($persalinan['keadaanBayi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Keadaan Bayi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Presentasi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="presentasi" class="form-control" placeholder="Masukan Presentasi" value="<?= esc($persalinan['presentasi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Presentasi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Kala 1</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:calendar-fill"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalKala1" class="form-control" value="<?= esc($persalinan['tanggalKala1']) ?>" readonly required>
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
                            <input type="time" name="jamKala1" class="form-control" value="<?= esc($persalinan['jamKala1']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Jam Kala 1 dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Kala 2</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:calendar-fill"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalKala2" class="form-control" value="<?= esc($persalinan['tanggalKala2']) ?>" readonly required>
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
                            <input type="time" name="jamKala2" class="form-control" value="<?= esc($persalinan['jamKala2']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Jam Kala 2 dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir Bayi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:calendar-fill"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalLahirBayi" class="form-control" value="<?= esc($persalinan['tanggalLahirBayi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tanggal Lahir Bayi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Plasenta Lahir</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:calendar-fill"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalPlasentaLahir" class="form-control" value="<?= esc($persalinan['tanggalPlasentaLahir']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tanggal Plasenta Lahir dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kondisi Plasenta</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="kondisiPlasenta" class="form-control" placeholder="Masukan Kondisi Plasenta" value="<?= esc($persalinan['kondisiPlasenta']) ?>" readonly required>
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
                            <input type="text" name="manajemenKala3" class="form-control" placeholder="Masukan Manajemen Kala 3" value="<?= esc($persalinan['manajemenKala3']) ?>" readonly required>
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
                            <input type="text" name="kondisiKala4" class="form-control" placeholder="Masukan Kondisi Kala 4" value="<?= esc($persalinan['kondisiKala4']) ?>" readonly required>
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
                            <input type="number" name="jumlahPendarahan" class="form-control" placeholder="Masukan Jumlah Pendarahan" value="<?= esc($persalinan['jumlahPendarahan']) ?>" readonly required>
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
                            <input type="number" name="tekananDarahKala4" class="form-control" placeholder="Masukan Tekanan Darah Kala 4" value="<?= esc($persalinan['tekananDarahKala4']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tekanan Darah Kala 4 dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Terjadinya Komplikasi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="terjadinyaKomplikasi" class="form-control" placeholder="Masukan Terjadinya Komplikasi" value="<?= esc($persalinan['terjadinyaKomplikasi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Terjadinya Komplikasi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-10">
                        <label class="form-label">Keterangan Komplikasi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="keteranganKomplikasi" class="form-control" placeholder="Masukan Keterangan Komplikasi" value="<?= esc($persalinan['keteranganKomplikasi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Keterangan Komplikasi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-10">
                        <label class="form-label">Inisiasi Menyusui Dini</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="imd" class="form-control" placeholder="Masukan IMD" value="<?= esc($persalinan['imd']) ?>" readonly required>
                            <div class="invalid-feedback">
                                IMD dibutuhkan
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Aksi</h5>
            </div>
            <div class="card-body">

                <a href="<?= site_url('print-data-persalinan/' . esc($persalinan['persalinanID'])) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Persalinan
                </a>
                <a href="/edit-persalinans/<?= esc($persalinan['persalinanID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Persalinan
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($persalinan['persalinanID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Persalinan
                </a>
                <form id="deleteForm_<?= esc($persalinan['persalinanID']) ?>" action="<?= site_url('delete-persalinans') ?>" method="post">
                    <input type="hidden" name="persalinanID" value="<?= esc($persalinan['persalinanID']) ?>">
                </form>
            </div>
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

    function confirmDelete(userID) {
        Swal.fire({
            text: "Kamu yakin menghapus data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete action
                $('#deleteForm_' + userID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>