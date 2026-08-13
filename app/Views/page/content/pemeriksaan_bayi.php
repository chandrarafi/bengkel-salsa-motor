<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Pemeriksaan Bayi</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="material-symbols:note-alt" class="icon text-lg"></iconify-icon>
                Pelayanan Pasien
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('view-bayi/' . $bayi['bayiID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:baby-face" class="icon text-lg"></iconify-icon>
                Bayi
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">
            <a href="<?= site_url('pemeriksaan-bayi/' . $bayi['bayiID']) ?>" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="mdi:clipboard-text-outline" class="icon text-lg"></iconify-icon>
                Pemeriksaan Bayi
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
                <h5 class="card-title mb-0">Pemeriksaan Bayi <?= esc($bayi['bayiID']) ?> (<?= esc($bayi['bayiNama']) ?>)</h5>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center gap-3 mt-20">
                    <a href="<?= site_url('view-bayis/' . esc($bayi['bayiID'])) ?>" class="btn border border-primary-600bg-hover-primary-200 text-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:arrow-left-line" class="text-xl"></iconify-icon> Kembali
                    </a>
                    <a href="<?= site_url('add-pemeriksaan-bayi/' . esc($bayi['bayiID'])) ?>" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                        <iconify-icon icon="mingcute:table-2-line" class="text-xl"></iconify-icon> Pemeriksaan Baru
                    </a>
                </div>
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
                    <th scope="col">BB Pemeriksaan</th>
                    <th scope="col">TB Pemeriksaan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Imunisasi Bayi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pemeriksaanBayis as $pemeriksaanBayi) : ?>
                    <tr>
                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    <?= esc($pemeriksaanBayi['pemeriksaanBayiID']) ?>
                                </label>
                            </div>
                        </td>
                        <td><?= esc($pemeriksaanBayi['bbPemeriksaanBayi']) ?></td>
                        <td><?= esc($pemeriksaanBayi['tbPemeriksaanBayi']) ?></td>
                        <td><?= esc($pemeriksaanBayi['status']) ?></td>
                        <td><?= esc($pemeriksaanBayi['imunisasiBayi']) ?></td>
                        <td>
                            <a href="/view-pemeriksaan-bayi/<?= esc($pemeriksaanBayi['pemeriksaanBayiID']) ?>" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:eye"></iconify-icon>
                            </a>
                            <a href="/edit-pemeriksaan-bayi/<?= esc($pemeriksaanBayi['pemeriksaanBayiID']) ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a type="button" onclick="confirmDelete('<?= esc($pemeriksaanBayi['pemeriksaanBayiID']) ?>')" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                            <form id="deleteForm_<?= esc($pemeriksaanBayi['pemeriksaanBayiID']) ?>" action="<?= site_url('delete-pemeriksaan-bayi') ?>" method="post">
                                <input type="hidden" name="pemeriksaanBayiID" value="<?= esc($pemeriksaanBayi['pemeriksaanBayiID']) ?>">
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

    function confirmDelete(pemeriksaanBayiID) {
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
                $('#deleteForm_' + pemeriksaanBayiID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>