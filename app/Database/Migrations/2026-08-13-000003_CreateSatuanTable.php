<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSatuanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idsatuan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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

        $this->forge->addKey('idsatuan', true);
        $this->forge->createTable('satuan');
    }

    public function down()
    {
        $this->forge->dropTable('satuan');
    }
}
