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
                <p><b>Laporan Data Riwayat Bayi</b></p>
                <p><?= $riwayat_bayi['bayiNoRM'] ?></p>
                <p><?= $riwayat_bayi['bayiNama'] ?></p>
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
                            <th>Deskripsi</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama Bayi</td>
                            <td><?= $riwayat_bayi['bayiNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td><?= $riwayat_bayi['bbBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Panjang Badan</td>
                            <td><?= $riwayat_bayi['panjangBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Golongan Darah</td>
                            <td><?= $riwayat_bayi['golonganDarah'] ?></td>
                        </tr>
                        <tr>
                            <td>Buku KIA/KMS</td>
                            <td><?= $riwayat_bayi['bukuKIAKMS'] ?></td>
                        </tr>
                        <tr>
                            <td>Keadaan Lahir</td>
                            <td><?= $riwayat_bayi['keadaanLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Komplikasi Lahir</td>
                            <td><?= $riwayat_bayi['komplikasiLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Resusitasi</td>
                            <td><?= $riwayat_bayi['resusitasi'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>