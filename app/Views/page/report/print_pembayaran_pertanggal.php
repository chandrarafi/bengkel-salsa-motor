<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Pembayaran Pertanggal
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
                <p><b>Laporan Data Pembayaran Pertanggal </b></p>
                <p>Dari <?= $tanggalAwal ?></p>
                <p>Sampai <?= $tanggalAkhir ?></p>
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
                            <th>Nama Pasien</th>
                            <th>B Persalinan</th>
                            <th>B Kamar</th>
                            <th>B Obat</th>
                            <th>B Lainnya</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalPersalinan = 0;
                        $totalKamar = 0;
                        $totalObat = 0;
                        $totalLainnya = 0;
                        $totalBiaya = 0;
                        $no = 1;
                        foreach ($pembayaran as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggalPembayaran'] ?></td>
                                <td><?= $data['ibuNama'] ?></td>
                                <td><?= ($data['biayaPersalinan'] == 0) ? "BPJS" : "Rp " . number_format($data['biayaPersalinan'], 0, ',', '.') ?>
                                    <?php ($data['biayaPersalinan'] != 0) ? $totalPersalinan += $data['biayaPersalinan'] : "" ?></td>
                                <td><?= ($data['biayaPersalinan'] == 0) ? "BPJS" : "Rp " . number_format($data['biayaKamar'], 0, ',', '.') ?>
                                    <?php ($data['biayaPersalinan'] != 0) ? $totalKamar += $data['biayaKamar'] : "" ?></td>
                                <td><?= ($data['biayaPersalinan'] == 0) ? "BPJS" : "Rp " . number_format($data['biayaObat'], 0, ',', '.') ?>
                                    <?php ($data['biayaPersalinan'] != 0) ? $totalObat += $data['biayaObat'] : "" ?></td>
                                <td><?= ($data['biayaPersalinan'] == 0) ? "BPJS" : "Rp " . number_format($data['biayaLainnya'], 0, ',', '.') ?>
                                    <?php ($data['biayaPersalinan'] != 0) ? $totalLainnya += $data['biayaLainnya'] : "" ?></td>
                                <td><?= ($data['biayaPersalinan'] == 0) ? "BPJS" : "Rp " . number_format($data['totalBiaya'], 0, ',', '.') ?>
                                    <?php ($data['biayaPersalinan'] != 0) ? $totalBiaya += $data['totalBiaya'] : "" ?></td>
                                <td><?= $data['keterangan'] ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="flex-table">
                    <div class="flex-column"></div>
                    <div class="flex-column">
                        <table class="table-subtotal">
                            <tbody>
                                <tr>
                                    <td>Total Biaya Persalinan</td>
                                    <td><?= "Rp " . number_format($totalPersalinan, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Biaya Kamar</td>
                                    <td><?= "Rp " . number_format($totalKamar, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Biaya Obat</td>
                                    <td><?= "Rp " . number_format($totalObat, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Biaya Lainnya</td>
                                    <td><?= "Rp " . number_format($totalLainnya, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Total Keseluruhan</b></td>
                                    <td><b><?= "Rp " . number_format($totalBiaya, 0, ',', '.'); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>