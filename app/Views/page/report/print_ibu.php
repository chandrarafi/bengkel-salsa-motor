<!DOCTYPE html>
<html lang="en, id">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Laporan Data Master Pasien Ibu
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
                <p><b>Laporan Data Master Pasien Ibu</b></p>
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
                            <th>RM</th>
                            <th>NIK</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Lahir</th>
                            <th>Nama Suami</th>
                            <th>Alamat</th>
                            <th>RT RW</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($print_ibu as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['ibuRM'] ?></td>
                                <td><?= $data['ibuNIK'] ?></td>
                                <td><?= $data['ibuNama'] ?></td>
                                <td><?= $data['ibuTanggalLahir'] ?></td>
                                <td><?= $data['ibuSuami'] ?></td>
                                <td><?= $data['ibuAlamat'] ?></td>
                                <td><?= $data['ibuRtRw'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Pendidikan</th>
                            <th>Pekerjaan Ibu</th>
                            <th>Pekerjaan Suami</th>
                            <th>Agama</th>
                            <th>Gol Darah</th>
                            <th>No HP</th>
                            <th>BPJS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        $no = 1;
                        foreach ($print_ibu as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['ibuKecamatan'] ?></td>
                                <td><?= $data['ibuPendidikan'] ?></td>
                                <td><?= $data['ibuPekerjaan'] ?></td>
                                <td><?= $data['suamiPekerjaan'] ?></td>
                                <td><?= $data['ibuAgama'] ?></td>
                                <td><?= $data['ibuGolDarah'] ?></td>
                                <td><?= $data['ibuNoHP'] ?></td>
                                <td><?= $data['ibuNoBPJS'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="invoice-total-amount">
                    <p>Total Data : <?= $no - 1 ?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>Created by ❤ Rahmad Agung</p>
    </div>
</body>

</html>