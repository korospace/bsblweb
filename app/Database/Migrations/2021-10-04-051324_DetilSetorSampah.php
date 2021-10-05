<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetilSetorSampah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'serial',
                'null' => false,
            ],
            'id_setor' => [
                'type' => 'text',
                'null' => false,
            ],
            'id_sampah' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
            ],
            'jumlah' => [
                'type' => 'integer',
                'null' => false,
            ],
            'harga' => [
                'type' => 'integer',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_setor','setor_sampah','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('id_sampah','sampah','id','SET NULL','SET NULL');
        $this->forge->createTable('detil_setor_sampah');
    }

    public function down()
    {
        //
    }
}
