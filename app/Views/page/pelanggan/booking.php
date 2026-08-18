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

    .bank-card-box:hover, .bank-card-box.active {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.03);
    }

    /* Wowdash Upload Image */
    .upload-image-wrapper {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
    }

    .uploaded-img {
        width: 120px;
        height: 120px;
        min-width: 120px;
        min-height: 120px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px dashed #cbd5e1;
        background-color: #ffffff;
        position: relative;
    }

    .upload-file {
        width: 120px;
        height: 120px;
        min-width: 120px;
        min-height: 120px;
        border-radius: 10px;
        border: 2px dashed #cbd5e1;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }

    .upload-file:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.04);
    }

    /* Time Slot Buttons */
    .time-slot-btn {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 8px;
        font-size: 0.8125rem;
        font-weight: 700;
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
        width: 100%;
    }

    .time-slot-btn:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.04);
        color: #ff5500;
    }

    .time-slot-btn.active {
        background-color: #ff5500 !important;
        border-color: #ff5500 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(255, 85, 0, 0.28);
    }

    .time-slot-btn:disabled, .time-slot-btn.disabled-slot {
        background-color: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
        color: #94a3b8 !important;
        cursor: not-allowed !important;
        opacity: 0.5;
        box-shadow: none !important;
        text-decoration: line-through;
        pointer-events: none;
    }

    /* Selected Service Item */
    .selected-service-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        transition: all 0.2s ease;
    }

    .selected-service-item:hover {
        border-color: #cbd5e1;
        background: #f1f5f9;
    }

    /* Modal Service Item */
    .modal-service-row {
        padding: 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        background: #ffffff;
    }

    .modal-service-row:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.02);
    }

    .modal-service-row.checked-row {
        border: 2px solid #ff5500 !important;
        background-color: rgba(255, 85, 0, 0.04) !important;
        box-shadow: 0 2px 8px rgba(255, 85, 0, 0.08);
    }

    .modal-service-row .badge-kode {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        letter-spacing: 0.02em;
    }
</style>

<!-- Page Title & Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h4 class="fw-bold text-dark mb-1">Formulir Booking Servis Motor</h4>
        <p class="text-xs text-secondary-light mb-0">Pesan antrean servis secara online, lakukan pembayaran, dan unggah bukti transfer untuk konfirmasi instan.</p>
    </div>
    <a href="<?= site_url('riwayat-booking') ?>" class="btn btn-outline-neutral-700 text-dark radius-8 px-16 py-8 text-xs fw-bold d-inline-flex align-items-center gap-2 bg-white border">
        <iconify-icon icon="solar:calendar-mark-bold-duotone" style="color: #ff5500;" class="text-base"></iconify-icon>
        Lihat Riwayat Booking Saya
    </a>
</div>

<form action="<?= site_url('pelanggan/booking/simpan') ?>" method="post" enctype="multipart/form-data" id="formBookingServis">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Left Side: Data Kendaraan & Jadwal Servis -->
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
                                <input type="text" class="form-control radius-8 text-sm <?= isset($errors['merkkendaraan']) ? 'is-invalid' : '' ?>" name="merkkendaraan" placeholder="Contoh: Honda Vario 160 / Yamaha NMAX" value="<?= old('merkkendaraan') ?>" required>
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

            <!-- Card 2: Pilihan Paket Servis & Waktu Kedatangan -->
            <div class="card-custom">
                <div class="card-header-custom border-bottom">
                    <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:calendar-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                        2. Paket Servis & Waktu Kedatangan
                    </h6>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <!-- Paket Servis (Multi-select via Modal) -->
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label text-xs fw-bold text-dark mb-0">
                                    Paket Layanan Servis <span class="text-danger">*</span>
                                    <small class="text-muted fw-normal ms-1">(Bisa pilih lebih dari 1)</small>
                                </label>
                                <button type="button" class="btn btn-outline-neutral-700 bg-white text-dark btn-sm radius-6 px-12 py-4 text-xxs fw-bold d-inline-flex align-items-center gap-1 border" data-bs-toggle="modal" data-bs-target="#modalPilihServis">
                                    <iconify-icon icon="solar:magnifer-linear" style="color: #ff5500;" class="text-sm"></iconify-icon>
                                    Cari & Pilih Layanan
                                </button>
                            </div>

                            <!-- Selected Services Container -->
                            <div id="selectedServicesList" class="d-flex flex-column gap-2 mb-2">
                                <!-- Populated dynamically by JS -->
                            </div>

                            <!-- Empty State when no service selected -->
                            <div id="emptyServiceAlert" class="p-20 radius-10 border border-dashed text-center bg-light">
                                <iconify-icon icon="solar:wrench-bold-duotone" class="text-3xl text-secondary-light mb-2"></iconify-icon>
                                <p class="text-xs text-secondary-light mb-2">Belum ada layanan servis yang dipilih.</p>
                                <button type="button" class="btn btn-brand btn-sm radius-6 px-16 py-6 text-xs fw-bold d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalPilihServis">
                                    <iconify-icon icon="solar:add-circle-bold"></iconify-icon>
                                    Pilih Paket Layanan Servis
                                </button>
                            </div>

                            <?php if (isset($errors['kodeservis'])): ?>
                                <div class="text-danger text-xxs mt-2 fw-semibold d-block"><?= $errors['kodeservis'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Tanggal Servis -->
                        <div class="col-12 mt-3">
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
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="08:00">
                                            <iconify-icon icon="solar:sun-2-bold-duotone" class="text-base"></iconify-icon>
                                            <span>08:00 WIB</span>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn active" data-jam="09:00">
                                            <iconify-icon icon="solar:sun-2-bold-duotone" class="text-base"></iconify-icon>
                                            <span>09:00 WIB</span>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="10:00">
                                            <iconify-icon icon="solar:sun-2-bold-duotone" class="text-base"></iconify-icon>
                                            <span>10:00 WIB</span>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="11:00">
                                            <iconify-icon icon="solar:sun-2-bold-duotone" class="text-base"></iconify-icon>
                                            <span>11:00 WIB</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Afternoon Slots -->
                            <div>
                                <span class="text-xxs text-secondary-light fw-bold text-uppercase d-block mb-1">Siang - Sore Hari (13:00 - 16:00)</span>
                                <div class="row g-2">
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="13:00">
                                            <iconify-icon icon="solar:sun-fog-bold-duotone" class="text-base"></iconify-icon>
                                            <span>13:00 WIB</span>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="14:00">
                                            <iconify-icon icon="solar:sun-fog-bold-duotone" class="text-base"></iconify-icon>
                                            <span>14:00 WIB</span>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="15:00">
                                            <iconify-icon icon="solar:sun-fog-bold-duotone" class="text-base"></iconify-icon>
                                            <span>15:00 WIB</span>
                                        </button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="time-slot-btn" data-jam="16:00">
                                            <iconify-icon icon="solar:sun-fog-bold-duotone" class="text-base"></iconify-icon>
                                            <span>16:00 WIB</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php if (isset($errors['jam_booking'])): ?>
                                <div class="text-danger text-xxs mt-2 fw-semibold d-block"><?= $errors['jam_booking'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Catatan / Keluhan -->
                        <div class="col-12 mt-3">
                            <label class="form-label text-xs fw-bold text-dark mb-1">Catatan Keluhan Motor (Opsional)</label>
                            <textarea class="form-control radius-8 text-sm" name="keluhan" rows="3" placeholder="Contoh: Rem belakang berdecit, tarikan agak berat, ganti oli sekalian..."><?= old('keluhan') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Pembayaran & Upload Bukti Transfer -->
        <div class="col-lg-5">
            <div class="card-custom mb-20">
                <div class="card-header-custom border-bottom">
                    <h6 class="text-sm fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:wallet-money-bold-duotone" style="color: #ff5500;" class="text-lg"></iconify-icon>
                        3. Pembayaran & Upload Bukti
                    </h6>
                </div>
                <div class="card-body-custom">
                    <!-- Total DP Estimasi Booking Summary -->
                    <div class="p-16 radius-10 mb-20 text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-xxs text-neutral-400 text-uppercase fw-bold">DP Estimasi Booking:</span>
                            <span class="badge bg-secondary-700 text-neutral-300 text-xxs" id="selectedServicesCountBadge">0 Layanan</span>
                        </div>
                        <h3 class="fw-bold mb-0" id="displayTotalBiaya" style="color: #ff5500;">Rp 0</h3>
                        <small class="text-xxs text-neutral-400 d-block mt-1">*Pembayaran online ini adalah DP estimasi booking. Total biaya servis & sparepart sebenarnya dihitung di bengkel setelah pengerjaan selesai.</small>
                    </div>

                    <!-- Pilihan Metode Pembayaran -->
                    <label class="form-label text-xs fw-bold text-dark mb-2">Pilih Rekening Tujuan Transfer</label>
                    <div class="d-flex flex-column gap-2 mb-20">
                        <label class="bank-card-box active d-flex align-items-center justify-content-between" for="payBca">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payBca" value="Transfer Bank BCA" checked>
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">Bank BCA (Transfer)</span>
                                    <span class="text-xxs text-secondary-light">No. Rek: <b class="text-dark">8245-1234-99</b> a.n Salsa Motor</span>
                                </div>
                            </div>
                            <span class="badge bg-primary-50 text-primary-600 text-xxs fw-bold">BCA</span>
                        </label>

                        <label class="bank-card-box d-flex align-items-center justify-content-between" for="payBri">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payBri" value="Transfer Bank BRI">
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">Bank BRI (Transfer)</span>
                                    <span class="text-xxs text-secondary-light">No. Rek: <b class="text-dark">0123-0100-8888-501</b> a.n Salsa Motor</span>
                                </div>
                            </div>
                            <span class="badge bg-success-50 text-success-600 text-xxs fw-bold">BRI</span>
                        </label>

                        <label class="bank-card-box d-flex align-items-center justify-content-between" for="payQris">
                            <div class="d-flex align-items-center gap-3">
                                <input class="form-check-input mt-0" type="radio" name="metode_pembayaran" id="payQris" value="QRIS / E-Wallet (GoPay, OVO, Dana)">
                                <div>
                                    <span class="fw-bold text-dark text-xs d-block">QRIS All Payment</span>
                                    <span class="text-xxs text-secondary-light">GoPay, OVO, Dana, ShopeePay</span>
                                </div>
                            </div>
                            <span class="badge bg-warning-50 text-warning-600 text-xxs fw-bold">QRIS</span>
                        </label>
                    </div>

                    <!-- Info Pembayaran Selanjutnya -->
                    <div class="p-14 radius-10 mb-20 bg-warning-50 border border-warning-200">
                        <div class="d-flex align-items-start gap-2">
                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-xl text-warning-600 flex-shrink-0 mt-1"></iconify-icon>
                            <div>
                                <span class="fw-bold text-warning-700 text-xs d-block mb-1">Batas Waktu Transfer DP 5 Menit</span>
                                <small class="text-xxs text-neutral-600 d-block" style="line-height: 1.4;">
                                    Setelah data disimpan, Anda diberikan waktu <b>5 menit</b> untuk mentransfer DP & mengunggah bukti pembayaran sebelum booking kadaluarsa secara otomatis.
                                </small>
                            </div>
                        </div>
                    </div>

                    <hr class="my-20 border-neutral-200">

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-brand w-100 radius-8 py-12 text-sm fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <iconify-icon icon="solar:wallet-money-bold" class="text-lg"></iconify-icon>
                        <span>Simpan & Lanjutkan Pembayaran</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL CARI & PILIH LAYANAN SERVIS (MULTI-SELECT) -->
<div class="modal fade" id="modalPilihServis" tabindex="-1" aria-labelledby="modalPilihServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content radius-16 border-0 shadow-lg">
            <div class="modal-header border-bottom px-24 py-16 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="modal-title fw-bold mb-1 d-flex align-items-center gap-2" id="modalPilihServisLabel" style="color: #0f172a !important; font-size: 16px !important;">
                        <iconify-icon icon="solar:wrench-bold-duotone" style="color: #ff5500; font-size: 20px;"></iconify-icon>
                        <span>Pilih Paket Layanan Servis</span>
                    </h6>
                    <p class="text-xs text-secondary-light mb-0">Centang satu atau beberapa layanan yang diinginkan untuk motor Anda.</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Search Bar in Modal -->
            <div class="px-24 py-12 bg-light border-bottom">
                <div class="position-relative">
                    <span class="position-absolute top-50 start-0 translate-middle-y ms-12 text-secondary-light d-flex align-items-center">
                        <iconify-icon icon="solar:magnifer-linear" style="font-size: 18px;"></iconify-icon>
                    </span>
                    <input type="text" class="form-control radius-8 text-xs ps-36 py-8" id="searchServisInput" placeholder="Cari nama atau kode layanan (contoh: Injeksi, Ganti Oli, Rem)...">
                </div>
            </div>

            <div class="modal-body px-24 py-16">
                <div id="modalServicesList">
                    <?php if (!empty($daftarServis)): ?>
                        <?php foreach ($daftarServis as $s): 
                            $kode = $s['kodeservis'];
                            $nama = $s['jenis_servis'] ?? $s['Jenis_servis'] ?? '';
                            $biaya = (float)($s['biaya'] ?? $s['Biaya'] ?? 0);
                            $waktu = $s['estimasi_waktu'] ?? 30;
                            $desc = $s['keterangan'] ?? 'Pemeriksaan dan perawatan standar bengkel.';
                        ?>
                            <div class="modal-service-row" data-kode="<?= esc($kode) ?>" data-nama="<?= esc($nama) ?>" data-biaya="<?= $biaya ?>" data-waktu="<?= esc($waktu) ?>" data-search="<?= strtolower($kode . ' ' . $nama . ' ' . $desc) ?>">
                                <div class="d-flex align-items-start gap-3 flex-grow-1">
                                    <input class="form-check-input mt-1 modal-servis-checkbox flex-shrink-0" type="checkbox" value="<?= esc($kode) ?>" id="chk_<?= esc($kode) ?>" style="cursor: pointer; width: 20px; height: 20px;">
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                            <span class="badge px-8 py-3 text-xxs fw-bold radius-4 me-1" style="background-color: #e2e8f0; color: #1e293b !important; border: 1px solid #cbd5e1;"><?= esc($kode) ?></span>
                                            <h6 class="text-sm fw-bold text-dark mb-0"><?= esc($nama) ?></h6>
                                        </div>
                                        <p class="text-xs text-secondary-light mb-0" style="line-height: 1.4;"><?= esc($desc) ?></p>
                                    </div>
                                </div>
                                <div class="text-end flex-shrink-0 ps-2" style="min-width: 110px;">
                                    <span class="badge radius-6 px-8 py-3 text-xxs fw-bold mb-2 d-inline-flex align-items-center gap-1" style="background: rgba(255, 85, 0, 0.08); color: #ff5500;">
                                        <iconify-icon icon="solar:clock-circle-bold-duotone" style="font-size: 13px;"></iconify-icon>
                                        <?= esc($waktu) ?> Menit
                                    </span>
                                    <span class="fw-extrabold text-dark text-sm d-block text-nowrap" style="font-size: 15px; color: #0f172a !important;">Rp <?= number_format($biaya, 0, ',', '.') ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center py-4 text-xs">Tidak ada data layanan servis.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="modal-footer border-top px-24 py-14 d-flex align-items-center justify-content-between bg-light">
                <div>
                    <span class="text-xxs text-secondary-light d-block">Total Terpilih:</span>
                    <span class="text-xs fw-bold text-dark"><span id="modalSelectedCount">0</span> Layanan (<span id="modalSelectedTotal" style="color: #ff5500;">Rp 0</span>)</span>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-neutral-700 bg-white text-dark btn-sm radius-6 px-16 py-8 text-xs fw-bold border" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-brand btn-sm radius-6 px-20 py-8 text-xs fw-bold d-inline-flex align-items-center gap-1" id="btnApplyModalServices">
                        <iconify-icon icon="solar:check-circle-bold" class="text-base"></iconify-icon>
                        Terapkan Pilihan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data store for all services
        const allServices = <?= json_encode(array_map(function($s) {
            return [
                'kode'  => $s['kodeservis'],
                'nama'  => $s['jenis_servis'] ?? $s['Jenis_servis'] ?? '',
                'biaya' => (float)($s['biaya'] ?? $s['Biaya'] ?? 0),
                'waktu' => $s['estimasi_waktu'] ?? 30,
            ];
        }, $daftarServis ?? [])) ?>;

        // Set of selected service codes
        let selectedServiceCodes = new Set();

        // Initial preselect only from query parameter ?kodeservis=...
        const urlParams = new URLSearchParams(window.location.search);
        const preselectCode = urlParams.get('kodeservis');
        if (preselectCode) {
            selectedServiceCodes.add(preselectCode);
        }

        const selectedServicesList = document.getElementById("selectedServicesList");
        const emptyServiceAlert = document.getElementById("emptyServiceAlert");
        const displayTotalBiaya = document.getElementById("displayTotalBiaya");
        const selectedServicesCountBadge = document.getElementById("selectedServicesCountBadge");

        // Function to render selected services in the form
        function renderSelectedServices() {
            selectedServicesList.innerHTML = "";
            let total = 0;
            let count = 0;

            if (selectedServiceCodes.size === 0) {
                emptyServiceAlert.classList.remove("d-none");
            } else {
                emptyServiceAlert.classList.add("d-none");

                allServices.forEach(s => {
                    if (selectedServiceCodes.has(s.kode)) {
                        count++;
                        total += s.biaya;

                        const item = document.createElement("div");
                        item.className = "selected-service-item";
                        item.innerHTML = `
                            <div class="d-flex align-items-center gap-2 flex-grow-1">
                                <span class="badge px-8 py-3 text-xxs fw-bold radius-4" style="background-color: #e2e8f0; color: #1e293b !important; border: 1px solid #cbd5e1;">${s.kode}</span>
                                <div>
                                    <span class="text-xs fw-bold text-dark d-block">${s.nama}</span>
                                    <small class="text-xxs text-secondary-light">Estimasi: ${s.waktu} Menit</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="fw-bold text-dark text-xs text-nowrap" style="color: #0f172a !important;">Rp ${s.biaya.toLocaleString('id-ID')}</span>
                                <button type="button" class="btn btn-outline-danger btn-sm p-1 rounded-circle d-flex align-items-center justify-content-center btn-remove-service" data-kode="${s.kode}" title="Hapus layanan" style="width: 26px; height: 26px;">
                                    <iconify-icon icon="solar:trash-bin-trash-bold" class="text-xs"></iconify-icon>
                                </button>
                                <input type="hidden" name="kodeservis[]" value="${s.kode}">
                            </div>
                        `;
                        selectedServicesList.appendChild(item);
                    }
                });
            }

            displayTotalBiaya.innerText = 'Rp ' + total.toLocaleString('id-ID');
            selectedServicesCountBadge.innerText = count + ' Layanan';
            syncModalCheckboxes();
        }

        // Remove service handler
        selectedServicesList.addEventListener("click", function(e) {
            const btn = e.target.closest(".btn-remove-service");
            if (btn) {
                const kode = btn.getAttribute("data-kode");
                selectedServiceCodes.delete(kode);
                renderSelectedServices();
            }
        });

        // Sync checkboxes in modal with selectedServiceCodes
        function syncModalCheckboxes() {
            let modalTotal = 0;
            let modalCount = 0;

            document.querySelectorAll(".modal-service-row").forEach(row => {
                const kode = row.getAttribute("data-kode");
                const chk = row.querySelector(".modal-servis-checkbox");
                const biaya = parseFloat(row.getAttribute("data-biaya") || 0);

                if (selectedServiceCodes.has(kode)) {
                    chk.checked = true;
                    row.classList.add("checked-row");
                    modalCount++;
                    modalTotal += biaya;
                } else {
                    chk.checked = false;
                    row.classList.remove("checked-row");
                }
            });

            document.getElementById("modalSelectedCount").innerText = modalCount;
            document.getElementById("modalSelectedTotal").innerText = 'Rp ' + modalTotal.toLocaleString('id-ID');
        }

        // Clicking modal row toggles checkbox
        document.querySelectorAll(".modal-service-row").forEach(row => {
            row.addEventListener("click", function(e) {
                if (e.target.tagName !== 'INPUT') {
                    const chk = this.querySelector(".modal-servis-checkbox");
                    chk.checked = !chk.checked;
                }
                const kode = this.getAttribute("data-kode");
                const chk = this.querySelector(".modal-servis-checkbox");
                if (chk.checked) {
                    selectedServiceCodes.add(kode);
                } else {
                    selectedServiceCodes.delete(kode);
                }
                syncModalCheckboxes();
            });
        });

        // Search in modal
        const searchInput = document.getElementById("searchServisInput");
        if (searchInput) {
            searchInput.addEventListener("input", function() {
                const q = this.value.toLowerCase().trim();
                document.querySelectorAll(".modal-service-row").forEach(row => {
                    const searchData = row.getAttribute("data-search");
                    if (searchData.indexOf(q) !== -1) {
                        row.classList.remove("d-none");
                    } else {
                        row.classList.add("d-none");
                    }
                });
            });
        }

        // Apply modal button
        document.getElementById("btnApplyModalServices").addEventListener("click", function() {
            renderSelectedServices();
            const modalEl = document.getElementById("modalPilihServis");
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
                modalInstance.hide();
            }
        });

        // Initial render
        renderSelectedServices();

        // -------------------------------------------------------------
        // TIME SLOT BUTTONS SELECTOR & DISABLING PAST SLOTS FOR TODAY
        // -------------------------------------------------------------
        const timeSlotBtns = document.querySelectorAll(".time-slot-btn");
        const inputJamBooking = document.getElementById("inputJamBooking");
        const selectedTimeBadge = document.getElementById("selectedTimeBadge");
        const inputTglBooking = document.getElementById("inputTglBooking");

        function updateAvailableTimeSlots() {
            if (!inputTglBooking) return;

            const selectedDate = inputTglBooking.value;
            const now = new Date();
            
            // Format YYYY-MM-DD in Asia/Jakarta timezone
            const todayStr = new Intl.DateTimeFormat('en-CA', { timeZone: 'Asia/Jakarta' }).format(now);
            // Format HH:mm in Asia/Jakarta timezone
            const nowTimeStr = new Intl.DateTimeFormat('id-ID', { 
                timeZone: 'Asia/Jakarta', 
                hour12: false, 
                hour: '2-digit', 
                minute: '2-digit' 
            }).format(now).replace('.', ':');

            const isToday = (selectedDate === todayStr);

            let firstValidSlot = null;

            timeSlotBtns.forEach(btn => {
                const jamSlot = btn.getAttribute("data-jam");
                
                // If today and slot time is past (<= nowTimeStr), disable it
                if (isToday && jamSlot <= nowTimeStr) {
                    btn.disabled = true;
                    btn.classList.add("disabled-slot");
                    btn.classList.remove("active");
                    btn.setAttribute("title", "Jam " + jamSlot + " WIB sudah lewat untuk hari ini");
                } else {
                    btn.disabled = false;
                    btn.classList.remove("disabled-slot");
                    btn.removeAttribute("title");
                    if (!firstValidSlot) {
                        firstValidSlot = btn;
                    }
                }
            });

            // Check if currently selected slot is disabled
            const currentJam = inputJamBooking.value;
            const currentActiveBtn = Array.from(timeSlotBtns).find(b => b.getAttribute("data-jam") === currentJam);

            if (!currentActiveBtn || currentActiveBtn.disabled) {
                if (firstValidSlot) {
                    timeSlotBtns.forEach(b => b.classList.remove("active"));
                    firstValidSlot.classList.add("active");
                    const newJam = firstValidSlot.getAttribute("data-jam");
                    inputJamBooking.value = newJam;
                    if (selectedTimeBadge) {
                        selectedTimeBadge.innerText = newJam + ' WIB';
                        selectedTimeBadge.className = "badge bg-primary-50 text-primary-600 text-xxs fw-bold";
                    }
                } else {
                    timeSlotBtns.forEach(b => b.classList.remove("active"));
                    inputJamBooking.value = "";
                    if (selectedTimeBadge) {
                        selectedTimeBadge.innerText = "Slot Hari Ini Habis";
                        selectedTimeBadge.className = "badge bg-danger-50 text-danger-600 text-xxs fw-bold";
                    }
                }
            } else {
                if (selectedTimeBadge) {
                    selectedTimeBadge.className = "badge bg-primary-50 text-primary-600 text-xxs fw-bold";
                }
            }
        }

        timeSlotBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                if (this.disabled) return;
                timeSlotBtns.forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                const jam = this.getAttribute("data-jam");
                inputJamBooking.value = jam;
                if (selectedTimeBadge) {
                    selectedTimeBadge.innerText = jam + ' WIB';
                    selectedTimeBadge.className = "badge bg-primary-50 text-primary-600 text-xxs fw-bold";
                }
            });
        });

        if (inputTglBooking) {
            inputTglBooking.addEventListener("change", updateAvailableTimeSlots);
            inputTglBooking.addEventListener("input", updateAvailableTimeSlots);
        }

        // Run initial check
        updateAvailableTimeSlots();

        // -------------------------------------------------------------
        // PAYMENT METHOD CARDS
        // -------------------------------------------------------------
        const bankBoxes = document.querySelectorAll(".bank-card-box");
        bankBoxes.forEach(box => {
            box.addEventListener("click", function() {
                bankBoxes.forEach(b => b.classList.remove("active"));
                this.classList.add("active");
            });
        });

        // -------------------------------------------------------------
        // WOWDASH UPLOAD IMAGE JS
        // -------------------------------------------------------------
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
    });
</script>
<?= $this->endSection() ?>
