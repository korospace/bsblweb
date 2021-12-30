<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriSampah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                // 'type'       => 'text', // postgre
                'type'       => 'varchar', // mysql
                'constraint' => 200,       // mysql
                'null'       => false,
            ],
            'name' => [
                // 'type'       => 'character varying', // postgre
                'type'       => 'varchar', // mysql
                'constraint' => 20,
                'unique'     => true,
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        // $this->forge->addUniqueKey('name'); // postgre
        $this->forge->createTable('kategori_sampah');
    }

    public function down()
    {
        //
    }
}
