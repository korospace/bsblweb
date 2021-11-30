<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriSampah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'text',
                'null' => false,
            ],
            'name' => [
                'type'       => 'character varying',
                'constraint' => 20,
                'unique'     => true,
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('kategori_sampah');
    }

    public function down()
    {
        //
    }
}
