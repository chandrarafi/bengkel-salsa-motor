<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Pembayaran</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('pembayaran') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:document-add-outline" class="icon text-lg"></iconify-icon>
                Pelayanan Pembayaran
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
            <table class="table bordered-table mb-0" id="dataTable-ibu" data-page-length='10'>
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
                                <button onclick="selectDataIbu('<?= esc($ibu['ibuID']) ?>','<?= esc($ibu['ibuNama']) ?>','<?= esc($ibu['ibuRM']) ?>','<?= esc($ibu['ibuNoBPJS']) ?>')" type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-14 py-6 text-sm">Pilih</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="table-penggunaan-kamar" class="card basic-data-table mb-20">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Data Penggunaan Kamar</h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3 mt-20">
                        <a onclick="back()" class="btn border border-primary-600bg-hover-primary-200 text-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:arrow-left-line" class="text-xl"></iconify-icon> Kembali
                        </a>
                        <a href="<?= site_url('add-penggunaan-kamar') ?>" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:user-add-fill" class="text-xl"></iconify-icon> Data Baru
                        </a>
                    </div>
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
                        <th scope="col">No RM Ibu</th>
                        <th scope="col">Nama Ibu</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Tanggal Keluar</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="penggunaan-kamar-body">
                    <!-- Data will be appended here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <div id="table-penggunaan-obat" class="card basic-data-table">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Data Penggunaan Obat</h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3 mt-20">
                        <a onclick="back()" class="btn border border-primary-600bg-hover-primary-200 text-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:arrow-left-line" class="text-xl"></iconify-icon> Kembali
                        </a>
                        <a href="<?= site_url('add-penggunaan-obat') ?>" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:user-add-fill" class="text-xl"></iconify-icon> Data Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable-obat" data-page-length='10'>
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
                        <th scope="col">No RM Ibu</th>
                        <th scope="col">Nama Ibu</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="penggunaan-obat-body">
                    <!-- Data will be appended here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12 mb-10">
    <div id="tambah-card" class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Pembayaran</h5>
        </div>
        <div class="card-body">
            <form id="pembayaranForm" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-10">
                        <label class="form-label">Pilih Ibu</label>
                        <div class="has-validation">
                            <input type="hidden" id="ibuID" name="ibuID">
                            <div class="input-group">
                                <input type="text" id="ibuNama" name="ibuNama" class="form-control" placeholder="Pilih Data Ibu" readonly>
                                <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">No RM Ibu</label>
                        <input type="text" id="ibuRM" name="ibuRM" class="form-control" placeholder="Masukkan No RM Ibu" readonly required>
                        <div class="invalid-feedback">
                            No RM Ibu dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">No BPJS</label>
                        <input type="text" id="ibuNoBPJS" name="ibuNoBPJS" class="form-control" placeholder="BPJS" readonly required>
                        <div class="invalid-feedback">
                            No RM Ibu dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-6 mb-10">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="tanggalPembayaran" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Biaya Persalinan</label>
                        <input type="number" id="biayaPersalinan" name="biayaPersalinan" class="form-control" required oninput="updateTotal()">
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Biaya Lainnya</label>
                        <input type="number" id="biayaLainnya" name="biayaLainnya" class="form-control" required oninput="updateTotal()">
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Pilih Penggunaan Kamar</label>
                        <div class="has-validation">
                            <input type="hidden" id="penggunaanKamarID" name="penggunaanKamarID">
                            <div class="input-group">
                                <input type="text" id="kamarNama" name="kamarNama" class="form-control" placeholder="Pilih Data" readonly>
                                <button type="button" onclick="showDataPenggunaanKamar()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Penggunaan Kamar dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="text" id="tanggalMasuk" name="tanggalMasuk" class="form-control" placeholder="Tanggal" readonly required>
                        <div class="invalid-feedback">
                            Data Tanggal Dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Tanggal keluar</label>
                        <input type="text" id="tanggalKeluar" name="tanggalKeluar" class="form-control" placeholder="Tanggal" readonly required>
                        <div class="invalid-feedback">
                            Data Tanggal Dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-3 mb-10">
                        <label class="form-label">Biaya Kamar</label>
                        <input type="text" id="kamarBiaya" name="kamarBiaya" class="form-control" placeholder="Biaya" readonly required>
                        <div class="invalid-feedback">
                            Biaya Kamar Dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-4 mb-10">
                        <label class="form-label">Pilih Penggunaan Obat</label>
                        <div class="has-validation">
                            <input type="hidden" id="penggunaanObatID" name="penggunaanObatID">
                            <div class="input-group">
                                <input type="text" id="dataPenggunaanObatID" name="dataPenggunaanObatID" class="form-control" placeholder="Pilih Data" readonly>
                                <button type="button" onclick="showDataPenggunaanObat()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Penggunaan Obat dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-10">
                        <label class="form-label">Catatan</label>
                        <input type="text" id="catatan" name="catatan" class="form-control" placeholder="Catatan" readonly required>
                        <div class="invalid-feedback">
                            Catatan Dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-4 mb-10">
                        <label class="form-label">Biaya Obat</label>
                        <input type="text" id="biayaObat" name="biayaObat" class="form-control" placeholder="Biaya" readonly required oninput="updateTotal()">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-md-12 mb-10">
                        <label class="form-label">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
                        <div class="invalid-feedback">
                            Keterangan Dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-12 mt-10">
                        <label class="form-label">Detail Penggunaan Obat</label>
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table text-sm" id="detail-obat-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-sm">Nama Obat</th>
                                        <th scope="col" class="text-sm">Harga</th>
                                        <th scope="col" class="text-sm">Stok</th>
                                        <th scope="col" class="text-sm">Qty</th>
                                        <th scope="col" class="text-sm">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex flex-wrap justify-content-between gap-3 mt-24">
                            <div>
                            </div>
                            <div>
                                <table class="text-sm">
                                    <tbody>
                                        <tr>
                                            <td class="pe-64 pb-4">Biaya Persalinan:</td>
                                            <td class="pe-16 pb-4">
                                                <span id="biaya_persalinan" class="text-primary-light fw-semibold">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-64 pb-4">Biaya Kamar:</td>
                                            <td class="pe-16 pb-4">
                                                <span id="biaya_kamar" class="text-primary-light fw-semibold">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-64 border-bottom pb-4">Biaya Obat:</td>
                                            <td class="pe-16 border-bottom pb-4">
                                                <span id="biaya_obat" class="text-primary-light fw-semibold">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-64 border-bottom pb-4">Biaya Lainnya:</td>
                                            <td class="pe-16 border-bottom pb-4">
                                                <span id="biaya_lainnya" class="text-primary-light fw-semibold">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-64 pt-4">
                                                <span class="text-primary-light fw-semibold">Total Biaya:</span>
                                            </td>
                                            <td class="pe-16 pt-4">
                                                <span id="total_biaya" class="text-primary-light fw-semibold">0</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hiddenBiayaPersalinan" name="biayaPersalinan">
                    <input type="hidden" id="hiddenBiayaKamar" name="biayaKamar">
                    <input type="hidden" id="hiddenBiayaObat" name="biayaObat">
                    <input type="hidden" id="hiddenBiayaLainnya" name="biayaLainnya">
                    <input type="hidden" id="hiddenTotalBiaya" name="totalBiaya">
                    <div class="d-flex align-items-center gap-3 mt-20">
                        <a href="<?= site_url('pembayaran') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:back-fill" class="text-xl"></iconify-icon> Batal
                        </a>
                        <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                            <iconify-icon icon="mingcute:card-pay-line" class="text-xl"></iconify-icon> Buat Pembayaran
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    let tableIbu = new DataTable('#dataTable-ibu');
    let tableKamar = new DataTable('#dataTable-kamar');
    let tableObat = new DataTable('#dataTable-obat');

    $(document).ready(function() {
        $('#table-ibu').hide();
        $('#table-penggunaan-kamar').hide();
        $('#table-penggunaan-obat').hide();
    });

    function back() {
        $('#tambah-card').show();
        $('#table-ibu').hide();
        $('#table-penggunaan-kamar').hide();
        $('#table-penggunaan-obat').hide();

    }

    function showDataIbu() {
        $('#table-ibu').show();
        $('#tambah-card').hide();
    }

    function showDataPenggunaanKamar() {
        $('#table-penggunaan-kamar').show();
        $('#tambah-card').hide();
    }

    function showDataPenggunaanObat() {
        $('#table-penggunaan-obat').show();
        $('#tambah-card').hide();
    }

    function selectDataIbu(ibuID, ibuNama, ibuRM, ibuNoBPJS) {
        $('#ibuID').val(ibuID);
        $('#ibuNama').val(ibuNama);
        $('#ibuRM').val(ibuRM);
        $('#ibuNoBPJS').val(ibuNoBPJS);
        $('#table-ibu').hide();
        $('#tambah-card').show();
        updateTotal();
        fetchPenggunaanKamar(ibuID);
        fetchPenggunaanObat(ibuID);
    }

    function fetchPenggunaanKamar(ibuID) {
        $.ajax({
            url: '<?= site_url('fetch-penggunaan-kamar') ?>',
            type: 'GET',
            data: {
                ibuID: ibuID
            },
            success: function(data) {
                let tbody = $('#penggunaan-kamar-body');
                tbody.empty();
                data.forEach(function(item) {
                    let row = `
            <tr>
                <td>
                    <div class="form-check style-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            ${item.penggunaanKamarID}
                        </label>
                    </div>
                </td>
                <td>${item.kamarNama} (${item.kamarTipe})</td>
                <td>${item.ibuRM}</td>
                <td>${item.ibuNama}</td>
                <td>${item.tanggalMasuk}</td>
                <td>${item.tanggalKeluar}</td>
                <td>
                    <a class="w-32-px h-32-px bg-warning-focus text-warning rounded-circle d-inline-flex align-items-center justify-content-center" onclick="selectDataPenggunaanKamar('${item.penggunaanKamarID}','${item.kamarNama} (${item.kamarTipe})','${item.tanggalMasuk}','${item.tanggalKeluar}', '${item.kamarBiaya}')" type="button">
                        <iconify-icon icon="mingcute:check-circle-line"></iconify-icon>
                    </a>
                    <a href="/view-penggunaan-kamar/${item.penggunaanKamarID}" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:eye"></iconify-icon>
                    </a>
                    <a href="/edit-penggunaan-kamar/${item.penggunaanKamarID}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </a>
                    <a type="button" onclick="confirmDelete('${item.penggunaanKamarID}')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </a>
                    <form id="deleteForm_${item.penggunaanKamarID}" action="delete-penggunaan-kamar" method="post">
                        <input type="hidden" name="penggunaanKamarID" value="${item.penggunaanKamarID}">
                    </form>
                </td>
            </tr>
            `;
                    tbody.append(row);
                });
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function fetchPenggunaanObat(ibuID) {
        $.ajax({
            url: '<?= site_url('fetch-penggunaan-obat') ?>',
            type: 'GET',
            data: {
                ibuID: ibuID
            },
            success: function(data) {
                let tbody = $('#penggunaan-obat-body');
                tbody.empty();
                data.forEach(function(item) {
                    let row = `
            <tr>
                <td>
                    <div class="form-check style-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                            ${item.penggunaanObatID}
                        </label>
                    </div>
                </td>
                <td>${item.ibuRM}</td>
                <td>${item.ibuNama}</td>
                <td>${item.catatan}</td>
                <td>
                    <a class="w-32-px h-32-px bg-warning-focus text-warning rounded-circle d-inline-flex align-items-center justify-content-center" onclick="selectDataPenggunaanObat('${item.penggunaanObatID}','${item.catatan}')" type="button">
                        <iconify-icon icon="mingcute:check-circle-line"></iconify-icon>
                    </a>
                    <a href="/view-penggunaan-obat/${item.penggunaanObatID}" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:eye"></iconify-icon>
                    </a>
                    <a href="/edit-penggunaan-obat/${item.penggunaanObatID}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </a>
                    <a type="button" onclick="confirmDelete('${item.penggunaanObatID}')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </a>
                    <form id="deleteForm_${item.penggunaanObatID}" action="delete-penggunaan-obat" method="post">
                        <input type="hidden" name="penggunaanObatID" value="${item.penggunaanObatID}">
                    </form>
                </td>
            </tr>
            `;
                    tbody.append(row);
                });
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function selectDataPenggunaanKamar(penggunaanKamarID, kamarNama, tanggalMasuk, tanggalKeluar, kamarBiaya) {
        $('#penggunaanKamarID').val(penggunaanKamarID);
        $('#kamarNama').val(kamarNama);
        $('#tanggalMasuk').val(tanggalMasuk);
        $('#tanggalKeluar').val(tanggalKeluar);
        $('#table-penggunaan-kamar').hide();
        $('#tambah-card').show();

        var dateMasuk = new Date(tanggalMasuk);
        var dateKeluar = new Date(tanggalKeluar);
        var timeDifference = dateKeluar - dateMasuk;
        var dayDifference = timeDifference / (1000 * 3600 * 24);
        var totalBiaya = dayDifference * kamarBiaya;
        console.log('Total Biaya:', totalBiaya);
        $('#kamarBiaya').val(totalBiaya);
        updateTotal();
    }

    function selectDataPenggunaanObat(penggunaanObatID, catatan) {
        $('#penggunaanObatID').val(penggunaanObatID);
        $('#dataPenggunaanObatID').val(penggunaanObatID);
        $('#catatan').val(catatan);
        $('#table-penggunaan-obat').hide();
        $('#tambah-card').show();

        $.ajax({
            url: '/getDetailPenggunaanObat',
            type: 'GET',
            data: {
                penggunaanObatID: penggunaanObatID
            },
            success: function(data) {
                let tbody = $('#detail-obat-table tbody');
                tbody.empty();
                var biayaObat = 0;
                data.forEach(function(item) {
                    biayaObat += item.subtotal;
                    let row = `
            <tr>
                <td>${item.namaObat}</td>
                <td>${item.harga}</td>
                <td>${item.stok}</td>
                <td>${item.obatJumlah}</td>
                <td>${item.subtotal}</td>
            </tr>
            `;
                    tbody.append(row);
                });
                $('#biayaObat').val(biayaObat);
                updateTotal();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });

    }

    function updateTotal() {
        var biayaPersalinan = parseFloat($('#biayaPersalinan').val()) || 0;
        var biayaKamar = parseFloat($('#kamarBiaya').val()) || 0;
        var biayaObat = parseFloat($('#biayaObat').val()) || 0;
        var biayaLainnya = parseFloat($('#biayaLainnya').val()) || 0;
        var bpjs = $('#ibuNoBPJS').val();
        var totalBiaya = (bpjs === '-') ? biayaPersalinan + biayaKamar + biayaObat + biayaLainnya : '(Gratis) BPJS';

        $('#biaya_persalinan').text(biayaPersalinan);
        $('#biaya_kamar').text(biayaKamar);
        $('#biaya_obat').text(biayaObat);
        $('#biaya_lainnya').text(biayaLainnya);
        $('#total_biaya').text(totalBiaya);

        $('#hiddenBiayaPersalinan').val(biayaPersalinan);
        $('#hiddenBiayaKamar').val(biayaKamar);
        $('#hiddenBiayaObat').val(biayaObat);
        $('#hiddenBiayaLainnya').val(biayaLainnya);
        $('#hiddenTotalBiaya').val(totalBiaya);
    }

    $('#pembayaranForm').on('submit', function(event) {
        event.preventDefault();
        if (this.checkValidity() === false) {
            event.stopPropagation();
            $(this).addClass('was-validated');
            return;
        }

        updateTotal();

        let formData = $(this).serialize();

        $.ajax({
            url: '<?= site_url('save-pembayaran') ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Open the print URL in a new tab
                    window.open('<?= site_url('print-pembayaran/') ?>' + response.pembayaranID, '_blank');
                    // Redirect the current tab to the pembayaran URL
                    window.location.href = '<?= site_url('pembayaran') ?>';
                } else {
                    alert('Failed to save data. Please try again.');
                }
            },
            error: function(error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });


    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation');

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<?= $this->endSection() ?>