<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Pasca Persalinan
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
                <p><b>Laporan Data Pasca Persalinan</b></p>
                <p><?= $pasca_persalinan['ibuRM'] ?></p>
                <p><?= $pasca_persalinan['ibuNama'] ?></p>
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
                            <td><?= $pasca_persalinan['ibuNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pemeriksaan</td>
                            <td><?= $pasca_persalinan['tanggalPemeriksaan'] ?></td>
                        </tr>
                        <tr>
                            <td>Jam Pemeriksaan</td>
                            <td><?= $pasca_persalinan['jamPemeriksaan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah</td>
                            <td><?= $pasca_persalinan['tekananDarah'] ?></td>
                        </tr>
                        <tr>
                            <td>Nadi</td>
                            <td><?= $pasca_persalinan['nadi'] ?></td>
                        </tr>
                        <tr>
                            <td>Suhu Tubuh</td>
                            <td><?= $pasca_persalinan['suhuTubuh'] ?></td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td><?= $pasca_persalinan['beratBadan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tinggi Badan</td>
                            <td><?= $pasca_persalinan['tinggiBadan'] ?></td>
                        </tr>
                        <tr>
                            <td>Pernapasan</td>
                            <td><?= $pasca_persalinan['pernapasan'] ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Luka Episiotomi</td>
                            <td><?= $pasca_persalinan['kondisiLukaEpisiotomi'] ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Luka Caesarean</td>
                            <td><?= $pasca_persalinan['kondisiLukaCaesarean'] ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Uterus</td>
                            <td><?= $pasca_persalinan['kondisiUterus'] ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Payudara</td>
                            <td><?= $pasca_persalinan['kondisiPayudara'] ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Vagina</td>
                            <td><?= $pasca_persalinan['kondisiVagina'] ?></td>
                        </tr>
                        <tr>
                            <td>Kesehatan Mental</td>
                            <td><?= $pasca_persalinan['kesehatanMental'] ?></td>
                        </tr>
                        <tr>
                            <td>Pemeriksaan Lab</td>
                            <td><?= $pasca_persalinan['pemeriksaanLab'] ?></td>
                        </tr>
                        <tr>
                            <td>Terapi</td>
                            <td><?= $pasca_persalinan['terapi'] ?></td>
                        </tr>
                        <tr>
                            <td>Komplikasi</td>
                            <td><?= $pasca_persalinan['komplikasi'] ?></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><?= $pasca_persalinan['catatan'] ?></td>
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