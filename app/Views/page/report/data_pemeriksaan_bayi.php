<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Pemeriksaan Bayi
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
                <p><b>Laporan Data Pemeriksaan Bayi</b></p>
                <p><?= $pemeriksaan_bayi['bayiNoRM'] ?></p>
                <p><?= $pemeriksaan_bayi['bayiNama'] ?></p>
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
                            <td><?= $pemeriksaan_bayi['bayiNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Asi</td>
                            <td><?= $pemeriksaan_bayi['asi'] ?></td>
                        </tr>
                        <tr>
                            <td>MP Asi</td>
                            <td><?= $pemeriksaan_bayi['mpAsi'] ?></td>
                        </tr>
                        <tr>
                            <td>SDI/DTK</td>
                            <td><?= $pemeriksaan_bayi['sdiDtk'] ?></td>
                        </tr>
                        <tr>
                            <td>Berat Badan Pemeriksaan</td>
                            <td><?= $pemeriksaan_bayi['bbPemeriksaanBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Tinggi Badan Pemeriksaan</td>
                            <td><?= $pemeriksaan_bayi['tbPemeriksaanBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?= $pemeriksaan_bayi['status'] ?></td>
                        </tr>
                        <tr>
                            <td>Vitamin A</td>
                            <td><?= $pemeriksaan_bayi['vitA'] ?></td>
                        </tr>
                        <tr>
                            <td>Imunisasi Bayi</td>
                            <td><?= $pemeriksaan_bayi['imunisasiBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan Bayi</td>
                            <td><?= $pemeriksaan_bayi['keteranganBayi'] ?></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Umur Bayi</td>
                            <td><?= $pemeriksaan_bayi['umurBayi'] ?></td>
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