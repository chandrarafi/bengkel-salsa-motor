<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Persalinan
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
                <p><b>Laporan Data Persalinan</b></p>
                <p><?= $persalinan['ibuRM'] ?></p>
                <p><?= $persalinan['ibuNama'] ?></p>
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
                            <td><?= $persalinan['ibuNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Persalinan</td>
                            <td><?= $persalinan['tanggalPersalinan'] ?></td>
                        </tr>
                        <tr>
                            <td>Jam Persalinan</td>
                            <td><?= $persalinan['jamPersalinan'] ?></td>
                        </tr>
                        <tr>
                            <td>Cara Persalinan</td>
                            <td><?= $persalinan['caraPersalinan'] ?></td>
                        </tr>
                        <tr>
                            <td>Petugas Persalinan</td>
                            <td><?= $persalinan['userNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah</td>
                            <td><?= $persalinan['tekananDarah'] ?></td>
                        </tr>
                        <tr>
                            <td>Nadi</td>
                            <td><?= $persalinan['nadi'] ?></td>
                        </tr>
                        <tr>
                            <td>Temperature</td>
                            <td><?= $persalinan['temperature'] ?></td>
                        </tr>
                        <tr>
                            <td>Tingi Fundus Uteri</td>
                            <td><?= $persalinan['tinggiFundusUteri'] ?></td>
                        </tr>
                        <tr>
                            <td>Kontraksi Uterus</td>
                            <td><?= $persalinan['kontraksiUterus'] ?></td>
                        </tr>
                        <tr>
                            <td>Kandungan Kemih</td>
                            <td><?= $persalinan['kandunganKemih'] ?></td>
                        </tr>
                        <tr>
                            <td>Pendarahan</td>
                            <td><?= $persalinan['pendarahan'] ?></td>
                        </tr>
                        <tr>
                            <td>Keadaan Ibu</td>
                            <td><?= $persalinan['keadaanIbu'] ?></td>
                        </tr>
                        <tr>
                            <td>Keadaan Bayi</td>
                            <td><?= $persalinan['keadaanBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Presentasi</td>
                            <td><?= $persalinan['presentasi'] ?></td>
                        </tr>
                        <tr>
                            <td>Kala 1</td>
                            <td><?= $persalinan['tanggalKala1'] ?> <?= $persalinan['jamKala1'] ?></td>
                        </tr>
                        <tr>
                            <td>Kala 2</td>
                            <td><?= $persalinan['tanggalKala2'] ?> <?= $persalinan['jamKala2'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Bayi Lahir</td>
                            <td><?= $persalinan['tanggalLahirBayi'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Plasenta Lahie</td>
                            <td><?= $persalinan['tanggalPlasentaLahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Plasenta</td>
                            <td><?= $persalinan['kondisiPlasenta'] ?></td>
                        </tr>
                        <tr>
                            <td>Manajemen Kala 3</td>
                            <td><?= $persalinan['manajemenKala3'] ?></td>
                        </tr>
                        <tr>
                            <td>kondisi Kala 4</td>
                            <td><?= $persalinan['kondisiKala4'] ?></td>
                        </tr>
                        <tr>
                            <td>Kontraksi Uterus</td>
                            <td><?= $persalinan['kontraksiUterus'] ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Pendarahan</td>
                            <td><?= $persalinan['jumlahPendarahan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah Kala 4</td>
                            <td><?= $persalinan['tekananDarahKala4'] ?></td>
                        </tr>
                        <tr>
                            <td>Terjadinya Komplikasi</td>
                            <td><?= $persalinan['terjadinyaKomplikasi'] ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan Komplikasi</td>
                            <td><?= $persalinan['keteranganKomplikasi'] ?></td>
                        </tr>
                        <tr>
                            <td>Inisiasi Menyusui Dini</td>
                            <td><?= $persalinan['imd'] ?></td>
                        </tr>
                        <tr>
                            <td>Kontraksi Uterus</td>
                            <td><?= $persalinan['kontraksiUterus'] ?></td>
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