<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Rujukan Ibu</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('rujukan-ibus') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:document-add-outline" class="icon text-lg"></iconify-icon>
                Pelayanan Rujukan Ibu
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
</div>

<div class="col-lg-12 mb-10">
    <div id="table-tambah-ibu" class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Data Rujukan Ibu</h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('update-rujukan-ibu') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="col-md-6">
                    <label class="form-label">Pilih Ibu</label>
                    <div class="has-validation">
                        <input type="hidden" name="rujukanIbuID" value="<?= esc($rujukanIbu['rujukanIbuID']) ?>">
                        <input type="hidden" id="ibuID" name="ibuID" value="<?= esc($rujukanIbu['ibuID']) ?>">
                        <div class="input-group">
                            <input type="text" id="ibuNama" name="ibuNama" value="<?= esc($rujukanIbu['ibuNama']) ?>" class="form-control" placeholder="Pilih Data Ibu" readonly>
                            <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                        </div>
                        <div class="invalid-feedback">
                            Data Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Rujukan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="date" name="tanggalRujukan" class="form-control" placeholder="Masukkan Tanggal Rujukan" value="<?= esc($rujukanIbu['tanggalRujukan']) ?>" required>
                        <div class="invalid-feedback">
                            Tanggal Rujukan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kepada</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="text" name="kepada" value="<?= esc($rujukanIbu['kepada']) ?>" class="form-control" placeholder="Tujuan Rujukan" required>
                        <div class="invalid-feedback">
                            Kepada dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <textarea name="alamat" class="form-control" placeholder="Alamat Rujukan" required><?= esc($rujukanIbu['alamat']) ?></textarea>
                        <div class="invalid-feedback">
                            Alamat dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hasil Pemeriksaan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:document-add-outline"></iconify-icon>
                        </span>
                        <input type="text" name="hasilPemeriksaan" value="<?= esc($rujukanIbu['hasilPemeriksaan']) ?>" class="form-control" placeholder="Masukkan Hasil Pemeriksaan" required>
                        <div class="invalid-feedback">
                            Hasil Pemeriksaan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('rujukan-ibu') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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
        $('#table-ibu').hide();
    });

    function showDataIbu() {
        $('#table-ibu').slideDown();
    }

    function selectDataIbu(ibuID, ibuNama) {
        $('#ibuID').val(ibuID);
        $('#ibuNama').val(ibuNama);
        $('#table-ibu').slideUp();

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