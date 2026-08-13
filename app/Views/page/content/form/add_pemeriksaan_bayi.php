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
            <a href="<?= site_url('bayis') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="ant-design:number-outlined" class="icon text-lg"></iconify-icon>
                <?= $bayi['bayiNoRM'] ?>
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('bayis') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:history-line" class="icon text-lg"></iconify-icon>
                Tambah Riwayat Bayi
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12 mb-10">
    <div id="table-tambah-bayi" class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Data Pemeriksaan Bayi <?= $bayi['bayiNoRM'] ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('add-pemeriksaan-bayi') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="bayiID" value="<?= $bayi['bayiID'] ?>">

                <div class="col-md-6">
                    <label class="form-label">ASI</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="asi" class="form-control" required>
                            <option value="">Pilih ASI</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <div class="invalid-feedback">
                            ASI dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">MP ASI</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="mpAsi" class="form-control" required>
                            <option value="">Pilih MP ASI</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <div class="invalid-feedback">
                            MP ASI dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">SDI/DTK</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="sdiDtk" class="form-control" required>
                            <option value="">Pilih SDI/DTK</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <div class="invalid-feedback">
                            SDI/DTK dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Berat Badan (kg)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="number" name="bbPemeriksaanBayi" class="form-control" placeholder="Masukkan Berat Badan" required>
                        <div class="invalid-feedback">
                            Berat Badan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tinggi Badan (cm)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="number" name="tbPemeriksaanBayi" class="form-control" placeholder="Masukkan Tinggi Badan" required>
                        <div class="invalid-feedback">
                            Tinggi Badan dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="status" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <option value="Sehat">Sehat</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Gizi Buruk">Gizi Buruk</option>
                        </select>
                        <div class="invalid-feedback">
                            Status dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Vitamin A</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="vitA" class="form-control" required>
                            <option value="">Pilih Vitamin A</option>
                            <option value="Diberikan">Diberikan</option>
                            <option value="Tidak Diberikan">Tidak Diberikan</option>
                        </select>
                        <div class="invalid-feedback">
                            Vitamin A dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Imunisasi Bayi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="text" name="imunisasiBayi" class="form-control" placeholder="Masukkan Imunisasi Bayi" required>
                        <div class="invalid-feedback">
                            Imunisasi Bayi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Keterangan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <textarea name="keteranganBayi" class="form-control" placeholder="Masukkan Keterangan Bayi" required></textarea>
                        <div class="invalid-feedback">
                            Keterangan Bayi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Umur Bayi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="text" name="umurBayi" class="form-control" placeholder="Masukkan Umur Bayi" required>
                        <div class="invalid-feedback">
                            Umur Bayi dibutuhkan
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <br>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('riwayat-bayis/' . $bayi['bayiID']) ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:back-fill" class="text-xl"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:save-2-fill" class="text-xl"></iconify-icon> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#table-bayi').hide();
    });

    function showDataBayi() {
        $('#table-bayi').slideDown();
    }

    function selectDataBayi(bayiID, bayiNama) {
        $('#bayiID').val(bayiID);
        $('#bayiNama').val(bayiNama);
        $('#table-bayi').slideUp();
    }

    let table = new DataTable('#dataTable');

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
</script>
<?= $this->endSection() ?>