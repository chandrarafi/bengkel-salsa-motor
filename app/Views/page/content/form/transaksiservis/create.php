<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    .table-cart th {
        background-color: #f8fafc !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 10px 14px !important;
        color: #334155 !important;
    }
    .table-cart td {
        font-size: 13px !important;
        padding: 8px 14px !important;
        vertical-align: middle !important;
    }
    /* Large & Responsive Modal Cari Barang, Pelanggan & Servis */
    #cariBarangModal .modal-dialog,
    #cariPelangganModal .modal-dialog,
    #cariServisModal .modal-dialog {
        max-width: 1100px !important;
        width: 92% !important;
        margin: 1.75rem auto !important;
    }
    #cariBarangModal .dataTables_filter input,
    #cariPelangganModal .dataTables_filter input,
    #cariServisModal .dataTables_filter input {
        height: 38px !important;
        border-radius: 8px !important;
        border: 1px solid #d1d5db !important;
        padding: 6px 12px !important;
        font-size: 13px !important;
        outline: none !important;
        box-shadow: none !important;
        min-width: 220px !important;
    }
    #cariBarangModal .dataTables_length select,
    #cariPelangganModal .dataTables_length select,
    #cariServisModal .dataTables_length select {
        height: 38px !important;
        border-radius: 8px !important;
        border: 1px solid #d1d5db !important;
        padding: 4px 12px !important;
        font-size: 13px !important;
    }
    #tableCariBarang, #tableCariPelanggan, #tableCariServis {
        width: 100% !important;
    }

    /* Custom Segmented Tab Control Switcher */
    .custom-tab-btn {
        background-color: transparent !important;
        color: #475569 !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 6px 14px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-check:checked + .custom-tab-btn {
        background-color: #2563eb !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25) !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= site_url('admin/transaksiservis') ?>" class="w-36-px h-36-px bg-neutral-100 text-neutral-700 rounded-circle d-flex align-items-center justify-content-center hover-bg-neutral-200" title="Kembali">
            <iconify-icon icon="mingcute:left-line" class="text-lg"></iconify-icon>
        </a>
        <h6 class="fw-semibold mb-0 text-lg">Transaksi Servis Baru (Work Order)</h6>
    </div>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium">
            <a href="<?= site_url('admin/transaksiservis') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                Transaksi Servis
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Tambah Baru</li>
    </ul>
</div>

<form id="storeServisForm" action="<?= site_url('admin/transaksiservis/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="row g-4 mb-24">
        <!-- Informasi Transaksi & Kendaraan Card -->
        <div class="col-lg-6">
            <div class="card radius-12 border h-100">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14">
                    <h6 class="card-title mb-0 text-base fw-bold">Informasi Transaksi & Kendaraan</h6>
                </div>
                <div class="card-body p-20">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">No. Faktur Servis <span class="text-danger-600">*</span></label>
                            <input type="text" name="faktur" id="faktur" class="form-control form-control-sm radius-8 fw-bold text-primary-600 bg-neutral-50" value="<?= esc($autoFaktur) ?>" readonly required>
                            <div class="invalid-feedback" id="faktur_feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Tanggal Transaksi <span class="text-danger-600">*</span></label>
                            <input type="date" name="tglfaktur" id="tglfaktur" class="form-control form-control-sm radius-8" value="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback" id="tglfaktur_feedback"></div>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Pelanggan / Pemilik</label>
                            <div class="input-group input-group-sm">
                                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control radius-start-8" placeholder="Nama Pelanggan Umum" value="Pelanggan Umum">
                                <button type="button" class="btn btn-primary-600 px-12 radius-end-8 text-xs d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#cariPelangganModal">
                                    <iconify-icon icon="solar:users-group-two-rounded-outline"></iconify-icon> Cari Pelanggan
                                </button>
                                <button type="button" class="btn btn-neutral-200 text-neutral-800 fw-bold px-12 text-xs" id="btnPelangganUmum" title="Set Pelanggan Umum">
                                    Umum
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Merk / Tipe Kendaraan <span class="text-danger-600">*</span></label>
                            <input type="text" name="merkkendaraan" id="merkkendaraan" class="form-control form-control-sm radius-8" placeholder="Contoh: Honda Vario 125" required>
                            <div class="invalid-feedback" id="merkkendaraan_feedback">Merk/tipe kendaraan wajib diisi.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nomor Polisi (Plat Motor) <span class="text-danger-600">*</span></label>
                            <input type="text" name="nopol" id="nopol" class="form-control form-control-sm radius-8 font-mono text-uppercase" placeholder="Contoh: B 1234 ABC" required>
                            <div class="invalid-feedback" id="nopol_feedback">Nomor polisi wajib diisi.</div>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Keluhan / Diagnosa Perbaikan</label>
                            <textarea name="alasan" id="alasan" rows="6" class="form-control form-control-sm radius-8" style="min-height: 150px;" placeholder="Contoh: Tarikan mesin berat, ganti oli & lampu depan mati"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Item Servis / Sparepart Card -->
        <div class="col-lg-6">
            <div class="card radius-12 border h-100">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h6 class="card-title mb-0 text-base fw-bold">Pilih Item Servis / Sparepart</h6>
                    <div class="btn-group p-1 bg-neutral-100 radius-8" role="group">
                        <input type="radio" class="btn-check" name="itemTypeToggle" id="toggleServis" value="servis" checked>
                        <label class="custom-tab-btn d-inline-flex align-items-center gap-1.5" for="toggleServis">
                            <iconify-icon icon="solar:settings-bold-duotone" class="text-sm"></iconify-icon> Jasa Servis
                        </label>

                        <input type="radio" class="btn-check" name="itemTypeToggle" id="toggleBarang" value="barang">
                        <label class="custom-tab-btn d-inline-flex align-items-center gap-1.5" for="toggleBarang">
                            <iconify-icon icon="solar:box-bold-duotone" class="text-sm"></iconify-icon> Sparepart
                        </label>
                    </div>
                </div>
                <div class="card-body p-20">
                    <!-- Form Input Jasa Servis -->
                    <div id="formSectionServis">
                        <div class="mb-16">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Pilih Jenis Jasa Servis <span class="text-danger-600">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="hidden" id="input_detserviskode">
                                <input type="text" id="input_jenis_servis_display" class="form-control radius-start-8 bg-neutral-50 fw-medium" placeholder="Klik tombol Cari Jasa Servis..." readonly>
                                <button type="button" class="btn btn-primary-600 px-14 radius-end-8 text-xs fw-semibold d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#cariServisModal">
                                    <iconify-icon icon="solar:magnifer-linear"></iconify-icon> Cari Jasa Servis
                                </button>
                            </div>
                        </div>
                        <div class="mb-20">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Biaya Jasa Servis (Rp)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-neutral-100 fw-bold text-neutral-600">Rp</span>
                                <input type="number" id="input_detbiaya" class="form-control radius-end-8 fw-semibold text-neutral-900" placeholder="0" min="0">
                            </div>
                        </div>
                        <button type="button" id="btnAddServisTemp" class="btn btn-primary-600 radius-8 px-16 py-10 text-xs w-100 d-flex align-items-center justify-content-center gap-2 fw-semibold">
                            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah Jasa Servis ke Daftar
                        </button>
                    </div>

                    <!-- Form Input Sparepart / Barang -->
                    <div id="formSectionBarang" style="display: none;">
                        <div class="mb-16">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Pilih Barang / Sparepart <span class="text-danger-600">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="hidden" id="input_detailbrgkode">
                                <input type="text" id="input_nama_barang_display" class="form-control radius-start-8 bg-neutral-50 fw-medium" placeholder="Klik tombol Cari Sparepart..." readonly>
                                <button type="button" class="btn btn-primary-600 px-14 radius-end-8 text-xs fw-semibold d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#cariBarangModal">
                                    <iconify-icon icon="solar:magnifer-linear"></iconify-icon> Cari Sparepart
                                </button>
                            </div>
                            <span class="text-xxs text-primary-600 fw-semibold d-block mt-1" id="label_stok_info"></span>
                        </div>
                        <div class="row g-3 mb-20">
                            <div class="col-7">
                                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Harga Jual (Rp)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-neutral-100 fw-bold text-neutral-600">Rp</span>
                                    <input type="number" id="input_detailhargajual" class="form-control radius-end-8 fw-semibold text-neutral-900" placeholder="0" min="0">
                                </div>
                            </div>
                            <div class="col-5">
                                <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Jumlah (Qty)</label>
                                <input type="number" id="input_detjml" class="form-control form-control-sm radius-8 fw-semibold text-center text-neutral-900" value="1" min="1">
                            </div>
                        </div>
                        <button type="button" id="btnAddBarangTemp" class="btn btn-success-600 radius-8 px-16 py-10 text-xs w-100 d-flex align-items-center justify-content-center gap-2 fw-semibold">
                            <iconify-icon icon="solar:add-circle-bold" class="text-base"></iconify-icon> Tambah Sparepart ke Daftar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Rincian Transaksi Servis Card -->
    <div class="card radius-12 border mb-24">
        <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
            <h6 class="card-title mb-0 text-base fw-bold">Daftar Keranjang Item Servis & Sparepart</h6>
            <div class="d-flex align-items-center gap-2">
                <span class="text-xs text-secondary-light">Total Biaya Servis:</span>
                <span class="fw-bold text-success-main text-xl" id="displayTotalHarga">Rp 0</span>
            </div>
        </div>
        <div class="card-body p-20">
            <div class="table-responsive">
                <table class="table bordered-table align-middle text-sm mb-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center">#</th>
                            <th style="width: 110px;">Tipe</th>
                            <th style="width: 110px;">Kode</th>
                            <th>Nama Jasa / Sparepart</th>
                            <th class="text-end" style="width: 140px;">Biaya / Harga</th>
                            <th class="text-center" style="width: 100px;">Qty</th>
                            <th class="text-end" style="width: 140px;">Subtotal</th>
                            <th class="text-center" style="width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cartTableBody">
                        <tr>
                            <td colspan="8" class="text-center text-secondary-light py-4">Belum ada item jasa servis atau sparepart di keranjang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-flex align-items-center justify-content-end gap-2 mb-30">
        <a href="<?= site_url('admin/transaksiservis') ?>" class="border border-neutral-400 bg-neutral-100 text-neutral-700 text-sm px-20 py-10 radius-8 d-flex align-items-center gap-2 fw-medium">
            <iconify-icon icon="mingcute:close-line" class="text-base"></iconify-icon> Batal
        </a>
        <button type="submit" id="btnSubmitFinal" class="btn btn-primary-600 radius-8 px-24 py-10 text-sm d-flex align-items-center gap-2 fw-semibold">
            <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Transaksi Servis
        </button>
    </div>
</form>

<!-- Modal Cari Jasa Servis -->
<div class="modal fade" id="cariServisModal" tabindex="-1" aria-labelledby="cariServisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1100px !important; width: 92% !important;">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="cariServisModalLabel" style="font-size: 16px !important;">
                            Cari & Pilih Jasa Servis
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1">Pilih jenis jasa servis dari data master</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table align-middle text-sm mb-0" id="tableCariServis" style="width:100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th style="width: 130px;">Kode Servis</th>
                                <th>Jenis Jasa Servis</th>
                                <th class="text-end" style="width: 150px;">Biaya Jasa</th>
                                <th class="text-center" style="width: 90px;">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($servisList)): $noS = 1; foreach ($servisList as $s): 
                                $kodeS = esc($s['kodeservis']);
                                $namaS = esc($s['jenis_servis'] ?? $s['Jenis_servis']);
                                $biayaS = (float)($s['biaya'] ?? $s['Biaya'] ?? 0);
                            ?>
                                <tr>
                                    <td class="text-center text-xs text-secondary-light"><?= $noS++ ?></td>
                                    <td><span class="badge bg-neutral-200 text-secondary-light font-mono text-xs">#<?= $kodeS ?></span></td>
                                    <td><span class="fw-bold text-neutral-900 text-xs"><?= $namaS ?></span></td>
                                    <td class="text-end fw-semibold text-xs text-success-main">Rp <?= number_format($biayaS, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-primary-600 radius-4 px-12 py-4 btn-select-servis"
                                                data-kode="<?= $kodeS ?>"
                                                data-nama="<?= $namaS ?>"
                                                data-biaya="<?= $biayaS ?>">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cari Pelanggan -->
<div class="modal fade" id="cariPelangganModal" tabindex="-1" aria-labelledby="cariPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1100px !important; width: 92% !important;">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-primary-50 text-primary-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:users-group-two-rounded-outline"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="cariPelangganModalLabel" style="font-size: 16px !important;">
                            Cari & Pilih Data Pelanggan
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1">Pilih dari daftar pelanggan terdaftar di sistem</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table align-middle text-sm mb-0" id="tableCariPelanggan" style="width:100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Handphone</th>
                                <th class="text-center" style="width: 90px;">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pelangganList)): $noP = 1; foreach ($pelangganList as $p): ?>
                                <tr>
                                    <td class="text-center text-xs text-secondary-light"><?= $noP++ ?></td>
                                    <td><span class="fw-bold text-neutral-900 text-xs"><?= esc($p['nama']) ?></span></td>
                                    <td><span class="badge bg-neutral-200 text-neutral-700 text-xs"><?= esc($p['email'] ?? '-') ?></span></td>
                                    <td><span class="text-xs text-neutral-800"><?= esc($p['no_hp'] ?? $p['nohp'] ?? '-') ?></span></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-primary-600 radius-4 px-12 py-4 btn-select-pelanggan" data-nama="<?= esc($p['nama']) ?>">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cari Barang / Sparepart -->
<div class="modal fade" id="cariBarangModal" tabindex="-1" aria-labelledby="cariBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1100px !important; width: 92% !important;">
        <div class="modal-content radius-12 border-0 shadow-lg">
            <div class="modal-header border-bottom border-neutral-200 px-24 py-16 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3 text-start">
                    <div class="w-40-px h-40-px bg-success-50 text-success-600 rounded-circle d-flex align-items-center justify-content-center text-xl flex-shrink-0">
                        <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                    </div>
                    <div class="text-start">
                        <h6 class="modal-title fw-bold mb-0 text-start text-neutral-900" id="cariBarangModalLabel" style="font-size: 16px !important;">
                            Cari & Pilih Sparepart
                        </h6>
                        <span class="text-xs text-secondary-light d-block text-start mt-1">Pilih sparepart dari stok master barang</span>
                    </div>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table align-middle text-sm mb-0" id="tableCariBarang" style="width:100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th style="width: 100px;">Kode</th>
                                <th>Nama Barang / Sparepart</th>
                                <th>Kategori</th>
                                <th class="text-center">Stok</th>
                                <th class="text-end">Harga Jual</th>
                                <th class="text-center" style="width: 90px;">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($barangList)): $noB = 1; foreach ($barangList as $b): ?>
                                <tr>
                                    <td class="text-center text-xs text-secondary-light"><?= $noB++ ?></td>
                                    <td><span class="badge bg-neutral-200 text-secondary-light font-mono text-xs">#<?= esc($b['kode']) ?></span></td>
                                    <td><span class="fw-bold text-neutral-900 text-xs"><?= esc($b['nama_barng']) ?></span></td>
                                    <td><span class="text-xs text-neutral-700"><?= esc($b['namakategori'] ?? $b['nama_kategori'] ?? '-') ?></span></td>
                                    <td class="text-center">
                                        <span class="badge <?= ((int)$b['stok'] > 5) ? 'bg-success-focus text-success-main' : 'bg-danger-focus text-danger-main' ?> px-8 py-3 rounded-pill text-xs fw-bold">
                                            <?= esc($b['stok']) ?> <?= esc($b['nama_satuan'] ?? '') ?>
                                        </span>
                                    </td>
                                    <td class="text-end fw-semibold text-xs">Rp <?= number_format(($b['harga'] ?? $b['harga_jual'] ?? 0), 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-primary-600 radius-4 px-12 py-4 btn-select-barang"
                                                data-kode="<?= esc($b['kode']) ?>"
                                                data-nama="<?= esc($b['nama_barng']) ?>"
                                                data-hargajual="<?= (float)($b['harga'] ?? $b['harga_jual'] ?? 0) ?>"
                                                data-stok="<?= (int)$b['stok'] ?>"
                                                data-satuan="<?= esc($b['nama_satuan'] ?? '') ?>">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var currentGrandTotal = 0;

    $(document).ready(function() {
        var dtPelanggan = null, dtBarang = null, dtServis = null;
        if ($('#tableCariPelanggan').length) {
            dtPelanggan = $('#tableCariPelanggan').DataTable({
                autoWidth: false,
                language: { search: "Cari Pelanggan:", lengthMenu: "Tampilkan _MENU_ data", paginate: { next: "›", previous: "‹" } }
            });
        }
        if ($('#tableCariBarang').length) {
            dtBarang = $('#tableCariBarang').DataTable({
                autoWidth: false,
                language: { search: "Cari Barang:", lengthMenu: "Tampilkan _MENU_ data", paginate: { next: "›", previous: "‹" } }
            });
        }
        if ($('#tableCariServis').length) {
            dtServis = $('#tableCariServis').DataTable({
                autoWidth: false,
                language: { search: "Cari Jasa Servis:", lengthMenu: "Tampilkan _MENU_ data", paginate: { next: "›", previous: "‹" } }
            });
        }

        $('#cariPelangganModal').on('shown.bs.modal', function () {
            if (dtPelanggan) {
                dtPelanggan.columns.adjust().draw();
            }
        });

        $('#cariBarangModal').on('shown.bs.modal', function () {
            if (dtBarang) {
                dtBarang.columns.adjust().draw();
            }
        });

        $('#cariServisModal').on('shown.bs.modal', function () {
            if (dtServis) {
                dtServis.columns.adjust().draw();
            }
        });

        // Load Temp Cart on startup
        loadTempCart();

        // Item type toggle (Jasa vs Barang)
        $('input[name="itemTypeToggle"]').on('change', function() {
            if ($(this).val() === 'servis') {
                $('#formSectionServis').show();
                $('#formSectionBarang').hide();
            } else {
                $('#formSectionServis').hide();
                $('#formSectionBarang').show();
            }
        });

        // Jasa Servis Selection from Modal
        $(document).on('click', '.btn-select-servis', function() {
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var biaya = $(this).data('biaya');

            $('#input_detserviskode').val(kode);
            $('#input_jenis_servis_display').val(nama + ' (#' + kode + ')');
            $('#input_detbiaya').val(biaya);

            $('#cariServisModal').modal('hide');
        });

        // Pelanggan Selection
        $(document).on('click', '.btn-select-pelanggan', function() {
            var nama = $(this).data('nama');
            $('#nama_pelanggan').val(nama);
            $('#cariPelangganModal').modal('hide');
        });

        $('#btnPelangganUmum').on('click', function() {
            $('#nama_pelanggan').val('Pelanggan Umum');
        });

        // Barang Selection
        $(document).on('click', '.btn-select-barang', function() {
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var harga = $(this).data('hargajual');
            var stok = $(this).data('stok');
            var satuan = $(this).data('satuan');

            $('#input_detailbrgkode').val(kode);
            $('#input_nama_barang_display').val(nama + ' (#' + kode + ')');
            $('#input_detailhargajual').val(harga);
            $('#input_detjml').val(1);
            $('#label_stok_info').text('Stok tersedia: ' + stok + ' ' + satuan);

            $('#cariBarangModal').modal('hide');
        });

        // Add Jasa Servis to Temp Cart
        $('#btnAddServisTemp').on('click', function() {
            var kode = $('#input_detserviskode').val();
            var biaya = $('#input_detbiaya').val();

            if (!kode) {
                Swal.fire({ icon: 'warning', title: 'Pilih Jasa Servis', text: 'Silakan pilih jenis jasa servis terlebih dahulu.' });
                return;
            }

            var $btn = $(this);
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menambahkan...');

            $.ajax({
                url: '<?= site_url('admin/transaksiservis/addTemp') ?>',
                type: 'POST',
                data: { type: 'servis', detserviskode: kode, detbiaya: biaya },
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalHtml);
                    if (response.status) {
                        loadTempCart();
                        $('#input_detserviskode').val('');
                        $('#input_jenis_servis_display').val('');
                        $('#input_detbiaya').val('');
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalHtml);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menambahkan jasa servis.' });
                }
            });
        });

        // Add Sparepart to Temp Cart
        $('#btnAddBarangTemp').on('click', function() {
            var kode = $('#input_detailbrgkode').val();
            var harga = $('#input_detailhargajual').val();
            var jml = $('#input_detjml').val();

            if (!kode) {
                Swal.fire({ icon: 'warning', title: 'Pilih Sparepart', text: 'Silakan klik Cari Sparepart untuk memilih barang.' });
                return;
            }

            var $btn = $(this);
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menambahkan...');

            $.ajax({
                url: '<?= site_url('admin/transaksiservis/addTemp') ?>',
                type: 'POST',
                data: { type: 'barang', detailbrgkode: kode, detailhargajual: harga, detjml: jml },
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalHtml);
                    if (response.status) {
                        loadTempCart();
                        $('#input_detailbrgkode').val('');
                        $('#input_nama_barang_display').val('');
                        $('#input_detailhargajual').val('');
                        $('#input_detjml').val(1);
                        $('#label_stok_info').text('');
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalHtml);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menambahkan sparepart.' });
                }
            });
        });

        // Delete Temp Item
        $(document).on('click', '.btn-delete-temp', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?= site_url('admin/transaksiservis/deleteTemp') ?>',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    if (response.status) {
                        loadTempCart();
                    }
                }
            });
        });

        // Submit Form with Confirmation Dialog
        $('#storeServisForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Simpan Transaksi Servis?',
                text: 'Apakah data kendaraan, pelanggan, dan item servis yang diinput sudah sesuai?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Simpan Transaksi',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    processSaveServis(form);
                }
            });
        });

        function processSaveServis(form) {
            var formData = $(form).serialize();
            var $btn = $('#btnSubmitFinal');
            var originalBtnHtml = $btn.html();

            $('.form-control').removeClass('is-invalid');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan Transaksi...');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Transaksi Servis Disimpan!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = response.show_url || response.redirect_url;
                        });
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(field, msg) {
                                $('#' + field).addClass('is-invalid');
                                $('#' + field + '_feedback').addClass('d-block').text(msg);
                            });
                        }
                        Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menyimpan transaksi servis.' });
                }
            });
        }
    });

    function loadTempCart() {
        $.ajax({
            url: '<?= site_url('admin/transaksiservis/getTemp') ?>',
            type: 'GET',
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                if (response.status) {
                    currentGrandTotal = parseFloat(response.totalharga) || 0;
                    $('#displayTotalHarga').text(response.totalharga_formatted || 'Rp 0');

                    var html = '';
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(idx, item) {
                            var isServis = !!item.detserviskode;
                            var typeBadge = isServis ? '<span class="badge bg-info-50 text-info-600 border border-info-200 px-10 py-4 radius-6 text-xs fw-semibold">Jasa Servis</span>' : '<span class="badge bg-warning-50 text-warning-600 border border-warning-200 px-10 py-4 radius-6 text-xs fw-semibold">Sparepart</span>';
                            var kodeBadge = isServis ? ('#' + item.detserviskode) : ('#' + item.detailbrgkode);
                            var nameDesc = isServis ? item.jenis_servis : item.nama_barng;
                            var price = isServis ? parseFloat(item.detbiaya) : parseFloat(item.detailhargajual);
                            var qtyBadge = isServis ? '<span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-10 py-4 radius-6 text-xs fw-semibold">1 Servis</span>' : '<span class="badge bg-primary-50 text-primary-600 border border-primary-200 px-10 py-4 radius-6 text-xs fw-semibold">' + item.detjml + ' ' + (item.nama_satuan || 'Pcs') + '</span>';

                            html += '<tr>' +
                                '<td class="text-center text-xs text-secondary-light">' + (idx + 1) + '</td>' +
                                '<td>' + typeBadge + '</td>' +
                                '<td><span class="badge bg-neutral-200 text-secondary-light font-mono fw-bold text-xs">' + kodeBadge + '</span></td>' +
                                '<td><span class="fw-semibold text-neutral-800 text-xs">' + nameDesc + '</span></td>' +
                                '<td class="text-end text-xs">Rp ' + new Intl.NumberFormat('id-ID').format(price) + '</td>' +
                                '<td class="text-center">' + qtyBadge + '</td>' +
                                '<td class="text-end fw-bold text-xs text-success-main">Rp ' + new Intl.NumberFormat('id-ID').format(item.dettotaljual) + '</td>' +
                                '<td class="text-center">' +
                                    '<button type="button" class="w-26-px h-26-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0 btn-delete-temp" data-id="' + item.id + '" title="Hapus Item">' +
                                        '<iconify-icon icon="mingcute:delete-2-line" class="text-xs"></iconify-icon>' +
                                    '</button>' +
                                '</td>' +
                            '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="8" class="text-center text-secondary-light py-4">Belum ada item jasa servis atau sparepart di keranjang.</td></tr>';
                    }
                    $('#cartTableBody').html(html);
                }
            }
        });
    }
</script>
<?= $this->endSection() ?>
