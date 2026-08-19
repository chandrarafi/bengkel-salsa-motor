<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_salsamotor');

// Update any existing rejected bookings
$mysqli->query("UPDATE booking_servis SET status_booking = 'dibatalkan' WHERE status_pembayaran = 'ditolak'");
echo "Updated rows: " . $mysqli->affected_rows . "\n";

// Check today's active bookings
$res = $mysqli->query("SELECT id_booking, kode_booking, jam_booking, status_pembayaran, status_booking FROM booking_servis WHERE tgl_booking = CURDATE()");
while ($r = $res->fetch_assoc()) {
    echo sprintf("[%s] Jam: %s | Pay: %s | Booking: %s\n",
        $r['kode_booking'],
        $r['jam_booking'],
        $r['status_pembayaran'],
        $r['status_booking']
    );
}
