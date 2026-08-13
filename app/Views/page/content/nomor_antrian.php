<?= $this->extend('page/component/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Nomor Antrian</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="#" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:ticket-outline" class="icon text-lg"></iconify-icon>
                Nomor Antrian
            </a>
        </li>
    </ul>
</div>


<div class="row gy-4 mb-20">
    <div class="col-xxl-3 col-sm-3">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Antrian</p>
                        <h4 class="mb-0"><?= $antrianTotal ?></h4>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mingcute:ticket-fill" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Antrian Sekarang</p>
                        <h4 class="mb-0"><?= $antrianSaatIni ?></h4>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mingcute:ticket-fill" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Berikutnya</p>
                        <h4 class="mb-0"><?= ($antrianTotal == $antrianSaatIni) ? '-' : $antrianSaatIni + 1 ?></h4>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mingcute:ticket-fill" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Sisa Antrian</p>
                        <h4 class="mb-0"><?= $antrianTotal - $antrianSaatIni ?></h4>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mingcute:ticket-fill" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row gy-4 justify-content-center">
    <div class="col-xxl-3 col-sm-3">
        <div class="card h-100 radius-12 bg-gradient-success text-center">
            <div class="card-body p-24">
                <a href="<?= site_url('print-antrian') ?>" target="_blank" class="d-block w-100 d-inline-flex justify-content-center  btn btn-success-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16">
                    <iconify-icon icon="mingcute:print-fill" class="text-xl"></iconify-icon> Cetak Antrian Baru
                </a>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-4">
        <div class="card h-100 radius-12 bg-gradient-primary text-center">
            <div class="card-body p-24">
                <a href="<?= site_url('prev-antrian') ?>" class="d-block w-100 d-inline-flex justify-content-center  btn btn-primary-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16 <?= ($antrianSaatIni == 0) ? 'disabled' : '' ?>">
                    <iconify-icon icon="mingcute:arrow-left-fill" class="text-xl"></iconify-icon> Antrian Sebelumnya
                </a>
                <a href="<?= site_url('next-antrian') ?>" class="d-block w-100 d-inline-flex justify-content-center  btn btn-primary-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16 <?= ($antrianSaatIni >= $antrianTotal) ? 'disabled' : '' ?>">
                    <iconify-icon icon="mingcute:arrow-right-fill" class="text-xl"></iconify-icon> Antrian Selanjutnya
                </a>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-3">
        <div class="card h-100 radius-12 bg-gradient-danger text-center">
            <div class="card-body p-24">
                <a href="<?= site_url('reset-antrian') ?>" class="d-block w-100 d-inline-flex justify-content-center  btn btn-danger-600 radius-12 px-20 py-11 d-flex align-items-center gap-2 mb-16">
                    <iconify-icon icon="mingcute:alert-fill" class="text-xl"></iconify-icon> Reset Antrian
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var blurred = false;
    window.onblur = function() {
        blurred = true;
    };
    window.onfocus = function() {
        blurred && (location.reload());
    };
</script>
<?= $this->endSection() ?>