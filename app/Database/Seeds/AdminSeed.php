<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeed extends Seeder
{
    public function run()
    {
        $data = [
            'id'           => 'A001',
            'email'        => 'superadmin1@gmail.com',
            'username'     => 'superadmin1',
            'password'     => password_hash(trim('superadmin1'), PASSWORD_DEFAULT),
            'nama_lengkap' => 'super admin 1',
            'notelp'       => '021123456789',
            'nik'          => '1234567890123456',
            'alamat'       => 'cileduk',
            'tgl_lahir'    => date("d-m-Y", time()),
            'kelamin'      => 'laki-laki',
            'is_active'    => true,
            'last_active'  => time(),
            'is_verify'    => true,
            'privilege'    => 'superadmin',
            'created_at'   => time(),
        ];

        $this->db->table('users')->insert($data);
    }
}
