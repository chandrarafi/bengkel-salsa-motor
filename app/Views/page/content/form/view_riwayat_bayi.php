<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Riwayat Bayi</h6>
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
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $riwayat_bayi['riwayatBayiID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Riwayat Bayi <?= esc($riwayat_bayi['riwayatBayiID']) ?> Rekam Medis <?= esc($bayi['bayiNoRM']) ?> (<?= esc($bayi['bayiNama']) ?>)</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-riwayat-bayi') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <input type="hidden" name="riwayatBayiID" value="<?= esc($riwayat_bayi['riwayatBayiID']) ?>">
                    <div class="col-md-6">
                        <label class="form-label">Berat Badan (kg)</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="number" name="bbBayi" class="form-control" placeholder="Masukkan Berat Badan" value="<?= esc($riwayat_bayi['bbBayi']) ?>" readonly required>
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
                            <input type="number" name="panjangBayi" class="form-control" placeholder="Masukkan Panjang Badan" value="<?= esc($riwayat_bayi['panjangBayi']) ?>" readonly required>
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
                            <input type="text" name="golonganDarah" class="form-control" placeholder="Masukkan Golongan Darah" value="<?= esc($riwayat_bayi['golonganDarah']) ?>" readonly required>
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
                            <input type="text" name="bukuKIAKMS" class="form-control" placeholder="Masukkan Buku KIA/KMS" value="<?= esc($riwayat_bayi['bukuKIAKMS']) ?>" readonly required>
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
                            <input type="text" name="keadaanLahir" class="form-control" placeholder="Masukkan Keadaan Lahir" value="<?= esc($riwayat_bayi['keadaanLahir']) ?>" readonly required>
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
                            <input type="text" name="komplikasiLahir" class="form-control" placeholder="Masukkan Komplikasi Lahir" value="<?= esc($riwayat_bayi['komplikasiLahir']) ?>" readonly required>
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
                            <input type="text" name="resusitasi" class="form-control" placeholder="Masukkan Resusitasi" value="<?= esc($riwayat_bayi['resusitasi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Resusitasi dibutuhkan
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
                <a href="<?= site_url('print-data-riwayat-bayi/' . esc($riwayat_bayi['riwayatBayiID'])) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Riwayat Bayi
                </a>
                <a href="/edit-riwayat-bayi/<?= esc($riwayat_bayi['riwayatBayiID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Riwayat Bayi
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($riwayat_bayi['riwayatBayiID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Riwayat Bayi
                </a>
                <form id="deleteForm_<?= esc($riwayat_bayi['riwayatBayiID']) ?>" action="<?= site_url('delete-riwayat-bayi') ?>" method="post" class="d-none">
                    <input type="hidden" name="riwayatBayiID" value="<?= esc($riwayat_bayi['riwayatBayiID']) ?>">
                </form>
                <a href="<?= site_url('riwayat-bayis/' . esc($riwayat_bayi['bayiID'])) ?>" class="btn btn-neutral-100 text-primary-light radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="ic:round-arrow-back" class="text-xl"></iconify-icon> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            document.getElementById('deleteForm_' + id).submit();
        }
    }
</script>

<?= $this->endSection() ?>