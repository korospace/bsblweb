<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriBerita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'name' => [
                'type' => 'character varying',
                'constraint' => 20,
                'unique' => true,
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('kategori_berita');
    }

    public function down()
    {
        //
    }
}
