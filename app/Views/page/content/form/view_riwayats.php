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
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $riwayat['riwayatID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Riwayat <?= esc($riwayat['riwayatID']) ?> Rekam Medis <?= esc($ibu['ibuRM']) ?> (<?= esc($ibu['ibuNama']) ?>)</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-riwayats') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <input type="hidden" name="riwayatID" value="<?= esc($riwayat['riwayatID']) ?>">
                    <div class="col-md-4">
                        <label class="form-label">Kehamilan Ke</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="number" name="kehamilan" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['kehamilan']) ?>" readonly required>
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
                            <input type="number" name="gravida" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['gravida']) ?>" readonly required>
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
                            <input type="number" name="partus" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['partus']) ?>" readonly required>
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
                            <input type="number" name="abortus" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['abortus']) ?>" readonly required>
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
                            <input type="number" name="lahirMati" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['lahirMati']) ?>" readonly required>
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
                            <input type="date" name="tanggalHPL" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['tanggalHPL']) ?>" readonly required>
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
                            <input type="date" name="tanggalHPHT" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['tanggalHPHT']) ?>" readonly required>
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
                            <input type="date" name="taksiranPersalinan" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['taksiranPersalinan']) ?>" readonly required>
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
                            <input type="date" name="persalinanSebelumnya" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['persalinanSebelumnya']) ?>" readonly required>
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
                            <input type="number" name="bbSebelum" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['bbSebelum']) ?>" readonly required>
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
                            <input type="number" name="tb" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['tb']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Data Tinggi Badan dibutuhkan
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

                <a href="<?= site_url('print-data-riwayat/' . $riwayat['riwayatID']) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Riwayat
                </a>
                <a href="/edit-riwayats/<?= esc($riwayat['riwayatID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Riwayat
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($riwayat['riwayatID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Riwayat
                </a>
                <form id="deleteForm_<?= esc($riwayat['riwayatID']) ?>" action="<?= site_url('delete-riwayats') ?>" method="post">
                    <input type="hidden" name="riwayatID" value="<?= esc($riwayat['riwayatID']) ?>">
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