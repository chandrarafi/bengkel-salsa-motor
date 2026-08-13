<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Pimpinan Bengkel',
                'email'      => 'pimpinan@salsamotor.com',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'level'      => 'pimpinan',
                'no_hp'      => '081234567890',
                'alamat'     => 'Jl. Pimpinan No. 1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Admin Bengkel',
                'email'      => 'admin@salsamotor.com',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'level'      => 'admin',
                'no_hp'      => '081234567891',
                'alamat'     => 'Jl. Admin Bengkel No. 2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Budi Santoso (Pelanggan)',
                'email'      => 'pelanggan@salsamotor.com',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'level'      => 'pelanggan',
                'no_hp'      => '081234567892',
                'alamat'     => 'Jl. Pelanggan No. 3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
