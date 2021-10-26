<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sampah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
            ],
            'kategori' => [
                'type' => 'character varying',
                'constraint' => 20,
                'null' => false,
            ],
            'jenis' => [
                'type' => 'character varying',
                'constraint' => 40,
                'unique' => true,
                'null' => false,
            ],
            'harga' => [
                'type' => 'integer',
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'numeric',
                'default' => 0,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('jenis');
        $this->forge->addForeignKey('kategori','kategori_sampah','name','CASCADE','CASCADE');
        $this->forge->createTable('sampah');
    }

    public function down()
    {
        //
    }
}
