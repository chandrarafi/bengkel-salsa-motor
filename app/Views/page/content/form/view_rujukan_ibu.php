<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Rujukan Ibu</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('rujukan-ibus') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Rujukan Ibu <?= esc($rujukanIbu['rujukanIbuID']) ?></h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-rujukan-ibu') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <input type="hidden" name="rujukanIbuID" value="<?= esc($rujukanIbu['rujukanIbuID']) ?>">
                    <input type="hidden" name="ibuID" value="<?= esc($rujukanIbu['ibuID']) ?>">

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Rujukan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mage:calendar"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalRujukan" class="form-control" value="<?= esc($rujukanIbu['tanggalRujukan']) ?>" required readonly>
                            <div class="invalid-feedback">
                                Tanggal Rujukan dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Pasien</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="bx:bxs-user"></iconify-icon>
                            </span>
                            <input type="text" name="ibu" class="form-control" placeholder="Masukan kepada" value="<?= esc($rujukanIbu['ibuNama']) ?>" required readonly>
                            <div class="invalid-feedback">
                                Kepada dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kepada</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="bx:bxs-user"></iconify-icon>
                            </span>
                            <input type="text" name="kepada" class="form-control" placeholder="Masukan kepada" value="<?= esc($rujukanIbu['kepada']) ?>" required readonly>
                            <div class="invalid-feedback">
                                Kepada dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Alamat</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="bx:bxs-map"></iconify-icon>
                            </span>
                            <textarea name="alamat" class="form-control" placeholder="Masukan Alamat" required readonly><?= esc($rujukanIbu['alamat']) ?></textarea>
                            <div class="invalid-feedback">
                                Alamat dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hasil Pemeriksaan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="fluent:text-line-spacing-1-25-filled"></iconify-icon>
                            </span>
                            <textarea name="hasilPemeriksaan" class="form-control" placeholder="Masukan Hasil Pemeriksaan" required readonly><?= esc($rujukanIbu['hasilPemeriksaan']) ?></textarea>
                            <div class="invalid-feedback">
                                Hasil Pemeriksaan dibutuhkan
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <a href="<?= site_url('print-data-rujukan-ibu/' . $rujukanIbu['rujukanIbuID']) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Rujukan Ibu
                </a>
                <a href="/edit-rujukan-ibu/<?= esc($rujukanIbu['rujukanIbuID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Rujukan Ibu
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($rujukanIbu['rujukanIbuID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Rujukan Ibu
                </a>
                <form id="deleteForm_<?= esc($rujukanIbu['rujukanIbuID']) ?>" action="<?= site_url('delete-rujukan-ibu') ?>" method="post">
                    <input type="hidden" name="rujukanIbuID" value="<?= esc($rujukanIbu['rujukanIbuID']) ?>">
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

    function confirmDelete(rujukanIbuID) {
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
                $('#deleteForm_' + rujukanIbuID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>