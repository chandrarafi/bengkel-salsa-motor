<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangMasukTables extends Migration
{
    public function up()
    {
        // 1. Table barangmasuk
        if (!$this->db->tableExists('barangmasuk')) {
            $this->forge->addField([
                'faktur' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                ],
                'tanggalfaktur' => [
                    'type' => 'DATE',
                ],
                'totalharga' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'keterangan' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
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
            $this->forge->addKey('faktur', true);
            $this->forge->createTable('barangmasuk');
        }

        // 2. Table detailbarangmasuk
        if (!$this->db->tableExists('detailbarangmasuk')) {
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
                'detailhargabeli' => [
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
            $this->forge->addForeignKey('detfaktur', 'barangmasuk', 'faktur', 'CASCADE', 'CASCADE');
            $this->forge->addForeignKey('detailbrgkode', 'barang', 'kode', 'CASCADE', 'CASCADE');
            $this->forge->createTable('detailbarangmasuk');
        }

        // 3. Table temp_barangmasuk
        if (!$this->db->tableExists('temp_barangmasuk')) {
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
                'detailhargabeli' => [
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
            $this->forge->createTable('temp_barangmasuk');
        }
    }

    public function down()
    {
        $this->forge->dropTable('temp_barangmasuk', true);
        $this->forge->dropTable('detailbarangmasuk', true);
        $this->forge->dropTable('barangmasuk', true);
    }
}
