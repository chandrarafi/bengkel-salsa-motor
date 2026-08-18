<?= $this->extend('page/pelanggan/layout') ?>

<?= $this->section('content') ?>

<style>
    /* Countdown Box Styles */
    .countdown-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 16px;
        padding: 24px;
        color: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.25);
        position: relative;
        overflow: hidden;
    }

    .countdown-timer-display {
        font-size: 2.75rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: #ff5500;
        font-family: 'Monaco', 'Consolas', monospace;
        line-height: 1;
        text-shadow: 0 2px 10px rgba(255, 85, 0, 0.4);
    }

    .countdown-progress-bar {
        height: 6px;
        background: #ff5500;
        border-radius: 3px;
        transition: width 1s linear;
    }

    /* Bank Account Card */
    .rekening-box {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px;
    }

    .copy-btn {
        transition: all 0.2s ease;
    }

    .copy-btn:hover {
        background-color: #ff5500 !important;
        border-color: #ff5500 !important;
        color: #ffffff !important;
    }

    /* WOWDASH Upload Box */
    .upload-image-wrapper {
        background-color: #ffffff;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.2s ease;
    }

    .upload-image-wrapper:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.02);
    }

    .uploaded-img {
        width: 140px;
        height: 140px;
        min-width: 140px;
        min-height: 140px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        background-color: #ffffff;
        position: relative;
    }

    .upload-file {
        width: 140px;
        height: 140px;
        min-width: 140px;
        min-height: 140px;
        border-radius: 10px;
        border: 2px dashed #cbd5e1;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    .upload-file:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.04);
    }
</style>

<!-- Page Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h4 class="fw-bold text-dark mb-1">Pembayaran Booking Servis Motor</h4>
        <p class="text-xs text-secondary-light mb-0">Selesaikan transfer dan unggah bukti pembayaran sebelum batas waktu berakhir.</p>
    </div>
    <a href="<?= site_url('riwayat-booking') ?>" class="btn btn-outline-neutral-700 text-dark radius-8 px-16 py-8 text-xs fw-bold d-inline-flex align-items-center gap-2 bg-white border">
        <iconify-icon icon="solar:calendar-mark-bold-duotone" style="color: #ff5500;" class="text-base"></iconify-icon>
        Lihat Riwayat Booking
    </a>
</div>

<?php 
    $isExpired = ($booking['status_booking'] === 'dibatalkan') || ($remainingSeconds <= 0 && $booking['status_pembayaran'] === 'menunggu_pembayaran');
    $isPaid    = ($booking['status_pembayaran'] === 'menunggu_konfirmasi') || ($booking['status_pembayaran'] === 'lunas');
?>

<div class="row g-4">
    <!-- Left Side: Hitung Mundur & Rekening Tujuan -->
    <div class="col-lg-7">
        <!-- COUNTDOWN TIMER CARD -->
        <div class="countdown-card mb-20">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge bg-warning-500 text-dark text-xxs fw-bold px-10 py-4 radius-6 d-inline-flex align-items-center gap-1">
                    <iconify-icon icon="solar:clock-circle-bold" class="text-xs"></iconify-icon>
                    Batas Waktu Pembayaran 5 Menit
                </span>
                <span class="text-xxs text-neutral-400">Kode: <b class="text-white"><?= esc($booking['kode_booking']) ?></b></span>
            </div>

            <?php if ($isExpired): ?>
                <div class="text-center py-20">
                    <iconify-icon icon="solar:close-circle-bold-duotone" class="text-5xl text-danger-main mb-2"></iconify-icon>
                    <h5 class="fw-bold text-white mb-1">Batas Waktu 5 Menit Telah Habis</h5>
                    <p class="text-xs text-neutral-400 mb-16">Pengajuan booking servis ini telah kadaluarsa secara otomatis.</p>
                    <a href="<?= site_url('booking') ?>" class="btn btn-brand btn-sm radius-8 px-20 py-8 text-xs fw-bold">
                        Buat Booking Servis Baru
                    </a>
                </div>
            <?php elseif ($isPaid): ?>
                <div class="text-center py-20">
                    <iconify-icon icon="solar:check-circle-bold-duotone" class="text-5xl text-success-main mb-2"></iconify-icon>
                    <h5 class="fw-bold text-white mb-1">Bukti Pembayaran Berhasil Dikirim</h5>
                    <p class="text-xs text-neutral-400 mb-16">Admin bengkel sedang memverifikasi pembayaran Anda.</p>
                    <a href="<?= site_url('riwayat-booking') ?>" class="btn btn-success-600 btn-sm radius-8 px-20 py-8 text-xs fw-bold">
                        Cek Status Riwayat Booking
                    </a>
                </div>
            <?php else: ?>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <span class="text-xxs text-neutral-400 d-block uppercase fw-bold">Sisa Waktu Anda:</span>
                        <div class="countdown-timer-display mt-1" id="timerDisplay">05:00</div>
                    </div>
                    <div class="text-end">
                        <span class="text-xxs text-neutral-400 d-block">DP Estimasi Booking:</span>
                        <h4 class="fw-bold mb-0 text-white" style="color: #ff5500 !important;">Rp <?= number_format($booking['biaya'], 0, ',', '.') ?></h4>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="bg-neutral-800 radius-4 overflow-hidden mb-2" style="height: 6px;">
                    <div class="countdown-progress-bar" id="progressBar" style="width: 100%;"></div>
                </div>
                <small class="text-xxs text-neutral-400 d-block text-center">*Selesaikan transfer sebelum waktu hitung mundur di atas menjadi 00:00.</small>
            <?php endif; ?>
        </div>

        <!-- REKENING TRANSFER CARD -->
        <div class="card-custom">
            <div class="card-header-custom border-bottom">
                <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:card-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                    Instruksi Pembayaran & Rekening Tujuan
                </h6>
            </div>
            <div class="card-body-custom">
                <div class="mb-3">
                    <span class="text-xs text-secondary-light d-block mb-1">Metode Pembayaran Dipilih:</span>
                    <span class="badge bg-primary-50 text-primary-600 text-xs fw-bold px-12 py-6 radius-6">
                        <?= esc($booking['metode_pembayaran']) ?>
                    </span>
                </div>

                <?php 
                    $metode = strtolower($booking['metode_pembayaran'] ?? '');
                    if (str_contains($metode, 'bca')):
                ?>
                    <!-- Rekening BCA -->
                    <div class="rekening-box d-flex align-items-center justify-content-between gap-3">
                        <div>
                            <span class="text-xxs text-secondary-light fw-bold uppercase d-block">Bank BCA (PT Salsa Motor Bengkel)</span>
                            <h4 class="fw-extrabold text-dark mb-1 font-monospace" style="letter-spacing: 1px;">8245-1234-99</h4>
                            <span class="text-xs text-secondary-light">Atas Nama: <b class="text-dark">Salsa Motor Bengkel</b></span>
                        </div>
                        <button type="button" class="btn btn-outline-neutral-700 bg-white text-dark btn-sm radius-8 px-14 py-8 text-xs fw-bold border copy-btn d-inline-flex align-items-center gap-1" data-copy="8245123499">
                            <iconify-icon icon="solar:copy-bold-duotone"></iconify-icon>
                            <span>Salin No. Rek</span>
                        </button>
                    </div>

                <?php elseif (str_contains($metode, 'bri')): ?>
                    <!-- Rekening BRI -->
                    <div class="rekening-box d-flex align-items-center justify-content-between gap-3">
                        <div>
                            <span class="text-xxs text-secondary-light fw-bold uppercase d-block">Bank BRI (PT Salsa Motor Bengkel)</span>
                            <h4 class="fw-extrabold text-dark mb-1 font-monospace" style="letter-spacing: 1px;">0123-0100-8888-501</h4>
                            <span class="text-xs text-secondary-light">Atas Nama: <b class="text-dark">Salsa Motor Bengkel</b></span>
                        </div>
                        <button type="button" class="btn btn-outline-neutral-700 bg-white text-dark btn-sm radius-8 px-14 py-8 text-xs fw-bold border copy-btn d-inline-flex align-items-center gap-1" data-copy="012301008888501">
                            <iconify-icon icon="solar:copy-bold-duotone"></iconify-icon>
                            <span>Salin No. Rek</span>
                        </button>
                    </div>

                <?php else: ?>
                    <!-- QRIS All Payment -->
                    <div class="rekening-box text-center p-20">
                        <span class="text-xs text-secondary-light fw-bold uppercase d-block mb-2">Scan QRIS All Payment (GoPay, OVO, Dana, ShopeePay)</span>
                        <div class="p-12 bg-white d-inline-block radius-12 border shadow-sm mb-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=BKG_SALSA_MOTOR_<?= $booking['kode_booking'] ?>" alt="QRIS Salsa Motor" class="img-fluid radius-8" style="width: 160px; height: 160px;">
                        </div>
                        <span class="text-xs text-dark fw-bold d-block">Atas Nama: Salsa Motor Bengkel</span>
                    </div>
                <?php endif; ?>

                <div class="p-12 radius-8 mt-16 bg-light border text-xs text-secondary-light d-flex align-items-start gap-2">
                    <iconify-icon icon="solar:info-circle-bold-duotone" class="text-lg text-primary-600 flex-shrink-0 mt-1"></iconify-icon>
                    <div>
                        <span>Pembayaran online ini merupakan <b>DP / Uang Muka Estimasi Booking</b> sebesar <b>Rp <?= number_format($booking['biaya'], 0, ',', '.') ?></b>. Pelunasan sisa biaya servis & sparepart tambahan akan dihitung dan dilunasi di bengkel setelah pengerjaan selesai.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Rincian Booking & Form Upload Struk -->
    <div class="col-lg-5">
        <!-- RINGKASAN DATA BOOKING -->
        <div class="card-custom mb-20">
            <div class="card-header-custom border-bottom">
                <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:document-text-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                    Rincian Pemesanan Servis
                </h6>
            </div>
            <div class="card-body-custom">
                <ul class="list-group list-group-flush text-xs border-0">
                    <li class="list-group-item d-flex justify-content-between px-0 py-8 border-bottom">
                        <span class="text-secondary-light">Nama Pemilik:</span>
                        <span class="fw-bold text-dark"><?= esc($booking['nama_pelanggan']) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-8 border-bottom">
                        <span class="text-secondary-light">No. WhatsApp:</span>
                        <span class="fw-bold text-dark"><?= esc($booking['no_hp']) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-8 border-bottom">
                        <span class="text-secondary-light">Kendaraan / Plat:</span>
                        <span class="fw-bold text-dark"><?= esc($booking['merkkendaraan']) ?> (<?= esc($booking['nopol']) ?>)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-8 border-bottom">
                        <span class="text-secondary-light">Jadwal Kedatangan:</span>
                        <span class="fw-bold text-dark"><?= date('d/m/Y', strtotime($booking['tgl_booking'])) ?> - Jam <?= date('H:i', strtotime($booking['jam_booking'])) ?> WIB</span>
                    </li>
                    <li class="list-group-item px-0 py-8 border-bottom">
                        <span class="text-secondary-light d-block mb-1">Paket Layanan Servis:</span>
                        <span class="fw-bold text-dark d-block"><?= esc($booking['jenis_servis']) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-10 bg-primary-50 px-12 radius-8 mt-8 border-0">
                        <span class="fw-bold text-dark">DP Estimasi Booking:</span>
                        <span class="fw-extrabold text-brand" style="font-size: 15px; color: #ff5500;">Rp <?= number_format($booking['biaya'], 0, ',', '.') ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- FORM UPLOAD BUKTI PEMBAYARAN -->
        <div class="card-custom">
            <div class="card-header-custom border-bottom">
                <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:camera-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                    Unggah Struk Bukti Transfer
                </h6>
            </div>
            <div class="card-body-custom">
                <?php if ($isExpired): ?>
                    <div class="alert alert-danger bg-danger-50 text-danger-700 border border-danger-200 text-xs radius-8 mb-0">
                        Maaf, waktu pembayaran 5 menit telah habis. Form upload bukti pembayaran ditutup.
                    </div>
                <?php elseif ($isPaid): ?>
                    <div class="alert alert-success bg-success-50 text-success-700 border border-success-200 text-xs radius-8 mb-0">
                        Bukti pembayaran Anda sudah berhasil dikirim. Terima kasih!
                    </div>
                <?php else: ?>
                    <form action="<?= site_url('pelanggan/booking/proses-pembayaran') ?>" method="post" enctype="multipart/form-data" id="formUploadBukti">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">

                        <div class="upload-image-wrapper mb-20">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Preview Box -->
                                <div class="uploaded-img d-none position-relative d-flex align-items-center justify-content-center">
                                    <button type="button" class="uploaded-img__remove position-absolute top-0 end-0 z-1 p-0 me-6 mt-6 d-flex border-0 bg-white rounded-circle shadow-sm cursor-pointer" title="Hapus foto" style="width: 24px; height: 24px; align-items: center; justify-content: center;">
                                        <iconify-icon icon="radix-icons:cross-2" class="text-sm text-danger-600"></iconify-icon>
                                    </button>
                                    <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover" src="" alt="Bukti Transfer">
                                </div>

                                <!-- Upload Button Box -->
                                <label class="upload-file d-flex align-items-center flex-column justify-content-center gap-1 cursor-pointer mb-0" for="upload-bukti">
                                    <iconify-icon icon="solar:camera-bold-duotone" class="text-3xl text-secondary-light"></iconify-icon>
                                    <span class="text-xxs fw-bold text-secondary-light">Pilih Struk</span>
                                    <input id="upload-bukti" name="bukti_pembayaran" type="file" hidden accept="image/png, image/jpeg, image/jpg, image/webp" required>
                                </label>

                                <div class="flex-grow-1">
                                    <span class="text-xs fw-bold text-dark d-block">Pilih Struk Transfer</span>
                                    <small class="text-xxs text-secondary-light d-block mt-1">Format: JPG, PNG, WEBP (Maks 3MB).</small>
                                    <small class="text-xxs text-secondary-light d-block">Admin akan memvalidasi bukti Anda.</small>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($errors['bukti_pembayaran'])): ?>
                            <div class="text-danger text-xxs mb-12 fw-semibold d-block"><?= $errors['bukti_pembayaran'] ?></div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-brand w-100 radius-8 py-12 text-sm fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm" id="btnSubmitBukti">
                            <iconify-icon icon="solar:check-circle-bold" class="text-lg"></iconify-icon>
                            <span>Kirim & Upload Bukti Pembayaran</span>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Copy No Rekening Button
        document.querySelectorAll(".copy-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const textToCopy = this.getAttribute("data-copy");
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<iconify-icon icon="solar:check-circle-bold"></iconify-icon> <span>Tersalin!</span>';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                });
            });
        });

        // Upload Preview
        const fileInput = document.getElementById("upload-bukti");
        const imagePreview = document.getElementById("uploaded-img__preview");
        const uploadedImgContainer = document.querySelector(".uploaded-img");
        const removeButton = document.querySelector(".uploaded-img__remove");

        if (fileInput) {
            fileInput.addEventListener("change", (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    imagePreview.src = src;
                    uploadedImgContainer.classList.remove('d-none');
                }
            });
        }

        if (removeButton) {
            removeButton.addEventListener("click", () => {
                imagePreview.src = "";
                uploadedImgContainer.classList.add('d-none');
                if (fileInput) {
                    fileInput.value = "";
                }
            });
        }

        // -------------------------------------------------------------
        // 5-MINUTE COUNTDOWN TIMER JS
        // -------------------------------------------------------------
        let remainingSeconds = <?= (int)$remainingSeconds ?>;
        const isExpired = <?= $isExpired ? 'true' : 'false' ?>;
        const isPaid = <?= $isPaid ? 'true' : 'false' ?>;

        const timerDisplay = document.getElementById("timerDisplay");
        const progressBar = document.getElementById("progressBar");
        const idBooking = <?= (int)$booking['id_booking'] ?>;
        const maxSeconds = 300; // 5 minutes = 300 seconds

        if (!isExpired && !isPaid && remainingSeconds > 0) {
            const timerInterval = setInterval(function() {
                remainingSeconds--;

                if (remainingSeconds <= 0) {
                    clearInterval(timerInterval);
                    if (timerDisplay) timerDisplay.innerText = "00:00";
                    if (progressBar) progressBar.style.width = "0%";

                    // Trigger AJAX Expiration to Server
                    fetch("<?= site_url('pelanggan/booking/expirate') ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                            "X-Requested-With": "XMLHttpRequest",
                            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                        },
                        body: "id_booking=" + idBooking
                    }).finally(() => {
                        alert("Waktu pembayaran 5 menit telah habis! Pesanan booking Anda dibatalkan secara otomatis.");
                        window.location.reload();
                    });
                } else {
                    const mins = Math.floor(remainingSeconds / 60);
                    const secs = remainingSeconds % 60;
                    const minsStr = mins < 10 ? '0' + mins : mins;
                    const secsStr = secs < 10 ? '0' + secs : secs;

                    if (timerDisplay) {
                        timerDisplay.innerText = minsStr + ":" + secsStr;
                        if (remainingSeconds <= 60) {
                            timerDisplay.style.color = "#ef4444"; // turns red warning
                        }
                    }

                    if (progressBar) {
                        const pct = Math.max(0, (remainingSeconds / maxSeconds) * 100);
                        progressBar.style.width = pct + "%";
                        if (remainingSeconds <= 60) {
                            progressBar.style.backgroundColor = "#ef4444";
                        }
                    }
                }
            }, 1000);
        }
    });
</script>
<?= $this->endSection() ?>
