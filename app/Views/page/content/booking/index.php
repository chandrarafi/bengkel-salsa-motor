<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>

<style>
    .basic-data-table .dataTables_wrapper .dataTables_length,
    .basic-data-table .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px !important;
        font-size: 13px !important;
    }
    .basic-data-table .dataTables_wrapper .dataTables_length label,
    .basic-data-table .dataTables_wrapper .dataTables_filter label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-size: 13px !important;
        color: #4b5563 !important;
        margin-bottom: 0 !important;
    }
    .basic-data-table .dataTables_wrapper .dataTables_length select {
        padding: 4px 28px 4px 10px !important;
        font-size: 13px !important;
        border-radius: 6px !important;
        height: 34px !important;
        display: inline-block !important;
        width: auto !important;
    }
    .basic-data-table .dataTables_wrapper .dataTables_filter input {
        padding: 4px 10px !important;
        font-size: 13px !important;
        border-radius: 6px !important;
        height: 34px !important;
        display: inline-block !important;
        width: auto !important;
        border: 1px solid #d1d5db !important;
    }
    .bordered-table th {
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 10px 12px !important;
        background-color: #f8fafc !important;
        color: #374151 !important;
        white-space: nowrap;
    }
    .bordered-table td {
        font-size: 13px !important;
        padding: 8px 12px !important;
        vertical-align: middle !important;
        color: #4b5563 !important;
    }
    .dataTables_info, .dataTables_paginate {
        margin-top: 16px !important;
        font-size: 13px !important;
    }
    #modalApprovalAdmin .modal-dialog {
        max-width: 1140px !important;
        width: 95% !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <div>
        <h6 class="fw-semibold mb-0 text-lg">Kelola Booking Servis Pelanggan</h6>
        <span class="text-xs text-secondary-light">Daftar reservasi jadwal servis online dan approval pembayaran DP</span>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= site_url('admin/booking/setting') ?>" class="btn btn-outline-primary-600 bg-white radius-8 px-14 py-8 text-xs fw-bold d-inline-flex align-items-center gap-2 border">
            <iconify-icon icon="solar:calendar-settings-bold-duotone" class="text-base"></iconify-icon>
            Pengaturan Booking & Kuota
        </a>
    </div>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-20 alert alert-success bg-success-100 text-success-600 border-success-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:check-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('success') ?>
        </div>
        <button class="remove-button text-success-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('error') ?>
        </div>
        <button class="remove-button text-danger-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')) : ?>
    <div class="mb-20 alert alert-warning bg-warning-100 text-warning-700 border-warning-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:alert-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('warning') ?>
        </div>
        <button class="remove-button text-warning-700 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<!-- Main Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Pengajuan Booking Servis</h6>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col" style="width: 140px;">Kode Booking</th>
                        <th scope="col">Pelanggan & Kontak</th>
                        <th scope="col">Kendaraan & Nopol</th>
                        <th scope="col">Jadwal Kedatangan</th>
                        <th scope="col">Status Bayar & Struk</th>
                        <th scope="col" class="text-center" style="width: 130px;">Status Booking</th>
                        <th scope="col" class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $list = $daftarBooking ?? [];
                    if (!empty($list)) :
                        $no = 1;
                        foreach ($list as $row) :
                            // Status Pembayaran
                            $stBayar = strtolower($row['status_pembayaran'] ?? 'menunggu_konfirmasi');
                            $badgeBayar = 'bg-warning-50 text-warning-700 border-warning-200';
                            $textBayar  = 'Menunggu Approval';

                            if ($stBayar === 'lunas') {
                                $badgeBayar = 'bg-success-50 text-success-700 border-success-200';
                                $textBayar  = 'LUNAS (Disetujui)';
                            } elseif ($stBayar === 'ditolak') {
                                $badgeBayar = 'bg-danger-50 text-danger-700 border-danger-200';
                                $textBayar  = 'Ditolak';
                            } elseif ($stBayar === 'menunggu_pembayaran') {
                                $badgeBayar = 'bg-neutral-100 text-secondary-light border-neutral-300';
                                $textBayar  = 'Belum Bayar';
                            }

                            // Status Booking
                            $stBooking = strtolower($row['status_booking'] ?? 'menunggu_konfirmasi');
                            $badgeBooking = 'bg-warning-50 text-warning-700';
                            $textBooking  = 'Menunggu Konfirmasi';

                            if ($stBooking === 'diterima') {
                                $badgeBooking = 'bg-primary-50 text-primary-700';
                                $textBooking  = 'Jadwal Diterima';
                            } elseif ($stBooking === 'diproses') {
                                $badgeBooking = 'bg-info-50 text-info-700';
                                $textBooking  = 'Sedang Diproses';
                            } elseif ($stBooking === 'selesai') {
                                $badgeBooking = 'bg-success-50 text-success-700';
                                $textBooking  = 'Servis Selesai';
                            } elseif ($stBooking === 'dibatalkan') {
                                $badgeBooking = 'bg-danger-50 text-danger-700';
                                $textBooking  = 'Dibatalkan / Kadaluarsa';
                            }

                            $hasBukti = !empty($row['bukti_pembayaran']) && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $row['bukti_pembayaran']);
                            $buktiUrl = $hasBukti ? base_url('uploads/bukti_pembayaran/' . $row['bukti_pembayaran']) : '';

                            // Format WhatsApp link
                            $phoneClean = preg_replace('/[^0-9]/', '', $row['no_hp']);
                            if (substr($phoneClean, 0, 1) === '0') {
                                $phoneClean = '62' . substr($phoneClean, 1);
                            }
                            $waLink = "https://wa.me/{$phoneClean}?text=" . urlencode("Halo {$row['nama_pelanggan']}, kami dari Bengkel Salsa Motor mengonfirmasi booking servis Anda dengan kode {$row['kode_booking']}.");
                    ?>
                            <tr>
                                <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>

                                <!-- Kode Booking -->
                                <td class="fw-bold text-dark">
                                    <span class="badge bg-primary-focus text-primary-600 fw-bold text-xs"><?= esc($row['kode_booking']) ?></span>
                                    <small class="text-xxs text-secondary-light d-block mt-1"><?= date('d/m/Y H:i', strtotime($row['created_at'] ?? 'now')) ?></small>
                                </td>

                                <!-- Pelanggan -->
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= esc($row['nama_pelanggan']) ?></span>
                                    <a href="<?= $waLink ?>" target="_blank" class="text-xxs text-success-main d-inline-flex align-items-center gap-1 fw-semibold hover-underline" title="Chat WhatsApp Pelanggan">
                                        <iconify-icon icon="logos:whatsapp-icon" class="text-xs"></iconify-icon>
                                        <?= esc($row['no_hp']) ?>
                                    </a>
                                </td>

                                <!-- Kendaraan -->
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= esc($row['merkkendaraan']) ?></span>
                                    <span class="badge bg-neutral-100 text-secondary-light text-xxs"><?= esc($row['nopol']) ?></span>
                                </td>

                                <!-- Jadwal Servis -->
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= date('d M Y', strtotime($row['tgl_booking'])) ?></span>
                                    <span class="text-xxs text-secondary-light fw-semibold">Pukul <?= date('H:i', strtotime($row['jam_booking'])) ?> WIB</span>
                                </td>

                                <!-- Bukti & Status Pembayaran -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <?php if ($hasBukti): ?>
                                            <a href="javascript:void(0)" class="btn-preview-bukti position-relative d-inline-block border radius-6 overflow-hidden" 
                                               style="width: 36px; height: 36px; min-width: 36px;"
                                               data-id="<?= $row['id_booking'] ?>"
                                               data-kode="<?= esc($row['kode_booking']) ?>"
                                               data-pelanggan="<?= esc($row['nama_pelanggan']) ?>"
                                               data-motor="<?= esc($row['merkkendaraan']) ?> (<?= esc($row['nopol']) ?>)"
                                               data-keluhan="<?= esc($row['keluhan'] ?? '') ?>"
                                               data-biaya="Rp <?= number_format($row['biaya'], 0, ',', '.') ?>"
                                               data-metode="<?= esc($row['metode_pembayaran']) ?>"
                                               data-bukti="<?= $buktiUrl ?>"
                                               data-status-bayar="<?= $stBayar ?>"
                                               data-catatan="<?= esc($row['catatan_admin'] ?? '') ?>"
                                               title="Klik untuk verifikasi bukti transfer">
                                                <img src="<?= $buktiUrl ?>" alt="Struk" class="w-100 h-100 object-fit-cover">
                                            </a>
                                        <?php endif; ?>
                                        <div>
                                            <span class="badge <?= $badgeBayar ?> border radius-4 px-6 py-2 text-xxs fw-bold d-inline-block">
                                                <?= $textBayar ?>
                                            </span>
                                            <small class="text-xxs text-secondary-light d-block"><?= esc($row['metode_pembayaran']) ?></small>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status Booking -->
                                <td class="text-center">
                                    <span class="badge <?= $badgeBooking ?> radius-4 px-8 py-4 text-xxs fw-bold d-inline-block">
                                        <?= $textBooking ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!-- Tombol Detail / Approval -->
                                        <button type="button" class="w-28-px h-28-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-info-main hover-text-white border-0 text-xs btn-preview-bukti"
                                                data-id="<?= $row['id_booking'] ?>"
                                                data-kode="<?= esc($row['kode_booking']) ?>"
                                                data-pelanggan="<?= esc($row['nama_pelanggan']) ?>"
                                                data-motor="<?= esc($row['merkkendaraan']) ?> (<?= esc($row['nopol']) ?>)"
                                                data-keluhan="<?= esc($row['keluhan'] ?? '') ?>"
                                                data-biaya="Rp <?= number_format($row['biaya'], 0, ',', '.') ?>"
                                                data-metode="<?= esc($row['metode_pembayaran']) ?>"
                                                data-bukti="<?= $buktiUrl ?>"
                                                data-status-bayar="<?= $stBayar ?>"
                                                data-catatan="<?= esc($row['catatan_admin'] ?? '') ?>"
                                                title="Detail & Verifikasi Pembayaran">
                                            <iconify-icon icon="solar:eye-bold-duotone"></iconify-icon>
                                        </button>

                                        <!-- Tombol Proses ke Work Order (Hijau) -->
                                        <a href="<?= site_url('admin/transaksiservis/proses-booking/' . $row['id_booking']) ?>" 
                                           class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white border-0 text-xs" 
                                           title="Proses ke Transaksi Servis (Work Order)">
                                            <iconify-icon icon="lucide:wrench"></iconify-icon>
                                        </a>

                                        <!-- Tombol Update Status Booking -->
                                        <button type="button" class="w-28-px h-28-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-warning-main hover-text-white border-0 text-xs btn-update-status"
                                                data-id="<?= $row['id_booking'] ?>"
                                                data-kode="<?= esc($row['kode_booking']) ?>"
                                                data-status="<?= $stBooking ?>"
                                                title="Ubah Status Booking">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <button type="button" onclick="confirmDeleteBooking('<?= $row['id_booking'] ?>', '<?= esc($row['kode_booking']) ?>')" 
                                                class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" 
                                                title="Hapus Data Booking">
                                            <iconify-icon icon="mingcute:close-circle-line"></iconify-icon>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL VERIFIKASI & APPROVAL BUKTI TRANSFER ADMIN -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalApprovalAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content radius-14 border-0 shadow-lg">
            <div class="modal-header border-bottom px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-dark mb-0">Verifikasi Bukti Pembayaran Booking</h6>
                    <span class="text-xxs text-secondary-light" id="adminModalKode">-</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-24 py-20">
                <div class="row g-4 align-items-start">
                    <!-- Left: Preview Struk -->
                    <div class="col-md-6 text-center">
                        <div class="p-8 bg-neutral-50 radius-10 border mb-2 min-h-200 d-flex align-items-center justify-content-center" id="buktiBoxContainer">
                            <img id="adminModalBuktiImg" src="" alt="Bukti Transfer" class="img-fluid rounded-8 shadow-sm" style="max-height: 380px; width: 100%; object-fit: contain;">
                            <div id="adminNoBuktiText" class="text-secondary-light text-xs p-20 d-none">
                                <iconify-icon icon="solar:camera-minimalistic-bold-duotone" class="text-4xl text-neutral-400 d-block mb-2 mx-auto"></iconify-icon>
                                Belum ada bukti transfer diunggah pelanggan.
                            </div>
                        </div>
                        <a href="#" id="adminModalBuktiLink" target="_blank" class="text-xxs text-primary-600 fw-bold d-inline-flex align-items-center gap-1 mt-1">
                            <iconify-icon icon="solar:maximize-square-bold"></iconify-icon> Buka Gambar Ukuran Penuh
                        </a>
                    </div>

                    <!-- Right: Booking Detail & Action Buttons -->
                    <div class="col-md-6">
                        <h6 class="text-xs fw-bold text-dark text-uppercase mb-12">Rincian Booking Servis</h6>
                        
                        <div class="p-16 radius-10 bg-neutral-50 border mb-16 text-xs">
                            <div class="mb-8">
                                <span class="text-xxs text-secondary-light d-block">Nama Pelanggan:</span>
                                <span class="fw-bold text-dark" id="adminModalPelanggan">-</span>
                            </div>
                            <div class="mb-8">
                                <span class="text-xxs text-secondary-light d-block">Kendaraan / Motor:</span>
                                <span class="fw-bold text-dark" id="adminModalMotor">-</span>
                            </div>
                            <div class="mb-8">
                                <span class="text-xxs text-secondary-light d-block">Catatan Keluhan Motor:</span>
                                <span class="fw-bold text-dark" id="adminModalKeluhan">-</span>
                            </div>
                            <div class="mb-8">
                                <span class="text-xxs text-secondary-light d-block">Metode Pembayaran:</span>
                                <span class="fw-bold text-dark" id="adminModalMetode">-</span>
                            </div>
                            <div class="pt-8 border-top d-flex justify-content-between align-items-center">
                                <span class="text-xs fw-bold text-dark">Biaya Booking (DP):</span>
                                <span class="text-sm fw-bold text-primary-600" id="adminModalBiaya">Rp 50.000</span>
                            </div>
                            <small class="text-xxs text-secondary-light d-block mt-1">*Otomatis memotong tagihan saat diproses ke Transaksi Servis (Work Order).</small>
                        </div>

                        <!-- Form Tolak Pembayaran (Input Catatan) -->
                        <div id="formTolakContainer" class="d-none mb-16 p-12 bg-danger-50 border border-danger-200 radius-8">
                            <label class="form-label text-xxs fw-bold text-danger-700 mb-1">Alasan Penolakan Pembayaran <span class="text-danger">*</span></label>
                            <textarea class="form-control radius-6 text-xs mb-2" id="inputCatatanTolak" rows="2" placeholder="Contoh: Bukti transfer buram / nominal tidak sesuai / salah rekening..."></textarea>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm radius-6 px-10 py-4 text-xxs" id="btnBatalTolak">Batal</button>
                                <button type="button" class="btn btn-danger btn-sm radius-6 px-12 py-4 text-xxs fw-bold" id="btnKonfirmasiTolak">Kirim Penolakan</button>
                            </div>
                        </div>

                        <!-- Action Approval Buttons -->
                        <div id="defaultActionButtons" class="d-flex flex-column gap-2">
                            <button type="button" class="btn btn-success radius-8 py-10 text-xs fw-bold d-flex align-items-center justify-content-center gap-2" id="btnApproveAction">
                                <iconify-icon icon="solar:check-circle-bold" class="text-base"></iconify-icon>
                                Approve Pembayaran (Lunas & Terima Jadwal)
                            </button>
                            <a href="#" id="btnProsesWO" class="btn btn-primary-600 radius-8 py-10 text-xs fw-bold d-flex align-items-center justify-content-center gap-2">
                                <iconify-icon icon="lucide:wrench" class="text-base"></iconify-icon>
                                Proses ke Transaksi Servis (Work Order)
                            </a>
                            <button type="button" class="btn btn-outline-danger radius-8 py-10 text-xs fw-bold d-flex align-items-center justify-content-center gap-2" id="btnTolakAction">
                                <iconify-icon icon="solar:close-circle-bold" class="text-base"></iconify-icon>
                                Tolak Bukti Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top px-24 py-12">
                <button type="button" class="btn btn-outline-neutral-700 text-xs radius-6 px-16 py-8" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL UBAH STATUS PENGERJAAN BOOKING -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalUpdateStatusBooking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content radius-14 border-0 shadow-lg">
            <form id="formUpdateStatusBooking" method="post">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom px-20 py-14">
                    <h6 class="modal-title fw-bold text-dark mb-0 text-sm">Ubah Status Booking</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-20 py-16">
                    <p class="text-xxs text-secondary-light mb-12" id="statusModalKodeText">-</p>
                    <label class="form-label text-xs fw-bold text-dark mb-1">Pilih Status Progres:</label>
                    <select name="status_booking" id="selectStatusBooking" class="form-select radius-8 text-xs" required>
                        <option value="menunggu_konfirmasi">Menunggu Konfirmasi</option>
                        <option value="diterima">Jadwal Diterima</option>
                        <option value="diproses">Sedang Dikerjakan (Mekanik)</option>
                        <option value="selesai">Servis Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <div class="modal-footer border-top px-20 py-10 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-neutral-700 text-xs radius-6 px-12 py-6" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-600 text-xs fw-bold radius-6 px-16 py-6">Simpan Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        if ($('#dataTable').length) {
            new DataTable('#dataTable', {
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Tidak ada data booking servis yang ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ booking",
                    infoEmpty: "Menampilkan 0 booking",
                    infoFiltered: "(disaring dari _MAX_ total booking)",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        }

        let currentBookingId = null;

        // Trigger Modal Verifikasi & Approval
        const previewButtons = document.querySelectorAll(".btn-preview-bukti");
        previewButtons.forEach(function(btn) {
            btn.addEventListener("click", function() {
                currentBookingId = this.getAttribute("data-id");
                const kode = this.getAttribute("data-kode");
                const pelanggan = this.getAttribute("data-pelanggan");
                const motor = this.getAttribute("data-motor");
                const keluhan = this.getAttribute("data-keluhan");
                const biaya = this.getAttribute("data-biaya");
                const metode = this.getAttribute("data-metode");
                const bukti = this.getAttribute("data-bukti");

                document.getElementById("adminModalKode").innerText = "Kode Booking: " + kode;
                document.getElementById("adminModalPelanggan").innerText = pelanggan;
                document.getElementById("adminModalMotor").innerText = motor;
                document.getElementById("adminModalKeluhan").innerText = keluhan ? keluhan : "Pengecekan Servis Berkala";
                document.getElementById("adminModalMetode").innerText = metode;
                document.getElementById("adminModalBiaya").innerText = biaya;
                document.getElementById("btnProsesWO").href = "<?= site_url('admin/transaksiservis/proses-booking/') ?>" + currentBookingId;

                const imgEl = document.getElementById("adminModalBuktiImg");
                const linkEl = document.getElementById("adminModalBuktiLink");
                const noBuktiText = document.getElementById("adminNoBuktiText");

                if (bukti && bukti !== '') {
                    imgEl.src = bukti;
                    imgEl.classList.remove('d-none');
                    linkEl.href = bukti;
                    linkEl.classList.remove('d-none');
                    noBuktiText.classList.add('d-none');
                } else {
                    imgEl.src = '';
                    imgEl.classList.add('d-none');
                    linkEl.classList.add('d-none');
                    noBuktiText.classList.remove('d-none');
                }

                // Reset tolak form
                document.getElementById("formTolakContainer").classList.add("d-none");
                document.getElementById("defaultActionButtons").classList.remove("d-none");
                document.getElementById("inputCatatanTolak").value = "";

                new bootstrap.Modal(document.getElementById("modalApprovalAdmin")).show();
            });
        });

        // Tombol Approve Pembayaran (Action)
        document.getElementById("btnApproveAction").addEventListener("click", function() {
            if (!currentBookingId) return;

            Swal.fire({
                title: 'Setujui Pembayaran DP?',
                text: 'Pembayaran akan disetujui sebagai LUNAS dan status jadwal booking berubah menjadi DITERIMA.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Approve Pembayaran',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(function(result) {
                if (result.isConfirmed) {
                    window.location.href = "<?= site_url('admin/booking/approve/') ?>" + currentBookingId;
                }
            });
        });

        // Buka Form Input Alasan Penolakan
        document.getElementById("btnTolakAction").addEventListener("click", function() {
            document.getElementById("formTolakContainer").classList.remove("d-none");
            document.getElementById("defaultActionButtons").classList.add("d-none");
            document.getElementById("inputCatatanTolak").focus();
        });

        document.getElementById("btnBatalTolak").addEventListener("click", function() {
            document.getElementById("formTolakContainer").classList.add("d-none");
            document.getElementById("defaultActionButtons").classList.remove("d-none");
        });

        // Kirim Penolakan Pembayaran via Form POST
        document.getElementById("btnKonfirmasiTolak").addEventListener("click", function() {
            const catatan = document.getElementById("inputCatatanTolak").value.trim();
            if (!catatan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Silakan masukkan alasan penolakan bukti pembayaran.'
                });
                return;
            }

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "<?= site_url('admin/booking/tolak/') ?>" + currentBookingId;

            const csrfInput = document.createElement("input");
            csrfInput.type = "hidden";
            csrfInput.name = "<?= csrf_token() ?>";
            csrfInput.value = "<?= csrf_hash() ?>";
            form.appendChild(csrfInput);

            const catInput = document.createElement("input");
            catInput.type = "hidden";
            catInput.name = "catatan_admin";
            catInput.value = catatan;
            form.appendChild(catInput);

            document.body.appendChild(form);
            form.submit();
        });

        // Trigger Modal Update Status Booking
        const updateButtons = document.querySelectorAll(".btn-update-status");
        updateButtons.forEach(function(btn) {
            btn.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const kode = this.getAttribute("data-kode");
                const status = this.getAttribute("data-status");

                document.getElementById("statusModalKodeText").innerText = "Kode Booking: " + kode;
                document.getElementById("selectStatusBooking").value = status;
                document.getElementById("formUpdateStatusBooking").action = "<?= site_url('admin/booking/update-status/') ?>" + id;

                new bootstrap.Modal(document.getElementById("modalUpdateStatusBooking")).show();
            });
        });
    });

    // Global SweetAlert function for delete booking
    function confirmDeleteBooking(id, kode) {
        Swal.fire({
            title: 'Hapus Data Booking?',
            text: 'Data booking "' + kode + '" akan dihapus permanen dari sistem.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('admin/booking/hapus/') ?>" + id;
            }
        });
    }
</script>
<?= $this->endSection() ?>
