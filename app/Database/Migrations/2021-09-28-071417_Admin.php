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
                'null' => false,
            ],
            'username' => [
                'type' => 'character varying',
                'constraint' => 20,
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
                'null' => false,
            ],
            'notelp' => [
                'type' => 'character varying',
                'constraint' => 12,
                'null' => false,
            ],
            'alamat' => [
                'type' => 'character varying',
                'constraint' => 255,
                'null' => false,
            ],
            'tgl_lahir' => [
                'type' => 'character varying',
                'constraint' => 16,
                'null' => false,
                'default' => '03-oktober-2000',
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
            'token' => [
                'type' => 'character varying',
                'constraint' => 255,
                'null' => true,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('id_admin');
        $this->forge->addField("last_active TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('admin');
    }

    public function down()
    {
        //
    }
}
