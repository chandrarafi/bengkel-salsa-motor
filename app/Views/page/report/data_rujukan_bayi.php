<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Rujukan
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
                <p><b>Laporan Data Rujukan</b></p>
                <p><?= $rujukan_bayi['bayiNoRM'] ?></p>
                <p><?= $rujukan_bayi['bayiNama'] ?></p>
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
                            <td>Nama Pasien</td>
                            <td><?= $rujukan_bayi['bayiNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Rujukan</td>
                            <td><?= $rujukan_bayi['tanggalRujukan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tujuan Rujukan</td>
                            <td><?= $rujukan_bayi['kepada'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $rujukan_bayi['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>Hasil Pemeriksaan</td>
                            <td><?= $rujukan_bayi['hasilPemeriksaan'] ?></td>
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