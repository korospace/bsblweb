<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Artikel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'text',
                'null' => false,
            ],
            'title' => [
                'type'       => 'character varying',
                'constraint' => 255,
                'null'       => false,
            ],
            'thumbnail' => [
                'type' => 'text',
                'null' => false,
            ],
            'content' => [
                'type' => 'text',
                'null' => false,
            ],
            'id_kategori' => [
                'type' => 'text',
                'null' => false,
            ],
            'created_by' => [
                'type'       => 'text',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'bigint',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('title');
        $this->forge->addForeignKey('id_kategori','kategori_artikel','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('created_by','users','id','CASCADE','CASCADE');
        // $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('artikel');
    }

    public function down()
    {
        //
    }
}
