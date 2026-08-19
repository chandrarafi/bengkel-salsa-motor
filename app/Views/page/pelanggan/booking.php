<?= $this->extend('page/pelanggan/layout') ?>

<?= $this->section('content') ?>

<style>
    /* Payment Box Styles */
    .bank-card-box {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .bank-card-box:hover,
    .bank-card-box.active {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.03);
    }

    /* Time Slot Buttons */
    .time-slot-btn {
        background-color: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 6px;
        font-size: 0.8125rem;
        font-weight: 700;
        color: #334155;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        transition: all 0.2s ease;
        cursor: pointer;
        width: 100%;
        min-height: 56px;
    }

    .time-slot-btn .slot-time {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 0.8rem;
    }

    .time-slot-btn .slot-quota {
        font-size: 0.65rem;
        font-weight: 600;
        padding: 1px 6px;
        border-radius: 4px;
        background-color: #f1f5f9;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .time-slot-btn:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.04);
        color: #ff5500;
    }

    .time-slot-btn:hover .slot-quota {
        background-color: #ffedd5;
        color: #ff5500;
    }

    .time-slot-btn.active {
        background-color: #ff5500 !important;
        border-color: #ff5500 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(255, 85, 0, 0.3);
    }

    .time-slot-btn.active .slot-quota {
        background-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }

    .time-slot-btn:disabled,
    .time-slot-btn.disabled-slot {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        color: #94a3b8 !important;
        cursor: not-allowed !important;
        opacity: 0.6;
        box-shadow: none !important;
        pointer-events: none;
    }

    .time-slot-btn.disabled-slot .slot-quota {
        background-color: #fee2e2 !important;
        color: #ef4444 !important;
        text-decoration: none;
    }

    .policy-card {
        background: #ffffff;
        border: 1.5px solid #fed7aa;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px -3px rgba(255, 85, 0, 0.08);
    }

    .policy-card-header {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        border-bottom: 1px solid #fed7aa;
        padding: 12px 16px;
    }

    .policy-card-body {
        padding: 12px;
    }

    .policy-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid #f1f5f9;
        margin-bottom: 8px;
        transition: all 0.2s ease;
    }

    .policy-item:last-child {
        margin-bottom: 0;
    }

    .policy-item:hover {
        background: #fffaf5;
        border-color: #fed7aa;
        transform: translateX(2px);
    }

    .policy-icon-badge {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }
</style>

<!-- Page Title & Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h4 class="fw-bold text-dark mb-1">Formulir Booking Servis Motor</h4>
        <p class="text-xs text-secondary-light mb-0">Pesan antrean servis secara online, cukup tuliskan keluhan motor dan bayar uang muka booking (Rp 50.000).</p>
    </div>
    <a href="<?= site_url('riwayat-booking') ?>" class="btn btn-outline-neutral-700 text-dark radius-8 px-16 py-8 text-xs fw-bold d-inline-flex align-items-center gap-2 bg-white border">
        <iconify-icon icon="solar:calendar-mark-bold-duotone" style="color: #ff5500;" class="text-base"></iconify-icon>
        Lihat Riwayat Booking Saya
    </a>
</div>

<form action="<?= site_url('pelanggan/booking/simpan') ?>" method="post" id="formBookingServis">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Left Side: Data Kendaraan & Jadwal + Keluhan -->
        <div class="col-lg-7">
            <!-- Card 1: Data Pemilik & Kendaraan -->
            <div class="card-custom mb-20">
                <div class="card-header-custom border-bottom">
                    <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:scooter-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                        1. Informasi Pemilik & Kendaraan
                    </h6>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <!-- Nama Lengkap -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-dark mb-1">Nama Lengkap Pemilik <span class="text-danger">*</span></label>
                            <div class="icon-field">
                                <span class="icon"><iconify-icon icon="solar:user-bold-duotone"></iconify-icon></span>
                                <input type="text" class="form-control radius-8 text-sm <?= isset($errors['nama_pelanggan']) ? 'is-invalid' : '' ?>" name="nama_pelanggan" placeholder="Contoh: Hendra Putra" value="<?= old('nama_pelanggan', $user['nama'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['nama_pelanggan'])): ?>
                                <div class="invalid-feedback"><?= $errors['nama_pelanggan'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- No WhatsApp -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-dark mb-1">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                            <div class="icon-field">
                                <span class="icon"><iconify-icon icon="solar:phone-bold-duotone"></iconify-icon></span>
                                <input type="tel" class="form-control radius-8 text-sm <?= isset($errors['no_hp']) ? 'is-invalid' : '' ?>" name="no_hp" placeholder="Contoh: 08123456789" value="<?= old('no_hp', $user['no_hp'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['no_hp'])): ?>
                                <div class="invalid-feedback"><?= $errors['no_hp'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Merk & Tipe Motor -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-dark mb-1">Merk & Tipe Motor <span class="text-danger">*</span></label>
                            <div class="icon-field">
                                <span class="icon"><iconify-icon icon="solar:scooter-bold-duotone"></iconify-icon></span>
                                <input type="text" class="form-control radius-8 text-sm <?= isset($errors['merkkendaraan']) ? 'is-invalid' : '' ?>" name="merkkendaraan" placeholder="Contoh: Honda Vario 160 / Scoopy / NMAX" value="<?= old('merkkendaraan') ?>" required>
                            </div>
                            <?php if (isset($errors['merkkendaraan'])): ?>
                                <div class="invalid-feedback"><?= $errors['merkkendaraan'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Nomor Polisi -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-bold text-dark mb-1">Nomor Polisi (Plat Motor) <span class="text-danger">*</span></label>
                            <div class="icon-field">
                                <span class="icon"><iconify-icon icon="solar:card-bold-duotone"></iconify-icon></span>
                                <input type="text" class="form-control radius-8 text-sm text-uppercase <?= isset($errors['nopol']) ? 'is-invalid' : '' ?>" name="nopol" placeholder="Contoh: BA 1234 XY" value="<?= old('nopol') ?>" required>
                            </div>
                            <?php if (isset($errors['nopol'])): ?>
                                <div class="invalid-feedback"><?= $errors['nopol'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Jadwal Servis & Catatan Keluhan -->
            <div class="card-custom">
                <div class="card-header-custom border-bottom">
                    <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:calendar-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                        2. Jadwal Kedatangan & Catatan Keluhan
                    </h6>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <!-- Tanggal Servis -->
                        <div class="col-12">
                            <label class="form-label text-xs fw-bold text-dark mb-1">Tanggal Rencana Servis <span class="text-danger">*</span></label>
                            <input type="date" class="form-control radius-8 text-sm <?= isset($errors['tgl_booking']) ? 'is-invalid' : '' ?>" name="tgl_booking" id="inputTglBooking" min="<?= date('Y-m-d') ?>" value="<?= old('tgl_booking', date('Y-m-d')) ?>" required>
                            <?php if (isset($errors['tgl_booking'])): ?>
                                <div class="invalid-feedback"><?= $errors['tgl_booking'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Jam Kedatangan (Pilihan Tombol Slot) -->
                        <div class="col-12 mt-3">
                            <label class="form-label text-xs fw-bold text-dark mb-2 d-flex align-items-center justify-content-between">
                                <span>Pilih Jam Kedatangan <span class="text-danger">*</span></span>
                                <span class="badge bg-primary-50 text-primary-600 text-xxs fw-bold" id="selectedTimeBadge">09:00 WIB</span>
                            </label>

                            <!-- Hidden Input for Form Submission -->
                            <input type="hidden" name="jam_booking" id="inputJamBooking" value="<?= old('jam_booking', '09:00') ?>" required>

                            <!-- Morning Slots -->
                            <div class="mb-2">
                                <span class="text-xxs text-secondary-light fw-bold text-uppercase d-block mb-1">Pagi Hari (08:00 - 11:00)</span>
                                <div class="row g-2">
                                    <?php 
                                        $pagiJams = ['08:00', '09:00', '10:00', '11:00'];
                                        foreach ($pagiJams as $jam):
                                            $slot = $todaySlots[$jam] ?? ['sisa_kuota' => 2, 'is_available' => true, 'is_full' => false, 'is_past' => false];
                                            $isAvail = $slot['is_available'];
                                    ?>
                                        <div class="col-6 col-sm-3">
                                            <button type="button" class="time-slot-btn <?= $jam === '09:00' && $isAvail ? 'active' : '' ?> <?= !$isAvail ? 'disabled-slot' : '' ?>" data-jam="<?= $jam ?>" <?= !$isAvail ? 'disabled' : '' ?>>
                                                <div class="slot-time">
                                                    <iconify-icon icon="solar:sun-2-bold-duotone" class="text-base"></iconify-icon>
                                                    <span><?= $jam ?> WIB</span>
                                                </div>
                                                <span class="slot-quota"><?= $slot['is_full'] ? 'Penuh' : ($slot['is_past'] ? 'Lewat' : 'Sisa ' . $slot['sisa_kuota']) ?></span>
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Afternoon Slots -->
                            <div>
                                <span class="text-xxs text-secondary-light fw-bold text-uppercase d-block mb-1">Siang - Sore Hari (13:00 - 16:00)</span>
                                <div class="row g-2">
                                    <?php 
                                        $soreJams = ['13:00', '14:00', '15:00', '16:00'];
                                        foreach ($soreJams as $jam):
                                            $slot = $todaySlots[$jam] ?? ['sisa_kuota' => 2, 'is_available' => true, 'is_full' => false, 'is_past' => false];
                                            $isAvail = $slot['is_available'];
                                    ?>
                                        <div class="col-6 col-sm-3">
                                            <button type="button" class="time-slot-btn <?= !$isAvail ? 'disabled-slot' : '' ?>" data-jam="<?= $jam ?>" <?= !$isAvail ? 'disabled' : '' ?>>
                                                <div class="slot-time">
                                                    <iconify-icon icon="solar:sun-fog-bold-duotone" class="text-base"></iconify-icon>
                                                    <span><?= $jam ?> WIB</span>
                                                </div>
                                                <span class="slot-quota"><?= $slot['is_full'] ? 'Penuh' : ($slot['is_past'] ? 'Lewat' : 'Sisa ' . $slot['sisa_kuota']) ?></span>
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <?php if (isset($errors['jam_booking'])): ?>
                                <div class="text-danger text-xxs mt-2 fw-semibold d-block"><?= $errors['jam_booking'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Catatan Keluhan Kerusakan / Kebutuhan Servis -->
                        <div class="col-12 mt-3">
                            <label class="form-label text-xs fw-bold text-dark mb-1">
                                Catatan Keluhan Kerusakan & Kebutuhan Servis <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control radius-8 text-sm <?= isset($errors['keluhan']) ? 'is-invalid' : '' ?>" name="keluhan" rows="4" placeholder="Tuliskan keluhan motor Anda secara jelas, misalnya:&#10;- Tarikan gas terasa berat dan mesin brebet&#10;- Rem depan bunyi berdecit saat ditekan&#10;- Ingin sekalian ganti oli mesin & oli gardan" required><?= old('keluhan') ?></textarea>
                            <small class="text-xxs text-secondary-light mt-1 d-block">
                                <iconify-icon icon="solar:info-circle-bold" class="text-xs me-1"></iconify-icon>
                                Mekanik kami akan melakukan pemeriksaan menyeluruh berdasarkan catatan keluhan ini saat motor Anda tiba di bengkel.
                            </small>
                            <?php if (isset($errors['keluhan'])): ?>
                                <div class="invalid-feedback"><?= $errors['keluhan'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Biaya Booking (DP) & Rekening Pembayaran -->
        <div class="col-lg-5">
            <div class="card-custom mb-20">
                <div class="card-header-custom border-bottom">
                    <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:wallet-money-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                        3. Biaya Booking & Rekening Transfer
                    </h6>
                </div>
                <div class="card-body-custom">
                    <!-- Total Biaya Booking / DP Card -->
                    <div class="p-20 radius-12 mb-20 text-white shadow-sm" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-xxs text-neutral-400 text-uppercase fw-bold">Biaya Booking Servis (DP):</span>
                            <span class="badge bg-warning-500 text-dark text-xxs fw-bold px-8 py-3 radius-4">Uang Muka Servis</span>
                        </div>
                        <h2 class="fw-extrabold mb-1" style="color: #ff5500;">Rp <?= number_format($biayaBooking, 0, ',', '.') ?></h2>
                        <span class="text-xxs text-neutral-300 d-block">Batas waktu transfer: <b><?= $durasiMenit ?> Menit</b> setelah klik tombol simpan.</span>
                    </div>

                    <!-- Ketentuan & Kebijakan DP Card -->
                    <div class="policy-card mb-20">
                        <div class="policy-card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="solar:shield-check-bold" style="color: #ff5500; font-size: 20px;"></iconify-icon>
                                <span class="fw-bold text-dark text-xs">Ketentuan Biaya Booking</span>
                            </div>
                        </div>
                        <div class="policy-card-body">
                            <!-- Item 1 -->
                            <div class="policy-item">
                                <div class="policy-icon-badge bg-primary-50 text-primary-600">
                                    <iconify-icon icon="solar:wallet-money-bold"></iconify-icon>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block mb-1">Uang Muka Sebagai Deposit</span>
                                    <p class="text-xxs text-secondary-light mb-0" style="line-height: 1.4;">
                                        Biaya <b>Rp <?= number_format($biayaBooking, 0, ',', '.') ?></b> langsung memotong total tagihan servis & sparepart Anda di bengkel.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="policy-item">
                                <div class="policy-icon-badge bg-warning-50 text-warning-700">
                                    <iconify-icon icon="solar:card-2-bold"></iconify-icon>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block mb-1">Jika Biaya Lebih dari Rp <?= number_format($biayaBooking, 0, ',', '.') ?></span>
                                    <p class="text-xxs text-secondary-light mb-0" style="line-height: 1.4;">
                                        Anda <b>hanya membayar kekurangannya</b> saat servis selesai di kasir bengkel.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="policy-item">
                                <div class="policy-icon-badge bg-success-50 text-success-600">
                                    <iconify-icon icon="solar:restart-circle-bold"></iconify-icon>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block mb-1">Jika Biaya Kurang dari Rp <?= number_format($biayaBooking, 0, ',', '.') ?></span>
                                    <p class="text-xxs text-secondary-light mb-0" style="line-height: 1.4;">
                                        Sisa kelebihan uang DP Anda <b>pasti dikembalikan 100%</b> oleh kasir bengkel.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pilihan Metode Pembayaran -->
                    <label class="form-label text-xs fw-bold text-dark mb-2">Pilih Rekening Tujuan Transfer <span class="text-danger">*</span></label>
                    <div class="d-flex flex-column gap-2 mb-20">
                        <label class="bank-card-box active d-flex align-items-center justify-content-between" for="payBca">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payBca" value="Transfer Bank BCA" checked>
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">Bank BCA (Transfer)</span>
                                    <span class="text-xxs text-secondary-light">No. Rek: <b class="text-dark">8245-1234-99</b> a.n Salsa Motor</span>
                                </div>
                            </div>
                            <span class="badge bg-primary-50 text-primary-600 text-xxs fw-bold px-8 py-4 radius-4">BCA</span>
                        </label>

                        <label class="bank-card-box d-flex align-items-center justify-content-between" for="payBri">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payBri" value="Transfer Bank BRI">
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">Bank BRI (Transfer)</span>
                                    <span class="text-xxs text-secondary-light">No. Rek: <b class="text-dark">0123-01-001234-53-8</b> a.n Salsa Motor</span>
                                </div>
                            </div>
                            <span class="badge bg-info-50 text-info-600 text-xxs fw-bold px-8 py-4 radius-4">BRI</span>
                        </label>

                        <label class="bank-card-box d-flex align-items-center justify-content-between" for="payMandiri">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payMandiri" value="Transfer Bank Mandiri">
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">Bank Mandiri (Transfer)</span>
                                    <span class="text-xxs text-secondary-light">No. Rek: <b class="text-dark">137-00-1928374-1</b> a.n Salsa Motor</span>
                                </div>
                            </div>
                            <span class="badge bg-warning-50 text-warning-600 text-xxs fw-bold px-8 py-4 radius-4">Mandiri</span>
                        </label>

                        <label class="bank-card-box d-flex align-items-center justify-content-between" for="payQris">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payQris" value="QRIS Salsa Motor">
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">QRIS All Payment (Gopay/OVO/Dana)</span>
                                    <span class="text-xxs text-secondary-light">Scan QRIS Nasional Instan</span>
                                </div>
                            </div>
                            <span class="badge bg-success-50 text-success-600 text-xxs fw-bold px-8 py-4 radius-4">QRIS</span>
                        </label>
                    </div>

                    <!-- Info Waktu 5 Menit -->
                    <div class="p-14 radius-10 mb-20 bg-warning-50 border border-warning-200">
                        <div class="d-flex align-items-start gap-2">
                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-xl text-warning-600 flex-shrink-0 mt-1"></iconify-icon>
                            <div>
                                <span class="fw-bold text-warning-700 text-xs d-block mb-1">Batas Waktu Transfer DP <?= $durasiMenit ?> Menit</span>
                                <small class="text-xxs text-neutral-600 d-block" style="line-height: 1.4;">
                                    Setelah formulir dikirim, Anda diberikan waktu <b><?= $durasiMenit ?> menit</b> untuk mentransfer DP Rp <?= number_format($biayaBooking, 0, ',', '.') ?> & mengunggah bukti pembayaran.
                                </small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-20 border-neutral-200">

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary-600 w-100 radius-8 py-12 text-sm fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <iconify-icon icon="solar:card-send-bold" class="text-lg"></iconify-icon>
                        <span>Simpan & Lanjutkan Pembayaran (Rp <?= number_format($biayaBooking, 0, ',', '.') ?>)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Toggle Active Class for Bank Selection Box
        $('input[name="metode_pembayaran"]').on('change', function() {
            $('.bank-card-box').removeClass('active');
            $(this).closest('.bank-card-box').addClass('active');
        });

        // Time Slot Selection Handling & Real-time Quota Fetching
        function updateTimeSlotsAvailability() {
            var selectedDate = $('#inputTglBooking').val();
            if (!selectedDate) return;

            var currentSelectedJam = $('#inputJamBooking').val();

            // Fetch live slot availability from backend
            $.ajax({
                url: "<?= site_url('booking/check-slots') ?>",
                type: "GET",
                data: { tanggal: selectedDate },
                dataType: "json",
                success: function(res) {
                    if (res && res.status && res.slots) {
                        var firstAvailableJam = null;
                        var isCurrentSelectedStillValid = false;

                        $('.time-slot-btn').each(function() {
                            var slotJam = $(this).data('jam');
                            var slotInfo = res.slots[slotJam];

                            if (slotInfo) {
                                var $quotaBadge = $(this).find('.slot-quota');

                                if (!slotInfo.is_available) {
                                    $(this).prop('disabled', true).addClass('disabled-slot');
                                    if (slotInfo.is_past) {
                                        $quotaBadge.text('Lewat').css({ 'background-color': '#f1f5f9', 'color': '#94a3b8' });
                                        $(this).attr('title', 'Jam ' + slotJam + ' WIB sudah lewat');
                                    } else if (slotInfo.is_full) {
                                        $quotaBadge.text('Penuh (' + slotInfo.booked_count + '/' + slotInfo.max_kuota + ')').css({ 'background-color': '#fee2e2', 'color': '#ef4444' });
                                        $(this).attr('title', 'Kuota booking jam ' + slotJam + ' WIB penuh (' + slotInfo.booked_count + '/' + slotInfo.max_kuota + ')');
                                    }
                                } else {
                                    $(this).prop('disabled', false).removeClass('disabled-slot');
                                    $quotaBadge.text('Sisa ' + slotInfo.sisa_kuota).css({ 'background-color': '', 'color': '' });
                                    $(this).attr('title', 'Tersedia ' + slotInfo.sisa_kuota + ' dari ' + slotInfo.max_kuota + ' kuota');

                                    if (!firstAvailableJam) {
                                        firstAvailableJam = slotJam;
                                    }
                                    if (slotJam === currentSelectedJam) {
                                        isCurrentSelectedStillValid = true;
                                    }
                                }
                            }
                        });

                        // Re-select valid slot
                        if (!isCurrentSelectedStillValid && firstAvailableJam) {
                            $('.time-slot-btn').removeClass('active');
                            var $btn = $('.time-slot-btn[data-jam="' + firstAvailableJam + '"]');
                            $btn.addClass('active');
                            $('#inputJamBooking').val(firstAvailableJam);
                            $('#selectedTimeBadge').text(firstAvailableJam + ' WIB');
                        } else if (!isCurrentSelectedStillValid && !firstAvailableJam) {
                            $('.time-slot-btn').removeClass('active');
                            $('#inputJamBooking').val('');
                            $('#selectedTimeBadge').text('Semua slot jam penuh/lewat. Pilih tanggal lain.');
                        }
                    }
                }
            });
        }

        // Handle Slot Button Click
        $(document).on('click', '.time-slot-btn', function() {
            if ($(this).prop('disabled') || $(this).hasClass('disabled-slot')) return;
            $('.time-slot-btn').removeClass('active');
            $(this).addClass('active');
            var jam = $(this).data('jam');
            $('#inputJamBooking').val(jam);
            $('#selectedTimeBadge').text(jam + ' WIB');
        });

        // Trigger date change check
        $('#inputTglBooking').on('change', function() {
            updateTimeSlotsAvailability();
        });

        // Initial check on load
        updateTimeSlotsAvailability();
    });
</script>
<?= $this->endSection() ?>