<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel Salsa Motor</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>" sizes="16x16">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php include(APPPATH . 'Views/assets/css.php') ?>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 50%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .auth-bg-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        .auth-bg-wrapper::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(72, 128, 255, 0.12) 0%, rgba(72, 128, 255, 0) 70%);
            top: -80px;
            right: -80px;
            pointer-events: none;
        }

        .auth-bg-wrapper::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, rgba(16, 185, 129, 0) 70%);
            bottom: -60px;
            left: -60px;
            pointer-events: none;
        }

        .auth-card {
            max-width: 440px;
            width: 100%;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.07), 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            padding: 40px 36px;
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-logo-box {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-logo-box img {
            max-height: 52px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .auth-logo-box img:hover {
            transform: scale(1.03);
        }

        .form-control-custom {
            height: 52px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.2s ease-in-out;
            padding-left: 48px !important;
            color: #1e293b;
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: #4880ff;
            box-shadow: 0 0 0 4px rgba(72, 128, 255, 0.12);
            outline: none;
        }

        .icon-field-custom {
            position: relative;
        }

        .icon-field-custom .field-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.25rem;
            color: #64748b;
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .btn-auth-primary {
            height: 50px;
            background: linear-gradient(135deg, #4880ff 0%, #2b65ec 100%);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            box-shadow: 0 8px 20px -4px rgba(72, 128, 255, 0.4);
            transition: all 0.2s ease-in-out;
        }

        .btn-auth-primary:hover {
            background: linear-gradient(135deg, #366fe4 0%, #1f55d7 100%);
            box-shadow: 0 12px 24px -4px rgba(72, 128, 255, 0.5);
            transform: translateY(-1px);
            color: #ffffff;
        }

        .btn-auth-primary:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px -2px rgba(72, 128, 255, 0.4);
        }

        .toggle-password-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.2s;
        }

        .toggle-password-icon:hover {
            color: #4880ff;
        }
    </style>
</head>

<body>

    <div class="auth-bg-wrapper">
        <div class="auth-card">
            <!-- Logo Bengkel -->
            <div class="auth-logo-box">
                <a href="<?= site_url('/') ?>" class="d-inline-block">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo Bengkel Salsa Motor">
                </a>
            </div>

            <!-- Title & Subtitle -->
            <div class="text-center mb-28">
                <h4 class="fw-bold text-dark mb-6" style="font-size: 1.5rem; letter-spacing: -0.3px;">Selamat Datang</h4>
                <p class="text-secondary-light text-sm mb-0">Silakan masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success_register')): ?>
                <div class="mb-20 alert alert-success bg-success-100 text-success-600 border-success-100 px-20 py-12 radius-12 d-flex align-items-center justify-content-between text-sm fw-medium" role="alert">
                    <span><?= session()->getFlashdata('success_register') ?></span>
                    <button type="button" class="remove-button text-success-600 text-xl border-0 bg-transparent p-0 ms-2">
                        <iconify-icon icon="iconamoon:sign-times-light"></iconify-icon>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('msg')): ?>
                <div class="mb-20 alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-20 py-12 radius-12 d-flex align-items-center justify-content-between text-sm fw-medium" role="alert">
                    <span><?= session()->getFlashdata('msg') ?></span>
                    <button type="button" class="remove-button text-danger-600 text-xl border-0 bg-transparent p-0 ms-2">
                        <iconify-icon icon="iconamoon:sign-times-light"></iconify-icon>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="<?= site_url('login') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Input Email -->
                <div class="icon-field-custom mb-16">
                    <span class="field-icon">
                        <iconify-icon icon="solar:letter-bold-duotone"></iconify-icon>
                    </span>
                    <input type="email" class="form-control form-control-custom" placeholder="Alamat Email" name="userEmail" id="userEmail" value="<?= old('userEmail') ?>" required>
                </div>

                <!-- Input Password -->
                <div class="icon-field-custom position-relative mb-24">
                    <span class="field-icon">
                        <iconify-icon icon="solar:lock-keyhole-bold-duotone"></iconify-icon>
                    </span>
                    <input type="password" class="form-control form-control-custom pe-44" id="yourPassword" placeholder="Kata Sandi" name="userPassword" required>
                    <span class="toggle-password-icon ri-eye-line" data-toggle="#yourPassword"></span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-auth-primary w-100">Login</button>

                <!-- Footer Link -->
                <div class="mt-28 text-center text-sm text-secondary-light">
                    Belum memiliki akun?
                    <a href="<?= site_url('register') ?>" class="text-primary-600 fw-bold hover-text-primary text-decoration-none ms-1">Daftar Akun Baru</a>
                </div>
            </form>
        </div>
    </div>

    <?php include(APPPATH . 'Views/assets/js.php') ?>

    <script>
        $(document).ready(function() {
            $('.toggle-password-icon').on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $('.remove-button').on('click', function() {
                $(this).closest('.alert').fadeOut(200);
            });
        });
    </script>

</body>

</html>