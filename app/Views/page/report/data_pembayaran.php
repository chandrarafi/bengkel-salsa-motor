<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Pembayaran
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
                <p><b>Laporan Data Pembayaran</b></p>
                <p><?= $pembayaran['ibuRM'] ?></p>
                <p><?= $pembayaran['ibuNama'] ?></p>
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
                            <td><?= $pembayaran['ibuNama'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pembayaran</td>
                            <td><?= $pembayaran['tanggalPembayaran'] ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?= $pembayaran['keterangan'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Kamar</th>
                            <th>Tipe</th>
                            <th>Kapasitas</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        foreach ($penggunaan_kamar as $data) { ?>
                            <tr>
                                <td><?= $data['kamarNama'] ?></td>
                                <td><?= $data['kamarTipe'] ?></td>
                                <td><?= $data['kapasitas'] ?></td>
                                <td><?= $data['kamarBiaya'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Tanggal</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        foreach ($detail_penggunaan_obat as $dpo) { ?>
                            <tr>
                                <td><?= $dpo['obatNama'] ?></td>
                                <td><?= $dpo['Tanggal'] ?></td>
                                <td><?= $dpo['obatJumlah'] ?></td>
                                <td><?= $subtotal = ($dpo['obatJumlah'] * $dpo['obatHarga']);
                                    $total += $subtotal ?></td>
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
                                    <td>Biaya Persalinan</td>
                                    <td><?= ($data['biayaPersalinan'] == 0) ? "Rp 0" : "Rp " . number_format($data['biayaPersalinan'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Kamar</td>
                                    <td><?= ($data['biayaPersalinan'] == 0) ? "Rp 0" : "Rp " . number_format($data['biayaKamar'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Obat</td>
                                    <td><?= ($data['biayaPersalinan'] == 0) ? "Rp 0" : "Rp " . number_format($data['biayaObat'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Lainnya</td>
                                    <td><?= ($data['biayaPersalinan'] == 0) ? "Rp 0" : "Rp " . number_format($data['biayaLainnya'], 0, ',', '.') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="invoice-total-amount">
                    <p>Total : <?= ($data['biayaPersalinan'] == 0) ? "Rp 0 (BPJS)" : "Rp " . number_format($data['totalBiaya'], 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>