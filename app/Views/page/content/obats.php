<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Obat</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:database-outline" class="icon text-lg"></iconify-icon>
                Kelola Data
            </a>
        </li>
    </ul>
</div>
<?php if (session()->getFlashdata('msg')) : ?>
    <div class="mb-16 alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
        <?= session()->getFlashdata('msg') ?>
        <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
    </div>
<?php endif; ?>

<div class="card basic-data-table">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <h5 class="card-title mb-0">Data Obat</h5>
            </div>
            <div class="col-auto">
                <a href="<?= site_url('add-obats') ?>" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                    <iconify-icon icon="mingcute:user-add-fill" class="text-xl"></iconify-icon> Data Baru
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                ID
                            </label>
                        </div>
                    </th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($obats as $obat) : ?>
                    <tr>
                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    <?= esc($obat['obatID']) ?>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <h6 class="text-md mb-0 fw-medium flex-grow-1"><?= esc($obat['obatNama']) ?></h6>
                            </div>
                        </td>
                        <td><?= esc($obat['obatStok']) ?></td>
                        <td><?= esc(number_format($obat['obatHarga'], 0, ',', '.')) ?></td>
                        <td>
                            <a href="/edit-obats/<?= esc($obat['obatID']) ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a type="button" onclick="confirmDelete('<?= esc($obat['obatID']) ?>')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                            <form id="deleteForm_<?= esc($obat['obatID']) ?>" action="<?= site_url('delete-obats') ?>" method="post">
                                <input type="hidden" name="obatID" value="<?= esc($obat['obatID']) ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    let table = new DataTable('#dataTable');

    function confirmDelete(obatID) {
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
                $('#deleteForm_' + obatID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>