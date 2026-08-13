<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Pasien Ibu</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:note-alt" class="icon text-lg"></iconify-icon>
                Pelayanan Pasien
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('ibus') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:mother-nurse" class="icon text-lg"></iconify-icon>
                Ibu
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:note-plus" class="icon text-lg"></iconify-icon>
                Tambah Data Ibu
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12 mb-10">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Pasien</h5>
        </div>
        <div class="card-body">
            <form action="<?= site_url('add-ibus') ?>" method="post" class="row gy-3 needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:id-card"></iconify-icon>
                        </span>
                        <input type="number" name="ibuNIK" class="form-control" placeholder="Masukan NIK" required>
                        <div class="invalid-feedback">
                            NIK dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="ibuNama" class="form-control" placeholder="Masukan Nama Ibu" required>
                        <div class="invalid-feedback">
                            Nama ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Suami</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="f7:person"></iconify-icon>
                        </span>
                        <input type="text" name="ibuSuami" class="form-control" placeholder="Masukan Nama Suami" required>
                        <div class="invalid-feedback">
                            Nama suami dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:calendar"></iconify-icon>
                        </span>
                        <input type="date" name="ibuTanggalLahir" class="form-control" placeholder="Masukan Tanggal Lahir Ibu" required>
                        <div class="invalid-feedback">
                            Tanggal Lahir Ibu dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No HP</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:phone"></iconify-icon>
                        </span>
                        <input type="number" name="ibuNoHP" class="form-control" placeholder="Masukan No HP" required>
                        <div class="invalid-feedback">
                            No HP dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">No BPJS</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:id-card"></iconify-icon>
                        </span>
                        <input type="text" name="ibuNoBPJS" class="form-control" placeholder="Masukan No BPJS" required>
                        <div class="invalid-feedback">
                            No BPJS dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-3">
                    <label class="form-label">RT</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <input type="number" name="ibuRT" class="form-control" placeholder="Masukan RT" required>
                        <div class="invalid-feedback">
                            RT dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">RW</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <input type="number" name="ibuRW" class="form-control" placeholder="Masukan RW" required>
                        <div class="invalid-feedback">
                            RW dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kecamatan</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <select name="ibuKecamatan" class="select2-basic" required>
                            <option value="" disabled selected>Masukan Kecamatan</option>
                            <option value="Teluk Kabung Selatan">Teluk Kabung Selatan</option>
                            <option value="Bungus Selatan">Bungus Selatan</option>
                            <option value="Teluk Kabung Tengah">Teluk Kabung Tengah</option>
                            <option value="Teluk Kabung Utara">Teluk Kabung Utara</option>
                            <option value="Bungus Timur">Bungus Timur</option>
                            <option value="Bungus Barat">Bungus Barat</option>
                            <option value="Tarantang">Tarantang</option>
                            <option value="Beringin">Beringin</option>
                            <option value="Batu Gadang">Batu Gadang</option>
                            <option value="Indarung">Indarung</option>
                            <option value="Padang Besi">Padang Besi</option>
                            <option value="Koto Lalang">Koto Lalang</option>
                            <option value="Bandar Buat">Bandar Buat</option>
                            <option value="Kampung Baru Nan Xx">Kampung Baru Nan Xx</option>
                            <option value="Pampangan Nan Xx">Pampangan Nan Xx</option>
                            <option value="Koto Baru Nan Xx">Koto Baru Nan Xx</option>
                            <option value="Tanjuang Aur Nan Xx">Tanjuang Aur Nan Xx</option>
                            <option value="Gurun Laweh Nan Xx">Gurun Laweh Nan Xx</option>
                            <option value="Banuaran Nan Xx">Banuaran Nan Xx</option>
                            <option value="Lubuk Begalung Nan Xx">Lubuk Begalung Nan Xx</option>
                            <option value="Cengkeh Nan Xx">Cengkeh Nan Xx</option>
                            <option value="Gates Nan Xx">Gates Nan Xx</option>
                            <option value="Pagambiran Ampulu Nan Xx">Pagambiran Ampulu Nan Xx</option>
                            <option value="Parak Laweh Pulau Air Nan Xx">Parak Laweh Pulau Air Nan Xx</option>
                            <option value="Tanjung Saba Pitameh Nan Xx">Tanjung Saba Pitameh Nan Xx</option>
                            <option value="Tanah Sirah Piai Nan Xx">Tanah Sirah Piai Nan Xx</option>
                            <option value="Kampung Jua Nan Xx">Kampung Jua Nan Xx</option>
                            <option value="Batuang Taba Nan Xx">Batuang Taba Nan Xx</option>
                            <option value="Air Manis">Air Manis</option>
                            <option value="Bukik Gado Gado">Bukik Gado Gado</option>
                            <option value="Batang Arau">Batang Arau</option>
                            <option value="Seberang Palinggam">Seberang Palinggam</option>
                            <option value="Pasa Gadang">Pasa Gadang</option>
                            <option value="Belakang Pondok">Belakang Pondok</option>
                            <option value="Alang Laweh">Alang Laweh</option>
                            <option value="Taluak Bayua">Taluak Bayua</option>
                            <option value="Rawang">Rawang</option>
                            <option value="Mato Aie">Mato Aie</option>
                            <option value="Seberang Padang">Seberang Padang</option>
                            <option value="Ranah Parak Rumbio">Ranah Parak Rumbio</option>
                            <option value="Sawahan">Sawahan</option>
                            <option value="Ganting Parak Gadang">Ganting Parak Gadang</option>
                            <option value="Parak Gadang Timur">Parak Gadang Timur</option>
                            <option value="Kubu Marapalam">Kubu Marapalam</option>
                            <option value="Kubu Parak Karakah">Kubu Parak Karakah</option>
                            <option value="Andalas">Andalas</option>
                            <option value="Simpang Haru">Simpang Haru</option>
                            <option value="Sawahan Timur">Sawahan Timur</option>
                            <option value="Jati Baru">Jati Baru</option>
                            <option value="Jati">Jati</option>
                            <option value="Belakang Tangsi">Belakang Tangsi</option>
                            <option value="Olo">Olo</option>
                            <option value="Ujung Gurun">Ujung Gurun</option>
                            <option value="Berok Nipah">Berok Nipah</option>
                            <option value="Kampung Pondok">Kampung Pondok</option>
                            <option value="Kampung Jao">Kampung Jao</option>
                            <option value="Purus">Purus</option>
                            <option value="Padang Pasir">Padang Pasir</option>
                            <option value="Rimbo Kaluang">Rimbo Kaluang</option>
                            <option value="Flamboyan Baru">Flamboyan Baru</option>
                            <option value="Gunung Pangilun">Gunung Pangilun</option>
                            <option value="Ulak Karang Selatan">Ulak Karang Selatan</option>
                            <option value="Ulak Karang Utara">Ulak Karang Utara</option>
                            <option value="Air Tawar Timur">Air Tawar Timur</option>
                            <option value="Air Tawar Barat">Air Tawar Barat</option>
                            <option value="Alai Parak Kopi">Alai Parak Kopi</option>
                            <option value="Lolong Belanti">Lolong Belanti</option>
                            <option value="Tabiang Banda Gadang">Tabiang Banda Gadang</option>
                            <option value="Gurun Laweh">Gurun Laweh</option>
                            <option value="Kampung Olo">Kampung Olo</option>
                            <option value="Kampung Lapai Baru">Kampung Lapai Baru</option>
                            <option value="Surau Gadang">Surau Gadang</option>
                            <option value="Kurao Pagang">Kurao Pagang</option>
                            <option value="Anduring">Anduring</option>
                            <option value="Pasar Ambacang">Pasar Ambacang</option>
                            <option value="Lubuk Lintah">Lubuk Lintah</option>
                            <option value="Ampang">Ampang</option>
                            <option value="Kalumbuk">Kalumbuk</option>
                            <option value="Korong Gadang">Korong Gadang</option>
                            <option value="Kuranji">Kuranji</option>
                            <option value="Gunung Sarik">Gunung Sarik</option>
                            <option value="Sungai Sapih">Sungai Sapih</option>
                            <option value="Pisang">Pisang</option>
                            <option value="Binuang Kampung Dalam">Binuang Kampung Dalam</option>
                            <option value="Piai Tangah">Piai Tangah</option>
                            <option value="Cupak Tangah">Cupak Tangah</option>
                            <option value="Kapala Koto">Kapala Koto</option>
                            <option value="Koto Luar">Koto Luar</option>
                            <option value="Lambung Bukit">Lambung Bukit</option>
                            <option value="Limau Manis Selatan">Limau Manis Selatan</option>
                            <option value="Limau Manis">Limau Manis</option>
                            <option value="Dadok Tunggul Hitam">Dadok Tunggul Hitam</option>
                            <option value="Air Pacah">Air Pacah</option>
                            <option value="Lubuk Minturun">Lubuk Minturun</option>
                            <option value="Bungo Pasang">Bungo Pasang</option>
                            <option value="Parupuk Tabing">Parupuk Tabing</option>
                            <option value="Batang Kabung">Batang Kabung</option>
                            <option value="Lubuk Buaya">Lubuk Buaya</option>
                            <option value="Padang Sarai">Padang Sarai</option>
                            <option value="Koto Panjang Ikua Koto">Koto Panjang Ikua Koto</option>
                            <option value="Pasir Nan Tigo">Pasir Nan Tigo</option>
                            <option value="Koto Pulai">Koto Pulai</option>
                            <option value="Balai Gadang">Balai Gadang</option>
                            <option value="Batipuh Panjang">Batipuh Panjang</option>
                        </select>
                        <div class="invalid-feedback">
                            Kecamatan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Alamat</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:location-pin"></iconify-icon>
                        </span>
                        <textarea name="ibuAlamat" class="form-control" placeholder="Masukan Alamat" required></textarea>
                        <div class="invalid-feedback">
                            Alamat dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pendidikan Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:book-text"></iconify-icon>
                        </span>
                        <input type="text" name="ibuPendidikan" class="form-control" placeholder="Masukan Pendidikan" required>
                        <div class="invalid-feedback">
                            Pendidikan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:clipboard-2"></iconify-icon>
                        </span>
                        <input type="text" name="ibuPekerjaan" class="form-control" placeholder="Masukan Pekerjaan" required>
                        <div class="invalid-feedback">
                            Pekerjaan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Suami</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:clipboard-2"></iconify-icon>
                        </span>
                        <input type="text" name="suamiPekerjaan" class="form-control" placeholder="Masukan Pekerjaan" required>
                        <div class="invalid-feedback">
                            Pekerjaan dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Agama Ibu</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:message-dots-question-mark"></iconify-icon>
                        </span>
                        <select class="form-control radius-8 form-select" name="ibuAgama">
                            <option>Islam</option>
                            <option>Budha</option>
                            <option>Hindu</option>
                            <option>Katolik</option>
                            <option>Konghucu</option>
                            <option>Kristen</option>
                        </select>
                        <div class="invalid-feedback">
                            Agama dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gol Darah</label>
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:water-drop"></iconify-icon>
                        </span>
                        <select class="form-control radius-8 form-select" name="ibuGolDarah">
                            <option>A</option>
                            <option>AB</option>
                            <option>B</option>
                            <option>O</option>
                        </select>
                        <div class="invalid-feedback">
                            Gol Darah dibutuhkan
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= site_url('ibus') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:back-fill" class="text-xl"></iconify-icon> Batal
                    </a>
                    <button type="submit" class="btn btn-primary-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:save-2-fill" class="text-xl"></iconify-icon> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('.select2-basic').select2({
            width: 'element'
        });
    });

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
</script>
<?= $this->endSection() ?>