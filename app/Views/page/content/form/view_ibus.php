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
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $ibu['ibuRM'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Rekam Medis <?= esc($ibu['ibuRM']) ?></h5>
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
                            <input type="number" name="ibuNIK" class="form-control" placeholder="Masukan NIK" value="<?= esc($ibu['ibuNIK']) ?>" readonly required>
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
                            <input type="text" name="ibuNama" class="form-control" placeholder="Masukan Nama Ibu" value="<?= esc($ibu['ibuNama']) ?>" readonly required>
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
                            <input type="text" name="ibuSuami" class="form-control" placeholder="Masukan Nama Suami" value="<?= esc($ibu['ibuSuami']) ?>" readonly required>
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
                            <input type="date" name="ibuTanggalLahir" class="form-control" placeholder="Masukan Tanggal Lahir Ibu" value="<?= esc($ibu['ibuTanggalLahir']) ?>" readonly required>
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
                            <input type="number" name="ibuNoHP" class="form-control" placeholder="Masukan No HP" value="<?= esc($ibu['ibuNoHP']) ?>" readonly required>
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
                            <input type="text" name="ibuNoBPJS" class="form-control" placeholder="Masukan No BPJS" value="<?= esc($ibu['ibuNoBPJS']) ?>" readonly required>
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
                            <input type="number" name="ibuRT" class="form-control" placeholder="Masukan RT" value="<?= esc($rt) ?>" readonly required>
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
                            <input type="number" name="ibuRW" class="form-control" placeholder="Masukan RW" value="<?= esc($rw) ?>" readonly required>
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
                            <input type="text" name="ibuKecamatan" class="form-control" placeholder="Masukan Kecamatan" value="<?= esc($ibu['ibuKecamatan']) ?>" readonly required>
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
                            <textarea name="ibuAlamat" class="form-control" placeholder="Masukan Alamat" readonly required><?= esc($ibu['ibuAlamat']) ?></textarea>
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
                            <input type="text" name="ibuPendidikan" class="form-control" placeholder="Masukan Pendidikan" value="<?= esc($ibu['ibuPendidikan']) ?>" readonly required>
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
                            <input type="text" name="ibuPekerjaan" class="form-control" placeholder="Masukan Pekerjaan" value="<?= esc($ibu['ibuPekerjaan']) ?>" readonly required>
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
                            <input type="text" name="suamiPekerjaan" class="form-control" placeholder="Masukan Pekerjaan" value="<?= esc($ibu['suamiPekerjaan']) ?>" readonly required>
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
                            <input type="text" name="ibuAgama" class="form-control" placeholder="Masukan Agama" value="<?= esc($ibu['ibuAgama']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Agama dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Gol Darah</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mage:water-drop"></iconify-icon>
                            </span>
                            <input type="text" name="ibuGolDarah" class="form-control" placeholder="Masukan GolDarah" value="<?= esc($ibu['ibuGolDarah']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Gol Darah dibutuhkan
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
                <a href="<?= site_url('kehamilan-ibus/' . $ibu['ibuID']) ?>" class="btn btn-success-100 text-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:file-plus-fill" class="text-xl"></iconify-icon> Data Riwayat
                </a>
                <a href="<?= site_url('antenatal-ibus/' . $ibu['ibuID']) ?>" class="btn btn-success-100 text-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:dashboard-chart-fill" class="text-xl"></iconify-icon> Data Antenatal
                </a>
                <a href="<?= site_url('persalinan-ibus/' . $ibu['ibuID']) ?>" class="btn btn-success-100 text-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:box-plus-fill" class="text-xl"></iconify-icon> Data Persalinan
                </a>
                <a href="<?= site_url('pasca-persalinan-ibus/' . $ibu['ibuID']) ?>" class="btn btn-success-100 text-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-40">
                    <iconify-icon icon="mage:box-plus-fill" class="text-xl"></iconify-icon> Data Pasca Persalinan
                </a>
                <a href="<?= site_url('print-card-ibu/' . $ibu['ibuID']) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:id-card-fill" class="text-xl"></iconify-icon> Cetak Kartu Ibu
                </a>
                <a href="<?= site_url('print-data-ibu/' . $ibu['ibuID']) ?>" class="btn btn-info-100 text-info-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Ibu
                </a>
                <a href="/edit-ibus/<?= esc($ibu['ibuID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Ibu
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($ibu['ibuID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Ibu
                </a>
                <form id="deleteForm_<?= esc($ibu['ibuID']) ?>" action="<?= site_url('delete-ibus') ?>" method="post">
                    <input type="hidden" name="ibuID" value="<?= esc($ibu['ibuID']) ?>">
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