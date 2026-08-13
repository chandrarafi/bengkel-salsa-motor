<?= $this->extend('page/component/layout_print') ?>

<?= $this->section('content') ?>
<div class="row gy-4 justify-content-center mt-10">
    <!-- Dashboard Widget Start -->
    <div class="col-xxl-3 col-sm-8">
        <div class="card px-24 py-16 shadow-none radius-8 border h-100 bg-gradient-danger">
            <div class="card-body p-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-shrink-0 w-170-px h-100">
                            <img src="<?= site_url() ?>assets/images/asset/asset-img6.png" class="h-100 w-100 object-fit-cover" alt="">
                        </div>
                        <div>
                            <img src="<?= base_url() ?>assets/images/logo.png" alt="Bootdey.com" style="height: 20px; max-width: 100%; width: 120px;" height="50" width="157" /><br>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Kartu Pasien Bayi</span>
                            <h6 class="fw-semibold text-secondary-light my-1"><?= $bayi['bayiNoRM'] ?></h6>
                            <h5 class="fw-semibold text-secondary-light my-1"><?= $bayi['bayiNama'] ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Widget End -->
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
    window.print();
</script>
<?= $this->endSection() ?>