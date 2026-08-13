<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanTables extends Migration
{
    public function up()
    {
        // 1. Table penjualan (Header)
        if (!$this->db->tableExists('penjualan')) {
            $this->forge->addField([
                'faktur' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                ],
                'tglfaktur' => [
                    'type' => 'DATE',
                ],
                'nama_pelanggan' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'default'    => 'Pelanggan Umum',
                ],
                'totalharga' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'bayar' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'kembali' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'keterangan' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
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
            $this->forge->addKey('faktur', true);
            $this->forge->createTable('penjualan');
        }

        // 2. Table detailpenjualan (Item details)
        if (!$this->db->tableExists('detailpenjualan')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'BIGINT',
                    'constraint'     => 20,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'detfaktur' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                ],
                'detailbrgkode' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                ],
                'detailhargajual' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'jumlah' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 1,
                ],
                'subtotal' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addForeignKey('detfaktur', 'penjualan', 'faktur', 'CASCADE', 'CASCADE');
            $this->forge->addForeignKey('detailbrgkode', 'barang', 'kode', 'CASCADE', 'CASCADE');
            $this->forge->createTable('detailpenjualan');
        }

        // 3. Table temp_penjualan (Temporary cart)
        if (!$this->db->tableExists('temp_penjualan')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'BIGINT',
                    'constraint'     => 20,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'session_id' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                ],
                'detfaktur' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'detailbrgkode' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                ],
                'detailhargajual' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'jumlah' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 1,
                ],
                'subtotal' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('temp_penjualan');
        }
    }

    public function down()
    {
        $this->forge->dropTable('temp_penjualan', true);
        $this->forge->dropTable('detailpenjualan', true);
        $this->forge->dropTable('penjualan', true);
    }
}
