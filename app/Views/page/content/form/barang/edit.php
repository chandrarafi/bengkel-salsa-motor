<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<?php $errors = session('errors') ?? []; ?>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Edit Data Barang</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium">
            <a href="<?= site_url('admin/barang') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                Kelola Barang
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Edit Barang</li>
    </ul>
</div>

<!-- Flash Error Alert -->
<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('error') ?>
        </div>
        <button class="remove-button text-danger-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<!-- Form Card -->
<div class="card radius-12 border">
    <div class="card-header border-bottom border-neutral-200 px-20 py-14 d-flex align-items-center justify-content-between">
        <h6 class="card-title mb-0 text-base fw-bold">Edit Barang: <?= esc($barang['nama_barng']) ?> (#<?= esc($barang['kode']) ?>)</h6>
        <a href="<?= site_url('admin/barang') ?>" class="btn btn-outline-neutral-400 text-neutral-700 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:arrow-left-line" class="text-base"></iconify-icon> Kembali ke List
        </a>
    </div>
    <div class="card-body p-24">
        <form id="editBarangForm" action="<?= site_url('admin/barang/update/' . $barang['kode']) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <?= csrf_field() ?>
            <input type="hidden" name="remove_gambar" id="remove_gambar" value="0">
            
            <div class="row g-4">
                <!-- Left Side: Form Data -->
                <div class="col-lg-8">
                    <div class="row g-3">
                        <!-- Kode Barang (Readonly) -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Kode Barang</label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:qr-code-bold-duotone"></iconify-icon>
                                </span>
                                <input type="text" name="kode" id="kode" class="form-control form-control-sm radius-8 bg-neutral-100" value="<?= esc($barang['kode']) ?>" readonly>
                            </div>
                        </div>

                        <!-- Nama Barang -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Nama Barang / Sparepart <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                                </span>
                                <input type="text" name="nama_barng" id="nama_barng" class="form-control form-control-sm radius-8 <?= isset($errors['nama_barng']) ? 'is-invalid' : '' ?>" value="<?= old('nama_barng', $barang['nama_barng']) ?>" placeholder="Nama barang" maxlength="50" required>
                            </div>
                            <div class="invalid-feedback <?= isset($errors['nama_barng']) ? 'd-block' : '' ?>" id="nama_barng_feedback"><?= esc($errors['nama_barng'] ?? 'Nama barang wajib diisi (max 50 karakter).') ?></div>
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Kategori Barang <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:tag-horizontal-bold-duotone"></iconify-icon>
                                </span>
                                <select name="idkategori" id="idkategori" class="form-select form-select-sm radius-8 <?= isset($errors['idkategori']) ? 'is-invalid' : '' ?>" required>
                                    <option value="" disabled>-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $kat): ?>
                                        <option value="<?= $kat['idkategori'] ?>" <?= old('idkategori', $barang['idkategori']) == $kat['idkategori'] ? 'selected' : '' ?>><?= esc($kat['namakategori']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="invalid-feedback <?= isset($errors['idkategori']) ? 'd-block' : '' ?>" id="idkategori_feedback"><?= esc($errors['idkategori'] ?? 'Pilih kategori barang.') ?></div>
                        </div>

                        <!-- Satuan -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Satuan Barang <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                                </span>
                                <select name="idsatuan" id="idsatuan" class="form-select form-select-sm radius-8 <?= isset($errors['idsatuan']) ? 'is-invalid' : '' ?>" required>
                                    <option value="" disabled>-- Pilih Satuan --</option>
                                    <?php foreach ($satuan as $sat): ?>
                                        <option value="<?= $sat['idsatuan'] ?>" <?= old('idsatuan', $barang['idsatuan']) == $sat['idsatuan'] ? 'selected' : '' ?>><?= esc($sat['nama_satuan']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="invalid-feedback <?= isset($errors['idsatuan']) ? 'd-block' : '' ?>" id="idsatuan_feedback"><?= esc($errors['idsatuan'] ?? 'Pilih satuan barang.') ?></div>
                        </div>

                        <!-- Harga Beli -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Harga Beli (Rp) <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:tag-price-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="harga_beli" id="harga_beli" class="form-control form-control-sm radius-8 <?= isset($errors['harga_beli']) ? 'is-invalid' : '' ?>" value="<?= old('harga_beli', $barang['harga_beli'] ?? '') ?>" placeholder="Harga beli barang" min="0" required>
                            </div>
                            <div class="invalid-feedback <?= isset($errors['harga_beli']) ? 'd-block' : '' ?>" id="harga_beli_feedback"><?= esc($errors['harga_beli'] ?? 'Harga beli barang wajib diisi.') ?></div>
                        </div>

                        <!-- Harga Jual -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Harga Jual (Rp) <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:tag-price-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="harga_jual" id="harga_jual" class="form-control form-control-sm radius-8 <?= isset($errors['harga_jual']) ? 'is-invalid' : '' ?>" value="<?= old('harga_jual', $barang['harga_jual'] ?? '') ?>" placeholder="Harga jual barang" min="0" required>
                            </div>
                            <div class="invalid-feedback <?= isset($errors['harga_jual']) ? 'd-block' : '' ?>" id="harga_jual_feedback"><?= esc($errors['harga_jual'] ?? 'Harga jual barang wajib diisi.') ?></div>
                        </div>

                        <!-- Stok -->
                        <div class="col-md-6">
                            <label class="form-label text-xs fw-semibold text-neutral-700 mb-1">Jumlah Stok <span class="text-danger-600">*</span></label>
                            <div class="icon-field">
                                <span class="icon">
                                    <iconify-icon icon="solar:square-academic-cap-bold-duotone"></iconify-icon>
                                </span>
                                <input type="number" name="stok" id="stok" class="form-control form-control-sm radius-8 <?= isset($errors['stok']) ? 'is-invalid' : '' ?>" value="<?= old('stok', $barang['stok']) ?>" placeholder="Jumlah stok" min="0" required>
                            </div>
                            <div class="invalid-feedback <?= isset($errors['stok']) ? 'd-block' : '' ?>" id="stok_feedback"><?= esc($errors['stok'] ?? 'Stok barang wajib diisi.') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Image Upload Component -->
                <div class="col-lg-4">
                    <div class="card h-100 p-0 border radius-12 overflow-hidden">
                        <div class="card-header border-bottom bg-base py-16 px-24">
                          <h6 class="text-md fw-semibold mb-0">Foto Barang</h6>
                        </div>
                        <div class="card-body p-24">
                            <?php 
                                $hasExistingImg = !empty($barang['gambar']) && file_exists(ROOTPATH . 'public/uploads/barang/' . $barang['gambar']);
                                $existingImgSrc = $hasExistingImg ? base_url('uploads/barang/' . $barang['gambar']) : '';
                            ?>
                            <div class="upload-image-wrapper d-flex align-items-center gap-3">
                              <div class="uploaded-img <?= $hasExistingImg ? '' : 'd-none' ?> position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                <button type="button" class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex border-0 bg-transparent cursor-pointer">
                                  <iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>
                                </button>
                                <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover" src="<?= $existingImgSrc ?>" alt="image">
                              </div>
            
                              <label class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1 cursor-pointer" for="upload-file">
                                <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                <span class="fw-semibold text-secondary-light">Ganti</span>
                                <input id="upload-file" name="gambar" type="file" hidden accept="image/png, image/jpeg, image/jpg, image/webp">
                              </label>
                            </div>
                            <small class="text-secondary-light d-block mt-12">Format: JPG, PNG, WEBP (Max 2MB)</small>
                            <div class="invalid-feedback <?= isset($errors['gambar']) ? 'd-block' : '' ?>" id="gambar_feedback"><?= esc($errors['gambar'] ?? '') ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-24 border-neutral-200">

            <div class="d-flex align-items-center justify-content-end gap-2">
                <a href="<?= site_url('admin/barang') ?>" class="border border-neutral-400 bg-neutral-100 text-neutral-700 text-sm px-20 py-8 radius-8 d-flex align-items-center gap-2 fw-medium">
                    <iconify-icon icon="mingcute:close-line" class="text-base"></iconify-icon> Batal
                </a>
                <button type="submit" id="submitBtn" class="btn btn-primary-600 radius-8 px-24 py-8 text-sm d-flex align-items-center gap-2 fw-semibold">
                    <iconify-icon icon="mingcute:save-2-fill" class="text-base"></iconify-icon> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // =============================== Upload Single Image js ================================================
        const fileInput = document.getElementById("upload-file");
        const imagePreview = document.getElementById("uploaded-img__preview");
        const uploadedImgContainer = document.querySelector(".uploaded-img");
        const removeButton = document.querySelector(".uploaded-img__remove");
        const removeGambarInput = document.getElementById("remove_gambar");

        fileInput.addEventListener("change", (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                imagePreview.src = src;
                uploadedImgContainer.classList.remove('d-none');
                removeGambarInput.value = "0";
            }
        });
        removeButton.addEventListener("click", () => {
            imagePreview.src = "";
            uploadedImgContainer.classList.add('d-none');
            fileInput.value = ""; 
            removeGambarInput.value = "1";
        });
        // =========================================================================================================

        // AJAX Form Submit
        $('#editBarangForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = new FormData(form);
            var $btn = $('#submitBtn');
            var originalBtnHtml = $btn.html();

            $('.form-control, .form-select').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block').text('');
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = response.redirect_url || '<?= site_url('admin/barang') ?>';
                        });
                    } else {
                        if (response.errors) {
                            $.each(response.errors, function(field, msg) {
                                var $el = $('#' + field);
                                if (field === 'gambar') {
                                    $el = $('#upload-file');
                                }
                                $el.addClass('is-invalid');
                                $('#' + field + '_feedback').addClass('d-block').text(msg);
                            });
                        } else if (response.message) {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Terjadi kesalahan sistem.';
                    Swal.fire({ icon: 'error', title: 'Error', text: msg });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
