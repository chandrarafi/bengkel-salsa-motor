<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard'); ?> - Application</title>
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="<?= base_url('assets/css/lib/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/remixicon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

    <style>
        :root {
            --sidebar-width: 250px;
            --primary-bg: #f8fafc;
            --sidebar-bg: #0f172a;
            --sidebar-color: #94a3b8;
            --sidebar-active: #38bdf8;
        }

        body {
            background-color: var(--primary-bg);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #1e293b;
            border-bottom: 1px solid #334155;
        }

        #sidebar .sidebar-header h3 {
            color: #f8fafc;
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            color: var(--sidebar-color);
            text-decoration: none;
            transition: 0.2s;
        }

        #sidebar ul li a i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        #sidebar ul li a:hover, #sidebar ul li.active > a {
            color: #fff;
            background: #1e293b;
            border-left: 4px solid var(--sidebar-active);
        }

        /* Content Area */
        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-custom {
            background: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .main-container {
            padding: 30px;
            flex: 1;
        }

        /* Empty State Card */
        .empty-dashboard-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px dashed #cbd5e1;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .empty-icon-box {
            width: 80px;
            height: 80px;
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .metric-skeleton {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            transition: transform 0.2s;
        }

        .metric-skeleton:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .skeleton-circle {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #64748b;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center gap-2">
            <i class="ri-dashboard-line text-info fs-4"></i>
            <h3>App Dashboard</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="<?= site_url('dashboard'); ?>">
                    <i class="ri-home-4-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="ri-folders-line"></i> Master Data
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="ri-file-chart-line"></i> Laporan
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="ri-settings-3-line"></i> Pengaturan
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-custom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <h5 class="m-0 font-weight-bold text-dark">Dashboard Utama</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-dark border px-3 py-2">
                    <i class="ri-user-3-line me-1"></i> Admin User
                </span>
            </div>
        </nav>

        <!-- Main Body Container -->
        <div class="main-container">
            <!-- Metric Placeholder Cards -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-skeleton d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-medium">Total Data</div>
                            <div class="h4 mb-0 fw-bold mt-1 text-secondary">-</div>
                        </div>
                        <div class="skeleton-circle">
                            <i class="ri-database-2-line"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-skeleton d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-medium">Pengguna Aktif</div>
                            <div class="h4 mb-0 fw-bold mt-1 text-secondary">-</div>
                        </div>
                        <div class="skeleton-circle">
                            <i class="ri-user-line"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-skeleton d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-medium">Aktivitas Hari Ini</div>
                            <div class="h4 mb-0 fw-bold mt-1 text-secondary">-</div>
                        </div>
                        <div class="skeleton-circle">
                            <i class="ri-activity-line"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="metric-skeleton d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-medium">Status Sistem</div>
                            <div class="h4 mb-0 fw-bold mt-1 text-success">Normal</div>
                        </div>
                        <div class="skeleton-circle">
                            <i class="ri-checkbox-circle-line text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State Card -->
            <div class="empty-dashboard-card">
                <div class="empty-icon-box">
                    <i class="ri-layout-grid-line"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2">Dashboard Siap Digunakan</h4>
                <p class="text-muted max-w-md mx-auto mb-4" style="max-width: 500px;">
                    Tampilan dashboard versi kosong telah disiapkan. Anda dapat mulai menambahkan komponen UI, grafik, atau tabel data sesuai kebutuhan project Anda.
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="#" class="btn btn-primary px-4 py-2">
                        <i class="ri-add-line me-1"></i> Tambah Widget
                    </a>
                    <a href="https://codeigniter.com/user_guide/" target="_blank" class="btn btn-outline-secondary px-4 py-2">
                        <i class="ri-book-read-line me-1"></i> Dokumentasi CI4
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Dependencies -->
<script src="<?= base_url('assets/js/lib/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/lib/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
