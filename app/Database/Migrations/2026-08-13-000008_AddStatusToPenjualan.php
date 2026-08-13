<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToPenjualan extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('penjualan') && !$this->db->fieldExists('status', 'penjualan')) {
            $fields = [
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'pending',
                    'after'      => 'keterangan',
                ],
            ];
            $this->forge->addColumn('penjualan', $fields);

            // Update existing transactions to 'selesai' if bayar > 0
            $this->db->query("UPDATE penjualan SET status = 'selesai' WHERE bayar > 0");
        }
    }

    public function down()
    {
        if ($this->db->tableExists('penjualan') && $this->db->fieldExists('status', 'penjualan')) {
            $this->forge->dropColumn('penjualan', 'status');
        }
    }
}
