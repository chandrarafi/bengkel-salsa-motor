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
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $antenatal['antenatalID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Antenatal <?= esc($antenatal['antenatalID']) ?> Rekam Medis <?= esc($ibu['ibuRM']) ?> (<?= esc($ibu['ibuNama']) ?>)</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-antenatal') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <input type="hidden" name="antenatalID" value="<?= esc($antenatal['antenatalID']) ?>">
                    <div class="col-md-6">
                        <label class="form-label">Keluhan Sekarang</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="keluhanSekarang" class="form-control" placeholder="Masukan Keluhan" value="<?= esc($antenatal['keluhanSekarang']) ?>" readonly required>
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
                            <input type="text" name="tekananDarah" class="form-control" placeholder="Masukan Tekanan Darah" value="<?= esc($antenatal['tekananDarah']) ?>" readonly required>
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
                            <input type="number" name="beratBadan" class="form-control" placeholder="Masukan Berat Badan" value="<?= esc($antenatal['beratBadan']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Berat Badan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Umur Kehamilan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="text" name="umurKehamilan" class="form-control" placeholder="Masukan Umur Kehamilan" value="<?= esc($antenatal['umurKehamilan']) ?> minggu" readonly required>
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
                            <input type="number" name="tinggiFundus" class="form-control" placeholder="Masukan Tinggi Fundus" value="<?= esc($antenatal['tinggiFundus']) ?>" readonly required>
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
                            <input type="text" name="letakJanin" class="form-control" placeholder="Masukan Letak Janin" value="<?= esc($antenatal['letakJanin']) ?>" readonly required>
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
                            <input type="number" name="denyutJantung" class="form-control" placeholder="Masukan Denyut Jantung" value="<?= esc($antenatal['denyutJantung']) ?>" readonly required>
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
                            <input type="text" name="lab" class="form-control" placeholder="Masukan Data Lab" value="<?= esc($antenatal['lab']) ?>" readonly required>
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
                            <input type="text" name="pemeliharaanKhusus" class="form-control" placeholder="Masukan Data Pemeliharaan Khusus" value="<?= esc($antenatal['pemeliharaanKhusus']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Data Pemeliharaan Khusus dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-10">
                        <label class="form-label">Tindakan Terapi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                            </span>
                            <input type="text" name="tindakanTerapi" class="form-control" placeholder="Masukan Data Tindakan Terapi" value="<?= esc($antenatal['tindakanTerapi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Data Tindakan Terapi dibutuhkan
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

                <a href="<?= site_url('print-data-antenatal/' . esc($antenatal['antenatalID'])) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Antenatal
                </a>
                <a href="/edit-antenatals/<?= esc($antenatal['antenatalID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Antenatal
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($antenatal['antenatalID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Antenatal
                </a>
                <form id="deleteForm_<?= esc($antenatal['antenatalID']) ?>" action="<?= site_url('delete-antenatals') ?>" method="post">
                    <input type="hidden" name="antenatalID" value="<?= esc($antenatal['antenatalID']) ?>">
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