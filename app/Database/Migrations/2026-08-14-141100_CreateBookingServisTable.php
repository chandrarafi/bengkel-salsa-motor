<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingServisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_booking' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_booking' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'unique'     => true,
            ],
            'id_pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'nama_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'merkkendaraan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nopol' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'kodeservis' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'jenis_servis' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'biaya' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'tgl_booking' => [
                'type' => 'DATE',
            ],
            'jam_booking' => [
                'type' => 'TIME',
            ],
            'keluhan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'metode_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'Transfer Bank BCA',
            ],
            'bukti_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu_pembayaran', 'menunggu_konfirmasi', 'lunas', 'ditolak'],
                'default'    => 'menunggu_konfirmasi',
            ],
            'status_booking' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu_konfirmasi', 'diterima', 'diproses', 'selesai', 'dibatalkan'],
                'default'    => 'menunggu_konfirmasi',
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_booking', true);
        $this->forge->createTable('booking_servis', true);
    }

    public function down()
    {
        $this->forge->dropTable('booking_servis', true);
    }
}
