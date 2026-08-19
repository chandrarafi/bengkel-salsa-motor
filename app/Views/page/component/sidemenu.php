<?php
helper('url');
$currentUri = uri_string();
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

$isLaporanBarangMasukActive = (
  strpos($currentUri, 'laporan/barangmasuk') !== false ||
  strpos($requestUri, 'laporan/barangmasuk') !== false ||
  url_is('admin/laporan/barangmasuk*')
);

$isBarangMasukActive = !$isLaporanBarangMasukActive && (
  strpos($currentUri, 'barangmasuk') !== false ||
  strpos($requestUri, 'barangmasuk') !== false ||
  url_is('admin/barangmasuk*') ||
  url_is('barangmasuk*')
);

$isLaporanBarangActive = (
  strpos($currentUri, 'laporan/barang') !== false ||
  strpos($requestUri, 'laporan/barang') !== false ||
  url_is('admin/laporan/barang*')
);

$isBarangActive = !$isBarangMasukActive && !$isLaporanBarangActive && (
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

$isLaporanTransaksiServisActive = (
  strpos($currentUri, 'laporan/transaksiservis') !== false ||
  strpos($requestUri, 'laporan/transaksiservis') !== false ||
  url_is('admin/laporan/transaksiservis*')
);

$isTransaksiServisActive = !$isLaporanTransaksiServisActive && (
  strpos($currentUri, 'transaksiservis') !== false ||
  strpos($requestUri, 'transaksiservis') !== false ||
  url_is('admin/transaksiservis*') ||
  url_is('transaksiservis*')
);

$isLaporanServisActive = (
  strpos($currentUri, 'laporan/servis') !== false ||
  strpos($requestUri, 'laporan/servis') !== false ||
  url_is('admin/laporan/servis*')
);

$isServisActive = !$isTransaksiServisActive && !$isLaporanServisActive && (
  strpos($currentUri, 'servis') !== false ||
  strpos($requestUri, 'servis') !== false ||
  url_is('admin/servis*') ||
  url_is('servis*')
);

$isSettingBookingActive = (
  strpos($currentUri, 'admin/booking/setting') !== false ||
  url_is('admin/booking/setting*')
);

$isLaporanBookingActive = (
  strpos($currentUri, 'laporan/booking') !== false ||
  strpos($requestUri, 'laporan/booking') !== false ||
  url_is('admin/laporan/booking*')
);

$isBookingActive = !$isSettingBookingActive && !$isLaporanBookingActive && (
  strpos($currentUri, 'admin/booking') !== false ||
  strpos($requestUri, 'admin/booking') !== false ||
  url_is('admin/booking*')
);

$isLaporanPenjualanActive = (
  strpos($currentUri, 'laporan/penjualan') !== false ||
  strpos($requestUri, 'laporan/penjualan') !== false ||
  url_is('admin/laporan/penjualan*')
);

$isPenjualanActive = !$isLaporanPenjualanActive && (
  strpos($currentUri, 'penjualan') !== false ||
  strpos($requestUri, 'penjualan') !== false ||
  url_is('admin/penjualan*') ||
  url_is('penjualan*')
);

$pendingBookingCount = 0;
try {
  $bookingModelForBadge = new \App\Models\BookingModel();
  $pendingBookingCount = $bookingModelForBadge->countPendingApproval();
} catch (\Throwable $e) {
  $pendingBookingCount = 0;
}

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

    <!-- Booking Servis Online -->
    <li class="mb-10 <?= $isBookingActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/booking') ?>" class="<?= $isBookingActive ? 'active-page' : '' ?> d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <iconify-icon icon="solar:calendar-mark-bold-duotone" class="menu-icon"></iconify-icon>
          <span>Booking Servis</span>
        </div>
        <?php if ($pendingBookingCount > 0): ?>
          <span class="badge bg-warning-500 text-white text-xxs fw-bold px-6 py-2 radius-4 me-2"><?= $pendingBookingCount ?></span>
        <?php endif; ?>
      </a>
    </li>

    <!-- Transaksi Servis (Work Order) -->
    <li class="mb-10 <?= $isTransaksiServisActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/transaksiservis') ?>" class="<?= $isTransaksiServisActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:settings-minimalistic-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Transaksi Servis</span>
      </a>
    </li>

    <!-- GROUP 3: LAPORAN -->
    <li class="sidebar-menu-group-title">Laporan</li>

    <!-- Laporan Barang -->
    <li class="mb-10 <?= $isLaporanBarangActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/laporan/barang') ?>" class="<?= $isLaporanBarangActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:document-text-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Laporan Barang</span>
      </a>
    </li>

    <!-- Laporan Jenis Servis -->
    <li class="mb-10 <?= $isLaporanServisActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/laporan/servis') ?>" class="<?= $isLaporanServisActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:settings-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Laporan Jenis Servis</span>
      </a>
    </li>

    <!-- Laporan Barang Masuk -->
    <li class="mb-10 <?= $isLaporanBarangMasukActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/laporan/barangmasuk') ?>" class="<?= $isLaporanBarangMasukActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:cart-large-minimalistic-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Laporan Barang Masuk</span>
      </a>
    </li>

    <!-- Laporan Penjualan Barang -->
    <li class="mb-10 <?= $isLaporanPenjualanActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/laporan/penjualan') ?>" class="<?= $isLaporanPenjualanActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:bag-smile-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Laporan Penjualan Barang</span>
      </a>
    </li>

    <!-- Laporan Booking Servis -->
    <li class="mb-10 <?= $isLaporanBookingActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/laporan/booking') ?>" class="<?= $isLaporanBookingActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:calendar-mark-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Laporan Booking Servis</span>
      </a>
    </li>

    <!-- Laporan Transaksi Servis -->
    <li class="mb-10 <?= $isLaporanTransaksiServisActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/laporan/transaksiservis') ?>" class="<?= $isLaporanTransaksiServisActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:settings-minimalistic-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Laporan Transaksi Servis</span>
      </a>
    </li>


    <!-- GROUP 3: PENGATURAN -->
    <li class="sidebar-menu-group-title">Pengaturan</li>

    <!-- Pengaturan Booking -->
    <li class="mb-10 <?= $isSettingBookingActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/booking/setting') ?>" class="<?= $isSettingBookingActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:calendar-settings-bold-duotone" class="menu-icon"></iconify-icon>
        <span>Pengaturan Booking</span>
      </a>
    </li>

    <!-- Kelola User -->
    <li class="mb-10 <?= $isUsersActive ? 'active active-page' : '' ?>">
      <a href="<?= site_url('admin/users') ?>" class="<?= $isUsersActive ? 'active-page' : '' ?>">
        <iconify-icon icon="solar:users-group-two-rounded-outline" class="menu-icon"></iconify-icon>
        <span>Kelola User</span>
      </a>
    </li>
  <?php endif; ?>
</ul>