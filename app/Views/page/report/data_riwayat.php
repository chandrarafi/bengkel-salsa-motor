<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Riwayat
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
                <p><b>Laporan Data Riwayat</b></p>
                <p><?= $riwayat['ibuRM'] ?></p>
                <p><?= $riwayat['ibuNama'] ?></p>
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
                            <td><?= $riwayat['ibuNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Kehamilan Ke</td>
                            <td><?= $riwayat['kehamilan'] ?></td>
                        </tr>
                        <tr>
                            <td>Gravida</td>
                            <td><?= $riwayat['gravida'] ?></td>
                        </tr>
                        <tr>
                            <td>Partus</td>
                            <td><?= $riwayat['partus'] ?></td>
                        </tr>
                        <tr>
                            <td>Abortus</td>
                            <td><?= $riwayat['abortus'] ?></td>
                        </tr>
                        <tr>
                            <td>Lahir Mati</td>
                            <td><?= $riwayat['lahirMati'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal HPL</td>
                            <td><?= $riwayat['tanggalHPL'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal HPHT</td>
                            <td><?= $riwayat['tanggalHPHT'] ?></td>
                        </tr>
                        <tr>
                            <td>Taksiran Persalinan</td>
                            <td><?= $riwayat['taksiranPersalinan'] ?></td>
                        </tr>
                        <tr>
                            <td>Persalinan Sebelumnya</td>
                            <td><?= $riwayat['persalinanSebelumnya'] ?></td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td><?= $riwayat['bbSebelum'] ?></td>
                        </tr>
                        <tr>
                            <td>Tinggi Badan</td>
                            <td><?= $riwayat['tb'] ?></td>
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