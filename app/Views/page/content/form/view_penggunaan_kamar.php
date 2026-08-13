<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Penggunaan Kamar</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('penggunaan-kamar') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Penggunaan Kamar <?= esc($penggunaanKamar['penggunaanKamarID']) ?></h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-penggunaan-kamar') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <input type="hidden" name="penggunaanKamarID" value="<?= esc($penggunaanKamar['penggunaanKamarID']) ?>">
                    <div class="col-md-6">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" name="ibuNama" class="form-control" placeholder="Masukkan ID Ibu" value="<?= esc($penggunaanKamar['ibuNama']) ?>" readonly readonly required>
                        <div class="invalid-feedback">
                            ID Ibu dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kamar</label>
                        <input type="text" name="kamarNama" class="form-control" placeholder="Masukkan ID Kamar" value="<?= esc($penggunaanKamar['kamarNama']) ?>" readonly readonly required>
                        <div class="invalid-feedback">
                            ID Kamar dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Biaya</label>
                        <input type="text" id="biayaKamar" name="kamarBiaya" class="form-control" placeholder="Masukkan ID Kamar" value="<?= esc($penggunaanKamar['kamarBiaya']) ?>" readonly readonly required>
                        <div class="invalid-feedback">
                            ID Kamar dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" id="tanggalMasuk" name="tanggalMasuk" class="form-control" placeholder="Masukkan Tanggal Masuk" value="<?= esc($penggunaanKamar['tanggalMasuk']) ?>" readonly required>
                        <div class="invalid-feedback">
                            Tanggal Masuk dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" id="tanggalKeluar" name="tanggalKeluar" class="form-control" placeholder="Masukkan Tanggal Keluar" value="<?= esc($penggunaanKamar['tanggalKeluar']) ?>" readonly required>
                        <div class="invalid-feedback">
                            Tanggal Keluar dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Perkiraan Biaya</label>
                        <input type="text" id="perkiraanBiaya" name="perkiraanBiaya" class="form-control" placeholder="Perkiraan Biaya" readonly required>
                        <div class="invalid-feedback">
                            Perkiraan Biaya
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" placeholder="Masukkan Catatan" readonly><?= esc($penggunaanKamar['catatan']) ?></textarea>
                        <div class="invalid-feedback">
                            Catatan dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Aksi</h5>
            </div>
            <div class="card-body">
                <a href="<?= site_url('print-data-penggunaan-kamar/' . esc($penggunaanKamar['penggunaanKamarID'])) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Penggunaan Kamar
                </a>
                <a href="/edit-penggunaan-kamar/<?= esc($penggunaanKamar['penggunaanKamarID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Penggunaan Kamar
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($penggunaanKamar['penggunaanKamarID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Penggunaan Kamar
                </a>
                <form id="deleteForm_<?= esc($penggunaanKamar['penggunaanKamarID']) ?>" action="<?= site_url('delete-penggunaan-kamar') ?>" method="post">
                    <input type="hidden" name="penggunaanKamarID" value="<?= esc($penggunaanKamar['penggunaanKamarID']) ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        const biayaKamarElement = document.getElementById('biayaKamar');
        const tanggalMasukElement = document.getElementById('tanggalMasuk');
        const tanggalKeluarElement = document.getElementById('tanggalKeluar');
        const perkiraanBiayaElement = document.getElementById('perkiraanBiaya');

        const biayaKamar = parseFloat(biayaKamarElement.value);
        const tanggalMasuk = new Date(tanggalMasukElement.value);
        const tanggalKeluar = new Date(tanggalKeluarElement.value);

        const totalMalam = dateDiffInDays(tanggalMasuk, tanggalKeluar) + 1;
        const perkiraanBiaya = totalMalam * biayaKamar;
        perkiraanBiayaElement.value = perkiraanBiaya.toLocaleString('id-ID'); // Format to Indonesian Rupiah or use toLocaleString for local currency formatting
    });

    // Function to calculate difference in days between two dates
    function dateDiffInDays(date1, date2) {
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays;
    }
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

    function confirmDelete(penggunaanKamarID) {
        Swal.fire({
            text: "Kamu yakin menghapus data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete action
                $('#deleteForm_' + penggunaanKamarID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>