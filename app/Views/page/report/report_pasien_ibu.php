<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Laporan</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mingcute:print-line" class="icon text-lg"></iconify-icon>
                Laporan
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

<div id="all-data" class="row gy-4 justify-content-center">
    <div class="col-xxl-3 col-sm-3">
        <div class="card radius-12 h-100">
            <form action="<?= site_url('print-riwayat-ibu') ?>" method="post">
                <div class="card-header py-16 px-24 bg-base d-flex align-items-center gap-1 justify-content-between border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Riwayat Ibu</h6>
                    <button type="button" class="text-xl line-height-1">
                        <iconify-icon icon="mdi:times" class="text-xl"></iconify-icon>
                    </button>
                </div>
                <div class="card-body py-16 px-24">
                    <div class="col-md-12">
                        <label class="form-label">Nama Ibu</label>
                        <div class="has-validation">
                            <input type="hidden" class="ibuID" name="ibuID">
                            <div class="input-group">
                                <input type="text" name="ibuNama" class="form-control ibuNama" placeholder="Pilih Data Ibu" required>
                                <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-transparent border border-end-0 border-start-0 border-bottom-0 py-16 px-24">
                    <button type="submit" target="_blank" class="d-block w-100 d-inline-flex justify-content-center  btn btn-success-100 text-success-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16">
                        <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Riwayat
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card radius-12 h-100">
            <form action="<?= site_url('print-antenatal-ibu') ?>" method="post">
                <div class="card-header py-16 px-24 bg-base d-flex align-items-center gap-1 justify-content-between border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Antenatal Ibu</h6>
                    <button type="button" class="text-xl line-height-1">
                        <iconify-icon icon="mdi:times" class="text-xl"></iconify-icon>
                    </button>
                </div>
                <div class="card-body py-16 px-24">
                    <div class="col-md-12">
                        <label class="form-label">Nama Ibu</label>
                        <div class="has-validation">
                            <input type="hidden" class="ibuID" name="ibuID">
                            <div class="input-group">
                                <input type="text" name="ibuNama" class="form-control ibuNama" placeholder="Pilih Data Ibu" required>
                                <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-transparent border border-end-0 border-start-0 border-bottom-0 py-16 px-24">
                    <button type="submit" target="_blank" class="d-block w-100 d-inline-flex justify-content-center  btn btn-success-100 text-success-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16">
                        <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Antenatal
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card radius-12 h-100">
            <form action="<?= site_url('print-persalinan-ibu') ?>" method="post">
                <div class="card-header py-16 px-24 bg-base d-flex align-items-center gap-1 justify-content-between border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Persalinan Ibu</h6>
                    <button type="button" class="text-xl line-height-1">
                        <iconify-icon icon="mdi:times" class="text-xl"></iconify-icon>
                    </button>
                </div>
                <div class="card-body py-16 px-24">
                    <div class="col-md-12">
                        <label class="form-label">Nama Ibu</label>
                        <div class="has-validation">
                            <input type="hidden" class="ibuID" name="ibuID">
                            <div class="input-group">
                                <input type="text" name="ibuNama" class="form-control ibuNama" placeholder="Pilih Data Ibu" required>
                                <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-transparent border border-end-0 border-start-0 border-bottom-0 py-16 px-24">
                    <button type="submit" target="_blank" class="d-block w-100 d-inline-flex justify-content-center  btn btn-success-100 text-success-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16">
                        <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Persalinan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card radius-12 h-100">
            <form action="<?= site_url('print-pasca-persalinan-ibu') ?>" method="post">
                <div class="card-header py-16 px-24 bg-base d-flex align-items-center gap-1 justify-content-between border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Pasca persalinan</h6>
                    <button type="button" class="text-xl line-height-1">
                        <iconify-icon icon="mdi:times" class="text-xl"></iconify-icon>
                    </button>
                </div>
                <div class="card-body py-16 px-24">
                    <div class="col-md-12">
                        <label class="form-label">Nama Ibu</label>
                        <div class="has-validation">
                            <input type="hidden" class="ibuID" name="ibuID">
                            <div class="input-group">
                                <input type="text" name="ibuNama" class="form-control ibuNama" placeholder="Pilih Data Ibu" required>
                                <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-transparent border border-end-0 border-start-0 border-bottom-0 py-16 px-24">
                    <button type="submit" target="_blank" class="d-block w-100 d-inline-flex justify-content-center  btn btn-success-100 text-success-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16">
                        <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Pasca persalinan
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
        $('#all-data').hide();
        $('#table-bayi').show();
    }

    function selectDataIbu(ibuID, ibuNama) {
        $('.ibuID').val(ibuID);
        $('.ibuNama').val(ibuNama);
        $('#table-bayi').hide();
        $('#all-data').show();

    }
</script>
<?= $this->endSection('script') ?>