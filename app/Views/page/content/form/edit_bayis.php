<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Bayi</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('bayis') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>


<div class="col-lg-12 mb-10">
    <div id="table-bayi" class="card basic-data-table mb-20">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Pilih Ibu</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <label class="form-check-label">
                                    ID
                                </label>
                            </div>
                        </th>
                        <th scope="col">No RM</th>
                        <th scope="col">Nama Ibu</th>
                        <th scope="col">Nama Suami</th>
                        <th scope="col">No HP</th>
                        <th scope="col">No BPJS</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ibus as $ibu) : ?>
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <label class="form-check-label">
                                        <?= esc($ibu['ibuID']) ?>
                                    </label>
                                </div>
                            </td>
                            <td><?= esc($ibu['ibuRM']) ?></td>
                            <td><?= esc($ibu['ibuNama']) ?></td>
                            <td><?= esc($ibu['ibuSuami']) ?></td>
                            <td><?= esc($ibu['ibuNoHP']) ?></td>
                            <td><?= esc($ibu['ibuNoBPJS']) ?></td>
                            <td>
                                <button onclick="selectDataIbu('<?= esc($ibu['ibuID']) ?>','<?= esc($ibu['ibuNama']) ?>')" type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-14 py-6 text-sm">Pilih</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div id="tambah-table-bayi" class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data Bayi <?= esc($bayi['bayiNoRM']) ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-bayis') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="bayiID" value="<?= esc($bayi['bayiID']) ?>">
                <div class="col-md-6">
                    <label class="form-label">Nama Bayi</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="bayiNama" class="form-control" placeholder="Masukan Nama Bayi" value="<?= esc($bayi['bayiNama']) ?>" required>
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
                        <input type="date" name="tanggalLahir" class="form-control" placeholder="Masukan Tanggal Lahir" value="<?= esc($bayi['tanggalLahir']) ?>" required>
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
                        <input type="time" name="jamLahir" class="form-control" placeholder="Masukan Jam Lahir" value="<?= esc($bayi['jamLahir']) ?>" required>
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
                        <select class="form-control radius-8 form-select" name="jenisKelamin" required>
                            <option value="Laki-laki" <?= esc($bayi['jenisKelamin']) == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= esc($bayi['jenisKelamin']) == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
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
                        <input type="number" name="beratLahir" class="form-control" placeholder="Masukan Berat Lahir" value="<?= esc($bayi['beratLahir']) ?>" required>
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
                        <input type="number" name="tinggiLahir" class="form-control" placeholder="Masukan Tinggi Lahir" value="<?= esc($bayi['tinggiLahir']) ?>" required>
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
                        <input type="number" name="anakKe" class="form-control" placeholder="Masukan Anak Ke" value="<?= esc($bayi['anakKe']) ?>" required>
                        <div class="invalid-feedback">
                            Anak Ke dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Ibu</label>
                    <div class="has-validation">
                        <input type="hidden" id="ibuID" name="ibuID" value="<?= esc($bayi['ibuID']) ?>">
                        <div class="input-group">
                            <input type="text" id="ibuNama" name="ibuNama" value="<?= esc($bayi['ibuNama']) ?>" class="form-control" placeholder="Pilih Data Ibu" readonly>
                            <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                        </div>
                        <div class="invalid-feedback">
                            Data Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('bayis') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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

    function showDataIbu() {
        $('#tambah-table-bayi').hide();
        $('#table-bayi').show();
    }

    function selectDataIbu(ibuID, ibuNama) {
        $('#ibuID').val(ibuID);
        $('#ibuNama').val(ibuNama);
        $('#table-bayi').hide();
        $('#tambah-table-bayi').show();

    }

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