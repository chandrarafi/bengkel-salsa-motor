<?= $this->extend('page/pelanggan/layout') ?>

<?= $this->section('content') ?>

<!-- Page Title & Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h4 class="fw-bold text-dark mb-1">Riwayat Booking Servis Saya</h4>
        <p class="text-xs text-secondary-light mb-0">Pantau status konfirmasi jadwal dan approval pembayaran booking servis motor Anda secara real-time.</p>
    </div>
    <a href="<?= site_url('booking') ?>" class="btn btn-brand text-xs fw-bold d-inline-flex align-items-center gap-2">
        <iconify-icon icon="solar:calendar-add-bold" class="text-base"></iconify-icon>
        Booking Servis Baru
    </a>
</div>

<!-- Table Card -->
<div class="card-custom">
    <div class="card-header-custom border-bottom">
        <h6 class="text-sm fw-bold text-dark mb-0">Daftar Pengajuan Booking Servis</h6>
        <span class="badge bg-neutral-100 text-secondary-light text-xxs px-10 py-4 radius-6 fw-bold">
            <?= count($daftarBooking) ?> Data Ditemukan
        </span>
    </div>

    <div class="card-body-custom p-0">
        <?php if (!empty($daftarBooking)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-xs">
                    <thead class="bg-neutral-50 text-secondary-light text-xxs text-uppercase fw-bold">
                        <tr>
                            <th class="ps-24 py-12">Kode Booking</th>
                            <th class="py-12">Jadwal Servis</th>
                            <th class="py-12">Kendaraan</th>
                            <th class="py-12">Keluhan & DP Booking</th>
                            <th class="py-12">Status Bayar</th>
                            <th class="py-12">Status Booking</th>
                            <th class="text-center pe-24 py-12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftarBooking as $row): 
                            $stBayar   = strtolower($row['status_pembayaran'] ?? 'menunggu_konfirmasi');
                            $stBooking = strtolower($row['status_booking'] ?? 'menunggu_konfirmasi');
                            
                            $createdAt = strtotime($row['created_at'] ?? 'now');
                            $elapsed   = time() - $createdAt;
                            $remSecs   = (5 * 60) - $elapsed;
                            $isExpired = ($stBayar === 'menunggu_pembayaran' && $remSecs <= 0 && $stBooking !== 'dibatalkan');

                            if ($isExpired) {
                                $stBooking = 'dibatalkan';
                            }

                            // Status Pembayaran Badge
                            $badgeBayar = 'bg-warning-50 text-warning-700';
                            $textBayar  = 'Menunggu Approval';

                            if ($stBayar === 'lunas') {
                                $badgeBayar = 'bg-success-50 text-success-700';
                                $textBayar  = 'Lunas / Disetujui';
                            } elseif ($stBayar === 'ditolak') {
                                $badgeBayar = 'bg-danger-50 text-danger-700';
                                $textBayar  = 'Pembayaran Ditolak';
                            } elseif ($stBayar === 'menunggu_pembayaran') {
                                if ($remSecs > 0) {
                                    $badgeBayar = 'bg-warning-50 text-warning-700';
                                    $textBayar  = 'Belum Bayar DP (5 Menit)';
                                } else {
                                    $badgeBayar = 'bg-neutral-100 text-secondary-light';
                                    $textBayar  = 'Kadaluarsa';
                                }
                            }

                            // Status Booking Badge
                            $badgeBooking = 'bg-warning-50 text-warning-700';
                            $textBooking  = 'Menunggu Konfirmasi';

                            if ($stBooking === 'diterima') {
                                $badgeBooking = 'bg-primary-50 text-primary-700';
                                $textBooking  = 'Jadwal Diterima';
                            } elseif ($stBooking === 'diproses') {
                                $badgeBooking = 'bg-info-50 text-info-700';
                                $textBooking  = 'Sedang Dikerjakan';
                            } elseif ($stBooking === 'selesai') {
                                $badgeBooking = 'bg-success-50 text-success-700';
                                $textBooking  = 'Servis Selesai';
                            } elseif ($stBooking === 'dibatalkan') {
                                $badgeBooking = 'bg-danger-50 text-danger-700';
                                $textBooking  = 'Dibatalkan / Kadaluarsa';
                            }

                            $hasBukti = !empty($row['bukti_pembayaran']) && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $row['bukti_pembayaran']);
                            $buktiUrl = $hasBukti ? base_url('uploads/bukti_pembayaran/' . $row['bukti_pembayaran']) : '';
                        ?>
                            <tr>
                                <td class="ps-24 fw-bold text-dark">
                                    <?= esc($row['kode_booking']) ?>
                                    <small class="text-xxs text-secondary-light d-block"><?= date('d/m/Y H:i', strtotime($row['created_at'] ?? 'now')) ?></small>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= date('d F Y', strtotime($row['tgl_booking'])) ?></span>
                                    <span class="text-xxs text-secondary-light fw-semibold">Pukul <?= date('H:i', strtotime($row['jam_booking'])) ?> WIB</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= esc($row['merkkendaraan']) ?></span>
                                    <span class="badge bg-neutral-100 text-secondary-light text-xxs"><?= esc($row['nopol']) ?></span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block text-xs" title="<?= esc($row['keluhan'] ?? '') ?>"><?= esc(!empty($row['keluhan']) ? (strlen($row['keluhan']) > 30 ? substr($row['keluhan'], 0, 30) . '...' : $row['keluhan']) : 'Pengecekan Servis') ?></span>
                                    <span class="text-xxs fw-bold" style="color: #ff5500;">Rp <?= number_format($row['biaya'], 0, ',', '.') ?> <small class="text-secondary-light fw-semibold">(DP)</small></span>
                                </td>
                                <td>
                                    <span class="badge <?= $badgeBayar ?> radius-4 px-8 py-4 text-xxs fw-bold d-inline-block">
                                        <?= $textBayar ?>
                                    </span>
                                    <?php if (!empty($row['catatan_admin'])): ?>
                                        <small class="text-xxs text-danger-main d-block mt-1 fw-semibold" title="Alasan: <?= esc($row['catatan_admin']) ?>">
                                            <?= esc(strlen($row['catatan_admin']) > 35 ? substr($row['catatan_admin'], 0, 35) . '...' : $row['catatan_admin']) ?>
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge <?= $badgeBooking ?> radius-4 px-8 py-4 text-xxs fw-bold d-inline-block">
                                        <?= $textBooking ?>
                                    </span>
                                </td>
                                <td class="text-center pe-24">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!-- Tombol Bayar Sekarang jika belum bayar dan belum kadaluarsa -->
                                        <?php if ($stBayar === 'menunggu_pembayaran' && $remSecs > 0 && $stBooking !== 'dibatalkan'): ?>
                                            <a href="<?= site_url('pelanggan/booking/pembayaran/' . $row['id_booking']) ?>" class="btn btn-brand text-white btn-sm radius-6 px-10 py-6 text-xxs fw-bold d-inline-flex align-items-center gap-1 shadow-sm" title="Selesaikan Pembayaran (5 Menit)">
                                                <iconify-icon icon="solar:wallet-money-bold"></iconify-icon> Bayar Sekarang
                                            </a>
                                        <?php endif; ?>

                                        <!-- Tombol Lihat Detail / Bukti -->
                                        <?php if ($hasBukti): ?>
                                            <button type="button" class="btn btn-outline-neutral-700 btn-sm radius-6 px-8 py-4 text-xxs fw-bold btn-view-bukti" 
                                                    data-kode="<?= esc($row['kode_booking']) ?>" 
                                                    data-bukti="<?= $buktiUrl ?>" 
                                                    data-metode="<?= esc($row['metode_pembayaran']) ?>"
                                                    data-status="<?= $textBayar ?>"
                                                    data-catatan="<?= esc($row['catatan_admin'] ?? '') ?>">
                                                <iconify-icon icon="solar:eye-bold" class="me-1"></iconify-icon> Bukti
                                            </button>
                                        <?php endif; ?>

                                        <!-- Tombol Re-Upload Bukti jika Ditolak -->
                                        <?php if ($stBayar === 'ditolak' && $stBooking !== 'dibatalkan'): ?>
                                            <button type="button" class="btn btn-warning-main text-white btn-sm radius-6 px-8 py-4 text-xxs fw-bold btn-reupload-bukti" 
                                                    data-id="<?= $row['id_booking'] ?>" 
                                                    data-kode="<?= esc($row['kode_booking']) ?>"
                                                    data-catatan="<?= esc($row['catatan_admin'] ?? '') ?>">
                                                <iconify-icon icon="solar:upload-bold" class="me-1"></iconify-icon> Upload Struk
                                            </button>
                                        <?php endif; ?>

                                        <!-- Tombol Batalkan jika masih menunggu -->
                                        <?php if ($stBooking === 'menunggu_konfirmasi' && $remSecs > 0): ?>
                                            <a href="<?= site_url('pelanggan/booking/batal/' . $row['id_booking']) ?>" class="btn btn-outline-danger btn-sm radius-6 px-8 py-4 text-xxs" onclick="return confirm('Apakah Anda yakin ingin membatalkan pengajuan booking servis ini?')" title="Batalkan Booking">
                                                <iconify-icon icon="solar:close-circle-bold"></iconify-icon>
                                            </a>
                                        <?php endif; ?>
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
                <h6 class="fw-bold text-dark mb-4">Belum Ada Pengajuan Booking Servis</h6>
                <p class="text-xs text-secondary-light mb-20" style="max-width: 420px; margin-left: auto; margin-right: auto;">
                    Anda belum memiliki riwayat pesanan servis online. Lakukan booking sekarang untuk mendapatkan kepastian jadwal mekanik terbaik kami!
                </p>
                <a href="<?= site_url('booking') ?>" class="btn btn-brand text-xs fw-bold px-20 py-10">
                    Booking Servis Sekarang
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL PREVIEW BUKTI PEMBAYARAN -->
<div class="modal fade" id="modalViewBukti" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-14 border-0 shadow-lg">
            <div class="modal-header border-bottom px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-dark mb-0">Bukti Pembayaran / Transfer</h6>
                    <span class="text-xxs text-secondary-light" id="modalBuktiKode">-</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-24 py-20 text-center">
                <div class="mb-16 p-12 bg-neutral-50 radius-8 border text-start text-xs">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-secondary-light">Metode:</span>
                        <span class="fw-bold text-dark" id="modalBuktiMetode">-</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-secondary-light">Status:</span>
                        <span class="fw-bold" id="modalBuktiStatus">-</span>
                    </div>
                    <div id="modalBuktiCatatanContainer" class="mt-2 pt-2 border-top d-none">
                        <span class="text-danger-main fw-bold d-block text-xxs">Catatan Admin:</span>
                        <span class="text-secondary-light text-xs" id="modalBuktiCatatan">-</span>
                    </div>
                </div>
                <img id="modalBuktiImg" src="" alt="Bukti Transfer" class="img-fluid rounded-8 border shadow-sm" style="max-height: 400px; width: auto; object-fit: contain;">
            </div>
            <div class="modal-footer border-top px-24 py-12">
                <button type="button" class="btn btn-outline-neutral-700 text-xs radius-6 px-16 py-8" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL RE-UPLOAD BUKTI PEMBAYARAN -->
<div class="modal fade" id="modalReupload" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-14 border-0 shadow-lg">
            <form action="<?= site_url('pelanggan/booking/upload-ulang') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id_booking" id="reuploadIdBooking">

                <div class="modal-header border-bottom px-24 py-16">
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0">Upload Ulang Bukti Pembayaran</h6>
                        <span class="text-xxs text-secondary-light" id="reuploadKode">-</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-24 py-20">
                    <div id="reuploadCatatanBox" class="alert alert-danger bg-danger-50 text-danger-700 border-danger-200 radius-8 p-12 mb-16 text-xs d-none">
                        <span class="fw-bold d-block mb-1">Alasan Penolakan Sebelumnya:</span>
                        <span id="reuploadCatatanText">-</span>
                    </div>

                    <label class="form-label text-xs fw-bold text-dark mb-2">Pilih File Struk / Bukti Transfer Baru <span class="text-danger">*</span></label>
                    <input type="file" class="form-control radius-8 text-sm mb-2" name="bukti_pembayaran" accept="image/*" required>
                    <small class="text-xxs text-secondary-light d-block">Format: JPG, PNG, JPEG, WEBP (Maksimal 3MB). Pastikan struk terbaca jelas.</small>
                </div>
                <div class="modal-footer border-top px-24 py-12 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-neutral-700 text-xs radius-6 px-16 py-8" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-brand text-xs fw-bold px-18 py-8">Kirim Bukti Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Modal Preview Bukti
        const viewButtons = document.querySelectorAll(".btn-view-bukti");
        viewButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                const kode = this.getAttribute("data-kode");
                const bukti = this.getAttribute("data-bukti");
                const metode = this.getAttribute("data-metode");
                const status = this.getAttribute("data-status");
                const catatan = this.getAttribute("data-catatan");

                document.getElementById("modalBuktiKode").innerText = "Kode: " + kode;
                document.getElementById("modalBuktiImg").src = bukti;
                document.getElementById("modalBuktiMetode").innerText = metode;
                document.getElementById("modalBuktiStatus").innerText = status;

                const catBox = document.getElementById("modalBuktiCatatanContainer");
                if (catatan && catatan.trim() !== "") {
                    document.getElementById("modalBuktiCatatan").innerText = catatan;
                    catBox.classList.remove("d-none");
                } else {
                    catBox.classList.add("d-none");
                }

                new bootstrap.Modal(document.getElementById("modalViewBukti")).show();
            });
        });

        // Modal Re-upload Bukti
        const reuploadButtons = document.querySelectorAll(".btn-reupload-bukti");
        reuploadButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const kode = this.getAttribute("data-kode");
                const catatan = this.getAttribute("data-catatan");

                document.getElementById("reuploadIdBooking").value = id;
                document.getElementById("reuploadKode").innerText = "Kode: " + kode;

                const catAlert = document.getElementById("reuploadCatatanBox");
                if (catatan && catatan.trim() !== "") {
                    document.getElementById("reuploadCatatanText").innerText = catatan;
                    catAlert.classList.remove("d-none");
                } else {
                    catAlert.classList.add("d-none");
                }

                new bootstrap.Modal(document.getElementById("modalReupload")).show();
            });
        });
    });
</script>
<?= $this->endSection() ?>
