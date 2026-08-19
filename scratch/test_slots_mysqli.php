<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_salsamotor');

$res = $mysqli->query("SELECT jam_booking, COUNT(*) as total FROM booking_servis WHERE tgl_booking = '2026-08-19' AND status_booking NOT IN ('dibatalkan', 'ditolak') AND status_pembayaran NOT IN ('ditolak') GROUP BY jam_booking");

$booked = [];
while ($r = $res->fetch_assoc()) {
    $jamKey = substr(trim($r['jam_booking']), 0, 5);
    $booked[$jamKey] = (int)$r['total'];
}

$slots = ['08:00'=>2, '09:00'=>2, '10:00'=>2, '11:00'=>2, '13:00'=>2, '14:00'=>2, '15:00'=>2, '16:00'=>2];

echo "=== ACTIVE SLOTS FOR 2026-08-19 ===\n";
foreach ($slots as $jam => $max) {
    $bCount = $booked[$jam] ?? 0;
    $sisa = max(0, $max - $bCount);
    echo sprintf("Jam %s: Max: %d | Booked: %d | Sisa: %d | Full: %s\n",
        $jam,
        $max,
        $bCount,
        $sisa,
        ($bCount >= $max) ? 'YES' : 'NO'
    );
}
