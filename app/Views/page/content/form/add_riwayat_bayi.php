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
            <h5 class="card-title mb-0">Tambah Data Riwayat Bayi <?= $bayi['bayiNoRM'] ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('add-riwayat-bayi') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="col--md-6">
                    <input type="hidden" name="bayiID" value="<?= $bayi['bayiID'] ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Berat Badan (kg)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="number" name="bbBayi" class="form-control" placeholder="Masukkan Berat Badan" required>
                        <div class="invalid-feedback">
                            Berat Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Panjang Badan (cm)</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="number" name="panjangBayi" class="form-control" placeholder="Masukkan Panjang Badan" required>
                        <div class="invalid-feedback">
                            Panjang Badan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Golongan Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="golonganDarah" class="form-control" required>
                            <option value="">Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                        <div class="invalid-feedback">
                            Golongan Darah dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Buku KIA/KMS</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="bukuKIAKMS" class="form-control" required>
                            <option value="">Pilih Buku KIA/KMS</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                        <div class="invalid-feedback">
                            Buku KIA/KMS dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Keadaan Lahir</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="keadaanLahir" class="form-control" required>
                            <option value="">Pilih Keadaan Lahir</option>
                            <option value="Sehat">Sehat</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                        <div class="invalid-feedback">
                            Keadaan Lahir dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Komplikasi Lahir</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <textarea name="komplikasiLahir" class="form-control" placeholder="Masukkan Komplikasi Lahir" required></textarea>
                        <div class="invalid-feedback">
                            Komplikasi Lahir dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Resusitasi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <select name="resusitasi" class="form-control" required>
                            <option value="">Pilih Resusitasi</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <div class="invalid-feedback">
                            Resusitasi dibutuhkan
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