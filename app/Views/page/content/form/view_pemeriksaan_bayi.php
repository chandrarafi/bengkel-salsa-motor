<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Pemeriksaan Bayi</h6>
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
            <a href="<?= site_url('pemeriksaan-bayis/' . $bayi['bayiID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:history-line" class="icon text-lg"></iconify-icon>
                Pemeriksaan Bayi
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $pemeriksaan_bayi['pemeriksaanBayiID'] ?>
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Pemeriksaan Bayi <?= esc($pemeriksaan_bayi['pemeriksaanBayiID']) ?> Rekam Medis <?= esc($bayi['bayiNoRM']) ?> (<?= esc($bayi['bayiNama']) ?>)</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-pemeriksaan-bayi') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <input type="hidden" name="pemeriksaanBayiID" value="<?= esc($pemeriksaan_bayi['pemeriksaanBayiID']) ?>">
                    <div class="col-md-6">
                        <label class="form-label">ASI</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:milk-line"></iconify-icon>
                            </span>
                            <input type="text" name="asi" class="form-control" value="<?= esc($pemeriksaan_bayi['asi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Status ASI dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">MP-ASI</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:milk-line"></iconify-icon>
                            </span>
                            <input type="text" name="mpAsi" class="form-control" value="<?= esc($pemeriksaan_bayi['mpAsi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Status MP-ASI dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SDIDTK</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:activity-heart-line"></iconify-icon>
                            </span>
                            <input type="text" name="sdiDtk" class="form-control" value="<?= esc($pemeriksaan_bayi['sdiDtk']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Status SDIDTK dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Berat Badan (kg)</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="number" name="bbPemeriksaanBayi" class="form-control" placeholder="Masukkan Berat Badan" value="<?= esc($pemeriksaan_bayi['bbPemeriksaanBayi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Berat Badan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tinggi Badan (cm)</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                            </span>
                            <input type="number" name="tbPemeriksaanBayi" class="form-control" placeholder="Masukkan Tinggi Badan" value="<?= esc($pemeriksaan_bayi['tbPemeriksaanBayi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Tinggi Badan dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:status-line"></iconify-icon>
                            </span>
                            <input type="text" name="status" class="form-control" value="<?= esc($pemeriksaan_bayi['status']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Status dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Vitamin A</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:vitamins-fill"></iconify-icon>
                            </span>
                            <input type="text" name="vitA" class="form-control" value="<?= esc($pemeriksaan_bayi['vitA']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Status Vitamin A dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Imunisasi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:syringe-line"></iconify-icon>
                            </span>
                            <input type="text" name="imunisasiBayi" class="form-control" placeholder="Masukkan Imunisasi" value="<?= esc($pemeriksaan_bayi['imunisasiBayi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Imunisasi dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keteranganBayi" class="form-control" placeholder="Masukkan Keterangan" readonly required><?= esc($pemeriksaan_bayi['keteranganBayi']) ?></textarea>
                        <div class="invalid-feedback">
                            Keterangan dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Umur Bayi</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                                <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                            </span>
                            <input type="text" name="umurBayi" class="form-control" placeholder="Masukkan Umur Bayi" value="<?= esc($pemeriksaan_bayi['umurBayi']) ?>" readonly required>
                            <div class="invalid-feedback">
                                Umur Bayi dibutuhkan
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
                <a href="<?= site_url('print-data-pemeriksaan-bayi/' . esc($pemeriksaan_bayi['pemeriksaanBayiID'])) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Pemeriksaan Bayi
                </a>
                <a href="/edit-pemeriksaan-bayi/<?= esc($pemeriksaan_bayi['pemeriksaanBayiID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Pemeriksaan Bayi
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($pemeriksaan_bayi['pemeriksaanBayiID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Pemeriksaan Bayi
                </a>
                <form id="deleteForm_<?= esc($pemeriksaan_bayi['pemeriksaanBayiID']) ?>" action="<?= site_url('delete-pemeriksaan-bayi') ?>" method="post" class="d-none">
                    <input type="hidden" name="pemeriksaanBayiID" value="<?= esc($pemeriksaan_bayi['pemeriksaanBayiID']) ?>">
                </form>
                <a href="<?= site_url('pemeriksaan-bayis/' . esc($pemeriksaan_bayi['bayiID'])) ?>" class="btn btn-neutral-100 text-primary-light radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
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