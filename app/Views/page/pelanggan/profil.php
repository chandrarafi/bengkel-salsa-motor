<?= $this->extend('page/pelanggan/layout') ?>

<?= $this->section('content') ?>

<style>
    /* Profile Avatar Styling */
    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 14px;
    }

    .profile-avatar-circle {
        width: 90px !important;
        height: 90px !important;
        min-width: 90px !important;
        min-height: 90px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 34px !important;
        font-weight: 800 !important;
        color: #ffffff !important;
        background: linear-gradient(135deg, #ff5500 0%, #d94800 100%) !important;
        box-shadow: 0 6px 16px rgba(255, 85, 0, 0.3) !important;
        border: 3px solid #ffffff !important;
        margin: 0 auto;
    }

    .profile-avatar-img {
        width: 90px !important;
        height: 90px !important;
        min-width: 90px !important;
        min-height: 90px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        border: 3px solid #ffffff !important;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1) !important;
        margin: 0 auto;
        display: block;
    }

    .profile-online-badge {
        position: absolute;
        bottom: 2px;
        right: 4px;
        width: 16px;
        height: 16px;
        background-color: #10b981;
        border: 2px solid #ffffff;
        border-radius: 50%;
    }

    /* Tab Pills Custom */
    .customer-tab-nav .nav-link {
        color: #64748b !important;
        background-color: #f1f5f9 !important;
        font-weight: 700 !important;
        font-size: 0.8125rem !important;
        padding: 9px 18px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        border: 1px solid #e2e8f0 !important;
        transition: all 0.2s ease !important;
        line-height: 1 !important;
    }

    .customer-tab-nav .nav-link iconify-icon {
        font-size: 1.1rem !important;
        line-height: 1 !important;
    }

    .customer-tab-nav .nav-link:hover {
        color: #ff5500 !important;
        background-color: #ffffff !important;
        border-color: #cbd5e1 !important;
    }

    .customer-tab-nav .nav-link.active {
        color: #ffffff !important;
        background-color: #ff5500 !important;
        border-color: #ff5500 !important;
        box-shadow: 0 4px 12px rgba(255, 85, 0, 0.28) !important;
    }

    /* Action Buttons Icon Alignment */
    .btn-action-custom {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        line-height: 1.2 !important;
    }

    .btn-action-custom iconify-icon {
        font-size: 1.15rem !important;
        display: flex !important;
        align-items: center !important;
    }

    /* Wowdash Upload Image Component */
    .upload-image-wrapper {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
    }

    .uploaded-img {
        width: 100px;
        height: 100px;
        min-width: 100px;
        min-height: 100px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px dashed #cbd5e1;
        background-color: #ffffff;
        position: relative;
    }

    .upload-file {
        width: 100px;
        height: 100px;
        min-width: 100px;
        min-height: 100px;
        border-radius: 10px;
        border: 2px dashed #cbd5e1;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }

    .upload-file:hover {
        border-color: #ff5500;
        background-color: rgba(255, 85, 0, 0.04);
    }
</style>

<!-- Page Title & Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h4 class="fw-bold text-dark mb-1">Profil Saya</h4>
        <p class="text-xs text-secondary-light mb-0">Kelola data pribadi, informasi kontak, dan keamanan akun Anda di Salsa Motor.</p>
    </div>
    <a href="<?= site_url('riwayat-servis') ?>" class="btn btn-outline-neutral-700 text-dark radius-8 px-16 py-8 text-xs fw-bold btn-action-custom bg-white border">
        <iconify-icon icon="solar:history-bold-duotone" style="color: #ff5500;"></iconify-icon>
        <span>Lihat Riwayat Servis</span>
    </a>
</div>

<div class="row g-4">
    <!-- Left Column: User Summary Card -->
    <div class="col-lg-4">
        <div class="card-custom text-center p-24 mb-20">
            <!-- Profile Photo / Initial -->
            <div class="profile-avatar-wrapper">
                <?php if (!empty($user['foto']) && file_exists(FCPATH . 'uploads/users/' . $user['foto'])): ?>
                    <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" alt="<?= esc($user['nama']) ?>" class="profile-avatar-img" id="sidebarAvatarImg">
                <?php else: ?>
                    <div class="profile-avatar-circle" id="sidebarAvatarCircle">
                        <?= strtoupper(substr($user['nama'] ?? 'P', 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <span class="profile-online-badge" title="Akun Aktif"></span>
            </div>

            <!-- User Info -->
            <h5 class="fw-bold text-dark mb-2 text-base"><?= esc($user['nama']) ?></h5>
            <p class="text-xs text-secondary-light mb-8"><?= esc($user['email']) ?></p>
            <span class="badge radius-4 px-10 py-4 text-xxs fw-bold text-uppercase" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">
                Pelanggan Setia
            </span>

            <hr class="my-20 border-neutral-200">

            <!-- Detail List -->
            <div class="row g-2 text-start">
                <div class="col-12 mb-8">
                    <span class="text-xxs text-secondary-light d-block">Nomor WhatsApp / HP</span>
                    <span class="text-xs fw-bold text-dark"><?= esc($user['no_hp'] ?? '-') ?></span>
                </div>
                <div class="col-12 mb-8">
                    <span class="text-xxs text-secondary-light d-block">Alamat Domisili</span>
                    <span class="text-xs fw-semibold text-dark"><?= esc($user['alamat'] ?? '-') ?></span>
                </div>
                <div class="col-12">
                    <span class="text-xxs text-secondary-light d-block">Terdaftar Sejak</span>
                    <span class="text-xs fw-semibold text-dark"><?= date('d F Y', strtotime($user['created_at'] ?? 'now')) ?></span>
                </div>
            </div>
        </div>

        <!-- Mini Stats Card -->
        <div class="card-custom p-20 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="w-44-px h-44-px rounded-10 d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">
                    <iconify-icon icon="solar:wrench-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <span class="text-xxs text-secondary-light d-block text-uppercase fw-bold">Total Kunjungan Servis</span>
                    <h4 class="fw-bold text-dark mb-0"><?= esc($totalServis) ?> Kali</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Tabs (Edit Profile & Password) -->
    <div class="col-lg-8">
        <div class="card-custom">
            <!-- Nav Tabs -->
            <div class="card-header-custom border-bottom">
                <ul class="nav nav-pills gap-2 customer-tab-nav" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-profil" data-bs-toggle="pill" data-bs-target="#content-profil" type="button" role="tab" aria-controls="content-profil" aria-selected="true">
                            <iconify-icon icon="solar:user-id-bold-duotone"></iconify-icon>
                            <span>Data Pribadi</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-keamanan" data-bs-toggle="pill" data-bs-target="#content-keamanan" type="button" role="tab" aria-controls="content-keamanan" aria-selected="false">
                            <iconify-icon icon="solar:lock-password-bold-duotone"></iconify-icon>
                            <span>Ubah Kata Sandi</span>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body-custom">
                <div class="tab-content" id="profileTabsContent">
                    <!-- TAB 1: EDIT PROFIL -->
                    <div class="tab-pane fade show active" id="content-profil" role="tabpanel" aria-labelledby="tab-profil">
                        <form action="<?= site_url('profil/update') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="row g-3">
                                <!-- Nama Lengkap -->
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:user-bold-duotone"></iconify-icon></span>
                                        <input type="text" class="form-control radius-8 text-sm <?= (isset($errors['nama'])) ? 'is-invalid' : '' ?>" name="nama" value="<?= old('nama', $user['nama']) ?>" required>
                                    </div>
                                    <?php if (isset($errors['nama'])): ?>
                                        <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Alamat Email <span class="text-danger">*</span></label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:letter-bold-duotone"></iconify-icon></span>
                                        <input type="email" class="form-control radius-8 text-sm <?= (isset($errors['email'])) ? 'is-invalid' : '' ?>" name="email" value="<?= old('email', $user['email']) ?>" required>
                                    </div>
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- No HP / WA -->
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Nomor WhatsApp / HP</label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:phone-bold-duotone"></iconify-icon></span>
                                        <input type="tel" class="form-control radius-8 text-sm" name="no_hp" placeholder="Contoh: 0823456789" value="<?= old('no_hp', $user['no_hp'] ?? '') ?>">
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Alamat Lengkap</label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:map-point-bold-duotone"></iconify-icon></span>
                                        <input type="text" class="form-control radius-8 text-sm" name="alamat" placeholder="Contoh: Padang, Sumatera Barat" value="<?= old('alamat', $user['alamat'] ?? '') ?>">
                                    </div>
                                </div>

                                <!-- WOWDASH IMAGE UPLOAD WITH PREVIEW COMPONENT -->
                                <div class="col-12 mt-3">
                                    <label class="form-label text-xs fw-bold text-dark mb-2">Foto Profil (Opsional)</label>
                                    
                                    <?php 
                                        $hasExistingFoto = !empty($user['foto']) && file_exists(FCPATH . 'uploads/users/' . $user['foto']);
                                        $existingFotoSrc = $hasExistingFoto ? base_url('uploads/users/' . $user['foto']) : '';
                                    ?>
                                    
                                    <input type="hidden" name="remove_foto" id="remove_foto" value="0">
                                    
                                    <div class="upload-image-wrapper d-flex flex-wrap align-items-center gap-3">
                                        <!-- Image Preview Box -->
                                        <div class="uploaded-img <?= $hasExistingFoto ? '' : 'd-none' ?> position-relative d-flex align-items-center justify-content-center">
                                            <button type="button" class="uploaded-img__remove position-absolute top-0 end-0 z-1 p-0 me-6 mt-6 d-flex border-0 bg-white rounded-circle shadow-sm cursor-pointer" title="Hapus foto" style="width: 24px; height: 24px; align-items: center; justify-content: center;">
                                                <iconify-icon icon="radix-icons:cross-2" class="text-sm text-danger-600"></iconify-icon>
                                            </button>
                                            <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover" src="<?= $existingFotoSrc ?>" alt="Preview Foto">
                                        </div>

                                        <!-- Upload Box Label -->
                                        <label class="upload-file d-flex align-items-center flex-column justify-content-center gap-1 cursor-pointer mb-0" for="upload-file">
                                            <iconify-icon icon="solar:camera-bold-duotone" class="text-2xl text-secondary-light"></iconify-icon>
                                            <span class="text-xxs fw-bold text-secondary-light"><?= $hasExistingFoto ? 'Ganti Foto' : 'Upload Foto' ?></span>
                                            <input id="upload-file" name="foto" type="file" hidden accept="image/png, image/jpeg, image/jpg, image/webp">
                                        </label>

                                        <!-- Info Text -->
                                        <div class="flex-grow-1">
                                            <span class="text-xs fw-bold text-dark d-block">Pratinjau Foto Profil</span>
                                            <small class="text-xxs text-secondary-light d-block mt-1">Format: <b>JPG, JPEG, PNG, WEBP</b> (Maksimal <b>2MB</b>).</small>
                                            <small class="text-xxs text-secondary-light d-block">Klik <b>Upload Foto</b> untuk memilih gambar baru, atau klik tanda silang (x) untuk menghapus.</small>
                                        </div>
                                    </div>
                                    
                                    <?php if (isset($errors['foto'])): ?>
                                        <div class="text-danger text-xxs mt-2 fw-semibold d-block"><?= $errors['foto'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-brand radius-8 px-24 py-10 text-xs fw-bold btn-action-custom">
                                        <iconify-icon icon="solar:diskette-bold"></iconify-icon>
                                        <span>Simpan Perubahan Profil</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 2: UBAH KATA SANDI -->
                    <div class="tab-pane fade" id="content-keamanan" role="tabpanel" aria-labelledby="tab-keamanan">
                        <?php if (session()->getFlashdata('error_password')): ?>
                            <div class="alert alert-danger bg-danger-50 text-danger-700 border-danger-200 radius-8 p-12 mb-16 text-xs" role="alert">
                                <?= session()->getFlashdata('error_password') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success_password')): ?>
                            <div class="alert alert-success bg-success-50 text-success-700 border-success-200 radius-8 p-12 mb-16 text-xs" role="alert">
                                <?= session()->getFlashdata('success_password') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('profil/password') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="row g-3">
                                <!-- Password Lama -->
                                <div class="col-12">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Kata Sandi Saat Ini <span class="text-danger">*</span></label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:lock-keyhole-bold-duotone"></iconify-icon></span>
                                        <input type="password" class="form-control radius-8 text-sm" name="password_lama" id="passLama" placeholder="Masukkan kata sandi lama" required>
                                    </div>
                                </div>

                                <!-- Password Baru -->
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Kata Sandi Baru <span class="text-danger">*</span></label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:lock-password-bold-duotone"></iconify-icon></span>
                                        <input type="password" class="form-control radius-8 text-sm" name="password_baru" id="passBaru" placeholder="Minimal 6 karakter" required>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password Baru -->
                                <div class="col-md-6">
                                    <label class="form-label text-xs fw-bold text-dark mb-1">Konfirmasi Kata Sandi Baru <span class="text-danger">*</span></label>
                                    <div class="icon-field">
                                        <span class="icon"><iconify-icon icon="solar:shield-check-bold-duotone"></iconify-icon></span>
                                        <input type="password" class="form-control radius-8 text-sm" name="konfirmasi_pass" id="passKonfirm" placeholder="Ketik ulang kata sandi baru" required>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-brand radius-8 px-24 py-10 text-xs fw-bold btn-action-custom">
                                        <iconify-icon icon="solar:shield-keyhole-bold"></iconify-icon>
                                        <span>Perbarui Kata Sandi</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tab switching check
        var hash = window.location.hash;
        if (hash === '#keamanan') {
            var triggerEl = document.querySelector('#tab-keamanan');
            if (triggerEl) {
                var tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }

        // =============================== Wowdash Upload Single Image JS ================================================
        const fileInput = document.getElementById("upload-file");
        const imagePreview = document.getElementById("uploaded-img__preview");
        const uploadedImgContainer = document.querySelector(".uploaded-img");
        const removeButton = document.querySelector(".uploaded-img__remove");
        const removeFotoInput = document.getElementById("remove_foto");

        if (fileInput) {
            fileInput.addEventListener("change", (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    imagePreview.src = src;
                    uploadedImgContainer.classList.remove('d-none');
                    if (removeFotoInput) {
                        removeFotoInput.value = "0";
                    }
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
                if (removeFotoInput) {
                    removeFotoInput.value = "1";
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>
