<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Persalinan Ibu
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
                <p><b>Laporan Data Persalinan Ibu </b></p>
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
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Persalinan</th>
                            <th>Petugas</th>
                            <th>Tekanan Darah</th>
                            <th>Denyut Nadi</th>
                            <th>Temperature</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggalPersalinan'] ?></td>
                                <td><?= $data['jamPersalinan'] ?></td>
                                <td><?= $data['caraPersalinan'] ?></td>
                                <td><?= $data['userNama'] ?></td>
                                <td><?= $data['tekananDarah'] ?></td>
                                <td><?= $data['nadi'] ?></td>
                                <td><?= $data['temperature'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Fundus Uteri</th>
                            <th>Kontraksi Uterus</th>
                            <th>Kandung Kemih</th>
                            <th>Pendarahan</th>
                            <th>Kondisi Ibu</th>
                            <th>Kondisi Bayi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tinggiFundusUteri'] ?></td>
                                <td><?= $data['kontraksiUterus'] ?></td>
                                <td><?= $data['kandunganKemih'] ?></td>
                                <td><?= $data['pendarahan'] ?></td>
                                <td><?= $data['keadaanIbu'] ?></td>
                                <td><?= $data['keadaanBayi'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Presentasi</th>
                            <th>Kala 1</th>
                            <th>Kala 2</th>
                            <th>TL Bayi</th>
                            <th>TL Plasenta</th>
                            <th>Kondisi Plasenta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['presentasi'] ?></td>
                                <td><?= $data['tanggalKala1'] ?><br><?= $data['jamKala1'] ?></td>
                                <td><?= $data['tanggalKala2'] ?><br><?= $data['jamKala2'] ?></td>
                                <td><?= $data['tanggalLahirBayi'] ?></td>
                                <td><?= $data['tanggalPlasentaLahir'] ?></td>
                                <td><?= $data['kondisiPlasenta'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Manajemen Kala 3</th>
                            <th>Kondisi Kala 4</th>
                            <th>Pendarahan</th>
                            <th>Tekanan Darah Kala 4</th>
                            <th>Komplikasi</th>
                            <th>Keterangan Komplikasi</th>
                            <th>IMD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($persalinan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['manajemenKala3'] ?></td>
                                <td><?= $data['kondisiKala4'] ?><br><?= $data['jamKala1'] ?></td>
                                <td><?= $data['jumlahPendarahan'] ?><br><?= $data['jamKala2'] ?></td>
                                <td><?= $data['tekananDarahKala4'] ?></td>
                                <td><?= $data['terjadinyaKomplikasi'] ?></td>
                                <td><?= $data['keteranganKomplikasi'] ?></td>
                                <td><?= $data['imd'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="invoice-total-amount">
                    <p>Total Data Persalinan Ibu : <?= $no - 1 ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>