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
                <p><b>Laporan Data Pemeriksaan Bayi </b></p>
                <p><?= $bayi['bayiNoRM'] ?></p>
                <p><?= $bayi['bayiNama'] ?></p>
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
                            <th>ASI</th>
                            <th>Mp ASI</th>
                            <th>SDI/DTK</th>
                            <th>BB</th>
                            <th>PB</th>
                            <th>Status</th>
                            <th>Vit A</th>
                            <th>Imunisasi</th>
                            <th>Keterangan</th>
                            <th>Umur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($pemeriksaan_bayi as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['asi'] ?></td>
                                <td><?= $data['mpAsi'] ?></td>
                                <td><?= $data['sdiDtk'] ?></td>
                                <td><?= $data['bbPemeriksaanBayi'] ?></td>
                                <td><?= $data['tbPemeriksaanBayi'] ?></td>
                                <td><?= $data['status'] ?></td>
                                <td><?= $data['vitA'] ?></td>
                                <td><?= $data['imunisasiBayi'] ?></td>
                                <td><?= $data['keteranganBayi'] ?></td>
                                <td><?= $data['umurBayi'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="invoice-total-amount">
                    <p>Total Data Pemeriksaan Bayi : <?= $no - 1 ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>