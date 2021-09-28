<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BeritaAcara extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'title' => [
                'type' => 'character varying',
                'constraint' => 100,
                'null' => false,
            ],
            'thumbnail' => [
                'type' => 'BYTEA',
                'null' => false,
            ],
            'content' => [
                'type' => 'character varying',
                'constraint' => 10000,
                'null' => false,
            ],
            'created_by' => [
                'type' => 'character varying',
                'constraint' => 40,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addField("created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('berita_acara');
    }

    public function down()
    {
        //
    }
}
