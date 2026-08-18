<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Area Pelanggan - Bengkel Salsa Motor') ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>" sizes="16x16">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <?php include(APPPATH . 'Views/assets/css.php') ?>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: #f1f5f9;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Dark Modern Navbar (Identical to Landing Page) */
        .landing-navbar {
            background-color: #121824 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 10px 0;
            z-index: 1040;
            transition: all 0.3s ease;
        }

        .nav-link-custom {
            color: #94a3b8 !important;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            padding: 8px 16px !important;
            border-radius: 4px;
            transition: all 0.2s ease;
            text-transform: uppercase;
        }

        .nav-link-custom:hover {
            color: #ffffff !important;
        }

        .nav-link-custom.active {
            color: #ff5500 !important;
            background-color: rgba(255, 85, 0, 0.12);
        }

        /* User Circle Button */
        .btn-nav-user {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #1e293b;
            color: #cbd5e1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.12);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-nav-user:hover {
            background-color: #ff5500;
            color: #ffffff;
            border-color: #ff5500;
        }

        /* Customer Container */
        .customer-main-content {
            flex: 1;
            padding: 36px 0 60px;
        }

        /* Card Styling */
        .card-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-body-custom {
            padding: 24px;
        }

        /* Button Accent */
        .btn-brand {
            background-color: #ff5500;
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 6px;
            padding: 8px 18px;
            transition: all 0.2s ease;
        }

        .btn-brand:hover {
            background-color: #e04b00;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .customer-footer {
            background-color: #0b101b;
            color: #94a3b8;
            padding: 20px 0;
            border-top: 1px solid #1e293b;
            font-size: 0.8125rem;
        }
    </style>
</head>

<body>

    <!-- DARK MODERN NAVBAR (MATCHING LANDING PAGE) -->
    <header class="landing-navbar sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg py-0">
                <!-- Brand Logo -->
                <a class="navbar-brand d-flex align-items-center me-4 py-0" href="<?= site_url('/') ?>">
                    <img src="<?= base_url('assets/images/logo-light.png') ?>" alt="Bengkel Salsa Motor" style="height: 32px; width: auto;" class="d-inline-block">
                </a>

                <!-- Mobile Toggler -->
                <button class="navbar-toggler border-0 shadow-none p-1 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#customerNav" aria-controls="customerNav" aria-expanded="false" aria-label="Toggle navigation">
                    <iconify-icon icon="solar:hamburger-menu-linear" class="text-2xl text-white"></iconify-icon>
                </button>

                <!-- Navigation Links (HOME, SERVICES, BOOKING, ABOUT US, CONTACT) -->
                <div class="collapse navbar-collapse" id="customerNav">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/') ?>">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/#layanan') ?>">SERVICES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom <?= url_is('booking*') || url_is('pelanggan/booking*') ? 'active' : '' ?>" href="<?= site_url('booking') ?>">BOOKING</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/#keunggulan') ?>">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/#kontak') ?>">CONTACT</a>
                        </li>
                    </ul>

                    <!-- Right User Action Button (Like Landing Page) -->
                    <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                        <div class="dropdown">
                            <button class="btn-nav-user" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Akun Pelanggan">
                                <iconify-icon icon="solar:user-bold" class="text-lg"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm radius-12 border-neutral-200 mt-2">
                                <li class="px-16 py-8 border-bottom">
                                    <p class="text-xxs text-secondary-light mb-1">Masuk sebagai Pelanggan:</p>
                                    <p class="text-xs fw-bold text-dark mb-0"><?= esc(session()->get('userNama')) ?></p>
                                    <span class="badge bg-primary-50 text-primary-600 text-xxs fw-bold uppercase mt-1"><?= esc(session()->get('userRole') ?? 'pelanggan') ?></span>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs <?= url_is('booking*') ? 'text-primary-600 fw-bold' : '' ?>" href="<?= site_url('booking') ?>">
                                        <iconify-icon icon="solar:calendar-add-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                        <span>Booking Servis Online</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs <?= url_is('riwayat-booking*') ? 'text-primary-600 fw-bold' : '' ?>" href="<?= site_url('riwayat-booking') ?>">
                                        <iconify-icon icon="solar:calendar-mark-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                        <span>Riwayat Booking Saya</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs <?= url_is('riwayat-servis*') ? 'text-primary-600 fw-bold' : '' ?>" href="<?= site_url('riwayat-servis') ?>">
                                        <iconify-icon icon="solar:history-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                        <span>Riwayat Servis Motor</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs <?= url_is('profil*') ? 'text-primary-600 fw-bold' : '' ?>" href="<?= site_url('profil') ?>">
                                        <iconify-icon icon="solar:user-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                        <span>Profil Saya</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs text-danger-main" href="<?= site_url('logout') ?>">
                                        <iconify-icon icon="lucide:power" class="text-base"></iconify-icon>
                                        <span>Keluar (Logout)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="customer-main-content">
        <div class="container">
            <!-- Flash Message Alerts -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success bg-success-50 text-success-700 border-success-200 radius-10 p-16 mb-20 d-flex align-items-center justify-content-between text-sm" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-circle-bold" class="text-xl text-success-main"></iconify-icon>
                        <span><?= session()->getFlashdata('success') ?></span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger bg-danger-50 text-danger-700 border-danger-200 radius-10 p-16 mb-20 d-flex align-items-center justify-content-between text-sm" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:danger-triangle-bold" class="text-xl text-danger-main"></iconify-icon>
                        <span><?= session()->getFlashdata('error') ?></span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="customer-footer">
        <div class="container text-center text-xs">
            <p class="mb-0">&copy; <?= date('Y') ?> Bengkel Salsa Motor. Area Khusus Pelanggan. Pelayanan Prima & Performa Maksimal.</p>
        </div>
    </footer>

    <?php include(APPPATH . 'Views/assets/js.php') ?>
    <?= $this->renderSection('script') ?>

</body>

</html>
