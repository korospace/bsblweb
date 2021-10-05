<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeed extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 'A001',
            'username' => 'superadmin',
            'password' => password_hash(trim('superadmin'), PASSWORD_DEFAULT),
            'nama_lengkap' => 'super admin 1',
            'notelp' => '021123456789',
            'alamat' => 'cileduk',
            'tgl_lahir' => '00-00-0000',
            'kelamin' => 'laki-laki',
            'privilege' => 'super',
            'last_active' => time(),
        ];

        $this->db->table('admin')->insert($data);
    }
}
