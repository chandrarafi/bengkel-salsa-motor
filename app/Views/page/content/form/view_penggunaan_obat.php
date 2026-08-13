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

<div class="row">
    <div class="col-lg-9 mb-10">
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
                                    <input type="text" id="ibuNama" name="ibuNama" value="<?= esc($penggunaanObat['ibuNama']) ?>" class="form-control" placeholder="Pilih Data Ibu" readonly>
                                    <button type="button" class="input-group-text bg-base"><iconify-icon icon="lucide:search"></iconify-icon></button>
                                </div>
                                <div class="invalid-feedback">
                                    Data Ibu dibutuhkan
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No RM Ibu</label>
                            <input type="text" id="ibuRM" name="ibuRM" value="<?= esc($penggunaanObat['ibuRM']) ?>" class="form-control" placeholder="Masukkan No RM Ibu" readonly required>
                            <div class="invalid-feedback">
                                No RM Ibu dibutuhkan
                            </div>
                        </div>
                        <div class="col-md-12 mb-20">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" placeholder="Masukan Keterangan Komplikasi" readonly><?= esc($penggunaanObat['catatan']) ?></textarea>
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
                                        <th scope="col" class="text-sm">Nama Obat</th>
                                        <th scope="col" class="text-sm">Harga</th>
                                        <th scope="col" class="text-sm">Stok</th>
                                        <th scope="col" class="text-sm">Qty</th>
                                        <th scope="col" class="text-sm">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalObat = 0;
                                    $total = 0 ?>
                                    <?php foreach ($detailPenggunaanObat as $dpo) { ?>
                                        <tr>
                                            <td><?= esc($dpo['obatNama']) ?></td>
                                            <td><?= esc($dpo['obatHarga']) ?></td>
                                            <td><?= esc($dpo['obatStok']) ?></td>
                                            <td><?= esc($dpo['obatJumlah']) ?></td>
                                            <td><?= $subtotal = $dpo['obatHarga'] * $dpo['obatJumlah'];
                                                $totalObat += $dpo['obatJumlah'];
                                                $total += $subtotal; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
                                                <span id="jumlahObat" class="text-primary-light fw-semibold"><?= esc($totalObat) ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-64 pt-4">
                                                <span class="text-primary-light fw-semibold">Total:</span>
                                            </td>
                                            <td class="pe-16 pt-4">
                                                <span id="totalObat" class="text-primary-light fw-semibold"><?= esc($total) ?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

                <a href="<?= site_url('print-data-penggunaan-obat/' . esc($penggunaanObat['penggunaanObatID'])) ?>" class="btn btn-lilac-100 text-lilac-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Data Penggunaan Obat
                </a>
                <a href="/edit-penggunaan-obat/<?= esc($penggunaanObat['penggunaanObatID']) ?>" class="btn btn-warning-100 text-warning-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:edit-fill" class="text-xl"></iconify-icon> Edit Data Penggunaan Obat
                </a>
                <a type="button" onclick="confirmDelete('<?= esc($penggunaanObat['penggunaanObatID']) ?>')" class="btn btn-danger-100 text-danger-600 radius-8 px-20 py-11 d-flex align-items-center gap-2 mb-10">
                    <iconify-icon icon="mage:trash-3-fill" class="text-xl"></iconify-icon> Hapus Data Penggunaan Obat
                </a>
                <form id="deleteForm_<?= esc($penggunaanObat['penggunaanObatID']) ?>" action="<?= site_url('delete-penggunaan-obat') ?>" method="post">
                    <input type="hidden" name="penggunaanObatID" value="<?= esc($penggunaanObat['penggunaanObatID']) ?>">
                </form>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    let table = new DataTable('#dataTable');

    function confirmDelete(penggunaanObatID) {
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
                $('#deleteForm_' + penggunaanObatID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>