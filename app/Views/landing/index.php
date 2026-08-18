<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Bengkel Salsa Motor - Servis Motor Profesional, Performa Maksimal') ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>" sizes="16x16">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <?php include(APPPATH . 'Views/assets/css.php') ?>

    <style>
        :root {
            --bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
            --brand-primary: #ff5500;
            --brand-hover: #e04b00;
            --dark-nav: #121824;
            --dark-hero: #0b101b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }

        /* Dark Modern Automotive Navbar */
        .landing-navbar {
            background-color: #121824 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            transition: all 0.25s ease;
            z-index: 1040;
            padding: 12px 0;
        }

        .landing-navbar.scrolled {
            background-color: rgba(18, 24, 36, 0.98) !important;
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            padding: 10px 0;
        }

        .landing-navbar .navbar-nav .nav-link,
        .landing-navbar .navbar-nav .nav-link-custom {
            color: #cbd5e1 !important;
            font-weight: 700 !important;
            font-size: 0.8125rem !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase !important;
            padding: 8px 16px !important;
            border-radius: 4px;
            white-space: nowrap;
            transition: all 0.2s ease;
            position: relative;
            background: transparent !important;
        }

        .landing-navbar .navbar-nav .nav-link:hover,
        .landing-navbar .navbar-nav .nav-link-custom:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.06) !important;
        }

        .landing-navbar .navbar-nav .nav-link:focus,
        .landing-navbar .navbar-nav .nav-link-custom:focus {
            color: #ff5500 !important;
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        .landing-navbar .navbar-nav .nav-link.active,
        .landing-navbar .navbar-nav .nav-link-custom.active,
        .landing-navbar .navbar-nav .nav-link.show,
        .landing-navbar .navbar-nav .show > .nav-link {
            color: #ff5500 !important;
            background: transparent !important;
        }

        .landing-navbar .navbar-nav .nav-link-custom.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 14px;
            right: 14px;
            height: 3px;
            background-color: #ff5500 !important;
            border-radius: 2px;
        }

        /* Header User Button */
        .btn-nav-user {
            width: 36px;
            height: 36px;
            background-color: #ff5500;
            color: #ffffff;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-nav-user:hover {
            background-color: #e04b00;
            transform: translateY(-1px);
        }

        /* High-Impact Hero Section (Like Image 2) */
        .hero-section {
            padding: 160px 0 110px;
            background: linear-gradient(90deg, rgba(11, 16, 27, 0.95) 0%, rgba(11, 16, 27, 0.88) 45%, rgba(11, 16, 27, 0.65) 75%, rgba(11, 16, 27, 0.4) 100%), 
                        url('<?= base_url("assets/images/hero-workshop.jpg") ?>') center right / cover no-repeat;
            position: relative;
            min-height: 82vh;
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: clamp(2.4rem, 1.8rem + 3vw, 4rem);
            font-weight: 900;
            line-height: 1.12;
            color: #ffffff;
            letter-spacing: -0.01em;
            text-transform: uppercase;
        }

        .text-orange-accent {
            color: #ff5500;
            display: block;
        }

        .hero-desc {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #cbd5e1;
            max-width: 580px;
        }

        /* Hero Action Buttons */
        .btn-hero-primary {
            background-color: #ff5500;
            color: #ffffff;
            font-weight: 800;
            font-size: 0.875rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 14px 28px;
            border-radius: 6px;
            border: 2px solid #ff5500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-primary:hover {
            background-color: #e04b00;
            border-color: #e04b00;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 85, 0, 0.35);
        }

        .btn-hero-secondary {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-weight: 800;
            font-size: 0.875rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 14px 28px;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(4px);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-secondary:hover {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: #ffffff;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Stats Bar */
        .stat-bar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            margin-top: -40px;
            position: relative;
            z-index: 20;
        }

        /* Section Global */
        .section-padding {
            padding: 80px 0;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8125rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 4px 12px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: clamp(1.8rem, 1.4rem + 1vw, 2.3rem);
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.01em;
            line-height: 1.3;
        }

        .section-subtitle {
            font-size: 0.95rem;
            color: #64748b;
            max-width: 620px;
            margin: 0 auto;
        }

        /* Feature Card */
        .feature-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 28px 22px;
            height: 100%;
            transition: all 0.25s ease;
            position: relative;
            border-top: 3px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-top-color: #ff5500;
            box-shadow: 0 16px 24px -6px rgba(0, 0, 0, 0.07);
        }

        .feature-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
            background: rgba(255, 85, 0, 0.1);
            color: #ff5500;
        }

        /* Service Card */
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s ease;
        }

        .service-card:hover {
            border-color: #ff5500;
            box-shadow: 0 14px 24px -6px rgba(255, 85, 0, 0.12);
            transform: translateY(-3px);
        }

        .service-price {
            font-size: 1.3rem;
            font-weight: 900;
            color: #0f172a;
        }

        /* Step Card */
        .step-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 26px 18px;
            text-align: center;
            height: 100%;
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            background: #ff5500;
            color: #ffffff;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            margin-bottom: 14px;
        }

        /* Booking Form Card */
        .booking-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 32px 28px;
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.06);
            border-top: 4px solid #ff5500;
        }

        /* Portal Banner */
        .portal-callout {
            background: linear-gradient(135deg, #121824 0%, #0b101b 100%);
            border-radius: 14px;
            padding: 42px 36px;
            color: #ffffff;
            border-left: 5px solid #ff5500;
        }

        /* Testimonial Card */
        .testimonial-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            height: 100%;
        }

        /* Footer */
        .landing-footer {
            background: #0b101b;
            color: #94a3b8;
            padding-top: 54px;
            padding-bottom: 24px;
            border-top: 1px solid #1e293b;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
            font-size: 0.875rem;
            display: inline-block;
            margin-bottom: 6px;
        }

        .footer-link:hover {
            color: #ff5500;
            transform: translateX(2px);
        }

        .btn-brand {
            background-color: #ff5500;
            color: #ffffff;
            font-weight: 700;
            border: none;
        }

        .btn-brand:hover {
            background-color: #e04b00;
            color: #ffffff;
        }
    </style>
</head>

<body>

    <!-- DARK MODERN NAVBAR -->
    <header class="landing-navbar fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg py-0">
                <!-- Brand Logo -->
                <a class="navbar-brand d-flex align-items-center me-4 py-0" href="<?= site_url('/') ?>">
                    <img src="<?= base_url('assets/images/logo-light.png') ?>" alt="Bengkel Salsa Motor" style="height: 32px; width: auto;" class="d-inline-block">
                </a>

                <!-- Mobile Toggler -->
                <button class="navbar-toggler border-0 shadow-none p-1 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav" aria-controls="landingNav" aria-expanded="false" aria-label="Toggle navigation">
                    <iconify-icon icon="solar:hamburger-menu-linear" class="text-2xl text-white"></iconify-icon>
                </button>

                <!-- Navigation Links (Like Image 2: HOME, SERVICES, BOOKING, ABOUT US, CONTACT) -->
                <div class="collapse navbar-collapse" id="landingNav">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/') ?>#beranda">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/') ?>#layanan">SERVICES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('booking') ?>">BOOKING</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/') ?>#keunggulan">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="<?= site_url('/') ?>#kontak">CONTACT</a>
                        </li>
                    </ul>

                    <!-- Right User Action Button (Like Image 2) -->
                    <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                        <?php if ($isLoggedIn): ?>
                            <!-- Logged In User Dropdown -->
                            <div class="dropdown">
                                <button class="btn-nav-user" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Akun Pelanggan">
                                    <iconify-icon icon="solar:user-bold" class="text-lg"></iconify-icon>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm radius-12 border-neutral-200 mt-2">
                                    <li class="px-16 py-8 border-bottom">
                                        <p class="text-xxs text-secondary-light mb-1">Masuk sebagai:</p>
                                        <p class="text-xs fw-bold text-dark mb-0"><?= esc($userData['nama']) ?></p>
                                        <span class="badge bg-primary-50 text-primary-600 text-xxs fw-bold uppercase mt-1"><?= esc($userData['role']) ?></span>
                                    </li>
                                    <?php if (in_array(strtolower($userData['role'] ?? ''), ['admin', 'pimpinan'])): ?>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs" href="<?= site_url('dashboard') ?>">
                                                <iconify-icon icon="solar:widget-2-bold-duotone" class="text-primary-600 text-base"></iconify-icon>
                                                <span>Dashboard Admin</span>
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs" href="<?= site_url('booking') ?>">
                                                <iconify-icon icon="solar:calendar-add-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                                <span>Booking Servis Online</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs" href="<?= site_url('riwayat-booking') ?>">
                                                <iconify-icon icon="solar:calendar-mark-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                                <span>Riwayat Booking Saya</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs" href="<?= site_url('riwayat-servis') ?>">
                                                <iconify-icon icon="solar:history-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                                <span>Riwayat Servis Motor</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs" href="<?= site_url('profil') ?>">
                                                <iconify-icon icon="solar:user-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                                <span>Profil Saya</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-8 text-xs text-danger-main" href="<?= site_url('logout') ?>">
                                            <iconify-icon icon="lucide:power" class="text-base"></iconify-icon>
                                            <span>Keluar (Logout)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="<?= site_url('login') ?>" class="btn-nav-user text-decoration-none" title="Masuk / Login">
                                <iconify-icon icon="solar:user-bold" class="text-lg"></iconify-icon>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION (MATCHING IMAGE 2) -->
    <section class="hero-section" id="beranda">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <!-- Bold Headline with Orange Accent -->
                    <h1 class="hero-title mb-24">
                        SERVIS MOTOR PROFESIONAL,
                        <span class="text-orange-accent">PERFORMA MAKSIMAL.</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="hero-desc mb-36">
                        Teknisi ahli, suku cadang asli, dan layanan cepat untuk motor kesayangan Anda. Keandalan tanpa kompromi.
                    </p>

                    <!-- Dual Action Buttons (Like Image 2) -->
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <a href="#booking-section" class="btn btn-hero-primary">
                            BOOKING SERVIS SEKARANG
                        </a>
                        <a href="#layanan" class="btn btn-hero-secondary">
                            LIHAT LAYANAN
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS COUNTER BAR -->
    <div class="container">
        <div class="stat-bar">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3 border-end-md">
                    <h3 class="fw-bold mb-1" style="color: #ff5500;">5.000+</h3>
                    <p class="text-xs text-secondary-light mb-0 fw-semibold text-uppercase">Motor Tertangani</p>
                </div>
                <div class="col-6 col-md-3 border-end-md">
                    <h3 class="fw-bold mb-1" style="color: #ff5500;">100%</h3>
                    <p class="text-xs text-secondary-light mb-0 fw-semibold text-uppercase">Suku Cadang Asli</p>
                </div>
                <div class="col-6 col-md-3 border-end-md">
                    <h3 class="fw-bold mb-1" style="color: #ff5500;">4.9 / 5</h3>
                    <p class="text-xs text-secondary-light mb-0 fw-semibold text-uppercase">Kepuasan Pelanggan</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="fw-bold mb-1" style="color: #ff5500;">30 Hari</h3>
                    <p class="text-xs text-secondary-light mb-0 fw-semibold text-uppercase">Garansi Pengerjaan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- DAFTAR LAYANAN SERVIS (DYNAMIC FROM DB) -->
    <section class="section-padding bg-white" id="layanan">
        <div class="container">
            <div class="text-center mb-48">
                <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">SERVICES</span>
                <h2 class="section-title mb-10">Layanan Servis & Estimasi Biaya</h2>
                <p class="section-subtitle">Standar pengerjaan mekanik ahli dengan transparansi harga dan estimasi waktu yang jelas.</p>
            </div>

            <div class="row g-4">
                <?php if (!empty($daftarServis)): ?>
                    <?php foreach ($daftarServis as $servis): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="service-card">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-12">
                                        <span class="badge radius-4 px-8 py-4 text-xxs fw-bold" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">
                                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="me-1"></iconify-icon>
                                            Estimasi: <?= esc($servis['estimasi_waktu'] ?? 30) ?> Menit
                                        </span>
                                        <span class="text-xxs text-secondary-light fw-bold"><?= esc($servis['kodeservis']) ?></span>
                                    </div>

                                    <h5 class="fw-bold text-dark mb-8 text-base"><?= esc($servis['jenis_servis']) ?></h5>
                                    <p class="text-xs text-secondary-light mb-16" style="min-height: 40px; line-height: 1.5;">
                                        <?= esc($servis['keterangan'] ?? 'Pemeriksaan dan perawatan komponen motor dengan standar bengkel.') ?>
                                    </p>
                                </div>

                                <div class="pt-16 border-top d-flex align-items-center justify-content-between mt-auto">
                                    <div>
                                        <span class="text-xxs text-secondary-light d-block text-uppercase fw-semibold">Biaya Jasa</span>
                                        <span class="service-price">Rp <?= number_format($servis['biaya'], 0, ',', '.') ?></span>
                                    </div>
                                    <button type="button" class="btn btn-brand radius-6 px-14 py-8 text-xs fw-bold btn-pilih-servis" data-servis="<?= esc($servis['jenis_servis']) ?>" data-kode="<?= esc($servis['kodeservis']) ?>">
                                        BOOKING SERVIS
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center radius-12 p-20 text-sm">
                            Daftar layanan servis sedang disiapkan. Hubungi bengkel untuk informasi lebih lanjut.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN (ABOUT US / WHY CHOOSE US) -->
    <section class="section-padding bg-light" id="keunggulan">
        <div class="container">
            <div class="text-center mb-48">
                <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">ABOUT US</span>
                <h2 class="section-title mb-10">Standar Kualitas Salsa Motor</h2>
                <p class="section-subtitle">Komitmen kami menghadirkan perawatan motor terbaik dengan peralatan modern dan teknisi handal.</p>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <iconify-icon icon="solar:user-speak-bold-duotone"></iconify-icon>
                        </div>
                        <h5 class="fw-bold text-dark mb-8 text-base">Mekanik Bersertifikat</h5>
                        <p class="text-xs text-secondary-light mb-0 leading-relaxed">
                            Teknisi ahli berpengalaman menangani motor matic, bebek, sport, hingga sistem injeksi modern.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <iconify-icon icon="solar:laptop-minimalistic-bold-duotone"></iconify-icon>
                        </div>
                        <h5 class="fw-bold text-dark mb-8 text-base">Scanner Injeksi Modern</h5>
                        <p class="text-xs text-secondary-light mb-0 leading-relaxed">
                            Diagnostik komputer akurat membaca kode error ECU motor injeksi tanpa tebak-tebakan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                        </div>
                        <h5 class="fw-bold text-dark mb-8 text-base">100% Suku Cadang Asli</h5>
                        <p class="text-xs text-secondary-light mb-0 leading-relaxed">
                            Jaminan keaslian oli dan onderdil resmi pabrikan (AHM, Yamaha Genuine Parts, Suzuki, dll).
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <iconify-icon icon="solar:wallet-money-bold-duotone"></iconify-icon>
                        </div>
                        <h5 class="fw-bold text-dark mb-8 text-base">Biaya Jujur & Transparan</h5>
                        <p class="text-xs text-secondary-light mb-0 leading-relaxed">
                            Estimasi pengerjaan dan harga selalu dikonfirmasi kepada Anda sebelum pengerjaan dimulai.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ALUR SERVIS -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="text-center mb-48">
                <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">WORKFLOW</span>
                <h2 class="section-title mb-10">4 Langkah Mudah Servis Motor</h2>
                <p class="section-subtitle">Proses praktis dan bebas antre dari awal kedatangan hingga motor siap dipacu kembali.</p>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h6 class="fw-bold text-dark mb-6 text-sm">Booking Online</h6>
                        <p class="text-xxs text-secondary-light mb-0">
                            Isi formulir online untuk memilih jadwal dan paket servis tanpa antre.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h6 class="fw-bold text-dark mb-6 text-sm">Pemeriksaan & Estimasi</h6>
                        <p class="text-xxs text-secondary-light mb-0">
                            Mekanik memeriksa motor dan menjelaskan estimasi biaya secara transparan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h6 class="fw-bold text-dark mb-6 text-sm">Pengerjaan Ahli</h6>
                        <p class="text-xxs text-secondary-light mb-0">
                            Servis dikerjakan dengan cermat oleh teknisi ahli berstandar pabrikan.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h6 class="fw-bold text-dark mb-6 text-sm">Selesai & Garansi</h6>
                        <p class="text-xxs text-secondary-light mb-0">
                            Pemeriksaan akhir (final check) dan penyerahan motor beserta garansi servis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BOOKING SERVIS ONLINE CTA SECTION -->
    <section class="section-padding bg-light" id="booking-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">BOOKING ONLINE</span>
                    <h2 class="section-title mb-16">Jadwalkan Servis Motor Anda Tanpa Antre</h2>
                    <p class="text-secondary-light text-sm mb-24 leading-relaxed">
                        Pesan antrean servis secara online, pilih paket perawatan yang tepat, lakukan pembayaran transfer/QRIS, dan unggah bukti untuk konfirmasi instan dari tim mekanik kami.
                    </p>

                    <div class="d-flex flex-column gap-3 mb-28">
                        <div class="d-flex align-items-start gap-3">
                            <div class="w-32-px h-32-px rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 text-white fw-bold text-xs" style="background-color: #ff5500;">
                                1
                            </div>
                            <div>
                                <h6 class="text-xs fw-bold text-dark mb-1">Pilih Paket Layanan & Waktu Kedatangan</h6>
                                <p class="text-xxs text-secondary-light mb-0">Tentukan tanggal dan jam kedatangan Anda tanpa perlu mengantre di bengkel.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="w-32-px h-32-px rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 text-white fw-bold text-xs" style="background-color: #ff5500;">
                                2
                            </div>
                            <div>
                                <h6 class="text-xs fw-bold text-dark mb-1">Pembayaran Transfer Bank / QRIS</h6>
                                <p class="text-xxs text-secondary-light mb-0">Pembayaran mudah via BCA, BRI, atau QRIS instan.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="w-32-px h-32-px rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 text-white fw-bold text-xs" style="background-color: #ff5500;">
                                3
                            </div>
                            <div>
                                <h6 class="text-xs fw-bold text-dark mb-1">Upload Bukti & Verifikasi Cepat</h6>
                                <p class="text-xxs text-secondary-light mb-0">Admin memverifikasi bukti transfer dan jadwal pengerjaan langsung dipersiapkan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card p-32 radius-16 border-0 shadow-lg text-center" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: #ffffff;">
                        <div class="w-64-px h-64-px rounded-circle mx-auto mb-20 d-flex align-items-center justify-content-center" style="background: rgba(255, 85, 0, 0.15); color: #ff5500;">
                            <iconify-icon icon="solar:calendar-add-bold-duotone" class="text-3xl"></iconify-icon>
                        </div>
                        <h4 class="fw-bold text-white mb-8 text-xl">Formulir Booking Servis Online</h4>
                        <p class="text-neutral-300 text-xs mb-24 leading-relaxed" style="max-width: 440px; margin: 0 auto;">
                            Klik tombol di bawah untuk mengisi data kendaraan Anda, memilih paket servis, dan mengunggah bukti pembayaran secara lengkap.
                        </p>

                        <a href="<?= site_url('booking') ?>" class="btn btn-hero-primary w-100 py-14 text-sm fw-bold mb-12 shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <iconify-icon icon="solar:calendar-add-bold" class="text-base"></iconify-icon>
                            BUKA FORMULIR BOOKING SERVIS
                        </a>

                        <a href="https://wa.me/6281234567890?text=Halo%20Bengkel%20Salsa%20Motor%2C%20saya%20ingin%20konsultasi%20dan%20booking%20jadwal%20servis." target="_blank" class="btn btn-outline-light w-100 py-10 text-xs fw-bold d-flex align-items-center justify-content-center gap-2">
                            <iconify-icon icon="logos:whatsapp-icon" class="text-base"></iconify-icon>
                            Konsultasi Cepat via WhatsApp
                        </a>

                        <?php if ($isLoggedIn): ?>
                            <div class="mt-20 pt-16 border-top border-secondary-800 text-xxs text-neutral-400">
                                Sudah punya booking? <a href="<?= site_url('riwayat-booking') ?>" class="fw-bold text-white text-decoration-underline ms-1">Lihat Status Booking Saya &rarr;</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PORTAL RIWAYAT SERVIS BANNER -->
    <section class="section-padding py-0">
        <div class="container">
            <div class="portal-callout">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="badge text-white text-xxs fw-bold px-10 py-4 radius-4 mb-12" style="background-color: #ff5500;">
                            PORTAL PELANGGAN
                        </span>
                        <h3 class="fw-bold text-white mb-8 text-xl">Pantau Riwayat Servis Motor Anda Secara Digital</h3>
                        <p class="text-neutral-300 text-xs mb-0 leading-relaxed" style="max-width: 580px;">
                            Dengan akun pelanggan Salsa Motor, Anda dapat melihat riwayat pengerjaan bengkel, daftar suku cadang yang pernah diganti, serta pengingat servis berkala berikutnya secara transparan.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <?php if ($isLoggedIn): ?>
                            <a href="<?= site_url('riwayat-servis') ?>" class="btn btn-light text-dark fw-bold radius-6 px-20 py-10 text-xs shadow-sm d-inline-flex align-items-center gap-2">
                                <iconify-icon icon="solar:history-bold-duotone" class="text-base" style="color: #ff5500;"></iconify-icon>
                                Riwayat Servis Saya
                            </a>
                        <?php else: ?>
                            <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-2">
                                <a href="<?= site_url('register') ?>" class="btn btn-brand text-white fw-bold radius-6 px-16 py-10 text-xs shadow-sm">
                                    Daftar Akun Baru
                                </a>
                                <a href="<?= site_url('login') ?>" class="btn btn-outline-light fw-bold radius-6 px-16 py-10 text-xs">
                                    Masuk Akun
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONI PELANGGAN -->
    <section class="section-padding bg-white mt-60">
        <div class="container">
            <div class="text-center mb-48">
                <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">TESTIMONIALS</span>
                <h2 class="section-title mb-10">Ulasan Pelanggan Salsa Motor</h2>
                <p class="section-subtitle">Kepuasan dan kenyamanan pelanggan adalah prioritas utama kami.</p>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center gap-1 text-warning-main mb-10">
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                        </div>
                        <p class="text-xs text-secondary-light mb-16 italic leading-relaxed">
                            "Pelayanan sangat ramah dan jujur. Di Salsa Motor dicek dulu detail dan dijelaskan dengan baik. Motor Vario saya jadi enteng lagi tarikannya."
                        </p>
                        <div class="d-flex align-items-center gap-2 pt-10 border-top">
                            <div class="w-32-px h-32-px rounded-circle bg-neutral-100 text-dark d-flex align-items-center justify-content-center fw-bold text-xs">
                                AS
                            </div>
                            <div>
                                <h6 class="text-xs fw-bold text-dark mb-0">Agus Setiawan</h6>
                                <span class="text-xxs text-secondary-light">Honda Vario 150</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center gap-1 text-warning-main mb-10">
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                        </div>
                        <p class="text-xs text-secondary-light mb-16 italic leading-relaxed">
                            "Sangat praktis bisa booking online dulu, jadi pas sampai mekanik langsung kerjain tanpa antre. Ruang tunggu bersih dan nyaman."
                        </p>
                        <div class="d-flex align-items-center gap-2 pt-10 border-top">
                            <div class="w-32-px h-32-px rounded-circle bg-neutral-100 text-dark d-flex align-items-center justify-content-center fw-bold text-xs">
                                DP
                            </div>
                            <div>
                                <h6 class="text-xs fw-bold text-dark mb-0">Dian Permata</h6>
                                <span class="text-xxs text-secondary-light">Yamaha Fazzio</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center gap-1 text-warning-main mb-10">
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                            <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                        </div>
                        <p class="text-xs text-secondary-light mb-16 italic leading-relaxed">
                            "Mekanik sangat paham kelistrikan dan injeksi. Scanner diagnostiknya canggih, kode error di NMAX saya langsung beres."
                        </p>
                        <div class="d-flex align-items-center gap-2 pt-10 border-top">
                            <div class="w-32-px h-32-px rounded-circle bg-neutral-100 text-dark d-flex align-items-center justify-content-center fw-bold text-xs">
                                RH
                            </div>
                            <div>
                                <h6 class="text-xs fw-bold text-dark mb-0">Rizky Hendrawan</h6>
                                <span class="text-xxs text-secondary-light">Yamaha NMAX 155</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LOKASI & KONTAK -->
    <section class="section-padding bg-light" id="kontak">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">CONTACT</span>
                    <h2 class="section-title mb-12">Kunjungi Bengkel Kami</h2>
                    <p class="text-secondary-light text-xs mb-20">
                        Kami siap melayani kebutuhan servis berkala dan tune up motor kesayangan Anda setiap hari.
                    </p>

                    <!-- Jam Operasional Card -->
                    <div class="card border-0 shadow-sm radius-12 p-16 bg-white mb-16">
                        <div class="d-flex align-items-center gap-2 mb-12">
                            <div class="w-32-px h-32-px rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">
                                <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-lg"></iconify-icon>
                            </div>
                            <h6 class="fw-bold text-dark mb-0 text-xs">Jam Buka Bengkel</h6>
                        </div>

                        <div class="d-flex flex-column gap-1 text-xs">
                            <div class="d-flex justify-content-between pb-6 border-bottom">
                                <span class="text-secondary-light">Senin - Sabtu</span>
                                <span class="fw-bold text-dark">08.00 - 17.00 WIB</span>
                            </div>
                            <div class="d-flex justify-content-between pt-4">
                                <span class="text-secondary-light">Minggu</span>
                                <span class="fw-bold" style="color: #ff5500;">08.00 - 14.00 WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak Info Cards -->
                    <div class="d-flex flex-column gap-2">
                        <div class="p-12 radius-10 bg-white border border-neutral-200 d-flex align-items-center gap-3">
                            <div class="w-32-px h-32-px rounded-6 bg-success-50 text-success-600 d-flex align-items-center justify-content-center flex-shrink-0">
                                <iconify-icon icon="solar:map-point-bold-duotone" class="text-lg"></iconify-icon>
                            </div>
                            <div>
                                <span class="text-xxs text-secondary-light d-block">Alamat Bengkel</span>
                                <p class="text-xs fw-semibold text-dark mb-0">Jl. Raya Utama No. 128, Salsa Motor Center</p>
                            </div>
                        </div>

                        <div class="p-12 radius-10 bg-white border border-neutral-200 d-flex align-items-center gap-3">
                            <div class="w-32-px h-32-px rounded-6 d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">
                                <iconify-icon icon="solar:phone-calling-bold-duotone" class="text-lg"></iconify-icon>
                            </div>
                            <div>
                                <span class="text-xxs text-secondary-light d-block">WhatsApp & Telepon</span>
                                <p class="text-xs fw-semibold text-dark mb-0">+62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Accordion -->
                <div class="col-lg-7">
                    <span class="section-badge" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">FAQ</span>
                    <h2 class="section-title mb-12">Pertanyaan Umum</h2>
                    <p class="text-secondary-light text-xs mb-20">Informasi seputar garansi, pembayaran, dan estimasi waktu servis.</p>

                    <div class="accordion" id="accordionFaq">
                        <div class="accordion-item border radius-10 mb-10 overflow-hidden shadow-none">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-bold text-dark text-xs bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Berapa lama estimasi waktu pengerjaan servis motor?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFaq">
                                <div class="accordion-body text-xs text-secondary-light bg-neutral-50 pt-0">
                                    Untuk servis rutin atau ganti oli berkisar antara 15-30 menit. Servis berkala/tune up lengkap injeksi membutuhkan waktu 45-60 menit.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border radius-10 mb-10 overflow-hidden shadow-none">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold text-dark text-xs bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apakah ada garansi setelah pengerjaan servis?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
                                <div class="accordion-body text-xs text-secondary-light bg-neutral-50 pt-0">
                                    Ya! Setiap pengerjaan servis dan tune-up di Bengkel Salsa Motor mendapatkan garansi pengerjaan selama 7 hingga 30 hari.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border radius-10 overflow-hidden shadow-none">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-bold text-dark text-xs bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Metode pembayaran apa saja yang diterima?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFaq">
                                <div class="accordion-body text-xs text-secondary-light bg-neutral-50 pt-0">
                                    Kami menerima pembayaran tunai (cash), QRIS (GoPay, OVO, Dana, ShopeePay, Mobile Banking), serta transfer bank langsung.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="landing-footer">
        <div class="container">
            <div class="row g-4 pb-32 border-bottom border-secondary-800">
                <div class="col-lg-5">
                    <a href="<?= site_url('/') ?>" class="d-inline-block mb-12">
                        <img src="<?= base_url('assets/images/logo-light.png') ?>" alt="Bengkel Salsa Motor" style="height: 32px; width: auto;">
                    </a>
                    <p class="text-xs text-secondary-light mb-16" style="max-width: 340px;">
                        Pusat perawatan dan servis motor profesional, tune up injeksi, ganti oli resmi, dan mekanik terpercaya bergaransi.
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <a href="https://wa.me/6281234567890" target="_blank" class="w-32-px h-32-px rounded-circle bg-neutral-800 text-white d-flex align-items-center justify-content-center hover-bg-primary-600 text-decoration-none">
                            <iconify-icon icon="logos:whatsapp-icon" class="text-sm"></iconify-icon>
                        </a>
                        <a href="tel:081234567890" class="w-32-px h-32-px rounded-circle bg-neutral-800 text-white d-flex align-items-center justify-content-center hover-bg-primary-600 text-decoration-none">
                            <iconify-icon icon="solar:phone-bold" class="text-sm"></iconify-icon>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <h6 class="text-white text-xs fw-bold mb-12">Navigasi</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#beranda" class="footer-link">Home</a></li>
                        <li><a href="#layanan" class="footer-link">Services</a></li>
                        <li><a href="#booking-section" class="footer-link">Booking</a></li>
                        <li><a href="#keunggulan" class="footer-link">About Us</a></li>
                        <li><a href="#kontak" class="footer-link">Contact</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4">
                    <h6 class="text-white text-xs fw-bold mb-12">Bengkel Salsa Motor</h6>
                    <p class="text-xxs text-secondary-light mb-6">
                        <iconify-icon icon="solar:map-point-bold" class="text-primary-400 me-1"></iconify-icon>
                        Jl. Raya Utama No. 128, Salsa Motor Center
                    </p>
                    <p class="text-xxs text-secondary-light mb-6">
                        <iconify-icon icon="solar:phone-bold" class="text-primary-400 me-1"></iconify-icon>
                        +62 812-3456-7890
                    </p>
                    <p class="text-xxs text-secondary-light mb-0">
                        <iconify-icon icon="solar:clock-circle-bold" class="text-primary-400 me-1"></iconify-icon>
                        Senin - Sabtu: 08:00 - 17:00 | Minggu: 08:00 - 14:00
                    </p>
                </div>
            </div>

            <div class="pt-20 d-flex flex-wrap align-items-center justify-content-between gap-2 text-xxs text-secondary-light">
                <p class="mb-0">&copy; <?= date('Y') ?> Bengkel Salsa Motor. All rights reserved.</p>
                <p class="mb-0">Wowdash Automotive Theme</p>
            </div>
        </div>
    </footer>

    <?php include(APPPATH . 'Views/assets/js.php') ?>

    <script>
        $(document).ready(function() {
            var isManualScroll = false;

            // Function to update active nav link
            function updateActiveNav(targetId) {
                $('.nav-link-custom').removeClass('active');
                var activeLink = $('.nav-link-custom[href="' + targetId + '"]');
                if (activeLink.length) {
                    activeLink.addClass('active');
                }
            }

            // Smooth scroll for nav links & button links
            $('a[href^="#"]').on('click', function(e) {
                var href = $(this).attr('href');
                if (href && href.length > 1) {
                    var target = $(href);
                    if (target.length) {
                        e.preventDefault();
                        isManualScroll = true;
                        updateActiveNav(href);

                        $('html, body').stop().animate({
                            scrollTop: target.offset().top - 65
                        }, 400, function() {
                            setTimeout(function() {
                                isManualScroll = false;
                            }, 50);
                        });

                        // Close mobile nav if open
                        var navbarCollapse = $('.navbar-collapse');
                        if (navbarCollapse.hasClass('show')) {
                            navbarCollapse.collapse('hide');
                        }
                    }
                }
            });

            // Navbar shadow & ScrollSpy on scroll
            $(window).on('scroll', function() {
                var scrollTop = $(this).scrollTop();

                // Navbar shadow
                if (scrollTop > 40) {
                    $('.landing-navbar').addClass('scrolled');
                } else {
                    $('.landing-navbar').removeClass('scrolled');
                }

                // ScrollSpy (only when not manual animating)
                if (!isManualScroll) {
                    var scrollPosition = scrollTop + 120;
                    var sections = ['#kontak', '#booking-section', '#keunggulan', '#layanan', '#beranda'];

                    for (var i = 0; i < sections.length; i++) {
                        var sectionEl = $(sections[i]);
                        if (sectionEl.length) {
                            var top = sectionEl.offset().top;
                            var bottom = top + sectionEl.outerHeight();
                            if (scrollPosition >= top && scrollPosition <= bottom) {
                                updateActiveNav(sections[i]);
                                break;
                            }
                        }
                    }
                }
            });

            // Direct to booking page with selected service
            $('.btn-pilih-servis').on('click', function() {
                var kode = $(this).data('kode');
                window.location.href = '<?= site_url("booking") ?>?kodeservis=' + encodeURIComponent(kode);
            });

            // Set default booking time to tomorrow 09:00
            var now = new Date();
            now.setDate(now.getDate() + 1);
            now.setHours(9, 0, 0, 0);
            var tzOffset = now.getTimezoneOffset() * 60000;
            var localISOTime = (new Date(now - tzOffset)).toISOString().slice(0, 16);
            $('#bookingWaktu').val(localISOTime);
        });

        // Booking form handler to send via WhatsApp
        function handleBookingSubmit(e) {
            e.preventDefault();
            var nama = $('#bookingNama').val();
            var hp = $('#bookingHp').val();
            var motor = $('#bookingMotor').val();
            var plat = $('#bookingPlat').val();
            var servis = $('#bookingServis').val();
            var waktu = $('#bookingWaktu').val();
            var catatan = $('#bookingCatatan').val() || '-';

            // Format tanggal & jam
            var dateObj = new Date(waktu);
            var formattedDate = dateObj.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            var text = "*BOOKING SERVIS - BENGKEL SALSA MOTOR*\n" +
                       "-----------------------------------------\n" +
                       "👤 *Nama Pemilik:* " + nama + "\n" +
                       "📱 *No. HP/WA:* " + hp + "\n" +
                       "🏍️ *Merk/Tipe Motor:* " + motor + "\n" +
                       "🔢 *Nomor Polisi (Plat):* " + plat + "\n" +
                       "🛠️ *Layanan Servis:* " + servis + "\n" +
                       "📅 *Rencana Waktu:* " + formattedDate + " WIB\n" +
                       "📝 *Catatan Keluhan:* " + catatan + "\n" +
                       "-----------------------------------------\n" +
                       "Mohon konfirmasi ketersediaan jadwal mekanik. Terima kasih!";

            var waUrl = "https://wa.me/6281234567890?text=" + encodeURIComponent(text);
            window.open(waUrl, '_blank');
        }
    </script>
</body>

</html>
