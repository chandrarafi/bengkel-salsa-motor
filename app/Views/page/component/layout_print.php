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

    <?= $this->renderSection('content') ?>

    <?php include(APPPATH . 'Views/assets/js.php') ?>

    <?= $this->renderSection('script') ?>

</body>

</html>