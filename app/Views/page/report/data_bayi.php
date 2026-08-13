<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Bayi
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
                <p><b>Laporan Data Bayi</b></p>
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
                            <th>Deskripsi</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama Bayi</td>
                            <td><?= $bayi['bayiNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Rekam Medis</td>
                            <td><?= $bayi['bayiNoRM'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td><?= $bayi['tanggalLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><?= $bayi['jenisKelamin'] ?></td>
                        </tr>
                        <tr>
                            <td>Berat Lahir</td>
                            <td><?= $bayi['beratLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Tinggi Lahir</td>
                            <td><?= $bayi['tinggiLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Anak Ke</td>
                            <td><?= $bayi['anakKe'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td><?= $bayi['ibuNama'] ?></td>
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