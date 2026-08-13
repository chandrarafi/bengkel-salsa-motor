<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServisTable extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('servis')) {
            if (!$this->db->fieldExists('estimasi_waktu', 'servis')) {
                $this->forge->addColumn('servis', [
                    'estimasi_waktu' => [
                        'type'       => 'INT',
                        'constraint' => 11,
                        'default'    => 30,
                        'after'      => 'Keterangan',
                    ],
                ]);
            }
            if (!$this->db->fieldExists('created_at', 'servis')) {
                $this->forge->addColumn('servis', [
                    'created_at' => [
                        'type' => 'DATETIME',
                        'null' => true,
                    ],
                    'updated_at' => [
                        'type' => 'DATETIME',
                        'null' => true,
                    ],
                ]);
            }
        } else {
            $this->forge->addField([
                'kodeservis' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                ],
                'Jenis_servis' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                ],
                'Biaya' => [
                    'type'    => 'DOUBLE',
                    'default' => 0,
                ],
                'Keterangan' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'estimasi_waktu' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 30,
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

            $this->forge->addKey('kodeservis', true);
            $this->forge->createTable('servis');
        }
    }

    public function down()
    {
        $this->forge->dropTable('servis', true);
    }
}
