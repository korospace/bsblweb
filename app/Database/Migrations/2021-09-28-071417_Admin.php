<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'character varying',
                'constraint' => 20,
                'null' => false,
            ],
            'id_admin' => [
                'type' => 'character varying',
                'constraint' => 10,
                'unique' => true,
                'null' => false,
            ],
            'username' => [
                'type' => 'character varying',
                'constraint' => 20,
                'unique' => true,
                'null' => false,
            ],
            'password' => [
                'type' => 'character varying',
                'constraint' => 255,
                'null' => false,
            ],
            'nama_lengkap' => [
                'type' => 'character varying',
                'constraint' => 40,
                'unique' => true,
                'null' => false,
            ],
            'notelp' => [
                'type' => 'character varying',
                'constraint' => 14,
                'unique' => true,
                'null' => false,
            ],
            'alamat' => [
                'type' => 'character varying',
                'constraint' => 255,
                'null' => false,
            ],
            'tgl_lahir' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
                'default' => '00-00-0000',
            ],
            'kelamin' => [
                'type' => 'character varying',
                'constraint' => 9,
                'default' => 'laki-laki',
                'null' => false,
            ],
            'privilege' => [
                'type' => 'character varying',
                'constraint' => 5,
                'default' => 'admin',
                'null' => false,
            ],
            'active' => [
                'type' => 'BOOLEAN',
                'default' => true,
                'null' => false,
            ],
            'last_active' => [
                'type' => 'bigint',
                'constraint' => 19,
                'default' => 0,
                'null' => false,
            ],
            'token' => [
                'type' => 'character varying',
                'constraint' => 255,
                'null' => true,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['id_admin','username','nama_lengkap','notelp']);
        $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('admin');
    }

    public function down()
    {
        //
    }
}
