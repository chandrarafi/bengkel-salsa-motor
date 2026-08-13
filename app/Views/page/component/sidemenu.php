<?php
helper('url');
$currentUri = uri_string();
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

$isBarangMasukActive = (
  strpos($currentUri, 'barangmasuk') !== false ||
  strpos($requestUri, 'barangmasuk') !== false ||
  url_is('admin/barangmasuk*') ||
  url_is('barangmasuk*')
);

$isBarangActive = !$isBarangMasukActive && (
  strpos($currentUri, 'admin/barang') !== false ||
  strpos($currentUri, 'barang/') !== false ||
  $currentUri === 'barang' ||
  url_is('admin/barang') ||
  url_is('admin/barang/*') ||
  url_is('barang') ||
  url_is('barang/*')
);

$isUsersActive = (
  strpos($currentUri, 'users') !== false ||
  strpos($requestUri, 'users') !== false ||
  url_is('admin/users*') ||
  url_is('users*')
);

$isKategoriActive = (
  strpos($currentUri, 'kategori') !== false ||
  strpos($requestUri, 'kategori') !== false ||
  url_is('admin/kategori*') ||
  url_is('kategori*')
);

$isSatuanActive = (
  strpos($currentUri, 'satuan') !== false ||
  strpos($requestUri, 'satuan') !== false ||
  url_is('admin/satuan*') ||
  url_is('satuan*')
);

$isTransaksiServisActive = (
  strpos($currentUri, 'transaksiservis') !== false ||
  strpos($requestUri, 'transaksiservis') !== false ||
  url_is('admin/transaksiservis*') ||
  url_is('transaksiservis*')
);

$isServisActive = !$isTransaksiServisActive && (
  strpos($currentUri, 'servis') !== false ||
  strpos($requestUri, 'servis') !== false ||
  url_is('admin/servis*') ||
  url_is('servis*')
);

$isPenjualanActive = (
  strpos($currentUri, 'penjualan') !== false ||
  strpos($requestUri, 'penjualan') !== false ||
  url_is('admin/penjualan*') ||
  url_is('penjualan*')
);

$isDashboardActive = (
  !$isUsersActive &&
  !$isKategoriActive &&
  !$isSatuanActive &&
  !$isBarangActive &&
  !$isServisActive &&
  !$isBarangMasukActive &&
  !$isPenjualanActive &&
  (strpos($currentUri, 'dashboard') !== false || $currentUri === '' || $currentUri === '/')
);

$role = strtolower(session()->get('userRole') ?? '');
$isAdminOrPimpinan = in_array($role, ['admin', 'pimpinan']) || session()->get('isLoggedIn');
?>
<ul class="sidebar-menu" id="sidebar-menu">
  <!-- DASHBOARD -->
  <li class="mb-10 <?= $isDashboardActive ? 'active active-page' : '' ?>">
    <a href="<?= site_url('dashboard') ?>" class="<?= $isDashboardActive ? 'active-page' : '' ?>">
      <iconify-icon icon="solar:home-smile-outline" class="menu-icon"></iconify-icon>
      <span>Dashboard</span>
    </a>
  </li>

  <?php if ($isAdminOrPimpinan): ?>
    <!-- GROUP 1: DATA MASTER -->
    <li class="sidebar-menu-group-title">Data Master</li>

    <!-- Barang -->
    <li class="mb-10 <?= $isBarangActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/barang') ?>" class="<?= $isBarangActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:box-minimalistic-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Barang</span>
      </a>
    </li>

    <!-- Jasa Servis -->
    <li class="mb-10 <?= $isServisActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/servis') ?>" class="<?= $isServisActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:settings-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Jasa Servis</span>
      </a>
    </li>

    <!-- Kategori -->
    <li class="mb-10 <?= $isKategoriActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/kategori') ?>" class="<?= $isKategoriActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:tag-horizontal-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Kategori</span>
      </a>
    </li>

    <!-- Satuan -->
    <li class="mb-10 <?= $isSatuanActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/satuan') ?>" class="<?= $isSatuanActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:box-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Satuan</span>
      </a>
    </li>

    <!-- GROUP 2: TRANSAKSI -->
    <li class="sidebar-menu-group-title">Transaksi</li>


    <!-- Barang Masuk -->
    <li class="mb-10 <?= $isBarangMasukActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/barangmasuk') ?>" class="<?= $isBarangMasukActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:cart-large-minimalistic-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Barang Masuk</span>
      </a>
    </li>

    <!-- Penjualan Barang (POS) -->
    <li class="mb-10 <?= $isPenjualanActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/penjualan') ?>" class="<?= $isPenjualanActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:bag-smile-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Penjualan Barang</span>
      </a>
    </li>

    <!-- Transaksi Servis (Work Order) -->
    <li class="mb-10 <?= $isTransaksiServisActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/transaksiservis') ?>" class="<?= $isTransaksiServisActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:settings-minimalistic-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Transaksi Servis</span>
      </a>
    </li>


    <!-- GROUP 3: PENGATURAN -->
    <li class="sidebar-menu-group-title">Pengaturan</li>

    <!-- Kelola User -->
    <li class="mb-10 <?= $isUsersActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/users') ?>" class="<?= $isUsersActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:users-group-two-rounded-outline" class="menu-icon"></iconify-icon>
        <span>Kelola User</span>
      </a>
    </li>
  <?php endif; ?>
</ul>