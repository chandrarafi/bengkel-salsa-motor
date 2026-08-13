<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="print-container">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Laporan Antenatal</h6>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Detail Data Antenatal <?= esc($antenatal['antenatalID']) ?> Rekam Medis <?= esc($ibu['ibuRM']) ?> (<?= esc($ibu['ibuNama']) ?>)</h5>
        </div>
        <div class="card-body">
            <form class="row gy-3 needs-validation">
                <div class="col-md-6">
                    <label class="form-label">Keluhan Sekarang</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="keluhanSekarang" class="form-control" placeholder="Masukan Keluhan" value="<?= esc($antenatal['keluhanSekarang']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tekanan Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="text" name="tekananDarah" class="form-control" placeholder="Masukan Tekanan Darah" value="<?= esc($antenatal['tekananDarah']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berat Badan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="beratBadan" class="form-control" placeholder="Masukan Berat Badan" value="<?= esc($antenatal['beratBadan']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Umur Kehamilan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="umurKehamilan" class="form-control" placeholder="Masukan Umur Kehamilan" value="<?= esc($antenatal['umurKehamilan']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tinggi Fundus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="tinggiFundus" class="form-control" placeholder="Masukan Tinggi Fundus" value="<?= esc($antenatal['tinggiFundus']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Letak Janin</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="letakJanin" class="form-control" placeholder="Masukan Letak Janin" value="<?= esc($antenatal['letakJanin']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Denyut Jantung</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:numbers-09-sort-ascending-line"></iconify-icon>
                        </span>
                        <input type="number" name="denyutJantung" class="form-control" placeholder="Masukan Denyut Jantung" value="<?= esc($antenatal['denyutJantung']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lab</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="lab" class="form-control" placeholder="Masukan Data Lab" value="<?= esc($antenatal['lab']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pemeliharaan Khusus</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="pemeliharaanKhusus" class="form-control" placeholder="Masukan Data Pemeliharaan Khusus" value="<?= esc($antenatal['pemeliharaanKhusus']) ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 mb-10">
                    <label class="form-label">Tindakan Terapi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mingcute:text-fill"></iconify-icon>
                        </span>
                        <input type="text" name="tindakanTerapi" class="form-control" placeholder="Masukan Data Tindakan Terapi" value="<?= esc($antenatal['tindakanTerapi']) ?>" readonly>
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