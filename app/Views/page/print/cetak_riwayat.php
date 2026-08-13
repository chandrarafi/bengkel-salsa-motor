<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="print-container">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Laporan Riwayat</h6>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Detail Data Riwayat <?= esc($riwayat['riwayatID']) ?> Rekam Medis <?= esc($ibu['ibuRM']) ?> (<?= esc($ibu['ibuNama']) ?>)</h5>
        </div>
        <div class="card-body">
            <form class="row gy-3 needs-validation">
                <div class="col-md-4">
                    <label class="form-label">Kehamilan Ke</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="kehamilan" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['kehamilan']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Gravida</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="gravida" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['gravida']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Partus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="partus" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['partus']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Abortus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="abortus" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['abortus']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lahir Mati</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="lahirMati" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['lahirMati']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal HPL</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalHPL" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['tanggalHPL']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal HPHT</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalHPHT" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['tanggalHPHT']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Taksiran Persalinan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="taksiranPersalinan" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['taksiranPersalinan']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Persalinan Sebelumnya</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:calendar-line"></iconify-icon>
                        </span>
                        <input type="date" name="persalinanSebelumnya" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['persalinanSebelumnya']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="bbSebelum" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['bbSebelum']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-10">
                    <label class="form-label">Tinggi Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="tb" class="form-control" placeholder="Masukan Data" value="<?= esc($riwayat['tb']) ?>" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    window.onload = function() {
        window.print();
    }
</script>
<?= $this->endSection() ?>