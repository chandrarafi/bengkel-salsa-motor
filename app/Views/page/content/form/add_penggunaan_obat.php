<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Penggunaan Obat</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="<?= site_url('penggunaan-obat') ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:document-add-outline" class="icon text-lg"></iconify-icon>
                Pelayanan Penggunaan Obat
            </a>
        </li>
    </ul>
</div>

<div class="col-lg-12 mb-10">
    <div id="table-ibu" class="card basic-data-table mb-20">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <h5 class="card-title mb-0">Pilih Ibu</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <label class="form-check-label">
                                    ID
                                </label>
                            </div>
                        </th>
                        <th scope="col">No RM</th>
                        <th scope="col">Nama Ibu</th>
                        <th scope="col">Nama Suami</th>
                        <th scope="col">No HP</th>
                        <th scope="col">No BPJS</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ibus as $ibu) : ?>
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <label class="form-check-label">
                                        <?= esc($ibu['ibuID']) ?>
                                    </label>
                                </div>
                            </td>
                            <td><?= esc($ibu['ibuRM']) ?></td>
                            <td><?= esc($ibu['ibuNama']) ?></td>
                            <td><?= esc($ibu['ibuSuami']) ?></td>
                            <td><?= esc($ibu['ibuNoHP']) ?></td>
                            <td><?= esc($ibu['ibuNoBPJS']) ?></td>
                            <td>
                                <button onclick="selectDataIbu('<?= esc($ibu['ibuID']) ?>','<?= esc($ibu['ibuNama']) ?>','<?= esc($ibu['ibuRM']) ?>')" type="button" class="btn btn-warning-100 text-warning-600 radius-8 px-14 py-6 text-sm">Pilih</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12 mb-10">
    <div id="tambah-card" class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Penggunaan Obat</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 mb-10">
                        <label class="form-label">Pilih Ibu</label>
                        <div class="has-validation">
                            <input type="hidden" id="ibuID" name="ibuID">
                            <div class="input-group">
                                <input type="text" id="ibuNama" name="ibuNama" class="form-control" placeholder="Pilih Data Ibu" readonly>
                                <button type="button" onclick="showDataIbu()" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                            </div>
                            <div class="invalid-feedback">
                                Data Ibu dibutuhkan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No RM Ibu</label>
                        <input type="text" id="ibuRM" name="ibuRM" class="form-control" placeholder="Masukkan No RM Ibu" readonly required>
                        <div class="invalid-feedback">
                            No RM Ibu dibutuhkan
                        </div>
                    </div>
                    <div class="col-md-12 mb-20">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" placeholder="Masukan Keterangan Komplikasi" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Detail Penggunaan Obat</label>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table text-sm" id="detail-obat-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-sm">No</th>
                                    <th scope="col" class="text-sm">Nama Obat</th>
                                    <th scope="col" class="text-sm">Harga</th>
                                    <th scope="col" class="text-sm">Stok</th>
                                    <th scope="col" class="text-sm">Qty</th>
                                    <th scope="col" class="text-sm">Subtotal</th>
                                    <th scope="col" class="text-center text-sm">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <button type="button" id="addRow" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="simple-line-icons:plus" class="text-xl"></iconify-icon>
                            Tambah Obat
                        </button>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between gap-3 mt-24">
                        <div>
                        </div>
                        <div>
                            <table class="text-sm">
                                <tbody>
                                    <tr>
                                        <td class="pe-64 border-bottom pb-4">Jumlah Obat:</td>
                                        <td class="pe-16 border-bottom pb-4">
                                            <span id="jumlahObat" class="text-primary-light fw-semibold">0</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pe-64 pt-4">
                                            <span class="text-primary-light fw-semibold">Total:</span>
                                        </td>
                                        <td class="pe-16 pt-4">
                                            <span id="totalObat" class="text-primary-light fw-semibold">0</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 mt-20">
                    <a href="<?= site_url('penggunaan-obat') ?>" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8 d-flex align-items-center gap-2">
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
        $('#table-ibu').hide();
    });

    function showDataIbu() {
        $('#table-ibu').show();
        $('#tambah-card').hide();
    }

    function selectDataIbu(ibuID, ibuNama, ibuRM) {
        $('#ibuID').val(ibuID);
        $('#ibuNama').val(ibuNama);
        $('#ibuRM').val(ibuRM);
        $('#table-ibu').hide();
        $('#tambah-card').show();
    }

    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();

    'use strict';

    (function($) {
        $('#addRow').click(function() {
            const rowCount = $('#detail-obat-table tbody tr').length + 1;
            const newRow = `
        <tr class="data-detail-obat">
            <td>${String(rowCount).padStart(2, '0')}</td>
            <td>
                <select class="obat-select form-control select2-basic" required>
                    <option value="" disabled selected>Pilih Obat</option>
                    <?php foreach ($obats as $obat) { ?>
                        <option data-stok="<?= esc($obat['obatStok']) ?>" data-harga="<?= esc($obat['obatHarga']) ?>" value="<?= esc($obat['obatID']) ?>"><?= esc($obat['obatNama']) ?></option>
                    <?php } ?>
                </select>
            </td>
            <td class="obatHarga">0</td>
            <td class="obatStok">0</td>
            <td><input type="number" class="obatQty form-control" value="0" min="0"></td>
            <td class="obatSubtotal">0</td>
            <td class="text-center">
                <button type="button" class="remove-row"><iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon></button>
            </td>
        </tr>
    `;
            $('#detail-obat-table tbody').append(newRow);
            updateTotals();
            $('.select2-basic').select2({
                width: 'element'
            });
        });

        // Delegate the change event to dynamically added select elements
        $('#detail-obat-table').on('change', '.obat-select', function() {
            const selectedOption = $(this).find('option:selected');
            const harga = selectedOption.data('harga');
            const stok = selectedOption.data('stok');
            const row = $(this).closest('tr');

            row.find('.obatHarga').text(harga);
            row.find('.obatStok').text(stok);

            // Set the max attribute of the qty input to the stok value
            const qtyInput = row.find('.obatQty');
            qtyInput.attr('max', stok);

            // Optionally update the subtotal if qty is already set
            const qty = qtyInput.val();
            row.find('.obatSubtotal').text(harga * qty);

            updateTotals();
        });

        // Delegate the input event to dynamically added qty inputs
        $('#detail-obat-table').on('input', '.obatQty', function() {
            const row = $(this).closest('tr');
            const harga = row.find('.obat-select option:selected').data('harga');
            const qty = $(this).val();

            row.find('.obatSubtotal').text(harga * qty);
            updateTotals();
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateRowNumbers();
            updateTotals();
        });

        function updateRowNumbers() {
            $('#detail-obat-table tbody tr').each(function(index) {
                $(this).find('td:first').text(String(index + 1).padStart(2, '0'));
            });
        }

        // Function to update the totals
        function updateTotals() {
            let totalJumlahObat = 0;
            let totalHarga = 0;

            $('#detail-obat-table tbody tr').each(function() {
                const qty = parseInt($(this).find('.obatQty').val()) || 0;
                const subtotal = parseInt($(this).find('.obatSubtotal').text()) || 0;

                totalJumlahObat += qty;
                totalHarga += subtotal;
            });

            $('#jumlahObat').text(totalJumlahObat);
            $('#totalObat').text(totalHarga);
        }

        // Handle form submission
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Perform client-side validation
            let isValid = true;
            $('#detail-obat-table tbody tr').each(function() {
                const qty = parseInt($(this).find('.obatQty').val()) || 0;
                const stok = parseInt($(this).find('.obat-select option:selected').data('stok')) || 0;
                if (qty > stok) {
                    alert('Qty tidak boleh lebih dari stok');
                    isValid = false;
                    return false; // Exit the loop
                }
            });

            if (!isValid) return;

            // Collect form data
            const formData = {
                ibuID: $('#ibuID').val(),
                catatan: $('textarea[name="catatan"]').val(),
                details: []
            };

            $('#detail-obat-table tbody tr').each(function() {
                const row = $(this);
                formData.details.push({
                    obatID: row.find('.obat-select').val(),
                    Tanggal: new Date().toISOString().split('T')[0], // Today's date
                    obatJumlah: row.find('.obatQty').val()
                });
            });

            // Send data to the server via AJAX
            $.ajax({
                url: '<?= site_url("add-penggunaan-obat") ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    window.location.href = "<?= base_url('penggunaan-obat') ?>";
                    // Redirect or update the UI as needed
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while saving the data');
                    console.error(error);
                }
            });
        });
    })(jQuery);
</script>
<?= $this->endSection() ?>