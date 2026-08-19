<?php
require 'vendor/autoload.php';

// Bootstrap CI4
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require 'app/Config/Paths.php';
$paths = new Config\Paths();
require 'system/bootstrap.php';

$settingModel = new \App\Models\SettingBookingModel();
$slots = $settingModel->getSlotAvailability('2026-08-19');

echo "=== SLOT AVAILABILITY FOR 2026-08-19 ===\n";
foreach ($slots as $jam => $data) {
    echo sprintf("Jam %s: Max: %d | Booked: %d | Sisa: %d | Available: %s\n",
        $jam,
        $data['max_kuota'],
        $data['booked_count'],
        $data['sisa_kuota'],
        $data['is_available'] ? 'YES' : 'NO'
    );
}
