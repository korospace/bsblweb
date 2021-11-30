<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'text',
                'null' => false,
            ],
            'email' => [
                'type'       => 'character varying',
                'constraint' => 30,
                'unique'     => true,
                'null'       => false,
            ],
            'username' => [
                'type'       => 'character varying',
                'constraint' => 20,
                'unique'     => true,
                'null'       => false,
            ],
            'password'       => [
                'type'       => 'character varying',
                'constraint' => 255,
                'null'       => false,
            ],
            'nama_lengkap' => [
                'type'       => 'character varying',
                'constraint' => 40,
                'unique'     => true,
                'null'       => false,
            ],
            'notelp' => [
                'type'       => 'character varying',
                'constraint' => 14,
                'unique'     => true,
                'null'       => false,
            ],
            'alamat' => [
                'type'       => 'character varying',
                'constraint' => 255,
                'null'       => false,
            ],
            'tgl_lahir' => [
                'type'       => 'character varying',
                'constraint' => 10,
                'null'       => false,
                'default'    => '00-00-0000',
            ],
            'kelamin' => [
                'type'       => 'character varying',
                'constraint' => 9,
                'default'    => 'laki-laki',
                'null'       => false,
            ],
            'token' => [
                'type' => 'text',
                'null' => true,
            ],
            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => true,
                'null'    => false,
            ],
            'last_active' => [
                'type'       => 'bigint',
                'constraint' => 19,
                'default'    => 0,
                'null'       => false,
            ],
            'otp' => [
                'type'       => 'character varying',
                'constraint' => 6,
                'null'       => true,
            ],
            'is_verify' => [
                'type'    => 'BOOLEAN',
                'null'    => false,
                'default' => false,
            ],
            'privilege' => [
                'type'       => 'character varying',
                'constraint' => 10,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'bigint',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['email','username','notelp']);
        // $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
