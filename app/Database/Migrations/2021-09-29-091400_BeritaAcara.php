<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BeritaAcara extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
            ],
            'title' => [
                'type' => 'character varying',
                'constraint' => 100,
                'null' => false,
            ],
            'thumbnail' => [
                'type' => 'text',
                'null' => false,
            ],
            'content' => [
                'type' => 'text',
                'null' => false,
            ],
            'kategori' => [
                'type' => 'character varying',
                'constraint' => 20,
                'null' => false,
            ],
            'created_by' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('title');
        $this->forge->addForeignKey('kategori','kategori_berita','name','CASCADE','CASCADE');
        $this->forge->addForeignKey('created_by','admin','id','NO ACTION','NO ACTION');
        $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('berita_acara');
    }

    public function down()
    {
        //
    }
}
