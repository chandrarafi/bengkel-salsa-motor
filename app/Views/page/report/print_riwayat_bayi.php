<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Riwayat Bayi
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= site_url() ?>/assets/css/invoice.css" />
</head>

<body>
    <section class="wrapper-invoice">
        <!-- switch mode rtl by adding class rtl on invoice class -->
        <div class="invoice">
            <div class="invoice-information">
                <p><b>Laporan Data Riwayat Bayi </b></p>
                <p><?= $bayi['bayiNoRM'] ?></p>
                <p><?= $bayi['bayiNama'] ?></p>
            </div>
            <!-- logo brand invoice -->
            <div class="invoice-logo-brand">
                <!-- <h2>Tampsh.</h2> -->
                <img src="<?= site_url() ?>/assets/images/logo.png" alt="" />
            </div>
            <!-- invoice body-->
            <div class="invoice-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>BB</th>
                            <th>PB</th>
                            <th>Gol Darah</th>
                            <th>KIA/KMS</th>
                            <th>Keadaan Lahir</th>
                            <th>Komplikasi</th>
                            <th>Resusitasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($riwayat_bayi as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['bbBayi'] ?></td>
                                <td><?= $data['panjangBayi'] ?></td>
                                <td><?= $data['golonganDarah'] ?></td>
                                <td><?= $data['bukuKIAKMS'] ?></td>
                                <td><?= $data['keadaanLahir'] ?></td>
                                <td><?= $data['komplikasiLahir'] ?></td>
                                <td><?= $data['resusitasi'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="invoice-total-amount">
                    <p>Total Data Riwayat Bayi : <?= $no - 1 ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>