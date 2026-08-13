<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Rujukan Bayi</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('rujukan-bayi') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
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
                <h5 class="card-title mb-0">Detail Data Rujukan Bayi <?= esc($rujukanBayi['rujukanBayiID']) ?></h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-rujukan-bayi') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <input type="hidden" name="rujukanBayiID" value="<?= esc($rujukanBayi['rujukanBayiID']) ?>">
                    <input type="hidden" name="bayiID" value="<?= esc($rujukanBayi['bayiID']) ?>">

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Rujukan</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mage:calendar"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalRujukan" class="form-control" value="<?= esc($rujukanBayi['tanggalRujukan']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tanggal Rujukan dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Bayi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="bx:bxs-user"></iconify-icon>
                            </span>
                            <input type="text" name="bayi" class="form-control" placeholder="Masukan nama bayi" value="<?= esc($rujukanBayi['bayiNama']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Nama bayi dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kepada</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="bx:bxs-user"></iconify-icon>
                            </span>
                            <input type="text" name="kepada" class="form-control" placeholder="Masukan kepada" value="<?= esc($rujukanBayi['kepada']) ?>" readonly required>
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
                            <textarea name="alamat" class="form-control" placeholder="Masukan Alamat" readonly required><?= esc($rujukanBayi['alamat']) ?></textarea>
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
                            <textarea name="hasilPemeriksaan" class="form-control" placeholder="Masukan Hasil Pemeriksaan" readonly required><?= esc($rujukanBayi['hasilPemeriksaan']) ?></textarea>
                            <div class="invalid-feedback">
                                Hasil Pemeriksaan dibutuhkan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <br>
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
                <a href="<?= site_url('print-data-rujukan-bayi/' . $rujukanBayi['rujukanBayiID']) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Rujukan Bayi
                </a>
                <a href="/edit-rujukan-bayi/<?= esc($rujukanBayi['rujukanBayiID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Rujukan Bayi
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($rujukanBayi['rujukanBayiID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Rujukan Bayi
                </a>
                <form id="deleteForm_<?= esc($rujukanBayi['rujukanBayiID']) ?>" action="<?= site_url('delete-rujukan-bayi') ?>" method="post">
                    <input type="hidden" name="rujukanBayiID" value="<?= esc($rujukanBayi['rujukanBayiID']) ?>">
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

    function confirmDelete(rujukanBayiID) {
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
                $('#deleteForm_' + rujukanBayiID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>