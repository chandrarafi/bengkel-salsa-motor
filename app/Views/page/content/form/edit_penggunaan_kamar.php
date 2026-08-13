<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Penggunaan Kamar</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('penggunaan-kamar') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>



<div class="col-lg-12 mb-10">
    <div id="table-ibu" class="card basic-data-table mb-20">
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
    <div id="table-kamar" class="card basic-data-table">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Data Kamar</h5>
                </div>
                <div class="col-auto">
                    <a href="<?= site_url('add-kamars') ?>" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:user-add-fill" class="text-xl"></iconify-icon> Data Baru
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable-kamar" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    ID
                                </label>
                            </div>
                        </th>
                        <th scope="col">Nama Kamar</th>
                        <th scope="col">Tipe Kamar</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kamars as $kamar) : ?>
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">
                                        <?= esc($kamar['kamarID']) ?>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= esc($kamar['kamarNama']) ?></h6>
                                </div>

                            </td>
                            <td><?= esc($kamar['kamarTipe']) ?></td>
                            <td><?= esc(number_format($kamar['kamarBiaya'], 0, ',', '.')) ?></td>
                            <td>
                                <button onclick="selectDataKamar('<?= esc($kamar['kamarID']) ?>','<?= esc($kamar['kamarNama']) ?>','<?= esc($kamar['kamarBiaya']) ?>')" type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-14 py-6 text-sm">Pilih</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data <?= esc($penggunaan_kamar['penggunaanKamarID']) ?></h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-penggunaan-kamar') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="penggunaanKamarID" value="<?= esc($penggunaan_kamar['penggunaanKamarID']) ?>">
                <div class="col-md-6">
                    <label class="form-label">Pilih Ibu</label>
                    <div class="has-validation">
                        <input type="hidden" id="ibuID" value="<?= esc($penggunaan_kamar['ibuID']) ?>" name=" ibuID">
                        <div class="input-group">
                            <input type="text" id="ibuNama" name="ibuNama" value="<?= esc($penggunaan_kamar['ibuNama']) ?>" class=" form-control" placeholder="Pilih Data Ibu" readonly>
                            <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                        </div>
                        <div class="invalid-feedback">
                            Data Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Pilih Kamar</label>
                    <div class="has-validation">
                        <input type="hidden" id="kamarID" value="<?= esc($penggunaan_kamar['kamarID']) ?>" name=" kamarID" required>
                        <div class="input-group">
                            <input type="text" id="kamarNama" value="<?= esc($penggunaan_kamar['kamarNama']) ?>" name=" kamarNama" class="form-control" placeholder="Pilih Data Kamar" readonly>
                            <button type="button" onclick="showDataKamar()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                        </div>
                        <div class="invalid-feedback">
                            Data Kamar dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Biaya Kamar /malam</label>
                    <input type="text" id="biayaKamar" name="biayaKamar" value="<?= esc($penggunaan_kamar['kamarBiaya']) ?>" class=" form-control" placeholder="Pilih Kamar" readonly required>
                    <div class="invalid-feedback">
                        Biaya kamar dibutuhkan
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Masuk</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="fa-solid:calendar-alt"></iconify-icon>
                        </span>
                        <input type="date" id="tanggalMasuk" name="tanggalMasuk" class="form-control" value="<?= esc($penggunaan_kamar['tanggalMasuk']) ?>" required>
                        <div class="invalid-feedback">
                            Tanggal Masuk dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Keluar</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="fa-solid:calendar-alt"></iconify-icon>
                        </span>
                        <input type="date" id="tanggalKeluar" name="tanggalKeluar" class="form-control" value="<?= esc($penggunaan_kamar['tanggalKeluar']) ?>" required>
                        <div class="invalid-feedback">
                            Tanggal Keluar dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Perkiraan Biaya</label>
                    <input type="text" id="perkiraanBiaya" name="perkiraanBiaya" class="form-control" placeholder="Perkiraan Biaya" readonly required>
                    <div class="invalid-feedback">
                        Perkiraan Biaya
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Catatan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="bi:card-text"></iconify-icon>
                        </span>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Masukan Catatan"><?= esc($penggunaan_kamar['catatan']) ?></textarea>
                        <div class="invalid-feedback">
                            Catatan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('penggunaan-kamar-ibus/' . esc($penggunaan_kamar['ibuID'])) ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="fa-solid:arrow-left"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="fa-solid:save"></iconify-icon> Simpan
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
        $('#table-ibu').hide();
        $('#table-kamar').hide();
        const biayaKamarElement = document.getElementById('biayaKamar');
        const tanggalMasukElement = document.getElementById('tanggalMasuk');
        const tanggalKeluarElement = document.getElementById('tanggalKeluar');
        const perkiraanBiayaElement = document.getElementById('perkiraanBiaya');

        const biayaKamar = parseFloat(biayaKamarElement.value);
        const tanggalMasuk = new Date(tanggalMasukElement.value);
        const tanggalKeluar = new Date(tanggalKeluarElement.value);

        // Function to calculate difference in days between two dates
        function dateDiffInDays(date1, date2) {
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays;
        }

        const totalMalam = dateDiffInDays(tanggalMasuk, tanggalKeluar) + 1;
        const perkiraanBiaya = totalMalam * biayaKamar;
        perkiraanBiayaElement.value = perkiraanBiaya.toLocaleString('id-ID'); // Format to Indonesian Rupiah or use toLocaleString for local currency formatting
    });

    function showDataIbu() {
        $('#tambah-table-ibu').slideUp();
        $('#table-ibu').slideDown();
    }

    function selectDataIbu(ibuID, ibuNama) {
        $('#ibuID').val(ibuID);
        $('#ibuNama').val(ibuNama);
        $('#table-ibu').slideUp();
        $('#tambah-table-ibu').slideDown();

    }

    function showDataKamar() {
        $('#tambah-table-kamar').slideUp();
        $('#table-kamar').slideDown();
    }

    function selectDataKamar(kamarID, kamarNama, kamarBiaya) {
        $('#kamarID').val(kamarID);
        $('#kamarNama').val(kamarNama);
        $('#biayaKamar').val(kamarBiaya);
        $('#table-kamar').slideUp();
        $('#tambah-table-kamar').slideDown();

    }

    let table = new DataTable('#dataTable');
    let table_kamar = new DataTable('#dataTable-kamar');

    (() => {
        'use strict'

        const biayaKamarElement = document.getElementById('biayaKamar');
        const tanggalMasukElement = document.getElementById('tanggalMasuk');
        const tanggalKeluarElement = document.getElementById('tanggalKeluar');
        const perkiraanBiayaElement = document.getElementById('perkiraanBiaya');

        // Function to calculate difference in days between two dates
        function dateDiffInDays(date1, date2) {
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays;
        }

        // Calculate perkiraan biaya when dates change
        function calculatePerkiraanBiaya() {
            const biayaKamar = parseFloat(biayaKamarElement.value);
            const tanggalMasuk = new Date(tanggalMasukElement.value);
            const tanggalKeluar = new Date(tanggalKeluarElement.value);

            if (!isNaN(biayaKamar) && tanggalMasuk && tanggalKeluar && tanggalKeluar > tanggalMasuk) {
                const totalMalam = dateDiffInDays(tanggalMasuk, tanggalKeluar) + 1;
                const perkiraanBiaya = totalMalam * biayaKamar;
                perkiraanBiayaElement.value = perkiraanBiaya.toLocaleString('id-ID'); // Format to Indonesian Rupiah or use toLocaleString for local currency formatting
            } else {
                perkiraanBiayaElement.value = ''; // Reset if invalid date or biaya kamar
            }
        }

        $('#tanggalMasuk').change(calculatePerkiraanBiaya);
        $('#tanggalKeluar').change(calculatePerkiraanBiaya);

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