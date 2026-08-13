<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel Salsa Motor</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/images/favicon.png" sizes="16x16">
    <?php include(APPPATH . 'Views/assets/css.php') ?>
</head>

<body>
    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a href="index.html" class="sidebar-logo">
                <img src="<?= base_url() ?>assets/images/logo.png" alt="site logo" class="light-logo">
                <img src="<?= base_url() ?>assets/images/logo-light.png" alt="site logo" class="dark-logo">
                <img src="<?= base_url() ?>assets/images/logo-icon.png" alt="site logo" class="logo-icon">
            </a>
        </div>
        <div class="sidebar-menu-area">
            <?php include(APPPATH . 'Views/page/component/sidemenu.php') ?>

        </div>
    </aside>

    <main class="dashboard-main">
        <?php include(APPPATH . 'Views/page/component/header.php') ?>
        </div>

        <div class="dashboard-main-body">
            <?= $this->renderSection('content') ?>
        </div>

        <?php include(APPPATH . 'Views/page/component/footer.php') ?>

    </main>

    <?php include(APPPATH . 'Views/assets/js.php') ?>

    <script>
        $('.remove-button').on('click', function() {
            $(this).closest('.alert').addClass('d-none')
        });
    </script>

    <?= $this->renderSection('script') ?>

</body>

</html>