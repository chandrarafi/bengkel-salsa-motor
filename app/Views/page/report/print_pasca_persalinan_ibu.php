<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Pasca Persalinan Ibu
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
                <p><b>Laporan Data Pasca Persalinan Ibu </b></p>
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
                            <th>No</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Tekanan Darah</th>
                            <th>Nadi</th>
                            <th>Suhu Tubuh</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>Pernapasan</th>
                            <th>Kondisi Luka Episiotomi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($pasca_persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggalPemeriksaan'] ?><br><?= $data['jamPemeriksaan'] ?></td>
                                <td><?= $data['tekananDarah'] ?></td>
                                <td><?= $data['nadi'] ?></td>
                                <td><?= $data['suhuTubuh'] ?></td>
                                <td><?= $data['beratBadan'] ?></td>
                                <td><?= $data['tinggiBadan'] ?></td>
                                <td><?= $data['pernapasan'] ?></td>
                                <td><?= $data['kondisiLukaEpisiotomi'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kondisi Luka Caesarean</th>
                            <th>Kondisi Uterus</th>
                            <th>Kondisi Payudara</th>
                            <th>Kondisi Vagina</th>
                            <th>Kesehatan Mental</th>
                            <th>Pemeriksaan Lab</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($pasca_persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['kondisiLukaCaesarean'] ?></td>
                                <td><?= $data['kondisiUterus'] ?></td>
                                <td><?= $data['kondisiPayudara'] ?></td>
                                <td><?= $data['kondisiVagina'] ?></td>
                                <td><?= $data['kesehatanMental'] ?></td>
                                <td><?= $data['pemeriksaanLab'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Terapi</th>
                            <th>Nasihat</th>
                            <th>Komplikasi</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($pasca_persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['terapi'] ?></td>
                                <td><?= $data['nasihat'] ?></td>
                                <td><?= $data['komplikasi'] ?></td>
                                <td><?= $data['catatan'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="invoice-total-amount">
                    <p>Total Data Pasca Persalinan Ibu : <?= $no - 1 ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>