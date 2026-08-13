<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Bayi</h6>
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
            <a href="<?= site_url('bayis') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $bayi['bayiNoRM'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Rekam Medis <?= esc($bayi['bayiNoRM']) ?></h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-bayis') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <input type="hidden" name="bayiID" value="<?= esc($bayi['bayiID']) ?>">
                    <div class="col-md-6">
                        <label class="form-label">No Rekam Medis</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mdi:medical-bag"></iconify-icon>
                            </span>
                            <input type="text" name="bayiNoRM" class="form-control" placeholder="Masukan No Rekam Medis" value="<?= esc($bayi['bayiNoRM']) ?>" readonly required>
                            <div class="invalid-feedback">
                                No Rekam Medis dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Bayi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="f7:person"></iconify-icon>
                            </span>
                            <input type="text" name="bayiNama" class="form-control" placeholder="Masukan Nama Bayi" value="<?= esc($bayi['bayiNama']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Nama Bayi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mage:calendar"></iconify-icon>
                            </span>
                            <input type="date" name="tanggalLahir" class="form-control" placeholder="Masukan Tanggal Lahir" value="<?= esc($bayi['tanggalLahir']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tanggal Lahir dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jam Lahir</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mdi:clock-time-four-outline"></iconify-icon>
                            </span>
                            <input type="time" name="jamLahir" class="form-control" placeholder="Masukan Jam Lahir" value="<?= esc($bayi['jamLahir']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Jam Lahir dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="f7:gender"></iconify-icon>
                            </span>
                            <input type="text" name="jenisKelamin" class="form-control" placeholder="Masukan Jenis Kelamin" value="<?= esc($bayi['jenisKelamin']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Jenis Kelamin dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Berat Lahir (gram)</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mdi:weight"></iconify-icon>
                            </span>
                            <input type="number" name="beratLahir" class="form-control" placeholder="Masukan Berat Lahir" value="<?= esc($bayi['beratLahir']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Berat Lahir dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tinggi Lahir (cm)</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mdi:height"></iconify-icon>
                            </span>
                            <input type="number" name="tinggiLahir" class="form-control" placeholder="Masukan Tinggi Lahir" value="<?= esc($bayi['tinggiLahir']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tinggi Lahir dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Anak Ke</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mdi:numeric"></iconify-icon>
                            </span>
                            <input type="number" name="anakKe" class="form-control" placeholder="Masukan Anak Ke" value="<?= esc($bayi['anakKe']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Anak Ke dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Ibu</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mdi:identifier"></iconify-icon>
                            </span>
                            <input type="text" name="ibuNama" class="form-control" placeholder="Masukan ID Ibu" value="<?= esc($bayi['ibuNama']) ?>" readonly required>
                            <div class="invalid-feedback">
                                ID Ibu dibutuhkan
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
                <a href="<?= site_url('riwayat-bayis/' . $bayi['bayiID']) ?>" class="btn btn-success-100 text-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:file-plus-fill" class="text-xl"></iconify-icon> Riwayat Bayi
                </a>
                <a href="<?= site_url('pemeriksaan-bayis/' . $bayi['bayiID']) ?>" class="btn btn-success-100 text-success-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-40">
                    <iconify-icon icon="mage:dashboard-chart-fill" class="text-xl"></iconify-icon> Pemeriksaan
                </a>
                <a href="<?= site_url('print-card-bayi/' . $bayi['bayiID']) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:id-card-fill" class="text-xl"></iconify-icon> Cetak Kartu Bayi
                </a>
                <a href="<?= site_url('print-data-bayi/' . $bayi['bayiID']) ?>" class="btn btn-info-100 text-info-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Bayi
                </a>
                <a href="/edit-bayis/<?= esc($bayi['bayiID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Bayi
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($bayi['bayiID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Bayi
                </a>
                <form id="deleteForm_<?= esc($bayi['bayiID']) ?>" action="<?= site_url('delete-bayis') ?>" method="post">
                    <input type="hidden" name="bayiID" value="<?= esc($bayi['bayiID']) ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    let table = new DataTable('#dataTable');

    function confirmDelete(bayiID) {
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
                $('#deleteForm_' + bayiID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>