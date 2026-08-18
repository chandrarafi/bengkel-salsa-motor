<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h6 class="fw-semibold mb-0">Kelola Booking Servis Pelanggan</h6>
        <p class="text-xs text-secondary-light mb-0">Verifikasi bukti transfer pembayaran, konfirmasi antrean, dan pantau progres pengerjaan servis motor.</p>
    </div>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium text-secondary-light">Booking Servis</li>
    </ul>
</div>

<!-- KPI Metric Cards -->
<div class="row g-3 mb-24">
    <!-- Stat 1 -->
    <div class="col-sm-6 col-lg-3">
        <div class="card shadow-none border radius-12 p-20 bg-white">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light text-uppercase fw-bold d-block mb-1">Total Booking</span>
                    <h4 class="fw-bold text-dark mb-0"><?= esc($totalSemua) ?></h4>
                    <span class="text-xxs text-secondary-light">Semua pengajuan</span>
                </div>
                <div class="w-44-px h-44-px rounded-10 d-flex align-items-center justify-content-center bg-primary-50 text-primary-600">
                    <iconify-icon icon="solar:calendar-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 2: Pending Approval -->
    <div class="col-sm-6 col-lg-3">
        <div class="card shadow-none border radius-12 p-20 bg-white">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light text-uppercase fw-bold d-block mb-1">Butuh Approval</span>
                    <h4 class="fw-bold text-warning-main mb-0"><?= esc($pendingApproval) ?></h4>
                    <span class="text-xxs text-warning-600 fw-semibold">Menunggu cek transfer</span>
                </div>
                <div class="w-44-px h-44-px rounded-10 d-flex align-items-center justify-content-center bg-warning-50 text-warning-600">
                    <iconify-icon icon="solar:bill-check-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 3: Total Lunas -->
    <div class="col-sm-6 col-lg-3">
        <div class="card shadow-none border radius-12 p-20 bg-white">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light text-uppercase fw-bold d-block mb-1">Pembayaran Lunas</span>
                    <h4 class="fw-bold text-success-main mb-0"><?= esc($totalLunas) ?></h4>
                    <span class="text-xxs text-success-600 fw-semibold">Transfer terverifikasi</span>
                </div>
                <div class="w-44-px h-44-px rounded-10 d-flex align-items-center justify-content-center bg-success-50 text-success-600">
                    <iconify-icon icon="solar:check-circle-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 4: Servis Selesai -->
    <div class="col-sm-6 col-lg-3">
        <div class="card shadow-none border radius-12 p-20 bg-white">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light text-uppercase fw-bold d-block mb-1">Servis Selesai</span>
                    <h4 class="fw-bold text-info-main mb-0"><?= esc($totalSelesai) ?></h4>
                    <span class="text-xxs text-info-600 fw-semibold">Pengerjaan tuntas</span>
                </div>
                <div class="w-44-px h-44-px rounded-10 d-flex align-items-center justify-content-center bg-info-50 text-info-600">
                    <iconify-icon icon="solar:wrench-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card h-100 p-0 radius-12">
    <!-- Filter Header -->
    <div class="card-header border-bottom bg-base py-16 px-24">
        <form method="get" action="<?= site_url('admin/booking') ?>" class="row g-2 align-items-center">
            <!-- Search -->
            <div class="col-md-4">
                <div class="icon-field">
                    <span class="icon"><iconify-icon icon="solar:magnifer-linear"></iconify-icon></span>
                    <input type="text" name="q" class="form-control form-control-sm radius-8 text-xs" placeholder="Cari Kode, Nama, Plat, No HP..." value="<?= esc($search) ?>">
                </div>
            </div>

            <!-- Filter Status Pembayaran -->
            <div class="col-md-3">
                <select name="bayar" class="form-select form-select-sm radius-8 text-xs" onchange="this.form.submit()">
                    <option value="semua" <?= $filterBayar === 'semua' ? 'selected' : '' ?>>Semua Status Bayar</option>
                    <option value="menunggu_konfirmasi" <?= $filterBayar === 'menunggu_konfirmasi' ? 'selected' : '' ?>>Menunggu Approval</option>
                    <option value="lunas" <?= $filterBayar === 'lunas' ? 'selected' : '' ?>>Lunas / Disetujui</option>
                    <option value="ditolak" <?= $filterBayar === 'ditolak' ? 'selected' : '' ?>>Pembayaran Ditolak</option>
                    <option value="menunggu_pembayaran" <?= $filterBayar === 'menunggu_pembayaran' ? 'selected' : '' ?>>Belum Bayar</option>
                </select>
            </div>

            <!-- Filter Status Booking -->
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm radius-8 text-xs" onchange="this.form.submit()">
                    <option value="semua" <?= $filterBooking === 'semua' ? 'selected' : '' ?>>Semua Status Booking</option>
                    <option value="menunggu_konfirmasi" <?= $filterBooking === 'menunggu_konfirmasi' ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                    <option value="diterima" <?= $filterBooking === 'diterima' ? 'selected' : '' ?>>Jadwal Diterima</option>
                    <option value="diproses" <?= $filterBooking === 'diproses' ? 'selected' : '' ?>>Sedang Dikerjakan</option>
                    <option value="selesai" <?= $filterBooking === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="dibatalkan" <?= $filterBooking === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary-600 btn-sm radius-8 text-xs w-100 fw-bold">Filter</button>
                <a href="<?= site_url('admin/booking') ?>" class="btn btn-outline-neutral-700 btn-sm radius-8 text-xs" title="Reset"><iconify-icon icon="solar:restart-bold"></iconify-icon></a>
            </div>
        </form>
    </div>

    <!-- Table Body -->
    <div class="card-body p-0">
        <?php if (!empty($daftarBooking)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-xs">
                    <thead class="bg-neutral-50 text-secondary-light text-xxs text-uppercase fw-bold">
                        <tr>
                            <th class="ps-24 py-12">Kode Booking</th>
                            <th class="py-12">Pelanggan</th>
                            <th class="py-12">Kendaraan</th>
                            <th class="py-12">Jadwal Servis</th>
                            <th class="py-12">Paket & Biaya</th>
                            <th class="py-12">Bukti & Pembayaran</th>
                            <th class="py-12">Status Booking</th>
                            <th class="text-center pe-24 py-12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftarBooking as $row): 
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
                                $textBooking  = 'Diterima';
                            } elseif ($stBooking === 'diproses') {
                                $badgeBooking = 'bg-info-50 text-info-700';
                                $textBooking  = 'Sedang Diproses';
                            } elseif ($stBooking === 'selesai') {
                                $badgeBooking = 'bg-success-50 text-success-700';
                                $textBooking  = 'Selesai';
                            } elseif ($stBooking === 'dibatalkan') {
                                $badgeBooking = 'bg-danger-50 text-danger-700';
                                $textBooking  = 'Dibatalkan';
                            }

                            $hasBukti = !empty($row['bukti_pembayaran']) && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $row['bukti_pembayaran']);
                            $buktiUrl = $hasBukti ? base_url('uploads/bukti_pembayaran/' . $row['bukti_pembayaran']) : '';

                            // Format WhatsApp link (e.g. 08123 -> 628123)
                            $phoneClean = preg_replace('/[^0-9]/', '', $row['no_hp']);
                            if (substr($phoneClean, 0, 1) === '0') {
                                $phoneClean = '62' . substr($phoneClean, 1);
                            }
                            $waLink = "https://wa.me/{$phoneClean}?text=" . urlencode("Halo {$row['nama_pelanggan']}, kami dari Bengkel Salsa Motor mengonfirmasi booking servis Anda dengan kode {$row['kode_booking']}.");
                        ?>
                            <tr>
                                <!-- Kode Booking -->
                                <td class="ps-24 fw-bold text-dark">
                                    <span class="text-primary-600"><?= esc($row['kode_booking']) ?></span>
                                    <small class="text-xxs text-secondary-light d-block"><?= date('d/m/Y H:i', strtotime($row['created_at'] ?? 'now')) ?></small>
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

                                <!-- Paket & Biaya -->
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= esc($row['jenis_servis']) ?></span>
                                    <span class="text-xxs fw-bold text-primary-600">Rp <?= number_format($row['biaya'], 0, ',', '.') ?></span>
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
                                               data-layanan="<?= esc($row['jenis_servis']) ?>"
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
                                <td>
                                    <span class="badge <?= $badgeBooking ?> radius-4 px-8 py-4 text-xxs fw-bold d-inline-block">
                                        <?= $textBooking ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="text-center pe-24">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!-- Tombol Approval Bukti Pembayaran -->
                                        <?php if ($hasBukti): ?>
                                            <button type="button" class="btn btn-outline-primary-600 btn-sm radius-6 px-8 py-4 text-xxs fw-bold btn-preview-bukti"
                                                    data-id="<?= $row['id_booking'] ?>"
                                                    data-kode="<?= esc($row['kode_booking']) ?>"
                                                    data-pelanggan="<?= esc($row['nama_pelanggan']) ?>"
                                                    data-motor="<?= esc($row['merkkendaraan']) ?> (<?= esc($row['nopol']) ?>)"
                                                    data-layanan="<?= esc($row['jenis_servis']) ?>"
                                                    data-biaya="Rp <?= number_format($row['biaya'], 0, ',', '.') ?>"
                                                    data-metode="<?= esc($row['metode_pembayaran']) ?>"
                                                    data-bukti="<?= $buktiUrl ?>"
                                                    data-status-bayar="<?= $stBayar ?>"
                                                    data-catatan="<?= esc($row['catatan_admin'] ?? '') ?>"
                                                    title="Verifikasi Bukti Transfer">
                                                <iconify-icon icon="solar:bill-check-bold" class="me-1 text-sm"></iconify-icon> Approval
                                            </button>
                                        <?php endif; ?>

                                        <!-- Tombol Update Status Booking -->
                                        <button type="button" class="btn btn-outline-neutral-700 btn-sm radius-6 px-8 py-4 text-xxs fw-bold btn-update-status"
                                                data-id="<?= $row['id_booking'] ?>"
                                                data-kode="<?= esc($row['kode_booking']) ?>"
                                                data-status="<?= $stBooking ?>"
                                                title="Ubah Status Booking">
                                            <iconify-icon icon="solar:pen-new-square-bold"></iconify-icon>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <a href="<?= site_url('admin/booking/hapus/' . $row['id_booking']) ?>" class="btn btn-outline-danger btn-sm radius-6 px-8 py-4 text-xxs" onclick="return confirm('Apakah Anda yakin ingin menghapus data booking ini?')" title="Hapus Data">
                                            <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-60 px-20">
                <div class="w-64-px h-64-px rounded-circle bg-neutral-100 text-secondary-light d-inline-flex align-items-center justify-content-center mb-16">
                    <iconify-icon icon="solar:calendar-bold-duotone" class="text-3xl"></iconify-icon>
                </div>
                <h6 class="fw-bold text-dark mb-4">Tidak Ada Data Booking</h6>
                <p class="text-xs text-secondary-light mb-0">Belum ada pengajuan booking servis yang sesuai dengan filter pencarian Anda.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL VERIFIKASI & APPROVAL BUKTI TRANSFER ADMIN -->
<!-- ========================================================================= -->
<div class="modal fade" id="modalApprovalAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <div class="p-8 bg-neutral-50 radius-10 border mb-2">
                            <img id="adminModalBuktiImg" src="" alt="Bukti Transfer" class="img-fluid rounded-8 shadow-sm" style="max-height: 380px; width: 100%; object-fit: contain;">
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
                                <span class="text-xxs text-secondary-light d-block">Paket Layanan Servis:</span>
                                <span class="fw-bold text-dark" id="adminModalLayanan">-</span>
                            </div>
                            <div class="mb-8">
                                <span class="text-xxs text-secondary-light d-block">Metode Pembayaran:</span>
                                <span class="fw-bold text-dark" id="adminModalMetode">-</span>
                            </div>
                            <div class="pt-8 border-top d-flex justify-content-between align-items-center">
                                <span class="text-xs fw-bold text-dark">Nominal Transfer:</span>
                                <span class="text-sm fw-bold text-primary-600" id="adminModalBiaya">Rp 0</span>
                            </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        let currentBookingId = null;

        // Trigger Modal Verifikasi & Approval
        const previewButtons = document.querySelectorAll(".btn-preview-bukti");
        previewButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                currentBookingId = this.getAttribute("data-id");
                const kode = this.getAttribute("data-kode");
                const pelanggan = this.getAttribute("data-pelanggan");
                const motor = this.getAttribute("data-motor");
                const layanan = this.getAttribute("data-layanan");
                const biaya = this.getAttribute("data-biaya");
                const metode = this.getAttribute("data-metode");
                const bukti = this.getAttribute("data-bukti");

                document.getElementById("adminModalKode").innerText = "Kode Booking: " + kode;
                document.getElementById("adminModalPelanggan").innerText = pelanggan;
                document.getElementById("adminModalMotor").innerText = motor;
                document.getElementById("adminModalLayanan").innerText = layanan;
                document.getElementById("adminModalMetode").innerText = metode;
                document.getElementById("adminModalBiaya").innerText = biaya;
                document.getElementById("adminModalBuktiImg").src = bukti;
                document.getElementById("adminModalBuktiLink").href = bukti;

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

            if (confirm("Apakah Anda yakin ingin menyetujui pembayaran ini sebagai LUNAS dan menerima jadwal booking?")) {
                window.location.href = "<?= site_url('admin/booking/approve/') ?>" + currentBookingId;
            }
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
                alert("Silakan masukkan alasan penolakan bukti pembayaran.");
                return;
            }

            // Buat form submit dinamis
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
        updateButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const kode = this.getAttribute("data-kode");
                const status = this.getAttribute("data-status");

                document.getElementById("statusModalKodeText").innerText = "Booking: " + kode;
                document.getElementById("selectStatusBooking").value = status;
                document.getElementById("formUpdateStatusBooking").action = "<?= site_url('admin/booking/update-status/') ?>" + id;

                new bootstrap.Modal(document.getElementById("modalUpdateStatusBooking")).show();
            });
        });
    });
</script>
<?= $this->endSection() ?>
