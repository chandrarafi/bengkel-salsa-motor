<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Rujukan Ibu</h6>
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
                <h5 class="card-title mb-0">Rujukan Ibu</h5>
            </div>
            <div class="col-auto">
                <a href="<?= site_url('add-rujukan-ibu') ?>" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                    <iconify-icon icon="tabler:circle-plus" class="text-xl"></iconify-icon> Rujukan Baru
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
                    <th scope="col">Tanggal Rujukan</th>
                    <th scope="col">Pasien</th>
                    <th scope="col">Kepada</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Hasil Pemeriksaan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rujukans as $rujukan) : ?>
                    <tr>
                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    <?= esc($rujukan['rujukanIbuID']) ?>
                                </label>
                            </div>
                        </td>
                        <td><?= esc($rujukan['tanggalRujukan']) ?></td>
                        <td><?= esc($rujukan['ibuNama']) ?></td>
                        <td><?= esc($rujukan['kepada']) ?></td>
                        <td><?= esc($rujukan['alamat']) ?></td>
                        <td><?= esc($rujukan['hasilPemeriksaan']) ?></td>
                        <td>
                            <a href="/view-rujukan-ibu/<?= esc($rujukan['rujukanIbuID']) ?>" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:eye"></iconify-icon>
                            </a>
                            <a href="/edit-rujukan-ibu/<?= esc($rujukan['rujukanIbuID']) ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a type="button" onclick="confirmDelete('<?= esc($rujukan['rujukanIbuID']) ?>')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                            <form id="deleteForm_<?= esc($rujukan['rujukanIbuID']) ?>" action="<?= site_url('delete-rujukan-ibu') ?>" method="post">
                                <input type="hidden" name="rujukanIbuID" value="<?= esc($rujukan['rujukanIbuID']) ?>">
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

    function confirmDelete(rujukanIbuID) {
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
                $('#deleteForm_' + rujukanIbuID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>