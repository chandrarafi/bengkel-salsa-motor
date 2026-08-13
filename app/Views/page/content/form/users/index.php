<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<style>
    .basic-data-table .dataTables_wrapper .dataTables_length,
    .basic-data-table .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px !important;
        font-size: 13px !important;
    }
    .basic-data-table .dataTables_wrapper .dataTables_length label,
    .basic-data-table .dataTables_wrapper .dataTables_filter label {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-size: 13px !important;
        color: #4b5563 !important;
        margin-bottom: 0 !important;
    }
    .basic-data-table .dataTables_wrapper .dataTables_length select {
        padding: 4px 28px 4px 10px !important;
        font-size: 13px !important;
        border-radius: 6px !important;
        height: 34px !important;
        display: inline-block !important;
        width: auto !important;
    }
    .basic-data-table .dataTables_wrapper .dataTables_filter input {
        padding: 4px 10px !important;
        font-size: 13px !important;
        border-radius: 6px !important;
        height: 34px !important;
        display: inline-block !important;
        width: auto !important;
        border: 1px solid #d1d5db !important;
    }
    .bordered-table th {
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 10px 12px !important;
        background-color: #f8f9fa !important;
        color: #374151 !important;
        white-space: nowrap;
    }
    .bordered-table td {
        font-size: 13px !important;
        padding: 8px 12px !important;
        vertical-align: middle !important;
        color: #4b5563 !important;
    }
    .dataTables_info, .dataTables_paginate {
        font-size: 13px !important;
        margin-top: 14px !important;
    }
    .pagination .page-link {
        padding: 4px 10px !important;
        font-size: 12px !important;
    }
</style>

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-20">
    <h6 class="fw-semibold mb-0 text-lg">Manajemen User</h6>
    <ul class="d-flex align-items-center gap-2 text-sm">
        <li class="fw-medium">
            <a href="<?= site_url('dashboard') ?>" class="d-flex align-items-center gap-1 hover-text-primary text-secondary-light">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-base"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-secondary-light">-</li>
        <li class="fw-medium text-secondary-light">Kelola User</li>
    </ul>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-20 alert alert-success bg-success-100 text-success-600 border-success-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:check-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('success') ?>
        </div>
        <button class="remove-button text-success-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:close-circle-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('error') ?>
        </div>
        <button class="remove-button text-danger-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('msg')) : ?>
    <div class="mb-20 alert alert-info bg-info-100 text-info-600 border-info-100 px-16 py-10 radius-8 d-flex align-items-center justify-content-between text-sm" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:information-fill" class="icon text-lg"></iconify-icon>
            <?= session()->getFlashdata('msg') ?>
        </div>
        <button class="remove-button text-info-600 text-lg line-height-1 border-0 bg-transparent"><iconify-icon icon="iconamoon:sign-times-light"></iconify-icon></button>
    </div>
<?php endif; ?>

<!-- User Data Table Card -->
<div class="card basic-data-table radius-12 border">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 px-20 py-14 border-bottom border-neutral-200">
        <h6 class="card-title mb-0 text-base fw-bold">Daftar Data User</h6>
        <a href="<?= site_url('admin/users/create') ?>" class="btn btn-primary-600 radius-8 px-16 py-8 text-sm d-flex align-items-center gap-2">
            <iconify-icon icon="mingcute:user-add-fill" class="text-base"></iconify-icon> Tambah User
        </a>
    </div>
    <div class="card-body p-20">
        <div class="table-responsive">
            <table class="table bordered-table align-middle text-sm mb-0" id="dataTable" data-page-length="10" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 40px;">#</th>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Level Access</th>
                        <th scope="col">Alamat</th>
                        <th scope="col" class="text-center" style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $users = $users ?? [];
                        if (!empty($users)) : 
                            $no = 1; 
                            foreach ($users as $user) : 
                    ?>
                        <tr>
                            <td class="text-center text-xs text-secondary-light"><?= $no++ ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="w-32-px h-32-px rounded-circle bg-primary-50 text-primary-600 d-flex align-items-center justify-content-center fw-bold text-xs flex-shrink-0">
                                        <?= strtoupper(substr($user['nama'], 0, 2)) ?>
                                    </div>
                                    <div>
                                        <span class="fw-semibold text-neutral-800 text-sm d-block line-height-1 mb-1"><?= esc($user['nama']) ?></span>
                                        <span class="text-xs text-secondary-light">ID: #<?= esc($user['id']) ?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary-light text-xs"><?= esc($user['email']) ?></span>
                            </td>
                            <td>
                                <span class="text-secondary-light text-xs"><?= esc($user['no_hp'] ?: '-') ?></span>
                            </td>
                            <td>
                                <?php
                                    $level = strtolower($user['level']);
                                    if ($level === 'admin') {
                                        echo '<span class="badge bg-success-focus text-success-main px-10 py-4 rounded-pill fw-semibold text-xs d-inline-flex align-items-center gap-1"><iconify-icon icon="solar:shield-user-bold"></iconify-icon> Admin</span>';
                                    } elseif ($level === 'pimpinan') {
                                        echo '<span class="badge bg-primary-focus text-primary-600 px-10 py-4 rounded-pill fw-semibold text-xs d-inline-flex align-items-center gap-1"><iconify-icon icon="solar:crown-bold"></iconify-icon> Pimpinan</span>';
                                    } else {
                                        echo '<span class="badge bg-info-focus text-info-main px-10 py-4 rounded-pill fw-semibold text-xs d-inline-flex align-items-center gap-1"><iconify-icon icon="solar:user-bold"></iconify-icon> Pelanggan</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <span class="text-secondary-light text-xs text-truncate d-inline-block" style="max-width: 180px;" title="<?= esc($user['alamat'] ?: '-') ?>">
                                    <?= esc($user['alamat'] ?: '-') ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <a href="<?= site_url('admin/users/edit/' . esc($user['id'])) ?>" class="w-28-px h-28-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-success-main hover-text-white text-xs" title="Edit User">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <?php if ((int)$user['id'] !== (int)session()->get('user_id')): ?>
                                        <button type="button" onclick="confirmDelete(<?= esc($user['id']) ?>, '<?= esc($user['nama']) ?>')" class="w-28-px h-28-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center hover-bg-danger-main hover-text-white border-0 text-xs" title="Hapus User">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </button>
                                        <form id="deleteForm_<?= esc($user['id']) ?>" action="<?= site_url('admin/users/delete/' . esc($user['id'])) ?>" method="get" class="d-none">
                                        </form>
                                    <?php else: ?>
                                        <span class="w-28-px h-28-px bg-neutral-200 text-neutral-400 rounded-circle d-inline-flex align-items-center justify-content-center text-xs" title="Akun Aktif Anda">
                                            <iconify-icon icon="solar:lock-outline"></iconify-icon>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center text-secondary-light py-4">Belum ada data user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        if ($('#dataTable').length) {
            new DataTable('#dataTable', {
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Tidak ada data user yang ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ user",
                    infoEmpty: "Menampilkan 0 user",
                    infoFiltered: "(disaring dari _MAX_ total user)",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        }
    });

    function confirmDelete(userID, userName) {
        Swal.fire({
            title: 'Hapus User?',
            html: `Yakin ingin menghapus user <strong>${userName}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-danger radius-8 px-16 py-6 text-sm me-2',
                cancelButton: 'btn btn-secondary radius-8 px-16 py-6 text-sm'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm_' + userID).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>
