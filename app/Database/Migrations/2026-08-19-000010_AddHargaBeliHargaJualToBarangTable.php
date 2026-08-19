<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHargaBeliHargaJualToBarangTable extends Migration
{
    public function up()
    {
        $fields = [
            'harga_beli' => [
                'type'       => 'DOUBLE',
                'default'    => 0,
                'after'      => 'idsatuan',
            ],
            'harga_jual' => [
                'type'       => 'DOUBLE',
                'default'    => 0,
                'after'      => 'harga_beli',
            ],
        ];

        if (!$this->db->fieldExists('harga_beli', 'barang')) {
            $this->forge->addColumn('barang', $fields);
        }

        // Copy existing 'harga' column values into 'harga_jual' and 'harga_beli' if 'harga' exists
        if ($this->db->fieldExists('harga', 'barang')) {
            $this->db->query("UPDATE barang SET harga_jual = harga, harga_beli = harga WHERE harga_jual = 0 AND harga_beli = 0");
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('harga_jual', 'barang')) {
            $this->forge->dropColumn('barang', 'harga_jual');
        }
        if ($this->db->fieldExists('harga_beli', 'barang')) {
            $this->forge->dropColumn('barang', 'harga_beli');
        }
    }
}
