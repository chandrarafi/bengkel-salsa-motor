<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Ibu
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
                <p><b>Laporan Data Ibu</b></p>
                <p><?= $ibu['ibuRM'] ?></p>
                <p><?= $ibu['ibuNama'] ?></p>
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
                            <td>NIK</td>
                            <td><?= $ibu['ibuNIK'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap Pasien</td>
                            <td><?= $ibu['ibuNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Rekam Medis</td>
                            <td><?= $ibu['ibuRM'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Suami</td>
                            <td><?= $ibu['ibuSuami'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td><?= $ibu['ibuTanggalLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $ibu['ibuAlamat'] ?></td>
                        </tr>
                        <tr>
                            <td>RT/RW</td>
                            <td><?= $ibu['ibuRtRw'] ?></td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td><?= $ibu['ibuKecamatan'] ?></td>
                        </tr>
                        <tr>
                            <td>Pendidikan</td>
                            <td><?= $ibu['ibuPendidikan'] ?></td>
                        </tr>
                        <tr>
                            <td>Pekerjaan Pasien</td>
                            <td><?= $ibu['ibuPekerjaan'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Pekerjaan Suami</td>
                            <td><?= $ibu['suamiPekerjaan'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td><?= $ibu['ibuAgama'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Golongan Darah</td>
                            <td><?= $ibu['ibuGolDarah'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td><?= $ibu['ibuNoHP'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>No BPJS</td>
                            <td><?= $ibu['ibuNoBPJS'] ?></td>
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