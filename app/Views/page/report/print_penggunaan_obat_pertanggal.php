<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Penggunaan Obat
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
                <p><b>Laporan Data Penggunaan Obat </b></p>
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
                            <th>ID</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($penggunaan_obat as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['penggunaanObatID'] ?></td>
                                <td><?= $data['catatan'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php $total = 0;
                $no = 1;
                foreach ($penggunaan_obat as $data) { ?>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;
                            $no = 1;
                            foreach ($detail_penggunaan_obat as $data) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['Tanggal'] ?></td>
                                    <td><?= $data['obatNama'] ?></td>
                                    <td><?= $data['obatJumlah'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="invoice-total-amount">
                        <p>Total Data Penggunaan Obat : <?= $no - 1 ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>