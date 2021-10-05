<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetorSampah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'text',
                'null' => false,
            ],
            'id_nasabah' => [
                'type' => 'character varying',
                'constraint' => 10,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_nasabah','nasabah','id','CASCADE','CASCADE');
        $this->forge->addField("tgl_setor TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->forge->createTable('setor_sampah');
    }

    public function down()
    {
        //
    }
}
