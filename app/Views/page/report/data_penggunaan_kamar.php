<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Penggunaan Kamar
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
                <p><b>Laporan Data Penggunaan Kamar</b></p>
                <p><?= $penggunaan_kamar['ibuRM'] ?></p>
                <p><?= $penggunaan_kamar['ibuNama'] ?></p>
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
                            <td><?= $penggunaan_kamar['ibuNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Kamar</td>
                            <td><?= $penggunaan_kamar['kamarNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td><?= $penggunaan_kamar['tanggalMasuk'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Keluar</td>
                            <td><?= $penggunaan_kamar['tanggalKeluar'] ?></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><?= $penggunaan_kamar['catatan'] ?></td>
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