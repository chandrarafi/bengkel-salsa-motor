<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h6 class="fw-bold text-dark mb-1">Pengaturan Booking & Kuota Jam Kedatangan</h6>
        <p class="text-xs text-secondary-light mb-0">Kelola durasi batas pembayaran transfer dan kapasitas kuota maksimal antrean per jam kedatangan.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= site_url('admin/booking') ?>" class="btn btn-outline-neutral-700 bg-white radius-8 px-16 py-8 text-xs fw-bold d-inline-flex align-items-center gap-2 border">
            <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
            Kembali ke Daftar Booking
        </a>
    </div>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-20 alert alert-success bg-success-50 text-success-700 border border-success-200 px-16 py-12 radius-8 d-flex align-items-center justify-content-between text-xs" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:check-circle-fill" class="text-base text-success-600"></iconify-icon>
            <span><?= session()->getFlashdata('success') ?></span>
        </div>
        <button type="button" class="btn-close text-xs" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-20 alert alert-danger bg-danger-50 text-danger-700 border border-danger-200 px-16 py-12 radius-8 d-flex align-items-center justify-content-between text-xs" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="text-base text-danger-600"></iconify-icon>
            <span><?= session()->getFlashdata('error') ?></span>
        </div>
        <button type="button" class="btn-close text-xs" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="<?= site_url('admin/booking/setting/update') ?>" method="post">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Kolom Kiri: Durasi & Nominal DP -->
        <div class="col-lg-5">
            <div class="card radius-12 border">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14 bg-neutral-50">
                    <h6 class="card-title mb-0 text-sm fw-bold d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-primary-600 text-lg"></iconify-icon>
                        Durasi Pembayaran & Biaya DP
                    </h6>
                </div>
                <div class="card-body p-20">
                    <!-- Durasi Pembayaran -->
                    <div class="mb-20">
                        <label class="form-label text-xs fw-bold text-dark mb-1">
                            Batas Waktu Pembayaran (Menit) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" name="durasi_pembayaran_menit" class="form-control radius-start-8 text-sm fw-bold <?= isset($errors['durasi_pembayaran_menit']) ? 'is-invalid' : '' ?>" value="<?= old('durasi_pembayaran_menit', $setting['durasi_pembayaran_menit'] ?? 5) ?>" min="1" max="180" required>
                            <span class="input-group-text bg-neutral-100 text-dark fw-bold text-xs">Menit</span>
                        </div>
                        <small class="text-xxs text-secondary-light mt-1 d-block">
                            Waktu hitung mundur bagi pelanggan untuk transfer & unggah struk. Jika habis, booking otomatis berstatus <b>Dibatalkan</b>.
                        </small>
                        <?php if (isset($errors['durasi_pembayaran_menit'])): ?>
                            <div class="text-danger text-xxs mt-1"><?= $errors['durasi_pembayaran_menit'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Nominal Biaya Booking / DP -->
                    <div class="mb-20">
                        <label class="form-label text-xs fw-bold text-dark mb-1">
                            Nominal Biaya Booking / DP (Rp) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-neutral-100 text-dark fw-bold text-xs">Rp</span>
                            <input type="number" name="biaya_booking" class="form-control radius-end-8 text-sm fw-bold <?= isset($errors['biaya_booking']) ? 'is-invalid' : '' ?>" value="<?= old('biaya_booking', (int)($setting['biaya_booking'] ?? 50000)) ?>" min="0" step="1000" required>
                        </div>
                        <small class="text-xxs text-secondary-light mt-1 d-block">
                            Uang muka deposit yang memotong total biaya servis sebenarnya di bengkel.
                        </small>
                        <?php if (isset($errors['biaya_booking'])): ?>
                            <div class="text-danger text-xxs mt-1"><?= $errors['biaya_booking'] ?></div>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Kuota Slot Jam Kedatangan -->
        <div class="col-lg-7">
            <div class="card radius-12 border">
                <div class="card-header border-bottom border-neutral-200 px-20 py-14 bg-neutral-50 d-flex align-items-center justify-content-between">
                    <h6 class="card-title mb-0 text-sm fw-bold d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:calendar-bold-duotone" class="text-primary-600 text-lg"></iconify-icon>
                        Kuota Antrean per Jam Kedatangan
                    </h6>
                    <span class="badge bg-neutral-200 text-dark text-xxs fw-bold px-8 py-4 radius-4">8 Slot Operasional</span>
                </div>
                <div class="card-body p-20">
                    <div class="alert alert-warning bg-warning-50 border border-warning-200 p-12 radius-8 mb-20 text-xs text-warning-800 d-flex align-items-start gap-2">
                        <iconify-icon icon="solar:shield-warning-bold" class="text-lg text-warning-600 flex-shrink-0 mt-1"></iconify-icon>
                        <span>Tentukan kapasitas maksimal motor yang dapat diterima pada setiap jam. Jika jumlah booking pada jam tersebut telah mencapai kuota, tombol slot jam di formulir pelanggan otomatis <b>Penuh (Disabled)</b>.</span>
                    </div>

                    <!-- Slot Pagi Hari -->
                    <div class="mb-20">
                        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-12 d-flex align-items-center gap-1">
                            <iconify-icon icon="solar:sun-2-bold-duotone" class="text-warning-main"></iconify-icon>
                            Slot Pagi Hari (08:00 - 11:00)
                        </h6>
                        <div class="row g-3">
                            <?php
                            $pagiSlots = ['08:00', '09:00', '10:00', '11:00'];
                            foreach ($pagiSlots as $jam):
                                $currVal = $setting['slots'][$jam] ?? 2;
                            ?>
                                <div class="col-6 col-sm-3">
                                    <div class="p-12 radius-8 border bg-neutral-50 text-center">
                                        <span class="fw-bold text-dark text-xs d-block mb-1"><?= $jam ?> WIB</span>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="slot_kuota[<?= $jam ?>]" class="form-control text-center fw-bold text-primary-600" value="<?= $currVal ?>" min="1" max="50" required>
                                        </div>
                                        <small class="text-xxs text-secondary-light mt-1 d-block">Motor / Jam</small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Slot Siang - Sore Hari -->
                    <div class="mb-20">
                        <h6 class="text-xs fw-bold text-uppercase text-secondary-light mb-12 d-flex align-items-center gap-1">
                            <iconify-icon icon="solar:sun-fog-bold-duotone" class="text-warning-main"></iconify-icon>
                            Slot Siang - Sore Hari (13:00 - 16:00)
                        </h6>
                        <div class="row g-3">
                            <?php
                            $soreSlots = ['13:00', '14:00', '15:00', '16:00'];
                            foreach ($soreSlots as $jam):
                                $currVal = $setting['slots'][$jam] ?? 2;
                            ?>
                                <div class="col-6 col-sm-3">
                                    <div class="p-12 radius-8 border bg-neutral-50 text-center">
                                        <span class="fw-bold text-dark text-xs d-block mb-1"><?= $jam ?> WIB</span>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="slot_kuota[<?= $jam ?>]" class="form-control text-center fw-bold text-primary-600" value="<?= $currVal ?>" min="1" max="50" required>
                                        </div>
                                        <small class="text-xxs text-secondary-light mt-1 d-block">Motor / Jam</small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-12 border-top">
                        <button type="reset" class="btn btn-outline-neutral-700 text-dark radius-8 px-16 py-10 text-xs fw-bold">
                            Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-10 text-xs fw-bold d-inline-flex align-items-center gap-2 shadow-sm">
                            <iconify-icon icon="solar:diskette-bold" class="text-base"></iconify-icon>
                            Simpan Perubahan Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>