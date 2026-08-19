<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropHargaFromBarangTable extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('harga', 'barang')) {
            $this->forge->dropColumn('barang', 'harga');
        }
    }

    public function down()
    {
        if (!$this->db->fieldExists('harga', 'barang')) {
            $fields = [
                'harga' => [
                    'type'       => 'DOUBLE',
                    'default'    => 0,
                    'after'      => 'harga_jual',
                ],
            ];
            $this->forge->addColumn('barang', $fields);
        }
    }
}
