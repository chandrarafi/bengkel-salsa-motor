<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_salsamotor');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check existing tables
echo "=== EXISTING TABLES ===\n";
$r = $mysqli->query("SHOW TABLES");
while ($row = $r->fetch_array()) {
    echo "- " . $row[0] . "\n";
}

// Create or verify `setting_booking` table
$createSql = "CREATE TABLE IF NOT EXISTS `setting_booking` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `durasi_pembayaran_menit` INT(11) NOT NULL DEFAULT 5,
    `biaya_booking` DECIMAL(12,2) NOT NULL DEFAULT 50000.00,
    `kuota_per_jam_default` INT(11) NOT NULL DEFAULT 2,
    `kuota_slot_json` TEXT NULL,
    `updated_at` DATETIME NULL,
    `created_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($mysqli->query($createSql)) {
    echo "\nTable setting_booking created/checked successfully.\n";
} else {
    echo "Error creating table: " . $mysqli->error . "\n";
}

// Ensure default row exists
$checkRow = $mysqli->query("SELECT * FROM setting_booking LIMIT 1");
if ($checkRow && $checkRow->num_rows == 0) {
    $defaultSlots = json_encode([
        '08:00' => 2,
        '09:00' => 2,
        '10:00' => 2,
        '11:00' => 2,
        '13:00' => 2,
        '14:00' => 2,
        '15:00' => 2,
        '16:00' => 2,
    ]);
    $mysqli->query("INSERT INTO setting_booking (durasi_pembayaran_menit, biaya_booking, kuota_per_jam_default, kuota_slot_json, created_at, updated_at) VALUES (5, 50000.00, 2, '{$defaultSlots}', NOW(), NOW())");
    echo "Default setting row inserted.\n";
} else {
    echo "Setting row already exists.\n";
}
