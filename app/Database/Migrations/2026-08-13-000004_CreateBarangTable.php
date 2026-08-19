<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode' => [
                'type'       => 'CHAR',
                'constraint' => 10,
            ],
            'nama_barng' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'idkategori' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'idsatuan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'harga_beli' => [
                'type'       => 'DOUBLE',
                'default'    => 0,
            ],
            'harga_jual' => [
                'type'       => 'DOUBLE',
                'default'    => 0,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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

        $this->forge->addKey('kode', true);
        $this->forge->addForeignKey('idkategori', 'kategori', 'idkategori', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idsatuan', 'satuan', 'idsatuan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
