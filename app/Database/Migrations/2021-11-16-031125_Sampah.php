<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sampah extends Migration
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
            'id_kategori' => [
                // 'type'       => 'text', // postgre
                'type'       => 'varchar', // mysql
                'constraint' => 200,       // mysql
                'null'       => false,
            ],
            'jenis' => [
                // 'type'       => 'character varying', // postgre
                'type'       => 'varchar', // mysql
                'constraint' => 40,
                'unique'     => true,
                'null'       => false,
            ],
            'harga' => [
                // 'type' => 'integer', // postgre
                'type' => 'int', // mysql
                'null' => false,
            ],
            'jumlah' => [
                'type'    => 'numeric',
                'default' => 0,
                'null'    => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        // $this->forge->addUniqueKey('jenis'); // postgre
        $this->forge->addForeignKey('id_kategori','kategori_sampah','id','CASCADE','CASCADE');
        $this->forge->createTable('sampah');
    }

    public function down()
    {
        //
    }
}
