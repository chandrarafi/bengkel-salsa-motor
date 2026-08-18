<?= $this->extend('page/pelanggan/layout') ?>

<?= $this->section('content') ?>

<!-- Page Title & Header -->
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <div>
        <h4 class="fw-bold text-dark mb-1">Riwayat Servis Motor Saya</h4>
        <p class="text-xs text-secondary-light mb-0">Catatan lengkap pengerjaan bengkel, suku cadang yang diganti, dan transparansi invoice Anda.</p>
    </div>
    <a href="<?= site_url('/#booking-section') ?>" class="btn btn-brand text-xs fw-bold d-inline-flex align-items-center gap-2">
        <iconify-icon icon="solar:calendar-add-bold" class="text-base"></iconify-icon>
        Booking Servis Baru
    </a>
</div>

<!-- Stats Metric Row -->
<div class="row g-3 mb-24">
    <!-- Stat 1 -->
    <div class="col-sm-6 col-lg-4">
        <div class="card-custom p-20">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light d-block text-uppercase fw-bold mb-1">Total Servis</span>
                    <h3 class="fw-bold text-dark mb-0"><?= esc($totalServis) ?></h3>
                    <span class="text-xxs text-secondary-light">Transaksi pengerjaan</span>
                </div>
                <div class="w-48-px h-48-px rounded-12 d-flex align-items-center justify-content-center" style="background: rgba(255, 85, 0, 0.1); color: #ff5500;">
                    <iconify-icon icon="solar:history-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="col-sm-6 col-lg-4">
        <div class="card-custom p-20">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light d-block text-uppercase fw-bold mb-1">Servis Selesai</span>
                    <h3 class="fw-bold text-success-main mb-0"><?= esc($servisSelesai) ?></h3>
                    <span class="text-xxs text-success-600 fw-semibold">Bergaransi resmi</span>
                </div>
                <div class="w-48-px h-48-px rounded-12 bg-success-50 text-success-600 d-flex align-items-center justify-content-center">
                    <iconify-icon icon="solar:check-circle-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="col-sm-12 col-lg-4">
        <div class="card-custom p-20">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-xxs text-secondary-light d-block text-uppercase fw-bold mb-1">Total Pengeluaran</span>
                    <h3 class="fw-bold text-dark mb-0">Rp <?= number_format($totalBiaya, 0, ',', '.') ?></h3>
                    <span class="text-xxs text-secondary-light">Investasi perawatan motor</span>
                </div>
                <div class="w-48-px h-48-px rounded-12 bg-primary-50 text-primary-600 d-flex align-items-center justify-content-center">
                    <iconify-icon icon="solar:wallet-money-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card-custom">
    <div class="card-header-custom border-bottom">
        <h6 class="text-sm fw-bold text-dark mb-0">Daftar Transaksi Servis</h6>
        <span class="badge bg-neutral-100 text-secondary-light text-xxs px-10 py-4 radius-6 fw-bold">
            <?= count($riwayatServis) ?> Data Ditemukan
        </span>
    </div>

    <div class="card-body-custom p-0">
        <?php if (!empty($riwayatServis)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-xs">
                    <thead class="bg-neutral-50 text-secondary-light text-xxs text-uppercase fw-bold">
                        <tr>
                            <th class="ps-24 py-12">No. Faktur</th>
                            <th class="py-12">Tanggal</th>
                            <th class="py-12">Kendaraan</th>
                            <th class="py-12">Keluhan / Catatan</th>
                            <th class="py-12">Total Biaya</th>
                            <th class="py-12">Status</th>
                            <th class="text-center pe-24 py-12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($riwayatServis as $row): 
                            $status = strtolower($row['status'] ?? 'selesai');
                            $badgeClass = 'bg-success-50 text-success-600';
                            $statusText = 'Selesai';
                            if ($status === 'proses') {
                                $badgeClass = 'bg-warning-50 text-warning-600';
                                $statusText = 'Dalam Pengerjaan';
                            } elseif ($status === 'menunggu') {
                                $badgeClass = 'bg-neutral-100 text-secondary-light';
                                $statusText = 'Menunggu Antrean';
                            }
                        ?>
                            <tr>
                                <td class="ps-24 fw-bold text-dark">
                                    <?= esc($row['faktur']) ?>
                                </td>
                                <td class="text-secondary-light">
                                    <?= date('d/m/Y', strtotime($row['tglfaktur'])) ?>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= esc($row['merkkendaraan'] ?? '-') ?></span>
                                    <span class="text-xxs text-secondary-light fw-semibold"><?= esc($row['nopol'] ?? '-') ?></span>
                                </td>
                                <td>
                                    <span class="text-secondary-light d-inline-block text-truncate" style="max-width: 220px;" title="<?= esc($row['alasan'] ?? '-') ?>">
                                        <?= esc($row['alasan'] ?? 'Servis Berkala') ?>
                                    </span>
                                </td>
                                <td class="fw-bold text-dark">
                                    Rp <?= number_format($row['totalharga'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <span class="badge <?= $badgeClass ?> radius-4 px-8 py-4 text-xxs fw-bold">
                                        <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="text-center pe-24">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <button type="button" class="btn btn-outline-neutral-700 btn-sm radius-6 px-10 py-4 text-xxs fw-bold btn-detail-servis" data-faktur="<?= esc($row['faktur']) ?>">
                                            <iconify-icon icon="solar:eye-bold" class="me-1"></iconify-icon>
                                            Detail
                                        </button>
                                        <a href="<?= site_url('riwayat-servis/cetak/' . $row['faktur']) ?>" target="_blank" class="btn btn-light btn-sm radius-6 px-8 py-4 text-xxs text-dark" title="Cetak Nota">
                                            <iconify-icon icon="solar:printer-minimalistic-bold" class="text-base"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-60 px-20">
                <div class="w-64-px h-64-px rounded-circle bg-neutral-100 text-secondary-light d-inline-flex align-items-center justify-content-center mb-16">
                    <iconify-icon icon="solar:wrench-bold-duotone" class="text-3xl"></iconify-icon>
                </div>
                <h6 class="fw-bold text-dark mb-4">Belum Ada Riwayat Servis</h6>
                <p class="text-xs text-secondary-light mb-20" style="max-width: 420px; margin-left: auto; margin-right: auto;">
                    Anda belum memiliki transaksi servis di Bengkel Salsa Motor. Jadwalkan servis pertama Anda sekarang untuk performa motor yang maksimal!
                </p>
                <a href="<?= site_url('/#booking-section') ?>" class="btn btn-brand text-xs fw-bold px-20 py-10">
                    Booking Servis Sekarang
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL DETAIL SERVIS PELANGGAN -->
<div class="modal fade" id="modalDetailServis" tabindex="-1" aria-labelledby="modalDetailServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content radius-14 border-0 shadow-lg">
            <div class="modal-header border-bottom px-24 py-16">
                <div>
                    <h6 class="modal-title fw-bold text-dark" id="modalDetailServisLabel">Rincian Transaksi Servis</h6>
                    <span class="text-xxs text-secondary-light" id="modalFakturSub">-</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-24 py-20">
                <!-- Header Info Box -->
                <div class="p-16 radius-10 bg-neutral-50 border border-neutral-200 mb-20">
                    <div class="row g-2 text-xs">
                        <div class="col-sm-6">
                            <span class="text-xxs text-secondary-light d-block">Kendaraan & Nomor Polisi:</span>
                            <span class="fw-bold text-dark" id="modalMotor">-</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-xxs text-secondary-light d-block">Tanggal Servis:</span>
                            <span class="fw-bold text-dark" id="modalTanggal">-</span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <span class="text-xxs text-secondary-light d-block">Keluhan / Catatan Perawatan:</span>
                            <span class="fw-medium text-dark" id="modalAlasan">-</span>
                        </div>
                    </div>
                </div>

                <!-- Detail Table -->
                <h6 class="text-xs fw-bold text-dark text-uppercase mb-12">Rincian Jasa Servis & Suku Cadang</h6>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-xs mb-0">
                        <thead class="bg-light text-secondary-light text-xxs text-uppercase fw-bold">
                            <tr>
                                <th>Deskripsi Jasa / Sparepart</th>
                                <th class="text-center" style="width: 80px;">Qty</th>
                                <th class="text-end" style="width: 130px;">Harga Satuan</th>
                                <th class="text-end" style="width: 140px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="modalDetailBody">
                            <!-- Populated via AJAX -->
                        </tbody>
                        <tfoot class="bg-light fw-bold text-dark">
                            <tr>
                                <td colspan="3" class="text-end py-10">Total Keseluruhan:</td>
                                <td class="text-end py-10" id="modalTotalAkhir" style="color: #ff5500;">Rp 0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top px-24 py-12 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-neutral-700 text-xs radius-6 px-16 py-8" data-bs-dismiss="modal">Tutup</button>
                <a href="#" id="modalBtnCetak" target="_blank" class="btn btn-brand text-xs fw-bold px-18 py-8 d-inline-flex align-items-center gap-2">
                    <iconify-icon icon="solar:printer-minimalistic-bold" class="text-base"></iconify-icon>
                    Cetak Nota Digital
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Modal detail trigger via AJAX
        $('.btn-detail-servis').on('click', function() {
            var faktur = $(this).data('faktur');
            
            // Open modal and show loader
            $('#modalFakturSub').text('No. Faktur: ' .concat(faktur));
            $('#modalDetailBody').html('<tr><td colspan="4" class="text-center py-20 text-secondary-light">Memuat rincian data...</td></tr>');
            $('#modalBtnCetak').attr('href', '<?= site_url("riwayat-servis/cetak/") ?>' + faktur);
            $('#modalDetailServis').modal('show');

            $.ajax({
                url: '<?= site_url("pelanggan/riwayat/detail/") ?>' + faktur,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status && response.header) {
                        var h = response.header;
                        $('#modalMotor').text((h.merkkendaraan || '-') + ' (' + (h.nopol || '-') + ')');
                        $('#modalTanggal').text(h.tglfaktur || '-');
                        $('#modalAlasan').text(h.alasan || 'Servis Berkala Standar');
                        
                        var rows = '';
                        var total = 0;

                        if (response.details && response.details.length > 0) {
                            $.each(response.details, function(idx, item) {
                                var namaItem = item.jenis_servis ? ('[JASA] ' + item.jenis_servis) : (item.nama_barng ? ('[PART] ' + item.nama_barng) : 'Item Servis');
                                var qty = item.detjml || 1;
                                var harga = parseFloat(item.detbiaya || item.detailhargajual || 0);
                                var subtotal = parseFloat(item.dettotaljual || (qty * harga));
                                total += subtotal;

                                rows += '<tr>' +
                                    '<td class="fw-semibold text-dark">' + namaItem + '</td>' +
                                    '<td class="text-center">' + qty + '</td>' +
                                    '<td class="text-end">Rp ' + harga.toLocaleString('id-ID') + '</td>' +
                                    '<td class="text-end fw-bold">Rp ' + subtotal.toLocaleString('id-ID') + '</td>' +
                                    '</tr>';
                            });
                        } else {
                            rows = '<tr><td colspan="4" class="text-center text-secondary-light py-12">Tidak ada rincian item.</td></tr>';
                        }

                        $('#modalDetailBody').html(rows);
                        $('#modalTotalAkhir').text('Rp ' + parseFloat(h.totalharga || total).toLocaleString('id-ID'));
                    } else {
                        $('#modalDetailBody').html('<tr><td colspan="4" class="text-center text-danger py-12">' + (response.message || 'Gagal memuat rincian.') + '</td></tr>');
                    }
                },
                error: function() {
                    $('#modalDetailBody').html('<tr><td colspan="4" class="text-center text-danger py-12">Terjadi kesalahan koneksi server.</td></tr>');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
