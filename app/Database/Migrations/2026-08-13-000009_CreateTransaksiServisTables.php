<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiServisTables extends Migration
{
    public function up()
    {
        // 1. Table transaksi_servis (Header)
        if (!$this->db->tableExists('transaksi_servis')) {
            $this->forge->addField([
                'faktur' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                ],
                'tglfaktur' => [
                    'type' => 'DATE',
                ],
                'idpel' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'nama_pelanggan' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 200,
                    'default'    => 'Pelanggan Umum',
                ],
                'merkkendaraan' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 200,
                    'null'       => true,
                ],
                'nopol' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 200,
                    'null'       => true,
                ],
                'alasan' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'totalharga' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'bayar' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'kembali' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'default'    => 'pending',
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
            $this->forge->createTable('transaksi_servis', true);
        }

        // 2. Table temp_transaksi_servis (Temporary Cart)
        if (!$this->db->tableExists('temp_transaksi_servis')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'BIGINT',
                    'constraint'     => 20,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'session_id' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'detfaktur' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'detserviskode' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'detbiaya' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'detailbrgkode' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'detailhargajual' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'detjml' => [
                    'type'       => 'DOUBLE',
                    'default'    => 1,
                ],
                'dettotaljual' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('temp_transaksi_servis', true);
        }

        // 3. Table detail_transaksi_servis (Final Detail Lines)
        if (!$this->db->tableExists('detail_transaksi_servis')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'BIGINT',
                    'constraint'     => 20,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'detfaktur' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                ],
                'detserviskode' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'detbiaya' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'detailbrgkode' => [
                    'type'       => 'CHAR',
                    'constraint' => 20,
                    'null'       => true,
                ],
                'detailhargajual' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
                'detjml' => [
                    'type'       => 'DOUBLE',
                    'default'    => 1,
                ],
                'dettotaljual' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addForeignKey('detfaktur', 'transaksi_servis', 'faktur', 'CASCADE', 'CASCADE');
            $this->forge->createTable('detail_transaksi_servis', true);
        }
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi_servis', true);
        $this->forge->dropTable('temp_transaksi_servis', true);
        $this->forge->dropTable('transaksi_servis', true);
    }
}
