<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_salsamotor');
$res = $mysqli->query("SELECT id_booking, kode_booking, nama_pelanggan, tgl_booking, jam_booking, status_pembayaran, status_booking, created_at FROM booking_servis ORDER BY id_booking DESC LIMIT 15");
while ($r = $res->fetch_assoc()) {
    echo sprintf("#%d [%s] %s | Tgl: %s %s | Bayar: %s | Booking: %s | Created: %s\n",
        $r['id_booking'],
        $r['kode_booking'],
        $r['nama_pelanggan'],
        $r['tgl_booking'],
        $r['jam_booking'],
        $r['status_pembayaran'],
        $r['status_booking'],
        $r['created_at']
    );
}
