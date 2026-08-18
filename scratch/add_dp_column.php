<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_salsamotor');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if dp_booking column exists
$result = $mysqli->query("SHOW COLUMNS FROM transaksi_servis LIKE 'dp_booking'");
if ($result && $result->num_rows == 0) {
    $mysqli->query("ALTER TABLE transaksi_servis ADD COLUMN dp_booking DECIMAL(12,2) DEFAULT 0 AFTER totalharga");
    echo "Column dp_booking added to transaksi_servis successfully.\n";
} else {
    echo "Column dp_booking already exists.\n";
}
