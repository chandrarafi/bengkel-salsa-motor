<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_salsamotor');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Update records that have DP Terbayar in alasan
$res = $mysqli->query("SELECT faktur, alasan FROM transaksi_servis WHERE (dp_booking IS NULL OR dp_booking = 0) AND (alasan LIKE '%DP Terbayar%' OR alasan LIKE '%DP Online%')");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        if (preg_match('/DP (?:Terbayar|Online):\s*Rp\s*([0-9\.]+)/i', $row['alasan'], $m)) {
            $dpVal = (float)str_replace('.', '', $m[1]);
            $faktur = $row['faktur'];
            $mysqli->query("UPDATE transaksi_servis SET dp_booking = {$dpVal} WHERE faktur = '{$faktur}'");
            echo "Updated faktur {$faktur} with dp_booking = {$dpVal}\n";
        }
    }
}
